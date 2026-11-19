<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Akun &amp; Hak Akses - Disdukcapil OKI</title>
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
            width: 36px;
            height: 36px;
            border-radius: 0.55rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
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
            font-size: 0.75rem;
            font-weight: 600;
        }

        .security-note-box {
            background-color: #EFF6FF;
            border: 1px solid #BFDBFE;
            border-radius: var(--radius-md);
            padding: 0.75rem;
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
                <a href="/admin/users" class="nav-link-sidebar active">
                    <span class="d-flex align-items-center gap-3">
                        <i class="bi bi-people-fill" aria-hidden="true"></i>
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
                <span class="text-secondary">Administrasi Sistem</span>
                <span class="text-secondary mx-1">/</span>
                <span class="text-primary fw-medium">Manajemen Akun &amp; Hak Akses</span>
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
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show py-2 px-3 mb-3 border-0 shadow-sm" role="alert" style="background-color: #FEE2E2; color: #B91C1C; font-size: 0.8rem;">
                    <div class="d-flex align-items-start gap-2">
                        <i class="bi bi-exclamation-octagon-fill mt-1 flex-shrink-0" aria-hidden="true"></i>
                        <div class="flex-grow-1">
                            <div class="fw-bold mb-1">Validasi Data Pegawai Gagal:</div>
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

            <div class="row g-3 mb-4">
                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="surface-card p-3 h-100 d-flex align-items-center justify-content-between">
                        <div>
                            <div class="text-secondary fw-medium mb-1" style="font-size: 0.76rem;">Total Akun Terdaftar</div>
                            <div class="fs-4 fw-bold text-dark lh-1 mb-1">{{ $stats['total'] ?? $users->count() }}</div>
                            <div class="text-primary fw-medium" style="font-size: 0.72rem;">
                                <i class="bi bi-people-fill me-1" aria-hidden="true"></i>Database Single Gate RBAC
                            </div>
                        </div>
                        <div class="mini-stat-icon" style="background-color: #DBEAFE; color: #2563EB;">
                            <i class="bi bi-people-fill" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="surface-card p-3 h-100 d-flex align-items-center justify-content-between">
                        <div>
                            <div class="text-secondary fw-medium mb-1" style="font-size: 0.76rem;">Akun Berstatus Aktif</div>
                            <div class="fs-4 fw-bold text-success lh-1 mb-1">{{ $stats['aktif'] ?? $users->where('is_active', true)->count() }}</div>
                            <div class="text-success fw-medium" style="font-size: 0.72rem;">
                                <i class="bi bi-check-circle-fill me-1" aria-hidden="true"></i>Dapat Mengakses Sistem
                            </div>
                        </div>
                        <div class="mini-stat-icon" style="background-color: #DCFCE7; color: #16A34A;">
                            <i class="bi bi-person-check-fill" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="surface-card p-3 h-100 d-flex align-items-center justify-content-between">
                        <div>
                            <div class="text-secondary fw-medium mb-1" style="font-size: 0.76rem;">Pejabat Verifikator &amp; TTE</div>
                            <div class="fs-4 fw-bold lh-1 mb-1" style="color: #D97706;">{{ $users->whereIn('role', ['kasubbag', 'sekdin', 'kadin'])->count() }}</div>
                            <div class="fw-medium" style="font-size: 0.72rem; color: #B45309;">
                                <i class="bi bi-diagram-3-fill me-1" aria-hidden="true"></i>Kasubbag, Sekdin &amp; Kadin
                            </div>
                        </div>
                        <div class="mini-stat-icon" style="background-color: #FEF3C7; color: #D97706;">
                            <i class="bi bi-shield-check" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="surface-card p-3 h-100 d-flex align-items-center justify-content-between">
                        <div>
                            <div class="text-secondary fw-medium mb-1" style="font-size: 0.76rem;">Akun Dinonaktifkan</div>
                            <div class="fs-4 fw-bold text-danger lh-1 mb-1">{{ $stats['nonaktif'] ?? $users->where('is_active', false)->count() }}</div>
                            <div class="text-secondary fw-medium" style="font-size: 0.72rem;">
                                <i class="bi bi-person-slash me-1" aria-hidden="true"></i>Akses Login Diblokir
                            </div>
                        </div>
                        <div class="mini-stat-icon" style="background-color: #FEE2E2; color: #DC2626;">
                            <i class="bi bi-person-fill-lock" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-4">
                <div class="col-12 col-lg-4">
                    <div class="surface-card h-100 d-flex flex-column">
                        <div class="px-4 py-3 border-bottom d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center gap-2">
                                <div class="mini-stat-icon" style="background-color: #DBEAFE; color: #2563EB;">
                                    <i class="bi bi-person-plus-fill" aria-hidden="true"></i>
                                </div>
                                <div>
                                    <h6 class="fw-bold text-dark mb-0" style="font-size: 0.9rem;">Daftarkan Akun Pegawai Baru</h6>
                                    <div class="text-secondary" style="font-size: 0.73rem;">Otoritas Khusus Admin Subbag Umpeg</div>
                                </div>
                            </div>
                        </div>

                        <div class="p-4 flex-grow-1">
                            <form action="{{ route('admin.users.store') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="nipPegawai" class="form-label fw-semibold text-dark small mb-1">
                                        NIP Pegawai (18 Digit) <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-text bg-light text-secondary"><i class="bi bi-person-vcard" aria-hidden="true"></i></span>
                                        <input type="text" name="nip" id="nipPegawai" maxlength="18" class="form-control doc-number-mono" placeholder="Contoh: 198807152014021003" value="{{ old('nip') }}" required>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="namaPegawai" class="form-label fw-semibold text-dark small mb-1">
                                        Nama Lengkap &amp; Gelar <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-text bg-light text-secondary"><i class="bi bi-person" aria-hidden="true"></i></span>
                                        <input type="text" name="nama_lengkap" id="namaPegawai" class="form-control" placeholder="Masukkan nama lengkap beserta gelar..." value="{{ old('nama_lengkap') }}" required>
                                    </div>
                                </div>

                                <div class="row g-2 mb-3">
                                    <div class="col-12 col-sm-7">
                                        <label for="jabatanPegawai" class="form-label fw-semibold text-dark small mb-1">
                                            Jabatan Struktural/Fungsional <span class="text-danger">*</span>
                                        </label>
                                        <div class="input-group input-group-sm">
                                            <span class="input-group-text bg-light text-secondary"><i class="bi bi-briefcase" aria-hidden="true"></i></span>
                                            <input type="text" name="jabatan" id="jabatanPegawai" class="form-control" placeholder="Jabatan resmi..." value="{{ old('jabatan') }}" required>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-5">
                                        <label for="pangkatPegawai" class="form-label fw-semibold text-dark small mb-1">
                                            Pangkat / Golongan
                                        </label>
                                        <input type="text" name="pangkat_golongan" id="pangkatPegawai" class="form-control form-control-sm" placeholder="Penata (III/c)" value="{{ old('pangkat_golongan') }}">
                                    </div>
                                </div>

                                <div class="row g-2 mb-3">
                                    <div class="col-12 col-sm-7">
                                        <label for="emailPegawai" class="form-label fw-semibold text-dark small mb-1">
                                            Email Resmi <span class="text-danger">*</span>
                                        </label>
                                        <div class="input-group input-group-sm">
                                            <span class="input-group-text bg-light text-secondary"><i class="bi bi-envelope-at" aria-hidden="true"></i></span>
                                            <input type="email" name="email" id="emailPegawai" class="form-control" placeholder="nama@kaboki.go.id" value="{{ old('email') }}" required>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-5">
                                        <label for="noHpPegawai" class="form-label fw-semibold text-dark small mb-1">
                                            No. HP / WhatsApp
                                        </label>
                                        <input type="text" name="no_hp" id="noHpPegawai" class="form-control form-control-sm doc-number-mono" placeholder="081271xxxxxx" value="{{ old('no_hp') }}">
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="roleSistem" class="form-label fw-semibold text-dark small mb-1">
                                        Penetapan Hak Akses (Role Sistem) <span class="text-danger">*</span>
                                    </label>
                                    <select name="role" id="roleSistem" class="form-select form-select-sm fw-medium">
                                        <option value="admin" {{ old('role', 'admin') === 'admin' ? 'selected' : '' }}>Staf Admin (Operator Agenda &amp; Konsep Surat)</option>
                                        <option value="kasubbag" {{ old('role') === 'kasubbag' ? 'selected' : '' }}>Kasubbag Umpeg (Verifikator Hierarki Tahap 1)</option>
                                        <option value="sekdin" {{ old('role') === 'sekdin' ? 'selected' : '' }}>Sekretaris Dinas / Sekdin (Verifikator Hierarki Tahap 2)</option>
                                        <option value="kadin" {{ old('role') === 'kadin' ? 'selected' : '' }}>Kepala Dinas / Kadin (Otorisator TTE &amp; Disposisi)</option>
                                    </select>
                                    <div class="form-text" style="font-size: 0.69rem;">
                                        Menentukan hak akses dashboard pada Single Gate Login.
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="passwordDefault" class="form-label fw-semibold text-dark small mb-1">
                                        Password Sementara (Default) <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-text bg-light text-secondary"><i class="bi bi-key-fill" aria-hidden="true"></i></span>
                                        <input type="text" name="password" id="passwordDefault" class="form-control doc-number-mono text-primary" value="{{ old('password', 'password123') }}" required>
                                    </div>
                                </div>

                                <div class="security-note-box mb-4">
                                    <div class="d-flex align-items-start gap-2">
                                        <i class="bi bi-shield-lock-fill text-primary mt-1" aria-hidden="true"></i>
                                        <div class="text-secondary" style="font-size: 0.73rem; line-height: 1.45;">
                                            <strong class="text-dark">Kebijakan Keamanan Kredensial:</strong> Pegawai dapat langsung login menggunakan NIP, Email Resmi, atau No. HP beserta password sementara di atas.
                                        </div>
                                    </div>
                                </div>

                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary btn-sm fw-semibold py-2 rounded-2 d-flex align-items-center justify-content-center gap-2 shadow-sm" style="font-size: 0.85rem;">
                                        <i class="bi bi-check2-circle" aria-hidden="true"></i>
                                        <span>Simpan &amp; Aktifkan Akun Pegawai</span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-8">
                    <div class="surface-card h-100 d-flex flex-column overflow-hidden">
                        <div class="p-3 px-4 border-bottom d-flex flex-column flex-xl-row align-items-xl-center justify-content-between gap-3">
                            <div>
                                <h6 class="fw-bold text-dark mb-1">Daftar Akun Pegawai Terdaftar ({{ $users->count() }} Aparatur)</h6>
                                <div class="text-secondary" style="font-size: 0.76rem;">Kelola hak akses RBAC, status otorisasi TTE, dan pemulihan kata sandi aparatur Disdukcapil OKI.</div>
                            </div>

                            <div class="d-flex flex-wrap align-items-center gap-2">
                                <div class="input-group input-group-sm" style="width: 215px;">
                                    <span class="input-group-text bg-white border-end-0 text-secondary">
                                        <i class="bi bi-search" aria-hidden="true"></i>
                                    </span>
                                    <input type="text" id="userSearchInput" onkeyup="filterUserTable()" class="form-control border-start-0 ps-0" placeholder="Cari NIP / Nama pegawai...">
                                </div>

                                <select id="userRoleFilter" onchange="filterUserTable()" class="form-select form-select-sm fw-medium" style="width: 170px;">
                                    <option value="">Semua Role ({{ $users->count() }})</option>
                                    <option value="kadin">Kepala Dinas (Kadin)</option>
                                    <option value="sekdin">Sekretaris Dinas</option>
                                    <option value="kasubbag">Kasubbag Umpeg</option>
                                    <option value="admin">Staf Admin</option>
                                </select>
                            </div>
                        </div>

                        <div class="table-responsive flex-grow-1">
                            <table class="table table-ledger mb-0" id="userDataTable">
                                <thead>
                                    <tr>
                                        <th class="ps-4" style="width: 52px;">NO</th>
                                        <th>NIP, NAMA &amp; KONTAK</th>
                                        <th>JABATAN &amp; PANGKAT</th>
                                        <th>ROLE AKSES</th>
                                        <th>STATUS TTE / AKUN</th>
                                        <th class="pe-4 text-end">AKSI</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $idx => $pegawai)
                                        <tr data-role="{{ $pegawai->role }}" class="{{ ! $pegawai->is_active ? 'table-light text-muted' : '' }}">
                                            <td class="ps-4 fw-bold text-dark font-monospace">{{ $idx + 1 }}</td>
                                            <td>
                                                <div class="fw-semibold text-dark">{{ $pegawai->nama_lengkap }}</div>
                                                <div class="doc-number-mono text-primary mt-1">NIP: {{ $pegawai->nip }}</div>
                                                <div class="text-secondary" style="font-size: 0.71rem;">
                                                    {{ $pegawai->email }}{{ $pegawai->no_hp ? ' • ' . $pegawai->no_hp : '' }}
                                                </div>
                                            </td>
                                            <td>
                                                <div class="fw-medium text-dark">{{ $pegawai->jabatan }}</div>
                                                <div class="text-secondary" style="font-size: 0.72rem;">{{ $pegawai->pangkat_golongan ?: 'ASN Disdukcapil OKI' }}</div>
                                            </td>
                                            <td>
                                                @if ($pegawai->role === 'kadin')
                                                    <span class="badge rounded-2 px-2 py-1 fw-semibold" style="background-color: #EDE9FE; color: #6D28D9; font-size: 0.72rem;">
                                                        <i class="bi bi-award-fill me-1" aria-hidden="true"></i>Kepala Dinas (Kadin)
                                                    </span>
                                                @elseif ($pegawai->role === 'sekdin')
                                                    <span class="badge rounded-2 px-2 py-1 fw-semibold" style="background-color: #DBEAFE; color: #1D4ED8; font-size: 0.72rem;">
                                                        <i class="bi bi-shield-check me-1" aria-hidden="true"></i>Sekdin (Verifikator II)
                                                    </span>
                                                @elseif ($pegawai->role === 'kasubbag')
                                                    <span class="badge rounded-2 px-2 py-1 fw-semibold" style="background-color: #FEF3C7; color: #B45309; font-size: 0.72rem;">
                                                        <i class="bi bi-file-earmark-check me-1" aria-hidden="true"></i>Kasubbag (Verifikator I)
                                                    </span>
                                                @else
                                                    <span class="badge rounded-2 px-2 py-1 fw-semibold" style="background-color: #E0F2FE; color: #0369A1; font-size: 0.72rem;">
                                                        <i class="bi bi-person-gear me-1" aria-hidden="true"></i>Staf Admin
                                                    </span>
                                                @endif
                                            </td>
                                            <td>
                                                @if (! $pegawai->is_active)
                                                    <span class="badge rounded-pill fw-medium px-2 py-1" style="background-color: #FEE2E2; color: #B91C1C; font-size: 0.72rem;">
                                                        <i class="bi bi-x-circle-fill me-1" aria-hidden="true"></i>Nonaktif
                                                    </span>
                                                @elseif ($pegawai->role === 'kadin' && ! empty($pegawai->pin_tte))
                                                    <span class="badge rounded-pill fw-medium px-2 py-1" style="background-color: #DCFCE7; color: #15803D; font-size: 0.72rem;">
                                                        <i class="bi bi-qr-code me-1" aria-hidden="true"></i>PIN TTE Terkonfigurasi
                                                    </span>
                                                @else
                                                    <span class="badge rounded-pill fw-medium px-2 py-1" style="background-color: #DCFCE7; color: #15803D; font-size: 0.72rem;">
                                                        <i class="bi bi-check-circle-fill me-1" aria-hidden="true"></i>Aktif
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="pe-4 text-end">
                                                <div class="d-inline-flex align-items-center gap-1">
                                                    <button type="button"
                                                        onclick="openEditUserModal({{ $pegawai->id }}, @js($pegawai->nip), @js($pegawai->nama_lengkap), @js($pegawai->jabatan), @js($pegawai->pangkat_golongan ?? ''), @js($pegawai->email), @js($pegawai->no_hp ?? ''), @js($pegawai->role))"
                                                        class="btn btn-sm btn-outline-primary fw-medium px-2 py-1" style="font-size: 0.72rem;" title="Edit Profil & Role">
                                                        <i class="bi bi-pencil-square" aria-hidden="true"></i> Edit
                                                    </button>
                                                    <button type="button"
                                                        onclick="openResetPasswordModal({{ $pegawai->id }}, @js($pegawai->nama_lengkap), @js($pegawai->nip))"
                                                        class="btn btn-sm btn-outline-warning text-dark fw-medium px-2 py-1" style="font-size: 0.72rem;" title="Reset Kata Sandi">
                                                        <i class="bi bi-key" aria-hidden="true"></i> Reset
                                                    </button>
                                                    @if ($pegawai->id !== auth()->id())
                                                        <form action="{{ route('admin.users.toggle-active', $pegawai->id) }}" method="POST" class="d-inline">
                                                            @csrf
                                                            @method('PATCH')
                                                            <button type="submit" class="btn btn-sm {{ $pegawai->is_active ? 'btn-outline-danger' : 'btn-outline-success' }} fw-medium px-2 py-1" style="font-size: 0.72rem;" title="{{ $pegawai->is_active ? 'Nonaktifkan Akun' : 'Aktifkan Akun' }}">
                                                                <i class="bi {{ $pegawai->is_active ? 'bi-person-slash' : 'bi-person-check' }}" aria-hidden="true"></i>
                                                            </button>
                                                        </form>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="card-footer bg-white border-top px-4 py-3 d-flex flex-column flex-sm-row align-items-sm-center justify-content-between gap-2">
                            <span class="text-secondary" style="font-size: 0.76rem;">
                                Menampilkan total <strong>{{ $users->count() }}</strong> akun aparatur di database MySQL Disdukcapil OKI
                            </span>
                            <span class="badge bg-primary bg-opacity-10 text-primary fw-semibold" style="font-size: 0.72rem;">
                                <i class="bi bi-database-fill-check me-1" aria-hidden="true"></i>Sinkron Real-Time db_disdukcapil_oki
                            </span>
                        </div>
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

