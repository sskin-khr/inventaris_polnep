<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Form Pemindahan Aset') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="p-6 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <form action="{{ route('mutations.store') }}" method="POST" class="space-y-4">
                    @csrf

                    <div>
                        <x-input-label for="asset_id" value="Pilih Aset yang Akan Dipindahkan" />
                        <select id="asset_id" name="asset_id" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 shadow-sm" required>
                            <option value="">-- Pilih Aset --</option>
                            @foreach($assets as $asset)
                                <option value="{{ $asset->id }}">
                                    {{ $asset->asset_code }} - {{ $asset->name }} (Lokasi Sekarang: {{ $asset->location->room_name ?? 'Belum ada' }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <x-input-label for="to_location_id" value="Lokasi Ruangan Baru" />
                            <select id="to_location_id" name="to_location_id" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 shadow-sm" required>
                                <option value="">-- Pilih Lokasi Baru --</option>
                                @foreach($locations as $loc)
                                    <option value="{{ $loc->id }}">{{ $loc->room_name }} - {{ $loc->building }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <x-input-label for="mutation_date" value="Tanggal Pemindahan" />
                            <x-text-input id="mutation_date" name="mutation_date" type="date" class="mt-1 block w-full" value="{{ date('Y-m-d') }}" required />
                        </div>
                    </div>

                    <div>
                        <x-input-label for="notes" value="Alasan / Catatan Pemindahan" />
                        <textarea id="notes" name="notes" rows="3" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 shadow-sm" placeholder="Contoh: Pemindahan unit untuk perawatan rutin"></textarea>
                    </div>

                    <div class="flex justify-end space-x-2 pt-4">
                        <a href="{{ route('mutations.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded-lg">Batal</a>
                        <x-primary-button>Simpan Mutasi</x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>