@extends('layouts.layout')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">Data Wilayah</h2>
@endsection

@section('content')
    <div class="bg-white p-6 rounded shadow">
        <a href="{{ route('admin.wilayah.create') }}" class="bg-blue-500 text-black px-4 py-2 rounded hover:bg-blue-600">Tambah Wilayah</a>

        <table class="w-full mt-4 table-auto border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border px-4 py-2">#</th>
                    <th class="border px-4 py-2">Nama</th>
                    <th class="border px-4 py-2">Tipe</th>
                    <th class="border px-4 py-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($wilayah as $item)
                    <tr>
                        <td class="border px-4 py-2 text-center">{{ $loop->iteration }}</td>
                        <td class="border px-4 py-2">{{ $item->nama }}</td>
                        <td class="border px-4 py-2">{{ $item->tipe }}</td>
                        <td class="border px-4 py-2 text-center">
                            <a href="{{ route('admin.wilayah.edit', $item) }}" class="text-blue-600 hover:underline">Edit</a>
                            <form action="{{ route('admin.wilayah.destroy', $item) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Hapus?')" class="text-red-600 ml-2 hover:underline">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach

                @if($wilayah->isEmpty())
                    <tr>
                        <td colspan="4" class="border px-4 py-2 text-center text-gray-500">Data belum tersedia.</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
@endsection
