<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'Jurnal Harian Pengasuhan') ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #F97316;
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

        .page-container {
            max-width: 800px;
            margin: 30px auto;
            background: #ffffff;
            padding: 40px 50px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.08);
            border-radius: 4px;
        }

        .doc-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 3px double #F97316;
            padding-bottom: 15px;
            margin-bottom: 20px;
        }

        .brand-logo {
            font-family: 'Outfit', sans-serif;
            font-weight: 800;
            font-size: 24px;
            color: #F97316;
        }

        .doc-tag {
            background-color: #FBE4A1;
            color: #431407;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            text-transform: uppercase;
        }

        .meta-header {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            background-color: #fffaf7;
            border: 1px dashed #F97316;
            padding: 15px 20px;
            border-radius: 8px;
            margin-bottom: 25px;
        }

        .meta-item {
            font-size: 0.95rem;
        }

        .meta-item strong {
            color: #431407;
        }

        .section-title {
            font-weight: 700;
            font-size: 1rem;
            color: #431407;
            margin-top: 20px;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            gap: 8px;
            border-bottom: 2px solid #FFCAB3;
            padding-bottom: 5px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }

        th, td {
            border: 1px solid #d1d5db;
            padding: 8px 12px;
            font-size: 0.9rem;
            text-align: left;
        }

        th {
            background-color: #f9fafb;
            color: #374151;
            font-weight: 600;
        }

        .notes-box {
            border: 1px solid #d1d5db;
            height: 90px;
            border-radius: 6px;
            padding: 10px;
            font-size: 0.85rem;
            color: #9ca3af;
        }

        @media print {
            body { background: #ffffff !important; }
            .no-print-bar { display: none !important; }
            .page-container {
                margin: 0 !important;
                padding: 20px 30px !important;
                box-shadow: none !important;
                border: none !important;
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
            🖨️ Cetak / Download PDF
        </button>
    </div>

    <div class="page-container">
        
        <div class="doc-header">
            <div class="brand-logo">parentela</div>
            <div class="doc-tag">Template Jurnal Harian Pengasuhan</div>
        </div>

        <h2 style="text-align:center; font-family:'Playfair Display', serif; color:#431407; margin-bottom:15px; font-size:1.5rem;">
            JURNAL HARIAN PENGASUHAN (DAILY NANNY LOG)
        </h2>

        <div class="meta-header">
            <div class="meta-item"><strong>Nama Anak:</strong> ....................................................</div>
            <div class="meta-item"><strong>Hari / Tanggal:</strong> ....................................................</div>
            <div class="meta-item"><strong>Nama Pengasuh:</strong> ....................................................</div>
            <div class="meta-item"><strong>Mood Anak:</strong> [ ] Ceria  [ ] Rewel  [ ] Mengantuk</div>
        </div>

        <!-- 1. JADWAL MAKAN & MINUM -->
        <div class="section-title">🥣 1. Catatan Makan & Minum</div>
        <table>
            <thead>
                <tr>
                    <th style="width: 100px;">Waktu</th>
                    <th>Menu Makanan / Minuman</th>
                    <th style="width: 120px;">Porsi Dimakan</th>
                    <th>Keterangan / Reaksi Anak</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Pagi (07.00)</td>
                    <td></td>
                    <td>[ ] Habis [ ] 1/2 [ ] Sedikit</td>
                    <td></td>
                </tr>
                <tr>
                    <td>Snack Pagi (10.00)</td>
                    <td></td>
                    <td>[ ] Habis [ ] 1/2 [ ] Sedikit</td>
                    <td></td>
                </tr>
                <tr>
                    <td>Siang (12.00)</td>
                    <td></td>
                    <td>[ ] Habis [ ] 1/2 [ ] Sedikit</td>
                    <td></td>
                </tr>
                <tr>
                    <td>Susu / Air Putih</td>
                    <td>........ ml</td>
                    <td>-</td>
                    <td></td>
                </tr>
            </tbody>
        </table>

        <!-- 2. JADWAL TIDUR -->
        <div class="section-title">😴 2. Jadwal Tidur Anak</div>
        <table>
            <thead>
                <tr>
                    <th>Sesi Tidur</th>
                    <th style="width: 120px;">Jam Mulai</th>
                    <th style="width: 120px;">Jam Bangun</th>
                    <th>Kualitas Tidur</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Tidur Siang I</td>
                    <td>:</td>
                    <td>:</td>
                    <td>[ ] Nyenyak  [ ] Terbangun-bangun</td>
                </tr>
                <tr>
                    <td>Tidur Siang II</td>
                    <td>:</td>
                    <td>:</td>
                    <td>[ ] Nyenyak  [ ] Terbangun-bangun</td>
                </tr>
            </tbody>
        </table>

        <!-- 3. BUANG AIR & OBAT -->
        <div class="section-title">🚽 3. Buang Air & Riwayat Obat / Suplemen</div>
        <table>
            <thead>
                <tr>
                    <th style="width: 100px;">Waktu</th>
                    <th style="width: 120px;">Jenis (BAB / BAK)</th>
                    <th>Kondisi / Konsistensi / Nama Obat</th>
                    <th style="width: 120px;">Dosis</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td></td>
                    <td>[ ] BAB  [ ] BAK</td>
                    <td></td>
                    <td>-</td>
                </tr>
                <tr>
                    <td></td>
                    <td>[ ] BAB  [ ] BAK</td>
                    <td></td>
                    <td>-</td>
                </tr>
                <tr>
                    <td></td>
                    <td>[ ] Obat / Vitamin</td>
                    <td></td>
                    <td>........ ml/tetes</td>
                </tr>
            </tbody>
        </table>

        <!-- 4. AKTIVITAS & STIMULASI -->
        <div class="section-title">🎨 4. Aktivitas & Stimulasi Hari Ini</div>
        <p style="font-size:0.85rem; margin-bottom: 8px;">Centang aktivitas yang dilakukan:</p>
        <div style="display:grid; grid-template-columns: 1fr 1fr 1fr; gap: 10px; font-size:0.9rem; margin-bottom:15px;">
            <label>[ ] Membaca Buku</label>
            <label>[ ] Bermain di Luar Rumah</label>
            <label>[ ] Mewarnai / Menggambar</label>
            <label>[ ] Bermain Sensorik (Playdough/Air)</label>
            <label>[ ] Mendengarkan Musik / Lagu</label>
            <label>[ ] Screen Time (........ menit)</label>
        </div>

        <!-- 5. CATATAN KEPADA ORANG TUA -->
        <div class="section-title">📝 5. Catatan Khusus untuk Orang Tua</div>
        <div class="notes-box">
            Tuliskan jika ada kebutuhan barang yang habis (diaper, susu, tisu), atau jika anak menunjukkan ruam, luka kecil, atau perilaku khusus hari ini...
        </div>

        <div style="margin-top: 30px; text-align: center; font-size: 0.8rem; color: #9ca3af; border-top: 1px solid #e5e7eb; padding-top: 10px;">
            Dibuat dan dicetak melalui Parentela - Platform Edukasi & Pengasuhan Anak Indonesia
        </div>

    </div>

</body>
</html>
