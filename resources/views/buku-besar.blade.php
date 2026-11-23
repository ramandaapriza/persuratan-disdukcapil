<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buku Besar &amp; Laporan Arsip - Disdukcapil OKI</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@600;700;800&family=JetBrains+Mono:wght@500;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        :root {
            --color-slate-50: #F8FAFC;
            --color-slate-100: #F3F4F6;
            --color-slate-200: #E5E7EB;
            --color-slate-500: #6B7280;
            --color-slate-700: #374151;
            --color-slate-900: #111827;
            --color-blue-600: #2563EB;
            --color-emerald-600: #059669;
            --color-rose-600: #E11D48;
            --radius-md: 0.5rem;
            --radius-lg: 0.75rem;
            --shadow-card: 0 1px 3px rgba(15, 23, 42, 0.06), 0 1px 2px rgba(15, 23, 42, 0.04);
            --bg-surface: #FFFFFF;
            --bg-canvas: var(--color-slate-100);
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-canvas);
            color: var(--color-slate-900);
        }

        .sidebar {
            width: 260px;
            min-height: 100vh;
            background-color: var(--color-slate-900);
        }

        .sidebar-section-label {
            font-size: 0.66rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: #6B7280;
            padding: 0.85rem 0.9rem 0.35rem;
        }

        .nav-link-sidebar {
            color: #9CA3AF;
            padding: 0.6rem 0.9rem;
            border-radius: var(--radius-md);
            font-size: 0.84rem;
            font-weight: 500;
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: space-between;
            transition: background-color 0.15s ease, color 0.15s ease;
        }

        .nav-link-sidebar:hover {
            background-color: rgba(255, 255, 255, 0.05);
            color: #F9FAFB;
        }

        .nav-link-sidebar.active {
            background-color: #1E293B;
            color: #60A5FA;
            border: 1px solid rgba(96, 165, 250, 0.15);
        }

        .surface-card {
            background-color: var(--bg-surface);
            border: 1px solid var(--color-slate-200);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-card);
        }

        .mini-stat-icon {
            width: 42px;
            height: 42px;
            border-radius: 0.65rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.15rem;
            flex-shrink: 0;
        }

        .ledger-tabs .nav-link {
            color: var(--color-slate-500);
            font-size: 0.82rem;
            font-weight: 600;
            padding: 0.6rem 1rem;
            border: none;
            border-bottom: 2px solid transparent;
            border-radius: 0;
            cursor: pointer;
        }

        .ledger-tabs .nav-link:hover {
            color: var(--color-slate-900);
        }

        .ledger-tabs .nav-link.active {
            color: var(--color-blue-600);
            background-color: transparent;
            border-bottom-color: var(--color-blue-600);
        }

        .table-ledger th {
            font-size: 0.71rem;
            font-weight: 600;
            color: var(--color-slate-500);
            letter-spacing: 0.04em;
            text-transform: uppercase;
            background-color: var(--color-slate-50);
            padding: 0.85rem 0.9rem;
            border-bottom: 1px solid var(--color-slate-200);
            white-space: nowrap;
        }

        .table-ledger td {
            padding: 0.95rem 0.9rem;
            vertical-align: middle;
            border-bottom: 1px solid #F3F4F6;
            font-size: 0.82rem;
        }

        .table-ledger tbody tr:hover {
            background-color: #F8FAFC;
        }

        .doc-number-mono {
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.78rem;
            font-weight: 600;
        }

        .timeline-step {
            position: relative;
            padding-left: 2.3rem;
            padding-bottom: 1rem;
        }

        .timeline-step:last-child {
            padding-bottom: 0;
        }

        .timeline-step::before {
            content: '';
            position: absolute;
            left: 11px;
            top: 24px;
            bottom: 0;
            width: 2px;
            background-color: var(--color-slate-200);
        }

        .timeline-step:last-child::before {
            display: none;
        }

        .timeline-dot {
            position: absolute;
            left: 0;
            top: 2px;
            width: 24px;
            height: 24px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.75rem;
        }
    </style>
</head>
<body>
@php
    $authUser = auth()->user();
    $userRole = $authUser->role ?? 'admin';
    $userName = $authUser->nama_lengkap ?? 'Pegawai Disdukcapil';
    $userJabatan = $authUser->jabatan ?? 'Subbag Umum & Kepegawaian';
    $userNip = $authUser->nip ?? '-';

    $cleanName = preg_replace('/^(Drs\.|Ir\.|H\.|Hj\.|Dr\.|Prof\.)\s+/i', '', $userName);
    $cleanName = preg_replace('/^(Drs\.|Ir\.|H\.|Hj\.|Dr\.|Prof\.)\s+/i', '', $cleanName);
    $cleanName = explode(',', $cleanName)[0];
    $words = array_values(array_filter(explode(' ', trim($cleanName))));
    $userInitials = strtoupper(substr($words[0] ?? 'P', 0, 1) . substr($words[1] ?? ($words[0] ?? 'D'), 0, 1));

    $avatarBadgeClass = match ($userRole) {
        'kadin' => 'bg-success text-white',
        'kasubbag' => 'bg-warning text-dark',
        'sekdin' => 'bg-info text-dark',
        default => 'bg-primary text-white',
    };

    $roleStatusLabel = match ($userRole) {
        'kadin' => 'Otoritas: Kepala Dinas',
        'kasubbag' => 'Otoritas: Kasubbag (Verif I)',
        'sekdin' => 'Otoritas: Sekdin (Verif II)',
        default => 'Otoritas: Staf Admin',
    };

    $activeJenis = $filters['jenis'] ?? 'semua';
    $activeKodeBidang = $filters['kode_bidang'] ?? 'semua';
    $activeStatus = $filters['status'] ?? 'semua';
    $activeTanggalDari = $filters['tanggal_dari'] ?? '';
    $activeTanggalSampai = $filters['tanggal_sampai'] ?? '';
    $activeSearch = $filters['q'] ?? '';

    $pageItemsCollection = collect($ledgerItems->items());
@endphp

