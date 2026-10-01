<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<!-- GOOGLE FONTS FOR MODERN PARENTELA AESTHETIC -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Caveat:wght@700&family=Outfit:wght@400;500;600;700;800&family=Playfair+Display:ital,wght@0,600;0,800;1,600&display=swap" rel="stylesheet">

<?php 
    $fotoUtamaPanti = !empty($panti['foto_utama']) ? $panti['foto_utama'] : '';
    if (!empty($fotoUtamaPanti) && strpos($fotoUtamaPanti, 'http') !== 0 && strpos($fotoUtamaPanti, 'data:') !== 0) {
        $fotoUtamaPanti = base_url($fotoUtamaPanti);
    }
    $heroStylePanti = !empty($fotoUtamaPanti) 
        ? "background-image: url('" . esc($fotoUtamaPanti) . "');" 
        : "background: linear-gradient(135deg, #7a2b2b 0%, #a84b4b 50%, #db8a74 100%);";
?>
<!-- 1. TOP HERO BANNER DENGAN EFEK FADE KE LATAR BELAKANG #FAF7F2 -->
<div class="panti-detail-hero" style="<?= $heroStylePanti ?>">
    <!-- Overlay Gelap Atas untuk Keterbacaan Teks -->
    <div class="panti-hero-overlay-top"></div>
    
    <!-- Efek Fade/Gradasi ke Warna Latar Belakang #FAF7F2 di Bagian Bawah -->
    <div class="panti-hero-fade-bottom"></div>

    <div class="container panti-hero-content">
        <!-- Frosted Glass Badge Status -->
        <div class="panti-hero-badge">
            <span>🏡 Panti Asuhan & Lembaga Sosial Terverifikasi</span>
        </div>
        
        <h1 class="panti-hero-title"><?= esc($panti['nama']) ?></h1>
        <p class="panti-hero-location">📍 <?= esc(str_replace('📍 ', '', $panti['lokasi'])) ?></p>
    </div>
</div>

