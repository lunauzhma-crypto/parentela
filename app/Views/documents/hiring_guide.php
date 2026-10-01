<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'Panduan Rekrutmen & Seleksi Pengasuh - Parentela') ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #4C9EEB;
            --dark: #291F1E;
            --light-bg: #FFFDF8;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Outfit', sans-serif;
            color: var(--dark);
            background-color: #f3f4f6;
            line-height: 1.6;
        }

        /* BAR NAVIGASI/CETAK */
        .no-print-bar {
            background-color: #ffffff;
            border-bottom: 2px solid #e5e7eb;
            padding: 12px 24px;
            position: sticky;
            top: 0;
            z-index: 100;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
            border: none;
            font-size: 0.95rem;
            transition: all 0.2s;
        }

        .btn-primary {
            background-color: #4C9EEB;
            color: #ffffff;
        }

        .btn-primary:hover {
            background-color: #3b88d1;
        }

        .btn-outline {
            background-color: #ffffff;
            color: #4b5563;
            border: 1px solid #d1d5db;
        }

        .btn-outline:hover {
            background-color: #f9fafb;
            color: #111827;
        }

        /* KERTAS DOKUMEN (A4) */
        .page-container {
            max-width: 800px;
            margin: 30px auto;
            background: #ffffff;
            padding: 50px 60px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.08);
            border-radius: 4px;
        }

        .doc-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 3px double #4C9EEB;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }

        .brand-logo {
            font-family: 'Outfit', sans-serif;
            font-weight: 800;
            font-size: 24px;
            color: #4C9EEB;
            letter-spacing: -0.5px;
        }

        .doc-tag {
            background-color: #CCE7FF;
            color: #1E3A5F;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            text-transform: uppercase;
        }

        .doc-title {
            text-align: center;
            margin-bottom: 30px;
        }

        .doc-title h1 {
            font-family: 'Playfair Display', serif;
            font-size: 1.6rem;
            color: #1E3A5F;
            margin-bottom: 5px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .doc-title p {
            font-size: 0.85rem;
            color: #6b7280;
        }

        .section-title {
            font-weight: 700;
            font-size: 1.05rem;
            color: #1E3A5F;
            margin-top: 25px;
            margin-bottom: 12px;
            border-left: 4px solid #4C9EEB;
            padding-left: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            font-size: 0.92rem;
        }

        th, td {
            border: 1px solid #d1d5db;
            padding: 10px 12px;
            text-align: left;
        }

        th {
            background-color: #f3f4f6;
            color: #1f2937;
            font-weight: 700;
        }

        .badge-green-flag {
            background-color: #DEF7EC;
            color: #03543F;
            padding: 3px 8px;
            border-radius: 12px;
            font-weight: 700;
            font-size: 0.8rem;
        }

        .badge-red-flag {
            background-color: #FDE8E8;
            color: #9B1C1C;
            padding: 3px 8px;
            border-radius: 12px;
            font-weight: 700;
            font-size: 0.8rem;
        }

        ol, ul {
            padding-left: 20px;
            margin-bottom: 15px;
        }

        li {
            margin-bottom: 8px;
            color: #374151;
            font-size: 0.95rem;
        }

        @media print {
            body {
                background: #ffffff !important;
                color: #000000 !important;
            }

            .no-print-bar {
                display: none !important;
            }

            .page-container {
                margin: 0 !important;
                padding: 30px 40px !important;
                box-shadow: none !important;
                border: none !important;
                max-width: 100% !important;
                width: 100% !important;
            }

            @page {
                size: A4;
                margin: 1.5cm;
            }
        }
    </style>
</head>
<body>

    <!-- BAR TOMBOL CETAK -->
    <div class="no-print-bar">
        <a href="<?= base_url('nanny') ?>" class="btn btn-outline">
            ← Kembali ke Menu Nanny & Pengasuh
        </a>
        <button onclick="window.print()" class="btn btn-primary">
            🖨️ Cetak / Download PDF
        </button>
    </div>

    <!-- HALAMAN DOKUMEN -->
    <div class="page-container">
        
        <div class="doc-header">
            <div class="brand-logo">parentela</div>
            <div class="doc-tag">Panduan Resmi Seleksi</div>
        </div>

        <div class="doc-title">
            <h1>PANDUAN REKRUTMEN & SELEKSI PENGASUH ANAK</h1>
            <p>Lembar Kerja Orang Tua: Daftar Pertanyaan Wawancara, Background Check, dan Evaluasi Risk/Fitur</p>
        </div>

        <!-- SECTION 1 -->
        <div class="section-title">I. DAFTAR PERTANYAAN WAWANCARA KUNCI</div>
        <ol>
            <li><strong>Pengalaman & Riwayat Pengasuhan:</strong> Berapa lama pengalaman mengasuh anak sebelumnya? Berapa usia anak yang pernah diampu? Kenapa berhenti dari majikan sebelumnya?</li>
            <li><strong>Penanganan Anak Tantrum / Menangis:</strong> Bagaimana cara Anda merespons jika anak menangis terus-menerus atau menolak makan (GTM)?</li>
            <li><strong>Kondisi Darurat & Kesehatan:</strong> Pertolongan pertama apa yang Anda ketahui saat anak demam tinggi, tersedak, atau jatuh?</li>
            <li><strong>Disiplin & Etika Kebersihan:</strong> Bagaimana pandangan Anda soal sterilisasi botol susu, mencuci tangan sebelum memegang anak, dan aturan membatasi penggunaan HP saat menjaga anak?</li>
        </ol>

        <!-- SECTION 2 -->
        <div class="section-title">II. CHECKLIST BACKGROUND CHECK & VERIFIKASI IDENTITAS</div>
        <table>
            <thead>
                <tr>
                    <th style="width: 5%;">No</th>
                    <th style="width: 35%;">Item Verifikasi</th>
                    <th style="width: 40%;">Catatan & Bukti Dokumen</th>
                    <th style="width: 20%;">Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Verifikasi KTP Asli & Kartu Keluarga</td>
                    <td>Cocokkan foto KTP dengan wajah calon pengasuh. simpan fotokopi/foto KTP.</td>
                    <td>[ &nbsp; ] Sesuai</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Surat Keterangan Catatan Kepolisian (SKCK)</td>
                    <td>Memastikan calon pengasuh bebas dari rekam jejak kriminalitas.</td>
                    <td>[ &nbsp; ] Ada & Valid</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>Kontak Referensi Majikan Sebelumnya</td>
                    <td>Hubungi minimal 1-2 mantan majikan untuk konfirmasi karakter dan kinerja.</td>
                    <td>[ &nbsp; ] Terverifikasi</td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>Riwayat Kesehatan & Imunisasi</td>
                    <td>Pemeriksaan fisik bebas TBC, Hepatitis, atau penyakit menular lainnya.</td>
                    <td>[ &nbsp; ] Sehat</td>
                </tr>
            </tbody>
        </table>

        <!-- SECTION 3 -->
        <div class="section-title">III. INDIKATOR RED FLAGS VS GREEN FLAGS</div>
        <table>
            <thead>
                <tr>
                    <th style="width: 50%;"><span class="badge-green-flag">✓ GREEN FLAGS (Tanda Pengasuh Baik)</span></th>
                    <th style="width: 50%;"><span class="badge-red-flag">⚠️ RED FLAGS (Perlu Waspada)</span></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Ramah, komunikatif, dan langsung berinisiatif menyapa atau berinteraksi hangat dengan anak saat wawancara.</td>
                    <td>Acuh tak acuh pada anak, lebih fokus melihat smartphone atau menunjukkan gestur kurang sabar.</td>
                </tr>
                <tr>
                    <td>Jujur menceritakan alasan berhenti dari pekerjaan sebelumnya dan terbuka menceritakan latar belakang keluarga.</td>
                    <td>Terlihat defensif, sering berganti-ganti pekerjaan dalam durasi sangat singkat (<3 bulan) tanpa alasan jelas.</td>
                </tr>
                <tr>
                    <td>Menjaga kebersihan diri (kuku bersih, pakaian rapi) dan bersedia mengikuti prosedur/SOP rumah tangga.</td>
                    <td>Menolak aturan batas penggunaan HP atau menawar SOP sterilisasi perlengkapan bayi.</td>
                </tr>
            </tbody>
        </table>

        <!-- SECTION 4 -->
        <div class="section-title">IV. CATATAN KEPUTUSAN ORANG TUA</div>
        <div style="border: 1px dashed #9ca3af; border-radius: 6px; padding: 15px; min-height: 80px; margin-bottom: 20px; background-color: #fafafa;">
            <em>Catatan wawancara / rekomendasi kesepakatan:</em>
        </div>

        <div style="margin-top: 30px; text-align: center; font-size: 0.8rem; color: #9ca3af; border-top: 1px solid #e5e7eb; padding-top: 15px;">
            Dibuat dan dicetak melalui Parentela - Platform Edukasi & Pengasuhan Anak Indonesia
        </div>

    </div>

</body>
</html>
