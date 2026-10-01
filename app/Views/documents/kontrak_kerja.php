<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'Draft Kontrak Kerja Pengasuh') ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #F97316;
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

        /* BAR NAVIGASI/CETAK (Hanya Muncul di Layar) */
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
            background-color: var(--primary);
            color: #ffffff;
        }

        .btn-primary:hover {
            background-color: #ea580c;
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

        /* HEADER DOKUMEN */
        .doc-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 3px double #F97316;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }

        .brand-logo {
            font-family: 'Outfit', sans-serif;
            font-weight: 800;
            font-size: 24px;
            color: #F97316;
            letter-spacing: -0.5px;
        }

        .doc-tag {
            background-color: #FFD8C9;
            color: #431407;
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
            color: #431407;
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
            color: #431407;
            margin-top: 25px;
            margin-bottom: 10px;
            border-left: 4px solid #F97316;
            padding-left: 10px;
        }

        .form-row {
            margin-bottom: 12px;
            display: flex;
        }

        .form-label {
            width: 180px;
            font-weight: 500;
            color: #374151;
        }

        .form-value {
            flex: 1;
            border-bottom: 1px dotted #9ca3af;
            color: #111827;
            padding-bottom: 2px;
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

        .signatures {
            margin-top: 50px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
            text-align: center;
        }

        .sig-box {
            padding-top: 15px;
        }

        .sig-space {
            height: 70px;
        }

        .sig-name {
            font-weight: 600;
            border-bottom: 1px solid #374151;
            display: inline-block;
            min-width: 180px;
            padding-bottom: 4px;
        }

        /* MEDIA PRINT */
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

            .btn {
                display: none !important;
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
            <div class="doc-tag">Template Resmi Orang Tua</div>
        </div>

        <div class="doc-title">
            <h1>SURAT PERJANJIAN KERJA (SPK) PENGASUH ANAK</h1>
            <p>Dokumen Perjanjian Kerja Orang Tua (Majikan) dan Nanny / Pengasuh</p>
        </div>

        <p style="font-size:0.95rem; margin-bottom: 20px;">
            Pada hari ini, <strong>....................</strong> tanggal <strong>......</strong> bulan <strong>........................</strong> tahun <strong>20.....</strong>, kami yang bertanda tangan di bawah ini:
        </p>

        <!-- PIHAK PERTAMA -->
        <div class="section-title">I. PIHAK PERTAMA (Pemberi Kerja / Orang Tua)</div>
        <div class="form-row">
            <div class="form-label">Nama Lengkap</div>
            <div class="form-value">: </div>
        </div>
        <div class="form-row">
            <div class="form-label">No. KTP / NIK</div>
            <div class="form-value">: </div>
        </div>
        <div class="form-row">
            <div class="form-label">No. Telepon / HP</div>
            <div class="form-value">: </div>
        </div>
        <div class="form-row">
            <div class="form-label">Alamat Rumah</div>
            <div class="form-value">: </div>
        </div>

        <!-- PIHAK KEDUA -->
        <div class="section-title">II. PIHAK KEDUA (Penerima Kerja / Pengasuh)</div>
        <div class="form-row">
            <div class="form-label">Nama Lengkap</div>
            <div class="form-value">: </div>
        </div>
        <div class="form-row">
            <div class="form-label">No. KTP / NIK</div>
            <div class="form-value">: </div>
        </div>
        <div class="form-row">
            <div class="form-label">No. Telepon / HP</div>
            <div class="form-value">: </div>
        </div>
        <div class="form-row">
            <div class="form-label">Alamat Asal / KTP</div>
            <div class="form-value">: </div>
        </div>

        <p style="font-size:0.95rem; margin: 20px 0 10px;">
            Kedua belah pihak sepakat untuk mengikatkan diri dalam Perjanjian Kerja Pengasuhan Anak dengan ketentuan sebagai berikut:
        </p>

        <!-- PASAL 1 -->
        <div class="section-title">PASAL 1: TUGAS DAN TANGGUNG JAWAB UTAMA</div>
        <ol>
            <li>Mengasuh, merawat, dan menjaga keselamatan anak bernama: <strong>..................................................</strong> (Usia: ........ tahun/bulan).</li>
            <li>Menyiapkan makanan/minuman anak sesuai jadwal dan instruksi Pihak Pertama.</li>
            <li>Mencuci, mensterilkan, dan menjaga kebersihan pakaian serta perlengkapan anak.</li>
            <li>Mendampingi anak bermain, belajar, serta aktivitas stimulasi tumbuh kembang harian.</li>
            <li>Mengisi Jurnal Harian Pengasuhan secara tertib setiap hari.</li>
        </ol>

        <!-- PASAL 2 -->
        <div class="section-title">PASAL 2: HAK, GAJI, DAN FASILITAS</div>
        <ol>
            <li><strong>Masa Percobaan:</strong> Berlangsung selama ...... bulan terhitung mulai tanggal ............................</li>
            <li><strong>Gaji Pokok:</strong> Pihak Kedua berhak menerima gaji bulanan sebesar <strong>Rp ........................................</strong> yang dibayarkan setiap tanggal ...... setiap bulannya.</li>
            <li><strong>Hari Libur:</strong> Pihak Kedua berhak atas libur ...... hari per bulan atau sesuai kesepakatan bersama.</li>
            <li><strong>Tunjangan Hari Raya (THR):</strong> Diberikan sesuai ketentuan lama masa kerja.</li>
        </ol>

        <!-- PASAL 3 -->
        <div class="section-title">PASAL 3: TATA TER TIB & KETENTUAN KHUSUS</div>
        <ol>
            <li>Dilarang bermain HP / media sosial saat sedang aktif menjaga anak demi keselamatan anak.</li>
            <li>Dilarang membawa orang luar masuk ke dalam rumah tanpa izin Pihak Pertama.</li>
            <li>Menjaga kerahasiaan dan privasi keluarga Pihak Pertama.</li>
            <li>Segera melapor ke Pihak Pertama jika anak menunjukkan tanda-tanda sakit atau kondisi darurat.</li>
        </ol>

        <!-- PASAL 4 -->
        <div class="section-title">PASAL 4: PEMUTUSAN HUBUNGAN KERJA</div>
        <p style="font-size:0.95rem; margin-bottom: 10px;">
            Apabila salah satu pihak ingin mengakhiri hubungan kerja, wajib memberikan pemberitahuan sekurang-kurangnya <strong>14 (empat belas) hari</strong> sebelumnya.
        </p>

        <!-- TANDA TANGAN -->
        <div class="signatures">
            <div class="sig-box">
                <p><strong>PIHAK PERTAMA</strong><br><small>(Orang Tua)</small></p>
                <div class="sig-space"></div>
                <div class="sig-name">( .................................................... )</div>
            </div>
            <div class="sig-box">
                <p><strong>PIHAK KEDUA</strong><br><small>(Pengasuh / Nanny)</small></p>
                <div class="sig-space"></div>
                <div class="sig-name">( .................................................... )</div>
            </div>
        </div>

        <div style="margin-top: 40px; text-align: center; font-size: 0.8rem; color: #9ca3af; border-top: 1px solid #e5e7eb; padding-top: 15px;">
            Dibuat dan dicetak melalui Parentela - Platform Edukasi & Pengasuhan Anak Indonesia
        </div>

    </div>

</body>
</html>
