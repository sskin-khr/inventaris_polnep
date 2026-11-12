<nav x-data="{ open: false }" class="sticky top-0 z-30 border-b border-slate-200 bg-white">
    <div class="mx-auto max-w-screen-2xl px-4 sm:px-6 lg:px-8">
        <div class="flex min-h-16 items-center justify-between gap-6">
            <div class="flex shrink-0 items-center">
                <a href="{{ Auth::user()->role === 'admin' ? route('dashboard') : route('home') }}" class="flex items-center gap-3">
                    <x-application-logo class="block h-9 w-9 fill-current text-blue-700" />
                    <span class="hidden sm:block">
                        <span class="block text-sm font-bold leading-tight text-slate-900">INVENTARIS</span>
                        <span class="block text-xs text-slate-500">POLNEP</span>
                    </span>
                </a>
            </div>

            <div class="hidden min-w-0 flex-1 items-center justify-center gap-1 overflow-x-auto lg:flex">
                @if(Auth::user()->role === 'admin')
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                @else
                    <x-nav-link :href="route('home')" :active="request()->routeIs('home')">
                        {{ __('Beranda') }}
                    </x-nav-link>
                @endif

                <x-nav-link :href="route('assets.index')" :active="request()->routeIs('assets.*')">
                    {{ __('Data Aset') }}
                </x-nav-link>
                <x-nav-link :href="route('categories.index')" :active="request()->routeIs('categories.*')">
                    {{ __('Kategori') }}
                </x-nav-link>
                <x-nav-link :href="route('locations.index')" :active="request()->routeIs('locations.*')">
                    {{ __('Lokasi') }}
                </x-nav-link>
                <x-nav-link :href="route('mutations.index')" :active="request()->routeIs('mutations.*')">
                    {{ __('Mutasi') }}
                </x-nav-link>
                <x-nav-link :href="route('reports.index')" :active="request()->routeIs('reports.*')">
                    {{ __('Laporan') }}
                </x-nav-link>
                <x-nav-link :href="route('tickets.index')" :active="request()->routeIs('tickets.*')">
                    {{ __('Tiket') }}
                </x-nav-link>
            </div>

            <div class="hidden shrink-0 items-center lg:flex">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button type="button" class="inline-flex items-center gap-2 rounded-xl px-3 py-2 text-sm font-medium text-slate-600 transition hover:bg-slate-50 hover:text-slate-900 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <span class="flex h-8 w-8 items-center justify-center rounded-full bg-blue-50 text-xs font-bold text-blue-700">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </span>
                            <span class="max-w-32 truncate">{{ Auth::user()->name }}</span>
                            <svg class="h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profil') }}
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Keluar') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <button type="button" @click="open = ! open" class="inline-flex items-center justify-center rounded-xl p-2 text-slate-600 transition hover:bg-slate-100 focus:outline-none focus:ring-2 focus:ring-blue-500 lg:hidden" aria-label="Buka menu" :aria-expanded="open">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24" aria-hidden="true">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
            </button>
        </div>
    </div>

    <div x-show="open" x-transition style="display: none;" class="border-t border-slate-200 bg-white lg:hidden">
        <div class="space-y-1 px-4 py-3">
            @if(Auth::user()->role === 'admin')
                <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                    {{ __('Dashboard') }}
                </x-responsive-nav-link>
            @else
                <x-responsive-nav-link :href="route('home')" :active="request()->routeIs('home')">
                    {{ __('Beranda') }}
                </x-responsive-nav-link>
            @endif
            <x-responsive-nav-link :href="route('assets.index')" :active="request()->routeIs('assets.*')">
                {{ __('Data Aset') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('categories.index')" :active="request()->routeIs('categories.*')">
                {{ __('Kategori') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('locations.index')" :active="request()->routeIs('locations.*')">
                {{ __('Lokasi Ruangan') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('mutations.index')" :active="request()->routeIs('mutations.*')">
                {{ __('Riwayat Mutasi') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('reports.index')" :active="request()->routeIs('reports.*')">
                {{ __('Laporan') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('tickets.index')" :active="request()->routeIs('tickets.*')">
                {{ __('Lapor Kerusakan') }}
            </x-responsive-nav-link>
        </div>

        <div class="border-t border-slate-200 px-4 py-4">
            <p class="font-semibold text-sm text-slate-800">{{ Auth::user()->name }}</p>
            <p class="mt-1 text-xs text-slate-500">{{ Auth::user()->email }}</p>
            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profil') }}
                </x-responsive-nav-link>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="block w-full rounded-lg px-3 py-2 text-left text-sm font-medium text-slate-600 transition hover:bg-slate-50 hover:text-slate-900">
                        {{ __('Keluar') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>
