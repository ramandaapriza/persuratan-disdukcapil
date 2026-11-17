<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Resmi Verifikasi TTE - Disdukcapil Kabupaten OKI</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=JetBrains+Mono:wght@500;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        :root {
            --color-slate-50: #F8FAFC;
            --color-slate-100: #F1F5F9;
            --color-slate-200: #E2E8F0;
            --color-slate-500: #64748B;
            --color-slate-700: #334155;
            --color-slate-900: #0F172A;
            --color-gov-navy: #0B2545;
            --color-blue-600: #2563EB;
            --color-blue-700: #1D4ED8;
            --color-emerald-50: #ECFDF5;
            --color-emerald-100: #D1FAE5;
            --color-emerald-500: #10B981;
            --color-emerald-600: #059669;
            --color-emerald-700: #047857;
            --space-2: 0.5rem;
            --space-3: 0.75rem;
            --space-4: 1rem;
            --space-6: 1.5rem;
            --radius-md: 0.625rem;
            --radius-lg: 1rem;
            --radius-xl: 1.25rem;
            --shadow-soft: 0 4px 24px -4px rgba(15, 23, 42, 0.06), 0 2px 8px -2px rgba(15, 23, 42, 0.04);
            --shadow-elevated: 0 12px 32px -8px rgba(15, 23, 42, 0.1), 0 4px 12px -2px rgba(15, 23, 42, 0.05);
            --color-background: var(--color-slate-50);
            --color-foreground: var(--color-slate-900);
            --color-primary: var(--color-blue-600);
            --color-verified: var(--color-emerald-600);
            --card-bg: #FFFFFF;
            --card-border: var(--color-slate-200);
            --card-radius: var(--radius-lg);
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--color-background);
            color: var(--color-foreground);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .gov-navbar {
            background: linear-gradient(90deg, #091E3A 0%, #0F2C59 50%, #1E3A8A 100%);
            border-bottom: 1px solid rgba(255, 255, 255, 0.12);
            box-shadow: 0 4px 20px rgba(9, 30, 58, 0.12);
        }

        .portal-lencana {
            background-color: rgba(16, 185, 129, 0.15);
            border: 1px solid rgba(52, 211, 153, 0.35);
            color: #6EE7B7;
            font-size: 0.76rem;
            font-weight: 600;
            letter-spacing: 0.02em;
            padding: 0.45rem 0.9rem;
            border-radius: 50rem;
        }

        .hero-verification-card {
            background: linear-gradient(180deg, #FFFFFF 0%, #F8FAFC 100%);
            border: 1px solid var(--card-border);
            border-top: 4px solid var(--color-emerald-500);
            border-radius: var(--radius-xl);
            box-shadow: var(--shadow-elevated);
            position: relative;
            overflow: hidden;
        }

        .shield-glow-badge {
            width: 78px;
            height: 78px;
            border-radius: 50%;
            background: radial-gradient(circle, #D1FAE5 0%, #ECFDF5 70%);
            border: 2px solid #6EE7B7;
            box-shadow: 0 0 0 8px rgba(16, 185, 129, 0.08), 0 8px 20px rgba(5, 150, 105, 0.18);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: var(--color-emerald-600);
            font-size: 2.35rem;
        }

        .verified-pill-banner {
            background-color: var(--color-emerald-50);
            border: 1.5px solid #6EE7B7;
            color: var(--color-emerald-700);
            font-weight: 800;
            font-size: 0.92rem;
            letter-spacing: 0.04em;
            padding: 0.55rem 1.35rem;
            border-radius: 50rem;
            box-shadow: 0 2px 10px rgba(16, 185, 129, 0.12);
        }

        .uuid-token-box {
            font-family: 'JetBrains Mono', monospace;
            background-color: var(--color-slate-900);
            color: #38BDF8;
            border: 1px solid #1E293B;
            border-radius: var(--radius-md);
            padding: 0.65rem 1.15rem;
            font-size: 0.86rem;
            letter-spacing: 0.03em;
        }

        .enterprise-card {
            background-color: var(--card-bg);
            border: 1px solid var(--card-border);
            border-radius: var(--card-radius);
            box-shadow: var(--shadow-soft);
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
        }

        .enterprise-card:hover {
            border-color: #CBD5E1;
        }

        .data-row {
            padding: 0.75rem 0;
            border-bottom: 1px dashed var(--color-slate-200);
        }

        .data-row:last-child {
            border-bottom: none;
            padding-bottom: 0;
        }

        .data-label {
            font-size: 0.76rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.04em;
            color: var(--color-slate-500);
            margin-bottom: 0.2rem;
        }

        .data-value {
            font-size: 0.9rem;
            font-weight: 600;
            color: var(--color-slate-900);
        }

        .audit-step {
            position: relative;
            padding-left: 2.25rem;
            padding-bottom: 0.95rem;
        }

        .audit-step:last-child {
            padding-bottom: 0;
        }

        .audit-step::before {
            content: '';
            position: absolute;
            left: 11px;
            top: 24px;
            bottom: 0;
            width: 2px;
            background-color: #A7F3D0;
        }

        .audit-step:last-child::before {
            display: none;
        }

        .audit-dot {
            position: absolute;
            left: 0;
            top: 2px;
            width: 24px;
            height: 24px;
            border-radius: 50%;
            background-color: var(--color-emerald-100);
            color: var(--color-emerald-700);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.75rem;
        }

        .btn-enterprise-primary {
            background: linear-gradient(135deg, #2563EB 0%, #1D4ED8 100%);
            border: none;
            color: #FFFFFF;
            font-weight: 600;
            padding: 0.7rem 1.4rem;
            border-radius: var(--radius-md);
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.25);
            transition: background-color 0.2s ease, box-shadow 0.2s ease;
        }

        .btn-enterprise-primary:hover {
            background: linear-gradient(135deg, #1D4ED8 0%, #1E40AF 100%);
            color: #FFFFFF;
            box-shadow: 0 6px 16px rgba(37, 99, 235, 0.35);
        }
    </style>
</head>
<body>

<header class="gov-navbar py-3 px-3 px-lg-5 sticky-top">
    <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
            <div class="d-flex align-items-center gap-3">
                <div class="d-flex align-items-center gap-2">
                    <div class="rounded-3 bg-white bg-opacity-10 border border-white border-opacity-25 d-flex align-items-center justify-content-center" style="width: 42px; height: 42px;">
                        <i class="bi bi-shield-shaded text-warning fs-5" aria-hidden="true"></i>
                    </div>
                    <div class="rounded-3 bg-primary d-flex align-items-center justify-content-center shadow-sm" style="width: 42px; height: 42px;">
                        <i class="bi bi-qr-code-scan text-white fs-5" aria-hidden="true"></i>
                    </div>
                </div>
                <div>
                    <div class="fw-bold text-white" style="font-size: 0.95rem; letter-spacing: 0.02em;">DISDUKCAPIL KABUPATEN OKI</div>
                    <div class="text-white text-opacity-75" style="font-size: 0.73rem;">Dinas Kependudukan dan Pencatatan Sipil Kab. Ogan Komering Ilir</div>
                </div>
            </div>

            <div class="d-flex align-items-center gap-2">
                <span class="portal-lencana d-none d-lg-inline-flex align-items-center gap-2">
                    <i class="bi bi-patch-check-fill" aria-hidden="true"></i>
                    <span>Portal Resmi Verifikasi Tanda Tangan Elektronik (TTE)</span>
                </span>
                <a href="/buku-besar" id="backToSystemBtn" class="btn btn-sm btn-light fw-semibold text-primary rounded-pill px-3 py-1 d-inline-flex align-items-center gap-1" style="font-size: 0.78rem;">
                    <i class="bi bi-arrow-left-circle-fill" aria-hidden="true"></i>
                    <span>Kembali ke Sistem</span>
                </a>
                <a href="/login" class="btn btn-sm btn-outline-light fw-semibold rounded-pill px-3 py-1 d-inline-flex align-items-center gap-1" style="font-size: 0.78rem; border-color: rgba(255,255,255,0.3);">
                    <i class="bi bi-lock-fill" aria-hidden="true"></i>
                    <span>Portal Pegawai</span>
                </a>
            </div>
        </div>
    </div>
</header>

<main class="py-4 py-lg-5 flex-grow-1">
    <div class="container" style="max-width: 1080px;">
        <div class="hero-verification-card p-4 p-lg-5 mb-4 text-center">
            <div class="mb-3">
                <span class="shield-glow-badge">
                    <i class="bi bi-shield-fill-check" aria-hidden="true"></i>
                </span>
            </div>

            <div class="mb-3">
                <span class="verified-pill-banner d-inline-flex align-items-center gap-2">
                    <i class="bi bi-check-circle-fill" aria-hidden="true"></i>
                    <span>DOKUMEN ASLI &amp; TERVERIFIKASI SAH</span>
                </span>
            </div>

            <h1 class="h4 fw-bold text-dark mb-2">Sertifikat Tanda Tangan Elektronik Valid &amp; Terdaftar</h1>
            <p class="text-secondary mx-auto mb-4" style="max-width: 660px; font-size: 0.88rem; line-height: 1.6;">
                Naskah dinas ini telah ditandatangani secara elektronik menggunakan sertifikat digital resmi Kepala Dinas Kependudukan dan Pencatatan Sipil Kabupaten Ogan Komering Ilir dan tercatat pada Buku Besar E-Surat OKI.
            </p>

            <div class="d-inline-flex flex-column flex-md-row align-items-center justify-content-center gap-2 gap-md-3 p-2 px-3 rounded-3 bg-light border">
                <div class="d-flex align-items-center gap-2">
                    <span class="badge bg-primary bg-opacity-10 text-primary fw-semibold px-2 py-1" style="font-size: 0.72rem;">
                        <i class="bi bi-key-fill me-1" aria-hidden="true"></i>Token UUID Dokumen
                    </span>
                    <span id="displayTokenUuid" class="uuid-token-box">e8b7a9c2-4f1d-4a9b-8c3e-9102f84a712b</span>
                </div>
                <div class="vr d-none d-md-block text-secondary"></div>
                <div class="text-secondary d-flex align-items-center gap-1" style="font-size: 0.78rem;">
                    <i class="bi bi-clock-history text-success" aria-hidden="true"></i>
                    <span>Waktu Pemindaian Real-Time: <strong class="text-dark">17 Nov 2026, 10:02:15 WIB</strong></span>
                </div>
            </div>
        </div>

        <div class="row g-4 mb-4">
            <div class="col-12 col-lg-6">
                <div class="enterprise-card h-100 p-4">
                    <div class="d-flex align-items-center justify-content-between pb-3 mb-3 border-bottom">
                        <div class="d-flex align-items-center gap-2">
                            <span class="rounded-2 bg-primary bg-opacity-10 text-primary d-inline-flex align-items-center justify-content-center" style="width: 36px; height: 36px;">
                                <i class="bi bi-file-earmark-text-fill fs-5" aria-hidden="true"></i>
                            </span>
                            <div>
                                <h2 class="h6 fw-bold text-dark mb-0">Data Naskah Dinas</h2>
                                <div class="text-secondary" style="font-size: 0.74rem;">Identitas registrasi agenda persuratan resmi</div>
                            </div>
                        </div>
                        <span id="displayKodeBidang" class="badge rounded-pill bg-primary bg-opacity-10 text-primary fw-semibold px-3 py-1" style="font-size: 0.72rem;">
                            Kode Bidang 400
                        </span>
                    </div>

                    <div class="data-row">
                        <div class="data-label">Jenis Dokumen</div>
                        <div class="d-flex align-items-center gap-2 mt-1">
                            <span id="displayJenisDok" class="badge rounded-2 px-2 py-1 fw-semibold" style="background-color: #DBEAFE; color: #1D4ED8; font-size: 0.76rem;">
                                <i class="bi bi-send-fill me-1" aria-hidden="true"></i>Surat Keluar / SPPD
                            </span>
                            <span class="text-secondary small">Naskah Dinas Eksternal</span>
                        </div>
                    </div>

                    <div class="data-row">
                        <div class="data-label">Nomor Surat Resmi</div>
                        <div id="displayNomorSurat" class="data-value font-monospace text-primary" style="font-size: 0.95rem;">400/2763/disdukcapil/2026</div>
                    </div>

                    <div class="data-row">
                        <div class="data-label">Tanggal Diterbitkan</div>
                        <div class="data-value">
                            <i class="bi bi-calendar3 text-secondary me-1" aria-hidden="true"></i>12 November 2026
                        </div>
                    </div>

                    <div class="data-row">
                        <div class="data-label">Perihal</div>
                        <div id="displayPerihal" class="data-value fw-semibold" style="line-height: 1.5;">
                            Penyampaian Laporan Rekapitulasi Penerbitan Akta Pencatatan Sipil dan Sinkronisasi Data Kependudukan Semester II Tahun 2026
                        </div>
                    </div>

                    <div class="data-row">
                        <div class="data-label">Instansi / Pihak Tujuan</div>
                        <div class="data-value d-flex align-items-center gap-2">
                            <i class="bi bi-building text-secondary" aria-hidden="true"></i>
                            <span id="displayTujuan">Direktorat Jenderal Dukcapil Kemendagri RI - Jakarta</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-6">
                <div class="enterprise-card h-100 p-4">
                    <div class="d-flex align-items-center justify-content-between pb-3 mb-3 border-bottom">
                        <div class="d-flex align-items-center gap-2">
                            <span class="rounded-2 bg-success bg-opacity-10 text-success d-inline-flex align-items-center justify-content-center" style="width: 36px; height: 36px;">
                                <i class="bi bi-person-check-fill fs-5" aria-hidden="true"></i>
                            </span>
                            <div>
                                <h2 class="h6 fw-bold text-dark mb-0">Jejak Audit &amp; Otorisasi Pejabat</h2>
                                <div class="text-secondary" style="font-size: 0.74rem;">Kredensial penandatangan &amp; riwayat verifikasi berjenjang</div>
                            </div>
                        </div>
                        <span class="badge rounded-pill bg-success bg-opacity-10 text-success fw-semibold px-3 py-1" style="font-size: 0.72rem;">
                            <i class="bi bi-shield-lock-fill me-1" aria-hidden="true"></i>BSrE Terotentikasi
                        </span>
                    </div>

                    <div class="p-3 rounded-3 mb-3 border" style="background-color: #F8FAFC;">
                        <div class="row g-2">
                            <div class="col-12 col-sm-7">
                                <div class="data-label">Nama Penandatangan</div>
                                <div class="fw-bold text-dark" style="font-size: 0.92rem;">Drs. H. Hendra Suryadi, M.Si</div>
                                <div class="text-secondary font-monospace" style="font-size: 0.75rem;">NIP. 19710814 199803 1 004</div>
                            </div>
                            <div class="col-12 col-sm-5">
                                <div class="data-label">Jabatan</div>
                                <div class="fw-semibold text-primary" style="font-size: 0.82rem;">Kepala Dinas Dukcapil Kab. OKI</div>
                                <div class="text-secondary" style="font-size: 0.72rem;">Pembina Utama Muda (IV/c)</div>
                            </div>
                        </div>
                        <div class="mt-2 pt-2 border-top d-flex align-items-center justify-content-between" style="font-size: 0.76rem;">
                            <span class="text-secondary">Waktu TTD Elektronik:</span>
                            <span class="fw-bold text-success"><i class="bi bi-patch-check-fill me-1" aria-hidden="true"></i>12 Nov 2026, 14:20:08 WIB</span>
                        </div>
                    </div>

                    <div class="data-label mb-2">Timeline Verifikasi Hierarki Berjenjang</div>
                    <div class="pt-1">
                        <div class="audit-step">
                            <div class="audit-dot">
                                <i class="bi bi-check-lg" aria-hidden="true"></i>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="fw-semibold text-dark" style="font-size: 0.82rem;">Verifikasi I: Kasubbag Umpeg</span>
                                <span class="text-secondary" style="font-size: 0.72rem;">12 Nov 2026, 09:45 WIB</span>
                            </div>
                            <div class="text-secondary" style="font-size: 0.75rem;">Hj. Siti Rahmawati, S.Sos., M.Si &mdash; <span class="text-success fw-medium">Konsep &amp; Nomor Agenda Disetujui</span></div>
                        </div>

                        <div class="audit-step">
                            <div class="audit-dot">
                                <i class="bi bi-check-lg" aria-hidden="true"></i>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="fw-semibold text-dark" style="font-size: 0.82rem;">Verifikasi II: Sekretaris Dinas (Sekdin)</span>
                                <span class="text-secondary" style="font-size: 0.72rem;">12 Nov 2026, 11:30 WIB</span>
                            </div>
                            <div class="text-secondary" style="font-size: 0.75rem;">Ir. H. Bambang Irawan, M.M &mdash; <span class="text-success fw-medium">Diparaf Koordinasi &amp; Diteruskan</span></div>
                        </div>

                        <div class="audit-step">
                            <div class="audit-dot" style="background-color: #059669; color: #FFFFFF;">
                                <i class="bi bi-qr-code" aria-hidden="true"></i>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="fw-bold text-dark" style="font-size: 0.82rem;">Otorisasi Final: Kepala Dinas Dukcapil OKI</span>
                                <span class="text-success fw-semibold" style="font-size: 0.72rem;">12 Nov 2026, 14:20 WIB</span>
                            </div>
                            <div class="text-secondary" style="font-size: 0.75rem;">Drs. H. Hendra Suryadi, M.Si &mdash; <span class="text-success fw-semibold">Sah &amp; Ditandatangani (QR Code UUID)</span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="enterprise-card p-4">
            <div class="row g-3 align-items-center justify-content-between">
                <div class="col-12 col-lg-5">
                    <div class="d-flex flex-wrap align-items-center gap-2">
                        <button type="button" onclick="window.print()" class="btn btn-enterprise-primary d-inline-flex align-items-center gap-2" style="font-size: 0.86rem;">
                            <i class="bi bi-file-earmark-arrow-down-fill fs-6" aria-hidden="true"></i>
                            <span>Unduh Salinan Resmi PDF</span>
                        </button>
                        <span class="text-secondary" style="font-size: 0.74rem;">
                            <i class="bi bi-lock-fill text-success me-1" aria-hidden="true"></i>PDF Terproteksi Digital Signature
                        </span>
                    </div>
                </div>

                <div class="col-12 col-lg-7">
                    <form onsubmit="cekDokumenManual(); return false;">
                        <label for="cekTokenInput" class="form-label fw-semibold text-dark small mb-1">
                            Cek Keaslian Dokumen Lain (Token UUID / Nomor Surat Resmi)
                        </label>
                        <div class="input-group">
                            <span class="input-group-text bg-light text-secondary">
                                <i class="bi bi-upc-scan" aria-hidden="true"></i>
                            </span>
                            <input type="text" id="cekTokenInput" class="form-control" placeholder="Masukkan Token UUID atau Nomor Surat (Misal: 090/091/SPPD/DUKCAPIL/2026)..." style="font-size: 0.85rem;">
                            <button class="btn btn-dark fw-semibold px-3" type="submit" style="background-color: var(--color-gov-navy); font-size: 0.84rem;">
                                <i class="bi bi-search me-1" aria-hidden="true"></i>Periksa Dokumen
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

<footer class="bg-white border-top py-3 px-4 mt-4">
    <div class="container" style="max-width: 1080px;">
        <div class="d-flex flex-column flex-sm-row align-items-center justify-content-between text-secondary gap-2" style="font-size: 0.76rem;">
            <div>&copy; 2026 <strong class="text-dark">Dinas Kependudukan dan Pencatatan Sipil Kabupaten Ogan Komering Ilir</strong>.</div>
            <div class="d-flex align-items-center gap-2">
                <i class="bi bi-shield-check text-success" aria-hidden="true"></i>
                <span>Sistem Verifikasi Kriptografi QR Code UUID Terintegrasi</span>
            </div>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function cekDokumenManual() {
        const q = (document.getElementById('cekTokenInput').value || '').trim();
        if (!q) return;
        document.getElementById('displayNomorSurat').textContent = q;
        if (q.toLowerCase().includes('sppd') || q.includes('090')) {
            document.getElementById('displayKodeBidang').textContent = 'Kode Bidang 800';
            document.getElementById('displayJenisDok').innerHTML = '<i class="bi bi-briefcase-fill me-1"></i>SPPD (Perjalanan Dinas)';
            document.getElementById('displayPerihal').textContent = 'Rapat Koordinasi Teknis Pemutakhiran Data Kependudukan & Rekonsiliasi Blangko KTP-el';
            document.getElementById('displayTujuan').textContent = 'Dinas Dukcapil Provinsi Sumatera Selatan - Palembang';
        } else if (q.toLowerCase().includes('ba') || q.includes('028')) {
            document.getElementById('displayKodeBidang').textContent = 'Kode Bidang 400';
            document.getElementById('displayJenisDok').innerHTML = '<i class="bi bi-file-earmark-text-fill me-1"></i>Berita Acara (BAST)';
            document.getElementById('displayPerihal').textContent = 'Berita Acara Serah Terima (BAST) Distribusi 1.500 Keping Blangko KTP-el';
            document.getElementById('displayTujuan').textContent = 'Kantor Kecamatan Kayuagung Kabupaten OKI';
        } else {
            document.getElementById('displayKodeBidang').textContent = 'Kode Bidang 400';
            document.getElementById('displayJenisDok').innerHTML = '<i class="bi bi-send-fill me-1"></i>Surat Keluar Resmi';
            document.getElementById('displayPerihal').textContent = 'Koordinasi Integrasi SIAK Terpusat dan Sinkronisasi Data Kependudukan Kabupaten OKI';
            document.getElementById('displayTujuan').textContent = 'Direktorat Jenderal Dukcapil Kemendagri RI';
        }
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }

    document.addEventListener('DOMContentLoaded', function() {
        const lockedRole = localStorage.getItem('esurat_locked_role') || 'admin';
        const btn = document.getElementById('backToSystemBtn');
        if (btn) {
            if (lockedRole === 'kadin') btn.setAttribute('href', '/kadin?role=kadin');
            else if (lockedRole === 'kasubbag' || lockedRole === 'sekdin') btn.setAttribute('href', '/verifikasi-hierarki?role=' + lockedRole);
            else btn.setAttribute('href', '/?role=admin');
        }
    });
</script>
</body>
</html>
