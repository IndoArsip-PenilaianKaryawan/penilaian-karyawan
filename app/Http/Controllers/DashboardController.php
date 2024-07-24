<?php

namespace App\Http\Controllers;

use App\Exports\RekapExport;
use App\Models\M_bidang;
use App\Models\M_cabang;
use App\Models\M_departement;
use App\Models\M_karyawan;
use App\Models\M_kompetensi;
use App\Models\m_periode;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $userCount = M_karyawan::where('is_penilai', 1)->count();
        $karyawanCount = M_karyawan::count();
        $kompetensiCount = M_kompetensi::count();
        $periodeCount = m_periode::count();


        $rataAllBidang = DB::table('m_nilai as mn')
        ->join('m_karyawan as mk', 'mn.id_karyawan', '=', 'mk.id')
            ->join('m_bidang as mb', 'mb.id', '=', 'mk.id_bidang')
            ->join('m_departement as d', 'd.id', '=', 'mb.id_departement')
            ->join(DB::raw("(SELECT 0 i UNION SELECT 1 UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7 UNION SELECT 8 UNION SELECT 9) numbers"), function ($join) {
                $join->on(DB::raw("JSON_EXTRACT(mn.nilai_approval_2, CONCAT('$[', numbers.i, ']'))"), 'IS NOT', DB::raw('NULL'));
            })
            ->select('mb.id', 'mb.nama_bidang', DB::raw('AVG(CAST(JSON_UNQUOTE(JSON_EXTRACT(mn.nilai_approval_2, CONCAT("$[", numbers.i, "]"))) AS UNSIGNED)) AS rata_nilai_bidang'))
            ->groupBy('mb.id', 'mb.nama_bidang')
            ->get();

        $rataAllDepartement = DB::table('m_nilai as mn')
        ->join('m_karyawan as mk', 'mn.id_karyawan', '=', 'mk.id')
        ->join('m_bidang as mb', 'mb.id', '=', 'mk.id_bidang')
        ->join('m_departement as d', 'd.id', '=', 'mb.id_departement')
        ->join(DB::raw("(SELECT 0 i UNION SELECT 1 UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7 UNION SELECT 8 UNION SELECT 9) numbers"), function ($join) {
            $join->on(DB::raw("JSON_EXTRACT(mn.nilai_approval_2, CONCAT('$[', numbers.i, ']'))"), 'IS NOT', DB::raw('NULL'));
        })
            ->select('d.id', 'd.nama_departement', DB::raw('AVG(CAST(JSON_UNQUOTE(JSON_EXTRACT(mn.nilai_approval_2, CONCAT("$[", numbers.i, "]"))) AS UNSIGNED)) AS rata_nilai_departement'))
            ->groupBy('d.id', 'd.nama_departement')
            ->get();

        return view('dashboard_adm.index', [
            'userCount' => $userCount,
            'karyawanCount' => $karyawanCount,
            'kompetensiCount' => $kompetensiCount,
            'periodeCount' => $periodeCount,
            'rataAllBidang' => $rataAllBidang,
            'rataAllDepartement' => $rataAllDepartement
        ]);
    }



    public function rekapNilaiCpy(Request $request)
    {
        $action = $request->input('action');
        $id_periode = $request->input('id_periode');
        $id_cabang = $request->input('id_cabang');
        $id_bidang = $request->input('id_bidang');
        $id_departement = $request->input('id_departement');

        // Jika id_periode belum dipilih, ambil periode terbaru
        if (!$id_periode) {
            $periode_terbaru = m_periode::orderBy('created_at', 'desc')->first();
            if (!$periode_terbaru) {
                return redirect()->back()->withErrors(['msg' => 'No periode available']);
            }
            $id_periode = $periode_terbaru->id;
        }

        if ($action === 'export') {
            return $this->exportRekap($request);
        }

        // Fetch karyawans with filters
        $karyawansQuery = M_karyawan::join('m_bidang', 'm_karyawan.id_bidang', '=', 'm_bidang.id')
        ->select('m_karyawan.*', 'm_karyawan.no_pegawai', 'm_bidang.nama_bidang');

        if ($id_cabang) {
            $karyawansQuery->where('m_karyawan.id_cabang', $id_cabang);
        }
        if ($id_bidang) {
            $karyawansQuery->where('m_karyawan.id_bidang', $id_bidang);
        }
        if ($id_departement) {
            $karyawansQuery->whereHas('bidang', function ($query) use ($id_departement) {
                $query->where('id_departement', $id_departement);
            });
        }

        $karyawans = $karyawansQuery->get();

        $periode_terpilih = m_periode::find($id_periode);
        if (!$periode_terpilih) {
            return redirect()->back()->withErrors(['msg' => 'Periode not found']);
        }

        $periodes = m_periode::orderBy('created_at', 'desc')->get();
        $cabangs = M_cabang::all();
        $bidangs = M_bidang::all();
        $departements = M_departement::all();

        // Fetch nilai_karyawan as before
        $nilai_karyawan = [];
        foreach ($karyawans as $karyawan) {
            // ... your existing code for fetching nilai and departement ...

            $nilai_approval_2 = DB::table('m_nilai')
            ->select(DB::raw("
                    AVG(CAST(JSON_UNQUOTE(JSON_EXTRACT(JSON_EXTRACT(nilai_approval_2, CONCAT('$[', numbers.i, ']')), '$')) AS UNSIGNED)) AS rata_rata_nilai_approval_2
                "))
            ->crossJoin(DB::raw("(SELECT 0 i UNION SELECT 1 UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7 UNION SELECT 8 UNION SELECT 9) numbers"))
            ->where('id_karyawan', $karyawan->id)
            ->where('id_periode', $id_periode)
            ->whereRaw("JSON_EXTRACT(indeks, CONCAT('$[', numbers.i, ']')) IS NOT NULL")
            ->groupBy('id_karyawan', 'id_periode')
            ->value('rata_rata_nilai_approval_2');

            $departement = DB::table('m_bidang as mb')
            ->where('mb.id', $karyawan->id_bidang)
                ->join('m_departement as d', 'd.id', '=', 'mb.id_departement')
                ->select('d.nama_departement')
                ->first();

            // Ambil data status approval
            $nilai = DB::table('m_nilai')
            ->select('indeks', 'status_approval_2')
                ->where('id_karyawan', $karyawan->id)
                ->where('id_periode', $id_periode)
                ->first();

            if ($nilai) {
                $nilai_karyawan[$karyawan->id] = [
                    'nilai_approval_2' => $nilai_approval_2,
                    'status_approval_2' => $nilai->status_approval_2,
                    'departement' => $departement ? $departement->nama_departement : null
                ];
            } else {
                $nilai_karyawan[$karyawan->id] = [
                    'nilai_approval_2' => $nilai_approval_2,
                    'status_approval_2' => null,
                    'departement' => $departement ? $departement->nama_departement : null
                ];
            }
        }

        return view('dashboard_adm.rekap', compact('karyawans', 'periodes', 'periode_terpilih', 'nilai_karyawan', 'cabangs', 'bidangs', 'departements', 'id_cabang', 'id_bidang', 'id_departement'));
    }

    public function rekapNilai(Request $request)
    {
        $action = $request->input('action');
        $id_periode = $request->input('id_periode');
        $id_cabang = $request->input('id_cabang');
        $id_bidang = $request->input('id_bidang');
        $id_departement = $request->input('id_departement');
        $search = $request->input('search');

        // Jika id_periode belum dipilih, ambil periode terbaru
        if (!$id_periode) {
            $periode_terbaru = m_periode::orderBy('created_at', 'desc')->first();
            if (!$periode_terbaru) {
                return redirect()->back()->withErrors(['msg' => 'No periode available']);
            }
            $id_periode = $periode_terbaru->id;
        }

        if ($action === 'export') {
            return $this->exportRekap($request);
        }

        // Filter
        $karyawansQuery = M_karyawan::join('m_bidang', 'm_karyawan.id_bidang', '=', 'm_bidang.id')
        ->select('m_karyawan.*', 'm_karyawan.no_pegawai', 'm_bidang.nama_bidang');

        if ($id_cabang && $id_cabang !== 'all') {
            $karyawansQuery->where('m_karyawan.id_cabang', $id_cabang);
        }
        if ($id_bidang && $id_bidang !== 'all') {
            $karyawansQuery->where('m_karyawan.id_bidang', $id_bidang);
        }
        if ($id_departement && $id_departement !== 'all') {
            $karyawansQuery->whereHas('bidang', function ($query) use ($id_departement) {
                $query->where('id_departement', $id_departement);
            });
        }

        // Search
        if ($search) {
            $karyawansQuery->where(function ($query) use ($search) {
                $query->where('m_karyawan.nama', 'like', '%' . $search . '%')
                    ->orWhere('m_karyawan.no_pegawai', 'like', '%' . $search . '%');
            });
        }

        $karyawans = $karyawansQuery->get();

        //buat pagination
        $perPage = 10;

        // Tentukan halaman saat ini
        $currentPage = Paginator::resolveCurrentPage();

        // Potong data untuk halaman saat ini
        $currentItems = $karyawans->slice(($currentPage - 1) * $perPage, $perPage)->all();

        // Buat instance LengthAwarePaginator
        $karyawansPaginated = new LengthAwarePaginator(
            $currentItems,
            $karyawans->count(),
            $perPage,
            $currentPage,
            ['path' => Paginator::resolveCurrentPath()]
        );

        $periode_terpilih = m_periode::find($id_periode);
        if (!$periode_terpilih) {
            return redirect()->back()->withErrors(['msg' => 'Periode not found']);
        }

        $periodes = m_periode::orderBy('created_at', 'desc')->get();
        $cabangs = M_cabang::all();
        $bidangs = M_bidang::all();
        $departements = M_departement::all();

        // Fetch nilai_karyawan
        $nilai_karyawan = [];
        $totalNilaiApproval2 = 0;
        $totalEmployees = 0;
        foreach ($karyawans as $karyawan) {



            $nilai_approval_2 = DB::table('m_nilai')
                ->select(DB::raw("
                    AVG(CAST(JSON_UNQUOTE(JSON_EXTRACT(JSON_EXTRACT(nilai_approval_2, CONCAT('$[', numbers.i, ']')), '$')) AS UNSIGNED)) AS rata_rata_nilai_approval_2
                "))
                ->crossJoin(DB::raw("(SELECT 0 i UNION SELECT 1 UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7 UNION SELECT 8 UNION SELECT 9) numbers"))
                ->where('id_karyawan', $karyawan->id)
                ->where('id_periode', $id_periode)
                ->whereRaw("JSON_EXTRACT(indeks, CONCAT('$[', numbers.i, ']')) IS NOT NULL")
                ->groupBy('id_karyawan', 'id_periode')
                ->value('rata_rata_nilai_approval_2');



            $departement = DB::table('m_bidang as mb')
                ->where('mb.id', $karyawan->id_bidang)
                ->join('m_departement as d', 'd.id', '=', 'mb.id_departement')
                ->select('d.nama_departement')
                ->first();

            // Ambil data status approval
            $nilai = DB::table('m_nilai')
                ->select('indeks', 'status_approval_2')
                ->where('id_karyawan', $karyawan->id)
                ->where('id_periode', $id_periode)
                ->first();

            if ($nilai) {
                $nilai_karyawan[$karyawan->id] = [
                    'nilai_approval_2' => $nilai_approval_2,
                    'status_approval_2' => $nilai->status_approval_2,

                    'departement' => $departement ? $departement->nama_departement : null
                ];
            } else {
                $nilai_karyawan[$karyawan->id] = [
                    'nilai_approval_2' => $nilai_approval_2,
                    'status_approval_2' => null,
                    'departement' => $departement ? $departement->nama_departement : null
                ];
            }

            if ($nilai_approval_2 !== null) {
                $totalNilaiApproval2 += $nilai_approval_2;
                $totalEmployees++;
            }

        }

        
        $averageNilaiApproval2 = $totalEmployees > 0 ? $totalNilaiApproval2 / $totalEmployees : 0;

        return view('dashboard_adm.rekap', compact('karyawansPaginated', 'periodes', 'periode_terpilih', 'nilai_karyawan', 'cabangs', 'bidangs', 'departements', 'id_cabang', 'id_bidang', 'id_departement', 'averageNilaiApproval2'));
    }


    public function exportRekap(Request $request){
        $exporter = new RekapExport();
        return $exporter->export($request);

    }


    public function notifCount(){
        $notifCount = DB::table('m_nilai as mn')
        ->join('m_karyawan as mk', 'mn.id_karyawan', '=', 'mk.id')
        ->join('m_bidang as mb', 'mb.id', '=', 'mk.id_bidang')
        ->join('m_departement as d', 'd.id', '=', 'mb.id_departement')
        ->where('mn.status_approval_1', null)
        ->orWhere('m_karyawan.id_approval_2', null)
        ->count();
        return view('component.sidebar2', [
            'notifCount' => $notifCount
        ]);
    }
}
