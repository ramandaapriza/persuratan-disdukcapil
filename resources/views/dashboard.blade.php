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
<body data-default-role="{{ $activeRole ?? 'admin' }}">

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
            <div class="sidebar-section-label">MENU UTAMA &amp; AGENDA</div>
            <a href="/" id="nav-dashboard-link" class="nav-link-sidebar active">
                <span class="d-flex align-items-center gap-3">
                    <i class="bi bi-grid-fill" aria-hidden="true"></i>
                    <span>Dashboard</span>
                </span>
            </a>
            <a href="/kadin/disposisi" class="nav-link-sidebar">
                <span class="d-flex align-items-center gap-3">
                    <i class="bi bi-inbox" aria-hidden="true"></i>
                    <span>Surat Masuk &amp; Disposisi</span>
                </span>
                <span class="badge rounded-pill bg-warning text-dark fw-bold" style="font-size: 0.68rem;">2</span>
            </a>
            <a href="/registrasi-surat" class="nav-link-sidebar">
                <span class="d-flex align-items-center gap-3">
                    <i class="bi bi-send" aria-hidden="true"></i>
                    <span>Registrasi Surat &amp; SPPD</span>
                </span>
            </a>

            <div class="sidebar-section-label">VERIFIKASI &amp; OTORISASI TTE</div>
            <a href="/verifikasi-hierarki" class="nav-link-sidebar">
                <span class="d-flex align-items-center gap-3">
                    <i class="bi bi-file-earmark-check" aria-hidden="true"></i>
                    <span>Verifikasi Hierarki</span>
                </span>
                <span class="badge rounded-pill bg-warning text-dark fw-bold" style="font-size: 0.68rem;">4</span>
            </a>
            <a href="/kadin/validasi" class="nav-link-sidebar">
                <span class="d-flex align-items-center gap-3">
                    <i class="bi bi-qr-code-scan" aria-hidden="true"></i>
                    <span>Validasi &amp; TTE Kadin</span>
                </span>
                <span class="badge rounded-pill bg-danger" style="font-size: 0.68rem;">10</span>
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
            <a href="#modalPinTte" data-bs-toggle="modal" class="nav-link-sidebar">
                <span class="d-flex align-items-center gap-3">
                    <i class="bi bi-shield-lock" aria-hidden="true"></i>
                    <span>Pengaturan PIN &amp; Profil</span>
                </span>
            </a>
            <a href="/login" onclick="localStorage.removeItem('esurat_locked_role')" class="nav-link-sidebar text-danger">
                <span class="d-flex align-items-center gap-3">
                    <i class="bi bi-box-arrow-left" aria-hidden="true"></i>
                    <span>Logout</span>
                </span>
            </a>
        </div>

        <div class="p-3 border-top border-secondary border-opacity-25" style="background-color: #0B0F19;">
            <div class="d-flex align-items-center gap-2 mb-2">
                <div id="sidebar-avatar" class="rounded-circle bg-primary text-white fw-bold d-flex align-items-center justify-content-center flex-shrink-0" style="width: 36px; height: 36px; font-size: 0.75rem;">
                    AD
                </div>
                <div class="lh-sm overflow-hidden">
                    <div id="sidebar-name" class="text-white fw-semibold text-truncate" style="font-size: 0.78rem;">AD - Admin Disdukcapil</div>
                    <div id="sidebar-subtitle" class="text-secondary text-truncate" style="font-size: 0.69rem;">Subbag Umum &amp; Kepegawaian</div>
                </div>
            </div>
            <div class="d-flex align-items-center justify-content-between px-2 py-1 rounded-2" style="background-color: rgba(16, 185, 129, 0.12); border: 1px solid rgba(16, 185, 129, 0.25);">
                <span id="sidebar-status" class="text-success fw-semibold d-inline-flex align-items-center gap-1" style="font-size: 0.68rem;">
                    <i class="bi bi-lock-fill" aria-hidden="true"></i> Role Terkunci: Staf Admin
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
                <span class="text-primary fw-medium">Dashboard Persuratan</span>
            </div>

            <div class="d-flex align-items-center gap-2">
                <div class="dropdown">
                    <button class="btn btn-sm border border-primary border-opacity-25 rounded-pill px-3 py-1 d-flex align-items-center gap-2" style="background-color: #EFF6FF; font-size: 0.74rem;" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-person-Private text-primary bi-shield-lock-fill" aria-hidden="true"></i>
                        <span class="text-primary fw-semibold" id="role-switcher-label">Simulasi Aktor: Staf Admin</span>
                        <i class="bi bi-chevron-down text-primary" style="font-size: 0.65rem;" aria-hidden="true"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end shadow border-0 small" style="min-width: 250px;">
                        <li class="px-3 py-1 text-secondary fw-bold" style="font-size: 0.68rem; text-transform: uppercase;">Kunci Identitas Aktor (Testing)</li>
                        <li><a class="dropdown-item py-2" href="/switch-role/admin" onclick="lockUserRole('admin')"><i class="bi bi-person-gear text-primary me-2"></i><strong>Staf Admin</strong> (Subbag Umpeg)</a></li>
                        <li><a class="dropdown-item py-2" href="/switch-role/kasubbag" onclick="lockUserRole('kasubbag')"><i class="bi bi-clipboard2-check text-warning me-2"></i><strong>Kasubbag Umpeg</strong> (Verifikator I)</a></li>
                        <li><a class="dropdown-item py-2" href="/switch-role/sekdin" onclick="lockUserRole('sekdin')"><i class="bi bi-pen text-info me-2"></i><strong>Sekretaris Dinas</strong> (Verifikator II)</a></li>
                        <li><a class="dropdown-item py-2" href="/switch-role/kadin" onclick="lockUserRole('kadin')"><i class="bi bi-qr-code-scan text-success me-2"></i><strong>Kepala Dinas</strong> (Otorisator TTE)</a></li>
                    </ul>
                </div>

                <div class="border rounded-2 px-3 py-1 bg-light text-secondary d-none d-md-flex align-items-center gap-2" style="font-size: 0.78rem;">
                    <i class="bi bi-calendar3 text-primary" aria-hidden="true"></i>
                    <span>Selasa, 17 November 2026</span>
                </div>

                <div class="dropdown">
                    <button class="btn btn-sm border rounded-pill px-2 py-1 d-flex align-items-center gap-2 bg-white" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <span id="topbar-avatar" class="rounded-circle bg-primary text-white fw-bold d-inline-flex align-items-center justify-content-center" style="width: 24px; height: 24px; font-size: 0.68rem;">AD</span>
                        <span id="topbar-name" class="text-dark fw-medium" style="font-size: 0.76rem;">AD - Admin Disdukcapil</span>
                        <i class="bi bi-chevron-down text-secondary" style="font-size: 0.65rem;" aria-hidden="true"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 small">
                        <li class="px-3 py-2 border-bottom">
                            <div id="dropdown-name" class="fw-bold text-dark">Rizky Pratama, S.IP</div>
                            <div id="dropdown-subtitle" class="text-secondary" style="font-size: 0.7rem;">Staf Admin Subbag Umpeg</div>
                        </li>
                        <li><a class="dropdown-item" href="#modalPinTte" data-bs-toggle="modal"><i class="bi bi-person-badge me-2"></i>Profil &amp; Keamanan Akun</a></li>
                        <li><a class="dropdown-item" href="/verifikasi-dokumen"><i class="bi bi-qr-code-scan me-2"></i>Portal Verifikasi Publik</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item text-danger" href="/login" onclick="localStorage.removeItem('esurat_locked_role')"><i class="bi bi-box-arrow-right me-2"></i>Logout</a></li>
                    </ul>
                </div>
            </div>
        </header>

        <main class="p-4 flex-grow-1">
            <div class="welcome-banner p-4 mb-4 text-white d-flex flex-column flex-lg-row align-items-lg-center justify-content-between gap-3">
                <div style="max-width: 680px;">
                    <span class="badge rounded-pill px-3 py-1 mb-2 fw-medium d-inline-flex align-items-center gap-1" style="background-color: rgba(59, 130, 246, 0.25); color: #93C5FD; border: 1px solid rgba(147, 197, 253, 0.3); font-size: 0.72rem;">
                        <i class="bi bi-shield-check" aria-hidden="true"></i> Sistem Tata Kelola Naskah Dinas Terpadu
                    </span>
                    <h4 id="banner-greeting" class="fw-bold mb-2">Selamat Datang, Admin Disdukcapil</h4>
                    <p class="mb-0 text-white text-opacity-75" style="font-size: 0.82rem; line-height: 1.55;">
                        Kelola dan pantau seluruh alur persuratan resmi, surat masuk, surat keluar, SPPD, dan berita acara kedinasan Dinas Kependudukan dan Pencatatan Sipil Kabupaten Ogan Komering Ilir secara efisien dan real-time.
                    </p>
                </div>
                <div class="d-flex flex-wrap align-items-center gap-2 flex-shrink-0">
                    <a href="/registrasi-surat" class="btn btn-light btn-sm fw-semibold text-primary px-3 py-2 rounded-2 d-inline-flex align-items-center gap-1 shadow-sm">
                        <i class="bi bi-plus-circle-fill" aria-hidden="true"></i>
                        <span>Registrasi Surat</span>
                    </a>
                    <a href="/buku-besar" class="btn btn-outline-light btn-sm fw-medium px-3 py-2 rounded-2 d-inline-flex align-items-center gap-1" style="border-color: rgba(255,255,255,0.35);">
                        <i class="bi bi-printer" aria-hidden="true"></i>
                        <span>Cetak Rekap</span>
                    </a>
                </div>
            </div>

            <div class="row g-3 mb-4">
                <div class="col-12 col-sm-6 col-xl-3">
                    <a href="/kadin/disposisi" class="text-decoration-none">
                        <div class="surface-card p-3 h-100 d-flex align-items-center justify-content-between">
                            <div>
                                <div class="text-secondary fw-medium mb-1" style="font-size: 0.76rem;">Total Surat Masuk</div>
                                <div class="fs-4 fw-bold text-dark lh-1 mb-1">153</div>
                                <div class="text-success fw-medium" style="font-size: 0.72rem;">
                                    <i class="bi bi-graph-up-arrow me-1" aria-hidden="true"></i>+12 minggu ini
                                </div>
                            </div>
                            <div class="mini-stat-icon" style="background-color: #DBEAFE; color: #2563EB;">
                                <i class="bi bi-inbox-fill" aria-hidden="true"></i>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-12 col-sm-6 col-xl-3">
                    <a href="/registrasi-surat" class="text-decoration-none">
                        <div class="surface-card p-3 h-100 d-flex align-items-center justify-content-between">
                            <div>
                                <div class="text-secondary fw-medium mb-1" style="font-size: 0.76rem;">Surat Keluar</div>
                                <div class="fs-4 fw-bold text-dark lh-1 mb-1">96</div>
                                <div class="text-primary fw-medium" style="font-size: 0.72rem;">
                                    <i class="bi bi-check2-all me-1" aria-hidden="true"></i>8 terkirim hari ini
                                </div>
                            </div>
                            <div class="mini-stat-icon" style="background-color: #DCFCE7; color: #16A34A;">
                                <i class="bi bi-send-fill" aria-hidden="true"></i>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-12 col-sm-6 col-xl-3">
                    <a href="/registrasi-surat#panel-sppd" class="text-decoration-none">
                        <div class="surface-card p-3 h-100 d-flex align-items-center justify-content-between">
                            <div>
                                <div class="text-secondary fw-medium mb-1" style="font-size: 0.76rem;">SPPD</div>
                                <div class="fs-4 fw-bold text-dark lh-1 mb-1">34</div>
                                <div class="text-secondary fw-medium" style="font-size: 0.72rem;">
                                    <i class="bi bi-geo-alt-fill text-info me-1" aria-hidden="true"></i>3 tugas dinas aktif
                                </div>
                            </div>
                            <div class="mini-stat-icon" style="background-color: #E0F2FE; color: #0284C7;">
                                <i class="bi bi-briefcase-fill" aria-hidden="true"></i>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-12 col-sm-6 col-xl-3">
                    <a href="/kadin/validasi" class="text-decoration-none">
                        <div class="surface-card p-3 h-100 d-flex align-items-center justify-content-between">
                            <div>
                                <div class="text-secondary fw-medium mb-1" style="font-size: 0.76rem;">Menunggu Tanda Tangan</div>
                                <div class="fs-4 fw-bold text-danger lh-1 mb-1">10</div>
                                <div class="text-danger fw-medium" style="font-size: 0.72rem;">
                                    <i class="bi bi-exclamation-circle-fill me-1" aria-hidden="true"></i>Perlu verifikasi Kadis
                                </div>
                            </div>
                            <div class="mini-stat-icon" style="background-color: #FEE2E2; color: #DC2626;">
                                <i class="bi bi-vector-pen" aria-hidden="true"></i>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <div class="surface-card overflow-hidden">
                <div class="p-3 px-4 border-bottom d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
                    <div>
                        <h6 class="fw-bold text-dark mb-1">Surat Masuk Terbaru</h6>
                        <div class="text-secondary" style="font-size: 0.76rem;">Daftar naskah dinas masuk yang tercatat pada buku agenda persuratan Disdukcapil OKI.</div>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <div class="input-group input-group-sm" style="width: 240px;">
                            <span class="input-group-text bg-white border-end-0 text-secondary">
                                <i class="bi bi-search" aria-hidden="true"></i>
                            </span>
                            <input type="text" id="dashboardSearchInput" onkeyup="filterDashboardTable()" class="form-control border-start-0 ps-0" placeholder="Cari surat / pengirim...">
                        </div>
                        <button type="button" onclick="document.getElementById('dashboardSearchInput').value=''; filterDashboardTable();" class="btn btn-sm btn-outline-secondary px-2 py-1" title="Reset Pencarian">
                            <i class="bi bi-arrow-clockwise" aria-hidden="true"></i>
                        </button>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-ledger mb-0" id="dashboardSuratTable">
                        <thead>
                            <tr>
                                <th class="ps-4" style="width: 65px;">NO</th>
                                <th style="width: 135px;">TANGGAL</th>
                                <th style="width: 280px;">PENGIRIM &amp; NOMOR SURAT</th>
                                <th>PERIHAL</th>
                                <th style="width: 155px;">STATUS</th>
                                <th class="pe-4 text-end" style="width: 135px;">TINDAK LANJUT</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="ps-4 fw-bold text-dark font-monospace">1</td>
                                <td class="text-secondary">04 Nov 2026</td>
                                <td>
                                    <div class="fw-semibold text-dark">Ditjen Dukcapil Kemendagri RI</div>
                                    <div class="doc-number-mono text-primary mt-1">470/1204/Dukcapil/2026</div>
                                </td>
                                <td>
                                    <div class="text-dark fw-medium">Undangan Koordinasi Pemanfaatan Identitas Kependudukan Digital (IKD) Semester II</div>
                                    <div class="text-secondary mt-1" style="font-size: 0.73rem;">
                                        <i class="bi bi-tag me-1" aria-hidden="true"></i>Sifat: Penting &bull; Kode Bidang 400
                                    </div>
                                </td>
                                <td>
                                    <span class="badge rounded-pill fw-medium px-3 py-1" style="background-color: #DCFCE7; color: #15803D; font-size: 0.72rem;">
                                        <i class="bi bi-check-circle me-1" aria-hidden="true"></i>Selesai
                                    </span>
                                </td>
                                <td class="pe-4 text-end">
                                    <a href="/buku-besar" class="btn btn-sm btn-outline-primary py-1 px-2" style="font-size: 0.73rem;">Detail Agenda</a>
                                </td>
                            </tr>

                            <tr>
                                <td class="ps-4 fw-bold text-dark font-monospace">2</td>
                                <td class="text-secondary">06 Nov 2026</td>
                                <td>
                                    <div class="fw-semibold text-dark">Sekretariat Daerah Kab. OKI</div>
                                    <div class="doc-number-mono text-primary mt-1">005/341/Setda-OKI/2026</div>
                                </td>
                                <td>
                                    <div class="text-dark fw-medium">Permintaan Data Agregat Kependudukan Bersih (DAK2) untuk Alokasi Anggaran</div>
                                    <div class="text-secondary mt-1" style="font-size: 0.73rem;">
                                        <i class="bi bi-tag me-1" aria-hidden="true"></i>Sifat: Segera &bull; Disposisi Kadin
                                    </div>
                                </td>
                                <td>
                                    <span class="badge rounded-pill fw-medium px-3 py-1" style="background-color: #FEF3C7; color: #B45309; font-size: 0.72rem;">
                                        <i class="bi bi-hourglass-split me-1" aria-hidden="true"></i>Diproses
                                    </span>
                                </td>
                                <td class="pe-4 text-end">
                                    <a href="/kadin/disposisi" class="btn btn-sm btn-primary py-1 px-2" style="font-size: 0.73rem;">Lembar Disposisi</a>
                                </td>
                            </tr>

                            <tr>
                                <td class="ps-4 fw-bold text-dark font-monospace">3</td>
                                <td class="text-secondary">07 Nov 2026</td>
                                <td>
                                    <div class="fw-semibold text-dark">Dinas Komunikasi &amp; Informatika Kab. OKI</div>
                                    <div class="doc-number-mono text-primary mt-1">800/189/Diskominfo-OKI/2026</div>
                                </td>
                                <td>
                                    <div class="text-dark fw-medium">Koordinasi Integrasi API SIAK Terpusat dengan Portal Satu Data Kab. OKI</div>
                                    <div class="text-secondary mt-1" style="font-size: 0.73rem;">
                                        <i class="bi bi-tag me-1" aria-hidden="true"></i>Sifat: Penting &bull; Kode Bidang 800
                                    </div>
                                </td>
                                <td>
                                    <span class="badge rounded-pill fw-medium px-3 py-1" style="background-color: #FEE2E2; color: #B91C1C; font-size: 0.72rem;">
                                        <i class="bi bi-vector-pen me-1" aria-hidden="true"></i>Menunggu TTD
                                    </span>
                                </td>
                                <td class="pe-4 text-end">
                                    <a href="/kadin/validasi" class="btn btn-sm btn-outline-danger py-1 px-2" style="font-size: 0.73rem;">Cek Validasi TTE</a>
                                </td>
                            </tr>

                            <tr>
                                <td class="ps-4 fw-bold text-dark font-monospace">4</td>
                                <td class="text-secondary">08 Nov 2026</td>
                                <td>
                                    <div class="fw-semibold text-dark">Kantor Kecamatan Kayuagung</div>
                                    <div class="doc-number-mono text-primary mt-1">471/092/Kec-Kyg/2026</div>
                                </td>
                                <td>
                                    <div class="text-dark fw-medium">Permohonan Distribusi Tambahan Blangko KTP Elektronik &amp; Ribbon Printer</div>
                                    <div class="text-secondary mt-1" style="font-size: 0.73rem;">
                                        <i class="bi bi-tag me-1" aria-hidden="true"></i>Sifat: Segera &bull; Kode Bidang 400
                                    </div>
                                </td>
                                <td>
                                    <span class="badge rounded-pill fw-medium px-3 py-1" style="background-color: #DCFCE7; color: #15803D; font-size: 0.72rem;">
                                        <i class="bi bi-check-circle me-1" aria-hidden="true"></i>Selesai
                                    </span>
                                </td>
                                <td class="pe-4 text-end">
                                    <a href="/buku-besar" class="btn btn-sm btn-outline-primary py-1 px-2" style="font-size: 0.73rem;">Detail Agenda</a>
                                </td>
                            </tr>

                            <tr>
                                <td class="ps-4 fw-bold text-dark font-monospace">5</td>
                                <td class="text-secondary">09 Nov 2026</td>
                                <td>
                                    <div class="fw-semibold text-dark">Pengadilan Agama Kayuagung</div>
                                    <div class="doc-number-mono text-primary mt-1">W6-A4/892/HK.05/XI/2026</div>
                                </td>
                                <td>
                                    <div class="text-dark fw-medium">Penyampaian Salinan Putusan Perubahan Status Perkawinan &amp; Hak Asuh</div>
                                    <div class="text-secondary mt-1" style="font-size: 0.73rem;">
                                        <i class="bi bi-tag me-1" aria-hidden="true"></i>Sifat: Biasa &bull; Kode Bidang 400
                                    </div>
                                </td>
                                <td>
                                    <span class="badge rounded-pill fw-medium px-3 py-1" style="background-color: #DBEAFE; color: #1D4ED8; font-size: 0.72rem;">
                                        <i class="bi bi-envelope me-1" aria-hidden="true"></i>Baru
                                    </span>
                                </td>
                                <td class="pe-4 text-end">
                                    <a href="/kadin/disposisi" class="btn btn-sm btn-outline-primary py-1 px-2" style="font-size: 0.73rem;">Naikkan ke Ajudan</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="card-footer bg-white border-top px-4 py-3 d-flex flex-column flex-sm-row align-items-sm-center justify-content-between gap-2">
                    <span class="text-secondary" style="font-size: 0.76rem;">Menampilkan <strong>1 &ndash; 5</strong> surat masuk paling mutakhir</span>
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

