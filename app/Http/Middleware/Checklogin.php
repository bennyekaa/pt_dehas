<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Session;
use App\Models\Log;

class Checklogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // dd(session()->all());
        if (Session::get('login') == 1) {
            // dd(session()->all());
            if(empty(session('device'))){
                return redirect('/login')->with('error', 'Device Anda tidak terdaftar!!');
            }else{
                // $hitungnotif = RiwayatPenghargaan::select(DB::raw('count(id_riwayat_penghargaan) as hitungpenghargaan'))->where('status_ajuan', '=', 1)->count();
                return $next($request);
            }
            // dd(substr(shell_exec('getmac'), 159,20));
        } else {
            return redirect('/login');
        }
    }
}
