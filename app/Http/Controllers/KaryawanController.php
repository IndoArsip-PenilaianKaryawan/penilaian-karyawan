<?php

namespace App\Http\Controllers;

use App\Models\M_bidang;
use App\Models\M_cabang;
use App\Models\M_departement;
use App\Models\M_jabatan;
use App\Models\M_karyawan;
use App\Models\M_nilai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class KaryawanController extends Controller
{
    // Menampilkan daftar karyawan
    public function index(Request $request)
    {
        $search = $request->input('search');

        $karyawansQuery = M_karyawan::query();

        if ($search) {
            $karyawansQuery->where('nama', 'like', '%' . $search . '%')
                ->orWhere('no_pegawai', 'like', '%' . $search . '%');
        }

        $karyawans = $karyawansQuery->paginate(10);

        return view('karyawan.index', compact('karyawans'));
    }

    // Menampilkan form untuk menambah karyawan baru
    public function create()
    {
        $departements = M_departement::all();
        $cabangs = M_cabang::all();
        $bidangs = M_bidang::all();
        $karyawans = M_karyawan::all();
        $jabatans = M_jabatan::all();
        return view('karyawan.create', compact('bidangs', 'karyawans', 'departements', 'jabatans', 'cabangs'));
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
            'id_cabang' => 'required|numeric',
        ]);

        if ($request->is_penilai == 'on') {
            $is_penilai = true;
        } else {
            $is_penilai = false;
        }

        if (!$is_penilai){
            $password = NULL;
        }else{
            $password = Hash::make($request->no_pegawai);
        }

        DB::table('m_karyawan')->insert([
            'nama' => $request->nama,
            'no_pegawai' => $request->no_pegawai,
            'id_bidang' => $request->id_bidang,
            'id_atasan' => $request->id_atasan,
            'id_jabatan' => $request->id_jabatan,
            'id_approval_1' => $request->id_approval_1,
            'id_approval_2' => $request->id_approval_2,
            'is_penilai' => $is_penilai,
            'id_cabang' => $request->id_cabang,
            'password' => $password,
        ]);

        return redirect()->route('karyawan.index')
            ->with('success', 'Karyawan berhasil ditambahkan');
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
        $karyawans = M_karyawan::all();
        $bidangs = M_bidang::all();
        $jabatans = M_jabatan::all();
        $cabangs = M_cabang::all();
        return view('karyawan.edit', compact('bidangs', 'departements', 'karyawans', 'jabatans', 'karyawan', 'cabangs'));
    }

    // Mengupdate karyawan
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'no_pegawai' => 'required',
            'id_cabang' => 'required|numeric',
            'id_bidang' => 'required|numeric',
            'id_atasan' => 'required|numeric',
            'id_jabatan' => 'required|numeric',
            'id_approval_1' => 'required|numeric',
            'id_approval_2' => 'required|numeric',
        ]);

        if ($request->is_penilai == 'on') {
            $is_penilai = true;
        } else {
            $is_penilai = false;
        }

        if (!$is_penilai){
            $password = NULL;
        }else{
            $password = Hash::make($request->no_pegawai);
        }

        DB::table('m_karyawan')->where('id', $id)->update([
            'nama' => $request->nama,
            'no_pegawai' => $request->no_pegawai,
            'id_cabang' => $request->id_cabang,
            'id_bidang' => $request->id_bidang,
            'id_atasan' => $request->id_atasan,
            'id_jabatan' => $request->id_jabatan,
            'id_approval_1' => $request->id_approval_1,
            'id_approval_2' => $request->id_approval_2,
            'is_penilai' => $is_penilai,
            'password' => $password,
        ]);
        return redirect()->route('karyawan.index')
            ->with('success', 'Karyawan berhasil diupdate');
    }

    // Menghapus karyawan
    public function destroy($id)
    {
        $karyawan = M_karyawan::find($id);

        // Hapus referensi approval1 dan approval2
        M_karyawan::where('id_approval_1', $id)->update(['id_approval_1' => null]);
        M_karyawan::where('id_approval_2', $id)->update(['id_approval_2' => null]);

        // Hapus referensi bawahans (karyawan yang memiliki karyawan ini sebagai atasan)
        M_karyawan::where('id_atasan', $id)->update(['id_atasan' => null]);;
        M_nilai::where('id_karyawan', $id)->delete();

        // Hapus baris utama
        $karyawan->delete();
        return redirect()->route('karyawan.index')
        ->with('success', 'Karyawan berhasil dihapus');
    }




}
