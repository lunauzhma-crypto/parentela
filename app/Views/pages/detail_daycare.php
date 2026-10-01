<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<?php 
    $heroStyle = !empty($daycare['foto_utama']) 
        ? "background-image: url('" . ((strpos($daycare['foto_utama'], 'http') === 0 || strpos($daycare['foto_utama'], 'data:') === 0) ? esc($daycare['foto_utama']) : base_url($daycare['foto_utama'])) . "');" 
        : "background: linear-gradient(135deg, #7a2b2b 0%, #a84b4b 50%, #db8a74 100%);";
?>
<!-- Header / Hero Image dengan Efek Fade -->
<section class="detail-hero" style="<?= $heroStyle ?>">
    <!-- Overlay Gelap di atas untuk memperjelas teks -->
    <div class="hero-overlay-top"></div>
    
    <!-- Efek Fade/Gradasi ke warna latar belakang halaman di bagian bawah -->
    <div class="hero-fade-bottom"></div>
    
    <div class="container relative-content">
        <span class="badge-kategori">🧸 <?= esc($daycare['category'] ?? 'Daycare Terverifikasi') ?></span>
        <h1 class="detail-title"><?= esc($daycare['nama']) ?></h1>
        <p class="detail-location"><?= esc($daycare['lokasi']) ?></p>
    </div>
</section>