<!-- Modal Edit Profil & Role Pegawai -->
<div class="modal fade" id="modalEditUser" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow rounded-3">
            <form id="formEditUser" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header border-bottom px-4 py-3">
                    <h6 class="modal-title fw-bold text-primary d-flex align-items-center gap-2">
                        <i class="bi bi-pencil-square" aria-hidden="true"></i>
                        <span>Edit Data &amp; Hak Akses (Role) Pegawai</span>
                    </h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body p-4 small">
                    <div class="mb-3">
                        <label class="form-label fw-semibold text-dark mb-1">NIP Pegawai (18 Digit) <span class="text-danger">*</span></label>
                        <input type="text" name="nip" id="editUserNip" maxlength="18" class="form-control form-control-sm doc-number-mono" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold text-dark mb-1">Nama Lengkap &amp; Gelar <span class="text-danger">*</span></label>
                        <input type="text" name="nama_lengkap" id="editUserNama" class="form-control form-control-sm" required>
                    </div>
                    <div class="row g-2 mb-3">
                        <div class="col-12 col-sm-7">
                            <label class="form-label fw-semibold text-dark mb-1">Jabatan <span class="text-danger">*</span></label>
                            <input type="text" name="jabatan" id="editUserJabatan" class="form-control form-control-sm" required>
                        </div>
                        <div class="col-12 col-sm-5">
                            <label class="form-label fw-semibold text-dark mb-1">Pangkat / Golongan</label>
                            <input type="text" name="pangkat_golongan" id="editUserPangkat" class="form-control form-control-sm">
                        </div>
                    </div>
                    <div class="row g-2 mb-3">
                        <div class="col-12 col-sm-7">
                            <label class="form-label fw-semibold text-dark mb-1">Email Resmi <span class="text-danger">*</span></label>
                            <input type="email" name="email" id="editUserEmail" class="form-control form-control-sm" required>
                        </div>
                        <div class="col-12 col-sm-5">
                            <label class="form-label fw-semibold text-dark mb-1">No. HP</label>
                            <input type="text" name="no_hp" id="editUserNoHp" class="form-control form-control-sm doc-number-mono">
                        </div>
                    </div>
                    <div class="mb-0">
                        <label class="form-label fw-semibold text-dark mb-1">Hak Akses (Role Sistem RBAC) <span class="text-danger">*</span></label>
                        <select name="role" id="editUserRole" class="form-select form-select-sm fw-medium">
                            <option value="admin">Staf Admin (Operator Agenda &amp; Konsep Surat)</option>
                            <option value="kasubbag">Kasubbag Umpeg (Verifikator Hierarki Tahap 1)</option>
                            <option value="sekdin">Sekretaris Dinas / Sekdin (Verifikator Hierarki Tahap 2)</option>
                            <option value="kadin">Kepala Dinas / Kadin (Otorisator TTE &amp; Disposisi)</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer border-top px-4 py-2">
                    <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-sm btn-primary fw-semibold">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Reset Password Pegawai -->
