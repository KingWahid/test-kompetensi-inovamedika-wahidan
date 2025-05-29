<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Dashboard Dokter') }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium mb-4">Selamat datang, {{ Auth::user()->name }}!</h3>
                    <div class="mb-4">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                            Role: Dokter
                        </span>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <a href="{{ route('dokter.transaksis.create') }}" class="block p-4 bg-blue-50 rounded-lg hover:bg-blue-100">
                            <h4 class="font-medium text-blue-900">Catat Transaksi</h4>
                            <p class="text-sm text-blue-700">Tambah tindakan dan resep obat</p>
                        </a>
                        <a href="{{ route('dokter.transaksis.index') }}" class="block p-4 bg-green-50 rounded-lg hover:bg-green-100">
                            <h4 class="font-medium text-green-900">Riwayat Transaksi</h4>
                            <p class="text-sm text-green-700">Lihat transaksi kunjungan</p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
