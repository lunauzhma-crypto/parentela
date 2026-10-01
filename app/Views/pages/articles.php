<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<?php
$normalizedCategory = $normalizedCategory ?? $activeCategory ?? 'semua';
$articles = $articles ?? [];
?>

<!-- Link Modular CSS Artikel & Kewenangan Theme -->
<link rel="stylesheet" href="<?= base_url('css/kewenangan.css') ?>?v=<?= file_exists(FCPATH . 'css/kewenangan.css') ? filemtime(FCPATH . 'css/kewenangan.css') : time() ?>">
<link rel="stylesheet" href="<?= base_url('css/articles.css') ?>?v=<?= file_exists(FCPATH . 'css/articles.css') ? filemtime(FCPATH . 'css/articles.css') : time() ?>">

<div class="kew-page-wrapper" style="padding-top: 40px; padding-bottom: 16px;">
    
    <!-- ══════════════════════════════════════════════════════════════
         1. HERO SECTION (TEMA KEWENANGAN)
         ══════════════════════════════════════════════════════════════ -->
    <section class="kew-hero-container" style="margin-bottom: 24px;">
        <div class="kew-hero-grid">
            
            <!-- HERO LEFT CARD (THEME TERRACOTTA / ROSE) -->
            <div class="kew-hero-card-left theme-terracotta">
                <!-- DASHED SVG ACCENT -->
                <svg class="kew-svg-curve" viewBox="0 0 300 200" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M10 100 C 90 20, 210 180, 290 100" stroke="#C85A54" stroke-width="2.5" stroke-dasharray="6 6" opacity="0.3"/>
                    <circle cx="290" cy="100" r="4" fill="#C85A54"/>
                    <circle cx="10" cy="100" r="4" fill="#C85A54"/>
                </svg>

                <div class="kew-chip-tag">
                    <span>📚 Pusat Artikel & Edukasi Orang Tua</span>
                </div>

                <h1 class="kew-hero-title">
                    Panduan & <span class="kew-pill kew-pill-rose">Edukasi</span> Tumbuh Kembang
                </h1>

                <p class="kew-hero-subtitle">
                    Panduan terpercaya berbasis medis, tumbuh kembang, dan nutrisi untuk mendampingi perjalanan pengasuhan buah hati tercinta Anda.
                </p>

                <!-- SEARCH & CONTROL ACTIONS -->
                <div class="art-hero-controls" style="margin-bottom: 24px;">
                    <div class="art-search-box" style="width: 100%; max-width: 100%; margin-bottom: 12px;">
                        <span class="art-search-icon">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                        </span>
                        <input type="text" id="artSearchInput" class="art-search-input" placeholder="Cari artikel, tips parenting, resep MPASI..." autocomplete="off">
                        <button type="button" id="artSearchClear" class="art-search-clear" style="display:none;" aria-label="Hapus pencarian">&times;</button>
                    </div>
                    
                    <div style="display: flex; gap: 10px; flex-wrap: wrap;">
                        <button type="button" class="art-control-btn btn-saved-hub" id="btnOpenSaved" style="background:#ffffff; border:1px solid rgba(200,90,84,0.3); color:#7A2824; border-radius:20px; padding:8px 16px; font-weight:600; font-size:13px; display:inline-flex; align-items:center; gap:6px; cursor:pointer; box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"></path></svg>
                            <span>Konten Tersimpan</span>
                            <span class="saved-badge-count" style="background:#C85A54; color:#fff; font-size:11px; padding:2px 7px; border-radius:10px; font-weight:700; display:none;">0</span>
                        </button>
                        
                        <button type="button" class="art-control-btn btn-filter-modal" id="btnOpenFilter" style="background:#ffffff; border:1px solid rgba(200,90,84,0.3); color:#7A2824; border-radius:20px; padding:8px 16px; font-weight:600; font-size:13px; display:inline-flex; align-items:center; gap:6px; cursor:pointer; box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"></polygon></svg>
                            <span>Filter Lengkap</span>
                        </button>
                    </div>
                </div>

                <!-- QUICK STATS BADGES -->
                <div class="kew-hero-stats">
                    <div class="stat-pill-item">
                        <span class="stat-num">100+</span>
                        <span class="stat-lbl">Artikel Edukatif</span>
                    </div>
                    <div class="stat-pill-divider"></div>
                    <div class="stat-pill-item">
                        <span class="stat-num">Terpercaya</span>
                        <span class="stat-lbl">Berbasis Medis</span>
                    </div>
                    <div class="stat-pill-divider"></div>
                    <div class="stat-pill-item">
                        <span class="stat-num">Lengkap</span>
                        <span class="stat-lbl">Info Tumbuh Kembang</span>
                    </div>
                </div>
            </div>

            <!-- HERO RIGHT CARD PHOTO -->
            <div class="kew-hero-card-right">
                <div class="kew-img-wrapper">
                    <img src="<?= base_url('images/article-hero-family.jpg') ?>?v=<?= time() ?>" alt="Keluarga Parentela & Edukasi Anak" class="kew-hero-img">
                    
                    <!-- OVERLAY BADGES AT BOTTOM -->
                    <div class="kew-img-overlay-bar">
                        <div class="kew-overlay-badge badge-orange">
                            <span class="badge-title">Kesehatan</span>
                            <span class="badge-sub">Info Medis & Gizi</span>
                        </div>
                        <div class="kew-overlay-badge badge-green">
                            <span class="badge-title">Pola Asuh</span>
                            <span class="badge-sub">Tips Parenting</span>
                        </div>
                        <div class="kew-overlay-badge badge-blue">
                            <span class="badge-title">Tumbuh Kembang</span>
                            <span class="badge-sub">Motorik & Kognitif</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- ══════════════════════════════════════════════════════════
         2. KATEGORI ARTIKEL UTAMA (GRID)
         ══════════════════════════════════════════════════════════ -->
    <div class="categories-card-section" style="max-width: 1240px; margin: 0 auto 0;">
        <div class="categories-grid">
            <!-- 1. Semua Kategori -->
            <a href="javascript:void(0)" class="category-card <?= ($normalizedCategory === 'semua') ? 'active' : '' ?>" data-category="semua">
                <div class="category-icon-wrap">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                        <rect x="3" y="3" width="7" height="7" rx="1.5" />
                        <circle cx="17.5" cy="6.5" r="3.5" />
                        <polygon points="6.5,14 10,21 3,21" />
                        <rect x="14" y="14" width="7" height="7" rx="1.5" />
                    </svg>
                </div>
                <span class="category-title">Semua Kategori</span>
            </a>

            <!-- 2. Tumbuh Kembang -->
            <a href="javascript:void(0)" class="category-card <?= ($normalizedCategory === 'tumbuh-kembang') ? 'active' : '' ?>" data-category="tumbuh-kembang">
                <div class="category-icon-wrap">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="22 7 13.5 15.5 8.5 10.5 2 17"></polyline>
                        <polyline points="16 7 22 7 22 13"></polyline>
                    </svg>
                </div>
                <span class="category-title">Tumbuh Kembang</span>
            </a>

            <!-- 3. Kesehatan -->
            <a href="javascript:void(0)" class="category-card <?= ($normalizedCategory === 'kesehatan') ? 'active' : '' ?>" data-category="kesehatan">
                <div class="category-icon-wrap">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                        <polyline points="7 12 10 12 11 9 13 15 14 12 17 12"></polyline>
                    </svg>
                </div>
                <span class="category-title">Kesehatan</span>
            </a>

            <!-- 4. Kebutuhan Khusus -->
            <a href="javascript:void(0)" class="category-card <?= ($normalizedCategory === 'kebutuhan-khusus') ? 'active' : '' ?>" data-category="kebutuhan-khusus">
                <div class="category-icon-wrap">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="9" cy="7" r="4"></circle>
                        <path d="M3 21v-2a4 4 0 0 1 4-4h4a4 4 0 0 1 4 4v2"></path>
                        <circle cx="18" cy="11" r="3"></circle>
                        <path d="M15 21v-1.5a3 3 0 0 1 3-3h1"></path>
                    </svg>
                </div>
                <span class="category-title">Kebutuhan Khusus</span>
            </a>

            <!-- 5. Kebugaran -->
            <a href="javascript:void(0)" class="category-card <?= ($normalizedCategory === 'kebugaran') ? 'active' : '' ?>" data-category="kebugaran">
                <div class="category-icon-wrap">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="5" r="2.5"></circle>
                        <path d="M6 21v-5l3-3 2 4 4-6 3 2"></path>
                        <path d="M12 11l2-3 4 1"></path>
                    </svg>
                </div>
                <span class="category-title">Kebugaran</span>
            </a>

            <!-- 6. Parenting -->
            <a href="javascript:void(0)" class="category-card <?= ($normalizedCategory === 'parenting') ? 'active' : '' ?>" data-category="parenting">
                <div class="category-icon-wrap">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"></path>
                    </svg>
                </div>
                <span class="category-title">Parenting</span>
            </a>

            <!-- 7. Gaya Hidup -->
            <a href="javascript:void(0)" class="category-card <?= ($normalizedCategory === 'gaya-hidup') ? 'active' : '' ?>" data-category="gaya-hidup">
                <div class="category-icon-wrap">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect>
                        <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path>
                    </svg>
                </div>
                <span class="category-title">Gaya Hidup</span>
            </a>

            <!-- 8. Video Edukasi -->
            <a href="javascript:void(0)" class="category-card <?= ($normalizedCategory === 'video-edukasi') ? 'active' : '' ?>" data-category="video-edukasi">
                <div class="category-icon-wrap">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="2" y="4" width="20" height="15" rx="2"></rect>
                        <polygon points="10 9 15 12 10 15 10 9" fill="currentColor"></polygon>
                        <line x1="8" y1="21" x2="16" y2="21"></line>
                    </svg>
                </div>
                <span class="category-title">Video Edukasi</span>
            </a>

        </div>
    </div>

