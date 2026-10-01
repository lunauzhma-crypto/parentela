<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<!-- Tempat Asuh Hero Section (Sesuai Desain Foto Terlampir) -->
<section class="asuh-hero-section">
    <div class="asuh-hero-container">
        <!-- Kolom Kiri: Teks Informasi & Statistik -->
        <div class="asuh-hero-left">
            <!-- Badge Direktori & Garis Hias Dotted -->
            <div class="asuh-badge-row">
                <div class="asuh-pill-badge">
                    <span class="asuh-badge-emoji">🏠</span>
                    <span class="asuh-badge-text">Direktori Ramah Anak & Tumbuh Kembang</span>
                </div>
                <!-- Garis lengkung dekoratif bertitik -->
                <svg class="asuh-dotted-curve" width="120" height="24" viewBox="0 0 120 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M4 18 C 35 4, 85 4, 116 18" stroke="#E27D48" stroke-width="2.5" stroke-dasharray="3 6" stroke-linecap="round" fill="none"/>
                    <circle cx="4" cy="18" r="3" fill="#E27D48"/>
                    <circle cx="116" cy="18" r="3" fill="#E27D48"/>
                </svg>
            </div>

            <!-- Judul Utama -->
            <h1 class="asuh-main-title">
                Tempat Asuh & <br>
                <span class="asuh-title-highlight">Fasilitas Anak</span>
            </h1>

            <!-- Deskripsi Singkat -->
            <p class="asuh-main-desc">
                Rujukan resmi terverifikasi untuk panti asuhan, daycare harian, ruang laktasi publik, arena bermain sensori, serta taman bacaan masyarakat di Kota Surabaya.
            </p>

            <!-- Stat Cards Bar -->
            <div class="asuh-stats-card">
                <div class="asuh-stat-item">
                    <div class="asuh-stat-number">10+</div>
                    <div class="asuh-stat-label">Panti Asuhan</div>
                </div>
                <div class="asuh-stat-divider"></div>
                <div class="asuh-stat-item">
                    <div class="asuh-stat-number">5+</div>
                    <div class="asuh-stat-label">Daycare</div>
                </div>
                <div class="asuh-stat-divider"></div>
                <div class="asuh-stat-item">
                    <div class="asuh-stat-number">5+</div>
                    <div class="asuh-stat-label">Nursery & Play</div>
                </div>
                <div class="asuh-stat-divider"></div>
                <div class="asuh-stat-item">
                    <div class="asuh-stat-number">4+</div>
                    <div class="asuh-stat-label">Taman Bacaan</div>
                </div>
            </div>
        </div>

        <!-- Kolom Kanan: Foto Keluarga Bahagia & 3 Badge Overlay Bawah -->
        <div class="asuh-hero-right">
            <div class="asuh-photo-wrapper">
                <img src="<?= base_url('images/tempat-asuh-hero.jpg') ?>" alt="Keluarga Bahagia Parentela" class="asuh-hero-img">
                
                <!-- 3 Chip Kategori Floating di Bagian Bawah Foto -->
                <div class="asuh-photo-chips">
                    <a href="<?= base_url('tempat-asuh/panti-asuhan') ?>" class="asuh-chip asuh-chip-orange">
                        <strong class="asuh-chip-title">Panti Asuhan</strong>
                        <span class="asuh-chip-sub">Akreditasi Kemensos</span>
                    </a>
                    <a href="<?= base_url('tempat-asuh/daycare') ?>" class="asuh-chip asuh-chip-green">
                        <strong class="asuh-chip-title">Daycare & Nursery</strong>
                        <span class="asuh-chip-sub">Laktasi & Stimulasi</span>
                    </a>
                    <a href="<?= base_url('tempat-asuh/taman-bacaan') ?>" class="asuh-chip asuh-chip-blue">
                        <strong class="asuh-chip-title">Taman Bacaan</strong>
                        <span class="asuh-chip-sub">Literasi Bergambar</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Filter Kategori Tab -->
