<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<!-- GOOGLE FONTS IMPORT (OUTFIT & CAVEAT LIKE KEWANANGAN) -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Caveat:wght@700&family=Outfit:wght@400;500;600;700;800&family=Playfair+Display:ital,wght@0,600;0,800;1,600&display=swap" rel="stylesheet">

<div class="nanny-page-wrapper">
    
    <!-- 1. TOP HERO SECTION -->
    <section class="nanny-hero-container">
        <div class="nanny-hero-grid">
            
            <!-- HERO LEFT CARD -->
            <div class="nanny-hero-card-left">
                <!-- DASHED SVG ACCENT (MATCHING KEWANANGAN STYLE) -->
                <svg class="nanny-svg-curve" viewBox="0 0 300 200" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M10 100 C 90 20, 210 180, 290 100" stroke="#EC4899" stroke-width="2.5" stroke-dasharray="6 6" opacity="0.25"/>
                    <circle cx="290" cy="100" r="4" fill="#EC4899"/>
                    <circle cx="10" cy="100" r="4" fill="#EC4899"/>
                </svg>

                <div class="nanny-chip-tag">
                    <span>🍼 Layanan Nanny & Pengasuh Berizin</span>
                </div>

                <h1 class="nanny-hero-title">
                    Mencari Nanny & <span class="nanny-pill nanny-pill-pink">Pengasuh Terpercaya</span>
                </h1>

                <p class="nanny-hero-subtitle">
                    Solusi pendampingan anak penuh kasih, aman, dan tersertifikasi untuk ketenangan hati Ayah & Bunda dalam merawat sang buah hati di Surabaya & sekitarnya.
                </p>

                <!-- QUICK STATS BADGES (MATCHING KEWANANGAN HERO STATS) -->
                <div class="nanny-hero-stats">
                    <div class="stat-pill-item">
                        <span class="stat-num">100%</span>
                        <span class="stat-lbl">Pengasuh Terverifikasi</span>
                    </div>
                    <div class="stat-pill-divider"></div>
                    <div class="stat-pill-item">
                        <span class="stat-num">SKCK</span>
                        <span class="stat-lbl">Catatan Kepolisian Lengkap</span>
                    </div>
                    <div class="stat-pill-divider"></div>
                    <div class="stat-pill-item">
                        <span class="stat-num">P3K & CPR</span>
                        <span class="stat-lbl">Pertolongan Pertama</span>
                    </div>
                </div>
            </div>

            <!-- HERO RIGHT CARD PHOTO -->
            <div class="nanny-hero-card-right">
                <div class="nanny-img-wrapper">
                    <img src="<?= base_url('images/nanny-hero.jpg') ?>" alt="Layanan Nanny & Pengasuh Terpercaya Parentela" class="nanny-hero-img">
                    
                    <!-- OVERLAY BADGES AT BOTTOM -->
                    <div class="nanny-img-overlay-bar">
                        <div class="nanny-overlay-badge badge-blue">
                            <span class="badge-title">Tersertifikasi</span>
                            <span class="badge-sub">Verifikasi SKCK & Pengalaman</span>
                        </div>
                        <div class="nanny-overlay-badge badge-pink">
                            <span class="badge-title">Penuh Kasih</span>
                            <span class="badge-sub">Stimulasi Tumbuh Kembang</span>
                        </div>
                        <div class="nanny-overlay-badge badge-green">
                            <span class="badge-title">Kenyamanan</span>
                            <span class="badge-sub">Jurnal Harian & SOP Kerja</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- 1.5 - 3 CARDS SECTION (DI BAWAH HERO) -->
    <section class="nanny-lengkap-section">
        <div class="lengkap-cards-grid">
            
            <!-- CARD 1: PENCARIAN -->
            <div class="lengkap-card card-pink-tilted">
                <div class="lengkap-sticker-badge badge-pink-sticker">Pencarian</div>
                
                <h3 class="lengkap-card-title">
                    1. DIREKTORI & LAYANAN PENCARIAN
                </h3>

                <div class="lengkap-subcards-list">
                    <div class="lengkap-subcard">
                        <div class="subcard-content">
                            <span class="dot-bullet dot-pink"></span>
                            <div>
                                <strong>Profil Nanny/Pengasuh Tersertifikasi:</strong> List profil ART/Nanny lengkap dengan pengalaman, keahlian khusus (misal: penanganan <em>newborn</em> atau <em>toddler</em>), serta status verifikasi latar belakang.
                            </div>
                        </div>
                    </div>

                    <div class="lengkap-subcard">
                        <div class="subcard-content">
                            <span class="dot-bullet dot-pink"></span>
                            <div>
                                <strong>Direktori Yayasan/Penyalur:</strong> Daftar rekomendasi agen atau yayasan penyalur pengasuh terpercaya lengkap dengan ulasan dari sesama orang tua.
                            </div>
                        </div>
                        <div class="subcard-action">
                            <a href="#direktori-penyalur" class="nanny-dl-btn btn-pink-outline">
                                🔍 Lihat Daftar Yayasan & Penyalur 🎯
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- CARD 2: HIRING GUIDE -->
            <div class="lengkap-card card-green-tilted">
                <div class="lengkap-sticker-badge badge-green-sticker">Hiring Guide</div>
                
                <h3 class="lengkap-card-title">
                    2. PANDUAN REKRUTMEN & SELEKSI
                </h3>

                <div class="lengkap-subcards-list">
                    <div class="lengkap-subcard">
                        <div class="subcard-content">
                            <span class="dot-bullet dot-green"></span>
                            <div>
                                <strong>Daftar Pertanyaan Wawancara:</strong> Panduan pertanyaan penting saat menginterviu calon pengasuh (kebiasaan pribadi, penanganan saat anak <em>tantrum</em>, hingga kondisi darurat).
                            </div>
                        </div>
                        <div class="subcard-action">
                            <a href="<?= base_url('downloads/panduan-wawancara-nanny.pdf') ?>" download class="nanny-dl-btn btn-green-outline">
                                🖨️ Cetak / Download Panduan Wawancara
                            </a>
                        </div>
                    </div>

                    <div class="lengkap-subcard">
                        <div class="subcard-content">
                            <span class="dot-bullet dot-green"></span>
                            <div>
                                <strong>Tips Background Check:</strong> Cara memeriksa rekam jejak, referensi majikan sebelumnya, serta verifikasi identitas (KTP/SKCK).
                            </div>
                        </div>
                    </div>

                    <div class="lengkap-subcard">
                        <div class="subcard-content">
                            <span class="dot-bullet dot-green"></span>
                            <div>
                                <strong>Fitur Red Flags & Green Flags:</strong> Panduan mengenali tanda-tanda pengasuh yang baik maupun yang berisiko.
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- CARD 3: DOKUMEN -->
            <div class="lengkap-card card-blue-tilted">
                <div class="lengkap-sticker-badge badge-blue-sticker">Dokumen</div>
                
                <h3 class="lengkap-card-title">
                    3. <em>TOOLKIT</em>, SOP, & TEMPLATE DOKUMEN
                </h3>

                <div class="lengkap-subcards-list">
                    <div class="lengkap-subcard">
                        <div class="subcard-content">
                            <span class="dot-bullet dot-blue"></span>
                            <div>
                                <strong>Draft Kontrak Kerja:</strong> Template Surat Perjanjian Kerja (SPK) antara orang tua dan pengasuh mencakup hak, kewajiban, jam kerja, dan periode percobaan.
                            </div>
                        </div>
                        <div class="subcard-action">
                            <a href="<?= base_url('downloads/kontrak-kerja-nanny.pdf') ?>" download class="nanny-dl-btn btn-blue-outline">
                                🖨️ Cetak / Download SPK
                            </a>
                        </div>
                    </div>

                    <div class="lengkap-subcard">
                        <div class="subcard-content">
                            <span class="dot-bullet dot-blue"></span>
                            <div>
                                <strong>Jurnal Harian Pengasuhan:</strong> Template harian untuk dicetak/diisi pengasuh (jam makan, waktu tidur, BAB/BAK, aktivitas, dan riwayat obat).
                            </div>
                        </div>
                        <div class="subcard-action">
                            <a href="<?= base_url('downloads/jurnal-harian-pengasuhan.pdf') ?>" download class="nanny-dl-btn btn-blue-outline">
                                🖨️ Cetak / Download Jurnal
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- 4.5 DIREKTORI YAYASAN & AGEN PENYALUR NANNY DI INDONESIA -->
    <section class="nanny-agencies-section" id="direktori-penyalur">
        <div class="nanny-chip-tag chip-center">
            <span>Direktori Agen & Yayasan Terverifikasi</span>
        </div>
        <h2 class="nanny-section-title text-center">
            Daftar Tempat & Yayasan <span class="nanny-pill nanny-pill-green">Penyalur Nanny di Indonesia</span>
        </h2>
        <p class="nanny-section-subtitle text-center">
            Rujukan resmi lembaga pelatihan kerja (LPK), yayasan penyalur ART/Nanny, dan platform digital terpercaya untuk kebutuhan keluarga Anda.
        </p>

        <!-- SEARCH BAR FOR AGENCIES -->
        <div class="agency-search-wrapper">
            <div class="agency-search-box">
                <span class="search-icon">🔍</span>
                <input type="text" id="agencySearchInput" placeholder="Cari nama tempat, yayasan, lokasi (misal: Surabaya, LPK, Babysits)..." autocomplete="off" class="agency-search-input">
                <button type="button" id="clearSearchBtn" class="clear-search-btn" style="display:none;" title="Hapus pencarian">✕</button>
            </div>
            
            <!-- QUICK FILTER CHIPS -->
            <div class="agency-filter-chips">
                <button type="button" class="filter-chip active" data-filter="all">Semua Yayasan</button>
                <button type="button" class="filter-chip" data-filter="surabaya">Surabaya & Jatim</button>
                <button type="button" class="filter-chip" data-filter="jabodetabek">Jabodetabek & Jawa</button>
                <button type="button" class="filter-chip" data-filter="lpk">LPK & Resmi</button>
                <button type="button" class="filter-chip" data-filter="online">Platform Online</button>
            </div>
        </div>

        <!-- NO RESULTS MESSAGE -->
        <div id="noAgenciesResult" class="no-agencies-found" style="display:none;">
            <span class="no-result-icon">🔎</span>
            <h4>Yayasan Tidak Ditemukan</h4>
            <p>Tidak ada agen atau yayasan penyalur yang sesuai dengan kata kunci "<span id="searchQueryText" style="font-weight:700; color:#15803D;"></span>". Coba kata kunci lain seperti <em>Surabaya</em>, <em>LPK</em>, atau <em>Yayasan</em>.</p>
        </div>

        <div class="nanny-agencies-grid" id="agenciesGrid">
            <?php
            $agencies = [
                [
                    'name' => 'Babysits Indonesia',
                    'url' => 'https://www.babysits.id',
                    'tag' => '🌐 Platform Digital Global',
                    'loc' => '📍 Nasional / Seluruh Indonesia',
                    'badge' => 'Platform Online',
                    'desc' => 'Komunitas online pencarian babysitter dan pengasuh anak terverifikasi dengan ulasan transparan dari sesama orang tua.'
                ],
                [
                    'name' => 'Yayasan Citra Bunda Nanny',
                    'url' => 'https://www.citrabunda.id',
                    'tag' => '🏢 Yayasan Baby Sitter Resmi',
                    'loc' => '📍 Jabodetabek & Jawa',
                    'badge' => 'Yayasan Resmi',
                    'desc' => 'Yayasan penyalur pengasuh anak profesional & baby sitter tersertifikasi dengan masa garansi penempatan.'
                ],
                [
                    'name' => 'LPK Permata Kasih Bunda Indonesia',
                    'url' => 'https://mynanny.co.id',
                    'tag' => '🎓 LPK & Penyalur Nanny',
                    'loc' => '📍 Surabaya & Nasional',
                    'badge' => 'LPK Tersertifikasi',
                    'desc' => 'Lembaga pelatihan kerja (LPK) resmi penyedia nanny profesional terlatih pertolongan pertama (P3K) dan perawatan newborn.'
                ],
                [
                    'name' => 'Yayasan Mutiara Bunda',
                    'url' => 'https://cvmutiarabunda.com',
                    'tag' => '🏢 CV / Yayasan Penyalur',
                    'loc' => '📍 Indonesia',
                    'badge' => 'Terverifikasi',
                    'desc' => 'Penyedia jasa baby sitter, ners lansia, dan ART terpercaya dengan garansi penggantian dan seleksi identitas ketat.'
                ],
                [
                    'name' => 'PT Permata Kasih Anugerah',
                    'url' => 'https://permatakasihanugerah.com/about',
                    'tag' => '🏢 PT Penyalur Tenaga Kerja',
                    'loc' => '📍 Jawa & Sumatra',
                    'badge' => 'PT Resmi',
                    'desc' => 'Perusahaan penyalur pekerja pengasuhan anak dan asisten rumah tangga berizin resmi Kemenaker.'
                ],
                [
                    'name' => 'PT Bunda Mandiri Sejahtera',
                    'url' => 'https://ptbms.carrd.co',
                    'tag' => '🏢 Agen Penyalur Terdaftar',
                    'loc' => '📍 Indonesia',
                    'badge' => 'Resmi Kemenaker',
                    'desc' => 'Layanan penyalur pengasuh anak, perawat lansia, dan asisten rumah tangga berpengalaman dengan SKCK valid.'
                ],
                [
                    'name' => 'PT Jasa Mandiri',
                    'url' => 'https://penyalurkerja.com',
                    'tag' => '🏢 Agen Penyalur Kerja',
                    'loc' => '📍 Surabaya & Jawa Timur',
                    'badge' => 'Agen Surabaya',
                    'desc' => 'Agensi penempatan tenaga kerja resmi di Surabaya untuk sektor pengasuhan anak dan rumah tangga.'
                ],
                [
                    'name' => 'PT Dani Mandiri',
                    'url' => 'https://danimandiri.com',
                    'tag' => '🏢 PT Penyalur ART & Nanny',
                    'loc' => '📍 Nasional',
                    'badge' => '10+ Thn Pengalaman',
                    'desc' => 'Penyalur ART & Nanny berpengalaman lebih dari 10 tahun dengan jaminan seleksi latar belakang ketat.'
                ],
                [
                    'name' => 'PT Anak Sejahtera Surabaya',
                    'url' => 'https://anaksejahtera.com/about-us/',
                    'tag' => '🏙️ Penyalur Khusus Surabaya',
                    'loc' => '📍 Surabaya, Sidoarjo, Gresik',
                    'badge' => 'Lokal Surabaya',
                    'desc' => 'Layanan penyalur nanny & pengasuh anak khusus wilayah Surabaya dan sekitarnya dengan garansi pendampingan.'
                ],
                [
                    'name' => 'The Nanny Pro',
                    'url' => 'https://pnpro.id',
                    'tag' => '✈️ International Nanny & Governor',
                    'loc' => '📍 Global / Indonesia',
                    'badge' => 'International Standard',
                    'desc' => 'Layanan profesional nanny & governor bertaraf internasional untuk keluarga modern dengan kurikulum pengasuhan global.'
                ],
                [
                    'name' => 'Nanny Care ID',
                    'url' => 'https://www.nannycare.id',
                    'tag' => '🛡️ Agensi Penempatan Nanny',
                    'loc' => '📍 Indonesia',
                    'badge' => 'Agensi Terpercaya',
                    'desc' => 'Agensi penempatan nanny & baby sitter profesional yang teredukasi dalam pola asuh anak usia dini.'
                ],
                [
                    'name' => 'Cahaya Ibu Indonesia',
                    'url' => 'https://cahayaibuindonesia.com/?gad_source=1&gad_campaignid=23358918189&gclid=CjwKCAjw_eLVBhBEEiwAeaYZfALMXAdaA9wdpvntzvxkE9h3h2XsUkO1qP_xFHE4H-Hrs53D2D52hhoC_r0QAvD_BwE',
                    'tag' => '🏢 Yayasan Baby Sitter',
                    'loc' => '📍 Jawa & Bali',
                    'badge' => 'Responsif 24/7',
                    'desc' => 'Yayasan pengasuh anak dan baby sitter tersertifikasi dengan respon cepat pencocokan calon pengasuh.'
                ],
                [
                    'name' => 'PT Meta Homecare Indonesia',
                    'url' => 'https://www.metahomecareofficial.com/?gad_source=1&gad_campaignid=24244357418&gclid=CjwKCAjw_eLVBhBEEiwAeaYZfJSSVCl5U9KfD2LILOrMj2yvCiGNMM1jE308LhYExAqWmc3DBmb1jxoC5vcQAvD_BwE',
                    'tag' => '🏥 Homecare & Nanny Expert',
                    'loc' => '📍 Indonesia',
                    'badge' => 'Medis & Nanny',
                    'desc' => 'Penyedia layanan perawat medis anak, baby sitter, dan nanny tersertifikasi klinik homecare.'
                ],
                [
                    'name' => 'Mami Berlian Agency',
                    'url' => 'https://mamiberlianagency.com/blog/jasa-penyalur-art-surabaya-yang-resmi-dan-terpercaya-update-2026-2/',
                    'tag' => '🏙️ Agen Penyalur Surabaya',
                    'loc' => '📍 Kota Surabaya',
                    'badge' => 'Surabaya Update',
                    'desc' => 'Jasa agen penyalur ART dan Nanny resmi & terpercaya di Kota Surabaya dengan ulasan positif sesama orang tua.'
                ],
                [
                    'name' => 'Yayasan Kirana Era Prima',
                    'url' => 'https://kiranaeraprima.com/yayasan-baby-sitter-terbaik/',
                    'tag' => '🏢 Yayasan Baby Sitter Terbaik',
                    'loc' => '📍 Indonesia',
                    'badge' => 'Pilihan Utama',
                    'desc' => 'Yayasan penyalur baby sitter terkemuka dengan pembekalan sertifikasi keahlian pengasuhan anak secara intensif.'
                ]
            ];

            foreach ($agencies as $agency):
            ?>
            <div class="nanny-agency-card"
                 data-name="<?= esc($agency['name']) ?>"
                 data-tag="<?= esc($agency['tag']) ?>"
                 data-loc="<?= esc($agency['loc']) ?>"
                 data-desc="<?= esc($agency['desc']) ?>"
                 data-category="<?= esc($agency['badge']) ?>">
                <div class="agency-badge"><?= esc($agency['badge']) ?></div>
                <h4 class="agency-name"><?= esc($agency['name']) ?></h4>
                <span class="agency-tag"><?= esc($agency['tag']) ?></span>
                <span class="agency-loc"><?= esc($agency['loc']) ?></span>
                <p class="agency-desc"><?= esc($agency['desc']) ?></p>
                <div class="agency-footer">
                    <a href="<?= esc($agency['url']) ?>" target="_blank" rel="noopener noreferrer" class="agency-visit-btn">
                        Kunjungi Website Resmi ↗
                    </a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </section>

    <!-- 5. EDUKASI INFOGRAFIK: 4 PILAR UTAMA KUALIFIKASI NANNY (MATCHING KEWANANGAN RIGHTS SECTION) -->
    <section class="nanny-rights-section">
        <div class="nanny-rights-box">
            
            <div class="nanny-chip-tag chip-center">
                <span>Jaminan Kualitas & Keamanan</span>
            </div>

            <h2 class="nanny-rights-title">
                4 Pilar Kualifikasi <span class="nanny-pill nanny-pill-pink">Nanny Berkualitas</span>
            </h2>

            <p class="nanny-rights-subtitle">
                Setiap pengasuh anak di platform Parentela wajib memenuhi standar etika dan kecakapan pengasuhan profesional demi keamanan keluarga.
            </p>

            <div class="nanny-rights-grid">
                
                <!-- PILLAR 1 -->
                <div class="nanny-right-card">
                    <div class="right-img-box">
                        <img src="<?= base_url('images/kewenangan/family-rafiki.png') ?>" alt="Latar Belakang Bebas Kriminal" class="right-img">
                    </div>
                    <div class="right-badge tag-pink">1. Verifikasi Rekam Jejak</div>
                    <h4 class="right-title">Latar Belakang Terverifikasi</h4>
                    <p class="right-desc">Pemeriksaan identitas valid KTP/KK, kelakuan baik dari kepolisian (SKCK), serta referensi domisili resmi.</p>
                </div>

                <!-- PILLAR 2 -->
                <div class="nanny-right-card">
                    <div class="right-img-box">
                        <img src="<?= base_url('images/kewenangan/family-amico.png') ?>" alt="Pertolongan Pertama P3K" class="right-img">
                    </div>
                    <div class="right-badge tag-green">2. Keterampilan Darurat</div>
                    <h4 class="right-title">Pertolongan Pertama (P3K)</h4>
                    <p class="right-desc">Pembekalan ketrampilan cepat tanggap untuk penanganan tersedak, luka memar, pertolongan suhu panas, dan CPR anak.</p>
                </div>

                <!-- PILLAR 3 -->
                <div class="nanny-right-card">
                    <div class="right-img-box">
                        <img src="<?= base_url('images/kewenangan/family-cuate.png') ?>" alt="Disiplin Positif Bebas Bentakan" class="right-img">
                    </div>
                    <div class="right-badge tag-blue">3. Pola Asuh Positif</div>
                    <h4 class="right-title">Pendampingan Tanpa Kekerasan</h4>
                    <p class="right-desc">Prinsip pengasuhan penuh kasih tanpa hukuman fisik, komunikasi santun, dan kemampuan meredakan tantrum dengan sabar.</p>
                </div>

                <!-- PILLAR 4 -->
                <div class="nanny-right-card">
                    <div class="right-img-box">
                        <img src="<?= base_url('images/kewenangan/family-pana.png') ?>" alt="Transparansi & Komunikasi" class="right-img">
                    </div>
                    <div class="right-badge tag-amber">4. Komunikasi Transparan</div>
                    <h4 class="right-title">Laporan & Etika Profesional</h4>
                    <p class="right-desc">Pencatatan harian yang jujur, kepatuhan pada SOP rumah tangga Ayah & Bunda, serta menjaga privasi keluarga.</p>
                </div>

            </div>

        </div>
    </section>

    <!-- 7. BANNER KONSULTASI & HOTLINE NANNY 24 JAM (MATCHING KEWANANGAN EMERGENCY BANNER) -->
    <section class="nanny-emergency-section">
        <div class="nanny-emergency-box">
            
            <div class="nanny-emergency-left">
                <div class="nanny-chip-tag chip-white">
                    <span>💬 Layanan Konsultasi & Respon Cepat</span>
                </div>

                <h3 class="nanny-emergency-title">
                    Butuh Bantuan Memilih <span class="nanny-pill nanny-pill-pink">Nanny yang Tepat?</span>
                </h3>

                <p class="nanny-emergency-desc">
                    Tim konsultan Parentela siap mendampingi Ayah & Bunda dalam mencocokkan kualifikasi pengasuh sesuai kebutuhan spesifik dan jadwal keluarga Anda.
                </p>

                <div class="nanny-emergency-notice">
                    <span class="notice-icon">🔒</span>
                    <span class="notice-text">Konsultasi gratis & kerahasiaan data keluarga terjamin 100%.</span>
                </div>
            </div>

            <!-- HOTLINE BUTTON CARDS GRID -->
            <div class="nanny-emergency-right">
                <div class="hotline-cards-grid">
                    
                    <!-- HOTLINE 1: WA CONSULTATION -->
                    <a href="https://wa.me/6281234567890?text=Halo%20Parentela,%20saya%20ingin%20konsultasi%20pencarian%20Nanny" target="_blank" rel="noopener noreferrer" class="hotline-card card-wa">
                        <div class="hotline-icon-box box-green">💬</div>
                        <div class="hotline-info">
                            <span class="hotline-num">0812-3456-7890</span>
                            <span class="hotline-sub">WhatsApp Layanan Nanny Parentela</span>
                        </div>
                    </a>

                    <!-- HOTLINE 2: CALL CENTER -->
                    <a href="tel:081234567890" class="hotline-card card-call">
                        <div class="hotline-icon-box box-pink">📞</div>
                        <div class="hotline-info">
                            <span class="hotline-num">Call Center Nanny</span>
                            <span class="hotline-sub">Layanan Konsultasi Pukul 08.00 - 20.00</span>
                        </div>
                    </a>

                    <!-- HOTLINE 3: LOKASI SURABAYA -->
                    <a href="#nanny-list" class="hotline-card card-surabaya">
                        <div class="hotline-icon-box box-blue">📍</div>
                        <div class="hotline-info">
                            <span class="hotline-num">Area Layanan Surabaya</span>
                            <span class="hotline-sub">Surabaya Barat, Timur, Selatan, Pusat, Utara</span>
                        </div>
                    </a>

                    <!-- HOTLINE 4: PANDUAN PENGASUHAN -->
                    <a href="#toolkit" class="hotline-card card-kpai">
                        <div class="hotline-icon-box box-amber">📖</div>
                        <div class="hotline-info">
                            <span class="hotline-num">Panduan SPK & Jurnal</span>
                            <span class="hotline-sub">Unduh Dokumen Kerja Resmi</span>
                        </div>
                    </a>

                </div>
            </div>

        </div>
    </section>