<div class="d-flex">
    <aside class="sidebar d-flex flex-column flex-shrink-0 position-fixed top-0 bottom-0 start-0 z-3">
        <div class="p-3 d-flex align-items-center gap-3 border-bottom border-secondary border-opacity-25">
            <div class="bg-primary text-white rounded-3 d-flex align-items-center justify-content-center" style="width: 38px; height: 38px;">
                <i class="bi bi-envelope-paper-fill fs-5" aria-hidden="true"></i>
            </div>
            <div>
                <div class="fw-bold text-white" style="font-size: 0.9rem; letter-spacing: 0.02em;">DISDUKCAPIL OKI</div>
                <div class="text-secondary" style="font-size: 0.72rem;">Persuratan &amp; Kearsipan</div>
            </div>
        </div>

        <div class="px-3 py-2 d-flex flex-column gap-1 flex-grow-1 overflow-y-auto">
            @if(auth()->user()->role === 'admin')
                <div class="sidebar-section-label">MENU UTAMA &amp; AGENDA</div>
                <a href="/" class="nav-link-sidebar">
                    <span class="d-flex align-items-center gap-3">
                        <i class="bi bi-grid" aria-hidden="true"></i>
                        <span>Dashboard Admin</span>
                    </span>
                </a>
                <a href="/registrasi-surat" class="nav-link-sidebar">
                    <span class="d-flex align-items-center gap-3">
                        <i class="bi bi-send" aria-hidden="true"></i>
                        <span>Registrasi &amp; Agenda Naskah</span>
                    </span>
                </a>
                <a href="/riwayat-naskah" class="nav-link-sidebar">
                    <span class="d-flex align-items-center gap-3">
                        <i class="bi bi-clock-history" aria-hidden="true"></i>
                        <span>Riwayat &amp; Pantauan Naskah</span>
                    </span>
                    @if(($sidebarRevisiCount ?? 0) > 0)
                        <span class="badge rounded-pill bg-danger text-white fw-bold" style="font-size: 0.68rem;">{{ $sidebarRevisiCount }}</span>
                    @endif
                </a>

                <div class="sidebar-section-label">ARSIP &amp; PELAPORAN</div>
                <a href="/buku-besar" class="nav-link-sidebar active">
                    <span class="d-flex align-items-center gap-3">
                        <i class="bi bi-journal-bookmark-fill" aria-hidden="true"></i>
                        <span>Buku Besar / Laporan</span>
                    </span>
                </a>
                <a href="/verifikasi-dokumen" class="nav-link-sidebar">
                    <span class="d-flex align-items-center gap-3">
                        <i class="bi bi-patch-check" aria-hidden="true"></i>
                        <span>Portal Verifikasi Publik</span>
                    </span>
                </a>

                <div class="sidebar-section-label">ADMINISTRASI &amp; KEAMANAN</div>
                <a href="/admin/users" class="nav-link-sidebar">
                    <span class="d-flex align-items-center gap-3">
                        <i class="bi bi-people" aria-hidden="true"></i>
                        <span>Manajemen Akun Pegawai</span>
                    </span>
                </a>
                <a href="/logout" class="nav-link-sidebar text-danger">
                    <span class="d-flex align-items-center gap-3">
                        <i class="bi bi-box-arrow-left" aria-hidden="true"></i>
                        <span>Logout</span>
                    </span>
                </a>
            @elseif(in_array(auth()->user()->role, ['kasubbag', 'sekdin']))
                <div class="sidebar-section-label">VERIFIKASI BERJENJANG</div>
                <a href="/verifikasi-hierarki" class="nav-link-sidebar">
                    <span class="d-flex align-items-center gap-3">
                        <i class="bi bi-file-earmark-check" aria-hidden="true"></i>
                        <span>Verifikasi Hierarki Naskah</span>
                    </span>
                    <span class="badge rounded-pill bg-warning text-dark fw-bold" style="font-size: 0.68rem;">
                        {{ auth()->user()->role === 'sekdin' ? ($verifTahap2Count ?? 0) : ($verifTahap1Count ?? 0) }}
                    </span>
                </a>

                <div class="sidebar-section-label">ARSIP &amp; PELAPORAN</div>
                <a href="/buku-besar" class="nav-link-sidebar active">
                    <span class="d-flex align-items-center gap-3">
                        <i class="bi bi-journal-bookmark-fill" aria-hidden="true"></i>
                        <span>Buku Besar / Laporan</span>
                    </span>
                </a>
                <a href="/verifikasi-dokumen" class="nav-link-sidebar">
                    <span class="d-flex align-items-center gap-3">
                        <i class="bi bi-patch-check" aria-hidden="true"></i>
                        <span>Portal Verifikasi Publik</span>
                    </span>
                </a>

                <div class="sidebar-section-label">SESI &amp; KEAMANAN</div>
                <a href="/logout" class="nav-link-sidebar text-danger">
                    <span class="d-flex align-items-center gap-3">
                        <i class="bi bi-box-arrow-left" aria-hidden="true"></i>
                        <span>Logout</span>
                    </span>
                </a>
            @elseif(auth()->user()->role === 'kadin')
                <div class="sidebar-section-label">MENU UTAMA PIMPINAN</div>
                <a href="/kadin" class="nav-link-sidebar">
                    <span class="d-flex align-items-center gap-3">
                        <i class="bi bi-grid" aria-hidden="true"></i>
                        <span>Dashboard Eksekutif</span>
                    </span>
                </a>
                <a href="/kadin/validasi" class="nav-link-sidebar">
                    <span class="d-flex align-items-center gap-3">
                        <i class="bi bi-qr-code-scan" aria-hidden="true"></i>
                        <span>Validasi &amp; TTE QR</span>
                    </span>
                    <span class="badge rounded-pill bg-danger" style="font-size: 0.68rem;">{{ $menungguTteCount ?? 0 }}</span>
                </a>
                <a href="/kadin/disposisi" class="nav-link-sidebar">
                    <span class="d-flex align-items-center gap-3">
                        <i class="bi bi-inbox" aria-hidden="true"></i>
                        <span>Disposisi Surat Masuk</span>
                    </span>
                    <span class="badge rounded-pill bg-warning text-dark fw-bold" style="font-size: 0.68rem;">{{ $menungguDisposisiCount ?? 0 }}</span>
                </a>

                <div class="sidebar-section-label">ARSIP &amp; PELAPORAN</div>
                <a href="/buku-besar" class="nav-link-sidebar active">
                    <span class="d-flex align-items-center gap-3">
                        <i class="bi bi-journal-bookmark-fill" aria-hidden="true"></i>
                        <span>Buku Besar / Laporan</span>
                    </span>
                </a>
                <a href="/verifikasi-dokumen" class="nav-link-sidebar">
                    <span class="d-flex align-items-center gap-3">
                        <i class="bi bi-patch-check" aria-hidden="true"></i>
                        <span>Portal Verifikasi Publik</span>
                    </span>
                </a>

                <div class="sidebar-section-label">OTORISASI &amp; KEAMANAN</div>
                <a href="#modalPinTte" data-bs-toggle="modal" class="nav-link-sidebar">
                    <span class="d-flex align-items-center gap-3">
                        <i class="bi bi-shield-lock" aria-hidden="true"></i>
                        <span>Pengaturan PIN / Passphrase TTE</span>
                    </span>
                </a>
                <a href="/logout" class="nav-link-sidebar text-danger">
                    <span class="d-flex align-items-center gap-3">
                        <i class="bi bi-box-arrow-left" aria-hidden="true"></i>
                        <span>Logout</span>
                    </span>
                </a>
            @endif
        </div>

        <div class="p-3 border-top border-secondary border-opacity-25" style="background-color: #0B0F19;">
            <div class="d-flex align-items-center gap-2 mb-2">
                <div class="rounded-circle {{ $avatarBadgeClass }} fw-bold d-flex align-items-center justify-content-center flex-shrink-0" style="width: 36px; height: 36px; font-size: 0.75rem;">
                    {{ $userInitials }}
                </div>
                <div class="lh-sm overflow-hidden">
                    <div class="text-white fw-semibold text-truncate" style="font-size: 0.78rem;">{{ $userName }}</div>
                    <div class="text-secondary text-truncate" style="font-size: 0.69rem;">{{ $userJabatan }}</div>
                </div>
            </div>
            <div class="d-flex align-items-center justify-content-between px-2 py-1 rounded-2" style="background-color: rgba(16, 185, 129, 0.12); border: 1px solid rgba(16, 185, 129, 0.25);">
                <span class="text-success fw-semibold d-inline-flex align-items-center gap-1" style="font-size: 0.68rem;">
                    <i class="bi bi-shield-lock-fill" aria-hidden="true"></i> {{ $roleStatusLabel }}
                </span>
                <span class="badge bg-success text-white" style="font-size: 0.62rem;">RBAC</span>
            </div>
        </div>
    </aside>

    <div class="flex-grow-1 d-flex flex-column min-vh-100" style="margin-left: 260px;">
        <header class="bg-white border-bottom px-4 py-2 d-flex align-items-center justify-content-between sticky-top" style="height: 58px;">
            <div class="small">
                <span class="text-secondary">Disdukcapil OKI</span>
                <span class="text-secondary mx-1">/</span>
                <span class="text-secondary">Laporan &amp; Arsip</span>
                <span class="text-secondary mx-1">/</span>
                <span class="text-primary fw-medium">Buku Besar Persuratan Digital</span>
            </div>

            <div class="d-flex align-items-center gap-2">
                <div class="border rounded-2 px-3 py-1 bg-light text-secondary d-none d-md-flex align-items-center gap-2" style="font-size: 0.78rem;">
                    <i class="bi bi-calendar3 text-primary" aria-hidden="true"></i>
                    <span>{{ now()->translatedFormat('l, d F Y') }}</span>
                </div>

                <div class="dropdown">
                    <button class="btn btn-sm border rounded-pill px-2 py-1 d-flex align-items-center gap-2 bg-white" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="rounded-circle {{ $avatarBadgeClass }} fw-bold d-inline-flex align-items-center justify-content-center" style="width: 24px; height: 24px; font-size: 0.68rem;">{{ $userInitials }}</span>
                        <span class="text-dark fw-medium" style="font-size: 0.76rem;">{{ $userName }}</span>
                        <i class="bi bi-chevron-down text-secondary" style="font-size: 0.65rem;" aria-hidden="true"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 small" style="min-width: 230px;">
                        <li class="px-3 py-2 border-bottom">
                            <div class="fw-bold text-dark">{{ $userName }}</div>
                            <div class="text-secondary" style="font-size: 0.7rem;">{{ $userJabatan }}</div>
                            <div class="doc-number-mono text-primary mt-1" style="font-size: 0.68rem;">NIP: {{ $userNip }}</div>
                        </li>
                        @if(auth()->user()->role === 'kadin')
                            <li><a class="dropdown-item" href="#modalPinTte" data-bs-toggle="modal"><i class="bi bi-shield-lock me-2"></i>Pengaturan PIN / Passphrase TTE</a></li>
                        @endif
                        <li><a class="dropdown-item" href="/verifikasi-dokumen"><i class="bi bi-qr-code-scan me-2"></i>Portal Verifikasi Publik</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item text-danger" href="/logout"><i class="bi bi-box-arrow-right me-2"></i>Logout</a></li>
                    </ul>
                </div>
            </div>
        </header>

        <main class="p-4 flex-grow-1">
            @if (session('status'))
                <div class="alert alert-success alert-dismissible fade show py-2 px-3 mb-3 d-flex align-items-center gap-2 border-0 shadow-sm" role="alert" style="background-color: #DCFCE7; color: #15803D; font-size: 0.8rem;">
                    <i class="bi bi-check-circle-fill flex-shrink-0" aria-hidden="true"></i>
                    <div class="flex-grow-1">{{ session('status') }}</div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup" style="font-size: 0.65rem;"></button>
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show py-2 px-3 mb-3 d-flex align-items-center gap-2 border-0 shadow-sm" role="alert" style="background-color: #FEE2E2; color: #B91C1C; font-size: 0.8rem;">
                    <i class="bi bi-shield-exclamation flex-shrink-0" aria-hidden="true"></i>
                    <div class="flex-grow-1">{{ session('error') }}</div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup" style="font-size: 0.65rem;"></button>
                </div>
            @endif

            {{-- FORM FILTER DINAMIS & EKSPOR LAPORAN --}}
            <div class="surface-card p-3 px-4 mb-4">
                <form id="formFilterBukuBesar" action="{{ route('buku.besar') }}" method="GET">
                    <div class="d-flex flex-column flex-xl-row align-items-xl-end justify-content-between gap-3">
                        <div class="row g-3 flex-grow-1">
                            <div class="col-12 col-md-4">
                                <label class="form-label fw-semibold text-dark small mb-1">
                                    <i class="bi bi-calendar-range text-primary me-1" aria-hidden="true"></i>Rentang Tanggal Agenda
                                </label>
                                <div class="input-group input-group-sm">
                                    <input type="date" name="tanggal_dari" class="form-control" value="{{ $activeTanggalDari }}" aria-label="Tanggal Mulai">
                                    <span class="input-group-text bg-light text-secondary">s/d</span>
                                    <input type="date" name="tanggal_sampai" class="form-control" value="{{ $activeTanggalSampai }}" aria-label="Tanggal Akhir">
                                </div>
                            </div>

                            <div class="col-12 col-sm-4 col-md-3">
                                <label for="filterJenisNaskah" class="form-label fw-semibold text-dark small mb-1">
                                    <i class="bi bi-layers text-primary me-1" aria-hidden="true"></i>Jenis Naskah Dinas
                                </label>
                                <select name="jenis" id="filterJenisNaskah" onchange="this.form.submit()" class="form-select form-select-sm fw-medium">
                                    <option value="semua" {{ $activeJenis === 'semua' ? 'selected' : '' }}>Semua Jenis Naskah</option>
                                    <option value="surat_masuk" {{ $activeJenis === 'surat_masuk' ? 'selected' : '' }}>Surat Masuk</option>
                                    <option value="surat_keluar" {{ $activeJenis === 'surat_keluar' ? 'selected' : '' }}>Surat Keluar</option>
                                    <option value="sppd" {{ $activeJenis === 'sppd' ? 'selected' : '' }}>SPPD (Perjalanan Dinas)</option>
                                    <option value="berita_acara" {{ $activeJenis === 'berita_acara' ? 'selected' : '' }}>Berita Acara</option>
                                </select>
                            </div>

                            <div class="col-12 col-sm-4 col-md-3">
                                <label for="filterKodeBidang" class="form-label fw-semibold text-dark small mb-1">
                                    <i class="bi bi-diagram-2 text-primary me-1" aria-hidden="true"></i>Kode Klasifikasi Bidang
                                </label>
                                <select name="kode_bidang" id="filterKodeBidang" onchange="this.form.submit()" class="form-select form-select-sm fw-medium">
                                    <option value="semua" {{ $activeKodeBidang === 'semua' ? 'selected' : '' }}>Semua Klasifikasi (400, 800, 00)</option>
                                    <option value="400" {{ $activeKodeBidang === '400' ? 'selected' : '' }}>400 - Catatan Sipil</option>
                                    <option value="800" {{ $activeKodeBidang === '800' ? 'selected' : '' }}>800 - Kepegawaian &amp; Umum</option>
                                    <option value="00" {{ $activeKodeBidang === '00' ? 'selected' : '' }}>00 - Keuangan / Dana</option>
                                </select>
                            </div>

                            <div class="col-12 col-sm-4 col-md-2">
                                <label for="filterStatusSelect" class="form-label fw-semibold text-dark small mb-1">
                                    <i class="bi bi-check2-circle text-primary me-1" aria-hidden="true"></i>Status
                                </label>
                                <select name="status" id="filterStatusSelect" onchange="this.form.submit()" class="form-select form-select-sm fw-medium">
                                    <option value="semua" {{ $activeStatus === 'semua' ? 'selected' : '' }}>Semua Status</option>
                                    <option value="ttd_kadin" {{ $activeStatus === 'ttd_kadin' ? 'selected' : '' }}>Sah TTE Kadin</option>
                                    <option value="valid_sekdin" {{ $activeStatus === 'valid_sekdin' ? 'selected' : '' }}>Antrean TTE Kadin</option>
                                    <option value="valid_kasubbag" {{ $activeStatus === 'valid_kasubbag' ? 'selected' : '' }}>Tahap 2 Sekdin</option>
                                    <option value="draf" {{ $activeStatus === 'draf' ? 'selected' : '' }}>Tahap 1 Kasubbag</option>
                                    <option value="revisi" {{ $activeStatus === 'revisi' ? 'selected' : '' }}>Perlu Revisi</option>
                                    <option value="selesai" {{ $activeStatus === 'selesai' ? 'selected' : '' }}>Disposisi Selesai</option>
                                    <option value="diproses" {{ $activeStatus === 'diproses' ? 'selected' : '' }}>Disposisi Diproses</option>
                                </select>
                            </div>
                        </div>

                        <div class="d-flex flex-wrap align-items-center gap-2 flex-shrink-0">
                            <button type="submit" class="btn btn-sm btn-primary fw-semibold px-3 py-2 rounded-2 d-inline-flex align-items-center gap-1">
                                <i class="bi bi-funnel-fill" aria-hidden="true"></i>
                                <span>Terapkan</span>
                            </button>
                            <a href="{{ route('buku.besar') }}" class="btn btn-sm btn-outline-secondary px-2 py-2 rounded-2" title="Reset Filter">
                                <i class="bi bi-arrow-clockwise" aria-hidden="true"></i>
                            </a>
                            <a href="{{ route('buku.besar.export-excel', request()->query()) }}" class="btn btn-sm btn-success fw-semibold px-3 py-2 rounded-2 d-inline-flex align-items-center gap-1 shadow-sm">
                                <i class="bi bi-file-earmark-excel-fill" aria-hidden="true"></i>
                                <span>Export Excel</span>
                            </a>
                            <a href="{{ route('buku.besar.export-pdf', request()->query()) }}" class="btn btn-sm btn-danger fw-semibold px-3 py-2 rounded-2 d-inline-flex align-items-center gap-1 shadow-sm">
                                <i class="bi bi-file-earmark-pdf-fill" aria-hidden="true"></i>
                                <span>Cetak Rekap PDF</span>
                            </a>
                        </div>
                    </div>

                    <input type="hidden" name="q" id="hiddenSearchInput" value="{{ $activeSearch }}">
                </form>
            </div>

            {{-- 4 MINI-CARD REAL-TIME DARI DATABASE --}}
            <div class="row g-3 mb-4">
                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="surface-card p-3 h-100 d-flex align-items-center justify-content-between" style="cursor: pointer;" onclick="selectLedgerTab('semua')">
                        <div>
                            <div class="text-secondary fw-medium mb-1" style="font-size: 0.76rem;">Total Agenda Persuratan</div>
                            <div class="fs-4 fw-bold text-dark lh-1 mb-1">{{ $totalAgenda ?? 0 }}</div>
                            <div class="text-primary fw-medium" style="font-size: 0.72rem;">
                                <i class="bi bi-journal-check me-1" aria-hidden="true"></i>{{ $totalSuratMasuk ?? 0 }} Masuk &bull; {{ ($totalSuratKeluar ?? 0) + ($totalSppd ?? 0) + ($totalBeritaAcara ?? 0) }} Keluar/Naskah
                            </div>
                        </div>
                        <div class="mini-stat-icon" style="background-color: #DBEAFE; color: #2563EB;">
                            <i class="bi bi-journals" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="surface-card p-3 h-100 d-flex align-items-center justify-content-between" style="cursor: pointer;" onclick="selectLedgerTab('surat_keluar')">
                        <div>
                            <div class="text-secondary fw-medium mb-1" style="font-size: 0.76rem;">Total Surat Keluar Ber-TTE</div>
                            <div class="fs-4 fw-bold text-success lh-1 mb-1">{{ $totalSuratKeluarTte ?? 0 }}</div>
                            <div class="text-success fw-medium" style="font-size: 0.72rem;">
                                <i class="bi bi-qr-code me-1" aria-hidden="true"></i>Dari {{ $totalSuratKeluar ?? 0 }} total surat keluar
                            </div>
                        </div>
                        <div class="mini-stat-icon" style="background-color: #DCFCE7; color: #16A34A;">
                            <i class="bi bi-patch-check-fill" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="surface-card p-3 h-100 d-flex align-items-center justify-content-between" style="cursor: pointer;" onclick="selectLedgerTab('sppd')">
                        <div>
                            <div class="text-secondary fw-medium mb-1" style="font-size: 0.76rem;">Total SPPD Terbit</div>
                            <div class="fs-4 fw-bold lh-1 mb-1" style="color: #D97706;">{{ $totalSppd ?? 0 }}</div>
                            <div class="fw-medium" style="font-size: 0.72rem; color: #B45309;">
                                <i class="bi bi-geo-alt-fill me-1" aria-hidden="true"></i>Dinas Dalam &amp; Luar Daerah
                            </div>
                        </div>
                        <div class="mini-stat-icon" style="background-color: #FEF3C7; color: #D97706;">
                            <i class="bi bi-briefcase-fill" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="surface-card p-3 h-100 d-flex align-items-center justify-content-between" style="cursor: pointer;" onclick="selectLedgerTab('berita_acara')">
                        <div>
                            <div class="text-secondary fw-medium mb-1" style="font-size: 0.76rem;">Total Berita Acara</div>
                            <div class="fs-4 fw-bold lh-1 mb-1" style="color: #7C3AED;">{{ $totalBeritaAcara ?? 0 }}</div>
                            <div class="fw-medium" style="font-size: 0.72rem; color: #6D28D9;">
                                <i class="bi bi-file-earmark-ruled me-1" aria-hidden="true"></i>BAST &amp; Rekonsiliasi SIAK
                            </div>
                        </div>
                        <div class="mini-stat-icon" style="background-color: #EDE9FE; color: #7C3AED;">
                            <i class="bi bi-file-earmark-text-fill" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="surface-card overflow-hidden">
                <div class="px-4 pt-3 border-bottom d-flex flex-column flex-xl-row align-items-xl-center justify-content-between gap-3">
                    <ul class="nav nav-tabs ledger-tabs border-0" id="ledgerTabNav">
                        <li class="nav-item">
                            <button type="button" class="nav-link {{ $activeJenis === 'semua' ? 'active' : '' }}" onclick="selectLedgerTab('semua')">
                                Semua Naskah <span class="badge rounded-pill bg-primary bg-opacity-10 text-primary ms-1">{{ $totalAgenda ?? 0 }}</span>
                            </button>
                        </li>
                        <li class="nav-item">
                            <button type="button" class="nav-link {{ $activeJenis === 'surat_masuk' ? 'active' : '' }}" onclick="selectLedgerTab('surat_masuk')">
                                Surat Masuk <span class="badge rounded-pill bg-secondary bg-opacity-10 text-secondary ms-1">{{ $totalSuratMasuk ?? 0 }}</span>
                            </button>
                        </li>
                        <li class="nav-item">
                            <button type="button" class="nav-link {{ $activeJenis === 'surat_keluar' ? 'active' : '' }}" onclick="selectLedgerTab('surat_keluar')">
                                Surat Keluar <span class="badge rounded-pill bg-secondary bg-opacity-10 text-secondary ms-1">{{ $totalSuratKeluar ?? 0 }}</span>
                            </button>
                        </li>
                        <li class="nav-item">
                            <button type="button" class="nav-link {{ $activeJenis === 'sppd' ? 'active' : '' }}" onclick="selectLedgerTab('sppd')">
                                SPPD <span class="badge rounded-pill bg-secondary bg-opacity-10 text-secondary ms-1">{{ $totalSppd ?? 0 }}</span>
                            </button>
                        </li>
                        <li class="nav-item">
                            <button type="button" class="nav-link {{ $activeJenis === 'berita_acara' ? 'active' : '' }}" onclick="selectLedgerTab('berita_acara')">
                                Berita Acara <span class="badge rounded-pill bg-secondary bg-opacity-10 text-secondary ms-1">{{ $totalBeritaAcara ?? 0 }}</span>
                            </button>
                        </li>
                    </ul>

                    <div class="pb-2 d-flex align-items-center gap-2">
                        <div class="input-group input-group-sm" style="width: 265px;">
                            <span class="input-group-text bg-white border-end-0 text-secondary">
                                <i class="bi bi-search" aria-hidden="true"></i>
                            </span>
                            <input type="text"
                                   id="ledgerSearchInput"
                                   value="{{ $activeSearch }}"
                                   onkeydown="if(event.key==='Enter'){submitSearchQuery();}"
                                   oninput="filterClientRows(this.value)"
                                   class="form-control border-start-0 ps-0"
                                   placeholder="Cari nomor surat / perihal / tujuan...">
                            <button type="button" onclick="submitSearchQuery()" class="btn btn-outline-primary">Cari</button>
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-ledger mb-0" id="ledgerDataTable">
                        <thead>
                            <tr>
                                <th class="ps-4" style="width: 105px;">NO. AGENDA</th>
                                <th style="width: 115px;">TANGGAL</th>
                                <th style="width: 230px;">NOMOR NASKAH &amp; KODE BIDANG</th>
                                <th style="width: 130px;">KATEGORI</th>
                                <th style="width: 220px;">PENGIRIM / TUJUAN</th>
                                <th>PERIHAL</th>
                                <th style="width: 175px;">STATUS TTE / DISPOSISI</th>
                                <th class="pe-4 text-end" style="width: 125px;">AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($ledgerItems as $item)
                                @php
                                    $bidangBadgeClass = match($item['kode_bidang']) {
                                        '800' => 'bg-warning bg-opacity-15 text-dark',
                                        '00' => 'bg-secondary bg-opacity-10 text-dark border',
                                        default => 'bg-primary bg-opacity-10 text-primary',
                                    };
                                @endphp
                                <tr class="ledger-data-row">
                                    <td class="ps-4">
                                        <span class="fw-bold text-dark font-monospace">{{ $item['no_agenda'] }}</span>
                                    </td>
                                    <td class="text-secondary">{{ $item['tanggal_display'] }}</td>
                                    <td>
                                        <div class="doc-number-mono text-primary">{{ $item['nomor_naskah'] }}</div>
                                        <span class="badge {{ $bidangBadgeClass }} fw-medium mt-1" style="font-size: 0.68rem;">
                                            Kode {{ $item['kode_bidang'] }} - {{ $item['nama_bidang'] }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge rounded-2 px-2 py-1 fw-semibold" style="background-color: {{ $item['kategori_badge_bg'] }}; color: {{ $item['kategori_badge_color'] }}; font-size: 0.72rem;">
                                            <i class="bi {{ $item['kategori_icon'] }} me-1" aria-hidden="true"></i>{{ $item['kategori_label'] }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="fw-semibold text-dark">{{ $item['pihak_utama'] }}</div>
                                        <div class="text-secondary" style="font-size: 0.73rem;">{{ $item['pihak_sub'] }}</div>
                                    </td>
                                    <td>
                                        <div class="text-dark fw-medium">{{ $item['perihal'] }}</div>
                                    </td>
                                    <td>
                                        <span class="badge rounded-pill fw-medium px-2 py-1" style="background-color: {{ $item['status_badge_bg'] }}; color: {{ $item['status_badge_color'] }}; font-size: 0.72rem;">
                                            <i class="bi {{ $item['status_icon'] }} me-1" aria-hidden="true"></i>{{ $item['status_label'] }}
                                        </span>
                                    </td>
                                    <td class="pe-4 text-end">
                                        <button type="button"
                                                onclick="openDetailArsipByKey('{{ $item['key'] }}')"
                                                class="btn btn-sm btn-outline-primary fw-medium px-2 py-1 d-inline-flex align-items-center gap-1"
                                                style="font-size: 0.74rem;">
                                            <i class="bi bi-file-earmark-text" aria-hidden="true"></i>
                                            <span>Lihat Arsip</span>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center py-4 text-secondary">
                                        <i class="bi bi-journal-x fs-4 d-block mb-1"></i>
                                        Tidak ada rekaman naskah dinas yang sesuai dengan filter yang dipilih.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="card-footer bg-white border-top px-4 py-3 d-flex flex-column flex-sm-row align-items-sm-center justify-content-between gap-2">
                    <span class="text-secondary" style="font-size: 0.76rem;">
                        Menampilkan <strong>{{ $ledgerItems->firstItem() ?? 0 }} &ndash; {{ $ledgerItems->lastItem() ?? 0 }}</strong> dari <strong>{{ $ledgerItems->total() }}</strong> rekaman buku besar naskah dinas
                    </span>
                    <div>
                        {{ $ledgerItems->withQueryString()->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </main>

        <footer class="bg-white border-top px-4 py-3 d-flex flex-column flex-sm-row align-items-center justify-content-between text-secondary" style="font-size: 0.75rem;">
            <div>&copy; 2026 <strong class="text-dark">Disdukcapil Kabupaten Ogan Komering Ilir</strong>. Hak Cipta Dilindungi.</div>
            <div>Aplikasi Tata Naskah Dinas Elektronik (TNDE) OKI Mandira</div>
        </footer>
    </div>
</div>

{{-- MODAL 1: DETAIL ARSIP NASKAH DINAS (TERINTEGRASI TAHAP 4A VERIFIKASI QR & UNDUH PDF) --}}
<div class="modal fade" id="modalDetailArsip" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow rounded-3">
            <div class="modal-header border-bottom px-4 py-3">
                <div>
                    <h6 class="modal-title fw-bold text-dark d-flex align-items-center gap-2 mb-0">
                        <i class="bi bi-journal-text text-primary" aria-hidden="true"></i>
                        <span>Rincian Arsip Buku Besar Persuratan Digital</span>
                    </h6>
                    <div class="text-secondary small">
                        No. Agenda: <span id="arsipModalAgenda" class="fw-bold text-dark font-monospace">-</span> &bull;
                        Nomor Naskah: <span id="arsipModalNomor" class="doc-number-mono text-primary">-</span>
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body p-4 small">
                <div class="p-3 rounded-3 mb-3 border" style="background-color: #F8FAFC;">
                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 mb-2">
                        <div class="d-flex align-items-center gap-2">
                            <span id="arsipModalKategoriBadge" class="badge rounded-2 px-2 py-1 fw-semibold">-</span>
                            <span id="arsipModalBidangBadge" class="badge bg-primary bg-opacity-10 text-primary fw-semibold">-</span>
                        </div>
                        <span id="arsipModalStatusBadge" class="badge rounded-pill px-2 py-1 fw-semibold">-</span>
                    </div>
                    <div class="fw-bold text-dark mb-1" id="arsipModalPerihal" style="font-size: 0.88rem;">-</div>
                    <div class="text-secondary" id="arsipModalPihak">-</div>
                    <div class="text-secondary mt-1" id="arsipModalTanggal" style="font-size: 0.73rem;">-</div>
                </div>

                {{-- BOX TOKEN UUID TTE & TAUTAN TAHAP 4A (KHUSUS NASKAH BERSTATUS ttd_kadin) --}}
                <div id="arsipModalTteBox" class="p-3 rounded-3 mb-3 border d-none" style="background-color: #ECFDF5; border-color: #A7F3D0 !important;">
                    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-2">
                        <div>
                            <div class="fw-bold text-success d-flex align-items-center gap-1">
                                <i class="bi bi-patch-check-fill"></i>
                                <span>Dokumen Sah Ber-Tanda Tangan Elektronik (TTE QR Code)</span>
                            </div>
                            <div class="doc-number-mono text-dark mt-1" style="font-size: 0.73rem;">
                                Token UUID: <span id="arsipModalUuid" class="text-primary">-</span>
                            </div>
                            <div class="text-secondary mt-1" id="arsipModalSignedInfo" style="font-size: 0.71rem;">-</div>
                        </div>
                        <div class="d-flex flex-wrap gap-2 flex-shrink-0">
                            <a id="arsipModalVerifyLink" href="#" class="btn btn-sm btn-outline-success fw-semibold">
                                <i class="bi bi-qr-code-scan me-1"></i>Cek Portal Verifikasi QR
                            </a>
                            <a id="arsipModalDownloadPdfLink" href="#" class="btn btn-sm btn-primary fw-semibold">
                                <i class="bi bi-file-earmark-arrow-down-fill me-1"></i>Unduh Salinan Resmi PDF
                            </a>
                        </div>
                    </div>
                </div>

                {{-- BOX DISPOSISI SURAT MASUK --}}
                <div id="arsipModalDisposisiSection" class="d-none">
                    <h6 class="fw-bold text-dark mb-2" style="font-size: 0.82rem;">
                        <i class="bi bi-inbox-fill text-primary me-1"></i>Rincian Disposisi Kepala Dinas
                    </h6>
                    <div id="arsipModalDisposisiContent" class="p-3 rounded-2 border bg-light"></div>
                </div>

                {{-- BOX TIMELINE LOG VERIFIKASI (SURAT KELUAR / SPPD / BERITA ACARA) --}}
                <div id="arsipModalTimelineSection" class="d-none">
                    <h6 class="fw-bold text-dark mb-3" style="font-size: 0.82rem;">
                        <i class="bi bi-diagram-3-fill text-primary me-1"></i>Jejak Audit Verifikasi Berjenjang (<code>log_verifikasi</code>)
                    </h6>
                    <div id="arsipModalTimelineContainer" class="ps-1"></div>
                </div>
            </div>
            <div class="modal-footer border-top px-4 py-2 d-flex align-items-center justify-content-between">
                <div>
                    <a id="arsipModalFileLampiranBtn" href="#" target="_blank" class="btn btn-sm btn-outline-primary fw-semibold d-none">
                        <i class="bi bi-paperclip me-1"></i>Buka Berkas Lampiran Unggahan
                    </a>
                </div>
                <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

@if(auth()->user()->role === 'kadin')
<div class="modal fade" id="modalPinTte" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow rounded-3">
            <form action="{{ route('kadin.pin-tte.update') }}" method="POST">
                @csrf
                @method('PATCH')
                <div class="modal-header border-bottom px-4 py-3">
                    <h6 class="modal-title fw-bold text-dark d-flex align-items-center gap-2">
                        <i class="bi bi-shield-lock-fill text-primary" aria-hidden="true"></i>
                        <span>Pengaturan PIN / Passphrase TTE Kepala Dinas</span>
                    </h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="p-3 rounded-2 mb-3 border" style="background-color: #EFF6FF; border-color: #BFDBFE !important; font-size: 0.78rem;">
                        <strong class="text-primary d-block mb-1">Otorisator TTE: {{ $userName }}</strong>
                        <span class="text-secondary">{{ $userJabatan }} &bull; NIP {{ $userNip }}</span>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold small text-dark mb-1">Verifikasi PIN TTE Saat Ini / Kata Sandi Akun <span class="text-danger">*</span></label>
                        <input type="password" name="kredensial_verifikasi" class="form-control form-control-sm" placeholder="Masukkan PIN TTE lama atau Password login Anda..." required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold small text-dark mb-1">PIN / Passphrase TTE Baru (6 Digit Angka) <span class="text-danger">*</span></label>
                        <input type="password" name="pin_tte_baru" maxlength="6" pattern="\d{6}" inputmode="numeric" class="form-control form-control-sm doc-number-mono" placeholder="Contoh: 123456" required>
                    </div>
                    <div class="mb-0">
                        <label class="form-label fw-semibold small text-dark mb-1">Konfirmasi PIN / Passphrase TTE Baru (6 Digit Angka) <span class="text-danger">*</span></label>
                        <input type="password" name="pin_tte_baru_confirmation" maxlength="6" pattern="\d{6}" inputmode="numeric" class="form-control form-control-sm doc-number-mono" placeholder="Ketik ulang 6 digit PIN baru..." required>
                    </div>
                </div>
                <div class="modal-footer border-top px-4 py-2">
                    <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-sm btn-primary fw-semibold">Simpan Perubahan PIN TTE</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    const LEDGER_ITEMS_MAP = @json($pageItemsCollection->keyBy('key'));

    function selectLedgerTab(jenisValue) {
        const selectEl = document.getElementById('filterJenisNaskah');
        if (selectEl) {
            selectEl.value = jenisValue;
        }
        document.getElementById('formFilterBukuBesar').submit();
    }

    function submitSearchQuery() {
        const qVal = document.getElementById('ledgerSearchInput').value || '';
        document.getElementById('hiddenSearchInput').value = qVal;
        document.getElementById('formFilterBukuBesar').submit();
    }

    function filterClientRows(query) {
        const q = (query || '').toLowerCase();
        document.getElementById('hiddenSearchInput').value = query;
        document.querySelectorAll('#ledgerDataTable tbody tr.ledger-data-row').forEach(function (row) {
            row.style.display = row.innerText.toLowerCase().includes(q) ? '' : 'none';
        });
    }

    function openDetailArsipByKey(key) {
        const item = LEDGER_ITEMS_MAP[key];
        if (!item) return;

        document.getElementById('arsipModalAgenda').textContent = item.no_agenda;
        document.getElementById('arsipModalNomor').textContent = item.nomor_naskah;
        document.getElementById('arsipModalPerihal').textContent = item.perihal;
        document.getElementById('arsipModalPihak').textContent = item.pihak_utama + ' • ' + item.pihak_sub;
        document.getElementById('arsipModalTanggal').textContent = 'Tanggal Naskah: ' + item.tanggal_display;

        const katBadge = document.getElementById('arsipModalKategoriBadge');
        katBadge.textContent = item.kategori_label;
        katBadge.style.backgroundColor = item.kategori_badge_bg;
        katBadge.style.color = item.kategori_badge_color;

        document.getElementById('arsipModalBidangBadge').textContent = 'Kode ' + item.kode_bidang + ' - ' + item.nama_bidang;

        const stBadge = document.getElementById('arsipModalStatusBadge');
        stBadge.textContent = item.status_label;
        stBadge.style.backgroundColor = item.status_badge_bg;
        stBadge.style.color = item.status_badge_color;

        // TTE Box (Tahap 4A Integration)
        const tteBox = document.getElementById('arsipModalTteBox');
        if (item.status_raw === 'ttd_kadin' && item.tte_token_uuid) {
            tteBox.classList.remove('d-none');
            document.getElementById('arsipModalUuid').textContent = item.tte_token_uuid;
            document.getElementById('arsipModalSignedInfo').textContent = 'Disahkan oleh: ' + (item.penandatangan_nama || 'Kepala Dinas') + ' (' + (item.signed_at_display || '-') + ')';
            document.getElementById('arsipModalVerifyLink').href = item.verify_url || '/verifikasi-dokumen';
            document.getElementById('arsipModalDownloadPdfLink').href = item.unduh_tte_url || '#';
        } else {
            tteBox.classList.add('d-none');
        }

        // Lampiran Button
        const fileBtn = document.getElementById('arsipModalFileLampiranBtn');
        if (item.file_url) {
            fileBtn.classList.remove('d-none');
            fileBtn.href = item.file_url;
        } else {
            fileBtn.classList.add('d-none');
        }

        // Disposisi vs Timeline Section
        const dispSec = document.getElementById('arsipModalDisposisiSection');
        const tlSec = document.getElementById('arsipModalTimelineSection');

        if (item.jenis === 'surat_masuk') {
            dispSec.classList.remove('d-none');
            tlSec.classList.add('d-none');
            const dispContent = document.getElementById('arsipModalDisposisiContent');
            if (item.disposisi_detail) {
                const d = item.disposisi_detail;
                dispContent.innerHTML = `
                    <div class="fw-bold text-primary mb-1">Diteruskan ke: ${d.unit}</div>
                    <div class="text-dark">Penerima: <strong>${d.penerima}</strong> &bull; Tanggal Terima: ${d.tanggal_menerima}</div>
                    <div class="text-secondary mt-1">Sifat: <strong>${d.sifat}</strong> &bull; Instruksi: ${d.instruksi}</div>
                    <div class="p-2 rounded-2 bg-white border mt-2 text-dark fst-italic">"${d.catatan_kadin}"</div>
                    <div class="text-secondary mt-2" style="font-size: 0.72rem;">Pejabat Pendisposisi: <strong>${d.pejabat_kadin}</strong> &bull; Status: <strong>${d.status_disposisi}</strong></div>
                `;
            } else {
                dispContent.innerHTML = '<div class="text-secondary">Surat masuk ini belum memiliki catatan disposisi Kepala Dinas.</div>';
            }
        } else {
            dispSec.classList.add('d-none');
            tlSec.classList.remove('d-none');
            const tlContainer = document.getElementById('arsipModalTimelineContainer');
            tlContainer.innerHTML = '';

            const logs = Array.isArray(item.logs) ? item.logs : [];
            if (logs.length === 0) {
                tlContainer.innerHTML = '<div class="text-secondary">Belum ada riwayat log verifikasi tercatat.</div>';
            } else {
                logs.forEach(log => {
                    const isRevisi = log.status_aksi === 'revisi';
                    const dotBg = isRevisi ? '#FEE2E2' : '#DCFCE7';
                    const dotColor = isRevisi ? '#DC2626' : '#16A34A';
                    const icon = isRevisi ? 'bi-arrow-counterclockwise' : 'bi-check-lg';

                    const step = document.createElement('div');
                    step.className = 'timeline-step';
                    step.innerHTML = `
                        <div class="timeline-dot" style="background-color: ${dotBg}; color: ${dotColor};">
                            <i class="bi ${icon}"></i>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="fw-bold text-dark" style="font-size: 0.8rem;">${log.tahap_label}</span>
                            <span class="text-secondary doc-number-mono" style="font-size: 0.7rem;">${log.waktu}</span>
                        </div>
                        <div class="text-dark fw-medium" style="font-size: 0.75rem;">${log.verifikator_nama}</div>
                        <div class="text-secondary" style="font-size: 0.74rem;">${log.catatan || '-'}</div>
                    `;
                    tlContainer.appendChild(step);
                });
            }
        }

        new bootstrap.Modal(document.getElementById('modalDetailArsip')).show();
    }
</script>
</body>
</html>
