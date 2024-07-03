<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use App\Models\Kompetensi;
use App\Models\Users;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $userCount = Users::count();
        $karyawanCount = Karyawan::count();
        $kompetensiCount = Kompetensi::count();

        return view('dashboard_adm.index', [
            'userCount' => $userCount,
            'karyawanCount' => $karyawanCount,
            'kompetensiCount' => $kompetensiCount,
        ]);
    }
}
