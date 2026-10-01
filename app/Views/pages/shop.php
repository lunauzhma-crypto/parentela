<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<!-- GOOGLE FONTS IMPORT (OUTFIT, CAVEAT, PLAYFAIR DISPLAY) -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Caveat:wght@700&family=Outfit:wght@400;500;600;700;800&family=Playfair+Display:ital,wght@0,600;0,800;1,600&display=swap" rel="stylesheet">

<div class="shop-page-wrapper">
<?php
$shopProductsList = $shopProducts ?? [];
$renderCategoryProducts = function($categoryKey) use ($shopProductsList) {
    if (empty($shopProductsList)) return false;
    $items = array_filter($shopProductsList, function($p) use ($categoryKey) {
        return ($p['category'] ?? '') === $categoryKey;
    });
    if (empty($items)) return false;

    foreach ($items as $prod) {
        $imgVal = $prod['image'] ?? '';
        $name = esc($prod['name'] ?? '');
        $subtext = esc($prod['subtext'] ?? '');
        $badge = esc($prod['badge'] ?? '');
        $shopeeLink = esc($prod['shopee_link'] ?? '#');
        $searchData = strtolower($name . ' ' . $subtext);
        ?>
        <div class="product-card" data-cat="<?= esc($categoryKey) ?>" data-name="<?= $searchData ?>">
            <?php if (!empty($badge)): ?>
                <div class="product-badge"><?= $badge ?></div>
            <?php endif; ?>

            <?php if (!empty($imgVal) && (strpos($imgVal, '/') !== false || strpos($imgVal, '.') !== false)): 
                $imgSrc = (strpos($imgVal, 'http') === 0) ? esc($imgVal) : base_url($imgVal);
            ?>
                <div class="product-img-wrap">
                    <img src="<?= $imgSrc ?>" alt="<?= $name ?>">
                </div>
            <?php else: ?>
                <div class="product-icon-wrap"><?= esc($imgVal ?: '🛍️') ?></div>
            <?php endif; ?>

            <h4 class="product-name"><?= $name ?></h4>
            <span class="product-subtext"><?= $subtext ?></span>
            <a href="<?= $shopeeLink ?>" target="_blank" rel="noopener" class="btn-shopee">🛒 Beli di Shopee</a>
        </div>
        <?php
    }
    return true;
};
?>
    
    <!-- 1. TOP HERO SECTION -->
    <section class="shop-hero-container">
        <div class="shop-hero-grid">
            
            <!-- HERO LEFT CARD -->
            <div class="shop-hero-card-left">
                <!-- DASHED SVG ACCENT (WARM ROSE GOLD THEME) -->
                <svg class="shop-svg-curve" viewBox="0 0 300 200" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M10 100 C 90 20, 210 180, 290 100" stroke="#E11D48" stroke-width="2.5" stroke-dasharray="6 6" opacity="0.35"/>
                    <circle cx="290" cy="100" r="4" fill="#E11D48"/>
                    <circle cx="10" cy="100" r="4" fill="#E11D48"/>
                </svg>

                <div class="shop-chip-tag">
                    <span>🛍️ Rekomendasi Resmi Dapur & Perlengkapan Parentela</span>
                </div>

                <h1 class="shop-hero-title">
                    Rekomendasi Toko & <span class="shop-pill shop-pill-rose">Perlengkapan Ibu-Anak</span>
                </h1>

                <p class="shop-hero-subtitle">
                    Koleksi kurasi produk terbaik untuk masa kehamilan, perlengkapan newborn, peralatan MPASI, mainan edukasi Montessori, hingga pengaman rumah terpercaya langsung di Shopee.
                </p>

                <!-- QUICK STATS BADGES -->
                <div class="shop-hero-stats">
                    <div class="stat-pill-item">
                        <span class="stat-num">50+</span>
                        <span class="stat-lbl">Produk Pilihan</span>
                    </div>
                    <div class="stat-pill-divider"></div>
                    <div class="stat-pill-item">
                        <span class="stat-num">5</span>
                        <span class="stat-lbl">Kategori Utama</span>
                    </div>
                    <div class="stat-pill-divider"></div>
                    <div class="stat-pill-item">
                        <span class="stat-num">100%</span>
                        <span class="stat-lbl">Link Shopee Resmi</span>
                    </div>
                </div>
            </div>

            <!-- HERO RIGHT CARD PHOTO -->
            <div class="shop-hero-card-right">
                <div class="shop-img-wrapper">
                    <img src="<?= base_url('images/mother_baby_shopping.jpg') ?>" alt="Rekomendasi Toko & Perlengkapan Ibu Anak Parentela" class="shop-hero-img">
                    
                    <!-- OVERLAY BADGES AT BOTTOM -->
                    <div class="shop-img-overlay-bar">
                        <div class="shop-overlay-badge badge-rose">
                            <span class="badge-title">Link Shopee Resmi</span>
                            <span class="badge-sub">Checkout Aman & Praktis</span>
                        </div>
                        <div class="shop-overlay-badge badge-amber">
                            <span class="badge-title">Teruji Kualitasnya</span>
                            <span class="badge-sub">Rekomendasi Komunitas</span>
                        </div>
                        <div class="shop-overlay-badge badge-pink">
                            <span class="badge-title">Kebutuhan Lengkap</span>
                            <span class="badge-sub">Hamil hingga Balita</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>


    <!-- SEARCH & FILTER TOOLBAR -->
    <section class="shop-section-container">
        <div class="search-filter-toolbar">
            <div class="search-input-box">
                <span class="search-icon">🔍</span>
                <input type="text" id="shopSearchInput" placeholder="Cari perlengkapan hamil, bantal menyusui, stroller, piring MPASI, mainan..." onkeyup="filterProducts()">
            </div>
            
            <div class="category-filter-buttons">
                <button class="cat-filter-btn active" data-cat="all" onclick="selectCategoryFilter(this, 'all')">✨ Semua Produk</button>
                <button class="cat-filter-btn" data-cat="ibu-hamil" onclick="selectCategoryFilter(this, 'ibu-hamil')">🤰 Ibu & Kehamilan</button>
                <button class="cat-filter-btn" data-cat="newborn" onclick="selectCategoryFilter(this, 'newborn')">👶 Newborn (0-6 Bln)</button>
                <button class="cat-filter-btn" data-cat="mpasi" onclick="selectCategoryFilter(this, 'mpasi')">🥣 Fase MPASI</button>
                <button class="cat-filter-btn" data-cat="balita" onclick="selectCategoryFilter(this, 'balita')">🧸 Balita & Montessori</button>
                <button class="cat-filter-btn" data-cat="keamanan" onclick="selectCategoryFilter(this, 'keamanan')">🛡️ Keamanan & Rumah</button>
            </div>
        </div>
    </section>

    <!-- ========================================== -->
    <!-- 1. KATEGORI IBU & KEHAMILAN -->
    <!-- ========================================== -->
    <section class="shop-section-container shop-cat-section" id="kategori-ibu-hamil" data-category="ibu-hamil">
        <div class="shop-chip-tag chip-center">
            <span>Kategori 1</span>
        </div>
        <h2 class="shop-section-title text-center">
            🤰 Ibu & Kehamilan <span class="shop-pill shop-pill-rose">(Mom & Maternity)</span>
        </h2>
        <p class="shop-section-sub text-center">
            Perlengkapan kenyamanan masa hamil, dukungan menyusui, serta pemulihan pasca melahirkan (postpartum).
        </p>

        <!-- SUBKATEGORI: MASA HAMIL & PERLENGKAPAN BUMIL -->
        <div class="subcat-group">
            <div class="products-grid">
                <?php if (!$renderCategoryProducts('ibu-hamil')): ?>
                
                <div class="product-card" data-cat="ibu-hamil" data-name="bantal hamil ergonomic pillow">
                    <div class="product-badge">⭐ Rekomendasi Bumil</div>
                    <div class="product-img-wrap">
                        <img src="<?= base_url('images/bantal_hamil_model1.png') ?>" alt="Bantal Hamil Ergonomis (Model 1) Malaya Official">
                    </div>
                    <h4 class="product-name">Bantal Hamil Ergonomis (Model 1)</h4>
                    <span class="product-subtext">Menopang perut & punggung saat tidur</span>
                    <a href="https://id.shp.ee/yVqRp9is" target="_blank" rel="noopener" class="btn-shopee">🛒 Beli di Shopee</a>
                </div>

                <div class="product-card" data-cat="ibu-hamil" data-name="bantal hamil empuk maternity">
                    <div class="product-badge">⭐ Best Seller</div>
                    <div class="product-img-wrap">
                        <img src="<?= base_url('images/bantal_hamil_model2.png') ?>" alt="Bantal Hamil Maternity (Model 2) Bumbee Collection">
                    </div>
                    <h4 class="product-name">Bantal Hamil Maternity (Model 2)</h4>
                    <span class="product-subtext">Bahan katun lembut & sarung washable</span>
                    <a href="https://id.shp.ee/pYJBN7GE" target="_blank" rel="noopener" class="btn-shopee">🛒 Beli di Shopee</a>
                </div>

                <div class="product-card" data-cat="ibu-hamil" data-name="bantal hamil u shape">
                    <div class="product-img-wrap">
                        <img src="<?= base_url('images/bantal_hamil_model3.png') ?>" alt="Bantal Hamil U-Shape Premium (Model 3) Scientific Zoning Support">
                    </div>
                    <h4 class="product-name">Bantal Hamil U-Shape Premium (Model 3)</h4>
                    <span class="product-subtext">Kenyamanan tidur maksimal trimester 2-3</span>
                    <a href="https://id.shp.ee/VXQ4bomL" target="_blank" rel="noopener" class="btn-shopee">🛒 Beli di Shopee</a>
                </div>

                <div class="product-card" data-cat="ibu-hamil" data-name="bantal hamil j shape">
                    <div class="product-icon-wrap">🛏️</div>
                    <h4 class="product-name">Bantal Hamil Comfort (Model 4)</h4>
                    <span class="product-subtext">Desain praktis fleksibel</span>
                    <a href="https://id.shp.ee/LetkM4P1" target="_blank" rel="noopener" class="btn-shopee">🛒 Beli di Shopee</a>
                </div>

                <div class="product-card" data-cat="ibu-hamil" data-name="bantal hamil empuk">
                    <div class="product-icon-wrap">🛏️</div>
                    <h4 class="product-name">Bantal Hamil Multi-Fungsi (Model 5)</h4>
                    <span class="product-subtext">Bisa dipakai lanjut untuk menyusui</span>
                    <a href="https://id.shp.ee/k6K25svL" target="_blank" rel="noopener" class="btn-shopee">🛒 Beli di Shopee</a>
                </div>

                <div class="product-card" data-cat="ibu-hamil" data-name="suplemen vitamin hamil ibu">
                    <div class="product-badge">💊 Suplemen Hamil</div>
                    <div class="product-icon-wrap">💊</div>
                    <h4 class="product-name">Suplemen & Vitamin Bumil (Opsi 1)</h4>
                    <span class="product-subtext">Kaya Asam Folat & Kalsium harian</span>
                    <a href="https://id.shp.ee/FRm1DWDd" target="_blank" rel="noopener" class="btn-shopee">🛒 Beli di Shopee</a>
                </div>

                <div class="product-card" data-cat="ibu-hamil" data-name="suplemen nutrisi kehamilan">
                    <div class="product-icon-wrap">💊</div>
                    <h4 class="product-name">Suplemen Nutrisi Kehamilan (Opsi 2)</h4>
                    <span class="product-subtext">DHA & Zat Besi untuk janin sehat</span>
                    <a href="https://id.shp.ee/5z7ufnjh" target="_blank" rel="noopener" class="btn-shopee">🛒 Beli di Shopee</a>
                </div>

                <div class="product-card" data-cat="ibu-hamil" data-name="suplemen kalsium bumil">
                    <div class="product-icon-wrap">💊</div>
                    <h4 class="product-name">Vitamin Kalsium & Tulang Bumil (Opsi 3)</h4>
                    <span class="product-subtext">Cegah kram kaki saat hamil</span>
                    <a href="https://id.shp.ee/968qHYfG" target="_blank" rel="noopener" class="btn-shopee">🛒 Beli di Shopee</a>
                </div>

                <div class="product-card" data-cat="ibu-hamil" data-name="korset penyangga perut hamil">
                    <div class="product-badge">🩱 Penyangga Perut</div>
                    <div class="product-icon-wrap">🩱</div>
                    <h4 class="product-name">Korset Penyangga Perut Hamil (Model 1)</h4>
                    <span class="product-subtext">Ringankan beban pinggang & panggul</span>
                    <a href="https://id.shp.ee/LzMec8bh" target="_blank" rel="noopener" class="btn-shopee">🛒 Beli di Shopee</a>
                </div>

                <div class="product-card" data-cat="ibu-hamil" data-name="korset hamil breathable">
                    <div class="product-icon-wrap">🩱</div>
                    <h4 class="product-name">Korset Hamil Breathable (Model 2)</h4>
                    <span class="product-subtext">Bahan adem tidak bikin gerah</span>
                    <a href="https://id.shp.ee/XYxVwmye" target="_blank" rel="noopener" class="btn-shopee">🛒 Beli di Shopee</a>
                </div>

                <div class="product-card" data-cat="ibu-hamil" data-name="korset kehamilan adjustable">
                    <div class="product-icon-wrap">🩱</div>
                    <h4 class="product-name">Korset Hamil Adjustable (Model 3)</h4>
                    <span class="product-subtext">Perekat velcro mudah disesuaikan</span>
                    <a href="https://id.shp.ee/829UXCwq" target="_blank" rel="noopener" class="btn-shopee">🛒 Beli di Shopee</a>
                </div>

            </div>
        </div>

        <!-- SUBKATEGORI: MENYUSUI -->
        <div class="subcat-group" style="margin-top: 40px;">
            <h3 class="subcat-title">🍼 Perlengkapan Menyusui (Pompa ASI, Bantal, Booster)</h3>
            <div class="products-grid">
                
                <div class="product-card" data-cat="ibu-hamil" data-name="pompa asi elektrik portable">
                    <div class="product-badge">⭐ Handsfree Electric</div>
                    <div class="product-icon-wrap">🍼</div>
                    <h4 class="product-name">Pompa ASI Electric Handsfree (Model 1)</h4>
                    <span class="product-subtext">Praktis dipasang di dalam bra tanpa kabel</span>
                    <a href="https://id.shp.ee/NAP1YaVg" target="_blank" rel="noopener" class="btn-shopee">🛒 Beli di Shopee</a>
                </div>

                <div class="product-card" data-cat="ibu-hamil" data-name="pompa asi dual pump">
                    <div class="product-icon-wrap">🍼</div>
                    <h4 class="product-name">Pompa ASI Dual Pump Powerful (Model 2)</h4>
                    <span class="product-subtext">Pumping cepat & pijatan lembut 9 tingkat</span>
                    <a href="https://id.shp.ee/qmuZTJkm" target="_blank" rel="noopener" class="btn-shopee">🛒 Beli di Shopee</a>
                </div>

                <div class="product-card" data-cat="ibu-hamil" data-name="pompa asi rechargeable">
                    <div class="product-icon-wrap">🍼</div>
                    <h4 class="product-name">Pompa ASI Portable Rechargeable (Model 3)</h4>
                    <span class="product-subtext">Baterai tahan lama hemat listrik</span>
                    <a href="https://id.shp.ee/gRi76xax" target="_blank" rel="noopener" class="btn-shopee">🛒 Beli di Shopee</a>
                </div>

                <div class="product-card" data-cat="ibu-hamil" data-name="bantal menyusui nursing pillow">
                    <div class="product-badge">🛋️ Nursing Pillow</div>
                    <div class="product-icon-wrap">🛋️</div>
                    <h4 class="product-name">Bantal Menyusui Ergonomis (Model 1)</h4>
                    <span class="product-subtext">Penopang bayi pas agar ibu tidak pegal</span>
                    <a href="https://id.shp.ee/ntw21E45" target="_blank" rel="noopener" class="btn-shopee">🛒 Beli di Shopee</a>
                </div>

                <div class="product-card" data-cat="ibu-hamil" data-name="bantal menyusui katun lembut">
                    <div class="product-icon-wrap">🛋️</div>
                    <h4 class="product-name">Bantal Menyusui Katun Lembut (Model 2)</h4>
                    <span class="product-subtext">Sarung dapat dilepas & dicuci</span>
                    <a href="https://id.shp.ee/d2Prom6n" target="_blank" rel="noopener" class="btn-shopee">🛒 Beli di Shopee</a>
                </div>

                <div class="product-card" data-cat="ibu-hamil" data-name="bantal menyusui traveling">
                    <div class="product-icon-wrap">🛋️</div>
                    <h4 class="product-name">Bantal Menyusui Premium (Model 3)</h4>
                    <span class="product-subtext">Nyaman dipakai posisi duduk/tiduran</span>
                    <a href="https://id.shp.ee/Pp8R32Gv" target="_blank" rel="noopener" class="btn-shopee">🛒 Beli di Shopee</a>
                </div>

                <div class="product-card" data-cat="ibu-hamil" data-name="booster asi pelancar asi herbal">
                    <div class="product-badge">🌱 Booster ASI</div>
                    <div class="product-icon-wrap">🌿</div>
                    <h4 class="product-name">Booster ASI Herbal Pelancar (Opsi 1)</h4>
                    <span class="product-subtext">Meningkatkan kualitas & kuantitas ASI</span>
                    <a href="https://id.shp.ee/FGkEeFdk" target="_blank" rel="noopener" class="btn-shopee">🛒 Beli di Shopee</a>
                </div>

                <div class="product-card" data-cat="ibu-hamil" data-name="booster asi daun katuk kelor">
                    <div class="product-icon-wrap">🌿</div>
                    <h4 class="product-name">Booster ASI Alami Katuk & Kelor (Opsi 2)</h4>
                    <span class="product-subtext">Kaya asam folat & nutrisi ibu menyusui</span>
                    <a href="https://id.shp.ee/BgV7Msvh" target="_blank" rel="noopener" class="btn-shopee">🛒 Beli di Shopee</a>
                </div>

            </div>
        </div>

        <!-- SUBKATEGORI: PEMULIHAN POSTPARTUM -->
        <div class="subcat-group" style="margin-top: 40px;">
            <h3 class="subcat-title">🩺 Pemulihan Postpartum (Korset Melahirkan, Pembalut Nifas)</h3>
            <div class="products-grid">
                
                <div class="product-card" data-cat="ibu-hamil" data-name="korset melahirkan stagen nifas">
                    <div class="product-badge">🩱 Postpartum</div>
                    <div class="product-icon-wrap">🩱</div>
                    <h4 class="product-name">Korset Melahirkan 3-in-1 (Model 1)</h4>
                    <span class="product-subtext">Membantu mengecilkan perut pasca persalinan</span>
                    <a href="https://id.shp.ee/rNt3YKan" target="_blank" rel="noopener" class="btn-shopee">🛒 Beli di Shopee</a>
                </div>

                <div class="product-card" data-cat="ibu-hamil" data-name="korset nifas caesar">
                    <div class="product-icon-wrap">🩱</div>
                    <h4 class="product-name">Korset Nifas Aman Caesar (Model 2)</h4>
                    <span class="product-subtext">Bahan khusus tanpa menekan bekas jahitan</span>
                    <a href="https://id.shp.ee/X6387jsi" target="_blank" rel="noopener" class="btn-shopee">🛒 Beli di Shopee</a>
                </div>

                <div class="product-card" data-cat="ibu-hamil" data-name="korset pemulihan melahirkan">
                    <div class="product-icon-wrap">🩱</div>
                    <h4 class="product-name">Korset Pemulihan Pasca Melahirkan (Model 3)</h4>
                    <span class="product-subtext">Penopang ekstra lumbar & pinggul</span>
                    <a href="https://id.shp.ee/w5UgkWsK" target="_blank" rel="noopener" class="btn-shopee">🛒 Beli di Shopee</a>
                </div>

                <div class="product-card" data-cat="ibu-hamil" data-name="pembalut nifas maternity pad">
                    <div class="product-badge">🩸 Pembalut Nifas</div>
                    <div class="product-icon-wrap">🩹</div>
                    <h4 class="product-name">Pembalut Nifas Max Absorben (Opsi 1)</h4>
                    <span class="product-subtext">Panjang 35cm+ daya serap maksimal</span>
                    <a href="https://id.shp.ee/VLefE7v6" target="_blank" rel="noopener" class="btn-shopee">🛒 Beli di Shopee</a>
                </div>

                <div class="product-card" data-cat="ibu-hamil" data-name="pembalut nifas bersalin">
                    <div class="product-icon-wrap">🩹</div>
                    <h4 class="product-name">Pembalut Bersalin Extra Soft (Opsi 2)</h4>
                    <span class="product-subtext">Permukaan lembut tidak iritasi</span>
                    <a href="https://id.shp.ee/zj6q698G" target="_blank" rel="noopener" class="btn-shopee">🛒 Beli di Shopee</a>
                </div>

                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- ========================================== -->
    <!-- 2. KATEGORI BAYI BARU LAHIR (NEWBORN) -->
    <!-- ========================================== -->
    <section class="shop-section-container shop-cat-section" id="kategori-newborn" data-category="newborn">
        <div class="shop-chip-tag chip-center">
            <span>Kategori 2</span>
        </div>
        <h2 class="shop-section-title text-center">
            👶 Bayi Baru Lahir <span class="shop-pill shop-pill-rose">(Newborn 0–6 Bulan)</span>
        </h2>
        <p class="shop-section-sub text-center">
            Perlengkapan tidur lelap, travel gear aman (stroller/car seat), dan perawatan mandi sensitif.
        </p>

        <!-- SUBKATEGORI: PERLENGKAPAN TIDUR & GEAR NEWBORN -->
        <div class="subcat-group">
            <div class="products-grid">
                <?php if (!$renderCategoryProducts('newborn')): ?>
                
                <div class="product-card" data-cat="newborn" data-name="bedong bayi instan swaddle zipper">
                    <div class="product-badge">⭐ Swaddle Instant</div>
                    <div class="product-icon-wrap">👶</div>
                    <h4 class="product-name">Bedong Bayi Instan Zipper (Model 1)</h4>
                    <span class="product-subtext">Praktis tanpa lilitan, hangat & aman</span>
                    <a href="https://id.shp.ee/6zN1Fv4j" target="_blank" rel="noopener" class="btn-shopee">🛒 Beli di Shopee</a>
                </div>

                <div class="product-card" data-cat="newborn" data-name="bedong bayi katun fleksibel">
                    <div class="product-icon-wrap">👶</div>
                    <h4 class="product-name">Bedong Swaddle Katun Premium (Model 2)</h4>
                    <span class="product-subtext">Bahan stretchy adem kulit sensitif</span>
                    <a href="https://id.shp.ee/Lejoej5x" target="_blank" rel="noopener" class="btn-shopee">🛒 Beli di Shopee</a>
                </div>

                <div class="product-card" data-cat="newborn" data-name="bedong bayi perekat velcro">
                    <div class="product-icon-wrap">👶</div>
                    <h4 class="product-name">Bedong Velcro Anti-Lepas (Model 3)</h4>
                    <span class="product-subtext">Cegah refleks kaget (startle reflex)</span>
                    <a href="https://id.shp.ee/sjPxCotZ" target="_blank" rel="noopener" class="btn-shopee">🛒 Beli di Shopee</a>
                </div>

                <div class="product-card" data-cat="newborn" data-name="nesting bed kasur bayi pelindung">
                    <div class="product-badge">🛏️ Nesting Bed</div>
                    <div class="product-icon-wrap">🛏️</div>
                    <h4 class="product-name">Nesting Bed / Kasur Bayi Portable (Model 1)</h4>
                    <span class="product-subtext">Desain bumper pelindung cegah bayi tertindih</span>
                    <a href="https://id.shp.ee/cbKEhiWr" target="_blank" rel="noopener" class="btn-shopee">🛒 Beli di Shopee</a>
                </div>

                <div class="product-card" data-cat="newborn" data-name="nesting bed babynest empuk">
                    <div class="product-icon-wrap">🛏️</div>
                    <h4 class="product-name">Baby Nest Ergonomis (Model 2)</h4>
                    <span class="product-subtext">Mudah dibawa bepergian / co-sleeping</span>
                    <a href="https://id.shp.ee/3R9JXP2X" target="_blank" rel="noopener" class="btn-shopee">🛒 Beli di Shopee</a>
                </div>

                <div class="product-card" data-cat="newborn" data-name="white noise machine penenang tidur bayi">
                    <div class="product-badge">🎶 White Noise</div>
                    <div class="product-icon-wrap">🎶</div>
                    <h4 class="product-name">White Noise Machine Baby (Model 1)</h4>
                    <span class="product-subtext">Suara rahim & hujan penenang tidur lelap</span>
                    <a href="https://id.shp.ee/fGGnJR3h" target="_blank" rel="noopener" class="btn-shopee">🛒 Beli di Shopee</a>
                </div>

                <div class="product-card" data-cat="newborn" data-name="white noise night light">
                    <div class="product-icon-wrap">🎶</div>
                    <h4 class="product-name">White Noise + Lampu Tidur (Model 2)</h4>
                    <span class="product-subtext">Lampu tidur warm light tidak silau</span>
                    <a href="https://id.shp.ee/dUgpmprG" target="_blank" rel="noopener" class="btn-shopee">🛒 Beli di Shopee</a>
                </div>

                <div class="product-card" data-cat="newborn" data-name="white noise rechargeable timer">
                    <div class="product-icon-wrap">🎶</div>
                    <h4 class="product-name">White Noise Portable Timer (Model 3)</h4>
                    <span class="product-subtext">Bisa digantung di stroller / boks bayi</span>
                    <a href="https://id.shp.ee/nLo9J3Cm" target="_blank" rel="noopener" class="btn-shopee">🛒 Beli di Shopee</a>
                </div>

            </div>
        </div>

        <!-- SUBKATEGORI: BEPERGIAN & GEAR -->
        <div class="subcat-group" style="margin-top: 40px;">
            <h3 class="subcat-title">🚗 Bepergian & Gear (Gendongan M-Shape, Stroller, Car Seat, Diaper Bag)</h3>
            <div class="products-grid">
                
                <div class="product-card" data-cat="newborn" data-name="gendongan m shape ergonomic carrier">
                    <div class="product-badge">⭐ M-Shape Safe</div>
                    <div class="product-icon-wrap">🎒</div>
                    <h4 class="product-name">Gendongan M-Shape Ergonomis (Model 1)</h4>
                    <span class="product-subtext">Aman untuk pertumbuhan tulang panggul bayi</span>
                    <a href="https://id.shp.ee/LBo5uA" target="_blank" rel="noopener" class="btn-shopee">🛒 Beli di Shopee</a>
                </div>

                <div class="product-card" data-cat="newborn" data-name="gendongan ssc m shape">
                    <div class="product-icon-wrap">🎒</div>
                    <h4 class="product-name">Gendongan Soft Structured Carrier (Model 2)</h4>
                    <span class="product-subtext">Beban terbagi merata di pundak & pinggang</span>
                    <a href="https://id.shp.ee/2Vy1AKC9" target="_blank" rel="noopener" class="btn-shopee">🛒 Beli di Shopee</a>
                </div>

                <div class="product-card" data-cat="newborn" data-name="gendongan geos instan">
                    <div class="product-icon-wrap">🎒</div>
                    <h4 class="product-name">Gendongan Kaos Instan / Geos (Model 3)</h4>
                    <span class="product-subtext">Praktis tanpa ring, langsung pakai</span>
                    <a href="https://id.shp.ee/QF1p5hSi" target="_blank" rel="noopener" class="btn-shopee">🛒 Beli di Shopee</a>
                </div>

                <div class="product-card" data-cat="newborn" data-name="stroller newborn lipat ringan">
                    <div class="product-badge">🛒 Stroller Newborn</div>
                    <div class="product-icon-wrap">🛒</div>
                    <h4 class="product-name">Stroller Newborn Flat Recline (Model 1)</h4>
                    <span class="product-subtext">Bisa tiduran 180° aman bayi baru lahir</span>
                    <a href="https://id.shp.ee/EMCkCLbF" target="_blank" rel="noopener" class="btn-shopee">🛒 Beli di Shopee</a>
                </div>

                <div class="product-card" data-cat="newborn" data-name="stroller cabin size ringan">
                    <div class="product-icon-wrap">🛒</div>
                    <h4 class="product-name">Stroller Cabin Size Lightweight (Model 2)</h4>
                    <span class="product-subtext">Ringan & muat kabin pesawat</span>
                    <a href="https://id.shp.ee/2E5Pmtor" target="_blank" rel="noopener" class="btn-shopee">🛒 Beli di Shopee</a>
                </div>

                <div class="product-card" data-cat="newborn" data-name="stroller lipat otomatis">
                    <div class="product-icon-wrap">🛒</div>
                    <h4 class="product-name">Stroller Compact Autofold (Model 3)</h4>
                    <span class="product-subtext">Lipat otomatis 1 tangan</span>
                    <a href="https://id.shp.ee/iHvqxjAa" target="_blank" rel="noopener" class="btn-shopee">🛒 Beli di Shopee</a>
                </div>

                <div class="product-card" data-cat="newborn" data-name="car seat bayi isofix">
                    <div class="product-badge">🚗 Safety Car Seat</div>
                    <div class="product-icon-wrap">🚗</div>
                    <h4 class="product-name">Car Seat Infant Carrier Isofix (Model 1)</h4>
                    <span class="product-subtext">Proteksi benturan samping standar ECE</span>
                    <a href="https://id.shp.ee/oxhd36Rk" target="_blank" rel="noopener" class="btn-shopee">🛒 Beli di Shopee</a>
                </div>

                <div class="product-card" data-cat="newborn" data-name="car seat 360 rotasi">
                    <div class="product-icon-wrap">🚗</div>
                    <h4 class="product-name">Car Seat 360° Rotation (Model 2)</h4>
                    <span class="product-subtext">Bisa diputar ke pintu memudahkan angkat bayi</span>
                    <a href="https://id.shp.ee/DcTFkb2N" target="_blank" rel="noopener" class="btn-shopee">🛒 Beli di Shopee</a>
                </div>

                <div class="product-card" data-cat="newborn" data-name="car seat convertible newborn">
                    <div class="product-icon-wrap">🚗</div>
                    <h4 class="product-name">Car Seat Convertible Newborn-Toddler (Model 3)</h4>
                    <span class="product-subtext">Dapat dipakai usia 0-4 tahun</span>
                    <a href="https://id.shp.ee/cprzmcS9" target="_blank" rel="noopener" class="btn-shopee">🛒 Beli di Shopee</a>
                </div>

                <div class="product-card" data-cat="newborn" data-name="tas popok diaper bag ransel">
                    <div class="product-badge">🎒 Diaper Bag</div>
                    <div class="product-icon-wrap">👜</div>
                    <h4 class="product-name">Tas Popok Diaper Bag Ransel (Model 1)</h4>
                    <span class="product-subtext">Kompartemen thermal susu & kantong botol</span>
                    <a href="https://id.shp.ee/Z1KmfkBk" target="_blank" rel="noopener" class="btn-shopee">🛒 Beli di Shopee</a>
                </div>

                <div class="product-card" data-cat="newborn" data-name="tas popok waterproof">
                    <div class="product-icon-wrap">👜</div>
                    <h4 class="product-name">Diaper Bag Waterproof Capacity (Model 2)</h4>
                    <span class="product-subtext">Bahan anti air & banyak sekat rapi</span>
                    <a href="https://id.shp.ee/iJkBSCf8" target="_blank" rel="noopener" class="btn-shopee">🛒 Beli di Shopee</a>
                </div>

                <div class="product-card" data-cat="newborn" data-name="tas popok portable mat">
                    <div class="product-icon-wrap">👜</div>
                    <h4 class="product-name">Tas Popok + Matras Ganti Popok (Model 3)</h4>
                    <span class="product-subtext">Sudah termasuk perlak portable</span>
                    <a href="https://id.shp.ee/ezvGxLiY" target="_blank" rel="noopener" class="btn-shopee">🛒 Beli di Shopee</a>
                </div>

            </div>
        </div>

        <!-- SUBKATEGORI: KESEHATAN & MANDI -->
        <div class="subcat-group" style="margin-top: 40px;">
            <h3 class="subcat-title">🧼 Kesehatan & Mandi (Sabun Sensitif, Diaper Cream)</h3>
            <div class="products-grid">
                
                <div class="product-card" data-cat="newborn" data-name="sabun mandi bayi sensitif hypoallergenic">
                    <div class="product-badge">🧼 Skin Sensitive</div>
                    <div class="product-icon-wrap">🧴</div>
                    <h4 class="product-name">Sabun Mandi Bayi Sensitif (Opsi 1)</h4>
                    <span class="product-subtext">Formula pH balanced 5.5 tidak perih di mata</span>
                    <a href="https://id.shp.ee/w9R5gt4U" target="_blank" rel="noopener" class="btn-shopee">🛒 Beli di Shopee</a>
                </div>

                <div class="product-card" data-cat="newborn" data-name="sabun shampoo head to toe bayi">
                    <div class="product-icon-wrap">🧴</div>
                    <h4 class="product-name">Head-to-Toe Baby Wash Organic (Opsi 2)</h4>
                    <span class="product-subtext">Bebas SLS/SLES & paraben</span>
                    <a href="https://id.shp.ee/dcnH3Bdr" target="_blank" rel="noopener" class="btn-shopee">🛒 Beli di Shopee</a>
                </div>

                <div class="product-card" data-cat="newborn" data-name="sabun cair bayi murni">
                    <div class="product-icon-wrap">🧴</div>
                    <h4 class="product-name">Sabun Bayi Skin Defense (Opsi 3)</h4>
                    <span class="product-subtext">Cocok untuk kulit sensitif/eksema</span>
                    <a href="https://id.shp.ee/8pdYdrAk" target="_blank" rel="noopener" class="btn-shopee">🛒 Beli di Shopee</a>
                </div>

                <div class="product-card" data-cat="newborn" data-name="diaper cream ruam popok zinc oxide">
                    <div class="product-badge">🩹 Diaper Rash Cream</div>
                    <div class="product-icon-wrap">🧴</div>
                    <h4 class="product-name">Diaper Rash Cream Zinc Oxide (Opsi 1)</h4>
                    <span class="product-subtext">Meredakan ruam popok kemerahan seketika</span>
                    <a href="https://id.shp.ee/8odcpn6A" target="_blank" rel="noopener" class="btn-shopee">🛒 Beli di Shopee</a>
                </div>

                <div class="product-card" data-cat="newborn" data-name="diaper cream ruam bayi organik">
                    <div class="product-icon-wrap">🧴</div>
                    <h4 class="product-name">Krim Pelindung Ruam Popok (Opsi 2)</h4>
                    <span class="product-subtext">Membentuk lapisan pelindung kulit dari kelembapan</span>
                    <a href="https://id.shp.ee/b6ZzKAjK" target="_blank" rel="noopener" class="btn-shopee">🛒 Beli di Shopee</a>
                </div>

                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- ========================================== -->
    <!-- 3. KATEGORI FASE MPASI (6-12 BULAN) -->
    <!-- ========================================== -->
    <section class="shop-section-container shop-cat-section" id="kategori-mpasi" data-category="mpasi">
        <div class="shop-chip-tag chip-center">
            <span>Kategori 3</span>
        </div>
        <h2 class="shop-section-title text-center">
            🥣 Fase MPASI <span class="shop-pill shop-pill-rose">(6–12 Bulan)</span>
        </h2>
        <p class="shop-section-sub text-center">
            Set piring silicone food-grade, botol minum anti tumpah, alat masak MPASI, serta high chair ergonomis.
        </p>

        <!-- SUBKATEGORI: PERLENGKAPAN & BAHAN MPASI -->
        <div class="subcat-group">
            <div class="products-grid">
                <?php if (!$renderCategoryProducts('mpasi')): ?>
            
            <div class="product-card" data-cat="mpasi" data-name="set piring makan silicone mpasi suction">
                <div class="product-badge">🍽️ Silicone Suction</div>
                <div class="product-icon-wrap">🍽️</div>
                <h4 class="product-name">Set Piring Makan Silicone MPASI</h4>
                <span class="product-subtext">Lengkap dengan piring suction anti tumpah & sendok silicone</span>
                <a href="https://id.shp.ee/JEyJdjbi" target="_blank" rel="noopener" class="btn-shopee">🛒 Beli di Shopee</a>
            </div>

            <div class="product-card" data-cat="mpasi" data-name="botol minum spill proof mpasi straw cup">
                <div class="product-badge">🥤 Anti-Tumpah</div>
                <div class="product-icon-wrap">🥤</div>
                <h4 class="product-name">Botol Minum Spill-Proof (Straw Cup)</h4>
                <span class="product-subtext">Sedotan dengan pemberat gravity ball 360°</span>
                <a href="https://id.shp.ee/RyaCvnaR" target="_blank" rel="noopener" class="btn-shopee">🛒 Beli di Shopee</a>
            </div>

            <div class="product-card" data-cat="mpasi" data-name="bibs celemek makan silicone bayi">
                <div class="product-icon-wrap">🎽</div>
                <h4 class="product-name">Bibs Celemek Makan Silicone Kantong</h4>
                <span class="product-subtext">Menampung sisa makanan jatuh agar baju tidak kotor</span>
                <a href="https://id.shp.ee/Rmyb1AGa" target="_blank" rel="noopener" class="btn-shopee">🛒 Beli di Shopee</a>
            </div>

            <div class="product-card" data-cat="mpasi" data-name="food processor mpasi blender bayi">
                <div class="product-badge">🍲 Alat Masak MPASI</div>
                <div class="product-icon-wrap">🥣</div>
                <h4 class="product-name">Food Processor MPASI 4-in-1</h4>
                <span class="product-subtext">Kukus & blender halus otomatis dalam 1 wadah</span>
                <a href="https://id.shp.ee/FT8GHByQ" target="_blank" rel="noopener" class="btn-shopee">🛒 Beli di Shopee</a>
            </div>

            <div class="product-card" data-cat="mpasi" data-name="slow cooker mpasi bubur tim">
                <div class="product-badge">🍲 Slow Cooker</div>
                <div class="product-icon-wrap">🍲</div>
                <h4 class="product-name">Slow Cooker MPASI Ceramic Pot</h4>
                <span class="product-subtext">Memasak bubur tim & kaldu kaya nutrisi tanpa merusak zat gizi</span>
                <a href="https://id.shp.ee/yPErzw7s" target="_blank" rel="noopener" class="btn-shopee">🛒 Beli di Shopee</a>
            </div>

            <div class="product-card" data-cat="mpasi" data-name="cetakan kaldu mpasi silicone freezer container">
                <div class="product-icon-wrap">🧊</div>
                <h4 class="product-name">Cetakan Kaldu & Storage MPASI Silicone</h4>
                <span class="product-subtext">Sekat bertutup rapat tahan dingin freezer (-20°C)</span>
                <a href="https://id.shp.ee/DViXdhfk" target="_blank" rel="noopener" class="btn-shopee">🛒 Beli di Shopee</a>
            </div>

            <div class="product-card" data-cat="mpasi" data-name="high chair kursi makan bayi convertible">
                <div class="product-badge">🪑 High Chair</div>
                <div class="product-icon-wrap">🪑</div>
                <h4 class="product-name">High Chair Kursi Makan Bayi 6-in-1 (Model 1)</h4>
                <span class="product-subtext">Posisi fleksibel dari high chair hingga kursi belajar</span>
                <a href="https://id.shp.ee/xEvdpw5R" target="_blank" rel="noopener" class="btn-shopee">🛒 Beli di Shopee</a>
            </div>

            <div class="product-card" data-cat="mpasi" data-name="booster seat kursi makan lipat">
                <div class="product-icon-wrap">🪑</div>
                <h4 class="product-name">Booster Seat Kursi Makan Portable (Model 2)</h4>
                <span class="product-subtext">Bisa diikat di kursi makan dewasa / bawa bepergian</span>
                <a href="https://id.shp.ee/fp8QMBMm" target="_blank" rel="noopener" class="btn-shopee">🛒 Beli di Shopee</a>
            </div>

                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- ========================================== -->
    <!-- 4. KATEGORI BALITA & MONTESSORI (1-5 TAHUN) -->
    <!-- ========================================== -->
    <section class="shop-section-container shop-cat-section" id="kategori-balita" data-category="balita">
        <div class="shop-chip-tag chip-center">
            <span>Kategori 4</span>
        </div>
        <h2 class="shop-section-title text-center">
            🧸 Balita & Montessori <span class="shop-pill shop-pill-rose">(1–5 Tahun)</span>
        </h2>
        <p class="shop-section-sub text-center">
            Mainan edukasi motorik halus, buku anak pop-up & suara, serta perlengkapan toilet training.
        </p>

        <!-- SUBKATEGORI: BALITA & MONTESSORI -->
        <div class="subcat-group">
            <div class="products-grid">
                <?php if (!$renderCategoryProducts('balita')): ?>
            
            <div class="product-card" data-cat="balita" data-name="busy board montessori motorik halus">
                <div class="product-badge">🧩 Mainan Montessori</div>
                <div class="product-icon-wrap">🧩</div>
                <h4 class="product-name">Busy Board Montessori Motorik Halus</h4>
                <span class="product-subtext">Melatih kemandirian, pergerakan jari, & fokus anak</span>
                <a href="https://id.shp.ee/MA4z21sX" target="_blank" rel="noopener" class="btn-shopee">🛒 Beli di Shopee</a>
            </div>

            <div class="product-card" data-cat="balita" data-name="balok kayu montessori wooden blocks">
                <div class="product-icon-wrap">🧱</div>
                <h4 class="product-name">Balok Kayu Warna-Warni Montessori</h4>
                <span class="product-subtext">Bahan kayu halus bersertifikat non-toxic paint</span>
                <a href="https://id.shp.ee/SzSzUWbR" target="_blank" rel="noopener" class="btn-shopee">🛒 Beli di Shopee</a>
            </div>

            <div class="product-card" data-cat="balita" data-name="sensory bin wadah stimulasi sensori">
                <div class="product-icon-wrap">🎨</div>
                <h4 class="product-name">Sensory Bin Set Stimulasi Tangan</h4>
                <span class="product-subtext">Media eksplorasi tekstur sensori anak usia dini</span>
                <a href="https://id.shp.ee/NAL8Gbyj" target="_blank" rel="noopener" class="btn-shopee">🛒 Beli di Shopee</a>
            </div>

            <div class="product-card" data-cat="balita" data-name="puzzle kayu anak puzzle geometri">
                <div class="product-icon-wrap">🧩</div>
                <h4 class="product-name">Puzzle Kayu Edukasi Abjad & Angka</h4>
                <span class="product-subtext">Melatih pemecahan masalah & koordinasi mata-tangan</span>
                <a href="https://id.shp.ee/CcHjxJsU" target="_blank" rel="noopener" class="btn-shopee">🛒 Beli di Shopee</a>
            </div>

            <div class="product-card" data-cat="balita" data-name="board book anak buku tebal anti sobek">
                <div class="product-badge">📚 Buku Anak</div>
                <div class="product-icon-wrap">📚</div>
                <h4 class="product-name">Board Book Anak Anti-Sobek</h4>
                <span class="product-subtext">Buku tebal bergambar warna menarik</span>
                <a href="https://id.shp.ee/CqnJu8RP" target="_blank" rel="noopener" class="btn-shopee">🛒 Beli di Shopee</a>
            </div>

            <div class="product-card" data-cat="balita" data-name="buku pop up 3d cerita anak">
                <div class="product-icon-wrap">📚</div>
                <h4 class="product-name">Buku Pop-Up 3D Edukatif</h4>
                <span class="product-subtext">Karakter 3D yang muncul saat halaman dibuka</span>
                <a href="https://id.shp.ee/eVfJ1zZJ" target="_blank" rel="noopener" class="btn-shopee">🛒 Beli di Shopee</a>
            </div>

            <div class="product-card" data-cat="balita" data-name="buku suara sound book interaktif">
                <div class="product-icon-wrap">🔊</div>
                <h4 class="product-name">Sound Book (Buku Suara Hewan & Musik)</h4>
                <span class="product-subtext">Tekan tombol suara untuk mendengarkan audio</span>
                <a href="https://id.shp.ee/5pg8kwoi" target="_blank" rel="noopener" class="btn-shopee">🛒 Beli di Shopee</a>
            </div>

            <div class="product-card" data-cat="balita" data-name="buku mewarnai anak water magic book">
                <div class="product-icon-wrap">✏️</div>
                <h4 class="product-name">Buku Mewarnai Water Magic (Bisa Dipakai Berulang)</h4>
                <span class="product-subtext">Warnai hanya dengan air tanpa belepotan cat</span>
                <a href="https://id.shp.ee/DMYHe7SM" target="_blank" rel="noopener" class="btn-shopee">🛒 Beli di Shopee</a>
            </div>

            <div class="product-card" data-cat="balita" data-name="potties toilet training potty seat">
                <div class="product-badge">🚽 Toilet Training</div>
                <div class="product-icon-wrap">🚽</div>
                <h4 class="product-name">Potty Seat / Potties Toilet Training</h4>
                <span class="product-subtext">Desain lucu & empuk melatih lepas pampers</span>
                <a href="https://id.shp.ee/qbjGTQPS" target="_blank" rel="noopener" class="btn-shopee">🛒 Beli di Shopee</a>
            </div>

            <div class="product-card" data-cat="balita" data-name="piring balita sekat lucu bpa free">
                <div class="product-icon-wrap">🍽️</div>
                <h4 class="product-name">Piring Balita Sekat Karakter</h4>
                <span class="product-subtext">Membuat suasana makan lebih menyenangkan</span>
                <a href="https://id.shp.ee/Cq5LK3Ue" target="_blank" rel="noopener" class="btn-shopee">🛒 Beli di Shopee</a>
            </div>

            <div class="product-card" data-cat="balita" data-name="sikat gigi anak u shape silicone">
                <div class="product-icon-wrap">🪥</div>
                <h4 class="product-name">Sikat Gigi Anak U-Shape Silicone</h4>
                <span class="product-subtext">Membersihkan seluruh gigi 360° dengan lembut</span>
                <a href="https://id.shp.ee/znueTW11" target="_blank" rel="noopener" class="btn-shopee">🛒 Beli di Shopee</a>
            </div>

                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- ========================================== -->
    <!-- 5. KATEGORI KEAMANAN & RUMAH (HOME & SAFETY) -->
    <!-- ========================================== -->
    <section class="shop-section-container shop-cat-section" id="kategori-keamanan" data-category="keamanan">
        <div class="shop-chip-tag chip-center">
            <span>Kategori 5</span>
        </div>
        <h2 class="shop-section-title text-center">
            🛡️ Keamanan & Rumah <span class="shop-pill shop-pill-rose">(Home & Safety)</span>
        </h2>
        <p class="shop-section-sub text-center">
            Pengaman sudut meja, kunci lemari bayi, baby gate, air purifier, dan deterjen aman baju bayi.
        </p>

        <!-- SUBKATEGORI: KEAMANAN & RUMAH -->
        <div class="subcat-group">
            <div class="products-grid">
                <?php if (!$renderCategoryProducts('keamanan')): ?>
            
            <div class="product-card" data-cat="keamanan" data-name="baby gate pagar pengaman tangga pintu">
                <div class="product-badge">🛡️ Safety Gate</div>
                <div class="product-icon-wrap">🚪</div>
                <h4 class="product-name">Baby Safety Gate (Pagar Pintu & Tangga)</h4>
                <span class="product-subtext">Pengunci double-lock cegah balita jatuh di tangga</span>
                <a href="https://id.shp.ee/bsc4fnVW" target="_blank" rel="noopener" class="btn-shopee">🛒 Beli di Shopee</a>
            </div>

            <div class="product-card" data-cat="keamanan" data-name="pengaman sudut meja bening silicone">
                <div class="product-icon-wrap">🛡️</div>
                <h4 class="product-name">Pengaman Sudut Meja Silicone Bening</h4>
                <span class="product-subtext">Melindungi kepala bayi dari benturan siku meja tajam</span>
                <a href="https://id.shp.ee/madmXqa9" target="_blank" rel="noopener" class="btn-shopee">🛒 Beli di Shopee</a>
            </div>

            <div class="product-card" data-cat="keamanan" data-name="kunci lemari bayi pengunci laci">
                <div class="product-icon-wrap">🔐</div>
                <h4 class="product-name">Kunci Lemari & Laci Bayi Multi-Fungsi</h4>
                <span class="product-subtext">Mencegah laci terjepit / bayi mengambil benda berbahaya</span>
                <a href="https://id.shp.ee/n7K7agNh" target="_blank" rel="noopener" class="btn-shopee">🛒 Beli di Shopee</a>
            </div>

            <div class="product-card" data-cat="keamanan" data-name="air purifier pemurni udara hepa filter">
                <div class="product-badge">🌬️ Kebersihan Udara</div>
                <div class="product-icon-wrap">🌬️</div>
                <h4 class="product-name">Air Purifier HEPA Filter Ruangan Bayi</h4>
                <span class="product-subtext">Menyaring 99.97% debu, virus, & alergen udara</span>
                <a href="https://id.shp.ee/vT9tsLif" target="_blank" rel="noopener" class="btn-shopee">🛒 Beli di Shopee</a>
            </div>

            <div class="product-card" data-cat="keamanan" data-name="humidifier melembapkan udara diffuser">
                <div class="product-icon-wrap">💧</div>
                <h4 class="product-name">Humidifier Ruangan & Diffuser Aromaterapi</h4>
                <span class="product-subtext">Melembapkan udara kamar AC cegah hidung tersumbat</span>
                <a href="https://id.shp.ee/iJ6L5PWA" target="_blank" rel="noopener" class="btn-shopee">🛒 Beli di Shopee</a>
            </div>

            <div class="product-card" data-cat="keamanan" data-name="deterjen baju bayi khusus hypoallergenic">
                <div class="product-badge">🧺 Deterjen Bayi</div>
                <div class="product-icon-wrap">🧺</div>
                <h4 class="product-name">Deterjen Khusus Baju Bayi Hypoallergenic</h4>
                <span class="product-subtext">Bebas bahan kimia keras, lembut untuk kulit sensitif</span>
                <a href="https://id.shp.ee/QcWegfkA" target="_blank" rel="noopener" class="btn-shopee">🛒 Beli di Shopee</a>
            </div>

                <?php endif; ?>
            </div>
        </div>
    </section>

