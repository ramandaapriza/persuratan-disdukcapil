<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Eksekutif Kepala Dinas - Disdukcapil OKI</title>
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
    $userRole = $authUser->role ?? 'kadin';
    $userName = $authUser->nama_lengkap ?? 'Kepala Dinas Dukcapil';
    $userJabatan = $authUser->jabatan ?? 'Kepala Dinas Dukcapil Kab. OKI';
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

    $badgeTte = $menungguTteCount ?? 0;
    $badgeDisposisi = $menungguDisposisiCount ?? 0;
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
                </a>
            @elseif(in_array(auth()->user()->role, ['kasubbag', 'sekdin']))
                <div class="sidebar-section-label">VERIFIKASI BERJENJANG</div>
                <a href="/verifikasi-hierarki" class="nav-link-sidebar">
                    <span class="d-flex align-items-center gap-3">
                        <i class="bi bi-file-earmark-check" aria-hidden="true"></i>
                        <span>Verifikasi Hierarki Naskah</span>
                    </span>
                </a>
            @elseif(auth()->user()->role === 'kadin')
                <div class="sidebar-section-label">MENU UTAMA PIMPINAN</div>
                <a href="/kadin" class="nav-link-sidebar active">
                    <span class="d-flex align-items-center gap-3">
                        <i class="bi bi-grid-fill" aria-hidden="true"></i>
                        <span>Dashboard Eksekutif</span>
                    </span>
                </a>
                <a href="/kadin/validasi" class="nav-link-sidebar">
                    <span class="d-flex align-items-center gap-3">
                        <i class="bi bi-qr-code-scan" aria-hidden="true"></i>
                        <span>Validasi &amp; TTE QR</span>
                    </span>
                    <span class="badge rounded-pill bg-danger" style="font-size: 0.68rem;">{{ $badgeTte }}</span>
                </a>
                <a href="/kadin/disposisi" class="nav-link-sidebar">
                    <span class="d-flex align-items-center gap-3">
                        <i class="bi bi-inbox" aria-hidden="true"></i>
                        <span>Disposisi Surat Masuk</span>
                    </span>
                    <span class="badge rounded-pill bg-warning text-dark fw-bold" style="font-size: 0.68rem;">{{ $badgeDisposisi }}</span>
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
                <span class="badge bg-success text-white" style="font-size: 0.62rem;">BSrE Ready</span>
            </div>
        </div>
    </aside>

    <div class="flex-grow-1 d-flex flex-column min-vh-100" style="margin-left: 260px;">
        <header class="bg-white border-bottom px-4 py-2 d-flex align-items-center justify-content-between sticky-top" style="height: 58px;">
            <div class="small">
                <span class="text-secondary">Disdukcapil OKI</span>
                <span class="text-secondary mx-1">/</span>
                <span class="text-secondary">Menu Utama Pimpinan</span>
                <span class="text-secondary mx-1">/</span>
                <span class="text-primary fw-medium">Dashboard Eksekutif</span>
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
                        <li><a class="dropdown-item" href="#modalPinTte" data-bs-toggle="modal"><i class="bi bi-shield-lock me-2"></i>Pengaturan PIN / Passphrase TTE</a></li>
                        <li><a class="dropdown-item" href="/buku-besar"><i class="bi bi-journal-bookmark me-2"></i>Buku Besar Persuratan</a></li>
                        <li><a class="dropdown-item" href="/verifikasi-dokumen"><i class="bi bi-qr-code-scan me-2"></i>Cek Portal Verifikasi Publik</a></li>
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

            @if (isset($errors) && $errors->any())
                <div class="alert alert-danger alert-dismissible fade show py-2 px-3 mb-3 border-0 shadow-sm" role="alert" style="background-color: #FEE2E2; color: #B91C1C; font-size: 0.8rem;">
                    <div class="fw-bold mb-1"><i class="bi bi-exclamation-triangle-fill me-1"></i>Peringatan Validasi:</div>
                    <ul class="mb-0 ps-3">
                        @foreach ($errors->all() as $err)
                            <li>{{ $err }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup" style="font-size: 0.65rem;"></button>
                </div>
            @endif

            <div class="welcome-banner p-4 mb-4 text-white d-flex flex-column flex-lg-row align-items-lg-center justify-content-between gap-3">
                <div style="max-width: 680px;">
                    <span class="badge rounded-pill px-3 py-1 mb-2 fw-medium d-inline-flex align-items-center gap-1" style="background-color: rgba(59, 130, 246, 0.25); color: #93C5FD; border: 1px solid rgba(147, 197, 253, 0.3); font-size: 0.72rem;">
                        <i class="bi bi-shield-check" aria-hidden="true"></i> Otorisasi Tanda Tangan Elektronik Terpusat
                    </span>
                    <h4 class="fw-bold mb-2">Selamat Datang, {{ $userName }}</h4>
                    <p class="mb-0 text-white text-opacity-75" style="font-size: 0.82rem; line-height: 1.55;">
                        Pantau seluruh antrean naskah dinas keluar, SPPD, berita acara, serta instruksi disposisi surat masuk yang telah diverifikasi berjenjang oleh Kasubbag Umpeg dan Sekretaris Dinas.
                    </p>
                </div>
                <div class="d-flex flex-wrap align-items-center gap-2 flex-shrink-0">
                    <button type="button"
                            onclick="openModalTteMassal()"
                            class="btn btn-light btn-sm fw-semibold text-primary px-3 py-2 rounded-2 d-inline-flex align-items-center gap-1 shadow-sm"
                            {{ $antreanTte->isEmpty() ? 'disabled' : '' }}>
                        <i class="bi bi-qr-code-scan" aria-hidden="true"></i>
                        <span>Otorisasi TTE Massal ({{ $badgeTte }})</span>
                    </button>
                    <a href="/kadin/validasi" class="btn btn-outline-light btn-sm fw-medium px-3 py-2 rounded-2 d-inline-flex align-items-center gap-1" style="border-color: rgba(255,255,255,0.35);">
                        <i class="bi bi-file-earmark-check" aria-hidden="true"></i>
                        <span>Meja Validasi TTE</span>
                    </a>
                    <a href="/buku-besar" class="btn btn-outline-light btn-sm fw-medium px-3 py-2 rounded-2 d-inline-flex align-items-center gap-1" style="border-color: rgba(255,255,255,0.35);">
                        <i class="bi bi-printer" aria-hidden="true"></i>
                        <span>Cetak Buku Besar</span>
                    </a>
                </div>
            </div>

            <div class="row g-3 mb-4">
                <div class="col-12 col-sm-6 col-xl-3">
                    <a href="/kadin/validasi" class="text-decoration-none">
                        <div class="surface-card p-3 h-100 d-flex align-items-center justify-content-between">
                            <div>
                                <div class="text-secondary fw-medium mb-1" style="font-size: 0.76rem;">Menunggu TTE Kadin</div>
                                <div class="fs-4 fw-bold text-danger lh-1 mb-1">{{ $badgeTte }}</div>
                                <div class="text-danger fw-medium" style="font-size: 0.72rem;">
                                    <i class="bi bi-exclamation-circle-fill me-1" aria-hidden="true"></i>Siap dibubuhkan QR Code
                                </div>
                            </div>
                            <div class="mini-stat-icon" style="background-color: #FEE2E2; color: #DC2626;">
                                <i class="bi bi-qr-code-scan" aria-hidden="true"></i>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-12 col-sm-6 col-xl-3">
                    <a href="/kadin/disposisi" class="text-decoration-none">
                        <div class="surface-card p-3 h-100 d-flex align-items-center justify-content-between">
                            <div>
                                <div class="text-secondary fw-medium mb-1" style="font-size: 0.76rem;">Menunggu Disposisi Masuk</div>
                                <div class="fs-4 fw-bold lh-1 mb-1" style="color: #D97706;">{{ $badgeDisposisi }}</div>
                                <div class="fw-medium" style="font-size: 0.72rem; color: #B45309;">
                                    <i class="bi bi-inbox-fill me-1" aria-hidden="true"></i>Diterima Ajudan Kadin
                                </div>
                            </div>
                            <div class="mini-stat-icon" style="background-color: #FEF3C7; color: #D97706;">
                                <i class="bi bi-envelope-arrow-down-fill" aria-hidden="true"></i>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-12 col-sm-6 col-xl-3">
                    <a href="/verifikasi-dokumen" class="text-decoration-none">
                        <div class="surface-card p-3 h-100 d-flex align-items-center justify-content-between">
                            <div>
                                <div class="text-secondary fw-medium mb-1" style="font-size: 0.76rem;">Dokumen Selesai TTE</div>
                                <div class="fs-4 fw-bold text-success lh-1 mb-1">{{ $countSelesaiTte ?? 0 }}</div>
                                <div class="text-success fw-medium" style="font-size: 0.72rem;">
                                    <i class="bi bi-patch-check-fill me-1" aria-hidden="true"></i>Tervalidasi Token UUID
                                </div>
                            </div>
                            <div class="mini-stat-icon" style="background-color: #DCFCE7; color: #16A34A;">
                                <i class="bi bi-shield-fill-check" aria-hidden="true"></i>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-12 col-sm-6 col-xl-3">
                    <a href="/buku-besar" class="text-decoration-none">
                        <div class="surface-card p-3 h-100 d-flex align-items-center justify-content-between">
                            <div>
                                <div class="text-secondary fw-medium mb-1" style="font-size: 0.76rem;">SPPD &amp; Berita Acara Terbit</div>
                                <div class="fs-4 fw-bold text-primary lh-1 mb-1">{{ $totalSppdBa ?? 0 }}</div>
                                <div class="text-primary fw-medium" style="font-size: 0.72rem;">
                                    <i class="bi bi-briefcase-fill me-1" aria-hidden="true"></i>{{ $totalSppd ?? 0 }} SPPD &bull; {{ $totalBeritaAcara ?? 0 }} Berita Acara
                                </div>
                            </div>
                            <div class="mini-stat-icon" style="background-color: #DBEAFE; color: #2563EB;">
                                <i class="bi bi-journals" aria-hidden="true"></i>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <div class="surface-card overflow-hidden">
                <div class="p-3 px-4 border-bottom d-flex flex-column flex-xl-row align-items-xl-center justify-content-between gap-3">
                    <div>
                        <h6 class="fw-bold text-dark mb-1">Antrean Dokumen Membutuhkan Tanda Tangan Elektronik (Status: <code>valid_sekdin</code>)</h6>
                        <div class="text-secondary" style="font-size: 0.76rem;">Seluruh dokumen telah melewati verifikasi Kasubbag Umpeg &amp; Sekretaris Dinas serta siap diotorisasi TTE QR Code.</div>
                    </div>
                    <div class="d-flex flex-wrap align-items-center gap-2">
                        <select id="kadinKodeFilter" onchange="filterKadinTable()" class="form-select form-select-sm fw-medium" style="width: 195px;">
                            <option value="semua" selected>Semua Kode Bidang (400, 800, 00)</option>
                            <option value="Kode 400">Kode 400 - Catatan Sipil</option>
                            <option value="Kode 800">Kode 800 - Kepegawaian</option>
                            <option value="Kode 00">Kode 00 - Keuangan</option>
                        </select>
                        <div class="input-group input-group-sm" style="width: 215px;">
                            <span class="input-group-text bg-white border-end-0 text-secondary">
                                <i class="bi bi-search" aria-hidden="true"></i>
                            </span>
                            <input type="text" id="kadinSearchInput" onkeyup="filterKadinTable()" class="form-control border-start-0 ps-0" placeholder="Cari nomor / perihal...">
                        </div>
                        <button type="button" onclick="resetKadinFilters()" class="btn btn-sm btn-outline-secondary px-2 py-1" title="Reset Filter">
                            <i class="bi bi-arrow-clockwise" aria-hidden="true"></i>
                        </button>
                        <button type="button"
                                id="btnHeaderTteMassal"
                                onclick="openModalTteMassal()"
                                class="btn btn-sm btn-success fw-semibold px-3 py-1 d-inline-flex align-items-center gap-1 shadow-sm"
                                style="font-size: 0.76rem;"
                                {{ $antreanTte->isEmpty() ? 'disabled' : '' }}>
                            <i class="bi bi-check2-all" aria-hidden="true"></i>
                            <span>Tandatangani Terpilih (<span id="selectedCountBadge">{{ $antreanTte->count() }}</span>)</span>
                        </button>
                    </div>
                </div>

                <div class="px-4 pt-2 border-bottom bg-light bg-opacity-50">
                    <ul class="nav nav-tabs ledger-tabs border-0" id="kadinTabNav" data-active-jenis="semua">
                        <li class="nav-item">
                            <button type="button" class="nav-link active" onclick="selectKadinTab('semua', this)">
                                Semua Antrean <span class="badge rounded-pill bg-primary bg-opacity-10 text-primary ms-1">{{ $antreanTte->count() }}</span>
                            </button>
                        </li>
                        <li class="nav-item">
                            <button type="button" class="nav-link" onclick="selectKadinTab('Surat Keluar', this)">
                                Surat Keluar <span class="badge rounded-pill bg-secondary bg-opacity-10 text-secondary ms-1">{{ $countSkAntrean ?? 0 }}</span>
                            </button>
                        </li>
                        <li class="nav-item">
                            <button type="button" class="nav-link" onclick="selectKadinTab('SPPD', this)">
                                SPPD <span class="badge rounded-pill bg-secondary bg-opacity-10 text-secondary ms-1">{{ $countSppdAntrean ?? 0 }}</span>
                            </button>
                        </li>
                        <li class="nav-item">
                            <button type="button" class="nav-link" onclick="selectKadinTab('Berita Acara', this)">
                                Berita Acara <span class="badge rounded-pill bg-secondary bg-opacity-10 text-secondary ms-1">{{ $countBaAntrean ?? 0 }}</span>
                            </button>
                        </li>
                    </ul>
                </div>

                <div class="table-responsive">
                    <table class="table table-ledger mb-0" id="kadinQueueTable">
                        <thead>
                            <tr>
                                <th class="ps-4" style="width: 45px;">
                                    <input type="checkbox" class="form-check-input" id="checkAllTte" onchange="toggleAllTteCheckboxes(this)" {{ $antreanTte->isNotEmpty() ? 'checked' : 'disabled' }}>
                                </th>
                                <th style="width: 50px;">NO</th>
                                <th style="width: 115px;">TANGGAL</th>
                                <th style="width: 235px;">NOMOR DOKUMEN &amp; KODE BIDANG</th>
                                <th style="width: 135px;">JENIS NASKAH</th>
                                <th>PERIHAL &amp; TUJUAN</th>
                                <th style="width: 215px;">STATUS VERIFIKASI HIERARKI</th>
                                <th class="pe-4 text-end" style="width: 155px;">AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($antreanTte as $idx => $item)
                                @php
                                    $bidangBadgeClass = match($item['kode_bidang']) {
                                        '800' => 'bg-warning bg-opacity-15 text-dark',
                                        '00' => 'bg-secondary bg-opacity-10 text-dark border',
                                        default => 'bg-primary bg-opacity-10 text-primary',
                                    };
                                @endphp
                                <tr data-jenis="{{ $item['jenis_label'] }}" data-kode="Kode {{ $item['kode_bidang'] }}">
                                    <td class="ps-4">
                                        <input type="checkbox"
                                               class="form-check-input check-tte-item"
                                               value="{{ $item['key'] }}"
                                               data-nomor="{{ $item['nomor'] }}"
                                               data-jenis="{{ $item['jenis_label'] }}"
                                               checked
                                               onchange="updateSelectedTteCount()">
                                    </td>
                                    <td class="fw-bold text-dark font-monospace">{{ $idx + 1 }}</td>
                                    <td class="text-secondary">{{ $item['tanggal_short'] }}</td>
                                    <td>
                                        <div class="doc-number-mono text-primary">{{ $item['nomor'] }}</div>
                                        <span class="badge {{ $bidangBadgeClass }} fw-medium mt-1" style="font-size: 0.68rem;">
                                            Kode {{ $item['kode_bidang'] }} - {{ $item['nama_bidang'] }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge rounded-2 px-2 py-1 fw-semibold" style="background-color: {{ $item['jenis_badge_bg'] }}; color: {{ $item['jenis_badge_color'] }}; font-size: 0.72rem;">
                                            <i class="bi {{ $item['jenis_icon'] }} me-1" aria-hidden="true"></i>{{ $item['jenis_label'] }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="fw-semibold text-dark">{{ $item['perihal'] }}</div>
                                        <div class="text-secondary mt-1" style="font-size: 0.73rem;">
                                            <i class="bi bi-building me-1" aria-hidden="true"></i>{{ $item['sub_info'] }}
                                        </div>
                                        @if(!empty($item['file_url']))
                                            <a href="{{ $item['file_url'] }}" target="_blank" class="badge bg-info bg-opacity-10 text-primary text-decoration-none border border-primary border-opacity-25 mt-1" style="font-size: 0.66rem;">
                                                <i class="bi bi-paperclip me-1"></i>Pratinjau Lampiran
                                            </a>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="badge rounded-pill fw-medium px-2 py-1" style="background-color: #DCFCE7; color: #15803D; font-size: 0.72rem;">
                                            <i class="bi bi-check-circle-fill me-1" aria-hidden="true"></i>Kasubbag Umpeg &amp; Sekdin
                                        </span>
                                    </td>
                                    <td class="pe-4 text-end">
                                        <a href="{{ $item['validasi_url'] }}" class="btn btn-primary btn-sm fw-semibold px-3 py-1 rounded-2 d-inline-flex align-items-center gap-1 shadow-sm" style="font-size: 0.75rem;">
                                            <i class="bi bi-pen-fill" aria-hidden="true"></i>
                                            <span>Review &amp; TTE</span>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center py-4 text-secondary">
                                        <i class="bi bi-patch-check-fill text-success fs-4 d-block mb-1"></i>
                                        Seluruh antrean naskah berstatus <code>valid_sekdin</code> telah selesai ditandatangani secara elektronik.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="card-footer bg-white border-top px-4 py-3 d-flex flex-column flex-sm-row align-items-sm-center justify-content-between gap-2">
                    <span class="text-secondary" style="font-size: 0.76rem;">
                        Menampilkan <strong>{{ $antreanTte->count() }}</strong> dokumen dalam antrean Tanda Tangan Elektronik Kepala Dinas
                    </span>
                    <a href="/kadin/validasi" class="btn btn-sm btn-outline-primary rounded-2 px-3 py-1 fw-medium" style="font-size: 0.76rem;">
                        Buka Meja Validasi &amp; TTE ({{ $antreanTte->count() }}) <i class="bi bi-arrow-right ms-1" aria-hidden="true"></i>
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

{{-- MODAL 1: OTORISASI TTE MASSAL --}}
<div class="modal fade" id="modalTteMassal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow rounded-3">
            <form action="{{ route('kadin.tte-massal') }}" method="POST" id="formTteMassal">
                @csrf
                <div id="hiddenMassalItemsContainer"></div>

                <div class="modal-header border-bottom px-4 py-3">
                    <h6 class="modal-title fw-bold text-primary d-flex align-items-center gap-2">
                        <i class="bi bi-qr-code-scan" aria-hidden="true"></i>
                        <span>Otorisasi Tanda Tangan Elektronik (TTE) Massal</span>
                    </h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body p-4 small">
                    <div class="p-3 rounded-2 mb-3 border" style="background-color: #EFF6FF; border-color: #BFDBFE !important;">
                        <div class="fw-bold text-primary mb-1">
                            <i class="bi bi-files me-1"></i><span id="modalMassalCountText">0</span> Dokumen Terpilih Siap Diotorisasi
                        </div>
                        <div class="text-secondary" id="modalMassalListText" style="font-size: 0.73rem;">-</div>
                    </div>

                    <div class="mb-3">
                        <label for="inputPinTteMassal" class="form-label fw-semibold text-dark mb-1">
                            Passphrase / PIN Keamanan TTE Kepala Dinas <span class="text-danger">*</span>
                        </label>
                        <div class="input-group input-group-sm">
                            <span class="input-group-text bg-light text-secondary"><i class="bi bi-shield-lock-fill"></i></span>
                            <input type="password" name="pin_tte" id="inputPinTteMassal" class="form-control py-2" placeholder="Masukkan 6 digit PIN TTE Anda..." required>
                        </div>
                        <div class="form-text" style="font-size: 0.71rem;">
                            Setiap dokumen akan diterbitkan Token UUID unik secara otomatis dalam satu transaksi database.
                        </div>
                    </div>

                    <div class="mb-0">
                        <label for="inputCatatanMassal" class="form-label fw-semibold text-dark mb-1">
                            Catatan Otorisasi Pimpinan (Opsional)
                        </label>
                        <textarea name="catatan" id="inputCatatanMassal" class="form-control form-control-sm" rows="2" placeholder="Contoh: Disahkan melalui Otorisasi TTE Massal Kepala Dinas."></textarea>
                    </div>
                </div>
                <div class="modal-footer border-top px-4 py-2">
                    <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-sm btn-success fw-semibold px-3">
                        <i class="bi bi-patch-check-fill me-1"></i>Sah &amp; Bubuhkan TTE Massal
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- MODAL 2: PENGATURAN PIN / PASSPHRASE TTE MANDIRI (ZERO-KNOWLEDGE ADMIN) --}}
<div class="modal fade" id="modalPinTte" tabindex="-1" aria-labelledby="modalPinTteLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow rounded-3">
            <form action="{{ route('kadin.pin-tte.update') }}" method="POST">
                @csrf
                @method('PATCH')
                <div class="modal-header border-bottom px-4 py-3">
                    <h6 class="modal-title fw-bold text-dark d-flex align-items-center gap-2" id="modalPinTteLabel">
                        <i class="bi bi-shield-lock-fill text-primary" aria-hidden="true"></i>
                        <span>Panel Keamanan PIN / Passphrase TTE Kadin</span>
                    </h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="p-3 rounded-2 mb-3 border" style="background-color: #ECFDF5; border-color: #A7F3D0 !important; font-size: 0.78rem;">
                        <strong class="text-success d-block mb-1"><i class="bi bi-patch-check-fill me-1" aria-hidden="true"></i>Sertifikat Elektronik BSrE Aktif (Zero-Knowledge Admin)</strong>
                        <span class="text-secondary">Otorisator: <strong>{{ $userName }}</strong> (NIP. {{ $userNip }})</span>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold small text-dark mb-1">Verifikasi PIN TTE Saat Ini / Kata Sandi Akun <span class="text-danger">*</span></label>
                        <input type="password" name="kredensial_verifikasi" class="form-control form-control-sm" placeholder="Masukkan PIN TTE lama atau Password login Anda..." required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold small text-dark mb-1">PIN TTE Baru (6 Digit Angka) <span class="text-danger">*</span></label>
                        <input type="password" name="pin_tte_baru" maxlength="6" pattern="\d{6}" inputmode="numeric" class="form-control form-control-sm doc-number-mono" placeholder="Contoh: 123456" required>
                    </div>
                    <div class="mb-0">
                        <label class="form-label fw-semibold small text-dark mb-1">Konfirmasi PIN TTE Baru (6 Digit Angka) <span class="text-danger">*</span></label>
                        <input type="password" name="pin_tte_baru_confirmation" maxlength="6" pattern="\d{6}" inputmode="numeric" class="form-control form-control-sm doc-number-mono" placeholder="Ketik ulang 6 digit PIN TTE baru..." required>
                    </div>
                </div>
                <div class="modal-footer border-top px-4 py-2">
                    <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-sm btn-primary fw-semibold">
                        <i class="bi bi-key-fill me-1"></i>Simpan Perubahan PIN TTE
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function selectKadinTab(jenis, btnEl) {
        const nav = document.getElementById('kadinTabNav');
        nav.setAttribute('data-active-jenis', jenis);
        document.querySelectorAll('#kadinTabNav .nav-link').forEach(function(el) {
            el.classList.remove('active');
        });
        if (btnEl) btnEl.classList.add('active');
        filterKadinTable();
    }

    function resetKadinFilters() {
        document.getElementById('kadinSearchInput').value = '';
        document.getElementById('kadinKodeFilter').value = 'semua';
        selectKadinTab('semua', document.querySelector('#kadinTabNav .nav-link'));
    }

    function filterKadinTable() {
        const nav = document.getElementById('kadinTabNav');
        const jenis = nav.getAttribute('data-active-jenis') || 'semua';
        const kode = document.getElementById('kadinKodeFilter').value;
        const q = (document.getElementById('kadinSearchInput').value || '').toLowerCase();

        document.querySelectorAll('#kadinQueueTable tbody tr[data-jenis]').forEach(function(row) {
            const rowJenis = row.getAttribute('data-jenis') || '';
            const rowKode = row.getAttribute('data-kode') || '';
            const matchText = row.innerText.toLowerCase().includes(q);
            const matchJenis = (jenis === 'semua') || (rowJenis === jenis);
            const matchKode = (kode === 'semua') || (rowKode === kode);
            row.style.display = (matchText && matchJenis && matchKode) ? '' : 'none';
        });
    }

    function toggleAllTteCheckboxes(masterEl) {
        document.querySelectorAll('.check-tte-item').forEach(cb => {
            cb.checked = masterEl.checked;
        });
        updateSelectedTteCount();
    }

    function updateSelectedTteCount() {
        const checked = document.querySelectorAll('.check-tte-item:checked');
        const badge = document.getElementById('selectedCountBadge');
        if (badge) badge.textContent = checked.length;
    }

    function openModalTteMassal() {
        let checked = Array.from(document.querySelectorAll('.check-tte-item:checked'));
        if (checked.length === 0) {
            checked = Array.from(document.querySelectorAll('.check-tte-item'));
            checked.forEach(cb => cb.checked = true);
            updateSelectedTteCount();
        }

        const container = document.getElementById('hiddenMassalItemsContainer');
        container.innerHTML = '';

        const nomors = [];
        checked.forEach(cb => {
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'items[]';
            input.value = cb.value;
            container.appendChild(input);
            nomors.push(cb.getAttribute('data-nomor'));
        });

        document.getElementById('modalMassalCountText').textContent = checked.length;
        document.getElementById('modalMassalListText').textContent = 'Nomor Naskah: ' + (nomors.join(', ') || '-');

        new bootstrap.Modal(document.getElementById('modalTteMassal')).show();
    }
</script>
</body>
</html>
