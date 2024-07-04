<?php

namespace App\Http\Controllers;

use App\Models\M_bidang;
use App\Models\M_departement;
use App\Models\M_jabatan;
use App\Models\M_karyawan;
use App\Models\M_users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KaryawanController extends Controller
{
    // Menampilkan daftar karyawan
    public function index()
    {
        $karyawans = M_karyawan::all();
        $karyawans = M_karyawan::all();
        return view('karyawan.index', compact('karyawans'));
    }

    // Menampilkan form untuk menambah karyawan baru
    public function create()
    {
        $departements = M_departement::all();
        $bidangs = M_bidang::all();
        $users = M_users::all();
        $jabatans = M_jabatan::all();
        return view('karyawan.create', compact('bidangs', 'users', 'departements', 'jabatans'));
    }

    // Menyimpan karyawan baru
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'no_pegawai' => 'required',
            'id_bidang' => 'required|numeric',
            'id_atasan' => 'required|numeric',
            'id_jabatan' => 'required|numeric',
            'id_approval_1' => 'required|numeric',
            'id_approval_2' => 'required|numeric',
        ]);

        DB::table('m_karyawan')->insert([
            'nama' => $request->nama,
            'no_pegawai' => $request->no_pegawai,
            'id_bidang' => $request->id_bidang,
            'id_atasan' => $request->id_atasan,
            'id_jabatan' => $request->id_jabatan,
            'id_approval_1' => $request->id_approval_1,
            'id_approval_2' => $request->id_approval_2,
        ]);

        return redirect()->route('karyawan.index')
            ->with('success', 'Karyawan berhasil ditambahkan.');
    }

    // Menampilkan detail karyawan
    public function show(M_karyawan $karyawan)
    {
        return view('karyawan.show', compact('karyawan'));
    }

    // Menampilkan form untuk mengedit karyawan
    public function edit($id)
    {
        $karyawan = M_karyawan::find($id);
        $departements = M_departement::all();
        $bidangs = M_bidang::all();
        $users = M_users::all();
        $jabatans = M_jabatan::all();
        return view('karyawan.edit', compact('bidangs', 'users', 'departements', 'jabatans', 'karyawan'));
    }

    // Mengupdate karyawan
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'no_pegawai' => 'required',
            'id_bidang' => 'required|numeric',
            'id_atasan' => 'required|numeric',
            'id_jabatan' => 'required|numeric',
            'id_approval_1' => 'required|numeric',
            'id_approval_2' => 'required|numeric',
        ]);

        DB::table('m_karyawan')->where('id', $id)->update([
            'nama' => $request->nama,
            'no_pegawai' => $request->no_pegawai,
            'id_bidang' => $request->id_bidang,
            'id_atasan' => $request->id_atasan,
            'id_jabatan' => $request->id_jabatan,
            'id_approval_1' => $request->id_approval_1,
            'id_approval_2' => $request->id_approval_2,
        ]);
        return redirect()->route('karyawan.index')
            ->with('success', 'Karyawan berhasil diupdate.');
        // $request->validate([
        //     'nama' => 'required',
        //     'jabatan' => 'required',
        //     'gaji' => 'required|numeric',
        // ]);

        // $karyawan->update($request->all());

        // return redirect()->route('karyawan.index')
        //     ->with('success', 'Karyawan berhasil diupdate.');
    }

    // Menghapus karyawan
    public function destroy($id)
    {
        DB::table('m_karyawan')->where('id', $id)->delete();

        return redirect()->route('karyawan.index')
            ->with('success', 'Karyawan berhasil dihapus.');
    }
}

