<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use App\Models\Kunjungan;
use App\Models\Tindakan;
use App\Models\Obat;
use App\Models\TransaksiKunjungan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransaksiController extends Controller
{
    public function index()
    {
        $kunjungans = Kunjungan::with(['pasien', 'transaksiKunjungans'])->get();
        return view('dokter.transaksis.index', compact('kunjungans'));
    }

    public function create()
    {
        $kunjungans = Kunjungan::with('pasien')->get();
        $tindakans = Tindakan::all();
        $obats = Obat::where('stok', '>', 0)->get();
        return view('dokter.transaksis.create', compact('kunjungans', 'tindakans', 'obats'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kunjungan_id' => 'required|exists:kunjungans,id',
            'tindakan_id' => 'nullable|exists:tindakans,id',
            'obat_id' => 'nullable|exists:obats,id',
            'jumlah_obat' => 'nullable|integer|min:1',
            'catatan' => 'nullable|string',
        ]);

        $tindakan = $request->tindakan_id ? Tindakan::find($request->tindakan_id) : null;
        $obat = $request->obat_id ? Obat::find($request->obat_id) : null;

        if ($obat && $request->jumlah_obat) {
            if ($obat->stok < $request->jumlah_obat) {
                return back()->withErrors(['jumlah_obat' => 'Stok obat tidak cukup.']);
            }
            $obat->decrement('stok', $request->jumlah_obat);
        }

        TransaksiKunjungan::create([
            'kunjungan_id' => $request->kunjungan_id,
            'tindakan_id' => $request->tindakan_id,
            'obat_id' => $request->obat_id,
            'jumlah_obat' => $request->jumlah_obat,
            'biaya_tindakan' => $tindakan ? $tindakan->biaya : null,
            'biaya_obat' => $obat && $request->jumlah_obat ? $obat->harga * $request->jumlah_obat : null,
            'catatan' => $request->catatan,
            'dokter_id' => Auth::id(),
        ]);

        return redirect()->route('dokter.transaksis.index')->with('success', 'Transaksi berhasil dicatat.');
    }
}
