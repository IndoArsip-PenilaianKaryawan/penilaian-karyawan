<?php

namespace App\Http\Controllers;


use App\Models\M_karyawan;
use App\Models\M_kompetensi;
use App\Models\m_periode;
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
