<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Persuratan - Disdukcapil OKI</title>
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
        .welcome-banner {
            background: linear-gradient(135deg, #172554 0%, #1e3a8a 60%, #1d4ed8 100%);
        }
        .icon-box {
            width: 44px;
            height: 44px;
            border-radius: 0.65rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
        }
        .table-agenda th {
            font-size: 0.72rem;
            font-weight: 600;
            color: #6B7280;
            letter-spacing: 0.04em;
            text-transform: uppercase;
            background-color: #F9FAFB;
            padding: 0.85rem 1rem;
            border-bottom: 1px solid #E5E7EB;
        }
        .table-agenda td {
            padding: 1rem;
            vertical-align: middle;
            border-bottom: 1px solid #F3F4F6;
            font-size: 0.85rem;
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
            <a href="#" class="nav-link-sidebar active">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
            <a href="#" class="nav-link-sidebar">
                <i class="bi bi-inbox"></i>
                <span>Surat Masuk</span>
            </a>
            <a href="#" class="nav-link-sidebar">
                <i class="bi bi-send"></i>
                <span>Surat Keluar</span>
            </a>
            <a href="#" class="nav-link-sidebar">
                <i class="bi bi-briefcase"></i>
                <span>SPPD</span>
            </a>
            <a href="#" class="nav-link-sidebar">
                <i class="bi bi-file-earmark-text"></i>
                <span>Berita Acara</span>
            </a>
        </div>

        <div class="px-3 py-2 border-top border-secondary border-opacity-25">
            <a href="#" class="nav-link-sidebar text-danger">
                <i class="bi bi-box-arrow-left"></i>
                <span>Logout</span>
            </a>
        </div>

        <div class="p-3 border-top border-secondary border-opacity-25 d-flex align-items-center gap-2" style="background-color: #0B0F19;">
            <div class="rounded-circle bg-primary bg-opacity-25 text-info fw-bold d-flex align-items-center justify-content-center" style="width: 34px; height: 34px; font-size: 0.75rem;">
                AD
            </div>
            <div class="lh-sm">
                <div class="text-white fw-semibold" style="font-size: 0.8rem;">Admin Disdukcapil</div>
                <div class="text-secondary" style="font-size: 0.7rem;">Subbag Umum OKI</div>
            </div>
        </div>
    </aside>

    <div class="flex-grow-1 d-flex flex-column min-vh-100" style="margin-left: 250px;">
        <header class="bg-white border-bottom px-4 py-2 d-flex align-items-center justify-content-between sticky-top" style="height: 58px;">
            <div class="small">
                <span class="text-secondary">Disdukcapil OKI</span>
                <span class="text-secondary mx-1">/</span>
                <span class="text-primary fw-medium">Dashboard Persuratan</span>
            </div>

            <div class="d-flex align-items-center gap-2">
                <div class="border rounded-2 px-3 py-1 bg-light text-secondary d-flex align-items-center gap-2" style="font-size: 0.78rem;">
                    <i class="bi bi-calendar3 text-primary"></i>
                    <span>Senin, 09 November 2026</span>
                </div>

                <div class="dropdown">
                    <button class="btn btn-sm border rounded-pill px-2 py-1 d-flex align-items-center gap-2 bg-white" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="rounded-circle bg-primary text-white fw-bold d-inline-flex align-items-center justify-content-center" style="width: 24px; height: 24px; font-size: 0.68rem;">AD</span>
                        <span class="text-dark fw-medium" style="font-size: 0.78rem;">Admin Disdukcapil</span>
                        <i class="bi bi-chevron-down text-secondary" style="font-size: 0.65rem;"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 small">
                        <li><a class="dropdown-item" href="#"><i class="bi bi-person me-2"></i>Profil Saya</a></li>
                        <li><a class="dropdown-item" href="#"><i class="bi bi-gear me-2"></i>Pengaturan</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item text-danger" href="#"><i class="bi bi-box-arrow-right me-2"></i>Logout</a></li>
                    </ul>
                </div>
            </div>
        </header>

        <main class="p-4 flex-grow-1">
            <div class="welcome-banner rounded-3 p-4 mb-4 text-white shadow-sm d-flex flex-column flex-lg-row align-items-lg-center justify-content-between gap-3">
                <div style="max-width: 680px;">
                    <span class="badge rounded-pill px-3 py-1 mb-2 fw-medium d-inline-flex align-items-center gap-1" style="background-color: rgba(59, 130, 246, 0.25); color: #93C5FD; border: 1px solid rgba(147, 197, 253, 0.3); font-size: 0.72rem;">
                        <i class="bi bi-shield-check"></i> Sistem Tata Kelola Naskah Dinas Terpadu
                    </span>
                    <h4 class="fw-bold mb-2">Selamat Datang, Admin Disdukcapil</h4>
                    <p class="mb-0 text-white text-opacity-75" style="font-size: 0.82rem; line-height: 1.55;">
                        Kelola dan pantau seluruh alur persuratan resmi, surat masuk, surat keluar, SPPD, dan berita acara kedinasan Dinas Kependudukan dan Pencatatan Sipil Kabupaten Ogan Komering Ilir secara efisien dan real-time.
                    </p>
                </div>
                <div class="d-flex align-items-center gap-2 flex-shrink-0">
                    <button type="button" class="btn btn-light btn-sm fw-semibold text-primary px-3 py-2 rounded-2 d-inline-flex align-items-center gap-1">
                        <i class="bi bi-plus-circle"></i> Registrasi Surat
                    </button>
                    <button type="button" class="btn btn-outline-light btn-sm fw-medium px-3 py-2 rounded-2 d-inline-flex align-items-center gap-1" style="border-color: rgba(255,255,255,0.35);">
                        <i class="bi bi-printer"></i> Cetak Rekap
                    </button>
                </div>
            </div>

            <div class="row g-3 mb-4">
                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="card border-0 shadow-sm rounded-3 h-100">
                        <div class="card-body p-3 d-flex align-items-center justify-content-between">
                            <div>
                                <div class="text-secondary fw-medium mb-1" style="font-size: 0.78rem;">Total Surat Masuk</div>
                                <div class="fs-3 fw-bold text-dark lh-1 mb-2">153</div>
                                <div class="text-success fw-medium" style="font-size: 0.74rem;">
                                    <i class="bi bi-graph-up-arrow me-1"></i>+12 minggu ini
                                </div>
                            </div>
                            <div class="icon-box" style="background-color: #DBEAFE; color: #2563EB;">
                                <i class="bi bi-inbox-fill"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="card border-0 shadow-sm rounded-3 h-100">
                        <div class="card-body p-3 d-flex align-items-center justify-content-between">
                            <div>
                                <div class="text-secondary fw-medium mb-1" style="font-size: 0.78rem;">Surat Keluar</div>
                                <div class="fs-3 fw-bold text-dark lh-1 mb-2">96</div>
                                <div class="text-primary fw-medium" style="font-size: 0.74rem;">
                                    <i class="bi bi-check2 me-1"></i>8 terkirim hari ini
                                </div>
                            </div>
                            <div class="icon-box" style="background-color: #DCFCE7; color: #16A34A;">
                                <i class="bi bi-send-fill"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="card border-0 shadow-sm rounded-3 h-100">
                        <div class="card-body p-3 d-flex align-items-center justify-content-between">
                            <div>
                                <div class="text-secondary fw-medium mb-1" style="font-size: 0.78rem;">SPPD</div>
                                <div class="fs-3 fw-bold text-dark lh-1 mb-2">34</div>
                                <div class="text-secondary fw-medium" style="font-size: 0.74rem;">
                                    <i class="bi bi-geo-alt me-1"></i>3 tugas dinas aktif
                                </div>
                            </div>
                            <div class="icon-box" style="background-color: #E0F2FE; color: #0284C7;">
                                <i class="bi bi-briefcase-fill"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="card border-0 shadow-sm rounded-3 h-100">
                        <div class="card-body p-3 d-flex align-items-center justify-content-between">
                            <div>
                                <div class="text-secondary fw-medium mb-1" style="font-size: 0.78rem;">Menunggu Tanda Tangan</div>
                                <div class="fs-3 fw-bold text-danger lh-1 mb-2">10</div>
                                <div class="text-danger fw-medium" style="font-size: 0.74rem;">
                                    <i class="bi bi-exclamation-circle-fill me-1"></i>Perlu verifikasi Kadis
                                </div>
                            </div>
                            <div class="icon-box" style="background-color: #FEE2E2; color: #DC2626;">
                                <i class="bi bi-pencil-fill"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card border-0 shadow-sm rounded-3">
                <div class="card-header bg-white border-bottom p-3 px-4 d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
                    <div>
                        <h6 class="fw-bold text-dark mb-1">Surat Masuk Terbaru</h6>
                        <div class="text-secondary" style="font-size: 0.78rem;">Daftar naskah dinas masuk yang tercatat pada buku agenda persuratan Disdukcapil OKI.</div>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <div class="input-group input-group-sm" style="width: 230px;">
                            <span class="input-group-text bg-white border-end-0 text-secondary">
                                <i class="bi bi-search"></i>
                            </span>
                            <input type="text" class="form-control border-start-0 ps-0" placeholder="Cari surat / pengirim...">
                        </div>
                        <button type="button" class="btn btn-sm btn-outline-secondary px-2 py-1" title="Refresh">
                            <i class="bi bi-arrow-clockwise"></i>
                        </button>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-agenda mb-0">
                        <thead>
                            <tr>
                                <th class="ps-4" style="width: 60px;">NO</th>
                                <th style="width: 140px;">TANGGAL</th>
                                <th style="width: 280px;">PENGIRIM</th>
                                <th>PERIHAL</th>
                                <th class="pe-4 text-end" style="width: 160px;">STATUS</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="ps-4 fw-bold text-dark">1</td>
                                <td class="text-secondary">04 Nov 2026</td>
                                <td>
                                    <div class="fw-semibold text-dark">Ditjen Dukcapil Kemendagri RI</div>
                                    <div class="text-secondary" style="font-size: 0.75rem;">No: 470/1204/Dukcapil/2026</div>
                                </td>
                                <td>
                                    <div class="text-dark">Undangan Koordinasi Pemanfaatan Identitas Kependudukan Digital (IKD) Semester II</div>
                                    <div class="text-secondary" style="font-size: 0.75rem;"><i class="bi bi-tag me-1"></i>Sifat: Penting</div>
                                </td>
                                <td class="pe-4 text-end">
                                    <span class="badge rounded-pill fw-medium px-3 py-1" style="background-color: #DCFCE7; color: #15803D; font-size: 0.74rem;">
                                        <i class="bi bi-check-circle me-1"></i>Selesai
                                    </span>
                                </td>
                            </tr>

                            <tr>
                                <td class="ps-4 fw-bold text-dark">2</td>
                                <td class="text-secondary">06 Nov 2026</td>
                                <td>
                                    <div class="fw-semibold text-dark">Sekretariat Daerah Kab. OKI</div>
                                    <div class="text-secondary" style="font-size: 0.75rem;">No: 005/341/Setda-OKI/2026</div>
                                </td>
                                <td>
                                    <div class="text-dark">Permintaan Data Agregat Kependudukan Bersih (DAK2) untuk Alokasi Anggaran</div>
                                    <div class="text-secondary" style="font-size: 0.75rem;"><i class="bi bi-tag me-1"></i>Sifat: Segera</div>
                                </td>
                                <td class="pe-4 text-end">
                                    <span class="badge rounded-pill fw-medium px-3 py-1" style="background-color: #FEF3C7; color: #B45309; font-size: 0.74rem;">
                                        <i class="bi bi-hourglass-split me-1"></i>Diproses
                                    </span>
                                </td>
                            </tr>

                            <tr>
                                <td class="ps-4 fw-bold text-dark">3</td>
                                <td class="text-secondary">07 Nov 2026</td>
                                <td>
                                    <div class="fw-semibold text-dark">Dinas Komunikasi &amp; Informatika Kab. OKI</div>
                                    <div class="text-secondary" style="font-size: 0.75rem;">No: 800/189/Diskominfo-OKI/2026</div>
                                </td>
                                <td>
                                    <div class="text-dark">Koordinasi Integrasi API SIAK Terpusat dengan Portal Satu Data Kab. OKI</div>
                                    <div class="text-secondary" style="font-size: 0.75rem;"><i class="bi bi-tag me-1"></i>Sifat: Penting</div>
                                </td>
                                <td class="pe-4 text-end">
                                    <span class="badge rounded-pill fw-medium px-3 py-1" style="background-color: #FEE2E2; color: #B91C1C; font-size: 0.74rem;">
                                        <i class="bi bi-vector-pen me-1"></i>Menunggu TTD
                                    </span>
                                </td>
                            </tr>

                            <tr>
                                <td class="ps-4 fw-bold text-dark">4</td>
                                <td class="text-secondary">08 Nov 2026</td>
                                <td>
                                    <div class="fw-semibold text-dark">Kantor Kecamatan Kayuagung</div>
                                    <div class="text-secondary" style="font-size: 0.75rem;">No: 471/092/Kec-Kyg/2026</div>
                                </td>
                                <td>
                                    <div class="text-dark">Permohonan Distribusi Tambahan Blangko KTP Elektronik &amp; Ribbon Printer</div>
                                    <div class="text-secondary" style="font-size: 0.75rem;"><i class="bi bi-tag me-1"></i>Sifat: Segera</div>
                                </td>
                                <td class="pe-4 text-end">
                                    <span class="badge rounded-pill fw-medium px-3 py-1" style="background-color: #DCFCE7; color: #15803D; font-size: 0.74rem;">
                                        <i class="bi bi-check-circle me-1"></i>Selesai
                                    </span>
                                </td>
                            </tr>

                            <tr>
                                <td class="ps-4 fw-bold text-dark">5</td>
                                <td class="text-secondary">09 Nov 2026</td>
                                <td>
                                    <div class="fw-semibold text-dark">Pengadilan Agama Kayuagung</div>
                                    <div class="text-secondary" style="font-size: 0.75rem;">No: W6-A4/892/HK.05/XI/2026</div>
                                </td>
                                <td>
                                    <div class="text-dark">Penyampaian Salinan Putusan Perubahan Status Perkawinan &amp; Hak Asuh</div>
                                    <div class="text-secondary" style="font-size: 0.75rem;"><i class="bi bi-tag me-1"></i>Sifat: Biasa</div>
                                </td>
                                <td class="pe-4 text-end">
                                    <span class="badge rounded-pill fw-medium px-3 py-1" style="background-color: #DBEAFE; color: #1D4ED8; font-size: 0.74rem;">
                                        <i class="bi bi-envelope me-1"></i>Baru
                                    </span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="card-footer bg-white border-top px-4 py-3 d-flex align-items-center justify-content-between">
                    <span class="text-secondary" style="font-size: 0.78rem;">Menampilkan 5 surat masuk paling mutakhir</span>
                    <a href="#" class="btn btn-sm btn-outline-primary rounded-2 px-3 py-1 fw-medium" style="font-size: 0.78rem;">
                        Lihat Seluruh Surat Masuk <i class="bi bi-arrow-right ms-1"></i>
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
</body>
</html>
