<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Catat Transaksi</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    @if (session('success'))
                        <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
                    @endif
                    <form action="{{ route('dokter.transaksis.store') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="kunjungan_id" class="block text-sm font-medium text-gray-700">Kunjungan Pasien</label>
                            <select name="kunjungan_id" id="kunjungan_id" class="mt-1 block w-full border-gray-300 rounded-md">
                                <option value="">Pilih Kunjungan</option>
                                @foreach ($kunjungans as $kunjungan)
                                    <option value="{{ $kunjungan->id }}">{{ $kunjungan->pasien->nama }} - {{ $kunjungan->tanggal_kunjungan }}</option>
                                @endforeach
                            </select>
                            @error('kunjungan_id')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="tindakan_id" class="block text-sm font-medium text-gray-700">Tindakan Medis</label>
                            <select name="tindakan_id" id="tindakan_id" class="mt-1 block w-full border-gray-300 rounded-md">
                                <option value="">Pilih Tindakan (Opsional)</option>
                                @foreach ($tindakans as $tindakan)
                                    <option value="{{ $tindakan->id }}">{{ $tindakan->nama }} ({{ number_format($tindakan->biaya, 2) }})</option>
                                @endforeach
                            </select>
                            @error('tindakan_id')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="obat_id" class="block text-sm font-medium text-gray-700">Obat</label>
                            <select name="obat_id" id="obat_id" class="mt-1 block w-full border-gray-300 rounded-md">
                                <option value="">Pilih Obat (Opsional)</option>
                                @foreach ($obats as $obat)
                                    <option value="{{ $obat->id }}">{{ $obat->nama }} (Stok: {{ $obat->stok }})</option>
                                @endforeach
                            </select>
                            @error('obat_id')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="jumlah_obat" class="block text-sm font-medium text-gray-700">Jumlah Obat</label>
                            <input type="number" name="jumlah_obat" id="jumlah_obat" class="mt-1 block w-full border-gray-300 rounded-md" value="{{ old('jumlah_obat') }}">
                            @error('jumlah_obat')
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
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-black rounded hover:bg-blue-700">Simpan Transaksi</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
