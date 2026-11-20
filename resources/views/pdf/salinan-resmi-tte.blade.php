<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Salinan Resmi Naskah Dinas Ber-TTE - {{ $dokumen['nomor'] }}</title>
    <style>
        @page {
            margin: 2cm 2.2cm 1.8cm 2.2cm;
        }

        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 11.5pt;
            color: #000000;
            line-height: 1.5;
            margin: 0;
            padding: 0;
        }

        .kop-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 4px;
        }

        .kop-title-kab {
            font-size: 13pt;
            font-weight: bold;
            text-align: center;
            letter-spacing: 0.5px;
        }

        .kop-title-dinas {
            font-size: 15pt;
            font-weight: bold;
            text-align: center;
            letter-spacing: 0.3px;
            margin-top: 2px;
        }

        .kop-address {
            font-size: 9.5pt;
            text-align: center;
            margin-top: 3px;
        }

        .kop-divider {
            border-top: 3px solid #000000;
            border-bottom: 1px solid #000000;
            height: 2px;
            margin-bottom: 18px;
        }

        .meta-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 16px;
        }

        .meta-table td {
            vertical-align: top;
            padding: 1px 0;
        }

        .sppd-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 12px;
            margin-bottom: 16px;
        }

        .sppd-table td {
            border: 1px solid #000000;
            padding: 6px 8px;
            vertical-align: top;
            font-size: 10.5pt;
        }

        .paragraph {
            text-align: justify;
            text-indent: 34px;
            margin-bottom: 12px;
        }

        .signature-wrapper {
            width: 100%;
            margin-top: 24px;
        }

        .tte-box {
            border: 1.5px solid #059669;
            background-color: #F0FDF4;
            padding: 8px 10px;
            margin: 8px 0;
            font-family: Arial, Helvetica, sans-serif;
        }

        .tte-badge {
            background-color: #059669;
            color: #FFFFFF;
            font-size: 7.5pt;
            font-weight: bold;
            padding: 2px 6px;
            display: inline-block;
            margin-bottom: 4px;
        }

        .footer-legal {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            border-top: 1px solid #CBD5E1;
            padding-top: 6px;
            font-family: Arial, Helvetica, sans-serif;
            font-size: 8pt;
            color: #475569;
        }
    </style>
