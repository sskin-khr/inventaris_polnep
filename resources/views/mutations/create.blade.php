<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="text-xs font-semibold uppercase tracking-[0.18em] text-blue-700">Inventaris POLNEP</p>
            <h1 class="mt-1 text-2xl font-bold tracking-tight text-slate-900">{{ __('Pemindahan aset') }}</h1>
            <p class="mt-1 text-sm text-slate-500">Catat lokasi baru untuk aset yang dipindahkan.</p>
        </div>
    </x-slot>

    <div class="mx-auto max-w-4xl px-4 py-8 sm:px-6 lg:px-8">
        <section class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm sm:p-8">
                <form action="{{ route('mutations.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <div>
                        <x-input-label for="asset_id" value="Pilih Aset yang Akan Dipindahkan" />
                        <select id="asset_id" name="asset_id" class="mt-1 block w-full rounded-xl border-slate-300 text-sm shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                            <option value="">-- Pilih Aset --</option>
                            @foreach($assets as $asset)
                                <option value="{{ $asset->id }}" @selected(old('asset_id') == $asset->id)>
                                    {{ $asset->asset_code }} - {{ $asset->name }} (Lokasi Sekarang: {{ $asset->location->room_name ?? 'Belum ada' }})
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('asset_id')" class="mt-2" />
                    </div>

                    <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                        <div>
                            <x-input-label for="to_location_id" value="Lokasi Ruangan Baru" />
                            <select id="to_location_id" name="to_location_id" class="mt-1 block w-full rounded-xl border-slate-300 text-sm shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                                <option value="">-- Pilih Lokasi Baru --</option>
                                @foreach($locations as $loc)
                                    <option value="{{ $loc->id }}" @selected(old('to_location_id') == $loc->id)>{{ $loc->room_name }} - {{ $loc->building }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('to_location_id')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="mutation_date" value="Tanggal Pemindahan" />
                            <x-text-input id="mutation_date" name="mutation_date" type="date" class="mt-1 block w-full" :value="old('mutation_date', date('Y-m-d'))" required />
                            <x-input-error :messages="$errors->get('mutation_date')" class="mt-2" />
                        </div>
                    </div>

                    <div>
                        <x-input-label for="notes" value="Alasan / Catatan Pemindahan" />
                        <textarea id="notes" name="notes" rows="3" class="mt-1 block w-full rounded-xl border-slate-300 text-sm shadow-sm placeholder:text-slate-400 focus:border-blue-500 focus:ring-blue-500" placeholder="Contoh: Pemindahan unit untuk perawatan rutin">{{ old('notes') }}</textarea>
                        <x-input-error :messages="$errors->get('notes')" class="mt-2" />
                    </div>

                    <div class="flex flex-col-reverse justify-end gap-3 border-t border-slate-100 pt-5 sm:flex-row">
                        <a href="{{ route('mutations.index') }}" class="inline-flex items-center justify-center rounded-xl border border-slate-300 px-4 py-2.5 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">Batal</a>
                        <x-primary-button>Simpan Mutasi</x-primary-button>
                    </div>
                </form>
        </section>
    </div>
</x-app-layout>