<div class="modal fade" id="modalPinTte" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow rounded-3">
            <div class="modal-header border-bottom px-4 py-3">
                <h6 class="modal-title fw-bold text-dark d-flex align-items-center gap-2">
                    <i class="bi bi-shield-lock-fill text-primary" aria-hidden="true"></i>
                    <span>Pengaturan Profil &amp; Keamanan Akun</span>
                </h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body p-4">
                <div class="p-3 rounded-2 mb-3 border" style="background-color: #EFF6FF; border-color: #BFDBFE !important; font-size: 0.78rem;">
                    <strong class="text-primary d-block mb-1" id="modal-role-title">Aktor Aktif: Staf Admin Subbag Umpeg</strong>
                    <span class="text-secondary">Kredensial Single Gate RBAC terhubung dengan Buku Besar Disdukcapil OKI.</span>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold small text-dark mb-1">Kata Sandi / Passphrase Saat Ini</label>
                    <input type="password" class="form-control form-control-sm" value="••••••••••••">
                </div>
                <div class="mb-0">
                    <label class="form-label fw-semibold small text-dark mb-1">Kata Sandi / PIN Baru</label>
                    <input type="password" class="form-control form-control-sm" placeholder="Minimal 8 karakter...">
                </div>
            </div>
            <div class="modal-footer border-top px-4 py-2">
                <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-sm btn-primary fw-semibold" data-bs-dismiss="modal">Simpan Perubahan</button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    const ROLE_PROFILES = {
        admin: {
            initials: 'AD',
            badgeClass: 'bg-primary text-white',
            sidebarName: 'AD - Admin Disdukcapil',
            sidebarSub: 'Subbag Umum & Kepegawaian',
            statusText: 'Role Terkunci: Staf Admin',
            switcherText: 'Simulasi Aktor: Staf Admin',
            fullName: 'Rizky Pratama, S.IP',
            greeting: 'Selamat Datang, Admin Disdukcapil',
            homeUrl: '/?role=admin'
        },
        kasubbag: {
            initials: 'KS',
            badgeClass: 'bg-warning text-dark',
            sidebarName: 'KS - Hj. Siti Rahmawati',
            sidebarSub: 'Kasubbag Umpeg • Verifikator I',
            statusText: 'Role Terkunci: Kasubbag (Verif I)',
            switcherText: 'Simulasi Aktor: Kasubbag Umpeg',
            fullName: 'Hj. Siti Rahmawati, S.Sos., M.Si',
            greeting: 'Selamat Datang, Ibu Kasubbag Umpeg',
            homeUrl: '/verifikasi-hierarki?role=kasubbag'
        },
        sekdin: {
            initials: 'SD',
            badgeClass: 'bg-info text-dark',
            sidebarName: 'SD - Ir. H. Bambang Irawan',
            sidebarSub: 'Sekretaris Dinas • Verifikator II',
            statusText: 'Role Terkunci: Sekdin (Verif II)',
            switcherText: 'Simulasi Aktor: Sekretaris Dinas',
            fullName: 'Ir. H. Bambang Irawan, M.M',
            greeting: 'Selamat Datang, Bapak Sekretaris Dinas',
            homeUrl: '/verifikasi-hierarki?role=sekdin'
        },
        kadin: {
            initials: 'KD',
            badgeClass: 'bg-primary text-white',
            sidebarName: 'KD - Drs. H. Hendra Suryadi',
            sidebarSub: 'Kepala Dinas Dukcapil OKI',
            statusText: 'Role Terkunci: Kepala Dinas',
            switcherText: 'Simulasi Aktor: Kepala Dinas',
            fullName: 'Drs. H. Hendra Suryadi, M.Si',
            greeting: 'Selamat Datang, Bapak Kepala Dinas',
            homeUrl: '/kadin?role=kadin'
        }
    };

    function lockUserRole(role) {
        if (ROLE_PROFILES[role]) {
            localStorage.setItem('esurat_locked_role', role);
        }
    }

    function applyLockedRole() {
        const params = new URLSearchParams(window.location.search);
        const urlRole = params.get('role');
        if (urlRole && ROLE_PROFILES[urlRole]) {
            localStorage.setItem('esurat_locked_role', urlRole);
        }

        const activeRole = localStorage.getItem('esurat_locked_role') || document.body.getAttribute('data-default-role') || 'admin';
        localStorage.setItem('esurat_locked_role', activeRole);
        const profile = ROLE_PROFILES[activeRole] || ROLE_PROFILES.admin;

        const sidebarAvatar = document.getElementById('sidebar-avatar');
        const topbarAvatar = document.getElementById('topbar-avatar');
        if (sidebarAvatar) {
            sidebarAvatar.textContent = profile.initials;
            sidebarAvatar.className = 'rounded-circle fw-bold d-flex align-items-center justify-content-center flex-shrink-0 ' + profile.badgeClass;
        }
        if (topbarAvatar) {
            topbarAvatar.textContent = profile.initials;
            topbarAvatar.className = 'rounded-circle fw-bold d-inline-flex align-items-center justify-content-center ' + profile.badgeClass;
        }

        const elMap = {
            'sidebar-name': profile.sidebarName,
            'sidebar-subtitle': profile.sidebarSub,
            'topbar-name': profile.sidebarName,
            'dropdown-name': profile.fullName,
            'dropdown-subtitle': profile.sidebarSub,
            'role-switcher-label': profile.switcherText,
            'banner-greeting': profile.greeting,
            'modal-role-title': 'Aktor Aktif: ' + profile.fullName + ' (' + profile.sidebarSub + ')'
        };
        Object.keys(elMap).forEach(function(id) {
            const el = document.getElementById(id);
            if (el) el.textContent = elMap[id];
        });

        const statusEl = document.getElementById('sidebar-status');
        if (statusEl) {
            statusEl.innerHTML = '<i class="bi bi-lock-fill me-1" aria-hidden="true"></i>' + profile.statusText;
        }

        const dashLink = document.getElementById('nav-dashboard-link');
        if (dashLink) {
            dashLink.setAttribute('href', profile.homeUrl);
        }

        document.querySelectorAll('a[href^="/"]').forEach(function(link) {
            const href = link.getAttribute('href');
            if (!href || href.startsWith('/switch-role') || href.startsWith('/login') || href.includes('role=')) return;
            const parts = href.split('#');
            const base = parts[0];
            const hash = parts[1] ? '#' + parts[1] : '';
            const sep = base.includes('?') ? '&' : '?';
            link.setAttribute('href', base + sep + 'role=' + activeRole + hash);
        });
    }

    function filterDashboardTable() {
        const q = (document.getElementById('dashboardSearchInput').value || '').toLowerCase();
        document.querySelectorAll('#dashboardSuratTable tbody tr').forEach(function(row) {
            row.style.display = row.innerText.toLowerCase().includes(q) ? '' : 'none';
        });
    }

    document.addEventListener('DOMContentLoaded', applyLockedRole);
</script>
</body>
</html>
