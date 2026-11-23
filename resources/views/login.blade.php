<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autentikasi Pegawai - E-Surat Disdukcapil OKI</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@600;700;800&family=JetBrains+Mono:wght@500;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('css/esurat-modern.css') }}">
</head>
<body>

<div class="container-fluid p-0">
    <div class="row g-0 min-vh-100">
        <div class="col-12 col-lg-5 branding-panel p-4 p-xl-5 d-flex flex-column justify-content-between">
            <div class="animate-fade-up">
                <div class="d-flex align-items-center gap-3 pb-4 border-bottom border-white border-opacity-10">
                    <div class="d-flex align-items-center gap-2 flex-shrink-0">
                        <div class="rounded-3 bg-white bg-opacity-10 border border-white border-opacity-25 d-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
                            <i class="bi bi-shield-shaded text-warning fs-5" aria-hidden="true"></i>
                        </div>
                        <div class="sidebar-brand-icon d-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
                            <i class="bi bi-envelope-paper-fill text-white fs-5" aria-hidden="true"></i>
                        </div>
                    </div>
                    <div>
                        <div class="fw-bold text-white" style="font-size: 0.88rem; letter-spacing: 0.02em; line-height: 1.35;">
                            DINAS KEPENDUDUKAN DAN PENCATATAN SIPIL<br>
                            KABUPATEN OGAN KOMERING ILIR (OKI)
                        </div>
                    </div>
                </div>

                <div class="mt-4 pt-2">
                    <span class="portal-lencana d-inline-flex align-items-center gap-2 mb-3">
                        <i class="bi bi-shield-lock-fill" aria-hidden="true"></i>
                        <span>Single Gate Role-Based Access Control (RBAC)</span>
                    </span>

                    <h1 class="heading-font fw-bold text-white mb-3" style="font-size: 1.65rem; line-height: 1.35; letter-spacing: -0.01em;">
                        Sistem Informasi Pengelolaan Persuratan &amp; Berita Acara (E-Surat OKI)
                    </h1>
                    <p class="text-white text-opacity-75 mb-4" style="font-size: 0.85rem; line-height: 1.6;">
                        Platform terpusat tata kelola naskah dinas masuk, surat keluar, SPPD, disposisi pimpinan, dan buku besar kearsipan digital di lingkungan Disdukcapil Kabupaten Ogan Komering Ilir.
                    </p>

                    <div class="security-architecture-box mt-4 animate-fade-up delay-1">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <span class="fw-bold text-white d-flex align-items-center gap-2" style="font-size: 0.86rem;">
                                <i class="bi bi-cpu-fill text-info" aria-hidden="true"></i>
                                <span>Arsitektur Keamanan &amp; Otorisasi</span>
                            </span>
                            <span class="badge rounded-pill bg-primary bg-opacity-25 text-info font-monospace" style="font-size: 0.68rem;">TLS 1.3</span>
                        </div>

                        <div class="d-flex flex-column gap-2">
                            <div class="security-item d-flex align-items-start gap-3">
                                <div class="mini-stat-icon" style="width: 34px; height: 34px; background-color: rgba(37, 99, 235, 0.28); color: #93C5FD;">
                                    <i class="bi bi-diagram-3-fill" aria-hidden="true"></i>
                                </div>
                                <div>
                                    <div class="fw-semibold text-white" style="font-size: 0.82rem;">Deteksi Hak Akses Otomatis (Single Gate RBAC)</div>
                                    <div class="text-white text-opacity-75" style="font-size: 0.74rem; line-height: 1.45;">
                                        Otoritas jabatan (Staf Admin, Kasubbag Umpeg, Sekdin, atau Kepala Dinas) dipetakan otomatis berdasarkan kredensial NIP terenkripsi.
                                    </div>
                                </div>
                            </div>

                            <div class="security-item d-flex align-items-start gap-3">
                                <div class="mini-stat-icon" style="width: 34px; height: 34px; background-color: rgba(16, 185, 129, 0.25); color: #6EE7B7;">
                                    <i class="bi bi-qr-code-scan" aria-hidden="true"></i>
                                </div>
                                <div>
                                    <div class="fw-semibold text-white" style="font-size: 0.82rem;">Validasi TTE Berbasis Token QR Code UUID</div>
                                    <div class="text-white text-opacity-75" style="font-size: 0.74rem; line-height: 1.45;">
                                        Penomoran klasifikasi bidang (400, 800, 00) dan tanda tangan elektronik Kepala Dinas tercatat utuh pada Buku Besar Persuratan.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="pt-4 mt-4 border-top border-white border-opacity-10 d-flex flex-wrap align-items-center justify-content-between text-white text-opacity-75 gap-2" style="font-size: 0.75rem;">
                <div>&copy; Hak Cipta 2026 <strong class="text-white">Disdukcapil Kabupaten OKI</strong>.</div>
                <span class="font-monospace">TNDE OKI Mandira v2.4</span>
            </div>
        </div>

        <div class="col-12 col-lg-7 d-flex align-items-center justify-content-center p-4 p-md-5" style="background-color: var(--bg-canvas);">
            <div class="w-100" style="max-width: 500px;">
                <div class="surface-card p-4 p-md-5 mb-3 animate-fade-up delay-1">
                    <div class="mb-4">
                        <div class="d-inline-flex align-items-center gap-2 px-2 py-1 rounded-2 fw-semibold mb-2" style="background-color: #DBEAFE; color: #1D4ED8; font-size: 0.72rem;">
                            <i class="bi bi-key-fill" aria-hidden="true"></i>
                            <span>Autentikasi Terpusat Aparatur Sipil Negara</span>
                        </div>
                        <h2 class="heading-font h4 fw-bold text-dark mb-1">Autentikasi Pegawai</h2>
                        <p class="text-secondary mb-0" style="font-size: 0.82rem; line-height: 1.5;">
                            Masukkan kredensial resmi ASN/Pegawai Disdukcapil OKI. Hak akses akan dideteksi secara otomatis oleh sistem.
                        </p>
                    </div>

                    @if (session('status'))
                        <div class="alert alert-success alert-dismissible fade show py-2 px-3 mb-3 d-flex align-items-center gap-2 border-0" role="alert" style="background-color: #DCFCE7; color: #15803D; font-size: 0.8rem;">
                            <i class="bi bi-check-circle-fill flex-shrink-0" aria-hidden="true"></i>
                            <div class="flex-grow-1">{{ session('status') }}</div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup" style="font-size: 0.65rem;"></button>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-warning alert-dismissible fade show py-2 px-3 mb-3 d-flex align-items-center gap-2 border-0" role="alert" style="background-color: #FEF3C7; color: #B45309; font-size: 0.8rem;">
                            <i class="bi bi-exclamation-triangle-fill flex-shrink-0" aria-hidden="true"></i>
                            <div class="flex-grow-1">{{ session('error') }}</div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup" style="font-size: 0.65rem;"></button>
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show py-2 px-3 mb-3 border-0" data-no-autodismiss="true" role="alert" style="background-color: #FEE2E2; color: #B91C1C; font-size: 0.8rem;">
                            <div class="d-flex align-items-start gap-2">
                                <i class="bi bi-shield-exclamation mt-1 flex-shrink-0" aria-hidden="true"></i>
                                <div class="flex-grow-1">
                                    <div class="fw-bold mb-1">Autentikasi Gagal:</div>
                                    <ul class="mb-0 ps-3">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup" style="font-size: 0.65rem;"></button>
                            </div>
                        </div>
                    @endif

                    <form id="singleGateLoginForm" action="{{ route('login.post') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <div class="d-flex justify-content-between align-items-center flex-wrap gap-1 mb-1">
                                <label for="kredensialPegawai" class="form-label fw-semibold text-dark small mb-0">
                                    <span class="text-nowrap">NIP / Email Resmi / No. HP Terdaftar&nbsp;<span class="text-danger">*</span></span>
                                </label>
                                <a href="#modalNipDemo" data-bs-toggle="modal" class="text-primary text-decoration-none fw-medium text-nowrap" style="font-size: 0.72rem;">
                                    <i class="bi bi-info-circle me-1" aria-hidden="true"></i>Lihat Daftar NIP Uji Coba
                                </a>
                            </div>
                            <div class="input-group">
                                <span class="input-group-text bg-light text-secondary">
                                    <i class="bi bi-person-vcard-fill" aria-hidden="true"></i>
                                </span>
                                <input type="text" name="kredensial" id="kredensialPegawai" class="form-control doc-number-mono py-2 @error('kredensial') is-invalid @enderror" placeholder="Contoh: 198504122010011008 atau email dinas" value="{{ old('kredensial', '198504122010011008') }}" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="kataSandiPegawai" class="form-label fw-semibold text-dark small mb-1">
                                Kata Sandi (Password) <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text bg-light text-secondary">
                                    <i class="bi bi-lock-fill" aria-hidden="true"></i>
                                </span>
                                <input type="password" name="password" id="kataSandiPegawai" class="form-control py-2 @error('password') is-invalid @enderror" placeholder="Masukkan kata sandi akun Anda..." value="password123" required>
                                <button class="btn btn-outline-secondary bg-light text-secondary px-3" type="button" onclick="togglePasswordVisibility()" title="Tampilkan Sandi" aria-label="Tampilkan Sandi">
                                    <i id="eyeToggleIcon" class="bi bi-eye" aria-hidden="true"></i>
                                </button>
                            </div>
                        </div>

                        <div class="mb-4">
                            <div class="d-flex justify-content-between align-items-center gap-2">
                                <div class="form-check mb-0">
                                    <input class="form-check-input" type="checkbox" name="remember" id="ingatSesi" value="1" {{ old('remember', true) ? 'checked' : '' }}>
                                    <label class="form-check-label text-secondary" for="ingatSesi" style="font-size: 0.8rem;">
                                        Ingat Sesi Perangkat
                                    </label>
                                </div>
                                <a href="#modalLupaSandi" data-bs-toggle="modal" class="text-primary fw-semibold text-decoration-none d-inline-flex align-items-center gap-1 text-nowrap" style="font-size: 0.8rem;">
                                    <i class="bi bi-question-circle" aria-hidden="true"></i>
                                    <span>Lupa Kata Sandi?</span>
                                </a>
                            </div>
                            <div class="text-secondary mt-1" style="font-size: 0.7rem;">
                                <i class="bi bi-info-circle me-1" aria-hidden="true"></i>Hubungi Admin Subbag Umpeg untuk reset kredensial
                            </div>
                        </div>

                        <div class="d-grid mb-3">
                            <button type="submit" class="btn btn-enterprise-primary d-flex align-items-center justify-content-center gap-2" style="font-size: 0.9rem;">
                                <i class="bi bi-box-arrow-in-right" aria-hidden="true"></i>
                                <span>Masuk ke Sistem</span>
                            </button>
                        </div>
                    </form>

                    <div class="security-note-box">
                        <div class="d-flex align-items-start gap-2">
                            <i class="bi bi-shield-lock-fill text-primary mt-1" aria-hidden="true"></i>
                            <div class="text-secondary" style="font-size: 0.74rem; line-height: 1.45;">
                                <strong class="text-dark">Kebijakan Keamanan Akses Terbatas:</strong> Sistem ini tidak menyediakan registrasi publik. Pendaftaran akun pegawai baru hanya dapat dilakukan secara internal oleh Administrator Subbag Umpeg melalui modul <strong>Manajemen Akun</strong>.
                            </div>
                        </div>
                    </div>
                </div>

                <div class="surface-card surface-card-interactive p-3 px-4 animate-fade-up delay-2">
                    <div class="d-flex flex-column flex-sm-row align-items-sm-center justify-content-between gap-3">
                        <div class="d-flex align-items-center gap-3">
                            <div class="mini-stat-icon verified-pulse" style="width: 38px; height: 38px; background-color: #DCFCE7; color: #16A34A;">
                                <i class="bi bi-qr-code-scan" aria-hidden="true"></i>
                            </div>
                            <div>
                                <div class="fw-bold text-dark" style="font-size: 0.82rem;">Portal Resmi Verifikasi Tanda Tangan Elektronik (TTE)</div>
                                <div class="text-secondary" style="font-size: 0.72rem;">Periksa keabsahan Token QR Code UUID Surat Keluar &amp; SPPD</div>
                            </div>
                        </div>
                        <a href="/verifikasi-dokumen" class="btn btn-sm btn-outline-primary fw-semibold rounded-2 px-3 py-2 flex-shrink-0 d-inline-flex align-items-center gap-1" style="font-size: 0.76rem;">
                            <i class="bi bi-patch-check-fill" aria-hidden="true"></i>
                            <span>Cek Keaslian QR</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalNipDemo" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow rounded-3">
            <div class="modal-header border-bottom px-4 py-3">
                <h6 class="modal-title fw-bold text-dark d-flex align-items-center gap-2">
                    <i class="bi bi-person-vcard-fill text-primary" aria-hidden="true"></i>
                    <span>Daftar NIP Uji Coba Deteksi Otomatis (Single Gate RBAC)</span>
                </h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body p-4 small">
                <p class="text-secondary mb-3">Klik salah satu akun pegawai resmi di bawah ini untuk mengisi NIP &amp; kata sandi otomatis (<code class="text-primary">password123</code>) lalu masuk secara nyata ke database:</p>
                <div class="d-flex flex-column gap-2">
                    <button type="button" onclick="fillDemoNip('198504122010011008', 'admin')" class="btn btn-light border text-start p-2 px-3 d-flex align-items-center justify-content-between">
                        <div>
                            <div class="fw-bold text-dark">Staf Admin Subbag Umpeg</div>
                            <div class="doc-number-mono text-primary">NIP: 198504122010011008 (Rizky Pratama, S.IP)</div>
                            <div class="text-secondary" style="font-size: 0.72rem;">Email: rizky.pratama@kaboki.go.id &bull; Sandi: password123</div>
                        </div>
                        <span class="badge bg-primary">Login Akun</span>
                    </button>
                    <button type="button" onclick="fillDemoNip('197911032005012006', 'kasubbag')" class="btn btn-light border text-start p-2 px-3 d-flex align-items-center justify-content-between">
                        <div>
                            <div class="fw-bold text-dark">Kasubbag Umpeg (Verifikator Tahap 1)</div>
                            <div class="doc-number-mono text-primary">NIP: 197911032005012006 (Hj. Siti Rahmawati, S.Sos)</div>
                            <div class="text-secondary" style="font-size: 0.72rem;">Email: siti.rahmawati@kaboki.go.id &bull; Sandi: password123</div>
                        </div>
                        <span class="badge bg-warning text-dark">Login Akun</span>
                    </button>
                    <button type="button" onclick="fillDemoNip('197405212000031002', 'sekdin')" class="btn btn-light border text-start p-2 px-3 d-flex align-items-center justify-content-between">
                        <div>
                            <div class="fw-bold text-dark">Sekretaris Dinas / Sekdin (Verifikator Tahap 2)</div>
                            <div class="doc-number-mono text-primary">NIP: 197405212000031002 (Ir. H. Bambang Irawan, M.M)</div>
                            <div class="text-secondary" style="font-size: 0.72rem;">Email: bambang.irawan@kaboki.go.id &bull; Sandi: password123</div>
                        </div>
                        <span class="badge bg-info text-dark">Login Akun</span>
                    </button>
                    <button type="button" onclick="fillDemoNip('197108141998031004', 'kadin')" class="btn btn-light border text-start p-2 px-3 d-flex align-items-center justify-content-between">
                        <div>
                            <div class="fw-bold text-dark">Kepala Dinas Dukcapil OKI (Otorisator TTE)</div>
                            <div class="doc-number-mono text-primary">NIP: 197108141998031004 (Drs. H. Hendra Suryadi, M.Si)</div>
                            <div class="text-secondary" style="font-size: 0.72rem;">Email: hendra.suryadi@kaboki.go.id &bull; Sandi: password123</div>
                        </div>
                        <span class="badge bg-success">Login Akun</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalLupaSandi" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow rounded-3">
            <div class="modal-header border-bottom px-4 py-3">
                <h6 class="modal-title fw-bold text-dark d-flex align-items-center gap-2">
                    <i class="bi bi-shield-lock-fill text-primary" aria-hidden="true"></i>
                    <span>Prosedur Pemulihan Kredensial Pegawai</span>
                </h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body p-4 small">
                <p class="text-secondary mb-0">Demi menjaga keamanan Tanda Tangan Elektronik dan Buku Besar Disdukcapil OKI, pemulihan kata sandi hanya dapat dilakukan melalui <strong>Administrator Subbag Umum &amp; Kepegawaian</strong> dengan menunjukkan identitas NIP pegawai resmi.</p>
            </div>
            <div class="modal-footer border-top px-4 py-2">
                <button type="button" class="btn btn-sm btn-primary fw-semibold" data-bs-dismiss="modal">Mengerti</button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('js/esurat-motion.js') }}" defer></script>
<script>
    function togglePasswordVisibility() {
        const input = document.getElementById('kataSandiPegawai');
        const icon = document.getElementById('eyeToggleIcon');
        if (input.type === 'password') {
            input.type = 'text';
            icon.className = 'bi bi-eye-slash';
        } else {
            input.type = 'password';
            icon.className = 'bi bi-eye';
        }
    }

    function fillDemoNip(nip) {
        const kredInput = document.getElementById('kredensialPegawai');
        const passInput = document.getElementById('kataSandiPegawai');
        if (kredInput) kredInput.value = nip;
        if (passInput) passInput.value = 'password123';
        const form = document.getElementById('singleGateLoginForm');
        if (form) {
            form.submit();
        }
    }
</script>
</body>
</html>
