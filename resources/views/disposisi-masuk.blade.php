<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Disposisi Surat Masuk - Disdukcapil OKI</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@600;700;800&family=JetBrains+Mono:wght@500;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('css/esurat-modern.css') }}">
    <style>
        @media print {
            .sidebar, header, footer, .no-print {
                display: none !important;
            }
            .main-wrapper {
                margin-left: 0 !important;
            }
            body {
                background-color: #FFFFFF !important;
            }
            .surface-card {
                box-shadow: none !important;
                border: 1px solid #000000 !important;
            }
        }
    </style>
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

    $activeDisp = $activeSuratMasuk ? $activeSuratMasuk->disposisi->last() : null;
    $activeKodeBidang = $activeDisp?->kodeKlasifikasi?->kode_bidang
        ?? ($activeSuratMasuk?->kodeKlasifikasi?->kode_bidang ?? '400');

    $defaultUnitMap = [
        '400' => [
            'unit' => 'Bidang Catatan Sipil (Kode 400)',
            'penerima' => 'Drs. H. M. Amin, M.Si (Kabid PIAK & Capil)',
        ],
        '800' => [
            'unit' => 'Subbag Kepegawaian & Umum (Kode 800)',
            'penerima' => 'Hj. Siti Rahmawati, S.Sos., M.Si (Kasubbag Umpeg)',
        ],
        '00' => [
            'unit' => 'Subbag Keuangan (Kode 00)',
            'penerima' => 'Hendri Wijaya, S.E., Ak (Kasubbag Keuangan)',
        ],
    ];

    $selectedUnitValue = $activeDisp?->diserahkan_kepada_unit ?? ($defaultUnitMap[$activeKodeBidang]['unit'] ?? 'Bidang Catatan Sipil (Kode 400)');
    $selectedPenerimaValue = $activeDisp?->nama_pegawai_penerima ?? ($defaultUnitMap[$activeKodeBidang]['penerima'] ?? 'Drs. H. M. Amin, M.Si (Kabid PIAK & Capil)');
    $selectedTanggalTerima = $activeDisp?->tanggal_menerima?->format('Y-m-d') ?? now()->format('Y-m-d');
    $selectedSifat = $activeDisp?->sifat_disposisi ?? ($activeSuratMasuk?->sifat_surat ?? 'Segera');
    $selectedInstruksi = is_array($activeDisp?->instruksi_cepat) ? $activeDisp->instruksi_cepat : ['Tindak Lanjuti', 'Siapkan Konsep Balasan'];
    $selectedCatatan = $activeDisp?->catatan_kadin ?? 'Segera tindak lanjuti sesuai ketentuan peraturan perundang-undangan dan koordinasikan konsep balasan/laporan melalui Sekretaris Dinas sebelum dinaikkan untuk Tanda Tangan Elektronik Kepala Dinas.';
    $selectedStatusDisp = $activeDisp?->status_disposisi ?? 'diproses';
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
                <a href="/kadin/validasi" class="nav-link-sidebar">
                    <span class="d-flex align-items-center gap-3">
                        <i class="bi bi-qr-code-scan" aria-hidden="true"></i>
                        <span>Validasi &amp; TTE QR</span>
                    </span>
                    <span class="badge rounded-pill bg-danger {{ $badgeTte > 0 ? 'status-pulse' : '' }}" style="font-size: 0.68rem;">{{ $badgeTte }}</span>
                </a>
                <a href="/kadin/disposisi" class="nav-link-sidebar active">
                    <span class="d-flex align-items-center gap-3">
                        <i class="bi bi-inbox-fill" aria-hidden="true"></i>
                        <span>Disposisi Surat Masuk</span>
                    </span>
                    <span class="badge rounded-pill bg-warning text-dark fw-bold {{ $badgeDisposisi > 0 ? 'status-pulse' : '' }}" style="font-size: 0.68rem;">{{ $badgeDisposisi }}</span>
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

    <div class="flex-grow-1 d-flex flex-column min-vh-100 main-wrapper" style="margin-left: 260px;">
        <header class="topbar-glass px-4 py-2 d-flex align-items-center justify-content-between sticky-top" style="height: 58px;">
            <div class="small">
                <span class="text-secondary">Disdukcapil OKI</span>
                <span class="text-secondary mx-1">/</span>
                <span class="text-secondary">Disposisi Surat Masuk</span>
                <span class="text-secondary mx-1">/</span>
                <span class="text-primary fw-semibold">Lembar Disposisi Pimpinan</span>
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
                <div class="alert alert-success alert-dismissible fade show py-2 px-3 mb-3 d-flex align-items-center gap-2 border-0 shadow-sm no-print" role="alert" style="background-color: #DCFCE7; color: #15803D; font-size: 0.8rem;">
                    <i class="bi bi-check-circle-fill flex-shrink-0" aria-hidden="true"></i>
                    <div class="flex-grow-1">{{ session('status') }}</div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup" style="font-size: 0.65rem;"></button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show py-2 px-3 mb-3 d-flex align-items-center gap-2 border-0 shadow-sm no-print" role="alert" style="background-color: #FEE2E2; color: #B91C1C; font-size: 0.8rem;">
                    <i class="bi bi-shield-exclamation flex-shrink-0" aria-hidden="true"></i>
                    <div class="flex-grow-1">{{ session('error') }}</div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup" style="font-size: 0.65rem;"></button>
                </div>
            @endif

            @if (isset($errors) && $errors->any())
                <div class="alert alert-danger alert-dismissible fade show py-2 px-3 mb-3 border-0 shadow-sm no-print" data-no-autodismiss="true" role="alert" style="background-color: #FEE2E2; color: #B91C1C; font-size: 0.8rem;">
                    <div class="fw-bold mb-1"><i class="bi bi-exclamation-triangle-fill me-1"></i>Validasi Disposisi Gagal:</div>
                    <ul class="mb-0 ps-3">
                        @foreach ($errors->all() as $err)
                            <li>{{ $err }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup" style="font-size: 0.65rem;"></button>
                </div>
            @endif

            {{-- BARIS PEMILIHAN ANTREAN SURAT MASUK YANG SUDAH NAIK KE AJUDAN / KADIN --}}
            <div class="surface-card p-3 px-4 mb-4 no-print animate-fade-up">
                <div class="d-flex flex-column flex-lg-row align-items-lg-center justify-content-between gap-2">
                    <div>
                        <h6 class="heading-font fw-bold text-dark mb-1" style="font-size: 0.88rem;">
                            <i class="bi bi-inbox-fill text-primary me-1"></i>Daftar Surat Masuk di Meja Kepala Dinas (Diterima Ajudan)
                        </h6>
                        <div class="text-secondary" style="font-size: 0.74rem;">
                            Pilih nomor agenda surat masuk di bawah untuk memberikan instruksi disposisi baru atau mencetak lembar disposisi:
                        </div>
                    </div>
                    <div class="d-flex flex-wrap align-items-center gap-2">
                        @foreach($suratMasukKadinList as $smOption)
                            @php
                                $isCurrentSm = $activeSuratMasuk && $activeSuratMasuk->id === $smOption->id;
                                $belumDisposisi = $smOption->disposisi->isEmpty();
                            @endphp
                            <a href="{{ route('kadin.disposisi', ['surat_masuk_id' => $smOption->id]) }}"
                               class="btn btn-sm {{ $isCurrentSm ? 'btn-primary fw-semibold shadow-sm' : ($belumDisposisi ? 'btn-outline-danger fw-semibold' : 'btn-outline-secondary') }} py-1 px-2 d-inline-flex align-items-center gap-1"
                               style="font-size: 0.74rem;">
                                <span class="doc-number-mono">#{{ $smOption->nomor_urut_agenda }}</span>
                                <span>&bull; {{ \Illuminate\Support\Str::limit($smOption->pengirim, 20) }}</span>
                                @if($belumDisposisi)
                                    <span class="badge rounded-pill bg-warning text-dark status-pulse" style="font-size: 0.62rem;">Baru</span>
                                @else
                                    <i class="bi bi-check2-circle"></i>
                                @endif
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>

            @if($activeSuratMasuk)
                <div class="row g-4 mb-4">
                    <div class="col-12 col-lg-5 animate-fade-up delay-1">
                        <div class="surface-card h-100 d-flex flex-column">
                            <div class="px-4 py-3 border-bottom d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center gap-2">
                                    <div class="mini-stat-icon" style="width: 38px; height: 38px; font-size: 1.05rem; background-color: #DBEAFE; color: #2563EB;">
                                        <i class="bi bi-envelope-open-fill" aria-hidden="true"></i>
                                    </div>
                                    <div>
                                        <h6 class="heading-font fw-bold text-dark mb-0" style="font-size: 0.88rem;">Detail Agenda Surat Masuk (#{{ $activeSuratMasuk->nomor_urut_agenda }})</h6>
                                        <div class="text-secondary" style="font-size: 0.73rem;">Registrasi Buku Agenda &amp; Pelacakan Ajudan</div>
                                    </div>
                                </div>
                                <span class="badge rounded-2 px-2 py-1 fw-semibold doc-number-mono" style="background-color: #DBEAFE; color: #1D4ED8; font-size: 0.73rem;">
                                    #{{ $activeSuratMasuk->nomor_urut_agenda }}
                                </span>
                            </div>

                            <div class="p-4 flex-grow-1 d-flex flex-column justify-content-between">
                                <div>
                                    <div class="row g-3 mb-3">
                                        <div class="col-6">
                                            <div class="p-2 px-3 rounded-2 border" style="background-color: var(--color-slate-50);">
                                                <div class="text-secondary" style="font-size: 0.72rem;">Nomor Urut Agenda</div>
                                                <div class="fw-bold text-dark doc-number-mono fs-6">#{{ $activeSuratMasuk->nomor_urut_agenda }}</div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="p-2 px-3 rounded-2 border" style="background-color: var(--color-slate-50);">
                                                <div class="text-secondary" style="font-size: 0.72rem;">Tanggal Diterima Disdukcapil</div>
                                                <div class="fw-bold text-dark" style="font-size: 0.9rem;">{{ $activeSuratMasuk->tanggal_diterima?->format('d M Y') ?? '-' }}</div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3 pb-3 border-bottom d-flex align-items-center justify-content-between">
                                        <div>
                                            <div class="text-secondary mb-1" style="font-size: 0.74rem;">Pengirim Surat</div>
                                            <div class="fw-bold text-dark" style="font-size: 0.9rem;">{{ $activeSuratMasuk->pengirim }}</div>
                                        </div>
                                        <span class="badge rounded-pill bg-danger bg-opacity-10 text-danger fw-semibold px-2 py-1" style="font-size: 0.7rem;">
                                            Sifat: {{ $activeSuratMasuk->sifat_surat }}
                                        </span>
                                    </div>

                                    <div class="row g-3 mb-3 pb-3 border-bottom">
                                        <div class="col-5">
                                            <div class="text-secondary mb-1" style="font-size: 0.74rem;">Tanggal Surat</div>
                                            <div class="fw-semibold text-dark" style="font-size: 0.84rem;">{{ $activeSuratMasuk->tanggal_surat?->format('d M Y') ?? '-' }}</div>
                                        </div>
                                        <div class="col-7">
                                            <div class="text-secondary mb-1" style="font-size: 0.74rem;">Keterangan Nomor Surat</div>
                                            <div class="doc-number-mono text-primary">{{ $activeSuratMasuk->nomor_surat }}</div>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <div class="text-secondary mb-1" style="font-size: 0.74rem;">Perihal Surat</div>
                                        <div class="p-3 rounded-2 border text-dark fw-medium" style="background-color: var(--color-slate-50); font-size: 0.84rem; line-height: 1.5;">
                                            {{ $activeSuratMasuk->perihal }}
                                        </div>
                                    </div>

                                    <div class="ajudan-tracking-box p-3 mb-4">
                                        <div class="d-flex align-items-center justify-content-between mb-2">
                                            <span class="fw-bold text-success d-flex align-items-center gap-1" style="font-size: 0.76rem;">
                                                <i class="bi bi-arrow-up-right-circle-fill" aria-hidden="true"></i> Pelacakan Kenaikan Surat ke Kadin
                                            </span>
                                            <span class="badge rounded-pill bg-success text-white fw-medium px-2 py-1" style="font-size: 0.69rem;">
                                                <i class="bi bi-check2-circle me-1" aria-hidden="true"></i>Diterima Ajudan Kadin
                                            </span>
                                        </div>
                                        <div class="row g-2 pt-1" style="font-size: 0.78rem;">
                                            <div class="col-12 col-sm-6">
                                                <div class="text-secondary" style="font-size: 0.71rem;">Tanggal Naik ke Kadin</div>
                                                <div class="fw-semibold text-dark doc-number-mono">
                                                    <i class="bi bi-clock me-1 text-success" aria-hidden="true"></i>{{ $activeSuratMasuk->tanggal_naik_kadin ? $activeSuratMasuk->tanggal_naik_kadin->format('d M Y, H:i') . ' WIB' : '-' }}
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-6">
                                                <div class="text-secondary" style="font-size: 0.71rem;">Nama Ajudan Penerima</div>
                                                <div class="fw-semibold text-dark">
                                                    <i class="bi bi-person-check-fill me-1 text-success" aria-hidden="true"></i>{{ $activeSuratMasuk->nama_ajudan_penerima ?? 'Rizky Pratama, S.IP' }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-grid no-print">
                                    <button type="button" data-bs-toggle="modal" data-bs-target="#modalLampiranPdf" class="btn btn-outline-primary btn-sm fw-semibold py-2 rounded-2 d-flex align-items-center justify-content-center gap-2" style="font-size: 0.84rem;">
                                        <i class="bi bi-file-earmark-pdf-fill text-danger" aria-hidden="true"></i>
                                        <span>Lihat Lampiran PDF Surat Masuk</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-lg-7 animate-fade-up delay-2">
                        <div class="surface-card h-100 d-flex flex-column">
                            <div class="px-4 py-3 border-bottom d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center gap-2">
                                    <div class="mini-stat-icon" style="width: 38px; height: 38px; font-size: 1.05rem; background-color: #FEF3C7; color: #D97706;">
                                        <i class="bi bi-send-check-fill" aria-hidden="true"></i>
                                    </div>
                                    <div>
                                        <h6 class="heading-font fw-bold text-dark mb-0" style="font-size: 0.88rem;">Form Instruksi Disposisi Kadin &amp; Penyerahan</h6>
                                        <div class="text-secondary" style="font-size: 0.73rem;">Penentuan bidang penerima (400, 800, 00), tanggal terima, dan arahan Kepala Dinas</div>
                                    </div>
                                </div>
                                @if($activeDisp)
                                    <span class="badge rounded-pill fw-semibold px-2 py-1" style="background-color: #DCFCE7; color: #15803D; font-size: 0.71rem;">
                                        <i class="bi bi-check-circle-fill me-1" aria-hidden="true"></i>Telah Didisposisi ({{ strtoupper($activeDisp->status_disposisi) }})
                                    </span>
                                @else
                                    <span class="badge rounded-pill fw-semibold px-2 py-1 status-pulse" style="background-color: #FEF3C7; color: #B45309; font-size: 0.71rem;">
                                        <i class="bi bi-hourglass-split me-1" aria-hidden="true"></i>Menunggu Disposisi
                                    </span>
                                @endif
                            </div>

                            <div class="p-4 flex-grow-1">
                                <form action="{{ route('kadin.disposisi.store', $activeSuratMasuk->id) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="kode_bidang" id="inputKodeBidangDisposisi" value="{{ old('kode_bidang', $activeKodeBidang) }}">

                                    <div class="mb-3">
                                        <label class="form-label fw-semibold text-dark small mb-2">
                                            Diteruskan ke Bidang / Subbagian (Kode Klasifikasi) <span class="text-danger">*</span>
                                        </label>
                                        <div class="row g-2" id="unitCardsContainer">
                                            <div class="col-12 col-md-4">
                                                <label class="unit-option-card {{ $activeKodeBidang === '400' ? 'selected' : '' }} d-flex align-items-start gap-2 w-100" style="cursor: pointer;" onclick="selectUnitDisposisi(this, '400', 'Drs. H. M. Amin, M.Si (Kabid PIAK & Capil)')">
                                                    <input class="form-check-input mt-1" type="radio" name="diserahkan_kepada_unit" value="Bidang Catatan Sipil (Kode 400)" {{ $activeKodeBidang === '400' ? 'checked' : '' }}>
                                                    <div>
                                                        <div class="fw-bold text-dark" style="font-size: 0.79rem;">Bidang Catatan Sipil</div>
                                                        <span class="badge bg-primary text-white mt-1 doc-number-mono" style="font-size: 0.68rem;">Kode 400</span>
                                                    </div>
                                                </label>
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <label class="unit-option-card {{ $activeKodeBidang === '800' ? 'selected' : '' }} d-flex align-items-start gap-2 w-100" style="cursor: pointer;" onclick="selectUnitDisposisi(this, '800', 'Hj. Siti Rahmawati, S.Sos., M.Si (Kasubbag Umpeg)')">
                                                    <input class="form-check-input mt-1" type="radio" name="diserahkan_kepada_unit" value="Subbag Kepegawaian & Umum (Kode 800)" {{ $activeKodeBidang === '800' ? 'checked' : '' }}>
                                                    <div>
                                                        <div class="fw-bold text-dark" style="font-size: 0.79rem;">Subbag Kepegawaian &amp; Umum</div>
                                                        <span class="badge bg-secondary text-white mt-1 doc-number-mono" style="font-size: 0.68rem;">Kode 800</span>
                                                    </div>
                                                </label>
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <label class="unit-option-card {{ $activeKodeBidang === '00' ? 'selected' : '' }} d-flex align-items-start gap-2 w-100" style="cursor: pointer;" onclick="selectUnitDisposisi(this, '00', 'Hendri Wijaya, S.E., Ak (Kasubbag Keuangan)')">
                                                    <input class="form-check-input mt-1" type="radio" name="diserahkan_kepada_unit" value="Subbag Keuangan (Kode 00)" {{ $activeKodeBidang === '00' ? 'checked' : '' }}>
                                                    <div>
                                                        <div class="fw-bold text-dark" style="font-size: 0.79rem;">Subbag Keuangan</div>
                                                        <span class="badge bg-secondary text-white mt-1 doc-number-mono" style="font-size: 0.68rem;">Kode 00</span>
                                                    </div>
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row g-3 mb-3">
                                        <div class="col-12 col-md-5">
                                            <label for="pegawaiPenerima" class="form-label fw-semibold text-dark small mb-1">
                                                Nama Penerima Disposisi <span class="text-danger">*</span>
                                            </label>
                                            <div class="input-group input-group-sm">
                                                <span class="input-group-text bg-light text-secondary"><i class="bi bi-person-vcard" aria-hidden="true"></i></span>
                                                <input type="text" name="nama_pegawai_penerima" id="pegawaiPenerima" class="form-control" value="{{ old('nama_pegawai_penerima', $selectedPenerimaValue) }}" placeholder="Masukkan nama pejabat / staf penerima..." required>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-4">
                                            <label for="tanggalMenerima" class="form-label fw-semibold text-dark small mb-1">
                                                Tanggal Terima <span class="text-danger">*</span>
                                            </label>
                                            <div class="input-group input-group-sm">
                                                <span class="input-group-text bg-light text-secondary"><i class="bi bi-calendar-event" aria-hidden="true"></i></span>
                                                <input type="date" name="tanggal_menerima" id="tanggalMenerima" class="form-control" value="{{ old('tanggal_menerima', $selectedTanggalTerima) }}" required>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-3">
                                            <label for="statusDisposisiSelect" class="form-label fw-semibold text-dark small mb-1">
                                                Status Tindak Lanjut
                                            </label>
                                            <select name="status_disposisi" id="statusDisposisiSelect" class="form-select form-select-sm fw-medium">
                                                <option value="diproses" {{ $selectedStatusDisp === 'diproses' ? 'selected' : '' }}>Diproses Unit</option>
                                                <option value="selesai" {{ $selectedStatusDisp === 'selesai' ? 'selected' : '' }}>Selesai</option>
                                                <option value="diarsipkan" {{ $selectedStatusDisp === 'diarsipkan' ? 'selected' : '' }}>Diarsipkan</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row g-3 mb-3">
                                        <div class="col-12 col-md-5">
                                            <label class="form-label fw-semibold text-dark small mb-2">
                                                Sifat Disposisi <span class="text-danger">*</span>
                                            </label>
                                            <div class="d-flex flex-wrap gap-2">
                                                @foreach(['Segera', 'Penting', 'Rahasia', 'Biasa'] as $sifatOpt)
                                                    <div class="form-check form-check-inline m-0 border rounded-2 px-2 py-1 bg-light">
                                                        <input class="form-check-input" type="radio" name="sifat_disposisi" id="sifat{{ $sifatOpt }}" value="{{ $sifatOpt }}" {{ $selectedSifat === $sifatOpt ? 'checked' : '' }}>
                                                        <label class="form-check-label {{ $sifatOpt === 'Segera' ? 'fw-semibold text-danger' : 'fw-medium text-dark' }}" for="sifat{{ $sifatOpt }}" style="font-size: 0.77rem;">{{ $sifatOpt }}</label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-7">
                                            <label class="form-label fw-semibold text-dark small mb-2">
                                                Instruksi Cepat Pimpinan
                                            </label>
                                            <div class="row g-2">
                                                @foreach(['Tindak Lanjuti', 'Siapkan Konsep Balasan', 'Koordinasikan', 'Arsipkan'] as $idxInst => $instOpt)
                                                    <div class="col-6">
                                                        <div class="form-check border rounded-2 px-3 py-1 bg-light">
                                                            <input class="form-check-input" type="checkbox" name="instruksi_cepat[]" value="{{ $instOpt }}" id="inst{{ $idxInst }}" {{ in_array($instOpt, $selectedInstruksi, true) ? 'checked' : '' }}>
                                                            <label class="form-check-label fw-medium text-dark" for="inst{{ $idxInst }}" style="font-size: 0.77rem;">{{ $instOpt }}</label>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-4">
                                        <label for="catatanKadin" class="form-label fw-semibold text-dark small mb-1">
                                            Catatan / Instruksi Khusus Kepala Dinas
                                        </label>
                                        <textarea name="catatan_kadin" id="catatanKadin" class="form-control form-control-sm" rows="3" style="font-size: 0.83rem;" placeholder="Tuliskan arahan spesifik Kepala Dinas kepada unit penerima...">{{ old('catatan_kadin', $selectedCatatan) }}</textarea>
                                    </div>

                                    <div class="d-flex flex-wrap align-items-center justify-content-end gap-2 pt-3 border-top no-print">
                                        <button type="button" onclick="window.print()" class="btn btn-outline-secondary btn-sm fw-medium px-3 py-2 rounded-2 d-inline-flex align-items-center gap-2" style="font-size: 0.82rem;">
                                            <i class="bi bi-printer" aria-hidden="true"></i>
                                            <span>Cetak Lembar Disposisi</span>
                                        </button>
                                        <button type="submit" class="btn btn-primary btn-sm fw-semibold px-4 py-2 rounded-2 d-inline-flex align-items-center gap-2 shadow-sm" style="font-size: 0.82rem;">
                                            <i class="bi bi-send-fill" aria-hidden="true"></i>
                                            <span>{{ $activeDisp ? 'Perbarui Instruksi Disposisi' : 'Kirim Instruksi Disposisi' }}</span>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <div class="surface-card overflow-hidden no-print animate-fade-up delay-3">
                <div class="p-3 px-4 border-bottom d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-2">
                    <div>
                        <h6 class="heading-font fw-bold text-dark mb-1">Riwayat Disposisi Surat Masuk ({{ $riwayatDisposisiList->count() }} Tercatat)</h6>
                        <div class="text-secondary" style="font-size: 0.76rem;">Rekam jejak kenaikan surat melalui ajudan dan penyerahan disposisi ke bidang/subbagian terkait.</div>
                    </div>
                    <a href="/buku-besar" class="btn btn-sm btn-outline-primary rounded-2 px-3 py-1 fw-medium" style="font-size: 0.75rem;">
                        <i class="bi bi-journal-bookmark me-1" aria-hidden="true"></i>Lihat di Buku Besar
                    </a>
                </div>

                <div class="table-responsive">
                    <table class="table table-ledger mb-0">
                        <thead>
                            <tr>
                                <th class="ps-4" style="width: 95px;">NO. URUT</th>
                                <th style="width: 245px;">PENGIRIM &amp; NO. SURAT</th>
                                <th style="width: 215px;">TANGGAL NAIK &amp; NAMA AJUDAN</th>
                                <th>DISERAHKAN KEPADA &amp; INSTRUKSI KADIN</th>
                                <th style="width: 155px;">STATUS DISPOSISI</th>
                                <th class="pe-4 text-end" style="width: 175px;">TINDAK LANJUT</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($riwayatDisposisiList as $dispRow)
                                @php
                                    $sm = $dispRow->suratMasuk;
                                    $kodeBid = $dispRow->kodeKlasifikasi->kode_bidang ?? '400';
                                    $unitBadgeStyle = match($kodeBid) {
                                        '800' => 'background-color: #FEF3C7; color: #B45309;',
                                        '00' => 'background-color: #F3F4F6; color: #374151; border: 1px solid #E5E7EB;',
                                        default => 'background-color: #DBEAFE; color: #1D4ED8;',
                                    };
                                @endphp
                                <tr>
                                    <td class="ps-4">
                                        <span class="fw-bold text-dark font-monospace">#{{ $sm->nomor_urut_agenda ?? '-' }}</span>
                                        <div class="text-secondary" style="font-size: 0.72rem;">{{ $sm?->tanggal_diterima?->format('d M Y') ?? '-' }}</div>
                                    </td>
                                    <td>
                                        <div class="fw-semibold text-dark">{{ $sm->pengirim ?? '-' }}</div>
                                        <div class="doc-number-mono text-primary mt-1">{{ $sm->nomor_surat ?? '-' }}</div>
                                        <div class="text-secondary small mt-1">{{ \Illuminate\Support\Str::limit($sm->perihal ?? '-', 55) }}</div>
                                    </td>
                                    <td>
                                        <div class="fw-medium text-dark doc-number-mono" style="font-size: 0.76rem;">
                                            {{ $sm?->tanggal_naik_kadin ? $sm->tanggal_naik_kadin->format('d M Y, H:i') . ' WIB' : '-' }}
                                        </div>
                                        <div class="text-secondary mt-1" style="font-size: 0.74rem;">
                                            <i class="bi bi-person-check text-success me-1" aria-hidden="true"></i>Ajudan: {{ $sm->nama_ajudan_penerima ?? 'Rizky Pratama, S.IP' }}
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge rounded-2 px-2 py-1 fw-semibold mb-1" style="{{ $unitBadgeStyle }} font-size: 0.7rem;">
                                            {{ $dispRow->diserahkan_kepada_unit }}
                                        </span>
                                        <div class="text-dark fw-medium" style="font-size: 0.75rem;">
                                            Penerima: {{ $dispRow->nama_pegawai_penerima }} &bull; {{ $dispRow->tanggal_menerima?->format('d M Y') }}
                                        </div>
                                        @if(!empty($dispRow->instruksi_cepat))
                                            <div class="d-flex flex-wrap gap-1 mt-1">
                                                @foreach((array) $dispRow->instruksi_cepat as $instTag)
                                                    <span class="badge bg-light text-secondary border fw-normal" style="font-size: 0.65rem;">{{ $instTag }}</span>
                                                @endforeach
                                            </div>
                                        @endif
                                        @if($dispRow->catatan_kadin)
                                            <div class="text-secondary fst-italic mt-1" style="font-size: 0.72rem;">
                                                "{{ \Illuminate\Support\Str::limit($dispRow->catatan_kadin, 85) }}"
                                            </div>
                                        @endif
                                    </td>
                                    <td>
                                        @if($dispRow->status_disposisi === 'selesai')
                                            <span class="badge rounded-pill fw-medium px-3 py-1" style="background-color: #DCFCE7; color: #15803D; font-size: 0.72rem;">
                                                <i class="bi bi-check-circle me-1" aria-hidden="true"></i>Selesai Ditindaklanjuti
                                            </span>
                                        @elseif($dispRow->status_disposisi === 'diarsipkan')
                                            <span class="badge rounded-pill fw-medium px-3 py-1" style="background-color: #DBEAFE; color: #1D4ED8; font-size: 0.72rem;">
                                                <i class="bi bi-archive me-1" aria-hidden="true"></i>Diarsipkan Unit
                                            </span>
                                        @else
                                            <span class="badge rounded-pill fw-medium px-3 py-1" style="background-color: #FEF3C7; color: #B45309; font-size: 0.72rem;">
                                                <i class="bi bi-clock-history me-1" aria-hidden="true"></i>Sedang Diproses
                                            </span>
                                        @endif
                                    </td>
                                    <td class="pe-4 text-end">
                                        <div class="d-inline-flex align-items-center gap-1">
                                            @if($dispRow->status_disposisi === 'diproses')
                                                <form action="{{ route('kadin.disposisi.status', $dispRow->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="hidden" name="status_disposisi" value="selesai">
                                                    <button type="submit" class="btn btn-sm btn-outline-success py-1 px-2" style="font-size: 0.71rem;" title="Tandai Selesai Ditindaklanjuti">
                                                        <i class="bi bi-check2"></i> Selesai
                                                    </button>
                                                </form>
                                            @endif
                                            @if($sm)
                                                <a href="{{ route('kadin.disposisi', ['surat_masuk_id' => $sm->id]) }}" class="btn btn-sm btn-outline-primary py-1 px-2" style="font-size: 0.71rem;">
                                                    <i class="bi bi-printer me-1"></i>Detail
                                                </a>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-4 text-secondary">Belum ada riwayat disposisi surat masuk.</td>
                                </tr>
                            @endforelse
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

{{-- MODAL 1: PRATINJAU LAMPIRAN PDF SURAT MASUK --}}
<div class="modal fade" id="modalLampiranPdf" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content border-0 shadow rounded-3">
            <div class="modal-header border-bottom px-4 py-3">
                <h6 class="modal-title fw-bold text-dark d-flex align-items-center gap-2">
                    <i class="bi bi-file-earmark-pdf-fill text-danger" aria-hidden="true"></i>
                    <span>Pratinjau Lampiran PDF Surat Masuk (#{{ $activeSuratMasuk->nomor_urut_agenda ?? '-' }})</span>
                </h6>
                <div class="d-flex align-items-center gap-2">
                    @if(!empty($activeSuratMasuk?->file_lampiran))
                        <a href="{{ asset('storage/' . $activeSuratMasuk->file_lampiran) }}" target="_blank" class="btn btn-sm btn-primary fw-semibold">
                            <i class="bi bi-box-arrow-up-right me-1"></i>Buka Berkas Asli di Tab Baru
                        </a>
                    @endif
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
            </div>
            @if(!empty($activeSuratMasuk?->file_lampiran))
                <div class="modal-body p-0 bg-light" style="height: 70vh;">
                    <iframe src="{{ asset('storage/' . $activeSuratMasuk->file_lampiran) }}" class="w-100 h-100 border-0" title="Lampiran Surat Masuk"></iframe>
                </div>
            @else
                <div class="modal-body p-4 bg-light small">
                    <div class="bg-white border rounded-2 p-4 shadow-sm">
                        <div class="d-flex align-items-center justify-content-between border-bottom pb-2 mb-3">
                            <div>
                                <div class="fw-bold text-dark">{{ strtoupper($activeSuratMasuk->pengirim ?? '-') }}</div>
                                <div class="doc-number-mono text-primary">Nomor: {{ $activeSuratMasuk->nomor_surat ?? '-' }} &bull; Tanggal Surat: {{ $activeSuratMasuk?->tanggal_surat?->format('d F Y') ?? '-' }}</div>
                            </div>
                            <span class="badge bg-secondary">Ringkasan Digital Buku Agenda</span>
                        </div>
                        <p class="text-dark fw-medium mb-2">Perihal: {{ $activeSuratMasuk->perihal ?? '-' }}</p>
                        <p class="text-secondary mb-0">
                            Agenda Surat Masuk <strong>#{{ $activeSuratMasuk->nomor_urut_agenda ?? '-' }}</strong> diterima pada {{ $activeSuratMasuk?->tanggal_diterima?->format('d F Y') ?? '-' }} dengan sifat <strong>{{ $activeSuratMasuk->sifat_surat ?? 'Biasa' }}</strong> dan diteruskan ke meja Kepala Dinas melalui Ajudan ({{ $activeSuratMasuk->nama_ajudan_penerima ?? 'Rizky Pratama, S.IP' }}).
                        </p>
                    </div>
                </div>
            @endif
            <div class="modal-footer border-top px-4 py-2">
                <button type="button" class="btn btn-sm btn-primary fw-semibold" data-bs-dismiss="modal">Tutup Pratinjau</button>
            </div>
        </div>
    </div>
</div>

{{-- MODAL 2: PENGATURAN PIN / PASSPHRASE TTE MANDIRI (ZERO-KNOWLEDGE ADMIN) --}}
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
<script>
    function selectUnitDisposisi(cardEl, kodeBidang, defaultRecipient) {
        document.querySelectorAll('#unitCardsContainer .unit-option-card').forEach(function(el) {
            el.classList.remove('selected');
        });
        cardEl.classList.add('selected');
        document.getElementById('inputKodeBidangDisposisi').value = kodeBidang;
        document.getElementById('pegawaiPenerima').value = defaultRecipient;
    }
</script>
</body>
</html>
