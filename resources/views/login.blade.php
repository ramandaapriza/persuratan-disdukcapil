<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autentikasi Pegawai - E-Surat Disdukcapil OKI</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #FFFFFF;
            color: #1F2937;
        }
        .branding-panel {
            background: linear-gradient(155deg, #0b2e59 0%, #142d63 50%, #1e3a8a 100%);
            color: #FFFFFF;
        }
        .security-info-box {
            background-color: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.16);
            border-radius: 0.85rem;
            padding: 1.25rem;
        }
        .security-badge-item {
            background-color: rgba(15, 23, 42, 0.35);
            border: 1px solid rgba(147, 197, 253, 0.2);
            border-radius: 0.65rem;
            padding: 0.85rem 1rem;
        }
        .restricted-alert {
            background-color: #F1F5F9;
            border: 1px solid #CBD5E1;
            border-radius: 0.65rem;
            color: #334155;
        }
    </style>
</head>
<body>

<div class="container-fluid p-0">
    <div class="row g-0 min-vh-100">
        <div class="col-12 col-lg-5 branding-panel p-4 p-xl-5 d-flex flex-column justify-content-between">
            <div>
                <div class="d-flex align-items-center gap-3 pb-4 border-bottom border-white border-opacity-10">
                    <div class="d-flex align-items-center gap-2 flex-shrink-0">
                        <div class="rounded-3 bg-white bg-opacity-10 border border-white border-opacity-25 d-flex align-items-center justify-content-center" style="width: 46px; height: 46px;">
                            <i class="bi bi-shield-shaded fs-4 text-warning"></i>
                        </div>
                        <div class="rounded-3 bg-primary d-flex align-items-center justify-content-center shadow-sm" style="width: 46px; height: 46px;">
                            <i class="bi bi-envelope-paper-fill fs-4 text-white"></i>
                        </div>
                    </div>
                    <div>
                        <div class="fw-bold text-white" style="font-size: 0.85rem; letter-spacing: 0.03em; line-height: 1.35;">
                            DINAS KEPENDUDUKAN DAN PENCATATAN SIPIL<br>
                            KABUPATEN OGAN KOMERING ILIR (OKI)
                        </div>
                    </div>
                </div>

                <div class="mt-4 pt-2">
                    <span class="badge rounded-pill px-3 py-1 mb-3 fw-medium d-inline-flex align-items-center gap-1" style="background-color: rgba(59, 130, 246, 0.25); color: #93C5FD; border: 1px solid rgba(147, 197, 253, 0.3); font-size: 0.74rem;">
                        <i class="bi bi-lock-fill"></i> Single Gate Government Authentication
                    </span>
                    <h2 class="fw-bold text-white mb-3" style="font-size: 1.7rem; line-height: 1.35; letter-spacing: -0.01em;">
                        Sistem Informasi Pengelolaan Persuratan &amp; Berita Acara (E-Surat OKI)
                    </h2>
                    <p class="text-white text-opacity-75 mb-4" style="font-size: 0.86rem; line-height: 1.6;">
                        Platform terpusat tata kelola naskah dinas masuk, surat keluar, SPPD, disposisi pimpinan, dan berita acara kedinasan di lingkungan Disdukcapil Kabupaten Ogan Komering Ilir.
                    </p>

                    <div class="security-info-box mt-4">
                        <div class="d-flex align-items-center gap-2 mb-3">
                            <i class="bi bi-shield-check text-info fs-5"></i>
                            <span class="fw-bold text-white" style="font-size: 0.92rem;">Informasi Keamanan &amp; Arsitektur Sistem</span>
                        </div>

                        <div class="d-flex flex-column gap-3">
                            <div class="security-badge-item d-flex align-items-start gap-3">
                                <div class="rounded-2 bg-primary bg-opacity-25 text-info d-flex align-items-center justify-content-center flex-shrink-0 mt-1" style="width: 34px; height: 34px;">
                                    <i class="bi bi-diagram-3-fill"></i>
                                </div>
                                <div>
                                    <div class="fw-semibold text-white" style="font-size: 0.85rem;">Single Gate Role-Based Access Control (RBAC)</div>
                                    <div class="text-white text-opacity-75" style="font-size: 0.75rem; line-height: 1.45;">
                                        Sistem mendeteksi otoritas jabatan (Staf Admin, Kasubbag Umpeg, Sekdin, atau Kepala Dinas) secara otomatis dari satu pintu masuk terenkripsi.
                                    </div>
                                </div>
                            </div>

                            <div class="security-badge-item d-flex align-items-start gap-3">
                                <div class="rounded-2 bg-success bg-opacity-25 text-info d-flex align-items-center justify-content-center flex-shrink-0 mt-1" style="width: 34px; height: 34px;">
                                    <i class="bi bi-qr-code-scan text-white"></i>
                                </div>
                                <div>
                                    <div class="fw-semibold text-white" style="font-size: 0.85rem;">Otorisasi Tanda Tangan Elektronik QR Code</div>
                                    <div class="text-white text-opacity-75" style="font-size: 0.75rem; line-height: 1.45;">
                                        Seluruh dokumen yang disahkan oleh Kepala Dinas dilengkapi token QR Code UUID unik yang tercatat dalam jejak audit buku besar.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="pt-4 mt-4 border-top border-white border-opacity-10 d-flex align-items-center justify-content-between text-white text-opacity-75" style="font-size: 0.76rem;">
                <div>&copy; Hak Cipta 2026 <strong>Disdukcapil Kabupaten OKI</strong>.</div>
                <span>Keamanan Terenkripsi TLS 1.3</span>
            </div>
        </div>

        <div class="col-12 col-lg-7 bg-white d-flex align-items-center justify-content-center p-4 p-md-5">
            <div class="w-100" style="max-width: 490px;">
                <div class="mb-4">
                    <div class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill bg-primary bg-opacity-10 text-primary fw-semibold mb-2" style="font-size: 0.74rem;">
                        <i class="bi bi-key-fill"></i> Portal Akses Internal ASN &amp; Pegawai
                    </div>
                    <h3 class="fw-bold text-dark mb-1">Autentikasi Pegawai</h3>
                    <p class="text-secondary mb-0" style="font-size: 0.85rem; line-height: 1.5;">
                        Masukkan kredensial resmi ASN/Pegawai Disdukcapil OKI. Hak akses akan dideteksi secara otomatis oleh sistem.
                    </p>
                </div>

                <form action="/" method="GET">
                    <div class="mb-3">
                        <label for="kredensialPegawai" class="form-label fw-semibold text-dark small mb-1">
                            NIP / Email Resmi / No. HP Terdaftar <span class="text-danger">*</span>
                        </label>
                        <div class="input-group">
                            <span class="input-group-text bg-light text-secondary">
                                <i class="bi bi-person-vcard-fill"></i>
                            </span>
                            <input type="text" id="kredensialPegawai" class="form-control py-2" placeholder="Contoh: 198504122010011008 atau email dinas" value="198504122010011008">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="kataSandiPegawai" class="form-label fw-semibold text-dark small mb-1">
                            Kata Sandi (Password) <span class="text-danger">*</span>
                        </label>
                        <div class="input-group">
                            <span class="input-group-text bg-light text-secondary">
                                <i class="bi bi-lock-fill"></i>
                            </span>
                            <input type="password" id="kataSandiPegawai" class="form-control py-2" placeholder="Masukkan kata sandi akun Anda..." value="••••••••••••">
                            <button class="btn btn-outline-secondary bg-light text-secondary px-3" type="button" title="Tampilkan Sandi">
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>
                    </div>

                    <div class="d-flex flex-wrap align-items-start justify-content-between gap-2 mb-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="ingatSesi" checked>
                            <label class="form-check-label text-secondary" for="ingatSesi" style="font-size: 0.82rem;">
                                Ingat Sesi Perangkat
                            </label>
                        </div>
                        <div class="text-end">
                            <a href="#modalLupaSandi" data-bs-toggle="collapse" class="text-primary fw-semibold text-decoration-none d-inline-flex align-items-center gap-1" style="font-size: 0.82rem;" title="Hubungi Admin Subbag Umpeg untuk reset kredensial">
                                <i class="bi bi-question-circle"></i> Lupa Kata Sandi?
                            </a>
                            <div class="text-secondary" style="font-size: 0.7rem;">
                                Hubungi Admin Subbag Umpeg untuk reset kredensial
                            </div>
                        </div>
                    </div>

                    <div class="d-grid mb-3">
                        <button type="submit" class="btn btn-primary btn-lg fw-semibold py-2 rounded-2 d-flex align-items-center justify-content-center gap-2 shadow-sm" style="font-size: 0.94rem;">
                            <i class="bi bi-box-arrow-in-right"></i>
                            <span>Masuk ke Sistem</span>
                        </button>
                    </div>
                </form>

                <div class="restricted-alert p-3 mb-4 d-flex align-items-start gap-2">
                    <i class="bi bi-shield-lock-fill text-primary fs-5 flex-shrink-0 mt-1"></i>
                    <div style="font-size: 0.77rem; line-height: 1.45;">
                        <strong class="text-dark">Akses Terbatas:</strong> Pendaftaran akun pegawai baru hanya dapat dilakukan oleh Administrator Subbag Umum &amp; Kepegawaian.
                    </div>
                </div>

                <div class="card border rounded-3 shadow-sm bg-light bg-opacity-50">
                    <div class="card-body p-3 d-flex flex-column flex-sm-row align-items-sm-center justify-content-between gap-3">
                        <div class="d-flex align-items-center gap-2">
                            <div class="rounded-2 bg-primary bg-opacity-10 text-primary d-flex align-items-center justify-content-center flex-shrink-0" style="width: 38px; height: 38px;">
                                <i class="bi bi-qr-code-scan fs-5"></i>
                            </div>
                            <div>
                                <div class="fw-bold text-dark" style="font-size: 0.8rem;">Portal Verifikasi Dokumen Publik</div>
                                <div class="text-secondary" style="font-size: 0.71rem;">Validasi keabsahan tanda tangan elektronik naskah dinas</div>
                            </div>
                        </div>
                        <a href="#" class="btn btn-sm btn-outline-primary fw-semibold rounded-2 px-3 py-2 flex-shrink-0 d-inline-flex align-items-center gap-1" style="font-size: 0.76rem;">
                            <i class="bi bi-patch-check"></i>
                            <span>Cek Keaslian QR Code Surat / SPPD</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
