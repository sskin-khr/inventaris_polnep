<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Manajemen Lokasi / Ruangan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @if(session('success'))
                <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Form Tambah Ruangan (Hanya Tampil untuk Admin) -->
            @if(Auth::user()->role === 'admin')
                <div class="p-6 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100 mb-4">Tambah Ruangan Baru</h3>
                    <form action="{{ route('locations.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        @csrf
                        <div>
                            <x-input-label for="room_name" value="Nama Ruangan (misal: Lab Komputer 1)" />
                            <x-text-input id="room_name" name="room_name" type="text" class="mt-1 block w-full" required />
                        </div>
                        <div>
                            <x-input-label for="building" value="Gedung / Unit (misal: Gedung UPA TIK)" />
                            <x-text-input id="building" name="building" type="text" class="mt-1 block w-full" required />
                        </div>
                        <div class="flex items-end">
                            <x-primary-button>Simpan Ruangan</x-primary-button>
                        </div>
                    </form>
                </div>
            @endif

            <!-- Tabel Daftar Ruangan/Lokasi -->
            <div class="p-6 bg-white dark:bg-gray-800 shadow sm:rounded-lg overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th class="px-6 py-3">No</th>
                            <th class="px-6 py-3">Nama Ruangan</th>
                            <th class="px-6 py-3">Gedung</th>
                            @if(Auth::user()->role === 'admin')
                                <th class="px-6 py-3">Aksi</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($locations as $index => $loc)
                            <tr class="border-b dark:border-gray-700">
                                <td class="px-6 py-4">{{ $index + 1 }}</td>
                                <td class="px-6 py-4 font-bold text-gray-900 dark:text-gray-100">{{ $loc->room_name }}</td>
                                <td class="px-6 py-4">{{ $loc->building }}</td>
                                @if(Auth::user()->role === 'admin')
                                    <td class="px-6 py-4">
                                        <form action="{{ route('locations.destroy', $loc->id) }}" method="POST" onsubmit="return confirm('Yakin hapus data ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                                        </form>
                                    </td>
                                @endif
                            </tr>
                        @empty
                            <tr>
                                <td colspan="{{ Auth::user()->role === 'admin' ? '4' : '3' }}" class="px-6 py-4 text-center">Belum ada data lokasi.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>