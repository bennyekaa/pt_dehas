<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LogMid
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $role = session('nama_role');

        if ($role == 'DEVELOPER') {
            return $next($request);
        } else {
            return redirect()->back()->with('Anda Tidak Memiliki Akses Lur!!');
        }
    }
}
