<?php

namespace App\Http\Controllers;


use App\Models\M_karyawan;
use App\Models\M_kompetensi;
use App\Models\M_nilai;
use App\Models\m_periode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Exports\KaryawanExport;

class PenilaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index()
    // {
    //     $user = Auth::guard('user')->user();

    //     $total = M_karyawan::where(function ($query) use ($user) {
    //         $query->where('id_approval_1', $user->id)
    //             ->orWhere('id_approval_2', $user->id);
    //     })->count();




    //     return view('dashboard_penilai.index', compact('total'));
    // }

    public function index(Request $request)
    {
        $user = Auth::guard('user')->user(); // Ambil user yang sudah login

        $dataLogin = M_karyawan::where('id', $user->id)->first();

        $total = M_karyawan::where(function ($query) use ($user) {
            $query->where('id_approval_1', $user->id)
                ->orWhere('id_approval_2', $user->id);
        })->count();
        if ($user) {
            $id_periode = $request->input('id_periode'); // Ambil id_periode yang dipilih dari form

            // Jika id_periode belum dipilih, ambil periode terbaru
            if (!$id_periode) {
                $periode_terbaru = m_periode::orderBy('created_at', 'desc')->first();

                if (!$periode_terbaru) {
                    return redirect()->back()->withErrors(['msg' => 'No periode available']);
                }

                $id_periode = $periode_terbaru->id;
            }

            // Ambil data karyawan berdasarkan periode yang dipilih
            $karyawans = M_karyawan::join('m_bidang', 'm_karyawan.id_bidang', '=', 'm_bidang.id')
            ->where('m_karyawan.id_atasan', $user->id)
                ->select('m_karyawan.*', 'm_karyawan.no_pegawai', 'm_bidang.nama_bidang')
                ->get();

            // Ambil data periode yang dipilih
            $periode_terpilih = m_periode::find($id_periode);

            // Jika periode tidak ditemukan, beri respons sesuai kebutuhan
            if (!$periode_terpilih) {
                return redirect()->back()->withErrors(['msg' => 'Periode not found']);
            }

            // Ambil semua periodes (jika diperlukan untuk tampilan opsi selanjutnya)
            $periodes = m_periode::orderBy('created_at', 'desc')->get();

            // Ambil rata-rata nilai bidang user yang login
            $rataNilaiBidang = DB::table('m_nilai as mn')
            ->join('m_karyawan as mk', 'mn.id_karyawan', '=', 'mk.id')
            ->join('m_bidang as mb', 'mb.id', '=', 'mk.id_bidang')
            ->select('mb.id', 'mb.nama_bidang', DB::raw('AVG(CAST(JSON_UNQUOTE(JSON_EXTRACT(mn.nilai_approval_2, CONCAT("$[", numbers.i, "]"))) AS UNSIGNED)) AS rata_nilai_bidang'))
            ->join(DB::raw("(SELECT 0 i UNION SELECT 1 UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7 UNION SELECT 8 UNION SELECT 9) numbers"), function ($join) {
                $join->whereRaw("JSON_EXTRACT(mn.nilai_approval_2, CONCAT('$[', numbers.i, ']')) IS NOT NULL");
            })
            ->where('mb.id', $user->id_bidang)
            ->groupBy('mb.id', 'mb.nama_bidang')
            ->first();


            // Assuming $user->id_departement contains the department ID from the user's selected field

            $departement_id = DB::table('m_bidang as mb')
            ->where('mb.id', $user->id_bidang)
            ->join('m_departement as d', 'd.id', '=', 'mb.id_departement')
            ->select('d.id')
            ->value('id');


            $rataAllBidang = DB::table('m_nilai as mn')
            ->join('m_karyawan as mk', 'mn.id_karyawan', '=', 'mk.id')
            ->join('m_bidang as mb', 'mb.id', '=', 'mk.id_bidang')
            ->join('m_departement as d', 'd.id', '=', 'mb.id_departement')
            ->join(DB::raw("(SELECT 0 i UNION SELECT 1 UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7 UNION SELECT 8 UNION SELECT 9) numbers"), function ($join) {
                $join->on(DB::raw("JSON_EXTRACT(mn.nilai_approval_2, CONCAT('$[', numbers.i, ']'))"), 'IS NOT', DB::raw('NULL'));
            })
            ->select('mb.id', 'mb.nama_bidang', DB::raw('AVG(CAST(JSON_UNQUOTE(JSON_EXTRACT(mn.nilai_approval_2, CONCAT("$[", numbers.i, "]"))) AS UNSIGNED)) AS rata_nilai_bidang'))
            ->where('d.id', $departement_id)
            ->groupBy('mb.id', 'mb.nama_bidang')
            ->get();

            $rataDapartemen = DB::table('m_nilai as mn')
            ->join('m_karyawan as mk', 'mn.id_karyawan', '=', 'mk.id')
            ->join('m_bidang as mb', 'mb.id', '=', 'mk.id_bidang')
            ->join('m_departement as d', 'd.id', '=', 'mb.id_departement')
            ->join(DB::raw("(SELECT 0 i UNION SELECT 1 UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7 UNION SELECT 8 UNION SELECT 9) numbers"), function ($join) {
                $join->on(DB::raw("JSON_EXTRACT(mn.nilai_approval_2, CONCAT('$[', numbers.i, ']'))"), 'IS NOT', DB::raw('NULL'));
            })
            ->select('d.id', 'd.nama_departement', DB::raw('AVG(CAST(JSON_UNQUOTE(JSON_EXTRACT(mn.nilai_approval_2, CONCAT("$[", numbers.i, "]"))) AS UNSIGNED)) AS rata_nilai_departement'))
            ->where('d.id', $departement_id)
            ->groupBy('d.id', 'd.nama_departement')
            ->first();

            // ! Manager

            $inkompetenKaryawanManager = DB::table('m_karyawan as mk')
            ->join('m_nilai as mn', 'mn.id_karyawan', '=', 'mk.id')
            ->join('m_bidang as mb', 'mb.id', '=', 'mk.id_bidang')
            ->join('m_departement as d', 'd.id', '=', 'mb.id_departement')
                ->join(DB::raw("(SELECT 0 i UNION SELECT 1 UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7 UNION SELECT 8 UNION SELECT 9) numbers"), function ($join) {
                    $join->on(DB::raw("JSON_EXTRACT(mn.nilai_approval_2, CONCAT('$[', numbers.i, ']'))"), 'IS NOT', DB::raw('NULL'));
                })
            ->where('d.id', $departement_id)
              ->select('mk.id', 'mk.no_pegawai', 'mk.nama', DB::raw("AVG(CAST(JSON_UNQUOTE(JSON_EXTRACT(mn.nilai_approval_2, CONCAT('$[', numbers.i, ']'))) AS UNSIGNED)) AS average"))
            ->groupBy('mk.id', 'mk.nama', 'mk.no_pegawai')
            ->having('average', '<', 3)
            ->orderBy('average', 'desc')
            ->get();

            $kompetenKaryawanManager = DB::table('m_karyawan as mk')
            ->join('m_nilai as mn', 'mn.id_karyawan', '=', 'mk.id')
            ->join('m_bidang as mb', 'mb.id', '=', 'mk.id_bidang')
            ->join('m_departement as d', 'd.id', '=', 'mb.id_departement')
                ->join(DB::raw("(SELECT 0 i UNION SELECT 1 UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7 UNION SELECT 8 UNION SELECT 9) numbers"), function ($join) {
                    $join->on(DB::raw("JSON_EXTRACT(mn.nilai_approval_2, CONCAT('$[', numbers.i, ']'))"), 'IS NOT', DB::raw('NULL'));
                })
            ->where('d.id', $departement_id)
              ->select('mk.id', 'mk.no_pegawai', 'mk.nama', DB::raw("AVG(CAST(JSON_UNQUOTE(JSON_EXTRACT(mn.nilai_approval_2, CONCAT('$[', numbers.i, ']'))) AS UNSIGNED)) AS average"))
            ->groupBy('mk.id', 'mk.nama', 'mk.no_pegawai')
            ->having('average', '>', 2)
            ->orderBy('average', 'desc')
            ->get();



            // ! Kepala Bagian
            // Ambil karyawan di bidang user yang login dengan average kurang dari 3
            $inkompetenKaryawan = DB::table('m_karyawan as mk')
            ->join('m_nilai as mn', 'mn.id_karyawan', '=', 'mk.id')
            ->join(DB::raw("(SELECT 0 i UNION SELECT 1 UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7 UNION SELECT 8 UNION SELECT 9) numbers"), function ($join) {
                $join->whereRaw("JSON_EXTRACT(mn.nilai_approval_2, CONCAT('$[', numbers.i, ']')) IS NOT NULL");
            })
            ->where('mk.id_bidang', $user->id_bidang)
            ->select('mk.id', 'mk.no_pegawai', 'mk.nama', DB::raw("AVG(CAST(JSON_UNQUOTE(JSON_EXTRACT(mn.nilai_approval_2, CONCAT('$[', numbers.i, ']'))) AS UNSIGNED)) AS average"))
            ->groupBy('mk.id', 'mk.nama', 'mk.no_pegawai')
            ->having('average', '<', 3)
            ->get();

            $kompetenKaryawan = DB::table('m_karyawan as mk')
            ->join('m_nilai as mn', 'mn.id_karyawan', '=', 'mk.id')
            ->join(DB::raw("(SELECT 0 i UNION SELECT 1 UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7 UNION SELECT 8 UNION SELECT 9) numbers"), function ($join) {
                $join->whereRaw("JSON_EXTRACT(mn.nilai_approval_2, CONCAT('$[', numbers.i, ']')) IS NOT NULL");
            })
            ->where('mk.id_bidang', $user->id_bidang)
            ->select('mk.id', 'mk.no_pegawai', 'mk.nama', DB::raw("AVG(CAST(JSON_UNQUOTE(JSON_EXTRACT(mn.nilai_approval_2, CONCAT('$[', numbers.i, ']'))) AS UNSIGNED)) AS average"))
            ->groupBy('mk.id', 'mk.nama', 'mk.no_pegawai')
            ->having('average', '>', 2)
            ->get();

            $totalInkompetenManager = count($inkompetenKaryawanManager);
            $totalKompetenManager = count($kompetenKaryawanManager);
            $totalInkompeten = count($inkompetenKaryawan);
            $totalKompeten = count($kompetenKaryawan);


            // Ambil data nilai berdasarkan periode yang dipilih
            $nilai_karyawan = [];
            foreach ($karyawans as $karyawan) {
                // Menggunakan raw query untuk menghitung rata-rata dari array JSON
                $average = DB::table('m_nilai')
                ->select(DB::raw("
                    AVG(CAST(JSON_UNQUOTE(JSON_EXTRACT(JSON_EXTRACT(indeks, CONCAT('$[', numbers.i, ']')), '$')) AS UNSIGNED)) AS rata_rata_indeks
                "))
                ->crossJoin(DB::raw("(SELECT 0 i UNION SELECT 1 UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7 UNION SELECT 8 UNION SELECT 9) numbers"))
                ->where('id_karyawan', $karyawan->id)
                    ->where('id_periode', $id_periode)
                    ->whereRaw("JSON_EXTRACT(indeks, CONCAT('$[', numbers.i, ']')) IS NOT NULL")
                    ->groupBy('id_karyawan', 'id_periode')
                    ->value('rata_rata_indeks');

                $nilai = M_nilai::where('id_karyawan', $karyawan->id)
                    ->where('id_periode', $id_periode)
                    ->select('indeks')
                    ->first();

                if ($nilai) {
                    if (is_string($nilai->indeks)) {
                        $indeks_array = json_decode($nilai->indeks, true);
                        $nilai_karyawan[$karyawan->id] = [
                            'indeks' => $indeks_array,
                            'average' => $average
                        ];
                    } else {
                        $nilai_karyawan[$karyawan->id] = [
                            'indeks' => $nilai->indeks,
                            'average' => $average
                        ];
                    }
                } else {
                    $nilai_karyawan[$karyawan->id] = [
                        'indeks' => null,
                        'average' => $average
                    ];
                }
            }

        $dataLogin = M_karyawan::where('id', $user->id)->first();
            return view('dashboard_penilai.index', compact('karyawans', 'periodes', 'periode_terpilih', 'nilai_karyawan', 'inkompetenKaryawan', 'kompetenKaryawan', 'rataNilaiBidang', 'total', 'totalInkompeten', 'totalKompeten','dataLogin', 'rataAllBidang', 'inkompetenKaryawanManager', 'kompetenKaryawanManager', 'totalInkompetenManager', 'totalKompetenManager', 'rataDapartemen'));
        } else {
            return redirect()->route('login')->withErrors(['msg' => 'User not authenticated']);
        }
    }

    public function indexNilai(Request $request)
    {
        $user = Auth::guard('user')->user(); // Ambil user yang sudah login
        if ($user) {
            $id_periode = $request->input('id_periode'); // Ambil id_periode yang dipilih dari form

            // Jika id_periode belum dipilih, ambil periode terbaru
            if (!$id_periode) {
                $periode_terbaru = m_periode::orderBy('created_at', 'desc')->first();

                if (!$periode_terbaru) {
                    return redirect()->back()->withErrors(['msg' => 'No periode available']);
                }

                $id_periode = $periode_terbaru->id;
            }

            // Ambil data karyawan berdasarkan periode yang dipilih
            $karyawans = M_karyawan::join('m_bidang', 'm_karyawan.id_bidang', '=', 'm_bidang.id')
            ->where('m_karyawan.id_atasan', $user->id)
                ->select('m_karyawan.*', 'm_karyawan.no_pegawai', 'm_bidang.nama_bidang')
                ->get();

            // Ambil data periode yang dipilih
            $periode_terpilih = m_periode::find($id_periode);

            // Jika periode tidak ditemukan, beri respons sesuai kebutuhan
            if (!$periode_terpilih) {
                return redirect()->back()->withErrors(['msg' => 'Periode not found']);
            }

            // Ambil semua periodes (jika diperlukan untuk tampilan opsi selanjutnya)
            $periodes = m_periode::orderBy('created_at', 'desc')->get();

            // Ambil data nilai berdasarkan periode yang dipilih
            $nilai_karyawan = [];
            foreach ($karyawans as $karyawan) {
                // Menggunakan raw query untuk menghitung rata-rata dari array JSON
                $average = DB::table('m_nilai')
                ->select(DB::raw("
                    AVG(CAST(JSON_UNQUOTE(JSON_EXTRACT(JSON_EXTRACT(indeks, CONCAT('$[', numbers.i, ']')), '$')) AS UNSIGNED)) AS rata_rata_indeks
                "))
                ->crossJoin(DB::raw("(SELECT 0 i UNION SELECT 1 UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7 UNION SELECT 8 UNION SELECT 9) numbers"))
                ->where('id_karyawan', $karyawan->id)
                    ->where('id_periode', $id_periode)
                    ->whereRaw("JSON_EXTRACT(indeks, CONCAT('$[', numbers.i, ']')) IS NOT NULL")
                    ->groupBy('id_karyawan', 'id_periode')
                    ->value('rata_rata_indeks');

                $nilai = M_nilai::where('id_karyawan', $karyawan->id)
                    ->where('id_periode', $id_periode)
                    ->select('indeks', 'status_approval_1')
                    ->first();

                if ($nilai) {
                    if (is_string($nilai->indeks)) {
                        $indeks_array = json_decode($nilai->indeks, true);
                        $nilai_karyawan[$karyawan->id] = [
                            'indeks' => $indeks_array,
                            'average' => $average,
                            'status_approval_1' => $nilai->status_approval_1
                        ];
                    } else {
                        $nilai_karyawan[$karyawan->id] = [
                            'indeks' => $nilai->indeks,
                            'average' => $average,
                            'status_approval_1' => $nilai->status_approval_1
                        ];
                    }
                } else {
                    $nilai_karyawan[$karyawan->id] = [
                        'indeks' => null,
                        'average' => $average,
                        'status_approval_1' => null
                    ];
                }
            }

            return view('dashboard_penilai.penilai', compact('karyawans', 'periodes', 'periode_terpilih', 'nilai_karyawan'));
        } else {
            return redirect()->route('login')->withErrors(['msg' => 'User not authenticated']);
        }
    }


    public function indexPeriksa(Request $request)
    {
        $user = Auth::guard('user')->user(); // Ambil user yang sudah login
        if ($user) {
             $id_periode = $request->input('id_periode'); // Ambil id_periode yang dipilih dari form

            // Jika id_periode belum dipilih, ambil periode terbaru
            if (!$id_periode) {
                $periode_terbaru = m_periode::orderBy('created_at', 'desc')->first();

                if (!$periode_terbaru) {
                    return redirect()->back()->withErrors(['msg' => 'No periode available']);
                }

                $id_periode = $periode_terbaru->id;
            }

            // Ambil data karyawan berdasarkan periode yang dipilih
            $karyawans = M_karyawan::join('m_bidang', 'm_karyawan.id_bidang', '=', 'm_bidang.id')
            ->where(function ($query) use ($user) {
                $query->where('m_karyawan.id_approval_1', $user->id)
                    ->orWhere('m_karyawan.id_approval_2', $user->id);
            })
                ->select('m_karyawan.*', 'm_karyawan.no_pegawai', 'm_bidang.nama_bidang')
                ->get();

            // Ambil data periode yang dipilih
            $periode_terpilih = m_periode::find($id_periode);

            // Jika periode tidak ditemukan, beri respons sesuai kebutuhan
            if (!$periode_terpilih) {
                return redirect()->back()->withErrors(['msg' => 'Periode not found']);
            }

            // Ambil semua periodes (jika diperlukan untuk tampilan opsi selanjutnya)
            $periodes = m_periode::orderBy('created_at', 'desc')->get();

            // Ambil data nilai berdasarkan periode yang dipilih
            $nilai_karyawan = [];
            foreach ($karyawans as $karyawan) {
                // Menggunakan raw query untuk menghitung rata-rata dari array JSON
                $average = DB::table('m_nilai')
                ->select(DB::raw("
                    AVG(CAST(JSON_UNQUOTE(JSON_EXTRACT(JSON_EXTRACT(indeks, CONCAT('$[', numbers.i, ']')), '$')) AS UNSIGNED)) AS rata_rata_indeks
                "))
                ->crossJoin(DB::raw("(SELECT 0 i UNION SELECT 1 UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7 UNION SELECT 8 UNION SELECT 9) numbers"))
                ->where('id_karyawan', $karyawan->id)
                    ->where('id_periode', $id_periode)
                    ->whereRaw("JSON_EXTRACT(indeks, CONCAT('$[', numbers.i, ']')) IS NOT NULL")
                    ->groupBy('id_karyawan', 'id_periode')
                    ->value('rata_rata_indeks');

                // nilai approval 1
                $nilai_approval_1 = DB::table('m_nilai')
                ->select(DB::raw("
                    AVG(CAST(JSON_UNQUOTE(JSON_EXTRACT(JSON_EXTRACT(nilai_approval_1, CONCAT('$[', numbers.i, ']')), '$')) AS UNSIGNED)) AS rata_rata_nilai_approval_1
                "))
                ->crossJoin(DB::raw("(SELECT 0 i UNION SELECT 1 UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7 UNION SELECT 8 UNION SELECT 9) numbers"))
                ->where('id_karyawan', $karyawan->id)
                    ->where('id_periode', $id_periode)
                    ->whereRaw("JSON_EXTRACT(indeks, CONCAT('$[', numbers.i, ']')) IS NOT NULL")
                    ->groupBy('id_karyawan', 'id_periode')
                    ->value('rata_rata_nilai_approval_1');


                // nilai approval 2
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

                // Ambil data status approval
                $nilai = DB::table('m_nilai')
                ->select('indeks', 'status_approval_1', 'status_approval_2')
                ->where('id_karyawan', $karyawan->id)
                    ->where('id_periode', $id_periode)
                    ->first();

                if ($nilai) {
                    $nilai_karyawan[$karyawan->id] = [
                        'average' => $average,
                        'nilai_approval_1' => $nilai_approval_1,
                        'nilai_approval_2' => $nilai_approval_2,
                        'status_approval_1' => $nilai->status_approval_1,
                        'status_approval_2' => $nilai->status_approval_2,
                        'id_approval_1' => $karyawan->id_approval_1,
                        'id_approval_2' => $karyawan->id_approval_2,
                    ];
                } else {
                    $nilai_karyawan[$karyawan->id] = [
                        'average' => $average,
                        'nilai_approval_1' => $nilai_approval_1,
                        'nilai_approval_2' => $nilai_approval_2,
                        'status_approval_1' => null,
                        'status_approval_2' => null,
                        'id_approval_1' => $karyawan->id_approval_1,
                        'id_approval_2' => $karyawan->id_approval_2,
                    ];
                }
            }

            return view('dashboard_penilai.pengecek', compact('karyawans', 'periodes', 'periode_terpilih', 'nilai_karyawan', 'user'));
        } else {
            return redirect()->route('login')->withErrors(['msg' => 'User not authenticated']);
        }
    }


    public function exportKaryawan(Request $request)
    {
        $exporter = new KaryawanExport();
        return $exporter->export($request);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        // Ambil data karyawan berdasarkan id_karyawan
        $karyawan = M_karyawan::where('id', $id)->first();

        // Ambil semua data kompetensi
        $kompetensis = M_kompetensi::all();

        $periodes = M_periode::orderBy('created_at', 'desc')->get();


        return view('dashboard_penilai.create', compact('karyawan', 'kompetensis', 'periodes'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        request()->validate([
            'indeks.*' => 'required|numeric',
            'nilai_approval_1.*' => 'required|numeric',
            'nilai_approval_2.*' => 'required|numeric',
            'id_periode' => 'required|integer|exists:m_periode,id',
        ]);


        M_nilai::insert([
            'id_karyawan' => $id,
            'id_periode' => $request->id_periode,
            'indeks' => json_encode($request->indeks),
            'nilai_approval_1' => json_encode($request->indeks),
            'nilai_approval_2' => json_encode($request->indeks),
        ]);



        return redirect()->route('dashboard_penilai.penilai')->with('success', 'Data berhasil disimpan.');


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Ambil data karyawan berdasarkan id_karyawan
        $karyawan = M_nilai::where('id_karyawan', $id)->first();

        $namaKaryawan = M_karyawan::where('id', $id)->first();

        // Ambil semua data kompetensi
        $kompetensis = M_kompetensi::all();

        // Ambil semua data kompetensi
        $periodes = M_periode::orderBy('created_at', 'desc')->get();


        return view('dashboard_penilai.edit', compact('karyawan', 'kompetensis','periodes', 'namaKaryawan'));
    }
    public function editPeriksaNilai1($id)
    {
        // Ambil data karyawan berdasarkan id_karyawan
        $karyawan = M_nilai::where('id_karyawan', $id)->first();

        $namaKaryawan = M_karyawan::where('id', $id)->first();

        // Ambil semua data kompetensi
        $kompetensis = M_kompetensi::all();

        // Ambil semua data kompetensi
        $periodes = M_periode::orderBy('created_at', 'desc')->get();


        return view('dashboard_penilai.editPeriksa', compact('karyawan', 'kompetensis','periodes', 'namaKaryawan'));
    }
    public function editPeriksaNilai2($id)
    {
        // Ambil data karyawan berdasarkan id_karyawan
        $karyawan = M_nilai::where('id_karyawan', $id)->first();

        $namaKaryawan = M_karyawan::where('id', $id)->first();

        // Ambil semua data kompetensi
        $kompetensis = M_kompetensi::all();

        // Ambil semua data kompetensi
        $periodes = M_periode::orderBy('created_at', 'desc')->get();


        return view('dashboard_penilai.editPeriksa2', compact('karyawan', 'kompetensis','periodes', 'namaKaryawan'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        request()->validate([
            'indeks.*' => 'required|numeric',
            'id_periode' => 'required|integer|exists:m_periode,id',
        ]);


        M_nilai::where('id_karyawan', $id)->update([
            'id_karyawan' => $id,
            'id_periode' => $request->id_periode,
            'indeks' => json_encode($request->indeks),
        ]);

        return redirect()->route('dashboard_penilai.penilai')->with('success', 'Data berhasil disimpan.');
    }

    public function updatePeriksaNilai1(Request $request, $id)
    {
        request()->validate([
            'nilai_approval_1.*' => 'required|numeric',
            'nilai_approval_2.*' => 'required|numeric',
            'id_periode' => 'required|integer|exists:m_periode,id',
        ]);


        M_nilai::where('id_karyawan', $id)->update([
            'id_karyawan' => $id,
            'id_periode' => $request->id_periode,
            'nilai_approval_1' => json_encode($request->nilai_approval_1),
            'nilai_approval_2' => json_encode($request->nilai_approval_1),
            'status_approval_1' => 'Approved',
        ]);



        return redirect()->route('dashboard_penilai.periksa')->with('success', 'Data berhasil disimpansi.');
    }
    public function updatePeriksaNilai2(Request $request, $id)
    {
        request()->validate([

            'nilai_approval_2.*' => 'required|numeric',
            'id_periode' => 'required|integer|exists:m_periode,id',
        ]);


        M_nilai::where('id_karyawan', $id)->update([
            'id_karyawan' => $id,
            'id_periode' => $request->id_periode,
            'nilai_approval_2' => json_encode($request->nilai_approval_2),
            'status_approval_2' => 'Approved',
        ]);



        return redirect()->route('dashboard_penilai.periksa')->with('success', 'Data berhasil disimpansi.');
    }

    public function accnilai1 ($id)
    {
        M_nilai::where('id_karyawan', $id)->update([
            'status_approval_1' => 'Approved',
        ]);

        return redirect()->route('dashboard_penilai.periksa')->with('success', 'Data berhasil diApproved.');
    }
    public function accnilai2 ($id)
    {
        M_nilai::where('id_karyawan', $id)->update([
            'status_approval_2' => 'Approved',
        ]);

        return redirect()->route('dashboard_penilai.periksa')->with('success', 'Data berhasil diApproved.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        M_nilai::where('id_karyawan', $id)->delete();
        return redirect()->route('dashboard_penilai.penilai')->with('success', 'Data berhasil dihapus.');
    }
}
