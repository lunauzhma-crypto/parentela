<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<!-- GOOGLE FONTS -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Caveat:wght@700&family=Outfit:wght@400;500;600;700;800&family=Playfair+Display:ital,wght@0,600;0,800;1,600&display=swap" rel="stylesheet">

<div class="kew-page-wrapper">
    
    <!-- 1. TOP HERO SECTION -->
    <section class="kew-hero-container">
        <div class="kew-hero-grid">
            
            <!-- HERO LEFT CARD -->
            <div class="kew-hero-card-left">
                <!-- DASHED SVG ACCENT -->
                <svg class="kew-svg-curve" viewBox="0 0 300 200" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M10 100 C 90 20, 210 180, 290 100" stroke="#F97316" stroke-width="2.5" stroke-dasharray="6 6" opacity="0.25"/>
                    <circle cx="290" cy="100" r="4" fill="#F97316"/>
                    <circle cx="10" cy="100" r="4" fill="#F97316"/>
                </svg>

                <div class="kew-chip-tag">
                    <span>⚖️ Pusat Regulasi & Advokasi Resmi</span>
                </div>

                <h1 class="kew-hero-title">
                    Kewenangan & <span class="kew-pill kew-pill-orange">Perlindungan</span> Anak & Ibu
                </h1>

                <p class="kew-hero-subtitle">
                    Rujukan resmi perundang-undangan negara, layanan pengaduan independen, serta jaringan advokasi tanggap darurat dari tingkat nasional hingga Kota Surabaya.
                </p>

                <!-- QUICK STATS BADGES -->
                <div class="kew-hero-stats">
                    <div class="stat-pill-item">
                        <span class="stat-num">4</span>
                        <span class="stat-lbl">Lembaga Otoritas Utama</span>
                    </div>
                    <div class="stat-pill-divider"></div>
                    <div class="stat-pill-item">
                        <span class="stat-num">100%</span>
                        <span class="stat-lbl">Naskah Resmi Terverifikasi</span>
                    </div>
                    <div class="stat-pill-divider"></div>
                    <div class="stat-pill-item">
                        <span class="stat-num">24/7</span>
                        <span class="stat-lbl">Layanan Tanggap Darurat</span>
                    </div>
                </div>
            </div>

            <!-- HERO RIGHT CARD PHOTO -->
            <div class="kew-hero-card-right">
                <div class="kew-img-wrapper">
                    <img src="<?= base_url('images/kewenangan/family-header-cheerful.jpg') ?>" alt="Keluarga Indonesia Harmonis & Terlindungi" class="kew-hero-img">
                    
                    <!-- OVERLAY BADGES AT BOTTOM -->
                    <div class="kew-img-overlay-bar">
                        <div class="kew-overlay-badge badge-orange">
                            <span class="badge-title">Payung Hukum</span>
                            <span class="badge-sub">UU Perlindungan Anak & UU KIA</span>
                        </div>
                        <div class="kew-overlay-badge badge-green">
                            <span class="badge-title">Pengawasan Hak</span>
                            <span class="badge-sub">Independen via KPAI RI</span>
                        </div>
                        <div class="kew-overlay-badge badge-blue">
                            <span class="badge-title">Aksi Lokal</span>
                            <span class="badge-sub">DP3A & Hotline 112 Surabaya</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- 2. SECTION HEADER -->
    <section class="kew-section-header">
        <div class="kew-chip-tag chip-center">
            <span>Jaringan Otoritas Resmi Negara</span>
        </div>
        <h2 class="kew-section-title">
            Lembaga Otoritas & <span class="kew-pill kew-pill-green">Pusat Regulasi Hukum</span>
        </h2>
        <p class="kew-section-subtitle">
            Pilihlah situs resmi di bawah ini untuk mengunduh dokumen perundang-undangan asli, mengajukan aduan perlindungan, atau memperoleh layanan advokasi keluarga.
        </p>
    </section>

    <!-- 3. 4 KARTU UTAMA LEMBAGA OTORITAS -->
    <section class="kew-cards-section">
        <div class="kew-cards-grid">
            
            <!-- CARD 1: JDIH KemenPPPA -->
            <div class="kew-card card-orange-theme">
                <div class="kew-sticker-badge badge-orange-sticker">KemenPPPA RI</div>
                
                <div class="kew-card-img-wrap">
                    <img src="<?= base_url('images/kewenangan/gedung-kemenpppa.jpg') ?>" alt="Gedung KemenPPPA RI" class="kew-card-img">
                    <div class="kew-card-img-overlay">
                        <span class="kew-img-tag">🏛️ Gedung KemenPPPA RI</span>
                        <span class="kew-img-loc">📍 Jakarta Pusat</span>
                    </div>
                </div>

                <div class="kew-card-content">
                    <h3 class="kew-card-heading">
                        JDIH Kementerian Pemberdayaan Perempuan & Perlindungan Anak
                    </h3>

                    <p class="kew-card-desc">
                        Pusat dokumentasi dan naskah hukum resmi nasional yang mengatur standar pengasuhan ramah anak, indikator Kota Layak Anak (KLA), serta hak-hak ibu melahirkan.
                    </p>

                    <div class="kew-card-items">
                        <div class="kew-item-pill">
                            <div class="kew-item-dot dot-orange"></div>
                            <div class="kew-item-content">
                                <strong>Naskah UU KIA No. 4/2024:</strong> Undang-Undang Kesejahteraan Ibu dan Anak pada Fase 1.000 Hari Pertama Kehidupan.
                            </div>
                        </div>

                        <div class="kew-item-pill">
                            <div class="kew-item-dot dot-orange"></div>
                            <div class="kew-item-content">
                                <strong>PermenPPPA Pengasuhan Ramah Anak:</strong> Pedoman resmi standar pelayanan ruang laktasi, pengasuhan keluarga, dan daycare.
                            </div>
                        </div>

                        <div class="kew-item-pill">
                            <div class="kew-item-dot dot-orange"></div>
                            <div class="kew-item-content">
                                <strong>Evaluasi KLA Nasional:</strong> Indikator pemenuhan hak sipil, lingkungan keluarga, dan perlindungan khusus anak.
                            </div>
                        </div>
                    </div>

                    <div class="card-footer-action">
                        <a href="https://jdih.kemenpppa.go.id/" target="_blank" rel="noopener noreferrer" class="kew-action-btn btn-orange">
                            Kunjungi Website JDIH ↗
                        </a>
                    </div>
                </div>
            </div>

            <!-- CARD 2: KPAI -->
            <div class="kew-card card-green-theme">
                <div class="kew-sticker-badge badge-green-sticker">KPAI Independen</div>
                
                <div class="kew-card-img-wrap">
                    <img src="<?= base_url('images/kewenangan/gedung-kpai.jpg') ?>" alt="Kantor KPAI RI" class="kew-card-img">
                    <div class="kew-card-img-overlay">
                        <span class="kew-img-tag">🛡️ Kantor KPAI RI</span>
                        <span class="kew-img-loc">📍 Menteng, Jakarta Pusat</span>
                    </div>
                </div>

                <div class="kew-card-content">
                    <h3 class="kew-card-heading">
                        Komisi Perlindungan Anak Indonesia (KPAI)
                    </h3>

                    <p class="kew-card-desc">
                        Lembaga independen negara pengawas pemenuhan hak anak, penerima aduan pelanggaran, serta penangan kasus perundungan (bullying) dan advokasi sengketa hak asuh.
                    </p>

                    <div class="kew-card-items">
                        <div class="kew-item-pill">
                            <div class="kew-item-dot dot-green"></div>
                            <div class="kew-item-content">
                                <strong>Layanan Pengaduan Online Hak Anak:</strong> Saluran resmi pelaporan kasus kekerasan fisik, psikis, perundungan sekolah, atau <em>cyberbullying</em>.
                            </div>
                        </div>

                        <div class="kew-item-pill">
                            <div class="kew-item-dot dot-green"></div>
                            <div class="kew-item-content">
                                <strong>Advokasi & Mediasi Keluarga:</strong> Pendampingan pengawasan hak asuh anak, pencegahan penelantaran, dan pemenuhan nafkah anak.
                            </div>
                        </div>

                        <div class="kew-item-pill">
                            <div class="kew-item-dot dot-green"></div>
                            <div class="kew-item-content">
                                <strong>Laporan Statistik Perlindungan Anak:</strong> Publikasi data nasional tindak pelanggaran dan evaluasi kebijakan pengawasan anak.
                            </div>
                        </div>
                    </div>

                    <div class="card-footer-action">
                        <a href="https://www.kpai.go.id/" target="_blank" rel="noopener noreferrer" class="kew-action-btn btn-green">
                            Kunjungi Website KPAI ↗
                        </a>
                    </div>
                </div>
            </div>

            <!-- CARD 3: JDIHN Kemenkumham -->
            <div class="kew-card card-blue-theme">
                <div class="kew-sticker-badge badge-blue-sticker">Kemenkumham RI</div>
                
                <div class="kew-card-img-wrap">
                    <img src="<?= base_url('images/kewenangan/gedung-kemenkumham.jpg') ?>" alt="Gedung Kemenkumham RI" class="kew-card-img">
                    <div class="kew-card-img-overlay">
                        <span class="kew-img-tag">⚖️ Gedung Kemenkumham RI</span>
                        <span class="kew-img-loc">📍 Kuningan, Jakarta Selatan</span>
                    </div>
                </div>

                <div class="kew-card-content">
                    <h3 class="kew-card-heading">
                        JDIHN Kementerian Hukum & HAM RI
                    </h3>

                    <p class="kew-card-desc">
                        Jaringan Dokumentasi & Informasi Hukum Nasional terpadu yang memuat basis data naskah akademis, UU Perlindungan Anak, serta bantuan hukum gratis (Posbakum).
                    </p>

                    <div class="kew-card-items">
                        <div class="kew-item-pill">
                            <div class="kew-item-dot dot-blue"></div>
                            <div class="kew-item-content">
                                <strong>Basis Data Regulasi Terpadu:</strong> Akses pencarian seluruh undang-undang, PP, dan Perpres tentang hukum keluarga & anak.
                            </div>
                        </div>

                        <div class="kew-item-pill">
                            <div class="kew-item-dot dot-blue"></div>
                            <div class="kew-item-content">
                                <strong>Legalitas Adopsi & Pengangkatan Anak:</strong> Naskah akademik dan prosedur hukum tata cara adopsi anak secara sah di Indonesia.
                            </div>
                        </div>

                        <div class="kew-item-pill">
                            <div class="kew-item-dot dot-blue"></div>
                            <div class="kew-item-content">
                                <strong>Bantuan Hukum Gratis (Posbakum):</strong> Layanan konseling legal gratis dari Organisasi Bantuan Hukum terakreditasi Kemenkumham.
                            </div>
                        </div>
                    </div>

                    <div class="card-footer-action">
                        <a href="https://jdihn.go.id/" target="_blank" rel="noopener noreferrer" class="kew-action-btn btn-blue">
                            Kunjungi Website JDIHN ↗
                        </a>
                    </div>
                </div>
            </div>

            <!-- CARD 4: DP3A-PPKB Surabaya -->
            <div class="kew-card card-purple-theme">
                <div class="kew-sticker-badge badge-purple-sticker">Pemkot Surabaya</div>
                
                <div class="kew-card-img-wrap">
                    <img src="<?= base_url('images/kewenangan/gedung-siola-surabaya.jpg') ?>" alt="Gedung Siola DP3A Surabaya" class="kew-card-img">
                    <div class="kew-card-img-overlay">
                        <span class="kew-img-tag">🏙️ Sentra Pelayanan Siola Surabaya</span>
                        <span class="kew-img-loc">📍 Jl. Tunjungan No. 1-3, Surabaya</span>
                    </div>
                </div>

                <div class="kew-card-content">
                    <h3 class="kew-card-heading">
                        DP3A-PPKB Kota Surabaya (UPTD PPA)
                    </h3>

                    <p class="kew-card-desc">
                        Dinas Perlindungan Anak Kota Surabaya untuk respon cepat penanganan kekerasan ibu dan anak, konseling psikologis gratis, dan pendampingan trauma.
                    </p>

                    <div class="kew-card-items">
                        <div class="kew-item-pill">
                            <div class="kew-item-dot dot-purple"></div>
                            <div class="kew-item-content">
                                <strong>UPTD PPA Kota Surabaya:</strong> Unit penanganan darurat kekerasan fisik, psikis, penelantaran anak, dan perlindungan saksi/korban.
                            </div>
                        </div>

                        <div class="kew-item-pill">
                            <div class="kew-item-dot dot-purple"></div>
                            <div class="kew-item-content">
                                <strong>Konseling Psikologi & Trauma Healing:</strong> Layanan gratis psikolog klinis untuk pemulihan kesehatan mental ibu dan anak korban trauma.
                            </div>
                        </div>

                        <div class="kew-item-pill">
                            <div class="kew-item-dot dot-purple"></div>
                            <div class="kew-item-content">
                                <strong>Pos Sahabat Curhat RW & Hotline 112:</strong> Integrasi layanan konseling komunitas Balai RW dan Command Center Darurat 112 Surabaya.
                            </div>
                        </div>
                    </div>

                    <div class="card-footer-action">
                        <a href="https://dp3appkb.surabaya.go.id/" target="_blank" rel="noopener noreferrer" class="kew-action-btn btn-purple">
                            Kunjungi Website DP3A ↗
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- 4. EDUKASI INFOGRAFIK: HAK UTAMA ANAK SESUAI UU NO. 35 TAHUN 2014 -->
    <section class="kew-rights-section">
        <div class="kew-rights-box">
            
            <div class="kew-chip-tag chip-center">
                <span>Edukasi Hak Asasi Anak</span>
            </div>

            <h2 class="kew-rights-title">
                4 Klaster Hak Dasar Anak Menurut <span class="kew-pill kew-pill-blue">Undang-Undang RI</span>
            </h2>

            <p class="kew-rights-subtitle">
                Setiap anak di Indonesia dijamin oleh negara untuk memperoleh 4 hak konstitusional utama secara penuh tanpa diskriminasi.
            </p>

            <div class="kew-rights-grid">
                
                <!-- RIGHT 1: HAK HIDUP -->
                <div class="kew-right-card">
                    <div class="right-img-box">
                        <img src="<?= base_url('images/kewenangan/family-rafiki.png') ?>" alt="Hak Kelangsungan Hidup Anak" class="right-img">
                    </div>
                    <div class="right-badge tag-orange">1. Hak Kelangsungan Hidup</div>
                    <h4 class="right-title">Hak Atas Kehidupan & Kesehatan</h4>
                    <p class="right-desc">Hak untuk hidup, tumbuh, memperoleh akta kelahiran, identitas resmi negara, serta jaminan pelayanan kesehatan dan gizi seimbang.</p>
                </div>

                <!-- RIGHT 2: HAK TUMBUH KEMBANG -->
                <div class="kew-right-card">
                    <div class="right-img-box">
                        <img src="<?= base_url('images/kewenangan/family-amico.png') ?>" alt="Hak Tumbuh Kembang Anak" class="right-img">
                    </div>
                    <div class="right-badge tag-green">2. Hak Tumbuh Kembang</div>
                    <h4 class="right-title">Hak Pendidikan & Pola Asuh</h4>
                    <p class="right-desc">Hak memperoleh pendidikan layak, bimbingan moral, pengasuhan kasih sayang dari orang tua, serta ruang bermain yang aman.</p>
                </div>

                <!-- RIGHT 3: HAK PERLINDUNGAN -->
                <div class="kew-right-card">
                    <div class="right-img-box">
                        <img src="<?= base_url('images/kewenangan/family-cuate.png') ?>" alt="Hak Perlindungan Anak" class="right-img">
                    </div>
                    <div class="right-badge tag-blue">3. Hak Perlindungan Khusus</div>
                    <h4 class="right-title">Bebas Kekerasan & Eksploitasi</h4>
                    <p class="right-desc">Perlindungan penuh dari tindakan diskriminasi, kekerasan fisik/psikis, penelantaran, perundungan sekolah, serta eksploitasi ekonomi.</p>
                </div>

                <!-- RIGHT 4: HAK PARTISIPASI -->
                <div class="kew-right-card">
                    <div class="right-img-box">
                        <img src="<?= base_url('images/kewenangan/family-pana.png') ?>" alt="Hak Partisipasi Anak" class="right-img">
                    </div>
                    <div class="right-badge tag-amber">4. Hak Partisipasi Anak</div>
                    <h4 class="right-title">Hak Dengar Pendapat & KREASI</h4>
                    <p class="right-desc">Hak untuk menyuarakan pendapat, berpartisipasi dalam Forum Anak, serta mengembangkan potensi minat dan bakat diri secara positif.</p>
                </div>

            </div>

        </div>
    </section>

    <!-- 5. BANNER LAYANAN TANGGAP DARURAT & HOTLINE 24 JAM -->
    <section class="kew-emergency-section">
        <div class="kew-emergency-box">
            
            <div class="kew-emergency-left">
                <div class="kew-chip-tag chip-white">
                    <span>🚨 Pos Siaga Darurat 24 Jam Nonstop</span>
                </div>

                <h3 class="kew-emergency-title">
                    Membutuhkan Bantuan atau Mengetahui <span class="kew-pill kew-pill-orange">Kekerasan pada Anak?</span>
                </h3>

                <p class="kew-emergency-desc">
                    Pemerintah Republik Indonesia dan Pemkot Surabaya menyediakan layanan darurat bebas pulsa 24 jam nonstop untuk respon cepat penanganan, konseling krisis, dan perlindungan saksi/korban.
                </p>

                <div class="kew-emergency-notice">
                    <span class="notice-icon">🔒</span>
                    <span class="notice-text">Identitas dan kerahasiaan pelapor dijamin penuh oleh undang-undang.</span>
                </div>
            </div>

            <!-- HOTLINE BUTTON CARDS GRID -->
            <div class="kew-emergency-right">
                <div class="hotline-cards-grid">
                    
                    <!-- HOTLINE 1: SAPA 129 -->
                    <a href="tel:129" class="hotline-card card-call">
                        <div class="hotline-icon-box box-orange">📞</div>
                        <div class="hotline-info">
                            <span class="hotline-num">Call Center SAPA 129</span>
                            <span class="hotline-sub">Panggilan Bebas Pulsa KemenPPPA RI</span>
                        </div>
                    </a>

                    <!-- HOTLINE 2: WA SAPA -->
                    <a href="https://wa.me/628111129129" target="_blank" rel="noopener noreferrer" class="hotline-card card-wa">
                        <div class="hotline-icon-box box-green">💬</div>
                        <div class="hotline-info">
                            <span class="hotline-num">08111-129-129</span>
                            <span class="hotline-sub">WhatsApp Layanan SAPA KemenPPPA</span>
                        </div>
                    </a>

                    <!-- HOTLINE 3: COMMAND CENTER 112 SURABAYA -->
                    <a href="tel:112" class="hotline-card card-surabaya">
                        <div class="hotline-icon-box box-red">🚑</div>
                        <div class="hotline-info">
                            <span class="hotline-num">Hotline 112 Surabaya</span>
                            <span class="hotline-sub">Command Center Darurat Pemkot</span>
                        </div>
                    </a>

                    <!-- HOTLINE 4: PENGADUAN KPAI ONLINE -->
                    <a href="https://www.kpai.go.id/layanan-pengaduan" target="_blank" rel="noopener noreferrer" class="hotline-card card-kpai">
                        <div class="hotline-icon-box box-blue">📝</div>
                        <div class="hotline-info">
                            <span class="hotline-num">Pengaduan Online KPAI</span>
                            <span class="hotline-sub">Formulir Advokasi Kasus Resmi</span>
                        </div>
                    </a>

                </div>
            </div>

        </div>
    </section>

