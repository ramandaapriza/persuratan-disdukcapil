<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Disposisi Masuk - Disdukcapil OKI</title>
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
            justify-content: space-between;
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
        .ajudan-tracking-box {
            background-color: #ECFDF5;
            border: 1px solid #A7F3D0;
            border-radius: 0.65rem;
        }
        .unit-option-card {
            border: 1px solid #E5E7EB;
            border-radius: 0.5rem;
            padding: 0.65rem 0.85rem;
            background-color: #F9FAFB;
        }
        .unit-option-card.selected {
            border-color: #2563EB;
            background-color: #EFF6FF;
        }
        .table-disposisi th {
            font-size: 0.72rem;
            font-weight: 600;
            color: #6B7280;
            letter-spacing: 0.04em;
            text-transform: uppercase;
            background-color: #F9FAFB;
            padding: 0.85rem 1rem;
            border-bottom: 1px solid #E5E7EB;
        }
        .table-disposisi td {
            padding: 0.95rem 1rem;
            vertical-align: middle;
            border-bottom: 1px solid #F3F4F6;
            font-size: 0.84rem;
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
            <a href="/kadin" class="nav-link-sidebar">
                <span class="d-flex align-items-center gap-3">
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                </span>
            </a>
            <a href="/kadin/validasi" class="nav-link-sidebar">
                <span class="d-flex align-items-center gap-3">
                    <i class="bi bi-vector-pen"></i>
                    <span>Validasi &amp; TTD</span>
                </span>
                <span class="badge rounded-pill bg-danger" style="font-size: 0.7rem;">10</span>
            </a>
            <a href="/kadin/disposisi" class="nav-link-sidebar active">
                <span class="d-flex align-items-center gap-3">
                    <i class="bi bi-inbox"></i>
                    <span>Disposisi Masuk</span>
                </span>
                <span class="badge rounded-pill bg-warning text-dark fw-bold" style="font-size: 0.7rem;">2</span>
            </a>
            <a href="#" class="nav-link-sidebar">
                <span class="d-flex align-items-center gap-3">
                    <i class="bi bi-journal-bookmark"></i>
                    <span>Buku Besar</span>
                </span>
            </a>
        </div>

        <div class="px-3 py-2 border-top border-secondary border-opacity-25">
            <a href="#" class="nav-link-sidebar text-danger">
                <span class="d-flex align-items-center gap-3">
                    <i class="bi bi-box-arrow-left"></i>
                    <span>Logout</span>
                </span>
            </a>
        </div>

        <div class="p-3 border-top border-secondary border-opacity-25 d-flex align-items-center gap-2" style="background-color: #0B0F19;">
            <div class="rounded-circle bg-primary text-white fw-bold d-flex align-items-center justify-content-center" style="width: 34px; height: 34px; font-size: 0.75rem;">
                KD
            </div>
            <div class="lh-sm">
                <div class="text-white fw-semibold" style="font-size: 0.8rem;">KD - Bapak Kepala Dinas</div>
                <div class="text-secondary" style="font-size: 0.7rem;">Kadin OKI</div>
            </div>
        </div>
    </aside>

    <div class="flex-grow-1 d-flex flex-column min-vh-100" style="margin-left: 250px;">
        <header class="bg-white border-bottom px-4 py-2 d-flex align-items-center justify-content-between sticky-top" style="height: 58px;">
            <div class="small">
                <span class="text-secondary">Disdukcapil OKI</span>
                <span class="text-secondary mx-1">/</span>
                <span class="text-secondary">Disposisi Masuk</span>
                <span class="text-secondary mx-1">/</span>
                <span class="text-primary fw-medium">Lembar Disposisi Pimpinan</span>
            </div>

            <div class="d-flex align-items-center gap-2">
                <div class="border rounded-2 px-3 py-1 bg-light text-secondary d-flex align-items-center gap-2" style="font-size: 0.78rem;">
                    <i class="bi bi-calendar3 text-primary"></i>
                    <span>Kamis, 12 November 2026</span>
                </div>

                <div class="dropdown">
                    <button class="btn btn-sm border rounded-pill px-2 py-1 d-flex align-items-center gap-2 bg-white" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="rounded-circle bg-primary text-white fw-bold d-inline-flex align-items-center justify-content-center" style="width: 24px; height: 24px; font-size: 0.68rem;">KD</span>
                        <span class="text-dark fw-medium" style="font-size: 0.78rem;">KD - Kepala Dinas</span>
                        <i class="bi bi-chevron-down text-secondary" style="font-size: 0.65rem;"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 small">
                        <li><a class="dropdown-item" href="#"><i class="bi bi-person-badge me-2"></i>Profil Pimpinan</a></li>
                        <li><a class="dropdown-item" href="#"><i class="bi bi-shield-lock me-2"></i>Pengaturan Passphrase TTE</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item text-danger" href="#"><i class="bi bi-box-arrow-right me-2"></i>Logout</a></li>
                    </ul>
                </div>
            </div>
        </header>

        <main class="p-4 flex-grow-1">
            <div class="row g-4 mb-4">
                <div class="col-12 col-lg-5">
                    <div class="card border-0 shadow-sm rounded-3 h-100">
                        <div class="card-header bg-white border-bottom px-4 py-3 d-flex align-items-center justify-content-between">
                            <div>
                                <h6 class="fw-bold text-dark mb-0 d-flex align-items-center gap-2">
                                    <i class="bi bi-envelope-open-fill text-primary"></i>
                                    <span>Detail Agenda Surat Masuk</span>
                                </h6>
                                <div class="text-secondary" style="font-size: 0.75rem;">Registrasi Buku Agenda &amp; Pelacakan Ajudan</div>
                            </div>
                            <span class="badge rounded-pill px-3 py-1 fw-semibold" style="background-color: #DBEAFE; color: #1D4ED8; font-size: 0.75rem;">
                                Agenda #0142
                            </span>
                        </div>

                        <div class="card-body p-4 d-flex flex-column justify-content-between">
                            <div>
                                <div class="row g-3 mb-3">
                                    <div class="col-6">
                                        <div class="p-2 px-3 bg-light rounded-2 border">
                                            <div class="text-secondary" style="font-size: 0.72rem;">Nomor Urut Agenda</div>
                                            <div class="fw-bold text-dark fs-6">0142</div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="p-2 px-3 bg-light rounded-2 border">
                                            <div class="text-secondary" style="font-size: 0.72rem;">Tanggal Diterima Disdukcapil</div>
                                            <div class="fw-bold text-dark fs-6">09 Nov 2026</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3 pb-3 border-bottom">
                                    <div class="text-secondary mb-1" style="font-size: 0.75rem;">Pengirim Surat</div>
                                    <div class="fw-bold text-dark" style="font-size: 0.92rem;">Sekretariat Daerah Kab. OKI</div>
                                </div>

                                <div class="row g-3 mb-3 pb-3 border-bottom">
                                    <div class="col-5">
                                        <div class="text-secondary mb-1" style="font-size: 0.75rem;">Tanggal Surat</div>
                                        <div class="fw-semibold text-dark" style="font-size: 0.85rem;">06 Nov 2026</div>
                                    </div>
                                    <div class="col-7">
                                        <div class="text-secondary mb-1" style="font-size: 0.75rem;">Keterangan Nomor Surat</div>
                                        <div class="fw-semibold text-primary" style="font-size: 0.85rem;">005/341/Setda-OKI/2026</div>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <div class="text-secondary mb-1" style="font-size: 0.75rem;">Perihal Surat</div>
                                    <div class="p-3 rounded-2 bg-light border text-dark fw-medium" style="font-size: 0.86rem; line-height: 1.5;">
                                        Permintaan Data Agregat Kependudukan Bersih Semester II
                                    </div>
                                </div>

                                <div class="ajudan-tracking-box p-3 mb-4">
                                    <div class="d-flex align-items-center justify-content-between mb-2">
                                        <span class="fw-bold text-success d-flex align-items-center gap-1" style="font-size: 0.78rem;">
                                            <i class="bi bi-arrow-up-right-circle-fill"></i> Status Kenaikan Surat ke Pimpinan
                                        </span>
                                        <span class="badge rounded-pill bg-success text-white fw-medium px-2 py-1" style="font-size: 0.7rem;">
                                            <i class="bi bi-check2-circle me-1"></i>Diterima Ajudan Kadin
                                        </span>
                                    </div>
                                    <div class="row g-2 pt-1" style="font-size: 0.8rem;">
                                        <div class="col-12 col-sm-6">
                                            <div class="text-secondary" style="font-size: 0.72rem;">Tanggal Menaikkan ke Kadin</div>
                                            <div class="fw-semibold text-dark"><i class="bi bi-clock me-1 text-success"></i>10 Nov 2026, 08:15 WIB</div>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <div class="text-secondary" style="font-size: 0.72rem;">Nama Ajudan Penerima</div>
                                            <div class="fw-semibold text-dark"><i class="bi bi-person-check-fill me-1 text-success"></i>Rizky Pratama, S.IP</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="d-grid">
                                <button type="button" class="btn btn-outline-primary fw-semibold py-2 rounded-2 d-flex align-items-center justify-content-center gap-2" style="font-size: 0.85rem;">
                                    <i class="bi bi-file-earmark-pdf-fill text-danger fs-6"></i>
                                    <span>Lihat Lampiran PDF Surat Masuk</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-7">
                    <div class="card border-0 shadow-sm rounded-3 h-100">
                        <div class="card-header bg-white border-bottom px-4 py-3 d-flex align-items-center justify-content-between">
                            <div>
                                <h6 class="fw-bold text-dark mb-0 d-flex align-items-center gap-2">
                                    <i class="bi bi-send-check-fill text-primary"></i>
                                    <span>Form Instruksi Disposisi Kadin &amp; Penyerahan</span>
                                </h6>
                                <div class="text-secondary" style="font-size: 0.75rem;">Penentuan unit kerja tujuan, sifat disposisi, dan arahan tindak lanjut Kepala Dinas</div>
                            </div>
                            <span class="badge bg-warning bg-opacity-15 text-dark border border-warning-subtle fw-semibold px-2 py-1" style="font-size: 0.72rem;">
                                <i class="bi bi-hourglass-split me-1"></i>Menunggu Disposisi
                            </span>
                        </div>

                        <div class="card-body p-4">
                            <form action="#" method="POST" onsubmit="return false;">
                                <div class="mb-3">
                                    <label class="form-label fw-semibold text-dark small mb-2">
                                        Diserahkan Kepada (Tujuan Disposisi &amp; Kode Klasifikasi Unit) <span class="text-danger">*</span>
                                    </label>
                                    <div class="row g-2">
                                        <div class="col-12 col-md-4">
                                            <label class="unit-option-card selected d-flex align-items-start gap-2 w-100" style="cursor: pointer;">
                                                <input class="form-check-input mt-1" type="radio" name="unit_tujuan" value="400" checked>
                                                <div>
                                                    <div class="fw-bold text-dark" style="font-size: 0.8rem;">Bidang Catatan Sipil</div>
                                                    <span class="badge bg-primary text-white mt-1" style="font-size: 0.68rem;">Kode 400</span>
                                                </div>
                                            </label>
                                        </div>
                                        <div class="col-12 col-md-4">
                                            <label class="unit-option-card d-flex align-items-start gap-2 w-100" style="cursor: pointer;">
                                                <input class="form-check-input mt-1" type="radio" name="unit_tujuan" value="800">
                                                <div>
                                                    <div class="fw-bold text-dark" style="font-size: 0.8rem;">Subbag Kepegawaian &amp; Umum</div>
                                                    <span class="badge bg-secondary text-white mt-1" style="font-size: 0.68rem;">Kode 800</span>
                                                </div>
                                            </label>
                                        </div>
                                        <div class="col-12 col-md-4">
                                            <label class="unit-option-card d-flex align-items-start gap-2 w-100" style="cursor: pointer;">
                                                <input class="form-check-input mt-1" type="radio" name="unit_tujuan" value="00">
                                                <div>
                                                    <div class="fw-bold text-dark" style="font-size: 0.8rem;">Subbag Keuangan</div>
                                                    <span class="badge bg-secondary text-white mt-1" style="font-size: 0.68rem;">Kode 00</span>
                                                </div>
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row g-3 mb-3">
                                    <div class="col-12 col-md-7">
                                        <label for="pegawaiPenerima" class="form-label fw-semibold text-dark small mb-1">
                                            Nama Pegawai Penerima <span class="text-danger">*</span>
                                        </label>
                                        <div class="input-group input-group-sm">
                                            <span class="input-group-text bg-light text-secondary"><i class="bi bi-person-Vcard"></i></span>
                                            <input type="text" id="pegawaiPenerima" class="form-control" value="Drs. H. M. Amin, M.Si (Kabid PiaK &amp; Capil)" placeholder="Masukkan nama pejabat / staf penerima...">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-5">
                                        <label for="tanggalMenerima" class="form-label fw-semibold text-dark small mb-1">
                                            Tanggal Menerima <span class="text-danger">*</span>
                                        </label>
                                        <div class="input-group input-group-sm">
                                            <span class="input-group-text bg-light text-secondary"><i class="bi bi-calendar-event"></i></span>
                                            <input type="date" id="tanggalMenerima" class="form-control" value="2026-11-10">
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
                                                <label class="form-check-label fw-semibold text-danger" for="sifatSegera" style="font-size: 0.78rem;">Segera</label>
                                            </div>
                                            <div class="form-check form-check-inline m-0 border rounded-2 px-2 py-1 bg-light">
                                                <input class="form-check-input" type="radio" name="sifat_disposisi" id="sifatPenting">
                                                <label class="form-check-label fw-medium text-dark" for="sifatPenting" style="font-size: 0.78rem;">Penting</label>
                                            </div>
                                            <div class="form-check form-check-inline m-0 border rounded-2 px-2 py-1 bg-light">
                                                <input class="form-check-input" type="radio" name="sifat_disposisi" id="sifatRahasia">
                                                <label class="form-check-label fw-medium text-dark" for="sifatRahasia" style="font-size: 0.78rem;">Rahasia</label>
                                            </div>
                                            <div class="form-check form-check-inline m-0 border rounded-2 px-2 py-1 bg-light">
                                                <input class="form-check-input" type="radio" name="sifat_disposisi" id="sifatBiasa">
                                                <label class="form-check-label fw-medium text-dark" for="sifatBiasa" style="font-size: 0.78rem;">Biasa</label>
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
                                                    <label class="form-check-label fw-medium text-dark" for="inst1" style="font-size: 0.78rem;">Tindak Lanjuti</label>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-check border rounded-2 px-3 py-1 bg-light">
                                                    <input class="form-check-input" type="checkbox" id="inst2" checked>
                                                    <label class="form-check-label fw-medium text-dark" for="inst2" style="font-size: 0.78rem;">Siapkan Konsep Balasan</label>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-check border rounded-2 px-3 py-1 bg-light">
                                                    <input class="form-check-input" type="checkbox" id="inst3">
                                                    <label class="form-check-label fw-medium text-dark" for="inst3" style="font-size: 0.78rem;">Koordinasikan</label>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-check border rounded-2 px-3 py-1 bg-light">
                                                    <input class="form-check-input" type="checkbox" id="inst4">
                                                    <label class="form-check-label fw-medium text-dark" for="inst4" style="font-size: 0.78rem;">Arsipkan</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label for="catatanKadin" class="form-label fw-semibold text-dark small mb-1">
                                        Catatan / Instruksi Khusus Kepala Dinas
                                    </label>
                                    <textarea id="catatanKadin" class="form-control" rows="3" style="font-size: 0.84rem;" placeholder="Tuliskan arahan spesifik Kepala Dinas kepada unit penerima...">Segera rekapitulasi data DAK2 Semester II yang telah tervalidasi SIAK Terpusat, koordinasikan draf surat pengantar dengan Sekdin sebelum dinaikkan untuk TTE.</textarea>
                                </div>

                                <div class="d-flex flex-wrap align-items-center justify-content-end gap-2 pt-2 border-top">
                                    <button type="button" class="btn btn-outline-secondary fw-medium px-3 py-2 rounded-2 d-inline-flex align-items-center gap-2" style="font-size: 0.84rem;">
                                        <i class="bi bi-printer"></i>
                                        <span>Cetak Lembar Disposisi</span>
                                    </button>
                                    <button type="button" class="btn btn-primary fw-semibold px-4 py-2 rounded-2 d-inline-flex align-items-center gap-2 shadow-sm" style="font-size: 0.84rem;">
                                        <i class="bi bi-send-fill"></i>
                                        <span>Kirim Instruksi Disposisi</span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card border-0 shadow-sm rounded-3">
                <div class="card-header bg-white border-bottom p-3 px-4 d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-2">
                    <div>
                        <h6 class="fw-bold text-dark mb-0">Riwayat Disposisi Surat Masuk</h6>
                        <div class="text-secondary" style="font-size: 0.76rem;">Rekam jejak kenaikan surat melalui ajudan dan penyerahan disposisi ke bidang/subbagian terkait</div>
                    </div>
                    <span class="badge bg-light text-secondary border fw-medium px-3 py-1" style="font-size: 0.75rem;">
                        Buku Kendali Disposisi Kadin
                    </span>
                </div>

                <div class="table-responsive">
                    <table class="table table-disposisi mb-0">
                        <thead>
                            <tr>
                                <th class="ps-4" style="width: 90px;">NO. URUT</th>
                                <th style="width: 260px;">PENGIRIM &amp; NO. SURAT</th>
                                <th style="width: 230px;">TANGGAL NAIK &amp; NAMA AJUDAN</th>
                                <th>DISERAHKAN KEPADA (NAMA &amp; TANGGAL TERIMA)</th>
                                <th class="pe-4 text-end" style="width: 170px;">STATUS DISPOSISI</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="ps-4">
                                    <span class="fw-bold text-dark">#0142</span>
                                    <div class="text-secondary" style="font-size: 0.72rem;">09 Nov 2026</div>
                                </td>
                                <td>
                                    <div class="fw-semibold text-dark">Sekretariat Daerah Kab. OKI</div>
                                    <div class="text-secondary" style="font-size: 0.75rem;">No: 005/341/Setda-OKI/2026</div>
                                </td>
                                <td>
                                    <div class="fw-medium text-dark">10 Nov 2026, 08:15 WIB</div>
                                    <div class="text-secondary" style="font-size: 0.75rem;"><i class="bi bi-person-check text-success me-1"></i>Ajudan: Rizky Pratama, S.IP</div>
                                </td>
                                <td>
                                    <div class="fw-semibold text-primary">Bidang Catatan Sipil (Kode 400)</div>
                                    <div class="text-secondary" style="font-size: 0.75rem;">Penerima: Drs. H. M. Amin, M.Si &bull; 10 Nov 2026</div>
                                </td>
                                <td class="pe-4 text-end">
                                    <span class="badge rounded-pill fw-medium px-3 py-1" style="background-color: #FEF3C7; color: #B45309; font-size: 0.73rem;">
                                        <i class="bi bi-clock-history me-1"></i>Sedang Diproses
                                    </span>
                                </td>
                            </tr>

                            <tr>
                                <td class="ps-4">
                                    <span class="fw-bold text-dark">#0141</span>
                                    <div class="text-secondary" style="font-size: 0.72rem;">08 Nov 2026</div>
                                </td>
                                <td>
                                    <div class="fw-semibold text-dark">BKPSDM Kabupaten OKI</div>
                                    <div class="text-secondary" style="font-size: 0.75rem;">No: 800/512/BKPSDM-II/2026</div>
                                </td>
                                <td>
                                    <div class="fw-medium text-dark">08 Nov 2026, 13:40 WIB</div>
                                    <div class="text-secondary" style="font-size: 0.75rem;"><i class="bi bi-person-check text-success me-1"></i>Ajudan: Rizky Pratama, S.IP</div>
                                </td>
                                <td>
                                    <div class="fw-semibold text-dark">Subbag Kepegawaian &amp; Umum (Kode 800)</div>
                                    <div class="text-secondary" style="font-size: 0.75rem;">Penerima: Hj. Siti Rahmawati, S.Sos &bull; 09 Nov 2026</div>
                                </td>
                                <td class="pe-4 text-end">
                                    <span class="badge rounded-pill fw-medium px-3 py-1" style="background-color: #DCFCE7; color: #15803D; font-size: 0.73rem;">
                                        <i class="bi bi-check-circle me-1"></i>Selesai Ditindaklanjuti
                                    </span>
                                </td>
                            </tr>

                            <tr>
                                <td class="ps-4">
                                    <span class="fw-bold text-dark">#0140</span>
                                    <div class="text-secondary" style="font-size: 0.72rem;">07 Nov 2026</div>
                                </td>
                                <td>
                                    <div class="fw-semibold text-dark">Badan Pengelola Keuangan &amp; Aset Daerah</div>
                                    <div class="text-secondary" style="font-size: 0.75rem;">No: 900/219/BPKAD-OKI/2026</div>
                                </td>
                                <td>
                                    <div class="fw-medium text-dark">07 Nov 2026, 10:20 WIB</div>
                                    <div class="text-secondary" style="font-size: 0.75rem;"><i class="bi bi-person-check text-success me-1"></i>Ajudan: Dedi Kurniawan, A.Md</div>
                                </td>
                                <td>
                                    <div class="fw-semibold text-dark">Subbag Keuangan (Kode 00)</div>
                                    <div class="text-secondary" style="font-size: 0.75rem;">Penerima: Hendri Wijaya, S.E., Ak &bull; 07 Nov 2026</div>
                                </td>
                                <td class="pe-4 text-end">
                                    <span class="badge rounded-pill fw-medium px-3 py-1" style="background-color: #DCFCE7; color: #15803D; font-size: 0.73rem;">
                                        <i class="bi bi-check-circle me-1"></i>Selesai Ditindaklanjuti
                                    </span>
                                </td>
                            </tr>

                            <tr>
                                <td class="ps-4">
                                    <span class="fw-bold text-dark">#0139</span>
                                    <div class="text-secondary" style="font-size: 0.72rem;">06 Nov 2026</div>
                                </td>
                                <td>
                                    <div class="fw-semibold text-dark">Pengadilan Agama Kayuagung</div>
                                    <div class="text-secondary" style="font-size: 0.75rem;">No: W6-A4/892/HK.05/XI/2026</div>
                                </td>
                                <td>
                                    <div class="fw-medium text-dark">06 Nov 2026, 14:05 WIB</div>
                                    <div class="text-secondary" style="font-size: 0.75rem;"><i class="bi bi-person-check text-success me-1"></i>Ajudan: Dedi Kurniawan, A.Md</div>
                                </td>
                                <td>
                                    <div class="fw-semibold text-dark">Bidang Catatan Sipil (Kode 400)</div>
                                    <div class="text-secondary" style="font-size: 0.75rem;">Penerima: Dewi Sartika, S.H. &bull; 06 Nov 2026</div>
                                </td>
                                <td class="pe-4 text-end">
                                    <span class="badge rounded-pill fw-medium px-3 py-1" style="background-color: #DBEAFE; color: #1D4ED8; font-size: 0.73rem;">
                                        <i class="bi bi-archive me-1"></i>Diarsipkan Unit
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
