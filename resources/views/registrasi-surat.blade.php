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
            <a href="/" id="nav-dashboard-link" class="nav-link-sidebar">
                <span class="d-flex align-items-center gap-3">
                    <i class="bi bi-grid" aria-hidden="true"></i>
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
            <a href="/registrasi-surat" class="nav-link-sidebar active">
                <span class="d-flex align-items-center gap-3">
                    <i class="bi bi-send-fill" aria-hidden="true"></i>
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
                <span class="text-secondary">Surat Keluar &amp; SPPD</span>
                <span class="text-secondary mx-1">/</span>
                <span class="text-primary fw-medium">Registrasi Naskah Dinas</span>
            </div>

            <div class="d-flex align-items-center gap-2">
                <div class="dropdown">
                    <button class="btn btn-sm border border-primary border-opacity-25 rounded-pill px-3 py-1 d-flex align-items-center gap-2" style="background-color: #EFF6FF; font-size: 0.74rem;" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-shield-lock-fill text-primary" aria-hidden="true"></i>
                        <span class="text-primary fw-semibold" id="role-switcher-label">Simulasi Aktor: Staf Admin</span>
                        <i class="bi bi-chevron-down text-primary" style="font-size: 0.65rem;" aria-hidden="true"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end shadow border-0 small" style="min-width: 250px;">
                        <li class="px-3 py-1 text-secondary fw-bold" style="font-size: 0.68rem; text-transform: uppercase;">Kunci Identitas Aktor (Testing)</li>
                        <li><a class="dropdown-item py-2" href="/switch-role/admin?redirect=/registrasi-surat" onclick="lockUserRole('admin')"><i class="bi bi-person-gear text-primary me-2"></i><strong>Staf Admin</strong> (Subbag Umpeg)</a></li>
                        <li><a class="dropdown-item py-2" href="/switch-role/kasubbag?redirect=/registrasi-surat" onclick="lockUserRole('kasubbag')"><i class="bi bi-clipboard2-check text-warning me-2"></i><strong>Kasubbag Umpeg</strong> (Verifikator I)</a></li>
                        <li><a class="dropdown-item py-2" href="/switch-role/sekdin?redirect=/registrasi-surat" onclick="lockUserRole('sekdin')"><i class="bi bi-pen text-info me-2"></i><strong>Sekretaris Dinas</strong> (Verifikator II)</a></li>
                        <li><a class="dropdown-item py-2" href="/switch-role/kadin?redirect=/registrasi-surat" onclick="lockUserRole('kadin')"><i class="bi bi-qr-code-scan text-success me-2"></i><strong>Kepala Dinas</strong> (Otorisator TTE)</a></li>
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
            <div class="surface-card px-4 pt-3 mb-4 d-flex flex-column flex-xl-row align-items-xl-center justify-content-between gap-3">
                <div class="pb-3">
                    <h6 class="fw-bold text-dark mb-1">Registrasi &amp; Penomoran Otomatis Naskah Dinas</h6>
                    <div class="text-secondary" style="font-size: 0.76rem;">Pencatatan buku agenda surat keluar, SPPD, dan berita acara terintegrasi alur verifikasi berjenjang.</div>
                </div>

                <ul class="nav nav-tabs ledger-tabs border-0" id="registrasiTabNav">
                    <li class="nav-item">
                        <button type="button" class="nav-link active d-inline-flex align-items-center gap-2" onclick="focusRegPanel('panel-surat-keluar', this)">
                            <i class="bi bi-send-fill" aria-hidden="true"></i>
                            <span>Tab 1: Form Surat Keluar</span>
                            <span class="badge rounded-pill bg-primary bg-opacity-10 text-primary">Aktif</span>
                        </button>
                    </li>
                    <li class="nav-item">
                        <button type="button" class="nav-link d-inline-flex align-items-center gap-2" onclick="focusRegPanel('panel-sppd', this)">
                            <i class="bi bi-briefcase-fill text-warning" aria-hidden="true"></i>
                            <span>Tab 2: Form Perjalanan Dinas (SPPD)</span>
                        </button>
                    </li>
                    <li class="nav-item">
                        <button type="button" class="nav-link d-inline-flex align-items-center gap-2" onclick="focusRegPanel('panel-berita-acara', this)">
                            <i class="bi bi-file-earmark-text-fill text-primary" aria-hidden="true"></i>
                            <span>Tab 3: Form Berita Acara</span>
                        </button>
                    </li>
                </ul>
            </div>

            <div class="row g-4 mb-4">
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
                                    <div id="previewNomorKeluar" class="fs-5 fw-bold text-primary font-monospace my-1">400/2763/disdukcapil/2026</div>
                                    <div class="text-secondary" style="font-size: 0.72rem;">Format: <strong>Kode Bidang / Nomor Urut / Nama Dinas / Tahun</strong></div>
                                </div>
                                <span class="badge rounded-pill bg-primary text-white px-2 py-1" style="font-size: 0.7rem;">Auto-Generate</span>
                            </div>

                            <form onsubmit="submitNaskah('Surat Keluar', document.getElementById('ketNomorSurat').value); return false;">
                                <div class="row g-3 mb-3">
                                    <div class="col-12 col-sm-4">
                                        <label for="nomorUrutKeluar" class="form-label fw-semibold text-dark small mb-1">
                                            Nomor Urut <span class="text-danger">*</span>
                                        </label>
                                        <div class="input-group input-group-sm">
                                            <span class="input-group-text bg-light text-secondary"><i class="bi bi-hash" aria-hidden="true"></i></span>
                                            <input type="number" id="nomorUrutKeluar" oninput="updateAutoNomorSurat()" class="form-control doc-number-mono text-primary" value="2763">
                                        </div>
                                        <div class="form-text" style="font-size: 0.68rem;">Urutan agenda otomatis</div>
                                    </div>

                                    <div class="col-12 col-sm-8">
                                        <label for="kodeBidangSelect" class="form-label fw-semibold text-dark small mb-1">
                                            Pilihan Kode Bidang Klasifikasi <span class="text-danger">*</span>
                                        </label>
                                        <select id="kodeBidangSelect" onchange="updateAutoNomorSurat()" class="form-select form-select-sm fw-medium">
                                            <option value="400" selected>400 - Catatan Sipil</option>
                                            <option value="800">800 - Kepegawaian</option>
                                            <option value="00">00 - Keuangan / Dana</option>
                                        </select>
                                        <div class="form-text" style="font-size: 0.68rem;">Opsi: 400 (Catatan Sipil) &bull; 800 (Kepegawaian) &bull; 00 (Keuangan / Dana)</div>
                                    </div>
                                </div>

                                <div class="row g-3 mb-3">
                                    <div class="col-12 col-sm-5">
                                        <label for="tglDikeluarkan" class="form-label fw-semibold text-dark small mb-1">
                                            Tanggal Dikeluarkan <span class="text-danger">*</span>
                                        </label>
                                        <input type="date" id="tglDikeluarkan" class="form-control form-control-sm" value="2026-11-17">
                                    </div>

                                    <div class="col-12 col-sm-7">
                                        <label for="ketNomorSurat" class="form-label fw-semibold text-dark small mb-1">
                                            Keterangan Nomor Surat (Otomatis)
                                        </label>
                                        <input type="text" id="ketNomorSurat" class="form-control form-control-sm bg-light doc-number-mono text-dark" value="400/2763/disdukcapil/2026" readonly>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="alamatDituju" class="form-label fw-semibold text-dark small mb-1">
                                        Alamat yang Dituju <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-text bg-light text-secondary"><i class="bi bi-building" aria-hidden="true"></i></span>
                                        <input type="text" id="alamatDituju" class="form-control" value="Direktorat Jenderal Dukcapil Kemendagri RI - Jakarta" placeholder="Masukkan instansi / pihak tujuan surat...">
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="perihalSuratKeluar" class="form-label fw-semibold text-dark small mb-1">
                                        Perihal / Isi Ringkas Surat <span class="text-danger">*</span>
                                    </label>
                                    <textarea id="perihalSuratKeluar" class="form-control form-control-sm" rows="3" placeholder="Tuliskan perihal atau ringkasan pokok isi surat keluar...">Penyampaian Laporan Rekapitulasi Penerbitan Akta Pencatatan Sipil dan Sinkronisasi Data Kependudukan Semester II Tahun 2026.</textarea>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-semibold text-dark small mb-1">
                                        Upload Dokumen Konsep Surat (PDF/DOCX) <span class="text-danger">*</span>
                                    </label>
                                    <div class="upload-dropzone">
                                        <i class="bi bi-cloud-arrow-up-fill text-primary fs-4 d-block mb-1" aria-hidden="true"></i>
                                        <div class="fw-semibold text-dark" style="font-size: 0.78rem;">Pilih berkas konsep naskah dinas atau seret ke sini</div>
                                        <div class="text-secondary mb-2" style="font-size: 0.71rem;">Format didukung: .PDF, .DOCX (Maks. 5 MB)</div>
                                        <input type="file" class="form-control form-control-sm" accept=".pdf,.doc,.docx">
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
                            <div class="p-3 rounded-3 mb-3 border d-flex align-items-center justify-content-between" style="background-color: #FFFBEB; border-color: #FDE68A !important;">
                                <div>
                                    <div class="fw-semibold d-flex align-items-center gap-1" style="font-size: 0.74rem; color: #B45309;">
                                        <i class="bi bi-geo-alt-fill" aria-hidden="true"></i> Registrasi Buku Agenda Perjalanan Dinas
                                    </div>
                                    <div class="fw-bold text-dark font-monospace my-1" style="font-size: 0.95rem;">090/091/SPPD/DUKCAPIL/2026</div>
                                    <div class="text-secondary" style="font-size: 0.72rem;">Otomatis terhubung dengan Lembar Surat Tugas &amp; Visum SPPD</div>
                                </div>
                                <span class="badge rounded-pill fw-semibold px-2 py-1" style="background-color: #FEF3C7; color: #B45309; font-size: 0.7rem;">Kode 800</span>
                            </div>

                            <form onsubmit="submitNaskah('SPPD', document.getElementById('noUrutSppd').value); return false;">
                                <div class="row g-3 mb-3">
                                    <div class="col-12 col-sm-6">
                                        <label for="noUrutSppd" class="form-label fw-semibold text-dark small mb-1">
                                            Nomor Urut SPPD <span class="text-danger">*</span>
                                        </label>
                                        <div class="input-group input-group-sm">
                                            <span class="input-group-text bg-light text-secondary"><i class="bi bi-hash" aria-hidden="true"></i></span>
                                            <input type="text" id="noUrutSppd" class="form-control doc-number-mono text-dark" value="090/091/SPPD/DUKCAPIL/2026">
                                        </div>
                                    </div>

                                    <div class="col-12 col-sm-6">
                                        <label for="tglDibuatSppd" class="form-label fw-semibold text-dark small mb-1">
                                            Tanggal Dibuatnya Surat <span class="text-danger">*</span>
                                        </label>
                                        <input type="date" id="tglDibuatSppd" class="form-control form-control-sm" value="2026-11-17">
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="namaPegawaiSppd" class="form-label fw-semibold text-dark small mb-1">
                                        Nama Pegawai yang Diperintahkan <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-text bg-light text-secondary"><i class="bi bi-person-badge-fill" aria-hidden="true"></i></span>
                                        <input type="text" id="namaPegawaiSppd" class="form-control" value="Drs. H. Ahmad Fauzi, M.Si (NIP. 19750412 200003 1 002)" placeholder="Cari atau pilih nama pegawai ASN...">
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="jabatanPegawaiSppd" class="form-label fw-semibold text-dark small mb-1">
                                        Jabatan yang Diperintahkan <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-text bg-light text-secondary"><i class="bi bi-award-fill" aria-hidden="true"></i></span>
                                        <input type="text" id="jabatanPegawaiSppd" class="form-control" value="Kepala Bidang Pelayanan Pendaftaran Penduduk" placeholder="Masukkan jabatan struktural / fungsional...">
                                    </div>
                                </div>

                                <div class="row g-3 mb-3">
                                    <div class="col-12 col-sm-6">
                                        <label for="tglBerangkatSppd" class="form-label fw-semibold text-dark small mb-1">
                                            Tanggal Berangkat <span class="text-danger">*</span>
                                        </label>
                                        <div class="input-group input-group-sm">
                                            <span class="input-group-text bg-light text-secondary"><i class="bi bi-calendar-check" aria-hidden="true"></i></span>
                                            <input type="date" id="tglBerangkatSppd" class="form-control" value="2026-11-18">
                                        </div>
                                    </div>

                                    <div class="col-12 col-sm-6">
                                        <label for="tglKembaliSppd" class="form-label fw-semibold text-dark small mb-1">
                                            Tanggal Kembali <span class="text-danger">*</span>
                                        </label>
                                        <div class="input-group input-group-sm">
                                            <span class="input-group-text bg-light text-secondary"><i class="bi bi-calendar-range" aria-hidden="true"></i></span>
                                            <input type="date" id="tglKembaliSppd" class="form-control" value="2026-11-20">
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="daerahTujuanSppd" class="form-label fw-semibold text-dark small mb-1">
                                        Daerah Tujuan <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-text bg-light text-secondary"><i class="bi bi-pin-map-fill" aria-hidden="true"></i></span>
                                        <input type="text" id="daerahTujuanSppd" class="form-control" value="Kantor Dinas Dukcapil Provinsi Sumatera Selatan - Palembang" placeholder="Masukkan kota / kecamatan / instansi tujuan...">
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="urusanSppd" class="form-label fw-semibold text-dark small mb-1">
                                        Urusan / Tujuan Melakukan Perjalanan Dinas <span class="text-danger">*</span>
                                    </label>
                                    <textarea id="urusanSppd" class="form-control form-control-sm" rows="4" placeholder="Jelaskan maksud dan rincian tugas perjalanan dinas...">Menghadiri Rapat Koordinasi Teknis Pemutakhiran Data Kependudukan Semester II serta Rekonsiliasi Blangko KTP Elektronik Tingkat Provinsi Sumatera Selatan Tahun 2026.</textarea>
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

            <div class="surface-card" id="panel-berita-acara">
                <div class="px-4 py-3 border-bottom d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center gap-2">
                        <div class="mini-stat-icon" style="background-color: #EDE9FE; color: #7C3AED;">
                            <i class="bi bi-file-earmark-text-fill" aria-hidden="true"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold text-dark mb-0" style="font-size: 0.9rem;">Panel 3: Formulir Input Berita Acara Kedinasan (BAST &amp; Rekonsiliasi)</h6>
                            <div class="text-secondary" style="font-size: 0.73rem;">Penerbitan Berita Acara Serah Terima Blangko / Peralatan SIAK ber-TTE QR Code</div>
                        </div>
                    </div>
                    <span class="badge rounded-2 px-2 py-1 fw-semibold" style="background-color: #EDE9FE; color: #6D28D9; font-size: 0.72rem;">
                        Form Berita Acara
                    </span>
                </div>

                <div class="p-4">
                    <form onsubmit="submitNaskah('Berita Acara', document.getElementById('noBeritaAcara').value); return false;">
                        <div class="row g-3">
                            <div class="col-12 col-md-4">
                                <label for="noBeritaAcara" class="form-label fw-semibold text-dark small mb-1">Nomor Berita Acara (Otomatis)</label>
                                <input type="text" id="noBeritaAcara" class="form-control form-control-sm doc-number-mono text-primary bg-light" value="400/029/BA-SIAK/XI/2026" readonly>
                            </div>
                            <div class="col-12 col-md-4">
                                <label for="pihakKeduaBa" class="form-label fw-semibold text-dark small mb-1">Pihak Kedua / Instansi Mitra <span class="text-danger">*</span></label>
                                <input type="text" id="pihakKeduaBa" class="form-control form-control-sm" value="Kantor Kecamatan Lempuing (Camat Lempuing)">
                            </div>
                            <div class="col-12 col-md-4">
                                <label for="perihalBa" class="form-label fw-semibold text-dark small mb-1">Pokok Berita Acara <span class="text-danger">*</span></label>
                                <input type="text" id="perihalBa" class="form-control form-control-sm" value="Serah Terima Distribusi 1.000 Keping Blangko KTP-el">
                            </div>
                        </div>
                        <div class="d-flex justify-content-end mt-3 pt-3 border-top">
                            <button type="submit" class="btn btn-primary btn-sm fw-semibold px-4 py-2 rounded-2 d-inline-flex align-items-center gap-2 shadow-sm">
                                <i class="bi bi-send-check-fill" aria-hidden="true"></i>
                                <span>Simpan &amp; Ajukan Berita Acara ke Hierarki</span>
                            </button>
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

