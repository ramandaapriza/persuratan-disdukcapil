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

    $sidebarRevisiCount = $userRole === 'admin' ? (
        \App\Models\SuratKeluar::where('status', 'revisi')->count()
        + \App\Models\Sppd::where('status', 'revisi')->count()
        + \App\Models\BeritaAcara::where('status', 'revisi')->count()
    ) : 0;
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
                    @if($sidebarRevisiCount > 0)
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
                    <span class="badge rounded-pill bg-warning text-dark fw-bold" style="font-size: 0.68rem;">{{ auth()->user()->role === 'sekdin' ? '3' : '4' }}</span>
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
                    <span class="badge rounded-pill bg-danger" style="font-size: 0.68rem;">10</span>
                </a>
                <a href="/kadin/disposisi" class="nav-link-sidebar">
                    <span class="d-flex align-items-center gap-3">
                        <i class="bi bi-inbox" aria-hidden="true"></i>
                        <span>Disposisi Surat Masuk</span>
                    </span>
                    <span class="badge rounded-pill bg-warning text-dark fw-bold" style="font-size: 0.68rem;">2</span>
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
                    <span>Selasa, 17 November 2026</span>
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
            <div class="surface-card p-3 px-4 mb-4">
                <div class="d-flex flex-column flex-xl-row align-items-xl-end justify-content-between gap-3">
                    <div class="row g-3 flex-grow-1">
                        <div class="col-12 col-md-4">
                            <label class="form-label fw-semibold text-dark small mb-1">
                                <i class="bi bi-calendar-range text-primary me-1" aria-hidden="true"></i>Rentang Tanggal Agenda
                            </label>
                            <div class="input-group input-group-sm">
                                <input type="date" class="form-control" value="2026-11-01" aria-label="Tanggal Mulai">
                                <span class="input-group-text bg-light text-secondary">s/d</span>
                                <input type="date" class="form-control" value="2026-11-17" aria-label="Tanggal Akhir">
                            </div>
                        </div>

                        <div class="col-12 col-sm-6 col-md-4">
                            <label for="filterJenisNaskah" class="form-label fw-semibold text-dark small mb-1">
                                <i class="bi bi-layers text-primary me-1" aria-hidden="true"></i>Jenis Naskah Dinas
                            </label>
                            <select id="filterJenisNaskah" onchange="applyLedgerFilter()" class="form-select form-select-sm fw-medium">
                                <option value="semua" selected>Semua Jenis Naskah</option>
                                <option value="Surat Masuk">Surat Masuk</option>
                                <option value="Surat Keluar">Surat Keluar</option>
                                <option value="SPPD">SPPD (Perjalanan Dinas)</option>
                                <option value="Berita Acara">Berita Acara</option>
                            </select>
                        </div>

                        <div class="col-12 col-sm-6 col-md-4">
                            <label for="filterKodeBidang" class="form-label fw-semibold text-dark small mb-1">
                                <i class="bi bi-diagram-2 text-primary me-1" aria-hidden="true"></i>Kode Klasifikasi Bidang
                            </label>
                            <select id="filterKodeBidang" onchange="applyLedgerFilter()" class="form-select form-select-sm fw-medium">
                                <option value="semua" selected>Semua Klasifikasi (400, 800, 00)</option>
                                <option value="Kode 400">400 - Catatan Sipil</option>
                                <option value="Kode 800">800 - Kepegawaian</option>
                                <option value="Kode 00">00 - Keuangan</option>
                            </select>
                        </div>
                    </div>

                    <div class="d-flex flex-wrap align-items-center gap-2 flex-shrink-0">
                        <button type="button" onclick="applyLedgerFilter()" class="btn btn-sm btn-primary fw-semibold px-3 py-2 rounded-2 d-inline-flex align-items-center gap-1">
                            <i class="bi bi-funnel-fill" aria-hidden="true"></i>
                            <span>Terapkan</span>
                        </button>
                        <button type="button" data-bs-toggle="modal" data-bs-target="#modalExportInfo" class="btn btn-sm btn-success fw-semibold px-3 py-2 rounded-2 d-inline-flex align-items-center gap-1 shadow-sm">
                            <i class="bi bi-file-earmark-excel-fill" aria-hidden="true"></i>
                            <span>Export Excel</span>
                        </button>
                        <button type="button" onclick="window.print()" class="btn btn-sm btn-danger fw-semibold px-3 py-2 rounded-2 d-inline-flex align-items-center gap-1 shadow-sm">
                            <i class="bi bi-file-earmark-pdf-fill" aria-hidden="true"></i>
                            <span>Cetak Rekap PDF</span>
                        </button>
                    </div>
                </div>
            </div>

            <div class="row g-3 mb-4">
                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="surface-card p-3 h-100 d-flex align-items-center justify-content-between" style="cursor: pointer;" onclick="selectLedgerTab('semua', this)">
                        <div>
                            <div class="text-secondary fw-medium mb-1" style="font-size: 0.76rem;">Total Agenda Bulan Ini</div>
                            <div class="fs-4 fw-bold text-dark lh-1 mb-1">312</div>
                            <div class="text-primary fw-medium" style="font-size: 0.72rem;">
                                <i class="bi bi-journal-check me-1" aria-hidden="true"></i>Periode November 2026
                            </div>
                        </div>
                        <div class="mini-stat-icon" style="background-color: #DBEAFE; color: #2563EB;">
                            <i class="bi bi-journals" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="surface-card p-3 h-100 d-flex align-items-center justify-content-between" style="cursor: pointer;" onclick="selectLedgerTab('Surat Keluar', this)">
                        <div>
                            <div class="text-secondary fw-medium mb-1" style="font-size: 0.76rem;">Total Surat Keluar Ber-TTE</div>
                            <div class="fs-4 fw-bold text-success lh-1 mb-1">142</div>
                            <div class="text-success fw-medium" style="font-size: 0.72rem;">
                                <i class="bi bi-qr-code me-1" aria-hidden="true"></i>Tervalidasi QR Code UUID
                            </div>
                        </div>
                        <div class="mini-stat-icon" style="background-color: #DCFCE7; color: #16A34A;">
                            <i class="bi bi-patch-check-fill" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="surface-card p-3 h-100 d-flex align-items-center justify-content-between" style="cursor: pointer;" onclick="selectLedgerTab('SPPD', this)">
                        <div>
                            <div class="text-secondary fw-medium mb-1" style="font-size: 0.76rem;">Total SPPD Terbit</div>
                            <div class="fs-4 fw-bold lh-1 mb-1" style="color: #D97706;">34</div>
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
                    <div class="surface-card p-3 h-100 d-flex align-items-center justify-content-between" style="cursor: pointer;" onclick="selectLedgerTab('Berita Acara', this)">
                        <div>
                            <div class="text-secondary fw-medium mb-1" style="font-size: 0.76rem;">Total Berita Acara</div>
                            <div class="fs-4 fw-bold lh-1 mb-1" style="color: #7C3AED;">28</div>
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
                            <button type="button" class="nav-link active" onclick="selectLedgerTab('semua', this)">
                                Semua Naskah <span class="badge rounded-pill bg-primary bg-opacity-10 text-primary ms-1">312</span>
                            </button>
                        </li>
                        <li class="nav-item">
                            <button type="button" class="nav-link" onclick="selectLedgerTab('Surat Masuk', this)">
                                Surat Masuk <span class="badge rounded-pill bg-secondary bg-opacity-10 text-secondary ms-1">108</span>
                            </button>
                        </li>
                        <li class="nav-item">
                            <button type="button" class="nav-link" onclick="selectLedgerTab('Surat Keluar', this)">
                                Surat Keluar <span class="badge rounded-pill bg-secondary bg-opacity-10 text-secondary ms-1">142</span>
                            </button>
                        </li>
                        <li class="nav-item">
                            <button type="button" class="nav-link" onclick="selectLedgerTab('SPPD', this)">
                                SPPD <span class="badge rounded-pill bg-secondary bg-opacity-10 text-secondary ms-1">34</span>
                            </button>
                        </li>
                        <li class="nav-item">
                            <button type="button" class="nav-link" onclick="selectLedgerTab('Berita Acara', this)">
                                Berita Acara <span class="badge rounded-pill bg-secondary bg-opacity-10 text-secondary ms-1">28</span>
                            </button>
                        </li>
                    </ul>

                    <div class="pb-2 d-flex align-items-center gap-2">
                        <div class="input-group input-group-sm" style="width: 245px;">
                            <span class="input-group-text bg-white border-end-0 text-secondary">
                                <i class="bi bi-search" aria-hidden="true"></i>
                            </span>
                            <input type="text" id="ledgerSearchInput" onkeyup="applyLedgerFilter()" class="form-control border-start-0 ps-0" placeholder="Cari nomor surat / perihal...">
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
                            <tr data-kategori="Surat Keluar" data-kode="Kode 400">
                                <td class="ps-4">
                                    <span class="fw-bold text-dark font-monospace">#AG-2763</span>
                                </td>
                                <td class="text-secondary">12 Nov 2026</td>
                                <td>
                                    <div class="doc-number-mono text-primary">400/2763/disdukcapil/2026</div>
                                    <span class="badge bg-primary bg-opacity-10 text-primary fw-medium mt-1" style="font-size: 0.68rem;">
                                        Kode 400 - Catatan Sipil
                                    </span>
                                </td>
                                <td>
                                    <span class="badge rounded-2 px-2 py-1 fw-semibold" style="background-color: #DBEAFE; color: #1D4ED8; font-size: 0.72rem;">
                                        <i class="bi bi-send-fill me-1" aria-hidden="true"></i>Surat Keluar
                                    </span>
                                </td>
                                <td>
                                    <div class="fw-semibold text-dark">Ditjen Dukcapil Kemendagri RI</div>
                                    <div class="text-secondary" style="font-size: 0.73rem;">Tujuan: Jakarta Pusat</div>
                                </td>
                                <td>
                                    <div class="text-dark fw-medium">Penyampaian Laporan Rekapitulasi Penerbitan Akta Pencatatan Sipil Semester II</div>
                                </td>
                                <td>
                                    <span class="badge rounded-pill fw-medium px-2 py-1" style="background-color: #DCFCE7; color: #15803D; font-size: 0.72rem;">
                                        <i class="bi bi-qr-code me-1" aria-hidden="true"></i>Sah Ber-TTE Kadin
                                    </span>
                                </td>
                                <td class="pe-4 text-end">
                                    <a href="/verifikasi-dokumen" class="btn btn-sm btn-outline-primary fw-medium px-2 py-1 d-inline-flex align-items-center gap-1" style="font-size: 0.74rem;">
                                        <i class="bi bi-file-earmark-pdf" aria-hidden="true"></i> Lihat Arsip
                                    </a>
                                </td>
                            </tr>

                            <tr data-kategori="Surat Masuk" data-kode="Kode 400">
                                <td class="ps-4">
                                    <span class="fw-bold text-dark font-monospace">#SM-0142</span>
                                </td>
                                <td class="text-secondary">10 Nov 2026</td>
                                <td>
                                    <div class="doc-number-mono text-dark">005/341/Setda-OKI/2026</div>
                                    <span class="badge bg-info bg-opacity-10 text-dark border border-info-subtle fw-medium mt-1" style="font-size: 0.68rem;">
                                        Disposisi ke Kode 400
                                    </span>
                                </td>
                                <td>
                                    <span class="badge rounded-2 px-2 py-1 fw-semibold" style="background-color: #E0F2FE; color: #0369A1; font-size: 0.72rem;">
                                        <i class="bi bi-inbox-fill me-1" aria-hidden="true"></i>Surat Masuk
                                    </span>
                                </td>
                                <td>
                                    <div class="fw-semibold text-dark">Sekretariat Daerah Kab. OKI</div>
                                    <div class="text-secondary" style="font-size: 0.73rem;">Ajudan: Rizky Pratama, S.IP</div>
                                </td>
                                <td>
                                    <div class="text-dark fw-medium">Permintaan Data Agregat Kependudukan Bersih (DAK2) Semester II</div>
                                </td>
                                <td>
                                    <span class="badge rounded-pill fw-medium px-2 py-1" style="background-color: #DCFCE7; color: #15803D; font-size: 0.72rem;">
                                        <i class="bi bi-check2-all me-1" aria-hidden="true"></i>Disposisi Selesai
                                    </span>
                                </td>
                                <td class="pe-4 text-end">
                                    <a href="{{ auth()->user()->role === 'kadin' ? '/kadin/disposisi' : '/verifikasi-dokumen' }}" class="btn btn-sm btn-outline-primary fw-medium px-2 py-1 d-inline-flex align-items-center gap-1" style="font-size: 0.74rem;">
                                        <i class="bi bi-file-earmark-pdf" aria-hidden="true"></i> Lihat Arsip
                                    </a>
                                </td>
                            </tr>

                            <tr data-kategori="SPPD" data-kode="Kode 800">
                                <td class="ps-4">
                                    <span class="fw-bold text-dark font-monospace">#SP-0091</span>
                                </td>
                                <td class="text-secondary">12 Nov 2026</td>
                                <td>
                                    <div class="doc-number-mono text-dark">090/091/SPPD/DUKCAPIL/2026</div>
                                    <span class="badge bg-warning bg-opacity-15 text-dark fw-medium mt-1" style="font-size: 0.68rem;">
                                        Kode 800 - Kepegawaian
                                    </span>
                                </td>
                                <td>
                                    <span class="badge rounded-2 px-2 py-1 fw-semibold" style="background-color: #FEF3C7; color: #B45309; font-size: 0.72rem;">
                                        <i class="bi bi-briefcase-fill me-1" aria-hidden="true"></i>SPPD
                                    </span>
                                </td>
                                <td>
                                    <div class="fw-semibold text-dark">Drs. H. Ahmad Fauzi, M.Si</div>
                                    <div class="text-secondary" style="font-size: 0.73rem;">Tujuan: Dukcapil Prov. Sumsel</div>
                                </td>
                                <td>
                                    <div class="text-dark fw-medium">Rapat Koordinasi Teknis Pemutakhiran Data &amp; Rekonsiliasi Blangko KTP-el</div>
                                </td>
                                <td>
                                    <span class="badge rounded-pill fw-medium px-2 py-1" style="background-color: #DCFCE7; color: #15803D; font-size: 0.72rem;">
                                        <i class="bi bi-qr-code me-1" aria-hidden="true"></i>Sah Ber-TTE Kadin
                                    </span>
                                </td>
                                <td class="pe-4 text-end">
                                    <a href="/verifikasi-dokumen" class="btn btn-sm btn-outline-primary fw-medium px-2 py-1 d-inline-flex align-items-center gap-1" style="font-size: 0.74rem;">
                                        <i class="bi bi-file-earmark-pdf" aria-hidden="true"></i> Lihat Arsip
                                    </a>
                                </td>
                            </tr>

                            <tr data-kategori="Berita Acara" data-kode="Kode 400">
                                <td class="ps-4">
                                    <span class="fw-bold text-dark font-monospace">#BA-0028</span>
                                </td>
                                <td class="text-secondary">11 Nov 2026</td>
                                <td>
                                    <div class="doc-number-mono text-dark">400/028/BA-SIAK/XI/2026</div>
                                    <span class="badge bg-primary bg-opacity-10 text-primary fw-medium mt-1" style="font-size: 0.68rem;">
                                        Kode 400 - Catatan Sipil
                                    </span>
                                </td>
                                <td>
                                    <span class="badge rounded-2 px-2 py-1 fw-semibold" style="background-color: #EDE9FE; color: #6D28D9; font-size: 0.72rem;">
                                        <i class="bi bi-file-earmark-text-fill me-1" aria-hidden="true"></i>Berita Acara
                                    </span>
                                </td>
                                <td>
                                    <div class="fw-semibold text-dark">Kantor Kecamatan Kayuagung</div>
                                    <div class="text-secondary" style="font-size: 0.73rem;">Pihak II: Camat Kayuagung</div>
                                </td>
                                <td>
                                    <div class="text-dark fw-medium">Berita Acara Serah Terima (BAST) Distribusi 1.500 Keping Blangko KTP-el</div>
                                </td>
                                <td>
                                    <span class="badge rounded-pill fw-medium px-2 py-1" style="background-color: #DCFCE7; color: #15803D; font-size: 0.72rem;">
                                        <i class="bi bi-qr-code me-1" aria-hidden="true"></i>Sah Ber-TTE Kadin
                                    </span>
                                </td>
                                <td class="pe-4 text-end">
                                    <a href="/verifikasi-dokumen" class="btn btn-sm btn-outline-primary fw-medium px-2 py-1 d-inline-flex align-items-center gap-1" style="font-size: 0.74rem;">
                                        <i class="bi bi-file-earmark-pdf" aria-hidden="true"></i> Lihat Arsip
                                    </a>
                                </td>
                            </tr>

                            <tr data-kategori="Surat Keluar" data-kode="Kode 00">
                                <td class="ps-4">
                                    <span class="fw-bold text-dark font-monospace">#AG-2762</span>
                                </td>
                                <td class="text-secondary">09 Nov 2026</td>
                                <td>
                                    <div class="doc-number-mono text-primary">00/2762/disdukcapil/2026</div>
                                    <span class="badge bg-secondary bg-opacity-10 text-dark border fw-medium mt-1" style="font-size: 0.68rem;">
                                        Kode 00 - Keuangan
                                    </span>
                                </td>
                                <td>
                                    <span class="badge rounded-2 px-2 py-1 fw-semibold" style="background-color: #DBEAFE; color: #1D4ED8; font-size: 0.72rem;">
                                        <i class="bi bi-send-fill me-1" aria-hidden="true"></i>Surat Keluar
                                    </span>
                                </td>
                                <td>
                                    <div class="fw-semibold text-dark">BPKAD Kabupaten OKI</div>
                                    <div class="text-secondary" style="font-size: 0.73rem;">Tujuan: Kayuagung</div>
                                </td>
                                <td>
                                    <div class="text-dark fw-medium">Pengajuan SPP-GU dan Laporan Realisasi Dana Operasional Pelayanan Keliling</div>
                                </td>
                                <td>
                                    <span class="badge rounded-pill fw-medium px-2 py-1" style="background-color: #FEF3C7; color: #B45309; font-size: 0.72rem;">
                                        <i class="bi bi-hourglass-split me-1" aria-hidden="true"></i>Antrean TTE Kadin
                                    </span>
                                </td>
                                <td class="pe-4 text-end">
                                    <a href="{{ auth()->user()->role === 'kadin' ? '/kadin/validasi' : (in_array(auth()->user()->role, ['kasubbag', 'sekdin']) ? '/verifikasi-hierarki' : '/verifikasi-dokumen') }}" class="btn btn-sm btn-outline-primary fw-medium px-2 py-1 d-inline-flex align-items-center gap-1" style="font-size: 0.74rem;">
                                        <i class="bi bi-file-earmark-pdf" aria-hidden="true"></i> Lihat Arsip
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="card-footer bg-white border-top px-4 py-3 d-flex flex-column flex-sm-row align-items-sm-center justify-content-between gap-2">
                    <span class="text-secondary" style="font-size: 0.76rem;">
                        Menampilkan <strong>1 &ndash; 5</strong> dari <strong>312</strong> rekaman buku besar naskah dinas
                    </span>
                    <nav aria-label="Navigasi halaman buku besar">
                        <ul class="pagination pagination-sm mb-0">
                            <li class="page-item disabled"><button type="button" class="page-link">Sebelumnya</button></li>
                            <li class="page-item active"><button type="button" class="page-link">1</button></li>
                            <li class="page-item"><button type="button" class="page-link" onclick="applyLedgerFilter()">2</button></li>
                            <li class="page-item"><button type="button" class="page-link" onclick="applyLedgerFilter()">3</button></li>
                            <li class="page-item"><button type="button" class="page-link" onclick="applyLedgerFilter()">Selanjutnya</button></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </main>

        <footer class="bg-white border-top px-4 py-3 d-flex flex-column flex-sm-row align-items-center justify-content-between text-secondary" style="font-size: 0.75rem;">
            <div>&copy; 2026 <strong class="text-dark">Disdukcapil Kabupaten Ogan Komering Ilir</strong>. Hak Cipta Dilindungi.</div>
            <div>Aplikasi Tata Naskah Dinas Elektronik (TNDE) OKI Mandira</div>
        </footer>
    </div>
