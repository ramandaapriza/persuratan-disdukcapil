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
<body data-default-role="{{ $activeRole ?? 'kadin' }}">

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
            <a href="/kadin" id="nav-dashboard-link" class="nav-link-sidebar active">
                <span class="d-flex align-items-center gap-3">
                    <i class="bi bi-grid-fill" aria-hidden="true"></i>
                    <span>Dashboard Eksekutif</span>
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
                    <i class="bi bi-send-check" aria-hidden="true"></i>
                    <span>Monitoring Surat &amp; SPPD</span>
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
                    <span>Validasi &amp; TTE QR</span>
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
                    <span>Pengaturan PIN / Passphrase TTE</span>
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
                    KD
                </div>
                <div class="lh-sm overflow-hidden">
                    <div id="sidebar-name" class="text-white fw-semibold text-truncate" style="font-size: 0.78rem;">KD - Drs. H. Hendra Suryadi</div>
                    <div id="sidebar-subtitle" class="text-secondary text-truncate" style="font-size: 0.69rem;">Kepala Dinas Dukcapil OKI</div>
                </div>
            </div>
            <div class="d-flex align-items-center justify-content-between px-2 py-1 rounded-2" style="background-color: rgba(16, 185, 129, 0.12); border: 1px solid rgba(16, 185, 129, 0.25);">
                <span id="sidebar-status" class="text-success fw-semibold d-inline-flex align-items-center gap-1" style="font-size: 0.68rem;">
                    <i class="bi bi-lock-fill" aria-hidden="true"></i> Role Terkunci: Kepala Dinas
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
                <div class="dropdown">
                    <button class="btn btn-sm border border-primary border-opacity-25 rounded-pill px-3 py-1 d-flex align-items-center gap-2" style="background-color: #EFF6FF; font-size: 0.74rem;" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-shield-lock-fill text-primary" aria-hidden="true"></i>
                        <span class="text-primary fw-semibold" id="role-switcher-label">Simulasi Aktor: Kepala Dinas</span>
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
                        <span id="topbar-avatar" class="rounded-circle bg-primary text-white fw-bold d-inline-flex align-items-center justify-content-center" style="width: 24px; height: 24px; font-size: 0.68rem;">KD</span>
                        <span id="topbar-name" class="text-dark fw-medium" style="font-size: 0.76rem;">KD - Drs. H. Hendra Suryadi</span>
                        <i class="bi bi-chevron-down text-secondary" style="font-size: 0.65rem;" aria-hidden="true"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 small">
                        <li class="px-3 py-2 border-bottom">
                            <div id="dropdown-name" class="fw-bold text-dark">Drs. H. Hendra Suryadi, M.Si</div>
                            <div id="dropdown-subtitle" class="text-secondary" style="font-size: 0.7rem;">Kepala Dinas Dukcapil OKI &bull; Otorisator TTE Aktif</div>
                        </li>
                        <li><a class="dropdown-item" href="#modalPinTte" data-bs-toggle="modal"><i class="bi bi-shield-lock me-2"></i>Pengaturan PIN / Passphrase TTE</a></li>
                        <li><a class="dropdown-item" href="/verifikasi-dokumen"><i class="bi bi-qr-code-scan me-2"></i>Cek Portal Verifikasi Publik</a></li>
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
                        <i class="bi bi-shield-check" aria-hidden="true"></i> Otorisasi Tanda Tangan Elektronik Terpusat
                    </span>
                    <h4 class="fw-bold mb-2">Selamat Datang, Drs. H. Hendra Suryadi, M.Si</h4>
                    <p class="mb-0 text-white text-opacity-75" style="font-size: 0.82rem; line-height: 1.55;">
                        Pantau seluruh antrean naskah dinas keluar, SPPD, berita acara, serta instruksi disposisi surat masuk yang telah diverifikasi berjenjang oleh Kasubbag Umpeg dan Sekretaris Dinas.
                    </p>
                </div>
                <div class="d-flex flex-wrap align-items-center gap-2 flex-shrink-0">
                    <a href="/kadin/validasi" class="btn btn-light btn-sm fw-semibold text-primary px-3 py-2 rounded-2 d-inline-flex align-items-center gap-1 shadow-sm">
                        <i class="bi bi-qr-code-scan" aria-hidden="true"></i>
                        <span>Validasi &amp; TTD Massal</span>
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
                                <div class="fs-4 fw-bold text-danger lh-1 mb-1">10</div>
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
                                <div class="fs-4 fw-bold lh-1 mb-1" style="color: #D97706;">2</div>
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
                                <div class="fs-4 fw-bold text-success lh-1 mb-1">142</div>
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
                                <div class="fs-4 fw-bold text-primary lh-1 mb-1">62</div>
                                <div class="text-primary fw-medium" style="font-size: 0.72rem;">
                                    <i class="bi bi-briefcase-fill me-1" aria-hidden="true"></i>34 SPPD &bull; 28 Berita Acara
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
                <div class="p-3 px-4 border-bottom d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
                    <div>
                        <h6 class="fw-bold text-dark mb-1">Antrean Dokumen Membutuhkan Tanda Tangan</h6>
                        <div class="text-secondary" style="font-size: 0.76rem;">Seluruh dokumen telah melewati verifikasi Kasubbag Umpeg &amp; Sekretaris Dinas serta siap diotorisasi.</div>
                    </div>
                    <div class="d-flex flex-wrap align-items-center gap-2">
                        <select id="kadinKodeFilter" onchange="filterKadinTable()" class="form-select form-select-sm fw-medium" style="width: 195px;">
                            <option value="semua" selected>Semua Kode Bidang (400, 800, 00)</option>
                            <option value="Kode 400">Kode 400 - Catatan Sipil</option>
                            <option value="Kode 800">Kode 800 - Kepegawaian</option>
                            <option value="Kode 00">Kode 00 - Keuangan</option>
                        </select>
                        <div class="input-group input-group-sm" style="width: 225px;">
                            <span class="input-group-text bg-white border-end-0 text-secondary">
                                <i class="bi bi-search" aria-hidden="true"></i>
                            </span>
                            <input type="text" id="kadinSearchInput" onkeyup="filterKadinTable()" class="form-control border-start-0 ps-0" placeholder="Cari nomor / perihal...">
                        </div>
                        <button type="button" onclick="document.getElementById('kadinSearchInput').value=''; document.getElementById('kadinKodeFilter').value='semua'; selectKadinTab('semua', document.querySelector('#kadinTabNav .nav-link'));" class="btn btn-sm btn-outline-secondary px-2 py-1" title="Reset Filter">
                            <i class="bi bi-arrow-clockwise" aria-hidden="true"></i>
                        </button>
                    </div>
                </div>

                <div class="px-4 pt-2 border-bottom bg-light bg-opacity-50">
                    <ul class="nav nav-tabs ledger-tabs border-0" id="kadinTabNav" data-active-jenis="semua">
                        <li class="nav-item">
                            <button type="button" class="nav-link active" onclick="selectKadinTab('semua', this)">
                                Semua Antrean <span class="badge rounded-pill bg-primary bg-opacity-10 text-primary ms-1">10</span>
                            </button>
                        </li>
                        <li class="nav-item">
                            <button type="button" class="nav-link" onclick="selectKadinTab('Surat Keluar', this)">
                                Surat Keluar <span class="badge rounded-pill bg-secondary bg-opacity-10 text-secondary ms-1">5</span>
                            </button>
                        </li>
                        <li class="nav-item">
                            <button type="button" class="nav-link" onclick="selectKadinTab('SPPD', this)">
                                SPPD <span class="badge rounded-pill bg-secondary bg-opacity-10 text-secondary ms-1">3</span>
                            </button>
                        </li>
                        <li class="nav-item">
                            <button type="button" class="nav-link" onclick="selectKadinTab('Berita Acara', this)">
                                Berita Acara <span class="badge rounded-pill bg-secondary bg-opacity-10 text-secondary ms-1">2</span>
                            </button>
                        </li>
                    </ul>
                </div>

                <div class="table-responsive">
                    <table class="table table-ledger mb-0" id="kadinQueueTable">
                        <thead>
                            <tr>
                                <th class="ps-4" style="width: 55px;">NO</th>
                                <th style="width: 120px;">TANGGAL</th>
                                <th style="width: 235px;">NOMOR DOKUMEN &amp; KODE BIDANG</th>
                                <th style="width: 130px;">JENIS NASKAH</th>
                                <th>PERIHAL &amp; TUJUAN</th>
                                <th style="width: 230px;">STATUS VERIFIKASI HIERARKI</th>
                                <th class="pe-4 text-end" style="width: 150px;">AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr data-jenis="Surat Keluar" data-kode="Kode 400">
                                <td class="ps-4 fw-bold text-dark font-monospace">1</td>
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
                                    <div class="fw-semibold text-dark">Penyampaian Laporan Rekapitulasi Penerbitan Akta Pencatatan Sipil Semester II</div>
                                    <div class="text-secondary mt-1" style="font-size: 0.73rem;">
                                        <i class="bi bi-building me-1" aria-hidden="true"></i>Tujuan: Ditjen Dukcapil Kemendagri RI - Jakarta
                                    </div>
                                </td>
                                <td>
                                    <span class="badge rounded-pill fw-medium px-2 py-1" style="background-color: #DCFCE7; color: #15803D; font-size: 0.72rem;">
                                        <i class="bi bi-check-circle-fill me-1" aria-hidden="true"></i>Kasubbag Umpeg &amp; Sekdin
                                    </span>
                                </td>
                                <td class="pe-4 text-end">
                                    <a href="/kadin/validasi" class="btn btn-primary btn-sm fw-semibold px-3 py-1 rounded-2 d-inline-flex align-items-center gap-1 shadow-sm" style="font-size: 0.75rem;">
                                        <i class="bi bi-pen-fill" aria-hidden="true"></i>
                                        <span>Review &amp; TTD</span>
                                    </a>
                                </td>
                            </tr>

                            <tr data-jenis="SPPD" data-kode="Kode 800">
                                <td class="ps-4 fw-bold text-dark font-monospace">2</td>
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
                                    <div class="fw-semibold text-dark">Rapat Koordinasi Teknis Pemutakhiran Data &amp; Rekonsiliasi Blangko KTP-el</div>
                                    <div class="text-secondary mt-1" style="font-size: 0.73rem;">
                                        <i class="bi bi-person-badge me-1" aria-hidden="true"></i>Pegawai: Drs. H. Ahmad Fauzi, M.Si (Palembang)
                                    </div>
                                </td>
                                <td>
                                    <span class="badge rounded-pill fw-medium px-2 py-1" style="background-color: #DCFCE7; color: #15803D; font-size: 0.72rem;">
                                        <i class="bi bi-check-circle-fill me-1" aria-hidden="true"></i>Kasubbag Umpeg &amp; Sekdin
                                    </span>
                                </td>
                                <td class="pe-4 text-end">
                                    <a href="/kadin/validasi" class="btn btn-primary btn-sm fw-semibold px-3 py-1 rounded-2 d-inline-flex align-items-center gap-1 shadow-sm" style="font-size: 0.75rem;">
                                        <i class="bi bi-pen-fill" aria-hidden="true"></i>
                                        <span>Review &amp; TTD</span>
                                    </a>
                                </td>
                            </tr>

                            <tr data-jenis="Berita Acara" data-kode="Kode 400">
                                <td class="ps-4 fw-bold text-dark font-monospace">3</td>
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
                                    <div class="fw-semibold text-dark">Berita Acara Serah Terima (BAST) Distribusi 1.500 Keping Blangko KTP-el</div>
                                    <div class="text-secondary mt-1" style="font-size: 0.73rem;">
                                        <i class="bi bi-building me-1" aria-hidden="true"></i>Tujuan: Kantor Kecamatan Kayuagung
                                    </div>
                                </td>
                                <td>
                                    <span class="badge rounded-pill fw-medium px-2 py-1" style="background-color: #DCFCE7; color: #15803D; font-size: 0.72rem;">
                                        <i class="bi bi-check-circle-fill me-1" aria-hidden="true"></i>Kasubbag Umpeg &amp; Sekdin
                                    </span>
                                </td>
                                <td class="pe-4 text-end">
                                    <a href="/kadin/validasi" class="btn btn-primary btn-sm fw-semibold px-3 py-1 rounded-2 d-inline-flex align-items-center gap-1 shadow-sm" style="font-size: 0.75rem;">
                                        <i class="bi bi-pen-fill" aria-hidden="true"></i>
                                        <span>Review &amp; TTD</span>
                                    </a>
                                </td>
                            </tr>

                            <tr data-jenis="Surat Keluar" data-kode="Kode 400">
                                <td class="ps-4 fw-bold text-dark font-monospace">4</td>
                                <td class="text-secondary">10 Nov 2026</td>
                                <td>
                                    <div class="doc-number-mono text-primary">470/189/Disdukcapil-OKI/XI/2026</div>
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
                                    <div class="fw-semibold text-dark">Koordinasi Integrasi SIAK Terpusat dengan Portal Satu Data Kab. OKI</div>
                                    <div class="text-secondary mt-1" style="font-size: 0.73rem;">
                                        <i class="bi bi-building me-1" aria-hidden="true"></i>Tujuan: Dinas Kominfo Kabupaten OKI
                                    </div>
                                </td>
                                <td>
                                    <span class="badge rounded-pill fw-medium px-2 py-1" style="background-color: #DCFCE7; color: #15803D; font-size: 0.72rem;">
                                        <i class="bi bi-check-circle-fill me-1" aria-hidden="true"></i>Kasubbag Umpeg &amp; Sekdin
                                    </span>
                                </td>
                                <td class="pe-4 text-end">
                                    <a href="/kadin/validasi" class="btn btn-primary btn-sm fw-semibold px-3 py-1 rounded-2 d-inline-flex align-items-center gap-1 shadow-sm" style="font-size: 0.75rem;">
                                        <i class="bi bi-pen-fill" aria-hidden="true"></i>
                                        <span>Review &amp; TTD</span>
                                    </a>
                                </td>
                            </tr>

                            <tr data-jenis="Surat Keluar" data-kode="Kode 00">
                                <td class="ps-4 fw-bold text-dark font-monospace">5</td>
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
                                    <div class="fw-semibold text-dark">Pengajuan SPP-GU dan Laporan Realisasi Dana Operasional Pelayanan Keliling</div>
                                    <div class="text-secondary mt-1" style="font-size: 0.73rem;">
                                        <i class="bi bi-building me-1" aria-hidden="true"></i>Tujuan: BPKAD Kabupaten OKI
                                    </div>
                                </td>
                                <td>
                                    <span class="badge rounded-pill fw-medium px-2 py-1" style="background-color: #DCFCE7; color: #15803D; font-size: 0.72rem;">
                                        <i class="bi bi-check-circle-fill me-1" aria-hidden="true"></i>Kasubbag Umpeg &amp; Sekdin
                                    </span>
                                </td>
                                <td class="pe-4 text-end">
                                    <a href="/kadin/validasi" class="btn btn-primary btn-sm fw-semibold px-3 py-1 rounded-2 d-inline-flex align-items-center gap-1 shadow-sm" style="font-size: 0.75rem;">
                                        <i class="bi bi-pen-fill" aria-hidden="true"></i>
                                        <span>Review &amp; TTD</span>
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="card-footer bg-white border-top px-4 py-3 d-flex flex-column flex-sm-row align-items-sm-center justify-content-between gap-2">
                    <span class="text-secondary" style="font-size: 0.76rem;">
                        Menampilkan <strong>1 &ndash; 5</strong> dari <strong>10</strong> dokumen dalam antrean tanda tangan Kepala Dinas
                    </span>
                    <a href="/kadin/validasi" class="btn btn-sm btn-outline-primary rounded-2 px-3 py-1 fw-medium" style="font-size: 0.76rem;">
                        Lihat Semua Antrean TTE (10) <i class="bi bi-arrow-right ms-1" aria-hidden="true"></i>
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

