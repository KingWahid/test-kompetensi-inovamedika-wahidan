<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Wilayah;
use Illuminate\Http\Request;

class WilayahController extends Controller
{
    public function index()
    {
        $wilayah = Wilayah::all();
        return view('admin.wilayah.index', compact('wilayah'));
    }

    public function create()
    {
        return view('admin.wilayah.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'tipe' => 'required'
        ]);

        Wilayah::create($request->all());

        return redirect()->route('admin.wilayah.index')->with('success', 'Wilayah berhasil ditambahkan.');
    }

    public function edit(Wilayah $wilayah)
    {
        return view('admin.wilayah.edit', compact('wilayah'));
    }

    public function update(Request $request, Wilayah $wilayah)
    {
        $request->validate([
            'nama' => 'required',
            'tipe' => 'required'
        ]);

        $wilayah->update($request->all());

        return redirect()->route('admin.wilayah.index')->with('success', 'Wilayah berhasil diperbarui.');
    }

    public function destroy(Wilayah $wilayah)
    {
        $wilayah->delete();

        return redirect()->route('admin.wilayah.index')->with('success', 'Wilayah berhasil dihapus.');
    }
}
