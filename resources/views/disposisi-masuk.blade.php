<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Disposisi Surat Masuk - Disdukcapil OKI</title>
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
            width: 38px;
            height: 38px;
            border-radius: 0.6rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.05rem;
            flex-shrink: 0;
        }

        .doc-number-mono {
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.78rem;
            font-weight: 600;
        }

        .ajudan-tracking-box {
            background-color: #ECFDF5;
            border: 1px solid #A7F3D0;
            border-radius: var(--radius-md);
        }

        .unit-option-card {
            border: 1px solid var(--color-slate-200);
            border-radius: var(--radius-md);
            padding: 0.65rem 0.85rem;
            background-color: var(--color-slate-50);
            transition: border-color 0.15s ease, background-color 0.15s ease;
        }

        .unit-option-card.selected {
            border-color: var(--color-blue-600);
            background-color: #EFF6FF;
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
            <a href="/kadin" id="nav-dashboard-link" class="nav-link-sidebar">
                <span class="d-flex align-items-center gap-3">
                    <i class="bi bi-grid" aria-hidden="true"></i>
                    <span>Dashboard Eksekutif</span>
                </span>
            </a>
            <a href="/kadin/disposisi" class="nav-link-sidebar active">
                <span class="d-flex align-items-center gap-3">
                    <i class="bi bi-inbox-fill" aria-hidden="true"></i>
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
                <span class="text-secondary">Disposisi Surat Masuk</span>
                <span class="text-secondary mx-1">/</span>
                <span class="text-primary fw-medium">Lembar Disposisi Pimpinan</span>
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
                        <li><a class="dropdown-item py-2" href="/switch-role/admin?redirect=/kadin/disposisi" onclick="lockUserRole('admin')"><i class="bi bi-person-gear text-primary me-2"></i><strong>Staf Admin</strong> (Subbag Umpeg)</a></li>
                        <li><a class="dropdown-item py-2" href="/switch-role/kasubbag?redirect=/kadin/disposisi" onclick="lockUserRole('kasubbag')"><i class="bi bi-clipboard2-check text-warning me-2"></i><strong>Kasubbag Umpeg</strong> (Verifikator I)</a></li>
                        <li><a class="dropdown-item py-2" href="/switch-role/sekdin?redirect=/kadin/disposisi" onclick="lockUserRole('sekdin')"><i class="bi bi-pen text-info me-2"></i><strong>Sekretaris Dinas</strong> (Verifikator II)</a></li>
                        <li><a class="dropdown-item py-2" href="/switch-role/kadin?redirect=/kadin/disposisi" onclick="lockUserRole('kadin')"><i class="bi bi-qr-code-scan text-success me-2"></i><strong>Kepala Dinas</strong> (Otorisator TTE)</a></li>
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
            <div class="row g-4 mb-4">
                <div class="col-12 col-lg-5">
                    <div class="surface-card h-100 d-flex flex-column">
                        <div class="px-4 py-3 border-bottom d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center gap-2">
                                <div class="mini-stat-icon" style="background-color: #DBEAFE; color: #2563EB;">
                                    <i class="bi bi-envelope-open-fill" aria-hidden="true"></i>
                                </div>
                                <div>
                                    <h6 class="fw-bold text-dark mb-0" style="font-size: 0.88rem;">Detail Agenda Surat Masuk (#0142)</h6>
                                    <div class="text-secondary" style="font-size: 0.73rem;">Registrasi Buku Agenda &amp; Pelacakan Ajudan</div>
                                </div>
                            </div>
                            <span class="badge rounded-2 px-2 py-1 fw-semibold doc-number-mono" style="background-color: #DBEAFE; color: #1D4ED8; font-size: 0.73rem;">
                                #0142
                            </span>
                        </div>

                        <div class="p-4 flex-grow-1 d-flex flex-column justify-content-between">
                            <div>
                                <div class="row g-3 mb-3">
                                    <div class="col-6">
                                        <div class="p-2 px-3 rounded-2 border" style="background-color: var(--color-slate-50);">
                                            <div class="text-secondary" style="font-size: 0.72rem;">Nomor Urut Agenda</div>
                                            <div class="fw-bold text-dark doc-number-mono fs-6">#0142</div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="p-2 px-3 rounded-2 border" style="background-color: var(--color-slate-50);">
                                            <div class="text-secondary" style="font-size: 0.72rem;">Tanggal Diterima Disdukcapil</div>
                                            <div class="fw-bold text-dark" style="font-size: 0.9rem;">09 Nov 2026</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3 pb-3 border-bottom">
                                    <div class="text-secondary mb-1" style="font-size: 0.74rem;">Pengirim Surat</div>
                                    <div class="fw-bold text-dark" style="font-size: 0.9rem;">Sekretariat Daerah Kab. OKI</div>
                                </div>

                                <div class="row g-3 mb-3 pb-3 border-bottom">
                                    <div class="col-5">
                                        <div class="text-secondary mb-1" style="font-size: 0.74rem;">Tanggal Surat</div>
                                        <div class="fw-semibold text-dark" style="font-size: 0.84rem;">06 Nov 2026</div>
                                    </div>
                                    <div class="col-7">
                                        <div class="text-secondary mb-1" style="font-size: 0.74rem;">Keterangan Nomor Surat</div>
                                        <div class="doc-number-mono text-primary">005/341/Setda-OKI/2026</div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <div class="text-secondary mb-1" style="font-size: 0.74rem;">Perihal Surat</div>
                                    <div class="p-3 rounded-2 border text-dark fw-medium" style="background-color: var(--color-slate-50); font-size: 0.84rem; line-height: 1.5;">
                                        Permintaan Data Agregat Kependudukan Bersih Semester II
                                    </div>
                                </div>

                                <div class="ajudan-tracking-box p-3 mb-4">
                                    <div class="d-flex align-items-center justify-content-between mb-2">
                                        <span class="fw-bold text-success d-flex align-items-center gap-1" style="font-size: 0.76rem;">
                                            <i class="bi bi-arrow-up-right-circle-fill" aria-hidden="true"></i> Pelacakan Kenaikan Surat ke Kadin
                                        </span>
                                        <span class="badge rounded-pill bg-success text-white fw-medium px-2 py-1" style="font-size: 0.69rem;">
                                            <i class="bi bi-check2-circle me-1" aria-hidden="true"></i>Diterima Ajudan Kadin
                                        </span>
                                    </div>
                                    <div class="row g-2 pt-1" style="font-size: 0.78rem;">
                                        <div class="col-12 col-sm-6">
                                            <div class="text-secondary" style="font-size: 0.71rem;">Tanggal Naik ke Kadin</div>
                                            <div class="fw-semibold text-dark doc-number-mono"><i class="bi bi-clock me-1 text-success" aria-hidden="true"></i>10 Nov 2026, 08:15 WIB</div>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <div class="text-secondary" style="font-size: 0.71rem;">Nama Ajudan Penerima</div>
                                            <div class="fw-semibold text-dark"><i class="bi bi-person-check-fill me-1 text-success" aria-hidden="true"></i>Rizky Pratama, S.IP</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="d-grid">
                                <button type="button" data-bs-toggle="modal" data-bs-target="#modalLampiranPdf" class="btn btn-outline-primary btn-sm fw-semibold py-2 rounded-2 d-flex align-items-center justify-content-center gap-2" style="font-size: 0.84rem;">
                                    <i class="bi bi-file-earmark-pdf-fill text-danger" aria-hidden="true"></i>
                                    <span>Lihat Lampiran PDF Surat Masuk</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-7">
                    <div class="surface-card h-100 d-flex flex-column">
                        <div class="px-4 py-3 border-bottom d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center gap-2">
                                <div class="mini-stat-icon" style="background-color: #FEF3C7; color: #D97706;">
                                    <i class="bi bi-send-check-fill" aria-hidden="true"></i>
                                </div>
                                <div>
                                    <h6 class="fw-bold text-dark mb-0" style="font-size: 0.88rem;">Form Instruksi Disposisi Kadin &amp; Penyerahan</h6>
                                    <div class="text-secondary" style="font-size: 0.73rem;">Penentuan bidang penerima (400, 800, 00), tanggal terima, dan arahan Kepala Dinas</div>
                                </div>
                            </div>
                            <span class="badge rounded-pill fw-semibold px-2 py-1" style="background-color: #FEF3C7; color: #B45309; font-size: 0.71rem;">
                                <i class="bi bi-hourglass-split me-1" aria-hidden="true"></i>Menunggu Disposisi
                            </span>
                        </div>

                        <div class="p-4 flex-grow-1">
                            <form onsubmit="submitDisposisiForm(); return false;">
                                <div class="mb-3">
                                    <label class="form-label fw-semibold text-dark small mb-2">
                                        Diteruskan ke Bidang / Subbagian (Kode Klasifikasi) <span class="text-danger">*</span>
                                    </label>
                                    <div class="row g-2" id="unitCardsContainer">
                                        <div class="col-12 col-md-4">
                                            <label class="unit-option-card selected d-flex align-items-start gap-2 w-100" style="cursor: pointer;" onclick="selectUnitDisposisi(this, 'Drs. H. M. Amin, M.Si (Kabid PIAK & Capil)')">
                                                <input class="form-check-input mt-1" type="radio" name="unit_tujuan" value="Bidang Catatan Sipil (Kode 400)" checked>
                                                <div>
                                                    <div class="fw-bold text-dark" style="font-size: 0.79rem;">Bidang Catatan Sipil</div>
                                                    <span class="badge bg-primary text-white mt-1 doc-number-mono" style="font-size: 0.68rem;">Kode 400</span>
                                                </div>
                                            </label>
                                        </div>
                                        <div class="col-12 col-md-4">
                                            <label class="unit-option-card d-flex align-items-start gap-2 w-100" style="cursor: pointer;" onclick="selectUnitDisposisi(this, 'Hj. Siti Rahmawati, S.Sos (Kasubbag Umpeg)')">
                                                <input class="form-check-input mt-1" type="radio" name="unit_tujuan" value="Subbag Kepegawaian & Umum (Kode 800)">
                                                <div>
                                                    <div class="fw-bold text-dark" style="font-size: 0.79rem;">Subbag Kepegawaian &amp; Umum</div>
                                                    <span class="badge bg-secondary text-white mt-1 doc-number-mono" style="font-size: 0.68rem;">Kode 800</span>
                                                </div>
                                            </label>
                                        </div>
                                        <div class="col-12 col-md-4">
                                            <label class="unit-option-card d-flex align-items-start gap-2 w-100" style="cursor: pointer;" onclick="selectUnitDisposisi(this, 'Hendri Wijaya, S.E., Ak (Kasubbag Keuangan)')">
                                                <input class="form-check-input mt-1" type="radio" name="unit_tujuan" value="Subbag Keuangan (Kode 00)">
                                                <div>
                                                    <div class="fw-bold text-dark" style="font-size: 0.79rem;">Subbag Keuangan</div>
                                                    <span class="badge bg-secondary text-white mt-1 doc-number-mono" style="font-size: 0.68rem;">Kode 00</span>
                                                </div>
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row g-3 mb-3">
                                    <div class="col-12 col-md-7">
                                        <label for="pegawaiPenerima" class="form-label fw-semibold text-dark small mb-1">
                                            Nama Penerima Disposisi <span class="text-danger">*</span>
                                        </label>
                                        <div class="input-group input-group-sm">
                                            <span class="input-group-text bg-light text-secondary"><i class="bi bi-person-vcard" aria-hidden="true"></i></span>
                                            <input type="text" id="pegawaiPenerima" class="form-control" value="Drs. H. M. Amin, M.Si (Kabid PIAK &amp; Capil)" placeholder="Masukkan nama pejabat / staf penerima..." required>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-5">
                                        <label for="tanggalMenerima" class="form-label fw-semibold text-dark small mb-1">
                                            Tanggal Terima <span class="text-danger">*</span>
                                        </label>
                                        <div class="input-group input-group-sm">
                                            <span class="input-group-text bg-light text-secondary"><i class="bi bi-calendar-event" aria-hidden="true"></i></span>
                                            <input type="date" id="tanggalMenerima" class="form-control" value="2026-11-17" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row g-3 mb-3">
                                    <div class="col-12 col-md-5">
                                        <label class="form-label fw-semibold text-dark small mb-2">
                                            Sifat Disposisi <span class="text-danger">*</span>
                                        </label>
                                        <div class="d-flex flex-wrap gap-2">
                                            <div class="form-check form-check-inline m-0 border rounded-2 px-2 py-1 bg-light">
                                                <input class="form-check-input" type="radio" name="sifat_disposisi" id="sifatSegera" checked>
                                                <label class="form-check-label fw-semibold text-danger" for="sifatSegera" style="font-size: 0.77rem;">Segera</label>
                                            </div>
                                            <div class="form-check form-check-inline m-0 border rounded-2 px-2 py-1 bg-light">
                                                <input class="form-check-input" type="radio" name="sifat_disposisi" id="sifatPenting">
                                                <label class="form-check-label fw-medium text-dark" for="sifatPenting" style="font-size: 0.77rem;">Penting</label>
                                            </div>
                                            <div class="form-check form-check-inline m-0 border rounded-2 px-2 py-1 bg-light">
                                                <input class="form-check-input" type="radio" name="sifat_disposisi" id="sifatRahasia">
                                                <label class="form-check-label fw-medium text-dark" for="sifatRahasia" style="font-size: 0.77rem;">Rahasia</label>
                                            </div>
                                            <div class="form-check form-check-inline m-0 border rounded-2 px-2 py-1 bg-light">
                                                <input class="form-check-input" type="radio" name="sifat_disposisi" id="sifatBiasa">
                                                <label class="form-check-label fw-medium text-dark" for="sifatBiasa" style="font-size: 0.77rem;">Biasa</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-7">
                                        <label class="form-label fw-semibold text-dark small mb-2">
                                            Instruksi Cepat Pimpinan
                                        </label>
                                        <div class="row g-2">
                                            <div class="col-6">
                                                <div class="form-check border rounded-2 px-3 py-1 bg-light">
                                                    <input class="form-check-input" type="checkbox" id="inst1" checked>
                                                    <label class="form-check-label fw-medium text-dark" for="inst1" style="font-size: 0.77rem;">Tindak Lanjuti</label>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-check border rounded-2 px-3 py-1 bg-light">
                                                    <input class="form-check-input" type="checkbox" id="inst2" checked>
                                                    <label class="form-check-label fw-medium text-dark" for="inst2" style="font-size: 0.77rem;">Siapkan Konsep Balasan</label>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-check border rounded-2 px-3 py-1 bg-light">
                                                    <input class="form-check-input" type="checkbox" id="inst3">
                                                    <label class="form-check-label fw-medium text-dark" for="inst3" style="font-size: 0.77rem;">Koordinasikan</label>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-check border rounded-2 px-3 py-1 bg-light">
                                                    <input class="form-check-input" type="checkbox" id="inst4">
                                                    <label class="form-check-label fw-medium text-dark" for="inst4" style="font-size: 0.77rem;">Arsipkan</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label for="catatanKadin" class="form-label fw-semibold text-dark small mb-1">
                                        Catatan / Instruksi Khusus Kepala Dinas
                                    </label>
                                    <textarea id="catatanKadin" class="form-control form-control-sm" rows="3" style="font-size: 0.83rem;" placeholder="Tuliskan arahan spesifik Kepala Dinas kepada unit penerima...">Segera rekapitulasi data DAK2 Semester II yang telah tervalidasi SIAK Terpusat, koordinasikan draf surat pengantar dengan Sekdin sebelum dinaikkan untuk TTE.</textarea>
                                </div>

                                <div class="d-flex flex-wrap align-items-center justify-content-end gap-2 pt-3 border-top">
                                    <button type="button" onclick="window.print()" class="btn btn-outline-secondary btn-sm fw-medium px-3 py-2 rounded-2 d-inline-flex align-items-center gap-2" style="font-size: 0.82rem;">
                                        <i class="bi bi-printer" aria-hidden="true"></i>
                                        <span>Cetak Lembar Disposisi</span>
                                    </button>
                                    <button type="submit" class="btn btn-primary btn-sm fw-semibold px-4 py-2 rounded-2 d-inline-flex align-items-center gap-2 shadow-sm" style="font-size: 0.82rem;">
                                        <i class="bi bi-send-fill" aria-hidden="true"></i>
                                        <span>Kirim Instruksi Disposisi</span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="surface-card overflow-hidden">
                <div class="p-3 px-4 border-bottom d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-2">
                    <div>
                        <h6 class="fw-bold text-dark mb-1">Riwayat Disposisi Surat Masuk</h6>
                        <div class="text-secondary" style="font-size: 0.76rem;">Rekam jejak kenaikan surat melalui ajudan dan penyerahan disposisi ke bidang/subbagian terkait.</div>
                    </div>
                    <a href="/buku-besar" class="btn btn-sm btn-outline-primary rounded-2 px-3 py-1 fw-medium" style="font-size: 0.75rem;">
                        <i class="bi bi-journal-bookmark me-1" aria-hidden="true"></i>Lihat di Buku Besar
                    </a>
                </div>

                <div class="table-responsive">
                    <table class="table table-ledger mb-0">
                        <thead>
                            <tr>
                                <th class="ps-4" style="width: 95px;">NO. URUT</th>
                                <th style="width: 260px;">PENGIRIM &amp; NO. SURAT</th>
                                <th style="width: 235px;">TANGGAL NAIK &amp; NAMA AJUDAN</th>
                                <th>DISERAHKAN KEPADA (NAMA &amp; TANGGAL TERIMA)</th>
                                <th class="pe-4 text-end" style="width: 180px;">STATUS DISPOSISI</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="ps-4">
                                    <span class="fw-bold text-dark font-monospace">#0142</span>
                                    <div class="text-secondary" style="font-size: 0.72rem;">09 Nov 2026</div>
                                </td>
                                <td>
                                    <div class="fw-semibold text-dark">Sekretariat Daerah Kab. OKI</div>
                                    <div class="doc-number-mono text-primary mt-1">005/341/Setda-OKI/2026</div>
                                </td>
                                <td>
                                    <div class="fw-medium text-dark doc-number-mono" style="font-size: 0.76rem;">10 Nov 2026, 08:15 WIB</div>
                                    <div class="text-secondary mt-1" style="font-size: 0.74rem;"><i class="bi bi-person-check text-success me-1" aria-hidden="true"></i>Ajudan: Rizky Pratama, S.IP</div>
                                </td>
                                <td>
                                    <span class="badge rounded-2 px-2 py-1 fw-semibold mb-1" style="background-color: #DBEAFE; color: #1D4ED8; font-size: 0.7rem;">
                                        Bidang Catatan Sipil (Kode 400)
                                    </span>
                                    <div class="text-secondary" style="font-size: 0.74rem;">Penerima: Drs. H. M. Amin, M.Si &bull; 10 Nov 2026</div>
                                </td>
                                <td class="pe-4 text-end">
                                    <span class="badge rounded-pill fw-medium px-3 py-1" style="background-color: #FEF3C7; color: #B45309; font-size: 0.72rem;">
                                        <i class="bi bi-clock-history me-1" aria-hidden="true"></i>Sedang Diproses
                                    </span>
                                </td>
                            </tr>

                            <tr>
                                <td class="ps-4">
                                    <span class="fw-bold text-dark font-monospace">#0141</span>
                                    <div class="text-secondary" style="font-size: 0.72rem;">08 Nov 2026</div>
                                </td>
                                <td>
                                    <div class="fw-semibold text-dark">BKPSDM Kabupaten OKI</div>
                                    <div class="doc-number-mono text-primary mt-1">800/512/BKPSDM-II/2026</div>
                                </td>
                                <td>
                                    <div class="fw-medium text-dark doc-number-mono" style="font-size: 0.76rem;">08 Nov 2026, 13:40 WIB</div>
                                    <div class="text-secondary mt-1" style="font-size: 0.74rem;"><i class="bi bi-person-check text-success me-1" aria-hidden="true"></i>Ajudan: Rizky Pratama, S.IP</div>
                                </td>
                                <td>
                                    <span class="badge rounded-2 px-2 py-1 fw-semibold mb-1" style="background-color: #FEF3C7; color: #B45309; font-size: 0.7rem;">
                                        Subbag Kepegawaian &amp; Umum (Kode 800)
                                    </span>
                                    <div class="text-secondary" style="font-size: 0.74rem;">Penerima: Hj. Siti Rahmawati, S.Sos &bull; 09 Nov 2026</div>
                                </td>
                                <td class="pe-4 text-end">
                                    <span class="badge rounded-pill fw-medium px-3 py-1" style="background-color: #DCFCE7; color: #15803D; font-size: 0.72rem;">
                                        <i class="bi bi-check-circle me-1" aria-hidden="true"></i>Selesai Ditindaklanjuti
                                    </span>
                                </td>
                            </tr>

                            <tr>
                                <td class="ps-4">
                                    <span class="fw-bold text-dark font-monospace">#0140</span>
                                    <div class="text-secondary" style="font-size: 0.72rem;">07 Nov 2026</div>
                                </td>
                                <td>
                                    <div class="fw-semibold text-dark">Badan Pengelola Keuangan &amp; Aset Daerah</div>
                                    <div class="doc-number-mono text-primary mt-1">900/219/BPKAD-OKI/2026</div>
                                </td>
                                <td>
                                    <div class="fw-medium text-dark doc-number-mono" style="font-size: 0.76rem;">07 Nov 2026, 10:20 WIB</div>
                                    <div class="text-secondary mt-1" style="font-size: 0.74rem;"><i class="bi bi-person-check text-success me-1" aria-hidden="true"></i>Ajudan: Dedi Kurniawan, A.Md</div>
                                </td>
                                <td>
                                    <span class="badge rounded-2 px-2 py-1 fw-semibold mb-1" style="background-color: #F3F4F6; color: #374151; border: 1px solid #E5E7EB; font-size: 0.7rem;">
                                        Subbag Keuangan (Kode 00)
                                    </span>
                                    <div class="text-secondary" style="font-size: 0.74rem;">Penerima: Hendri Wijaya, S.E., Ak &bull; 07 Nov 2026</div>
                                </td>
                                <td class="pe-4 text-end">
                                    <span class="badge rounded-pill fw-medium px-3 py-1" style="background-color: #DCFCE7; color: #15803D; font-size: 0.72rem;">
                                        <i class="bi bi-check-circle me-1" aria-hidden="true"></i>Selesai Ditindaklanjuti
                                    </span>
                                </td>
                            </tr>

                            <tr>
                                <td class="ps-4">
                                    <span class="fw-bold text-dark font-monospace">#0139</span>
                                    <div class="text-secondary" style="font-size: 0.72rem;">06 Nov 2026</div>
                                </td>
                                <td>
                                    <div class="fw-semibold text-dark">Pengadilan Agama Kayuagung</div>
                                    <div class="doc-number-mono text-primary mt-1">W6-A4/892/HK.05/XI/2026</div>
                                </td>
                                <td>
                                    <div class="fw-medium text-dark doc-number-mono" style="font-size: 0.76rem;">06 Nov 2026, 14:05 WIB</div>
                                    <div class="text-secondary mt-1" style="font-size: 0.74rem;"><i class="bi bi-person-check text-success me-1" aria-hidden="true"></i>Ajudan: Dedi Kurniawan, A.Md</div>
                                </td>
                                <td>
                                    <span class="badge rounded-2 px-2 py-1 fw-semibold mb-1" style="background-color: #DBEAFE; color: #1D4ED8; font-size: 0.7rem;">
                                        Bidang Catatan Sipil (Kode 400)
                                    </span>
                                    <div class="text-secondary" style="font-size: 0.74rem;">Penerima: Dewi Sartika, S.H. &bull; 06 Nov 2026</div>
                                </td>
                                <td class="pe-4 text-end">
                                    <span class="badge rounded-pill fw-medium px-3 py-1" style="background-color: #DBEAFE; color: #1D4ED8; font-size: 0.72rem;">
                                        <i class="bi bi-archive me-1" aria-hidden="true"></i>Diarsipkan Unit
                                    </span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>

        <footer class="bg-white border-top px-4 py-3 d-flex flex-column flex-sm-row align-items-center justify-content-between text-secondary" style="font-size: 0.75rem;">
            <div>&copy; 2026 <strong class="text-dark">Disdukcapil Kabupaten Ogan Komering Ilir</strong>. Hak Cipta Dilindungi.</div>
            <div>Aplikasi Tata Naskah Dinas Elektronik (TNDE) OKI Mandira</div>
        </footer>
    </div>
</div>

<div class="modal fade" id="modalLampiranPdf" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow rounded-3">
            <div class="modal-header border-bottom px-4 py-3">
                <h6 class="modal-title fw-bold text-dark d-flex align-items-center gap-2">
                    <i class="bi bi-file-earmark-pdf-fill text-danger" aria-hidden="true"></i>
                    <span>Pratinjau Lampiran PDF Surat Masuk (#0142)</span>
                </h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body p-4 bg-light small">
                <div class="bg-white border rounded-2 p-4 shadow-sm">
                    <div class="fw-bold text-dark mb-1">SEKRETARIAT DAERAH KABUPATEN OGAN KOMERING ILIR</div>
                    <div class="doc-number-mono text-primary mb-3">Nomor: 005/341/Setda-OKI/2026 &bull; Tanggal: 06 November 2026</div>
                    <p class="text-secondary mb-0">Perihal: Permintaan Data Agregat Kependudukan Bersih (DAK2) Semester II Tahun 2026 sebagai dasar perhitungan alokasi pelayanan publik tingkat kecamatan dan desa di Kabupaten Ogan Komering Ilir.</p>
                </div>
            </div>
            <div class="modal-footer border-top px-4 py-2">
                <button type="button" class="btn btn-sm btn-primary fw-semibold" data-bs-dismiss="modal">Tutup Pratinjau</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalDisposisiSukses" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow rounded-3">
            <div class="modal-header border-bottom px-4 py-3">
                <h6 class="modal-title fw-bold text-success d-flex align-items-center gap-2">
                    <i class="bi bi-check-circle-fill" aria-hidden="true"></i>
                    <span>Instruksi Disposisi Berhasil Dikirim</span>
                </h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body p-4 small">
                <p class="text-secondary mb-2">Instruksi disposisi Kepala Dinas untuk Surat Masuk <strong>#0142</strong> telah diserahkan kepada:</p>
                <div class="p-3 rounded-2 bg-light border mb-0">
                    <div class="fw-bold text-primary" id="modalDisposisiPenerima">Drs. H. M. Amin, M.Si</div>
                    <div class="text-secondary mt-1">Tercatat pada Buku Kendali Disposisi &amp; Buku Besar Persuratan.</div>
                </div>
            </div>
            <div class="modal-footer border-top px-4 py-2">
                <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">Tutup</button>
                <a href="/registrasi-surat" class="btn btn-sm btn-primary fw-semibold">Siapkan Konsep Surat Balasan &rarr;</a>
            </div>
        </div>
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
                    <strong class="text-success d-block mb-1"><i class="bi bi-patch-check-fill me-1" aria-hidden="true"></i>Sertifikat Elektronik BSrE Aktif</strong>
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

    function selectUnitDisposisi(cardEl, defaultRecipient) {
        document.querySelectorAll('#unitCardsContainer .unit-option-card').forEach(function(el) {
            el.classList.remove('selected');
        });
        cardEl.classList.add('selected');
        document.getElementById('pegawaiPenerima').value = defaultRecipient;
    }

    function submitDisposisiForm() {
        document.getElementById('modalDisposisiPenerima').textContent = 'Penerima: ' + document.getElementById('pegawaiPenerima').value;
        new bootstrap.Modal(document.getElementById('modalDisposisiSukses')).show();
    }

    document.addEventListener('DOMContentLoaded', applyLockedRole);
</script>
</body>
</html>
