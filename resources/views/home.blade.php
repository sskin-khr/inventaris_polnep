<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="text-xs font-semibold uppercase tracking-[0.18em] text-blue-700">INVENTARIS POLNEP</p>
            <h1 class="mt-1 text-2xl font-bold tracking-tight text-slate-900">Beranda Inventaris</h1>
            <p class="mt-1 text-sm text-slate-500">Lihat aset yang tercatat di lingkungan POLNEP.</p>
        </div>
    </x-slot>

    <div class="mx-auto max-w-7xl space-y-6 px-4 py-8 sm:px-6 lg:px-8">
        <section class="overflow-hidden rounded-2xl bg-slate-900 px-6 py-7 text-white shadow-sm sm:px-8">
            <div class="flex flex-col gap-6 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <p class="text-sm font-medium text-blue-200">Selamat datang</p>
                    <h2 class="mt-1 text-2xl font-bold">{{ Auth::user()->name }}</h2>
                    <p class="mt-2 max-w-2xl text-sm leading-6 text-slate-300">
                        Berikut daftar inventaris dan aset Politeknik Negeri Pontianak yang terdaftar di sistem.
                    </p>
                </div>
                <div class="flex w-fit items-center gap-3 rounded-xl border border-white/10 bg-white/5 px-4 py-3">
                    <span class="flex h-10 w-10 items-center justify-center rounded-lg bg-blue-500/20 text-lg font-bold text-blue-200" aria-hidden="true">#</span>
                    <span>
                        <span class="block text-xl font-bold text-white">{{ $assets->count() }}</span>
                        <span class="block text-xs text-slate-300">Aset terdaftar</span>
                    </span>
                </div>
            </div>
        </section>

        <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
            <div class="flex flex-col gap-1 border-b border-slate-100 px-5 py-5 sm:px-6">
                <h2 class="text-lg font-bold text-slate-900">Daftar inventaris</h2>
                <p class="text-sm text-slate-500">Informasi aset yang tersedia di sistem.</p>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-[760px] w-full text-left text-sm">
                    <thead class="bg-slate-50 text-xs font-semibold uppercase tracking-wide text-slate-500">
                        <tr>
                            <th class="px-5 py-3.5">Foto</th>
                            <th class="px-5 py-3.5">Kode aset</th>
                            <th class="px-5 py-3.5">Nama aset</th>
                            <th class="px-5 py-3.5">Kategori</th>
                            <th class="px-5 py-3.5">Lokasi</th>
                            <th class="px-5 py-3.5">Kondisi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-slate-600">
                        @forelse($assets as $asset)
                            <tr class="transition hover:bg-slate-50/80">
                                <td class="px-5 py-3">
                                    @if($asset->image)
                                        <img src="{{ asset('storage/' . $asset->image) }}" alt="Foto {{ $asset->name }}" class="h-12 w-12 rounded-lg object-cover ring-1 ring-slate-200">
                                    @else
                                        <span class="flex h-12 w-12 items-center justify-center rounded-lg bg-slate-100 text-[10px] font-medium text-slate-400">Tanpa foto</span>
                                    @endif
                                </td>
                                <td class="whitespace-nowrap px-5 py-3 font-semibold text-slate-800">{{ $asset->asset_code }}</td>
                                <td class="px-5 py-3 font-medium text-slate-800">{{ $asset->name }}</td>
                                <td class="px-5 py-3">{{ $asset->category->name ?? '-' }}</td>
                                <td class="px-5 py-3">
                                    <span class="block font-medium text-slate-700">{{ $asset->location->room_name ?? '-' }}</span>
                                    <span class="mt-0.5 block text-xs text-slate-500">{{ $asset->location->building ?? '' }}</span>
                                </td>
                                <td class="px-5 py-3">
                                    <span class="inline-flex whitespace-nowrap rounded-full px-2.5 py-1 text-xs font-semibold
                                        {{ $asset->condition === 'Baik' ? 'bg-emerald-50 text-emerald-700' : ($asset->condition === 'Rusak Ringan' ? 'bg-amber-50 text-amber-700' : 'bg-rose-50 text-rose-700') }}">
                                        {{ $asset->condition }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-14 text-center">
                                    <p class="font-semibold text-slate-700">Belum ada data aset</p>
                                    <p class="mt-1 text-sm text-slate-500">Data inventaris akan tampil di sini setelah tersedia.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>
    </div>
</x-app-layout>