</div>

<!-- ══════════════════════════════════════════════════════════════
     4. GRID KARTU ARTIKEL DESKTOP (PC)
     ══════════════════════════════════════════════════════════════ -->
<main class="articles-main-section">
    <div class="container">

        <div class="articles-grid" id="articlesGrid">
            <?php foreach ($articles as $art): 
                $artLinkSlug = !empty($art['slug']) ? $art['slug'] : $art['id'];
                $subtagsArr = is_array($art['subtags']) ? $art['subtags'] : (array_filter(explode(' ', (string)$art['subtags'])));
            ?>
                <article 
                    class="art-card"
                    data-id="<?= esc($art['id']) ?>"
                    data-category="<?= esc($art['category_slug']) ?>"
                    data-age="<?= esc($art['age_slug']) ?>"
                    data-type="<?= esc($art['type']) ?>"
                    data-subtags="<?= esc(implode(' ', $subtagsArr)) ?>"
                    data-title="<?= esc($art['title']) ?>"
                    data-saved-type="<?= esc($art['saved_type']) ?>"
                >
                    <!-- Card Thumbnail Image -->
                    <div class="art-card-thumb-wrap">
                        <a href="<?= base_url('articles/detail/' . $artLinkSlug) ?>" title="<?= esc($art['title']) ?>">
                            <img 
                                src="<?= esc($art['image']) ?>" 
                                alt="<?= esc($art['title']) ?>" 
                                class="art-card-img" 
                                loading="lazy"
                            />
                        </a>

                        <!-- Floating Content Type Badge -->
                        <?php if ($art['type'] === 'video'): ?>
                            <span class="art-type-badge badge-video">
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="currentColor"><polygon points="5 3 19 12 5 21 5 3"></polygon></svg>
                                <span>Video</span>
                            </span>
                        <?php else: ?>
                            <span class="art-type-badge">
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path></svg>
                                <span>Artikel</span>
                            </span>
                        <?php endif; ?>

                        <!-- Floating Age Range Badge -->
                        <span class="art-age-badge">
                            <?= esc($art['age_label']) ?>
                        </span>
                    </div>

                    <!-- Card Body -->
                    <div class="art-card-body">
                        <!-- Subtags Pills -->
                        <div class="art-card-tags">
                            <?php foreach ($subtagsArr as $st): ?>
                                <span class="art-tag-pill"><?= esc($st) ?></span>
                            <?php endforeach; ?>
                        </div>

                        <!-- Title -->
                        <h3 class="art-card-title">
                            <a href="<?= base_url('articles/detail/' . $artLinkSlug) ?>" style="color: inherit; text-decoration: none;">
                                <?= esc($art['title']) ?>
                            </a>
                        </h3>

                        <!-- Excerpt -->
                        <p class="art-card-excerpt"><?= esc($art['excerpt']) ?></p>

                        <!-- Card Footer Meta -->
                        <div class="art-card-footer">
                            <span class="art-card-author">
                                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 4-4H8a4 4 0 0 4-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                                <?= esc($art['author']) ?>
                            </span>
                            <a href="<?= base_url('articles/detail/' . $artLinkSlug) ?>" style="color: var(--color-primary); font-weight: 600; text-decoration: none; font-size: 12.5px; display: inline-flex; align-items: center; gap: 4px;">
                                <span>Lihat <?= esc($art['type_label']) ?></span> →
                            </a>
                        </div>
                    </div>
                </article>
            <?php endforeach; ?>

            <!-- State Ketika Tidak Ada Hasil -->
            <div class="art-no-results" id="artNoResults" style="display: none;">
                <div class="art-no-results-icon">
                    <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="color: var(--art-muted);">
                        <circle cx="11" cy="11" r="8"></circle>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                    </svg>
                </div>
                <h3>Tidak Ada Konten yang Sesuai</h3>
                <p>Coba gunakan kata kunci lain atau setel ulang filter usia dan kategori.</p>
                <button type="button" class="btn-reset-filters" onclick="resetAllFilters()">
                    <span>Setel Ulang Filter</span>
                </button>
            </div>
        </div>

    </div>
