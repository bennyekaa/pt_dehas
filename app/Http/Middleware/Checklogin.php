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
            if(empty(session('device'))){
                return redirect('/login')->with('error', 'Device Anda tidak terdaftar!!');
            }else{
                return $next($request);
            }
            // dd(session()->all());
            // dd(substr(shell_exec('getmac'), 159,20));
        } else {
            return redirect('/login');
        }
    }
}