<div class="modal fade" id="modalResetPassword" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow rounded-3">
            <form id="formResetPassword" method="POST">
                @csrf
                @method('PATCH')
                <div class="modal-header border-bottom px-4 py-3">
                    <h6 class="modal-title fw-bold text-dark d-flex align-items-center gap-2">
                        <i class="bi bi-key-fill text-warning" aria-hidden="true"></i>
                        <span>Reset Kata Sandi Akun Pegawai</span>
                    </h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body p-4 small">
                    <p class="text-secondary mb-2">Tetapkan kata sandi baru untuk pegawai:</p>
                    <div class="p-2 px-3 rounded-2 bg-light border mb-3">
                        <div class="fw-bold text-dark" id="resetPassNama">-</div>
                        <div class="doc-number-mono text-primary" id="resetPassNip">-</div>
                    </div>
                    <div class="mb-0">
                        <label class="form-label fw-semibold text-dark mb-1">Password Baru <span class="text-danger">*</span></label>
                        <input type="text" name="new_password" class="form-control form-control-sm doc-number-mono text-primary" value="password123" required minlength="6">
                    </div>
                </div>
                <div class="modal-footer border-top px-4 py-2">
                    <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-sm btn-warning text-dark fw-semibold">Reset Kata Sandi</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    localStorage.removeItem('esurat_locked_role');

    function filterUserTable() {
        const q = (document.getElementById('userSearchInput').value || '').toLowerCase();
        const role = document.getElementById('userRoleFilter').value;
        document.querySelectorAll('#userDataTable tbody tr').forEach(function(row) {
            const rowRole = row.getAttribute('data-role') || '';
            const matchText = row.innerText.toLowerCase().includes(q);
            const matchRole = !role || (rowRole === role);
            row.style.display = (matchText && matchRole) ? '' : 'none';
        });
    }

    function openEditUserModal(id, nip, nama, jabatan, pangkat, email, noHp, role) {
        document.getElementById('formEditUser').action = '/admin/users/' + id;
        document.getElementById('editUserNip').value = nip;
        document.getElementById('editUserNama').value = nama;
        document.getElementById('editUserJabatan').value = jabatan;
        document.getElementById('editUserPangkat').value = pangkat;
        document.getElementById('editUserEmail').value = email;
        document.getElementById('editUserNoHp').value = noHp;
        document.getElementById('editUserRole').value = role;
        new bootstrap.Modal(document.getElementById('modalEditUser')).show();
    }

    function openResetPasswordModal(id, nama, nip) {
        document.getElementById('formResetPassword').action = '/admin/users/' + id + '/reset-password';
        document.getElementById('resetPassNama').textContent = nama;
        document.getElementById('resetPassNip').textContent = 'NIP: ' + nip;
        new bootstrap.Modal(document.getElementById('modalResetPassword')).show();
    }
</script>
</body>
</html>