<!-- Konten Utama (Ditarik sedikit ke atas agar overlap dengan efek fade) -->
<section class="detail-content-section">
    <div class="container">
        <div class="detail-grid">
            
            <!-- Kolom Kiri: Penjelasan, Fasilitas & Galeri -->
            <div class="detail-main">
                <div class="main-card">
                    <h2>Tentang Daycare Ini</h2>
                    <p class="deskripsi-teks"><?= esc($daycare['deskripsi']) ?></p>
                    
                    <h3 class="section-subtitle">✨ Fasilitas Unggulan</h3>
                    <?php 
                        $fasilitasList = [];
                        if (!empty($daycare['fasilitas'])) {
                            if (is_array($daycare['fasilitas'])) {
                                $fasilitasList = $daycare['fasilitas'];
                            } else {
                                $decodedF = json_decode($daycare['fasilitas'], true);
                                $fasilitasList = is_array($decodedF) ? $decodedF : array_filter(array_map('trim', explode("\n", $daycare['fasilitas'])));
                            }
                        }
                    ?>
                    <?php if (!empty($fasilitasList)): ?>
                        <ul class="fasilitas-list">
                            <?php foreach ($fasilitasList as $fasilitas): ?>
                                <li><i class="fas fa-check-circle check-icon"></i> <?= esc($fasilitas) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php else: ?>
                        <p style="color: #888; font-size: 14px; font-style: italic;">Informasi fasilitas dapat ditanyakan langsung melalui kontak pengelola.</p>
                    <?php endif; ?>

                    <?php
                    $galeriDaycare = [];
                    $galeriRaw = $daycare['galeri'] ?? [];
                    if (is_string($galeriRaw)) {
                        $decodedG = json_decode($galeriRaw, true);
                        $galeriRaw = is_array($decodedG) ? $decodedG : [];
                    }
                    if (!is_array($galeriRaw)) {
                        $galeriRaw = [];
                    }

                    foreach ($galeriRaw as $idx => $foto) {
                        $defaultJudul = [
                            0 => 'Area Bermain & Stimulasi Motorik Anak',
                            1 => 'Aktivitas Belajar Interaktif & Kreativitas',
                            2 => 'Kenyamanan Ruang Istirahat & Makan Sehat'
                        ];
                        $defaultDeskripsi = [
                            0 => 'Arena bermain indoor dan outdoor yang aman, higienis, serta dirancang khusus untuk merangsang sensorik motorik anak di ' . $daycare['nama'] . '.',
                            1 => 'Program bimbingan bermain sambil belajar, sensory play, serta kreativitas yang didampingi penuh kasih sayang oleh pengasuh profesional.',
                            2 => 'Fasilitas ruang istirahat yang sejuk, bersih, dan jadwal makan bernutrisi tinggi untuk menunjang tumbuh kembang optimal si kecil.'
                        ];
                        $defaultTag = [
                            0 => 'Fasilitas & Arena',
                            1 => 'Aktivitas Edukasi',
                            2 => 'Kenyamanan Balita'
                        ];
                        
                        $imgUrl = is_array($foto) ? ($foto['url'] ?? '') : $foto;
                        if (!empty($imgUrl)) {
                            if (strpos($imgUrl, 'http') !== 0 && strpos($imgUrl, 'data:') !== 0) {
                                $imgUrl = base_url($imgUrl);
                            }
                            $galeriDaycare[] = [
                                'url' => $imgUrl,
                                'judul' => is_array($foto) ? ($foto['judul'] ?? ('Dokumentasi Foto #' . ($idx + 1))) : ($defaultJudul[$idx] ?? ('Dokumentasi Kegiatan #' . ($idx + 1))),
                                'deskripsi' => is_array($foto) ? ($foto['deskripsi'] ?? 'Momen kegiatan ceria anak-anak di daycare.') : ($defaultDeskripsi[$idx] ?? ('Dokumentasi momen kegiatan dan kehangatan pengasuhan di ' . $daycare['nama'] . '.')),
                                'tag' => is_array($foto) ? ($foto['tag'] ?? 'Kegiatan Daycare') : ($defaultTag[$idx] ?? 'Daycare Ceria')
                            ];
                        }
                    }
                    ?>

                    <?php if (!empty($galeriDaycare)): ?>
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 30px; margin-bottom: 15px;">
                        <h3 class="section-subtitle" style="margin: 0;">📸 Galeri Kegiatan</h3>
                        <span style="font-size: 13px; color: #777; background: #fdf6f3; padding: 4px 12px; border-radius: 12px; border: 1px solid #fae3dc;">
                            <strong style="color: #db8a74;"><?= count($galeriDaycare) ?></strong> Foto • Klik untuk detail
                        </span>
                    </div>
                    <?php endif; ?>

                    <?php if (!empty($galeriDaycare)): ?>
                    <!-- Carousel Wrapper dengan Tombol Panah Kiri dan Kanan -->
                    <div class="daycare-carousel-wrapper">
                        <button type="button" id="daycarePrevBtn" class="daycare-nav-btn prev" aria-label="Foto Sebelumnya" title="Foto Sebelumnya">
                            <i class="fas fa-chevron-left"></i>
                        </button>

                        <div id="daycareTrack" class="daycare-track">
                            <?php foreach ($galeriDaycare as $idx => $f): ?>
                                <div class="daycare-card" 
                                     onclick="openDaycareModal(<?= $idx ?>)"
                                     role="button"
                                     tabindex="0"
                                     onkeydown="if(event.key==='Enter'||event.key===' ')openDaycareModal(<?= $idx ?>)"
                                     aria-label="Lihat detail foto <?= esc($f['judul']) ?>">
                                    <img src="<?= esc($f['url']) ?>" 
                                         alt="<?= esc($f['judul']) ?>" 
                                         loading="lazy"
                                         onerror="this.onerror=null; this.src='<?= base_url('images/locations/daycare-surabaya.jpg') ?>';">
                                    <span class="daycare-badge-tag"><?= esc($f['tag']) ?></span>
                                    <div class="daycare-card-overlay">
                                        <div class="daycare-card-info">
                                            <div class="daycare-card-title"><?= esc($f['judul']) ?></div>
                                            <div class="daycare-card-hint">Klik untuk detail ↗</div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>

                        <button type="button" id="daycareNextBtn" class="daycare-nav-btn next" aria-label="Foto Selanjutnya" title="Foto Selanjutnya">
                            <i class="fas fa-chevron-right"></i>
                        </button>
                    </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Kolom Kanan: Informasi, Maps & Kontak -->
            <div class="detail-sidebar">
                <div class="info-card">
                    <h3>Informasi Layanan</h3>
                    
                    <div class="info-item">
                        <span class="info-icon">🕒</span>
                        <div class="info-text">
                            <strong>Jam Operasional</strong>
                            <span><?= esc($daycare['jam_buka']) ?></span>
                        </div>
                    </div>
                    
                    <div class="info-item">
                        <span class="info-icon">👶</span>
                        <div class="info-text">
                            <strong>Rentang Usia</strong>
                            <span><?= esc($daycare['usia']) ?></span>
                        </div>
                    </div>

                    <div class="info-item">
                        <span class="info-icon">💰</span>
                        <div class="info-text">
                            <strong>Estimasi Biaya</strong>
                            <span><?= esc($daycare['harga']) ?></span>
                        </div>
                    </div>

                    <hr class="divider">

                    <!-- Google Maps Embed (Diperbesar tingginya agar lebih lega) -->
                    <div class="maps-container">
                        <h4 style="margin-top:0; margin-bottom:10px; font-size:15px; color:#555;">📍 Titik Lokasi</h4>
                        <iframe 
                            src="<?= $daycare['gmaps'] ?>" 
                            width="100%" 
                            height="240" 
                            style="border:0; border-radius: 12px;" 
                            allowfullscreen="" 
                            loading="lazy" 
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>

                    <hr class="divider">

                    <!-- Tombol Aksi -->
                    <div class="action-buttons">
                        <?php 
                            $pesan = "Halo Admin " . $daycare['nama'] . ", saya tahu dari website Parentela. Bisa minta informasi pendaftaran?";
                        ?>
                        <a href="https://wa.me/<?= $daycare['wa'] ?>?text=<?= urlencode($pesan) ?>" target="_blank" class="btn-modern btn-whatsapp">
                            Hubungi via WhatsApp
                        </a>
                        
                        <?php if (!empty($daycare['website'])): ?>
                        <a href="<?= esc($daycare['website']) ?>" target="_blank" class="btn-modern btn-website">
                            Kunjungi Website / Info Resmi
                        </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- CSS Modern -->
