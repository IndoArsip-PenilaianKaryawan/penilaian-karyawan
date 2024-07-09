<?php

namespace App\Http\Controllers;


use App\Models\M_karyawan;
use App\Models\M_kompetensi;
use App\Models\M_nilai;
use App\Models\m_periode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PenilaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        return view('dashboard_penilai.index');
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
            $karyawans = M_nilai::join('m_karyawan', 'm_nilai.id_karyawan', '=', 'm_karyawan.id')
            ->join('m_bidang', 'm_karyawan.id_bidang', '=', 'm_bidang.id')
            ->where('m_karyawan.id_atasan', $user->id)
                ->where('m_nilai.id_periode', $id_periode) // Filter berdasarkan periode yang dipilih
                ->select('m_nilai.*', 'm_karyawan.nama', 'm_karyawan.no_pegawai', 'm_bidang.nama_bidang')
                ->get();

            // Ambil data periode yang dipilih
            $periode_terpilih = m_periode::find($id_periode);

            // Jika periode tidak ditemukan, beri respons sesuai kebutuhan
            if (!$periode_terpilih) {
                return redirect()->back()->withErrors(['msg' => 'Periode not found']);
            }

            // Ambil semua periodes (jika diperlukan untuk tampilan opsi selanjutnya)
            $periodes = m_periode::orderBy('created_at', 'desc')->get();

            return view('dashboard_penilai.penilai', compact('karyawans', 'periodes', 'periode_terpilih'));
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
        //ambil id user
        $karyawan = M_nilai::where('id_karyawan', $id)->first();


        // kirim data nama kompetensi ke view
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
        // Validasi input
        $request->validate([
            'indeks.*' => 'required|numeric',
            'id_periode' => 'required|integer|exists:m_periode,id',
        ]);

        // Loop melalui indeks dan simpan atau update nilai
        foreach ($request->indeks as $key => $indeks) {
            M_nilai::updateOrCreate(
                [
                    'id_periode' => $request->id_periode,

                ],
                [
                    'indeks' => $indeks,
                ]
            );
        }

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
        //
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
        //
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