</div>

<!-- PAGE STYLES (WARM ROSE GOLD & AMBER CORAL THEME) -->
<style>
.shop-page-wrapper {
    font-family: 'Outfit', sans-serif;
    color: #1F2937;
    background-color: #FAFAFA;
    padding-bottom: 80px;
}

/* 1. HERO CONTAINER */
.shop-hero-container {
    background: linear-gradient(135deg, #FFF1F2 0%, #FFE4E6 100%);
    padding: 60px 5% 50px;
    border-bottom: 1px solid #FECDD3;
    position: relative;
    overflow: hidden;
}

.shop-hero-grid {
    max-width: 1240px;
    margin: 0 auto;
    display: grid;
    grid-template-columns: 1.1fr 0.9fr;
    gap: 40px;
    align-items: center;
}

.shop-hero-card-left {
    position: relative;
    z-index: 2;
}

.shop-svg-curve {
    position: absolute;
    top: -40px;
    left: -20px;
    width: 260px;
    height: 180px;
    pointer-events: none;
    z-index: -1;
}

.shop-chip-tag {
    display: inline-flex;
    align-items: center;
    padding: 6px 16px;
    background-color: #FFE4E6;
    border: 1px solid #FDA4AF;
    border-radius: 50px;
    font-size: 0.88rem;
    font-weight: 600;
    color: #BE123C;
    margin-bottom: 20px;
}

.shop-chip-tag.chip-center {
    margin: 0 auto 16px;
}

.shop-hero-title {
    font-size: 2.8rem;
    font-weight: 800;
    line-height: 1.2;
    color: #881337;
    margin-bottom: 18px;
}

.shop-pill {
    display: inline-block;
    padding: 4px 18px;
    border-radius: 40px;
    color: #FFFFFF;
    font-family: 'Outfit', sans-serif;
}

.shop-pill-rose {
    background-color: #E11D48;
    box-shadow: 0 4px 14px rgba(225, 29, 72, 0.35);
}

.shop-hero-subtitle {
    font-size: 1.08rem;
    line-height: 1.6;
    color: #374151;
    margin-bottom: 30px;
}

.shop-hero-stats {
    display: inline-flex;
    align-items: center;
    background: #FFFFFF;
    padding: 14px 24px;
    border-radius: 20px;
    box-shadow: 0 10px 25px rgba(225, 29, 72, 0.08);
    border: 1px solid #FFE4E6;
    gap: 20px;
}

.stat-pill-item {
    display: flex;
    flex-direction: column;
}

.stat-num {
    font-weight: 800;
    font-size: 1.15rem;
    color: #E11D48;
}

.stat-lbl {
    font-size: 0.78rem;
    color: #6B7280;
    font-weight: 500;
}

.stat-pill-divider {
    width: 1px;
    height: 32px;
    background-color: #E5E7EB;
}

/* HERO RIGHT PHOTO */
.shop-img-wrapper {
    position: relative;
    border-radius: 28px;
    overflow: hidden;
    box-shadow: 0 20px 40px rgba(0,0,0,0.12);
    border: 4px solid #FFFFFF;
}

.shop-hero-img {
    width: 100%;
    height: 420px;
    object-fit: cover;
    display: block;
}

.shop-img-overlay-bar {
    position: absolute;
    bottom: 16px;
    left: 16px;
    right: 16px;
    display: grid;
    grid-template-columns: 1fr 1fr 1fr;
    gap: 10px;
}

.shop-overlay-badge {
    background: rgba(255, 255, 255, 0.94);
    backdrop-filter: blur(8px);
    padding: 10px 12px;
    border-radius: 14px;
    display: flex;
    flex-direction: column;
    border: 1px solid rgba(255, 255, 255, 0.7);
}

.badge-rose .badge-title { color: #E11D48; }
.badge-amber .badge-title { color: #D97706; }
.badge-pink .badge-title { color: #DB2777; }

.badge-title { font-size: 0.82rem; font-weight: 700; }
.badge-sub { font-size: 0.72rem; color: #4B5563; }

/* ANCHORS NAV BAR */
.shop-nav-anchors-wrap {
    background: #FFFFFF;
    border-bottom: 1px solid #E5E7EB;
    position: sticky;
    top: 0;
    z-index: 100;
    box-shadow: 0 4px 12px rgba(0,0,0,0.03);
}

.shop-nav-anchors {
    max-width: 1240px;
    margin: 0 auto;
    padding: 12px 5%;
    display: flex;
    gap: 12px;
    overflow-x: auto;
    white-space: nowrap;
}

.anchor-btn {
    padding: 8px 18px;
    border-radius: 30px;
    font-size: 0.88rem;
    font-weight: 600;
    color: #4B5563;
    text-decoration: none;
    background: #F3F4F6;
    transition: all 0.2s ease;
}

.anchor-btn:hover, .anchor-btn.highlight {
    background: #E11D48;
    color: #FFFFFF;
}

/* SEARCH & FILTER TOOLBAR */
.shop-section-container {
    max-width: 1240px;
    margin: 40px auto 0;
    padding: 0 5%;
}

.search-filter-toolbar {
    background: #FFFFFF;
    border-radius: 24px;
    border: 1px solid #E5E7EB;
    padding: 24px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.04);
}

.search-input-box {
    position: relative;
    margin-bottom: 20px;
}

.search-icon {
    position: absolute;
    left: 18px;
    top: 50%;
    transform: translateY(-50%);
    font-size: 1.2rem;
}

.search-input-box input {
    width: 100%;
    padding: 14px 20px 14px 50px;
    border-radius: 50px;
    border: 2px solid #FFE4E6;
    font-family: inherit;
    font-size: 1rem;
    outline: none;
    transition: border-color 0.2s;
}

.search-input-box input:focus {
    border-color: #E11D48;
}

.category-filter-buttons {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
    justify-content: center;
}

.cat-filter-btn {
    padding: 8px 18px;
    border-radius: 30px;
    border: 1px solid #E5E7EB;
    background: #F9FAFB;
    font-weight: 600;
    font-size: 0.88rem;
    color: #374151;
    cursor: pointer;
    transition: all 0.2s;
}

.cat-filter-btn:hover, .cat-filter-btn.active {
    background: #E11D48;
    color: #FFFFFF;
    border-color: #E11D48;
    box-shadow: 0 4px 12px rgba(225, 29, 72, 0.25);
}

/* SECTIONS & PRODUCT GRID */
.shop-cat-section {
    margin-top: 50px;
}

.shop-section-title {
    font-size: 2.2rem;
    font-weight: 800;
    color: #1F2937;
    margin-top: 8px;
    margin-bottom: 10px;
}

.shop-section-sub {
    font-size: 1.02rem;
    color: #6B7280;
    margin-bottom: 35px;
}

.subcat-group {
    background: #FFFFFF;
    border: 1px solid #E5E7EB;
    border-radius: 24px;
    padding: 24px;
    box-shadow: 0 8px 25px rgba(0,0,0,0.03);
    margin-bottom: 30px;
}

.subcat-title {
    font-size: 1.2rem;
    font-weight: 700;
    color: #9F1239;
    margin-bottom: 20px;
    padding-bottom: 10px;
    border-bottom: 2px dashed #FFE4E6;
}

.products-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
    gap: 20px;
}

.product-card {
    background: #F9FAFB;
    border: 1px solid #E5E7EB;
    border-radius: 18px;
    padding: 18px;
    display: flex;
    flex-direction: column;
    position: relative;
    transition: transform 0.2s, box-shadow 0.2s;
}

.product-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 12px 30px rgba(225, 29, 72, 0.12);
    border-color: #FDA4AF;
}

.product-badge {
    position: absolute;
    top: 12px;
    right: 12px;
    background: #FFE4E6;
    color: #BE123C;
    font-size: 0.72rem;
    font-weight: 700;
    padding: 3px 8px;
    border-radius: 8px;
}

.product-icon-wrap {
    width: 48px;
    height: 48px;
    background: #FFFFFF;
    border-radius: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    margin-bottom: 12px;
    border: 1px solid #FFE4E6;
}

.product-img-wrap {
    width: 100%;
    height: 180px;
    background: #FFFFFF;
    border-radius: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 14px;
    border: 1px solid #FFE4E6;
    overflow: hidden;
    padding: 8px;
}

.product-img-wrap img {
    max-width: 100%;
    max-height: 100%;
    object-fit: contain;
}

.product-name {
    font-size: 1.02rem;
    font-weight: 700;
    color: #111827;
    margin-bottom: 6px;
    line-height: 1.3;
}

.product-subtext {
    font-size: 0.8rem;
    color: #6B7280;
    line-height: 1.4;
    margin-bottom: 16px;
}

.btn-shopee {
    margin-top: auto;
    display: block;
    width: 100%;
    padding: 10px;
    background: linear-gradient(135deg, #EE4D2D 0%, #FF5722 100%);
    color: #FFFFFF;
    text-align: center;
    border-radius: 12px;
    font-weight: 700;
    font-size: 0.88rem;
    text-decoration: none;
    box-shadow: 0 4px 12px rgba(238, 77, 45, 0.3);
    transition: transform 0.2s, box-shadow 0.2s;
}

.btn-shopee:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 16px rgba(238, 77, 45, 0.45);
}

@media (max-width: 900px) {
    .shop-hero-grid { grid-template-columns: 1fr; }
    .shop-hero-title { font-size: 2.2rem; }
    .products-grid { grid-template-columns: 1fr; }
}
</style>

<!-- PAGE INTERACTIVE JAVASCRIPT -->
<script>
function selectCategoryFilter(btnElem, categoryKey) {
    document.querySelectorAll('.cat-filter-btn').forEach(b => b.classList.remove('active'));
    btnElem.classList.add('active');

    const sections = document.querySelectorAll('.shop-cat-section');
    sections.forEach(sec => {
        if (categoryKey === 'all' || sec.dataset.category === categoryKey) {
            sec.style.display = 'block';
        } else {
            sec.style.display = 'none';
        }
    });
}

function filterProducts() {
    const query = document.getElementById('shopSearchInput').value.toLowerCase().trim();
    const cards = document.querySelectorAll('.product-card');

    cards.forEach(card => {
        const name = card.dataset.name.toLowerCase();
        if (name.includes(query)) {
            card.style.display = 'flex';
        } else {
            card.style.display = 'none';
        }
    });
}
</script>

<?= $this->endSection() ?>
