<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Tiket Pelaporan Kerusakan Aset') }}
            </h2>
            @if(Auth::user()->role === 'user')
                <a href="{{ route('tickets.create') }}" class="px-4 py-2 bg-red-600 text-white font-semibold rounded-lg shadow hover:bg-red-700">
                    + Laporkan Kerusakan
                </a>
            @endif
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
                            <th class="px-4 py-3">Tgl Lapor</th>
                            <th class="px-4 py-3">Kode & Nama Aset</th>
                            <th class="px-4 py-3">Pelapor</th>
                            <th class="px-4 py-3">Deskripsi Masalah</th>
                            <th class="px-4 py-3">Status Penanganan</th>
                            @if(Auth::user()->role === 'admin')
                                <th class="px-4 py-3">Aksi Admin</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($reports as $ticket)
                            <tr class="border-b dark:border-gray-700">
                                <td class="px-4 py-3">{{ $ticket->created_at->format('d M Y H:i') }}</td>
                                <td class="px-4 py-3 font-bold text-gray-900 dark:text-gray-100">
                                    {{ $ticket->asset->asset_code }} - {{ $ticket->asset->name }}
                                </td>
                                <td class="px-4 py-3">{{ $ticket->user->name }}</td>
                                <td class="px-4 py-3">{{ $ticket->issue_description }}</td>
                                <td class="px-4 py-3">
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full 
                                        {{ $ticket->status == 'Pending' ? 'bg-red-100 text-red-800' : ($ticket->status == 'Sedang Diperbaiki' ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800') }}">
                                        {{ $ticket->status }}
                                    </span>
                                </td>
                                @if(Auth::user()->role === 'admin')
                                    <td class="px-4 py-3">
                                        <form action="{{ route('tickets.updateStatus', $ticket->id) }}" method="POST" class="flex gap-2">
                                            @csrf
                                            @method('PATCH')
                                            <select name="status" onchange="this.form.submit()" class="text-xs rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300">
                                                <option value="Pending" {{ $ticket->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                                <option value="Sedang Diperbaiki" {{ $ticket->status == 'Sedang Diperbaiki' ? 'selected' : '' }}>Sedang Diperbaiki</option>
                                                <option value="Selesai" {{ $ticket->status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                                            </select>
                                        </form>
                                    </td>
                                @endif
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-4 text-center">Belum ada tiket pelaporan kerusakan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>