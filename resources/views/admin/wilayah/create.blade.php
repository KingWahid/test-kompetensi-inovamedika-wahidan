@extends('layouts.layout')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ isset($wilayah) ? 'Edit Wilayah' : 'Tambah Wilayah' }}
    </h2>
@endsection

@section('content')
    <div class="p-6">
        <form method="POST" action="{{ isset($wilayah) ? route('admin.wilayah.update', $wilayah) : route('admin.wilayah.store') }}">
            @csrf
            @if(isset($wilayah)) @method('POST') @endif

            <div class="mb-4">
                <label class="block">Nama:</label>
                <input type="text" name="nama" value="{{ old('nama', $wilayah->nama ?? '') }}" class="border rounded px-4 py-2 w-full">
            </div>

            <div class="mb-4">
                <label class="block">Tipe:</label>
                <input type="text" name="tipe" value="{{ old('tipe', $wilayah->tipe ?? '') }}" class="border rounded px-4 py-2 w-full">
            </div>

            <button type="submit" class="bg-blue-500 text-black px-4 py-2 rounded">
                {{'Simpan' }}
            </button>
        </form>
    </div>
@endsection
