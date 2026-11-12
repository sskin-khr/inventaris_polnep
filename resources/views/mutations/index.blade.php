<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <p class="text-xs font-semibold uppercase tracking-[0.18em] text-blue-700">Inventaris POLNEP</p>
                <h1 class="mt-1 text-2xl font-bold tracking-tight text-slate-900">{{ __('Riwayat mutasi') }}</h1>
                <p class="mt-1 text-sm text-slate-500">Pantau perpindahan aset antar lokasi.</p>
            </div>
            <a href="{{ route('mutations.create') }}" class="inline-flex items-center justify-center gap-2 rounded-xl bg-blue-700 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-800">
                <span aria-hidden="true">+</span> Pemindahan aset
            </a>
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
                    <h2 class="text-lg font-bold text-slate-900">Aktivitas pemindahan</h2>
                    <p class="mt-1 text-sm text-slate-500">{{ $mutations->count() }} riwayat mutasi.</p>
                </div>
                <div class="overflow-x-auto">
                <table class="min-w-[900px] w-full text-left text-sm">
                    <thead class="bg-slate-50 text-xs font-semibold uppercase tracking-wide text-slate-500">
                        <tr>
                            <th class="px-5 py-3.5">Tanggal</th>
                            <th class="px-5 py-3.5">Aset</th>
                            <th class="px-5 py-3.5">Dari</th>
                            <th class="px-5 py-3.5">Ke</th>
                            <th class="px-5 py-3.5">Petugas</th>
                            <th class="px-5 py-3.5">Catatan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-slate-600">
                        @forelse($mutations as $m)
                            <tr class="transition hover:bg-slate-50/80">
                                <td class="whitespace-nowrap px-5 py-4 font-medium text-slate-700">{{ \Carbon\Carbon::parse($m->mutation_date)->format('d M Y') }}</td>
                                <td class="px-5 py-4">
                                    <span class="block font-semibold text-slate-800">{{ $m->asset->asset_code }}</span>
                                    <span class="mt-0.5 block text-xs text-slate-500">{{ $m->asset->name }}</span>
                                </td>
                                <td class="px-5 py-4 text-slate-600">{{ $m->fromLocation->room_name ?? '-' }}</td>
                                <td class="px-5 py-4 font-medium text-slate-800">{{ $m->toLocation->room_name ?? '-' }}</td>
                                <td class="px-5 py-4">{{ $m->user->name ?? '-' }}</td>
                                <td class="max-w-xs px-5 py-4">{{ $m->notes ?? '-' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center text-slate-500">Belum ada riwayat mutasi aset.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                </div>
            </section>
    </div>
</x-app-layout>