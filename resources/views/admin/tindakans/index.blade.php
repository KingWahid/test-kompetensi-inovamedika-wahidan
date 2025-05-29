@extends('layouts.layout')

@section('header')
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Kelola Tindakan</h2>
@endsection

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <a href="{{ route('admin.tindakans.create') }}" class="inline-block mb-4 px-4 py-2 bg-blue-600 text-black rounded hover:bg-blue-700">Tambah Tindakan</a>
                    @if (session('success'))
                        <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
                    @endif
                    <table class="w-full border-collapse">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="border p-2">Nama</th>
                                <th class="border p-2">Biaya</th>
                                <th class="border p-2">Deskripsi</th>
                                <th class="border p-2">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tindakans as $tindakan)
                                <tr>
                                    <td class="border p-2">{{ $tindakan->nama }}</td>
                                    <td class="border p-2">{{ number_format($tindakan->biaya, 2) }}</td>
                                    <td class="border p-2">{{ $tindakan->deskripsi }}</td>
                                    <td class="border p-2">
                                        <a href="{{ route('admin.tindakans.edit', $tindakan) }}" class="text-blue-600 hover:underline">Edit</a>
                                        <form action="{{ route('admin.tindakans.destroy', $tindakan) }}" method="POST" class="inline">
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
