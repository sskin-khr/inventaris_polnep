<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <p class="text-xs font-semibold uppercase tracking-[0.18em] text-blue-700">Layanan aset</p>
                <h1 class="mt-1 text-2xl font-bold tracking-tight text-slate-900">{{ __('Laporan kerusakan') }}</h1>
                <p class="mt-1 text-sm text-slate-500">Daftar laporan dan status penanganan.</p>
            </div>
            @if(Auth::user()->role === 'user')
                <a href="{{ route('tickets.create') }}" class="inline-flex items-center justify-center gap-2 rounded-xl bg-blue-700 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-800">
                    <span aria-hidden="true">+</span> Buat laporan
                </a>
            @endif
        </div>
    </x-slot>

    <div class="mx-auto max-w-7xl space-y-5 px-4 py-8 sm:px-6 lg:px-8">
            @if(session('success'))
                <div role="status" class="rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-800">
                    {{ session('success') }}
                </div>
            @endif

            <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
                <div class="border-b border-slate-100 px-5 py-5 sm:px-6">
                    <h2 class="text-lg font-bold text-slate-900">Daftar tiket</h2>
                    <p class="mt-1 text-sm text-slate-500">{{ $reports->count() }} laporan tercatat.</p>
                </div>
                <div class="overflow-x-auto">
                <table class="min-w-[900px] w-full text-left text-sm">
                    <thead class="bg-slate-50 text-xs font-semibold uppercase tracking-wide text-slate-500">
                        <tr>
                            <th class="px-5 py-3.5">Tanggal</th>
                            <th class="px-5 py-3.5">Aset</th>
                            <th class="px-5 py-3.5">Pelapor</th>
                            <th class="px-5 py-3.5">Deskripsi</th>
                            <th class="px-5 py-3.5">Status</th>
                            @if(Auth::user()->role === 'admin')
                                <th class="px-5 py-3.5">Ubah status</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-slate-600">
                        @forelse($reports as $ticket)
                            <tr class="transition hover:bg-slate-50/80">
                                <td class="whitespace-nowrap px-5 py-4">{{ $ticket->created_at->format('d M Y H:i') }}</td>
                                <td class="px-5 py-4">
                                    <span class="block font-semibold text-slate-800">{{ $ticket->asset->asset_code }}</span>
                                    <span class="mt-0.5 block text-xs text-slate-500">{{ $ticket->asset->name }}</span>
                                </td>
                                <td class="px-5 py-4">{{ $ticket->user->name }}</td>
                                <td class="max-w-sm px-5 py-4">{{ $ticket->issue_description }}</td>
                                <td class="px-5 py-4">
                                    <span class="inline-flex whitespace-nowrap rounded-full px-2.5 py-1 text-xs font-semibold
                                        {{ $ticket->status == 'Pending' ? 'bg-rose-50 text-rose-700' : ($ticket->status == 'Sedang Diperbaiki' ? 'bg-amber-50 text-amber-700' : 'bg-emerald-50 text-emerald-700') }}">
                                        {{ $ticket->status }}
                                    </span>
                                </td>
                                @if(Auth::user()->role === 'admin')
                                    <td class="px-5 py-4">
                                        <form action="{{ route('tickets.updateStatus', $ticket->id) }}" method="POST" class="flex gap-2">
                                            @csrf
                                            @method('PATCH')
                                            <select aria-label="Status laporan {{ $ticket->asset->asset_code }}" name="status" onchange="this.form.submit()" class="rounded-lg border-slate-300 text-xs shadow-sm focus:border-blue-500 focus:ring-blue-500">
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
                                <td colspan="{{ Auth::user()->role === 'admin' ? 6 : 5 }}" class="px-6 py-12 text-center text-slate-500">Belum ada tiket pelaporan kerusakan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                </div>
            </section>
    </div>
</x-app-layout>