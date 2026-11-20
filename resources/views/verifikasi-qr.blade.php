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
            --color-rose-50: #FFF1F2;
            --color-rose-600: #E11D48;
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

        .hero-verification-card.unverified {
            border-top-color: var(--color-rose-600);
        }

        .hero-verification-card.neutral {
            border-top-color: var(--color-blue-600);
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

        .shield-glow-badge.unverified {
            background: radial-gradient(circle, #FFE4E6 0%, #FFF1F2 70%);
            border-color: #FDA4AF;
            box-shadow: 0 0 0 8px rgba(225, 29, 72, 0.08), 0 8px 20px rgba(225, 29, 72, 0.16);
            color: var(--color-rose-600);
        }

        .shield-glow-badge.neutral {
            background: radial-gradient(circle, #DBEAFE 0%, #EFF6FF 70%);
            border-color: #93C5FD;
            box-shadow: 0 0 0 8px rgba(37, 99, 235, 0.08), 0 8px 20px rgba(37, 99, 235, 0.16);
            color: var(--color-blue-600);
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

        .unverified-pill-banner {
            background-color: var(--color-rose-50);
            border: 1.5px solid #FDA4AF;
            color: #BE123C;
            font-weight: 800;
            font-size: 0.92rem;
            letter-spacing: 0.04em;
            padding: 0.55rem 1.35rem;
            border-radius: 50rem;
            box-shadow: 0 2px 10px rgba(225, 29, 72, 0.12);
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
            text-decoration: none;
        }

        .btn-enterprise-primary:hover {
            background: linear-gradient(135deg, #1D4ED8 0%, #1E40AF 100%);
            color: #FFFFFF;
            box-shadow: 0 6px 16px rgba(37, 99, 235, 0.35);
        }

        .qr-svg-box svg {
            width: 92px;
            height: 92px;
            display: block;
        }
    </style>
</head>
<body>
@php
    $state = $searchState ?? 'empty';
    $backUrl = '/login';
    if (auth()->check()) {
        $backUrl = match (auth()->user()->role) {
            'kadin' => '/kadin',
            'kasubbag', 'sekdin' => '/verifikasi-hierarki',
            default => '/',
        };
    }
@endphp

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
                @auth
                    <a href="{{ $backUrl }}" class="btn btn-sm btn-light fw-semibold text-primary rounded-pill px-3 py-1 d-inline-flex align-items-center gap-1" style="font-size: 0.78rem;">
                        <i class="bi bi-arrow-left-circle-fill" aria-hidden="true"></i>
                        <span>Kembali ke Sistem</span>
                    </a>
                @else
                    <a href="/login" class="btn btn-sm btn-outline-light fw-semibold rounded-pill px-3 py-1 d-inline-flex align-items-center gap-1" style="font-size: 0.78rem; border-color: rgba(255,255,255,0.3);">
                        <i class="bi bi-lock-fill" aria-hidden="true"></i>
                        <span>Portal Pegawai</span>
                    </a>
                @endauth
            </div>
        </div>
    </div>
</header>

<main class="py-4 py-lg-5 flex-grow-1">
    <div class="container" style="max-width: 1080px;">

        @if($state === 'verified' && $dokumen)
            {{-- STATE 1: DOKUMEN DITEMUKAN & SAH BER-TTE KADIN --}}
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
                <p class="text-secondary mx-auto mb-4" style="max-width: 680px; font-size: 0.88rem; line-height: 1.6;">
                    Naskah dinas ini telah ditandatangani secara elektronik menggunakan sertifikat digital resmi Kepala Dinas Kependudukan dan Pencatatan Sipil Kabupaten Ogan Komering Ilir dan tercatat pada Buku Besar E-Surat OKI.
                </p>

                <div class="d-inline-flex flex-column flex-md-row align-items-center justify-content-center gap-3 p-3 rounded-3 bg-light border">
                    <div class="bg-white border border-success border-opacity-50 rounded-3 p-1 qr-svg-box shadow-sm">
                        {!! $dokumen['qr_svg'] !!}
                    </div>
                    <div class="text-start">
                        <div class="d-flex flex-wrap align-items-center gap-2 mb-2">
                            <span class="badge bg-primary bg-opacity-10 text-primary fw-semibold px-2 py-1" style="font-size: 0.72rem;">
                                <i class="bi bi-key-fill me-1" aria-hidden="true"></i>Token UUID Dokumen
                            </span>
                            <span class="uuid-token-box">{{ $dokumen['tte_token_uuid'] }}</span>
                        </div>
                        <div class="text-secondary d-flex align-items-center gap-1" style="font-size: 0.78rem;">
                            <i class="bi bi-clock-history text-success" aria-hidden="true"></i>
                            <span>Waktu Pemindaian Real-Time: <strong class="text-dark">{{ $dokumen['waktu_pindai'] }}</strong></span>
                        </div>
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
                            <span class="badge rounded-pill bg-primary bg-opacity-10 text-primary fw-semibold px-3 py-1" style="font-size: 0.72rem;">
                                Kode Bidang {{ $dokumen['kode_bidang'] }}
                            </span>
                        </div>

                        <div class="data-row">
                            <div class="data-label">Jenis Dokumen</div>
                            <div class="d-flex align-items-center gap-2 mt-1">
                                <span class="badge rounded-2 px-2 py-1 fw-semibold" style="background-color: {{ $dokumen['jenis_badge_bg'] }}; color: {{ $dokumen['jenis_badge_color'] }}; font-size: 0.76rem;">
                                    <i class="bi {{ $dokumen['jenis_icon'] }} me-1" aria-hidden="true"></i>{{ $dokumen['jenis_label'] }}
                                </span>
                                <span class="text-secondary small">{{ $dokumen['jenis_sub'] }}</span>
                            </div>
                        </div>

                        <div class="data-row">
                            <div class="data-label">Nomor Surat Resmi</div>
                            <div class="data-value font-monospace text-primary" style="font-size: 0.95rem;">{{ $dokumen['nomor'] }}</div>
                        </div>

                        <div class="data-row">
                            <div class="data-label">Tanggal Diterbitkan</div>
                            <div class="data-value">
                                <i class="bi bi-calendar3 text-secondary me-1" aria-hidden="true"></i>{{ $dokumen['tanggal_display'] }}
                            </div>
                        </div>

                        <div class="data-row">
                            <div class="data-label">Perihal / Pokok Naskah</div>
                            <div class="data-value fw-semibold" style="line-height: 1.5;">
                                {{ $dokumen['perihal'] }}
                            </div>
                        </div>

                        @if($dokumen['jenis'] === 'sppd' && !empty($dokumen['extra']))
                            <div class="data-row">
                                <div class="data-label">Pegawai yang Diperintahkan</div>
                                <div class="data-value">
                                    {{ $dokumen['extra']['nama_pegawai'] }} <span class="text-secondary fw-normal">(NIP. {{ $dokumen['extra']['nip_pegawai'] }})</span>
                                </div>
                                <div class="text-secondary small">Jadwal: {{ $dokumen['extra']['tanggal_berangkat'] }} s/d {{ $dokumen['extra']['tanggal_kembali'] }}</div>
                            </div>
                        @endif

                        <div class="data-row">
                            <div class="data-label">Instansi / Pihak Tujuan</div>
                            <div class="data-value d-flex align-items-center gap-2">
                                <i class="bi bi-building text-secondary" aria-hidden="true"></i>
                                <span>{{ $dokumen['tujuan'] }}</span>
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
                                    <div class="fw-bold text-dark" style="font-size: 0.92rem;">{{ $dokumen['penandatangan_nama'] }}</div>
                                    <div class="text-secondary font-monospace" style="font-size: 0.75rem;">NIP. {{ $dokumen['penandatangan_nip'] }}</div>
                                </div>
                                <div class="col-12 col-sm-5">
                                    <div class="data-label">Jabatan</div>
                                    <div class="fw-semibold text-primary" style="font-size: 0.82rem;">{{ $dokumen['penandatangan_jabatan'] }}</div>
                                    <div class="text-secondary" style="font-size: 0.72rem;">{{ $dokumen['penandatangan_pangkat'] }}</div>
                                </div>
                            </div>
                            <div class="mt-2 pt-2 border-top d-flex align-items-center justify-content-between" style="font-size: 0.76rem;">
                                <span class="text-secondary">Waktu Tanda Tangan Elektronik:</span>
                                <span class="fw-bold text-success"><i class="bi bi-patch-check-fill me-1" aria-hidden="true"></i>{{ $dokumen['signed_at_display'] }}</span>
                            </div>
                        </div>

                        <div class="data-label mb-2">Timeline Verifikasi Hierarki Berjenjang (`log_verifikasi`)</div>
                        <div class="pt-1">
                            @forelse($dokumen['logs'] as $log)
                                <div class="audit-step">
                                    <div class="audit-dot" style="{{ $log['tahap_verifikasi'] === 'kepala_dinas' ? 'background-color: #059669; color: #FFFFFF;' : '' }}">
                                        <i class="bi {{ $log['tahap_verifikasi'] === 'kepala_dinas' ? 'bi-qr-code' : 'bi-check-lg' }}" aria-hidden="true"></i>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="fw-semibold text-dark" style="font-size: 0.82rem;">{{ $log['tahap_label'] }}</span>
                                        <span class="{{ $log['tahap_verifikasi'] === 'kepala_dinas' ? 'text-success fw-semibold' : 'text-secondary' }}" style="font-size: 0.72rem;">{{ $log['waktu'] }}</span>
                                    </div>
                                    <div class="text-secondary" style="font-size: 0.75rem;">
                                        {{ $log['verifikator_nama'] }} &mdash; <span class="text-success fw-medium">{{ $log['catatan'] }}</span>
                                    </div>
                                </div>
                            @empty
                                <div class="text-secondary small">Tercatat sah pada Buku Besar E-Surat Disdukcapil OKI.</div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

        @elseif($state === 'unverified')
            {{-- STATE 2: DOKUMEN TIDAK DITEMUKAN ATAU BELUM SAH BER-TTE --}}
            <div class="hero-verification-card unverified p-4 p-lg-5 mb-4 text-center">
                <div class="mb-3">
                    <span class="shield-glow-badge unverified">
                        <i class="bi bi-shield-fill-exclamation" aria-hidden="true"></i>
                    </span>
                </div>

                <div class="mb-3">
                    <span class="unverified-pill-banner d-inline-flex align-items-center gap-2">
                        <i class="bi bi-x-circle-fill" aria-hidden="true"></i>
                        <span>DOKUMEN TIDAK DITEMUKAN / TIDAK TERVERIFIKASI</span>
                    </span>
                </div>

                <h1 class="h4 fw-bold text-dark mb-2">Kredensial Tanda Tangan Elektronik Tidak Valid</h1>
                <p class="text-secondary mx-auto mb-3" style="max-width: 680px; font-size: 0.88rem; line-height: 1.6;">
                    {{ $unverifiedReason }}
                </p>

                <div class="d-inline-flex align-items-center gap-2 p-2 px-3 rounded-3 bg-light border mb-2">
                    <span class="text-secondary small">Parameter yang Diperiksa:</span>
                    <code class="fw-bold text-danger">{{ $keyword }}</code>
                </div>
            </div>

        @else
            {{-- STATE 3: FORM PENCARIAN BERSIH (BELUM ADA INPUT) --}}
            <div class="hero-verification-card neutral p-4 p-lg-5 mb-4 text-center">
                <div class="mb-3">
                    <span class="shield-glow-badge neutral">
                        <i class="bi bi-qr-code-scan" aria-hidden="true"></i>
                    </span>
                </div>

                <h1 class="h4 fw-bold text-dark mb-2">Portal Verifikasi Keaslian Naskah Dinas Ber-TTE</h1>
                <p class="text-secondary mx-auto mb-0" style="max-width: 660px; font-size: 0.88rem; line-height: 1.6;">
                    Masukkan <strong>Token UUID QR Code</strong> atau <strong>Nomor Surat Resmi</strong> yang tertera pada lembar Surat Keluar, SPPD, atau Berita Acara Dinas Kependudukan dan Pencatatan Sipil Kabupaten Ogan Komering Ilir.
                </p>
            </div>
        @endif

        {{-- CARD TINDAKAN UNDUH PDF & FORM PENCARIAN TOKEN / NOMOR SURAT --}}
        <div class="enterprise-card p-4">
            <div class="row g-3 align-items-center justify-content-between">
                @if($state === 'verified' && $dokumen)
                    <div class="col-12 col-lg-5">
                        <div class="d-flex flex-wrap align-items-center gap-2">
                            <a href="{{ $dokumen['unduh_url'] }}" class="btn btn-enterprise-primary d-inline-flex align-items-center gap-2" style="font-size: 0.86rem;">
                                <i class="bi bi-file-earmark-arrow-down-fill fs-6" aria-hidden="true"></i>
                                <span>Unduh Salinan Resmi PDF</span>
                            </a>
                            <span class="text-secondary" style="font-size: 0.74rem;">
                                <i class="bi bi-lock-fill text-success me-1" aria-hidden="true"></i>PDF A4 Ber-QR Code SVG
                            </span>
                        </div>
                    </div>
                @endif

                <div class="col-12 {{ ($state === 'verified' && $dokumen) ? 'col-lg-7' : 'col-lg-12' }}">
                    <form action="{{ route('verifikasi.dokumen') }}" method="GET">
                        <label for="cekTokenInput" class="form-label fw-semibold text-dark small mb-1">
                            Cek Keaslian Dokumen (Token UUID / Nomor Surat Resmi)
                        </label>
                        <div class="input-group">
                            <span class="input-group-text bg-light text-secondary">
                                <i class="bi bi-upc-scan" aria-hidden="true"></i>
                            </span>
                            <input type="text"
                                   name="token"
                                   id="cekTokenInput"
                                   value="{{ $keyword }}"
                                   class="form-control"
                                   placeholder="Masukkan Token UUID atau Nomor Surat (Misal: e8b7a9c2-4f1d-4a9b-8c3e-9102f84a712b atau 400/2763/disdukcapil/2026)..."
                                   style="font-size: 0.85rem;"
                                   required>
                            <button class="btn btn-dark fw-semibold px-3" type="submit" style="background-color: var(--color-gov-navy); font-size: 0.84rem;">
                                <i class="bi bi-search me-1" aria-hidden="true"></i>Periksa Dokumen
                            </button>
                        </div>
                    </form>

                    @if(isset($sampleTokens) && $sampleTokens->isNotEmpty())
                        <div class="d-flex flex-wrap align-items-center gap-2 mt-2">
                            <span class="text-secondary" style="font-size: 0.72rem;">Uji Cepat Token Valid:</span>
                            @foreach($sampleTokens as $sample)
                                <a href="{{ route('verifikasi.dokumen', ['token' => $sample['token']]) }}"
                                   class="badge bg-light text-primary border text-decoration-none fw-medium"
                                   style="font-size: 0.7rem;">
                                    <i class="bi bi-qr-code me-1"></i>{{ $sample['label'] }} ({{ $sample['nomor'] }})
                                </a>
                            @endforeach
                        </div>
                    @endif
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
    localStorage.removeItem('esurat_locked_role');
</script>
</body>
</html>
