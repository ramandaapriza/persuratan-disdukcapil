<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat &amp; Pantauan Naskah Dinas - Disdukcapil OKI</title>
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
    $userRole = $authUser->role ?? 'admin';
    $userName = $authUser->nama_lengkap ?? 'Staf Admin';
    $userJabatan = $authUser->jabatan ?? 'Staf Administrasi Umpeg';
    $userNip = $authUser->nip ?? '-';

    $cleanName = preg_replace('/^(Drs\.|Ir\.|H\.|Hj\.|Dr\.|Prof\.)\s+/i', '', $userName);
    $cleanName = preg_replace('/^(Drs\.|Ir\.|H\.|Hj\.|Dr\.|Prof\.)\s+/i', '', $cleanName);
    $cleanName = explode(',', $cleanName)[0];
    $words = array_values(array_filter(explode(' ', trim($cleanName))));
    $userInitials = strtoupper(substr($words[0] ?? 'S', 0, 1) . substr($words[1] ?? ($words[0] ?? 'A'), 0, 1));

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

    $sidebarRevisiCount = $countRevisi ?? 0;
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
            @if(auth()->user()->role === 'admin')
                <div class="sidebar-section-label">MENU UTAMA &amp; AGENDA</div>
                <a href="/" class="nav-link-sidebar">
                    <span class="d-flex align-items-center gap-3">
                        <i class="bi bi-grid" aria-hidden="true"></i>
                        <span>Dashboard Admin</span>
                    </span>
                </a>
                <a href="/registrasi-surat" class="nav-link-sidebar">
                    <span class="d-flex align-items-center gap-3">
                        <i class="bi bi-send" aria-hidden="true"></i>
                        <span>Registrasi &amp; Agenda Naskah</span>
                    </span>
                </a>
                <a href="/riwayat-naskah" class="nav-link-sidebar active">
                    <span class="d-flex align-items-center gap-3">
                        <i class="bi bi-clock-history" aria-hidden="true"></i>
                        <span>Riwayat &amp; Pantauan Naskah</span>
                    </span>
                    @if($sidebarRevisiCount > 0)
                        <span class="badge rounded-pill bg-danger text-white fw-bold status-pulse" style="font-size: 0.68rem;">{{ $sidebarRevisiCount }}</span>
                    @endif
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

                <div class="sidebar-section-label">ADMINISTRASI &amp; KEAMANAN</div>
                <a href="/admin/users" class="nav-link-sidebar">
                    <span class="d-flex align-items-center gap-3">
                        <i class="bi bi-people" aria-hidden="true"></i>
                        <span>Manajemen Akun Pegawai</span>
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
                <span class="badge bg-success text-white" style="font-size: 0.62rem;">RBAC</span>
            </div>
        </div>
    </aside>

    <div class="flex-grow-1 d-flex flex-column min-vh-100" style="margin-left: 260px;">
        <header class="topbar-glass px-4 py-2 d-flex align-items-center justify-content-between sticky-top" style="height: 58px;">
            <div class="small">
                <span class="text-secondary">Disdukcapil OKI</span>
                <span class="text-secondary mx-1">/</span>
                <span class="text-secondary">Operasional Admin</span>
                <span class="text-secondary mx-1">/</span>
                <span class="text-primary fw-semibold">Riwayat &amp; Pantauan Naskah</span>
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
                        <li><a class="dropdown-item" href="/registrasi-surat"><i class="bi bi-send-plus me-2"></i>Input Registrasi Naskah</a></li>
                        <li><a class="dropdown-item" href="/buku-besar"><i class="bi bi-journal-bookmark me-2"></i>Buku Besar Persuratan</a></li>
                        <li><a class="dropdown-item" href="/verifikasi-dokumen"><i class="bi bi-qr-code-scan me-2"></i>Portal Verifikasi Publik</a></li>
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
                    <div class="fw-bold mb-1"><i class="bi bi-exclamation-octagon-fill me-1"></i>Validasi Perbaikan Naskah Gagal:</div>
                    <ul class="mb-0 ps-3">
                        @foreach ($errors->all() as $err)
                            <li>{{ $err }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup" style="font-size: 0.65rem;"></button>
                </div>
            @endif

            {{-- HEADER PAGE BANNER --}}
            <div class="surface-card p-3 px-4 mb-4 animate-fade-up">
                <div class="d-flex flex-column flex-lg-row align-items-lg-center justify-content-between gap-3">
                    <div>
                        <div class="d-flex align-items-center gap-2 mb-1">
                            <span class="badge rounded-pill px-2 py-1 fw-semibold" style="background-color: #DBEAFE; color: #1D4ED8; font-size: 0.7rem;">
                                <i class="bi bi-broadcast-pin me-1" aria-hidden="true"></i>Pusat Kendali &amp; Pelacakan Progres Naskah (Staf Admin)
                            </span>
                            <span class="text-secondary" style="font-size: 0.73rem;">Lacak posisi meja verifikator, perbaiki naskah revisi, dan pantau progres surat masuk</span>
                        </div>
                        <h6 class="heading-font fw-bold text-dark mb-0">Riwayat &amp; Pantauan Operasional Naskah Dinas Real-Time</h6>
                    </div>

                    <div class="d-flex flex-wrap align-items-center gap-2">
                        <a href="/registrasi-surat" class="btn btn-primary btn-sm fw-semibold px-3 py-2 rounded-2 d-inline-flex align-items-center gap-2 shadow-sm" style="font-size: 0.78rem;">
                            <i class="bi bi-plus-circle-fill" aria-hidden="true"></i>
                            <span>Input Registrasi Naskah Baru</span>
                        </a>
                        <a href="/buku-besar" class="btn btn-outline-secondary btn-sm fw-medium px-3 py-2 rounded-2 d-inline-flex align-items-center gap-1" style="font-size: 0.78rem;">
                            <i class="bi bi-journal-bookmark" aria-hidden="true"></i>
                            <span>Arsip &amp; Ekspor Buku Besar</span>
                        </a>
                    </div>
                </div>
            </div>

            {{-- 5 KARTU RINGKASAN STATUS NASKAH REAL-TIME (CLICKABLE FILTER) --}}
            <div class="row g-3 mb-4">
                <div class="col-12 col-sm-6 col-xl animate-fade-up delay-1">
                    <div class="surface-card stat-card-filter p-3 h-100 d-flex align-items-center justify-content-between"
                         id="statCard-revisi"
                         onclick="applyQuickStatusFilter('revisi')"
                         style="{{ $countRevisi > 0 ? 'border-color: #FCA5A5; background-color: #FEF2F2;' : '' }}">
                        <div>
                            <div class="text-secondary fw-medium mb-1" style="font-size: 0.74rem;">Perlu Revisi Admin</div>
                            <div class="fs-4 fw-bold text-danger lh-1 mb-1 metric-value" data-countup="{{ $countRevisi }}">{{ $countRevisi }}</div>
                            <div class="text-danger fw-medium" style="font-size: 0.7rem;">
                                <i class="bi bi-arrow-counterclockwise me-1"></i>Status <code>revisi</code>
                            </div>
                        </div>
                        <div class="mini-stat-icon {{ $countRevisi > 0 ? 'status-pulse' : '' }}" style="background-color: #FEE2E2; color: #DC2626;">
                            <i class="bi bi-exclamation-triangle-fill"></i>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-xl animate-fade-up delay-1">
                    <div class="surface-card stat-card-filter p-3 h-100 d-flex align-items-center justify-content-between"
                         id="statCard-draf"
                         onclick="applyQuickStatusFilter('draf')">
                        <div>
                            <div class="text-secondary fw-medium mb-1" style="font-size: 0.74rem;">Menunggu Kasubbag</div>
                            <div class="fs-4 fw-bold lh-1 mb-1 metric-value" style="color: #D97706;" data-countup="{{ $countDraf }}">{{ $countDraf }}</div>
                            <div class="fw-medium" style="font-size: 0.7rem; color: #B45309;">
                                <i class="bi bi-hourglass-split me-1"></i>Tahap 1 (<code>draf</code>)
                            </div>
                        </div>
                        <div class="mini-stat-icon" style="background-color: #FEF3C7; color: #D97706;">
                            <i class="bi bi-clipboard2-check-fill"></i>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-xl animate-fade-up delay-2">
                    <div class="surface-card stat-card-filter p-3 h-100 d-flex align-items-center justify-content-between"
                         id="statCard-valid_kasubbag"
                         onclick="applyQuickStatusFilter('valid_kasubbag')">
                        <div>
                            <div class="text-secondary fw-medium mb-1" style="font-size: 0.74rem;">Menunggu Sekdin</div>
                            <div class="fs-4 fw-bold text-primary lh-1 mb-1 metric-value" data-countup="{{ $countValidKasubbag }}">{{ $countValidKasubbag }}</div>
                            <div class="text-primary fw-medium" style="font-size: 0.7rem;">
                                <i class="bi bi-vector-pen me-1"></i>Tahap 2 (<code>valid_kasubbag</code>)
                            </div>
                        </div>
                        <div class="mini-stat-icon" style="background-color: #DBEAFE; color: #2563EB;">
                            <i class="bi bi-pen-fill"></i>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-xl animate-fade-up delay-3">
                    <div class="surface-card stat-card-filter p-3 h-100 d-flex align-items-center justify-content-between"
                         id="statCard-valid_sekdin"
                         onclick="applyQuickStatusFilter('valid_sekdin')">
                        <div>
                            <div class="text-secondary fw-medium mb-1" style="font-size: 0.74rem;">Menunggu TTE Kadin</div>
                            <div class="fs-4 fw-bold lh-1 mb-1 metric-value" style="color: #7C3AED;" data-countup="{{ $countValidSekdin }}">{{ $countValidSekdin }}</div>
                            <div class="fw-medium" style="font-size: 0.7rem; color: #6D28D9;">
                                <i class="bi bi-qr-code-scan me-1"></i>Tahap 3 (<code>valid_sekdin</code>)
                            </div>
                        </div>
                        <div class="mini-stat-icon" style="background-color: #EDE9FE; color: #7C3AED;">
                            <i class="bi bi-qr-code"></i>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-xl animate-fade-up delay-4">
                    <div class="surface-card stat-card-filter p-3 h-100 d-flex align-items-center justify-content-between"
                         id="statCard-ttd_kadin"
                         onclick="applyQuickStatusFilter('ttd_kadin')">
                        <div>
                            <div class="text-secondary fw-medium mb-1" style="font-size: 0.74rem;">Selesai &amp; Sah TTE</div>
                            <div class="fs-4 fw-bold text-success lh-1 mb-1 metric-value" data-countup="{{ $countTtdKadin }}">{{ $countTtdKadin }}</div>
                            <div class="text-success fw-medium" style="font-size: 0.7rem;">
                                <i class="bi bi-patch-check-fill me-1"></i>Terbit QR (<code>ttd_kadin</code>)
                            </div>
                        </div>
                        <div class="mini-stat-icon" style="background-color: #DCFCE7; color: #16A34A;">
                            <i class="bi bi-shield-fill-check"></i>
                        </div>
                    </div>
                </div>
            </div>

            {{-- PANEL PRIORITAS KHUSUS REVISI: Melihat & Mengedit Ulang Naskah Berstatus 'revisi' --}}
            <div class="surface-card overflow-hidden mb-4 animate-fade-up delay-2" id="panel-revisi" style="{{ $naskahRevisi->isNotEmpty() ? 'border-color: #FCA5A5;' : '' }}">
                <div class="px-4 py-3 border-bottom d-flex flex-wrap align-items-center justify-content-between gap-2" style="background-color: {{ $naskahRevisi->isNotEmpty() ? '#FEF2F2' : '#F8FAFC' }};">
                    <div class="d-flex align-items-center gap-2">
                        <div class="mini-stat-icon {{ $naskahRevisi->isNotEmpty() ? 'status-pulse' : '' }}" style="width: 36px; height: 36px; font-size: 1rem; background-color: #FEE2E2; color: #DC2626;">
                            <i class="bi bi-arrow-counterclockwise" aria-hidden="true"></i>
                        </div>
                        <div>
                            <h6 class="heading-font fw-bold text-dark mb-0" style="font-size: 0.88rem;">Daftar Prioritas Naskah Dikembalikan untuk Revisi &amp; Pengajuan Ulang</h6>
                            <div class="text-secondary" style="font-size: 0.73rem;">Staf Admin dapat memperbaiki redaksi, mengubah nomor/tanggal, serta mengunggah ulang berkas lampiran sesuai catatan verifikator</div>
                        </div>
                    </div>
                    <span class="badge rounded-pill {{ $naskahRevisi->isNotEmpty() ? 'bg-danger text-white status-pulse' : 'bg-success bg-opacity-10 text-success' }} px-3 py-1 fw-semibold" style="font-size: 0.72rem;">
                        {{ $naskahRevisi->count() }} Naskah Berstatus Revisi
                    </span>
                </div>

                @if ($naskahRevisi->isNotEmpty())
                    <div class="table-responsive">
                        <table class="table table-ledger mb-0">
                            <thead>
                                <tr>
                                    <th class="ps-4">JENIS &amp; NOMOR NASKAH</th>
                                    <th>TANGGAL</th>
                                    <th>TUJUAN / MITRA / PEGAWAI</th>
                                    <th>PERIHAL / POKOK NASKAH</th>
                                    <th>CATATAN REVISI VERIFIKATOR</th>
                                    <th class="pe-4 text-end">TINDAK LANJUT ADMIN</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($naskahRevisi as $rev)
                                    <tr>
                                        <td class="ps-4">
                                            <div class="doc-number-mono text-primary">{{ $rev['nomor'] }}</div>
                                            <span class="badge bg-danger bg-opacity-10 text-danger fw-semibold mt-1" style="font-size: 0.68rem;">
                                                {{ $rev['jenis_label'] }} &bull; Kode {{ $rev['kode_bidang'] }}
                                            </span>
                                            @if(!empty($rev['file_url']))
                                                <div class="mt-1">
                                                    <button type="button" onclick="openLampiranByKey('{{ $rev['key'] }}')" class="btn btn-link p-0 text-decoration-none small" style="font-size: 0.7rem;">
                                                        <i class="bi bi-paperclip"></i> Pratinjau Berkas
                                                    </button>
                                                </div>
                                            @endif
                                        </td>
                                        <td class="text-secondary">{{ $rev['tanggal_display'] }}</td>
                                        <td class="fw-semibold text-dark">{{ $rev['tujuan'] }}</td>
                                        <td>
                                            <div class="text-dark fw-medium">{{ $rev['perihal'] }}</div>
                                        </td>
                                        <td>
                                            <div class="p-2 rounded-2 border" style="background-color: #FFFBEB; border-color: #FDE68A !important; color: #92400E; font-size: 0.75rem;">
                                                <i class="bi bi-exclamation-triangle-fill me-1" aria-hidden="true"></i>
                                                <strong>Koreksi:</strong> {{ $rev['catatan_revisi'] }}
                                            </div>
                                        </td>
                                        <td class="pe-4 text-end">
                                            <div class="d-inline-flex align-items-center gap-1">
                                                <button type="button"
                                                        onclick="openTimelineModalByKey('{{ $rev['key'] }}')"
                                                        class="btn btn-sm btn-outline-secondary px-2 py-1"
                                                        style="font-size: 0.73rem;"
                                                        title="Lihat Riwayat Log Verifikasi">
                                                    <i class="bi bi-diagram-3"></i>
                                                </button>
                                                <button type="button"
                                                        onclick="openEditNaskahByKey('{{ $rev['key'] }}')"
                                                        class="btn btn-sm btn-danger fw-semibold px-3 py-1 d-inline-flex align-items-center gap-1 shadow-sm"
                                                        style="font-size: 0.74rem;">
                                                    <i class="bi bi-pencil-square" aria-hidden="true"></i>
                                                    <span>Edit &amp; Ajukan Ulang</span>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="p-3 px-4 text-secondary small d-flex align-items-center gap-2">
                        <i class="bi bi-check-circle-fill text-success" aria-hidden="true"></i>
                        <span>Tidak ada naskah yang berstatus revisi saat ini. Seluruh konsep naskah telah sesuai atau sedang dalam proses verifikasi berjenjang.</span>
                    </div>
                @endif
            </div>

            {{-- TABEL PANTAUAN UTAMA & FILTER CEPAT --}}
            <div class="surface-card overflow-hidden animate-fade-up delay-3">
                <div class="px-4 pt-3 border-bottom d-flex flex-column flex-xl-row align-items-xl-center justify-content-between gap-2">
                    <div class="pb-2">
                        <h6 class="heading-font fw-bold text-dark mb-0" style="font-size: 0.9rem;">Meja Pantauan Progres Naskah Keluar, SPPD, Berita Acara, &amp; Agenda Surat Masuk</h6>
                        <div class="text-secondary" style="font-size: 0.74rem;">Klik <strong>"Lacak Log"</strong> untuk melihat posisi meja pejabat verifikator atau <strong>"Edit Konsep"</strong> untuk memperbarui naskah.</div>
                    </div>

                    <ul class="nav nav-tabs ledger-tabs border-0 flex-wrap" id="kategoriTabNav">
                        <li class="nav-item">
                            <button type="button" class="nav-link active d-inline-flex align-items-center gap-2" data-kategori="all_keluar" onclick="switchKategoriTab('all_keluar', this)">
                                <i class="bi bi-layers-fill"></i>
                                <span>Semua Naskah Hierarki</span>
                                <span class="badge rounded-pill bg-primary bg-opacity-10 text-primary">{{ $semuaNaskahKeluar->count() }}</span>
                            </button>
                        </li>
                        <li class="nav-item">
                            <button type="button" class="nav-link d-inline-flex align-items-center gap-2" data-kategori="surat_keluar" onclick="switchKategoriTab('surat_keluar', this)">
                                <i class="bi bi-send-fill text-primary"></i>
                                <span>Surat Keluar</span>
                                <span class="badge rounded-pill bg-light text-dark border">{{ $semuaNaskahKeluar->where('jenis', 'surat_keluar')->count() }}</span>
                            </button>
                        </li>
                        <li class="nav-item">
                            <button type="button" class="nav-link d-inline-flex align-items-center gap-2" data-kategori="sppd" onclick="switchKategoriTab('sppd', this)">
                                <i class="bi bi-briefcase-fill text-warning"></i>
                                <span>SPPD</span>
                                <span class="badge rounded-pill bg-light text-dark border">{{ $semuaNaskahKeluar->where('jenis', 'sppd')->count() }}</span>
                            </button>
                        </li>
                        <li class="nav-item">
                            <button type="button" class="nav-link d-inline-flex align-items-center gap-2" data-kategori="berita_acara" onclick="switchKategoriTab('berita_acara', this)">
                                <i class="bi bi-file-earmark-text-fill" style="color: #7C3AED;"></i>
                                <span>Berita Acara</span>
                                <span class="badge rounded-pill bg-light text-dark border">{{ $semuaNaskahKeluar->where('jenis', 'berita_acara')->count() }}</span>
                            </button>
                        </li>
                        <li class="nav-item">
                            <button type="button" class="nav-link d-inline-flex align-items-center gap-2" data-kategori="surat_masuk" onclick="switchKategoriTab('surat_masuk', this)">
                                <i class="bi bi-inbox-fill text-success"></i>
                                <span>Progres Surat Masuk</span>
                                <span class="badge rounded-pill {{ $countSuratMasukBelumNaik > 0 ? 'bg-warning text-dark' : 'bg-light text-dark border' }}">{{ $countSuratMasuk }}</span>
                            </button>
                        </li>
                    </ul>
                </div>

                {{-- BARIS FILTER & PENCARIAN --}}
                <div class="p-3 px-4 bg-light border-bottom d-flex flex-wrap align-items-center justify-content-between gap-2">
                    <div class="d-flex flex-wrap align-items-center gap-2" id="filterHierarkiControls">
                        <div class="d-flex align-items-center gap-1">
                            <span class="text-secondary fw-semibold" style="font-size: 0.74rem;"><i class="bi bi-funnel me-1"></i>Status:</span>
                            <select id="filterStatusSelect" onchange="filterRiwayatTable()" class="form-select form-select-sm" style="width: 215px; font-size: 0.76rem;">
                                <option value="all">Semua Status Hierarki</option>
                                <option value="revisi">Perlu Revisi Admin (revisi)</option>
                                <option value="draf">Tahap 1: Menunggu Kasubbag (draf)</option>
                                <option value="valid_kasubbag">Tahap 2: Menunggu Sekdin (valid_kasubbag)</option>
                                <option value="valid_sekdin">Tahap 3: Menunggu TTE Kadin (valid_sekdin)</option>
                                <option value="ttd_kadin">Selesai: Sah Ber-TTE Kadin (ttd_kadin)</option>
                            </select>
                        </div>

                        <div class="d-flex align-items-center gap-1">
                            <span class="text-secondary fw-semibold" style="font-size: 0.74rem;">Kode Bidang:</span>
                            <select id="filterBidangSelect" onchange="filterRiwayatTable()" class="form-select form-select-sm" style="width: 195px; font-size: 0.76rem;">
                                <option value="all">Semua Kode Bidang</option>
                                <option value="400">Kode 400 - Catatan Sipil</option>
                                <option value="800">Kode 800 - Kepegawaian &amp; Umum</option>
                                <option value="00">Kode 00 - Keuangan / Dana</option>
                            </select>
                        </div>

                        <button type="button" onclick="resetAllFilters()" class="btn btn-sm btn-outline-secondary py-1 px-2" style="font-size: 0.74rem;">
                            <i class="bi bi-arrow-repeat me-1"></i>Reset Filter
                        </button>
                    </div>

                    <div class="input-group input-group-sm" style="width: 290px;">
                        <span class="input-group-text bg-white border-end-0 text-secondary">
                            <i class="bi bi-search" aria-hidden="true"></i>
                        </span>
                        <input type="text" id="searchRiwayatInput" oninput="filterRiwayatTable()" class="form-control border-start-0 ps-0" placeholder="Cari nomor naskah, perihal, tujuan...">
                    </div>
                </div>

                {{-- SECTION 1: TABEL NASKAH HIERARKI (SURAT KELUAR, SPPD, BERITA ACARA) --}}
                <div id="sectionTabelHierarki" class="table-responsive">
                    <table class="table table-ledger mb-0" id="tabelRiwayatKeluar">
                        <thead>
                            <tr>
                                <th class="ps-4">NOMOR NASKAH &amp; KODE</th>
                                <th>KATEGORI</th>
                                <th>TANGGAL</th>
                                <th>TUJUAN / PEGAWAI / MITRA</th>
                                <th>PERIHAL &amp; CATATAN VERIFIKATOR</th>
                                <th>POSISI MEJA &amp; STATUS</th>
                                <th class="pe-4 text-end">AKSI &amp; PELACAKAN</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($semuaNaskahKeluar as $item)
                                @php
                                    $bidangBadgeClass = match($item['kode_bidang']) {
                                        '800' => 'bg-warning bg-opacity-15 text-dark',
                                        '00' => 'bg-secondary bg-opacity-10 text-dark border',
                                        default => 'bg-primary bg-opacity-10 text-primary',
                                    };
                                @endphp
                                <tr class="row-naskah-keluar {{ $item['status'] === 'revisi' ? 'table-danger bg-opacity-10' : '' }}"
                                    data-jenis="{{ $item['jenis'] }}"
                                    data-status="{{ $item['status'] }}"
                                    data-bidang="{{ $item['kode_bidang'] }}">
                                    <td class="ps-4">
                                        <div class="doc-number-mono text-primary">{{ $item['nomor'] }}</div>
                                        <div class="d-flex flex-wrap align-items-center gap-1 mt-1">
                                            <span class="badge {{ $bidangBadgeClass }} fw-medium" style="font-size: 0.66rem;">
                                                Kode {{ $item['kode_bidang'] }}
                                            </span>
                                            @if(!empty($item['file_url']))
                                                <button type="button"
                                                        onclick="openLampiranByKey('{{ $item['key'] }}')"
                                                        class="badge bg-info bg-opacity-10 text-primary border border-primary border-opacity-25 fw-medium"
                                                        style="font-size: 0.65rem; cursor: pointer;">
                                                    <i class="bi bi-paperclip me-1"></i>Berkas
                                                </button>
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge rounded-2 px-2 py-1 fw-semibold" style="background-color: {{ $item['jenis_badge_bg'] }}; color: {{ $item['jenis_badge_color'] }}; font-size: 0.71rem;">
                                            {{ $item['jenis_label'] }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="text-dark fw-medium">{{ $item['tanggal_display'] }}</div>
                                        <div class="text-secondary" style="font-size: 0.69rem;">Oleh: {{ $item['pengaju_nama'] }}</div>
                                    </td>
                                    <td>
                                        <div class="fw-semibold text-dark">{{ $item['tujuan'] }}</div>
                                        <div class="text-secondary" style="font-size: 0.71rem;">{{ $item['sub_tujuan'] }}</div>
                                    </td>
                                    <td>
                                        <div class="text-dark fw-medium">{{ $item['perihal'] }}</div>
                                        @if ($item['status'] === 'revisi' && $item['catatan_revisi'])
                                            <div class="text-danger small mt-1 fw-semibold" style="font-size: 0.72rem;">
                                                <i class="bi bi-exclamation-circle-fill me-1" aria-hidden="true"></i>Catatan Revisi: {{ $item['catatan_revisi'] }}
                                            </div>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($item['status'] === 'revisi')
                                            <span class="badge rounded-pill bg-danger text-white px-2 py-1 status-pulse" style="font-size: 0.71rem;">
                                                <i class="bi bi-arrow-counterclockwise me-1" aria-hidden="true"></i>Perlu Revisi Admin
                                            </span>
                                        @elseif ($item['status'] === 'draf')
                                            <span class="badge rounded-pill px-2 py-1" style="background-color: #FEF3C7; color: #B45309; font-size: 0.71rem;">
                                                <i class="bi bi-hourglass-split me-1" aria-hidden="true"></i>Tahap 1: Kasubbag
                                            </span>
                                        @elseif ($item['status'] === 'valid_kasubbag')
                                            <span class="badge rounded-pill px-2 py-1" style="background-color: #DBEAFE; color: #1D4ED8; font-size: 0.71rem;">
                                                <i class="bi bi-check2-circle me-1" aria-hidden="true"></i>Tahap 2: Sekdin
                                            </span>
                                        @elseif ($item['status'] === 'valid_sekdin')
                                            <span class="badge rounded-pill px-2 py-1" style="background-color: #EDE9FE; color: #6D28D9; font-size: 0.71rem;">
                                                <i class="bi bi-qr-code-scan me-1" aria-hidden="true"></i>Menunggu TTE Kadin
                                            </span>
                                        @elseif ($item['status'] === 'ttd_kadin')
                                            <span class="badge rounded-pill px-2 py-1" style="background-color: #DCFCE7; color: #15803D; font-size: 0.71rem;">
                                                <i class="bi bi-patch-check-fill me-1" aria-hidden="true"></i>Sah Ber-TTE Kadin
                                            </span>
                                        @endif
                                        <div class="text-secondary mt-1" style="font-size: 0.68rem;">
                                            {{ $item['posisi_meja'] }}
                                        </div>
                                    </td>
                                    <td class="pe-4 text-end">
                                        <div class="d-inline-flex align-items-center gap-1">
                                            <button type="button"
                                                    onclick="openTimelineModalByKey('{{ $item['key'] }}')"
                                                    class="btn btn-sm btn-outline-secondary px-2 py-1 d-inline-flex align-items-center gap-1"
                                                    style="font-size: 0.72rem;">
                                                <i class="bi bi-diagram-3" aria-hidden="true"></i>
                                                <span>Lacak Log</span>
                                            </button>

                                            @if (in_array($item['status'], ['revisi', 'draf']))
                                                <button type="button"
                                                        onclick="openEditNaskahByKey('{{ $item['key'] }}')"
                                                        class="btn btn-sm {{ $item['status'] === 'revisi' ? 'btn-danger' : 'btn-outline-primary' }} fw-semibold px-2 py-1 d-inline-flex align-items-center gap-1"
                                                        style="font-size: 0.72rem;">
                                                    <i class="bi bi-pencil-square" aria-hidden="true"></i>
                                                    <span>{{ $item['status'] === 'revisi' ? 'Perbaiki Revisi' : 'Edit Konsep' }}</span>
                                                </button>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-4 text-secondary">Belum ada data naskah dinas tercatat.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- SECTION 2: TABEL PELACAKAN PROGRES SURAT MASUK (DIAGENDAKAN -> AJUDAN -> DISPOSISI KADIN) --}}
                <div id="sectionTabelSuratMasuk" class="table-responsive d-none">
                    <table class="table table-ledger mb-0" id="tabelRiwayatSuratMasuk">
                        <thead>
                            <tr>
                                <th class="ps-4">NO. AGENDA &amp; KODE</th>
                                <th>TGL DITERIMA</th>
                                <th>PENGIRIM &amp; NOMOR SURAT</th>
                                <th>PERIHAL SURAT MASUK</th>
                                <th>PROGRES AJUDAN &amp; DISPOSISI KADIN</th>
                                <th>STATUS</th>
                                <th class="pe-4 text-end">TINDAK LANJUT</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($suratMasukList as $sm)
                                <tr class="row-surat-masuk" data-bidang="{{ $sm->kodeKlasifikasi->kode_bidang ?? '400' }}">
                                    <td class="ps-4">
                                        <div class="fw-bold text-dark font-monospace">#{{ $sm->nomor_urut_agenda }}</div>
                                        <span class="badge bg-primary bg-opacity-10 text-primary fw-medium mt-1" style="font-size: 0.66rem;">
                                            Kode {{ $sm->kodeKlasifikasi->kode_bidang ?? '400' }}
                                        </span>
                                        @if($sm->file_lampiran)
                                            <div class="mt-1">
                                                <a href="{{ asset('storage/' . $sm->file_lampiran) }}" target="_blank" class="badge bg-info bg-opacity-10 text-primary text-decoration-none border border-primary border-opacity-25" style="font-size: 0.65rem;">
                                                    <i class="bi bi-paperclip me-1"></i>Berkas Scan
                                                </a>
                                            </div>
                                        @endif
                                    </td>
                                    <td class="text-secondary">{{ $sm->tanggal_diterima?->format('d M Y') }}</td>
                                    <td>
                                        <div class="fw-semibold text-dark">{{ $sm->pengirim }}</div>
                                        <div class="doc-number-mono text-primary mt-1">{{ $sm->nomor_surat }}</div>
                                    </td>
                                    <td>
                                        <div class="text-dark fw-medium">{{ $sm->perihal }}</div>
                                        <div class="text-secondary mt-1" style="font-size: 0.71rem;">
                                            Sifat: <strong>{{ $sm->sifat_surat }}</strong> &bull; Tgl Surat: {{ $sm->tanggal_surat?->format('d M Y') }}
                                        </div>
                                    </td>
                                    <td>
                                        @php
                                            $disp = $sm->disposisi->last();
                                        @endphp
                                        @if ($disp)
                                            <div class="p-2 rounded-2 border" style="background-color: #F0FDF4; border-color: #BBF7D0 !important; font-size: 0.73rem;">
                                                <div class="fw-bold text-success">
                                                    <i class="bi bi-check2-all me-1"></i>Didisposisi ke: {{ $disp->diserahkan_kepada_unit }}
                                                </div>
                                                <div class="text-dark">Penerima: {{ $disp->nama_pegawai_penerima }}</div>
                                                @if($disp->catatan_kadin)
                                                    <div class="text-secondary fst-italic mt-1">"{{ \Illuminate\Support\Str::limit($disp->catatan_kadin, 95) }}"</div>
                                                @endif
                                                @if($disp->kadin)
                                                    <div class="text-secondary mt-1" style="font-size: 0.68rem;">
                                                        <i class="bi bi-person-badge me-1"></i>Oleh: {{ $disp->kadin->nama_lengkap }}
                                                    </div>
                                                @endif
                                            </div>
                                        @elseif ($sm->status_kenaikan === 'diterima_ajudan')
                                            <div class="text-dark fw-medium" style="font-size: 0.75rem;">
                                                <i class="bi bi-person-check-fill text-primary me-1"></i>Diterima Ajudan: <strong>{{ $sm->nama_ajudan_penerima ?? 'Ajudan Kadin' }}</strong>
                                            </div>
                                            <div class="text-secondary" style="font-size: 0.7rem;">
                                                Waktu Naik: {{ $sm->tanggal_naik_kadin ? $sm->tanggal_naik_kadin->format('d M Y, H:i') . ' WIB' : '-' }}
                                            </div>
                                        @else
                                            <div class="text-secondary" style="font-size: 0.74rem;">
                                                <i class="bi bi-clock me-1"></i>Belum diteruskan ke Ajudan Kepala Dinas
                                            </div>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($sm->status === 'selesai')
                                            <span class="badge rounded-pill fw-medium px-3 py-1" style="background-color: #DCFCE7; color: #15803D; font-size: 0.71rem;">
                                                <i class="bi bi-check-circle me-1"></i>Selesai Disposisi
                                            </span>
                                        @elseif ($sm->status === 'diproses')
                                            <span class="badge rounded-pill fw-medium px-3 py-1" style="background-color: #FEF3C7; color: #B45309; font-size: 0.71rem;">
                                                <i class="bi bi-hourglass-split me-1"></i>Meja Kadin
                                            </span>
                                        @else
                                            <span class="badge rounded-pill fw-medium px-3 py-1" style="background-color: #DBEAFE; color: #1D4ED8; font-size: 0.71rem;">
                                                <i class="bi bi-envelope me-1"></i>Baru Diagendakan
                                            </span>
                                        @endif
                                    </td>
                                    <td class="pe-4 text-end">
                                        @if ($sm->status_kenaikan === 'belum_naik' || $sm->status === 'baru')
                                            <form action="{{ route('surat-masuk.naik-ajudan', $sm->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn btn-sm btn-primary py-1 px-2 fw-medium" style="font-size: 0.72rem;">
                                                    <i class="bi bi-send-check me-1"></i>Teruskan ke Ajudan
                                                </button>
                                            </form>
                                        @else
                                            <span class="badge bg-light text-secondary border fw-normal" style="font-size: 0.7rem;">
                                                <i class="bi bi-check2 me-1"></i>Tercatat Naik
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-4 text-secondary">Belum ada data agenda surat masuk.</td>
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

{{-- MODAL 1: TIMELINE RIWAYAT LOG VERIFIKASI BERJENJANG --}}
<div class="modal fade" id="modalTimelineLog" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow rounded-3">
            <div class="modal-header border-bottom px-4 py-3">
                <div>
                    <h6 class="modal-title fw-bold text-dark d-flex align-items-center gap-2 mb-0">
                        <i class="bi bi-diagram-3-fill text-primary" aria-hidden="true"></i>
                        <span>Pelacakan Posisi Meja &amp; Riwayat Log Verifikasi</span>
                    </h6>
                    <div class="text-secondary small">
                        Nomor Naskah: <span id="tlModalNomor" class="doc-number-mono text-primary">-</span>
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body p-4 small">
                <div class="p-3 rounded-3 mb-4 border" style="background-color: #F8FAFC;">
                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 mb-2">
                        <div>
                            <span class="text-secondary" style="font-size: 0.72rem;">Posisi Meja Saat Ini:</span>
                            <div class="fw-bold text-primary" id="tlModalPosisiMeja" style="font-size: 0.88rem;">-</div>
                        </div>
                        <span id="tlModalKategoriBadge" class="badge rounded-2 px-2 py-1 fw-semibold">-</span>
                    </div>
                    <div class="text-dark fw-medium" id="tlModalPerihal">-</div>
                    <div class="text-secondary mt-1" id="tlModalTujuan" style="font-size: 0.74rem;">-</div>
                </div>

                <h6 class="fw-bold text-dark mb-3" style="font-size: 0.82rem;">
                    <i class="bi bi-clock-history text-primary me-1"></i>Jejak Audit Log Verifikasi (<code>log_verifikasi</code>)
                </h6>
                <div id="tlModalStepsContainer" class="ps-1"></div>
            </div>
            <div class="modal-footer border-top px-4 py-2">
                <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

{{-- MODAL 2: EDIT & PENGAJUAN ULANG NASKAH DINAS (REVISI / DRAF) --}}
<div class="modal fade" id="modalEditNaskah" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow rounded-3">
            <form id="formEditNaskah" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-header border-bottom px-4 py-3" style="background-color: #FEF2F2;">
                    <h6 class="modal-title fw-bold text-danger d-flex align-items-center gap-2">
                        <i class="bi bi-pencil-square" aria-hidden="true"></i>
                        <span id="modalEditTitle">Perbaikan &amp; Pengajuan Ulang Naskah Dinas</span>
                    </h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body p-4 small">
                    <div id="editCatatanRevisiBox" class="p-3 rounded-2 border mb-3" style="background-color: #FFFBEB; border-color: #FDE68A !important; color: #92400E;">
                        <div class="fw-bold mb-1"><i class="bi bi-chat-left-quote-fill me-1" aria-hidden="true"></i>Catatan Koreksi Pejabat Verifikator:</div>
                        <div id="editCatatanRevisiText">-</div>
                    </div>

                    <div id="editExistingFileBox" class="p-2 px-3 rounded-2 border mb-3 d-none d-flex align-items-center justify-content-between" style="background-color: #EFF6FF; border-color: #BFDBFE !important;">
                        <span class="text-dark"><i class="bi bi-paperclip text-primary me-1"></i>Berkas saat ini: <strong id="editExistingFileName">-</strong></span>
                        <a id="editExistingFileLink" href="#" target="_blank" class="btn btn-sm btn-outline-primary py-0 px-2" style="font-size: 0.72rem;">Buka Berkas</a>
                    </div>

                    <!-- Field group khusus Surat Keluar -->
                    <div id="fieldsEditSuratKeluar" style="display: none;">
                        <div class="row g-3 mb-3">
                            <div class="col-12 col-sm-3">
                                <label class="form-label fw-semibold text-dark mb-1">Nomor Urut <span class="text-danger">*</span></label>
                                <input type="number" name="nomor_urut" id="editSkNomorUrut" class="form-control form-control-sm doc-number-mono">
                            </div>
                            <div class="col-12 col-sm-5">
                                <label class="form-label fw-semibold text-dark mb-1">Kode Bidang <span class="text-danger">*</span></label>
                                <select name="kode_bidang" id="editSkKodeBidang" class="form-select form-select-sm">
                                    <option value="400">400 - Bidang Catatan Sipil</option>
                                    <option value="800">800 - Subbag Kepegawaian &amp; Umum</option>
                                    <option value="00">00 - Subbag Keuangan / Dana</option>
                                </select>
                            </div>
                            <div class="col-12 col-sm-4">
                                <label class="form-label fw-semibold text-dark mb-1">Tanggal Surat <span class="text-danger">*</span></label>
                                <input type="date" name="tanggal_dikeluarkan" id="editSkTanggal" class="form-control form-control-sm">
                            </div>
                        </div>
                        <div class="row g-3 mb-3">
                            <div class="col-12 col-sm-6">
                                <label class="form-label fw-semibold text-dark mb-1">Alamat / Instansi Tujuan <span class="text-danger">*</span></label>
                                <input type="text" name="alamat_tujuan" id="editSkTujuan" class="form-control form-control-sm">
                            </div>
                            <div class="col-12 col-sm-3">
                                <label class="form-label fw-semibold text-dark mb-1">Sifat</label>
                                <select name="sifat" id="editSkSifat" class="form-select form-select-sm">
                                    <option value="Penting">Penting</option>
                                    <option value="Segera">Segera</option>
                                    <option value="Biasa">Biasa</option>
                                    <option value="Rahasia">Rahasia</option>
                                </select>
                            </div>
                            <div class="col-12 col-sm-3">
                                <label class="form-label fw-semibold text-dark mb-1">Lampiran</label>
                                <input type="text" name="lampiran" id="editSkLampiran" class="form-control form-control-sm">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold text-dark mb-1">Upload Ulang Berkas Konsep Surat (PDF/DOCX - Opsional)</label>
                            <input type="file" name="file_konsep" class="form-control form-control-sm" accept=".pdf,.doc,.docx">
                        </div>
                    </div>

                    <!-- Field group khusus SPPD -->
                    <div id="fieldsEditSppd" style="display: none;">
                        <div class="row g-3 mb-3">
                            <div class="col-12 col-sm-7">
                                <label class="form-label fw-semibold text-dark mb-1">Nomor SPPD <span class="text-danger">*</span></label>
                                <input type="text" name="nomor_sppd" id="editSppdNomor" class="form-control form-control-sm doc-number-mono">
                            </div>
                            <div class="col-12 col-sm-5">
                                <label class="form-label fw-semibold text-dark mb-1">Tanggal Surat <span class="text-danger">*</span></label>
                                <input type="date" name="tanggal_surat" id="editSppdTanggal" class="form-control form-control-sm">
                            </div>
                        </div>
                        <div class="row g-3 mb-3">
                            <div class="col-12 col-sm-4">
                                <label class="form-label fw-semibold text-dark mb-1">Nama Pegawai <span class="text-danger">*</span></label>
                                <input type="text" name="nama_pegawai" id="editSppdNamaPegawai" class="form-control form-control-sm">
                            </div>
                            <div class="col-12 col-sm-4">
                                <label class="form-label fw-semibold text-dark mb-1">NIP Pegawai</label>
                                <input type="text" name="nip_pegawai" id="editSppdNipPegawai" class="form-control form-control-sm doc-number-mono">
                            </div>
                            <div class="col-12 col-sm-4">
                                <label class="form-label fw-semibold text-dark mb-1">Jabatan <span class="text-danger">*</span></label>
                                <input type="text" name="jabatan_pegawai" id="editSppdJabatan" class="form-control form-control-sm">
                            </div>
                        </div>
                        <div class="row g-3 mb-3">
                            <div class="col-12 col-sm-4">
                                <label class="form-label fw-semibold text-dark mb-1">Tgl Berangkat <span class="text-danger">*</span></label>
                                <input type="date" name="tanggal_berangkat" id="editSppdBerangkat" class="form-control form-control-sm">
                            </div>
                            <div class="col-12 col-sm-4">
                                <label class="form-label fw-semibold text-dark mb-1">Tgl Kembali <span class="text-danger">*</span></label>
                                <input type="date" name="tanggal_kembali" id="editSppdKembali" class="form-control form-control-sm">
                            </div>
                            <div class="col-12 col-sm-4">
                                <label class="form-label fw-semibold text-dark mb-1">Daerah Tujuan <span class="text-danger">*</span></label>
                                <input type="text" name="daerah_tujuan" id="editSppdTujuan" class="form-control form-control-sm">
                            </div>
                        </div>
                    </div>

                    <!-- Field group khusus Berita Acara -->
                    <div id="fieldsEditBeritaAcara" style="display: none;">
                        <div class="row g-3 mb-3">
                            <div class="col-12 col-sm-7">
                                <label class="form-label fw-semibold text-dark mb-1">Nomor Berita Acara <span class="text-danger">*</span></label>
                                <input type="text" name="nomor_berita_acara" id="editBaNomor" class="form-control form-control-sm doc-number-mono">
                            </div>
                            <div class="col-12 col-sm-5">
                                <label class="form-label fw-semibold text-dark mb-1">Tanggal Berita Acara <span class="text-danger">*</span></label>
                                <input type="date" name="tanggal_berita_acara" id="editBaTanggal" class="form-control form-control-sm">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold text-dark mb-1">Pihak Kedua / Instansi Mitra <span class="text-danger">*</span></label>
                            <input type="text" name="pihak_kedua" id="editBaPihakKedua" class="form-control form-control-sm">
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold text-dark mb-1">Upload Ulang Berkas Berita Acara (PDF/DOCX - Opsional)</label>
                            <input type="file" name="file_dokumen" class="form-control form-control-sm" accept=".pdf,.doc,.docx">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold text-dark mb-1">Perihal / Isi Ringkas / Urusan Naskah <span class="text-danger">*</span></label>
                        <textarea name="perihal" id="editCommonPerihal" class="form-control form-control-sm" rows="3" required></textarea>
                    </div>

                    <div class="mb-0">
                        <label class="form-label fw-semibold text-primary mb-1">Catatan Perbaikan Staf Admin (Tercatat di Log Verifikasi)</label>
                        <input type="text" name="catatan_perbaikan" id="editCatatanPerbaikan" class="form-control form-control-sm" placeholder="Contoh: Tanggal pelaksanaan dan rincian lampiran telah diperbaiki sesuai arahan Kasubbag.">
                    </div>
                </div>
                <div class="modal-footer border-top px-4 py-2">
                    <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-sm btn-primary fw-semibold px-3">
                        <i class="bi bi-send-check-fill me-1" aria-hidden="true"></i>Simpan Perbaikan &amp; Ajukan Ulang ke Kasubbag
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- MODAL 3: PRATINJAU LAMPIRAN DOKUMEN DI STORAGE --}}
<div class="modal fade" id="modalPratinjauLampiran" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content border-0 shadow rounded-3">
            <div class="modal-header border-bottom px-4 py-3">
                <div>
                    <h6 class="modal-title fw-bold text-dark d-flex align-items-center gap-2 mb-0">
                        <i class="bi bi-file-earmark-pdf-fill text-danger" aria-hidden="true"></i>
                        <span>Pratinjau Berkas Lampiran Naskah Dinas</span>
                    </h6>
                    <div class="text-secondary small" id="modalLampiranSubtitle">-</div>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <a id="modalLampiranDownloadLink" href="#" target="_blank" class="btn btn-sm btn-primary fw-semibold">
                        <i class="bi bi-box-arrow-up-right me-1"></i>Buka / Unduh di Tab Baru
                    </a>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
            </div>
            <div class="modal-body p-0 bg-light" style="height: 72vh;">
                <iframe id="iframeLampiranPreview" src="about:blank" class="w-100 h-100 border-0" title="Pratinjau Lampiran"></iframe>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('js/esurat-motion.js') }}" defer></script>