<section class="asuh-filter-section">
    <div class="container">
        <div class="asuh-tabs-wrap">
            <a href="<?= base_url('tempat-asuh') ?>" class="asuh-tab-btn <?= ($activeType === 'semua' || empty($activeType)) ? 'active' : '' ?>">
                <span class="tab-icon">🌟</span>
                <span>Semua Fasilitas</span>
            </a>
            <a href="<?= base_url('tempat-asuh/panti-asuhan') ?>" class="asuh-tab-btn <?= ($activeType === 'panti-asuhan') ? 'active' : '' ?>">
                <span class="tab-icon">🏡</span>
                <span>Panti Asuhan</span>
                <span class="tab-badge-count"><?= !empty($pantiList) ? count($pantiList) : 10 ?></span>
            </a>
            <a href="<?= base_url('tempat-asuh/daycare') ?>" class="asuh-tab-btn <?= ($activeType === 'daycare') ? 'active' : '' ?>">
                <span class="tab-icon">🧸</span>
                <span>Daycare</span>
                <span class="tab-badge-count"><?= !empty($daycareList) ? count($daycareList) : 5 ?></span>
            </a>
            <a href="<?= base_url('tempat-asuh/nursery-playground') ?>" class="asuh-tab-btn <?= ($activeType === 'nursery-playground') ? 'active' : '' ?>">
                <span class="tab-icon">🎠</span>
                <span>Nursery & Playground</span>
                <span class="tab-badge-count"><?= !empty($nurseryPlayList) ? count($nurseryPlayList) : 5 ?></span>
            </a>
            <a href="<?= base_url('tempat-asuh/taman-bacaan') ?>" class="asuh-tab-btn <?= ($activeType === 'taman-bacaan') ? 'active' : '' ?>">
                <span class="tab-icon">📚</span>
                <span>Taman Bacaan</span>
                <span class="tab-badge-count"><?= !empty($tamanBacaanList) ? count($tamanBacaanList) : 4 ?></span>
            </a>
        </div>
    </div>
</section>