<style>
    body {
        background-color: #fdfaf9;
    }

    /* Hero Section & Efek Fade */
    .detail-hero {
        position: relative;
        width: 100%;
        height: 500px;
        background-size: cover;
        background-position: center;
        display: flex;
        align-items: flex-end;
        padding-bottom: 80px;
    }
    
    .hero-overlay-top {
        position: absolute;
        top: 0; left: 0; width: 100%; height: 100%;
        background: rgba(0, 0, 0, 0.4);
        z-index: 1;
    }

    .hero-fade-bottom {
        position: absolute;
        bottom: -2px; left: 0; width: 100%; height: 150px;
        background: linear-gradient(to bottom, rgba(253, 250, 249, 0) 0%, rgba(253, 250, 249, 1) 100%);
        z-index: 2;
    }

    .relative-content {
        position: relative;
        z-index: 3;
        color: white;
    }

    .badge-kategori {
        background: #db8a74;
        color: white;
        padding: 6px 16px;
        border-radius: 30px;
        font-size: 14px;
        font-weight: 600;
        display: inline-block;
        margin-bottom: 15px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.15);
    }
    
    .detail-title {
        font-family: 'Playfair Display', serif;
        font-size: 46px;
        font-weight: 700;
        margin: 0 0 10px 0;
        letter-spacing: -0.5px;
    }

    .detail-location {
        font-size: 18px;
        margin: 0;
        font-weight: 400;
        color: #f1f1f1;
    }

    /* Layout Konten */
    .detail-content-section {
        position: relative;
        z-index: 10;
        margin-top: -60px;
        padding-bottom: 80px;
    }

    .detail-grid {
        display: flex;
        gap: 30px;
        align-items: flex-start;
    }

    .detail-main {
        flex: 1.8;
    }

    .detail-sidebar {
        flex: 1;
        position: sticky;
        top: 90px;
    }

    .detail-main h2 {
        font-family: 'Playfair Display', serif;
        color: #a84b4b;
        font-size: 32px;
        font-weight: 700;
        margin-top: 0;
        margin-bottom: 20px;
    }
    
    .deskripsi-teks {
        font-size: 17px;
        line-height: 1.7;
        color: #4a4a4a;
        margin-bottom: 40px;
    }

    .section-subtitle {
        color: #a84b4b;
        font-size: 22px;
        font-weight: 600;
        margin-bottom: 20px;
        margin-top: 40px;
    }

    .fasilitas-list {
        list-style: none;
        padding: 0;
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 15px;
    }

    .fasilitas-list li {
        font-size: 16px;
        color: #444;
        display: flex;
        align-items: flex-start;
        gap: 10px;
    }

    .check-icon {
        color: #38bdf8;
        margin-top: 4px;
    }

    /* Carousel Galeri Daycare */
    .daycare-carousel-wrapper {
        position: relative;
        padding: 0 4px;
        margin-top: 10px;
    }

    .daycare-track {
        display: flex;
        gap: 16px;
        overflow-x: auto;
        scroll-behavior: smooth;
        scroll-snap-type: x mandatory;
        scrollbar-width: none;
        -ms-overflow-style: none;
        padding: 6px 2px;
    }
    .daycare-track::-webkit-scrollbar {
        display: none;
    }

    .daycare-nav-btn {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        width: 42px;
        height: 42px;
        border-radius: 50%;
        background: #ffffff;
        border: 1.5px solid #f2cfc5;
        color: #a84b4b;
        box-shadow: 0 4px 14px rgba(0, 0, 0, 0.12);
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        z-index: 5;
        transition: all 0.22s cubic-bezier(0.16, 1, 0.3, 1);
    }
    .daycare-nav-btn.prev {
        left: -15px;
    }
    .daycare-nav-btn.next {
        right: -15px;
    }
    .daycare-nav-btn:hover {
        background: #db8a74;
        color: #ffffff;
        border-color: #db8a74;
        transform: translateY(-50%) scale(1.1);
        box-shadow: 0 6px 18px rgba(219, 138, 116, 0.4);
    }
    .daycare-nav-btn.is-disabled {
        opacity: 0.35;
        pointer-events: none;
    }

    .daycare-card {
        flex: 0 0 215px;
        width: 215px;
        height: 145px;
        border-radius: 14px;
        overflow: hidden;
        position: relative;
        cursor: pointer;
        scroll-snap-align: start;
        box-shadow: 0 4px 14px rgba(0, 0, 0, 0.06);
        border: 1px solid rgba(249, 227, 219, 0.8);
        background: #fdfaf9;
        transition: transform 0.25s ease, box-shadow 0.25s ease, border-color 0.25s ease;
        outline: none;
    }
    .daycare-card img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
        transition: transform 0.4s ease;
    }
    .daycare-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 24px rgba(219, 138, 116, 0.25);
        border-color: #db8a74;
    }
    .daycare-card:hover img {
        transform: scale(1.08);
    }

    .daycare-badge-tag {
        position: absolute;
        top: 8px;
        left: 8px;
        background: rgba(20, 15, 15, 0.65);
        backdrop-filter: blur(4px);
        color: #ffffff;
        font-size: 10.5px;
        font-weight: 600;
        padding: 3px 8px;
        border-radius: 6px;
        z-index: 2;
        pointer-events: none;
    }

    .daycare-card-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(to top, rgba(15, 10, 10, 0.9) 0%, rgba(15, 10, 10, 0.3) 60%, transparent 100%);
        display: flex;
        flex-direction: column;
        justify-content: flex-end;
        padding: 10px;
        opacity: 0;
        transition: opacity 0.25s ease;
        z-index: 3;
    }
    .daycare-card:hover .daycare-card-overlay {
        opacity: 1;
    }
    .daycare-card-title {
        color: #ffffff;
        font-size: 12px;
        font-weight: 600;
        line-height: 1.3;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .daycare-card-hint {
        color: #f7c5b6;
        font-size: 10.5px;
        font-weight: 500;
        margin-top: 2px;
    }

    /* Sidebar Kanan */
    .info-card {
        background: #ffffff;
        padding: 35px 30px;
        border-radius: 24px;
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.04);
        border: 1px solid rgba(219, 138, 116, 0.15);
    }

    .info-card h3 {
        font-family: 'Playfair Display', serif;
        margin-top: 0;
        color: #333;
        font-size: 24px;
        font-weight: 700;
        margin-bottom: 25px;
    }

    .info-item {
        display: flex;
        gap: 16px;
        margin-bottom: 20px;
        align-items: center;
    }

    .info-icon {
        font-size: 26px;
        background: #fdfaf9;
        padding: 10px;
        border-radius: 50%;
    }

    .info-text strong {
        display: block;
        color: #222;
        font-size: 15px;
        margin-bottom: 4px;
    }

    .info-text span {
        color: #666;
        font-size: 15px;
    }

    .divider {
        border: none;
        border-top: 1px dashed #e2e2e2;
        margin: 25px 0;
    }

    /* Tombol Aksi */
    .action-buttons {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .btn-modern {
        display: block;
        text-align: center;
        padding: 16px;
        border-radius: 14px;
        text-decoration: none;
        font-weight: 600;
        font-size: 16px;
        transition: all 0.3s ease;
    }

    .btn-whatsapp {
        background: #22c55e; 
        color: white;
        box-shadow: 0 4px 15px rgba(34, 197, 94, 0.3);
    }

    .btn-whatsapp:hover {
        background: #16a34a;
        color: white;
        transform: translateY(-2px);
    }

    .btn-website {
        background: #fff;
        color: #a84b4b;
        border: 2px solid #a84b4b;
    }

    .btn-website:hover {
        background: #fdfaf9;
        color: #8c3b3b;
    }

    /* MODAL POPUP STYLING (PERBAIKAN ERROR OVERLAY UNHIDDEN) */
    .galeri-modal-backdrop {
        position: fixed;
        inset: 0;
        background: rgba(18, 12, 10, 0.82);
        backdrop-filter: blur(8px);
        -webkit-backdrop-filter: blur(8px);
        z-index: 99999;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
        opacity: 0;
        visibility: hidden;
        transition: opacity 0.25s ease, visibility 0.25s ease;
    }
    .galeri-modal-backdrop.show {
        opacity: 1;
        visibility: visible;
    }
    .galeri-modal-box {
        background: #ffffff;
        border-radius: 24px;
        max-width: 800px;
        width: 100%;
        max-height: 92vh;
        overflow-y: auto;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.4);
        transform: scale(0.95) translateY(10px);
        transition: transform 0.25s cubic-bezier(0.16, 1, 0.3, 1);
        display: flex;
        flex-direction: column;
    }
    .galeri-modal-backdrop.show .galeri-modal-box {
        transform: scale(1) translateY(0);
    }
    .galeri-modal-top {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 16px 22px;
        border-bottom: 1px solid #f2e2de;
    }
    .galeri-modal-tag-badge {
        background: #fdf6f3;
        color: #db8a74;
        font-size: 12px;
        font-weight: 700;
        padding: 4px 12px;
        border-radius: 20px;
        border: 1px solid #fae3dc;
    }
    .galeri-modal-counter-badge {
        font-size: 13px;
        color: #718096;
        margin-left: 8px;
        font-weight: 600;
    }
    .galeri-modal-close-btn {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        border: none;
        background: #F7FAFC;
        color: #4A5568;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.2s;
    }
    .galeri-modal-close-btn:hover {
        background: #FEE2E2;
        color: #DC2626;
        transform: rotate(90deg);
    }
    .galeri-modal-image-area {
        position: relative;
        width: 100%;
        height: 400px;
        background: #1A202C;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .galeri-modal-image-area img {
        max-width: 100%;
        max-height: 400px;
        object-fit: contain;
    }
    .galeri-modal-arrow-btn {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        width: 44px;
        height: 44px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.9);
        border: 1px solid rgba(255, 255, 255, 0.5);
        color: #2D3748;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.2s;
        z-index: 5;
    }
    .galeri-modal-arrow-btn.prev { left: 16px; }
    .galeri-modal-arrow-btn.next { right: 16px; }
    .galeri-modal-arrow-btn:hover {
        background: #db8a74;
        color: white;
        transform: translateY(-50%) scale(1.1);
    }
    .galeri-modal-info-area { padding: 22px 24px 26px; }
    .galeri-modal-location-pill {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        color: #718096;
        font-size: 13px;
        margin-bottom: 8px;
        font-weight: 600;
    }
    .galeri-modal-heading {
        font-family: 'Playfair Display', serif;
        color: #1A202C;
        font-size: 22px;
        font-weight: 800;
        margin: 0 0 10px;
    }
    .galeri-modal-text {
        color: #4A5568;
        font-size: 14.5px;
        line-height: 1.75;
        margin: 0 0 20px;
    }
    .galeri-modal-thumbs-container {
        border-top: 1px solid #EDF2F7;
        padding-top: 14px;
    }
    .galeri-modal-thumbs-label {
        font-size: 11.5px;
        font-weight: 700;
        color: #718096;
        margin-bottom: 10px;
        text-transform: uppercase;
    }
    .galeri-modal-thumbs-row {
        display: flex;
        gap: 10px;
        overflow-x: auto;
        padding-bottom: 4px;
    }
    .galeri-modal-thumb-btn {
        flex: 0 0 66px;
        width: 66px;
        height: 50px;
        border-radius: 10px;
        overflow: hidden;
        border: 2.5px solid transparent;
        cursor: pointer;
        padding: 0;
        background: #EDF2F7;
        opacity: 0.6;
        transition: all 0.2s;
    }
    .galeri-modal-thumb-btn img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .galeri-modal-thumb-btn.active, 
    .galeri-modal-thumb-btn:hover {
        border-color: #db8a74;
        opacity: 1;
        transform: scale(1.05);
    }

    @media (max-width: 992px) {
        .detail-grid {
            flex-direction: column;
        }
        .detail-sidebar {
            position: static;
        }
        .fasilitas-list {
            grid-template-columns: 1fr;
        }
        .detail-title {
            font-size: 32px;
        }
        .daycare-nav-btn.prev {
            left: -8px;
        }
        .daycare-nav-btn.next {
            right: -8px;
        }
    }
