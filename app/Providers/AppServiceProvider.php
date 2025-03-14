<?php

namespace App\Providers;


use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('component/sidebar2', function ($view) {
            $user = Auth::guard('user')->user(); // Ambil user yang sudah login
            $notifCount = DB::table('m_nilai as mn')
            ->join('m_karyawan as mk', 'mn.id_karyawan', '=', 'mk.id')
                ->join('m_bidang as mb', 'mb.id', '=', 'mk.id_bidang')
                ->join('m_departement as d', 'd.id', '=', 'mb.id_departement')
                ->where('mn.status_approval_1', 'Pending')
                ->orWhere('mn.status_approval_2', 'Pending')
                ->where('mk.id', $user->id)
                ->count();

            $view->with('notifCount', $notifCount);
        });
    }
}
