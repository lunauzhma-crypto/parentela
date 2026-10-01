<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<!-- GOOGLE FONTS IMPORT (OUTFIT, CAVEAT, PLAYFAIR DISPLAY) -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Caveat:wght@700&family=Outfit:wght@400;500;600;700;800&family=Playfair+Display:ital,wght@0,600;0,800;1,600&display=swap" rel="stylesheet">

<div class="menu-page-wrapper">
    
    <!-- 1. HERO SECTION -->
    <section class="menu-hero-container">
        <div class="menu-hero-grid">
            
            <!-- HERO LEFT CARD -->
            <div class="menu-hero-card-left">
                <!-- DASHED SVG ACCENT (PASTEL SAGE THEME) -->
                <svg class="menu-svg-curve" viewBox="0 0 300 200" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M10 100 C 90 20, 210 180, 290 100" stroke="#16A34A" stroke-width="2.5" stroke-dasharray="6 6" opacity="0.35"/>
                    <circle cx="290" cy="100" r="4" fill="#16A34A"/>
                    <circle cx="10" cy="100" r="4" fill="#16A34A"/>
                </svg>

                <div class="menu-chip-tag">
                    <span>🥗 Panduan Gizi & Resep MPASI Terpadu</span>
                </div>

                <h1 class="menu-hero-title">
                    Resep MPASI & <span class="menu-pill menu-pill-sage">Nutrisi Si Kecil</span>
                </h1>

                <p class="menu-hero-subtitle">
                    Tak sekadar galeri video! Dilengkapi transkrip bahan presisi (gram & sdm), kalkulator porsi dinamis, panduan penyimpanan medis, meal planner mingguan, serta trik anti-GTM dari komunitas orang tua.
                </p>

                <!-- QUICK STATS BADGES -->
                <div class="menu-hero-stats">
                    <div class="stat-pill-item">
                        <span class="stat-num">100%</span>
                        <span class="stat-lbl">Takaran Presisi (Gram)</span>
                    </div>
                    <div class="stat-pill-divider"></div>
                    <div class="stat-pill-item">
                        <span class="stat-num">6-12+</span>
                        <span class="stat-lbl">Fase Usia & Tekstur</span>
                    </div>
                    <div class="stat-pill-divider"></div>
                    <div class="stat-pill-item">
                        <span class="stat-num">Anti-GTM</span>
                        <span class="stat-lbl">Trik Komunitas</span>
                    </div>
                </div>
            </div>

            <!-- HERO RIGHT CARD PHOTO (MOTHER COOKING MPASI) -->
            <div class="menu-hero-card-right">
                <div class="menu-img-wrapper">
                    <img src="<?= base_url('images/mother_cooking_mpasi.jpg') ?>" alt="Ibu Memasak Resep MPASI Sehat Parentela" class="menu-hero-img">
                    
                    <!-- OVERLAY BADGES AT BOTTOM -->
                    <div class="menu-img-overlay-bar">
                        <div class="menu-overlay-badge badge-sage">
                            <span class="badge-title">Booster Berat Badan</span>
                            <span class="badge-sub">Kaya Lemak Sehat & Prohe</span>
                        </div>
                        <div class="menu-overlay-badge badge-mint">
                            <span class="badge-title">Tekstur Bertahap</span>
                            <span class="badge-sub">Saring, Cincang, & Finger Food</span>
                        </div>
                        <div class="menu-overlay-badge badge-amber">
                            <span class="badge-title">Bebas GTM</span>
                            <span class="badge-sub">Solusi Praktis Dapur Ibu</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- NAVIGATION ANCHOR BAR -->
    <div class="menu-nav-anchors-wrap">
        <div class="menu-nav-anchors">
            <a href="#resep-utama" class="anchor-btn highlight">🥗 Katalogue Resep MPASI</a>
            <a href="#kalkulator-porsi" class="anchor-btn">🧮 Kalkulator Porsi & Storage</a>
            <a href="#meal-planner" class="anchor-btn">📅 Weekly Meal Planner</a>
            <a href="#trik-anti-gtm" class="anchor-btn">💡 Trik Anti-GTM Komunitas</a>
        </div>
    </div>

    <!-- 2. FILTER AGE & NUTRITION TAGS -->
    <section class="menu-section-container" id="resep-utama">
        <div class="menu-chip-tag chip-center">
            <span>Filter Cerdas Dapur Parentela</span>
        </div>
        <h2 class="menu-section-title text-center">
            Pilih Resep Berdasarkan <span class="menu-pill menu-pill-sage">Usia & Nutrisi</span>
        </h2>
        <p class="menu-section-sub text-center">
            Temukan sajian ideal sesuai fase tumbuh kembang dan kebutuhan khusus si kecil.
        </p>

        <!-- AGE TABS -->
        <div class="age-filter-tabs">
            <button class="age-tab-btn active" data-age="all">✨ Semua Usia</button>
            <button class="age-tab-btn" data-age="6-8">👶 6–8 Bulan (Puree / Saring)</button>
            <button class="age-tab-btn" data-age="8-12">🧒 8–12 Bulan (Cincang / Tim)</button>
            <button class="age-tab-btn" data-age="12plus">👦 12+ Bulan (Finger Food)</button>
        </div>

        <!-- NUTRITION TAG CHIPS -->
        <div class="nutrition-filter-chips">
            <span class="filter-label">Fokus Nutrisi:</span>
            <button class="nutri-chip-btn active" data-tag="all">Semua Label</button>
            <button class="nutri-chip-btn" data-tag="booster-bb">🚀 Booster BB</button>
            <button class="nutri-chip-btn" data-tag="tinggi-zat-besi">🩸 Tinggi Zat Besi</button>
            <button class="nutri-chip-btn" data-tag="menu-lengkap">🥗 Menu Lengkap</button>
            <button class="nutri-chip-btn" data-tag="bebas-dairy">🥛 Bebas Dairy</button>
            <button class="nutri-chip-btn" data-tag="bebas-telur">🥚 Bebas Telur</button>
        </div>

        <!-- RECIPES GRID -->
        <div class="recipes-grid" id="recipesGrid">
            
            <!-- RECIPE CARD 1 (SPESIAL REVISI AKURAT YOUTUBE) -->
            <div class="recipe-card" data-age="8-12" data-tags="booster-bb menu-lengkap tinggi-zat-besi">
                <div class="recipe-card-header">
                    <div class="video-container">
                        <iframe src="https://www.youtube-nocookie.com/embed/vvHz-ChmB6Y?rel=0" title="Chicken Bolognese Porridge - Resep MPASI YouTube Devina Hermawan" allowfullscreen></iframe>
                        <span class="video-badge">▶ Video Resmi YouTube (vvHz-ChmB6Y)</span>
                    </div>
                    <div class="recipe-top-tags">
                        <span class="badge-age age-812">8–12 Bulan</span>
                        <span class="badge-nutri booster">🚀 Booster BB</span>
                        <span class="badge-nutri complete">🥗 Menu Lengkap Bolognese</span>
                    </div>
                </div>

                <div class="recipe-card-body">
                    <div class="recipe-title-row">
                        <h3 class="recipe-title">Chicken Bolognese Porridge</h3>
                        <button class="btn-bookmark-icon" title="Simpan ke Favorit" onclick="toggleBookmark(this, 'Chicken Bolognese Porridge')">
                            <svg class="star-icon" viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2">
                                <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                            </svg>
                        </button>
                    </div>

                    <p class="recipe-desc">
                        Resep kreasi MPASI lezat & praktis perpaduan paha ayam giling gurih, saus bolognese tomat wortel oregano segar, dan Promina Bubur Tim Ayam Kampung.
                    </p>

                    <!-- QUICK META INFO -->
                    <div class="recipe-quick-meta">
                        <span>⏱️ 20 Menit</span>
                        <span>🍲 2-3x Makan</span>
                        <span>🥣 Tekstur: Bubur Tim Bolognese Lembut</span>
                    </div>

                    <!-- INGREDIENTS TRANSCRIPT -->
                    <div class="transcript-box">
                        <div class="transcript-head">
                            <span>📝 Transkrip Bahan Presisi (YouTube Devina Hermawan):</span>
                            <div class="portion-scaler">
                                <label>Porsi:</label>
                                <select onchange="scaleIngredients(this, 1)">
                                    <option value="1">1 Porsi Resep (Standar)</option>
                                    <option value="0.5">0.5 Porsi</option>
                                    <option value="2">2 Porsi Resep (Double)</option>
                                </select>
                            </div>
                        </div>
                        <ul class="ing-list" id="ing-list-1">
                            <li><strong class="qty" data-base="50">50</strong> gr Paha Ayam Giling</li>
                            <li><strong class="qty" data-base="1">1</strong> buah Tomat Merah</li>
                            <li><strong class="qty" data-base="15">15</strong> gr Bawang Bombai</li>
                            <li><strong class="qty" data-base="1">1</strong> siung Bawang Putih</li>
                            <li><strong class="qty" data-base="10">10</strong> cm Batang Seledri</li>
                            <li><strong class="qty" data-base="20">20</strong> gr Wortel</li>
                            <li><strong class="qty" data-base="1">1</strong> sdm Minyak (untuk menumis)</li>
                            <li><strong class="qty" data-base="0.25">¼</strong> sdt Oregano Kering</li>
                            <li><strong class="qty" data-base="150">150</strong> ml Air</li>
                            <li><strong class="qty" data-base="1">1</strong> sachet Promina Bubur Tim Ayam Kampung Tomat Wortel (+ 100 ml Air Panas)</li>
                        </ul>

                        <div style="margin-top: 10px; font-size: 0.8rem; color: #4B5563;">
                            <strong>🧀 Pelengkap (Opsional):</strong> Keju parmesan bubuk, aonori (rumput laut), dan tomat ceri.
                        </div>
                    </div>

                    <!-- STEP BY STEP INSTRUCTIONS -->
                    <div class="steps-box">
                        <h4>👩‍🍳 Cara Membuat (8 Langkah Eksak):</h4>
                        <ol class="steps-list">
                            <li>Panaskan sedikit minyak, masak ayam giling hingga matang, sisihkan.</li>
                            <li>Potong-potong tomat, potong kotak bawang bombai, iris bawang putih, seledri dan wortel.</li>
                            <li>Panaskan sedikit minyak, masukkan tomat, bawang bombai dan bawang putih, tumis hingga wangi kemudian masukkan seledri, wortel dan oregano, tumis sesaat.</li>
                            <li>Masukkan air, masak sesaat kemudian sisihkan kulit tomat. Diamkan sesaat sebelum diblender.</li>
                            <li>Masukkan ke dalam blender, haluskan kemudian masukkan ayam, haluskan sesaat dan panaskan kembali.</li>
                            <li>Di dalam piring saji, campurkan Promina Bubur Tim Ayam Kampung Tomat Wortel dengan 100 ml air panas, aduk rata.</li>
                            <li>Tuang saus bolognese, keju parut, aonori dan tomat ceri di atasnya.</li>
                            <li>Chicken Bolognese Porridge siap disajikan hangat untuk si kecil!</li>
                        </ol>
                    </div>

                    <!-- STORAGE & PORTION ADVICE -->
                    <div class="storage-info-box">
                        <div class="storage-item">
                            <span class="st-icon">🌡️ Suhu Ruang:</span>
                            <span class="st-val">Maksimal 2 Jam</span>
                        </div>
                        <div class="storage-item">
                            <span class="st-icon">❄️ Chiller (Kulkas):</span>
                            <span class="st-val">Tahan 24 Jam (4°C)</span>
                        </div>
                        <div class="storage-item">
                            <span class="st-icon">🧊 Freezer:</span>
                            <span class="st-val">Tahan 14 Hari (-18°C)</span>
                        </div>
                    </div>

                    <!-- ANTI-GTM COMMUNITY HACK -->
                    <div class="gtm-hack-card">
                        <div class="gtm-hack-header">
                            <span class="gtm-tag">💡 Trik Anti-GTM Komunitas</span>
                            <span class="gtm-author">by Mom Devina</span>
                        </div>
                        <p class="gtm-hack-text">
                            "Saus bolognese alami berbahan tomat segar, oregano & keju parmesan ini punya aroma khas Italia yang sangat menggugah selera anak yang sedang mogok makan bubur biasa. Rasanya gurih manis alami!"
                        </p>
                    </div>

                    <!-- CARD ACTION BUTTONS -->
                    <div class="card-action-bar">
                        <button class="btn-add-planner" onclick="openPlannerModal('Chicken Bolognese Porridge')">
                            📅 Tambah ke Meal Planner
                        </button>
                    </div>

                </div>
            </div>

            <!-- RECIPE CARD 2 (AKURAT YOUTUBE hDXwtpwKjqY) -->
            <div class="recipe-card" data-age="6-8" data-tags="booster-bb menu-lengkap">
                <div class="recipe-card-header">
                    <div class="video-container">
                        <iframe src="https://www.youtube-nocookie.com/embed/hDXwtpwKjqY?rel=0" title="Resep Bubur Sup Telur Wortel MPASI YouTube" allowfullscreen></iframe>
                        <span class="video-badge">▶ Video Resmi YouTube (hDXwtpwKjqY)</span>
                    </div>
                    <div class="recipe-top-tags">
                        <span class="badge-age age-68">6-8 Bulan</span>
                        <span class="badge-nutri booster">🚀 Booster BB</span>
                        <span class="badge-nutri complete">🥗 Menu Lengkap Simple</span>
                    </div>
                </div>

                <div class="recipe-card-body">
                    <div class="recipe-title-row">
                        <h3 class="recipe-title">Bubur Sup Telur Wortel</h3>
                        <button class="btn-bookmark-icon" title="Simpan ke Favorit" onclick="toggleBookmark(this, 'Bubur Sup Telur Wortel')">
                            <svg class="star-icon" viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2">
                                <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                            </svg>
                        </button>
                    </div>

                    <p class="recipe-desc">
                        Menu MPASI rumahan super simpel, mudah, dan ekonomis! Perpaduan energi nasi, protein telur ayam & tahu, vitamin wortel segar, serta gurihnya kaldu sapi.
                    </p>

                    <!-- QUICK META INFO -->
                    <div class="recipe-quick-meta">
                        <span>⏱️ 15 Menit</span>
                        <span>🍲 2-3x Makan</span>
                        <span>🥣 Tekstur: Bubur Lembut Halus</span>
                    </div>

                    <!-- INGREDIENTS TRANSCRIPT -->
                    <div class="transcript-box">
                        <div class="transcript-head">
                            <span>📝 Transkrip Bahan Presisi (YouTube hDXwtpwKjqY):</span>
                            <div class="portion-scaler">
                                <label>Porsi:</label>
                                <select onchange="scaleIngredients(this, 2)">
                                    <option value="1">1 Porsi Resep (Standar)</option>
                                    <option value="0.5">0.5 Porsi</option>
                                    <option value="2">2 Porsi Resep (Double)</option>
                                </select>
                            </div>
                        </div>
                        <ul class="ing-list" id="ing-list-2">
                            <li><strong class="qty" data-base="60">60</strong> gram Nasi Pulen</li>
                            <li><strong class="qty" data-base="1">1</strong> butir Telur Ayam</li>
                            <li><strong class="qty" data-base="2">2</strong> ruas jari Wortel (parut / iris halus)</li>
                            <li><strong class="qty" data-base="0.5">½</strong> kotak Tahu Putih (lumatkan)</li>
                            <li><strong class="qty" data-base="1">1</strong> siung Bawang Merah (iris)</li>
                            <li><strong class="qty" data-base="1">1</strong> siung Bawang Putih (iris)</li>
                            <li>Daun Seledri secukupnya</li>
                            <li><strong class="qty" data-base="30">30</strong> ml Kaldu Sapi</li>
                            <li><strong class="qty" data-base="120">120</strong> ml Air</li>
                        </ul>
                    </div>

                    <!-- STEP BY STEP INSTRUCTIONS -->
                    <div class="steps-box">
                        <h4>👩‍🍳 Cara Membuat Singkat:</h4>
                        <ol class="steps-list">
                            <li>Tumis irisan bawang merah dan bawang putih hingga harum dan matang.</li>
                            <li>Masukkan air (120 ml) dan kaldu sapi (30 ml), lalu tambahkan nasi (60g), tahu lumat (1/2 kotak), serta wortel parut (2 ruas jari).</li>
                            <li>Masak dengan api sedang sambil diaduk hingga nasi menyusut dan wortel empuk.</li>
                            <li>Tuangkan kocokan telur ayam dan irisan seledri, aduk cepat hingga telur matang berserabut lembut.</li>
                            <li>Haluskan/saring jika disajikan untuk usia 6+ bulan, atau langsung sajikan hangat untuk si kecil!</li>
                        </ol>
                    </div>

                    <!-- STORAGE & PORTION ADVICE -->
                    <div class="storage-info-box">
                        <div class="storage-item">
                            <span class="st-icon">🌡️ Suhu Ruang:</span>
                            <span class="st-val">Maksimal 2 Jam</span>
                        </div>
                        <div class="storage-item">
                            <span class="st-icon">❄️ Chiller (Kulkas):</span>
                            <span class="st-val">Tahan 24 Jam (4°C)</span>
                        </div>
                        <div class="storage-item">
                            <span class="st-icon">🧊 Freezer:</span>
                            <span class="st-val">Tahan 14 Hari (-18°C)</span>
                        </div>
                    </div>

                    <!-- ANTI-GTM COMMUNITY HACK -->
                    <div class="gtm-hack-card">
                        <div class="gtm-hack-header">
                            <span class="gtm-tag">💡 Trik Anti-GTM Komunitas</span>
                            <span class="gtm-author">by Mom Nindya</span>
                        </div>
                        <p class="gtm-hack-text">
                            "Resep sangat penyelamat saat tanggal tua atau butuh masak kilat di bawah 15 menit! Penambahan kaldu sapi & seledri segar bikin aroma amis telur hilang total."
                        </p>
                    </div>

                    <!-- CARD ACTION BUTTONS -->
                    <div class="card-action-bar">
                        <button class="btn-add-planner" onclick="openPlannerModal('Bubur Sup Telur Wortel')">
                            📅 Tambah ke Meal Planner
                        </button>
                    </div>

                </div>
            </div>

            <!-- RECIPE CARD 3 (AKURAT YOUTUBE 5Hz1i0mqnwY) -->
            <div class="recipe-card" data-age="8-12" data-tags="booster-bb menu-lengkap">
                <div class="recipe-card-header">
                    <div class="video-container">
                        <iframe src="https://www.youtube-nocookie.com/embed/5Hz1i0mqnwY?rel=0" title="Resep MPASI Ayam Steak & Puree Sehat YouTube" allowfullscreen></iframe>
                        <span class="video-badge">▶ Video Resmi YouTube (5Hz1i0mqnwY)</span>
                    </div>
                    <div class="recipe-top-tags">
                        <span class="badge-age age-812">8–12 Bulan</span>
                        <span class="badge-nutri booster">🚀 Booster BB</span>
                        <span class="badge-nutri complete">🥗 Protein Tinggi</span>
                    </div>
                </div>

                <div class="recipe-card-body">
                    <div class="recipe-title-row">
                        <h3 class="recipe-title">Steak Ayam & Puree Kentang MPASI</h3>
                        <button class="btn-bookmark-icon" title="Simpan ke Favorit" onclick="toggleBookmark(this, 'Steak Ayam & Puree Kentang MPASI')">
                            <svg class="star-icon" viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2">
                                <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                            </svg>
                        </button>
                    </div>

                    <p class="recipe-desc">
                        Variasi sajian MPASI olahan daging ayam empuk gurih bersaus lembut dengan puree kentang manis yang sangat digemari si kecil.
                    </p>

                    <!-- QUICK META INFO -->
                    <div class="recipe-quick-meta">
                        <span>⏱️ 20 Menit</span>
                        <span>🍲 2-3x Makan</span>
                        <span>🥣 Tekstur: Cincang Halus / Puree</span>
                    </div>

                    <!-- INGREDIENTS TRANSCRIPT -->
                    <div class="transcript-box">
                        <div class="transcript-head">
                            <span>📝 Transkrip Bahan Presisi (YouTube 5Hz1i0mqnwY):</span>
                            <div class="portion-scaler">
                                <label>Porsi:</label>
                                <select onchange="scaleIngredients(this, 3)">
                                    <option value="1">1 Porsi Resep (Standar)</option>
                                    <option value="0.5">0.5 Porsi</option>
                                    <option value="2">2 Porsi Resep (Double)</option>
                                </select>
                            </div>
                        </div>
                        <ul class="ing-list" id="ing-list-3">
                            <li><strong class="qty" data-base="60">60</strong>g Daging Ayam Fillet Cincang</li>
                            <li><strong class="qty" data-base="60">60</strong>g Kentang Kukus Lumat (1/2 buah)</li>
                            <li><strong class="qty" data-base="15">15</strong>g Wortel Parut (1 sdm)</li>
                            <li><strong class="qty" data-base="5">5</strong>g Unsalted Butter (1 sdt)</li>
                            <li><strong class="qty" data-base="150">150</strong>ml Kaldu Ayam Gurih</li>
                        </ul>
                    </div>

                    <!-- STEP BY STEP INSTRUCTIONS -->
                    <div class="steps-box">
                        <h4>👩‍🍳 Cara Membuat Singkat:</h4>
                        <ol class="steps-list">
                            <li>Tumis daging ayam cincang dengan unsalted butter hingga harum dan berubah warna.</li>
                            <li>Masukkan kentang kukus lumat, wortel parut, dan kaldu ayam. Masak hingga air menyusut.</li>
                            <li>Haluskan dengan saringan/blender sesuai tekstur fase usia si kecil, lalu sajikan hangat.</li>
                        </ol>
                    </div>

                    <!-- STORAGE & PORTION ADVICE -->
                    <div class="storage-info-box">
                        <div class="storage-item">
                            <span class="st-icon">🌡️ Suhu Ruang:</span>
                            <span class="st-val">Maksimal 2 Jam</span>
                        </div>
                        <div class="storage-item">
                            <span class="st-icon">❄️ Chiller (Kulkas):</span>
                            <span class="st-val">Tahan 24 Jam (4°C)</span>
                        </div>
                        <div class="storage-item">
                            <span class="st-icon">🧊 Freezer:</span>
                            <span class="st-val">Tahan 14 Hari (-18°C)</span>
                        </div>
                    </div>

                    <!-- ANTI-GTM COMMUNITY HACK -->
                    <div class="gtm-hack-card">
                        <div class="gtm-hack-header">
                            <span class="gtm-tag">💡 Trik Anti-GTM Komunitas</span>
                            <span class="gtm-author">by Mom Sheila</span>
                        </div>
                        <p class="gtm-hack-text">
                            "Aroma lezat daging ayam tumis butter ini terbukti sukses bikin anak yang tadinya menolak nasi jadi sangat lahap!"
                        </p>
                    </div>

                    <!-- CARD ACTION BUTTONS -->
                    <div class="card-action-bar">
                        <button class="btn-add-planner" onclick="openPlannerModal('Steak Ayam & Puree Kentang MPASI')">
                            📅 Tambah ke Meal Planner
                        </button>
                    </div>

                </div>
            </div>

            <!-- RECIPE CARD 4 (BUBUR AYAM MENTEGA qMffNkl8Ql0) -->
            <div class="recipe-card" data-age="6-8" data-tags="booster-bb menu-lengkap">
                <div class="recipe-card-header">
                    <div class="video-container">
                        <iframe src="https://www.youtube-nocookie.com/embed/qMffNkl8Ql0?rel=0" title="Resep Bubur Ayam Mentega MPASI YouTube" allowfullscreen></iframe>
                        <span class="video-badge">▶ Video Resmi YouTube (qMffNkl8Ql0)</span>
                    </div>
                    <div class="recipe-top-tags">
                        <span class="badge-age age-68">6-8 Bulan</span>
                        <span class="badge-nutri booster">🚀 Booster BB</span>
                        <span class="badge-nutri complete">🥗 Menu Lengkap Mentega</span>
                    </div>
                </div>

                <div class="recipe-card-body">
                    <div class="recipe-title-row">
                        <h3 class="recipe-title">Bubur Ayam Mentega</h3>
                        <button class="btn-bookmark-icon" title="Simpan ke Favorit" onclick="toggleBookmark(this, 'Bubur Ayam Mentega')">
                            <svg class="star-icon" viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2">
                                <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                            </svg>
                        </button>
                    </div>

                    <p class="recipe-desc">
                        Bubur ayam kaya aroma mentega/margarin gurih dengan tekstur lembut yang pas untuk bayi, kaya protein ayam, telur, dan vitamin wortel.
                    </p>

                    <!-- QUICK META INFO -->
                    <div class="recipe-quick-meta">
                        <span>⏱️ 25 Menit</span>
                        <span>🍲 2-3x Makan</span>
                        <span>🥣 Tekstur: Bubur Lembut Mentega</span>
                    </div>

                    <!-- INGREDIENTS TRANSCRIPT -->
                    <div class="transcript-box">
                        <div class="transcript-head">
                            <span>📝 Transkrip Bahan Presisi (YouTube qMffNkl8Ql0):</span>
                            <div class="portion-scaler">
                                <label>Porsi:</label>
                                <select onchange="scaleIngredients(this, 4)">
                                    <option value="1">1 Porsi Resep (Standar)</option>
                                    <option value="0.5">0.5 Porsi</option>
                                    <option value="2">2 Porsi Resep (Double)</option>
                                </select>
                            </div>
                        </div>
                        <ul class="ing-list" id="ing-list-4">
                            <li><strong class="qty" data-base="3">3</strong> sdm Beras Putih</li>
                            <li><strong class="qty" data-base="300">300</strong> ml Kaldu Ayam / Air</li>
                            <li><strong class="qty" data-base="40">40</strong> gr Daging Ayam Cincang</li>
                            <li><strong class="qty" data-base="1">1</strong> butir Telur Ayam</li>
                            <li><strong class="qty" data-base="2">2</strong> ruas jari Wortel (parut halus)</li>
                            <li><strong class="qty" data-base="0.5">½</strong> siung Bawang Merah (iris)</li>
                            <li><strong class="qty" data-base="0.5">½</strong> siung Bawang Putih (iris)</li>
                            <li><strong class="qty" data-base="1">1</strong> sdm Margarin / Mentega</li>
                        </ul>
                    </div>

                    <!-- STEP BY STEP INSTRUCTIONS -->
                    <div class="steps-box">
                        <h4>👩‍🍳 Cara Membuat Singkat:</h4>
                        <ol class="steps-list">
                            <li>Tumis irisan bawang merah dan bawang putih menggunakan 1 sdm margarin/mentega hingga harum.</li>
                            <li>Masukkan daging ayam cincang (40 gr), tumis hingga berubah warna dan matang.</li>
                            <li>Masukkan beras (3 sdm), wortel parut (2 ruas jari), dan kaldu ayam/air (300 ml).</li>
                            <li>Masak dengan api kecil sambil sesekali diaduk hingga beras melembut menjadi bubur dan air menyusut.</li>
                            <li>Tuangkan kocokan telur ayam, aduk rata hingga matang berserabut lembut. Angkat, saring/haluskan jika disajikan untuk 6+ bulan, dan sajikan hangat!</li>
                        </ol>
                    </div>

                    <!-- STORAGE & PORTION ADVICE -->
                    <div class="storage-info-box">
                        <div class="storage-item">
                            <span class="st-icon">🌡️ Suhu Ruang:</span>
                            <span class="st-val">Maksimal 2 Jam</span>
                        </div>
                        <div class="storage-item">
                            <span class="st-icon">❄️ Chiller (Kulkas):</span>
                            <span class="st-val">Tahan 24 Jam (4°C)</span>
                        </div>
                        <div class="storage-item">
                            <span class="st-icon">🧊 Freezer:</span>
                            <span class="st-val">Tahan 14 Hari (-18°C)</span>
                        </div>
                    </div>

                    <!-- ANTI-GTM COMMUNITY HACK -->
                    <div class="gtm-hack-card">
                        <div class="gtm-hack-header">
                            <span class="gtm-tag">💡 Trik Anti-GTM Komunitas</span>
                            <span class="gtm-author">by Mom Amel</span>
                        </div>
                        <p class="gtm-hack-text">
                            "Menumis bawang merah & bawang putih langsung pakai margarin/mentega bikin kaldu bubur harum gurih alami tanpa perlu bumbu instan!"
                        </p>
                    </div>

                    <!-- CARD ACTION BUTTONS -->
                    <div class="card-action-bar">
                        <button class="btn-add-planner" onclick="openPlannerModal('Bubur Ayam Mentega')">
                            📅 Tambah ke Meal Planner
                        </button>
                    </div>

                </div>
            </div>
            <!-- RECIPE CARD 5 (AKURAT YOUTUBE Spa8V6zCBAc - PUREE MPASI 6 BULAN) -->
            <div class="recipe-card" data-age="6-8" data-tags="bebas-dairy bebas-telur booster-bb">
                <div class="recipe-card-header">
                    <div class="video-container">
                        <iframe src="https://www.youtube-nocookie.com/embed/Spa8V6zCBAc?rel=0" title="Puree MPASI 6 Bulan Bagus untuk Bayi YouTube" allowfullscreen></iframe>
                        <span class="video-badge">▶ Video Resmi YouTube (Spa8V6zCBAc)</span>
                    </div>
                    <div class="recipe-top-tags">
                        <span class="badge-age age-68">6-8 Bulan</span>
                        <span class="badge-nutri dairyfree">🥛 Bebas Dairy</span>
                        <span class="badge-nutri eggfree">🥚 Bebas Telur</span>
                    </div>
                </div>

                <div class="recipe-card-body">
                    <div class="recipe-title-row">
                        <h3 class="recipe-title">Puree MPASI 6 Bulan (6 Variasi Buah & Sayur Terbaik)</h3>
                        <button class="btn-bookmark-icon" title="Simpan ke Favorit" onclick="toggleBookmark(this, 'Puree MPASI 6 Bulan (6 Variasi)')">
                            <svg class="star-icon" viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2">
                                <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                            </svg>
                        </button>
                    </div>

                    <p class="recipe-desc">
                        Panduan membuat puree tunggal & kombinasi yang paling aman dan kaya gizi untuk masa awal perkenalan MPASI bayi usia 6 bulan.
                    </p>

                    <!-- QUICK META INFO -->
                    <div class="recipe-quick-meta">
                        <span>⏱️ 10 Menit</span>
                        <span>🍲 6 Variasi Menu</span>
                        <span>🥣 Tekstur: Saring Puree Sangat Lembut</span>
                    </div>

                    <!-- INGREDIENTS TRANSCRIPT -->
                    <div class="transcript-box">
                        <div class="transcript-head">
                            <span>📝 6 Jenis Puree Terbaik untuk Bayi 6 Bulan:</span>
                        </div>
                        <ul class="ing-list" id="ing-list-5">
                            <li>🍎 <strong>Puree Apel:</strong> Apel manis dikukus 5-8 menit lalu dilumatkan halus (Kaya Vitamin C & Serat).</li>
                            <li>🍠 <strong>Puree Ubi:</strong> Ubi manis/ungu dikukus lembut disaring halus (+ sedikit ASI/SUFOR).</li>
                            <li>🥕 <strong>Puree Wortel:</strong> Wortel organik dikukus lembut dan disaring (Kaya Beta-Karoten & Antioksidan).</li>
                            <li>🥭 <strong>Puree Pepaya:</strong> Pepaya matang dilumatkan langsung tanpa dikukus (Sangat bagus melancarkan BAB bayi).</li>
                            <li>🐉 <strong>Puree Buah Naga:</strong> Buah naga merah dilumatkan & disaring biji kecilnya (Kaya Zat Besi & Nutrisi).</li>
                            <li>🥑 <strong>Puree Alpukat:</strong> Alpukat mentega matang dilumatkan halus + 1 sdt minyak zaitun/ASI (Lemak Sehat Booster BB).</li>
                        </ul>
                    </div>

                    <!-- STEP BY STEP INSTRUCTIONS -->
                    <div class="steps-box">
                        <h4>👩‍🍳 Panduan Pengolahan Singkat:</h4>
                        <ol class="steps-list">
                            <li>Cuci bersih buah/sayur dengan air mengalir. Kupas kulitnya secara higienis.</li>
                            <li>Untuk apel, ubi, dan wortel: Kukus selama 5–10 menit hingga empuk lembut, lalu blender/saring kawat.</li>
                            <li>Untuk pepaya, buah naga, dan alpukat: Lumatkan langsung saat matang sempurna, saring jika perlu.</li>
                            <li>Tambahkan 1–2 sdm ASI / SUFOR hangat untuk mengatur kekentalan tekstur saat pertama kali dikenalkan ke bayi.</li>
                        </ol>
                    </div>

                    <!-- STORAGE & PORTION ADVICE -->
                    <div class="storage-info-box">
                        <div class="storage-item">
                            <span class="st-icon">🌡️ Suhu Ruang:</span>
                            <span class="st-val">Maksimal 1 Jam</span>
                        </div>
                        <div class="storage-item">
                            <span class="st-icon">❄️ Chiller (Kulkas):</span>
                            <span class="st-val">Tahan 24 Jam (4°C)</span>
                        </div>
                        <div class="storage-item">
                            <span class="st-icon">🧊 Freezer:</span>
                            <span class="st-val">Tahan 14 Hari (-18°C)</span>
                        </div>
                    </div>

                    <!-- ANTI-GTM COMMUNITY HACK -->
                    <div class="gtm-hack-card">
                        <div class="gtm-hack-header">
                            <span class="gtm-tag">💡 Trik Anti-GTM Komunitas</span>
                            <span class="gtm-author">by Mom Nindya</span>
                        </div>
                        <p class="gtm-hack-text">
                            "Mengenalkan puree alpukat atau ubi kukus manis dengan campuran ASI di minggu awal MPASI terbukti sangat efektif mencegah bayi menolak makanan!"
                        </p>
                    </div>

                    <!-- CARD ACTION BUTTONS -->
                    <div class="card-action-bar">
                        <button class="btn-add-planner" onclick="openPlannerModal('Puree MPASI 6 Bulan (6 Variasi)')">
                            📅 Tambah ke Meal Planner
                        </button>
                    </div>

                </div>
            </div>

        </div>
    </section>

        </div>
    </section>

    <!-- 3. INTERACTIVE STORAGE & PORTION CALCULATOR SECTION -->
    <section class="menu-section-container bg-warm-card" id="kalkulator-porsi">
        <div class="menu-chip-tag chip-center">
            <span>Standar Keamanan Pangan MPASI</span>
        </div>
        <h2 class="menu-section-title text-center">
            Panduan Penyimpanan & <span class="menu-pill menu-pill-sage">Defrosting Dapur</span>
        </h2>
        <p class="menu-section-sub text-center">
            Hindari bakteri berbahaya! Pelajari aturan ketat daya simpan makanan bayi berdasarkan rekomendasi medis IDAI.
        </p>

        <div class="storage-rules-grid">
            <div class="storage-rule-card">
                <div class="rule-icon-circle bg-mint">🌡️</div>
                <h3>Suhu Ruangan (25°C - 30°C)</h3>
                <span class="rule-time">Maksimal 2 Jam</span>
                <p>MPASI yang sudah bersentuhan dengan air liur bayi sebaiknya langsung dihabiskan atau dibuang dalam 1 jam.</p>
            </div>

            <div class="storage-rule-card">
                <div class="rule-icon-circle bg-sage">❄️</div>
                <h3>Chiller / Kulkas Bawah (4°C)</h3>
                <span class="rule-time">Maksimal 24 - 48 Jam</span>
                <p>Simpan dalam wadah kaca/BPA Free kedap udara. Pisahkan porsi per sekali makan sebelum disimpan.</p>
            </div>

            <div class="storage-rule-card">
                <div class="rule-icon-circle bg-olive">🧊</div>
                <h3>Freezer Khusus (-18°C)</h3>
                <span class="rule-time">Tahan 2 hingga 4 Minggu</span>
                <p>Gunakan wadah sekat silicone berpenutup. Beri label tanggal pembuatan pada tiap container MPASI.</p>
            </div>
        </div>

        <div class="defrost-tips-banner">
            <div class="defrost-content">
                <h4>🔥 Aturan Aman Menghangatkan (Defrosting) MPASI Beku:</h4>
                <ul>
                    <li>✅ <strong>Cara Terbaik:</strong> Pindahkan MPASI dari freezer ke chiller malam sebelumnya agar mencair perlahan.</li>
                    <li>✅ <strong>Kukus Ulang:</strong> Kukus selama 5–10 menit hingga uap panas merata sebelum disajikan suam kuku.</li>
                    <li>❌ <strong>Jangan Pernah:</strong> Membekukan kembali MPASI yang sudah pernah dicairkan/dihangatkan!</li>
                </ul>
            </div>
        </div>
    </section>

    <!-- 4. WEEKLY MEAL PLANNER INTERACTIVE GRID -->
    <section class="menu-section-container" id="meal-planner">
        <div class="menu-chip-tag chip-center">
            <span>Perencanaan Menu Keluarga Cerdas</span>
        </div>
        <h2 class="menu-section-title text-center">
            Jadwal Menu <span class="menu-pill menu-pill-sage">MPASI Mingguan</span>
        </h2>
        <p class="menu-section-sub text-center">
            Atur variasi menu protein dan nutrisi harian si kecil tanpa perlu pusing memilih resep setiap pagi.
        </p>

        <div class="planner-wrapper">
            <div class="planner-actions-top">
                <span class="planner-status" id="plannerStatus">0 Resep Terjadwal</span>
                <button class="btn-clear-planner" onclick="clearPlanner()">🧹 Kosongkan Jadwal</button>
                <button class="btn-print-planner" onclick="window.print()">🖨️ Cetak / Unduh Jadwal</button>
            </div>

            <div class="planner-grid">
                <!-- MONDAY -->
                <div class="planner-day-card">
                    <div class="day-header">Senin</div>
                    <div class="meal-slot" data-day="Senin" data-meal="Pagi">
                        <span class="slot-lbl">🌅 Makan Pagi</span>
                        <div class="slot-content" id="slot-Senin-Pagi"><em>+ Klik resep untuk tambah</em></div>
                    </div>
                    <div class="meal-slot" data-day="Senin" data-meal="Siang">
                        <span class="slot-lbl">☀️ Makan Siang</span>
                        <div class="slot-content" id="slot-Senin-Siang"><em>+ Klik resep untuk tambah</em></div>
                    </div>
                    <div class="meal-slot" data-day="Senin" data-meal="Malam">
                        <span class="slot-lbl">🌙 Makan Malam</span>
                        <div class="slot-content" id="slot-Senin-Malam"><em>+ Klik resep untuk tambah</em></div>
                    </div>
                </div>

                <!-- TUESDAY -->
                <div class="planner-day-card">
                    <div class="day-header">Selasa</div>
                    <div class="meal-slot" data-day="Selasa" data-meal="Pagi">
                        <span class="slot-lbl">🌅 Makan Pagi</span>
                        <div class="slot-content" id="slot-Selasa-Pagi"><em>+ Klik resep untuk tambah</em></div>
                    </div>
                    <div class="meal-slot" data-day="Selasa" data-meal="Siang">
                        <span class="slot-lbl">☀️ Makan Siang</span>
                        <div class="slot-content" id="slot-Selasa-Siang"><em>+ Klik resep untuk tambah</em></div>
                    </div>
                    <div class="meal-slot" data-day="Selasa" data-meal="Malam">
                        <span class="slot-lbl">🌙 Makan Malam</span>
                        <div class="slot-content" id="slot-Selasa-Malam"><em>+ Klik resep untuk tambah</em></div>
                    </div>
                </div>

                <!-- WEDNESDAY -->
                <div class="planner-day-card">
                    <div class="day-header">Rabu</div>
                    <div class="meal-slot" data-day="Rabu" data-meal="Pagi">
                        <span class="slot-lbl">🌅 Makan Pagi</span>
                        <div class="slot-content" id="slot-Rabu-Pagi"><em>+ Klik resep untuk tambah</em></div>
                    </div>
                    <div class="meal-slot" data-day="Rabu" data-meal="Siang">
                        <span class="slot-lbl">☀️ Makan Siang</span>
                        <div class="slot-content" id="slot-Rabu-Siang"><em>+ Klik resep untuk tambah</em></div>
                    </div>
                    <div class="meal-slot" data-day="Rabu" data-meal="Malam">
                        <span class="slot-lbl">🌙 Makan Malam</span>
                        <div class="slot-content" id="slot-Rabu-Malam"><em>+ Klik resep untuk tambah</em></div>
                    </div>
                </div>

                <!-- THURSDAY -->
                <div class="planner-day-card">
                    <div class="day-header">Kamis</div>
                    <div class="meal-slot" data-day="Kamis" data-meal="Pagi">
                        <span class="slot-lbl">🌅 Makan Pagi</span>
                        <div class="slot-content" id="slot-Kamis-Pagi"><em>+ Klik resep untuk tambah</em></div>
                    </div>
                    <div class="meal-slot" data-day="Kamis" data-meal="Siang">
                        <span class="slot-lbl">☀️ Makan Siang</span>
                        <div class="slot-content" id="slot-Kamis-Siang"><em>+ Klik resep untuk tambah</em></div>
                    </div>
                    <div class="meal-slot" data-day="Kamis" data-meal="Malam">
                        <span class="slot-lbl">🌙 Makan Malam</span>
                        <div class="slot-content" id="slot-Kamis-Malam"><em>+ Klik resep untuk tambah</em></div>
                    </div>
                </div>

                <!-- FRIDAY -->
                <div class="planner-day-card">
                    <div class="day-header">Jumat</div>
                    <div class="meal-slot" data-day="Jumat" data-meal="Pagi">
                        <span class="slot-lbl">🌅 Makan Pagi</span>
                        <div class="slot-content" id="slot-Jumat-Pagi"><em>+ Klik resep untuk tambah</em></div>
                    </div>
                    <div class="meal-slot" data-day="Jumat" data-meal="Siang">
                        <span class="slot-lbl">☀️ Makan Siang</span>
                        <div class="slot-content" id="slot-Jumat-Siang"><em>+ Klik resep untuk tambah</em></div>
                    </div>
                    <div class="meal-slot" data-day="Jumat" data-meal="Malam">
                        <span class="slot-lbl">🌙 Makan Malam</span>
                        <div class="slot-content" id="slot-Jumat-Malam"><em>+ Klik resep untuk tambah</em></div>
                    </div>
                </div>

                <!-- SATURDAY -->
                <div class="planner-day-card">
                    <div class="day-header">Sabtu</div>
                    <div class="meal-slot" data-day="Sabtu" data-meal="Pagi">
                        <span class="slot-lbl">🌅 Makan Pagi</span>
                        <div class="slot-content" id="slot-Sabtu-Pagi"><em>+ Klik resep untuk tambah</em></div>
                    </div>
                    <div class="meal-slot" data-day="Sabtu" data-meal="Siang">
                        <span class="slot-lbl">☀️ Makan Siang</span>
                        <div class="slot-content" id="slot-Sabtu-Siang"><em>+ Klik resep untuk tambah</em></div>
                    </div>
                    <div class="meal-slot" data-day="Sabtu" data-meal="Malam">
                        <span class="slot-lbl">🌙 Makan Malam</span>
                        <div class="slot-content" id="slot-Sabtu-Malam"><em>+ Klik resep untuk tambah</em></div>
                    </div>
                </div>

                <!-- SUNDAY -->
                <div class="planner-day-card">
                    <div class="day-header">Minggu</div>
                    <div class="meal-slot" data-day="Minggu" data-meal="Pagi">
                        <span class="slot-lbl">🌅 Makan Pagi</span>
                        <div class="slot-content" id="slot-Minggu-Pagi"><em>+ Klik resep untuk tambah</em></div>
                    </div>
                    <div class="meal-slot" data-day="Minggu" data-meal="Siang">
                        <span class="slot-lbl">☀️ Makan Siang</span>
                        <div class="slot-content" id="slot-Minggu-Siang"><em>+ Klik resep untuk tambah</em></div>
                    </div>
                    <div class="meal-slot" data-day="Minggu" data-meal="Malam">
                        <span class="slot-lbl">🌙 Makan Malam</span>
                        <div class="slot-content" id="slot-Minggu-Malam"><em>+ Klik resep untuk tambah</em></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 5. COMMUNITY ANTI-GTM HACKS SECTION -->
    <section class="menu-section-container" id="trik-anti-gtm">
        <div class="menu-chip-tag chip-center">
            <span>Forum Berbagi Pengalaman Ibu</span>
        </div>
        <h2 class="menu-section-title text-center">
            Kolom Trik <span class="menu-pill menu-pill-sage">Anti-GTM & Hack Komunitas</span>
        </h2>
        <p class="menu-section-sub text-center">
            Tempat orang tua saling berbagi modifikasi resep & cara taktis menghadapi si kecil yang Gerakan Tutup Mulut!
        </p>

        <div class="gtm-community-grid">
            
            <!-- LEFT: SUBMIT HACK FORM -->
            <div class="gtm-form-card">
                <h3>✍️ Bagikan Trik / Modifikasi Resep Anda</h3>
                <p class="form-desc">Bantu sesama orang tua dengan pengalaman nyata memasak di dapur!</p>

                <form id="hackForm" onsubmit="submitHack(event)">
                    <div class="form-group">
                        <label>Nama Orang Tua / Mom & Dad:</label>
                        <input type="text" id="hackAuthor" placeholder="Misal: Mom Amel" required>
                    </div>

                    <div class="form-group">
                        <label>Pilih Resep / Topik:</label>
                        <select id="hackRecipe" required>
                            <option value="Puree Daging Sapi & Hati Ayam">Puree Daging Sapi & Hati Ayam</option>
                            <option value="Nasi Tim Cincang Daging Sapi">Nasi Tim Cincang Daging Sapi</option>
                            <option value="Bola-Bola Nasi Salmon Cheese">Bola-Bola Nasi Salmon Cheese</option>
                            <option value="Bubur Sup Ikan Kembung">Bubur Sup Ikan Kembung</option>
                            <option value="Stik Tahu Ayam Udang">Stik Tahu Ayam Udang</option>
                            <option value="Tips Umum GTM">Tips Umum Menghadapi GTM</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Trik Modifikasi / Hack Dapur Anda:</label>
                        <textarea id="hackContent" rows="4" placeholder="Misal: Daging ayam diganti hati sapi plus tambahan 1 sdt unsalted butter hangat, anakku langsung lahap!" required></textarea>
                    </div>

                    <button type="submit" class="btn-submit-hack">🚀 Kirim Trik Komunitas</button>
                </form>
            </div>

            <!-- RIGHT: COMMUNITY HACKS FEED -->
            <div class="gtm-feed-card">
                <h3>💬 Trik & Hack Terpopuler dari Orang Tua Parentela</h3>
                
                <div class="hacks-feed-list" id="hacksFeed">
                    
                    <div class="feed-item">
                        <div class="feed-top">
                            <span class="author-badge">Mom Clara</span>
                            <span class="recipe-target">📌 Puree Daging Sapi</span>
                            <span class="feed-time">2 jam lalu</span>
                        </div>
                        <p class="feed-text">
                            "Resep ini aku modifikasi sedikit, ayamnya aku ganti hati sapi plus tambahan 1 sdt unsalted butter hangat saat mau disajikan. Aromanya harum banget dan anakku yang tadinya lepeh langsung lahap habis!"
                        </p>
                        <div class="feed-footer">
                            <button class="like-btn" onclick="likeFeed(this)">👍 Membantu (14)</button>
                        </div>
                    </div>

                    <div class="feed-item">
                        <div class="feed-top">
                            <span class="author-badge">Mom Nindya</span>
                            <span class="recipe-target">📌 Nasi Tim Cincang Sapi</span>
                            <span class="feed-time">Yesterday</span>
                        </div>
                        <p class="feed-text">
                            "Bagi yang anaknya sedang tumbuh gigi dan nggak mau tekstur terlalu kering: tambahkan 2 sdm kuah kaldu hangat tepat di atas mangkok saji. Dagingnya jadi super lembut gampang ditelan!"
                        </p>
                        <div class="feed-footer">
                            <button class="like-btn" onclick="likeFeed(this)">👍 Membantu (28)</button>
                        </div>
                    </div>

                    <div class="feed-item">
                        <div class="feed-top">
                            <span class="author-badge">Dad Rayhan</span>
                            <span class="recipe-target">📌 Bola-Bola Salmon</span>
                            <span class="feed-time">3 hari lalu</span>
                        </div>
                        <p class="feed-text">
                            "Kalau salmon susah didapat, ganti pakai ikan kembung segar. Kalsium dan DHA nya sama tingginya, harganya ekonomis, dan teksturnya tetap renyah di luar kalau ditumis sebentar!"
                        </p>
                        <div class="feed-footer">
                            <button class="like-btn" onclick="likeFeed(this)">👍 Membantu (42)</button>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </section>

