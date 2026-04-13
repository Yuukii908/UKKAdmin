<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
   public function handle(Request $request, Closure $next, string ...$roles): Response
{
    if (!Auth::check()) {
        return redirect('/login');
    }

    $userRole = Auth::user()->role;
    
    // Admin dapat mengakses semua route
    if ($userRole === 'admin') {
        return $next($request);
    }

    // Cek apakah role user sesuai dengan yang diizinkan
    if (!in_array($userRole, $roles)) {
        // Redirect ke dashboard sesuai role user
        if ($userRole === 'petugas') {
            return redirect('/petugas/dashboard');
        } elseif ($userRole === 'peminjam') {
            return redirect('/peminjam/dashboard');
        }
        return redirect('/login');
    }

    return $next($request);
}
}
