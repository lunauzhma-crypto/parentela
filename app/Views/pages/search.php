<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<!-- GOOGLE FONTS IMPORT -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Caveat:wght@700&family=Outfit:wght@400;500;600;700;800&family=Playfair+Display:ital,wght@0,600;0,800;1,600&display=swap" rel="stylesheet">

<div class="search-page-wrapper">
    
    <!-- HERO / SEARCH BAR SECTION -->
    <section class="search-hero-container">
        <div class="search-hero-inner">
            <div class="search-chip-tag">
                <span>🔍 Mesin Pencarian Global Parentela</span>
            </div>

            <h1 class="search-hero-title">
                Hasil Pencarian: <span class="search-pill"><?= esc($q ? '"' . $q . '"' : 'Semua Rekomendasi') ?></span>
            </h1>
            
            <p class="search-hero-sub">
                Menampilkan hasil pencarian terintegrasi dari <strong>Artikel & Panduan</strong>, <strong>Direktori Tempat Asuh & Sekolah</strong>, <strong>Nanny Berizin</strong>, <strong>Resep MPASI</strong>, dan <strong>Produk Toko</strong>.
            </p>

            <!-- SEARCH RE-INPUT FORM -->
            <form action="<?= base_url('search') ?>" method="get" class="search-hero-form">
                <div class="search-input-group">
                    <span class="search-input-icon">🔍</span>
                    <input type="text" name="q" value="<?= esc($q) ?>" placeholder="Cari artikel, daycare, nanny, resep MPASI, bantal hamil, stroller..." required>
                    <button type="submit" class="search-submit-btn">Cari Sekarang</button>
                </div>
            </form>
        </div>
    </section>

    <!-- SEARCH RESULTS SECTION -->
    <section class="search-results-section">
        <div class="search-results-container">
            
            <!-- CATEGORY FILTER TABS -->
            <div class="search-tabs-wrapper">
                <button class="search-tab-btn active" onclick="switchSearchTab(this, 'all')">
                    ✨ Semua Hasil <span class="tab-count"><?= $totalCount ?></span>
                </button>
                <button class="search-tab-btn" onclick="switchSearchTab(this, 'articles')">
                    📰 Artikel <span class="tab-count"><?= count($articles) ?></span>
                </button>
                <button class="search-tab-btn" onclick="switchSearchTab(this, 'directories')">
                    🏡 Tempat Asuh & Sekolah <span class="tab-count"><?= count($directories) ?></span>
                </button>
                <button class="search-tab-btn" onclick="switchSearchTab(this, 'nannies')">
                    👩‍🍼 Nanny <span class="tab-count"><?= count($nannies) ?></span>
                </button>
                <button class="search-tab-btn" onclick="switchSearchTab(this, 'menus')">
                    🥣 Resep MPASI <span class="tab-count"><?= count($menus) ?></span>
                </button>
                <button class="search-tab-btn" onclick="switchSearchTab(this, 'shop')">
                    🛍️ Toko & Produk <span class="tab-count"><?= count($shopItems) ?></span>
                </button>
            </div>

            <?php if ($totalCount === 0): ?>
                <!-- EMPTY SEARCH STATE -->
                <div class="search-empty-box">
                    <div class="empty-icon">🔎</div>
                    <h3>Tidak ada hasil yang cocok dengan "<?= esc($q) ?>"</h3>
                    <p>Coba gunakan kata kunci lain seperti <em>Bantal Hamil</em>, <em>MPASI Ayam</em>, <em>Daycare</em>, <em>Speech Delay</em>, atau <em>Nanny Surabaya</em>.</p>
                    <div class="empty-suggestions">
                        <a href="<?= base_url('search?q=Bantal+Hamil') ?>" class="sug-pill">🛏️ Bantal Hamil</a>
                        <a href="<?= base_url('search?q=Bolognese') ?>" class="sug-pill">🥣 Resep MPASI</a>
                        <a href="<?= base_url('search?q=Daycare') ?>" class="sug-pill">🧸 Daycare</a>
                        <a href="<?= base_url('search?q=Pengasuh') ?>" class="sug-pill">👩‍🍼 Nanny</a>
                        <a href="<?= base_url('search?q=Parenting') ?>" class="sug-pill">📰 Artikel Parenting</a>
                    </div>
                </div>
            <?php else: ?>

                <!-- RESULTS GRID -->
                <div class="search-cards-grid">
                    
                    <!-- 1. ARTIKEL RESULTS -->
                    <?php foreach ($articles as $art): ?>
                        <div class="result-card" data-cat="articles">
                            <div class="card-type-badge type-article">📰 Artikel & Panduan</div>
                            
                            <?php 
                                $imgSrc = !empty($art['image']) ? $art['image'] : (!empty($art['thumbnail']) ? $art['thumbnail'] : base_url('images/cand-mother-child.jpg'));
                                if (strpos($imgSrc, 'http') !== 0 && strpos($imgSrc, 'base_url') === false) {
                                    $imgSrc = base_url($imgSrc);
                                }
                            ?>
                            <div class="result-img-box">
                                <img src="<?= esc($imgSrc) ?>" alt="<?= esc($art['title']) ?>">
                            </div>
                            
                            <div class="result-card-content">
                                <div class="result-meta-chip"><?= esc($art['category_name'] ?? 'Parenting') ?></div>
                                <h3 class="result-title"><?= esc($art['title']) ?></h3>
                                <p class="result-excerpt"><?= esc($art['excerpt'] ?? '') ?></p>
                                <a href="<?= base_url('articles/detail/' . ($art['slug'] ?? $art['id'])) ?>" class="result-action-btn btn-article">
                                    Baca Artikel Selengkapnya &rarr;
                                </a>
                            </div>
                        </div>
                    <?php endforeach; ?>

                    <!-- 2. DIREKTORI & PENDIDIKAN RESULTS -->
                    <?php foreach ($directories as $dir): ?>
                        <div class="result-card" data-cat="directories">
                            <div class="card-type-badge type-directory">🏡 <?= esc($dir['type_label'] ?? 'Tempat Asuh') ?></div>
                            
                            <div class="result-img-box">
                                <?php if (!empty($dir['foto_utama'])): ?>
                                    <img src="<?= (strpos($dir['foto_utama'], 'http') === 0) ? esc($dir['foto_utama']) : base_url($dir['foto_utama']) ?>" alt="<?= esc($dir['nama']) ?>">
                                <?php else: ?>
                                    <div class="no-img-placeholder">🏫</div>
                                <?php endif; ?>
                            </div>
                            
                            <div class="result-card-content">
                                <div class="result-meta-chip"><?= esc(strtoupper($dir['category'] ?? 'Fasilitas')) ?></div>
                                <h3 class="result-title"><?= esc($dir['nama']) ?></h3>
                                <p class="result-excerpt">📍 <?= esc($dir['lokasi'] ?? 'Indonesia') ?> &bull; <?= esc($dir['deskripsi'] ?? 'Fasilitas & layanan terpercaya ibu-anak.') ?></p>
                                <a href="<?= esc($dir['url'] ?? base_url('tempat-asuh')) ?>" class="result-action-btn btn-directory">
                                    Lihat Detail Fasilitas &rarr;
                                </a>
                            </div>
                        </div>
                    <?php endforeach; ?>

                    <!-- 3. NANNY & PENGASUH RESULTS -->
                    <?php foreach ($nannies as $nan): ?>
                        <div class="result-card" data-cat="nannies">
                            <div class="card-type-badge type-nanny">👩‍🍼 Nanny & Pengasuh</div>
                            
                            <div class="result-img-box">
                                <?php if (!empty($nan['foto'])): ?>
                                    <img src="<?= (strpos($nan['foto'], 'http') === 0) ? esc($nan['foto']) : base_url($nan['foto']) ?>" alt="<?= esc($nan['nama']) ?>">
                                <?php else: ?>
                                    <div class="no-img-placeholder">👩‍🍼</div>
                                <?php endif; ?>
                            </div>
                            
                            <div class="result-card-content">
                                <div class="result-meta-chip">✔ Terverifikasi & Berizin</div>
                                <h3 class="result-title"><?= esc($nan['nama']) ?></h3>
                                <p class="result-excerpt">💼 Pengalaman: <?= esc($nan['pengalaman'] ?? '-') ?> &bull; 📍 <?= esc($nan['lokasi'] ?? 'Indonesia') ?></p>
                                <div style="font-weight: 700; color: #16a34a; font-size: 0.9rem; margin-bottom: 12px;"><?= esc($nan['tarif'] ?? 'Tarif Negosiasi') ?></div>
                                <a href="<?= base_url('nanny') ?>" class="result-action-btn btn-nanny">
                                    Lihat Profil Pengasuh &rarr;
                                </a>
                            </div>
                        </div>
                    <?php endforeach; ?>

                    <!-- 4. MENU & RESEP MPASI RESULTS -->
                    <?php foreach ($menus as $menu): ?>
                        <div class="result-card" data-cat="menus">
                            <div class="card-type-badge type-menu">🥣 Resep MPASI & Nutrisi</div>
                            
                            <div class="result-img-box">
                                <img src="<?= esc($menu['image']) ?>" alt="<?= esc($menu['title']) ?>">
                            </div>
                            
                            <div class="result-card-content">
                                <div class="result-meta-chip">👶 <?= esc($menu['age']) ?> &bull; <?= esc($menu['tag']) ?></div>
                                <h3 class="result-title"><?= esc($menu['title']) ?></h3>
                                <p class="result-excerpt"><?= esc($menu['desc']) ?></p>
                                <a href="<?= esc($menu['url']) ?>" class="result-action-btn btn-menu">
                                    Lihat Resep & Takaran &rarr;
                                </a>
                            </div>
                        </div>
                    <?php endforeach; ?>

                    <!-- 5. TOKO & PRODUK REKOMENDASI RESULTS -->
                    <?php foreach ($shopItems as $shop): ?>
                        <div class="result-card" data-cat="shop">
                            <div class="card-type-badge type-shop">🛍️ Produk Toko</div>
                            
                            <div class="result-img-box">
                                <?php 
                                    $imgVal = $shop['image'] ?? '';
                                    if (!empty($imgVal) && (strpos($imgVal, '/') !== false || strpos($imgVal, '.') !== false)): 
                                        $src = (strpos($imgVal, 'http') === 0) ? esc($imgVal) : base_url($imgVal);
                                ?>
                                    <img src="<?= $src ?>" alt="<?= esc($shop['name']) ?>" style="object-fit: contain; padding: 10px; background: #fff;">
                                <?php else: ?>
                                    <div class="no-img-placeholder" style="font-size: 3rem; background: #fff; border: 1px solid #fee2e2;"><?= esc($imgVal ?: '🛍️') ?></div>
                                <?php endif; ?>
                            </div>
                            
                            <div class="result-card-content">
                                <div class="result-meta-chip"><?= esc($shop['badge'] ?: strtoupper($shop['category'] ?? 'Produk')) ?></div>
                                <h3 class="result-title"><?= esc($shop['name']) ?></h3>
                                <p class="result-excerpt"><?= esc($shop['subtext'] ?? '') ?></p>
                                <a href="<?= esc($shop['shopee_link'] ?: 'https://shopee.co.id') ?>" target="_blank" rel="noopener" class="result-action-btn btn-shopee">
                                    🛒 Beli Langsung di Shopee &rarr;
                                </a>
                            </div>
                        </div>
                    <?php endforeach; ?>

                </div>
            <?php endif; ?>

        </div>
    </section>