<!-- Daftar Konten Dinamis -->
<section class="asuh-list-section">
    <div class="container">
        <div class="asuh-cards-grid">
            <?php if (!empty($places)): ?>
                <?php foreach ($places as $place): ?>
                    <article class="asuh-place-card">
                        <!-- Thumbnail Foto -->
                        <div class="asuh-place-thumb">
                            <?php if (!empty($place['foto_utama'])): ?>
                                <img src="<?= (strpos($place['foto_utama'], 'http') === 0 || strpos($place['foto_utama'], 'data:') === 0) ? esc($place['foto_utama']) : base_url($place['foto_utama']) ?>" alt="<?= esc($place['nama']) ?>" class="asuh-thumb-img" loading="lazy">
                            <?php else: ?>
                                <div class="asuh-thumb-fallback">
                                    <span class="fallback-icon">📷</span>
                                    <span class="fallback-text">Foto Fasilitas</span>
                                </div>
                            <?php endif; ?>
                            
                            <!-- Badges di atas thumbnail -->
                            <div class="asuh-thumb-badges">
                                <?php if (!empty($place['is_verified']) && $place['is_verified'] == 1): ?>
                                    <span class="badge-verified">
                                        <svg width="12" height="12" viewBox="0 0 24 24" fill="currentColor"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg>
                                        Terverifikasi
                                    </span>
                                <?php endif; ?>
                                <?php if (!empty($place['category_label'])): ?>
                                    <span class="badge-cat-tag"><?= esc($place['category_label']) ?></span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- Informasi Tempat -->
                        <div class="asuh-place-info">
                            <h3 class="asuh-place-name"><?= esc($place['nama']) ?></h3>
                            
                            <p class="asuh-place-loc">
                                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                                <span><?= esc($place['lokasi']) ?></span>
                            </p>
                            
                            <p class="asuh-place-desc">
                                <?= esc($place['deskripsi']) ?>
                            </p>

                            <div class="asuh-place-footer">
                                <?php 
                                    $detailUrl = ($place['category'] === 'panti-asuhan') 
                                        ? base_url('tempat-asuh/detail-panti/' . $place['slug']) 
                                        : base_url('tempat-asuh/detail/' . $place['slug']);
                                ?>
                                <a href="<?= $detailUrl ?>" class="btn-detail-asuh">
                                    <span>Kenali Lebih Lanjut</span>
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                                </a>
                                
                                <?php if (!empty($place['jam_buka'])): ?>
                                    <div class="asuh-place-hours">
                                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                                        <span><?= esc($place['jam_buka']) ?></span>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <!-- Tombol Kontak: WA, Maps, Instagram -->
                            <?php $hasContact = !empty($place['wa']) || !empty($place['gmaps']) || !empty($place['instagram']); ?>
                            <?php if ($hasContact): ?>
                            <div class="asuh-contact-row">
                                <?php if (!empty($place['wa'])): ?>
                                    <?php $waNum = preg_replace('/[^0-9]/', '', $place['wa']); ?>
                                    <a href="https://wa.me/<?= $waNum ?>" target="_blank" rel="noopener" class="asuh-contact-btn btn-wa" title="Chat WhatsApp">
                                        <svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347"/></svg>
                                        WhatsApp
                                    </a>
                                <?php endif; ?>
                                <?php if (!empty($place['gmaps'])): ?>
                                    <a href="<?= esc($place['gmaps']) ?>" target="_blank" rel="noopener" class="asuh-contact-btn btn-maps" title="Buka Google Maps">
                                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                                        Peta
                                    </a>
                                <?php endif; ?>
                                <?php if (!empty($place['instagram'])): ?>
                                    <?php $igUrl = (strpos($place['instagram'], 'http') === 0) ? $place['instagram'] : 'https://instagram.com/' . ltrim($place['instagram'], '@'); ?>
                                    <a href="<?= esc($igUrl) ?>" target="_blank" rel="noopener" class="asuh-contact-btn btn-ig" title="Instagram">
                                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg>
                                        Instagram
                                    </a>
                                <?php endif; ?>
                            </div>
                            <?php endif; ?>
                        </div>
                    </article>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="asuh-empty-state">
                    <span class="empty-icon">📍</span>
                    <h4>Belum ada data tempat asuh untuk kategori ini</h4>
                    <p>Silakan pilih kategori lain atau kembali ke seluruh fasilitas.</p>
                    <a href="<?= base_url('tempat-asuh') ?>" class="btn-reset-cat">Lihat Semua Fasilitas</a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- Scoped Stylesheet untuk Halaman Tempat Asuh -->
<style>
/* =========================================================
   TEMPAT ASUH HERO & DIRECTORY STYLES
   ========================================================= */

.asuh-hero-section {
    background: linear-gradient(180deg, #FFFFFF 0%, #FFF9F6 100%);
    padding: 36px 20px 24px 20px;
    border-bottom: 1px solid #F5EAE5;
}

.asuh-hero-container {
    max-width: 1120px;
    margin: 0 auto;
    display: grid;
    grid-template-columns: 1fr auto;
    gap: 40px;
    align-items: center;
    justify-content: center;
}

/* Kolom Kiri */
.asuh-hero-left {
    display: flex;
    flex-direction: column;
    justify-content: center;
}

.asuh-badge-row {
    display: flex;
    align-items: center;
    gap: 14px;
    margin-bottom: 20px;
}

.asuh-pill-badge {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: #FFF8F4;
    border: 1.5px solid #F3C4AA;
    padding: 7px 18px;
    border-radius: 999px;
    color: #9C3D26;
    font-size: 13.5px;
    font-weight: 600;
    box-shadow: 0 2px 8px rgba(226, 125, 72, 0.08);
}

.asuh-badge-emoji {
    font-size: 14px;
}

.asuh-dotted-curve {
    opacity: 0.85;
}

.asuh-main-title {
    font-family: 'Playfair Display', Georgia, serif;
    font-size: 46px;
    font-weight: 700;
    line-height: 1.18;
    color: #1F2937;
    margin: 0 0 16px 0;
    letter-spacing: -0.5px;
}

.asuh-title-highlight {
    background: #FEE8D6;
    color: #C85A32;
    padding: 2px 16px;
    border-radius: 14px;
    display: inline-block;
    margin-top: 4px;
}

.asuh-main-desc {
    color: #52525B;
    font-size: 15.5px;
    line-height: 1.65;
    margin: 0 0 26px 0;
    max-width: 540px;
}

/* Stat Cards Bar */
.asuh-stats-card {
    background: #FFFFFF;
    border: 1px solid #E8ECEF;
    border-radius: 18px;
    padding: 14px 22px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.04);
    max-width: 530px;
}

