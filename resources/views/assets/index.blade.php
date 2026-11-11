<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Daftar Aset POLNEP') }}
            </h2>
            <a href="{{ route('assets.create') }}" class="px-4 py-2 bg-indigo-600 text-white font-semibold rounded-lg shadow-md hover:bg-indigo-700">
                + Tambah Aset Baru
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @if(session('success'))
                <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400">
                    {{ session('success') }}
                </div>
            @endif

            <div class="p-6 bg-white dark:bg-gray-800 shadow sm:rounded-lg overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th class="px-4 py-3">Foto</th>
                            <th class="px-4 py-3">Kode Aset</th>
                            <th class="px-4 py-3">Nama Aset</th>
                            <th class="px-4 py-3">Kategori</th>
                            <th class="px-4 py-3">Lokasi</th>
                            <th class="px-4 py-3">Kondisi</th>
                            <th class="px-4 py-3">Aksi</th>
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
                                        {{ $asset->condition == 'Baik' ? 'bg-green-100 text-green-800' : 
                                        ($asset->condition == 'Rusak Ringan' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                        {{ $asset->condition }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 space-x-2">
                                    <a href="{{ route('assets.edit', $asset->id) }}" class="text-blue-600 hover:underline">Edit</a>
                                    <form action="{{ route('assets.destroy', $asset->id) }}" method="POST" class="inline" 
                                        onsubmit="return confirm('Hapus aset ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-4 text-center">Belum ada data aset tercatat.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>