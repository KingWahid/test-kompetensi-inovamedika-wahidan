<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Riwayat Kunjungan</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <a href="{{ route('petugas.pendaftarans.create') }}" class="inline-block mb-4 px-4 py-2 bg-blue-600 text-black rounded hover:bg-blue-700">Daftar Kunjungan Baru</a>
                    @if (session('success'))
                        <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
                    @endif
                    <table class="w-full border-collapse">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="border p-2">Pasien</th>
                                <th class="border p-2">Tindakan</th>
                                <th class="border p-2">Tanggal</th>
                                <th class="border p-2">Petugas</th>
                                <th class="border p-2">Catatan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kunjungans as $kunjungan)
                                <tr>
                                    <td class="border p-2">{{ $kunjungan->pasien->nama }}</td>
                                    <td class="border p-2">{{ $kunjungan->tindakan->nama ?? '-' }}</td>
                                    <td class="border p-2">{{ $kunjungan->tanggal_kunjungan }}</td>
                                    <td class="border p-2">{{ $kunjungan->user->name ?? '-' }}</td>
                                    <td class="border p-2">{{ $kunjungan->catatan ?? '-' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
