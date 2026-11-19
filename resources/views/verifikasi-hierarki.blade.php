<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Hierarki Berjenjang - Disdukcapil OKI</title>
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
            padding: 0.9rem 0.9rem;
            vertical-align: middle;
            border-bottom: 1px solid #F3F4F6;
            font-size: 0.81rem;
        }

        .table-ledger tbody tr:hover {
            background-color: #F8FAFC;
        }

        .table-ledger tbody tr.active-row {
            background-color: #EFF6FF;
        }

        .doc-number-mono {
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.78rem;
            font-weight: 600;
        }

        .role-switcher-pill {
            border: 1px solid var(--color-slate-200);
            border-radius: var(--radius-md);
            padding: 0.55rem 0.9rem;
            background-color: var(--color-slate-50);
            cursor: default;
            transition: all 0.15s ease;
        }

        .role-switcher-pill.active-stage {
            border-color: var(--color-blue-600);
            background-color: #EFF6FF;
        }

        .a4-paper {
            background-color: #FFFFFF;
            padding: 2.5rem 2.75rem;
            border: 1px solid var(--color-slate-200);
            font-family: 'Times New Roman', Times, serif;
            color: #000000;
            line-height: 1.58;
            position: relative;
            overflow: hidden;
        }

        .draft-watermark {
            position: absolute;
            top: 46%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-24deg);
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 1.35rem;
            font-weight: 800;
            letter-spacing: 0.08em;
            color: rgba(217, 119, 6, 0.14);
            border: 3px dashed rgba(217, 119, 6, 0.22);
            padding: 0.65rem 1.5rem;
            border-radius: 0.5rem;
            white-space: nowrap;
            pointer-events: none;
            z-index: 1;
        }

        .kop-line {
            border-top: 3px solid #000000;
            border-bottom: 1px solid #000000;
            height: 6px;
            margin-top: 0.5rem;
            margin-bottom: 1.35rem;
        }

        .qr-locked-box {
            border: 2px dashed #94A3B8;
            background-color: #F8FAFC;
            border-radius: var(--radius-md);
            padding: 0.85rem 1rem;
            font-family: 'Inter', sans-serif;
        }

        .timeline-step {
            position: relative;
            padding-left: 2.4rem;
            padding-bottom: 1.15rem;
        }

        .timeline-step:last-child {
            padding-bottom: 0;
        }

        .timeline-step::before {
            content: '';
            position: absolute;
            left: 13px;
            top: 26px;
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
            width: 28px;
            height: 28px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.82rem;
        }

        .checklist-item {
            background-color: var(--color-slate-50);
            border: 1px solid var(--color-slate-200);
            border-radius: var(--radius-md);
            padding: 0.65rem 0.85rem;
        }
    </style>
