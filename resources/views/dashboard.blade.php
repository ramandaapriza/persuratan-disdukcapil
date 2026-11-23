<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Persuratan - Disdukcapil OKI</title>
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

        .welcome-banner {
            background: linear-gradient(135deg, #172554 0%, #1e3a8a 60%, #1d4ed8 100%);
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

    $sidebarRevisiCount = isset($naskahRevisi) ? $naskahRevisi->count() : (
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
                <a href="/" class="nav-link-sidebar active">
                    <span class="d-flex align-items-center gap-3">
                        <i class="bi bi-grid-fill" aria-hidden="true"></i>
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
                <span class="text-primary fw-medium">Dashboard Admin Persuratan</span>
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
            <div class="welcome-banner p-4 mb-4 text-white d-flex flex-column flex-lg-row align-items-lg-center justify-content-between gap-3">
                <div style="max-width: 680px;">
                    <span class="badge rounded-pill px-3 py-1 mb-2 fw-medium d-inline-flex align-items-center gap-1" style="background-color: rgba(59, 130, 246, 0.25); color: #93C5FD; border: 1px solid rgba(147, 197, 253, 0.3); font-size: 0.72rem;">
                        <i class="bi bi-shield-check" aria-hidden="true"></i> Sistem Tata Kelola Naskah Dinas Terpadu
                    </span>
                    <h4 class="fw-bold mb-2">Selamat Datang, {{ $userName }}</h4>
                    <p class="mb-0 text-white text-opacity-75" style="font-size: 0.82rem; line-height: 1.55;">
                        Kelola dan pantau seluruh alur persuratan resmi, surat masuk, surat keluar, SPPD, dan berita acara kedinasan Dinas Kependudukan dan Pencatatan Sipil Kabupaten Ogan Komering Ilir secara efisien dan real-time.
                    </p>
                </div>
                <div class="d-flex flex-wrap align-items-center gap-2 flex-shrink-0">
                    <a href="/registrasi-surat" class="btn btn-light btn-sm fw-semibold text-primary px-3 py-2 rounded-2 d-inline-flex align-items-center gap-1 shadow-sm">
                        <i class="bi bi-plus-circle-fill" aria-hidden="true"></i>
                        <span>Registrasi Surat</span>
                    </a>
                    <a href="/riwayat-naskah" class="btn btn-outline-light btn-sm fw-medium px-3 py-2 rounded-2 d-inline-flex align-items-center gap-1" style="border-color: rgba(255,255,255,0.35);">
                        <i class="bi bi-clock-history" aria-hidden="true"></i>
                        <span>Riwayat &amp; Pantauan</span>
                    </a>
                    <a href="/buku-besar" class="btn btn-outline-light btn-sm fw-medium px-3 py-2 rounded-2 d-inline-flex align-items-center gap-1" style="border-color: rgba(255,255,255,0.35);">
                        <i class="bi bi-printer" aria-hidden="true"></i>
                        <span>Cetak Rekap</span>
                    </a>
                </div>
            </div>

            <div class="row g-3 mb-4">
                <div class="col-12 col-sm-6 col-xl-3">
                    <a href="/registrasi-surat#panel-surat-masuk" class="text-decoration-none">
                        <div class="surface-card p-3 h-100 d-flex align-items-center justify-content-between">
                            <div>
                                <div class="text-secondary fw-medium mb-1" style="font-size: 0.76rem;">Total Surat Masuk</div>
                                <div class="fs-4 fw-bold text-dark lh-1 mb-1">{{ $totalSuratMasuk ?? 0 }}</div>
                                <div class="text-success fw-medium" style="font-size: 0.72rem;">
                                    <i class="bi bi-inbox me-1" aria-hidden="true"></i>{{ $suratMasukBaru ?? 0 }} surat baru belum naik
                                </div>
                            </div>
                            <div class="mini-stat-icon" style="background-color: #DBEAFE; color: #2563EB;">
                                <i class="bi bi-inbox-fill" aria-hidden="true"></i>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-12 col-sm-6 col-xl-3">
                    <a href="/riwayat-naskah?kategori=surat_keluar" class="text-decoration-none">
                        <div class="surface-card p-3 h-100 d-flex align-items-center justify-content-between">
                            <div>
                                <div class="text-secondary fw-medium mb-1" style="font-size: 0.76rem;">Surat Keluar</div>
                                <div class="fs-4 fw-bold text-dark lh-1 mb-1">{{ $totalSuratKeluar ?? 0 }}</div>
                                <div class="text-primary fw-medium" style="font-size: 0.72rem;">
                                    <i class="bi bi-qr-code me-1" aria-hidden="true"></i>{{ $suratKeluarTte ?? 0 }} sah ber-TTE Kadin
                                </div>
                            </div>
                            <div class="mini-stat-icon" style="background-color: #DCFCE7; color: #16A34A;">
                                <i class="bi bi-send-fill" aria-hidden="true"></i>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-12 col-sm-6 col-xl-3">
                    <a href="/riwayat-naskah?kategori=sppd" class="text-decoration-none">
                        <div class="surface-card p-3 h-100 d-flex align-items-center justify-content-between">
                            <div>
                                <div class="text-secondary fw-medium mb-1" style="font-size: 0.76rem;">SPPD &amp; Berita Acara</div>
                                <div class="fs-4 fw-bold text-dark lh-1 mb-1">{{ ($totalSppd ?? 0) + ($totalBeritaAcara ?? 0) }}</div>
                                <div class="text-secondary fw-medium" style="font-size: 0.72rem;">
                                    <i class="bi bi-geo-alt-fill text-info me-1" aria-hidden="true"></i>{{ $totalSppd ?? 0 }} SPPD &bull; {{ $totalBeritaAcara ?? 0 }} Berita Acara
                                </div>
                            </div>
                            <div class="mini-stat-icon" style="background-color: #E0F2FE; color: #0284C7;">
                                <i class="bi bi-briefcase-fill" aria-hidden="true"></i>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-12 col-sm-6 col-xl-3">
                    <a href="/riwayat-naskah?status=revisi#panel-revisi" class="text-decoration-none">
                        <div class="surface-card p-3 h-100 d-flex align-items-center justify-content-between">
                            <div>
                                <div class="text-secondary fw-medium mb-1" style="font-size: 0.76rem;">Dalam Verifikasi &amp; Revisi</div>
                                <div class="fs-4 fw-bold text-danger lh-1 mb-1">{{ ($menungguVerifikasi ?? 0) + (isset($naskahRevisi) ? $naskahRevisi->count() : 0) }}</div>
                                <div class="text-danger fw-medium" style="font-size: 0.72rem;">
                                    <i class="bi bi-exclamation-circle-fill me-1" aria-hidden="true"></i>{{ isset($naskahRevisi) ? $naskahRevisi->count() : 0 }} perlu revisi Admin
                                </div>
                            </div>
                            <div class="mini-stat-icon" style="background-color: #FEE2E2; color: #DC2626;">
                                <i class="bi bi-vector-pen" aria-hidden="true"></i>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            @if (isset($naskahRevisi) && $naskahRevisi->isNotEmpty())
                <div class="surface-card overflow-hidden mb-4" style="border-color: #FCA5A5;">
                    <div class="p-3 px-4 border-bottom d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-2" style="background-color: #FEF2F2;">
                        <div class="d-flex align-items-center gap-2">
                            <span class="badge rounded-pill bg-danger text-white px-2 py-1">
                                <i class="bi bi-arrow-counterclockwise me-1" aria-hidden="true"></i>Perlu Tindakan Revisi ({{ $naskahRevisi->count() }})
                            </span>
                            <h6 class="fw-bold text-danger mb-0" style="font-size: 0.86rem;">Naskah Dinas Dikembalikan oleh Pejabat Verifikator untuk Diperbaiki</h6>
                        </div>
                        <a href="/riwayat-naskah?status=revisi#panel-revisi" class="btn btn-sm btn-danger fw-semibold px-3 py-1" style="font-size: 0.75rem;">
                            <i class="bi bi-clock-history me-1" aria-hidden="true"></i>Buka Halaman Riwayat &amp; Revisi Naskah
                        </a>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-ledger mb-0">
                            <thead>
                                <tr>
                                    <th class="ps-4">JENIS &amp; NOMOR NASKAH</th>
                                    <th>TUJUAN / MITRA</th>
                                    <th>PERIHAL</th>
                                    <th>CATATAN REVISI VERIFIKATOR</th>
                                    <th class="pe-4 text-end">TINDAK LANJUT</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($naskahRevisi as $rev)
                                    <tr>
                                        <td class="ps-4">
                                            <span class="badge bg-danger bg-opacity-10 text-danger fw-semibold mb-1">{{ $rev['jenis_label'] }} &bull; Kode {{ $rev['kode_bidang'] }}</span>
                                            <div class="doc-number-mono text-primary">{{ $rev['nomor'] }}</div>
                                        </td>
                                        <td class="fw-medium text-dark">{{ $rev['tujuan'] }}</td>
                                        <td class="text-dark">{{ $rev['perihal'] }}</td>
                                        <td>
                                            <div class="p-2 rounded-2 border small" style="background-color: #FFFBEB; border-color: #FDE68A !important; color: #92400E; font-size: 0.76rem;">
                                                <i class="bi bi-chat-left-quote-fill me-1" aria-hidden="true"></i>{{ $rev['catatan_revisi'] }}
                                            </div>
                                        </td>
                                        <td class="pe-4 text-end">
                                            <a href="/riwayat-naskah?status=revisi&amp;open_edit={{ ($rev['jenis'] ?? 'surat_keluar') . '_' . ($rev['id'] ?? 1) }}#panel-revisi" class="btn btn-sm btn-primary fw-semibold py-1 px-2" style="font-size: 0.74rem;">
                                                <i class="bi bi-pencil-square me-1" aria-hidden="true"></i>Edit &amp; Ajukan Ulang
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif

            <div class="surface-card overflow-hidden">
                <div class="p-3 px-4 border-bottom d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
                    <div>
                        <h6 class="fw-bold text-dark mb-1">Surat Masuk Terbaru (Database Agenda)</h6>
                        <div class="text-secondary" style="font-size: 0.76rem;">Daftar naskah dinas masuk yang tercatat pada buku agenda persuratan Disdukcapil OKI.</div>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <div class="input-group input-group-sm" style="width: 240px;">
                            <span class="input-group-text bg-white border-end-0 text-secondary">
                                <i class="bi bi-search" aria-hidden="true"></i>
                            </span>
                            <input type="text" id="dashboardSearchInput" onkeyup="filterDashboardTable()" class="form-control border-start-0 ps-0" placeholder="Cari surat / pengirim...">
                        </div>
                        <a href="/registrasi-surat#panel-surat-masuk" class="btn btn-sm btn-primary fw-semibold px-2 py-1" style="font-size: 0.74rem;">
                            <i class="bi bi-plus-lg me-1" aria-hidden="true"></i>Catat Surat Masuk
                        </a>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-ledger mb-0" id="dashboardSuratTable">
                        <thead>
                            <tr>
                                <th class="ps-4" style="width: 85px;">AGENDA</th>
                                <th style="width: 125px;">TANGGAL</th>
                                <th style="width: 260px;">PENGIRIM &amp; NOMOR SURAT</th>
                                <th>PERIHAL</th>
                                <th style="width: 155px;">STATUS</th>
                                <th class="pe-4 text-end" style="width: 155px;">TINDAK LANJUT</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($suratMasukTerbaru ?? [] as $sm)
                                <tr>
                                    <td class="ps-4 fw-bold text-dark font-monospace">#{{ $sm->nomor_urut_agenda }}</td>
                                    <td class="text-secondary">{{ $sm->tanggal_diterima?->format('d M Y') }}</td>
                                    <td>
                                        <div class="fw-semibold text-dark">{{ $sm->pengirim }}</div>
                                        <div class="doc-number-mono text-primary mt-1">{{ $sm->nomor_surat }}</div>
                                    </td>
                                    <td>
                                        <div class="text-dark fw-medium">{{ $sm->perihal }}</div>
                                        <div class="text-secondary mt-1" style="font-size: 0.73rem;">
                                            <i class="bi bi-tag me-1" aria-hidden="true"></i>Sifat: {{ $sm->sifat_surat }}
                                            &bull; Kode Bidang {{ $sm->kodeKlasifikasi->kode_bidang ?? '400' }}
                                            @if ($sm->nama_ajudan_penerima)
                                                &bull; Ajudan: {{ $sm->nama_ajudan_penerima }}
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        @if ($sm->status === 'selesai')
                                            <span class="badge rounded-pill fw-medium px-3 py-1" style="background-color: #DCFCE7; color: #15803D; font-size: 0.72rem;">
                                                <i class="bi bi-check-circle me-1" aria-hidden="true"></i>Selesai Disposisi
                                            </span>
                                        @elseif ($sm->status === 'diproses')
                                            <span class="badge rounded-pill fw-medium px-3 py-1" style="background-color: #FEF3C7; color: #B45309; font-size: 0.72rem;">
                                                <i class="bi bi-hourglass-split me-1" aria-hidden="true"></i>Diproses Kadin
                                            </span>
                                        @else
                                            <span class="badge rounded-pill fw-medium px-3 py-1" style="background-color: #DBEAFE; color: #1D4ED8; font-size: 0.72rem;">
                                                <i class="bi bi-envelope me-1" aria-hidden="true"></i>Baru Tercatat
                                            </span>
                                        @endif
                                    </td>
                                    <td class="pe-4 text-end">
                                        @if ($sm->status_kenaikan === 'belum_naik' || $sm->status === 'baru')
                                            <form action="{{ route('surat-masuk.naik-ajudan', $sm->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn btn-sm btn-primary py-1 px-2 fw-medium" style="font-size: 0.73rem;">
                                                    <i class="bi bi-send-check me-1" aria-hidden="true"></i>Teruskan ke Ajudan
                                                </button>
                                            </form>
                                        @else
                                            <a href="/riwayat-naskah?kategori=surat_masuk" class="btn btn-sm btn-outline-primary py-1 px-2" style="font-size: 0.73rem;">Detail Agenda</a>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-secondary py-4">Belum ada data surat masuk tercatat.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="card-footer bg-white border-top px-4 py-3 d-flex flex-column flex-sm-row align-items-sm-center justify-content-between gap-2">
                    <span class="text-secondary" style="font-size: 0.76rem;">Menampilkan <strong>{{ isset($suratMasukTerbaru) ? $suratMasukTerbaru->count() : 0 }}</strong> surat masuk paling mutakhir dari database</span>
                    <a href="/buku-besar" class="btn btn-sm btn-outline-primary rounded-2 px-3 py-1 fw-medium" style="font-size: 0.76rem;">
                        Lihat Seluruh Surat di Buku Besar <i class="bi bi-arrow-right ms-1" aria-hidden="true"></i>
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
    function filterDashboardTable() {
        const q = (document.getElementById('dashboardSearchInput').value || '').toLowerCase();
        document.querySelectorAll('#dashboardSuratTable tbody tr').forEach(function(row) {
            row.style.display = row.innerText.toLowerCase().includes(q) ? '' : 'none';
        });
    }
</script>
</body>
</html>