</main>

<?php if (session()->getFlashdata('submitted')): ?>
    <div style="max-width: 1240px; margin: 20px auto; padding: 16px 20px; background: #dcfce7; border: 1px solid #86efac; color: #166534; border-radius: 14px; font-weight: 600; font-size: 14px; display: flex; align-items: center; gap: 10px; box-shadow: 0 4px 12px rgba(0,0,0,0.03);">
        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
        <span><?= session()->getFlashdata('submitted') ?></span>
    </div>
<?php endif; ?>

<!-- ══════════════════════════════════════════════════════════════
     5. BANNER AJUKAN / SUBMIT ARTIKEL (BOTTOM SECTION)
     ══════════════════════════════════════════════════════════════ -->
<section class="art-submit-banner-section" style="max-width: 1240px; margin: 30px auto 40px; padding: 0 15px;">
    <div class="art-submit-card" style="background: linear-gradient(135deg, #7A2824 0%, #C85A54 100%); border-radius: 20px; padding: 36px 32px; color: #ffffff; display: flex; align-items: center; justify-content: space-between; gap: 24px; flex-wrap: wrap; box-shadow: 0 10px 30px rgba(122,40,36,0.18);">
        <div style="flex: 1; min-width: 280px;">
            <div style="display: inline-flex; align-items: center; gap: 6px; background: rgba(255,255,255,0.2); backdrop-filter: blur(4px); padding: 4px 12px; border-radius: 20px; font-size: 12px; font-weight: 700; margin-bottom: 12px;">
                ✍️ Kontribusi Penulis & Orang Tua
            </div>
            <h2 style="font-family: 'Playfair Display', serif; font-size: 26px; font-weight: 700; line-height: 1.3; margin-bottom: 8px; color: #ffffff;">
                Ingin menambahkan artikelmu ke dalam Parentela?
            </h2>
            <p style="font-size: 14px; opacity: 0.92; max-width: 640px; line-height: 1.6; color: rgba(255,255,255,0.95);">
                Bagikan wawasan, tips pengasuhan, atau pengalaman berharga Anda untuk membantu ribuan keluarga Indonesia. Kirimkan tulisan Anda dan tim Administrator kami akan meninjau kelayakannya.
            </p>
        </div>
        <div>
            <button type="button" class="btn-open-submit-modal" id="btnOpenSubmitArticle" data-logged-in="<?= session()->get('is_logged_in') ? '1' : '0' ?>" style="background: #ffffff; color: #7A2824; border: none; padding: 14px 28px; border-radius: 30px; font-weight: 700; font-size: 14px; cursor: pointer; display: inline-flex; align-items: center; gap: 8px; box-shadow: 0 4px 14px rgba(0,0,0,0.15); transition: all 0.2s ease;">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                <span>Submit Artikel Di Sini</span>
            </button>
        </div>
    </div>
