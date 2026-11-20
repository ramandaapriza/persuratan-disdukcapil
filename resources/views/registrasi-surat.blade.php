<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi Naskah Dinas - Disdukcapil OKI</title>
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
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
        }

        .surface-card.highlighted-panel {
            border-color: var(--color-blue-600);
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.15);
        }

        .mini-stat-icon {
            width: 38px;
            height: 38px;
            border-radius: 0.6rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
            flex-shrink: 0;
        }

        .ledger-tabs .nav-link {
            color: var(--color-slate-500);
            font-size: 0.82rem;
            font-weight: 600;
            padding: 0.65rem 1.15rem;
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

        .doc-number-mono {
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.82rem;
            font-weight: 600;
        }

        .upload-dropzone {
            border: 1.5px dashed #CBD5E1;
            background-color: var(--color-slate-50);
            border-radius: var(--radius-md);
            padding: 1rem;
            text-align: center;
        }

        .hierarchy-flow-box {
            background-color: var(--color-slate-50);
            border: 1px solid var(--color-slate-200);
            border-radius: var(--radius-md);
            padding: 0.85rem 1rem;
        }

        .step-pill {
            background-color: #FFFFFF;
            border: 1px solid var(--color-slate-200);
            border-radius: var(--radius-md);
            padding: 0.4rem 0.65rem;
            font-size: 0.74rem;
            font-weight: 600;
            color: var(--color-slate-900);
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
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

    $sidebarRevisiCount = $revisiCount ?? (
        \App\Models\SuratKeluar::where('status', 'revisi')->count()
        + \App\Models\Sppd::where('status', 'revisi')->count()
        + \App\Models\BeritaAcara::where('status', 'revisi')->count()
    );
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
                <a href="/registrasi-surat" class="nav-link-sidebar active">
                    <span class="d-flex align-items-center gap-3">
                        <i class="bi bi-send-fill" aria-hidden="true"></i>
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
                <a href="/verifikasi-hierarki" class="nav-link-sidebar">
                    <span class="d-flex align-items-center gap-3">
                        <i class="bi bi-file-earmark-check" aria-hidden="true"></i>
                        <span>Verifikasi Hierarki Naskah</span>
                    </span>
                    <span class="badge rounded-pill bg-warning text-dark fw-bold" style="font-size: 0.68rem;">{{ auth()->user()->role === 'sekdin' ? '3' : '4' }}</span>
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
                <span class="text-secondary">Agenda Persuratan</span>
                <span class="text-secondary mx-1">/</span>
                <span class="text-primary fw-medium">Registrasi &amp; Agenda Naskah</span>
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
                <div class="alert alert-success alert-dismissible fade show py-2 px-3 mb-3 d-flex flex-wrap align-items-center justify-content-between gap-2 border-0 shadow-sm" role="alert" style="background-color: #DCFCE7; color: #15803D; font-size: 0.8rem;">
                    <div class="d-flex align-items-center gap-2">
                        <i class="bi bi-check-circle-fill flex-shrink-0" aria-hidden="true"></i>
                        <span>{{ session('status') }}</span>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <a href="/riwayat-naskah" class="btn btn-sm btn-success fw-semibold py-1 px-2" style="font-size: 0.73rem;">
                            <i class="bi bi-clock-history me-1"></i>Pantau Status di Riwayat Naskah &rarr;
                        </a>
                        <button type="button" class="btn-close position-static p-1" data-bs-dismiss="alert" aria-label="Tutup" style="font-size: 0.65rem;"></button>
                    </div>
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
                    <div class="d-flex align-items-start gap-2">
                        <i class="bi bi-exclamation-octagon-fill mt-1 flex-shrink-0" aria-hidden="true"></i>
                        <div class="flex-grow-1">
                            <div class="fw-bold mb-1">Validasi Input Naskah Dinas Gagal:</div>
                            <ul class="mb-0 ps-3">
                                @foreach ($errors->all() as $err)
                                    <li>{{ $err }}</li>
                                @endforeach
                            </ul>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup" style="font-size: 0.65rem;"></button>
                    </div>
                </div>
            @endif

            <div class="surface-card px-4 pt-3 mb-4 d-flex flex-column flex-xl-row align-items-xl-center justify-content-between gap-3">
                <div class="pb-3">
                    <div class="d-flex flex-wrap align-items-center gap-2 mb-1">
                        <h6 class="fw-bold text-dark mb-0">Registrasi &amp; Penomoran Otomatis Naskah Dinas Baru</h6>
                        <a href="/riwayat-naskah" class="badge rounded-pill text-decoration-none px-2 py-1 fw-semibold" style="background-color: #EFF6FF; color: #1D4ED8; border: 1px solid #BFDBFE; font-size: 0.7rem;">
                            <i class="bi bi-clock-history me-1"></i>Buka Riwayat &amp; Pantauan Naskah ({{ $totalNaskahBerjalan ?? 0 }} Aktif) &rarr;
                        </a>
                        @if ($sidebarRevisiCount > 0)
                            <a href="/riwayat-naskah?status=revisi#panel-revisi" class="badge rounded-pill bg-danger text-white text-decoration-none px-2 py-1 fw-semibold" style="font-size: 0.7rem;">
                                <i class="bi bi-arrow-counterclockwise me-1"></i>{{ $sidebarRevisiCount }} Naskah Perlu Revisi
                            </a>
                        @endif
                    </div>
                    <div class="text-secondary" style="font-size: 0.76rem;">Formulir pencatatan buku agenda surat keluar, SPPD, berita acara, serta registrasi surat masuk.</div>
                </div>

                <ul class="nav nav-tabs ledger-tabs border-0 flex-wrap" id="registrasiTabNav">
                    <li class="nav-item">
                        <button type="button" class="nav-link active d-inline-flex align-items-center gap-2" onclick="focusRegPanel('panel-surat-keluar', this)">
                            <i class="bi bi-send-fill" aria-hidden="true"></i>
                            <span>Surat Keluar</span>
                        </button>
                    </li>
                    <li class="nav-item">
                        <button type="button" class="nav-link d-inline-flex align-items-center gap-2" onclick="focusRegPanel('panel-sppd', this)">
                            <i class="bi bi-briefcase-fill text-warning" aria-hidden="true"></i>
                            <span>Form SPPD</span>
                        </button>
                    </li>
                    <li class="nav-item">
                        <button type="button" class="nav-link d-inline-flex align-items-center gap-2" onclick="focusRegPanel('panel-berita-acara', this)">
                            <i class="bi bi-file-earmark-text-fill text-primary" aria-hidden="true"></i>
                            <span>Berita Acara</span>
                        </button>
                    </li>
                    <li class="nav-item">
                        <button type="button" class="nav-link d-inline-flex align-items-center gap-2" onclick="focusRegPanel('panel-surat-masuk', this)">
                            <i class="bi bi-inbox-fill text-success" aria-hidden="true"></i>
                            <span>Agenda Surat Masuk</span>
                        </button>
                    </li>
                </ul>
            </div>

            <div class="row g-4 mb-4">
                <!-- PANEL 1: FORMULIR INPUT SURAT KELUAR -->
                <div class="col-12 col-xl-6" id="panel-surat-keluar">
                    <div class="surface-card h-100 d-flex flex-column">
                        <div class="px-4 py-3 border-bottom d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center gap-2">
                                <div class="mini-stat-icon" style="background-color: #DBEAFE; color: #2563EB;">
                                    <i class="bi bi-send-plus-fill" aria-hidden="true"></i>
                                </div>
                                <div>
                                    <h6 class="fw-bold text-dark mb-0" style="font-size: 0.9rem;">Panel 1: Formulir Input Surat Keluar</h6>
                                    <div class="text-secondary" style="font-size: 0.73rem;">Aturan Penomoran Resmi Disdukcapil Kabupaten OKI</div>
                                </div>
                            </div>
                            <span class="badge rounded-2 px-2 py-1 fw-semibold" style="background-color: #DBEAFE; color: #1D4ED8; font-size: 0.72rem;">
                                Naskah Keluar
                            </span>
                        </div>

                        <div class="p-4 flex-grow-1 d-flex flex-column justify-content-between">
                            <div class="p-3 rounded-3 mb-3 border d-flex align-items-center justify-content-between" style="background-color: #EFF6FF; border-color: #BFDBFE !important;">
                                <div>
                                    <div class="text-primary fw-semibold d-flex align-items-center gap-1" style="font-size: 0.74rem;">
                                        <i class="bi bi-magic" aria-hidden="true"></i> Pratinjau Nomor Surat Otomatis
                                    </div>
                                    <div id="previewNomorKeluar" class="fs-5 fw-bold text-primary font-monospace my-1">400/{{ $nextUrutSuratKeluar ?? 2765 }}/disdukcapil/2026</div>
                                    <div class="text-secondary" style="font-size: 0.72rem;">Format: <strong>Kode Bidang / Nomor Urut / Nama Dinas / Tahun</strong></div>
                                </div>
                                <span class="badge rounded-pill bg-primary text-white px-2 py-1" style="font-size: 0.7rem;">Auto-Generate</span>
                            </div>

                            <form action="{{ route('registrasi.surat-keluar.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row g-3 mb-3">
                                    <div class="col-12 col-sm-4">
                                        <label for="nomorUrutKeluar" class="form-label fw-semibold text-dark small mb-1">
                                            Nomor Urut <span class="text-danger">*</span>
                                        </label>
                                        <div class="input-group input-group-sm">
                                            <span class="input-group-text bg-light text-secondary"><i class="bi bi-hash" aria-hidden="true"></i></span>
                                            <input type="number" name="nomor_urut" id="nomorUrutKeluar" oninput="updateAutoNomorSurat()" class="form-control doc-number-mono text-primary" value="{{ old('nomor_urut', $nextUrutSuratKeluar ?? 2765) }}" required>
                                        </div>
                                        <div class="form-text" style="font-size: 0.68rem;">Urutan agenda otomatis</div>
                                    </div>

                                    <div class="col-12 col-sm-8">
                                        <label for="kodeBidangSelect" class="form-label fw-semibold text-dark small mb-1">
                                            Pilihan Kode Bidang Klasifikasi <span class="text-danger">*</span>
                                        </label>
                                        <select name="kode_bidang" id="kodeBidangSelect" onchange="updateAutoNomorSurat()" class="form-select form-select-sm fw-medium">
                                            @forelse ($klasifikasiList ?? [] as $klas)
                                                <option value="{{ $klas->kode_bidang }}" {{ old('kode_bidang', '400') === $klas->kode_bidang ? 'selected' : '' }}>
                                                    {{ $klas->kode_bidang }} - {{ $klas->nama_bidang }}
                                                </option>
                                            @empty
                                                <option value="400" selected>400 - Bidang Catatan Sipil</option>
                                                <option value="800">800 - Subbag Kepegawaian &amp; Umum</option>
                                                <option value="00">00 - Subbag Keuangan / Dana</option>
                                            @endforelse
                                        </select>
                                        <div class="form-text" style="font-size: 0.68rem;">Opsi: 400 (Catatan Sipil) &bull; 800 (Kepegawaian) &bull; 00 (Keuangan / Dana)</div>
                                    </div>
                                </div>

                                <div class="row g-3 mb-3">
                                    <div class="col-12 col-sm-4">
                                        <label for="tglDikeluarkan" class="form-label fw-semibold text-dark small mb-1">
                                            Tanggal Dikeluarkan <span class="text-danger">*</span>
                                        </label>
                                        <input type="date" name="tanggal_dikeluarkan" id="tglDikeluarkan" class="form-control form-control-sm" value="{{ old('tanggal_dikeluarkan', '2026-11-19') }}" required>
                                    </div>

                                    <div class="col-12 col-sm-4">
                                        <label for="sifatSuratKeluar" class="form-label fw-semibold text-dark small mb-1">
                                            Sifat Surat
                                        </label>
                                        <select name="sifat" id="sifatSuratKeluar" class="form-select form-select-sm">
                                            <option value="Penting" selected>Penting</option>
                                            <option value="Segera">Segera</option>
                                            <option value="Biasa">Biasa</option>
                                            <option value="Rahasia">Rahasia</option>
                                        </select>
                                    </div>

                                    <div class="col-12 col-sm-4">
                                        <label for="ketNomorSurat" class="form-label fw-semibold text-dark small mb-1">
                                            Nomor Surat (Otomatis)
                                        </label>
                                        <input type="text" id="ketNomorSurat" class="form-control form-control-sm bg-light doc-number-mono text-dark" value="400/{{ $nextUrutSuratKeluar ?? 2765 }}/disdukcapil/2026" readonly>
                                    </div>
                                </div>

                                <div class="row g-3 mb-3">
                                    <div class="col-12 col-sm-8">
                                        <label for="alamatDituju" class="form-label fw-semibold text-dark small mb-1">
                                            Alamat / Instansi yang Dituju <span class="text-danger">*</span>
                                        </label>
                                        <div class="input-group input-group-sm">
                                            <span class="input-group-text bg-light text-secondary"><i class="bi bi-building" aria-hidden="true"></i></span>
                                            <input type="text" name="alamat_tujuan" id="alamatDituju" class="form-control" value="{{ old('alamat_tujuan') }}" placeholder="Contoh: Direktorat Jenderal Dukcapil Kemendagri RI - Jakarta" required>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <label for="lampiranSuratKeluar" class="form-label fw-semibold text-dark small mb-1">
                                            Keterangan Lampiran
                                        </label>
                                        <input type="text" name="lampiran" id="lampiranSuratKeluar" class="form-control form-control-sm" value="{{ old('lampiran', '1 (Satu) Berkas') }}" placeholder="1 (Satu) Berkas">
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="perihalSuratKeluar" class="form-label fw-semibold text-dark small mb-1">
                                        Perihal / Isi Ringkas Surat <span class="text-danger">*</span>
                                    </label>
                                    <textarea name="perihal" id="perihalSuratKeluar" class="form-control form-control-sm" rows="3" placeholder="Tuliskan perihal atau ringkasan pokok isi surat keluar..." required>{{ old('perihal') }}</textarea>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-semibold text-dark small mb-1">
                                        Upload Dokumen Konsep Surat (PDF/DOCX - Opsional)
                                    </label>
                                    <div class="upload-dropzone">
                                        <i class="bi bi-cloud-arrow-up-fill text-primary fs-4 d-block mb-1" aria-hidden="true"></i>
                                        <div class="fw-semibold text-dark" style="font-size: 0.78rem;">Pilih berkas konsep naskah dinas atau seret ke sini</div>
                                        <div class="text-secondary mb-2" style="font-size: 0.71rem;">Format didukung: .PDF, .DOCX (Maks. 5 MB)</div>
                                        <input type="file" name="file_konsep" class="form-control form-control-sm" accept=".pdf,.doc,.docx">
                                    </div>
                                </div>

                                <div class="hierarchy-flow-box mb-3">
                                    <div class="fw-bold text-dark mb-2 d-flex align-items-center gap-1" style="font-size: 0.75rem;">
                                        <i class="bi bi-diagram-3-fill text-primary" aria-hidden="true"></i>
                                        <span>Alur Pengiriman &amp; Verifikasi Hierarki Berjenjang:</span>
                                    </div>
                                    <div class="d-flex flex-wrap align-items-center gap-2">
                                        <span class="step-pill">
                                            <span class="badge rounded-circle bg-primary text-white">1</span>
                                            <span>Kasubbag Umpeg <small class="text-secondary fw-normal">(Verifikasi 1)</small></span>
                                        </span>
                                        <i class="bi bi-arrow-right text-secondary small" aria-hidden="true"></i>
                                        <span class="step-pill">
                                            <span class="badge rounded-circle bg-primary text-white">2</span>
                                            <span>Sekretaris Dinas <small class="text-secondary fw-normal">(Verifikasi 2)</small></span>
                                        </span>
                                        <i class="bi bi-arrow-right text-secondary small" aria-hidden="true"></i>
                                        <span class="step-pill" style="border-color: #A7F3D0; background-color: #ECFDF5;">
                                            <i class="bi bi-qr-code text-success" aria-hidden="true"></i>
                                            <span class="text-success">Kepala Dinas <small class="fw-normal">(Validasi TTE QR Code)</small></span>
                                        </span>
                                    </div>
                                </div>

                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary btn-sm fw-semibold py-2 rounded-2 d-flex align-items-center justify-content-center gap-2 shadow-sm" style="font-size: 0.85rem;">
                                        <i class="bi bi-send-check-fill" aria-hidden="true"></i>
                                        <span>Simpan &amp; Ajukan ke Kasubbag Umpeg</span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- PANEL 2: FORMULIR INPUT SPPD -->
                <div class="col-12 col-xl-6" id="panel-sppd">
                    <div class="surface-card h-100 d-flex flex-column">
                        <div class="px-4 py-3 border-bottom d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center gap-2">
                                <div class="mini-stat-icon" style="background-color: #FEF3C7; color: #D97706;">
                                    <i class="bi bi-briefcase-fill" aria-hidden="true"></i>
                                </div>
                                <div>
                                    <h6 class="fw-bold text-dark mb-0" style="font-size: 0.9rem;">Panel 2: Formulir Input SPPD</h6>
                                    <div class="text-secondary" style="font-size: 0.73rem;">Surat Perintah Perjalanan Dinas Pegawai Disdukcapil OKI</div>
                                </div>
                            </div>
                            <span class="badge rounded-2 px-2 py-1 fw-semibold" style="background-color: #FEF3C7; color: #B45309; font-size: 0.72rem;">
                                Form SPPD
                            </span>
                        </div>

                        <div class="p-4 flex-grow-1 d-flex flex-column justify-content-between">
                            @php
                                $paddedUrutSppd = str_pad((string) ($nextUrutSppd ?? 92), 3, '0', STR_PAD_LEFT);
                                $defaultNoSppd = "090/{$paddedUrutSppd}/SPPD/DUKCAPIL/2026";
                            @endphp
                            <div class="p-3 rounded-3 mb-3 border d-flex align-items-center justify-content-between" style="background-color: #FFFBEB; border-color: #FDE68A !important;">
                                <div>
                                    <div class="fw-semibold d-flex align-items-center gap-1" style="font-size: 0.74rem; color: #B45309;">
                                        <i class="bi bi-geo-alt-fill" aria-hidden="true"></i> Registrasi Buku Agenda Perjalanan Dinas
                                    </div>
                                    <div id="previewNomorSppd" class="fw-bold text-dark font-monospace my-1" style="font-size: 0.95rem;">{{ $defaultNoSppd }}</div>
                                    <div class="text-secondary" style="font-size: 0.72rem;">Otomatis terhubung dengan Lembar Surat Tugas &amp; Visum SPPD</div>
                                </div>
                                <span class="badge rounded-pill fw-semibold px-2 py-1" style="background-color: #FEF3C7; color: #B45309; font-size: 0.7rem;">Kode 800</span>
                            </div>

                            <form action="{{ route('registrasi.sppd.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="kode_bidang" value="800">
                                <div class="row g-3 mb-3">
                                    <div class="col-12 col-sm-3">
                                        <label for="urutSppdInput" class="form-label fw-semibold text-dark small mb-1">
                                            No. Urut <span class="text-danger">*</span>
                                        </label>
                                        <input type="number" name="nomor_urut" id="urutSppdInput" oninput="updateAutoNomorSppd()" class="form-control form-control-sm doc-number-mono" value="{{ old('nomor_urut', $nextUrutSppd ?? 92) }}" required>
                                    </div>
                                    <div class="col-12 col-sm-5">
                                        <label for="noUrutSppd" class="form-label fw-semibold text-dark small mb-1">
                                            Nomor SPPD <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" name="nomor_sppd" id="noUrutSppd" class="form-control form-control-sm doc-number-mono text-dark" value="{{ old('nomor_sppd', $defaultNoSppd) }}" required>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <label for="tglDibuatSppd" class="form-label fw-semibold text-dark small mb-1">
                                            Tanggal Surat <span class="text-danger">*</span>
                                        </label>
                                        <input type="date" name="tanggal_surat" id="tglDibuatSppd" class="form-control form-control-sm" value="{{ old('tanggal_surat', '2026-11-19') }}" required>
                                    </div>
                                </div>

                                <div class="row g-3 mb-3">
                                    <div class="col-12 col-sm-7">
                                        <label for="namaPegawaiSppd" class="form-label fw-semibold text-dark small mb-1">
                                            Nama Pegawai yang Diperintahkan <span class="text-danger">*</span>
                                        </label>
                                        <div class="input-group input-group-sm">
                                            <span class="input-group-text bg-light text-secondary"><i class="bi bi-person-badge-fill" aria-hidden="true"></i></span>
                                            <input type="text" name="nama_pegawai" id="namaPegawaiSppd" class="form-control" value="{{ old('nama_pegawai') }}" placeholder="Contoh: Drs. H. Ahmad Fauzi, M.Si" required>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-5">
                                        <label for="nipPegawaiSppd" class="form-label fw-semibold text-dark small mb-1">
                                            NIP Pegawai (18 Digit)
                                        </label>
                                        <input type="text" name="nip_pegawai" id="nipPegawaiSppd" maxlength="18" class="form-control form-control-sm doc-number-mono" value="{{ old('nip_pegawai') }}" placeholder="197504122000031002">
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="jabatanPegawaiSppd" class="form-label fw-semibold text-dark small mb-1">
                                        Jabatan yang Diperintahkan <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-text bg-light text-secondary"><i class="bi bi-award-fill" aria-hidden="true"></i></span>
                                        <input type="text" name="jabatan_pegawai" id="jabatanPegawaiSppd" class="form-control" value="{{ old('jabatan_pegawai') }}" placeholder="Contoh: Kepala Bidang Pelayanan Pendaftaran Penduduk" required>
                                    </div>
                                </div>

                                <div class="row g-3 mb-3">
                                    <div class="col-12 col-sm-6">
                                        <label for="tglBerangkatSppd" class="form-label fw-semibold text-dark small mb-1">
                                            Tanggal Berangkat <span class="text-danger">*</span>
                                        </label>
                                        <div class="input-group input-group-sm">
                                            <span class="input-group-text bg-light text-secondary"><i class="bi bi-calendar-check" aria-hidden="true"></i></span>
                                            <input type="date" name="tanggal_berangkat" id="tglBerangkatSppd" class="form-control" value="{{ old('tanggal_berangkat', '2026-11-20') }}" required>
                                        </div>
                                    </div>

                                    <div class="col-12 col-sm-6">
                                        <label for="tglKembaliSppd" class="form-label fw-semibold text-dark small mb-1">
                                            Tanggal Kembali <span class="text-danger">*</span>
                                        </label>
                                        <div class="input-group input-group-sm">
                                            <span class="input-group-text bg-light text-secondary"><i class="bi bi-calendar-range" aria-hidden="true"></i></span>
                                            <input type="date" name="tanggal_kembali" id="tglKembaliSppd" class="form-control" value="{{ old('tanggal_kembali', '2026-11-22') }}" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="daerahTujuanSppd" class="form-label fw-semibold text-dark small mb-1">
                                        Daerah / Instansi Tujuan <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-text bg-light text-secondary"><i class="bi bi-pin-map-fill" aria-hidden="true"></i></span>
                                        <input type="text" name="daerah_tujuan" id="daerahTujuanSppd" class="form-control" value="{{ old('daerah_tujuan') }}" placeholder="Contoh: Kantor Dinas Dukcapil Provinsi Sumatera Selatan - Palembang" required>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="urusanSppd" class="form-label fw-semibold text-dark small mb-1">
                                        Urusan / Tujuan Melakukan Perjalanan Dinas <span class="text-danger">*</span>
                                    </label>
                                    <textarea name="urusan_perjalanan" id="urusanSppd" class="form-control form-control-sm" rows="3" placeholder="Jelaskan maksud dan rincian tugas perjalanan dinas..." required>{{ old('urusan_perjalanan') }}</textarea>
                                </div>

                                <div class="hierarchy-flow-box mb-3">
                                    <div class="d-flex align-items-center justify-content-between" style="font-size: 0.75rem;">
                                        <span class="fw-semibold text-secondary">
                                            <i class="bi bi-shield-check text-success me-1" aria-hidden="true"></i>Otorisasi SPPD: <strong class="text-dark">Kasubbag Umpeg &rarr; Sekdin &rarr; TTE Kadin</strong>
                                        </span>
                                        <span class="badge rounded-pill px-2 py-1" style="background-color: #DCFCE7; color: #15803D;">Siap Diajukan</span>
                                    </div>
                                </div>

                                <div class="d-grid">
                                    <button type="submit" class="btn btn-dark btn-sm fw-semibold py-2 rounded-2 d-flex align-items-center justify-content-center gap-2 shadow-sm" style="background-color: #1E3A8A; border-color: #1E3A8A; font-size: 0.85rem;">
                                        <i class="bi bi-file-earmark-check-fill" aria-hidden="true"></i>
                                        <span>Simpan &amp; Ajukan SPPD ke Hierarki Pimpinan</span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-4 mb-4">
                <!-- PANEL 3: FORMULIR INPUT BERITA ACARA -->
                <div class="col-12 col-xl-6" id="panel-berita-acara">
                    <div class="surface-card h-100 d-flex flex-column">
                        <div class="px-4 py-3 border-bottom d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center gap-2">
                                <div class="mini-stat-icon" style="background-color: #EDE9FE; color: #7C3AED;">
                                    <i class="bi bi-file-earmark-text-fill" aria-hidden="true"></i>
                                </div>
                                <div>
                                    <h6 class="fw-bold text-dark mb-0" style="font-size: 0.9rem;">Panel 3: Formulir Input Berita Acara (BAST &amp; SIAK)</h6>
                                    <div class="text-secondary" style="font-size: 0.73rem;">Penerbitan Berita Acara Serah Terima ber-TTE QR Code</div>
                                </div>
                            </div>
                            <span class="badge rounded-2 px-2 py-1 fw-semibold" style="background-color: #EDE9FE; color: #6D28D9; font-size: 0.72rem;">
                                Form Berita Acara
                            </span>
                        </div>

                        <div class="p-4 flex-grow-1">
                            @php
                                $paddedUrutBa = str_pad((string) ($nextUrutBeritaAcara ?? 29), 3, '0', STR_PAD_LEFT);
                                $defaultNoBa = "400/{$paddedUrutBa}/BA-SIAK/XI/2026";
                            @endphp
                            <form action="{{ route('registrasi.berita-acara.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row g-3 mb-3">
                                    <div class="col-12 col-sm-3">
                                        <label class="form-label fw-semibold text-dark small mb-1">No. Urut <span class="text-danger">*</span></label>
                                        <input type="number" name="nomor_urut" id="urutBaInput" oninput="updateAutoNomorBa()" class="form-control form-control-sm doc-number-mono" value="{{ old('nomor_urut', $nextUrutBeritaAcara ?? 29) }}" required>
                                    </div>
                                    <div class="col-12 col-sm-5">
                                        <label class="form-label fw-semibold text-dark small mb-1">Kode Bidang <span class="text-danger">*</span></label>
                                        <select name="kode_bidang" id="kodeBidangBa" onchange="updateAutoNomorBa()" class="form-select form-select-sm fw-medium">
                                            @foreach ($klasifikasiList ?? [] as $klas)
                                                <option value="{{ $klas->kode_bidang }}">{{ $klas->kode_bidang }} - {{ $klas->nama_bidang }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <label class="form-label fw-semibold text-dark small mb-1">Tanggal BA <span class="text-danger">*</span></label>
                                        <input type="date" name="tanggal_berita_acara" class="form-control form-control-sm" value="{{ old('tanggal_berita_acara', '2026-11-19') }}" required>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="noBeritaAcara" class="form-label fw-semibold text-dark small mb-1">Nomor Berita Acara (Otomatis) <span class="text-danger">*</span></label>
                                    <input type="text" name="nomor_berita_acara" id="noBeritaAcara" class="form-control form-control-sm doc-number-mono text-primary bg-light" value="{{ old('nomor_berita_acara', $defaultNoBa) }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="pihakKeduaBa" class="form-label fw-semibold text-dark small mb-1">Pihak Kedua / Instansi Mitra <span class="text-danger">*</span></label>
                                    <input type="text" name="pihak_kedua" id="pihakKeduaBa" class="form-control form-control-sm" placeholder="Contoh: Kantor Kecamatan Lempuing (Camat Lempuing)" required>
                                </div>
                                <div class="mb-3">
                                    <label for="perihalBa" class="form-label fw-semibold text-dark small mb-1">Pokok / Perihal Berita Acara <span class="text-danger">*</span></label>
                                    <textarea name="perihal" id="perihalBa" class="form-control form-control-sm" rows="2" placeholder="Contoh: Berita Acara Serah Terima Distribusi 1.000 Keping Blangko KTP-el" required></textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-semibold text-dark small mb-1">Lampiran Dokumen BA (PDF/DOCX - Opsional)</label>
                                    <input type="file" name="file_dokumen" class="form-control form-control-sm" accept=".pdf,.doc,.docx">
                                </div>
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary btn-sm fw-semibold py-2 rounded-2 d-inline-flex align-items-center justify-content-center gap-2 shadow-sm">
                                        <i class="bi bi-send-check-fill" aria-hidden="true"></i>
                                        <span>Simpan &amp; Ajukan Berita Acara ke Hierarki</span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- PANEL 4: FORMULIR REGISTRASI AGENDA SURAT MASUK -->
                <div class="col-12 col-xl-6" id="panel-surat-masuk">
                    <div class="surface-card h-100 d-flex flex-column">
                        <div class="px-4 py-3 border-bottom d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center gap-2">
                                <div class="mini-stat-icon" style="background-color: #DCFCE7; color: #16A34A;">
                                    <i class="bi bi-inbox-fill" aria-hidden="true"></i>
                                </div>
                                <div>
                                    <h6 class="fw-bold text-dark mb-0" style="font-size: 0.9rem;">Panel 4: Registrasi Buku Agenda Surat Masuk</h6>
                                    <div class="text-secondary" style="font-size: 0.73rem;">Pencatatan Surat Masuk Eksternal &amp; Penerusan ke Ajudan Kepala Dinas</div>
                                </div>
                            </div>
                            <span class="badge rounded-2 px-2 py-1 fw-semibold" style="background-color: #DCFCE7; color: #15803D; font-size: 0.72rem;">
                                Surat Masuk
                            </span>
                        </div>

                        <div class="p-4 flex-grow-1">
                            <form action="{{ route('registrasi.surat-masuk.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row g-3 mb-3">
                                    <div class="col-12 col-sm-3">
                                        <label class="form-label fw-semibold text-dark small mb-1">No. Agenda <span class="text-danger">*</span></label>
                                        <input type="text" name="nomor_urut_agenda" class="form-control form-control-sm doc-number-mono text-primary" value="{{ old('nomor_urut_agenda', $nextUrutSuratMasuk ?? '0145') }}" required>
                                    </div>
                                    <div class="col-12 col-sm-5">
                                        <label class="form-label fw-semibold text-dark small mb-1">Kode Bidang <span class="text-danger">*</span></label>
                                        <select name="kode_bidang" class="form-select form-select-sm fw-medium">
                                            @foreach ($klasifikasiList ?? [] as $klas)
                                                <option value="{{ $klas->kode_bidang }}">{{ $klas->kode_bidang }} - {{ $klas->nama_bidang }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <label class="form-label fw-semibold text-dark small mb-1">Sifat Surat <span class="text-danger">*</span></label>
                                        <select name="sifat_surat" class="form-select form-select-sm">
                                            <option value="Segera" selected>Segera</option>
                                            <option value="Penting">Penting</option>
                                            <option value="Biasa">Biasa</option>
                                            <option value="Rahasia">Rahasia</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row g-3 mb-3">
                                    <div class="col-12 col-sm-6">
                                        <label class="form-label fw-semibold text-dark small mb-1">Tanggal Diterima <span class="text-danger">*</span></label>
                                        <input type="date" name="tanggal_diterima" class="form-control form-control-sm" value="{{ old('tanggal_diterima', '2026-11-19') }}" required>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <label class="form-label fw-semibold text-dark small mb-1">Tanggal Surat Asal <span class="text-danger">*</span></label>
                                        <input type="date" name="tanggal_surat" class="form-control form-control-sm" value="{{ old('tanggal_surat', '2026-11-18') }}" required>
                                    </div>
                                </div>
                                <div class="row g-3 mb-3">
                                    <div class="col-12 col-sm-6">
                                        <label class="form-label fw-semibold text-dark small mb-1">Instansi Pengirim <span class="text-danger">*</span></label>
                                        <input type="text" name="pengirim" class="form-control form-control-sm" placeholder="Contoh: Sekretariat Daerah Kab. OKI" required>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <label class="form-label fw-semibold text-dark small mb-1">Nomor Surat Asal <span class="text-danger">*</span></label>
                                        <input type="text" name="nomor_surat" class="form-control form-control-sm doc-number-mono" placeholder="Contoh: 005/412/Setda-OKI/2026" required>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-semibold text-dark small mb-1">Perihal Surat Masuk <span class="text-danger">*</span></label>
                                    <textarea name="perihal" class="form-control form-control-sm" rows="2" placeholder="Tuliskan perihal surat masuk..." required></textarea>
                                </div>
                                <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="langsung_naik_ajudan" value="1" id="checkNaikAjudan" checked>
                                        <label class="form-check-label small fw-medium text-dark" for="checkNaikAjudan">
                                            Langsung teruskan ke Ajudan Kepala Dinas untuk Disposisi
                                        </label>
                                    </div>
                                </div>
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-success btn-sm fw-semibold py-2 rounded-2 d-inline-flex align-items-center justify-content-center gap-2 shadow-sm">
                                        <i class="bi bi-journal-plus" aria-hidden="true"></i>
                                        <span>Catat Agenda Surat Masuk</span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="surface-card p-3 px-4 d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
                <div class="d-flex align-items-center gap-3">
                    <div class="mini-stat-icon" style="width: 38px; height: 38px; font-size: 1.05rem; background-color: #EFF6FF; color: #2563EB;">
                        <i class="bi bi-clock-history" aria-hidden="true"></i>
                    </div>
                    <div>
                        <div class="fw-bold text-dark" style="font-size: 0.85rem;">Ingin Memantau Posisi Verifikasi atau Memperbaiki Naskah Revisi?</div>
                        <div class="text-secondary" style="font-size: 0.74rem;">Daftar riwayat naskah, timeline log verifikasi pejabat, dan panel perbaikan revisi kini tersedia di halaman khusus <strong>Riwayat &amp; Pantauan Naskah</strong>.</div>
                    </div>
                </div>
                <div class="d-flex flex-wrap align-items-center gap-2 flex-shrink-0">
                    @if ($sidebarRevisiCount > 0)
                        <a href="/riwayat-naskah?status=revisi#panel-revisi" class="btn btn-sm btn-danger fw-semibold px-3 py-2 d-inline-flex align-items-center gap-1" style="font-size: 0.76rem;">
                            <i class="bi bi-pencil-square" aria-hidden="true"></i>
                            <span>Perbaiki {{ $sidebarRevisiCount }} Naskah Revisi</span>
                        </a>
                    @endif
                    <a href="/riwayat-naskah" class="btn btn-sm btn-outline-primary fw-semibold px-3 py-2 d-inline-flex align-items-center gap-1" style="font-size: 0.76rem;">
                        <i class="bi bi-arrow-right-circle" aria-hidden="true"></i>
                        <span>Buka Riwayat &amp; Pantauan Naskah</span>
                    </a>
                </div>
            </div>
        </main>

        <footer class="bg-white border-top px-4 py-3 d-flex flex-column flex-sm-row align-items-center justify-content-between text-secondary" style="font-size: 0.75rem;">
            <div>&copy; 2026 <strong class="text-dark">Disdukcapil Kabupaten Ogan Komering Ilir</strong>. Hak Cipta Dilindungi.</div>
            <div>Aplikasi Tata Naskah Dinas Elektronik (TNDE) OKI Mandira</div>
        </footer>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    localStorage.removeItem('esurat_locked_role');

    function updateAutoNomorSurat() {
        const kode = document.getElementById('kodeBidangSelect').value || '400';
        const urut = document.getElementById('nomorUrutKeluar').value || '2765';
        const formatted = kode + '/' + urut + '/disdukcapil/2026';
        document.getElementById('previewNomorKeluar').textContent = formatted;
        document.getElementById('ketNomorSurat').value = formatted;
    }

    function updateAutoNomorSppd() {
        const urut = String(document.getElementById('urutSppdInput').value || '92').padStart(3, '0');
        const formatted = '090/' + urut + '/SPPD/DUKCAPIL/2026';
        document.getElementById('previewNomorSppd').textContent = formatted;
        document.getElementById('noUrutSppd').value = formatted;
    }

    function updateAutoNomorBa() {
        const kode = document.getElementById('kodeBidangBa').value || '400';
        const urut = String(document.getElementById('urutBaInput').value || '29').padStart(3, '0');
        document.getElementById('noBeritaAcara').value = kode + '/' + urut + '/BA-SIAK/XI/2026';
    }

    function focusRegPanel(panelId, btnEl) {
        document.querySelectorAll('#registrasiTabNav .nav-link').forEach(function(el) {
            el.classList.remove('active');
        });
        if (btnEl) btnEl.classList.add('active');

        document.querySelectorAll('.surface-card').forEach(function(card) {
            card.classList.remove('highlighted-panel');
        });
        const target = document.getElementById(panelId);
        if (target) {
            const card = target.classList.contains('surface-card') ? target : target.querySelector('.surface-card');
            if (card) card.classList.add('highlighted-panel');
            target.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }
    }
</script>
</body>
</html>
