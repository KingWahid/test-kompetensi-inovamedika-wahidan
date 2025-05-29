<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Kelola Pembayaran</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    @if (session('success'))
                        <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
                    @endif
                    <table class="w-full border-collapse">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="border p-2">Pasien</th>
                                <th class="border p-2">Tanggal Kunjungan</th>
                                <th class="border p-2">Total Tagihan</th>
                                <th class="border p-2">Status</th>
                                <th class="border p-2">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kunjungans as $kunjungan)
                                @if ($kunjungan->transaksiKunjungans->isNotEmpty())
                                    <tr>
                                        <td class="border p-2">{{ $kunjungan->pasien->nama }}</td>
                                        <td class="border p-2">{{ $kunjungan->tanggal_kunjungan }}</td>
                                        <td class="border p-2">
                                            {{ number_format($kunjungan->transaksiKunjungans->sum(function ($transaksi) {
                                                return ($transaksi->biaya_tindakan ?? 0) + ($transaksi->biaya_obat ?? 0);
                                            }), 2) }}
                                        </td>
                                        <td class="border p-2">
                                            {{ $kunjungan->pembayaran && $kunjungan->pembayaran->lunas ? 'Lunas' : 'Belum Dibayar' }}
                                        </td>
                                        <td class="border p-2">
                                            <a href="{{ route('kasir.pembayarans.show', $kunjungan) }}" class="text-blue-600 hover:underline">Lihat Detail</a>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