</section>

<!-- ══════════════════════════════════════════════════════════════
     6. MODAL FORM SUBMIT ARTIKEL USER
     ══════════════════════════════════════════════════════════════ -->
<div class="art-modal-overlay" id="artSubmitModal" role="dialog" aria-modal="true" aria-labelledby="submitModalTitle">
    <div class="art-modal-box" style="max-width: 680px;">
        <div class="art-modal-header" style="border-bottom: 1px solid #f1f5f9; padding-bottom: 14px;">
            <div>
                <h3 class="art-modal-title" id="submitModalTitle" style="font-size: 20px; color: #7A2824; font-family: 'Playfair Display', serif;">Ajukan Artikel ke Parentela</h3>
                <p style="font-size: 12px; color: #64748b; margin-top: 2px;">Isi metadata dan materi artikel Anda untuk ditinjau oleh Administrator.</p>
            </div>
            <button type="button" class="btn-modal-close" id="btnCloseSubmitModal" aria-label="Tutup modal">&times;</button>
        </div>

        <form action="<?= base_url('articles/submit') ?>" method="post" enctype="multipart/form-data">
            <div class="art-modal-body" style="padding: 20px 24px; max-height: 70vh; overflow-y: auto;">
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 14px; margin-bottom: 14px;">
                    <div>
                        <label style="font-weight: 600; font-size: 13px; color: #334155; display: block; margin-bottom: 6px;">Nama Penulis / Pengirim *</label>
                        <input type="text" name="author" required placeholder="Contoh: Ayah Budi / dr. Sarah" style="width: 100%; padding: 10px 14px; border: 1px solid #cbd5e1; border-radius: 10px; font-size: 13.5px; box-sizing: border-box;">
                    </div>
                    <div>
                        <label style="font-weight: 600; font-size: 13px; color: #334155; display: block; margin-bottom: 6px;">Email Penulis *</label>
                        <input type="email" name="author_email" required placeholder="budi@example.com" style="width: 100%; padding: 10px 14px; border: 1px solid #cbd5e1; border-radius: 10px; font-size: 13.5px; box-sizing: border-box;">
                    </div>
                </div>

                <div style="margin-bottom: 14px;">
                    <label style="font-weight: 600; font-size: 13px; color: #334155; display: block; margin-bottom: 6px;">Judul Artikel *</label>
                    <input type="text" name="title" required placeholder="Contoh: Tips Menjaga Pola Tidur Bayi Usia 3 Bulan" style="width: 100%; padding: 10px 14px; border: 1px solid #cbd5e1; border-radius: 10px; font-size: 13.5px; box-sizing: border-box;">
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 12px; margin-bottom: 14px;">
                    <div>
                        <label style="font-weight: 600; font-size: 13px; color: #334155; display: block; margin-bottom: 6px;">Kategori *</label>
                        <select name="category_slug" required style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 10px; font-size: 13px; background: #fff; box-sizing: border-box;">
                            <option value="parenting">Parenting</option>
                            <option value="tumbuh-kembang">Tumbuh Kembang</option>
                            <option value="kesehatan">Kesehatan</option>
                            <option value="kebutuhan-khusus">Kebutuhan Khusus</option>
                            <option value="kebugaran">Kebugaran</option>
                            <option value="gaya-hidup">Gaya Hidup</option>
                            <option value="video-edukasi">Video Edukasi</option>
                        </select>
                    </div>
                    <div>
                        <label style="font-weight: 600; font-size: 13px; color: #334155; display: block; margin-bottom: 6px;">Target Usia *</label>
                        <select name="age_slug" required style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 10px; font-size: 13px; background: #fff; box-sizing: border-box;">
                            <option value="semua-usia">Semua Usia</option>
                            <option value="hamil-trimester-1">Hamil Trimester 1</option>
                            <option value="hamil-trimester-2">Hamil Trimester 2</option>
                            <option value="hamil-trimester-3">Hamil Trimester 3</option>
                            <option value="pasca-persalinan">Pasca Persalinan</option>
                            <option value="0-6-bulan">0 - 6 bulan</option>
                            <option value="6-12-bulan">6 - 12 bulan</option>
                            <option value="1-2-tahun">1 - 2 tahun</option>
                            <option value="2-5-tahun">2 - 5 tahun</option>
                            <option value="5-12-tahun">5 - 12 tahun</option>
                            <option value="lebih-12-tahun">> 12 tahun</option>
                        </select>
                    </div>
                    <div>
                        <label style="font-weight: 600; font-size: 13px; color: #334155; display: block; margin-bottom: 6px;">Tipe Konten *</label>
                        <select name="type" required style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 10px; font-size: 13px; background: #fff; box-sizing: border-box;">
                            <option value="artikel">Artikel Bacaan</option>
                            <option value="video">Video Edukasi</option>
                        </select>
                    </div>
                </div>

                <div style="margin-bottom: 14px;">
                    <label style="font-weight: 600; font-size: 13px; color: #334155; display: block; margin-bottom: 6px;">Ringkasan Singkat (Excerpt) *</label>
                    <textarea name="excerpt" rows="2" required placeholder="Tulis ringkasan 2-3 kalimat mengenai isi artikel..." style="width: 100%; padding: 10px 14px; border: 1px solid #cbd5e1; border-radius: 10px; font-size: 13.5px; box-sizing: border-box;"></textarea>
                </div>

                <div style="margin-bottom: 14px;">
                    <label style="font-weight: 600; font-size: 13px; color: #334155; display: block; margin-bottom: 6px;">Isi Artikel Lengkap / Link Video *</label>
                    <textarea name="content" rows="6" required placeholder="Tuliskan materi artikel lengkap atau selipkan tautan video..." style="width: 100%; padding: 10px 14px; border: 1px solid #cbd5e1; border-radius: 10px; font-size: 13.5px; box-sizing: border-box;"></textarea>
                </div>

                <div style="margin-bottom: 10px;">
                    <label style="font-weight: 600; font-size: 13px; color: #334155; display: block; margin-bottom: 6px;">Unggah Foto Sampul / Header (Opsional)</label>
                    <input type="file" name="image" accept="image/*" style="font-size: 13px;">
                    <p style="font-size: 11.5px; color: #94a3b8; margin-top: 4px;">Format JPG, PNG, WEBP. Jika dikosongkan, tim Administrator akan menambahkan gambar sampul.</p>
                </div>
            </div>

            <div class="art-modal-footer" style="padding: 14px 24px; border-top: 1px solid #f1f5f9; display: flex; justify-content: flex-end; gap: 10px;">
                <button type="button" class="btn-modal-reset" id="btnCancelSubmitModal" style="padding: 8px 18px; border-radius: 20px;">Batal</button>
                <button type="submit" class="btn-modal-submit" style="background: #C85A54; color: #fff; padding: 9px 24px; border-radius: 20px; font-weight: 700; border: none; cursor: pointer;">Kirimkan Artikel</button>
            </div>
        </form>
    </div>