</head>
<body>
@php
    $authUser = auth()->user();
    $userRole = $authUser->role ?? 'kasubbag';
    $userName = $authUser->nama_lengkap ?? 'Pejabat Verifikator';
    $userJabatan = $authUser->jabatan ?? 'Verifikator Berjenjang';
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

    $activeQueueCount = $userRole === 'sekdin' ? ($countTahap2 ?? 0) : ($countTahap1 ?? 0);
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

                <div class="sidebar-section-label">ARSIP &amp; PELAPORAN</div>
                <a href="/buku-besar" class="nav-link-sidebar">
                    <span class="d-flex align-items-center gap-3">
                        <i class="bi bi-journal-bookmark" aria-hidden="true"></i>
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
                <a href="/verifikasi-hierarki" class="nav-link-sidebar active">
                    <span class="d-flex align-items-center gap-3">
                        <i class="bi bi-file-earmark-check-fill" aria-hidden="true"></i>
                        <span>Verifikasi Hierarki Naskah</span>
                    </span>
                    <span class="badge rounded-pill bg-warning text-dark fw-bold" style="font-size: 0.68rem;">{{ $activeQueueCount }}</span>
                </a>

                <div class="sidebar-section-label">ARSIP &amp; PELAPORAN</div>
                <a href="/buku-besar" class="nav-link-sidebar">
                    <span class="d-flex align-items-center gap-3">
                        <i class="bi bi-journal-bookmark" aria-hidden="true"></i>
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
                </a>
                <a href="/kadin/disposisi" class="nav-link-sidebar">
                    <span class="d-flex align-items-center gap-3">
                        <i class="bi bi-inbox" aria-hidden="true"></i>
                        <span>Disposisi Surat Masuk</span>
                    </span>
                </a>

                <div class="sidebar-section-label">ARSIP &amp; PELAPORAN</div>
                <a href="/buku-besar" class="nav-link-sidebar">
                    <span class="d-flex align-items-center gap-3">
                        <i class="bi bi-journal-bookmark" aria-hidden="true"></i>
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
                <span class="text-secondary">Verifikasi Hierarki</span>
                <span class="text-secondary mx-1">/</span>
                <span class="text-primary fw-medium">{{ auth()->user()->role === 'sekdin' ? 'Paraf Tahap 2 (Sekretaris Dinas)' : 'Pemeriksaan Tahap 1 (Kasubbag Umpeg)' }}</span>
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
                        <li><a class="dropdown-item" href="/buku-besar"><i class="bi bi-journal-bookmark me-2"></i>Buku Besar Persuratan</a></li>
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

            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show py-2 px-3 mb-3 border-0 shadow-sm" role="alert" style="background-color: #FEE2E2; color: #B91C1C; font-size: 0.8rem;">
                    <div class="fw-bold mb-1"><i class="bi bi-exclamation-triangle-fill me-1"></i>Validasi Verifikasi Gagal:</div>
                    <ul class="mb-0 ps-3">
                        @foreach ($errors->all() as $err)
                            <li>{{ $err }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup" style="font-size: 0.65rem;"></button>
                </div>
            @endif

            <div class="surface-card p-3 px-4 mb-4">
                <div class="d-flex flex-column flex-xl-row align-items-xl-center justify-content-between gap-3">
                    <div>
                        <div class="d-flex align-items-center gap-2 mb-1">
                            <span class="badge rounded-pill px-2 py-1 fw-semibold" style="background-color: #DBEAFE; color: #1D4ED8; font-size: 0.7rem;">
                                <i class="bi bi-shield-lock-fill me-1" aria-hidden="true"></i>Otoritas Verifikasi Berjenjang Terkunci (Single Gate RBAC)
                            </span>
                            <span class="text-secondary" style="font-size: 0.74rem;">
                                Antrean dikunci otomatis pada status <code>{{ $targetStatus }}</code> sesuai role pejabat
                            </span>
                        </div>
                        <h6 class="fw-bold text-dark mb-0">Meja Kerja Pemeriksaan Konsep Surat Keluar, SPPD, &amp; Berita Acara</h6>
                    </div>

                    <div class="d-flex flex-wrap align-items-center gap-2">
                        @if(auth()->user()->role === 'sekdin')
                            <div class="role-switcher-pill active-stage d-flex align-items-center gap-2">
                                <span class="badge rounded-circle bg-primary text-white">2</span>
                                <div>
                                    <div class="fw-bold text-primary" style="font-size: 0.76rem;">Tahap 2 Aktif: Sekretaris Dinas (Sekdin)</div>
                                    <div class="text-secondary" style="font-size: 0.68rem;">{{ $userName }} &bull; NIP {{ $userNip }}</div>
                                </div>
                            </div>
                        @else
                            <div class="role-switcher-pill active-stage d-flex align-items-center gap-2">
                                <span class="badge rounded-circle bg-primary text-white">1</span>
                                <div>
                                    <div class="fw-bold text-primary" style="font-size: 0.76rem;">Tahap 1 Aktif: Kasubbag Umum &amp; Kepegawaian</div>
                                    <div class="text-secondary" style="font-size: 0.68rem;">{{ $userName }} &bull; NIP {{ $userNip }}</div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="row g-3 mb-4">
                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="surface-card p-3 h-100 d-flex align-items-center justify-content-between" style="{{ $userRole === 'kasubbag' ? 'border-color: #F59E0B; background-color: #FFFBEB;' : '' }}">
                        <div>
                            <div class="text-secondary fw-medium mb-1" style="font-size: 0.75rem;">Menunggu Verifikasi Tahap 1 Kasubbag</div>
                            <div class="fs-4 fw-bold lh-1 mb-1" style="color: #D97706;">{{ $countTahap1 }}</div>
                            <div class="fw-medium" style="font-size: 0.72rem; color: #B45309;">
                                <i class="bi bi-hourglass-split me-1" aria-hidden="true"></i>Status <code>draf</code> dari Staf Admin
                            </div>
                        </div>
                        <div class="mini-stat-icon" style="background-color: #FEF3C7; color: #D97706;">
                            <i class="bi bi-clipboard2-check-fill" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="surface-card p-3 h-100 d-flex align-items-center justify-content-between" style="{{ $userRole === 'sekdin' ? 'border-color: #2563EB; background-color: #EFF6FF;' : '' }}">
                        <div>
                            <div class="text-secondary fw-medium mb-1" style="font-size: 0.75rem;">Menunggu Paraf Tahap 2 Sekdin</div>
                            <div class="fs-4 fw-bold text-primary lh-1 mb-1">{{ $countTahap2 }}</div>
                            <div class="text-primary fw-medium" style="font-size: 0.72rem;">
                                <i class="bi bi-check2-circle me-1" aria-hidden="true"></i>Status <code>valid_kasubbag</code>
                            </div>
                        </div>
                        <div class="mini-stat-icon" style="background-color: #DBEAFE; color: #2563EB;">
                            <i class="bi bi-pen-fill" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="surface-card p-3 h-100 d-flex align-items-center justify-content-between">
                        <div>
                            <div class="text-secondary fw-medium mb-1" style="font-size: 0.75rem;">Dikembalikan untuk Revisi</div>
                            <div class="fs-4 fw-bold text-danger lh-1 mb-1">{{ $countRevisi }}</div>
                            <div class="text-danger fw-medium" style="font-size: 0.72rem;">
                                <i class="bi bi-arrow-counterclockwise me-1" aria-hidden="true"></i>Status <code>revisi</code> di Staf Admin
                            </div>
                        </div>
                        <div class="mini-stat-icon" style="background-color: #FEE2E2; color: #DC2626;">
                            <i class="bi bi-exclamation-triangle-fill" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-xl-3">
                    <a href="/buku-besar" class="text-decoration-none">
                        <div class="surface-card p-3 h-100 d-flex align-items-center justify-content-between">
                            <div>
                                <div class="text-secondary fw-medium mb-1" style="font-size: 0.75rem;">Diteruskan ke TTE Kadin</div>
                                <div class="fs-4 fw-bold text-success lh-1 mb-1">{{ $countDiteruskanKadin }}</div>
                                <div class="text-success fw-medium" style="font-size: 0.72rem;">
                                    <i class="bi bi-shield-fill-check me-1" aria-hidden="true"></i>{{ $countMenungguTteKadin }} antrean &bull; {{ $countSelesaiTteKadin }} sah TTE
                                </div>
                            </div>
                            <div class="mini-stat-icon" style="background-color: #DCFCE7; color: #16A34A;">
                                <i class="bi bi-send-check-fill" aria-hidden="true"></i>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <div class="row g-4">
                <div class="col-12 col-lg-7">
                    <div class="surface-card overflow-hidden mb-4">
                        <div class="px-4 py-3 border-bottom d-flex flex-wrap align-items-center justify-content-between gap-2">
                            <div class="d-flex align-items-center gap-2">
                                <div class="mini-stat-icon" style="width: 36px; height: 36px; font-size: 1rem; background-color: #DBEAFE; color: #2563EB;">
                                    <i class="bi bi-file-earmark-richtext-fill" aria-hidden="true"></i>
                                </div>
                                <div>
                                    <div class="d-flex align-items-center gap-2">
                                        <h6 class="fw-bold text-dark mb-0" style="font-size: 0.88rem;">Pratinjau Konsep Naskah Dinas (A4 Resmi)</h6>
                                        <span id="headerPreviewJenisBadge" class="badge rounded-2 px-2 py-1 fw-semibold" style="background-color: {{ $activeKonsep['jenis_badge_bg'] ?? '#DBEAFE' }}; color: {{ $activeKonsep['jenis_badge_color'] ?? '#1D4ED8' }}; font-size: 0.68rem;">
                                            {{ $activeKonsep['jenis_label'] ?? 'Naskah Dinas' }}
                                        </span>
                                    </div>
                                    <div class="text-secondary" style="font-size: 0.73rem;">
                                        Nomor Konsep: <span id="headerPreviewNo" class="doc-number-mono text-primary">{{ $activeKonsep['nomor'] ?? '-' }}</span>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex flex-wrap align-items-center gap-2">
                                <button type="button" id="btnPreviewLampiran"
                                        class="btn btn-sm btn-outline-primary py-1 px-2 d-inline-flex align-items-center gap-1 {{ empty($activeKonsep['file_url']) ? 'd-none' : '' }}"
                                        style="font-size: 0.72rem;"
                                        onclick="openModalLampiran()">
                                    <i class="bi bi-paperclip"></i>
                                    <span>Pratinjau Lampiran Unggahan</span>
                                </button>
                                <span id="badgeNoLampiran" class="badge bg-light text-secondary border fw-normal {{ !empty($activeKonsep['file_url']) ? 'd-none' : '' }}" style="font-size: 0.68rem;">
                                    <i class="bi bi-file-earmark-text me-1"></i>Konsep Digital TNDE
                                </span>

                                @if(auth()->user()->role === 'sekdin')
                                    <span id="stageHeaderBadge" class="badge rounded-pill px-3 py-1 fw-semibold" style="background-color: #DBEAFE; color: #1D4ED8; font-size: 0.71rem;">
                                        <i class="bi bi-pen-fill me-1" aria-hidden="true"></i>Paraf Tahap 2: Sekretaris Dinas
                                    </span>
                                @else
                                    <span id="stageHeaderBadge" class="badge rounded-pill px-3 py-1 fw-semibold" style="background-color: #FEF3C7; color: #B45309; font-size: 0.71rem;">
                                        <i class="bi bi-eye-fill me-1" aria-hidden="true"></i>Pemeriksaan Tahap 1: Kasubbag Umpeg
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="p-3 p-md-4" style="background-color: var(--color-slate-50);">
                            @if($activeKonsep)
                                <div class="a4-paper rounded-2 shadow-sm mx-auto">
                                    <div class="draft-watermark" id="paperWatermark">
                                        {{ $userRole === 'sekdin' ? 'LOLOS VERIFIKASI KASUBBAG - MENUNGGU PARAF SEKDIN' : 'KONSEP NASKAH - MENUNGGU VERIFIKASI KASUBBAG' }}
                                    </div>

                                    <div class="d-flex align-items-center gap-3 text-center">
                                        <div class="d-flex align-items-center justify-content-center flex-shrink-0" style="width: 64px; height: 72px;">
                                            <div class="border border-2 border-dark rounded-3 d-flex align-items-center justify-content-center w-100 h-100 bg-light">
                                                <i class="bi bi-shield-shaded fs-1 text-dark" aria-hidden="true"></i>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1">
                                            <div class="fw-bold" style="font-size: 0.96rem; letter-spacing: 0.03em;">PEMERINTAH KABUPATEN OGAN KOMERING ILIR</div>
                                            <div class="fw-bold" style="font-size: 1.14rem; letter-spacing: 0.02em;">DINAS KEPENDUDUKAN DAN PENCATATAN SIPIL</div>
                                            <div style="font-size: 0.76rem;">Jl. Letnan Muchtar Saleh No. 01, Kayuagung, Kab. Ogan Komering Ilir, Sumatera Selatan 30611</div>
                                            <div style="font-size: 0.73rem;">Telepon: (0712) 321456 &bull; Pos-el: disdukcapil@kaboki.go.id &bull; Laman: capil.kaboki.go.id</div>
                                        </div>
                                    </div>

                                    <div class="kop-line"></div>

                                    {{-- TEMPLATE 1: SURAT KELUAR --}}
                                    <div id="a4SectionSuratKeluar" class="{{ $activeKonsep['jenis'] === 'surat_keluar' ? '' : 'd-none' }}">
                                        <div class="d-flex justify-content-between align-items-start mb-3" style="font-size: 0.9rem;">
                                            <table class="table table-borderless table-sm mb-0" style="width: auto; font-size: 0.9rem;">
                                                <tbody>
                                                    <tr>
                                                        <td class="p-0 pe-3">Nomor</td>
                                                        <td class="p-0 pe-2">:</td>
                                                        <td class="p-0 fw-bold" id="paperNoText">{{ $activeKonsep['nomor'] }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="p-0 pe-3">Sifat</td>
                                                        <td class="p-0 pe-2">:</td>
                                                        <td class="p-0" id="paperSifatText">{{ $activeKonsep['sifat'] }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="p-0 pe-3">Lampiran</td>
                                                        <td class="p-0 pe-2">:</td>
                                                        <td class="p-0" id="paperLampiranText">{{ $activeKonsep['lampiran'] }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="p-0 pe-3">Perihal</td>
                                                        <td class="p-0 pe-2">:</td>
                                                        <td class="p-0 fw-bold text-decoration-underline" id="paperPerihalText">{{ $activeKonsep['perihal'] }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <div class="text-end flex-shrink-0">
                                                <div>Kayuagung, <span id="paperTanggalText">{{ $activeKonsep['tanggal_display'] }}</span></div>
                                            </div>
                                        </div>

                                        <div class="mb-3" style="font-size: 0.9rem;">
                                            <div>Kepada Yth.</div>
                                            <div class="fw-bold" id="paperTujuanText">{{ $activeKonsep['tujuan'] }}</div>
                                            <div>di -</div>
                                            <div class="ps-4 fw-semibold">Tempat</div>
                                        </div>

                                        <div style="font-size: 0.91rem; text-align: justify;">
                                            <p class="mb-3" style="text-indent: 2rem;">
                                                Dalam rangka pelaksanaan tertib administrasi kependudukan serta peningkatan kualitas pelayanan publik pada Dinas Kependudukan dan Pencatatan Sipil Kabupaten Ogan Komering Ilir, bersama ini kami sampaikan naskah dinas terkait <span class="fw-semibold" id="paperBodyPerihalText">{{ $activeKonsep['perihal'] }}</span>.
                                            </p>
                                            <p class="mb-4" style="text-indent: 2rem;">
                                                Seluruh data dan dokumen pendukung yang dilampirkan telah melalui pemeriksaan berjenjang sesuai Tata Naskah Dinas Elektronik (TNDE). Demikian disampaikan, atas perhatian dan kerja sama yang baik diucapkan terima kasih.
                                            </p>
                                        </div>
                                    </div>

                                    {{-- TEMPLATE 2: SPPD --}}
                                    <div id="a4SectionSppd" class="{{ $activeKonsep['jenis'] === 'sppd' ? '' : 'd-none' }}">
                                        <div class="text-center mb-3">
                                            <div class="fw-bold text-decoration-underline" style="font-size: 1rem;">SURAT PERINTAH PERJALANAN DINAS (SPPD)</div>
                                            <div style="font-size: 0.88rem;">Nomor: <span class="fw-bold" id="sppdNomorText">{{ $activeKonsep['nomor'] }}</span></div>
                                        </div>

                                        <table class="table table-bordered border-dark table-sm mb-3" style="font-size: 0.86rem;">
                                            <tbody>
                                                <tr>
                                                    <td style="width: 36%;" class="fw-semibold">1. Pejabat yang Memberi Perintah</td>
                                                    <td>Kepala Dinas Kependudukan dan Pencatatan Sipil Kabupaten OKI</td>
                                                </tr>
                                                <tr>
                                                    <td class="fw-semibold">2. Nama / NIP Pegawai yang Diperintahkan</td>
                                                    <td>
                                                        <div class="fw-bold" id="sppdNamaPegawaiText">{{ $activeKonsep['extra']['nama_pegawai'] ?? '-' }}</div>
                                                        <div>NIP. <span id="sppdNipPegawaiText">{{ $activeKonsep['extra']['nip_pegawai'] ?? '-' }}</span></div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="fw-semibold">3. Jabatan / Instansi</td>
                                                    <td id="sppdJabatanPegawaiText">{{ $activeKonsep['extra']['jabatan_pegawai'] ?? '-' }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="fw-semibold">4. Maksud Perjalanan Dinas</td>
                                                    <td id="sppdUrusanText">{{ $activeKonsep['perihal'] }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="fw-semibold">5. Tempat Berangkat &amp; Tempat Tujuan</td>
                                                    <td>Kayuagung &rarr; <span class="fw-bold" id="sppdTujuanText">{{ $activeKonsep['tujuan'] }}</span></td>
                                                </tr>
                                                <tr>
                                                    <td class="fw-semibold">6. Tanggal Berangkat s/d Tanggal Kembali</td>
                                                    <td>
                                                        <span id="sppdBerangkatText">{{ $activeKonsep['extra']['tanggal_berangkat'] ?? '-' }}</span>
                                                        s/d
                                                        <span id="sppdKembaliText">{{ $activeKonsep['extra']['tanggal_kembali'] ?? '-' }}</span>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <div class="text-end mb-2" style="font-size: 0.86rem;">
                                            Dikeluarkan di: Kayuagung &bull; Pada Tanggal: <span id="sppdTanggalSuratText">{{ $activeKonsep['tanggal_display'] }}</span>
                                        </div>
                                    </div>

                                    {{-- TEMPLATE 3: BERITA ACARA --}}
                                    <div id="a4SectionBeritaAcara" class="{{ $activeKonsep['jenis'] === 'berita_acara' ? '' : 'd-none' }}">
                                        <div class="text-center mb-3">
                                            <div class="fw-bold text-decoration-underline" style="font-size: 1rem;">BERITA ACARA KEDINASAN</div>
                                            <div style="font-size: 0.88rem;">Nomor: <span class="fw-bold" id="baNomorText">{{ $activeKonsep['nomor'] }}</span></div>
                                        </div>

                                        <div style="font-size: 0.9rem; text-align: justify;">
                                            <p class="mb-2" style="text-indent: 2rem;">
                                                Pada tanggal <span class="fw-semibold" id="baTanggalText">{{ $activeKonsep['tanggal_display'] }}</span>, bertempat di Kantor Dinas Kependudukan dan Pencatatan Sipil Kabupaten Ogan Komering Ilir, kami yang bertanda tangan di bawah ini:
                                            </p>
                                            <div class="ps-3 mb-2">
                                                <div><strong>PIHAK PERTAMA:</strong> Dinas Kependudukan dan Pencatatan Sipil Kabupaten Ogan Komering Ilir</div>
                                                <div><strong>PIHAK KEDUA (MITRA):</strong> <span id="baPihakKeduaText" class="fw-bold">{{ $activeKonsep['tujuan'] }}</span></div>
                                            </div>
                                            <p class="mb-3" style="text-indent: 2rem;">
                                                Kedua belah pihak sepakat membuat dan menandatangani Berita Acara tentang <strong id="baPerihalText">{{ $activeKonsep['perihal'] }}</strong> untuk dipergunakan sebagaimana mestinya sesuai ketentuan peraturan perundang-undangan yang berlaku.
                                            </p>
                                        </div>
                                    </div>

                                    <div class="row justify-content-end mt-4">
                                        <div class="col-12 col-sm-7 text-center">
                                            <div class="fw-bold mb-2" style="font-size: 0.88rem;">KEPALA DINAS KEPENDUDUKAN DAN<br>PENCATATAN SIPIL KABUPATEN OKI,</div>

                                            <div class="qr-locked-box my-2 d-flex align-items-center gap-3 text-start">
                                                <div class="bg-white border rounded-2 p-2 d-flex align-items-center justify-content-center flex-shrink-0 text-secondary">
                                                    <i class="bi bi-lock-fill" style="font-size: 2.1rem; line-height: 1;" aria-hidden="true"></i>
                                                </div>
                                                <div>
                                                    <span class="badge bg-secondary mb-1" style="font-size: 0.63rem;">AREA QR CODE TERKUNCI</span>
                                                    <div class="fw-bold text-dark" style="font-size: 0.75rem; line-height: 1.3;">
                                                        Menunggu Validasi Berjenjang (Kasubbag &amp; Sekdin)
                                                    </div>
                                                    <div class="text-secondary" style="font-size: 0.67rem;">QR Code UUID hanya dapat dibuka oleh Kepala Dinas</div>
                                                </div>
                                            </div>

                                            <div class="fw-bold text-decoration-underline mt-2" style="font-size: 0.9rem;">Drs. H. HENDRA SURYADI, M.Si</div>
                                            <div style="font-size: 0.82rem;">Pembina Utama Muda (IV/c)</div>
                                            <div style="font-size: 0.82rem;">NIP. 19710814 199803 1 004</div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="text-center py-5">
                                    <div class="mini-stat-icon mx-auto mb-3" style="width: 54px; height: 54px; background-color: #DCFCE7; color: #16A34A; font-size: 1.5rem;">
                                        <i class="bi bi-check2-all"></i>
                                    </div>
                                    <h6 class="fw-bold text-dark mb-1">Antrean Verifikasi {{ $userRole === 'sekdin' ? 'Tahap 2 (Sekretaris Dinas)' : 'Tahap 1 (Kasubbag Umpeg)' }} Kosong</h6>
                                    <p class="text-secondary small mb-0">
                                        Seluruh konsep naskah dinas pada tahap ini telah selesai diperiksa.
                                    </p>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="surface-card overflow-hidden" id="tabel-antrean-konsep">
                        <div class="px-4 py-3 border-bottom d-flex flex-wrap align-items-center justify-content-between gap-2">
                            <div>
                                <h6 class="fw-bold text-dark mb-0" style="font-size: 0.88rem;">
                                    Antrean Konsep {{ $userRole === 'sekdin' ? 'Tahap 2: Menunggu Paraf Sekdin (valid_kasubbag)' : 'Tahap 1: Menunggu Verifikasi Kasubbag (draf)' }}
                                </h6>
                                <div class="text-secondary" style="font-size: 0.73rem;">Klik "Pilih Konsep" untuk memuat naskah ke lembar pemeriksaan dan mengeksekusi keputusan</div>
                            </div>
                            <span class="badge rounded-pill bg-primary bg-opacity-10 text-primary fw-semibold px-2 py-1" style="font-size: 0.71rem;">
                                {{ $antreanKonsep->count() }} Konsep Aktif
                            </span>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-ledger mb-0">
                                <thead>
                                    <tr>
                                        <th class="ps-4">NOMOR KONSEP &amp; BIDANG</th>
                                        <th>KATEGORI</th>
                                        <th>PERIHAL / PEGAWAI</th>
                                        <th>POSISI HIERARKI</th>
                                        <th class="pe-4 text-end">AKSI</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($antreanKonsep as $item)
                                        @php
                                            $isSelected = $activeKonsep && $activeKonsep['key'] === $item['key'];
                                            $bidangBadgeClass = match($item['kode_bidang']) {
                                                '800' => 'bg-warning bg-opacity-15 text-dark',
                                                '00' => 'bg-secondary bg-opacity-10 text-dark border',
                                                default => 'bg-primary bg-opacity-10 text-primary',
                                            };
                                        @endphp
                                        <tr id="row-{{ $item['key'] }}" class="konsep-row {{ $isSelected ? 'active-row' : '' }}">
                                            <td class="ps-4">
                                                <div class="doc-number-mono text-primary">{{ $item['nomor'] }}</div>
                                                <span class="badge {{ $bidangBadgeClass }} fw-medium mt-1" style="font-size: 0.66rem;">
                                                    Kode {{ $item['kode_bidang'] }} - {{ $item['nama_bidang'] }}
                                                </span>
                                            </td>
                                            <td>
                                                <span class="badge rounded-2 px-2 py-1 fw-semibold" style="background-color: {{ $item['jenis_badge_bg'] }}; color: {{ $item['jenis_badge_color'] }}; font-size: 0.7rem;">
                                                    {{ $item['jenis_label'] }}
                                                </span>
                                            </td>
                                            <td>
                                                <div class="fw-semibold text-dark">{{ \Illuminate\Support\Str::limit($item['perihal'], 68) }}</div>
                                                <div class="text-secondary" style="font-size: 0.72rem;">{{ $item['sub_info'] }}</div>
                                                <div class="d-flex flex-wrap align-items-center gap-2 mt-1">
                                                    <span class="text-secondary" style="font-size: 0.68rem;">
                                                        <i class="bi bi-person-check me-1"></i>Pengaju: {{ $item['pengaju_nama'] }}
                                                    </span>
                                                    @if(!empty($item['file_url']))
                                                        <a href="{{ $item['file_url'] }}" target="_blank" class="badge bg-info bg-opacity-10 text-primary text-decoration-none border border-primary border-opacity-25" style="font-size: 0.65rem;">
                                                            <i class="bi bi-paperclip me-1"></i>Lampiran Tersedia
                                                        </a>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                @if($item['status'] === 'valid_kasubbag')
                                                    <span class="badge rounded-pill fw-medium px-2 py-1" style="background-color: #DBEAFE; color: #1D4ED8; font-size: 0.7rem;">
                                                        <i class="bi bi-check2-circle me-1" aria-hidden="true"></i>Tahap 2: Sekdin
                                                    </span>
                                                @else
                                                    <span class="badge rounded-pill fw-medium px-2 py-1" style="background-color: #FEF3C7; color: #B45309; font-size: 0.7rem;">
                                                        <i class="bi bi-hourglass-split me-1" aria-hidden="true"></i>Tahap 1: Kasubbag
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="pe-4 text-end">
                                                <button type="button"
                                                        id="btn-select-{{ $item['key'] }}"
                                                        onclick="selectKonsepByKey('{{ $item['key'] }}')"
                                                        class="btn btn-sm {{ $isSelected ? 'btn-primary' : 'btn-outline-primary' }} py-1 px-2 btn-pilih-konsep"
                                                        style="font-size: 0.72rem;">
                                                    {{ $isSelected ? 'Sedang Diperiksa' : 'Pilih Konsep' }}
                                                </button>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center py-4 text-secondary">
                                                <i class="bi bi-inbox fs-4 d-block mb-1"></i>
                                                Tidak ada konsep naskah dinas berstatus <code>{{ $targetStatus }}</code> yang menunggu pemeriksaan Anda.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-5">
                    <div class="surface-card mb-4">
                        <div class="px-4 py-3 border-bottom d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center gap-2">
                                <div class="mini-stat-icon" style="width: 36px; height: 36px; font-size: 1rem; background-color: #DBEAFE; color: #2563EB;">
                                    <i class="bi bi-diagram-3-fill" aria-hidden="true"></i>
                                </div>
                                <div>
                                    <h6 class="fw-bold text-dark mb-0" style="font-size: 0.88rem;">Status Alur Hierarki Berjenjang</h6>
                                    <div class="text-secondary" style="font-size: 0.73rem;">Riwayat log verifikasi naskah dinas dari database</div>
                                </div>
                            </div>
                            <span id="timelineActiveBadge" class="badge rounded-pill {{ auth()->user()->role === 'sekdin' ? 'bg-info text-dark' : 'bg-warning text-dark' }} fw-semibold px-2 py-1" style="font-size: 0.69rem;">
                                {{ auth()->user()->role === 'sekdin' ? 'Tahap 2 Aktif' : 'Tahap 1 Aktif' }}
                            </span>
                        </div>

                        <div class="p-4" id="timelineContainer">
                            @php
                                $logsCollection = collect($activeKonsep['logs'] ?? []);
                                $logStaf = $logsCollection->where('tahap_verifikasi', 'staf_admin')->last();
                                $logKasubbag = $logsCollection->where('tahap_verifikasi', 'kasubbag_umpeg')->where('status_aksi', 'valid_kasubbag')->last();
                            @endphp

                            {{-- Step 1: Staf Admin --}}
                            <div class="timeline-step">
                                <div class="timeline-dot" style="background-color: #DCFCE7; color: #16A34A;">
                                    <i class="bi bi-check-circle-fill" aria-hidden="true"></i>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="fw-bold text-dark" style="font-size: 0.83rem;">Staf Admin Umpeg (Pengaju Konsep)</span>
                                    <span class="badge rounded-pill px-2 py-1" style="background-color: #DCFCE7; color: #15803D; font-size: 0.67rem;">Diajukan</span>
                                </div>
                                <div class="text-secondary" style="font-size: 0.76rem;" id="tlStafDesc">
                                    {{ $logStaf['verifikator_nama'] ?? ($activeKonsep['pengaju_nama'] ?? 'Staf Admin Umpeg') }}
                                    &mdash; {{ $logStaf['catatan'] ?? ('Registrasi Nomor ' . ($activeKonsep['nomor'] ?? '-')) }}
                                </div>
                                <div class="text-secondary mt-1 doc-number-mono" style="font-size: 0.7rem;" id="tlStafTime">
                                    <i class="bi bi-clock me-1" aria-hidden="true"></i>{{ $logStaf['waktu'] ?? 'Tercatat di Buku Agenda' }}
                                </div>
                            </div>

                            {{-- Step 2: Kasubbag Umpeg --}}
                            <div class="timeline-step">
                                @if($userRole === 'sekdin' || ($activeKonsep && $activeKonsep['status'] === 'valid_kasubbag'))
                                    <div class="timeline-dot" id="tlKasubbagDot" style="background-color: #DCFCE7; color: #16A34A;">
                                        <i class="bi bi-check-circle-fill" aria-hidden="true"></i>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="fw-bold text-dark" style="font-size: 0.83rem;">Kasubbag Umpeg (Verifikasi Tahap 1)</span>
                                        <span class="badge rounded-pill px-2 py-1" id="tlKasubbagBadge" style="background-color: #DCFCE7; color: #15803D; font-size: 0.67rem;">Disetujui Kasubbag</span>
                                    </div>
                                    <div class="text-secondary" style="font-size: 0.76rem;" id="tlKasubbagDesc">
                                        {{ $logKasubbag['verifikator_nama'] ?? 'Hj. Siti Rahmawati, S.Sos., M.Si' }}
                                        &mdash; {{ $logKasubbag['catatan'] ?? 'Kode klasifikasi & redaksi sesuai standar TNDE.' }}
                                    </div>
                                    <div class="text-secondary mt-1 doc-number-mono" style="font-size: 0.7rem;" id="tlKasubbagTime">
                                        <i class="bi bi-clock me-1" aria-hidden="true"></i>{{ $logKasubbag['waktu'] ?? 'Telah diverifikasi Tahap 1' }}
                                    </div>
                                @else
                                    <div class="timeline-dot" id="tlKasubbagDot" style="background-color: #FEF3C7; color: #D97706; border: 2px solid #F59E0B;">
                                        <i class="bi bi-search" aria-hidden="true"></i>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="fw-bold text-dark" style="font-size: 0.83rem;">Kasubbag Umpeg (Verifikasi Tahap 1)</span>
                                        <span class="badge rounded-pill bg-warning text-dark fw-semibold px-2 py-1" id="tlKasubbagBadge" style="font-size: 0.67rem;">Sedang Diperiksa</span>
                                    </div>
                                    <div class="fw-medium" style="font-size: 0.76rem; color: #B45309;" id="tlKasubbagDesc">
                                        {{ $userName }} &mdash; Pemeriksaan kode klasifikasi, lampiran, &amp; redaksi
                                    </div>
                                    <div class="text-secondary mt-1 doc-number-mono d-none" style="font-size: 0.7rem;" id="tlKasubbagTime"></div>
                                @endif
                            </div>

                            {{-- Step 3: Sekretaris Dinas --}}
                            <div class="timeline-step">
                                @if($userRole === 'sekdin')
                                    <div class="timeline-dot" style="background-color: #DBEAFE; color: #2563EB; border: 2px solid #2563EB;">
                                        <i class="bi bi-vector-pen" aria-hidden="true"></i>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="fw-bold text-dark" style="font-size: 0.83rem;">Sekretaris Dinas (Verifikasi Tahap 2 / Paraf)</span>
                                        <span class="badge rounded-pill bg-primary text-white fw-semibold px-2 py-1" style="font-size: 0.67rem;">Sedang Diparaf</span>
                                    </div>
                                    <div class="fw-medium text-primary" style="font-size: 0.76rem;">
                                        {{ $userName }} &mdash; Paraf koordinasi sebelum diteruskan ke Kepala Dinas
                                    </div>
                                @else
                                    <div class="timeline-dot" style="background-color: #DBEAFE; color: #2563EB;">
                                        <i class="bi bi-vector-pen" aria-hidden="true"></i>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="fw-bold text-dark" style="font-size: 0.83rem;">Sekretaris Dinas (Verifikasi Tahap 2 / Paraf)</span>
                                        <span class="badge rounded-pill px-2 py-1" style="background-color: #DBEAFE; color: #1D4ED8; font-size: 0.67rem;">Tahap Berikutnya</span>
                                    </div>
                                    <div class="text-secondary" style="font-size: 0.76rem;">
                                        Ir. H. Bambang Irawan, M.M &mdash; Paraf koordinasi sebelum naik ke Kadin
                                    </div>
                                @endif
                            </div>

                            {{-- Step 4: Kepala Dinas --}}
                            <div class="timeline-step">
                                <div class="timeline-dot" style="background-color: #F3F4F6; color: #6B7280;">
                                    <i class="bi bi-qr-code" aria-hidden="true"></i>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="fw-bold text-secondary" style="font-size: 0.83rem;">Kepala Dinas (Otorisasi TTE QR Code)</span>
                                    <span class="badge rounded-pill bg-light text-secondary border px-2 py-1" style="font-size: 0.67rem;">Menunggu</span>
                                </div>
                                <div class="text-secondary" style="font-size: 0.76rem;">Drs. H. Hendra Suryadi, M.Si &mdash; Pembubuhan TTE QR Code UUID</div>
                            </div>
                        </div>
                    </div>

                    <form id="formApproveVerifikasi"
                          method="POST"
                          action="{{ $activeKonsep['approve_url'] ?? '#' }}">
                        @csrf

                        <div class="surface-card mb-4">
                            <div class="px-4 py-3 border-bottom d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center gap-2">
                                    <div class="mini-stat-icon" style="width: 36px; height: 36px; font-size: 1rem; background-color: #DCFCE7; color: #16A34A;">
                                        <i class="bi bi-ui-checks" aria-hidden="true"></i>
                                    </div>
                                    <div>
                                        <h6 class="fw-bold text-dark mb-0" style="font-size: 0.88rem;">Checklist Standar Tata Naskah Dinas</h6>
                                        <div class="text-secondary" style="font-size: 0.73rem;">Disimpan ke kolom JSON <code>checklist_pemeriksaan</code> pada <code>log_verifikasi</code></div>
                                    </div>
                                </div>
                            </div>

                            <div class="p-4 d-flex flex-column gap-2">
                                <div class="checklist-item form-check m-0 ps-4">
                                    <input class="form-check-input ms-0 me-2" type="checkbox" name="checklist[kode_klasifikasi]" value="1" id="chk1" checked>
                                    <label class="form-check-label fw-medium text-dark" for="chk1" style="font-size: 0.8rem;">
                                        Kesesuaian <strong>Kode Klasifikasi Bidang (400 / 800 / 00)</strong> &amp; Nomor Urut Buku Agenda
                                    </label>
                                </div>

                                <div class="checklist-item form-check m-0 ps-4">
                                    <input class="form-check-input ms-0 me-2" type="checkbox" name="checklist[kelengkapan_lampiran]" value="1" id="chk2" checked>
                                    <label class="form-check-label fw-medium text-dark" for="chk2" style="font-size: 0.8rem;">
                                        Kelengkapan berkas lampiran pendukung / kesesuaian data pokok naskah dinas
                                    </label>
                                </div>

                                <div class="checklist-item form-check m-0 ps-4">
                                    <input class="form-check-input ms-0 me-2" type="checkbox" name="checklist[ketepatan_redaksi]" value="1" id="chk3" checked>
                                    <label class="form-check-label fw-medium text-dark" for="chk3" style="font-size: 0.8rem;">
                                        Ketepatan redaksi naskah, tata bahasa kedinasan, serta pihak/instansi tujuan
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="surface-card">
                            <div class="px-4 py-3 border-bottom d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center gap-2">
                                    <div class="mini-stat-icon" style="width: 36px; height: 36px; font-size: 1rem; background-color: #FEF3C7; color: #D97706;">
                                        <i class="bi bi-check2-square" aria-hidden="true"></i>
                                    </div>
                                    <div>
                                        <h6 class="fw-bold text-dark mb-0" style="font-size: 0.88rem;">Eksekusi Keputusan Verifikasi</h6>
                                        <div class="text-secondary" style="font-size: 0.73rem;">Otorisasi satu klik tanpa PIN TTE (Khusus Verifikator I &amp; II)</div>
                                    </div>
                                </div>
                            </div>

                            <div class="p-4">
                                <div class="p-2 px-3 rounded-2 mb-3 border d-flex align-items-center gap-2" style="background-color: #EFF6FF; border-color: #BFDBFE !important; font-size: 0.74rem;">
                                    <i class="bi bi-info-circle-fill text-primary" aria-hidden="true"></i>
                                    <span class="text-secondary">
                                        @if($userRole === 'sekdin')
                                            Persetujuan Sekretaris Dinas akan mengubah status naskah menjadi <code>valid_sekdin</code> (Antrean TTE Kepala Dinas).
                                        @else
                                            Persetujuan Kasubbag Umpeg akan mengubah status naskah menjadi <code>valid_kasubbag</code> (Antrean Paraf Sekretaris Dinas).
                                        @endif
                                    </span>
                                </div>

                                <div class="mb-3">
                                    <label for="catatanParaf" class="form-label fw-semibold text-dark small mb-1">
                                        Catatan Verifikasi / Paraf Hierarki
                                    </label>
                                    <textarea id="catatanParaf" name="catatan" class="form-control form-control-sm" rows="3" placeholder="Tuliskan catatan paraf koordinasi atau verifikasi naskah...">{{ old('catatan', $userRole === 'sekdin' ? 'Telah diparaf koordinasi oleh Sekretaris Dinas. Konsep naskah siap diteruskan ke Kepala Dinas untuk otorisasi TTE QR Code.' : 'Kode klasifikasi, lampiran, dan redaksi naskah dinas telah sesuai standar TNDE. Diteruskan ke Sekretaris Dinas.') }}</textarea>
                                </div>

                                <div class="d-grid gap-2">
                                    <button type="submit"
                                            id="btnSubmitApprove"
                                            class="btn btn-success fw-semibold py-2 px-3 rounded-2 d-flex align-items-center justify-content-center gap-2 shadow-sm"
                                            style="font-size: 0.85rem;"
                                            {{ !$activeKonsep ? 'disabled' : '' }}>
                                        <i class="bi bi-check2-circle" aria-hidden="true"></i>
                                        <span>
                                            {{ $userRole === 'sekdin' ? 'Paraf & Teruskan ke Antrean TTE Kepala Dinas' : 'Setujui & Teruskan ke Sekretaris Dinas (Tahap 2)' }}
                                        </span>
                                    </button>
                                    <button type="button"
                                            id="btnOpenModalRevisi"
                                            onclick="prepareAndOpenRevisiModal()"
                                            class="btn btn-outline-danger btn-sm fw-medium py-2 px-3 rounded-2 d-flex align-items-center justify-content-center gap-2"
                                            style="font-size: 0.82rem;"
                                            {{ !$activeKonsep ? 'disabled' : '' }}>
                                        <i class="bi bi-arrow-counterclockwise" aria-hidden="true"></i>
                                        <span>Kembalikan ke Staf Admin untuk Revisi</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </main>

        <footer class="bg-white border-top px-4 py-3 d-flex flex-column flex-sm-row align-items-center justify-content-between text-secondary" style="font-size: 0.75rem;">
            <div>&copy; 2026 <strong class="text-dark">Disdukcapil Kabupaten Ogan Komering Ilir</strong>. Hak Cipta Dilindungi.</div>
            <div>Aplikasi Tata Naskah Dinas Elektronik (TNDE) OKI Mandira</div>
        </footer>
    </div>
</div>

{{-- MODAL KEMBALIKAN KE STAF ADMIN UNTUK REVISI --}}
<div class="modal fade" id="modalRevisiStaf" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow rounded-3">
            <form id="formRevisiVerifikasi" method="POST" action="{{ $activeKonsep['revisi_url'] ?? '#' }}">
                @csrf
                <input type="hidden" name="checklist[kode_klasifikasi]" id="revChk1" value="1">
                <input type="hidden" name="checklist[kelengkapan_lampiran]" id="revChk2" value="1">
                <input type="hidden" name="checklist[ketepatan_redaksi]" id="revChk3" value="1">

                <div class="modal-header border-bottom px-4 py-3">
                    <h6 class="modal-title fw-bold text-danger d-flex align-items-center gap-2">
                        <i class="bi bi-arrow-counterclockwise" aria-hidden="true"></i>
                        <span>Kembalikan Konsep ke Staf Admin (Status: Revisi)</span>
                    </h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body p-4 small">
                    <div class="p-2 px-3 rounded-2 mb-3 border" style="background-color: #FEF2F2; border-color: #FECACA !important;">
                        <div class="text-secondary" style="font-size: 0.72rem;">Nomor Naskah yang Dikembalikan:</div>
                        <div class="doc-number-mono text-danger fw-bold" id="modalRevisiNomor">{{ $activeKonsep['nomor'] ?? '-' }}</div>
                        <div class="text-dark fw-medium mt-1" id="modalRevisiPerihal" style="font-size: 0.76rem;">{{ $activeKonsep['perihal'] ?? '-' }}</div>
                    </div>

                    <div class="mb-2">
                        <label for="inputCatatanRevisi" class="form-label fw-semibold text-dark mb-1">
                            Catatan Koreksi / Instruksi Revisi <span class="text-danger">*</span>
                        </label>
                        <textarea name="catatan_revisi"
                                  id="inputCatatanRevisi"
                                  class="form-control form-control-sm"
                                  rows="4"
                                  required
                                  minlength="5"
                                  placeholder="Jelaskan secara spesifik bagian redaksi, kode klasifikasi, tanggal, atau lampiran yang wajib diperbaiki oleh Staf Admin...">{{ old('catatan_revisi') }}</textarea>
                        <div class="form-text" style="font-size: 0.71rem;">
                            Catatan ini akan disimpan ke kolom <code>catatan_revisi</code> pada naskah dan tabel <code>log_verifikasi</code>, serta langsung tampil di halaman Dashboard &amp; Registrasi Staf Admin.
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-top px-4 py-2">
                    <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-sm btn-danger fw-semibold">
                        <i class="bi bi-send-exclamation me-1"></i>Konfirmasi Kembalikan untuk Revisi
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- MODAL PRATINJAU LAMPIRAN DOKUMEN YANG DIUNGGGAH --}}
<div class="modal fade" id="modalPratinjauLampiran" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content border-0 shadow rounded-3">
            <div class="modal-header border-bottom px-4 py-3">
                <div>
                    <h6 class="modal-title fw-bold text-dark d-flex align-items-center gap-2 mb-0">
                        <i class="bi bi-file-earmark-pdf-fill text-danger" aria-hidden="true"></i>
                        <span>Pratinjau Berkas Lampiran Naskah Dinas</span>
                    </h6>
                    <div class="text-secondary small" id="modalLampiranSubtitle">{{ $activeKonsep['file_name'] ?? '-' }}</div>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <a id="modalLampiranDownloadLink"
                       href="{{ $activeKonsep['file_url'] ?? '#' }}"
                       target="_blank"
                       class="btn btn-sm btn-primary fw-semibold">
                        <i class="bi bi-box-arrow-up-right me-1"></i>Buka / Unduh di Tab Baru
                    </a>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
            </div>
            <div class="modal-body p-0 bg-light" style="height: 72vh;">
                <iframe id="iframeLampiranPreview"
                        src="{{ $activeKonsep['file_url'] ?? 'about:blank' }}"
                        class="w-100 h-100 border-0"
                        title="Pratinjau Dokumen Lampiran"></iframe>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    localStorage.removeItem('esurat_locked_role');

    const ANTREAN_DATA = @json($antreanKonsep->keyBy('key'));
    const CURRENT_USER_ROLE = @json($userRole);
    const CURRENT_USER_NAME = @json($userName);
    let currentSelectedKey = @json($activeKonsep['key'] ?? null);

    function selectKonsepByKey(key) {
        const item = ANTREAN_DATA[key];
        if (!item) return;

        currentSelectedKey = key;

        // Highlight active row & button in table
        document.querySelectorAll('.konsep-row').forEach(tr => tr.classList.remove('active-row'));
        const activeRow = document.getElementById('row-' + key);
        if (activeRow) activeRow.classList.add('active-row');

        document.querySelectorAll('.btn-pilih-konsep').forEach(btn => {
            btn.classList.remove('btn-primary');
            btn.classList.add('btn-outline-primary');
            btn.textContent = 'Pilih Konsep';
        });
        const activeBtn = document.getElementById('btn-select-' + key);
        if (activeBtn) {
            activeBtn.classList.remove('btn-outline-primary');
            activeBtn.classList.add('btn-primary');
            activeBtn.textContent = 'Sedang Diperiksa';
        }

        // Update Header Preview Info
        document.getElementById('headerPreviewNo').textContent = item.nomor;
        const jenisBadge = document.getElementById('headerPreviewJenisBadge');
        if (jenisBadge) {
            jenisBadge.textContent = item.jenis_label;
            jenisBadge.style.backgroundColor = item.jenis_badge_bg;
            jenisBadge.style.color = item.jenis_badge_color;
        }

        // Update Attachment Preview Button
        const btnLampiran = document.getElementById('btnPreviewLampiran');
        const badgeNoLampiran = document.getElementById('badgeNoLampiran');
        if (item.file_url) {
            btnLampiran.classList.remove('d-none');
            badgeNoLampiran.classList.add('d-none');
            document.getElementById('modalLampiranSubtitle').textContent = item.nomor + ' — ' + (item.file_name || 'Lampiran');
            document.getElementById('modalLampiranDownloadLink').href = item.file_url;
            document.getElementById('iframeLampiranPreview').src = item.file_url;
        } else {
            btnLampiran.classList.add('d-none');
            badgeNoLampiran.classList.remove('d-none');
        }

        // Switch A4 Template Section based on document jenis
        const secSk = document.getElementById('a4SectionSuratKeluar');
        const secSppd = document.getElementById('a4SectionSppd');
        const secBa = document.getElementById('a4SectionBeritaAcara');

        if (secSk && secSppd && secBa) {
            secSk.classList.toggle('d-none', item.jenis !== 'surat_keluar');
            secSppd.classList.toggle('d-none', item.jenis !== 'sppd');
            secBa.classList.toggle('d-none', item.jenis !== 'berita_acara');
        }

        if (item.jenis === 'surat_keluar') {
            document.getElementById('paperNoText').textContent = item.nomor;
            document.getElementById('paperSifatText').textContent = item.sifat;
            document.getElementById('paperLampiranText').textContent = item.lampiran;
            document.getElementById('paperPerihalText').textContent = item.perihal;
            document.getElementById('paperTanggalText').textContent = item.tanggal_display;
            document.getElementById('paperTujuanText').textContent = item.tujuan;
            document.getElementById('paperBodyPerihalText').textContent = item.perihal;
        } else if (item.jenis === 'sppd') {
            document.getElementById('sppdNomorText').textContent = item.nomor;
            document.getElementById('sppdNamaPegawaiText').textContent = item.extra.nama_pegawai || '-';
            document.getElementById('sppdNipPegawaiText').textContent = item.extra.nip_pegawai || '-';
            document.getElementById('sppdJabatanPegawaiText').textContent = item.extra.jabatan_pegawai || '-';
            document.getElementById('sppdUrusanText').textContent = item.perihal;
            document.getElementById('sppdTujuanText').textContent = item.tujuan;
            document.getElementById('sppdBerangkatText').textContent = item.extra.tanggal_berangkat || '-';
            document.getElementById('sppdKembaliText').textContent = item.extra.tanggal_kembali || '-';
            document.getElementById('sppdTanggalSuratText').textContent = item.tanggal_display;
        } else if (item.jenis === 'berita_acara') {
            document.getElementById('baNomorText').textContent = item.nomor;
            document.getElementById('baTanggalText').textContent = item.tanggal_display;
            document.getElementById('baPihakKeduaText').textContent = item.tujuan;
            document.getElementById('baPerihalText').textContent = item.perihal;
        }

        // Update Timeline from item.logs
        const logs = Array.isArray(item.logs) ? item.logs : [];
        const logStaf = [...logs].reverse().find(l => l.tahap_verifikasi === 'staf_admin');
        const logKasubbag = [...logs].reverse().find(l => l.tahap_verifikasi === 'kasubbag_umpeg' && l.status_aksi === 'valid_kasubbag');

        const tlStafDesc = document.getElementById('tlStafDesc');
        const tlStafTime = document.getElementById('tlStafTime');
        if (tlStafDesc) {
            tlStafDesc.textContent = (logStaf ? logStaf.verifikator_nama : item.pengaju_nama) + ' — ' + (logStaf && logStaf.catatan ? logStaf.catatan : ('Registrasi Nomor ' + item.nomor));
        }
        if (tlStafTime) {
            tlStafTime.innerHTML = '<i class="bi bi-clock me-1" aria-hidden="true"></i>' + (logStaf ? logStaf.waktu : 'Tercatat di Buku Agenda');
        }

        const tlKasubbagDesc = document.getElementById('tlKasubbagDesc');
        const tlKasubbagTime = document.getElementById('tlKasubbagTime');
        if (CURRENT_USER_ROLE === 'sekdin' && tlKasubbagDesc) {
            tlKasubbagDesc.textContent = (logKasubbag ? logKasubbag.verifikator_nama : 'Kasubbag Umpeg') + ' — ' + (logKasubbag && logKasubbag.catatan ? logKasubbag.catatan : 'Telah disetujui pada Tahap 1.');
            if (tlKasubbagTime) {
                tlKasubbagTime.classList.remove('d-none');
                tlKasubbagTime.innerHTML = '<i class="bi bi-clock me-1" aria-hidden="true"></i>' + (logKasubbag ? logKasubbag.waktu : 'Diverifikasi Tahap 1');
            }
        }

        // Update Form Action URLs (Approve & Revisi)
        const formApprove = document.getElementById('formApproveVerifikasi');
        if (formApprove) formApprove.action = item.approve_url;

        const formRevisi = document.getElementById('formRevisiVerifikasi');
        if (formRevisi) formRevisi.action = item.revisi_url;

        document.getElementById('modalRevisiNomor').textContent = item.nomor;
        document.getElementById('modalRevisiPerihal').textContent = item.perihal;

        window.scrollTo({ top: 160, behavior: 'smooth' });
    }

    function prepareAndOpenRevisiModal() {
        // Sync checkbox values into hidden inputs inside modalRevisiStaf
        document.getElementById('revChk1').value = document.getElementById('chk1').checked ? '1' : '0';
        document.getElementById('revChk2').value = document.getElementById('chk2').checked ? '1' : '0';
        document.getElementById('revChk3').value = document.getElementById('chk3').checked ? '1' : '0';

        new bootstrap.Modal(document.getElementById('modalRevisiStaf')).show();
    }

    function openModalLampiran() {
        const item = currentSelectedKey ? ANTREAN_DATA[currentSelectedKey] : null;
        if (item && item.file_url) {
            document.getElementById('modalLampiranSubtitle').textContent = item.nomor + ' — ' + (item.file_name || 'Lampiran');
            document.getElementById('modalLampiranDownloadLink').href = item.file_url;
            document.getElementById('iframeLampiranPreview').src = item.file_url;
        }
        new bootstrap.Modal(document.getElementById('modalPratinjauLampiran')).show();
    }
</script>
</body>
</html>