</div>

<!-- MEAL PLANNER SELECTION MODAL -->
<div class="menu-modal-overlay" id="plannerModal">
    <div class="menu-modal-card">
        <div class="modal-head">
            <h3>📅 Tambahkan ke Meal Planner</h3>
            <button class="modal-close-btn" onclick="closePlannerModal()">&times;</button>
        </div>
        <div class="modal-body">
            <p>Pilih hari dan waktu makan untuk resep: <strong id="modalRecipeTitle">--</strong></p>
            
            <div class="form-group">
                <label>Pilih Hari:</label>
                <select id="modalDay">
                    <option value="Senin">Senin</option>
                    <option value="Selasa">Selasa</option>
                    <option value="Rabu">Rabu</option>
                    <option value="Kamis">Kamis</option>
                    <option value="Jumat">Jumat</option>
                    <option value="Sabtu">Sabtu</option>
                    <option value="Minggu">Minggu</option>
                </select>
            </div>

            <div class="form-group">
                <label>Waktu Makan:</label>
                <select id="modalMeal">
                    <option value="Pagi">🌅 Makan Pagi</option>
                    <option value="Siang">☀️ Makan Siang</option>
                    <option value="Malam">🌙 Makan Malam</option>
                </select>
            </div>

            <button class="btn-confirm-add" onclick="confirmAddToPlanner()">Simpan ke Jadwal</button>
        </div>
    </div>