</head>
<body>

    <table class="kop-table">
        <tr>
            <td style="width: 100%;">
                <div class="kop-title-kab">PEMERINTAH KABUPATEN OGAN KOMERING ILIR</div>
                <div class="kop-title-dinas">DINAS KEPENDUDUKAN DAN PENCATATAN SIPIL</div>
                <div class="kop-address">
                    Jl. Letnan Muchtar Saleh No. 01, Kayuagung, Kab. Ogan Komering Ilir, Sumatera Selatan 30611<br>
                    Telepon: (0712) 321456 &bull; Pos-el: disdukcapil@kaboki.go.id &bull; Laman: capil.kaboki.go.id
                </div>
            </td>
        </tr>
    </table>

    <div class="kop-divider"></div>

    @if($dokumen['jenis'] === 'surat_keluar')
        <table class="meta-table">
            <tr>
                <td style="width: 65%;">
                    <table style="width: 100%; border-collapse: collapse;">
                        <tr>
                            <td style="width: 85px;">Nomor</td>
                            <td style="width: 12px;">:</td>
                            <td><strong>{{ $dokumen['nomor'] }}</strong></td>
                        </tr>
                        <tr>
                            <td>Sifat</td>
                            <td>:</td>
                            <td>{{ $dokumen['sifat'] }}</td>
                        </tr>
                        <tr>
                            <td>Lampiran</td>
                            <td>:</td>
                            <td>{{ $dokumen['lampiran'] }}</td>
                        </tr>
                        <tr>
                            <td>Perihal</td>
                            <td>:</td>
                            <td><strong><u>{{ $dokumen['perihal'] }}</u></strong></td>
                        </tr>
                    </table>
                </td>
                <td style="width: 35%; text-align: right;">
                    Kayuagung, {{ $dokumen['tanggal_display'] }}
                </td>
            </tr>
        </table>

        <div style="margin-bottom: 16px;">
            Kepada Yth.<br>
            <strong>{{ $dokumen['tujuan'] }}</strong><br>
            di -<br>
            <span style="padding-left: 20px; font-weight: bold;">Tempat</span>
        </div>

        <p class="paragraph">
            Dalam rangka pelaksanaan tertib administrasi kependudukan serta peningkatan kualitas pelayanan publik pada Dinas Kependudukan dan Pencatatan Sipil Kabupaten Ogan Komering Ilir, bersama ini kami sampaikan naskah dinas resmi mengenai <strong>{{ $dokumen['perihal'] }}</strong>.
        </p>
        <p class="paragraph">
            Seluruh data dan dokumen pendukung yang dilampirkan telah melalui proses verifikasi berjenjang sesuai standar Tata Naskah Dinas Elektronik (TNDE) Pemerintah Kabupaten Ogan Komering Ilir. Demikian disampaikan, atas perhatian dan kerja sama yang baik diucapkan terima kasih.
        </p>

    @elseif($dokumen['jenis'] === 'sppd')
        <div style="text-align: center; margin-bottom: 14px;">
            <div style="font-size: 13pt; font-weight: bold; text-decoration: underline;">SURAT PERINTAH PERJALANAN DINAS (SPPD)</div>
            <div style="font-size: 11pt; margin-top: 2px;">Nomor: <strong>{{ $dokumen['nomor'] }}</strong></div>
        </div>

        <table class="sppd-table">
            <tr>
                <td style="width: 38%; font-weight: bold;">1. Pejabat yang Memberi Perintah</td>
                <td>Kepala Dinas Kependudukan dan Pencatatan Sipil Kabupaten Ogan Komering Ilir</td>
            </tr>
            <tr>
                <td style="font-weight: bold;">2. Nama / NIP Pegawai yang Diperintahkan</td>
                <td>
                    <strong>{{ $dokumen['extra']['nama_pegawai'] ?? '-' }}</strong><br>
                    NIP. {{ $dokumen['extra']['nip_pegawai'] ?? '-' }}
                </td>
            </tr>
            <tr>
                <td style="font-weight: bold;">3. Jabatan / Instansi</td>
                <td>{{ $dokumen['extra']['jabatan_pegawai'] ?? '-' }}</td>
            </tr>
            <tr>
                <td style="font-weight: bold;">4. Maksud Perjalanan Dinas</td>
                <td>{{ $dokumen['perihal'] }}</td>
            </tr>
            <tr>
                <td style="font-weight: bold;">5. Tempat Berangkat &amp; Tempat Tujuan</td>
                <td>Kayuagung &rarr; <strong>{{ $dokumen['tujuan'] }}</strong></td>
            </tr>
            <tr>
                <td style="font-weight: bold;">6. Tanggal Berangkat s/d Tanggal Kembali</td>
                <td>{{ $dokumen['extra']['tanggal_berangkat'] ?? '-' }} s/d {{ $dokumen['extra']['tanggal_kembali'] ?? '-' }}</td>
            </tr>
            <tr>
                <td style="font-weight: bold;">7. Kode Klasifikasi Bidang</td>
                <td>Kode {{ $dokumen['kode_bidang'] }} - {{ $dokumen['nama_bidang'] }}</td>
            </tr>
        </table>

        <div style="text-align: right; margin-bottom: 10px;">
            Dikeluarkan di: Kayuagung &bull; Pada Tanggal: {{ $dokumen['tanggal_display'] }}
        </div>

    @else
        <div style="text-align: center; margin-bottom: 16px;">
            <div style="font-size: 13pt; font-weight: bold; text-decoration: underline;">BERITA ACARA KEDINASAN</div>
            <div style="font-size: 11pt; margin-top: 2px;">Nomor: <strong>{{ $dokumen['nomor'] }}</strong></div>
        </div>

        <p class="paragraph">
            Pada tanggal <strong>{{ $dokumen['tanggal_display'] }}</strong>, bertempat di Kantor Dinas Kependudukan dan Pencatatan Sipil Kabupaten Ogan Komering Ilir, kami yang bertanda tangan di bawah ini:
        </p>

        <table style="width: 100%; border-collapse: collapse; margin-bottom: 14px; margin-left: 16px;">
            <tr>
                <td style="width: 150px; font-weight: bold; padding: 3px 0;">PIHAK PERTAMA</td>
                <td style="width: 12px;">:</td>
                <td><strong>Dinas Kependudukan dan Pencatatan Sipil Kabupaten Ogan Komering Ilir</strong></td>
            </tr>
            <tr>
                <td style="font-weight: bold; padding: 3px 0;">PIHAK KEDUA (MITRA)</td>
                <td>:</td>
                <td><strong>{{ $dokumen['tujuan'] }}</strong></td>
            </tr>
        </table>

        <p class="paragraph">
            Kedua belah pihak telah melaksanakan dan menyepakati <strong>{{ $dokumen['perihal'] }}</strong>. Berita Acara ini dibuat dengan sesungguhnya untuk dipergunakan sebagaimana mestinya sesuai ketentuan peraturan perundang-undangan yang berlaku.
        </p>
    @endif

    <table class="signature-wrapper">
        <tr>
            <td style="width: 38%;"></td>
            <td style="width: 62%; text-align: center;">
                <div style="font-weight: bold; font-size: 10.5pt; margin-bottom: 6px;">
                    KEPALA DINAS KEPENDUDUKAN DAN<br>PENCATATAN SIPIL KABUPATEN OKI,
                </div>

                <div class="tte-box">
                    <table style="width: 100%; border-collapse: collapse;">
                        <tr>
                            <td style="width: 96px; vertical-align: middle; text-align: center;">
                                <img src="{{ $qrBase64 }}" width="88" height="88" alt="QR Code TTE">
                            </td>
                            <td style="vertical-align: middle; text-align: left; padding-left: 8px;">
                                <div class="tte-badge">TERVERIFIKASI SAH (TTE QR CODE)</div>
                                <div style="font-size: 8.5pt; font-weight: bold; color: #065F46; line-height: 1.25;">
                                    Ditandatangani Secara Elektronik oleh Kepala Dinas
                                </div>
                                <div style="font-size: 7.5pt; color: #1E293B; font-family: 'Courier New', Courier, monospace; margin-top: 3px;">
                                    UUID: {{ $dokumen['tte_token_uuid'] }}
                                </div>
                                <div style="font-size: 7.5pt; color: #475569; margin-top: 2px;">
                                    Waktu TTE: {{ $dokumen['signed_at_display'] }}
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>

                <div style="font-weight: bold; text-decoration: underline; font-size: 11pt; margin-top: 6px;">
                    {{ strtoupper($dokumen['penandatangan_nama']) }}
                </div>
                <div style="font-size: 10pt;">{{ $dokumen['penandatangan_pangkat'] }}</div>
                <div style="font-size: 10pt;">NIP. {{ $dokumen['penandatangan_nip'] }}</div>
            </td>
        </tr>
    </table>

    <div class="footer-legal">
        <strong>Catatan Keabsahan Hukum (UU ITE No. 11 Tahun 2008 Pasal 5 Ayat 1):</strong><br>
        Dokumen ini telah ditandatangani secara elektronik menggunakan Token QR Code UUID resmi Disdukcapil Kabupaten Ogan Komering Ilir. Keaslian dokumen dapat diverifikasi melalui: <strong>{{ $dokumen['verify_url'] }}</strong>
    </div>

</body>
</html>
