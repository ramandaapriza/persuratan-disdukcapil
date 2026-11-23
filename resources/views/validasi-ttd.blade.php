<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validasi &amp; TTE QR - Disdukcapil OKI</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@600;700;800&family=JetBrains+Mono:wght@500;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('css/esurat-modern.css') }}">
</head>
<body>
@php
    $authUser = auth()->user();
    $userRole = $authUser->role ?? 'kadin';
    $userName = $authUser->nama_lengkap ?? 'Kepala Dinas Dukcapil';
    $userJabatan = $authUser->jabatan ?? 'Kepala Dinas Dukcapil Kab. OKI';
    $userNip = $authUser->nip ?? '-';

    $cleanName = preg_replace('/^(Drs\.|Ir\.|H\.|Hj\.|Dr\.|Prof\.)\s+/i', '', $userName);
    $cleanName = preg_replace('/^(Drs\.|Ir\.|H\.|Hj\.|Dr\.|Prof\.)\s+/i', '', $cleanName);
    $cleanName = explode(',', $cleanName)[0];
    $words = array_values(array_filter(explode(' ', trim($cleanName))));
    $userInitials = strtoupper(substr($words[0] ?? 'P', 0, 1) . substr($words[1] ?? ($words[0] ?? 'D'), 0, 1));

    $avatarBadgeClass = match ($userRole) {
        'kadin' => 'bg-success text-white',
        'kasubbag' => 'bg-warning text-dark',
        'sekdin' => 'bg-info text-dark',
        default => 'bg-primary text-white',
    };

    $roleStatusLabel = match ($userRole) {
        'kadin' => 'Otoritas: Kepala Dinas',
        'kasubbag' => 'Otoritas: Kasubbag (Verif I)',
        'sekdin' => 'Otoritas: Sekdin (Verif II)',
        default => 'Otoritas: Staf Admin',
    };

    $badgeTte = $menungguTteCount ?? 0;
    $badgeDisposisi = $menungguDisposisiCount ?? 0;
    $isSigned = $activeDoc && $activeDoc['status'] === 'ttd_kadin';
@endphp

