<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="text-xs font-semibold uppercase tracking-[0.18em] text-blue-700">Data master</p>
            <h1 class="mt-1 text-2xl font-bold tracking-tight text-slate-900">{{ __('Lokasi dan ruangan') }}</h1>
            <p class="mt-1 text-sm text-slate-500">Kelola lokasi penempatan aset POLNEP.</p>
        </div>
    </x-slot>

    <div class="mx-auto max-w-7xl space-y-5 px-4 py-8 sm:px-6 lg:px-8">
            @if(session('success'))
                <div role="status" class="rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-800">
                    {{ session('success') }}
                </div>
            @endif

            @if(Auth::user()->role === 'admin')
                <section class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm sm:p-6">
                    <div class="mb-5">
                        <h2 class="text-base font-bold text-slate-900">Tambah ruangan</h2>
                        <p class="mt-1 text-sm text-slate-500">Masukkan nama ruangan dan gedung atau unit.</p>
                    </div>
                    <form action="{{ route('locations.store') }}" method="POST" class="grid grid-cols-1 items-end gap-4 md:grid-cols-[1fr_1fr_auto]">
                        @csrf
                        <div>
                            <x-input-label for="room_name" value="Nama Ruangan (misal: Lab Komputer 1)" />
                            <x-text-input id="room_name" name="room_name" type="text" class="mt-1 block w-full" :value="old('room_name')" required />
                            <x-input-error :messages="$errors->get('room_name')" class="mt-2" />
                        </div>
                        <div>
                            <x-input-label for="building" value="Gedung / Unit (misal: Gedung UPA TIK)" />
                            <x-text-input id="building" name="building" type="text" class="mt-1 block w-full" :value="old('building')" required />
                            <x-input-error :messages="$errors->get('building')" class="mt-2" />
                        </div>
                        <div class="flex">
                            <x-primary-button>Simpan Ruangan</x-primary-button>
                        </div>
                    </form>
                </section>
            @endif

            <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
                <div class="border-b border-slate-100 px-5 py-5 sm:px-6">
                    <h2 class="text-lg font-bold text-slate-900">Daftar lokasi</h2>
                    <p class="mt-1 text-sm text-slate-500">{{ $locations->count() }} lokasi terdaftar.</p>
                </div>
                <div class="overflow-x-auto">
                <table class="min-w-[600px] w-full text-left text-sm">
                    <thead class="bg-slate-50 text-xs font-semibold uppercase tracking-wide text-slate-500">
                        <tr>
                            <th class="px-5 py-3.5">No.</th>
                            <th class="px-5 py-3.5">Nama ruangan</th>
                            <th class="px-5 py-3.5">Gedung / unit</th>
                            @if(Auth::user()->role === 'admin')
                                <th class="px-5 py-3.5">Aksi</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-slate-600">
                        @forelse($locations as $index => $loc)
                            <tr class="transition hover:bg-slate-50/80">
                                <td class="px-5 py-4 text-slate-500">{{ $index + 1 }}</td>
                                <td class="px-5 py-4 font-semibold text-slate-800">{{ $loc->room_name }}</td>
                                <td class="px-5 py-4">{{ $loc->building }}</td>
                                @if(Auth::user()->role === 'admin')
                                    <td class="px-5 py-4">
                                        <form action="{{ route('locations.destroy', $loc->id) }}" method="POST" onsubmit="return confirm('Yakin hapus data ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-sm font-semibold text-rose-600 hover:text-rose-800">Hapus</button>
                                        </form>
                                    </td>
                                @endif
                            </tr>
                        @empty
                            <tr>
                                <td colspan="{{ Auth::user()->role === 'admin' ? '4' : '3' }}" class="px-6 py-12 text-center text-slate-500">Belum ada data lokasi.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                </div>
            </section>
    </div>
</x-app-layout>