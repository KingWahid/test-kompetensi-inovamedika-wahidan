<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Riwayat Transaksi</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <a href="{{ route('dokter.transaksis.create') }}" class="inline-block mb-4 px-4 py-2 bg-blue-600 text-black rounded hover:bg-blue-700">Catat Transaksi Baru</a>
                    @if (session('success'))
                        <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
                    @endif
                    <table class="w-full border-collapse">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="border p-2">Pasien</th>
                                <th class="border p-2">Tanggal Kunjungan</th>
                                <th class="border p-2">Tindakan</th>
                                <th class="border p-2">Obat</th>
                                <th class="border p-2">Jumlah Obat</th>
                                <th class="border p-2">Total Biaya</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kunjungans as $kunjungan)
                                @foreach ($kunjungan->transaksiKunjungans as $transaksi)
                                    <tr>
                                        <td class="border p-2">{{ $kunjungan->pasien->nama }}</td>
                                        <td class="border p-2">{{ $kunjungan->tanggal_kunjungan }}</td>
                                        <td class="border p-2">{{ $transaksi->tindakan->nama ?? '-' }}</td>
                                        <td class="border p-2">{{ $transaksi->obat->nama ?? '-' }}</td>
                                        <td class="border p-2">{{ $transaksi->jumlah_obat ?? '-' }}</td>
                                        <td class="border p-2">{{ number_format(($transaksi->biaya_tindakan ?? 0) + ($transaksi->biaya_obat ?? 0), 2) }}</td>
                                    </tr>
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
