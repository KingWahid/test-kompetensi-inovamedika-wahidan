<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Pasien;
use App\Models\Kunjungan;
use App\Models\Tindakan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PendaftaranController extends Controller
{
    public function index()
    {
        $kunjungans = Kunjungan::with(['pasien', 'tindakan', 'user'])->get();
        return view('petugas.pendaftarans.index', compact('kunjungans'));
    }

    public function create()
    {
        $pasiens = Pasien::all();
        $tindakans = Tindakan::all();
        return view('petugas.pendaftarans.create', compact('pasiens', 'tindakans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pasien_id' => 'required|exists:pasiens,id',
            'tindakan_id' => 'required|exists:tindakans,id',
            'tanggal_kunjungan' => 'required|date',
            'catatan' => 'nullable|string',
        ]);

        Kunjungan::create([
            'pasien_id' => $request->pasien_id,
            'tindakan_id' => $request->tindakan_id,
            'tanggal_kunjungan' => $request->tanggal_kunjungan,
            'catatan' => $request->catatan,
            'user_id' => Auth::id(), // Petugas yang mendaftarkan
        ]);

        return redirect()->route('petugas.pendaftarans.index')->with('success', 'Kunjungan berhasil didaftarkan.');
    }

    public function createPasien()
    {
        return view('petugas.pendaftarans.create-pasien');
    }

    public function storePasien(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'nullable|string',
            'telepon' => 'nullable|string|max:20',
            'tanggal_lahir' => 'nullable|date',
            'jenis_kelamin' => 'nullable|in:Laki-laki,Perempuan',
        ]);

        $pasien = Pasien::create($request->only('nama', 'alamat', 'telepon', 'tanggal_lahir', 'jenis_kelamin'));

        return redirect()->route('petugas.pendaftarans.create')->with('success', 'Pasien berhasil ditambahkan.');
    }
}