</div>

<style>
    /* KEWANANGAN PAGE STYLES */
    .kew-page-wrapper {
        background-color: #FFFDF9;
        padding: 50px 4% 90px;
        font-family: 'Outfit', sans-serif;
        color: #431407;
        overflow-x: hidden;
    }

    /* CHIP TAG ABOVE HEADINGS */
    .kew-chip-tag {
        display: inline-block;
        background-color: #F8EFE6;
        color: #78350F;
        padding: 6px 18px;
        border-radius: 20px;
        font-size: 0.88rem;
        font-weight: 700;
        letter-spacing: 0.3px;
        margin-bottom: 16px;
        border: 1px solid rgba(249, 115, 22, 0.15);
    }

    .chip-center {
        margin: 0 auto 14px auto;
    }

    .chip-white {
        background-color: rgba(255, 255, 255, 0.9);
        color: #431407;
    }

    /* HIGHLIGHT PILL BADGES FOR TEXT */
    .kew-pill {
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

    .kew-pill-orange { background-color: #F97316; }
    .kew-pill-green { background-color: #22C55E; }
    .kew-pill-blue { background-color: #3B82F6; }
    .kew-pill-amber { background-color: #F59E0B; }

    /* HERO SECTION */
    .kew-hero-container {
        max-width: 1240px;
        margin: 0 auto 60px;
    }

    .kew-hero-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 30px;
        align-items: stretch;
    }

    .kew-hero-card-left {
        background: linear-gradient(135deg, #FFF4EE 0%, #FFEDD5 100%);
        border: 1.5px solid rgba(249, 115, 22, 0.25);
        box-shadow: 0 10px 30px rgba(249, 115, 22, 0.08);
        border-radius: 28px;
        padding: 50px 45px;
        position: relative;
        display: flex;
        flex-direction: column;
        justify-content: center;
        overflow: hidden;
    }

    .kew-svg-curve {
        position: absolute;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        pointer-events: none;
    }

    .kew-hero-title {
        font-family: 'Outfit', sans-serif;
        font-size: 3.1rem;
        font-weight: 800;
        color: #431407;
        line-height: 1.2;
        margin-bottom: 20px;
        letter-spacing: -0.5px;
    }

    .kew-hero-subtitle {
        font-size: 1.12rem;
        color: #666;
        line-height: 1.65;
        margin-bottom: 30px;
        max-width: 500px;
    }

    .kew-hero-stats {
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
        font-size: 1.3rem;
        font-weight: 800;
        color: #F97316;
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
    .kew-hero-card-right {
        position: relative;
        border-radius: 28px;
        overflow: hidden;
        border: 1.5px solid rgba(67, 20, 7, 0.1);
        box-shadow: 0 10px 30px rgba(67, 20, 7, 0.08);
    }

    .kew-img-wrapper {
        width: 100%;
        height: 100%;
        min-height: 420px;
        position: relative;
    }

    .kew-hero-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    .kew-img-overlay-bar {
        position: absolute;
        bottom: 16px;
        left: 16px;
        right: 16px;
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 10px;
    }

    .kew-overlay-badge {
        padding: 12px 10px;
        border-radius: 18px;
        backdrop-filter: blur(10px);
        box-shadow: 0 4px 14px rgba(0, 0, 0, 0.08);
        display: flex;
        flex-direction: column;
        justify-content: center;
        text-align: center;
    }

    .badge-orange { background-color: rgba(255, 237, 213, 0.95); color: #7C2D12; }
    .badge-green { background-color: rgba(220, 252, 231, 0.95); color: #14532D; }
    .badge-blue { background-color: rgba(219, 234, 254, 0.95); color: #1E3A8A; }

    .badge-title { font-weight: 700; font-size: 0.85rem; line-height: 1.2; }
    .badge-sub { font-size: 0.74rem; opacity: 0.85; margin-top: 2px; }

    /* SECTION HEADER */
    .kew-section-header {
        text-align: center;
        max-width: 800px;
        margin: 0 auto 50px;
    }

    .kew-section-title {
        font-size: 2.3rem;
        font-weight: 800;
        color: #431407;
        line-height: 1.3;
        margin-bottom: 12px;
    }

    .kew-section-subtitle {
        font-size: 1.05rem;
        color: #666;
        line-height: 1.6;
    }

    /* 4 CARDS SECTION & GRID */
    .kew-cards-section {
        max-width: 1240px;
        margin: 0 auto 70px;
    }

    .kew-cards-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 32px;
        align-items: stretch;
    }

    .kew-card {
        border-radius: 26px;
        position: relative;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card-orange-theme {
        background-color: #FFF4EE;
        border: 1.5px solid rgba(249, 115, 22, 0.25);
        box-shadow: 0 10px 28px rgba(249, 115, 22, 0.07);
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

    .card-purple-theme {
        background-color: #FFFBEB;
        border: 1.5px solid rgba(245, 158, 11, 0.25);
        box-shadow: 0 10px 28px rgba(245, 158, 11, 0.07);
    }

    .kew-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 18px 38px rgba(67, 20, 7, 0.1);
    }

    /* STICKER BADGES TOP LEFT OF CARDS */
    .kew-sticker-badge {
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

    .badge-orange-sticker { background-color: #F97316; }
    .badge-green-sticker { background-color: #22C55E; }
    .badge-blue-sticker { background-color: #3B82F6; }
    .badge-purple-sticker { background-color: #F59E0B; }

    /* CARD IMAGE WRAPPER */
    .kew-card-img-wrap {
        position: relative;
        width: 100%;
        height: 210px;
        overflow: hidden;
    }

    .kew-card-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
        transition: transform 0.4s ease;
    }

    .kew-card:hover .kew-card-img {
        transform: scale(1.05);
    }

    .kew-card-img-overlay {
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

    .kew-card-content {
        padding: 28px 26px;
        display: flex;
        flex-direction: column;
        flex-grow: 1;
    }

    .kew-card-heading {
        font-size: 1.35rem;
        font-weight: 800;
        color: #431407;
        margin-bottom: 10px;
        line-height: 1.35;
    }

    .kew-card-desc {
        font-size: 0.95rem;
        color: #555;
        line-height: 1.6;
        margin-bottom: 20px;
    }

    /* ITEM PILLS INSIDE CARDS */
    .kew-card-items {
        display: flex;
        flex-direction: column;
        gap: 12px;
        flex-grow: 1;
        margin-bottom: 24px;
    }

    .kew-item-pill {
        background-color: #ffffff;
        border-radius: 16px;
        padding: 14px 16px;
        display: flex;
        align-items: flex-start;
        gap: 10px;
        border: 1px solid rgba(67, 20, 7, 0.08);
        box-shadow: 0 4px 12px rgba(67, 20, 7, 0.03);
    }

    .kew-item-dot {
        width: 10px;
        height: 10px;
        border-radius: 50%;
        flex-shrink: 0;
        margin-top: 6px;
    }

    .dot-orange { background-color: #F97316; }
    .dot-green { background-color: #22C55E; }
    .dot-blue { background-color: #3B82F6; }
    .dot-purple { background-color: #F59E0B; }

    .kew-item-content {
        font-size: 0.9rem;
        color: #555;
        line-height: 1.55;
    }

    .kew-item-content strong {
        color: #431407;
    }

    /* ACTION BUTTONS */
    .card-footer-action {
        margin-top: auto;
    }

    .kew-action-btn {
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

    .btn-orange {
        background-color: #F97316;
        color: #ffffff;
        box-shadow: 0 4px 14px rgba(249, 115, 22, 0.25);
    }

    .btn-orange:hover {
        background-color: #ea580c;
        color: #ffffff;
        transform: translateY(-2px);
    }

    .btn-green {
        background-color: #22C55E;
        color: #ffffff;
        box-shadow: 0 4px 14px rgba(34, 197, 94, 0.25);
    }

    .btn-green:hover {
        background-color: #16a34a;
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

    .btn-purple {
        background-color: #F59E0B;
        color: #ffffff;
        box-shadow: 0 4px 14px rgba(245, 158, 11, 0.25);
    }

    .btn-purple:hover {
        background-color: #d97706;
        color: #ffffff;
        transform: translateY(-2px);
    }

    /* 4 HAK UTAMA ANAK SECTION */
    .kew-rights-section {
        max-width: 1240px;
        margin: 0 auto 70px;
    }

    .kew-rights-box {
        background-color: #ffffff;
        border: 1.5px solid rgba(67, 20, 7, 0.1);
        box-shadow: 0 12px 36px rgba(67, 20, 7, 0.05);
        border-radius: 32px;
        padding: 50px 40px;
        text-align: center;
    }

    .kew-rights-title {
        font-size: 2.2rem;
        font-weight: 800;
        color: #431407;
        margin-bottom: 12px;
    }

    .kew-rights-subtitle {
        font-size: 1.05rem;
        color: #666;
        max-width: 700px;
        margin: 0 auto 40px;
    }

    .kew-rights-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 20px;
        text-align: left;
    }

    .kew-right-card {
        background-color: #FFFDF9;
        border: 1.5px solid rgba(67, 20, 7, 0.08);
        border-radius: 22px;
        padding: 22px 20px;
        display: flex;
        flex-direction: column;
        transition: transform 0.25s ease;
    }

    .kew-right-card:hover {
        transform: translateY(-4px);
        border-color: rgba(249, 115, 22, 0.3);
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

    .tag-orange { background-color: #FFEDD5; color: #9A3412; }
    .tag-green { background-color: #DCFCE7; color: #15803D; }
    .tag-blue { background-color: #DBEAFE; color: #1D4ED8; }
    .tag-amber { background-color: #FEF3C7; color: #B45309; }

    .right-title {
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

    /* EMERGENCY HOTLINE SECTION */
    .kew-emergency-section {
        max-width: 1240px;
        margin: 0 auto;
    }

    .kew-emergency-box {
        background: linear-gradient(135deg, #FEF3C7 0%, #FDE68A 100%);
        border: 1.5px solid rgba(245, 158, 11, 0.3);
        box-shadow: 0 12px 36px rgba(245, 158, 11, 0.1);
        border-radius: 32px;
        padding: 48px 42px;
        display: grid;
        grid-template-columns: 1fr 1.2fr;
        gap: 40px;
        align-items: center;
    }

    .kew-emergency-title {
        font-size: 2.2rem;
        font-weight: 800;
        color: #78350F;
        line-height: 1.25;
        margin-bottom: 16px;
    }

    .kew-emergency-desc {
        font-size: 1.02rem;
        color: #92400E;
        line-height: 1.6;
        margin-bottom: 24px;
    }

    .kew-emergency-notice {
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

    .box-orange { background-color: #FFF4EE; color: #F97316; }
    .box-green { background-color: #F0FDF4; color: #22C55E; }
    .box-red { background-color: #FEE2E2; color: #EF4444; }
    .box-blue { background-color: #EFF6FF; color: #3B82F6; }

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

    /* RESPONSIVE DESIGN BREAKPOINTS */
    @media (max-width: 1024px) {
        .kew-hero-grid,
        .kew-cards-grid,
        .kew-emergency-box {
            grid-template-columns: 1fr;
        }

        .kew-rights-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .kew-hero-title,
        .kew-section-title,
        .kew-rights-title,
        .kew-emergency-title {
            font-size: 2rem;
        }

        .kew-img-overlay-bar {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 640px) {
        .kew-page-wrapper {
            padding: 30px 16px 60px;
        }

        .kew-hero-card-left,
        .kew-rights-box,
        .kew-emergency-box {
            padding: 35px 20px;
            border-radius: 22px;
        }

        .kew-rights-grid,
        .hotline-cards-grid {
            grid-template-columns: 1fr;
        }

        .kew-hero-stats {
            flex-direction: column;
            gap: 10px;
        }

        .stat-pill-divider {
            display: none;
        }
    }
</style>

<?= $this->endSection() ?>
