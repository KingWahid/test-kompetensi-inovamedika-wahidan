<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Obat;
use Illuminate\Http\Request;

class ObatController extends Controller
{
    public function index()
    {
        $obats = Obat::all();
        return view('admin.obats.index', compact('obats'));
    }

    public function create()
    {
        return view('admin.obats.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'deskripsi' => 'nullable|string',
        ]);

        Obat::create($request->only('nama', 'harga', 'stok', 'deskripsi'));
        return redirect()->route('admin.obats.index')->with('success', 'Obat berhasil ditambahkan.');
    }

    public function edit(Obat $obat)
    {
        return view('admin.obats.edit', compact('obat'));
    }

    public function update(Request $request, Obat $obat)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'deskripsi' => 'nullable|string',
        ]);

        $obat->update($request->only('nama', 'harga', 'stok', 'deskripsi'));
        return redirect()->route('admin.obats.index')->with('success', 'Obat berhasil diperbarui.');
    }

    public function destroy(Obat $obat)
    {
        $obat->delete();
        return redirect()->route('admin.obats.index')->with('success', 'Obat berhasil dihapus.');
    }
}
