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
    <style>
        :root {
            --color-slate-50: #F8FAFC;
            --color-slate-100: #F3F4F6;
            --color-slate-200: #E5E7EB;
            --color-slate-500: #6B7280;
            --color-slate-700: #374151;
            --color-slate-900: #111827;
            --color-blue-600: #2563EB;
            --color-emerald-600: #059669;
            --color-rose-600: #E11D48;
            --radius-md: 0.5rem;
            --radius-lg: 0.75rem;
            --shadow-card: 0 1px 3px rgba(15, 23, 42, 0.06), 0 1px 2px rgba(15, 23, 42, 0.04);
            --bg-surface: #FFFFFF;
            --bg-canvas: var(--color-slate-100);
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-canvas);
            color: var(--color-slate-900);
        }

        .sidebar {
            width: 260px;
            min-height: 100vh;
            background-color: var(--color-slate-900);
        }

        .sidebar-section-label {
            font-size: 0.66rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: #6B7280;
            padding: 0.85rem 0.9rem 0.35rem;
        }

        .nav-link-sidebar {
            color: #9CA3AF;
            padding: 0.6rem 0.9rem;
            border-radius: var(--radius-md);
            font-size: 0.84rem;
            font-weight: 500;
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: space-between;
            transition: background-color 0.15s ease, color 0.15s ease;
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

        .surface-card {
            background-color: var(--bg-surface);
            border: 1px solid var(--color-slate-200);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-card);
        }

        .mini-stat-icon {
            width: 38px;
            height: 38px;
            border-radius: 0.6rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.05rem;
            flex-shrink: 0;
        }

        .doc-number-mono {
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.78rem;
            font-weight: 600;
        }

        .a4-paper {
            background-color: #FFFFFF;
            padding: 2.75rem 3rem;
            min-height: 840px;
            border: 1px solid var(--color-slate-200);
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
            border: 2px dashed var(--color-blue-600);
            background-color: #EFF6FF;
            border-radius: var(--radius-md);
            padding: 0.9rem 1rem;
            font-family: 'Inter', sans-serif;
            transition: all 0.25s ease;
        }

        .tte-placeholder.signed {
            border: 2px solid #059669;
            background-color: #ECFDF5;
        }

        .timeline-step {
            position: relative;
            padding-left: 2.5rem;
            padding-bottom: 1.25rem;
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
            background-color: var(--color-slate-200);
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
<body data-default-role="{{ $activeRole ?? 'kadin' }}">

<div class="d-flex">
    <aside class="sidebar d-flex flex-column flex-shrink-0 position-fixed top-0 bottom-0 start-0 z-3">
        <div class="p-3 d-flex align-items-center gap-3 border-bottom border-secondary border-opacity-25">
            <div class="bg-primary text-white rounded-3 d-flex align-items-center justify-content-center" style="width: 38px; height: 38px;">
                <i class="bi bi-envelope-paper-fill fs-5" aria-hidden="true"></i>
            </div>
            <div>
                <div class="fw-bold text-white" style="font-size: 0.9rem; letter-spacing: 0.02em;">DISDUKCAPIL OKI</div>
                <div class="text-secondary" style="font-size: 0.72rem;">Persuratan &amp; Kearsipan</div>
            </div>
        </div>

        <div class="px-3 py-2 d-flex flex-column gap-1 flex-grow-1 overflow-y-auto">
            <div class="sidebar-section-label">MENU UTAMA &amp; AGENDA</div>
            <a href="/kadin" id="nav-dashboard-link" class="nav-link-sidebar">
                <span class="d-flex align-items-center gap-3">
                    <i class="bi bi-grid" aria-hidden="true"></i>
                    <span>Dashboard Eksekutif</span>
                </span>
            </a>
            <a href="/kadin/disposisi" class="nav-link-sidebar">
                <span class="d-flex align-items-center gap-3">
                    <i class="bi bi-inbox" aria-hidden="true"></i>
                    <span>Surat Masuk &amp; Disposisi</span>
                </span>
                <span class="badge rounded-pill bg-warning text-dark fw-bold" style="font-size: 0.68rem;">2</span>
            </a>
            <a href="/registrasi-surat" class="nav-link-sidebar">
                <span class="d-flex align-items-center gap-3">
                    <i class="bi bi-send-check" aria-hidden="true"></i>
                    <span>Monitoring Surat &amp; SPPD</span>
                </span>
            </a>

            <div class="sidebar-section-label">VERIFIKASI &amp; OTORISASI TTE</div>
            <a href="/verifikasi-hierarki" class="nav-link-sidebar">
                <span class="d-flex align-items-center gap-3">
                    <i class="bi bi-file-earmark-check" aria-hidden="true"></i>
                    <span>Verifikasi Hierarki</span>
                </span>
                <span class="badge rounded-pill bg-warning text-dark fw-bold" style="font-size: 0.68rem;">4</span>
            </a>
            <a href="/kadin/validasi" class="nav-link-sidebar active">
                <span class="d-flex align-items-center gap-3">
                    <i class="bi bi-qr-code-scan" aria-hidden="true"></i>
                    <span>Validasi &amp; TTE QR</span>
                </span>
                <span class="badge rounded-pill bg-danger" style="font-size: 0.68rem;">10</span>
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
            <a href="#modalPinTte" data-bs-toggle="modal" class="nav-link-sidebar">
                <span class="d-flex align-items-center gap-3">
                    <i class="bi bi-shield-lock" aria-hidden="true"></i>
                    <span>Pengaturan PIN / Passphrase TTE</span>
                </span>
            </a>
            <a href="/login" onclick="localStorage.removeItem('esurat_locked_role')" class="nav-link-sidebar text-danger">
                <span class="d-flex align-items-center gap-3">
                    <i class="bi bi-box-arrow-left" aria-hidden="true"></i>
                    <span>Logout</span>
                </span>
            </a>
        </div>

        <div class="p-3 border-top border-secondary border-opacity-25" style="background-color: #0B0F19;">
            <div class="d-flex align-items-center gap-2 mb-2">
                <div id="sidebar-avatar" class="rounded-circle bg-primary text-white fw-bold d-flex align-items-center justify-content-center flex-shrink-0" style="width: 36px; height: 36px; font-size: 0.75rem;">
                    KD
                </div>
                <div class="lh-sm overflow-hidden">
                    <div id="sidebar-name" class="text-white fw-semibold text-truncate" style="font-size: 0.78rem;">KD - Drs. H. Hendra Suryadi</div>
                    <div id="sidebar-subtitle" class="text-secondary text-truncate" style="font-size: 0.69rem;">Kepala Dinas Dukcapil OKI</div>
                </div>
            </div>
            <div class="d-flex align-items-center justify-content-between px-2 py-1 rounded-2" style="background-color: rgba(16, 185, 129, 0.12); border: 1px solid rgba(16, 185, 129, 0.25);">
                <span id="sidebar-status" class="text-success fw-semibold d-inline-flex align-items-center gap-1" style="font-size: 0.68rem;">
                    <i class="bi bi-lock-fill" aria-hidden="true"></i> Role Terkunci: Kepala Dinas
                </span>
                <span class="badge bg-success text-white" style="font-size: 0.62rem;">BSrE Ready</span>
            </div>
        </div>
    </aside>

    <div class="flex-grow-1 d-flex flex-column min-vh-100" style="margin-left: 260px;">
        <header class="bg-white border-bottom px-4 py-2 d-flex align-items-center justify-content-between sticky-top" style="height: 58px;">
            <div class="small">
                <span class="text-secondary">Disdukcapil OKI</span>
                <span class="text-secondary mx-1">/</span>
                <span class="text-secondary">Validasi &amp; TTE QR</span>
                <span class="text-secondary mx-1">/</span>
                <span class="text-primary fw-medium">Detail Dokumen</span>
            </div>

            <div class="d-flex align-items-center gap-2">
                <div class="dropdown">
                    <button class="btn btn-sm border border-primary border-opacity-25 rounded-pill px-3 py-1 d-flex align-items-center gap-2" style="background-color: #EFF6FF; font-size: 0.74rem;" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-shield-lock-fill text-primary" aria-hidden="true"></i>
                        <span class="text-primary fw-semibold" id="role-switcher-label">Simulasi Aktor: Kepala Dinas</span>
                        <i class="bi bi-chevron-down text-primary" style="font-size: 0.65rem;" aria-hidden="true"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end shadow border-0 small" style="min-width: 250px;">
                        <li class="px-3 py-1 text-secondary fw-bold" style="font-size: 0.68rem; text-transform: uppercase;">Kunci Identitas Aktor (Testing)</li>
                        <li><a class="dropdown-item py-2" href="/switch-role/admin?redirect=/kadin/validasi" onclick="lockUserRole('admin')"><i class="bi bi-person-gear text-primary me-2"></i><strong>Staf Admin</strong> (Subbag Umpeg)</a></li>
                        <li><a class="dropdown-item py-2" href="/switch-role/kasubbag?redirect=/kadin/validasi" onclick="lockUserRole('kasubbag')"><i class="bi bi-clipboard2-check text-warning me-2"></i><strong>Kasubbag Umpeg</strong> (Verifikator I)</a></li>
                        <li><a class="dropdown-item py-2" href="/switch-role/sekdin?redirect=/kadin/validasi" onclick="lockUserRole('sekdin')"><i class="bi bi-pen text-info me-2"></i><strong>Sekretaris Dinas</strong> (Verifikator II)</a></li>
                        <li><a class="dropdown-item py-2" href="/switch-role/kadin?redirect=/kadin/validasi" onclick="lockUserRole('kadin')"><i class="bi bi-qr-code-scan text-success me-2"></i><strong>Kepala Dinas</strong> (Otorisator TTE)</a></li>
                    </ul>
                </div>

                <div class="border rounded-2 px-3 py-1 bg-light text-secondary d-none d-md-flex align-items-center gap-2" style="font-size: 0.78rem;">
                    <i class="bi bi-calendar3 text-primary" aria-hidden="true"></i>
                    <span>Selasa, 17 November 2026</span>
                </div>

                <div class="dropdown">
                    <button class="btn btn-sm border rounded-pill px-2 py-1 d-flex align-items-center gap-2 bg-white" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <span id="topbar-avatar" class="rounded-circle bg-primary text-white fw-bold d-inline-flex align-items-center justify-content-center" style="width: 24px; height: 24px; font-size: 0.68rem;">KD</span>
                        <span id="topbar-name" class="text-dark fw-medium" style="font-size: 0.76rem;">KD - Drs. H. Hendra Suryadi</span>
                        <i class="bi bi-chevron-down text-secondary" style="font-size: 0.65rem;" aria-hidden="true"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 small">
                        <li class="px-3 py-2 border-bottom">
                            <div id="dropdown-name" class="fw-bold text-dark">Drs. H. Hendra Suryadi, M.Si</div>
                            <div id="dropdown-subtitle" class="text-secondary" style="font-size: 0.7rem;">Kepala Dinas Dukcapil OKI &bull; Otorisator TTE Aktif</div>
                        </li>
                        <li><a class="dropdown-item" href="#modalPinTte" data-bs-toggle="modal"><i class="bi bi-shield-lock me-2"></i>Pengaturan PIN / Passphrase TTE</a></li>
                        <li><a class="dropdown-item" href="/verifikasi-dokumen"><i class="bi bi-qr-code-scan me-2"></i>Cek Portal Verifikasi Publik</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item text-danger" href="/login" onclick="localStorage.removeItem('esurat_locked_role')"><i class="bi bi-box-arrow-right me-2"></i>Logout</a></li>
                    </ul>
                </div>
            </div>
        </header>

        <main class="p-4 flex-grow-1">
            <div class="surface-card p-3 px-4 mb-4 d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
                <div>
                    <div class="d-flex flex-wrap align-items-center gap-2 mb-1">
                        <span class="badge rounded-2 px-2 py-1 fw-semibold" style="background-color: #DBEAFE; color: #1D4ED8; font-size: 0.72rem;">
                            <i class="bi bi-send-fill me-1" aria-hidden="true"></i>Surat Keluar &bull; Kode 400
                        </span>
                        <span class="doc-number-mono text-primary">470/189/Disdukcapil-OKI/XI/2026</span>
                    </div>
                    <h6 class="fw-bold text-dark mb-0">Pratinjau Lembar Naskah Dinas &amp; Otorisasi Tanda Tangan Elektronik (QR Code UUID)</h6>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <a href="/verifikasi-dokumen" class="btn btn-outline-primary btn-sm fw-medium px-3 py-2 rounded-2 d-inline-flex align-items-center gap-1" style="font-size: 0.78rem;">
                        <i class="bi bi-patch-check" aria-hidden="true"></i>
                        <span>Simulasi Hasil QR</span>
                    </a>
                    <a href="/kadin" class="btn btn-outline-secondary btn-sm fw-medium px-3 py-2 rounded-2 d-inline-flex align-items-center gap-1" style="font-size: 0.78rem;">
                        <i class="bi bi-arrow-left" aria-hidden="true"></i>
                        <span>Kembali ke Antrean</span>
                    </a>
                </div>
            </div>

            <div class="row g-4">
                <div class="col-12 col-lg-7">
                    <div class="surface-card overflow-hidden">
                        <div class="px-4 py-3 border-bottom d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center gap-2">
                                <div class="mini-stat-icon" style="background-color: #FEE2E2; color: #DC2626;">
                                    <i class="bi bi-file-earmark-pdf-fill" aria-hidden="true"></i>
                                </div>
                                <div>
                                    <h6 class="fw-bold text-dark mb-0" style="font-size: 0.88rem;">Pratinjau Lembar Naskah Dinas (A4 Resmi)</h6>
                                    <div class="text-secondary" style="font-size: 0.73rem;">Kop Resmi Disdukcapil OKI &amp; Area TTE QR Code UUID</div>
                                </div>
                            </div>
                            <span class="badge bg-light text-secondary border fw-medium" style="font-size: 0.72rem;">Halaman 1 dari 1</span>
                        </div>

                        <div class="p-3 p-md-4" style="background-color: var(--color-slate-50);">
                            <div class="a4-paper rounded-2 shadow-sm mx-auto">
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

                                        <div id="ttePaperBox" class="tte-placeholder my-2 d-flex align-items-center gap-3 text-start">
                                            <div class="bg-white border border-primary border-opacity-25 rounded-2 p-2 d-flex align-items-center justify-content-center flex-shrink-0">
                                                <i id="ttePaperIcon" class="bi bi-qr-code text-primary" style="font-size: 2.5rem; line-height: 1;" aria-hidden="true"></i>
                                            </div>
                                            <div>
                                                <span id="ttePaperBadge" class="badge bg-primary mb-1" style="font-size: 0.65rem;">QR CODE UUID</span>
                                                <div id="ttePaperTitle" class="fw-bold text-primary" style="font-size: 0.78rem; line-height: 1.3;">
                                                    Area Tanda Tangan Elektronik (Menunggu Validasi Kadin)
                                                </div>
                                                <div id="ttePaperSub" class="text-secondary" style="font-size: 0.68rem;">Token UUID akan terbit otomatis setelah otorisasi</div>
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
                    <div class="surface-card mb-4">
                        <div class="px-4 py-3 border-bottom d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center gap-2">
                                <div class="mini-stat-icon" style="background-color: #DBEAFE; color: #2563EB;">
                                    <i class="bi bi-diagram-3-fill" aria-hidden="true"></i>
                                </div>
                                <div>
                                    <h6 class="fw-bold text-dark mb-0" style="font-size: 0.88rem;">Timeline Verifikasi Berjenjang</h6>
                                    <div class="text-secondary" style="font-size: 0.73rem;">Riwayat persetujuan dari penyusun hingga pimpinan</div>
                                </div>
                            </div>
                            <span class="badge rounded-pill px-2 py-1 fw-semibold" style="background-color: #DCFCE7; color: #15803D; font-size: 0.7rem;">
                                3/4 Tahap Terverifikasi
                            </span>
                        </div>

                        <div class="p-4">
                            <div class="timeline-step">
                                <div class="timeline-dot" style="background-color: #DCFCE7; color: #16A34A;">
                                    <i class="bi bi-check-circle-fill" aria-hidden="true"></i>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="fw-bold text-dark" style="font-size: 0.84rem;">Staf Subbag Umpeg</span>
                                    <span class="badge rounded-pill px-2 py-1" style="background-color: #DCFCE7; color: #15803D; font-size: 0.68rem;">Selesai</span>
                                </div>
                                <div class="text-secondary" style="font-size: 0.78rem;">Konsep Surat Diajukan</div>
                                <div class="text-secondary mt-1 doc-number-mono" style="font-size: 0.71rem;"><i class="bi bi-clock me-1" aria-hidden="true"></i>10 Nov 2026, 08:30 WIB</div>
                            </div>

                            <div class="timeline-step">
                                <div class="timeline-dot" style="background-color: #DCFCE7; color: #16A34A;">
                                    <i class="bi bi-check-circle-fill" aria-hidden="true"></i>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="fw-bold text-dark" style="font-size: 0.84rem;">Kasubbag Umpeg</span>
                                    <span class="badge rounded-pill px-2 py-1" style="background-color: #DCFCE7; color: #15803D; font-size: 0.68rem;">Terverifikasi</span>
                                </div>
                                <div class="text-secondary" style="font-size: 0.78rem;">Diverifikasi &amp; Disetujui (Hj. Siti Rahmawati, S.Sos)</div>
                                <div class="text-secondary mt-1 doc-number-mono" style="font-size: 0.71rem;"><i class="bi bi-clock me-1" aria-hidden="true"></i>10 Nov 2026, 09:15 WIB</div>
                            </div>

                            <div class="timeline-step">
                                <div class="timeline-dot" style="background-color: #DCFCE7; color: #16A34A;">
                                    <i class="bi bi-check-circle-fill" aria-hidden="true"></i>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="fw-bold text-dark" style="font-size: 0.84rem;">Sekretaris Dinas / Sekdin</span>
                                    <span class="badge rounded-pill px-2 py-1" style="background-color: #DCFCE7; color: #15803D; font-size: 0.68rem;">Diparaf</span>
                                </div>
                                <div class="text-secondary" style="font-size: 0.78rem;">Diparaf &amp; Diteruskan ke Kadin (Ir. H. Bambang Irawan, M.M)</div>
                                <div class="text-secondary mt-1 doc-number-mono" style="font-size: 0.71rem;"><i class="bi bi-clock me-1" aria-hidden="true"></i>10 Nov 2026, 10:00 WIB</div>
                            </div>

                            <div class="timeline-step">
                                <div class="timeline-dot" style="background-color: #FEF3C7; color: #D97706; border: 2px solid #F59E0B;">
                                    <i class="bi bi-hourglass-split" aria-hidden="true"></i>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="fw-bold text-dark" style="font-size: 0.84rem;">Kepala Dinas</span>
                                    <span class="badge rounded-pill bg-warning text-dark fw-semibold px-2 py-1" style="font-size: 0.68rem;">Status Aktif</span>
                                </div>
                                <div class="fw-semibold" style="font-size: 0.78rem; color: #B45309;">Menunggu Tanda Tangan Online</div>
                                <div class="text-secondary mt-1" style="font-size: 0.71rem;"><i class="bi bi-shield-check me-1" aria-hidden="true"></i>Siap dieksekusi dengan Passphrase / PIN TTE</div>
                            </div>
                        </div>
                    </div>

                    <div class="surface-card">
                        <div class="px-4 py-3 border-bottom d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center gap-2">
                                <div class="mini-stat-icon" style="background-color: #DCFCE7; color: #16A34A;">
                                    <i class="bi bi-shield-lock-fill" aria-hidden="true"></i>
                                </div>
                                <div>
                                    <h6 class="fw-bold text-dark mb-0" style="font-size: 0.88rem;">Form Otorisasi Passphrase / PIN TTE</h6>
                                    <div class="text-secondary" style="font-size: 0.73rem;">Penerbitan QR Code UUID Kepala Dinas</div>
                                </div>
                            </div>
                        </div>

                        <div class="p-4">
                            <form onsubmit="executeTteSign(); return false;">
                                <div class="mb-3">
                                    <label for="passphraseInput" class="form-label fw-semibold text-dark small mb-1">
                                        Passphrase / PIN Keamanan TTE <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-text bg-light text-secondary">
                                            <i class="bi bi-lock-fill" aria-hidden="true"></i>
                                        </span>
                                        <input type="password" id="passphraseInput" class="form-control py-2" placeholder="Masukkan Passphrase atau PIN TTE Anda..." value="••••••••••••" required>
                                    </div>
                                    <div class="form-text" style="font-size: 0.71rem;">
                                        <i class="bi bi-info-circle me-1" aria-hidden="true"></i>Otentikasi kriptografi menghasilkan Token UUID unik pada Buku Besar.
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label for="catatanInput" class="form-label fw-semibold text-dark small mb-1">
                                        Catatan / Koreksi Pimpinan (Opsional)
                                    </label>
                                    <textarea id="catatanInput" class="form-control form-control-sm" rows="3" placeholder="Tambahkan arahan atau catatan revisi apabila surat perlu diperbaiki..."></textarea>
                                </div>

                                <div class="d-grid gap-2">
                                    <button type="submit" class="btn btn-success fw-semibold py-2 px-3 rounded-2 d-flex align-items-center justify-content-center gap-2 shadow-sm" style="font-size: 0.86rem;">
                                        <i class="bi bi-qr-code-scan" aria-hidden="true"></i>
                                        <span>Sah &amp; Bubuhkan Tanda Tangan (QR Code)</span>
                                    </button>
                                    <button type="button" data-bs-toggle="modal" data-bs-target="#modalRevisiKadin" class="btn btn-outline-danger btn-sm fw-medium py-2 px-3 rounded-2 d-flex align-items-center justify-content-center gap-2" style="font-size: 0.82rem;">
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

<div class="modal fade" id="modalTteSukses" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow rounded-3">
            <div class="modal-header border-bottom px-4 py-3">
                <h6 class="modal-title fw-bold text-success d-flex align-items-center gap-2">
                    <i class="bi bi-shield-fill-check" aria-hidden="true"></i>
                    <span>Otorisasi TTE QR Code Berhasil</span>
                </h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body p-4 small">
                <p class="text-secondary mb-2">Naskah dinas telah berhasil dibubuhkan Tanda Tangan Elektronik Kepala Dinas:</p>
                <div class="p-3 rounded-2 bg-light border mb-0">
                    <div class="fw-bold text-dark">Nomor: 470/189/Disdukcapil-OKI/XI/2026</div>
                    <div class="doc-number-mono text-success mt-1">Token UUID: e8b7a9c2-4f1d-4a9b-8c3e-9102f84a712b</div>
                </div>
            </div>
            <div class="modal-footer border-top px-4 py-2">
                <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">Lihat Pratinjau</button>
                <a href="/verifikasi-dokumen" class="btn btn-sm btn-success fw-semibold">Buka Hasil Portal Verifikasi QR &rarr;</a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalRevisiKadin" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow rounded-3">
            <div class="modal-header border-bottom px-4 py-3">
                <h6 class="modal-title fw-bold text-danger d-flex align-items-center gap-2">
                    <i class="bi bi-arrow-counterclockwise" aria-hidden="true"></i>
                    <span>Kembalikan Dokumen untuk Revisi</span>
                </h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body p-4 small">
                <p class="text-secondary mb-0">Dokumen ini akan dikembalikan ke antrean <strong>Sekretaris Dinas &amp; Kasubbag Umpeg</strong> beserta catatan koreksi Kepala Dinas.</p>
            </div>
            <div class="modal-footer border-top px-4 py-2">
                <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                <a href="/verifikasi-hierarki" class="btn btn-sm btn-danger fw-semibold">Ya, Kembalikan Dokumen</a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalPinTte" tabindex="-1" aria-labelledby="modalPinTteLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow rounded-3">
            <div class="modal-header border-bottom px-4 py-3">
                <h6 class="modal-title fw-bold text-dark d-flex align-items-center gap-2" id="modalPinTteLabel">
                    <i class="bi bi-shield-lock-fill text-primary" aria-hidden="true"></i>
                    <span>Panel Keamanan PIN / Passphrase TTE Kadin</span>
                </h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body p-4">
                <div class="p-3 rounded-2 mb-3 border" style="background-color: #ECFDF5; border-color: #A7F3D0 !important; font-size: 0.78rem;">
                    <strong class="text-success d-block mb-1"><i class="bi bi-patch-check-fill me-1" aria-hidden="true"></i>Sertifikat Elektronik BSrE Aktif</strong>
                    <span class="text-secondary">Otorisator: <strong>Drs. H. Hendra Suryadi, M.Si</strong> (NIP. 197108141998031004)</span>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold small text-dark mb-1">Passphrase / PIN TTE Saat Ini</label>
                    <input type="password" class="form-control form-control-sm" value="••••••••••••">
                </div>
                <div class="mb-0">
                    <label class="form-label fw-semibold small text-dark mb-1">Passphrase / PIN TTE Baru</label>
                    <input type="password" class="form-control form-control-sm" placeholder="Minimal 8 karakter kombinasi huruf &amp; angka...">
                </div>
            </div>
            <div class="modal-footer border-top px-4 py-2">
                <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-sm btn-primary fw-semibold" data-bs-dismiss="modal">Simpan Perubahan PIN</button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    const ROLE_PROFILES = {
        admin: {
            initials: 'AD',
            badgeClass: 'bg-primary text-white',
            sidebarName: 'AD - Admin Disdukcapil',
            sidebarSub: 'Subbag Umum & Kepegawaian',
            statusText: 'Role Terkunci: Staf Admin',
            switcherText: 'Simulasi Aktor: Staf Admin',
            fullName: 'Rizky Pratama, S.IP',
            homeUrl: '/?role=admin'
        },
        kasubbag: {
            initials: 'KS',
            badgeClass: 'bg-warning text-dark',
            sidebarName: 'KS - Hj. Siti Rahmawati',
            sidebarSub: 'Kasubbag Umpeg • Verifikator I',
            statusText: 'Role Terkunci: Kasubbag (Verif I)',
            switcherText: 'Simulasi Aktor: Kasubbag Umpeg',
            fullName: 'Hj. Siti Rahmawati, S.Sos., M.Si',
            homeUrl: '/verifikasi-hierarki?role=kasubbag'
        },
        sekdin: {
            initials: 'SD',
            badgeClass: 'bg-info text-dark',
            sidebarName: 'SD - Ir. H. Bambang Irawan',
            sidebarSub: 'Sekretaris Dinas • Verifikator II',
            statusText: 'Role Terkunci: Sekdin (Verif II)',
            switcherText: 'Simulasi Aktor: Sekretaris Dinas',
            fullName: 'Ir. H. Bambang Irawan, M.M',
            homeUrl: '/verifikasi-hierarki?role=sekdin'
        },
        kadin: {
            initials: 'KD',
            badgeClass: 'bg-primary text-white',
            sidebarName: 'KD - Drs. H. Hendra Suryadi',
            sidebarSub: 'Kepala Dinas Dukcapil OKI',
            statusText: 'Role Terkunci: Kepala Dinas',
            switcherText: 'Simulasi Aktor: Kepala Dinas',
            fullName: 'Drs. H. Hendra Suryadi, M.Si',
            homeUrl: '/kadin?role=kadin'
        }
    };

    function lockUserRole(role) {
        if (ROLE_PROFILES[role]) {
            localStorage.setItem('esurat_locked_role', role);
        }
    }

    function applyLockedRole() {
        const params = new URLSearchParams(window.location.search);
        const urlRole = params.get('role');
        if (urlRole && ROLE_PROFILES[urlRole]) {
            localStorage.setItem('esurat_locked_role', urlRole);
        }

        const activeRole = localStorage.getItem('esurat_locked_role') || document.body.getAttribute('data-default-role') || 'kadin';
        localStorage.setItem('esurat_locked_role', activeRole);
        const profile = ROLE_PROFILES[activeRole] || ROLE_PROFILES.kadin;

        const sidebarAvatar = document.getElementById('sidebar-avatar');
        const topbarAvatar = document.getElementById('topbar-avatar');
        if (sidebarAvatar) {
            sidebarAvatar.textContent = profile.initials;
            sidebarAvatar.className = 'rounded-circle fw-bold d-flex align-items-center justify-content-center flex-shrink-0 ' + profile.badgeClass;
        }
        if (topbarAvatar) {
            topbarAvatar.textContent = profile.initials;
            topbarAvatar.className = 'rounded-circle fw-bold d-inline-flex align-items-center justify-content-center ' + profile.badgeClass;
        }

        const elMap = {
            'sidebar-name': profile.sidebarName,
            'sidebar-subtitle': profile.sidebarSub,
            'topbar-name': profile.sidebarName,
            'dropdown-name': profile.fullName,
            'dropdown-subtitle': profile.sidebarSub,
            'role-switcher-label': profile.switcherText
        };
        Object.keys(elMap).forEach(function(id) {
            const el = document.getElementById(id);
            if (el) el.textContent = elMap[id];
        });

        const statusEl = document.getElementById('sidebar-status');
        if (statusEl) {
            statusEl.innerHTML = '<i class="bi bi-lock-fill me-1" aria-hidden="true"></i>' + profile.statusText;
        }

        const dashLink = document.getElementById('nav-dashboard-link');
        if (dashLink) {
            dashLink.setAttribute('href', profile.homeUrl);
        }

        document.querySelectorAll('a[href^="/"]').forEach(function(link) {
            const href = link.getAttribute('href');
            if (!href || href.startsWith('/switch-role') || href.startsWith('/login') || href.includes('role=')) return;
            const parts = href.split('#');
            const base = parts[0];
            const hash = parts[1] ? '#' + parts[1] : '';
            const sep = base.includes('?') ? '&' : '?';
            link.setAttribute('href', base + sep + 'role=' + activeRole + hash);
        });
    }

    function executeTteSign() {
        const box = document.getElementById('ttePaperBox');
        box.classList.add('signed');
        document.getElementById('ttePaperIcon').className = 'bi bi-qr-code text-success';
        document.getElementById('ttePaperBadge').className = 'badge bg-success mb-1';
        document.getElementById('ttePaperBadge').textContent = 'TERVERIFIKASI SAH (BSrE)';
        document.getElementById('ttePaperTitle').className = 'fw-bold text-success';
        document.getElementById('ttePaperTitle').textContent = 'Ditandatangani Elektronik oleh Kepala Dinas';
        document.getElementById('ttePaperSub').textContent = 'UUID: e8b7a9c2-4f1d-4a9b-8c3e-9102f84a712b';

        new bootstrap.Modal(document.getElementById('modalTteSukses')).show();
    }

    document.addEventListener('DOMContentLoaded', applyLockedRole);
</script>
</body>
</html>
