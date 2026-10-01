<!-- ============================================ -->
<!-- HERO SECTION — KIDSA EDITORIAL REVISION     -->
<!-- Self-contained, modular, and isolated        -->
<!-- ============================================ -->

<style>
/* CSS ISOLATED FOR HERO KIDSA */
.hero-kidsa-section {
  position: relative;
  background-color: #FAF5EF;
  background-image: 
    radial-gradient(circle at 10% 20%, rgba(255, 237, 219, 0.6) 0%, transparent 40%),
    radial-gradient(circle at 90% 80%, rgba(254, 228, 212, 0.45) 0%, transparent 45%);
  padding: 56px 0 90px;
  overflow: hidden;
  box-sizing: border-box;
}

.hero-kidsa-container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 0 32px;
  position: relative;
  z-index: 10;
}

.hero-kidsa-grid {
  display: grid;
  grid-template-columns: 1.1fr 0.9fr;
  align-items: center;
  gap: 40px;
  position: relative;
}

/* Kolom Kiri */
.hero-kidsa-left {
  position: relative;
  padding-left: 38px;
  z-index: 5;
}

/* Vertical Decorative Rail */
.hero-vertical-rail {
  position: absolute;
  left: 0;
  top: 10px;
  bottom: 10px;
  width: 2px;
  background: linear-gradient(to bottom, transparent 0%, #EEDFD5 12%, #DE5935 50%, #EEDFD5 88%, transparent 100%);
  border-radius: 2px;
}

.hero-vertical-rail::before,
.hero-vertical-rail::after,
.hero-rail-dot-center {
  content: '';
  position: absolute;
  left: 50%;
  transform: translateX(-50%);
  width: 8px;
  height: 8px;
  border-radius: 50%;
  background: #DE5935;
  box-shadow: 0 0 0 3px rgba(222, 89, 53, 0.2);
}

.hero-vertical-rail::before {
  top: 6%;
}

.hero-rail-dot-center {
  top: 50%;
  width: 6px;
  height: 6px;
  background: #E5876B;
}

.hero-vertical-rail::after {
  bottom: 6%;
}

/* Doodles */
.doodle-balloon {
  position: absolute;
  top: -42px;
  left: -10px;
  width: 54px;
  height: 68px;
  pointer-events: none;
  animation: kidsaFloatSlow 5s ease-in-out infinite alternate;
  z-index: 4;
}

.doodle-balloon svg {
  width: 54px;
  height: 68px;
  display: block;
}

.doodle-bee {
  position: absolute;
  top: -20px;
  right: 28px;
  width: 90px;
  height: 54px;
  pointer-events: none;
  animation: kidsaHoverBee 4s ease-in-out infinite alternate;
  z-index: 4;
}

.doodle-bee svg {
  width: 90px;
  height: 54px;
  display: block;
}

.doodle-star {
  position: absolute;
  width: 20px;
  height: 20px;
  pointer-events: none;
  animation: kidsaTwinkle 3s ease-in-out infinite;
}

.doodle-star-1 {
  top: 14px;
  right: 14px;
  animation-delay: 0.5s;
}

.doodle-star-2 {
  bottom: 74px;
  left: -14px;
  width: 16px;
  height: 16px;
  animation-delay: 1.5s;
}

.doodle-toycar {
  position: absolute;
  bottom: -40px;
  left: 38px;
  width: 140px;
  height: 44px;
  pointer-events: none;
  z-index: 3;
}

.doodle-toycar svg {
  width: 140px;
  height: 44px;
  display: block;
}

/* Kicker Badge */
.hero-kidsa-badge {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  background: #FFFFFF;
  border: 1.5px solid rgba(222, 89, 53, 0.22);
  color: #DE5935;
  padding: 6px 16px;
  border-radius: 9999px;
  font-size: 13px;
  font-weight: 700;
  letter-spacing: 0.2px;
  margin-bottom: 18px;
  box-shadow: 0 4px 14px rgba(222, 89, 53, 0.08);
}

/* Headline */
.hero-kidsa-title {
  font-family: 'Playfair Display', Georgia, serif;
  font-size: clamp(32px, 3.8vw, 46px);
  font-weight: 800;
  line-height: 1.2;
  color: #2F231D;
  margin-bottom: 18px;
  letter-spacing: -0.5px;
}

.hero-kidsa-title .text-accent {
  color: #DE5935;
  position: relative;
  display: inline;
}

.hero-kidsa-title .text-accent::after {
  content: '';
  position: absolute;
  left: 0;
  bottom: 2px;
  width: 100%;
  height: 7px;
  background: rgba(222, 89, 53, 0.16);
  border-radius: 4px;
  z-index: -1;
}

/* Sub-headline */
.hero-kidsa-subtitle {
  font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
  font-size: 16.5px;
  line-height: 1.68;
  color: #59473D;
  max-width: 480px;
  margin-bottom: 30px;
  font-weight: 450;
}

/* CTA Row */
.hero-kidsa-cta-row {
  display: flex;
  align-items: center;
  gap: 14px;
  flex-wrap: wrap;
  position: relative;
  z-index: 5;
}

.btn-kidsa-primary {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  gap: 10px;
  background-color: #DE5935;
  color: #FFFFFF !important;
  font-family: 'Inter', sans-serif;
  font-size: 15px;
  font-weight: 700;
  padding: 13px 30px;
  border-radius: 9999px;
  text-decoration: none;
  border: 2px solid #DE5935;
  box-shadow: 0 8px 20px rgba(222, 89, 53, 0.28);
  transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1);
}

