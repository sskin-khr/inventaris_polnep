<x-app-layout>
    @php
        $totalAset = \App\Models\Asset::count();
        $kondisiBaik = \App\Models\Asset::where('condition', 'Baik')->count();
        $rusakRingan = \App\Models\Asset::where('condition', 'Rusak Ringan')->count();
        $rusakBerat = \App\Models\Asset::where('condition', 'Rusak Berat')->count();

        $persenBaik = $totalAset > 0 ? ($kondisiBaik / $totalAset) * 100 : 0;
        $persenRingan = $totalAset > 0 ? ($rusakRingan / $totalAset) * 100 : 0;
        $persenBerat = $totalAset > 0 ? ($rusakBerat / $totalAset) * 100 : 0;
    @endphp

    <x-slot name="header">
        <div>
            <p class="text-xs font-semibold uppercase tracking-[0.18em] text-blue-700">INVENTARIS POLNEP</p>
            <h1 class="mt-1 text-2xl font-bold tracking-tight text-slate-900">Dashboard</h1>
            <p class="mt-1 text-sm text-slate-500">Ringkasan kondisi inventaris saat ini.</p>
        </div>
    </x-slot>

    <div class="mx-auto max-w-7xl space-y-6 px-4 py-8 sm:px-6 lg:px-8">
        <section class="flex flex-col gap-5 rounded-2xl bg-slate-900 px-6 py-7 text-white shadow-sm sm:flex-row sm:items-center sm:justify-between sm:px-8">
            <div>
                <p class="text-sm font-medium text-blue-200">Panel administrator</p>
                <h2 class="mt-1 text-2xl font-bold">Selamat datang, {{ Auth::user()->name }}</h2>
                <p class="mt-2 max-w-2xl text-sm leading-6 text-slate-300">
                    Pantau inventaris dan akses menu pengelolaan aset dari satu tempat.
                </p>
            </div>
            <a href="{{ route('assets.create') }}" class="inline-flex w-fit items-center justify-center gap-2 rounded-xl bg-white px-4 py-2.5 text-sm font-semibold text-slate-900 transition hover:bg-blue-50">
                <span aria-hidden="true">+</span> Tambah aset
            </a>
        </section>

        <section aria-labelledby="asset-overview-title">
            <div class="mb-4">
                <h2 id="asset-overview-title" class="text-lg font-bold text-slate-900">Ringkasan aset</h2>
                <p class="mt-1 text-sm text-slate-500">Jumlah aset berdasarkan kondisi yang tercatat.</p>
            </div>

            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">
                <article class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                    <p class="text-sm font-medium text-slate-500">Total aset</p>
                    <p class="mt-3 text-3xl font-bold tracking-tight text-slate-900">{{ number_format($totalAset) }}</p>
                    <p class="mt-1 text-xs text-slate-500">Aset terdaftar</p>
                </article>
                <article class="rounded-2xl border border-emerald-100 bg-white p-5 shadow-sm">
                    <p class="text-sm font-medium text-emerald-700">Kondisi baik</p>
                    <p class="mt-3 text-3xl font-bold tracking-tight text-slate-900">{{ number_format($kondisiBaik) }}</p>
                    <p class="mt-1 text-xs text-slate-500">{{ number_format($persenBaik, 1) }}% dari total aset</p>
                </article>
                <article class="rounded-2xl border border-amber-100 bg-white p-5 shadow-sm">
                    <p class="text-sm font-medium text-amber-700">Rusak ringan</p>
                    <p class="mt-3 text-3xl font-bold tracking-tight text-slate-900">{{ number_format($rusakRingan) }}</p>
                    <p class="mt-1 text-xs text-slate-500">{{ number_format($persenRingan, 1) }}% dari total aset</p>
                </article>
                <article class="rounded-2xl border border-rose-100 bg-white p-5 shadow-sm">
                    <p class="text-sm font-medium text-rose-700">Rusak berat</p>
                    <p class="mt-3 text-3xl font-bold tracking-tight text-slate-900">{{ number_format($rusakBerat) }}</p>
                    <p class="mt-1 text-xs text-slate-500">{{ number_format($persenBerat, 1) }}% dari total aset</p>
                </article>
            </div>
        </section>

        <div class="grid grid-cols-1 gap-5 lg:grid-cols-2">
            <section class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm sm:p-6" aria-labelledby="condition-title">
                <div class="mb-6">
                    <h2 id="condition-title" class="text-base font-bold text-slate-900">Kondisi aset</h2>
                    <p class="mt-1 text-sm text-slate-500">Perbandingan kondisi terhadap total aset.</p>
                </div>

                <div class="space-y-5">
                    <div>
                        <div class="mb-2 flex items-center justify-between gap-3 text-sm">
                            <span class="font-medium text-slate-700">Baik</span>
                            <span class="text-slate-500">{{ $kondisiBaik }} ({{ number_format($persenBaik, 1) }}%)</span>
                        </div>
                        <div class="h-2.5 overflow-hidden rounded-full bg-slate-100">
                            <div class="h-full rounded-full bg-emerald-500" style="width: {{ min($persenBaik, 100) }}%"></div>
                        </div>
                    </div>
                    <div>
                        <div class="mb-2 flex items-center justify-between gap-3 text-sm">
                            <span class="font-medium text-slate-700">Rusak ringan</span>
                            <span class="text-slate-500">{{ $rusakRingan }} ({{ number_format($persenRingan, 1) }}%)</span>
                        </div>
                        <div class="h-2.5 overflow-hidden rounded-full bg-slate-100">
                            <div class="h-full rounded-full bg-amber-400" style="width: {{ min($persenRingan, 100) }}%"></div>
                        </div>
                    </div>
                    <div>
                        <div class="mb-2 flex items-center justify-between gap-3 text-sm">
                            <span class="font-medium text-slate-700">Rusak berat</span>
                            <span class="text-slate-500">{{ $rusakBerat }} ({{ number_format($persenBerat, 1) }}%)</span>
                        </div>
                        <div class="h-2.5 overflow-hidden rounded-full bg-slate-100">
                            <div class="h-full rounded-full bg-rose-500" style="width: {{ min($persenBerat, 100) }}%"></div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm sm:p-6" aria-labelledby="shortcuts-title">
                <div class="mb-4">
                    <h2 id="shortcuts-title" class="text-base font-bold text-slate-900">Akses cepat</h2>
                    <p class="mt-1 text-sm text-slate-500">Menu yang sering digunakan.</p>
                </div>
                <div class="grid grid-cols-1 gap-3 sm:grid-cols-2">
                    <a href="{{ route('assets.index') }}" class="rounded-xl border border-slate-200 p-4 transition hover:border-blue-300 hover:bg-blue-50/50">
                        <span class="block text-sm font-semibold text-slate-800">Data aset</span>
                        <span class="mt-1 block text-xs text-slate-500">Lihat inventaris</span>
                    </a>
                    <a href="{{ route('categories.index') }}" class="rounded-xl border border-slate-200 p-4 transition hover:border-blue-300 hover:bg-blue-50/50">
                        <span class="block text-sm font-semibold text-slate-800">Kategori</span>
                        <span class="mt-1 block text-xs text-slate-500">Kelola kelompok aset</span>
                    </a>
                    <a href="{{ route('locations.index') }}" class="rounded-xl border border-slate-200 p-4 transition hover:border-blue-300 hover:bg-blue-50/50">
                        <span class="block text-sm font-semibold text-slate-800">Lokasi</span>
                        <span class="mt-1 block text-xs text-slate-500">Kelola ruangan</span>
                    </a>
                    <a href="{{ route('reports.index') }}" class="rounded-xl border border-slate-200 p-4 transition hover:border-blue-300 hover:bg-blue-50/50">
                        <span class="block text-sm font-semibold text-slate-800">Laporan</span>
                        <span class="mt-1 block text-xs text-slate-500">Tinjau dan cetak data</span>
                    </a>
                </div>
            </section>
        </div>
    </div>
