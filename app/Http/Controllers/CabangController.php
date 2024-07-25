<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\M_cabang;
use App\Models\M_karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CabangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $cabang = M_cabang::paginate(10);

        return view('cabang.index', ['cabang' => $cabang]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        return view('cabang.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'nama' => 'required',

        ]);

        $nama = $request->input('nama');

        M_cabang::addCabang([
            'nama' => $nama,
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        return redirect()->route('cabang.index')->with('success', 'Cabang berhasil ditambahkan');
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
        $cabang = M_cabang::editCabang($id);
        $view_data = [
            'cabang' => $cabang
        ];

        return view('cabang.edit', $view_data);
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
            'nama' => 'required',

        ]);

        $nama = $request->input('nama');
        $updateData = [
            'nama' => $nama,
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        M_cabang::updateCabang($updateData, $id);
        return redirect()->route('cabang.index')->with('success', 'Cabang berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Hapus referensi dari karyawan yang memiliki id_cabang yang akan dihapus
        M_karyawan::where('id_cabang', $id)->update(['id_cabang' => null]);

        // Hapus baris utama dari tabel m_cabang
        M_cabang::where('id', $id)->delete();

        DB::commit();

        return redirect()->route('cabang.index')->with('success', 'Cabang berhasil dihapus');
    }
}
