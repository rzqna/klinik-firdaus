<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class UserAkses
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        // Pastikan user sudah login
        if (!Auth::check()) {
            // Jika user tidak terautentikasi, arahkan ke halaman login
            return redirect()->route('login');
        }

        $userRole = Auth::user()->role;

        // Jika peran user yang sedang login cocok dengan peran yang diizinkan oleh middleware
        if ($userRole == $role) {
            return $next($request); // Izinkan akses ke rute yang diminta
        }

        // Jika peran user TIDAK cocok, lakukan pengalihan berdasarkan peran user yang sedang login
        if ($userRole == 'admin') {
            // Jika admin mencoba mengakses rute yang hanya untuk user, arahkan ke dashboard admin
            return redirect()->route('dashboard.admin');
        } elseif ($userRole == 'user') {
            // Jika user mencoba mengakses rute yang hanya untuk admin, arahkan ke dashboard user
            return redirect()->route('dashboard.user'); // Asumsi Anda punya rute 'dashboard.user'
        }

        // Fallback: Jika role tidak dikenali atau ada situasi tak terduga,
        // arahkan ke rute default atau halaman unauthorized.
        // Anda bisa membuat halaman error khusus atau mengarahkannya ke halaman login
        return redirect()->route('login'); // Atau redirect('/home') atau route('unauthorized')
    }
}
