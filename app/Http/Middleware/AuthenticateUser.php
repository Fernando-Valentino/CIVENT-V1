<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AuthenticateUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Cek apakah pengguna sudah terautentikasi
        if (!Auth::check()) {
            // Jika tidak terautentikasi, alihkan ke halaman login
            return redirect()->route('login')->with('error', 'You need to login first.');
        }

        return $next($request);
    }
}
