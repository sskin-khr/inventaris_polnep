<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="text-xs font-semibold uppercase tracking-[0.18em] text-blue-700">Inventaris POLNEP</p>
            <h1 class="mt-1 text-2xl font-bold tracking-tight text-slate-900">{{ __('Tambah aset baru') }}</h1>
            <p class="mt-1 text-sm text-slate-500">Lengkapi informasi aset yang akan didaftarkan.</p>
        </div>
    </x-slot>

    <div class="mx-auto max-w-4xl px-4 py-8 sm:px-6 lg:px-8">
        <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm sm:p-8">
                <form action="{{ route('assets.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    <div>
                        <x-input-label for="asset_code" value="Kode Aset (Unik)" />
                        <x-text-input id="asset_code" name="asset_code" type="text" class="mt-1 block w-full" placeholder="POLNEP/TIK/2026/001" :value="old('asset_code')" required />
                        <x-input-error :messages="$errors->get('asset_code')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="name" value="Nama Barang / Aset" />
                        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" placeholder="PC Workstation Lab 2" :value="old('name')" required />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                        <div>
                            <x-input-label for="category_id" value="Kategori Aset" />
                            <select id="category_id" name="category_id" class="mt-1 block w-full rounded-xl border-slate-300 text-sm shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                                <option value="">-- Pilih Kategori --</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}" @selected(old('category_id') == $cat->id)>{{ $cat->name }} ({{ $cat->code }})</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="location_id" value="Lokasi / Ruangan" />
                            <select id="location_id" name="location_id" class="mt-1 block w-full rounded-xl border-slate-300 text-sm shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                                <option value="">-- Pilih Lokasi --</option>
                                @foreach($locations as $loc)
                                    <option value="{{ $loc->id }}" @selected(old('location_id') == $loc->id)>{{ $loc->room_name }} - {{ $loc->building }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('location_id')" class="mt-2" />
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                        <div>
                            <x-input-label for="condition" value="Kondisi Aset" />
                            <select id="condition" name="condition" class="mt-1 block w-full rounded-xl border-slate-300 text-sm shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                                <option value="Baik" @selected(old('condition', 'Baik') === 'Baik')>Baik</option>
                                <option value="Rusak Ringan" @selected(old('condition') === 'Rusak Ringan')>Rusak Ringan</option>
                                <option value="Rusak Berat" @selected(old('condition') === 'Rusak Berat')>Rusak Berat</option>
                            </select>
                            <x-input-error :messages="$errors->get('condition')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="purchase_date" value="Tanggal Perolehan / Pengadaan" />
                            <x-text-input id="purchase_date" name="purchase_date" type="date" class="mt-1 block w-full" :value="old('purchase_date')" />
                            <x-input-error :messages="$errors->get('purchase_date')" class="mt-2" />
                        </div>
                    </div>

                    <div>
                        <x-input-label for="image" value="Foto Aset (Opsional)" />
                        <input id="image" name="image" type="file" accept="image/*" class="mt-1 block w-full rounded-xl border border-slate-300 bg-white text-sm text-slate-600 file:mr-4 file:rounded-lg file:border-0 file:bg-blue-50 file:px-4 file:py-2.5 file:font-semibold file:text-blue-700 hover:file:bg-blue-100">
                        <x-input-error :messages="$errors->get('image')" class="mt-2" />
                    </div>

                    <div class="flex flex-col-reverse justify-end gap-3 border-t border-slate-100 pt-5 sm:flex-row">
                        <a href="{{ route('assets.index') }}" class="inline-flex items-center justify-center rounded-xl border border-slate-300 px-4 py-2.5 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">Batal</a>
                        <x-primary-button>Simpan Data Aset</x-primary-button>
                    </div>
                </form>
        </div>
    </div>
</x-app-layout>