</style>

<!-- Modal Detail Foto Daycare -->
<div id="daycareModal" class="galeri-modal-backdrop" onclick="handleDaycareModalBackdrop(event)" role="dialog" aria-modal="true" aria-hidden="true">
    <div class="galeri-modal-box">
        <div class="galeri-modal-top">
            <div class="galeri-modal-badges">
                <span id="daycareModalTagBadge" class="galeri-modal-tag-badge">Kegiatan Daycare</span>
                <span id="daycareModalCounterBadge" class="galeri-modal-counter-badge">Foto 1 dari <?= count($galeriDaycare) ?></span>
            </div>
            <button type="button" class="galeri-modal-close-btn" onclick="closeDaycareModal()" aria-label="Tutup detail foto" title="Tutup (Esc)">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <div class="galeri-modal-image-area">
            <img id="daycareModalMainImg" src="" alt="Detail Foto Daycare" onerror="this.onerror=null; this.src='<?= base_url('images/locations/daycare-surabaya.jpg') ?>';">
            
            <button type="button" class="galeri-modal-arrow-btn prev" onclick="navigateDaycareModal(-1)" aria-label="Foto Sebelumnya" title="Foto Sebelumnya">
                <i class="fas fa-chevron-left"></i>
            </button>
            <button type="button" class="galeri-modal-arrow-btn next" onclick="navigateDaycareModal(1)" aria-label="Foto Selanjutnya" title="Foto Selanjutnya">
                <i class="fas fa-chevron-right"></i>
            </button>
        </div>

        <div class="galeri-modal-info-area">
            <div class="galeri-modal-location-pill">
                <i class="fas fa-map-marker-alt"></i>
                <span><?= esc($daycare['nama']) ?></span>
            </div>
            <h3 id="daycareModalTitle" class="galeri-modal-heading">Judul Foto</h3>
            <p id="daycareModalDesc" class="galeri-modal-text">Deskripsi lengkap seputar aktivitas dan kenyamanan anak di daycare.</p>

            <div class="galeri-modal-thumbs-container">
                <div class="galeri-modal-thumbs-label">Daftar Foto Galeri:</div>
                <div class="galeri-modal-thumbs-row" id="daycareModalThumbRow">
                    <?php foreach ($galeriDaycare as $tIdx => $tFoto): ?>
                        <button type="button" 
                                class="galeri-modal-thumb-btn <?= $tIdx === 0 ? 'active' : '' ?>" 
                                onclick="openDaycareModal(<?= $tIdx ?>)"
                                data-thumb-idx="<?= $tIdx ?>"
                                aria-label="Pilih foto <?= $tIdx + 1 ?>">
                            <img src="<?= esc($tFoto['url']) ?>" alt="Thumb <?= $tIdx + 1 ?>" onerror="this.onerror=null; this.src='<?= base_url('images/locations/daycare-surabaya.jpg') ?>';">
                        </button>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
