<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Buat Laporan Kerusakan Aset') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="p-6 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <form action="{{ route('tickets.store') }}" method="POST" class="space-y-4">
                    @csrf

                    <div>
                        <x-input-label for="asset_id" value="Pilih Perangkat / Aset yang Rusak" />
                        <select id="asset_id" name="asset_id" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 
                        dark:text-gray-300 shadow-sm" required>
                            <option value="">-- Pilih Perangkat --</option>
                            @foreach($assets as $asset)
                                <option value="{{ $asset->id }}">
                                    {{ $asset->asset_code }} - {{ $asset->name }} (Lokasi: {{ $asset->location->room_name ?? '-' }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <x-input-label for="issue_description" value="Deskripsi Kendala / Kerusakan" />
                        <textarea id="issue_description" name="issue_description" rows="4" class="mt-1 block w-full rounded-md border-gray-300 
                        dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 shadow-sm" placeholder="Jelaskan secara detail kerusakan yang terjadi..." 
                        required></textarea>
                    </div>

                    <div class="flex justify-end space-x-2 pt-4">
                        <a href="{{ route('tickets.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded-lg">Batal</a>
                        <x-primary-button class="bg-red-600 hover:bg-red-700">Kirim Laporan Kerusakan</x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>