</x-app-layout>
        <div class="admin-header">
            <div>
                <span class="admin-header-label">ASSET MANAGEMENT SYSTEM</span>
                <h2>Dashboard SIM-ASET POLNEP</h2>
                <p>Ringkasan dan pengelolaan data aset institusi</p>
            </div>

            <div class="admin-header-date is-loading">
                <i class="bi bi-calendar3"></i>
                <span id="adminCurrentDate">Memuat tanggal...</span>
            </div>
        </div>
    </x-slot>

    <div class="asset-dashboard is-loading">

        <div class="dashboard-skeleton" aria-hidden="true">
            <div class="skeleton-hero">
                <div class="skeleton-line skeleton-label"></div>
                <div class="skeleton-line skeleton-title"></div>
                <div class="skeleton-line skeleton-title short"></div>
                <div class="skeleton-line skeleton-copy"></div>
                <div class="skeleton-line skeleton-copy medium"></div>
                <div class="skeleton-line skeleton-chip"></div>
            </div>

            <div class="skeleton-section-heading">
                <div>
                    <div class="skeleton-line skeleton-label"></div>
                    <div class="skeleton-line skeleton-heading"></div>
                    <div class="skeleton-line skeleton-copy short"></div>
                </div>
                <div class="skeleton-line skeleton-badge"></div>
            </div>

            <div class="skeleton-statistics">
                @for ($i = 0; $i < 4; $i++)
                    <div class="skeleton-stat-card">
                        <div class="skeleton-line skeleton-icon"></div>
                        <div class="skeleton-line skeleton-copy"></div>
                        <div class="skeleton-line skeleton-number"></div>
                        <div class="skeleton-line skeleton-copy medium"></div>
                        <div class="skeleton-line skeleton-progress"></div>
                    </div>
                @endfor
            </div>

            <div class="skeleton-content-grid">
                <div class="skeleton-panel">
                    <div class="skeleton-line skeleton-heading"></div>
                    <div class="skeleton-line skeleton-copy medium"></div>
                    <div class="skeleton-line skeleton-total"></div>

                    @for ($i = 0; $i < 3; $i++)
                        <div class="skeleton-line skeleton-copy"></div>
                        <div class="skeleton-line skeleton-progress wide"></div>
                    @endfor
                </div>

                <div class="skeleton-panel">
                    <div class="skeleton-line skeleton-heading"></div>
                    <div class="skeleton-line skeleton-copy medium"></div>

                    @for ($i = 0; $i < 4; $i++)
                        <div class="skeleton-shortcut"></div>
                    @endfor
                </div>
            </div>
        </div>

        <div class="asset-dashboard-content">

            <div class="admin-welcome">
                <div class="admin-welcome-content">
                    <span class="admin-welcome-label">
                        <i class="bi bi-shield-check"></i>
                        ADMINISTRATOR PANEL
                    </span>

                    <h1>
                        Dashboard Pengelolaan
                        <span>Aset POLNEP</span>
                    </h1>

                    <p>
                        Selamat datang, {{ Auth::user()->name }}.
                        Kelola, pantau, dan evaluasi kondisi aset
                        Politeknik Negeri Pontianak melalui satu sistem terintegrasi.
                    </p>

                    <div class="admin-welcome-info">
                        <span>
                            <i class="bi bi-person-circle"></i>
                            {{ Auth::user()->name }}
                        </span>

                        <span class="admin-status">
                            <span></span>
                            Administrator Aktif
                        </span>
                    </div>
                </div>

                <div class="admin-welcome-art">
                    <div class="admin-art-circle">
                        <i class="bi bi-buildings"></i>
                    </div>

                    <div class="admin-art-icon art-icon-one">
                        <i class="bi bi-pc-display"></i>
                    </div>

                    <div class="admin-art-icon art-icon-two">
                        <i class="bi bi-clipboard-data"></i>
                    </div>

                    <div class="admin-art-icon art-icon-three">
                        <i class="bi bi-box-seam"></i>
                    </div>
                </div>
            </div>

            <div class="asset-section-heading">
                <div>
                    <span class="asset-section-label">OVERVIEW</span>
                    <h3>Ringkasan Aset</h3>
                    <p>Informasi jumlah dan kondisi aset saat ini.</p>
                </div>

                <div class="overview-badge">
                    <i class="bi bi-activity"></i>
                    Data Terkini
                </div>
            </div>

            <div class="asset-statistics">

                <div class="asset-stat-card total-card">
                    <div class="stat-top">
                        <div class="stat-icon">
                            <i class="bi bi-box-seam"></i>
                        </div>
                        <span class="stat-tag">KESELURUHAN</span>
                    </div>

                    <div class="stat-information">
                        <p>Total Aset</p>
                        <h2 class="count-number" data-count="{{ $totalAset }}">0</h2>
                        <span>Jumlah seluruh aset terdaftar</span>
                    </div>

                    <div class="stat-bottom">
                        <div class="stat-progress">
                            <div style="width:100%"></div>
                        </div>
                        <i class="bi bi-arrow-up-right"></i>
                    </div>
                </div>

                <div class="asset-stat-card good-card">
                    <div class="stat-top">
                        <div class="stat-icon">
                            <i class="bi bi-check-circle"></i>
                        </div>
                        <span class="stat-tag">NORMAL</span>
                    </div>

                    <div class="stat-information">
                        <p>Kondisi Baik</p>
                        <h2 class="count-number" data-count="{{ $kondisiBaik }}">0</h2>
                        <span>Aset dalam kondisi baik</span>
                    </div>

                    <div class="stat-bottom">
                        <div class="stat-progress">
                            <div style="width:{{ $persenBaik }}%"></div>
                        </div>
                        <strong>{{ number_format($persenBaik, 1) }}%</strong>
                    </div>
                </div>

                <div class="asset-stat-card warning-card">
                    <div class="stat-top">
                        <div class="stat-icon">
                            <i class="bi bi-exclamation-circle"></i>
                        </div>
                        <span class="stat-tag">PERHATIAN</span>
                    </div>

                    <div class="stat-information">
                        <p>Rusak Ringan</p>
                        <h2 class="count-number" data-count="{{ $rusakRingan }}">0</h2>
                        <span>Aset membutuhkan perbaikan</span>
                    </div>

                    <div class="stat-bottom">
                        <div class="stat-progress">
                            <div style="width:{{ $persenRingan }}%"></div>
                        </div>
                        <strong>{{ number_format($persenRingan, 1) }}%</strong>
                    </div>
                </div>

                <div class="asset-stat-card danger-card">
                    <div class="stat-top">
                        <div class="stat-icon">
                            <i class="bi bi-x-circle"></i>
                        </div>
                        <span class="stat-tag">KRITIS</span>
                    </div>

                    <div class="stat-information">
                        <p>Rusak Berat</p>
                        <h2 class="count-number" data-count="{{ $rusakBerat }}">0</h2>
                        <span>Aset membutuhkan penanganan</span>
                    </div>

                    <div class="stat-bottom">
                        <div class="stat-progress">
                            <div style="width:{{ $persenBerat }}%"></div>
                        </div>
                        <strong>{{ number_format($persenBerat, 1) }}%</strong>
                    </div>
                </div>

            </div>

            <div class="asset-content-grid">

                <div class="asset-chart-card">
                    <div class="asset-card-heading">
                        <div>
                            <span class="asset-section-label">ASSET CONDITION</span>
                            <h3>Distribusi Kondisi Aset</h3>
                            <p>Persentase berdasarkan kondisi aset terdaftar.</p>
                        </div>

                        <i class="bi bi-bar-chart-line chart-heading-symbol"></i>
                    </div>

                    <div class="condition-chart">

                        <div class="condition-chart-total">
                            <i class="bi bi-boxes chart-total-symbol"></i>
                            <div>
                                <h2>{{ number_format($totalAset) }}</h2>
                                <span>Total Aset</span>
                            </div>
                        </div>

                        <div class="condition-item">
                            <div class="condition-label">
                                <span>
                                    <i class="condition-dot dot-good"></i>
                                    Kondisi Baik
                                </span>
                                <strong>{{ $kondisiBaik }}</strong>
                            </div>

                            <div class="condition-track">
                                <div class="condition-fill fill-good"
                                    data-width="{{ $persenBaik }}"></div>
                            </div>

                            <span class="condition-percentage">
                                {{ number_format($persenBaik, 1) }}%
                            </span>
                        </div>

                        <div class="condition-item">
                            <div class="condition-label">
                                <span>
                                    <i class="condition-dot dot-warning"></i>
                                    Rusak Ringan
                                </span>
                                <strong>{{ $rusakRingan }}</strong>
                            </div>

                            <div class="condition-track">
                                <div class="condition-fill fill-warning"
                                    data-width="{{ $persenRingan }}"></div>
                            </div>

                            <span class="condition-percentage">
                                {{ number_format($persenRingan, 1) }}%
                            </span>
                        </div>

                        <div class="condition-item">
                            <div class="condition-label">
                                <span>
                                    <i class="condition-dot dot-danger"></i>
                                    Rusak Berat
                                </span>
                                <strong>{{ $rusakBerat }}</strong>
                            </div>

                            <div class="condition-track">
                                <div class="condition-fill fill-danger"
                                    data-width="{{ $persenBerat }}"></div>
                            </div>

                            <span class="condition-percentage">
                                {{ number_format($persenBerat, 1) }}%
                            </span>
                        </div>

                    </div>

                    <div class="chart-note">
                        <i class="bi bi-info-circle"></i>
                        <span>
                            Visualisasi berdasarkan jumlah aset yang tercatat
                            dalam database.
                        </span>
                    </div>
                </div>

                <div class="asset-shortcut-card">
                    <div class="asset-card-heading">
                        <div>
                            <span class="asset-section-label">QUICK ACCESS</span>
                            <h3>Navigasi Pengelolaan</h3>
                            <p>Pilih menu untuk mengelola data.</p>
                        </div>
                    </div>

                    <div class="shortcut-list">

                        <a href="{{ route('assets.create') }}" class="shortcut-item">
                            <div class="shortcut-icon shortcut-blue">
                                <i class="bi bi-plus-lg"></i>
                            </div>

                            <div class="shortcut-text">
                                <h4>Tambah Data Aset</h4>
                                <p>Daftarkan aset baru</p>
                            </div>

                            <i class="bi bi-arrow-up-right shortcut-arrow"></i>
                        </a>

                        <a href="{{ route('assets.index') }}" class="shortcut-item">
                            <div class="shortcut-icon shortcut-cyan">
                                <i class="bi bi-box-seam"></i>
                            </div>

                            <div class="shortcut-text">
                                <h4>Data Seluruh Aset</h4>
                                <p>Lihat dan kelola aset</p>
                            </div>

                            <i class="bi bi-arrow-up-right shortcut-arrow"></i>
                        </a>

                        <a href="{{ route('categories.index') }}" class="shortcut-item">
                            <div class="shortcut-icon shortcut-purple">
                                <i class="bi bi-grid"></i>
                            </div>

                            <div class="shortcut-text">
                                <h4>Kelola Kategori</h4>
                                <p>Atur kategori aset</p>
                            </div>

                            <i class="bi bi-arrow-up-right shortcut-arrow"></i>
                        </a>

                        <a href="{{ route('locations.index') }}" class="shortcut-item">
                            <div class="shortcut-icon shortcut-orange">
                                <i class="bi bi-geo-alt"></i>
                            </div>

                            <div class="shortcut-text">
                                <h4>Kelola Lokasi</h4>
                                <p>Atur lokasi dan ruangan</p>
                            </div>

                            <i class="bi bi-arrow-up-right shortcut-arrow"></i>
                        </a>

                    </div>
                </div>

            </div>

            <div class="asset-notice">
                <div class="notice-icon">
                    <i class="bi bi-shield-check"></i>
                </div>

                <div class="notice-content">
                    <h4>Pengelolaan Aset POLNEP</h4>
                    <p>
                        Pastikan seluruh data aset diperbarui secara berkala
                        untuk menjaga keakuratan informasi inventaris dan
                        mempermudah proses pemantauan kondisi aset.
                    </p>
                </div>

                <div class="notice-decoration">
                    <i class="bi bi-buildings"></i>
                </div>
            </div>

            <footer class="asset-dashboard-footer">
                <span>© {{ date('Y') }} Politeknik Negeri Pontianak</span>
                <span>SIM-ASET POLNEP · Asset Management System</span>
            </footer>

        </div>
    </div>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');

        .asset-dashboard {
            --navy: #102A43;
            --primary: #087E9C;
            --cyan: #16B8D4;
            --muted: #8293A6;

            max-width: 1400px;
            margin: auto;
            padding: 30px 28px;
            font-family: 'DM Sans', sans-serif;
            color: #243B53;
            position: relative;
        }

        .admin-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
        }

        .admin-header-label,
        .asset-section-label {
            color: #0891B2;
            font-size: 10px;
            font-weight: 800;
            letter-spacing: 1.7px;
        }

        .admin-header h2 {
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: var(--navy);
            font-size: 21px;
            font-weight: 800;
            margin-top: 5px;
        }

        .admin-header p {
            color: var(--muted);
            font-size: 12px;
            margin-top: 3px;
        }

        .admin-header-date {
            display: flex;
            align-items: center;
            gap: 9px;
            padding: 11px 15px;
            background: #F0F9FC;
            border: 1px solid #D9EDF3;
            border-radius: 11px;
            color: var(--primary);
            font-size: 12px;
            font-weight: 600;
            white-space: nowrap;
        }

        .admin-welcome {
            position: relative;
            overflow: hidden;
            display: flex;
            justify-content: space-between;
            align-items: center;
            min-height: 260px;
            padding: 35px 45px;
            margin-bottom: 35px;
            color: white;
            border-radius: 21px;
            background: linear-gradient(115deg, #102A43 0%, #075B78 68%, #087E9C 100%);
            box-shadow: 0 12px 30px rgba(16,42,67,.12);
        }

        .admin-welcome::before {
            content: "";
            position: absolute;
            width: 390px;
            height: 390px;
            right: 10%;
            top: -230px;
            border: 1px solid rgba(255,255,255,.1);
            border-radius: 50%;
        }

        .admin-welcome::after {
            content: "";
            position: absolute;
            width: 280px;
            height: 280px;
            right: -80px;
            bottom: -190px;
            border: 1px solid rgba(255,255,255,.1);
            border-radius: 50%;
        }

        .admin-welcome-content {
            position: relative;
            z-index: 2;
            max-width: 650px;
        }

        .admin-welcome-label {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 7px 12px;
            border: 1px solid rgba(255,255,255,.15);
            background: rgba(255,255,255,.1);
            color: #A5F3FC;
            border-radius: 30px;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 1px;
        }

        .admin-welcome-content h1 {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: clamp(23px, 3vw, 32px);
            font-weight: 800;
            line-height: 1.4;
            color: white;
            margin: 17px 0 9px;
        }

        .admin-welcome-content h1 span {
            color: #67E8F9;
        }

        .admin-welcome-content > p {
            color: #D0E7F0;
            font-size: 12px;
            line-height: 1.9;
            max-width: 550px;
        }

        .admin-welcome-info {
            display: flex;
            align-items: center;
            gap: 19px;
            flex-wrap: wrap;
            margin-top: 20px;
            font-size: 11px;
            color: #D9F4FA;
        }

        .admin-welcome-info > span {
            display: flex;
            align-items: center;
            gap: 7px;
        }

        .admin-status span {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: #4ADE80;
            box-shadow: 0 0 10px rgba(74,222,128,.6);
        }

        .admin-welcome-art {
            position: relative;
            z-index: 2;
            width: 220px;
            height: 190px;
            flex-shrink: 0;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .admin-art-circle {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 145px;
            height: 145px;
            border: 1px solid rgba(255,255,255,.2);
            border-radius: 50%;
            background: rgba(255,255,255,.1);
        }

        .admin-art-circle i {
            font-size: 70px;
            color: #CFFAFE;
        }

        .admin-art-icon {
            position: absolute;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 43px;
            height: 43px;
            border-radius: 13px;
            background: white;
            color: #087E9C;
            font-size: 19px;
            box-shadow: 0 8px 20px rgba(0,0,0,.15);
            animation: adminFloat 3s ease-in-out infinite;
        }

        .art-icon-one {
            top: 7px;
            left: 12px;
        }

        .art-icon-two {
            top: 43px;
            right: 3px;
            animation-delay: .5s;
        }

        .art-icon-three {
            bottom: 1px;
            left: 45%;
            animation-delay: 1s;
        }

        @keyframes adminFloat {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-8px); }
        }

        .asset-section-heading {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            margin-bottom: 19px;
        }

        .asset-section-heading h3,
        .asset-card-heading h3 {
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: var(--navy);
            font-size: 18px;
            font-weight: 800;
            margin-top: 5px;
        }

        .asset-section-heading p,
        .asset-card-heading p {
            color: var(--muted);
            font-size: 11px;
            margin-top: 5px;
        }

        .overview-badge {
            display: flex;
            align-items: center;
            gap: 7px;
            padding: 8px 12px;
            border: 1px solid #D6F0E1;
            background: #F0FDF4;
            color: #16804B;
            font-size: 10px;
            font-weight: 700;
            border-radius: 9px;
            white-space: nowrap;
        }

        .asset-statistics {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 16px;
        }

        .asset-stat-card {
            position: relative;
            overflow: hidden;
            padding: 20px;
            border: 1px solid #E7EEF3;
            border-radius: 16px;
            background: white;
            transition: transform .3s ease, box-shadow .3s ease, border-color .3s ease;
            min-width: 0;
            will-change: transform;
        }

        .asset-stat-card::before {
            content: "";
            position: absolute;
            inset: 0 auto 0 0;
            width: 3px;
            background: var(--primary);
            transform: scaleY(0);
            transform-origin: bottom;
            transition: transform .28s ease;
        }

        .asset-stat-card:hover::before {
            transform: scaleY(1);
        }

        .asset-stat-card:hover {
            transform: translateY(-7px);
            border-color: #C9E8F0;
            box-shadow: 0 16px 32px rgba(16,42,67,.10);
        }

        .stat-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 7px;
        }

        .stat-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 43px;
            height: 43px;
            border-radius: 12px;
            font-size: 20px;
        }

        .total-card .stat-icon {
            color: #087E9C;
            background: #E0F7FC;
        }

        .good-card .stat-icon {
            color: #15945A;
            background: #E5F8EE;
        }

        .warning-card .stat-icon {
            color: #D97706;
            background: #FFF4E5;
        }

        .danger-card .stat-icon {
            color: #DC4545;
            background: #FEECEC;
        }

        .stat-tag {
            font-size: 8px;
            font-weight: 800;
            letter-spacing: .7px;
            color: #8293A6;
            background: #F4F7FA;
            padding: 6px 8px;
            border-radius: 6px;
        }

        .stat-information {
            margin-top: 19px;
        }

        .stat-information p {
            font-size: 12px;
            font-weight: 600;
            color: #718096;
        }

        .stat-information h2 {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 31px;
            font-weight: 800;
            color: #102A43;
            margin: 3px 0;
            font-variant-numeric: tabular-nums;
        }

        .stat-information > span {
            color: #9AA9B8;
            font-size: 10px;
        }

        .stat-bottom {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-top: 17px;
            font-size: 10px;
            font-weight: 700;
        }

        .stat-progress {
            flex: 1;
            height: 5px;
            border-radius: 10px;
            background: #EDF2F6;
            overflow: hidden;
        }

        .stat-progress div {
            height: 100%;
            border-radius: 10px;
            transition: width 1.2s ease;
        }

        .total-card .stat-progress div { background: #087E9C; }
        .good-card .stat-progress div { background: #22C55E; }
        .warning-card .stat-progress div { background: #F59E0B; }
        .danger-card .stat-progress div { background: #EF4444; }

        .total-card .stat-bottom > i { color: #087E9C; }
        .good-card .stat-bottom strong { color: #15945A; }
        .warning-card .stat-bottom strong { color: #D97706; }
        .danger-card .stat-bottom strong { color: #DC4545; }

        .asset-content-grid {
            display: grid;
            grid-template-columns: 1.15fr .85fr;
            gap: 18px;
            margin-top: 25px;
        }

        .asset-chart-card,
        .asset-shortcut-card {
            padding: 24px;
            background: white;
            border: 1px solid #E7EEF3;
            border-radius: 17px;
        }

        .asset-card-heading {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 12px;
        }

        .asset-card-heading h3 {
            font-size: 16px;
        }

        .chart-heading-symbol,
        .chart-total-symbol {
            color: #087E9C;
            flex-shrink: 0;
        }

        .chart-heading-symbol {
            font-size: 25px;
            margin: 4px 2px 0 0;
        }

        .chart-total-symbol {
            font-size: 27px;
            margin-right: 3px;
        }

        .condition-chart {
            margin-top: 23px;
        }

        .condition-chart-total {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 0 0 16px;
            margin-bottom: 23px;
            border-bottom: 1px solid #EEF2F6;
        }

        .condition-chart-total h2 {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 20px;
            font-weight: 800;
            color: #102A43;
        }

        .condition-chart-total span {
            font-size: 10px;
            color: #8293A6;
        }

        .condition-item {
            display: grid;
            grid-template-columns: 1fr auto;
            gap: 8px 15px;
            margin-bottom: 19px;
        }

        .condition-label {
            display: flex;
            justify-content: space-between;
            align-items: center;
            grid-column: 1 / -1;
            font-size: 11px;
            color: #526579;
        }

        .condition-label span {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .condition-label strong {
            color: #243B53;
        }

        .condition-dot {
            width: 9px;
            height: 9px;
            border-radius: 50%;
        }

        .dot-good { background: #22C55E; }
        .dot-warning { background: #F59E0B; }
        .dot-danger { background: #EF4444; }

        .condition-track {
            height: 8px;
            border-radius: 20px;
            background: #EDF2F6;
            overflow: hidden;
        }

        .condition-fill {
            width: 0;
            height: 100%;
            border-radius: 20px;
            transition: width 1.2s ease;
        }

        .fill-good { background: #22C55E; }
        .fill-warning { background: #F59E0B; }
        .fill-danger { background: #EF4444; }

        .condition-percentage {
            font-size: 10px;
            font-weight: 700;
            color: #718096;
        }

        .chart-note {
            display: flex;
            align-items: flex-start;
            gap: 8px;
            padding-top: 14px;
            margin-top: 5px;
            border-top: 1px solid #EEF2F6;
            color: #8293A6;
            font-size: 10px;
            line-height: 1.7;
        }

        .chart-note i {
            color: #087E9C;
        }

        .shortcut-list {
            display: flex;
            flex-direction: column;
            margin-top: 18px;
        }

        .shortcut-item {
            position: relative;
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 13px 11px;
            margin: 2px -11px;
            text-decoration: none;
            border: 1px solid transparent;
            border-radius: 13px;
            transition: transform .25s ease, background .25s ease, border-color .25s ease, box-shadow .25s ease;
        }

        .shortcut-item:hover {
            background: #F5FBFD;
            border-color: #D9EDF3;
            box-shadow: 0 7px 18px rgba(8,126,156,.07);
            transform: translateX(4px);
        }

        .shortcut-icon {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-shrink: 0;
            width: 41px;
            height: 41px;
            border-radius: 11px;
            font-size: 18px;
            transition: transform .28s ease, box-shadow .28s ease;
        }

        .shortcut-item:hover .shortcut-icon {
            transform: rotate(-7deg) scale(1.09);
            box-shadow: 0 6px 13px rgba(8,126,156,.13);
        }

        .shortcut-blue {
            background: #E0F7FC;
            color: #087E9C;
        }

        .shortcut-cyan {
            background: #E5F6FF;
            color: #0284C7;
        }

        .shortcut-purple {
            background: #F2EAFE;
            color: #8B5CF6;
        }

        .shortcut-orange {
            background: #FFF4E5;
            color: #D97706;
        }

        .shortcut-text {
            flex: 1;
            min-width: 0;
        }

        .shortcut-text h4 {
            font-size: 12px;
            font-weight: 800;
            color: #243B53;
        }

        .shortcut-text p {
            font-size: 10px;
            color: #9AA9B8;
            margin-top: 4px;
        }

        .shortcut-arrow {
            color: #9AA9B8;
            font-size: 14px;
            transition: transform .25s ease, color .25s ease;
        }

        .shortcut-item:hover .shortcut-arrow {
            color: #087E9C;
            transform: translate(4px, -4px);
        }

        .asset-notice {
            position: relative;
            overflow: hidden;
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 21px 24px;
            margin-top: 24px;
            background: #F0F9FC;
            border: 1px solid #D9EDF3;
            border-radius: 15px;
        }

        .notice-icon {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-shrink: 0;
            width: 43px;
            height: 43px;
            border-radius: 12px;
            color: #087E9C;
            background: white;
            font-size: 20px;
        }

        .notice-content {
            position: relative;
            z-index: 1;
        }

        .notice-content h4 {
            font-size: 12px;
            font-weight: 800;
            color: #164E63;
            margin-bottom: 5px;
        }

        .notice-content p {
            font-size: 10px;
            line-height: 1.8;
            color: #527687;
            max-width: 700px;
        }

        .notice-decoration {
            margin-left: auto;
            color: rgba(8,126,156,.10);
            font-size: 60px;
            flex-shrink: 0;
        }

        .asset-dashboard-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            padding: 23px 0 5px;
            color: #9AA9B8;
            font-size: 10px;
        }

        /* Skeleton shimmer */
        .asset-dashboard-content {
            opacity: 0;
            visibility: hidden;
        }

        .asset-dashboard.is-loaded .asset-dashboard-content {
            visibility: visible;
            animation: dashboardReveal .55s ease forwards;
        }

        .dashboard-skeleton {
            display: none;
        }

        .asset-dashboard.is-loading .dashboard-skeleton {
            display: block;
        }

        .skeleton-line,
        .skeleton-shortcut {
            position: relative;
            overflow: hidden;
            background: #E9EFF4;
            border-radius: 8px;
        }

        .skeleton-line::after,
        .skeleton-shortcut::after {
            content: "";
            position: absolute;
            inset: 0;
            transform: translateX(-100%);
            background: linear-gradient(
                90deg,
                transparent,
                rgba(255,255,255,.78),
                transparent
            );
            animation: skeletonShimmer 1.35s infinite;
        }

        @keyframes skeletonShimmer {
            100% { transform: translateX(100%); }
        }

        @keyframes dashboardReveal {
            from {
                opacity: 0;
                transform: translateY(7px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .skeleton-hero {
            min-height: 260px;
            padding: 35px 45px;
            margin-bottom: 35px;
            border-radius: 21px;
            background: linear-gradient(115deg, #102A43, #075B78 68%, #087E9C);
        }

        .skeleton-hero .skeleton-line {
            background: rgba(255,255,255,.18);
        }

        .skeleton-hero .skeleton-line::after {
            background: linear-gradient(
                90deg,
                transparent,
                rgba(255,255,255,.2),
                transparent
            );
        }

        .skeleton-label {
            width: 125px;
            height: 11px;
            margin-bottom: 18px;
        }

        .skeleton-title {
            width: min(430px, 75%);
            height: 24px;
            margin-bottom: 10px;
        }

        .skeleton-title.short {
            width: 260px;
        }

        .skeleton-copy {
            width: 75%;
            height: 9px;
            margin: 10px 0;
        }

        .skeleton-copy.medium {
            width: 52%;
        }

        .skeleton-copy.short {
            width: 180px;
        }

        .skeleton-chip {
            width: 135px;
            height: 25px;
            margin-top: 22px;
            border-radius: 20px;
        }

        .skeleton-section-heading {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 19px;
        }

        .skeleton-heading {
            width: 190px;
            height: 19px;
            margin: 8px 0;
        }

        .skeleton-badge {
            width: 105px;
            height: 30px;
            border-radius: 9px;
        }

        .skeleton-statistics {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 16px;
        }

        .skeleton-stat-card,
        .skeleton-panel {
            padding: 20px;
            background: white;
            border: 1px solid #E7EEF3;
            border-radius: 16px;
        }

        .skeleton-icon {
            width: 43px;
            height: 43px;
            border-radius: 12px;
            margin-bottom: 18px;
        }

        .skeleton-number {
            width: 75px;
            height: 30px;
            margin: 9px 0;
        }

        .skeleton-progress {
            width: 100%;
            height: 5px;
            margin-top: 18px;
            border-radius: 10px;
        }

        .skeleton-progress.wide {
            margin: 9px 0 20px;
        }

        .skeleton-content-grid {
            display: grid;
            grid-template-columns: 1.15fr .85fr;
            gap: 18px;
            margin-top: 25px;
        }

        .skeleton-panel {
            min-height: 290px;
            padding: 24px;
        }

        .skeleton-total {
            width: 100%;
            height: 55px;
            margin: 20px 0;
            border-radius: 12px;
        }

        .skeleton-shortcut {
            height: 49px;
            margin-top: 12px;
        }

        /* Loading tanggal */
        .admin-header-date.is-loading {
            color: transparent;
            min-width: 165px;
            position: relative;
            overflow: hidden;
            background: #E9EFF4;
            border-color: #E9EFF4;
        }

        .admin-header-date.is-loading i,
        .admin-header-date.is-loading span {
            visibility: hidden;
        }

        .admin-header-date.is-loading::after {
            content: "";
            position: absolute;
            inset: 0;
            background: linear-gradient(
                90deg,
                transparent,
                rgba(255,255,255,.85),
                transparent
            );
            transform: translateX(-100%);
            animation: skeletonShimmer 1.35s infinite;
        }

        @media (max-width: 1024px) {
            .asset-statistics,
            .skeleton-statistics {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .asset-content-grid,
            .skeleton-content-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            .asset-dashboard {
                padding: 25px 18px;
            }

            .admin-header {
                align-items: flex-start;
                flex-direction: column;
            }

            .admin-welcome {
                padding: 30px 25px;
            }

            .admin-welcome-art {
                width: 160px;
                transform: scale(.85);
            }
        }

        @media (max-width: 560px) {
            .asset-dashboard {
                padding: 20px 13px;
            }

            .admin-welcome {
                padding: 26px 20px;
                min-height: auto;
            }

            .admin-welcome-art {
                display: none;
            }

            .admin-welcome-content h1 {
                font-size: 24px;
            }

            .asset-statistics,
            .skeleton-statistics {
                grid-template-columns: 1fr 1fr;
                gap: 10px;
            }

            .asset-stat-card,
            .skeleton-stat-card {
                padding: 14px;
            }

            .stat-tag {
                font-size: 7px;
                padding: 5px;
            }

            .stat-information h2 {
                font-size: 26px;
            }

            .stat-information > span {
                font-size: 9px;
            }

            .asset-section-heading {
                align-items: flex-start;
            }

            .asset-chart-card,
            .asset-shortcut-card,
            .skeleton-panel {
                padding: 18px;
            }

            .asset-dashboard-footer {
                flex-direction: column;
                align-items: flex-start;
            }

            .notice-decoration {
                display: none;
            }

            .skeleton-hero {
                padding: 26px 20px;
                min-height: 220px;
            }

            .skeleton-section-heading {
                align-items: flex-start;
                gap: 10px;
            }
        }

        @media (prefers-reduced-motion: reduce) {
            .asset-dashboard *,
            .asset-dashboard *::before,
            .asset-dashboard *::after {
                animation: none !important;
                transition: none !important;
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const dashboard = document.querySelector('.asset-dashboard');
            const dateElement = document.getElementById('adminCurrentDate');

            // Menampilkan tanggal saat ini
            if (dateElement) {
                dateElement.textContent = new Intl.DateTimeFormat('id-ID', {
                    weekday: 'long',
                    day: 'numeric',
                    month: 'long',
                    year: 'numeric'
                }).format(new Date());

                dateElement.parentElement.classList.remove('is-loading');
            }

            // Menghilangkan skeleton setelah halaman siap
            requestAnimationFrame(function () {
                requestAnimationFrame(function () {
                    window.setTimeout(function () {
                        if (dashboard) {
                            dashboard.classList.remove('is-loading');
                            dashboard.classList.add('is-loaded');
                        }
                    }, 450);
                });
            });

            // Animasi angka statistik
            document.querySelectorAll('.count-number').forEach(function (element) {
                const target = Number(element.dataset.count) || 0;
                const duration = 1000;
                const startTime = performance.now();

                function animateNumber(currentTime) {
                    const progress = Math.min(
                        (currentTime - startTime) / duration,
                        1
                    );

                    const eased = 1 - Math.pow(1 - progress, 3);

                    element.textContent = Math.floor(
                        target * eased
                    ).toLocaleString('id-ID');

                    if (progress < 1) {
                        requestAnimationFrame(animateNumber);
                    } else {
                        element.textContent = target.toLocaleString('id-ID');
                    }
                }

                requestAnimationFrame(animateNumber);
            });

            // Animasi progress bar kondisi aset
            setTimeout(function () {
                document.querySelectorAll('.condition-fill').forEach(function (bar) {
                    const width = Math.min(
                        Math.max(Number(bar.dataset.width) || 0, 0),
                        100
                    );

                    bar.style.width = width + '%';
                });
            }, 150);
        });
    </script>
</x-app-layout>
