<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="text-xs font-semibold uppercase tracking-[0.18em] text-blue-700">Inventaris POLNEP</p>
            <h1 class="mt-1 text-2xl font-bold tracking-tight text-slate-900">{{ __('Laporan aset') }}</h1>
            <p class="mt-1 text-sm text-slate-500">Saring data aset berdasarkan kategori, lokasi, dan kondisi.</p>
        </div>
    </x-slot>

    <div class="mx-auto max-w-7xl space-y-5 px-4 py-8 sm:px-6 lg:px-8">
            <section class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm sm:p-6">
                <form action="{{ route('reports.index') }}" method="GET" class="grid grid-cols-1 items-end gap-4 md:grid-cols-2 xl:grid-cols-4">
                    <div>
                        <x-input-label for="category_id" value="Kategori" />
                        <select id="category_id" name="category_id" class="mt-1 block w-full rounded-xl border-slate-300 text-sm shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            <option value="">-- Semua Kategori --</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <x-input-label for="location_id" value="Lokasi Ruangan" />
                        <select id="location_id" name="location_id" class="mt-1 block w-full rounded-xl border-slate-300 text-sm shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            <option value="">-- Semua Lokasi --</option>
                            @foreach($locations as $loc)
                                <option value="{{ $loc->id }}" {{ request('location_id') == $loc->id ? 'selected' : '' }}>{{ $loc->room_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <x-input-label for="condition" value="Kondisi" />
                        <select id="condition" name="condition" class="mt-1 block w-full rounded-xl border-slate-300 text-sm shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            <option value="">-- Semua Kondisi --</option>
                            <option value="Baik" {{ request('condition') == 'Baik' ? 'selected' : '' }}>Baik</option>
                            <option value="Rusak Ringan" {{ request('condition') == 'Rusak Ringan' ? 'selected' : '' }}>Rusak Ringan</option>
                            <option value="Rusak Berat" {{ request('condition') == 'Rusak Berat' ? 'selected' : '' }}>Rusak Berat</option>
                        </select>
                    </div>

                    <div class="flex flex-wrap items-center gap-2">
                        <button type="submit" class="inline-flex items-center justify-center rounded-xl bg-blue-700 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-800">Terapkan filter</button>
                        <a href="{{ route('reports.print', request()->query()) }}" target="_blank" rel="noopener" class="inline-flex items-center justify-center rounded-xl border border-slate-300 px-4 py-2.5 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">
                            Cetak laporan
                        </a>
                    </div>
                </form>
            </section>

            <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
                <div class="border-b border-slate-100 px-5 py-5 sm:px-6">
                    <h2 class="text-lg font-bold text-slate-900">Hasil laporan</h2>
                    <p class="mt-1 text-sm text-slate-500">{{ $assets->count() }} aset sesuai kriteria.</p>
                </div>
                <div class="overflow-x-auto">
                <table class="min-w-[820px] w-full text-left text-sm">
                    <thead class="bg-slate-50 text-xs font-semibold uppercase tracking-wide text-slate-500">
                        <tr>
                            <th class="px-5 py-3.5">Kode aset</th>
                            <th class="px-5 py-3.5">Nama aset</th>
                            <th class="px-5 py-3.5">Kategori</th>
                            <th class="px-5 py-3.5">Lokasi</th>
                            <th class="px-5 py-3.5">Kondisi</th>
                            <th class="px-5 py-3.5">Tanggal pengadaan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-slate-600">
                        @forelse($assets as $asset)
                            <tr class="transition hover:bg-slate-50/80">
                                <td class="whitespace-nowrap px-5 py-4 font-semibold text-slate-800">{{ $asset->asset_code }}</td>
                                <td class="px-5 py-4 font-medium text-slate-700">{{ $asset->name }}</td>
                                <td class="px-5 py-4">{{ $asset->category->name ?? '-' }}</td>
                                <td class="px-5 py-4">{{ $asset->location->room_name ?? '-' }}</td>
                                <td class="px-5 py-4">{{ $asset->condition }}</td>
                                <td class="whitespace-nowrap px-5 py-4">{{ $asset->purchase_date ? \Carbon\Carbon::parse($asset->purchase_date)->format('d M Y') : '-' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center text-slate-500">Tidak ada data yang sesuai dengan filter.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                </div>
            </section>
    </div>
</x-app-layout>