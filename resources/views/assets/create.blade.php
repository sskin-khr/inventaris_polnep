<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tambah Aset Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="p-6 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <form action="{{ route('assets.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    <div>
                        <x-input-label for="asset_code" value="Kode Aset (Unik)" />
                        <x-text-input id="asset_code" name="asset_code" type="text" class="mt-1 block w-full" placeholder="POLNEP/TIK/2026/001" required />
                    </div>

                    <div>
                        <x-input-label for="name" value="Nama Barang / Aset" />
                        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" placeholder="PC Workstation Lab 2" required />
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <x-input-label for="category_id" value="Kategori Aset" />
                            <select id="category_id" name="category_id" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 
                            dark:bg-gray-900 dark:text-gray-300 shadow-sm" required>
                                <option value="">-- Pilih Kategori --</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->name }} ({{ $cat->code }})</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <x-input-label for="location_id" value="Lokasi / Ruangan" />
                            <select id="location_id" name="location_id" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 
                            dark:bg-gray-900 dark:text-gray-300 shadow-sm" required>
                                <option value="">-- Pilih Lokasi --</option>
                                @foreach($locations as $loc)
                                    <option value="{{ $loc->id }}">{{ $loc->room_name }} - {{ $loc->building }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <x-input-label for="condition" value="Kondisi Aset" />
                            <select id="condition" name="condition" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 
                            dark:bg-gray-900 dark:text-gray-300 shadow-sm" required>
                                <option value="Baik">Baik</option>
                                <option value="Rusak Ringan">Rusak Ringan</option>
                                <option value="Rusak Berat">Rusak Berat</option>
                            </select>
                        </div>

                        <div>
                            <x-input-label for="purchase_date" value="Tanggal Perolehan / Pengadaan" />
                            <x-text-input id="purchase_date" name="purchase_date" type="date" class="mt-1 block w-full" />
                        </div>
                    </div>

                    <div>
                        <x-input-label for="image" value="Foto Aset (Opsional)" />
                        <input id="image" name="image" type="file" class="mt-1 block w-full text-sm text-gray-500 dark:text-gray-400">
                    </div>

                    <div class="flex justify-end space-x-2 pt-4">
                        <a href="{{ route('assets.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded-lg">Batal</a>
                        <x-primary-button>Simpan Data Aset</x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>