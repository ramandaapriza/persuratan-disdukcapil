<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Rekapitulasi Buku Besar Persuratan - Disdukcapil OKI</title>
    <style>
        @page {
            margin: 1.5cm 1.8cm 1.5cm 1.8cm;
        }

        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 10pt;
            color: #000000;
            line-height: 1.35;
            margin: 0;
            padding: 0;
        }

        .kop-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 4px;
        }

        .kop-title-kab {
            font-size: 12.5pt;
            font-weight: bold;
            text-align: center;
            letter-spacing: 0.5px;
        }

        .kop-title-dinas {
            font-size: 14.5pt;
            font-weight: bold;
            text-align: center;
            letter-spacing: 0.3px;
            margin-top: 2px;
        }

        .kop-address {
            font-size: 9pt;
            text-align: center;
            margin-top: 2px;
        }

        .kop-divider {
            border-top: 3px solid #000000;
            border-bottom: 1px solid #000000;
            height: 2px;
            margin-bottom: 12px;
        }

        .report-title {
            text-align: center;
            font-size: 11.5pt;
            font-weight: bold;
            text-decoration: underline;
            margin-bottom: 3px;
        }

        .report-subtitle {
            text-align: center;
            font-size: 9.5pt;
            margin-bottom: 10px;
        }

        .summary-box-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
            font-family: Arial, Helvetica, sans-serif;
            font-size: 8.5pt;
        }

        .summary-box-table td {
            border: 1px solid #CBD5E1;
            background-color: #F8FAFC;
            padding: 5px 8px;
        }

        .ledger-table {
            width: 100%;
            border-collapse: collapse;
            font-family: Arial, Helvetica, sans-serif;
            font-size: 8.5pt;
        }

        .ledger-table th {
            background-color: #1E293B;
            color: #FFFFFF;
            font-weight: bold;
            text-transform: uppercase;
            padding: 6px 6px;
            border: 1px solid #1E293B;
            text-align: left;
        }

        .ledger-table td {
            padding: 5px 6px;
            border: 1px solid #CBD5E1;
            vertical-align: top;
        }

        .ledger-table tr:nth-child(even) td {
            background-color: #F8FAFC;
        }

        .mono {
            font-family: 'Courier New', Courier, monospace;
            font-weight: bold;
        }

        .sign-table {
            width: 100%;
            margin-top: 18px;
            border-collapse: collapse;
        }
    </style>
</head>
<body>

    <table class="kop-table">
        <tr>
            <td>
                <div class="kop-title-kab">PEMERINTAH KABUPATEN OGAN KOMERING ILIR</div>
                <div class="kop-title-dinas">DINAS KEPENDUDUKAN DAN PENCATATAN SIPIL</div>
                <div class="kop-address">
                    Jl. Letnan Muchtar Saleh No. 01, Kayuagung, Kab. Ogan Komering Ilir, Sumatera Selatan 30611 &bull;
                    Telepon: (0712) 321456 &bull; Pos-el: disdukcapil@kaboki.go.id &bull; Laman: capil.kaboki.go.id
                </div>
            </td>
        </tr>
    </table>

    <div class="kop-divider"></div>

    <div class="report-title">LAPORAN REKAPITULASI BUKU BESAR PERSURATAN &amp; KEARSIPAN DIGITAL</div>
    <div class="report-subtitle">
        Periode Tanggal:
        <strong>{{ ($filters['tanggal_dari'] ?: 'Awal Pencatatan') . ' s/d ' . ($filters['tanggal_sampai'] ?: 'Sekarang') }}</strong>
        &bull; Filter Jenis: <strong>{{ strtoupper(str_replace('_', ' ', $filters['jenis'])) }}</strong>
        &bull; Kode Bidang: <strong>{{ $filters['kode_bidang'] === 'semua' ? 'SEMUA (400, 800, 00)' : ('KODE ' . $filters['kode_bidang']) }}</strong>
    </div>

    <table class="summary-box-table">
        <tr>
            <td><strong>Surat Masuk:</strong> {{ $summary['surat_masuk'] }} Naskah</td>
            <td><strong>Surat Keluar:</strong> {{ $summary['surat_keluar'] }} Naskah</td>
            <td><strong>SPPD:</strong> {{ $summary['sppd'] }} Naskah</td>
            <td><strong>Berita Acara:</strong> {{ $summary['berita_acara'] }} Naskah</td>
            <td><strong>Total Hasil Filter:</strong> {{ $summary['total'] }} Rekaman</td>
            <td style="text-align: right;"><strong>Dicetak:</strong> {{ $waktuCetak }}</td>
        </tr>
    </table>

    <table class="ledger-table">
        <thead>
            <tr>
                <th style="width: 26px; text-align: center;">NO</th>
                <th style="width: 68px;">AGENDA</th>
                <th style="width: 68px;">TANGGAL</th>
                <th style="width: 145px;">NOMOR NASKAH</th>
                <th style="width: 78px;">KATEGORI</th>
                <th style="width: 62px;">BIDANG</th>
                <th style="width: 145px;">PENGIRIM / TUJUAN</th>
                <th>PERIHAL / POKOK NASKAH</th>
                <th style="width: 125px;">STATUS &amp; TOKEN TTE</th>
            </tr>
        </thead>
        <tbody>
            @forelse($items as $idx => $row)
                <tr>
                    <td style="text-align: center;">{{ $idx + 1 }}</td>
                    <td class="mono">{{ $row['no_agenda'] }}</td>
                    <td>{{ $row['tanggal_display'] }}</td>
                    <td class="mono">{{ $row['nomor_naskah'] }}</td>
                    <td>{{ $row['kategori_label'] }}</td>
                    <td>Kode {{ $row['kode_bidang'] }}</td>
                    <td>
                        <strong>{{ $row['pihak_utama'] }}</strong><br>
                        <span style="color: #475569; font-size: 7.5pt;">{{ $row['pihak_sub'] }}</span>
                    </td>
                    <td>{{ $row['perihal'] }}</td>
                    <td>
                        <strong>{{ $row['status_label'] }}</strong>
                        @if(!empty($row['tte_token_uuid']))
                            <br><span class="mono" style="font-size: 7pt; color: #059669;">UUID: {{ $row['tte_token_uuid'] }}</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" style="text-align: center; padding: 14px;">Tidak ada data naskah dinas yang sesuai dengan filter yang dipilih.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <table class="sign-table">
        <tr>
            <td style="width: 62%; font-family: Arial, Helvetica, sans-serif; font-size: 8pt; color: #475569; vertical-align: bottom;">
                Dicetak melalui Sistem Informasi Pengelolaan Persuratan &amp; Berita Acara (E-Surat Disdukcapil OKI)<br>
                Oleh Akun: <strong>{{ $dicetakOleh->nama_lengkap ?? 'Pejabat Disdukcapil OKI' }}</strong> ({{ $dicetakOleh->jabatan ?? '-' }})
            </td>
            <td style="width: 38%; text-align: center;">
                <div>Kayuagung, {{ now()->translatedFormat('d F Y') }}</div>
                <div style="font-weight: bold; margin-bottom: 44px;">
                    KEPALA DINAS KEPENDUDUKAN DAN<br>PENCATATAN SIPIL KABUPATEN OKI,
                </div>
                <div style="font-weight: bold; text-decoration: underline;">Drs. H. HENDRA SURYADI, M.Si</div>
                <div>Pembina Utama Muda (IV/c)</div>
                <div>NIP. 197108141998031004</div>
            </td>
        </tr>
    </table>

</body>
</html>
