<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        // return $request->expectsJson() ? null : route('LoginUser');
        if (!$request->expectsJson()) {
            if (Auth::guard('pengajar')->check()) {
                return route('pengajar.dashboard'); // Ganti dengan route untuk dashboard pengajar
            } elseif (Auth::guard('santri')->check()) {
                return route('santri.dashboard'); // Ganti dengan route untuk dashboard santri
            } else {
                return route('LoginUser'); // Jika bukan pengajar atau santri, arahkan ke halaman login umum
            }
        }
    }
}
