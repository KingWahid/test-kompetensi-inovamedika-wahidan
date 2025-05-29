<?php

namespace App\Http\Controllers\Kasir;

use App\Http\Controllers\Controller;
use App\Models\Kunjungan;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PembayaranController extends Controller
{
    public function index()
    {
        $kunjungans = Kunjungan::with(['pasien', 'transaksiKunjungans', 'pembayaran'])->get();
        return view('kasir.pembayarans.index', compact('kunjungans'));
    }

    public function show(Kunjungan $kunjungan)
    {
        $kunjungan->load(['pasien', 'transaksiKunjungans.tindakan', 'transaksiKunjungans.obat', 'pembayaran']);
        $totalTagihan = $kunjungan->transaksiKunjungans->sum(function ($transaksi) {
            return ($transaksi->biaya_tindakan ?? 0) + ($transaksi->biaya_obat ?? 0);
        });
        return view('kasir.pembayarans.show', compact('kunjungan', 'totalTagihan'));
    }

    public function store(Request $request, Kunjungan $kunjungan)
    {
        $request->validate([
            'metode_pembayaran' => 'required|in:Tunai,Kartu,Transfer',
            'catatan' => 'nullable|string',
        ]);

        $totalTagihan = $kunjungan->transaksiKunjungans->sum(function ($transaksi) {
            return ($transaksi->biaya_tindakan ?? 0) + ($transaksi->biaya_obat ?? 0);
        });

        Pembayaran::updateOrCreate(
            ['kunjungan_id' => $kunjungan->id],
            [
                'total_tagihan' => $totalTagihan,
                'metode_pembayaran' => $request->metode_pembayaran,
                'lunas' => true,
                'tanggal_pembayaran' => now(),
                'kasir_id' => Auth::id(),
                'catatan' => $request->catatan,
            ]
        );

        return redirect()->route('kasir.pembayarans.index')->with('success', 'Pembayaran berhasil diproses.');
    }
}
