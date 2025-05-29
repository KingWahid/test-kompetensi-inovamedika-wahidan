<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium mb-4">
                        Selamat datang, {{ Auth::user()->name }}!
                    </h3>

                    <div class="mb-4">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                            Role:
                            @if(Auth::user()->hasRole('admin'))
                                Admin
                            @endif
                        </span>
                    </div>

                    @if(Auth::user()->hasRole('admin'))
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                            <a href="{{ route('admin.laporans.index') }}" class="block p-4 bg-yellow-50 rounded-lg hover:bg-yellow-100">
                                <h4 class="font-medium text-yellow-900">Laporan Klinik</h4>
                                <p class="text-sm text-yellow-700">View clinic reports</p>
                            </a>
                           <a href="{{ route('admin.wilayah.index') }}" class="block p-4 bg-blue-50 rounded-lg hover:bg-blue-100">
                                <h4 class="font-medium text-blue-900">Wilayah</h4>
                                <p class="text-sm text-blue-700">Manage regions</p>
                            </a>
                            <a href="{{ route('admin.users.index') }}" class="block p-4 bg-blue-50 rounded-lg hover:bg-blue-100">
                                <h4 class="font-medium text-blue-900">Kelola Pengguna</h4>
                                <p class="text-sm text-blue-700">Manage users and roles</p>
                            </a>
                            <a href="{{ route('admin.pegawais.index') }}" class="block p-4 bg-green-50 rounded-lg hover:bg-green-100">
                                <h4 class="font-medium text-green-900">Kelola Pegawai</h4>
                                <p class="text-sm text-green-700">Manage employees</p>
                            </a>
                            <a href="{{ route('admin.tindakans.index') }}" class="block p-4 bg-green-50 rounded-lg hover:bg-green-100">
                                <h4 class="font-medium text-green-900">Kelola Tindakan</h4>
                                <p class="text-sm text-green-700">Manage medical services</p>
                            </a>
                            <a href="{{ route('admin.obats.index') }}" class="block p-4 bg-green-50 rounded-lg hover:bg-green-100">
                                <h4 class="font-medium text-green-900">Kelola Obat</h4>
                                <p class="text-sm text-green-700">Manage medicines</p>
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