<script>
    const NASKAH_MAP = @json($semuaNaskahKeluar->keyBy('key'));
    let activeKategori = @json($initialKategoriFilter ?: 'all_keluar');

    function switchKategoriTab(kategori, btnEl) {
        activeKategori = kategori;

        document.querySelectorAll('#kategoriTabNav .nav-link').forEach(el => el.classList.remove('active'));
        if (btnEl) {
            btnEl.classList.add('active');
        } else {
            const targetBtn = document.querySelector(`#kategoriTabNav .nav-link[data-kategori="${kategori}"]`);
            if (targetBtn) targetBtn.classList.add('active');
        }

        const secHierarki = document.getElementById('sectionTabelHierarki');
        const secMasuk = document.getElementById('sectionTabelSuratMasuk');
        const statusSelect = document.getElementById('filterStatusSelect');

        if (kategori === 'surat_masuk') {
            secHierarki.classList.add('d-none');
            secMasuk.classList.remove('d-none');
            statusSelect.disabled = true;
        } else {
            secHierarki.classList.remove('d-none');
            secMasuk.classList.add('d-none');
            statusSelect.disabled = false;
        }

        filterRiwayatTable();
    }

    function applyQuickStatusFilter(status) {
        if (activeKategori === 'surat_masuk') {
            switchKategoriTab('all_keluar');
        }

        const statusSelect = document.getElementById('filterStatusSelect');
        if (statusSelect.value === status) {
            statusSelect.value = 'all';
        } else {
            statusSelect.value = status;
        }

        filterRiwayatTable();
    }

    function resetAllFilters() {
        document.getElementById('filterStatusSelect').value = 'all';
        document.getElementById('filterBidangSelect').value = 'all';
        document.getElementById('searchRiwayatInput').value = '';
        switchKategoriTab('all_keluar');
    }

    function filterRiwayatTable() {
        const statusVal = document.getElementById('filterStatusSelect').value;
        const bidangVal = document.getElementById('filterBidangSelect').value;
        const query = (document.getElementById('searchRiwayatInput').value || '').toLowerCase();

        // Highlight active status summary card
        document.querySelectorAll('.stat-card-filter').forEach(card => card.classList.remove('active-filter'));
        if (statusVal !== 'all') {
            const activeCard = document.getElementById('statCard-' + statusVal);
            if (activeCard) activeCard.classList.add('active-filter');
        }

        if (activeKategori === 'surat_masuk') {
            document.querySelectorAll('#tabelRiwayatSuratMasuk tbody tr.row-surat-masuk').forEach(row => {
                const rowBidang = row.getAttribute('data-bidang');
                const matchBidang = (bidangVal === 'all' || rowBidang === bidangVal);
                const matchQuery = !query || row.innerText.toLowerCase().includes(query);
                row.style.display = (matchBidang && matchQuery) ? '' : 'none';
            });
            return;
        }

        document.querySelectorAll('#tabelRiwayatKeluar tbody tr.row-naskah-keluar').forEach(row => {
            const rowJenis = row.getAttribute('data-jenis');
            const rowStatus = row.getAttribute('data-status');
            const rowBidang = row.getAttribute('data-bidang');

            const matchKategori = (activeKategori === 'all_keluar' || rowJenis === activeKategori);
            const matchStatus = (statusVal === 'all' || rowStatus === statusVal);
            const matchBidang = (bidangVal === 'all' || rowBidang === bidangVal);
            const matchQuery = !query || row.innerText.toLowerCase().includes(query);

            row.style.display = (matchKategori && matchStatus && matchBidang && matchQuery) ? '' : 'none';
        });
    }

    function openTimelineModalByKey(key) {
        const item = NASKAH_MAP[key];
        if (!item) return;

        document.getElementById('tlModalNomor').textContent = item.nomor;
        document.getElementById('tlModalPosisiMeja').textContent = item.posisi_meja;
        document.getElementById('tlModalPerihal').textContent = item.perihal;
        document.getElementById('tlModalTujuan').textContent = item.tujuan + ' • ' + item.sub_tujuan;

        const katBadge = document.getElementById('tlModalKategoriBadge');
        katBadge.textContent = item.jenis_label + ' (Kode ' + item.kode_bidang + ')';
        katBadge.style.backgroundColor = item.jenis_badge_bg;
        katBadge.style.color = item.jenis_badge_color;

        const container = document.getElementById('tlModalStepsContainer');
        container.innerHTML = '';

        const logs = Array.isArray(item.logs) ? item.logs : [];
        if (logs.length === 0) {
            container.innerHTML = '<div class="text-secondary">Belum ada catatan riwayat log verifikasi untuk naskah ini.</div>';
        } else {
            logs.forEach(log => {
                let dotBg = '#DBEAFE';
                let dotColor = '#2563EB';
                let iconClass = 'bi-check-circle-fill';
                let badgeBg = '#DBEAFE';
                let badgeColor = '#1D4ED8';

                if (log.status_aksi === 'revisi') {
                    dotBg = '#FEE2E2';
                    dotColor = '#DC2626';
                    iconClass = 'bi-arrow-counterclockwise';
                    badgeBg = '#FEE2E2';
                    badgeColor = '#B91C1C';
                } else if (log.status_aksi === 'ttd_kadin' || log.status_aksi === 'diajukan' || log.status_aksi === 'valid_kasubbag') {
                    dotBg = '#DCFCE7';
                    dotColor = '#16A34A';
                    iconClass = 'bi-check-circle-fill';
                    badgeBg = '#DCFCE7';
                    badgeColor = '#15803D';
                }

                let checklistHtml = '';
                if (log.checklist_pemeriksaan && typeof log.checklist_pemeriksaan === 'object') {
                    const pills = [];
                    for (const [k, v] of Object.entries(log.checklist_pemeriksaan)) {
                        const label = k.replace(/_/g, ' ');
                        if (v) {
                            pills.push(`<span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 fw-normal" style="font-size: 0.65rem;"><i class="bi bi-check2 me-1"></i>${label}</span>`);
                        }
                    }
                    if (pills.length > 0) {
                        checklistHtml = `<div class="d-flex flex-wrap gap-1 mt-1">${pills.join('')}</div>`;
                    }
                }

                const stepEl = document.createElement('div');
                stepEl.className = 'timeline-step';
                stepEl.innerHTML = `
                    <div class="timeline-dot" style="background-color: ${dotBg}; color: ${dotColor};">
                        <i class="bi ${iconClass}" aria-hidden="true"></i>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="fw-bold text-dark" style="font-size: 0.82rem;">${log.tahap_label}</span>
                        <span class="badge rounded-pill px-2 py-1" style="background-color: ${badgeBg}; color: ${badgeColor}; font-size: 0.67rem;">${log.aksi_label}</span>
                    </div>
                    <div class="text-dark fw-medium" style="font-size: 0.76rem;">${log.verifikator_nama} <span class="text-secondary fw-normal">(${log.verifikator_jabatan})</span></div>
                    <div class="text-secondary mt-1" style="font-size: 0.75rem;">${log.catatan || '-'}</div>
                    ${checklistHtml}
                    <div class="text-secondary mt-1 doc-number-mono" style="font-size: 0.69rem;"><i class="bi bi-clock me-1"></i>${log.waktu}</div>
                `;
                container.appendChild(stepEl);
            });
        }

        new bootstrap.Modal(document.getElementById('modalTimelineLog')).show();
    }

    function openEditNaskahByKey(key) {
        const data = NASKAH_MAP[key];
        if (!data) return;

        const form = document.getElementById('formEditNaskah');
        form.action = '/registrasi-surat/naskah/' + data.jenis + '/' + data.id;
        document.getElementById('modalEditTitle').textContent = 'Edit & Ajukan Ulang ' + data.jenis_label + ' (' + data.nomor + ')';

        const revBox = document.getElementById('editCatatanRevisiBox');
        if (data.catatan_revisi) {
            revBox.style.display = '';
            document.getElementById('editCatatanRevisiText').textContent = data.catatan_revisi;
        } else {
            revBox.style.display = 'none';
        }

        const existingFileBox = document.getElementById('editExistingFileBox');
        if (data.file_url) {
            existingFileBox.classList.remove('d-none');
            document.getElementById('editExistingFileName').textContent = data.file_name || 'Lampiran';
            document.getElementById('editExistingFileLink').href = data.file_url;
        } else {
            existingFileBox.classList.add('d-none');
        }

        const skBox = document.getElementById('fieldsEditSuratKeluar');
        const sppdBox = document.getElementById('fieldsEditSppd');
        const baBox = document.getElementById('fieldsEditBeritaAcara');
        const perihalInput = document.getElementById('editCommonPerihal');

        skBox.style.display = 'none';
        sppdBox.style.display = 'none';
        baBox.style.display = 'none';

        skBox.querySelectorAll('input, select').forEach(el => el.disabled = true);
        sppdBox.querySelectorAll('input, select').forEach(el => el.disabled = true);
        baBox.querySelectorAll('input, select').forEach(el => el.disabled = true);

        if (data.jenis === 'surat_keluar') {
            skBox.style.display = '';
            skBox.querySelectorAll('input, select').forEach(el => el.disabled = false);
            document.getElementById('editSkNomorUrut').value = data.nomor_urut || 2764;
            document.getElementById('editSkKodeBidang').value = data.kode_bidang || '400';
            document.getElementById('editSkTanggal').value = data.tanggal || '2026-11-19';
            document.getElementById('editSkTujuan').value = data.tujuan || '';
            document.getElementById('editSkSifat').value = data.sifat || 'Penting';
            document.getElementById('editSkLampiran').value = data.lampiran || '1 (Satu) Berkas';
            perihalInput.name = 'perihal';
            perihalInput.value = data.perihal || '';
        } else if (data.jenis === 'sppd') {
            sppdBox.style.display = '';
            sppdBox.querySelectorAll('input, select').forEach(el => el.disabled = false);
            document.getElementById('editSppdNomor').value = data.nomor || '';
            document.getElementById('editSppdTanggal').value = data.tanggal || '2026-11-19';
            document.getElementById('editSppdNamaPegawai').value = data.nama_pegawai || '';
            document.getElementById('editSppdNipPegawai').value = data.nip_pegawai || '';
            document.getElementById('editSppdJabatan').value = data.jabatan_pegawai || '';
            document.getElementById('editSppdBerangkat').value = data.tanggal_berangkat || '2026-11-20';
            document.getElementById('editSppdKembali').value = data.tanggal_kembali || '2026-11-22';
            document.getElementById('editSppdTujuan').value = data.tujuan || '';
            perihalInput.name = 'urusan_perjalanan';
            perihalInput.value = data.perihal || '';
        } else if (data.jenis === 'berita_acara') {
            baBox.style.display = '';
            baBox.querySelectorAll('input, select').forEach(el => el.disabled = false);
            document.getElementById('editBaNomor').value = data.nomor || '';
            document.getElementById('editBaTanggal').value = data.tanggal || '2026-11-19';
            document.getElementById('editBaPihakKedua').value = data.tujuan || '';
            perihalInput.name = 'perihal';
            perihalInput.value = data.perihal || '';
        }

        new bootstrap.Modal(document.getElementById('modalEditNaskah')).show();
    }

    function openLampiranByKey(key) {
        const item = NASKAH_MAP[key];
        if (!item || !item.file_url) return;

        document.getElementById('modalLampiranSubtitle').textContent = item.nomor + ' — ' + (item.file_name || 'Lampiran');
        document.getElementById('modalLampiranDownloadLink').href = item.file_url;
        document.getElementById('iframeLampiranPreview').src = item.file_url;

        new bootstrap.Modal(document.getElementById('modalPratinjauLampiran')).show();
    }

    document.addEventListener('DOMContentLoaded', function () {
        const initialStatus = @json($initialStatusFilter ?: 'all');
        const initialKategori = @json($initialKategoriFilter ?: 'all_keluar');
        const initialOpenEdit = @json($initialOpenEditKey ?: '');

        if (initialStatus && initialStatus !== 'all') {
            document.getElementById('filterStatusSelect').value = initialStatus;
        }
        switchKategoriTab(initialKategori);

        if (initialOpenEdit && NASKAH_MAP[initialOpenEdit]) {
            openEditNaskahByKey(initialOpenEdit);
        }
    });
</script>
</body>
</html>
