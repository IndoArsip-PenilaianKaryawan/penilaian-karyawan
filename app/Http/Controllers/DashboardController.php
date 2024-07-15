<?php

namespace App\Http\Controllers;


use App\Models\M_karyawan;
use App\Models\M_kompetensi;

class DashboardController extends Controller
{
    public function index()
    {
        $userCount = M_karyawan::where('is_penilai', 1)->count();
        $karyawanCount = M_karyawan::count();
        $kompetensiCount = M_kompetensi::count();

        return view('dashboard_adm.index', [
            'userCount' => $userCount,
            'karyawanCount' => $karyawanCount,
            'kompetensiCount' => $kompetensiCount,
        ]);
    }
}
