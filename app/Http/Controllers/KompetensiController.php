<?php

namespace App\Http\Controllers;


use App\Models\M_kompetensi;
use Illuminate\Http\Request;

class KompetensiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Mengambil semua data dari tabel Kompetensi
        $kompetensi = M_kompetensi::paginate(10);

        return view('kompetensi.index', ['kompetensi' => $kompetensi]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('kompetensi.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_kompetensi' => 'required',

        ]);

        $nama_kompetensi = $request->input('nama_kompetensi');
        $deskripsi = $request->input('deskripsi');

        M_kompetensi::addKompetensi([
            'nama_kompetensi' => $nama_kompetensi,
            'deskripsi' => $deskripsi,
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        return redirect()->route('kompetensi.index')->with('success', 'Kompetensi berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

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
        $kompetensi = M_kompetensi::editKompetensi($id);
        $view_data = [
            'kompetensi' => $kompetensi,
        ];

        return view('kompetensi.edit', $view_data);
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

        $request->validate([
            'nama_kompetensi' => 'required',
        ]);

        $nama_kompetensi = $request->input('nama_kompetensi');
        $deskripsi = $request->input('deskripsi');

        $updateData = [
            'nama_kompetensi' => $nama_kompetensi,
            'deskripsi' => $deskripsi,
            'updated_at' => date('Y-m-d H:i:s'),
        ];

       M_kompetensi::updateKompetensi($updateData, $id);
       return redirect()->route('kompetensi.index')->with('success', 'Kompetensi berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        M_kompetensi::deleteKompetensi($id);
        return redirect()->route('kompetensi.index')->with('success', 'Kompetensi berhaisl dihapus');
    }
}
