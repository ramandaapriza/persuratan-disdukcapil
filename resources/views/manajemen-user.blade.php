<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Akun &amp; Hak Akses - Disdukcapil OKI</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #F3F4F6;
            color: #1F2937;
        }
        .sidebar {
            width: 250px;
            min-height: 100vh;
            background-color: #111827;
        }
        .sidebar-section-label {
            font-size: 0.68rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: #6B7280;
            padding: 0.85rem 1rem 0.35rem;
        }
        .nav-link-sidebar {
            color: #9CA3AF;
            padding: 0.65rem 1rem;
            border-radius: 0.5rem;
            font-size: 0.875rem;
            font-weight: 500;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.75rem;
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
        .table-users th {
            font-size: 0.71rem;
            font-weight: 600;
            color: #6B7280;
            letter-spacing: 0.04em;
            text-transform: uppercase;
            background-color: #F9FAFB;
            padding: 0.85rem 0.9rem;
            border-bottom: 1px solid #E5E7EB;
            white-space: nowrap;
        }
        .table-users td {
            padding: 0.95rem 0.9rem;
            vertical-align: middle;
            border-bottom: 1px solid #F3F4F6;
            font-size: 0.82rem;
        }
        .security-note-box {
            background-color: #EFF6FF;
            border: 1px solid #BFDBFE;
            border-radius: 0.5rem;
            padding: 0.75rem;
        }
    </style>
</head>
<body>

<div class="d-flex">
    <aside class="sidebar d-flex flex-column flex-shrink-0 position-fixed top-0 bottom-0 start-0 z-3">
        <div class="p-3 d-flex align-items-center gap-3 border-bottom border-secondary border-opacity-25">
            <div class="bg-primary text-white rounded-3 d-flex align-items-center justify-content-center" style="width: 38px; height: 38px;">
                <i class="bi bi-envelope-paper-fill fs-5"></i>
            </div>
            <div>
                <div class="fw-bold text-white" style="font-size: 0.9rem; letter-spacing: 0.02em;">DISDUKCAPIL OKI</div>
                <div class="text-secondary" style="font-size: 0.72rem;">Persuratan &amp; Kearsipan</div>
            </div>
        </div>

        <div class="p-3 d-flex flex-column gap-1 flex-grow-1">
            <a href="/" class="nav-link-sidebar">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
            <a href="#" class="nav-link-sidebar">
                <i class="bi bi-inbox"></i>
                <span>Surat Masuk</span>
            </a>
            <a href="/registrasi-surat" class="nav-link-sidebar">
                <i class="bi bi-send"></i>
                <span>Surat Keluar</span>
            </a>
            <a href="/registrasi-surat" class="nav-link-sidebar">
                <i class="bi bi-briefcase"></i>
                <span>SPPD</span>
            </a>
            <a href="#" class="nav-link-sidebar">
                <i class="bi bi-file-earmark-text"></i>
                <span>Berita Acara</span>
            </a>

            <div class="sidebar-section-label mt-2">ADMINISTRASI SISTEM</div>
            <a href="/admin/users" class="nav-link-sidebar active">
                <i class="bi bi-people-fill"></i>
                <span>Manajemen Akun Pegawai</span>
            </a>
        </div>

        <div class="px-3 py-2 border-top border-secondary border-opacity-25">
            <a href="/login" class="nav-link-sidebar text-danger">
                <i class="bi bi-box-arrow-left"></i>
                <span>Logout</span>
            </a>
        </div>

        <div class="p-3 border-top border-secondary border-opacity-25 d-flex align-items-center gap-2" style="background-color: #0B0F19;">
            <div class="rounded-circle bg-primary bg-opacity-25 text-info fw-bold d-flex align-items-center justify-content-center" style="width: 34px; height: 34px; font-size: 0.75rem;">
                AD
            </div>
            <div class="lh-sm">
                <div class="text-white fw-semibold" style="font-size: 0.8rem;">AD - Admin Disdukcapil</div>
                <div class="text-secondary" style="font-size: 0.7rem;">Subbag Umum OKI</div>
            </div>
        </div>
    </aside>

    <div class="flex-grow-1 d-flex flex-column min-vh-100" style="margin-left: 250px;">
        <header class="bg-white border-bottom px-4 py-2 d-flex align-items-center justify-content-between sticky-top" style="height: 58px;">
            <div class="small">
                <span class="text-secondary">Disdukcapil OKI</span>
                <span class="text-secondary mx-1">/</span>
                <span class="text-secondary">Administrasi Sistem</span>
                <span class="text-secondary mx-1">/</span>
                <span class="text-primary fw-medium">Manajemen Akun &amp; Hak Akses</span>
            </div>

            <div class="d-flex align-items-center gap-2">
                <div class="border rounded-2 px-3 py-1 bg-light text-secondary d-flex align-items-center gap-2" style="font-size: 0.78rem;">
                    <i class="bi bi-calendar3 text-primary"></i>
                    <span>Kamis, 12 November 2026</span>
                </div>

                <div class="dropdown">
                    <button class="btn btn-sm border rounded-pill px-2 py-1 d-flex align-items-center gap-2 bg-white" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="rounded-circle bg-primary text-white fw-bold d-inline-flex align-items-center justify-content-center" style="width: 24px; height: 24px; font-size: 0.68rem;">AD</span>
                        <span class="text-dark fw-medium" style="font-size: 0.78rem;">AD - Admin Disdukcapil</span>
                        <i class="bi bi-chevron-down text-secondary" style="font-size: 0.65rem;"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 small">
                        <li><a class="dropdown-item" href="#"><i class="bi bi-person-gear me-2"></i>Profil Administrator</a></li>
                        <li><a class="dropdown-item" href="#"><i class="bi bi-shield-check me-2"></i>Log Audit Keamanan</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item text-danger" href="/login"><i class="bi bi-box-arrow-right me-2"></i>Logout</a></li>
                    </ul>
                </div>
            </div>
        </header>

        <main class="p-4 flex-grow-1">
            <div class="row g-4">
                <div class="col-12 col-lg-4">
                    <div class="card border-0 shadow-sm rounded-3 h-100">
                        <div class="card-header bg-white border-bottom px-4 py-3 d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center gap-2">
                                <span class="rounded-2 bg-primary bg-opacity-10 text-primary d-inline-flex align-items-center justify-content-center" style="width: 34px; height: 34px;">
                                    <i class="bi bi-person-plus-fill"></i>
                                </span>
                                <div>
                                    <h6 class="fw-bold text-dark mb-0">Daftarkan Akun Pegawai Baru</h6>
                                    <div class="text-secondary" style="font-size: 0.73rem;">Otoritas Khusus Admin Subbag Umpeg</div>
                                </div>
                            </div>
                        </div>

                        <div class="card-body p-4">
                            <form action="#" method="POST" onsubmit="return false;">
                                <div class="mb-3">
                                    <label for="nipPegawai" class="form-label fw-semibold text-dark small mb-1">
                                        NIP Pegawai (18 Digit) <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-text bg-light text-secondary"><i class="bi bi-person-vcard"></i></span>
                                        <input type="text" id="nipPegawai" class="form-control" placeholder="Contoh: 198807152014021003" value="198807152014021003">
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="namaPegawai" class="form-label fw-semibold text-dark small mb-1">
                                        Nama Lengkap &amp; Gelar <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-text bg-light text-secondary"><i class="bi bi-person"></i></span>
                                        <input type="text" id="namaPegawai" class="form-control" placeholder="Masukkan nama lengkap beserta gelar..." value="M. Farhan Pratama, S.Kom">
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="jabatanPegawai" class="form-label fw-semibold text-dark small mb-1">
                                        Jabatan Struktural/Fungsional <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-text bg-light text-secondary"><i class="bi bi-briefcase"></i></span>
                                        <input type="text" id="jabatanPegawai" class="form-control" placeholder="Masukkan jabatan resmi di Disdukcapil..." value="Pranata Komputer Ahli Pertama">
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="kontakPegawai" class="form-label fw-semibold text-dark small mb-1">
                                        Email Resmi / No. HP <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-text bg-light text-secondary"><i class="bi bi-envelope-at"></i></span>
                                        <input type="text" id="kontakPegawai" class="form-control" placeholder="email@kaboki.go.id / 0812xxxx" value="farhan.pratama@kaboki.go.id">
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
                                        <span class="input-group-text bg-light text-secondary"><i class="bi bi-key-fill"></i></span>
                                        <input type="text" id="passwordDefault" class="form-control font-monospace fw-semibold text-primary" value="DukcapilOKI#2026">
                                    </div>
                                </div>

                                <div class="security-note-box mb-4">
                                    <div class="d-flex align-items-start gap-2">
                                        <i class="bi bi-shield-lock-fill text-primary mt-1"></i>
                                        <div class="text-secondary" style="font-size: 0.73rem; line-height: 1.45;">
                                            <strong class="text-dark">Kebijakan Keamanan Kredensial:</strong> Pegawai wajib mengganti password sementara saat login pertama kali. Passphrase / PIN TTE diatur secara mandiri oleh Kepala Dinas.
                                        </div>
                                    </div>
                                </div>

                                <div class="d-grid">
                                    <button type="button" class="btn btn-primary fw-semibold py-2 rounded-2 d-flex align-items-center justify-content-center gap-2 shadow-sm" style="font-size: 0.86rem;">
                                        <i class="bi bi-check2-circle"></i>
                                        <span>Simpan &amp; Aktifkan Akun Pegawai</span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-8">
                    <div class="card border-0 shadow-sm rounded-3 h-100">
                        <div class="card-header bg-white border-bottom p-3 px-4 d-flex flex-column flex-xl-row align-items-xl-center justify-content-between gap-3">
                            <div>
                                <h6 class="fw-bold text-dark mb-1">Daftar Akun Pegawai Terdaftar</h6>
                                <div class="text-secondary" style="font-size: 0.76rem;">Kelola hak akses RBAC, status otorisasi TTE, dan pemulihan kata sandi aparatur Disdukcapil OKI.</div>
                            </div>

                            <div class="d-flex flex-wrap align-items-center gap-2">
                                <div class="input-group input-group-sm" style="width: 210px;">
                                    <span class="input-group-text bg-white border-end-0 text-secondary">
                                        <i class="bi bi-search"></i>
                                    </span>
                                    <input type="text" class="form-control border-start-0 ps-0" placeholder="Cari NIP / Nama pegawai...">
                                </div>

                                <select class="form-select form-select-sm" style="width: 165px;">
                                    <option value="">Semua Role (4)</option>
                                    <option value="kadin">Kepala Dinas (Kadin)</option>
                                    <option value="sekdin">Sekretaris Dinas</option>
                                    <option value="kasubbag">Kasubbag Umpeg</option>
                                    <option value="admin">Staf Admin</option>
                                </select>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-users mb-0">
                                <thead>
                                    <tr>
                                        <th class="ps-4" style="width: 48px;">NO</th>
                                        <th>NIP &amp; NAMA PEGAWAI</th>
                                        <th>JABATAN</th>
                                        <th>ROLE AKSES</th>
                                        <th>STATUS TTE / AKUN</th>
                                        <th class="pe-4 text-end">AKSI</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="ps-4 fw-bold text-dark">1</td>
                                        <td>
                                            <div class="fw-bold text-dark">Drs. H. Hendra Suryadi, M.Si</div>
                                            <div class="text-secondary font-monospace" style="font-size: 0.73rem;">NIP: 197108141998031004</div>
                                        </td>
                                        <td>
                                            <div class="fw-medium text-dark">Kepala Dinas Dukcapil</div>
                                            <div class="text-secondary" style="font-size: 0.72rem;">Pembina Utama Muda (IV/c)</div>
                                        </td>
                                        <td>
                                            <span class="badge rounded-pill fw-semibold px-2 py-1" style="background-color: #EDE9FE; color: #6D28D9; border: 1px solid #DDD6FE; font-size: 0.71rem;">
                                                <i class="bi bi-award-fill me-1"></i>Kepala Dinas (Kadin)
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge rounded-pill fw-medium px-2 py-1" style="background-color: #DCFCE7; color: #15803D; font-size: 0.71rem;">
                                                <i class="bi bi-qr-code me-1"></i>PIN TTE Terkonfigurasi
                                            </span>
                                        </td>
                                        <td class="pe-4 text-end">
                                            <div class="d-inline-flex align-items-center gap-1">
                                                <button type="button" class="btn btn-sm btn-outline-primary px-2 py-1" style="font-size: 0.72rem;" title="Edit Role">
                                                    <i class="bi bi-pencil-square"></i> Edit Role
                                                </button>
                                                <button type="button" class="btn btn-sm btn-outline-warning text-dark px-2 py-1" style="font-size: 0.72rem;" title="Reset Password">
                                                    <i class="bi bi-key"></i> Reset
                                                </button>
                                                <button type="button" class="btn btn-sm btn-outline-danger px-2 py-1" style="font-size: 0.72rem;" title="Nonaktifkan">
                                                    <i class="bi bi-slash-circle"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="ps-4 fw-bold text-dark">2</td>
                                        <td>
                                            <div class="fw-bold text-dark">Ir. H. Bambang Irawan, M.M</div>
                                            <div class="text-secondary font-monospace" style="font-size: 0.73rem;">NIP: 197405212000031002</div>
                                        </td>
                                        <td>
                                            <div class="fw-medium text-dark">Sekretaris Dinas (Sekdin)</div>
                                            <div class="text-secondary" style="font-size: 0.72rem;">Pembina Tk. I (IV/b)</div>
                                        </td>
                                        <td>
                                            <span class="badge rounded-pill fw-semibold px-2 py-1" style="background-color: #DBEAFE; color: #1D4ED8; border: 1px solid #BFDBFE; font-size: 0.71rem;">
                                                <i class="bi bi-shield-check me-1"></i>Sekdin (Verifikator II)
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge rounded-pill fw-medium px-2 py-1" style="background-color: #DCFCE7; color: #15803D; font-size: 0.71rem;">
                                                <i class="bi bi-check-circle-fill me-1"></i>Aktif (Paraf Hierarki)
                                            </span>
                                        </td>
                                        <td class="pe-4 text-end">
                                            <div class="d-inline-flex align-items-center gap-1">
                                                <button type="button" class="btn btn-sm btn-outline-primary px-2 py-1" style="font-size: 0.72rem;" title="Edit Role">
                                                    <i class="bi bi-pencil-square"></i> Edit Role
                                                </button>
                                                <button type="button" class="btn btn-sm btn-outline-warning text-dark px-2 py-1" style="font-size: 0.72rem;" title="Reset Password">
                                                    <i class="bi bi-key"></i> Reset
                                                </button>
                                                <button type="button" class="btn btn-sm btn-outline-danger px-2 py-1" style="font-size: 0.72rem;" title="Nonaktifkan">
                                                    <i class="bi bi-slash-circle"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="ps-4 fw-bold text-dark">3</td>
                                        <td>
                                            <div class="fw-bold text-dark">Hj. Siti Rahmawati, S.Sos., M.Si</div>
                                            <div class="text-secondary font-monospace" style="font-size: 0.73rem;">NIP: 197911032005012006</div>
                                        </td>
                                        <td>
                                            <div class="fw-medium text-dark">Kasubbag Umum &amp; Kepegawaian</div>
                                            <div class="text-secondary" style="font-size: 0.72rem;">Penata Tk. I (III/d)</div>
                                        </td>
                                        <td>
                                            <span class="badge rounded-pill fw-semibold px-2 py-1" style="background-color: #FEF3C7; color: #B45309; border: 1px solid #FDE68A; font-size: 0.71rem;">
                                                <i class="bi bi-file-earmark-check me-1"></i>Kasubbag (Verifikator I)
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge rounded-pill fw-medium px-2 py-1" style="background-color: #DCFCE7; color: #15803D; font-size: 0.71rem;">
                                                <i class="bi bi-check-circle-fill me-1"></i>Aktif (Verifikator)
                                            </span>
                                        </td>
                                        <td class="pe-4 text-end">
                                            <div class="d-inline-flex align-items-center gap-1">
                                                <button type="button" class="btn btn-sm btn-outline-primary px-2 py-1" style="font-size: 0.72rem;" title="Edit Role">
                                                    <i class="bi bi-pencil-square"></i> Edit Role
                                                </button>
                                                <button type="button" class="btn btn-sm btn-outline-warning text-dark px-2 py-1" style="font-size: 0.72rem;" title="Reset Password">
                                                    <i class="bi bi-key"></i> Reset
                                                </button>
                                                <button type="button" class="btn btn-sm btn-outline-danger px-2 py-1" style="font-size: 0.72rem;" title="Nonaktifkan">
                                                    <i class="bi bi-slash-circle"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="ps-4 fw-bold text-dark">4</td>
                                        <td>
                                            <div class="fw-bold text-dark">Rizky Pratama, S.IP</div>
                                            <div class="text-secondary font-monospace" style="font-size: 0.73rem;">NIP: 198504122010011008</div>
                                        </td>
                                        <td>
                                            <div class="fw-medium text-dark">Analis Tata Usaha / Ajudan</div>
                                            <div class="text-secondary" style="font-size: 0.72rem;">Penata Muda Tk. I (III/b)</div>
                                        </td>
                                        <td>
                                            <span class="badge rounded-pill fw-semibold px-2 py-1" style="background-color: #E0F2FE; color: #0369A1; border: 1px solid #BAE6FD; font-size: 0.71rem;">
                                                <i class="bi bi-person-gear me-1"></i>Staf Admin
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge rounded-pill fw-medium px-2 py-1" style="background-color: #DCFCE7; color: #15803D; font-size: 0.71rem;">
                                                <i class="bi bi-check-circle-fill me-1"></i>Aktif
                                            </span>
                                        </td>
                                        <td class="pe-4 text-end">
                                            <div class="d-inline-flex align-items-center gap-1">
                                                <button type="button" class="btn btn-sm btn-outline-primary px-2 py-1" style="font-size: 0.72rem;" title="Edit Role">
                                                    <i class="bi bi-pencil-square"></i> Edit Role
                                                </button>
                                                <button type="button" class="btn btn-sm btn-outline-warning text-dark px-2 py-1" style="font-size: 0.72rem;" title="Reset Password">
                                                    <i class="bi bi-key"></i> Reset
                                                </button>
                                                <button type="button" class="btn btn-sm btn-outline-danger px-2 py-1" style="font-size: 0.72rem;" title="Nonaktifkan">
                                                    <i class="bi bi-slash-circle"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="ps-4 fw-bold text-dark">5</td>
                                        <td>
                                            <div class="fw-bold text-dark">Dedi Kurniawan, A.Md.Kom</div>
                                            <div class="text-secondary font-monospace" style="font-size: 0.73rem;">NIP: 199209182019031005</div>
                                        </td>
                                        <td>
                                            <div class="fw-medium text-dark">Pengelola Surat &amp; Arsip Digital</div>
                                            <div class="text-secondary" style="font-size: 0.72rem;">Pengatur Tk. I (II/d)</div>
                                        </td>
                                        <td>
                                            <span class="badge rounded-pill fw-semibold px-2 py-1" style="background-color: #E0F2FE; color: #0369A1; border: 1px solid #BAE6FD; font-size: 0.71rem;">
                                                <i class="bi bi-person-gear me-1"></i>Staf Admin
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge rounded-pill fw-medium px-2 py-1" style="background-color: #DCFCE7; color: #15803D; font-size: 0.71rem;">
                                                <i class="bi bi-check-circle-fill me-1"></i>Aktif
                                            </span>
                                        </td>
                                        <td class="pe-4 text-end">
                                            <div class="d-inline-flex align-items-center gap-1">
                                                <button type="button" class="btn btn-sm btn-outline-primary px-2 py-1" style="font-size: 0.72rem;" title="Edit Role">
                                                    <i class="bi bi-pencil-square"></i> Edit Role
                                                </button>
                                                <button type="button" class="btn btn-sm btn-outline-warning text-dark px-2 py-1" style="font-size: 0.72rem;" title="Reset Password">
                                                    <i class="bi bi-key"></i> Reset
                                                </button>
                                                <button type="button" class="btn btn-sm btn-outline-danger px-2 py-1" style="font-size: 0.72rem;" title="Nonaktifkan">
                                                    <i class="bi bi-slash-circle"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="card-footer bg-white border-top px-4 py-3 d-flex flex-column flex-sm-row align-items-sm-center justify-content-between gap-2">
                            <span class="text-secondary" style="font-size: 0.76rem;">Menampilkan 5 dari 18 akun aparatur aktif di lingkungan Disdukcapil OKI</span>
                            <nav aria-label="Navigasi halaman pegawai">
                                <ul class="pagination pagination-sm mb-0">
                                    <li class="page-item disabled"><a class="page-link" href="#">Sebelumnya</a></li>
                                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item"><a class="page-link" href="#">Selanjutnya</a></li>
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