const daycareGaleriData = <?= json_encode($galeriDaycare) ?>;
let currentDaycareModalIndex = 0;

document.addEventListener('DOMContentLoaded', function() {
    const track = document.getElementById('daycareTrack');
    const prevBtn = document.getElementById('daycarePrevBtn');
    const nextBtn = document.getElementById('daycareNextBtn');

    if (track && prevBtn && nextBtn) {
        const updateNavButtons = () => {
            const maxScrollLeft = track.scrollWidth - track.clientWidth;
            if (track.scrollLeft <= 5) {
                prevBtn.classList.add('is-disabled');
            } else {
                prevBtn.classList.remove('is-disabled');
            }

            if (track.scrollLeft >= maxScrollLeft - 5) {
                nextBtn.classList.add('is-disabled');
            } else {
                nextBtn.classList.remove('is-disabled');
            }
        };

        prevBtn.addEventListener('click', function() {
            track.scrollBy({ left: -240, behavior: 'smooth' });
        });

        nextBtn.addEventListener('click', function() {
            track.scrollBy({ left: 240, behavior: 'smooth' });
        });

        track.addEventListener('scroll', updateNavButtons);
        window.addEventListener('resize', updateNavButtons);
        updateNavButtons();
    }
});

function openDaycareModal(index) {
    if (!daycareGaleriData || !daycareGaleriData[index]) return;
    currentDaycareModalIndex = index;
    renderDaycareModal(index);

    const modal = document.getElementById('daycareModal');
    modal.classList.add('show');
    modal.setAttribute('aria-hidden', 'false');
    document.body.style.overflow = 'hidden';
}

