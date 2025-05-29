<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Detail Tagihan</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden sm: shadow-sm rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-medium mb-4">Pasien: {{ $kunjungan->pasien->nama }}</h3>
                    <p class="mb-2">Tanggal Kunjungan: {{ $kunjungan->tanggal_kunjungan }}</p>
                    <p class="mb-4">Status: {{ $kunjungan->pembayaran && $kunjungan->pembayaran->lunas ? 'Lunas' : 'Belum Dibayar' }}</p>
                    <table class="w-full border-collapse">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="border p-2">Item</th>
                                <th class="border p-2">Detail</th>
                                <th class="border p-2">Biaya</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kunjungan->transaksiKunjungans as $transaksi)
                                @if ($transaksi->tindakan)
                                    <tr>
                                        <td class="border p-2">Tindakan</td>
                                        <td class="border p-2">{{ $transaksi->tindakan->nama }}</td>
                                        <td class="border p-2">{{ number_format($transaksi->biaya_tindakan, 2) }}</td>
                                    </tr>
                                @endif
                                @if ($transaksi->obat)
                                    <tr>
                                        <td class="border p-2">Obat</td>
                                        <td class="border p-2">{{ $transaksi->obat->nama }} (Jumlah: {{ $transaksi->jumlah_obat }})</td>
                                        <td class="border p-2">{{ number_format($transaksi->biaya_obat, 2) }}</td>
                                    </td>
                                    </tr>
                                @endif
                            @endforeach
                            <tr>
                                <td class="border p-2 font-bold" colspan="2">Total</td>
                                <td class="border p-2 font-bold">{{ number_format($total_tagihan, 2) }}</td>
                            </tr>
                        </tbody>
                    </table>

                    @if (!$kunjungan->pembayaran || !$kunjungan->pembayaran->lunas)
                        <form action="{{ route('kasir.pembayarans.store', $kunjungan) }}" method="POST" class="mt-4">
                            @csrf
                            @method('PUT')
                            <div class="mb-4">
                                <label for="metode_pembayaran" class="block text-sm font-medium text-gray-700">Metode Pembayaran</label>
                                <select name="metode_pembayaran" id="metode_pembayaran" class="mt-1 block w-full border-gray-300 rounded-md">
                                    <option value="">Pilih Metode</option>
                                    <option value="Tunai">Tunai</option>
                                    <option value="Kartu">Kartu</option>
                                    <option value="Transfer">Transfer</option>
                                </select>
                                @error('metode_pembayaran')
                                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label for="catatan" class="block text-sm font-medium text-gray-700">Catatan</label>
                                <textarea name="catatan" id="catatan" class="mt-1 block w-full border-gray-300 rounded-md">{{ old('catatan') }}</textarea>
                                @error('catatan')
                                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Proses Pembayaran</button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