.asuh-stat-item {
    text-align: left;
    padding: 2px 6px;
}

.asuh-stat-number {
    font-size: 20px;
    font-weight: 800;
    color: #BC4F4F;
    line-height: 1.1;
    margin-bottom: 3px;
    font-family: 'Playfair Display', Georgia, serif;
}

.asuh-stat-label {
    font-size: 12px;
    color: #64748B;
    font-weight: 500;
    white-space: nowrap;
}

.asuh-stat-divider {
    width: 1px;
    height: 32px;
    background: #E2E8F0;
    flex-shrink: 0;
}

/* Kolom Kanan: Foto Keluarga & Chips */
.asuh-hero-right {
    display: flex;
    justify-content: flex-start;
}

.asuh-photo-wrapper {
    position: relative;
    width: 100%;
    max-width: 520px;
    height: 340px;
    border-radius: 26px;
    overflow: hidden;
    box-shadow: 0 16px 36px rgba(188, 79, 79, 0.14), 0 4px 12px rgba(0, 0, 0, 0.06);
    border: 3px solid #FFFFFF;
}

.asuh-hero-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: center top;
    display: block;
    transition: transform 0.4s ease;
}

.asuh-photo-wrapper:hover .asuh-hero-img {
    transform: scale(1.02);
}

.asuh-photo-chips {
    position: absolute;
    bottom: 14px;
    left: 12px;
    right: 12px;
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 10px;
    z-index: 2;
}

.asuh-chip {
    padding: 10px 10px;
    border-radius: 14px;
    text-decoration: none;
    color: #FFFFFF !important;
    display: flex;
    flex-direction: column;
    justify-content: center;
    box-shadow: 0 4px 14px rgba(0, 0, 0, 0.2);
    backdrop-filter: blur(4px);
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.asuh-chip:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.28);
}

