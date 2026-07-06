<nav x-data="{ open: false }" class="bg-white shadow-sm border-b border-gray-200">
    <div class="max-w-full mx-auto px-6 lg:px-10">
        <div class="flex justify-between h-20">
 
            {{-- Logo & Brand --}}
            <div class="flex items-center">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-2 text-decoration-none">
                    <div class="bg-blue-600 rounded-lg p-2">
                        <x-application-logo class="block h-7 w-auto fill-current text-white" />
                    </div>
                    <div>
                        <span class="text-lg font-bold text-gray-800 block leading-tight">Perpustakaan</span>
                        <span class="text-xs text-gray-400 leading-tight">Bina Nusantara</span>
                    </div>
                </a>
            </div>
 
            {{-- Navigation Links --}}
            <div class="hidden sm:flex sm:items-center sm:gap-1">
                <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')"
                    class="px-4 py-2 rounded-lg text-sm font-medium transition-all duration-150">
                    <i class="bi bi-speedometer2 me-1"></i>{{ __('Dashboard') }}
                </x-nav-link>
                <x-nav-link :href="route('buku.index')" :active="request()->routeIs('buku.*')"
                    class="px-4 py-2 rounded-lg text-sm font-medium transition-all duration-150">
                    <i class="bi bi-book me-1"></i>{{ __('Buku') }}
                </x-nav-link>
                <x-nav-link :href="route('anggota.index')" :active="request()->routeIs('anggota.*')"
                    class="px-4 py-2 rounded-lg text-sm font-medium transition-all duration-150">
                    <i class="bi bi-people me-1"></i>{{ __('Anggota') }}
                </x-nav-link>
                <x-nav-link :href="route('transaksi.index')" :active="request()->routeIs('transaksi.*')"
                    class="px-4 py-2 rounded-lg text-sm font-medium transition-all duration-150">
                    <i class="bi bi-arrow-left-right me-1"></i>{{ __('Transaksi') }}
                </x-nav-link>
            </div>
 
            {{-- User Dropdown --}}
            <div class="hidden sm:flex sm:items-center sm:gap-3">
 
                <x-dropdown align="right" width="52">
                    <x-slot name="trigger">
                        <button class="flex items-center gap-2 px-3 py-2 rounded-lg border border-gray-200 text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 transition duration-150">
                            <div class="bg-blue-600 text-white rounded-full h-7 w-7 flex items-center justify-center text-xs font-bold">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>
                            <span>{{ Auth::user()->name }}</span>
                            <svg class="fill-current h-4 w-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </x-slot>
 
                    <x-slot name="content">
                        <div class="px-4 py-3 border-b border-gray-100">
                            <p class="text-sm font-semibold text-gray-800">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-gray-500">{{ Auth::user()->email }}</p>
                        </div>
 
                        <x-dropdown-link :href="route('profile.edit')" class="flex items-center gap-2">
                            <i class="bi bi-person text-gray-400"></i>{{ __('Profile') }}
                        </x-dropdown-link>
 
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();"
                                class="flex items-center gap-2 text-red-600">
                                <i class="bi bi-box-arrow-right text-red-400"></i>{{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>
 
            {{-- Hamburger --}}
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
 
    {{-- Responsive Navigation Menu --}}
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1 px-4">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                <i class="bi bi-speedometer2 me-1"></i>{{ __('Dashboard') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('buku.index')" :active="request()->routeIs('buku.*')">
                <i class="bi bi-book me-1"></i>{{ __('Buku') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('anggota.index')" :active="request()->routeIs('anggota.*')">
                <i class="bi bi-people me-1"></i>{{ __('Anggota') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('transaksi.index')" :active="request()->routeIs('transaksi.*')">
                <i class="bi bi-arrow-left-right me-1"></i>{{ __('Transaksi') }}
            </x-responsive-nav-link>
        </div>
 
        <div class="pt-4 pb-1 border-t border-gray-200 px-4">
            <div class="flex items-center gap-3 mb-3">
                <div class="bg-blue-600 text-white rounded-full h-9 w-9 flex items-center justify-center text-sm font-bold">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
                <div>
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>
            </div>
 
            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    <i class="bi bi-person me-1"></i>{{ __('Profile') }}
                </x-responsive-nav-link>
 
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault(); this.closest('form').submit();">
                        <i class="bi bi-box-arrow-right me-1"></i>{{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>