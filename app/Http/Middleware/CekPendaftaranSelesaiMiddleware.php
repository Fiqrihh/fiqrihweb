<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CekPendaftaranSelesaiMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (session('pendaftaran_selesai')) {
            // Pendaftaran telah selesai, arahkan ke beranda atau halaman lain
            return redirect('/');
        }
        return $next($request);
    }
}
