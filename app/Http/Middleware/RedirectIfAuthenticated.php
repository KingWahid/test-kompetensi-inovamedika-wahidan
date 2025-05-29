<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    public function handle(Request $request, Closure $next, ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                $user = Auth::user();

                switch ($user->role) {
                    case 'admin':
                        return redirect()->route('admin.dashboard');
                    case 'dokter':
                        return redirect()->route('dokter.dashboard');
                    case 'petugas':
                        return redirect()->route('petugas.dashboard');
                    case 'kasir':
                        return redirect()->route('kasir.dashboard');
                    default:
                        return redirect('/home');
                }
            }
        }

        return $next($request);
    }
}


