<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<!-- GOOGLE FONTS IMPORT (OUTFIT, CAVEAT, PLAYFAIR DISPLAY) -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Caveat:wght@700&family=Outfit:wght@400;500;600;700;800&family=Playfair+Display:ital,wght@0,600;0,800;1,600&display=swap" rel="stylesheet">

<div class="about-page-wrapper">
    
    <!-- 1. TOP HERO SECTION -->
    <section class="about-hero-container">
        <div class="about-hero-grid">
            
            <!-- HERO LEFT CARD -->
            <div class="about-hero-card-left">
                <!-- DASHED SVG ACCENT (WARM INDIGO THEME) -->
                <svg class="about-svg-curve" viewBox="0 0 300 200" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M10 100 C 90 20, 210 180, 290 100" stroke="#6366F1" stroke-width="2.5" stroke-dasharray="6 6" opacity="0.35"/>
                    <circle cx="290" cy="100" r="4" fill="#6366F1"/>
                    <circle cx="10" cy="100" r="4" fill="#6366F1"/>
                </svg>

                <div class="about-chip-tag">
                    <span>✨ Mengenal Ekosistem Parentela</span>
                </div>

                <h1 class="about-hero-title">
                    Mitra Terpercaya <span class="about-pill about-pill-indigo">Setiap Keluarga Indonesia</span>
                </h1>

                <p class="about-hero-subtitle">
                    Parentela hadir sebagai platform pendampingan pengasuhan terpadu. Kami mengombinasikan literasi medis terverifikasi, direktori pengasuh berizin, panduan hukum keluarga, serta fitur interaktif cerdas demi menciptakan ruang tumbuh kembang anak yang aman dan bahagia.
                </p>

                <!-- QUICK STATS BADGES -->
                <div class="about-hero-stats">
                    <div class="stat-pill-item">
                        <span class="stat-num">10.000+</span>
                        <span class="stat-lbl">Keluarga Terbantu</span>
                    </div>
                    <div class="stat-pill-divider"></div>
                    <div class="stat-pill-item">
                        <span class="stat-num">100%</span>
                        <span class="stat-lbl">Edukasi Terverifikasi</span>
                    </div>
                    <div class="stat-pill-divider"></div>
                    <div class="stat-pill-item">
                        <span class="stat-num">15+</span>
                        <span class="stat-lbl">Yayasan Nanny Berizin</span>
                    </div>
                </div>
            </div>

            <!-- HERO RIGHT CARD PHOTO -->
            <div class="about-hero-card-right">
                <div class="about-img-wrapper">
                    <img src="<?= base_url('images/keluarga-aman-baru.jpg') ?>" alt="Tentang Ekosistem Parentela" class="about-hero-img">
                    
                    <!-- OVERLAY BADGES AT BOTTOM -->
                    <div class="about-img-overlay-bar">
                        <div class="about-overlay-badge badge-indigo">
                            <span class="badge-title">Edukasi Medis</span>
                            <span class="badge-sub">Bebas Mitos & Hoaks</span>
                        </div>
                        <div class="about-overlay-badge badge-violet">
                            <span class="badge-title">Direktori Resmi</span>
                            <span class="badge-sub">Nanny & Yayasan Berizin</span>
                        </div>
                        <div class="about-overlay-badge badge-rose">
                            <span class="badge-title">Perangkat Cerdas</span>
                            <span class="badge-sub">Kuis & Meal Planner</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- NAVIGATION ANCHOR BAR -->
    <div class="about-nav-anchors-wrap">
        <div class="about-nav-anchors">
            <a href="#siapa-kami" class="anchor-btn highlight">📖 Siapa Kami</a>
            <a href="#visi-misi" class="anchor-btn">🎯 Visi & Misi</a>
            <a href="#nilai-utama" class="anchor-btn">💎 Nilai Utama</a>
            <a href="#faq-section" class="anchor-btn">❓ FAQ (Tanya Jawab)</a>
        </div>
    </div>

    <!-- 2. SIAPA KAMI (ABOUT STORY) -->
    <section class="about-section-container" id="siapa-kami">
        <div class="about-chip-tag chip-center">
            <span>Perjalanan Kami</span>
        </div>
        <h2 class="about-section-title text-center">
            Membangun Masa Depan <span class="about-pill about-pill-indigo">Anak Indonesia</span>
        </h2>
        <p class="about-section-sub text-center">
            Parentela lahir dari impian untuk mempermudah setiap orang tua dalam mengambil keputusan pengasuhan yang tepat.
        </p>

        <div class="story-grid">
            <div class="story-card-left">
                <div class="story-img-box">
                    <img src="<?= base_url('images/indonesian_family_about.jpg') ?>" alt="Keluarga Indonesia Membimbing Anak - Parentela" class="story-img">
                </div>
            </div>

            <div class="story-card-right">
                <h3 class="story-heading">Kenapa Parentela Hadir?</h3>
                <p class="story-text">
                    Di era digital, orang tua sering kali dihadapkan pada luapan informasi parenting yang simpang siur dan mitos yang tidak tervalidasi secara medis. Hal ini membuat momen membesarkan anak terasa membingungkan dan penuh kecemasan.
                </p>
                <p class="story-text">
                    <strong>Parentela</strong> hadir sebagai oasis jawaban terpercaya. Kami menjembatani kebutuhan orang tua muda akan informasi medis yang sahih (rekomendasi IDAI & Kementerian Kesehatan), direktori tempat asuh serta nanny berizin legal, panduan hak kewenangan hukum keluarga, hingga kalkulator nutrisi & MPASI sehari-hari.
                </p>

                <!-- 4 CORE PILLARS -->
                <div class="pillars-grid">
                    <div class="pillar-item">
                        <span class="pillar-icon">🩺</span>
                        <div>
                            <strong>Edukasi Medis & Gizi</strong>
                            <p>Artikel & resep MPASI berbasis fakta sains resmi.</p>
                        </div>
                    </div>
                    <div class="pillar-item">
                        <span class="pillar-icon">🛡️</span>
                        <div>
                            <strong>Perlindungan Hukum</strong>
                            <p>Panduan kewenangan & hak legal keluarga Indonesia.</p>
                        </div>
                    </div>
                    <div class="pillar-item">
                        <span class="pillar-icon">🏠</span>
                        <div>
                            <strong>Direktori Terverifikasi</strong>
                            <p>Pilihan nanny, daycare, & panti asuhan berizin.</p>
                        </div>
                    </div>
                    <div class="pillar-item">
                        <span class="pillar-icon">🧮</span>
                        <div>
                            <strong>Perangkat Interaktif</strong>
                            <p>Kuis KB, Meal Planner, & kalkulator jarak kehamilan.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 3. VISI & MISI SECTION -->
    <section class="about-section-container bg-indigo-card" id="visi-misi">
        <div class="about-chip-tag chip-center">
            <span>Arah & Komitmen Kami</span>
        </div>
        <h2 class="about-section-title text-center">
            Visi & Misi <span class="about-pill about-pill-indigo">Parentela</span>
        </h2>
        <p class="about-section-sub text-center">
            Komitmen kami untuk mewujudkan generasi emas Indonesia yang sehat, berkarakter, dan berdaya.
        </p>

        <!-- VISION BOX -->
        <div class="vision-banner">
            <div class="vision-icon">👁️‍🗨️</div>
            <div class="vision-body">
                <h3>Visi Utama Kami</h3>
                <p>
                    "Menjadi ekosistem digital pendampingan keluarga nomor satu di Indonesia yang mewujudkan tumbuh kembang anak secara sehat, cerdas, bahagia, serta terpercaya dalam memberikan perlindungan medis dan hukum bagi setiap rumah tangga."
                </p>
            </div>
        </div>

        <!-- MISSION GRID -->
        <div class="missions-grid">
            <div class="mission-card">
                <div class="m-num">01</div>
                <h4>Edukasi Medis Bebas Mitos</h4>
                <p>Menyajikan panduan kesehatan, gizi balita, dan pola asuh ilmiah yang dikemas secara ramah dan mudah dipraktikkan.</p>
            </div>

            <div class="mission-card">
                <div class="m-num">02</div>
                <h4>Direktori Pengasuh Berizin</h4>
                <p>Menghubungkan orang tua dengan yayasan nanny, daycare, dan panti sosial yang telah melalui verifikasi legalitas resmi.</p>
            </div>

            <div class="mission-card">
                <div class="m-num">03</div>
                <h4>Teknologi Interaktif Cerdas</h4>
                <p>Mengembangkan alat bantu pintar seperti Meal Planner MPASI, Kuis Kecocokan KB, dan kalkulator porsi untuk memudahkan dapur ibu.</p>
            </div>

            <div class="mission-card">
                <div class="m-num">04</div>
                <h4>Komunitas Suportif</h4>
                <p>Membangun ruang aman tempat para orang tua dapat saling berbagi pengalaman nyata, trik anti-GTM, dan dukungan emosional.</p>
            </div>
        </div>
    </section>

    <!-- 4. NILAI-NILAI UTAMA (CORE VALUES) -->
    <section class="about-section-container" id="nilai-utama">
        <div class="about-chip-tag chip-center">
            <span>Prinsip Kerja Kami</span>
        </div>
        <h2 class="about-section-title text-center">
            Nilai-Nilai Utama <span class="about-pill about-pill-indigo">Parentela</span>
        </h2>
        <p class="about-section-sub text-center">
            Prinsip yang menuntun setiap artikel, fitur, dan layanan yang kami hadirkan untuk Anda.
        </p>

        <div class="values-grid">
            <div class="value-card">
                <div class="v-icon bg-indigo">💙</div>
                <h3>Integritas Medis</h3>
                <p>Selalu berlandaskan pedoman kesehatan resmi IDAI & Kemenkes tanpa menjual klaim sepihak.</p>
            </div>

            <div class="value-card">
                <div class="v-icon bg-violet">🤝</div>
                <h3>Empati Keluarga</h3>
                <p>Memahami pergumulan nyata orang tua muda dengan pendekatan hangat tanpa menghakimi.</p>
            </div>

            <div class="value-card">
                <div class="v-icon bg-rose">🛡️</div>
                <h3>Keamanan & Transparansi</h3>
                <p>Menjamin transparansi data lembaga pengasuh dan keamanan hak anak serta perempuan.</p>
            </div>

            <div class="value-card">
                <div class="v-icon bg-amber">🌱</div>
                <h3>Inovasi Berkelanjutan</h3>
                <p>Terus berinovasi menghadirkan fitur-fitur praktis yang menjawab kebutuhan dapur & rumah tangga modern.</p>
            </div>
        </div>
    </section>

    <!-- 5. FREQUENTLY ASKED QUESTIONS (FAQ ACCORDION SECTION) -->
    <section class="about-section-container" id="faq-section">
        <div class="about-chip-tag chip-center">
            <span>Pertanyaan Umum</span>
        </div>
        <h2 class="about-section-title text-center">
            Frequently Asked <span class="about-pill about-pill-indigo">Questions (FAQ)</span>
        </h2>
        <p class="about-section-sub text-center">
            Temukan jawaban atas pertanyaan yang paling sering diajukan mengenai Parentela.
        </p>

        <div class="faq-accordion-wrapper">
            
            <!-- FAQ ITEM 1 -->
            <div class="faq-accordion-item active">
                <button class="faq-question-btn" onclick="toggleFaq(this)">
                    <span>❓ Apa itu Parentela dan bagaimana platform ini membantu keluarga muda?</span>
                    <span class="faq-icon-toggle">−</span>
                </button>
                <div class="faq-answer-panel" style="display: block;">
                    <p>
                        Parentela adalah ekosistem pendampingan pengasuhan terpadu untuk keluarga Indonesia. Kami membantu orang tua muda melalui artikel kesehatan medis terverifikasi, resep MPASI presisi dengan kalkulator porsi, kuis pemilihan kontrasepsi (KB), panduan kewenangan hukum keluarga, serta direktori resmi tempat pencarian nanny dan daycare berizin.
                    </p>
                </div>
            </div>

            <!-- FAQ ITEM 2 -->
            <div class="faq-accordion-item">
                <button class="faq-question-btn" onclick="toggleFaq(this)">
                    <span>🏥 Apakah seluruh informasi medis, gizi, dan resep di Parentela dapat dipercaya?</span>
                    <span class="faq-icon-toggle">+</span>
                </button>
                <div class="faq-answer-panel">
                    <p>
                        Ya, 100% informasi kesehatan, gizi balita, dan panduan kontrasepsi di Parentela disusun berdasarkan rekomendasi resmi dari Ikatan Dokter Anak Indonesia (IDAI), Kementerian Kesehatan RI, serta praktisi kesehatan tepercaya. Kami memprioritaskan literasi ilmiah yang bebas dari hoaks dan mitos.
                    </p>
                </div>
            </div>

            <!-- FAQ ITEM 3 -->
            <div class="faq-accordion-item">
                <button class="faq-question-btn" onclick="toggleFaq(this)">
                    <span>🏠 Bagaimana Parentela menyeleksi direktori Nanny, Daycare, dan Yayasan Pengasuh?</span>
                    <span class="faq-icon-toggle">+</span>
                </button>
                <div class="faq-answer-panel">
                    <p>
                        Setiap yayasan atau lembaga yang terdaftar di direktori Parentela telah melalui verifikasi izin operasional resmi, kelengkapan surat legalitas hukum, serta evaluasi riwayat pelayanan. Kami juga mengosongkan atau menghapus lembaga yang tidak memiliki situs resmi atau izin aktif demi keamanan keluarga Anda.
                    </p>
                </div>
            </div>

            <!-- FAQ ITEM 4 -->
            <div class="faq-accordion-item">
                <button class="faq-question-btn" onclick="toggleFaq(this)">
                    <span>🧮 Apakah seluruh fitur interaktif (Kuis KB, Meal Planner, & Kalkulator) gratis?</span>
                    <span class="faq-icon-toggle">+</span>
                </button>
                <div class="faq-answer-panel">
                    <p>
                        Ya! Seluruh fitur interaktif di Parentela — seperti Kuis "Cari KB yang Cocok", Kalkulator Jarak Kehamilan, Portion Scaler MPASI, dan Weekly Meal Planner — dapat diakses secara 100% gratis tanpa biaya tersembunyi.
                    </p>
                </div>
            </div>

            <!-- FAQ ITEM 5 -->
            <div class="faq-accordion-item">
                <button class="faq-question-btn" onclick="toggleFaq(this)">
                    <span>🤝 Bagaimana cara mendaftar sebagai mitra lembaga atau berkontribusi dalam komunitas?</span>
                    <span class="faq-icon-toggle">+</span>
                </button>
                <div class="faq-answer-panel">
                    <p>
                        Bagi yayasan pengasuh, dokter, ahli gizi, atau praktisi parenting yang ingin bekerja sama, Anda dapat menghubungi tim kami melalui email <strong>admin@parentela.id</strong> atau melalui formulir kontak kami. Untuk orang tua, Anda dapat langsung membagikan trik dapur di kolom Anti-GTM pada halaman Resep MPASI.
                    </p>
                </div>
            </div>

        </div>
    </section>

    <!-- 6. CALL TO ACTION BANNER -->
    <section class="about-section-container">
        <div class="about-cta-banner">
            <h2>Mari Bertumbuh Bersama <span class="about-pill about-pill-indigo">Parentela</span></h2>
            <p>Dapatkan panduan kesehatan medis, direktori nanny terpercaya, dan fitur dapur interaktif untuk keluarga Anda.</p>
            <div class="cta-buttons">
                <a href="<?= base_url('articles') ?>" class="btn-cta-primary">📚 Jelajahi Artikel & Panduan</a>
                <a href="<?= base_url('nanny') ?>" class="btn-cta-secondary">🏡 Cari Nanny Terverifikasi</a>
            </div>
        </div>
    </section>

