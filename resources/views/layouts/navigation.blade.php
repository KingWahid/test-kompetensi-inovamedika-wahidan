<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="flex items-center space-x-2 mr-">
                    <div class="font-bold text-xl">
                    MEDIC.
                    </div>
                </div>
                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>

                    @if(Auth::user()->hasRole('admin'))
                        <x-nav-link :href="route('admin.laporans.index')" :active="request()->routeIs('admin.*')">
                            {{ __('Admin Panel') }}
                        </x-nav-link>
                    @endif

                    @if(Auth::user()->hasRole('petugas'))
                        <x-nav-link :href="route('petugas.pendaftarans.index')" :active="request()->routeIs('petugas.*')">
                            {{ __('Pendaftaran') }}
                        </x-nav-link>
                    @endif

                    @if(Auth::user()->hasRole('dokter'))
                        <x-nav-link :href="route('dokter.transaksis.index')" :active="request()->routeIs('doctor.*')">
                            {{ __('Dokter Panel') }}
                        </x-nav-link>
                    @endif

                    @if(Auth::user()->hasRole('kasir'))
                        <x-nav-link :href="route('kasir.pembayarans.index')" :active="request()->routeIs('cashier.*')">
                            {{ __('Kasir Panel') }}
                        </x-nav-link>
                    @endif
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>
                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div class="px-4 py-2 text-xs text-gray-500">
                            Role:
                            @if(Auth::user()->hasRole('admin'))
                                Admin
                            @elseif(Auth::user()->hasRole('petugas'))
                                Petugas
                            @elseif(Auth::user()->hasRole('dokter'))
                                Dokter
                            @elseif(Auth::user()->hasRole('kasir'))
                                Kasir
                            @else
                                Guest
                            @endif
                        </div>

                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>
        </div>
    </div>
</nav>