.btn-kidsa-primary:hover {
  background-color: #C54623;
  border-color: #C54623;
  transform: translateY(-2px);
  box-shadow: 0 12px 24px rgba(222, 89, 53, 0.38);
  color: #FFFFFF;
}

.btn-kidsa-primary svg {
  transition: transform 0.2s ease;
}

.btn-kidsa-primary:hover svg {
  transform: translateX(4px);
}

.btn-kidsa-secondary {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  gap: 8px;
  background-color: transparent;
  color: #DE5935 !important;
  font-family: 'Inter', sans-serif;
  font-size: 15px;
  font-weight: 700;
  padding: 13px 28px;
  border-radius: 9999px;
  text-decoration: none;
  border: 2px solid #DE5935;
  transition: all 0.25s ease;
}

.btn-kidsa-secondary:hover {
  background-color: rgba(222, 89, 53, 0.1);
  transform: translateY(-2px);
  color: #DE5935;
}

.btn-kidsa-secondary svg {
  transition: transform 0.2s ease;
}

.btn-kidsa-secondary:hover svg {
  transform: translateX(4px);
}

/* Kolom Kanan */
.hero-kidsa-right {
  position: relative;
  display: flex;
  align-items: center;
  justify-content: center;
}

.hero-kidsa-photo-wrapper {
  position: relative;
  width: 100%;
  border-radius: 24px;
  overflow: hidden;
  box-shadow: 0 16px 40px rgba(92, 58, 42, 0.12);
  background: #FAF5EF;
}

.hero-kidsa-photo {
  display: block;
  width: 100%;
  height: 420px;
  object-fit: cover;
  object-position: center 30%;
  border-radius: 24px;
  -webkit-mask-image: linear-gradient(to right, transparent 0%, rgba(0,0,0,0.2) 6%, rgba(0,0,0,0.9) 22%, black 35%);
  mask-image: linear-gradient(to right, transparent 0%, rgba(0,0,0,0.2) 6%, rgba(0,0,0,0.9) 22%, black 35%);
  transition: transform 0.6s cubic-bezier(0.16, 1, 0.3, 1);
}

.hero-kidsa-photo-wrapper:hover .hero-kidsa-photo {
  transform: scale(1.02);
}