</div>

<!-- PAGE STYLES (WARM INDIGO & VIOLET THEME) -->
<style>
.about-page-wrapper {
    font-family: 'Outfit', sans-serif;
    color: #1F2937;
    background-color: #FAFAFA;
    padding-bottom: 80px;
}

/* 1. HERO CONTAINER */
.about-hero-container {
    background: linear-gradient(135deg, #EEF2FF 0%, #E0E7FF 100%);
    padding: 60px 5% 50px;
    border-bottom: 1px solid #C7D2FE;
    position: relative;
    overflow: hidden;
}

.about-hero-grid {
    max-width: 1240px;
    margin: 0 auto;
    display: grid;
    grid-template-columns: 1.1fr 0.9fr;
    gap: 40px;
    align-items: center;
}

.about-hero-card-left {
    position: relative;
    z-index: 2;
}

.about-svg-curve {
    position: absolute;
    top: -40px;
    left: -20px;
    width: 260px;
    height: 180px;
    pointer-events: none;
    z-index: -1;
}

.about-chip-tag {
    display: inline-flex;
    align-items: center;
    padding: 6px 16px;
    background-color: #E0E7FF;
    border: 1px solid #A5B4FC;
    border-radius: 50px;
    font-size: 0.88rem;
    font-weight: 600;
    color: #4338CA;
    margin-bottom: 20px;
}

.about-chip-tag.chip-center {
    margin: 0 auto 16px;
}

.about-hero-title {
    font-size: 2.8rem;
    font-weight: 800;
    line-height: 1.2;
    color: #1E1B4B;
    margin-bottom: 18px;
}

.about-pill {
    display: inline-block;
    padding: 4px 18px;
    border-radius: 40px;
    color: #FFFFFF;
    font-family: 'Outfit', sans-serif;
}

.about-pill-indigo {
    background-color: #4F46E5;
    box-shadow: 0 4px 14px rgba(79, 70, 229, 0.35);
}

.about-hero-subtitle {
    font-size: 1.08rem;
    line-height: 1.6;
    color: #374151;
    margin-bottom: 30px;
}

.about-hero-stats {
    display: inline-flex;
    align-items: center;
    background: #FFFFFF;
    padding: 14px 24px;
    border-radius: 20px;
    box-shadow: 0 10px 25px rgba(79, 70, 229, 0.08);
    border: 1px solid #E0E7FF;
    gap: 20px;
}

.stat-pill-item {
    display: flex;
    flex-direction: column;
}

.stat-num {
    font-weight: 800;
    font-size: 1.15rem;
    color: #4F46E5;
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
.about-img-wrapper {
    position: relative;
    border-radius: 28px;
    overflow: hidden;
    box-shadow: 0 20px 40px rgba(0,0,0,0.12);
    border: 4px solid #FFFFFF;
}

.about-hero-img {
    width: 100%;
    height: 420px;
    object-fit: cover;
    display: block;
}

.about-img-overlay-bar {
    position: absolute;
    bottom: 16px;
    left: 16px;
    right: 16px;
    display: grid;
    grid-template-columns: 1fr 1fr 1fr;
    gap: 10px;
}

.about-overlay-badge {
    background: rgba(255, 255, 255, 0.94);
    backdrop-filter: blur(8px);
    padding: 10px 12px;
    border-radius: 14px;
    display: flex;
    flex-direction: column;
    border: 1px solid rgba(255, 255, 255, 0.7);
}

.badge-indigo .badge-title { color: #4F46E5; }
.badge-violet .badge-title { color: #7C3AED; }
.badge-rose .badge-title { color: #E11D48; }

.badge-title { font-size: 0.82rem; font-weight: 700; }
.badge-sub { font-size: 0.72rem; color: #4B5563; }

/* ANCHORS NAV BAR */
.about-nav-anchors-wrap {
    background: #FFFFFF;
    border-bottom: 1px solid #E5E7EB;
    position: sticky;
    top: 0;
    z-index: 100;
    box-shadow: 0 4px 12px rgba(0,0,0,0.03);
}

.about-nav-anchors {
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
    background: #4F46E5;
    color: #FFFFFF;
}

/* SECTIONS COMMON */
.about-section-container {
    max-width: 1240px;
    margin: 60px auto 0;
    padding: 0 5%;
}

.about-section-title {
    font-size: 2.2rem;
    font-weight: 800;
    color: #1F2937;
    margin-top: 8px;
    margin-bottom: 10px;
}

.about-section-sub {
    font-size: 1.02rem;
    color: #6B7280;
    margin-bottom: 35px;
}

/* 2. STORY GRID */
.story-grid {
    display: grid;
    grid-template-columns: 0.9fr 1.1fr;
    gap: 40px;
    align-items: center;
}

.story-img-box {
    border-radius: 24px;
    overflow: hidden;
    box-shadow: 0 15px 35px rgba(0,0,0,0.08);
}

.story-img {
    width: 100%;
    height: 400px;
    object-fit: cover;
    display: block;
}

.story-heading {
    font-size: 1.5rem;
    font-weight: 700;
    color: #1E1B4B;
    margin-bottom: 12px;
}

.story-text {
    font-size: 0.95rem;
    color: #4B5563;
    line-height: 1.6;
    margin-bottom: 16px;
}

.pillars-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 16px;
    margin-top: 24px;
}

.pillar-item {
    background: #FFFFFF;
    border: 1px solid #E5E7EB;
    border-radius: 16px;
    padding: 14px;
    display: flex;
    gap: 12px;
    align-items: flex-start;
}

.pillar-icon {
    font-size: 1.4rem;
}

.pillar-item strong {
    display: block;
    font-size: 0.88rem;
    color: #1F2937;
}

.pillar-item p {
    font-size: 0.78rem;
    color: #6B7280;
    margin: 2px 0 0;
}

/* 3. VISI & MISI SECTION */
.bg-indigo-card {
    background: #EEF2FF;
    padding: 50px 5%;
    border-radius: 30px;
}

.vision-banner {
    background: #FFFFFF;
    border-radius: 24px;
    padding: 30px;
    display: flex;
    gap: 20px;
    align-items: center;
    box-shadow: 0 10px 30px rgba(79, 70, 229, 0.08);
    margin-bottom: 30px;
    border: 1px solid #C7D2FE;
}

.vision-icon {
    font-size: 2.5rem;
    background: #EEF2FF;
    width: 70px;
    height: 70px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.vision-body h3 {
    font-size: 1.2rem;
    font-weight: 700;
    color: #312E81;
    margin-bottom: 6px;
}

.vision-body p {
    font-size: 1rem;
    color: #4338CA;
    line-height: 1.5;
    font-style: italic;
    margin: 0;
}

.missions-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
    gap: 20px;
}

.mission-card {
    background: #FFFFFF;
    border-radius: 20px;
    padding: 24px;
    box-shadow: 0 8px 20px rgba(0,0,0,0.04);
}

.m-num {
    font-size: 1.5rem;
    font-weight: 800;
    color: #818CF8;
    margin-bottom: 10px;
}

.mission-card h4 {
    font-size: 1.05rem;
    font-weight: 700;
    color: #1F2937;
    margin-bottom: 8px;
}

.mission-card p {
    font-size: 0.86rem;
    color: #6B7280;
    line-height: 1.5;
    margin: 0;
}

/* 4. CORE VALUES */
.values-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
    gap: 24px;
}

.value-card {
    background: #FFFFFF;
    border: 1px solid #E5E7EB;
    border-radius: 20px;
    padding: 24px;
    text-align: center;
    box-shadow: 0 8px 20px rgba(0,0,0,0.04);
}

.v-icon {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 14px;
    font-size: 1.4rem;
}

.v-icon.bg-indigo { background: #EEF2FF; }
.v-icon.bg-violet { background: #F3E8FF; }
.v-icon.bg-rose { background: #FFE4E6; }
.v-icon.bg-amber { background: #FEF3C7; }

.value-card h3 {
    font-size: 1.1rem;
    font-weight: 700;
    margin-bottom: 8px;
}

.value-card p {
    font-size: 0.86rem;
    color: #6B7280;
    line-height: 1.5;
    margin: 0;
}

/* 5. FAQ ACCORDION STYLES */
.faq-accordion-wrapper {
    max-width: 860px;
    margin: 0 auto;
    display: flex;
    flex-direction: column;
    gap: 16px;
}

.faq-accordion-item {
    background: #FFFFFF;
    border: 1px solid #E5E7EB;
    border-radius: 18px;
    overflow: hidden;
    box-shadow: 0 6px 18px rgba(0,0,0,0.03);
    transition: border-color 0.2s;
}

.faq-accordion-item.active {
    border-color: #818CF8;
    box-shadow: 0 10px 25px rgba(79, 70, 229, 0.08);
}

.faq-question-btn {
    width: 100%;
    padding: 20px 24px;
    background: none;
    border: none;
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-size: 1rem;
    font-weight: 700;
    color: #1F2937;
    text-align: left;
    cursor: pointer;
    font-family: inherit;
}

.faq-icon-toggle {
    font-size: 1.4rem;
    font-weight: 400;
    color: #4F46E5;
    margin-left: 16px;
}

.faq-answer-panel {
    display: none;
    padding: 0 24px 20px;
    font-size: 0.92rem;
    color: #4B5563;
    line-height: 1.6;
    border-top: 1px stroke #F3F4F6;
}

/* 6. CTA BANNER */
.about-cta-banner {
    background: linear-gradient(135deg, #312E81 0%, #4F46E5 100%);
    border-radius: 30px;
    padding: 50px 30px;
    text-align: center;
    color: #FFFFFF;
    box-shadow: 0 20px 40px rgba(79, 70, 229, 0.25);
}

.about-cta-banner h2 {
    font-size: 2rem;
    font-weight: 800;
    margin-bottom: 12px;
}

.about-cta-banner p {
    font-size: 1.05rem;
    color: #E0E7FF;
    max-width: 600px;
    margin: 0 auto 28px;
}

.cta-buttons {
    display: flex;
    justify-content: center;
    gap: 16px;
    flex-wrap: wrap;
}

.btn-cta-primary {
    background: #FFFFFF;
    color: #312E81;
    padding: 12px 28px;
    border-radius: 30px;
    font-weight: 700;
    text-decoration: none;
    transition: transform 0.2s;
}

.btn-cta-secondary {
    background: rgba(255,255,255,0.15);
    color: #FFFFFF;
    padding: 12px 28px;
    border-radius: 30px;
    font-weight: 700;
    text-decoration: none;
    border: 1px solid rgba(255,255,255,0.3);
    transition: transform 0.2s;
}

.btn-cta-primary:hover, .btn-cta-secondary:hover {
    transform: translateY(-2px);
}

@media (max-width: 900px) {
    .about-hero-grid, .story-grid { grid-template-columns: 1fr; }
    .about-hero-title { font-size: 2.2rem; }
    .pillars-grid { grid-template-columns: 1fr; }
}
</style>

<!-- PAGE INTERACTIVE JAVASCRIPT -->
<script>
function toggleFaq(btnElem) {
    const item = btnElem.parentElement;
    const answerPanel = item.querySelector('.faq-answer-panel');
    const toggleIcon = btnElem.querySelector('.faq-icon-toggle');

    const isActive = item.classList.contains('active');

    // Close all other FAQs
    document.querySelectorAll('.faq-accordion-item').forEach(i => {
        i.classList.remove('active');
        i.querySelector('.faq-answer-panel').style.display = 'none';
        i.querySelector('.faq-icon-toggle').textContent = '+';
    });

    if (!isActive) {
        item.classList.add('active');
        answerPanel.style.display = 'block';
        toggleIcon.textContent = '−';
    }
}
</script>

<?= $this->endSection() ?>
