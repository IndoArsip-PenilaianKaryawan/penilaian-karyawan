<?php

namespace App\Http\Controllers;


use App\Models\M_karyawan;
use App\Models\M_kompetensi;
use App\Models\M_nilai;
use App\Models\m_periode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PenilaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::guard('user')->user();

        $total = M_karyawan::where('id_atasan', $user->id)->count();

        return view('dashboard_penilai.index', compact('total'));
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

            return view('dashboard_penilai.penilai', compact('karyawans', 'periodes', 'periode_terpilih', 'nilai_karyawan'));
        } else {
            return redirect()->route('login')->withErrors(['msg' => 'User not authenticated']);
        }
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


        return view('dashboard_penilai.create', compact('karyawan', 'kompetensis'));
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
            'id_periode' => 'required|integer|exists:m_periode,id',
        ]);


        M_nilai::insert([
            'id_karyawan' => $id,
            'id_periode' => $request->id_periode,
            'indeks' => json_encode($request->indeks),
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
        // Validasi input
        $request->validate([
            'indeks.*' => 'required|numeric',
            'id_periode' => 'required|integer|exists:m_periode,id',
        ]);

        // Gabungkan semua indeks ke dalam satu array dan konversikan menjadi integer
        $indeksArray = array_map('intval', $request->indeks); // Konversi ke array integer

        // Update atau buat data baru dengan menyimpan array indeks
        M_nilai::updateOrCreate(
            [
                'id_periode' => $request->id_periode,
            ],
            [
                'indeks' => $indeksArray,
            ]
        );

        return redirect()->route('dashboard_penilai.penilai')->with('success', 'Data berhasil disimpan.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
