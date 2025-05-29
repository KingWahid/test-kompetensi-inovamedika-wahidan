@extends('layouts.layout')

@section('header')
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Tambah Obat</h2>
 @endsection

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form action="{{ route('admin.obats.store') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="nama" class="block text-sm font-medium text-gray-700">Nama</label>
                            <input type="text" name="nama" id="nama" class="mt-1 block w-full border-gray-300 rounded-md" value="{{ old('nama') }}">
                            @error('nama')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="harga" class="block text-sm font-medium text-gray-700">Harga</label>
                            <input type="number" step="0.01" name="harga" id="harga" class="mt-1 block w-full border-gray-300 rounded-md" value="{{ old('harga') }}">
                            @error('harga')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="stok" class="block text-sm font-medium text-gray-700">Stok</label>
                            <input type="number" name="stok" id="stok" class="mt-1 block w-full border-gray-300 rounded-md" value="{{ old('stok') }}">
                            @error('stok')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="deskripsi" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                            <textarea name="deskripsi" id="deskripsi" class="mt-1 block w-full border-gray-300 rounded-md">{{ old('deskripsi') }}</textarea>
                            @error('deskripsi')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-black rounded hover:bg-blue-700">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
