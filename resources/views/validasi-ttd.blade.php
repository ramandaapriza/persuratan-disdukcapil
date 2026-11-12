<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validasi &amp; TTD Elektronik - Disdukcapil OKI</title>
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
        .a4-paper {
            background-color: #FFFFFF;
            padding: 2.75rem 3rem;
            min-height: 840px;
            border: 1px solid #E5E7EB;
            font-family: 'Times New Roman', Times, serif;
            color: #000000;
            line-height: 1.6;
        }
        .kop-line {
            border-top: 3px solid #000000;
            border-bottom: 1px solid #000000;
            height: 6px;
            margin-top: 0.5rem;
            margin-bottom: 1.5rem;
        }
        .tte-placeholder {
            border: 2px dashed #2563EB;
            background-color: #EFF6FF;
            border-radius: 0.65rem;
            padding: 1rem;
            font-family: 'Inter', sans-serif;
        }
        .timeline-step {
            position: relative;
            padding-left: 2.5rem;
            padding-bottom: 1.35rem;
        }
        .timeline-step:last-child {
            padding-bottom: 0;
        }
        .timeline-step::before {
            content: '';
            position: absolute;
            left: 13px;
            top: 26px;
            bottom: 0;
            width: 2px;
            background-color: #E5E7EB;
        }
        .timeline-step:last-child::before {
            display: none;
        }
        .timeline-dot {
            position: absolute;
            left: 0;
            top: 2px;
            width: 28px;
            height: 28px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
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
            <a href="/kadin" class="nav-link-sidebar">
                <span class="d-flex align-items-center gap-3">
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                </span>
            </a>
            <a href="/kadin/validasi" class="nav-link-sidebar active">
                <span class="d-flex align-items-center gap-3">
                    <i class="bi bi-vector-pen"></i>
                    <span>Validasi &amp; TTD</span>
                </span>
                <span class="badge rounded-pill bg-danger" style="font-size: 0.7rem;">10</span>
            </a>
            <a href="#" class="nav-link-sidebar">
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
                <div class="text-white fw-semibold" style="font-size: 0.8rem;">Bapak Kepala Dinas</div>
                <div class="text-secondary" style="font-size: 0.7rem;">Kadin OKI</div>
            </div>
        </div>
    </aside>

    <div class="flex-grow-1 d-flex flex-column min-vh-100" style="margin-left: 250px;">
        <header class="bg-white border-bottom px-4 py-2 d-flex align-items-center justify-content-between sticky-top" style="height: 58px;">
            <div class="small">
                <span class="text-secondary">Disdukcapil OKI</span>
                <span class="text-secondary mx-1">/</span>
                <span class="text-secondary">Validasi &amp; TTD</span>
                <span class="text-secondary mx-1">/</span>
                <span class="text-primary fw-medium">Detail Dokumen</span>
            </div>

            <div class="d-flex align-items-center gap-2">
                <div class="border rounded-2 px-3 py-1 bg-light text-secondary d-flex align-items-center gap-2" style="font-size: 0.78rem;">
                    <i class="bi bi-calendar3 text-primary"></i>
                    <span>Selasa, 10 November 2026</span>
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
            <div class="bg-white border rounded-3 p-3 px-4 mb-4 shadow-sm d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
                <div>
                    <div class="d-flex align-items-center gap-2 mb-1">
                        <span class="badge rounded-pill fw-medium px-2 py-1" style="background-color: #DBEAFE; color: #1D4ED8; font-size: 0.72rem;">
                            <i class="bi bi-send-fill me-1"></i>Surat Keluar Dinas
                        </span>
                        <span class="text-secondary small">Disdukcapil OKI / Validasi &amp; TTD / <strong class="text-dark">Detail Dokumen</strong></span>
                    </div>
                    <h5 class="fw-bold text-dark mb-0">Pratinjau &amp; Otorisasi Tanda Tangan Elektronik (TTE)</h5>
                </div>
                <a href="/kadin" class="btn btn-outline-secondary btn-sm fw-medium px-3 py-2 rounded-2 d-inline-flex align-items-center gap-2">
                    <i class="bi bi-arrow-left"></i> Kembali ke Antrean
                </a>
            </div>

            <div class="row g-4">
                <div class="col-12 col-lg-7">
                    <div class="card border-0 shadow-sm rounded-3 overflow-hidden">
                        <div class="card-header bg-white border-bottom px-4 py-2 d-flex align-items-center justify-content-between" style="font-family: 'Inter', sans-serif;">
                            <span class="small fw-semibold text-secondary">
                                <i class="bi bi-file-earmark-pdf text-danger me-1"></i> Pratinjau Lembar Naskah Dinas (A4)
                            </span>
                            <span class="badge bg-light text-secondary border fw-normal">Halaman 1 dari 1</span>
                        </div>
                        <div class="card-body p-3 p-md-4 bg-secondary bg-opacity-10">
                            <div class="a4-paper rounded-2 shadow-sm mx-auto">
                                <div class="d-flex align-items-center gap-3 text-center">
                                    <div class="d-flex align-items-center justify-content-center flex-shrink-0" style="width: 68px; height: 76px;">
                                        <div class="border border-2 border-dark rounded-3 d-flex align-items-center justify-content-center w-100 h-100 bg-light">
                                            <i class="bi bi-shield-shaded fs-1 text-dark"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1">
                                        <div class="fw-bold" style="font-size: 1rem; letter-spacing: 0.03em;">PEMERINTAH KABUPATEN OGAN KOMERING ILIR</div>
                                        <div class="fw-bold" style="font-size: 1.18rem; letter-spacing: 0.02em;">DINAS KEPENDUDUKAN DAN PENCATATAN SIPIL</div>
                                        <div style="font-size: 0.78rem;">Jl. Letnan Muchtar Saleh No. 01, Kayuagung, Kab. Ogan Komering Ilir, Sumatera Selatan 30611</div>
                                        <div style="font-size: 0.75rem;">Telepon: (0712) 321456 &bull; Pos-el: disdukcapil@kaboki.go.id &bull; Laman: capil.kaboki.go.id</div>
                                    </div>
                                </div>

                                <div class="kop-line"></div>

                                <div class="d-flex justify-content-between align-items-start mb-4" style="font-size: 0.92rem;">
                                    <table class="table table-borderless table-sm mb-0" style="width: auto; font-size: 0.92rem;">
                                        <tbody>
                                            <tr>
                                                <td class="p-0 pe-3">Nomor</td>
                                                <td class="p-0 pe-2">:</td>
                                                <td class="p-0 fw-semibold">470/189/Disdukcapil-OKI/XI/2026</td>
                                            </tr>
                                            <tr>
                                                <td class="p-0 pe-3">Sifat</td>
                                                <td class="p-0 pe-2">:</td>
                                                <td class="p-0">Penting</td>
                                            </tr>
                                            <tr>
                                                <td class="p-0 pe-3">Lampiran</td>
                                                <td class="p-0 pe-2">:</td>
                                                <td class="p-0">1 (Satu) Berkas</td>
                                            </tr>
                                            <tr>
                                                <td class="p-0 pe-3">Perihal</td>
                                                <td class="p-0 pe-2">:</td>
                                                <td class="p-0 fw-bold text-decoration-underline">Koordinasi Integrasi SIAK Terpusat</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div class="text-end">
                                        <div>Kayuagung, 10 November 2026</div>
                                    </div>
                                </div>

                                <div class="mb-4" style="font-size: 0.92rem;">
                                    <div>Kepada Yth.</div>
                                    <div class="fw-bold">Kepala Dinas Komunikasi dan Informatika</div>
                                    <div class="fw-bold">Kabupaten Ogan Komering Ilir</div>
                                    <div>di -</div>
                                    <div class="ps-4 fw-semibold">Kayuagung</div>
                                </div>

                                <div style="font-size: 0.93rem; text-align: justify;">
                                    <p class="mb-3" style="text-indent: 2.25rem;">
                                        Sehubungan dengan percepatan transformasi layanan pemerintahan berbasis digital serta tindak lanjut Peraturan Menteri Dalam Negeri tentang Sistem Informasi Administrasi Kependudukan (SIAK) Terpusat, bersama ini kami sampaikan bahwa Dinas Kependudukan dan Pencatatan Sipil Kabupaten Ogan Komering Ilir telah menyelesaikan penyesuaian skema hak akses dan jaringan komunikasi data antarpelayanan perangkat daerah.
                                    </p>
                                    <p class="mb-4" style="text-indent: 2.25rem;">
                                        Berkenaan dengan hal tersebut, kami mengharapkan dukungan dan koordinasi teknis dari Dinas Komunikasi dan Informatika Kabupaten Ogan Komering Ilir terkait sinkronisasi <em>endpoint</em> API SIAK Terpusat dengan Portal Satu Data Kabupaten Ogan Komering Ilir. Demikian surat ini kami sampaikan, atas perhatian dan kerja sama yang baik diucapkan terima kasih.
                                    </p>
                                </div>

                                <div class="row justify-content-end mt-5">
                                    <div class="col-12 col-sm-7 text-center">
                                        <div class="fw-bold mb-2" style="font-size: 0.92rem;">KEPALA DINAS KEPENDUDUKAN DAN<br>PENCATATAN SIPIL KABUPATEN OKI,</div>

                                        <div class="tte-placeholder my-2 d-flex align-items-center gap-3 text-start">
                                            <div class="bg-white border border-primary border-opacity-25 rounded-2 p-2 d-flex align-items-center justify-content-center flex-shrink-0">
                                                <i class="bi bi-qr-code text-primary" style="font-size: 2.6rem; line-height: 1;"></i>
                                            </div>
                                            <div>
                                                <div class="badge bg-primary mb-1" style="font-size: 0.65rem;">BSrE - BSSN</div>
                                                <div class="fw-bold text-primary" style="font-size: 0.78rem; line-height: 1.3;">
                                                    Area Tanda Tangan Elektronik (Menunggu Validasi Kadin)
                                                </div>
                                                <div class="text-secondary" style="font-size: 0.68rem;">QR Code akan terbit otomatis setelah otorisasi</div>
                                            </div>
                                        </div>

                                        <div class="fw-bold text-decoration-underline mt-2" style="font-size: 0.92rem;">Drs. H. HENDRA SURYADI, M.Si</div>
                                        <div style="font-size: 0.85rem;">Pembina Utama Muda (IV/c)</div>
                                        <div style="font-size: 0.85rem;">NIP. 19710814 199803 1 004</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-5">
                    <div class="card border-0 shadow-sm rounded-3 mb-4">
                        <div class="card-header bg-white border-bottom px-4 py-3">
                            <h6 class="fw-bold text-dark mb-0 d-flex align-items-center gap-2">
                                <i class="bi bi-diagram-3-fill text-primary"></i>
                                <span>Timeline Verifikasi Berjenjang</span>
                            </h6>
                            <div class="text-secondary" style="font-size: 0.76rem;">Riwayat persetujuan naskah dinas dari tingkat penyusun hingga pimpinan</div>
                        </div>
                        <div class="card-body p-4">
                            <div class="timeline-step">
                                <div class="timeline-dot" style="background-color: #DCFCE7; color: #16A34A;">
                                    <i class="bi bi-check-circle-fill"></i>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="fw-bold text-dark" style="font-size: 0.85rem;">Staf Subbag Umpeg</span>
                                    <span class="badge rounded-pill bg-success bg-opacity-10 text-success" style="font-size: 0.68rem;">Selesai</span>
                                </div>
                                <div class="text-secondary" style="font-size: 0.8rem;">Konsep Surat Diajukan</div>
                                <div class="text-secondary mt-1" style="font-size: 0.72rem;"><i class="bi bi-clock me-1"></i>10 Nov 2026, 08:30 WIB</div>
                            </div>

                            <div class="timeline-step">
                                <div class="timeline-dot" style="background-color: #DCFCE7; color: #16A34A;">
                                    <i class="bi bi-check-circle-fill"></i>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="fw-bold text-dark" style="font-size: 0.85rem;">Kasubbag Umpeg</span>
                                    <span class="badge rounded-pill bg-success bg-opacity-10 text-success" style="font-size: 0.68rem;">Terverifikasi</span>
                                </div>
                                <div class="text-secondary" style="font-size: 0.8rem;">Diverifikasi &amp; Disetujui</div>
                                <div class="text-secondary mt-1" style="font-size: 0.72rem;"><i class="bi bi-clock me-1"></i>10 Nov 2026, 09:15 WIB</div>
                            </div>

                            <div class="timeline-step">
                                <div class="timeline-dot" style="background-color: #DCFCE7; color: #16A34A;">
                                    <i class="bi bi-check-circle-fill"></i>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="fw-bold text-dark" style="font-size: 0.85rem;">Sekretaris Dinas / Sekdin</span>
                                    <span class="badge rounded-pill bg-success bg-opacity-10 text-success" style="font-size: 0.68rem;">Diparaf</span>
                                </div>
                                <div class="text-secondary" style="font-size: 0.8rem;">Diparaf &amp; Diteruskan ke Kadin</div>
                                <div class="text-secondary mt-1" style="font-size: 0.72rem;"><i class="bi bi-clock me-1"></i>10 Nov 2026, 10:00 WIB</div>
                            </div>

                            <div class="timeline-step">
                                <div class="timeline-dot" style="background-color: #FEF3C7; color: #D97706; border: 2px solid #F59E0B;">
                                    <i class="bi bi-hourglass-split"></i>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="fw-bold text-dark" style="font-size: 0.85rem;">Kepala Dinas</span>
                                    <span class="badge rounded-pill bg-warning text-dark fw-semibold" style="font-size: 0.68rem;">Status Aktif</span>
                                </div>
                                <div class="fw-medium" style="font-size: 0.8rem; color: #B45309;">Menunggu Tanda Tangan Online</div>
                                <div class="text-secondary mt-1" style="font-size: 0.72rem;"><i class="bi bi-shield-check me-1"></i>Siap dieksekusi dengan Passphrase TTE</div>
                            </div>
                        </div>
                    </div>

                    <div class="card border-0 shadow-sm rounded-3">
                        <div class="card-header bg-white border-bottom px-4 py-3">
                            <h6 class="fw-bold text-dark mb-0 d-flex align-items-center gap-2">
                                <i class="bi bi-shield-lock-fill text-success"></i>
                                <span>Form Otentikasi &amp; Eksekusi TTD Online</span>
                            </h6>
                            <div class="text-secondary" style="font-size: 0.76rem;">Masukkan Passphrase BSrE untuk membubuhkan QR Code TTE resmi</div>
                        </div>
                        <div class="card-body p-4">
                            <form action="#" method="POST" onsubmit="return false;">
                                <div class="mb-3">
                                    <label for="passphraseInput" class="form-label fw-semibold text-dark small mb-1">
                                        Passphrase / PIN Keamanan TTE <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light text-secondary">
                                            <i class="bi bi-lock-fill"></i>
                                        </span>
                                        <input type="password" id="passphraseInput" class="form-control" placeholder="Masukkan Passphrase atau PIN TTE Anda..." value="••••••••••••">
                                    </div>
                                    <div class="form-text" style="font-size: 0.72rem;">
                                        <i class="bi bi-info-circle me-1"></i>Otentikasi dienkripsi secara langsung melalui modul sertifikat elektronik BSrE.
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label for="catatanInput" class="form-label fw-semibold text-dark small mb-1">
                                        Catatan / Koreksi Pimpinan (Opsional)
                                    </label>
                                    <textarea id="catatanInput" class="form-control" rows="3" placeholder="Tambahkan arahan atau catatan revisi apabila surat perlu diperbaiki..."></textarea>
                                </div>

                                <div class="d-grid gap-2">
                                    <button type="button" class="btn btn-success btn-lg fw-semibold py-2 px-3 rounded-2 d-flex align-items-center justify-content-center gap-2 shadow-sm" style="font-size: 0.92rem;">
                                        <i class="bi bi-qr-code-scan"></i>
                                        <span>Sah &amp; Bubuhkan Tanda Tangan (QR Code)</span>
                                    </button>
                                    <button type="button" class="btn btn-outline-danger fw-medium py-2 px-3 rounded-2 d-flex align-items-center justify-content-center gap-2" style="font-size: 0.85rem;">
                                        <i class="bi bi-arrow-counterclockwise"></i>
                                        <span>Kembalikan untuk Revisi</span>
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