</div>

<!-- ══════════════════════════════════════════════════════════════
     7. MODAL FILTER LENGKAP (DESKTOP MODAL)
     ══════════════════════════════════════════════════════════════ -->
<div class="art-modal-overlay" id="artFilterModal" role="dialog" aria-modal="true" aria-labelledby="filterModalTitle">
    <div class="art-modal-box">
        <!-- Modal Header -->
        <div class="art-modal-header">
            <h3 class="art-modal-title" id="filterModalTitle">Filter Konten</h3>
            <div class="art-modal-actions">
                <button type="button" class="btn-modal-reset" id="btnResetFilter">Reset</button>
                <button type="button" class="btn-modal-close" id="btnCloseFilter" aria-label="Tutup filter">&times;</button>
            </div>
        </div>

        <!-- Modal Body -->
        <div class="art-modal-body">
            <!-- Bagian 1: Rentang Usia -->
            <div class="modal-section-title">
                Rentang Usia
            </div>
            <div class="modal-options-grid" id="modalAgeOptions">
                <button type="button" class="modal-opt-btn active" data-val="semua-usia">Semua Usia</button>
                <button type="button" class="modal-opt-btn" data-val="hamil-trimester-1">Hamil Trimester 1</button>
                <button type="button" class="modal-opt-btn" data-val="hamil-trimester-2">Hamil Trimester 2</button>
                <button type="button" class="modal-opt-btn" data-val="hamil-trimester-3">Hamil Trimester 3</button>
                <button type="button" class="modal-opt-btn" data-val="pasca-persalinan">Pasca Persalinan</button>
                <button type="button" class="modal-opt-btn" data-val="0-6-bulan">0 - 6 bulan</button>
                <button type="button" class="modal-opt-btn" data-val="6-12-bulan">6 - 12 bulan</button>
                <button type="button" class="modal-opt-btn" data-val="1-2-tahun">1 - 2 tahun</button>
                <button type="button" class="modal-opt-btn" data-val="2-5-tahun">2 - 5 tahun</button>
                <button type="button" class="modal-opt-btn" data-val="5-12-tahun">5 - 12 tahun</button>
                <button type="button" class="modal-opt-btn" data-val="lebih-12-tahun">> 12 tahun</button>
            </div>

            <!-- Bagian 2: Tipe Konten -->
            <div class="modal-section-title">
                Tipe Konten
            </div>
            <div class="modal-options-grid grid-3-col" id="modalTypeOptions">
                <button type="button" class="modal-opt-btn active" data-val="semua">Semua Tipe</button>
                <button type="button" class="modal-opt-btn" data-val="artikel">Artikel</button>
                <button type="button" class="modal-opt-btn" data-val="video">Video</button>
            </div>
        </div>

        <!-- Modal Footer -->
        <div class="art-modal-footer">
            <button type="button" class="btn-modal-submit" id="btnApplyFilter">Tampilkan Konten</button>
        </div>
    </div>