.asuh-chip-orange {
    background: linear-gradient(135deg, #D96538 0%, #C85A32 100%);
}

.asuh-chip-green {
    background: linear-gradient(135deg, #2E7D5B 0%, #256E4E 100%);
}

.asuh-chip-blue {
    background: linear-gradient(135deg, #2A79C9 0%, #1E63A8 100%);
}

.asuh-chip-title {
    font-size: 13px;
    font-weight: 700;
    line-height: 1.2;
    color: #FFFFFF;
    margin-bottom: 2px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.asuh-chip-sub {
    font-size: 10.5px;
    color: rgba(255, 255, 255, 0.9);
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

/* =========================================================
   CATEGORY TABS SECTION
   ========================================================= */
.asuh-filter-section {
    padding: 24px 20px 10px 20px;
}

.asuh-tabs-wrap {
    display: flex;
    gap: 10px;
    justify-content: center;
    flex-wrap: wrap;
    max-width: 1220px;
    margin: 0 auto;
}

.asuh-tab-btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 10px 20px;
    border-radius: 999px;
    text-decoration: none;
    font-weight: 600;
    font-size: 13.5px;
    background: #FFFFFF;
    color: #555555;
    border: 1.5px solid #EAEAEA;
    transition: all 0.25s ease;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.02);
}

.asuh-tab-btn:hover {
    background: #FFF5F2;
    color: #BC4F4F;
    border-color: #F8C3B5;
    transform: translateY(-1px);
}

.asuh-tab-btn.active {
    background: linear-gradient(135deg, #BC4F4F 0%, #D8634B 100%);
    color: #FFFFFF;
    border-color: #BC4F4F;
    box-shadow: 0 4px 14px rgba(188, 79, 79, 0.28);
}

.tab-badge-count {
    background: rgba(0, 0, 0, 0.08);
    font-size: 11px;
    padding: 1px 7px;
    border-radius: 999px;
    font-weight: 700;
}

.asuh-tab-btn.active .tab-badge-count {
    background: rgba(255, 255, 255, 0.25);
    color: #FFFFFF;
}

/* =========================================================
   PLACES LIST & CARDS
   ========================================================= */
.asuh-list-section {
    padding: 24px 20px 60px 20px;
}

.asuh-cards-grid {
    display: flex;
    flex-direction: column;
    gap: 22px;
    max-width: 1020px;
    margin: 0 auto;
}

.asuh-place-card {
    background: #FFFFFF;
    border-radius: 20px;
    padding: 22px;
    border: 1px solid #F6E6DF;
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.04);
    display: flex;
    gap: 24px;
    align-items: center;
    transition: transform 0.2s ease, box-shadow 0.2s ease, border-color 0.2s ease;
}

.asuh-place-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 14px 32px rgba(188, 79, 79, 0.1);
    border-color: #F0BCAD;
}

.asuh-place-thumb {
    width: 270px;
    height: 180px;
    flex-shrink: 0;
    border-radius: 14px;
    overflow: hidden;
    position: relative;
    background: #FDF4F1;
}

.asuh-thumb-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
    transition: transform 0.35s ease;
}

.asuh-place-card:hover .asuh-thumb-img {
    transform: scale(1.04);
}

.asuh-thumb-fallback {
    width: 100%;
    height: 100%;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, #FFF0EC, #FCE4DD);
    color: #BC4F4F;
}

.fallback-icon {
    font-size: 32px;
    margin-bottom: 4px;
}

.fallback-text {
    font-size: 12px;
    font-weight: 600;
}

.asuh-thumb-badges {
    position: absolute;
    top: 10px;
    left: 10px;
    right: 10px;
    display: flex;
    justify-content: space-between;
    gap: 6px;
    pointer-events: none;
}

.badge-verified {
    background: rgba(34, 139, 34, 0.92);
    color: #FFFFFF;
    font-size: 11px;
    font-weight: 700;
    padding: 3px 9px;
    border-radius: 999px;
    backdrop-filter: blur(4px);
    display: inline-flex;
    align-items: center;
    gap: 4px;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.18);
}

.badge-cat-tag {
    background: rgba(255, 255, 255, 0.94);
    color: #9C3D26;
    font-size: 11px;
    font-weight: 700;
    padding: 3px 9px;
    border-radius: 999px;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.12);
}

/* Place Info */
.asuh-place-info {
    flex: 1;
    min-width: 0;
}

.asuh-place-name {
    font-family: 'Playfair Display', Georgia, serif;
    font-size: 21px;
    font-weight: 700;
    color: #1F2937;
    margin: 0 0 6px 0;
    line-height: 1.25;
}

.asuh-place-loc {
    display: flex;
    align-items: center;
    gap: 6px;
    font-size: 13px;
    color: #64748B;
    margin: 0 0 10px 0;
    font-weight: 500;
}

.asuh-place-loc svg {
    color: #BC4F4F;
    flex-shrink: 0;
}

