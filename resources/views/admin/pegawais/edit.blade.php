@extends('layouts.layout')

@section('header')
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Pegawai</h2>
      @endsection

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form action="{{ route('admin.pegawais.update', $pegawai) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label for="nama" class="block text-sm font-medium text-gray-700">Nama</label>
                            <input type="text" name="nama" id="nama" class="mt-1 block w-full border-gray-300 rounded-md" value="{{ old('nama', $pegawai->nama) }}">
                            @error('nama')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="jabatan" class="block text-sm font-medium text-gray-700">Jabatan</label>
                            <input type="text" name="jabatan" id="jabatan" class="mt-1 block w-full border-gray-300 rounded-md" value="{{ old('jabatan', $pegawai->jabatan) }}">
                            @error('jabatan')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="telepon" class="block text-sm font-medium text-gray-700">Telepon</label>
                            <input type="text" name="telepon" id="telepon" class="mt-1 block w-full border-gray-300 rounded-md" value="{{ old('telepon', $pegawai->telepon) }}">
                            @error('telepon')
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
