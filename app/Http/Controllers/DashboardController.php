<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $role = $user->roles->first()?->name;

        switch ($role) {
            case 'admin':
                return view('admin.dashboard');
            case 'petugas':
                return view('petugas.dashboard');
            case 'dokter':
                return view('dokter.dashboard');
            case 'kasir':
                return view('kasir.dashboard');
            default:
                return view('dashboard');
        }

        return view('dashboard');
    }
}
