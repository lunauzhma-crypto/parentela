<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'Formulir Informasi Darurat Rumah') ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #BC4F4F;
            --dark: #291F1E;
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
            line-height: 1.5;
        }

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
            background-color: #BC4F4F;
            color: #ffffff;
        }

        .btn-primary:hover {
            background-color: #993b3b;
        }

        .btn-outline {
            background-color: #ffffff;
            color: #4b5563;
            border: 1px solid #d1d5db;
        }

        .page-container {
            max-width: 800px;
            margin: 30px auto;
            background: #ffffff;
            padding: 40px 50px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.08);
            border-radius: 4px;
            border: 3px solid #BC4F4F;
        }

        .doc-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 3px solid #BC4F4F;
            padding-bottom: 15px;
            margin-bottom: 20px;
        }

        .brand-logo {
            font-family: 'Outfit', sans-serif;
            font-weight: 800;
            font-size: 24px;
            color: #BC4F4F;
        }

        .doc-tag {
            background-color: #fee2e2;
            color: #991b1b;
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 700;
            text-transform: uppercase;
        }

        .section-title {
            font-weight: 700;
            font-size: 1.05rem;
            color: #7f1d1d;
            margin-top: 20px;
            margin-bottom: 12px;
            background-color: #fef2f2;
            padding: 6px 12px;
            border-left: 5px solid #BC4F4F;
            border-radius: 0 6px 6px 0;
        }

        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            margin-bottom: 15px;
        }

        .info-box {
            border: 1px solid #fca5a5;
            padding: 12px 15px;
            border-radius: 6px;
            background-color: #fffafb;
        }

        .info-box h4 {
            font-size: 0.95rem;
            color: #991b1b;
            margin-bottom: 8px;
            border-bottom: 1px dashed #fca5a5;
            padding-bottom: 4px;
        }

        .form-row {
            margin-bottom: 8px;
            font-size: 0.9rem;
            display: flex;
        }

        .form-label {
            width: 140px;
            font-weight: 600;
            color: #4b5563;
        }

        .form-value {
            flex: 1;
            border-bottom: 1px dotted #9ca3af;
            color: #111827;
        }

        .alert-box {
            background-color: #fff1f2;
            border: 2px dashed #f43f5e;
            padding: 15px;
            border-radius: 8px;
            margin-top: 20px;
        }

        .alert-box h4 {
            color: #be123c;
            margin-bottom: 8px;
            font-size: 0.95rem;
        }

        .alert-box ul {
            padding-left: 20px;
            font-size: 0.88rem;
            color: #4c0519;
        }

        @media print {
            body { background: #ffffff !important; }
            .no-print-bar { display: none !important; }
            .page-container {
                margin: 0 !important;
                padding: 20px 30px !important;
                box-shadow: none !important;
                border: 2px solid #BC4F4F !important;
                width: 100% !important;
            }
            @page { size: A4; margin: 1cm; }
        }
    </style>
</head>
<body>

    <div class="no-print-bar">
        <a href="<?= base_url('nanny') ?>" class="btn btn-outline">
            ← Kembali ke Menu Nanny & Pengasuh
        </a>
        <button onclick="window.print()" class="btn btn-primary">
            🖨️ Cetak / Tempel Di Rumah
        </button>
    </div>

    <div class="page-container">
        
        <div class="doc-header">
            <div class="brand-logo">parentela</div>
            <div class="doc-tag">🚨 TEMPEL DI KULKAS / DINDING RUMAH</div>
        </div>

        <h2 style="text-align:center; font-family:'Playfair Display', serif; color:#7f1d1d; margin-bottom:15px; font-size:1.6rem;">
            FORMULIR INFORMASI & KONTAK DARURAT RUMAH
        </h2>

        <!-- DATA ANAK -->
        <div class="section-title">👶 DATA & IDENTITAS ANAK</div>
        <div class="info-grid">
            <div class="info-box">
                <div class="form-row">
                    <div class="form-label">Nama Anak</div>
                    <div class="form-value">: </div>
                </div>
                <div class="form-row">
                    <div class="form-label">Tgl Lahir / Usia</div>
                    <div class="form-value">: </div>
                </div>
                <div class="form-row">
                    <div class="form-label">Golongan Darah</div>
                    <div class="form-value">: </div>
                </div>
            </div>
            <div class="info-box">
                <div class="form-row">
                    <div class="form-label">Alergi Obat</div>
                    <div class="form-value">: </div>
                </div>
                <div class="form-row">
                    <div class="form-label">Alergi Makanan</div>
                    <div class="form-value">: </div>
                </div>
                <div class="form-row">
                    <div class="form-label">Kondisi Medis Khusus</div>
                    <div class="form-value">: </div>
                </div>
            </div>
        </div>

        <!-- KONTAK UTAMA -->
        <div class="section-title">📞 KONTAK ORANG TUA & KELUARGA UTAMA</div>
        <div class="info-grid">
            <div class="info-box">
                <h4>1. IBU</h4>
                <div class="form-row"><div class="form-label">Nama</div><div class="form-value">: </div></div>
                <div class="form-row"><div class="form-label">No. HP / WA</div><div class="form-value">: </div></div>
                <div class="form-row"><div class="form-label">Lokasi Kantor</div><div class="form-value">: </div></div>
            </div>
            <div class="info-box">
                <h4>2. AYAH</h4>
                <div class="form-row"><div class="form-label">Nama</div><div class="form-value">: </div></div>
                <div class="form-row"><div class="form-label">No. HP / WA</div><div class="form-value">: </div></div>
                <div class="form-row"><div class="form-label">Lokasi Kantor</div><div class="form-value">: </div></div>
            </div>
        </div>

        <!-- KONTAK DARURAT LAIN -->
        <div class="section-title">🏥 DOKTER, RUMAH SAKIT & KERABAT TERDEKAT</div>
        <div class="info-grid">
            <div class="info-box">
                <h4>Dokter Anak / Klinik Langganan</h4>
                <div class="form-row"><div class="form-label">Nama Dokter</div><div class="form-value">: </div></div>
                <div class="form-row"><div class="form-label">No. Telepon</div><div class="form-value">: </div></div>
                <div class="form-row"><div class="form-label">Nama RS / Klinik</div><div class="form-value">: </div></div>
            </div>
            <div class="info-box">
                <h4>Kerabat / Tetangga Terdekat</h4>
                <div class="form-row"><div class="form-label">Nama</div><div class="form-value">: </div></div>
                <div class="form-row"><div class="form-label">No. Telepon</div><div class="form-value">: </div></div>
                <div class="form-row"><div class="form-label">Hubungan / Alamat</div><div class="form-value">: </div></div>
            </div>
        </div>

        <!-- LOKASI P3K -->
        <div class="section-title">🩹 PERLENGKAPAN DARURAT RUMAH</div>
        <div class="info-box" style="margin-bottom:15px;">
            <div class="form-row"><div class="form-label">Lokasi Kotak P3K</div><div class="form-value">: </div></div>
            <div class="form-row"><div class="form-label">Lokasi Obat Demam</div><div class="form-value">: </div></div>
            <div class="form-row"><div class="form-label">Lokasi Termometer</div><div class="form-value">: </div></div>
        </div>

        <!-- INSTRUKSI KEADAAN DARURAT -->
        <div class="alert-box">
            <h4>⚠️ PETUNJUK KELUARGA SAAT KEADAAN DARURAT:</h4>
            <ul>
                <li><strong>Demam Tinggi (>38.5°C):</strong> Ukur suhu tubuh, kompres air hangat pada dahi/ketiak, berikan obat demam dosis sesuai instruksi orang tua, dan hubungi Orang Tua segera.</li>
                <li><strong>Terjatuh / Benturan Kepala:</strong> Jangan panik, amati apakah anak pingsan/muntah, kompres es area memar, dan segera hubungi Rumah Sakit / Orang Tua.</li>
                <li><strong>Telepon Darurat Umum:</strong> Ambulans (118/119) | Polisi (110) | Pemadam (113).</li>
            </ul>
        </div>

        <div style="margin-top: 20px; text-align: center; font-size: 0.8rem; color: #9ca3af;">
            Parentela Emergency Form • Harap ditempel di tempat yang mudah terlihat di dalam rumah.
        </div>

    </div>

</body>
</html>