function renderDaycareModal(index) {
    const data = daycareGaleriData[index];
    const total = daycareGaleriData.length;

    const img = document.getElementById('daycareModalMainImg');
    img.style.opacity = '0.5';
    img.src = data.url;
    img.onload = () => { img.style.opacity = '1'; };
    img.alt = data.judul;

    document.getElementById('daycareModalTitle').textContent = data.judul;
    document.getElementById('daycareModalDesc').textContent = data.deskripsi;
    document.getElementById('daycareModalTagBadge').textContent = data.tag;
    document.getElementById('daycareModalCounterBadge').textContent = `Foto ${index + 1} dari ${total}`;

    const thumbs = document.querySelectorAll('#daycareModalThumbRow .galeri-modal-thumb-btn');
    thumbs.forEach((t, i) => {
        if (i === index) {
            t.classList.add('active');
            t.scrollIntoView({ behavior: 'smooth', inline: 'center', block: 'nearest' });
        } else {
            t.classList.remove('active');
        }
    });
}

function navigateDaycareModal(direction) {
    const total = daycareGaleriData.length;
    let nextIndex = currentDaycareModalIndex + direction;
    if (nextIndex < 0) nextIndex = total - 1;
    if (nextIndex >= total) nextIndex = 0;
    currentDaycareModalIndex = nextIndex;
    renderDaycareModal(currentDaycareModalIndex);
}

function closeDaycareModal() {
    const modal = document.getElementById('daycareModal');
    if (!modal) return;
    modal.classList.remove('show');
    modal.setAttribute('aria-hidden', 'true');
    document.body.style.overflow = '';
}

function handleDaycareModalBackdrop(e) {
    if (e.target.id === 'daycareModal') {
        closeDaycareModal();
    }
}

document.addEventListener('keydown', function(e) {
    const modal = document.getElementById('daycareModal');
    if (!modal || !modal.classList.contains('show')) return;

    if (e.key === 'Escape') {
        closeDaycareModal();
    } else if (e.key === 'ArrowLeft') {
        navigateDaycareModal(-1);
    } else if (e.key === 'ArrowRight') {
        navigateDaycareModal(1);
    }
});
</script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<?= $this->endSection() ?>