<div class="modal fade" id="modalPinTte" tabindex="-1" aria-labelledby="modalPinTteLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow rounded-3">
            <div class="modal-header border-bottom px-4 py-3">
                <h6 class="modal-title fw-bold text-dark d-flex align-items-center gap-2" id="modalPinTteLabel">
                    <i class="bi bi-shield-lock-fill text-primary" aria-hidden="true"></i>
                    <span>Panel Keamanan PIN / Passphrase TTE Kadin</span>
                </h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body p-4">
                <div class="p-3 rounded-2 mb-3 border" style="background-color: #ECFDF5; border-color: #A7F3D0 !important; font-size: 0.78rem;">
                    <strong class="text-success d-block mb-1" id="modal-role-title"><i class="bi bi-patch-check-fill me-1" aria-hidden="true"></i>Sertifikat Elektronik BSrE Aktif</strong>
                    <span class="text-secondary">Otorisator: <strong>Drs. H. Hendra Suryadi, M.Si</strong> (NIP. 197108141998031004)</span>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold small text-dark mb-1">Passphrase / PIN TTE Saat Ini</label>
                    <input type="password" class="form-control form-control-sm" value="••••••••••••">
                </div>
                <div class="mb-0">
                    <label class="form-label fw-semibold small text-dark mb-1">Passphrase / PIN TTE Baru</label>
                    <input type="password" class="form-control form-control-sm" placeholder="Minimal 8 karakter kombinasi huruf &amp; angka...">
                </div>
            </div>
            <div class="modal-footer border-top px-4 py-2">
                <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-sm btn-primary fw-semibold" data-bs-dismiss="modal">Simpan Perubahan PIN</button>
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

        const activeRole = localStorage.getItem('esurat_locked_role') || document.body.getAttribute('data-default-role') || 'kadin';
        localStorage.setItem('esurat_locked_role', activeRole);
        const profile = ROLE_PROFILES[activeRole] || ROLE_PROFILES.kadin;

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
            'role-switcher-label': profile.switcherText
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

    function selectKadinTab(jenis, btnEl) {
        const nav = document.getElementById('kadinTabNav');
        nav.setAttribute('data-active-jenis', jenis);
        document.querySelectorAll('#kadinTabNav .nav-link').forEach(function(el) {
            el.classList.remove('active');
        });
        if (btnEl) btnEl.classList.add('active');
        filterKadinTable();
    }

    function filterKadinTable() {
        const nav = document.getElementById('kadinTabNav');
        const jenis = nav.getAttribute('data-active-jenis') || 'semua';
        const kode = document.getElementById('kadinKodeFilter').value;
        const q = (document.getElementById('kadinSearchInput').value || '').toLowerCase();

        document.querySelectorAll('#kadinQueueTable tbody tr').forEach(function(row) {
            const rowJenis = row.getAttribute('data-jenis') || '';
            const rowKode = row.getAttribute('data-kode') || '';
            const matchText = row.innerText.toLowerCase().includes(q);
            const matchJenis = (jenis === 'semua') || (rowJenis === jenis);
            const matchKode = (kode === 'semua') || (rowKode === kode);
            row.style.display = (matchText && matchJenis && matchKode) ? '' : 'none';
        });
    }

    document.addEventListener('DOMContentLoaded', applyLockedRole);
</script>
</body>
</html>
