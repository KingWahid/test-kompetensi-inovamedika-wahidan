@extends('layouts.layout')

@section('header')
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Kelola Pegawai</h2>
     @endsection

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <a href="{{ route('admin.pegawais.create') }}" class="inline-block mb-4 px-4 py-2 bg-blue-600 text-black rounded hover:bg-blue-700">Tambah Pegawai</a>
                    @if (session('success'))
                        <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
                    @endif
                    <table class="w-full border-collapse">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="border p-2">Nama</th>
                                <th class="border p-2">Jabatan</th>
                                <th class="border p-2">Telepon</th>
                                <th class="border p-2">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pegawais as $pegawai)
                                <tr>
                                    <td class="border p-2">{{ $pegawai->nama }}</td>
                                    <td class="border p-2">{{ $pegawai->jabatan }}</td>
                                    <td class="border p-2">{{ $pegawai->telepon }}</td>
                                    <td class="border p-2">
                                        <a href="{{ route('admin.pegawais.edit', $pegawai) }}" class="text-blue-600 hover:underline">Edit</a>
                                        <form action="{{ route('admin.pegawais.destroy', $pegawai) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:underline" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
