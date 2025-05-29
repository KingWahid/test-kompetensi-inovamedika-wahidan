<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Pendaftaran Kunjungan</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <a href="{{ route('petugas.pendaftarans.create-pasien') }}" class="inline-block mb-4 px-4 py-2 bg-green-600 text-black rounded hover:bg-green-700">Tambah Pasien Baru</a>
                    <form action="{{ route('petugas.pendaftarans.store') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="pasien_id" class="block text-sm font-medium text-gray-700">Pasien</label>
                            <select name="pasien_id" id="pasien_id" class="mt-1 block w-full border-gray-300 rounded-md">
                                <option value="">Pilih Pasien</option>
                                @foreach ($pasiens as $pasien)
                                    <option value="{{ $pasien->id }}">{{ $pasien->nama }}</option>
                                @endforeach
                            </select>
                            @error('pasien_id')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="tindakan_id" class="block text-sm font-medium text-gray-700">Jenis Kunjungan</label>
                            <select name="tindakan_id" id="tindakan_id" class="mt-1 block w-full border-gray-300 rounded-md">
                                <option value="">Pilih Tindakan</option>
                                @foreach ($tindakans as $tindakan)
                                    <option value="{{ $tindakan->id }}">{{ $tindakan->nama }} ({{ number_format($tindakan->biaya, 2) }})</option>
                                @endforeach
                            </select>
                            @error('tindakan_id')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="tanggal_kunjungan" class="block text-sm font-medium text-gray-700">Tanggal Kunjungan</label>
                            <input type="date" name="tanggal_kunjungan" id="tanggal_kunjungan" class="mt-1 block w-full border-gray-300 rounded-md" value="{{ old('tanggal_kunjungan') }}">
                            @error('tanggal_kunjungan')
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
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-black rounded hover:bg-blue-700">Daftarkan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
