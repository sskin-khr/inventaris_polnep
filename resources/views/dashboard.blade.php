<x-app-layout>
    @php
        $totalAset = \App\Models\Asset::count();
        $kondisiBaik = \App\Models\Asset::where('condition', 'Baik')->count();
        $rusakRingan = \App\Models\Asset::where('condition', 'Rusak Ringan')->count();
        $rusakBerat = \App\Models\Asset::where('condition', 'Rusak Berat')->count();

        $persenBaik = $totalAset > 0 ? ($kondisiBaik / $totalAset) * 100 : 0;
        $persenRingan = $totalAset > 0 ? ($rusakRingan / $totalAset) * 100 : 0;
        $persenBerat = $totalAset > 0 ? ($rusakBerat / $totalAset) * 100 : 0;
    @endphp

    <x-slot name="header">
        <div>
            <p class="text-xs font-semibold uppercase tracking-[0.18em] text-blue-700">INVENTARIS POLNEP</p>
            <h1 class="mt-1 text-2xl font-bold tracking-tight text-slate-900">Dashboard</h1>
            <p class="mt-1 text-sm text-slate-500">Ringkasan kondisi inventaris saat ini.</p>
        </div>
    </x-slot>

    <div class="mx-auto max-w-7xl space-y-6 px-4 py-8 sm:px-6 lg:px-8">
        <section class="flex flex-col gap-5 rounded-2xl bg-slate-900 px-6 py-7 text-white shadow-sm sm:flex-row sm:items-center sm:justify-between sm:px-8">
            <div>
                <p class="text-sm font-medium text-blue-200">Panel administrator</p>
                <h2 class="mt-1 text-2xl font-bold">Selamat datang, {{ Auth::user()->name }}</h2>
                <p class="mt-2 max-w-2xl text-sm leading-6 text-slate-300">
                    Pantau inventaris dan akses menu pengelolaan aset dari satu tempat.
                </p>
            </div>
            <a href="{{ route('assets.create') }}" class="inline-flex w-fit items-center justify-center gap-2 rounded-xl bg-white px-4 py-2.5 text-sm font-semibold text-slate-900 transition hover:bg-blue-50">
                <span aria-hidden="true">+</span> Tambah aset
            </a>
        </section>

        <section aria-labelledby="asset-overview-title">
            <div class="mb-4">
                <h2 id="asset-overview-title" class="text-lg font-bold text-slate-900">Ringkasan aset</h2>
                <p class="mt-1 text-sm text-slate-500">Jumlah aset berdasarkan kondisi yang tercatat.</p>
            </div>

            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">
                <article class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                    <p class="text-sm font-medium text-slate-500">Total aset</p>
                    <p class="mt-3 text-3xl font-bold tracking-tight text-slate-900">{{ number_format($totalAset) }}</p>
                    <p class="mt-1 text-xs text-slate-500">Aset terdaftar</p>
                </article>
                <article class="rounded-2xl border border-emerald-100 bg-white p-5 shadow-sm">
                    <p class="text-sm font-medium text-emerald-700">Kondisi baik</p>
                    <p class="mt-3 text-3xl font-bold tracking-tight text-slate-900">{{ number_format($kondisiBaik) }}</p>
                    <p class="mt-1 text-xs text-slate-500">{{ number_format($persenBaik, 1) }}% dari total aset</p>
                </article>
                <article class="rounded-2xl border border-amber-100 bg-white p-5 shadow-sm">
                    <p class="text-sm font-medium text-amber-700">Rusak ringan</p>
                    <p class="mt-3 text-3xl font-bold tracking-tight text-slate-900">{{ number_format($rusakRingan) }}</p>
                    <p class="mt-1 text-xs text-slate-500">{{ number_format($persenRingan, 1) }}% dari total aset</p>
                </article>
                <article class="rounded-2xl border border-rose-100 bg-white p-5 shadow-sm">
                    <p class="text-sm font-medium text-rose-700">Rusak berat</p>
                    <p class="mt-3 text-3xl font-bold tracking-tight text-slate-900">{{ number_format($rusakBerat) }}</p>
                    <p class="mt-1 text-xs text-slate-500">{{ number_format($persenBerat, 1) }}% dari total aset</p>
                </article>
            </div>
        </section>

        <div class="grid grid-cols-1 gap-5 lg:grid-cols-2">
            <section class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm sm:p-6" aria-labelledby="condition-title">
                <div class="mb-6">
                    <h2 id="condition-title" class="text-base font-bold text-slate-900">Kondisi aset</h2>
                    <p class="mt-1 text-sm text-slate-500">Perbandingan kondisi terhadap total aset.</p>
                </div>

                <div class="space-y-5">
                    <div>
                        <div class="mb-2 flex items-center justify-between gap-3 text-sm">
                            <span class="font-medium text-slate-700">Baik</span>
                            <span class="text-slate-500">{{ $kondisiBaik }} ({{ number_format($persenBaik, 1) }}%)</span>
                        </div>
                        <div class="h-2.5 overflow-hidden rounded-full bg-slate-100">
                            <div class="h-full rounded-full bg-emerald-500" style="width: {{ min($persenBaik, 100) }}%"></div>
                        </div>
                    </div>
                    <div>
                        <div class="mb-2 flex items-center justify-between gap-3 text-sm">
                            <span class="font-medium text-slate-700">Rusak ringan</span>
                            <span class="text-slate-500">{{ $rusakRingan }} ({{ number_format($persenRingan, 1) }}%)</span>
                        </div>
                        <div class="h-2.5 overflow-hidden rounded-full bg-slate-100">
                            <div class="h-full rounded-full bg-amber-400" style="width: {{ min($persenRingan, 100) }}%"></div>
                        </div>
                    </div>
                    <div>
                        <div class="mb-2 flex items-center justify-between gap-3 text-sm">
                            <span class="font-medium text-slate-700">Rusak berat</span>
                            <span class="text-slate-500">{{ $rusakBerat }} ({{ number_format($persenBerat, 1) }}%)</span>
                        </div>
                        <div class="h-2.5 overflow-hidden rounded-full bg-slate-100">
                            <div class="h-full rounded-full bg-rose-500" style="width: {{ min($persenBerat, 100) }}%"></div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm sm:p-6" aria-labelledby="shortcuts-title">
                <div class="mb-4">
                    <h2 id="shortcuts-title" class="text-base font-bold text-slate-900">Akses cepat</h2>
                    <p class="mt-1 text-sm text-slate-500">Menu yang sering digunakan.</p>
                </div>
                <div class="grid grid-cols-1 gap-3 sm:grid-cols-2">
                    <a href="{{ route('assets.index') }}" class="rounded-xl border border-slate-200 p-4 transition hover:border-blue-300 hover:bg-blue-50/50">
                        <span class="block text-sm font-semibold text-slate-800">Data aset</span>
                        <span class="mt-1 block text-xs text-slate-500">Lihat inventaris</span>
                    </a>
                    <a href="{{ route('categories.index') }}" class="rounded-xl border border-slate-200 p-4 transition hover:border-blue-300 hover:bg-blue-50/50">
                        <span class="block text-sm font-semibold text-slate-800">Kategori</span>
                        <span class="mt-1 block text-xs text-slate-500">Kelola kelompok aset</span>
                    </a>
                    <a href="{{ route('locations.index') }}" class="rounded-xl border border-slate-200 p-4 transition hover:border-blue-300 hover:bg-blue-50/50">
                        <span class="block text-sm font-semibold text-slate-800">Lokasi</span>
                        <span class="mt-1 block text-xs text-slate-500">Kelola ruangan</span>
                    </a>
                    <a href="{{ route('reports.index') }}" class="rounded-xl border border-slate-200 p-4 transition hover:border-blue-300 hover:bg-blue-50/50">
                        <span class="block text-sm font-semibold text-slate-800">Laporan</span>
                        <span class="mt-1 block text-xs text-slate-500">Tinjau dan cetak data</span>
                    </a>
                </div>
            </section>
        </div>
    </div>
</x-app-layout>