</div>

<div class="modal fade" id="modalExportInfo" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow rounded-3">
            <div class="modal-header border-bottom px-4 py-3">
                <h6 class="modal-title fw-bold text-dark d-flex align-items-center gap-2">
                    <i class="bi bi-file-earmark-excel-fill text-success" aria-hidden="true"></i>
                    <span>Ekspor Buku Besar Persuratan (Excel .XLSX)</span>
                </h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body p-4 small">
                <p class="text-secondary mb-3">Rekapitulasi Buku Besar Persuratan Disdukcapil OKI siap diunduh sesuai filter yang aktif:</p>
                <div class="p-3 rounded-2 bg-light border mb-0">
                    <div class="fw-bold text-dark mb-1">Berkas: Buku_Besar_Disdukcapil_OKI_Nov2026.xlsx</div>
                    <div class="text-secondary">Mencakup Nomor Agenda, Klasifikasi (400/800/00), Riwayat Disposisi Ajudan, &amp; Token UUID TTE.</div>
                </div>
            </div>
            <div class="modal-footer border-top px-4 py-2">
                <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-sm btn-success fw-semibold" data-bs-dismiss="modal"><i class="bi bi-download me-1"></i>Unduh Sekarang</button>
            </div>
        </div>
    </div>
</div>

