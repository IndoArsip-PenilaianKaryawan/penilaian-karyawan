<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class ShareNotifCount
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
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

        return $next($request);
    }
}
