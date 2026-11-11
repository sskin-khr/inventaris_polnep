<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Riwayat Mutasi & Pemindahan Aset') }}
            </h2>
            <a href="{{ route('mutations.create') }}" class="px-4 py-2 bg-indigo-600 text-white font-semibold rounded-lg shadow hover:bg-indigo-700">
                + Pemindahan Aset Baru
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @if(session('success'))
                <div class="p-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400">
                    {{ session('success') }}
                </div>
            @endif

            <div class="p-6 bg-white dark:bg-gray-800 shadow sm:rounded-lg overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th class="px-4 py-3">Tanggal</th>
                            <th class="px-4 py-3">Kode & Nama Aset</th>
                            <th class="px-4 py-3">Dari Ruangan</th>
                            <th class="px-4 py-3">Ke Ruangan</th>
                            <th class="px-4 py-3">Petugas (PIC)</th>
                            <th class="px-4 py-3">Catatan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($mutations as $m)
                            <tr class="border-b dark:border-gray-700">
                                <td class="px-4 py-3 font-medium">{{ \Carbon\Carbon::parse($m->mutation_date)->format('d M Y') }}</td>
                                <td class="px-4 py-3 font-bold text-gray-900 dark:text-gray-100">
                                    {{ $m->asset->asset_code }} - {{ $m->asset->name }}
                                </td>
                                <td class="px-4 py-3 text-red-600 font-semibold">{{ $m->fromLocation->room_name ?? '-' }}</td>
                                <td class="px-4 py-3 text-green-600 font-semibold">{{ $m->toLocation->room_name ?? '-' }}</td>
                                <td class="px-4 py-3">{{ $m->user->name ?? '-' }}</td>
                                <td class="px-4 py-3">{{ $m->notes ?? '-' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-4 text-center">Belum ada riwayat mutasi aset.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>