</div>


<!-- ══════════════════════════════════════════════════════════════
     MODAL KONTEN TERSIMPAN (SAVED ARTICLES HUB)
     ══════════════════════════════════════════════════════════════ -->
<div class="art-modal-overlay" id="artSavedModal" role="dialog" aria-modal="true" aria-labelledby="savedModalTitle">
    <div class="art-modal-box saved-modal-box">
        <!-- Modal Header -->
        <div class="art-modal-header">
            <h3 class="art-modal-title" id="savedModalTitle">Konten Tersimpan</h3>
            <button type="button" class="btn-modal-close" id="btnCloseSaved" aria-label="Tutup konten tersimpan">&times;</button>
        </div>

        <!-- Modal Body -->
        <div class="art-modal-body">
            <!-- Tabs -->
            <div class="saved-tabs-row">
                <button type="button" class="saved-tab-btn active" data-tab="artikel">Artikel</button>
                <button type="button" class="saved-tab-btn" data-tab="video">Video</button>
            </div>

            <!-- List Konten Tersimpan -->
            <div class="saved-items-list" id="savedItemsContainer"></div>

            <!-- Empty State -->
            <div class="saved-empty-box" id="savedEmptyState" style="display: none;">
                <div style="font-size: 48px; margin-bottom: 12px;">🔖</div>
                <h3>Belum Ada Konten Tersimpan</h3>
                <p>Yuk, telusuri dan simpan artikel atau panduan favorit AyBun!</p>
                <button type="button" class="btn-explore-articles" onclick="exploreArticlesFromEmpty()">
                    <span>Lihat Artikel</span>
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Floating Scroll to Top -->
<button type="button" class="art-scroll-top-btn" id="artScrollTopBtn" title="Kembali ke atas" aria-label="Kembali ke atas">
    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
        <line x1="12" y1="19" x2="12" y2="5"></line>
        <polyline points="5 12 12 5 19 12"></polyline>
    </svg>
</button>

<!-- Toast Container -->
<div class="art-toast-container" id="artToastContainer"></div>

<!-- Link Modular JS Artikel -->
<script src="<?= base_url('js/articles.js') ?>?v=<?= file_exists(FCPATH . 'js/articles.js') ? filemtime(FCPATH . 'js/articles.js') : time() ?>"></script>

<?= $this->endSection() ?>
