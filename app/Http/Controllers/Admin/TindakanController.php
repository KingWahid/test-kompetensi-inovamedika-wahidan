<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tindakan;
use Illuminate\Http\Request;

class TindakanController extends Controller
{
    public function index()
    {
        $tindakans = Tindakan::all();
        return view('admin.tindakans.index', compact('tindakans'));
    }

    public function create()
    {
        return view('admin.tindakans.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'biaya' => 'required|numeric|min:0',
            'deskripsi' => 'nullable|string',
        ]);

        Tindakan::create($request->only('nama', 'biaya', 'deskripsi'));
        return redirect()->route('admin.tindakans.index')->with('success', 'Tindakan berhasil ditambahkan.');
    }

    public function edit(Tindakan $tindakan)
    {
        return view('admin.tindakans.edit', compact('tindakan'));
    }

    public function update(Request $request, Tindakan $tindakan)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'biaya' => 'required|numeric|min:0',
            'deskripsi' => 'nullable|string',
        ]);

        $tindakan->update($request->only('nama', 'biaya', 'deskripsi'));
        return redirect()->route('admin.tindakans.index')->with('success', 'Tindakan berhasil diperbarui.');
    }

    public function destroy(Tindakan $tindakan)
    {
        $tindakan->delete();
        return redirect()->route('admin.tindakans.index')->with('success', 'Tindakan berhasil dihapus.');
    }
}
