<x-app-layout>
    @php
        $isAdmin = auth()->user()?->role === 'admin';
    @endphp

    <x-slot name="header">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <p class="text-xs font-semibold uppercase tracking-[0.18em] text-blue-700">Inventaris POLNEP</p>
                <h1 class="mt-1 text-2xl font-bold tracking-tight text-slate-900">Daftar aset</h1>
                <p class="mt-1 text-sm text-slate-500">
                    Informasi dan pengelolaan data aset Politeknik Negeri Pontianak.
                </p>
            </div>

            @if($isAdmin)
                <a href="{{ route('assets.create') }}" class="inline-flex items-center justify-center gap-2 rounded-xl bg-blue-700 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-800">
                    <span aria-hidden="true">+</span>
                    Tambah Aset Baru
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
            <div class="flex flex-col gap-2 border-b border-slate-100 px-5 py-5 sm:flex-row sm:items-center sm:justify-between sm:px-6">
                <div>
                    <h2 class="text-lg font-bold text-slate-900">Informasi aset</h2>
                    <p class="mt-1 text-sm text-slate-500">Seluruh aset yang tercatat di sistem inventaris.</p>
                </div>
                <span class="inline-flex w-fit items-center rounded-full bg-blue-50 px-3 py-1 text-xs font-semibold text-blue-700">
                    {{ $assets->count() }} aset
                </span>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-[900px] w-full text-left text-sm">
                    <thead class="bg-slate-50 text-xs font-semibold uppercase tracking-wide text-slate-500">
                        <tr>
                            <th class="px-5 py-3.5">Foto</th>
                            <th class="px-5 py-3.5">Kode aset</th>
                            <th class="px-5 py-3.5">Nama aset</th>
                            <th class="px-5 py-3.5">Kategori</th>
                            <th class="px-5 py-3.5">Lokasi</th>
                            <th class="px-5 py-3.5">Kondisi</th>
                            @if($isAdmin)
                                <th class="px-5 py-3.5">Aksi</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-slate-600">
                        @forelse($assets as $asset)
                            <tr class="transition hover:bg-slate-50/80">
                                <td class="px-5 py-3">
                                    @if($asset->image)
                                        <img src="{{ asset('storage/' . $asset->image) }}" alt="Foto {{ $asset->name }}" class="h-11 w-11 rounded-lg object-cover ring-1 ring-slate-200">
                                    @else
                                        <span class="flex h-11 w-11 items-center justify-center rounded-lg bg-slate-100 text-[10px] text-slate-400">-</span>
                                    @endif
                                </td>
                                <td class="whitespace-nowrap px-5 py-3 font-semibold text-slate-800">{{ $asset->asset_code }}</td>
                                <td class="px-5 py-3 font-medium text-slate-800">{{ $asset->name }}</td>
                                <td class="px-5 py-3">{{ $asset->category->name ?? '-' }}</td>
                                <td class="px-5 py-3">
                                    <span class="block font-medium text-slate-700">{{ $asset->location->room_name ?? '-' }}</span>
                                    <span class="mt-0.5 block text-xs text-slate-500">{{ $asset->location->building ?? 'Lokasi tidak tersedia' }}</span>
                                </td>
                                <td class="px-5 py-3">
                                    @php
                                        $conditionClass = match($asset->condition) {
                                            'Baik' => 'bg-emerald-50 text-emerald-700',
                                            'Rusak Ringan' => 'bg-amber-50 text-amber-700',
                                            default => 'bg-rose-50 text-rose-700',
                                        };
                                    @endphp
                                    <span class="inline-flex whitespace-nowrap rounded-full px-2.5 py-1 text-xs font-semibold {{ $conditionClass }}">
                                        {{ $asset->condition }}
                                    </span>
                                </td>
                                @if($isAdmin)
                                    <td class="px-5 py-3">
                                        <div class="flex items-center gap-3">
                                            <a href="{{ route('assets.edit', $asset->id) }}" class="font-semibold text-blue-700 hover:text-blue-900">Edit</a>
                                            <form action="{{ route('assets.destroy', $asset->id) }}" method="POST" onsubmit="return confirm('Apakah kamu yakin ingin menghapus aset ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="font-semibold text-rose-600 hover:text-rose-800">Hapus</button>
                                            </form>
                                        </div>
                                    </td>
                                @endif
                            </tr>
                        @empty
                            <tr>
                                <td colspan="{{ $isAdmin ? 7 : 6 }}" class="px-6 py-14 text-center">
                                    <p class="font-semibold text-slate-700">Belum ada data aset</p>
                                    <p class="mt-1 text-sm text-slate-500">Daftar aset akan tampil di sini setelah tersedia.</p>
                                    @if($isAdmin)
                                        <a href="{{ route('assets.create') }}" class="mt-4 inline-flex rounded-lg bg-blue-700 px-4 py-2 text-sm font-semibold text-white hover:bg-blue-800">Tambah aset pertama</a>
                                    @endif
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>
    </div>
</x-app-layout>