@if(auth()->user()->role === 'kadin')
<div class="modal fade" id="modalPinTte" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow rounded-3">
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
                    <label class="form-label fw-semibold small text-dark mb-1">PIN / Passphrase TTE Saat Ini</label>
                    <input type="password" class="form-control form-control-sm" value="••••••••••••">
                </div>
                <div class="mb-0">
                    <label class="form-label fw-semibold small text-dark mb-1">PIN / Passphrase TTE Baru (6 Digit)</label>
                    <input type="password" class="form-control form-control-sm" placeholder="Masukkan 6 digit PIN baru...">
                </div>
            </div>
            <div class="modal-footer border-top px-4 py-2">
                <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-sm btn-primary fw-semibold" data-bs-dismiss="modal">Simpan Perubahan PIN</button>
            </div>
        </div>
    </div>
</div>
@endif

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    localStorage.removeItem('esurat_locked_role');

    function selectLedgerTab(category, btnEl) {
        document.getElementById('filterJenisNaskah').value = category;
        if (btnEl && btnEl.classList.contains('nav-link')) {
            document.querySelectorAll('#ledgerTabNav .nav-link').forEach(function(el) {
                el.classList.remove('active');
            });
            btnEl.classList.add('active');
        }
        applyLedgerFilter();
    }

    function applyLedgerFilter() {
        const jenis = document.getElementById('filterJenisNaskah').value;
        const kode = document.getElementById('filterKodeBidang').value;
        const q = (document.getElementById('ledgerSearchInput').value || '').toLowerCase();

        document.querySelectorAll('#ledgerDataTable tbody tr').forEach(function(row) {
            const rowKategori = row.getAttribute('data-kategori') || '';
            const rowKode = row.getAttribute('data-kode') || '';
            const textMatch = row.innerText.toLowerCase().includes(q);
            const jenisMatch = (jenis === 'semua') || (rowKategori === jenis);
            const kodeMatch = (kode === 'semua') || (rowKode === kode);
            row.style.display = (textMatch && jenisMatch && kodeMatch) ? '' : 'none';
        });
    }
</script>
</body>
</html>
