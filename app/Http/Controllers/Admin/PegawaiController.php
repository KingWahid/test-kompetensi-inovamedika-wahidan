<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pegawai;
use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    public function index()
    {
        $pegawais = Pegawai::all();
        return view('admin.pegawais.index', compact('pegawais'));
    }

    public function create()
    {
        return view('admin.pegawais.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'telepon' => 'nullable|string|max:20',
        ]);

        Pegawai::create($request->only('nama', 'jabatan', 'telepon'));
        return redirect()->route('admin.pegawais.index')->with('success', 'Pegawai berhasil ditambahkan.');
    }

    public function edit(Pegawai $pegawai)
    {
        return view('admin.pegawais.edit', compact('pegawai'));
    }

    public function update(Request $request, Pegawai $pegawai)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'telepon' => 'nullable|string|max:20',
        ]);

        $pegawai->update($request->only('nama', 'jabatan', 'telepon'));
        return redirect()->route('admin.pegawais.index')->with('success', 'Pegawai berhasil diperbarui.');
    }

    public function destroy(Pegawai $pegawai)
    {
        $pegawai->delete();
        return redirect()->route('admin.pegawais.index')->with('success', 'Pegawai berhasil dihapus.');
    }
}