</div>

<!-- PAGE STYLES -->
<style>
.search-page-wrapper {
    font-family: 'Outfit', sans-serif;
    color: #1f2937;
    background-color: #fcfcfc;
    padding-bottom: 80px;
}

/* HERO SECTION */
.search-hero-container {
    background: linear-gradient(135deg, #FFF7ED 0%, #FFEDD5 100%);
    padding: 50px 5% 40px;
    border-bottom: 1px solid #FED7AA;
    text-align: center;
}

.search-hero-inner {
    max-width: 800px;
    margin: 0 auto;
}

.search-chip-tag {
    display: inline-block;
    background: #FFEDD5;
    color: #C2410C;
    border: 1px solid #FDBA74;
    padding: 6px 16px;
    border-radius: 20px;
    font-size: 0.85rem;
    font-weight: 700;
    margin-bottom: 16px;
}

.search-hero-title {
    font-size: 2.2rem;
    font-weight: 800;
    color: #431407;
    margin-bottom: 10px;
}

.search-pill {
    background: #EA580C;
    color: #FFFFFF;
    padding: 2px 14px;
    border-radius: 12px;
}

.search-hero-sub {
    font-size: 0.95rem;
    color: #7C2D12;
    line-height: 1.5;
    margin-bottom: 25px;
}

/* RE-SEARCH FORM */
.search-hero-form {
    max-width: 650px;
    margin: 0 auto;
}

.search-input-group {
    display: flex;
    align-items: center;
    background: #FFFFFF;
    border: 2px solid #FDBA74;
    border-radius: 50px;
    padding: 6px 8px 6px 20px;
    box-shadow: 0 8px 24px rgba(194, 65, 12, 0.12);
}

.search-input-icon {
    font-size: 1.2rem;
    margin-right: 10px;
}

.search-input-group input {
    flex: 1;
    border: none;
    outline: none;
    font-size: 1rem;
    font-family: 'Outfit', sans-serif;
    color: #1f2937;
}

.search-submit-btn {
    background: linear-gradient(135deg, #EA580C 0%, #C2410C 100%);
    color: #FFFFFF;
    border: none;
    padding: 12px 24px;
    border-radius: 40px;
    font-weight: 700;
    font-size: 0.9rem;
    cursor: pointer;
    transition: transform 0.2s, box-shadow 0.2s;
}

.search-submit-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 14px rgba(194, 65, 12, 0.35);
}

/* RESULTS SECTION */
.search-results-section {
    padding: 40px 5%;
}

.search-results-container {
    max-width: 1240px;
    margin: 0 auto;
}

/* TABS */
.search-tabs-wrapper {
    display: flex;
    gap: 10px;
    overflow-x: auto;
    padding-bottom: 15px;
    margin-bottom: 30px;
    border-bottom: 2px solid #F3F4F6;
}

.search-tab-btn {
    background: #FFFFFF;
    border: 1px solid #E5E7EB;
    padding: 10px 18px;
    border-radius: 12px;
    font-size: 0.9rem;
    font-weight: 700;
    color: #4B5563;
    cursor: pointer;
    white-space: nowrap;
    transition: all 0.2s;
    display: flex;
    align-items: center;
    gap: 8px;
}

.search-tab-btn .tab-count {
    background: #F3F4F6;
    color: #374151;
    font-size: 0.75rem;
    padding: 2px 8px;
    border-radius: 10px;
}

.search-tab-btn.active {
    background: #EA580C;
    color: #FFFFFF;
    border-color: #EA580C;
    box-shadow: 0 4px 12px rgba(234, 88, 12, 0.25);
}

.search-tab-btn.active .tab-count {
    background: rgba(255, 255, 255, 0.25);
    color: #FFFFFF;
}

/* EMPTY STATE */
.search-empty-box {
    background: #FFFFFF;
    border: 2px dashed #FED7AA;
    border-radius: 20px;
    padding: 60px 20px;
    text-align: center;
    max-width: 600px;
    margin: 30px auto;
}

.empty-icon {
    font-size: 3.5rem;
    margin-bottom: 16px;
}

.search-empty-box h3 {
    font-size: 1.3rem;
    font-weight: 700;
    color: #431407;
    margin-bottom: 8px;
}

.search-empty-box p {
    font-size: 0.9rem;
    color: #6B7280;
    margin-bottom: 24px;
}

.empty-suggestions {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    justify-content: center;
}

.sug-pill {
    background: #FFF7ED;
    border: 1px solid #FFEDD5;
    color: #C2410C;
    padding: 8px 16px;
    border-radius: 10px;
    font-size: 0.85rem;
    font-weight: 600;
    text-decoration: none;
    transition: background 0.2s;
}

.sug-pill:hover {
    background: #FFEDD5;
}

/* CARDS GRID */
.search-cards-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
    gap: 24px;
}