.hero-kidsa-blend-left {
  position: absolute;
  top: 0;
  left: 0;
  bottom: 0;
  width: 120px;
  background: linear-gradient(to right, #FAF5EF 0%, rgba(250, 245, 239, 0.85) 30%, transparent 100%);
  pointer-events: none;
  z-index: 2;
}

.hero-kidsa-blend-bottom {
  position: absolute;
  left: 0;
  right: 0;
  bottom: 0;
  height: 50px;
  background: linear-gradient(to top, rgba(250, 245, 239, 0.6) 0%, transparent 100%);
  pointer-events: none;
  z-index: 2;
}

.hero-kidsa-floating-card {
  position: absolute;
  bottom: 20px;
  left: 20px;
  background: rgba(255, 255, 255, 0.94);
  backdrop-filter: blur(10px);
  -webkit-backdrop-filter: blur(10px);
  padding: 10px 16px;
  border-radius: 16px;
  box-shadow: 0 10px 24px rgba(61, 40, 29, 0.12);
  display: flex;
  align-items: center;
  gap: 12px;
  border: 1px solid rgba(255, 255, 255, 0.85);
  z-index: 5;
  animation: kidsaFloatSlow 4.5s ease-in-out infinite alternate;
}

.floating-card-icon {
  width: 38px;
  height: 38px;
  border-radius: 10px;
  background: #FEF3EE;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 18px;
  flex-shrink: 0;
}

.floating-card-text strong {
  display: block;
  font-size: 13px;
  font-weight: 800;
  color: #2F231D;
  line-height: 1.25;
}

.floating-card-text span {
  font-size: 11px;
  font-weight: 500;
  color: #8C786E;
}

/* Scalloped Divider */
.hero-scalloped-divider {
  position: absolute;
  left: 0;
  bottom: 0;
  width: 100%;
  overflow: hidden;
  line-height: 0;
  z-index: 6;
  pointer-events: none;
}

.hero-scalloped-divider svg {
  position: relative;
  display: block;
  width: 100%;
  height: 36px;
}

.hero-scalloped-divider .shape-fill {
  fill: #FAF5F0;
}

/* Animations */
@keyframes kidsaFloatSlow {
  0% { transform: translateY(0px); }
  100% { transform: translateY(-7px); }
}

@keyframes kidsaHoverBee {
  0% { transform: translate(0px, 0px) rotate(0deg); }
  50% { transform: translate(-4px, -6px) rotate(-3deg); }
  100% { transform: translate(3px, -10px) rotate(3deg); }
}

@keyframes kidsaTwinkle {
  0%, 100% { opacity: 0.35; transform: scale(0.85); }
  50% { opacity: 1; transform: scale(1.15); }
}

/* Responsiveness */
@media (max-width: 1024px) {
  .hero-kidsa-grid {
    grid-template-columns: 1fr;
    gap: 36px;
  }
  .hero-kidsa-left {
    padding-left: 28px;
    max-width: 600px;
    margin: 0 auto;
  }
  .hero-kidsa-photo {
    height: 340px;
    -webkit-mask-image: none;
    mask-image: none;
  }
  .hero-kidsa-blend-left {
    display: none;
  }
}

@media (max-width: 768px) {
  .hero-kidsa-section {
    padding: 38px 0 70px;
  }
  .hero-kidsa-left {
    padding-left: 20px;
  }
  .hero-kidsa-title {
    font-size: 30px;
  }
  .hero-kidsa-subtitle {
    font-size: 15px;
    margin-bottom: 24px;
  }
  .doodle-bee {
    right: 4px;
    top: -24px;
    width: 70px;
  }
  .doodle-balloon {
    top: -34px;
    left: -6px;
    width: 44px;
    height: 56px;
  }
  .hero-kidsa-photo {
    height: 270px;
  }
}

@media (max-width: 480px) {
  .hero-kidsa-container {
    padding: 0 16px;
  }
  .hero-kidsa-title {
    font-size: 26px;
  }
  .hero-kidsa-cta-row {
    flex-direction: column;
    align-items: stretch;
  }
  .btn-kidsa-primary,
  .btn-kidsa-secondary {
    width: 100%;
  }
  .doodle-toycar {
    display: none;
  }
}
</style>

<section class="hero-kidsa-section" id="hero-section">
    <div class="hero-kidsa-container">
        <div class="hero-kidsa-grid">
            
            <!-- KOLOM KIRI: Teks, Doodles, Vertical Rail & CTA -->
            <div class="hero-kidsa-left reveal-on-scroll">
                
                <!-- 1. Garis Dekoratif Vertikal (Kidsa Planner Rail) -->
                <div class="hero-vertical-rail" aria-hidden="true">
                    <span class="hero-rail-dot-center"></span>
                </div>

                <!-- 2. Aksen Doodle: Balon Udara (Kiri Atas) -->
                <div class="doodle-balloon" aria-hidden="true">
                    <svg width="54" height="68" viewBox="0 0 64 80" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M32 4C17.64 4 6 15.64 6 30C6 41.5 16.5 50.8 24 57.5V62H40V57.5C47.5 50.8 58 41.5 58 30C58 15.64 46.36 4 32 4Z" fill="#F8E5D8" stroke="#DE5935" stroke-width="2.5" stroke-linejoin="round"/>
                        <path d="M22 6C15 13 14 26 18 38C21 47 25 54 26 58" stroke="#DE5935" stroke-width="2" stroke-linecap="round"/>
                        <path d="M42 6C49 13 50 26 46 38C43 47 39 54 38 58" stroke="#DE5935" stroke-width="2" stroke-linecap="round"/>
                        <path d="M32 4V58" stroke="#E5876B" stroke-width="1.8" stroke-dasharray="3 3"/>
                        <path d="M26 68H38L36.5 76H27.5L26 68Z" fill="#DE5935" stroke="#BA4423" stroke-width="1.5"/>
                        <line x1="25" y1="62" x2="27" y2="68" stroke="#7A5243" stroke-width="1.5"/>
                        <line x1="39" y1="62" x2="37" y2="68" stroke="#7A5243" stroke-width="1.5"/>
                        <line x1="32" y1="62" x2="32" y2="68" stroke="#7A5243" stroke-width="1.5"/>
                    </svg>
                </div>

                <!-- 3. Aksen Doodle: Lebah Lucu + Dotted Flight Loop (Kanan Atas Headline) -->
                <div class="doodle-bee" aria-hidden="true">
                    <svg width="90" height="54" viewBox="0 0 100 60" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M6 46 C20 54, 38 48, 42 34 C46 18, 30 14, 28 26 C26 36, 44 42, 64 28" 
                              stroke="#DE5935" stroke-width="1.8" stroke-dasharray="3 4" stroke-linecap="round"/>
                        <ellipse cx="74" cy="18" rx="6" ry="10" transform="rotate(-25 74 18)" fill="#E0F2FE" stroke="#38BDF8" stroke-width="1.2" opacity="0.85"/>
                        <ellipse cx="80" cy="19" rx="5" ry="8" transform="rotate(20 80 19)" fill="#E0F2FE" stroke="#38BDF8" stroke-width="1.2" opacity="0.75"/>
                        <ellipse cx="76" cy="28" rx="13" ry="9" fill="#FBBF24" stroke="#451A03" stroke-width="1.5"/>
                        <path d="M72 20V36" stroke="#451A03" stroke-width="2" stroke-linecap="round"/>
                        <path d="M78 19.5V36.5" stroke="#451A03" stroke-width="2" stroke-linecap="round"/>
                        <circle cx="88" cy="27" r="4.5" fill="#451A03"/>
                        <path d="M89 23 L93 18" stroke="#451A03" stroke-width="1.2" stroke-linecap="round"/>
                        <circle cx="94" cy="17" r="1.2" fill="#DE5935"/>
                        <path d="M63 28 L59 28" stroke="#451A03" stroke-width="1.5" stroke-linecap="round"/>
                    </svg>
                </div>

                <!-- 4. Aksen Bintang Sparkle -->
                <div class="doodle-star doodle-star-1" aria-hidden="true">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="#F59E0B">
                        <path d="M12 0L14.5 9.5L24 12L14.5 14.5L12 24L9.5 14.5L0 12L9.5 9.5L12 0Z"/>
                    </svg>
                </div>
                <div class="doodle-star doodle-star-2" aria-hidden="true">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="#DE5935">
                        <path d="M12 0L14 8.5L22 12L14 15.5L12 24L10 15.5L2 12L10 8.5L12 0Z"/>
                    </svg>
                </div>

                <!-- Kicker / Badge Mini -->
                <div class="hero-kidsa-badge">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                    </svg>
                    <span>Komunitas & Edukasi Pengasuhan Ramah Anak</span>
                </div>

                <!-- Headline (H1) -->
                <h1 class="hero-kidsa-title">
                    Nikmati Bimbingan <span class="text-accent">Pengasuhan Gratis</span> di Hari Pertama Anda.
                </h1>

                <!-- Sub-headline -->
                <p class="hero-kidsa-subtitle">
                    Temukan panduan, dukungan, dan komunitas untuk perjalanan orang tua masa kini. Belajar bersama pakar, akses ratusan buku anak, dan rawat tumbuh kembang si kecil dengan penuh cinta.
                </p>

                <!-- Tombol Action (CTA Buttons) -->
                <div class="hero-kidsa-cta-row">
                    <a href="<?= base_url('login') ?>" class="btn-kidsa-primary" id="btn-hero-daftar">
                        <span>Daftar Sekarang</span>
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                            <polyline points="12 5 19 12 12 19"></polyline>
                        </svg>
                    </a>

                    <a href="<?= base_url('about-us') ?>" class="btn-kidsa-secondary" id="btn-hero-pelajari">
                        <span>Pelajari Lebih Lanjut</span>
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                            <polyline points="12 5 19 12 12 19"></polyline>
                        </svg>
                    </a>
                </div>

                <!-- 5. Aksen Doodle: Mobil Mainan & Jejak Jalanan (Kiri Bawah) -->
                <div class="doodle-toycar" aria-hidden="true">
                    <svg width="140" height="44" viewBox="0 0 160 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M2 38 Q 40 25, 80 38 T 155 38" stroke="#DE5935" stroke-width="2" stroke-dasharray="4 5" stroke-linecap="round" opacity="0.75"/>
                        <g transform="translate(90, 16)">
                            <rect x="0" y="8" width="36" height="12" rx="4" fill="#DE5935"/>
                            <path d="M6 8 L10 2 H24 L29 8 Z" fill="#F8A082"/>
                            <path d="M12 4 H17 V8 H10 Z" fill="#FFFFFF" opacity="0.9"/>
                            <path d="M19 4 H23 L26 8 H19 Z" fill="#FFFFFF" opacity="0.9"/>
                            <circle cx="9" cy="20" r="4.5" fill="#3D2921"/>
                            <circle cx="9" cy="20" r="1.8" fill="#FAF5EF"/>
                            <circle cx="27" cy="20" r="4.5" fill="#3D2921"/>
                            <circle cx="27" cy="20" r="1.8" fill="#FAF5EF"/>
                            <circle cx="34" cy="12" r="1.5" fill="#FBBF24"/>
                        </g>
                    </svg>
                </div>

            </div>

            <!-- KOLOM KANAN: Visual Foto Realistis + Soft Gradient Mask Blending -->
            <div class="hero-kidsa-right reveal-on-scroll reveal-delay-1">
                <div class="hero-kidsa-photo-wrapper">
                    
                    <!-- Foto Realistis Aktivitas Pengasuhan & Belajar Ceria -->
                    <img src="<?= base_url('images/hero-kidsa-parenting.jpg') ?>" 
                         alt="Pengasuh, orang tua, dan anak sedang belajar serta berkarya bersama dengan ceria di Parentela" 
                         class="hero-kidsa-photo" 
                         loading="eager" />

                    <!-- Soft Edge Gradient Blending Overlay (Kiri Melebur Mulus ke Background Krem) -->
                    <div class="hero-kidsa-blend-left" aria-hidden="true"></div>
                    <div class="hero-kidsa-blend-bottom" aria-hidden="true"></div>

                    <!-- Floating Trust Badge Khas Editorial Kidsa -->
                    <div class="hero-kidsa-floating-card">
                        <div class="floating-card-icon">
                            👶
                        </div>
                        <div class="floating-card-text">
                            <strong>10.000+ Keluarga Bahagia</strong>
                            <span>Panduan terpercaya dari psikolog & dokter anak</span>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>

    <!-- 6. Section Divider: Scalloped / Wavy Border SVG (Transisi Halus ke Section Bawah) -->
    <div class="hero-scalloped-divider" aria-hidden="true">
        <svg preserveAspectRatio="none" viewBox="0 0 1200 120" xmlns="http://www.w3.org/2000/svg">
            <path class="shape-fill" d="M0,0 C150,90 350,-40 500,50 C650,140 850,20 1000,60 C1100,85 1160,50 1200,40 L1200,120 L0,120 Z"></path>
        </svg>
    </div>
</section>