</div>

<style>
    /* ==========================================================================
       NANNY PAGE STYLES (MATCHING KEWANANGAN FONT, PILLS, VIBES & ELEGANCE)
       ========================================================================== */
    
    .nanny-page-wrapper {
        background-color: #FFFDF9;
        padding: 50px 4% 90px;
        font-family: 'Outfit', sans-serif;
        color: #431407;
        overflow-x: hidden;
    }

    /* CHIP TAG ABOVE HEADINGS */
    .nanny-chip-tag {
        display: inline-block;
        background-color: #FCE7F3;
        color: #9D174D;
        padding: 6px 18px;
        border-radius: 20px;
        font-size: 0.88rem;
        font-weight: 700;
        letter-spacing: 0.3px;
        margin-bottom: 16px;
        border: 1px solid rgba(236, 72, 153, 0.2);
    }

    .chip-center {
        margin: 0 auto 14px auto;
    }

    .chip-white {
        background-color: rgba(255, 255, 255, 0.95);
        color: #431407;
    }

    /* HIGHLIGHT PILL BADGES FOR TEXT (MATCHING KEWANANGAN .kew-pill) */
    .nanny-pill {
        display: inline-block;
        padding: 4px 18px;
        border-radius: 30px;
        color: #ffffff !important;
        font-weight: 800;
        vertical-align: middle;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.06);
        line-height: 1.25;
        margin: 0 2px;
    }

    .nanny-pill-pink { background-color: #EC4899; }
    .nanny-pill-blue { background-color: #3B82F6; }
    .nanny-pill-green { background-color: #10B981; }
    .nanny-pill-purple { background-color: #8B5CF6; }
    .nanny-pill-amber { background-color: #F59E0B; }

    /* 1. HERO SECTION */
    .nanny-hero-container {
        max-width: 1240px;
        margin: 0 auto 60px;
    }

    .nanny-hero-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 30px;
        align-items: stretch;
    }

    .nanny-hero-card-left {
        background: linear-gradient(135deg, #F0F9FF 0%, #E0F2FE 100%);
        border: 1.5px solid rgba(59, 130, 246, 0.25);
        box-shadow: 0 10px 30px rgba(59, 130, 246, 0.08);
        border-radius: 28px;
        padding: 50px 45px;
        position: relative;
        display: flex;
        flex-direction: column;
        justify-content: center;
        overflow: hidden;
    }

    .nanny-svg-curve {
        position: absolute;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        pointer-events: none;
    }

    .nanny-hero-title {
        font-family: 'Outfit', sans-serif;
        font-size: 3.1rem;
        font-weight: 800;
        color: #431407;
        line-height: 1.2;
        margin-bottom: 20px;
        letter-spacing: -0.5px;
    }

    .nanny-hero-subtitle {
        font-size: 1.12rem;
        color: #555;
        line-height: 1.65;
        margin-bottom: 30px;
        max-width: 500px;
    }

    .nanny-hero-stats {
        display: inline-flex;
        align-items: center;
        background-color: #ffffff;
        padding: 12px 24px;
        border-radius: 30px;
        box-shadow: 0 6px 20px rgba(67, 20, 7, 0.06);
        border: 1px solid rgba(67, 20, 7, 0.08);
        gap: 20px;
    }

    .stat-pill-item {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .stat-num {
        font-size: 1.25rem;
        font-weight: 800;
        color: #EC4899;
        line-height: 1;
    }

    .stat-lbl {
        font-size: 0.76rem;
        color: #666;
        font-weight: 600;
        margin-top: 2px;
    }

    .stat-pill-divider {
        width: 1px;
        height: 28px;
        background-color: rgba(67, 20, 7, 0.12);
    }

    /* HERO RIGHT CARD PHOTO */
    .nanny-hero-card-right {
        position: relative;
        border-radius: 28px;
        overflow: hidden;
        border: 1.5px solid rgba(67, 20, 7, 0.1);
        box-shadow: 0 10px 30px rgba(67, 20, 7, 0.08);
    }

    .nanny-img-wrapper {
        width: 100%;
        height: 100%;
        min-height: 420px;
        position: relative;
    }

    .nanny-hero-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    .nanny-img-overlay-bar {
        position: absolute;
        bottom: 16px;
        left: 16px;
        right: 16px;
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 10px;
    }

    .nanny-overlay-badge {
        padding: 12px 10px;
        border-radius: 18px;
        backdrop-filter: blur(10px);
        box-shadow: 0 4px 14px rgba(0, 0, 0, 0.08);
        display: flex;
        flex-direction: column;
        justify-content: center;
        text-align: center;
    }

    .badge-blue { background-color: rgba(219, 234, 254, 0.95); color: #1E3A8A; }
    .badge-pink { background-color: rgba(252, 231, 243, 0.95); color: #831843; }
    .badge-green { background-color: rgba(220, 252, 231, 0.95); color: #14532D; }

    .badge-title { font-weight: 800; font-size: 0.85rem; line-height: 1.2; }
    .badge-sub { font-size: 0.74rem; opacity: 0.85; margin-top: 2px; }

    /* 2. SECTION HEADER */
    .nanny-section-header {
        text-align: center;
        max-width: 800px;
        margin: 0 auto 50px;
    }

    .nanny-section-title {
        font-family: 'Outfit', sans-serif;
        font-size: 2.3rem;
        font-weight: 800;
        color: #431407;
        line-height: 1.3;
        margin-bottom: 12px;
    }

    .nanny-section-subtitle {
        font-size: 1.05rem;
        color: #666;
        line-height: 1.6;
    }

    .text-center { text-align: center; }

    /* 3. 4 CARDS SECTION & GRID (MATCHING KEWANANGAN) */
    .nanny-cards-section {
        max-width: 1240px;
        margin: 0 auto 70px;
    }

    .nanny-cards-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 32px;
        align-items: stretch;
    }

    .nanny-card {
        border-radius: 26px;
        position: relative;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card-pink-theme {
        background-color: #FFF0F5;
        border: 1.5px solid rgba(236, 72, 153, 0.25);
        box-shadow: 0 10px 28px rgba(236, 72, 153, 0.07);
    }

    .card-green-theme {
        background-color: #F0FDF4;
        border: 1.5px solid rgba(34, 197, 94, 0.25);
        box-shadow: 0 10px 28px rgba(34, 197, 94, 0.07);
    }

    .card-blue-theme {
        background-color: #EFF6FF;
        border: 1.5px solid rgba(59, 130, 246, 0.25);
        box-shadow: 0 10px 28px rgba(59, 130, 246, 0.07);
    }

    .card-amber-theme {
        background-color: #FFFBEB;
        border: 1.5px solid rgba(245, 158, 11, 0.25);
        box-shadow: 0 10px 28px rgba(245, 158, 11, 0.07);
    }

    .nanny-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 18px 38px rgba(67, 20, 7, 0.1);
    }

    /* STICKER BADGES TOP LEFT OF CARDS */
    .nanny-sticker-badge {
        position: absolute;
        top: 14px;
        left: 20px;
        z-index: 10;
        padding: 5px 18px;
        border-radius: 20px;
        font-family: 'Caveat', cursive;
        font-size: 1.45rem;
        font-weight: 700;
        color: #ffffff;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        letter-spacing: 0.5px;
    }

    .badge-pink-sticker { background-color: #EC4899; }
    .badge-green-sticker { background-color: #10B981; }
    .badge-blue-sticker { background-color: #3B82F6; }
    .badge-amber-sticker { background-color: #F59E0B; }

    /* CARD IMAGE WRAPPER */
    .nanny-card-img-wrap {
        position: relative;
        width: 100%;
        height: 210px;
        overflow: hidden;
    }

    .nanny-card-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
        transition: transform 0.4s ease;
    }

    .nanny-card:hover .nanny-card-img {
        transform: scale(1.05);
    }

    .nanny-card-img-overlay {
        position: absolute;
        bottom: 12px;
        left: 14px;
        right: 14px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        background: rgba(0, 0, 0, 0.55);
        backdrop-filter: blur(8px);
        padding: 8px 14px;
        border-radius: 14px;
        color: #ffffff;
        font-size: 0.8rem;
        font-weight: 600;
    }

    .nanny-card-content {
        padding: 28px 26px;
        display: flex;
        flex-direction: column;
        flex-grow: 1;
    }

    .nanny-card-heading {
        font-family: 'Outfit', sans-serif;
        font-size: 1.35rem;
        font-weight: 800;
        color: #431407;
        margin-bottom: 10px;
        line-height: 1.35;
    }

    .nanny-card-desc {
        font-size: 0.95rem;
        color: #555;
        line-height: 1.6;
        margin-bottom: 20px;
    }

    /* ITEM PILLS INSIDE CARDS */
    .nanny-card-items {
        display: flex;
        flex-direction: column;
        gap: 12px;
        flex-grow: 1;
        margin-bottom: 24px;
    }

    .nanny-item-pill {
        background-color: #ffffff;
        border-radius: 16px;
        padding: 14px 16px;
        display: flex;
        align-items: flex-start;
        gap: 10px;
        border: 1px solid rgba(67, 20, 7, 0.08);
        box-shadow: 0 4px 12px rgba(67, 20, 7, 0.03);
    }

    .nanny-item-dot {
        width: 10px;
        height: 10px;
        border-radius: 50%;
        flex-shrink: 0;
        margin-top: 6px;
    }

    .dot-pink { background-color: #EC4899; }
    .dot-green { background-color: #10B981; }
    .dot-blue { background-color: #3B82F6; }
    .dot-amber { background-color: #F59E0B; }

    .nanny-item-content {
        font-size: 0.9rem;
        color: #555;
        line-height: 1.55;
    }

    .nanny-item-content strong {
        color: #431407;
    }

    /* ACTION BUTTONS (MATCHING KEWANANGAN BUTTON STYLES) */
    .card-footer-action {
        margin-top: auto;
    }

    .nanny-action-btn {
        display: inline-block;
        width: 100%;
        text-align: center;
        border-radius: 30px;
        padding: 12px 20px;
        font-weight: 700;
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        text-decoration: none;
        transition: all 0.25s ease;
        border: none;
        cursor: pointer;
    }

    .btn-pink {
        background-color: #EC4899;
        color: #ffffff;
        box-shadow: 0 4px 14px rgba(236, 72, 153, 0.25);
    }

    .btn-pink:hover {
        background-color: #db2777;
        color: #ffffff;
        transform: translateY(-2px);
    }

    .btn-green {
        background-color: #10B981;
        color: #ffffff;
        box-shadow: 0 4px 14px rgba(16, 185, 129, 0.25);
    }

    .btn-green:hover {
        background-color: #059669;
        color: #ffffff;
        transform: translateY(-2px);
    }

    .btn-blue {
        background-color: #3B82F6;
        color: #ffffff;
        box-shadow: 0 4px 14px rgba(59, 130, 246, 0.25);
    }

    .btn-blue:hover {
        background-color: #2563eb;
        color: #ffffff;
        transform: translateY(-2px);
    }

    .btn-amber {
        background-color: #F59E0B;
        color: #ffffff;
        box-shadow: 0 4px 14px rgba(245, 158, 11, 0.25);
    }

    .btn-amber:hover {
        background-color: #d97706;
        color: #ffffff;
        transform: translateY(-2px);
    }

    /* 4. NANNY DIRECTORY CARDS GRID */
    .nanny-directory-section {
        max-width: 1240px;
        margin: 0 auto 70px;
    }

    .nanny-profiles-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 24px;
        margin-top: 36px;
    }

    .nanny-profile-card {
        background: #ffffff;
        border: 1.5px solid rgba(67, 20, 7, 0.08);
        border-radius: 24px;
        padding: 24px;
        position: relative;
        box-shadow: 0 8px 24px rgba(67, 20, 7, 0.04);
        display: flex;
        flex-direction: column;
        transition: transform 0.25s ease, box-shadow 0.25s ease;
    }

    .nanny-profile-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 14px 32px rgba(67, 20, 7, 0.09);
        border-color: rgba(236, 72, 153, 0.3);
    }

    .nanny-verif-badge {
        position: absolute;
        top: 16px;
        right: 16px;
        background: #DCFCE7;
        color: #15803D;
        font-size: 0.75rem;
        font-weight: 700;
        padding: 4px 10px;
        border-radius: 20px;
    }

    .nanny-profile-header {
        display: flex;
        align-items: center;
        gap: 16px;
        margin-bottom: 18px;
    }

    .nanny-profile-img {
        width: 70px;
        height: 70px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid #EC4899;
        flex-shrink: 0;
    }

    .nanny-profile-info {
        display: flex;
        flex-direction: column;
    }

    .nanny-profile-name {
        font-family: 'Outfit', sans-serif;
        font-size: 1.15rem;
        font-weight: 800;
        color: #431407;
        margin-bottom: 4px;
    }

    .nanny-profile-exp {
        font-size: 0.8rem;
        color: #10B981;
        font-weight: 700;
    }

    .nanny-profile-tag {
        font-size: 0.78rem;
        color: #666;
    }

    .nanny-profile-desc {
        font-size: 0.88rem;
        color: #555;
        line-height: 1.55;
        margin-bottom: 16px;
        flex-grow: 1;
    }

    .nanny-profile-meta {
        background: #FFFDF9;
        border-radius: 14px;
        padding: 12px 14px;
        margin-bottom: 18px;
        display: flex;
        flex-direction: column;
        gap: 6px;
        border: 1px solid rgba(67, 20, 7, 0.05);
    }

    .meta-item {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 0.82rem;
        color: #555;
    }

    .font-bold { font-weight: 700; }
    .text-pink { color: #EC4899; }

    .nanny-wa-btn {
        display: inline-block;
        width: 100%;
        text-align: center;
        background: #25D366;
        color: #ffffff;
        font-weight: 700;
        font-size: 0.88rem;
        padding: 10px 16px;
        border-radius: 20px;
        text-decoration: none;
        transition: background 0.2s ease, transform 0.2s ease;
        box-shadow: 0 4px 12px rgba(37, 211, 102, 0.2);
    }

    .nanny-wa-btn:hover {
        background: #1eb854;
        color: #ffffff;
        transform: translateY(-2px);
    }

    /* 5. 4 PILAR UTAMA SECTION (MATCHING KEWANANGAN RIGHTS SECTION) */
    .nanny-rights-section {
        max-width: 1240px;
        margin: 0 auto 70px;
    }

    .nanny-rights-box {
        background-color: #ffffff;
        border: 1.5px solid rgba(67, 20, 7, 0.1);
        box-shadow: 0 12px 36px rgba(67, 20, 7, 0.05);
        border-radius: 32px;
        padding: 50px 40px;
        text-align: center;
    }

    .nanny-rights-title {
        font-family: 'Outfit', sans-serif;
        font-size: 2.2rem;
        font-weight: 800;
        color: #431407;
        margin-bottom: 12px;
    }

    .nanny-rights-subtitle {
        font-size: 1.05rem;
        color: #666;
        max-width: 700px;
        margin: 0 auto 40px;
    }

    .nanny-rights-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 20px;
        text-align: left;
    }

    .nanny-right-card {
        background-color: #FFFDF9;
        border: 1.5px solid rgba(67, 20, 7, 0.08);
        border-radius: 22px;
        padding: 22px 20px;
        display: flex;
        flex-direction: column;
        transition: transform 0.25s ease;
    }

    .nanny-right-card:hover {
        transform: translateY(-4px);
        border-color: rgba(236, 72, 153, 0.3);
    }

    .right-img-box {
        width: 100%;
        height: 130px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 16px;
    }

    .right-img {
        max-width: 100%;
        max-height: 100%;
        object-fit: contain;
    }

    .right-badge {
        display: inline-block;
        font-size: 0.78rem;
        font-weight: 700;
        padding: 4px 12px;
        border-radius: 12px;
        margin-bottom: 10px;
        align-self: flex-start;
    }

    .tag-pink { background-color: #FCE7F3; color: #831843; }
    .tag-green { background-color: #DCFCE7; color: #15803D; }
    .tag-blue { background-color: #DBEAFE; color: #1D4ED8; }
    .tag-amber { background-color: #FEF3C7; color: #B45309; }

    .right-title {
        font-family: 'Outfit', sans-serif;
        font-size: 1.08rem;
        font-weight: 800;
        color: #431407;
        margin-bottom: 6px;
    }

    .right-desc {
        font-size: 0.88rem;
        color: #666;
        line-height: 1.55;
    }

    /* 6. TOOLKIT & DOCS SECTION */
    .nanny-docs-section {
        max-width: 1240px;
        margin: 0 auto 70px;
    }

    .nanny-docs-box {
        background-color: #ffffff;
        border: 1.5px solid rgba(59, 130, 246, 0.2);
        box-shadow: 0 10px 30px rgba(59, 130, 246, 0.06);
        border-radius: 32px;
        padding: 50px 40px;
        text-align: center;
    }

    .nanny-docs-title {
        font-family: 'Outfit', sans-serif;
        font-size: 2.2rem;
        font-weight: 800;
        color: #431407;
        margin-bottom: 12px;
    }

    .nanny-docs-subtitle {
        font-size: 1.05rem;
        color: #666;
        max-width: 700px;
        margin: 0 auto 36px;
    }

    .nanny-docs-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 24px;
        text-align: left;
    }

    .nanny-doc-card {
        background: #FFFDF9;
        border: 1.5px dashed rgba(67, 20, 7, 0.15);
        border-radius: 24px;
        padding: 28px 24px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .doc-icon-wrap {
        width: 50px;
        height: 50px;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        margin-bottom: 14px;
    }

    .icon-pink { background: #FCE7F3; }
    .icon-green { background: #DCFCE7; }

    .doc-content h4 {
        font-family: 'Outfit', sans-serif;
        font-size: 1.25rem;
        font-weight: 800;
        color: #431407;
        margin-bottom: 8px;
    }

    .doc-content p {
        font-size: 0.92rem;
        color: #666;
        line-height: 1.6;
        margin-bottom: 20px;
    }

    .doc-download-btn {
        display: inline-block;
        text-align: center;
        padding: 12px 20px;
        border-radius: 30px;
        font-weight: 700;
        font-size: 0.88rem;
        text-decoration: none;
        transition: all 0.25s ease;
    }

    .btn-pink-outline {
        border: 1.5px solid #EC4899;
        color: #EC4899;
        background: #ffffff;
    }

    .btn-pink-outline:hover {
        background: #EC4899;
        color: #ffffff;
    }

    .btn-green-outline {
        border: 1.5px solid #10B981;
        color: #10B981;
        background: #ffffff;
    }

    .btn-green-outline:hover {
        background: #10B981;
        color: #ffffff;
    }

    /* 7. EMERGENCY HOTLINE BANNER (MATCHING KEWANANGAN EMERGENCY BANNER) */
    .nanny-emergency-section {
        max-width: 1240px;
        margin: 0 auto;
    }

    .nanny-emergency-box {
        background: linear-gradient(135deg, #FCE7F3 0%, #FBCFE8 100%);
        border: 1.5px solid rgba(236, 72, 153, 0.3);
        box-shadow: 0 12px 36px rgba(236, 72, 153, 0.1);
        border-radius: 32px;
        padding: 48px 42px;
        display: grid;
        grid-template-columns: 1fr 1.2fr;
        gap: 40px;
        align-items: center;
    }

    .nanny-emergency-title {
        font-family: 'Outfit', sans-serif;
        font-size: 2.2rem;
        font-weight: 800;
        color: #831843;
        line-height: 1.25;
        margin-bottom: 16px;
    }

    .nanny-emergency-desc {
        font-size: 1.02rem;
        color: #9D174D;
        line-height: 1.6;
        margin-bottom: 24px;
    }

    .nanny-emergency-notice {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        background-color: #ffffff;
        color: #431407;
        padding: 10px 20px;
        border-radius: 20px;
        font-size: 0.88rem;
        font-weight: 700;
        box-shadow: 0 4px 12px rgba(67, 20, 7, 0.05);
    }

    .notice-icon { font-size: 1.1rem; }

    /* HOTLINE CARDS GRID */
    .hotline-cards-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 16px;
    }

    .hotline-card {
        background-color: #ffffff;
        border-radius: 20px;
        padding: 16px 18px;
        display: flex;
        align-items: center;
        gap: 14px;
        text-decoration: none;
        border: 1px solid rgba(67, 20, 7, 0.08);
        box-shadow: 0 6px 18px rgba(67, 20, 7, 0.04);
        transition: transform 0.25s ease, box-shadow 0.25s ease;
    }

    .hotline-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 24px rgba(67, 20, 7, 0.1);
    }

    .hotline-icon-box {
        width: 44px;
        height: 44px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.3rem;
        flex-shrink: 0;
    }

    .box-pink { background-color: #FCE7F3; color: #EC4899; }
    .box-green { background-color: #F0FDF4; color: #10B981; }
    .box-blue { background-color: #EFF6FF; color: #3B82F6; }
    .box-amber { background-color: #FFFBEB; color: #F59E0B; }

    .hotline-info {
        display: flex;
        flex-direction: column;
    }

    .hotline-num {
        font-size: 0.98rem;
        font-weight: 800;
        color: #431407;
        line-height: 1.2;
    }

    .hotline-sub {
        font-size: 0.78rem;
        color: #666;
        margin-top: 2px;
    }

    /* ==========================================================================
       1.5 LENGKAP 3 TILTED CARDS SECTION STYLES
       ========================================================================== */
    .nanny-lengkap-section {
        max-width: 1240px;
        margin: 0 auto 80px;
        padding-top: 10px;
    }

    .lengkap-top-pill-wrap {
        text-align: center;
        margin-bottom: 36px;
    }

    .lengkap-pill {
        display: inline-block;
        background-color: #84CC16;
        color: #ffffff;
        font-family: 'Playfair Display', serif;
        font-size: 2.3rem;
        font-weight: 800;
        font-style: italic;
        padding: 6px 45px;
        border-radius: 999px;
        box-shadow: 0 6px 20px rgba(132, 204, 22, 0.35);
        letter-spacing: 0.5px;
    }

    .lengkap-cards-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 28px;
        align-items: stretch;
    }

    .lengkap-card {
        border-radius: 28px;
        padding: 38px 24px 28px;
        position: relative;
        display: flex;
        flex-direction: column;
        transition: transform 0.35s ease, box-shadow 0.35s ease;
    }

    .card-pink-tilted {
        background-color: #FFF0F5;
        border: 2px dashed #F472B6;
        transform: none;
        box-shadow: 0 8px 24px rgba(244, 114, 182, 0.08);
    }

    .card-green-tilted {
        background-color: #F0FDF4;
        border: 2px dashed #84CC16;
        transform: none;
        box-shadow: 0 8px 24px rgba(132, 204, 22, 0.08);
    }

    .card-blue-tilted {
        background-color: #EFF6FF;
        border: 2px dashed #60A5FA;
        transform: none;
        box-shadow: 0 8px 24px rgba(96, 165, 250, 0.08);
    }

    .lengkap-card:hover {
        transform: translateY(-6px) !important;
        box-shadow: 0 16px 36px rgba(0, 0, 0, 0.08) !important;
    }

    .lengkap-sticker-badge {
        position: absolute;
        top: -16px;
        left: 24px;
        padding: 5px 24px;
        border-radius: 20px;
        font-family: 'Caveat', cursive;
        font-size: 1.55rem;
        font-weight: 700;
        color: #ffffff;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.12);
        letter-spacing: 0.5px;
    }

    .lengkap-card-title {
        font-family: 'Outfit', sans-serif;
        font-size: 1.25rem;
        font-weight: 800;
        color: #334155;
        line-height: 1.35;
        margin: 10px 0 20px 0;
        text-transform: uppercase;
        letter-spacing: -0.2px;
    }

    .lengkap-subcards-list {
        display: flex;
        flex-direction: column;
        gap: 16px;
        flex-grow: 1;
    }

    .lengkap-subcard {
        background-color: #ffffff;
        border-radius: 20px;
        padding: 20px;
        box-shadow: 0 4px 14px rgba(0, 0, 0, 0.03);
        border: 1px solid rgba(0, 0, 0, 0.04);
        display: flex;
        flex-direction: column;
        gap: 14px;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .lengkap-subcard:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.06);
    }

    .subcard-content {
        display: flex;
        align-items: flex-start;
        gap: 12px;
        font-size: 0.92rem;
        color: #475569;
        line-height: 1.55;
    }

    .subcard-content strong {
        color: #1E293B;
    }

    .dot-bullet {
        width: 10px;
        height: 10px;
        border-radius: 50%;
        flex-shrink: 0;
        margin-top: 6px;
    }

    .subcard-action {
        margin-top: 4px;
    }

    .nanny-dl-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        width: 100%;
        padding: 10px 18px;
        border-radius: 30px;
        font-size: 0.88rem;
        font-weight: 700;
        text-decoration: none;
        transition: all 0.25s ease;
        cursor: pointer;
    }

    .btn-pink-outline {
        border: 1.8px solid #EC4899;
        color: #DB2777;
        background-color: #ffffff;
        box-shadow: 0 2px 8px rgba(236, 72, 153, 0.1);
    }

    .btn-pink-outline:hover {
        background-color: #EC4899;
        color: #ffffff;
        transform: translateY(-2px);
        box-shadow: 0 4px 14px rgba(236, 72, 153, 0.3);
    }

    .btn-green-outline {
        border: 1.8px solid #84CC16;
        color: #65A30D;
        background-color: #ffffff;
        box-shadow: 0 2px 8px rgba(132, 204, 22, 0.1);
    }

    .btn-green-outline:hover {
        background-color: #84CC16;
        color: #ffffff;
        transform: translateY(-2px);
        box-shadow: 0 4px 14px rgba(132, 204, 22, 0.3);
    }

    .btn-blue-outline {
        border: 1.8px solid #3B82F6;
        color: #2563EB;
        background-color: #ffffff;
        box-shadow: 0 2px 8px rgba(59, 130, 246, 0.1);
    }

    .btn-blue-outline:hover {
        background-color: #3B82F6;
        color: #ffffff;
        transform: translateY(-2px);
        box-shadow: 0 4px 14px rgba(59, 130, 246, 0.3);
    }

    /* ==========================================================================
       4.5 DIREKTORI AGEN & YAYASAN PENYALUR STYLES
       ========================================================================== */
    .nanny-agencies-section {
        max-width: 1240px;
        margin: 0 auto 80px;
        scroll-margin-top: 80px;
    }

    .nanny-agencies-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 24px;
        margin-top: 36px;
    }

    .nanny-agency-card {
        background-color: #ffffff;
        border: 1.5px solid rgba(67, 20, 7, 0.08);
        border-radius: 24px;
        padding: 24px;
        position: relative;
        box-shadow: 0 8px 24px rgba(67, 20, 7, 0.04);
        display: flex;
        flex-direction: column;
        transition: transform 0.25s ease, box-shadow 0.25s ease;
    }

    .nanny-agency-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 14px 32px rgba(67, 20, 7, 0.09);
        border-color: rgba(34, 197, 94, 0.3);
    }

    .agency-badge {
        position: absolute;
        top: 16px;
        right: 16px;
        background-color: #F0FDF4;
        color: #15803D;
        font-size: 0.75rem;
        font-weight: 700;
        padding: 4px 12px;
        border-radius: 20px;
        border: 1px solid rgba(34, 197, 94, 0.2);
    }

    .agency-name {
        font-family: 'Outfit', sans-serif;
        font-size: 1.2rem;
        font-weight: 800;
        color: #431407;
        margin-bottom: 6px;
        padding-right: 90px;
    }

    .agency-tag {
        font-size: 0.82rem;
        color: #10B981;
        font-weight: 700;
        margin-bottom: 2px;
    }

    .agency-loc {
        font-size: 0.78rem;
        color: #666;
        margin-bottom: 12px;
    }

    .agency-desc {
        font-size: 0.88rem;
        color: #555;
        line-height: 1.55;
        margin-bottom: 20px;
        flex-grow: 1;
    }

    .agency-footer {
        margin-top: auto;
    }

    .agency-visit-btn {
        display: inline-block;
        width: 100%;
        text-align: center;
        background-color: #F0FDF4;
        color: #15803D;
        border: 1.5px solid #22C55E;
        font-weight: 700;
        font-size: 0.88rem;
        padding: 10px 16px;
        border-radius: 20px;
        text-decoration: none;
        transition: all 0.25s ease;
    }

    .agency-visit-btn:hover {
        background-color: #22C55E;
        color: #ffffff;
        transform: translateY(-2px);
        box-shadow: 0 4px 14px rgba(34, 197, 94, 0.25);
    }

    /* AGENCY SEARCH BAR & FILTER STYLES */
    .agency-search-wrapper {
        max-width: 780px;
        margin: 0 auto 36px;
        display: flex;
        flex-direction: column;
        gap: 16px;
        align-items: center;
    }

    .agency-search-box {
        width: 100%;
        position: relative;
        display: flex;
        align-items: center;
        background-color: #ffffff;
        border: 2px solid rgba(34, 197, 94, 0.3);
        border-radius: 30px;
        padding: 6px 18px 6px 22px;
        box-shadow: 0 8px 24px rgba(34, 197, 94, 0.08);
        transition: border-color 0.25s ease, box-shadow 0.25s ease;
    }

    .agency-search-box:focus-within {
        border-color: #22C55E;
        box-shadow: 0 10px 28px rgba(34, 197, 94, 0.18);
    }

    .search-icon {
        font-size: 1.2rem;
        margin-right: 12px;
        color: #10B981;
    }

    .agency-search-input {
        width: 100%;
        border: none;
        outline: none;
        font-family: 'Outfit', sans-serif;
        font-size: 1.02rem;
        color: #431407;
        background: transparent;
        padding: 10px 0;
    }

    .agency-search-input::placeholder {
        color: #94A3B8;
    }

    .clear-search-btn {
        background: #F1F5F9;
        border: none;
        color: #64748B;
        width: 26px;
        height: 26px;
        border-radius: 50%;
        font-size: 0.8rem;
        font-weight: 700;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: background 0.2s ease;
    }

    .clear-search-btn:hover {
        background: #E2E8F0;
        color: #0F172A;
    }

    .agency-filter-chips {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        justify-content: center;
    }

    .filter-chip {
        background: #ffffff;
        border: 1.5px solid rgba(67, 20, 7, 0.1);
        color: #666;
        font-family: 'Outfit', sans-serif;
        font-size: 0.85rem;
        font-weight: 700;
        padding: 6px 18px;
        border-radius: 20px;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .filter-chip:hover {
        border-color: #22C55E;
        color: #15803D;
        background: #F0FDF4;
    }

    .filter-chip.active {
        background: #22C55E;
        color: #ffffff;
        border-color: #22C55E;
        box-shadow: 0 4px 12px rgba(34, 197, 94, 0.25);
    }

    .no-agencies-found {
        text-align: center;
        background: #FFFDF9;
        border: 1.5px dashed rgba(67, 20, 7, 0.15);
        border-radius: 24px;
        padding: 40px 20px;
        margin: 30px 0;
    }

    .no-result-icon {
        font-size: 2.5rem;
        display: block;
        margin-bottom: 10px;
    }

    .no-agencies-found h4 {
        font-family: 'Outfit', sans-serif;
        font-size: 1.3rem;
        font-weight: 800;
        color: #431407;
        margin-bottom: 6px;
    }

    .no-agencies-found p {
        font-size: 0.95rem;
        color: #666;
    }

    /* RESPONSIVE DESIGN BREAKPOINTS */
    @media (max-width: 1024px) {
        .nanny-hero-grid,
        .lengkap-cards-grid,
        .nanny-cards-grid,
        .nanny-agencies-grid,
        .nanny-profiles-grid,
        .nanny-docs-grid,
        .nanny-emergency-box {
            grid-template-columns: 1fr;
        }

        .lengkap-card {
            transform: none !important;
        }

        .nanny-rights-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .nanny-hero-title,
        .nanny-section-title,
        .nanny-rights-title,
        .nanny-docs-title,
        .nanny-emergency-title {
            font-size: 2rem;
        }

        .nanny-img-overlay-bar {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 640px) {
        .nanny-page-wrapper {
            padding: 30px 16px 60px;
        }

        .nanny-hero-card-left,
        .lengkap-card,
        .nanny-rights-box,
        .nanny-docs-box,
        .nanny-emergency-box {
            padding: 35px 20px;
            border-radius: 22px;
        }

        .nanny-rights-grid,
        .hotline-cards-grid {
            grid-template-columns: 1fr;
        }

        .nanny-hero-stats {
            flex-direction: column;
            gap: 10px;
        }

        .stat-pill-divider {
            display: none;
        }
    }
</style>

<!-- LIVE SEARCH & FILTER JAVASCRIPT -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('agencySearchInput');
    const clearBtn = document.getElementById('clearSearchBtn');
    const filterChips = document.querySelectorAll('.filter-chip');
    const agencyCards = document.querySelectorAll('.nanny-agency-card');
    const noResultBox = document.getElementById('noAgenciesResult');
    const searchQueryText = document.getElementById('searchQueryText');

    let activeFilter = 'all';

    function filterAgencies() {
        const query = searchInput ? searchInput.value.toLowerCase().trim() : '';
        let visibleCount = 0;

        if (clearBtn) {
            clearBtn.style.display = query.length > 0 ? 'flex' : 'none';
        }

        agencyCards.forEach(card => {
            const name = card.dataset.name ? card.dataset.name.toLowerCase() : '';
            const tag = card.dataset.tag ? card.dataset.tag.toLowerCase() : '';
            const loc = card.dataset.loc ? card.dataset.loc.toLowerCase() : '';
            const desc = card.dataset.desc ? card.dataset.desc.toLowerCase() : '';
            const cardCategory = card.dataset.category ? card.dataset.category.toLowerCase() : '';

            const matchesQuery = !query || name.includes(query) || tag.includes(query) || loc.includes(query) || desc.includes(query);
            
            let matchesCategory = true;
            if (activeFilter === 'surabaya') {
                matchesCategory = loc.includes('surabaya') || loc.includes('jatim') || tag.includes('surabaya');
            } else if (activeFilter === 'jabodetabek') {
                matchesCategory = loc.includes('jabodetabek') || loc.includes('jawa') || loc.includes('nasional');
            } else if (activeFilter === 'lpk') {
                matchesCategory = tag.includes('lpk') || cardCategory.includes('lpk') || tag.includes('resmi');
            } else if (activeFilter === 'online') {
                matchesCategory = tag.includes('platform') || tag.includes('digital') || tag.includes('online');
            }

            if (matchesQuery && matchesCategory) {
                card.style.display = 'flex';
                visibleCount++;
            } else {
                card.style.display = 'none';
            }
        });

        if (noResultBox) {
            if (visibleCount === 0) {
                noResultBox.style.display = 'block';
                if (searchQueryText) searchQueryText.textContent = query || activeFilter;
            } else {
                noResultBox.style.display = 'none';
            }
        }
    }

    if (searchInput) {
        searchInput.addEventListener('input', filterAgencies);
    }

    if (clearBtn) {
        clearBtn.addEventListener('click', function() {
            searchInput.value = '';
            filterAgencies();
            searchInput.focus();
        });
    }

    filterChips.forEach(chip => {
        chip.addEventListener('click', function() {
            filterChips.forEach(c => c.classList.remove('active'));
            this.classList.add('active');
            activeFilter = this.dataset.filter;
            filterAgencies();
        });
    });
});
</script>

<?= $this->endSection() ?>
