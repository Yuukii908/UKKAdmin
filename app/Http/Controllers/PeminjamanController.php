<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Alat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PeminjamanController extends Controller
{
    /**
     * Display a listing of the resource (for admin/petugas).
     */
    public function index()
    {
        $peminjamans = Peminjaman::with(['user', 'alat'])->orderBy('created_at', 'desc')->get();
        return view('admin.peminjaman.index', compact('peminjamans'));
    }

    /**
     * Show the form for creating a new resource (for peminjam).
     */
    public function create()
    {
        $alats = Alat::where('stok', '>', 0)->get();
        return view('peminjam.peminjaman.create', compact('alats'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'alat_id' => 'required|exists:alats,id',
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali' => 'required|date|after:tanggal_pinjam'
        ]);

        // Cek stok
        $alat = Alat::find($request->alat_id);
        if ($alat->stok < 1) {
            return back()->with('error', 'Stok alat tidak tersedia');
        }

        Peminjaman::create([
            'user_id' => Auth::id(),
            'alat_id' => $request->alat_id,
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'tanggal_kembali' => $request->tanggal_kembali,
            'status' => 'menunggu'
        ]);

        return redirect()->route('peminjam.peminjaman.index')
            ->with('success', 'Permintaan peminjaman berhasil diajukan');
    }

    /**
     * Display peminjaman for current user (peminjam).
     */
    public function myPeminjaman()
    {
        $peminjamans = Peminjaman::with(['alat'])
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();
        return view('peminjam.peminjaman.index', compact('peminjamans'));
    }

    /**
     * Approve peminjaman (admin/petugas).
     */
    public function setuju(Peminjaman $peminjaman)
    {
        // Kurangi stok alat
        $alat = $peminjaman->alat;
        if ($alat->stok > 0) {
            $alat->decrement('stok');
            $peminjaman->update(['status' => 'disetujui']);
            return back()->with('success', 'Peminjaman disetujui');
        }
        return back()->with('error', 'Stok alat tidak tersedia');
    }

    /**
     * Reject peminjaman (admin/petugas).
     */
    public function tolak(Peminjaman $peminjaman)
    {
        $peminjaman->update(['status' => 'ditolak']);
        return back()->with('success', 'Peminjaman ditolak');
    }

    /**
     * Return peminjaman (admin/petugas).
     */
    public function kembalikan(Peminjaman $peminjaman)
    {
        // Tambah kembali stok alat
        $peminjaman->alat->increment('stok');
        $peminjaman->update(['status' => 'dikembalikan']);
        return back()->with('success', 'Alat telah dikembalikan');
    }
}