<div class="d-flex">
    <aside class="sidebar d-flex flex-column flex-shrink-0 position-fixed top-0 bottom-0 start-0 z-3">
        <div class="p-3 d-flex align-items-center gap-3 sidebar-brand-header">
            <div class="sidebar-brand-icon text-white d-flex align-items-center justify-content-center">
                <i class="bi bi-envelope-paper-fill fs-5" aria-hidden="true"></i>
            </div>
            <div>
                <div class="fw-bold text-white" style="font-size: 0.9rem; letter-spacing: 0.02em;">DISDUKCAPIL OKI</div>
                <div class="text-secondary" style="font-size: 0.72rem;">Persuratan &amp; Kearsipan</div>
            </div>
        </div>

        <div class="px-3 py-2 d-flex flex-column gap-1 flex-grow-1 overflow-y-auto">
            @if(auth()->user()->role === 'kadin')
                <div class="sidebar-section-label">MENU UTAMA PIMPINAN</div>
                <a href="/kadin" class="nav-link-sidebar">
                    <span class="d-flex align-items-center gap-3">
                        <i class="bi bi-grid" aria-hidden="true"></i>
                        <span>Dashboard Eksekutif</span>
                    </span>
                </a>
                <a href="/kadin/validasi" class="nav-link-sidebar active">
                    <span class="d-flex align-items-center gap-3">
                        <i class="bi bi-qr-code-scan" aria-hidden="true"></i>
                        <span>Validasi &amp; TTE QR</span>
                    </span>
                    <span class="badge rounded-pill bg-danger {{ $badgeTte > 0 ? 'status-pulse' : '' }}" style="font-size: 0.68rem;">{{ $badgeTte }}</span>
                </a>
                <a href="/kadin/disposisi" class="nav-link-sidebar">
                    <span class="d-flex align-items-center gap-3">
                        <i class="bi bi-inbox" aria-hidden="true"></i>
                        <span>Disposisi Surat Masuk</span>
                    </span>
                    <span class="badge rounded-pill bg-warning text-dark fw-bold" style="font-size: 0.68rem;">{{ $badgeDisposisi }}</span>
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

                <div class="sidebar-section-label">OTORISASI &amp; KEAMANAN</div>
                <a href="#modalPinTte" data-bs-toggle="modal" class="nav-link-sidebar">
                    <span class="d-flex align-items-center gap-3">
                        <i class="bi bi-shield-lock" aria-hidden="true"></i>
                        <span>Pengaturan PIN / Passphrase TTE</span>
                    </span>
                </a>
                <a href="/logout" class="nav-link-sidebar text-danger">
                    <span class="d-flex align-items-center gap-3">
                        <i class="bi bi-box-arrow-left" aria-hidden="true"></i>
                        <span>Logout</span>
                    </span>
                </a>
            @endif
        </div>

        <div class="p-3 sidebar-footer-panel">
            <div class="d-flex align-items-center gap-2 mb-2">
                <div class="rounded-circle {{ $avatarBadgeClass }} fw-bold d-flex align-items-center justify-content-center flex-shrink-0" style="width: 36px; height: 36px; font-size: 0.75rem;">
                    {{ $userInitials }}
                </div>
                <div class="lh-sm overflow-hidden">
                    <div class="text-white fw-semibold text-truncate" style="font-size: 0.78rem;">{{ $userName }}</div>
                    <div class="text-secondary text-truncate" style="font-size: 0.69rem;">{{ $userJabatan }}</div>
                </div>
            </div>
            <div class="d-flex align-items-center justify-content-between px-2 py-1 rounded-2" style="background-color: rgba(16, 185, 129, 0.12); border: 1px solid rgba(16, 185, 129, 0.25);">
                <span class="text-success fw-semibold d-inline-flex align-items-center gap-1" style="font-size: 0.68rem;">
                    <i class="bi bi-shield-lock-fill" aria-hidden="true"></i> {{ $roleStatusLabel }}
                </span>
                <span class="badge bg-success text-white" style="font-size: 0.62rem;">BSrE Ready</span>
            </div>
        </div>
    </aside>

    <div class="flex-grow-1 d-flex flex-column min-vh-100" style="margin-left: 260px;">
        <header class="topbar-glass px-4 py-2 d-flex align-items-center justify-content-between sticky-top" style="height: 58px;">
            <div class="small">
                <span class="text-secondary">Disdukcapil OKI</span>
                <span class="text-secondary mx-1">/</span>
                <span class="text-secondary">Validasi &amp; TTE QR</span>
                <span class="text-secondary mx-1">/</span>
                <span class="text-primary fw-semibold">{{ $activeDoc['nomor'] ?? 'Meja Otorisasi TTE' }}</span>
            </div>

            <div class="d-flex align-items-center gap-2">
                <div class="border rounded-2 px-3 py-1 bg-white bg-opacity-75 text-secondary d-none d-md-flex align-items-center gap-2" style="font-size: 0.78rem;">
                    <i class="bi bi-calendar3 text-primary" aria-hidden="true"></i>
                    <span>{{ now()->translatedFormat('l, d F Y') }}</span>
                </div>

                <div class="dropdown">
                    <button class="btn btn-sm border rounded-pill px-2 py-1 d-flex align-items-center gap-2 bg-white shadow-xs" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="rounded-circle {{ $avatarBadgeClass }} fw-bold d-inline-flex align-items-center justify-content-center" style="width: 24px; height: 24px; font-size: 0.68rem;">{{ $userInitials }}</span>
                        <span class="text-dark fw-medium" style="font-size: 0.76rem;">{{ $userName }}</span>
                        <i class="bi bi-chevron-down text-secondary" style="font-size: 0.65rem;" aria-hidden="true"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end shadow border-0 small rounded-3" style="min-width: 230px;">
                        <li class="px-3 py-2 border-bottom">
                            <div class="fw-bold text-dark">{{ $userName }}</div>
                            <div class="text-secondary" style="font-size: 0.7rem;">{{ $userJabatan }}</div>
                            <div class="doc-number-mono text-primary mt-1" style="font-size: 0.68rem;">NIP: {{ $userNip }}</div>
                        </li>
                        <li><a class="dropdown-item" href="#modalPinTte" data-bs-toggle="modal"><i class="bi bi-shield-lock me-2"></i>Pengaturan PIN / Passphrase TTE</a></li>
                        <li><a class="dropdown-item" href="/buku-besar"><i class="bi bi-journal-bookmark me-2"></i>Buku Besar Persuratan</a></li>
                        <li><a class="dropdown-item" href="/verifikasi-dokumen"><i class="bi bi-qr-code-scan me-2"></i>Cek Portal Verifikasi Publik</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item text-danger" href="/logout"><i class="bi bi-box-arrow-right me-2"></i>Logout</a></li>
                    </ul>
                </div>
            </div>
        </header>

        <main class="p-4 flex-grow-1">
            @if (session('status'))
                <div class="alert alert-success alert-dismissible fade show py-2 px-3 mb-3 d-flex align-items-center gap-2 border-0 shadow-sm" role="alert" style="background-color: #DCFCE7; color: #15803D; font-size: 0.8rem;">
                    <i class="bi bi-check-circle-fill flex-shrink-0" aria-hidden="true"></i>
                    <div class="flex-grow-1">{{ session('status') }}</div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup" style="font-size: 0.65rem;"></button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show py-2 px-3 mb-3 d-flex align-items-center gap-2 border-0 shadow-sm" role="alert" style="background-color: #FEE2E2; color: #B91C1C; font-size: 0.8rem;">
                    <i class="bi bi-shield-exclamation flex-shrink-0" aria-hidden="true"></i>
                    <div class="flex-grow-1">{{ session('error') }}</div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup" style="font-size: 0.65rem;"></button>
                </div>
            @endif

            @if (isset($errors) && $errors->any())
                <div class="alert alert-danger alert-dismissible fade show py-2 px-3 mb-3 border-0 shadow-sm" data-no-autodismiss="true" role="alert" style="background-color: #FEE2E2; color: #B91C1C; font-size: 0.8rem;">
                    <div class="fw-bold mb-1"><i class="bi bi-exclamation-triangle-fill me-1"></i>Validasi Otorisasi Gagal:</div>
                    <ul class="mb-0 ps-3">
                        @foreach ($errors->all() as $err)
                            <li>{{ $err }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup" style="font-size: 0.65rem;"></button>
                </div>
            @endif

            <div class="surface-card p-3 px-4 mb-4 d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3 animate-fade-up">
                <div>
                    <div class="d-flex flex-wrap align-items-center gap-2 mb-1">
                        @if($activeDoc)
                            <span class="badge rounded-2 px-2 py-1 fw-semibold" style="background-color: {{ $activeDoc['jenis_badge_bg'] }}; color: {{ $activeDoc['jenis_badge_color'] }}; font-size: 0.72rem;">
                                <i class="bi {{ $activeDoc['jenis_icon'] }} me-1" aria-hidden="true"></i>{{ $activeDoc['jenis_label'] }} &bull; Kode {{ $activeDoc['kode_bidang'] }}
                            </span>
                            <span class="doc-number-mono text-primary">{{ $activeDoc['nomor'] }}</span>
                            @if($isSigned)
                                <span class="badge rounded-pill bg-success text-white px-2 py-1 verified-pulse" style="font-size: 0.68rem;">
                                    <i class="bi bi-patch-check-fill me-1"></i>Telah Disahkan TTE QR
                                </span>
                            @else
                                <span class="badge rounded-pill bg-warning text-dark px-2 py-1 status-pulse" style="font-size: 0.68rem;">
                                    <i class="bi bi-hourglass-split me-1"></i>Menunggu Otorisasi PIN TTE
                                </span>
                            @endif
                        @endif
                    </div>
                    <h6 class="heading-font fw-bold text-dark mb-0">Pratinjau Lembar Naskah Dinas &amp; Otorisasi Tanda Tangan Elektronik (QR Code UUID)</h6>
                </div>
                <div class="d-flex flex-wrap align-items-center gap-2">
                    @if(!empty($activeDoc['file_url']))
                        <button type="button" data-bs-toggle="modal" data-bs-target="#modalPratinjauLampiran" class="btn btn-outline-primary btn-sm fw-semibold px-3 py-2 rounded-2 d-inline-flex align-items-center gap-1" style="font-size: 0.78rem;">
                            <i class="bi bi-paperclip" aria-hidden="true"></i>
                            <span>Pratinjau Berkas Unggahan</span>
                        </button>
                    @endif
                    <a href="{{ $activeDoc['verify_url'] ?? '/verifikasi-dokumen' }}" class="btn btn-outline-success btn-sm fw-medium px-3 py-2 rounded-2 d-inline-flex align-items-center gap-1" style="font-size: 0.78rem;">
                        <i class="bi bi-patch-check" aria-hidden="true"></i>
                        <span>Cek di Portal Verifikasi QR</span>
                    </a>
                    <a href="/kadin" class="btn btn-outline-secondary btn-sm fw-medium px-3 py-2 rounded-2 d-inline-flex align-items-center gap-1" style="font-size: 0.78rem;">
                        <i class="bi bi-arrow-left" aria-hidden="true"></i>
                        <span>Kembali ke Antrean</span>
                    </a>
                </div>
            </div>

            <div class="row g-4">
                <div class="col-12 col-lg-7 animate-fade-up delay-1">
                    <div class="surface-card overflow-hidden mb-4">
                        <div class="px-4 py-3 border-bottom d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center gap-2">
                                <div class="mini-stat-icon" style="width: 38px; height: 38px; font-size: 1.05rem; background-color: #FEE2E2; color: #DC2626;">
                                    <i class="bi bi-file-earmark-pdf-fill" aria-hidden="true"></i>
                                </div>
                                <div>
                                    <h6 class="heading-font fw-bold text-dark mb-0" style="font-size: 0.88rem;">Pratinjau Lembar Naskah Dinas (A4 Resmi)</h6>
                                    <div class="text-secondary" style="font-size: 0.73rem;">Kop Resmi Disdukcapil OKI &amp; Area Tanda Tangan Elektronik QR Code UUID</div>
                                </div>
                            </div>
                            <span class="badge bg-light text-secondary border fw-medium" style="font-size: 0.72rem;">Halaman 1 dari 1</span>
                        </div>

                        <div class="p-3 p-md-4" style="background-color: var(--color-slate-50);">
                            @if($activeDoc)
                                <div class="a4-paper mx-auto">
                                    <div class="d-flex align-items-center gap-3 text-center">
                                        <div class="d-flex align-items-center justify-content-center flex-shrink-0" style="width: 68px; height: 76px;">
                                            <div class="border border-2 border-dark rounded-3 d-flex align-items-center justify-content-center w-100 h-100 bg-light">
                                                <i class="bi bi-shield-shaded fs-1 text-dark" aria-hidden="true"></i>
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

                                    {{-- TEMPLATE 1: SURAT KELUAR --}}
                                    @if($activeDoc['jenis'] === 'surat_keluar')
                                        <div class="d-flex justify-content-between align-items-start mb-4" style="font-size: 0.92rem;">
                                            <table class="table table-borderless table-sm mb-0" style="width: auto; font-size: 0.92rem;">
                                                <tbody>
                                                    <tr>
                                                        <td class="p-0 pe-3">Nomor</td>
                                                        <td class="p-0 pe-2">:</td>
                                                        <td class="p-0 fw-semibold">{{ $activeDoc['nomor'] }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="p-0 pe-3">Sifat</td>
                                                        <td class="p-0 pe-2">:</td>
                                                        <td class="p-0">{{ $activeDoc['sifat'] }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="p-0 pe-3">Lampiran</td>
                                                        <td class="p-0 pe-2">:</td>
                                                        <td class="p-0">{{ $activeDoc['lampiran'] }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="p-0 pe-3">Perihal</td>
                                                        <td class="p-0 pe-2">:</td>
                                                        <td class="p-0 fw-bold text-decoration-underline">{{ $activeDoc['perihal'] }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <div class="text-end flex-shrink-0">
                                                <div>Kayuagung, {{ $activeDoc['tanggal_display'] }}</div>
                                            </div>
                                        </div>

                                        <div class="mb-4" style="font-size: 0.92rem;">
                                            <div>Kepada Yth.</div>
                                            <div class="fw-bold">{{ $activeDoc['tujuan'] }}</div>
                                            <div>di -</div>
                                            <div class="ps-4 fw-semibold">Tempat</div>
                                        </div>

                                        <div style="font-size: 0.93rem; text-align: justify;">
                                            <p class="mb-3" style="text-indent: 2.25rem;">
                                                Dalam rangka pelaksanaan tertib administrasi kependudukan serta peningkatan pelayanan publik pada Dinas Kependudukan dan Pencatatan Sipil Kabupaten Ogan Komering Ilir, bersama ini kami sampaikan naskah dinas perihal <strong>{{ $activeDoc['perihal'] }}</strong>.
                                            </p>
                                            <p class="mb-4" style="text-indent: 2.25rem;">
                                                Naskah dinas ini beserta berkas pendukungnya telah melalui proses verifikasi berjenjang sesuai standar Tata Naskah Dinas Elektronik (TNDE). Demikian surat ini kami sampaikan, atas perhatian dan kerja sama yang baik diucapkan terima kasih.
                                            </p>
                                        </div>
                                    @elseif($activeDoc['jenis'] === 'sppd')
                                        {{-- TEMPLATE 2: SPPD --}}
                                        <div class="text-center mb-3">
                                            <div class="fw-bold text-decoration-underline" style="font-size: 1rem;">SURAT PERINTAH PERJALANAN DINAS (SPPD)</div>
                                            <div style="font-size: 0.88rem;">Nomor: <span class="fw-bold">{{ $activeDoc['nomor'] }}</span></div>
                                        </div>

                                        <table class="table table-bordered border-dark table-sm mb-3" style="font-size: 0.86rem;">
                                            <tbody>
                                                <tr>
                                                    <td style="width: 36%;" class="fw-semibold">1. Pejabat yang Memberi Perintah</td>
                                                    <td>Kepala Dinas Kependudukan dan Pencatatan Sipil Kabupaten OKI</td>
                                                </tr>
                                                <tr>
                                                    <td class="fw-semibold">2. Nama / NIP Pegawai yang Diperintahkan</td>
                                                    <td>
                                                        <div class="fw-bold">{{ $activeDoc['extra']['nama_pegawai'] ?? '-' }}</div>
                                                        <div>NIP. {{ $activeDoc['extra']['nip_pegawai'] ?? '-' }}</div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="fw-semibold">3. Jabatan / Instansi</td>
                                                    <td>{{ $activeDoc['extra']['jabatan_pegawai'] ?? '-' }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="fw-semibold">4. Maksud Perjalanan Dinas</td>
                                                    <td>{{ $activeDoc['perihal'] }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="fw-semibold">5. Tempat Berangkat &amp; Tempat Tujuan</td>
                                                    <td>Kayuagung &rarr; <span class="fw-bold">{{ $activeDoc['tujuan'] }}</span></td>
                                                </tr>
                                                <tr>
                                                    <td class="fw-semibold">6. Tanggal Berangkat s/d Tanggal Kembali</td>
                                                    <td>{{ $activeDoc['extra']['tanggal_berangkat'] ?? '-' }} s/d {{ $activeDoc['extra']['tanggal_kembali'] ?? '-' }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <div class="text-end mb-2" style="font-size: 0.86rem;">
                                            Dikeluarkan di: Kayuagung &bull; Pada Tanggal: {{ $activeDoc['tanggal_display'] }}
                                        </div>
                                    @else
                                        {{-- TEMPLATE 3: BERITA ACARA --}}
                                        <div class="text-center mb-3">
                                            <div class="fw-bold text-decoration-underline" style="font-size: 1rem;">BERITA ACARA KEDINASAN</div>
                                            <div style="font-size: 0.88rem;">Nomor: <span class="fw-bold">{{ $activeDoc['nomor'] }}</span></div>
                                        </div>

                                        <div style="font-size: 0.91rem; text-align: justify;">
                                            <p class="mb-2" style="text-indent: 2rem;">
                                                Pada tanggal <strong>{{ $activeDoc['tanggal_display'] }}</strong>, bertempat di Kantor Dinas Kependudukan dan Pencatatan Sipil Kabupaten Ogan Komering Ilir, kami yang bertanda tangan di bawah ini:
                                            </p>
                                            <div class="ps-3 mb-2">
                                                <div><strong>PIHAK PERTAMA:</strong> Dinas Kependudukan dan Pencatatan Sipil Kabupaten Ogan Komering Ilir</div>
                                                <div><strong>PIHAK KEDUA (MITRA):</strong> <span class="fw-bold">{{ $activeDoc['tujuan'] }}</span></div>
                                            </div>
                                            <p class="mb-3" style="text-indent: 2rem;">
                                                Kedua belah pihak telah melaksanakan dan menyepakati <strong>{{ $activeDoc['perihal'] }}</strong> untuk dipergunakan sebagaimana mestinya sesuai ketentuan yang berlaku.
                                            </p>
                                        </div>
                                    @endif

                                    <div class="row justify-content-end mt-4">
                                        <div class="col-12 col-sm-8 text-center">
                                            <div class="fw-bold mb-2" style="font-size: 0.9rem;">KEPALA DINAS KEPENDUDUKAN DAN<br>PENCATATAN SIPIL KABUPATEN OKI,</div>

                                            @if($isSigned && !empty($activeDoc['qr_svg']))
                                                <div id="ttePaperBox" class="tte-placeholder signed my-2 d-flex align-items-center gap-3 text-start">
                                                    <div class="bg-white border border-success border-opacity-50 rounded-2 p-1 d-flex align-items-center justify-content-center flex-shrink-0 qr-svg-wrapper qr-scan-box">
                                                        {!! $activeDoc['qr_svg'] !!}
                                                    </div>
                                                    <div class="overflow-hidden">
                                                        <span class="badge bg-success mb-1" style="font-size: 0.64rem;">
                                                            <i class="bi bi-patch-check-fill me-1"></i>TERVERIFIKASI SAH (BSrE / TTE QR)
                                                        </span>
                                                        <div class="fw-bold text-success" style="font-size: 0.77rem; line-height: 1.25;">
                                                            Ditandatangani Secara Elektronik oleh Kepala Dinas
                                                        </div>
                                                        <div class="doc-number-mono text-dark text-truncate mt-1" style="font-size: 0.67rem;">
                                                            UUID: {{ $activeDoc['tte_token_uuid'] }}
                                                        </div>
                                                        <div class="mt-1">
                                                            <a href="{{ $activeDoc['verify_url'] }}" class="text-success fw-semibold text-decoration-none" style="font-size: 0.68rem;">
                                                                <i class="bi bi-box-arrow-up-right me-1"></i>Verifikasi Keaslian QR Code &rarr;
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            @else
                                                <div id="ttePaperBox" class="tte-placeholder my-2 d-flex align-items-center gap-3 text-start">
                                                    <div class="bg-white border border-primary border-opacity-25 rounded-2 p-2 d-flex align-items-center justify-content-center flex-shrink-0 qr-scan-box">
                                                        <i class="bi bi-qr-code text-primary" style="font-size: 2.5rem; line-height: 1;" aria-hidden="true"></i>
                                                    </div>
                                                    <div>
                                                        <span class="badge bg-primary mb-1" style="font-size: 0.65rem;">QR CODE UUID</span>
                                                        <div class="fw-bold text-primary" style="font-size: 0.78rem; line-height: 1.3;">
                                                            Area Tanda Tangan Elektronik (Menunggu Validasi Kadin)
                                                        </div>
                                                        <div class="text-secondary" style="font-size: 0.68rem;">Token UUID &amp; QR Code SVG akan terbit otomatis setelah otorisasi PIN TTE</div>
                                                    </div>
                                                </div>
                                            @endif

                                            <div class="fw-bold text-decoration-underline mt-2" style="font-size: 0.92rem;">{{ strtoupper($userName) }}</div>
                                            <div style="font-size: 0.84rem;">{{ $authUser->pangkat_golongan ?? 'Pembina Utama Muda (IV/c)' }}</div>
                                            <div style="font-size: 0.84rem;">NIP. {{ $userNip }}</div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="text-center py-5">
                                    <i class="bi bi-patch-check-fill text-success fs-1 d-block mb-2"></i>
                                    <h6 class="heading-font fw-bold text-dark">Tidak Ada Antrean Naskah Validasi</h6>
                                    <p class="text-secondary small mb-0">Seluruh dokumen telah selesai ditandatangani secara elektronik.</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- DAFTAR ANTREAN & RIWAYAT TTE UNTUK BERPINDAH DOKUMEN DENGAN CEPAT --}}
                    <div class="surface-card overflow-hidden">
                        <div class="px-4 py-3 border-bottom d-flex align-items-center justify-content-between">
                            <div>
                                <h6 class="heading-font fw-bold text-dark mb-0" style="font-size: 0.88rem;">Daftar Antrean Menunggu TTE ({{ $antreanValidasi->count() }}) &amp; Dokumen Terbit QR</h6>
                                <div class="text-secondary" style="font-size: 0.73rem;">Klik "Pilih Naskah" untuk memuat dokumen ke lembar pratinjau A4 di atas</div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-ledger mb-0">
                                <thead>
                                    <tr>
                                        <th class="ps-4">NOMOR DOKUMEN</th>
                                        <th>KATEGORI</th>
                                        <th>PERIHAL / TUJUAN</th>
                                        <th>STATUS TTE</th>
                                        <th class="pe-4 text-end">AKSI</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($antreanValidasi->concat($riwayatTte->take(4)) as $docItem)
                                        @php
                                            $isCurrent = $activeDoc && $activeDoc['key'] === $docItem['key'];
                                        @endphp
                                        <tr class="{{ $isCurrent ? 'active-row' : '' }}">
                                            <td class="ps-4">
                                                <div class="doc-number-mono text-primary">{{ $docItem['nomor'] }}</div>
                                                <span class="badge bg-light text-secondary border mt-1" style="font-size: 0.65rem;">Kode {{ $docItem['kode_bidang'] }}</span>
                                            </td>
                                            <td>
                                                <span class="badge rounded-2 px-2 py-1 fw-semibold" style="background-color: {{ $docItem['jenis_badge_bg'] }}; color: {{ $docItem['jenis_badge_color'] }}; font-size: 0.7rem;">
                                                    {{ $docItem['jenis_label'] }}
                                                </span>
                                            </td>
                                            <td>
                                                <div class="fw-semibold text-dark">{{ \Illuminate\Support\Str::limit($docItem['perihal'], 58) }}</div>
                                                <div class="text-secondary" style="font-size: 0.71rem;">{{ $docItem['sub_info'] }}</div>
                                            </td>
                                            <td>
                                                @if($docItem['status'] === 'ttd_kadin')
                                                    <span class="badge rounded-pill px-2 py-1" style="background-color: #DCFCE7; color: #15803D; font-size: 0.69rem;">
                                                        <i class="bi bi-qr-code me-1"></i>Sah TTE QR
                                                    </span>
                                                @else
                                                    <span class="badge rounded-pill bg-warning text-dark px-2 py-1" style="font-size: 0.69rem;">
                                                        <i class="bi bi-hourglass-split me-1"></i>Menunggu TTE
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="pe-4 text-end">
                                                <a href="{{ $docItem['validasi_url'] }}" class="btn btn-sm {{ $isCurrent ? 'btn-primary' : 'btn-outline-primary' }} py-1 px-2" style="font-size: 0.72rem;">
                                                    {{ $isCurrent ? 'Sedang Dibuka' : ($docItem['status'] === 'ttd_kadin' ? 'Lihat QR' : 'Pilih Naskah') }}
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-5 animate-fade-up delay-2">
                    <div class="surface-card mb-4">
                        <div class="px-4 py-3 border-bottom d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center gap-2">
                                <div class="mini-stat-icon" style="width: 38px; height: 38px; font-size: 1.05rem; background-color: #DBEAFE; color: #2563EB;">
                                    <i class="bi bi-diagram-3-fill" aria-hidden="true"></i>
                                </div>
                                <div>
                                    <h6 class="heading-font fw-bold text-dark mb-0" style="font-size: 0.88rem;">Timeline Verifikasi Berjenjang</h6>
                                    <div class="text-secondary" style="font-size: 0.73rem;">Riwayat persetujuan dari penyusun hingga pimpinan</div>
                                </div>
                            </div>
                            <span class="badge rounded-pill px-2 py-1 fw-semibold" style="background-color: #DCFCE7; color: #15803D; font-size: 0.7rem;">
                                {{ $isSigned ? '4/4 Tahap Selesai' : '3/4 Tahap Terverifikasi' }}
                            </span>
                        </div>

                        <div class="p-4">
                            @php
                                $logsCol = collect($activeDoc['logs'] ?? []);
                                $logStaf = $logsCol->where('tahap_verifikasi', 'staf_admin')->last();
                                $logKasubbag = $logsCol->where('tahap_verifikasi', 'kasubbag_umpeg')->where('status_aksi', 'valid_kasubbag')->last();
                                $logSekdin = $logsCol->where('tahap_verifikasi', 'sekretaris_dinas')->where('status_aksi', 'valid_sekdin')->last();
                                $logKadin = $logsCol->where('tahap_verifikasi', 'kepala_dinas')->where('status_aksi', 'ttd_kadin')->last();
                            @endphp

                            <div class="timeline-step">
                                <div class="timeline-dot" style="background-color: #DCFCE7; color: #16A34A;">
                                    <i class="bi bi-check-circle-fill" aria-hidden="true"></i>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="fw-bold text-dark" style="font-size: 0.84rem;">Staf Subbag Umpeg</span>
                                    <span class="badge rounded-pill px-2 py-1" style="background-color: #DCFCE7; color: #15803D; font-size: 0.68rem;">Selesai</span>
                                </div>
                                <div class="text-secondary" style="font-size: 0.78rem;">
                                    {{ $logStaf['verifikator_nama'] ?? ($activeDoc['pengaju_nama'] ?? 'Staf Admin') }} &mdash; {{ $logStaf['catatan'] ?? 'Konsep Naskah Diajukan' }}
                                </div>
                                <div class="text-secondary mt-1 doc-number-mono" style="font-size: 0.71rem;">
                                    <i class="bi bi-clock me-1" aria-hidden="true"></i>{{ $logStaf['waktu'] ?? 'Tercatat di Buku Agenda' }}
                                </div>
                            </div>

                            <div class="timeline-step">
                                <div class="timeline-dot" style="background-color: #DCFCE7; color: #16A34A;">
                                    <i class="bi bi-check-circle-fill" aria-hidden="true"></i>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="fw-bold text-dark" style="font-size: 0.84rem;">Kasubbag Umpeg</span>
                                    <span class="badge rounded-pill px-2 py-1" style="background-color: #DCFCE7; color: #15803D; font-size: 0.68rem;">Terverifikasi</span>
                                </div>
                                <div class="text-secondary" style="font-size: 0.78rem;">
                                    {{ $logKasubbag['verifikator_nama'] ?? 'Hj. Siti Rahmawati, S.Sos., M.Si' }} &mdash; {{ $logKasubbag['catatan'] ?? 'Diverifikasi & Disetujui Tahap 1' }}
                                </div>
                                <div class="text-secondary mt-1 doc-number-mono" style="font-size: 0.71rem;">
                                    <i class="bi bi-clock me-1" aria-hidden="true"></i>{{ $logKasubbag['waktu'] ?? 'Lolos Verifikasi Tahap 1' }}
                                </div>
                            </div>

                            <div class="timeline-step">
                                <div class="timeline-dot" style="background-color: #DCFCE7; color: #16A34A;">
                                    <i class="bi bi-check-circle-fill" aria-hidden="true"></i>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="fw-bold text-dark" style="font-size: 0.84rem;">Sekretaris Dinas / Sekdin</span>
                                    <span class="badge rounded-pill px-2 py-1" style="background-color: #DCFCE7; color: #15803D; font-size: 0.68rem;">Diparaf</span>
                                </div>
                                <div class="text-secondary" style="font-size: 0.78rem;">
                                    {{ $logSekdin['verifikator_nama'] ?? 'Ir. H. Bambang Irawan, M.M' }} &mdash; {{ $logSekdin['catatan'] ?? 'Diparaf Koordinasi & Diteruskan ke Kadin' }}
                                </div>
                                <div class="text-secondary mt-1 doc-number-mono" style="font-size: 0.71rem;">
                                    <i class="bi bi-clock me-1" aria-hidden="true"></i>{{ $logSekdin['waktu'] ?? 'Lolos Paraf Tahap 2' }}
                                </div>
                            </div>

                            <div class="timeline-step">
                                @if($isSigned)
                                    <div class="timeline-dot" style="background-color: #DCFCE7; color: #16A34A;">
                                        <i class="bi bi-patch-check-fill" aria-hidden="true"></i>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="fw-bold text-dark" style="font-size: 0.84rem;">Kepala Dinas</span>
                                        <span class="badge rounded-pill bg-success text-white fw-semibold px-2 py-1" style="font-size: 0.68rem;">Sah Ber-TTE QR</span>
                                    </div>
                                    <div class="fw-semibold text-success" style="font-size: 0.78rem;">
                                        {{ $logKadin['verifikator_nama'] ?? $userName }} &mdash; Disahkan dengan Tanda Tangan Elektronik
                                    </div>
                                    <div class="text-secondary mt-1 doc-number-mono" style="font-size: 0.71rem;">
                                        <i class="bi bi-clock me-1" aria-hidden="true"></i>{{ $logKadin['waktu'] ?? ($activeDoc['signed_at_display'] ?? '-') }}
                                    </div>
                                @else
                                    <div class="timeline-dot" style="background-color: #FEF3C7; color: #D97706; border: 2px solid #F59E0B;">
                                        <i class="bi bi-hourglass-split" aria-hidden="true"></i>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="fw-bold text-dark" style="font-size: 0.84rem;">Kepala Dinas</span>
                                        <span class="badge rounded-pill bg-warning text-dark fw-semibold px-2 py-1" style="font-size: 0.68rem;">Status Aktif</span>
                                    </div>
                                    <div class="fw-semibold" style="font-size: 0.78rem; color: #B45309;">Menunggu Tanda Tangan Elektronik</div>
                                    <div class="text-secondary mt-1" style="font-size: 0.71rem;"><i class="bi bi-shield-check me-1" aria-hidden="true"></i>Siap dieksekusi dengan Passphrase / PIN TTE</div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="surface-card">
                        <div class="px-4 py-3 border-bottom d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center gap-2">
                                <div class="mini-stat-icon" style="width: 38px; height: 38px; font-size: 1.05rem; background-color: #DCFCE7; color: #16A34A;">
                                    <i class="bi bi-shield-lock-fill" aria-hidden="true"></i>
                                </div>
                                <div>
                                    <h6 class="heading-font fw-bold text-dark mb-0" style="font-size: 0.88rem;">Form Otorisasi Passphrase / PIN TTE</h6>
                                    <div class="text-secondary" style="font-size: 0.73rem;">Penerbitan QR Code UUID Kepala Dinas</div>
                                </div>
                            </div>
                        </div>

                        <div class="p-4">
                            @if($isSigned)
                                <div class="p-3 rounded-3 border mb-3" style="background-color: #ECFDF5; border-color: #A7F3D0 !important;">
                                    <div class="d-flex align-items-center gap-2 text-success fw-bold mb-1" style="font-size: 0.84rem;">
                                        <i class="bi bi-patch-check-fill"></i>
                                        <span>Naskah Ini Telah Sah Ber-TTE QR Code</span>
                                    </div>
                                    <div class="text-secondary small mb-2">
                                        Token UUID: <code class="text-dark fw-bold">{{ $activeDoc['tte_token_uuid'] }}</code>
                                    </div>
                                    <div class="d-flex flex-wrap gap-2">
                                        <a href="{{ $activeDoc['verify_url'] }}" class="btn btn-sm btn-success fw-semibold">
                                            <i class="bi bi-qr-code-scan me-1"></i>Uji di Portal Verifikasi Publik
                                        </a>
                                        @if($antreanValidasi->isNotEmpty())
                                            <a href="{{ $antreanValidasi->first()['validasi_url'] }}" class="btn btn-sm btn-outline-primary fw-semibold">
                                                Lanjut ke Antrean Berikutnya &rarr;
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            @endif

                            <form action="{{ $activeDoc['tte_url'] ?? '#' }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="passphraseInput" class="form-label fw-semibold text-dark small mb-1">
                                        Passphrase / PIN Keamanan TTE (6 Digit) <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-text bg-light text-secondary">
                                            <i class="bi bi-lock-fill" aria-hidden="true"></i>
                                        </span>
                                        <input type="password"
                                               name="pin_tte"
                                               id="passphraseInput"
                                               class="form-control py-2 doc-number-mono"
                                               placeholder="Masukkan 6 digit PIN TTE Kepala Dinas..."
                                               required
                                               {{ (!$activeDoc || $isSigned) ? 'disabled' : '' }}>
                                    </div>
                                    <div class="form-text" style="font-size: 0.71rem;">
                                        <i class="bi bi-info-circle me-1" aria-hidden="true"></i>Otentikasi `Hash::check()` menghasilkan Token UUID v4 unik &amp; QR Code SVG pada lembar A4.
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label for="catatanInput" class="form-label fw-semibold text-dark small mb-1">
                                        Catatan Otorisasi Pimpinan (Opsional)
                                    </label>
                                    <textarea name="catatan"
                                              id="catatanInput"
                                              class="form-control form-control-sm"
                                              rows="2"
                                              placeholder="Tambahkan catatan pengesahan TTE apabila diperlukan..."
                                              {{ (!$activeDoc || $isSigned) ? 'disabled' : '' }}>{{ old('catatan') }}</textarea>
                                </div>

                                <div class="d-grid gap-2">
                                    <button type="submit"
                                            class="btn btn-success fw-semibold py-2 px-3 rounded-2 d-flex align-items-center justify-content-center gap-2 shadow-sm"
                                            style="font-size: 0.86rem;"
                                            {{ (!$activeDoc || $isSigned) ? 'disabled' : '' }}>
                                        <i class="bi bi-qr-code-scan" aria-hidden="true"></i>
                                        <span>Sah &amp; Bubuhkan Tanda Tangan Elektronik (QR Code)</span>
                                    </button>
                                    <button type="button"
                                            data-bs-toggle="modal"
                                            data-bs-target="#modalRevisiKadin"
                                            class="btn btn-outline-danger btn-sm fw-medium py-2 px-3 rounded-2 d-flex align-items-center justify-content-center gap-2"
                                            style="font-size: 0.82rem;"
                                            {{ (!$activeDoc || $isSigned) ? 'disabled' : '' }}>
                                        <i class="bi bi-arrow-counterclockwise" aria-hidden="true"></i>
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

{{-- MODAL 1: KEMBALIKAN DOKUMEN UNTUK REVISI DARI KADIN --}}
<div class="modal fade" id="modalRevisiKadin" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow rounded-3">
            <form action="{{ $activeDoc['revisi_url'] ?? '#' }}" method="POST">
                @csrf
                <div class="modal-header border-bottom px-4 py-3">
                    <h6 class="modal-title fw-bold text-danger d-flex align-items-center gap-2">
                        <i class="bi bi-arrow-counterclockwise" aria-hidden="true"></i>
                        <span>Kembalikan Dokumen untuk Revisi (Status: Revisi)</span>
                    </h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body p-4 small">
                    <div class="p-2 px-3 rounded-2 mb-3 border" style="background-color: #FEF2F2; border-color: #FECACA !important;">
                        <div class="text-secondary" style="font-size: 0.72rem;">Naskah yang Dikembalikan:</div>
                        <div class="doc-number-mono text-danger fw-bold">{{ $activeDoc['nomor'] ?? '-' }}</div>
                        <div class="text-dark fw-medium mt-1" style="font-size: 0.76rem;">{{ $activeDoc['perihal'] ?? '-' }}</div>
                    </div>

                    <div class="mb-0">
                        <label for="inputCatatanRevisiKadin" class="form-label fw-semibold text-dark mb-1">
                            Catatan Koreksi / Instruksi Revisi Kepala Dinas <span class="text-danger">*</span>
                        </label>
                        <textarea name="catatan_revisi"
                                  id="inputCatatanRevisiKadin"
                                  class="form-control form-control-sm"
                                  rows="4"
                                  required
                                  minlength="5"
                                  placeholder="Tuliskan bagian redaksi, substansi, atau lampiran yang wajib diperbaiki oleh Staf Admin...">{{ old('catatan_revisi') }}</textarea>
                    </div>
                </div>
                <div class="modal-footer border-top px-4 py-2">
                    <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-sm btn-danger fw-semibold">
                        <i class="bi bi-send-exclamation me-1"></i>Ya, Kembalikan Dokumen untuk Revisi
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- MODAL 2: PRATINJAU LAMPIRAN BERKAS DI STORAGE --}}
<div class="modal fade" id="modalPratinjauLampiran" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content border-0 shadow rounded-3">
            <div class="modal-header border-bottom px-4 py-3">
                <div>
                    <h6 class="modal-title fw-bold text-dark d-flex align-items-center gap-2 mb-0">
                        <i class="bi bi-file-earmark-pdf-fill text-danger" aria-hidden="true"></i>
                        <span>Pratinjau Berkas Lampiran Naskah Dinas</span>
                    </h6>
                    <div class="text-secondary small">{{ $activeDoc['nomor'] ?? '-' }} &mdash; {{ $activeDoc['file_name'] ?? 'Lampiran' }}</div>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <a href="{{ $activeDoc['file_url'] ?? '#' }}" target="_blank" class="btn btn-sm btn-primary fw-semibold">
                        <i class="bi bi-box-arrow-up-right me-1"></i>Buka di Tab Baru
                    </a>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
            </div>
            <div class="modal-body p-0 bg-light" style="height: 72vh;">
                <iframe src="{{ $activeDoc['file_url'] ?? 'about:blank' }}" class="w-100 h-100 border-0" title="Pratinjau Lampiran"></iframe>
            </div>
        </div>
    </div>
</div>

{{-- MODAL 3: PENGATURAN PIN / PASSPHRASE TTE MANDIRI (ZERO-KNOWLEDGE ADMIN) --}}
<div class="modal fade" id="modalPinTte" tabindex="-1" aria-labelledby="modalPinTteLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow rounded-3">
            <form action="{{ route('kadin.pin-tte.update') }}" method="POST">
                @csrf
                @method('PATCH')
                <div class="modal-header border-bottom px-4 py-3">
                    <h6 class="modal-title fw-bold text-dark d-flex align-items-center gap-2" id="modalPinTteLabel">
                        <i class="bi bi-shield-lock-fill text-primary" aria-hidden="true"></i>
                        <span>Panel Keamanan PIN / Passphrase TTE Kadin</span>
                    </h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="p-3 rounded-2 mb-3 border" style="background-color: #ECFDF5; border-color: #A7F3D0 !important; font-size: 0.78rem;">
                        <strong class="text-success d-block mb-1"><i class="bi bi-patch-check-fill me-1" aria-hidden="true"></i>Sertifikat Elektronik BSrE Aktif (Zero-Knowledge Admin)</strong>
                        <span class="text-secondary">Otorisator: <strong>{{ $userName }}</strong> (NIP. {{ $userNip }})</span>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold small text-dark mb-1">Verifikasi PIN TTE Saat Ini / Kata Sandi Akun <span class="text-danger">*</span></label>
                        <input type="password" name="kredensial_verifikasi" class="form-control form-control-sm" placeholder="Masukkan PIN TTE lama atau Password login Anda..." required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold small text-dark mb-1">PIN TTE Baru (6 Digit Angka) <span class="text-danger">*</span></label>
                        <input type="password" name="pin_tte_baru" maxlength="6" pattern="\d{6}" inputmode="numeric" class="form-control form-control-sm doc-number-mono" placeholder="Contoh: 123456" required>
                    </div>
                    <div class="mb-0">
                        <label class="form-label fw-semibold small text-dark mb-1">Konfirmasi PIN TTE Baru (6 Digit Angka) <span class="text-danger">*</span></label>
                        <input type="password" name="pin_tte_baru_confirmation" maxlength="6" pattern="\d{6}" inputmode="numeric" class="form-control form-control-sm doc-number-mono" placeholder="Ketik ulang 6 digit PIN TTE baru..." required>
                    </div>
                </div>
                <div class="modal-footer border-top px-4 py-2">
                    <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-sm btn-primary fw-semibold">
                        <i class="bi bi-key-fill me-1"></i>Simpan Perubahan PIN TTE
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('js/esurat-motion.js') }}" defer></script>
</body>
</html>
