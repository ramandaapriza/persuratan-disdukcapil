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
            <a href="/admin/users" class="nav-link-sidebar active">
                <span class="d-flex align-items-center gap-3">
                    <i class="bi bi-people-fill" aria-hidden="true"></i>
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
                <span class="text-secondary">Administrasi Sistem</span>
                <span class="text-secondary mx-1">/</span>
                <span class="text-primary fw-medium">Manajemen Akun &amp; Hak Akses</span>
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
                        <li><a class="dropdown-item py-2" href="/switch-role/admin?redirect=/admin/users" onclick="lockUserRole('admin')"><i class="bi bi-person-gear text-primary me-2"></i><strong>Staf Admin</strong> (Subbag Umpeg)</a></li>
                        <li><a class="dropdown-item py-2" href="/switch-role/kasubbag?redirect=/admin/users" onclick="lockUserRole('kasubbag')"><i class="bi bi-clipboard2-check text-warning me-2"></i><strong>Kasubbag Umpeg</strong> (Verifikator I)</a></li>
                        <li><a class="dropdown-item py-2" href="/switch-role/sekdin?redirect=/admin/users" onclick="lockUserRole('sekdin')"><i class="bi bi-pen text-info me-2"></i><strong>Sekretaris Dinas</strong> (Verifikator II)</a></li>
                        <li><a class="dropdown-item py-2" href="/switch-role/kadin?redirect=/admin/users" onclick="lockUserRole('kadin')"><i class="bi bi-qr-code-scan text-success me-2"></i><strong>Kepala Dinas</strong> (Otorisator TTE)</a></li>
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
                            <form onsubmit="openUserActionModal('Registrasi Akun Baru Berhasil', 'Akun pegawai ' + document.getElementById('namaPegawai').value + ' (' + document.getElementById('nipPegawai').value + ') telah diaktifkan pada Single Gate RBAC.'); return false;">
                                <div class="mb-3">
                                    <label for="nipPegawai" class="form-label fw-semibold text-dark small mb-1">
                                        NIP Pegawai (18 Digit) <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-text bg-light text-secondary"><i class="bi bi-person-vcard" aria-hidden="true"></i></span>
                                        <input type="text" id="nipPegawai" class="form-control doc-number-mono" placeholder="Contoh: 198807152014021003" value="198807152014021003" required>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="namaPegawai" class="form-label fw-semibold text-dark small mb-1">
                                        Nama Lengkap &amp; Gelar <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-text bg-light text-secondary"><i class="bi bi-person" aria-hidden="true"></i></span>
                                        <input type="text" id="namaPegawai" class="form-control" placeholder="Masukkan nama lengkap beserta gelar..." value="M. Farhan Pratama, S.Kom" required>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="jabatanPegawai" class="form-label fw-semibold text-dark small mb-1">
                                        Jabatan Struktural/Fungsional <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-text bg-light text-secondary"><i class="bi bi-briefcase" aria-hidden="true"></i></span>
                                        <input type="text" id="jabatanPegawai" class="form-control" placeholder="Masukkan jabatan resmi di Disdukcapil..." value="Pranata Komputer Ahli Pertama" required>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="kontakPegawai" class="form-label fw-semibold text-dark small mb-1">
                                        Email Resmi / No. HP <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-text bg-light text-secondary"><i class="bi bi-envelope-at" aria-hidden="true"></i></span>
                                        <input type="text" id="kontakPegawai" class="form-control" placeholder="email@kaboki.go.id / 0812xxxx" value="farhan.pratama@kaboki.go.id" required>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="roleSistem" class="form-label fw-semibold text-dark small mb-1">
                                        Penetapan Hak Akses (Role Sistem) <span class="text-danger">*</span>
                                    </label>
                                    <select id="roleSistem" class="form-select form-select-sm fw-medium">
                                        <option value="admin" selected>Staf Admin (Operator Agenda &amp; Konsep Surat)</option>
                                        <option value="kasubbag">Kasubbag Umpeg (Verifikator Hierarki Tahap 1)</option>
                                        <option value="sekdin">Sekretaris Dinas / Sekdin (Verifikator Hierarki Tahap 2)</option>
                                        <option value="kadin">Kepala Dinas / Kadin (Otorisator TTE &amp; Disposisi)</option>
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
                                        <input type="text" id="passwordDefault" class="form-control doc-number-mono text-primary" value="DukcapilOKI#2026">
                                    </div>
                                </div>

                                <div class="security-note-box mb-4">
                                    <div class="d-flex align-items-start gap-2">
                                        <i class="bi bi-shield-lock-fill text-primary mt-1" aria-hidden="true"></i>
                                        <div class="text-secondary" style="font-size: 0.73rem; line-height: 1.45;">
                                            <strong class="text-dark">Kebijakan Keamanan Kredensial:</strong> Pegawai wajib mengganti password sementara saat login pertama kali. Passphrase / PIN TTE diatur secara mandiri oleh Kepala Dinas.
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
                                <h6 class="fw-bold text-dark mb-1">Daftar Akun Pegawai Terdaftar</h6>
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
                                    <option value="">Semua Role (4)</option>
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
                                        <th>NIP &amp; NAMA PEGAWAI</th>
                                        <th>JABATAN</th>
                                        <th>ROLE AKSES</th>
                                        <th>STATUS TTE / AKUN</th>
                                        <th class="pe-4 text-end">AKSI</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr data-role="kadin">
                                        <td class="ps-4 fw-bold text-dark font-monospace">1</td>
                                        <td>
                                            <div class="fw-semibold text-dark">Drs. H. Hendra Suryadi, M.Si</div>
                                            <div class="doc-number-mono text-primary mt-1">NIP: 197108141998031004</div>
                                        </td>
                                        <td>
                                            <div class="fw-medium text-dark">Kepala Dinas Dukcapil</div>
                                            <div class="text-secondary" style="font-size: 0.72rem;">Pembina Utama Muda (IV/c)</div>
                                        </td>
                                        <td>
                                            <span class="badge rounded-2 px-2 py-1 fw-semibold" style="background-color: #EDE9FE; color: #6D28D9; font-size: 0.72rem;">
                                                <i class="bi bi-award-fill me-1" aria-hidden="true"></i>Kepala Dinas (Kadin)
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge rounded-pill fw-medium px-2 py-1" style="background-color: #DCFCE7; color: #15803D; font-size: 0.72rem;">
                                                <i class="bi bi-qr-code me-1" aria-hidden="true"></i>PIN TTE Terkonfigurasi
                                            </span>
                                        </td>
                                        <td class="pe-4 text-end">
                                            <div class="d-inline-flex align-items-center gap-1">
                                                <button type="button" onclick="openUserActionModal('Edit Role Pegawai', 'Ubah hak akses RBAC untuk Drs. H. Hendra Suryadi, M.Si')" class="btn btn-sm btn-outline-primary fw-medium px-2 py-1" style="font-size: 0.72rem;">
                                                    <i class="bi bi-pencil-square" aria-hidden="true"></i> Edit Role
                                                </button>
                                                <button type="button" onclick="openUserActionModal('Reset Kata Sandi', 'Kirimkan password sementara baru untuk Drs. H. Hendra Suryadi, M.Si')" class="btn btn-sm btn-outline-warning text-dark fw-medium px-2 py-1" style="font-size: 0.72rem;">
                                                    <i class="bi bi-key" aria-hidden="true"></i> Reset
                                                </button>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr data-role="sekdin">
                                        <td class="ps-4 fw-bold text-dark font-monospace">2</td>
                                        <td>
                                            <div class="fw-semibold text-dark">Ir. H. Bambang Irawan, M.M</div>
                                            <div class="doc-number-mono text-primary mt-1">NIP: 197405212000031002</div>
                                        </td>
                                        <td>
                                            <div class="fw-medium text-dark">Sekretaris Dinas (Sekdin)</div>
                                            <div class="text-secondary" style="font-size: 0.72rem;">Pembina Tk. I (IV/b)</div>
                                        </td>
                                        <td>
                                            <span class="badge rounded-2 px-2 py-1 fw-semibold" style="background-color: #DBEAFE; color: #1D4ED8; font-size: 0.72rem;">
                                                <i class="bi bi-shield-check me-1" aria-hidden="true"></i>Sekdin (Verifikator II)
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge rounded-pill fw-medium px-2 py-1" style="background-color: #DCFCE7; color: #15803D; font-size: 0.72rem;">
                                                <i class="bi bi-check-circle-fill me-1" aria-hidden="true"></i>Aktif (Paraf Hierarki)
                                            </span>
                                        </td>
                                        <td class="pe-4 text-end">
                                            <div class="d-inline-flex align-items-center gap-1">
                                                <button type="button" onclick="openUserActionModal('Edit Role Pegawai', 'Ubah hak akses RBAC untuk Ir. H. Bambang Irawan, M.M')" class="btn btn-sm btn-outline-primary fw-medium px-2 py-1" style="font-size: 0.72rem;">
                                                    <i class="bi bi-pencil-square" aria-hidden="true"></i> Edit Role
                                                </button>
                                                <button type="button" onclick="openUserActionModal('Reset Kata Sandi', 'Kirimkan password sementara baru untuk Ir. H. Bambang Irawan, M.M')" class="btn btn-sm btn-outline-warning text-dark fw-medium px-2 py-1" style="font-size: 0.72rem;">
                                                    <i class="bi bi-key" aria-hidden="true"></i> Reset
                                                </button>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr data-role="kasubbag">
                                        <td class="ps-4 fw-bold text-dark font-monospace">3</td>
                                        <td>
                                            <div class="fw-semibold text-dark">Hj. Siti Rahmawati, S.Sos., M.Si</div>
                                            <div class="doc-number-mono text-primary mt-1">NIP: 197911032005012006</div>
                                        </td>
                                        <td>
                                            <div class="fw-medium text-dark">Kasubbag Umum &amp; Kepegawaian</div>
                                            <div class="text-secondary" style="font-size: 0.72rem;">Penata Tk. I (III/d)</div>
                                        </td>
                                        <td>
                                            <span class="badge rounded-2 px-2 py-1 fw-semibold" style="background-color: #FEF3C7; color: #B45309; font-size: 0.72rem;">
                                                <i class="bi bi-file-earmark-check me-1" aria-hidden="true"></i>Kasubbag (Verifikator I)
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge rounded-pill fw-medium px-2 py-1" style="background-color: #DCFCE7; color: #15803D; font-size: 0.72rem;">
                                                <i class="bi bi-check-circle-fill me-1" aria-hidden="true"></i>Aktif (Verifikator)
                                            </span>
                                        </td>
                                        <td class="pe-4 text-end">
                                            <div class="d-inline-flex align-items-center gap-1">
                                                <button type="button" onclick="openUserActionModal('Edit Role Pegawai', 'Ubah hak akses RBAC untuk Hj. Siti Rahmawati, S.Sos., M.Si')" class="btn btn-sm btn-outline-primary fw-medium px-2 py-1" style="font-size: 0.72rem;">
                                                    <i class="bi bi-pencil-square" aria-hidden="true"></i> Edit Role
                                                </button>
                                                <button type="button" onclick="openUserActionModal('Reset Kata Sandi', 'Kirimkan password sementara baru untuk Hj. Siti Rahmawati, S.Sos., M.Si')" class="btn btn-sm btn-outline-warning text-dark fw-medium px-2 py-1" style="font-size: 0.72rem;">
                                                    <i class="bi bi-key" aria-hidden="true"></i> Reset
                                                </button>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr data-role="admin">
                                        <td class="ps-4 fw-bold text-dark font-monospace">4</td>
                                        <td>
                                            <div class="fw-semibold text-dark">Rizky Pratama, S.IP</div>
                                            <div class="doc-number-mono text-primary mt-1">NIP: 198504122010011008</div>
                                        </td>
                                        <td>
                                            <div class="fw-medium text-dark">Analis Tata Usaha / Ajudan</div>
                                            <div class="text-secondary" style="font-size: 0.72rem;">Penata Muda Tk. I (III/b)</div>
                                        </td>
                                        <td>
                                            <span class="badge rounded-2 px-2 py-1 fw-semibold" style="background-color: #E0F2FE; color: #0369A1; font-size: 0.72rem;">
                                                <i class="bi bi-person-gear me-1" aria-hidden="true"></i>Staf Admin
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge rounded-pill fw-medium px-2 py-1" style="background-color: #DCFCE7; color: #15803D; font-size: 0.72rem;">
                                                <i class="bi bi-check-circle-fill me-1" aria-hidden="true"></i>Aktif
                                            </span>
                                        </td>
                                        <td class="pe-4 text-end">
                                            <div class="d-inline-flex align-items-center gap-1">
                                                <button type="button" onclick="openUserActionModal('Edit Role Pegawai', 'Ubah hak akses RBAC untuk Rizky Pratama, S.IP')" class="btn btn-sm btn-outline-primary fw-medium px-2 py-1" style="font-size: 0.72rem;">
                                                    <i class="bi bi-pencil-square" aria-hidden="true"></i> Edit Role
                                                </button>
                                                <button type="button" onclick="openUserActionModal('Reset Kata Sandi', 'Kirimkan password sementara baru untuk Rizky Pratama, S.IP')" class="btn btn-sm btn-outline-warning text-dark fw-medium px-2 py-1" style="font-size: 0.72rem;">
                                                    <i class="bi bi-key" aria-hidden="true"></i> Reset
                                                </button>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr data-role="admin">
                                        <td class="ps-4 fw-bold text-dark font-monospace">5</td>
                                        <td>
                                            <div class="fw-semibold text-dark">Dedi Kurniawan, A.Md.Kom</div>
                                            <div class="doc-number-mono text-primary mt-1">NIP: 199209182019031005</div>
                                        </td>
                                        <td>
                                            <div class="fw-medium text-dark">Pengelola Surat &amp; Arsip Digital</div>
                                            <div class="text-secondary" style="font-size: 0.72rem;">Pengatur Tk. I (II/d)</div>
                                        </td>
                                        <td>
                                            <span class="badge rounded-2 px-2 py-1 fw-semibold" style="background-color: #E0F2FE; color: #0369A1; font-size: 0.72rem;">
                                                <i class="bi bi-person-gear me-1" aria-hidden="true"></i>Staf Admin
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge rounded-pill fw-medium px-2 py-1" style="background-color: #DCFCE7; color: #15803D; font-size: 0.72rem;">
                                                <i class="bi bi-check-circle-fill me-1" aria-hidden="true"></i>Aktif
                                            </span>
                                        </td>
                                        <td class="pe-4 text-end">
                                            <div class="d-inline-flex align-items-center gap-1">
                                                <button type="button" onclick="openUserActionModal('Edit Role Pegawai', 'Ubah hak akses RBAC untuk Dedi Kurniawan, A.Md.Kom')" class="btn btn-sm btn-outline-primary fw-medium px-2 py-1" style="font-size: 0.72rem;">
                                                    <i class="bi bi-pencil-square" aria-hidden="true"></i> Edit Role
                                                </button>
                                                <button type="button" onclick="openUserActionModal('Reset Kata Sandi', 'Kirimkan password sementara baru untuk Dedi Kurniawan, A.Md.Kom')" class="btn btn-sm btn-outline-warning text-dark fw-medium px-2 py-1" style="font-size: 0.72rem;">
                                                    <i class="bi bi-key" aria-hidden="true"></i> Reset
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="card-footer bg-white border-top px-4 py-3 d-flex flex-column flex-sm-row align-items-sm-center justify-content-between gap-2">
                            <span class="text-secondary" style="font-size: 0.76rem;">
                                Menampilkan <strong>1 &ndash; 5</strong> dari <strong>18</strong> akun aparatur aktif di lingkungan Disdukcapil OKI
                            </span>
                            <nav aria-label="Navigasi halaman pegawai">
                                <ul class="pagination pagination-sm mb-0">
                                    <li class="page-item disabled"><button type="button" class="page-link">Sebelumnya</button></li>
                                    <li class="page-item active"><button type="button" class="page-link">1</button></li>
                                    <li class="page-item"><button type="button" class="page-link" onclick="filterUserTable()">2</button></li>
                                    <li class="page-item"><button type="button" class="page-link" onclick="filterUserTable()">3</button></li>
                                    <li class="page-item"><button type="button" class="page-link" onclick="filterUserTable()">Selanjutnya</button></li>
                                </ul>
                            </nav>
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

<div class="modal fade" id="modalUserAction" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow rounded-3">
            <div class="modal-header border-bottom px-4 py-3">
                <h6 class="modal-title fw-bold text-primary d-flex align-items-center gap-2" id="modalUserActionTitle">
                    <i class="bi bi-check2-circle" aria-hidden="true"></i>
                    <span>Manajemen Akun Pegawai</span>
                </h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body p-4 small">
                <p class="text-dark fw-medium mb-0" id="modalUserActionDesc"></p>
            </div>
            <div class="modal-footer border-top px-4 py-2">
                <button type="button" class="btn btn-sm btn-primary fw-semibold" data-bs-dismiss="modal">Selesai</button>
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

    function openUserActionModal(title, desc) {
        document.getElementById('modalUserActionTitle').textContent = title;
        document.getElementById('modalUserActionDesc').textContent = desc;
        new bootstrap.Modal(document.getElementById('modalUserAction')).show();
    }

    document.addEventListener('DOMContentLoaded', applyLockedRole);
</script>
</body>
</html>
