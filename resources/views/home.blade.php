<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Beranda - Katalog Aset POLNEP') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <!-- Banner Selamat Datang -->
            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm text-gray-900 dark:text-gray-100">
                <h3 class="text-lg font-bold">Selamat datang, {{ Auth::user()->name }}!</h3>
                <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                    Berikut adalah daftar inventaris dan aset POLNEP yang terdaftar di sistem.
                </p>
            </div>

            <!-- Tabel Daftar Aset (Read-Only untuk Staf/User) -->
            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm overflow-x-auto">
                <h4 class="text-base font-semibold text-gray-800 dark:text-gray-200 mb-4">Daftar Inventaris Terdaftar</h4>
                
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th class="px-4 py-3">Foto</th>
                            <th class="px-4 py-3">Kode Aset</th>
                            <th class="px-4 py-3">Nama Aset</th>
                            <th class="px-4 py-3">Kategori</th>
                            <th class="px-4 py-3">Lokasi / Ruangan</th>
                            <th class="px-4 py-3">Kondisi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($assets as $asset)
                            <tr class="border-b dark:border-gray-700">
                                <td class="px-4 py-3">
                                    @if($asset->image)
                                        <img src="{{ asset('storage/' . $asset->image) }}" class="w-12 h-12 object-cover rounded-lg">
                                    @else
                                        <span class="text-xs text-gray-400">No Image</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 font-bold text-gray-900 dark:text-gray-100">{{ $asset->asset_code }}</td>
                                <td class="px-4 py-3 font-medium text-gray-900 dark:text-gray-100">{{ $asset->name }}</td>
                                <td class="px-4 py-3">{{ $asset->category->name ?? '-' }}</td>
                                <td class="px-4 py-3">{{ $asset->location->room_name ?? '-' }} ({{ $asset->location->building ?? '' }})</td>
                                <td class="px-4 py-3">
                                    <span class="px-2 py-1 text-xs rounded-full 
                                        {{ $asset->condition == 'Baik' ? 'bg-green-100 text-green-800' : ($asset->condition == 'Rusak Ringan' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                        {{ $asset->condition }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-4 text-center">Belum ada data aset tercatat.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>