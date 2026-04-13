<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Alat;
use App\Models\Peminjaman;


class DashboardController extends Controller
{
     public function admin()
    {
        return view('dashboard.admin.admin', [
            'totalUser' => User::count(),
            'totalAlat' => Alat::count(),
            'totalPeminjaman' => Peminjaman::count(),
            'menunggu' => Peminjaman::where('status', 'menunggu')->count(),
            'disetujui' => Peminjaman::where('status', 'disetujui')->count(),
            'ditolak' => Peminjaman::where('status', 'ditolak')->count(),
            'recentPeminjaman' => Peminjaman::with(['user', 'alat'])
                ->orderBy('created_at', 'desc')
                ->take(10)
                ->get(),
        ]);
    }

    public function petugas()
    {
        return view('dashboard.petugas.petugas', [
            'menunggu' => Peminjaman::where('status', 'menunggu')->count(),
            'disetujui' => Peminjaman::where('status', 'disetujui')->count(),
        ]);
    }
}