<div class="modal fade" id="modalSubmitSukses" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow rounded-3">
            <div class="modal-header border-bottom px-4 py-3">
                <h6 class="modal-title fw-bold text-success d-flex align-items-center gap-2">
                    <i class="bi bi-check-circle-fill" aria-hidden="true"></i>
                    <span>Naskah Dinas Berhasil Diajukan ke Hierarki</span>
                </h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body p-4 small">
                <p class="text-secondary mb-2">Konsep naskah dinas telah tercatat pada Buku Agenda dan diteruskan ke antrean <strong>Verifikasi Tahap 1 (Kasubbag Umpeg)</strong>:</p>
                <div class="p-3 rounded-2 bg-light border mb-0">
                    <div class="fw-bold text-dark" id="modalSubmitJenis">Jenis: Surat Keluar</div>
                    <div class="doc-number-mono text-primary mt-1" id="modalSubmitNomor">Nomor: 400/2763/disdukcapil/2026</div>
                </div>
            </div>
            <div class="modal-footer border-top px-4 py-2">
                <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">Tetap di Halaman Ini</button>
                <a href="/verifikasi-hierarki" class="btn btn-sm btn-primary fw-semibold">Lanjut ke Meja Verifikasi Hierarki &rarr;</a>
            </div>
        </div>
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

    function updateAutoNomorSurat() {
        const kode = document.getElementById('kodeBidangSelect').value || '400';
        const urut = document.getElementById('nomorUrutKeluar').value || '2763';
        const formatted = kode + '/' + urut + '/disdukcapil/2026';
        document.getElementById('previewNomorKeluar').textContent = formatted;
        document.getElementById('ketNomorSurat').value = formatted;
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

    function submitNaskah(jenis, nomor) {
        document.getElementById('modalSubmitJenis').textContent = 'Jenis Naskah: ' + jenis;
        document.getElementById('modalSubmitNomor').textContent = 'Nomor Registrasi: ' + nomor;
        const modal = new bootstrap.Modal(document.getElementById('modalSubmitSukses'));
        modal.show();
    }

    document.addEventListener('DOMContentLoaded', applyLockedRole);
</script>
</body>
</html>