.result-card {
    background: #FFFFFF;
    border-radius: 18px;
    border: 1px solid #E5E7EB;
    box-shadow: 0 4px 16px rgba(0,0,0,0.04);
    overflow: hidden;
    display: flex;
    flex-direction: column;
    position: relative;
    transition: transform 0.2s, box-shadow 0.2s;
}

.result-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 10px 25px rgba(234, 88, 12, 0.12);
    border-color: #FDBA74;
}

.card-type-badge {
    position: absolute;
    top: 12px;
    left: 12px;
    z-index: 2;
    padding: 4px 10px;
    border-radius: 8px;
    font-size: 0.72rem;
    font-weight: 800;
    text-transform: uppercase;
}

.type-article { background: #E0F2FE; color: #0369A1; }
.type-directory { background: #DCFCE7; color: #15803D; }
.type-nanny { background: #FEF3C7; color: #B45309; }
.type-menu { background: #F3E8FF; color: #6B21A8; }
.type-shop { background: #FFE4E6; color: #BE123C; }

.result-img-box {
    width: 100%;
    height: 180px;
    background: #F9FAFB;
    position: relative;
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
}

.result-img-box img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.no-img-placeholder {
    font-size: 2.5rem;
}

.result-card-content {
    padding: 20px;
    display: flex;
    flex-direction: column;
    flex: 1;
}

.result-meta-chip {
    font-size: 0.75rem;
    font-weight: 700;
    color: #6B7280;
    text-transform: uppercase;
    margin-bottom: 6px;
}

.result-title {
    font-size: 1.08rem;
    font-weight: 700;
    color: #111827;
    margin-bottom: 8px;
    line-height: 1.35;
}

.result-excerpt {
    font-size: 0.85rem;
    color: #4B5563;
    line-height: 1.45;
    margin-bottom: 20px;
    flex: 1;
}

.result-action-btn {
    display: block;
    width: 100%;
    padding: 10px 14px;
    text-align: center;
    border-radius: 10px;
    font-weight: 700;
    font-size: 0.85rem;
    text-decoration: none;
    transition: opacity 0.2s;
}

.btn-article { background: #0284C7; color: #FFF; }
.btn-directory { background: #16A34A; color: #FFF; }
.btn-nanny { background: #D97706; color: #FFF; }
.btn-menu { background: #7C3AED; color: #FFF; }
.btn-shopee { background: linear-gradient(135deg, #EE4D2D 0%, #FF5722 100%); color: #FFF; }

.result-action-btn:hover {
    opacity: 0.9;
}

@media (max-width: 768px) {
    .search-hero-title { font-size: 1.8rem; }
    .search-cards-grid { grid-template-columns: 1fr; }
}
</style>

<!-- TAB SWITCHING SCRIPT -->
<script>
function switchSearchTab(btnElem, categoryKey) {
    document.querySelectorAll('.search-tab-btn').forEach(b => b.classList.remove('active'));
    btnElem.classList.add('active');

    const cards = document.querySelectorAll('.result-card');
    cards.forEach(card => {
        if (categoryKey === 'all' || card.dataset.cat === categoryKey) {
            card.style.display = 'flex';
        } else {
            card.style.display = 'none';
        }
    });
}
</script>

<?= $this->endSection() ?>
