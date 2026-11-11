<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard SIM-ASET POLNEP') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <!-- Cards Ringkasan Aset -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow border-l-4 border-indigo-500">
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Aset</p>
                    <p class="text-2xl font-bold text-gray-900 dark:text-gray-100 mt-1">
                        {{ \App\Models\Asset::count() }}
                    </p>
                </div>

                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow border-l-4 border-green-500">
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Kondisi Baik</p>
                    <p class="text-2xl font-bold text-gray-900 dark:text-gray-100 mt-1">
                        {{ \App\Models\Asset::where('condition', 'Baik')->count() }}
                    </p>
                </div>

                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow border-l-4 border-yellow-500">
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Rusak Ringan</p>
                    <p class="text-2xl font-bold text-gray-900 dark:text-gray-100 mt-1">
                        {{ \App\Models\Asset::where('condition', 'Rusak Ringan')->count() }}
                    </p>
                </div>

                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow border-l-4 border-red-500">
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Rusak Berat</p>
                    <p class="text-2xl font-bold text-gray-900 dark:text-gray-100 mt-1">
                        {{ \App\Models\Asset::where('condition', 'Rusak Berat')->count() }}
                    </p>
                </div>
            </div>

            <!-- Quick Action Links -->
            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
                <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100 mb-4">Navigasi Cepat Pengelolaan Aset</h3>
                <div class="flex flex-wrap gap-4">
                    <a href="{{ route('assets.create') }}" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-lg shadow">
                        + Tambah Data Aset
                    </a>
                    <a href="{{ route('assets.index') }}" class="px-4 py-2 bg-gray-700 hover:bg-gray-800 text-white font-semibold rounded-lg shadow">
                        Lihat Semua Aset
                    </a>
                    <a href="{{ route('categories.index') }}" class="px-4 py-2 bg-gray-700 hover:bg-gray-800 text-white font-semibold rounded-lg shadow">
                        Kelola Kategori
                    </a>
                    <a href="{{ route('locations.index') }}" class="px-4 py-2 bg-gray-700 hover:bg-gray-800 text-white font-semibold rounded-lg shadow">
                        Kelola Lokasi Ruangan
                    </a>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>