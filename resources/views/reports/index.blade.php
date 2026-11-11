<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Laporan & Filter Data Aset') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <!-- Form Filter -->
            <div class="p-6 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <form action="{{ route('reports.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div>
                        <x-input-label for="category_id" value="Kategori" />
                        <select name="category_id" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 
                        dark:text-gray-300 shadow-sm">
                            <option value="">-- Semua Kategori --</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <x-input-label for="location_id" value="Lokasi Ruangan" />
                        <select name="location_id" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 
                        dark:text-gray-300 shadow-sm">
                            <option value="">-- Semua Lokasi --</option>
                            @foreach($locations as $loc)
                                <option value="{{ $loc->id }}" {{ request('location_id') == $loc->id ? 'selected' : '' }}>{{ $loc->room_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <x-input-label for="condition" value="Kondisi" />
                        <select name="condition" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 
                        dark:text-gray-300 shadow-sm">
                            <option value="">-- Semua Kondisi --</option>
                            <option value="Baik" {{ request('condition') == 'Baik' ? 'selected' : '' }}>Baik</option>
                            <option value="Rusak Ringan" {{ request('condition') == 'Rusak Ringan' ? 'selected' : '' }}>Rusak Ringan</option>
                            <option value="Rusak Berat" {{ request('condition') == 'Rusak Berat' ? 'selected' : '' }}>Rusak Berat</option>
                        </select>
                    </div>

                    <div class="flex items-end space-x-2">
                        <button type="submit" class="px-4 py-2 bg-indigo-600 text-white font-semibold rounded-lg shadow hover:bg-indigo-700">Filter</button>
                        <a href="{{ route('reports.print', request()->query()) }}" target="_blank" class="px-4 py-2 bg-red-600 text-white 
                            font-semibold rounded-lg shadow hover:bg-red-700">
                            Cetak PDF / Print
                        </a>
                    </div>
                </form>
            </div>

            <!-- Hasil Tabel Laporan -->
            <div class="p-6 bg-white dark:bg-gray-800 shadow sm:rounded-lg overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th class="px-4 py-3">Kode Aset</th>
                            <th class="px-4 py-3">Nama Aset</th>
                            <th class="px-4 py-3">Kategori</th>
                            <th class="px-4 py-3">Lokasi</th>
                            <th class="px-4 py-3">Kondisi</th>
                            <th class="px-4 py-3">Tgl Pengadaan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($assets as $asset)
                            <tr class="border-b dark:border-gray-700">
                                <td class="px-4 py-3 font-bold text-gray-900 dark:text-gray-100">{{ $asset->asset_code }}</td>
                                <td class="px-4 py-3">{{ $asset->name }}</td>
                                <td class="px-4 py-3">{{ $asset->category->name ?? '-' }}</td>
                                <td class="px-4 py-3">{{ $asset->location->room_name ?? '-' }}</td>
                                <td class="px-4 py-3">{{ $asset->condition }}</td>
                                <td class="px-4 py-3">{{ $asset->purchase_date ? \Carbon\Carbon::parse($asset->purchase_date)->format('d M Y') : '-' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-4 text-center">Data tidak ditemukan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>