</div>

<!-- PAGE STYLES (PASTEL SAGE GREEN & FRESH OLIVE THEME) -->
<style>
.menu-page-wrapper {
    font-family: 'Outfit', sans-serif;
    color: #1F2937;
    background-color: #FAFAFA;
    padding-bottom: 80px;
}

/* 1. HERO CONTAINER */
.menu-hero-container {
    background: linear-gradient(135deg, #F0FDF4 0%, #DCFCE7 100%);
    padding: 60px 5% 50px;
    border-bottom: 1px solid #BBF7D0;
    position: relative;
    overflow: hidden;
}

.menu-hero-grid {
    max-width: 1240px;
    margin: 0 auto;
    display: grid;
    grid-template-columns: 1.1fr 0.9fr;
    gap: 40px;
    align-items: center;
}

.menu-hero-card-left {
    position: relative;
    z-index: 2;
}

.menu-svg-curve {
    position: absolute;
    top: -40px;
    left: -20px;
    width: 260px;
    height: 180px;
    pointer-events: none;
    z-index: -1;
}

.menu-chip-tag {
    display: inline-flex;
    align-items: center;
    padding: 6px 16px;
    background-color: #DCFCE7;
    border: 1px solid #86EFAC;
    border-radius: 50px;
    font-size: 0.88rem;
    font-weight: 600;
    color: #15803D;
    margin-bottom: 20px;
}

.menu-chip-tag.chip-center {
    margin: 0 auto 16px;
}

.menu-hero-title {
    font-size: 2.8rem;
    font-weight: 800;
    line-height: 1.2;
    color: #14532D;
    margin-bottom: 18px;
}

.menu-pill {
    display: inline-block;
    padding: 4px 18px;
    border-radius: 40px;
    color: #FFFFFF;
    font-family: 'Outfit', sans-serif;
}

.menu-pill-sage {
    background-color: #16A34A;
    box-shadow: 0 4px 14px rgba(22, 163, 74, 0.35);
}

.menu-hero-subtitle {
    font-size: 1.08rem;
    line-height: 1.6;
    color: #374151;
    margin-bottom: 30px;
}

.menu-hero-stats {
    display: inline-flex;
    align-items: center;
    background: #FFFFFF;
    padding: 14px 24px;
    border-radius: 20px;
    box-shadow: 0 10px 25px rgba(22, 163, 74, 0.08);
    border: 1px solid #DCFCE7;
    gap: 20px;
}

.stat-pill-item {
    display: flex;
    flex-direction: column;
}

.stat-num {
    font-weight: 800;
    font-size: 1.15rem;
    color: #16A34A;
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
.menu-img-wrapper {
    position: relative;
    border-radius: 28px;
    overflow: hidden;
    box-shadow: 0 20px 40px rgba(0,0,0,0.12);
    border: 4px solid #FFFFFF;
}

.menu-hero-img {
    width: 100%;
    height: 420px;
    object-fit: cover;
    display: block;
}

.menu-img-overlay-bar {
    position: absolute;
    bottom: 16px;
    left: 16px;
    right: 16px;
    display: grid;
    grid-template-columns: 1fr 1fr 1fr;
    gap: 10px;
}

.menu-overlay-badge {
    background: rgba(255, 255, 255, 0.94);
    backdrop-filter: blur(8px);
    padding: 10px 12px;
    border-radius: 14px;
    display: flex;
    flex-direction: column;
    border: 1px solid rgba(255, 255, 255, 0.7);
}

.badge-sage .badge-title { color: #16A34A; }
.badge-mint .badge-title { color: #059669; }
.badge-amber .badge-title { color: #D97706; }

.badge-title {
    font-size: 0.82rem;
    font-weight: 700;
}

.badge-sub {
    font-size: 0.72rem;
    color: #4B5563;
}

/* ANCHORS NAV BAR */
.menu-nav-anchors-wrap {
    background: #FFFFFF;
    border-bottom: 1px solid #E5E7EB;
    position: sticky;
    top: 0;
    z-index: 100;
    box-shadow: 0 4px 12px rgba(0,0,0,0.03);
}

.menu-nav-anchors {
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
    background: #16A34A;
    color: #FFFFFF;
}

/* SECTIONS COMMON */
.menu-section-container {
    max-width: 1240px;
    margin: 60px auto 0;
    padding: 0 5%;
}

.menu-section-title {
    font-size: 2.2rem;
    font-weight: 800;
    color: #1F2937;
    margin-top: 8px;
    margin-bottom: 10px;
}

.menu-section-sub {
    font-size: 1.02rem;
    color: #6B7280;
    margin-bottom: 35px;
}

/* AGE & NUTRITION FILTERS */
.age-filter-tabs {
    display: flex;
    justify-content: center;
    gap: 12px;
    margin-bottom: 20px;
    flex-wrap: wrap;
}

.age-tab-btn {
    padding: 10px 22px;
    border-radius: 30px;
    border: 1px solid #E5E7EB;
    background: #FFFFFF;
    font-weight: 600;
    font-size: 0.92rem;
    color: #374151;
    cursor: pointer;
    transition: all 0.2s;
}

.age-tab-btn:hover, .age-tab-btn.active {
    background: #16A34A;
    color: #FFFFFF;
    border-color: #16A34A;
    box-shadow: 0 4px 12px rgba(22, 163, 74, 0.25);
}

.nutrition-filter-chips {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    margin-bottom: 40px;
    flex-wrap: wrap;
}

.filter-label {
    font-weight: 600;
    font-size: 0.88rem;
    color: #6B7280;
}

.nutri-chip-btn {
    padding: 6px 14px;
    border-radius: 20px;
    border: 1px solid #BBF7D0;
    background: #F0FDF4;
    font-size: 0.82rem;
    font-weight: 600;
    color: #15803D;
    cursor: pointer;
    transition: all 0.2s;
}

.nutri-chip-btn:hover, .nutri-chip-btn.active {
    background: #15803D;
    color: #FFFFFF;
    border-color: #15803D;
}

/* RECIPES GRID */
.recipes-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(360px, 1fr));
    gap: 30px;
}

.recipe-card {
    background: #FFFFFF;
    border-radius: 24px;
    border: 1px solid #E5E7EB;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(0,0,0,0.05);
    display: flex;
    flex-direction: column;
    transition: transform 0.2s, box-shadow 0.2s;
}

.recipe-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 16px 40px rgba(22, 163, 74, 0.12);
}

.recipe-card-header {
    position: relative;
    background: #1F2937;
}

.video-container {
    position: relative;
    padding-bottom: 56.25%; /* 16:9 ratio */
    height: 0;
    overflow: hidden;
}

.video-container iframe {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    border: 0;
}

.video-badge {
    position: absolute;
    top: 12px;
    left: 12px;
    background: rgba(0,0,0,0.75);
    color: #FFF;
    padding: 4px 10px;
    border-radius: 8px;
    font-size: 0.72rem;
    font-weight: 600;
}

.recipe-top-tags {
    padding: 12px 16px;
    background: #F0FDF4;
    display: flex;
    gap: 8px;
    flex-wrap: wrap;
    border-bottom: 1px solid #DCFCE7;
}

.badge-age {
    font-size: 0.75rem;
    font-weight: 700;
    padding: 4px 10px;
    border-radius: 12px;
}

.age-68 { background: #DCFCE7; color: #166534; }
.age-812 { background: #FEF08A; color: #854D0E; }
.age-12p { background: #E0E7FF; color: #3730A3; }

.badge-nutri {
    font-size: 0.75rem;
    font-weight: 600;
    padding: 4px 10px;
    border-radius: 12px;
    background: #FFFFFF;
    border: 1px solid #E5E7EB;
    color: #374151;
}

.recipe-card-body {
    padding: 24px;
    display: flex;
    flex-direction: column;
    flex-grow: 1;
}

.recipe-title-row {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    gap: 12px;
    margin-bottom: 8px;
}

.recipe-title {
    font-size: 1.25rem;
    font-weight: 700;
    color: #111827;
    line-height: 1.3;
}

.btn-bookmark-icon {
    background: none;
    border: none;
    color: #9CA3AF;
    cursor: pointer;
    padding: 4px;
    transition: color 0.2s;
}

.btn-bookmark-icon:hover, .btn-bookmark-icon.active {
    color: #F59E0B;
}

.btn-bookmark-icon.active .star-icon {
    fill: #F59E0B;
}

.recipe-desc {
    font-size: 0.88rem;
    color: #6B7280;
    line-height: 1.5;
    margin-bottom: 16px;
}

.recipe-quick-meta {
    display: flex;
    gap: 12px;
    font-size: 0.78rem;
    font-weight: 600;
    color: #15803D;
    background: #F0FDF4;
    padding: 8px 12px;
    border-radius: 10px;
    margin-bottom: 18px;
    flex-wrap: wrap;
}

/* TRANSCRIPT BOX */
.transcript-box {
    background: #F9FAFB;
    border: 1px solid #E5E7EB;
    border-radius: 14px;
    padding: 14px;
    margin-bottom: 16px;
}

.transcript-head {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 10px;
    font-size: 0.82rem;
    font-weight: 700;
    color: #374151;
}

.portion-scaler {
    display: flex;
    align-items: center;
    gap: 6px;
}

.portion-scaler select {
    font-size: 0.75rem;
    padding: 2px 6px;
    border-radius: 6px;
    border: 1px solid #D1D5DB;
}

.ing-list {
    list-style: none;
    padding: 0;
    margin: 0;
    font-size: 0.82rem;
    color: #4B5563;
}

.ing-list li {
    padding: 4px 0;
    border-bottom: 1px stroke #F3F4F6;
}

.ing-list li strong.qty {
    color: #16A34A;
}

/* STEPS BOX */
.steps-box {
    margin-bottom: 16px;
}

.steps-box h4 {
    font-size: 0.88rem;
    font-weight: 700;
    color: #111827;
    margin-bottom: 8px;
}

.steps-list {
    padding-left: 18px;
    margin: 0;
    font-size: 0.82rem;
    color: #4B5563;
    line-height: 1.5;
}

.steps-list li {
    margin-bottom: 6px;
}

/* STORAGE INFO BOX */
.storage-info-box {
    display: grid;
    grid-template-columns: 1fr 1fr 1fr;
    gap: 6px;
    background: #ECFDF5;
    border: 1px solid #A7F3D0;
    padding: 10px;
    border-radius: 12px;
    margin-bottom: 16px;
}

.storage-item {
    display: flex;
    flex-direction: column;
    text-align: center;
}

.st-icon {
    font-size: 0.7rem;
    color: #047857;
    font-weight: 600;
}

.st-val {
    font-size: 0.72rem;
    font-weight: 700;
    color: #065F46;
}

/* GTM HACK CARD */
.gtm-hack-card {
    background: #FEFCE8;
    border: 1px dashed #FDE047;
    padding: 12px;
    border-radius: 12px;
    margin-bottom: 18px;
}

.gtm-hack-header {
    display: flex;
    justify-content: space-between;
    margin-bottom: 6px;
}

.gtm-tag {
    font-size: 0.75rem;
    font-weight: 700;
    color: #854D0E;
}

.gtm-author {
    font-size: 0.72rem;
    color: #A16207;
    font-style: italic;
}

.gtm-hack-text {
    font-size: 0.8rem;
    color: #713F12;
    line-height: 1.4;
    margin: 0;
}

.card-action-bar {
    margin-top: auto;
}

.btn-add-planner {
    width: 100%;
    padding: 10px;
    background: #F0FDF4;
    border: 1px solid #DCFCE7;
    color: #15803D;
    border-radius: 12px;
    font-weight: 700;
    font-size: 0.88rem;
    cursor: pointer;
    transition: all 0.2s;
}

.btn-add-planner:hover {
    background: #16A34A;
    color: #FFFFFF;
    border-color: #16A34A;
}

/* 3. STORAGE & PORTION SECTION */
.bg-warm-card {
    background: #F0FDF4;
    padding: 50px 5%;
    border-radius: 30px;
}

.storage-rules-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 24px;
    margin-bottom: 30px;
}

.storage-rule-card {
    background: #FFFFFF;
    border-radius: 20px;
    padding: 24px;
    text-align: center;
    box-shadow: 0 8px 20px rgba(0,0,0,0.04);
}

.rule-icon-circle {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 14px;
    font-size: 1.4rem;
}

.rule-icon-circle.bg-mint { background: #DCFCE7; }
.rule-icon-circle.bg-sage { background: #A7F3D0; }
.rule-icon-circle.bg-olive { background: #FEF08A; }

.storage-rule-card h3 {
    font-size: 1.05rem;
    font-weight: 700;
    margin-bottom: 6px;
}

.rule-time {
    display: inline-block;
    font-size: 0.82rem;
    font-weight: 700;
    color: #16A34A;
    margin-bottom: 10px;
}

.storage-rule-card p {
    font-size: 0.84rem;
    color: #6B7280;
    line-height: 1.4;
    margin: 0;
}

.defrost-tips-banner {
    background: #FFFFFF;
    border-left: 5px solid #16A34A;
    padding: 20px 24px;
    border-radius: 16px;
}

.defrost-content h4 {
    font-weight: 700;
    color: #14532D;
    margin-bottom: 10px;
}

.defrost-content ul {
    margin: 0;
    padding-left: 20px;
    font-size: 0.88rem;
    color: #4B5563;
}

.defrost-content li {
    margin-bottom: 6px;
}

/* 4. MEAL PLANNER GRID */
.planner-wrapper {
    background: #FFFFFF;
    border-radius: 24px;
    border: 1px solid #E5E7EB;
    padding: 24px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.04);
}

.planner-actions-top {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
    flex-wrap: wrap;
    gap: 12px;
}

.planner-status {
    font-weight: 700;
    color: #16A34A;
}

.btn-clear-planner, .btn-print-planner {
    padding: 8px 16px;
    border-radius: 10px;
    font-size: 0.82rem;
    font-weight: 600;
    cursor: pointer;
}

.btn-clear-planner {
    background: #F3F4F6;
    border: 1px solid #D1D5DB;
    color: #4B5563;
}

.btn-print-planner {
    background: #16A34A;
    border: none;
    color: #FFFFFF;
}

.planner-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
    gap: 12px;
}

.planner-day-card {
    background: #F9FAFB;
    border: 1px solid #E5E7EB;
    border-radius: 14px;
    overflow: hidden;
}

.day-header {
    background: #F0FDF4;
    color: #15803D;
    font-weight: 700;
    text-align: center;
    padding: 8px;
    font-size: 0.88rem;
    border-bottom: 1px solid #DCFCE7;
}

.meal-slot {
    padding: 10px;
    border-bottom: 1px stroke #E5E7EB;
    min-height: 70px;
}

.slot-lbl {
    display: block;
    font-size: 0.7rem;
    font-weight: 700;
    color: #9CA3AF;
    margin-bottom: 4px;
}

.slot-content {
    font-size: 0.75rem;
    color: #6B7280;
}

.slot-content strong {
    color: #111827;
}

/* 5. GTM HACKS COMMUNITY */
.gtm-community-grid {
    display: grid;
    grid-template-columns: 0.9fr 1.1fr;
    gap: 30px;
}

.gtm-form-card, .gtm-feed-card {
    background: #FFFFFF;
    border: 1px solid #E5E7EB;
    border-radius: 24px;
    padding: 24px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.04);
}

.gtm-form-card h3, .gtm-feed-card h3 {
    font-size: 1.15rem;
    font-weight: 700;
    color: #111827;
    margin-bottom: 6px;
}

.form-desc {
    font-size: 0.84rem;
    color: #6B7280;
    margin-bottom: 18px;
}

.form-group {
    margin-bottom: 14px;
}

.form-group label {
    display: block;
    font-size: 0.82rem;
    font-weight: 600;
    color: #374151;
    margin-bottom: 6px;
}

.form-group input, .form-group select, .form-group textarea {
    width: 100%;
    padding: 10px 14px;
    border-radius: 10px;
    border: 1px solid #D1D5DB;
    font-family: inherit;
    font-size: 0.88rem;
}

.btn-submit-hack {
    width: 100%;
    padding: 12px;
    background: #16A34A;
    border: none;
    color: #FFFFFF;
    border-radius: 12px;
    font-weight: 700;
    cursor: pointer;
}

.hacks-feed-list {
    display: flex;
    flex-direction: column;
    gap: 16px;
    margin-top: 16px;
}

.feed-item {
    background: #F9FAFB;
    border: 1px solid #E5E7EB;
    border-radius: 14px;
    padding: 14px;
}

.feed-top {
    display: flex;
    gap: 8px;
    align-items: center;
    margin-bottom: 8px;
    flex-wrap: wrap;
}

.author-badge {
    font-size: 0.78rem;
    font-weight: 700;
    color: #15803D;
}

.recipe-target {
    font-size: 0.72rem;
    background: #DCFCE7;
    color: #14532D;
    padding: 2px 8px;
    border-radius: 6px;
}

.feed-time {
    font-size: 0.72rem;
    color: #9CA3AF;
    margin-left: auto;
}

.feed-text {
    font-size: 0.84rem;
    color: #374151;
    line-height: 1.4;
    margin-bottom: 8px;
}

.like-btn {
    background: none;
    border: 1px solid #D1D5DB;
    padding: 4px 10px;
    border-radius: 12px;
    font-size: 0.75rem;
    font-weight: 600;
    color: #4B5563;
    cursor: pointer;
}

.like-btn:hover {
    background: #F0FDF4;
    color: #16A34A;
    border-color: #86EFAC;
}

/* MODAL */
.menu-modal-overlay {
    position: fixed;
    top: 0; left: 0; right: 0; bottom: 0;
    background: rgba(0,0,0,0.5);
    display: none;
    align-items: center;
    justify-content: center;
    z-index: 999;
}

.menu-modal-overlay.active {
    display: flex;
}

.menu-modal-card {
    background: #FFFFFF;
    border-radius: 20px;
    width: 90%;
    max-width: 440px;
    padding: 24px;
    box-shadow: 0 20px 40px rgba(0,0,0,0.2);
}

.modal-head {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 16px;
}

.modal-head h3 { font-size: 1.1rem; font-weight: 700; }
.modal-close-btn { background: none; border: none; font-size: 1.4rem; cursor: pointer; }

.btn-confirm-add {
    width: 100%;
    padding: 12px;
    background: #16A34A;
    border: none;
    color: #FFFFFF;
    border-radius: 12px;
    font-weight: 700;
    cursor: pointer;
    margin-top: 10px;
}

@media (max-width: 900px) {
    .menu-hero-grid, .gtm-community-grid { grid-template-columns: 1fr; }
    .menu-hero-title { font-size: 2.2rem; }
}
</style>

<!-- PAGE INTERACTIVE JAVASCRIPT -->
<script>
// 1. FILTER AGE & NUTRITION TAGS
document.querySelectorAll('.age-tab-btn').forEach(btn => {
    btn.addEventListener('click', () => {
        document.querySelectorAll('.age-tab-btn').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');
        filterRecipes();
    });
});

document.querySelectorAll('.nutri-chip-btn').forEach(btn => {
    btn.addEventListener('click', () => {
        document.querySelectorAll('.nutri-chip-btn').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');
        filterRecipes();
    });
});

function filterRecipes() {
    const ageFilter = document.querySelector('.age-tab-btn.active').dataset.age;
    const nutriFilter = document.querySelector('.nutri-chip-btn.active').dataset.tag;
    const cards = document.querySelectorAll('.recipe-card');

    cards.forEach(card => {
        const cardAge = card.dataset.age;
        const cardTags = card.dataset.tags.split(' ');

        const matchAge = (ageFilter === 'all' || cardAge === ageFilter);
        const matchNutri = (nutriFilter === 'all' || cardTags.includes(nutriFilter));

        if (matchAge && matchNutri) {
            card.style.display = 'flex';
        } else {
            card.style.display = 'none';
        }
    });
}

// 2. PORTION INGREDIENT SCALER
function scaleIngredients(selectElem, recipeId) {
    const scaleFactor = parseFloat(selectElem.value);
    const ingList = document.getElementById(`ing-list-${recipeId}`);
    const qtyElems = ingList.querySelectorAll('.qty');

    qtyElems.forEach(elem => {
        const baseVal = parseFloat(elem.dataset.base);
        const scaledVal = (baseVal * scaleFactor);
        elem.textContent = Number.isInteger(scaledVal) ? scaledVal : scaledVal.toFixed(1);
    });
}

// 3. BOOKMARK TOGGLE
function toggleBookmark(btnElem, recipeName) {
    btnElem.classList.toggle('active');
    if (btnElem.classList.contains('active')) {
        alert(`⭐ "${recipeName}" telah disimpan ke daftar resep favorit Anda!`);
    }
}

// 4. MEAL PLANNER LOGIC
let selectedRecipeTitle = '';
let scheduledCount = 0;

function openPlannerModal(title) {
    selectedRecipeTitle = title;
    document.getElementById('modalRecipeTitle').textContent = title;
    document.getElementById('plannerModal').classList.add('active');
}

function closePlannerModal() {
    document.getElementById('plannerModal').classList.remove('active');
}

function confirmAddToPlanner() {
    const day = document.getElementById('modalDay').value;
    const meal = document.getElementById('modalMeal').value;
    const slotId = `slot-${day}-${meal}`;
    const slotElem = document.getElementById(slotId);

    if (slotElem) {
        slotElem.innerHTML = `<strong>${selectedRecipeTitle}</strong>`;
        scheduledCount++;
        document.getElementById('plannerStatus').textContent = `${scheduledCount} Resep Terjadwal`;
        closePlannerModal();
    }
}

function clearPlanner() {
    const slots = document.querySelectorAll('.slot-content');
    slots.forEach(slot => {
        slot.innerHTML = '<em>+ Klik resep untuk tambah</em>';
    });
    scheduledCount = 0;
    document.getElementById('plannerStatus').textContent = '0 Resep Terjadwal';
}

// 5. SUBMIT COMMUNITY HACK
function submitHack(event) {
    event.preventDefault();
    const author = document.getElementById('hackAuthor').value;
    const recipe = document.getElementById('hackRecipe').value;
    const content = document.getElementById('hackContent').value;

    const feedList = document.getElementById('hacksFeed');
    const newItem = document.createElement('div');
    newItem.className = 'feed-item';
    newItem.innerHTML = `
        <div class="feed-top">
            <span class="author-badge">${author}</span>
            <span class="recipe-target">📌 ${recipe}</span>
            <span class="feed-time">Baru saja</span>
        </div>
        <p class="feed-text">"${content}"</p>
        <div class="feed-footer">
            <button class="like-btn" onclick="likeFeed(this)">👍 Membantu (1)</button>
        </div>
    `;

    feedList.prepend(newItem);
    document.getElementById('hackForm').reset();
    alert('🎉 Terima kasih! Trik dapur Anda telah berhasil dipublikasikan.');
}

function likeFeed(btnElem) {
    let match = btnElem.textContent.match(/\d+/);
    let count = match ? parseInt(match[0]) : 0;
    count++;
    btnElem.textContent = `👍 Membantu (${count})`;
}
</script>

<?= $this->endSection() ?>