.asuh-place-desc {
    color: #4B5563;
    font-size: 14px;
    line-height: 1.55;
    margin: 0 0 16px 0;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.asuh-place-footer {
    display: flex;
    align-items: center;
    gap: 14px;
    flex-wrap: wrap;
}

.btn-detail-asuh {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    background: linear-gradient(135deg, #BC4F4F 0%, #D8634B 100%);
    color: #FFFFFF !important;
    padding: 8px 18px;
    border-radius: 10px;
    text-decoration: none;
    font-size: 13px;
    font-weight: 600;
    box-shadow: 0 3px 10px rgba(188, 79, 79, 0.25);
    transition: all 0.2s ease;
}

.btn-detail-asuh:hover {
    background: linear-gradient(135deg, #9C3D26 0%, #BC4F4F 100%);
    transform: translateY(-1px);
    box-shadow: 0 5px 14px rgba(188, 79, 79, 0.35);
}

.asuh-place-hours {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    font-size: 12px;
    color: #6B7280;
    background: #F8F9FA;
    padding: 6px 12px;
    border-radius: 8px;
    border: 1px solid #E9ECEF;
}

.asuh-place-hours svg {
    color: #9CA3AF;
}

/* Contact Buttons Row */
.asuh-contact-row {
    display: flex;
    flex-wrap: wrap;
    gap: 7px;
    margin-top: 10px;
    padding-top: 10px;
    border-top: 1px solid #F3F4F6;
}

.asuh-contact-btn {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    padding: 5px 12px;
    border-radius: 999px;
    font-size: 12px;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.2s ease;
    border: 1.5px solid transparent;
}

.btn-wa {
    background: #F0FDF4;
    color: #15803D;
    border-color: #BBF7D0;
}
.btn-wa:hover {
    background: #25D366;
    color: #FFFFFF;
    border-color: #25D366;
}

.btn-maps {
    background: #EFF6FF;
    color: #1D4ED8;
    border-color: #BFDBFE;
}
.btn-maps:hover {
    background: #1D4ED8;
    color: #FFFFFF;
    border-color: #1D4ED8;
}

.btn-ig {
    background: #FDF4FF;
    color: #9333EA;
    border-color: #E9D5FF;
}
.btn-ig:hover {
    background: linear-gradient(135deg, #F43F5E, #9333EA, #F59E0B);
    color: #FFFFFF;
    border-color: transparent;
}

/* Empty State */
.asuh-empty-state {
    text-align: center;
    padding: 60px 20px;
    background: #FFFFFF;
    border-radius: 20px;
    border: 2px dashed #E2E8F0;
}

.empty-icon {
    font-size: 42px;
    display: block;
    margin-bottom: 12px;
}

.asuh-empty-state h4 {
    font-size: 18px;
    color: #333333;
    margin: 0 0 6px 0;
}

.asuh-empty-state p {
    color: #777777;
    font-size: 14px;
    margin: 0 0 18px 0;
}

.btn-reset-cat {
    display: inline-block;
    background: #BC4F4F;
    color: #FFFFFF;
    padding: 10px 22px;
    border-radius: 999px;
    text-decoration: none;
    font-weight: 600;
    font-size: 13.5px;
}

/* =========================================================
   RESPONSIVE DESIGN
   ========================================================= */
@media (max-width: 992px) {
    .asuh-hero-container {
        grid-template-columns: 1fr;
        gap: 28px;
        text-align: left;
    }

    .asuh-hero-left {
        align-items: flex-start;
    }

    .asuh-photo-wrapper {
        max-width: 100%;
        height: 300px;
    }
}

@media (max-width: 768px) {
    .asuh-main-title {
        font-size: 34px;
    }

    .asuh-place-card {
        flex-direction: column;
        align-items: stretch;
        padding: 16px;
    }

    .asuh-place-thumb {
        width: 100%;
        height: 200px;
    }

    .asuh-stats-card {
        flex-wrap: wrap;
        gap: 12px 16px;
        padding: 12px 16px;
    }

    .asuh-stat-divider {
        display: none;
    }

    .asuh-photo-chips {
        grid-template-columns: 1fr;
        gap: 6px;
    }

    .asuh-chip {
        padding: 6px 10px;
    }
}
</style>

<?= $this->endSection() ?>