<!-- 2. KONTEN UTAMA DETAIL (LATAR BELAKANG #FAF7F2 SERVIBES THEME) -->
<div class="panti-detail-wrapper">
    <div class="container panti-detail-grid">
        
        <!-- KOLOM KIRI: DESKRIPSI, FASILITAS, & GALERI KEGIATAN -->
        <div class="panti-main-column">
            
            <!-- KARTU 1: TENTANG PANTI ASUHAN INI -->
            <div class="panti-card">
                <div class="panti-chip-tag">
                    <span>Informasi Lembaga</span>
                </div>
                <h2 class="panti-card-heading">Tentang Panti Asuhan Ini</h2>
                <p class="panti-card-desc"><?= esc($panti['deskripsi']) ?></p>
            </div>

            <!-- KARTU 2: PROGRAM & FASILITAS UNGGULAN -->
            <div class="panti-card">
                <div class="panti-chip-tag chip-green">
                    <span>Standar Pelayanan</span>
                </div>
                <h2 class="panti-card-heading">Program & Fasilitas Unggulan</h2>
                
                <div class="panti-fasilitas-grid">
                    <?php foreach ($panti['fasilitas'] as $fasilitas): ?>
                        <div class="panti-item-pill">
                            <div class="panti-item-dot dot-orange"></div>
                            <div class="panti-item-content">
                                <strong><?= esc($fasilitas) ?></strong>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- KARTU 3: GALERI KEGIATAN CAROUSEL INTERAKTIF -->
            <?php
            $galeriList = [];
            $galeriRaw = $panti['galeri'] ?? [];
            if (is_string($galeriRaw)) {
                $decodedG = json_decode($galeriRaw, true);
                $galeriRaw = is_array($decodedG) ? $decodedG : [];
            }
            if (!is_array($galeriRaw)) {
                $galeriRaw = [];
            }

            foreach ($galeriRaw as $idx => $item) {
                $imgUrl = is_array($item) ? ($item['url'] ?? '') : $item;
                if (empty($imgUrl)) continue;

                if (strpos($imgUrl, 'http') !== 0 && strpos($imgUrl, 'data:') !== 0) {
                    $imgUrl = base_url($imgUrl);
                }

                $defaultJudul = [
                    0 => 'Fasilitas & Lingkungan Asrama',
                    1 => 'Program Bimbingan Belajar & Tahfidz',
                    2 => 'Aktivitas Kreativitas & Kemandirian'
                ];
                $defaultDeskripsi = [
                    0 => 'Kondisi asrama, ruang istirahat, dan lingkungan yang nyaman serta higienis untuk keseharian anak-anak asuh di ' . $panti['nama'] . '.',
                    1 => 'Pendampingan belajar rutin, bimbingan akhlak mulia, serta pendampingan akademik anak asuh bersama para pembina.',
                    2 => 'Kegiatan ekstrakurikuler, seni, serta kebersamaan luar ruangan yang melatih keterampilan sosialisasi anak asuh.'
                ];
                $defaultTag = [
                    0 => 'Fasilitas Panti',
                    1 => 'Pendidikan & Karakter',
                    2 => 'Kemandirian & Bakat'
                ];

                $galeriList[] = [
                    'url' => $imgUrl,
                    'judul' => is_array($item) ? ($item['judul'] ?? ($defaultJudul[$idx] ?? ('Dokumentasi Kegiatan #' . ($idx + 1)))) : ($defaultJudul[$idx] ?? ('Dokumentasi Kegiatan #' . ($idx + 1))),
                    'deskripsi' => is_array($item) ? ($item['deskripsi'] ?? ($defaultDeskripsi[$idx] ?? ('Dokumentasi momen kegiatan dan kebersamaan di ' . $panti['nama'] . '.'))) : ($defaultDeskripsi[$idx] ?? ('Dokumentasi momen kegiatan dan kebersamaan di ' . $panti['nama'] . '.')),
                    'tag' => is_array($item) ? ($item['tag'] ?? ($defaultTag[$idx] ?? 'Kegiatan Panti')) : ($defaultTag[$idx] ?? 'Kegiatan Panti')
                ];
            }
            ?>

            <?php if (!empty($galeriList)): ?>
            <div class="panti-card">
                <div class="panti-galeri-header">
                    <div>
                        <div class="panti-chip-tag chip-blue">
                            <span>Dokumentasi & Aktivitas</span>
                        </div>
                        <h2 class="panti-card-heading">Galeri Kegiatan Anak Asuh</h2>
                    </div>
                    <div class="panti-galeri-counter">
                        <strong><?= count($galeriList) ?></strong> Foto • <span>Klik foto untuk detail</span>
                    </div>
                </div>

                <!-- Carousel Track Wrapper -->
                <div class="galeri-carousel-wrapper">
                    <!-- Tombol Panah Kiri -->
                    <button type="button" id="galeriPrevBtn" class="galeri-nav-btn prev" aria-label="Foto Sebelumnya" title="Foto Sebelumnya">
                        <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M15 18l-6-6 6-6"></path></svg>
                    </button>

                    <!-- Track Carousel -->
                    <div id="galeriTrack" class="galeri-track">
                        <?php foreach ($galeriList as $idx => $foto): ?>
                            <div class="galeri-card" 
                                 onclick="openGaleriModal(<?= $idx ?>)"
                                 role="button"
                                 tabindex="0"
                                 onkeydown="if(event.key==='Enter'||event.key===' ')openGaleriModal(<?= $idx ?>)"
                                 aria-label="Lihat detail foto <?= esc($foto['judul']) ?>">
                                <img src="<?= esc($foto['url']) ?>" 
                                     alt="<?= esc($foto['judul']) ?>" 
                                     loading="lazy"
                                     onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1513694203232-719a280e022f?q=80&w=800&auto=format&fit=crop';">
                                
                                <span class="galeri-badge-tag"><?= esc($foto['tag']) ?></span>

                                <div class="galeri-card-overlay">
                                    <div class="galeri-card-info">
                                        <div class="galeri-card-zoom-icon">
                                            <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"></circle><path d="M21 21l-4.35-4.35"></path><path d="M11 8v6M8 11h6"></path></svg>
                                        </div>
                                        <div class="galeri-card-title"><?= esc($foto['judul']) ?></div>
                                        <div class="galeri-card-hint">Klik untuk detail ↗</div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <!-- Tombol Panah Kanan -->
                    <button type="button" id="galeriNextBtn" class="galeri-nav-btn next" aria-label="Foto Selanjutnya" title="Foto Selanjutnya">
                        <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M9 18l6-6-6-6"></path></svg>
                    </button>
                </div>
            </div>
            <?php endif; ?>

        </div>

        <!-- KOLOM KANAN: INFORMASI LAYANAN & PETA LOKASI -->
        <div class="panti-sidebar-column">
            <div class="panti-card panti-sidebar-card">
                <h3 class="sidebar-heading">Informasi Layanan</h3>
                
                <!-- Jam Kunjungan -->
                <div class="sidebar-info-row">
                    <div class="info-icon-box icon-orange">
                        <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"></circle><path d="M12 6v6l4 2"></path></svg>
                    </div>
                    <div class="info-text-box">
                        <span class="info-label">Jam Kunjungan</span>
                        <strong class="info-val"><?= esc($panti['jam_buka']) ?></strong>
                    </div>
                </div>

                <!-- Kelompok Asuh -->
                <div class="sidebar-info-row">
                    <div class="info-icon-box icon-green">
                        <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 00-3-3.87"></path><path d="M16 3.13a4 4 0 010 7.75"></path></svg>
                    </div>
                    <div class="info-text-box">
                        <span class="info-label">Kelompok Asuh</span>
                        <strong class="info-val"><?= esc($panti['usia']) ?></strong>
                    </div>
                </div>

                <!-- Status / Donasi -->
                <div class="sidebar-info-row">
                    <div class="info-icon-box icon-blue">
                        <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z"></path></svg>
                    </div>
                    <div class="info-text-box">
                        <span class="info-label">Status / Donasi</span>
                        <strong class="info-val text-primary"><?= esc($panti['harga']) ?></strong>
                    </div>
                </div>

                <div class="sidebar-divider"></div>

                <!-- Titik Lokasi Google Maps -->
                <div class="sidebar-maps-block">
                    <span class="info-label">Titik Lokasi</span>
                    <div class="maps-iframe-wrap">
                        <iframe src="<?= $panti['gmaps'] ?>" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                    </div>
                </div>

                <!-- Tombol Buka Maps -->
                <a href="https://www.google.com/maps/search/<?= urlencode($panti['nama'] . ' Surabaya') ?>" target="_blank" rel="noopener noreferrer" class="panti-action-btn btn-orange">
                    Buka di Google Maps ↗
                </a>

                <!-- Tombol Instagram (Hanya jika ada IG) -->
                <?php if(!empty($panti['ig'])): 
                    $isFullUrl = str_starts_with($panti['ig'], 'http');
                    $igUrl = $isFullUrl ? $panti['ig'] : 'https://www.instagram.com/' . ltrim($panti['ig'], '@/');
                    $igLabel = !empty($panti['ig_label']) ? $panti['ig_label'] : ($isFullUrl ? 'Instagram ' . esc($panti['nama']) : 'Instagram @' . esc(ltrim($panti['ig'], '@/')));
                ?>
                <a href="<?= esc($igUrl) ?>" target="_blank" rel="noopener noreferrer" class="panti-action-btn btn-ig" style="margin-top: 12px;">
                    <?= esc($igLabel) ?> ↗
                </a>
                <?php endif; ?>

            </div>
        </div>

    </div>
</div>

<!-- MODAL DETAIL FOTO INTERAKTIF -->
<div id="galeriModal" class="galeri-modal-backdrop" onclick="handleModalBackdropClick(event)" role="dialog" aria-modal="true" aria-hidden="true">
    <div class="galeri-modal-box">
        <!-- Header Bar Modal -->
        <div class="galeri-modal-top">
            <div class="galeri-modal-badges">
                <span id="modalTagBadge" class="galeri-modal-tag-badge">Kegiatan</span>
                <span id="modalCounterBadge" class="galeri-modal-counter-badge">Foto 1 dari <?= count($galeriList) ?></span>
            </div>
            <button type="button" class="galeri-modal-close-btn" onclick="closeGaleriModal()" aria-label="Tutup detail foto" title="Tutup (Esc)">
                <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24"><path d="M18 6L6 18M6 6l12 12"></path></svg>
            </button>
        </div>

        <!-- Foto Utama & Tombol Navigasi Modal -->
        <div class="galeri-modal-image-area">
            <img id="modalMainImg" src="" alt="Detail Foto Kegiatan" onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1513694203232-719a280e022f?q=80&w=800&auto=format&fit=crop';">
            
            <button type="button" class="galeri-modal-arrow-btn prev" onclick="navigateModal(-1)" aria-label="Foto Sebelumnya" title="Foto Sebelumnya (Panah Kiri)">
                <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M15 18l-6-6 6-6"></path></svg>
            </button>
            <button type="button" class="galeri-modal-arrow-btn next" onclick="navigateModal(1)" aria-label="Foto Selanjutnya" title="Foto Selanjutnya (Panah Kanan)">
                <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M9 18l6-6-6-6"></path></svg>
            </button>
        </div>

        <!-- Informasi Detail Kegiatan -->
        <div class="galeri-modal-info-area">
            <div class="galeri-modal-location-pill">
                <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7z"></path><circle cx="12" cy="9" r="2.5"></circle></svg>
                <span><?= esc($panti['nama']) ?></span>
            </div>
            <h3 id="modalTitle" class="galeri-modal-heading">Judul Foto</h3>
            <p id="modalDesc" class="galeri-modal-text">Deskripsi lengkap seputar foto kegiatan dan aktivitas anak-anak asuh.</p>

            <!-- Thumbnail Strip di Dalam Modal -->
            <div class="galeri-modal-thumbs-container">
                <div class="galeri-modal-thumbs-label">Daftar Foto Galeri:</div>
                <div class="galeri-modal-thumbs-row" id="modalThumbRow">
                    <?php foreach ($galeriList as $tIdx => $tFoto): ?>
                        <button type="button" 
                                class="galeri-modal-thumb-btn <?= $tIdx === 0 ? 'active' : '' ?>" 
                                onclick="openGaleriModal(<?= $tIdx ?>)"
                                data-thumb-idx="<?= $tIdx ?>"
                                aria-label="Pilih foto <?= $tIdx + 1 ?>">
                            <img src="<?= esc($tFoto['url']) ?>" alt="Thumb <?= $tIdx + 1 ?>" onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1513694203232-719a280e022f?q=80&w=800&auto=format&fit=crop';">
                        </button>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- STYLESHEET HARMONIS THEME (#FAF7F2 & SERVIBES) -->
<style>
    /* 1. HERO BANNER WITH SMOOTH FADE TO #FAF7F2 */
    .panti-detail-hero {
        position: relative;
        height: 480px;
        background-position: center;
        background-size: cover;
        background-repeat: no-repeat;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        margin-bottom: 0;
        font-family: 'Outfit', sans-serif;
    }

    .panti-hero-overlay-top {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.42);
        z-index: 1;
    }

    .panti-hero-fade-bottom {
        position: absolute;
        bottom: -2px;
        left: 0;
        width: 100%;
        height: 240px;
        background: linear-gradient(to bottom, rgba(250, 247, 242, 0) 0%, rgba(250, 247, 242, 0.75) 65%, rgba(250, 247, 242, 1) 100%);
        z-index: 2;
    }

    .panti-hero-content {
        position: relative;
        z-index: 3;
        text-align: center;
        color: #FFFFFF;
        margin-top: -30px;
        max-width: 900px;
    }

    .panti-hero-badge {
        display: inline-flex;
        align-items: center;
        background: rgba(221, 107, 32, 0.92);
        backdrop-filter: blur(8px);
        -webkit-backdrop-filter: blur(8px);
        color: #FFFFFF;
        padding: 8px 20px;
        border-radius: 30px;
        font-size: 13px;
        font-weight: 700;
        margin-bottom: 16px;
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.18);
        letter-spacing: 0.5px;
    }

    .panti-hero-title {
        font-family: 'Playfair Display', serif;
        font-size: 46px;
        font-weight: 800;
        margin-top: 0;
        margin-bottom: 12px;
        text-shadow: 0 4px 12px rgba(0, 0, 0, 0.5);
        color: #FFFFFF;
        line-height: 1.25;
    }

    .panti-hero-location {
        font-size: 16px;
        opacity: 0.95;
        margin: 0;
        text-shadow: 0 2px 6px rgba(0, 0, 0, 0.5);
        font-weight: 500;
    }

    /* 2. WRAPPER & GRID SYSTEM */
    .panti-detail-wrapper {
        background-color: #FAF7F2;
        font-family: 'Outfit', sans-serif;
        color: #2D3748;
        padding-bottom: 80px;
        position: relative;
        z-index: 3;
    }

    .panti-detail-grid {
        display: grid;
        grid-template-columns: minmax(0, 2fr) minmax(320px, 1fr);
        gap: 35px;
        align-items: start;
        max-width: 1240px;
        margin: 0 auto;
    }

    /* 3. CARDS STYLING */
    .panti-card {
        background: #FFFFFF;
        border: 2px solid #F3E9E2;
        border-radius: 24px;
        padding: 32px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.03);
        margin-bottom: 30px;
    }

    .panti-chip-tag {
        display: inline-flex;
        align-items: center;
        background: #FFF5EE;
        border: 1px solid #FCD34D;
        color: #C05621;
        padding: 5px 14px;
        border-radius: 50px;
        font-size: 12px;
        font-weight: 700;
        margin-bottom: 14px;
    }

    .chip-green {
        background: #F0FFF4;
        border-color: #9AE6B4;
        color: #22543D;
    }

    .chip-blue {
        background: #EBF8FF;
        border-color: #90CDF4;
        color: #2B6CB0;
    }

    .panti-card-heading {
        font-family: 'Playfair Display', serif;
        font-size: 26px;
        font-weight: 800;
        color: #1A202C;
        margin-top: 0;
        margin-bottom: 16px;
    }

    .panti-card-desc {
        font-size: 15px;
        color: #4A5568;
        line-height: 1.75;
        margin: 0;
    }

    /* FASILITAS GRID */
    .panti-fasilitas-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
        gap: 14px;
    }

    .panti-item-pill {
        display: flex;
        align-items: center;
        gap: 12px;
        background: #F7FAFC;
        padding: 12px 16px;
        border-radius: 14px;
        border: 1px solid #EDF2F7;
        font-size: 14px;
        color: #2D3748;
    }

    .panti-item-dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        flex-shrink: 0;
    }
    .dot-orange { background: #DD6B20; }

    /* GALERI CAROUSEL */
    .panti-galeri-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
        margin-bottom: 20px;
        flex-wrap: wrap;
        gap: 12px;
    }

    .panti-galeri-counter {
        font-size: 13px;
        color: #718096;
        background: #F7FAFC;
        padding: 6px 14px;
        border-radius: 12px;
        border: 1px solid #E2E8F0;
    }

    .panti-galeri-counter strong { color: #DD6B20; }

    .galeri-carousel-wrapper {
        position: relative;
        padding: 0 4px;
        width: 100%;
        max-width: 100%;
    }

    .galeri-track {
        display: flex;
        gap: 16px;
        overflow-x: auto;
        scroll-behavior: smooth;
        scroll-snap-type: x mandatory;
        scrollbar-width: none;
        -ms-overflow-style: none;
        padding: 8px 2px;
    }
    .galeri-track::-webkit-scrollbar { display: none; }

    .galeri-nav-btn {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        width: 42px;
        height: 42px;
        border-radius: 50%;
        background: #FFFFFF;
        border: 1.5px solid #CBD5E0;
        color: #DD6B20;
        box-shadow: 0 4px 14px rgba(0, 0, 0, 0.1);
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        z-index: 5;
        transition: all 0.2s ease;
    }
    .galeri-nav-btn.prev { left: -15px; }
    .galeri-nav-btn.next { right: -15px; }
    .galeri-nav-btn:hover {
        background: #DD6B20;
        color: #FFFFFF;
        border-color: #DD6B20;
        transform: translateY(-50%) scale(1.1);
    }

    .galeri-card {
        flex: 0 0 215px;
        width: 215px;
        height: 145px;
        border-radius: 14px;
        overflow: hidden;
        position: relative;
        cursor: pointer;
        scroll-snap-align: start;
        box-shadow: 0 4px 14px rgba(0, 0, 0, 0.06);
        border: 1px solid #EDF2F7;
        background: #EDF2F7;
        transition: transform 0.25s ease, box-shadow 0.25s ease;
    }
    .galeri-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 24px rgba(221, 107, 32, 0.25);
    }
    .galeri-card img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
        transition: transform 0.4s ease;
    }
    .galeri-card:hover img { transform: scale(1.08); }

    .galeri-badge-tag {
        position: absolute;
        top: 8px;
        left: 8px;
        background: rgba(0, 0, 0, 0.65);
        backdrop-filter: blur(4px);
        color: #ffffff;
        font-size: 10.5px;
        font-weight: 600;
        padding: 3px 8px;
        border-radius: 6px;
        z-index: 2;
    }

    .galeri-card-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(to top, rgba(0, 0, 0, 0.85) 0%, rgba(0, 0, 0, 0.3) 60%, transparent 100%);
        display: flex;
        flex-direction: column;
        justify-content: flex-end;
        padding: 10px;
        opacity: 0;
        transition: opacity 0.25s ease;
        z-index: 3;
    }
    .galeri-card:hover .galeri-card-overlay { opacity: 1; }

    .galeri-card-zoom-icon {
        width: 28px;
        height: 28px;
        border-radius: 50%;
        background: #DD6B20;
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 4px;
    }
    .galeri-card-title {
        color: #ffffff;
        font-size: 12px;
        font-weight: 600;
        line-height: 1.3;
    }
    .galeri-card-hint {
        color: #FEEBC8;
        font-size: 10.5px;
        font-weight: 500;
        margin-top: 2px;
    }

    /* 4. SIDEBAR STYLING */
    .panti-sidebar-card {
        position: sticky;
        top: 20px;
    }

    .sidebar-heading {
        font-family: 'Playfair Display', serif;
        font-size: 22px;
        font-weight: 800;
        color: #1A202C;
        margin-top: 0;
        margin-bottom: 22px;
        padding-bottom: 12px;
        border-bottom: 2px solid #F7FAFC;
    }

    .sidebar-info-row {
        display: flex;
        align-items: flex-start;
        gap: 14px;
        margin-bottom: 20px;
    }

    .info-icon-box {
        width: 42px;
        height: 42px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }
    .icon-orange { background: #FFF5EE; color: #DD6B20; }
    .icon-green  { background: #F0FFF4; color: #2F855A; }
    .icon-blue   { background: #EBF8FF; color: #2B6CB0; }

    .info-text-box {
        display: flex;
        flex-direction: column;
    }

    .info-label {
        font-size: 12px;
        color: #718096;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 2px;
    }

    .info-val {
        font-size: 14px;
        color: #2D3748;
        font-weight: 600;
        line-height: 1.4;
    }
    .text-primary { color: #BC4F4F; }

    .sidebar-divider {
        height: 1px;
        background: #EDF2F7;
        margin: 20px 0;
    }

    .sidebar-maps-block {
        margin-bottom: 18px;
    }

    .maps-iframe-wrap {
        height: 160px;
        border-radius: 16px;
        overflow: hidden;
        border: 1px solid #E2E8F0;
        margin-top: 8px;
    }

    .panti-action-btn {
        display: block;
        width: 100%;
        text-align: center;
        padding: 13px 20px;
        border-radius: 14px;
        font-weight: 700;
        font-size: 14px;
        text-decoration: none;
        transition: all 0.3s ease;
        box-sizing: border-box;
    }

    .btn-orange {
        background: linear-gradient(135deg, #DD6B20 0%, #C05621 100%);
        color: white;
        box-shadow: 0 6px 18px rgba(221, 107, 32, 0.3);
    }
    .btn-orange:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 22px rgba(221, 107, 32, 0.4);
    }

    .btn-ig {
        background: linear-gradient(45deg, #f09433 0%, #e6683c 25%, #dc2743 50%, #cc2366 75%, #bc1888 100%);
        color: white;
        box-shadow: 0 6px 18px rgba(220, 39, 67, 0.25);
    }
    .btn-ig:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 22px rgba(220, 39, 67, 0.35);
    }

    /* MODAL STYLING */
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
        border-bottom: 1px solid #F7FAFC;
    }
    .galeri-modal-tag-badge {
        background: #FFF5EE;
        color: #DD6B20;
        font-size: 12px;
        font-weight: 700;
        padding: 4px 12px;
        border-radius: 20px;
        border: 1px solid #FEEBC8;
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
        background: #DD6B20;
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
        border-color: #DD6B20;
        opacity: 1;
        transform: scale(1.05);
    }

    /* RESPONSIVE DESIGN */
    @media (max-width: 992px) {
        .panti-detail-grid {
            grid-template-columns: 1fr !important;
            gap: 30px !important;
        }
        .panti-hero-title { font-size: 34px; }
    }
</style>

<!-- SCRIPT CAROUSEL & MODAL -->
<script>
const galeriData = <?= json_encode($galeriList) ?>;
let currentModalIndex = 0;

document.addEventListener('DOMContentLoaded', function() {
    const track = document.getElementById('galeriTrack');
    const prevBtn = document.getElementById('galeriPrevBtn');
    const nextBtn = document.getElementById('galeriNextBtn');

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

function openGaleriModal(index) {
    if (!galeriData || !galeriData[index]) return;
    currentModalIndex = index;
    renderModalContent(index);

    const modal = document.getElementById('galeriModal');
    modal.classList.add('show');
    modal.setAttribute('aria-hidden', 'false');
    document.body.style.overflow = 'hidden';
}

function renderModalContent(index) {
    const data = galeriData[index];
    const total = galeriData.length;

    const img = document.getElementById('modalMainImg');
    img.style.opacity = '0.5';
    img.src = data.url;
    img.onload = () => { img.style.opacity = '1'; };
    img.alt = data.judul;

    document.getElementById('modalTitle').textContent = data.judul;
    document.getElementById('modalDesc').textContent = data.deskripsi;
    document.getElementById('modalTagBadge').textContent = data.tag;
    document.getElementById('modalCounterBadge').textContent = `Foto ${index + 1} dari ${total}`;

    const thumbs = document.querySelectorAll('.galeri-modal-thumb-btn');
    thumbs.forEach((t, i) => {
        if (i === index) {
            t.classList.add('active');
            t.scrollIntoView({ behavior: 'smooth', inline: 'center', block: 'nearest' });
        } else {
            t.classList.remove('active');
        }
    });
}

function navigateModal(direction) {
    const total = galeriData.length;
    let nextIndex = currentModalIndex + direction;
    if (nextIndex < 0) nextIndex = total - 1;
    if (nextIndex >= total) nextIndex = 0;
    currentModalIndex = nextIndex;
    renderModalContent(currentModalIndex);
}

function closeGaleriModal() {
    const modal = document.getElementById('galeriModal');
    if (!modal) return;
    modal.classList.remove('show');
    modal.setAttribute('aria-hidden', 'true');
    document.body.style.overflow = '';
}

function handleModalBackdropClick(e) {
    if (e.target.id === 'galeriModal') {
        closeGaleriModal();
    }
}

document.addEventListener('keydown', function(e) {
    const modal = document.getElementById('galeriModal');
    if (!modal || !modal.classList.contains('show')) return;

    if (e.key === 'Escape') {
        closeGaleriModal();
    } else if (e.key === 'ArrowLeft') {
        navigateModal(-1);
    } else if (e.key === 'ArrowRight') {
        navigateModal(1);
    }
});
</script>

<?= $this->endSection() ?>