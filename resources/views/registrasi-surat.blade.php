<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi Naskah Dinas - Disdukcapil OKI</title>
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
        .nav-pills-custom .nav-link {
            color: #4B5563;
            background-color: #FFFFFF;
            border: 1px solid #E5E7EB;
            font-size: 0.85rem;
            font-weight: 600;
            padding: 0.65rem 1.25rem;
            border-radius: 0.5rem;
        }
        .nav-pills-custom .nav-link.active {
            background-color: #2563EB;
            color: #FFFFFF;
            border-color: #2563EB;
            box-shadow: 0 2px 6px rgba(37, 99, 235, 0.25);
        }
        .upload-dropzone {
            border: 2px dashed #CBD5E1;
            background-color: #F8FAFC;
            border-radius: 0.65rem;
            padding: 1.15rem;
            text-align: center;
        }
        .hierarchy-flow-box {
            background-color: #F8FAFC;
            border: 1px solid #E2E8F0;
            border-radius: 0.65rem;
            padding: 0.9rem 1rem;
        }
        .step-pill {
            background-color: #FFFFFF;
            border: 1px solid #CBD5E1;
            border-radius: 0.5rem;
            padding: 0.45rem 0.7rem;
            font-size: 0.75rem;
            font-weight: 600;
            color: #1E293B;
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
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
            <a href="/registrasi-surat" class="nav-link-sidebar active">
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
                <span class="text-secondary">Surat Keluar &amp; SPPD</span>
                <span class="text-secondary mx-1">/</span>
                <span class="text-primary fw-medium">Registrasi Naskah Dinas</span>
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
                        <li><a class="dropdown-item" href="#"><i class="bi bi-person me-2"></i>Profil Operator</a></li>
                        <li><a class="dropdown-item" href="#"><i class="bi bi-gear me-2"></i>Pengaturan Penomoran</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item text-danger" href="#"><i class="bi bi-box-arrow-right me-2"></i>Logout</a></li>
                    </ul>
                </div>
            </div>
        </header>

        <main class="p-4 flex-grow-1">
            <div class="d-flex flex-column flex-lg-row align-items-lg-center justify-content-between gap-3 mb-4">
                <div>
                    <h5 class="fw-bold text-dark mb-1">Registrasi &amp; Penomoran Otomatis Naskah Dinas</h5>
                    <div class="text-secondary" style="font-size: 0.8rem;">Pencatatan buku agenda surat keluar dan penerbitan SPPD terintegrasi alur verifikasi berjenjang.</div>
                </div>

                <ul class="nav nav-pills nav-pills-custom gap-2">
                    <li class="nav-item">
                        <a class="nav-link active d-inline-flex align-items-center gap-2" href="#panel-surat-keluar">
                            <i class="bi bi-send-fill"></i>
                            <span>Tab 1: Form Surat Keluar</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link d-inline-flex align-items-center gap-2" href="#panel-sppd">
                            <i class="bi bi-briefcase-fill text-primary"></i>
                            <span>Tab 2: Form Perjalanan Dinas (SPPD)</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link d-inline-flex align-items-center gap-2" href="#panel-berita-acara">
                            <i class="bi bi-file-earmark-text-fill text-secondary"></i>
                            <span>Tab 3: Form Berita Acara</span>
                        </a>
                    </li>
                </ul>
            </div>

            <div class="row g-4">
                <div class="col-12 col-xl-6" id="panel-surat-keluar">
                    <div class="card border-0 shadow-sm rounded-3 h-100">
                        <div class="card-header bg-white border-bottom px-4 py-3 d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center gap-2">
                                <span class="rounded-2 bg-primary bg-opacity-10 text-primary d-inline-flex align-items-center justify-content-center" style="width: 34px; height: 34px;">
                                    <i class="bi bi-send-plus-fill"></i>
                                </span>
                                <div>
                                    <h6 class="fw-bold text-dark mb-0">Panel 1: Formulir Input Surat Keluar</h6>
                                    <div class="text-secondary" style="font-size: 0.74rem;">Aturan Penomoran Resmi Disdukcapil Kabupaten OKI</div>
                                </div>
                            </div>
                            <span class="badge rounded-pill bg-primary bg-opacity-10 text-primary fw-semibold px-3 py-1" style="font-size: 0.72rem;">
                                Naskah Keluar
                            </span>
                        </div>

                        <div class="card-body p-4">
                            <div class="alert alert-primary border-primary border-opacity-25 rounded-3 p-3 mb-4 d-flex align-items-center justify-content-between" style="background-color: #EFF6FF;">
                                <div>
                                    <div class="text-primary fw-semibold d-flex align-items-center gap-1" style="font-size: 0.75rem;">
                                        <i class="bi bi-magic"></i> Pratinjau Nomor Surat Otomatis
                                    </div>
                                    <div class="fs-5 fw-bold text-dark my-1" style="letter-spacing: 0.02em;">400/2763/disdukcapil/2026</div>
                                    <div class="text-secondary" style="font-size: 0.72rem;">Format: <strong>Kode Bidang / Nomor Urut / Nama Dinas / Tahun</strong></div>
                                </div>
                                <span class="badge bg-primary text-white px-2 py-1" style="font-size: 0.7rem;">Auto-Generate</span>
                            </div>

                            <form action="#" method="POST" onsubmit="return false;">
                                <div class="row g-3 mb-3">
                                    <div class="col-12 col-sm-4">
                                        <label for="nomorUrutKeluar" class="form-label fw-semibold text-dark small mb-1">
                                            Nomor Urut <span class="text-danger">*</span>
                                        </label>
                                        <div class="input-group input-group-sm">
                                            <span class="input-group-text bg-light text-secondary"><i class="bi bi-hash"></i></span>
                                            <input type="number" id="nomorUrutKeluar" class="form-control fw-bold text-primary" value="2763">
                                        </div>
                                        <div class="form-text" style="font-size: 0.68rem;">Urutan agenda otomatis</div>
                                    </div>

                                    <div class="col-12 col-sm-8">
                                        <label for="kodeBidangSelect" class="form-label fw-semibold text-dark small mb-1">
                                            Pilihan Kode Bidang Klasifikasi <span class="text-danger">*</span>
                                        </label>
                                        <select id="kodeBidangSelect" class="form-select form-select-sm fw-medium">
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
                                        <input type="date" id="tglDikeluarkan" class="form-control form-control-sm" value="2026-11-12">
                                    </div>

                                    <div class="col-12 col-sm-7">
                                        <label for="ketNomorSurat" class="form-label fw-semibold text-dark small mb-1">
                                            Keterangan Nomor Surat (Otomatis)
                                        </label>
                                        <input type="text" id="ketNomorSurat" class="form-control form-control-sm bg-light fw-semibold text-dark" value="400/2763/disdukcapil/2026" readonly>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="alamatDituju" class="form-label fw-semibold text-dark small mb-1">
                                        Alamat yang Dituju <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-text bg-light text-secondary"><i class="bi bi-building"></i></span>
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
                                        <i class="bi bi-cloud-arrow-up-fill text-primary fs-4 d-block mb-1"></i>
                                        <div class="fw-semibold text-dark" style="font-size: 0.8rem;">Pilih berkas konsep naskah dinas atau seret ke sini</div>
                                        <div class="text-secondary mb-2" style="font-size: 0.72rem;">Format didukung: .PDF, .DOCX (Maks. 5 MB)</div>
                                        <input type="file" class="form-control form-control-sm" accept=".pdf,.doc,.docx">
                                    </div>
                                </div>

                                <div class="hierarchy-flow-box mb-4">
                                    <div class="fw-bold text-dark mb-2 d-flex align-items-center gap-1" style="font-size: 0.76rem;">
                                        <i class="bi bi-diagram-3-fill text-primary"></i>
                                        <span>Alur Pengiriman &amp; Verifikasi Hierarki Berjenjang:</span>
                                    </div>
                                    <div class="d-flex flex-wrap align-items-center gap-2">
                                        <span class="step-pill">
                                            <span class="badge rounded-circle bg-primary text-white">1</span>
                                            <span>Kasubbag Umpeg <small class="text-secondary fw-normal">(Verifikasi 1)</small></span>
                                        </span>
                                        <i class="bi bi-arrow-right text-secondary small"></i>
                                        <span class="step-pill">
                                            <span class="badge rounded-circle bg-primary text-white">2</span>
                                            <span>Sekretaris Dinas <small class="text-secondary fw-normal">(Verifikasi 2)</small></span>
                                        </span>
                                        <i class="bi bi-arrow-right text-secondary small"></i>
                                        <span class="step-pill" style="border-color: #16A34A; background-color: #F0FDF4;">
                                            <i class="bi bi-qr-code text-success"></i>
                                            <span class="text-success">Kepala Dinas <small class="fw-normal">(Validasi TTE QR Code)</small></span>
                                        </span>
                                    </div>
                                </div>

                                <div class="d-grid">
                                    <button type="button" class="btn btn-primary fw-semibold py-2 rounded-2 d-flex align-items-center justify-content-center gap-2 shadow-sm" style="font-size: 0.88rem;">
                                        <i class="bi bi-send-check-fill"></i>
                                        <span>Simpan &amp; Ajukan ke Kasubbag Umpeg</span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-xl-6" id="panel-sppd">
                    <div class="card border-0 shadow-sm rounded-3 h-100">
                        <div class="card-header bg-white border-bottom px-4 py-3 d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center gap-2">
                                <span class="rounded-2 bg-warning bg-opacity-15 text-warning d-inline-flex align-items-center justify-content-center" style="width: 34px; height: 34px;">
                                    <i class="bi bi-briefcase-fill text-dark"></i>
                                </span>
                                <div>
                                    <h6 class="fw-bold text-dark mb-0">Panel 2: Formulir Input SPPD</h6>
                                    <div class="text-secondary" style="font-size: 0.74rem;">Surat Perintah Perjalanan Dinas Pegawai Disdukcapil OKI</div>
                                </div>
                            </div>
                            <span class="badge rounded-pill fw-semibold px-3 py-1" style="background-color: #FEF3C7; color: #B45309; font-size: 0.72rem;">
                                Form SPPD
                            </span>
                        </div>

                        <div class="card-body p-4 d-flex flex-column justify-content-between">
                            <form action="#" method="POST" onsubmit="return false;">
                                <div class="alert border rounded-3 p-3 mb-4 d-flex align-items-center justify-content-between" style="background-color: #FFFBEB; border-color: #FDE68A !important;">
                                    <div>
                                        <div class="fw-semibold d-flex align-items-center gap-1" style="font-size: 0.75rem; color: #B45309;">
                                            <i class="bi bi-geo-alt-fill"></i> Registrasi Buku Agenda Perjalanan Dinas
                                        </div>
                                        <div class="fw-bold text-dark my-1" style="font-size: 0.95rem;">Nomor Agenda SPPD: 090/091/SPPD/DUKCAPIL/2026</div>
                                        <div class="text-secondary" style="font-size: 0.72rem;">Otomatis terhubung dengan Lembar Surat Tugas &amp; Visum SPPD</div>
                                    </div>
                                    <i class="bi bi-journal-check fs-3" style="color: #D97706;"></i>
                                </div>

                                <div class="row g-3 mb-3">
                                    <div class="col-12 col-sm-6">
                                        <label for="noUrutSppd" class="form-label fw-semibold text-dark small mb-1">
                                            Nomor Urut SPPD <span class="text-danger">*</span>
                                        </label>
                                        <div class="input-group input-group-sm">
                                            <span class="input-group-text bg-light text-secondary"><i class="bi bi-hash"></i></span>
                                            <input type="text" id="noUrutSppd" class="form-control fw-bold text-dark" value="091 / SPPD / XI / 2026">
                                        </div>
                                    </div>

                                    <div class="col-12 col-sm-6">
                                        <label for="tglDibuatSppd" class="form-label fw-semibold text-dark small mb-1">
                                            Tanggal Dibuatnya Surat <span class="text-danger">*</span>
                                        </label>
                                        <input type="date" id="tglDibuatSppd" class="form-control form-control-sm" value="2026-11-12">
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="namaPegawaiSppd" class="form-label fw-semibold text-dark small mb-1">
                                        Nama Pegawai yang Diperintahkan <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-text bg-light text-secondary"><i class="bi bi-person-badge-fill"></i></span>
                                        <input type="text" id="namaPegawaiSppd" class="form-control" value="Drs. H. Ahmad Fauzi, M.Si (NIP. 19750412 200003 1 002)" placeholder="Cari atau pilih nama pegawai ASN...">
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="jabatanPegawaiSppd" class="form-label fw-semibold text-dark small mb-1">
                                        Jabatan yang Diperintahkan <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-text bg-light text-secondary"><i class="bi bi-award-fill"></i></span>
                                        <input type="text" id="jabatanPegawaiSppd" class="form-control" value="Kepala Bidang Pelayanan Pendaftaran Penduduk" placeholder="Masukkan jabatan struktural / fungsional...">
                                    </div>
                                </div>

                                <div class="row g-3 mb-3">
                                    <div class="col-12 col-sm-6">
                                        <label for="tglBerangkatSppd" class="form-label fw-semibold text-dark small mb-1">
                                            Tanggal Berangkat <span class="text-danger">*</span>
                                        </label>
                                        <div class="input-group input-group-sm">
                                            <span class="input-group-text bg-light text-secondary"><i class="bi bi-calendar-check"></i></span>
                                            <input type="date" id="tglBerangkatSppd" class="form-control" value="2026-11-15">
                                        </div>
                                    </div>

                                    <div class="col-12 col-sm-6">
                                        <label for="tglKembaliSppd" class="form-label fw-semibold text-dark small mb-1">
                                            Tanggal Kembali <span class="text-danger">*</span>
                                        </label>
                                        <div class="input-group input-group-sm">
                                            <span class="input-group-text bg-light text-secondary"><i class="bi bi-calendar-range"></i></span>
                                            <input type="date" id="tglKembaliSppd" class="form-control" value="2026-11-17">
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="daerahTujuanSppd" class="form-label fw-semibold text-dark small mb-1">
                                        Daerah Tujuan <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-text bg-light text-secondary"><i class="bi bi-pin-map-fill"></i></span>
                                        <input type="text" id="daerahTujuanSppd" class="form-control" value="Kantor Dinas Dukcapil Provinsi Sumatera Selatan - Palembang" placeholder="Masukkan kota / kecamatan / instansi tujuan...">
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label for="urusanSppd" class="form-label fw-semibold text-dark small mb-1">
                                        Urusan / Tujuan Melakukan Perjalanan Dinas <span class="text-danger">*</span>
                                    </label>
                                    <textarea id="urusanSppd" class="form-control form-control-sm" rows="4" placeholder="Jelaskan maksud dan rincian tugas perjalanan dinas...">Menghadiri Rapat Koordinasi Teknis Pemutakhiran Data Kependudukan Semester II serta Rekonsiliasi Blangko KTP Elektronik Tingkat Provinsi Sumatera Selatan Tahun 2026.</textarea>
                                </div>

                                <div class="hierarchy-flow-box mb-4">
                                    <div class="d-flex align-items-center justify-content-between" style="font-size: 0.76rem;">
                                        <span class="fw-semibold text-secondary">
                                            <i class="bi bi-shield-check text-success me-1"></i>Otorisasi SPPD: <strong>Kasubbag Umpeg &rarr; Sekdin &rarr; TTE Kadin</strong>
                                        </span>
                                        <span class="badge bg-success bg-opacity-10 text-success">Siap Diajukan</span>
                                    </div>
                                </div>

                                <div class="d-grid">
                                    <button type="button" class="btn btn-dark fw-semibold py-2 rounded-2 d-flex align-items-center justify-content-center gap-2 shadow-sm" style="background-color: #1E3A8A; border-color: #1E3A8A; font-size: 0.88rem;">
                                        <i class="bi bi-file-earmark-check-fill"></i>
                                        <span>Simpan &amp; Ajukan SPPD ke Hierarki Pimpinan</span>
                                    </button>
                                </div>
                            </form>
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
