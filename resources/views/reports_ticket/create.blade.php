<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="text-xs font-semibold uppercase tracking-[0.18em] text-blue-700">Layanan aset</p>
            <h1 class="mt-1 text-2xl font-bold tracking-tight text-slate-900">{{ __('Laporkan kerusakan') }}</h1>
            <p class="mt-1 text-sm text-slate-500">Jelaskan kendala agar dapat ditindaklanjuti petugas.</p>
        </div>
    </x-slot>

    <div class="mx-auto max-w-4xl px-4 py-8 sm:px-6 lg:px-8">
        <section class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm sm:p-8">
                <form action="{{ route('tickets.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <div>
                        <x-input-label for="asset_id" value="Pilih Perangkat / Aset yang Rusak" />
                        <select id="asset_id" name="asset_id" class="mt-1 block w-full rounded-xl border-slate-300 text-sm shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                            <option value="">-- Pilih Perangkat --</option>
                            @foreach($assets as $asset)
                                <option value="{{ $asset->id }}" @selected(old('asset_id') == $asset->id)>
                                    {{ $asset->asset_code }} - {{ $asset->name }} (Lokasi: {{ $asset->location->room_name ?? '-' }})
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('asset_id')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="issue_description" value="Deskripsi Kendala / Kerusakan" />
                        <textarea id="issue_description" name="issue_description" rows="5" class="mt-1 block w-full rounded-xl border-slate-300 text-sm shadow-sm placeholder:text-slate-400 focus:border-blue-500 focus:ring-blue-500" placeholder="Jelaskan kendala atau kerusakan yang terjadi..." required>{{ old('issue_description') }}</textarea>
                        <x-input-error :messages="$errors->get('issue_description')" class="mt-2" />
                    </div>

                    <div class="flex flex-col-reverse justify-end gap-3 border-t border-slate-100 pt-5 sm:flex-row">
                        <a href="{{ route('tickets.index') }}" class="inline-flex items-center justify-center rounded-xl border border-slate-300 px-4 py-2.5 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">Batal</a>
                        <x-primary-button>Kirim laporan</x-primary-button>
                    </div>
                </form>
        </section>
    </div>
</x-app-layout>