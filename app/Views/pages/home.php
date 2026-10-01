<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<!-- HERO SECTION (SCRAPBOOK AESTHETIC) -->
<section class="sb-hero">
    <div class="sb-floating-polaroid p1">
        <img src="<?= base_url('images/hero/family1.png') ?>" alt="Keluarga Bahagia 1">
    </div>
    <div class="sb-floating-polaroid p2">
        <img src="<?= base_url('images/hero/family2.png') ?>" alt="Keluarga Bahagia 2">
    </div>
    <div class="sb-floating-polaroid p3">
        <img src="<?= base_url('images/hero/family3.jpg') ?>" alt="Keluarga Bahagia 3">
    </div>
    <div class="sb-floating-polaroid p4">
        <img src="<?= base_url('images/hero/family4.png') ?>" alt="Keluarga Bahagia 4">
    </div>

    <div class="sb-hero-content">
        <h1 class="sb-hero-title">
            the <span class="handwritten">"superparents"</span> of<br>modern parenting
        </h1>
        <p class="sb-hero-subtitle">
            Kumpulan panduan ahli, artikel inspiratif, dan dukungan komunitas untuk orang tua masa kini.
        </p>

        <!-- Search bar moved from header -->
        <form class="hero-search-form" action="<?= base_url('search') ?>" method="get" style="margin: 20px auto 30px auto; max-width: 450px; display: flex; position: relative;">
            <input type="text" name="q" placeholder="Cari artikel, produk, dll..." style="width: 100%; padding: 15px 50px 15px 25px; border-radius: 40px; border: 2px solid var(--sb-primary-light, #E98B50); font-family: 'Outfit', sans-serif; font-size: 1.05rem; outline: none; box-shadow: 0 4px 15px rgba(0,0,0,0.08); background: rgba(255, 255, 255, 0.95);">
            <button type="submit" aria-label="Cari" style="position: absolute; right: 15px; top: 50%; transform: translateY(-50%); background: none; border: none; color: var(--sb-primary, #BC4F4F); cursor: pointer;">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
            </button>
        </form>

        <a href="<?= base_url('articles') ?>" class="sb-btn-primary">Jelajahi Sekarang</a>
    </div>
</section>

<!-- SERVICES / PASSION SECTION -->
<section class="sb-services">
    <div class="sb-torn-top"></div>
    <div class="sb-services-header">
        <span class="handwritten">THIS IS PARENTELA</span>
        <h2>We're a modern team with an <span class="handwritten text-primary" style="font-size:3rem">eye</span> for care<br>and a <span class="handwritten text-primary" style="font-size:3rem">passion</span> for kids.</h2>
    </div>

    <div class="sb-services-container">
        <!-- Phone Mockup -->
        <div class="sb-phone-mockup">
            <img src="<?= base_url('images/family-pointing-left.jpg') ?>" alt="Parentela App">
        </div>

        <!-- Case Study Block -->
        <div class="sb-case-study">
            <div style="text-align:center;">
                <span style="background:var(--sb-accent-peach); padding: 2px 10px; border-radius:10px; font-weight:bold; font-size:12px; border:1px solid #431407;">Case Studies</span>
            </div>
            <h3 style="text-align:center;">parentela kids</h3>
            <p style="font-size:12px; color:#666; margin-bottom:15px; border-bottom: 2px dotted #ccc; padding-bottom:15px;">
                Memberikan wadah terbaik untuk anak mengeksplorasi dunia lewat cerita, bermain, dan interaksi sosial yang sehat.
            </p>
            <strong style="display:block; font-family:'Caveat', cursive; font-size:1.5rem; text-align:center;">panduan asuh, konsultasi parenting</strong>
            <div class="sb-stats">
                <div class="sb-stat-box">
                    <h4>200+</h4>
                    <span>Artikel Pilihan</span>
                </div>
                <div class="sb-stat-box">
                    <h4>15K</h4>
                    <span>Orang Tua</span>
                </div>
                <div class="sb-stat-box">
                    <h4>100%</h4>
                    <span>Dukungan Ahli</span>
                </div>
            </div>
        </div>
    </div>
    <div class="sb-torn-bottom"></div>
</section>

<!-- WAYS TO WORK WITH US -->
<section class="sb-ways">
    <h2>ways to explore with us</h2>
    <div class="sb-cards-grid">
        <div class="sb-card">
            <h3>Artikel Terkini</h3>
            <p>Ratusan artikel terpercaya seputar tumbuh kembang, kesehatan, dan pola asuh modern.</p>
            <a href="<?= base_url('articles') ?>" class="sb-btn-primary" style="font-size:10px; padding: 8px 15px;">Baca Artikel</a>
        </div>
        <div class="sb-card">
            <h3>Layanan Nanny</h3>
            <p>Temukan pengasuh anak terpercaya, terlatih, dan bersertifikat untuk si kecil.</p>
            <a href="<?= base_url('nanny') ?>" class="sb-btn-primary" style="font-size:10px; padding: 8px 15px;">Cari Nanny</a>
        </div>
        <div class="sb-card">
            <h3>Perencanaan Keluarga</h3>
            <p>Panduan terpadu dan informasi esensial untuk membangun masa depan keluarga.</p>
            <a href="<?= base_url('perencanaan-keluarga') ?>" class="sb-btn-primary" style="font-size:10px; padding: 8px 15px;">Pelajari</a>
        </div>
    </div>
</section>

<!-- PUSAT GIZI & MPASI (SCRAPBOOK THEME) -->
<section style="background-color: var(--sb-bg); padding: 80px 5%; display: flex; flex-wrap: wrap; justify-content: center; align-items: center; gap: 50px; position: relative;">
    
    <!-- Text Content -->
    <div style="flex: 1; min-width: 300px; max-width: 500px; position: relative; z-index: 2;">
        <span class="handwritten" style="font-size: 2.2rem; color: var(--sb-primary-light); display: block; margin-bottom: 5px; transform: rotate(-3deg);">Menu Harian Si Kecil</span>
        
        <h2 style="font-size: 3.5rem; color: var(--sb-accent-dark); line-height: 1.1; margin-bottom: 20px;">
            Gizi Anak &<br>MPASI
        </h2>
        
        <p style="font-size: 1.15rem; line-height: 1.6; color: var(--sb-text); margin-bottom: 30px;">
            Kumpulan resep praktis, panduan porsi gizi seimbang, dan tips mengatasi Gerakan Tutup Mulut (GTM) berdasar rekomendasi ahli.
        </p>
        
        <a href="<?= base_url('menu') ?>" class="sb-btn-primary">
            Masuk ke Dapur Parentela
        </a>
        
        <!-- Doodle Arrow -->
        <div style="position:absolute; right: -20px; bottom: -10px; transform: rotate(-20deg); font-size:3rem; color:var(--sb-primary);">
            <svg width="60" height="60" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M20 80 Q 50 20 80 80 M 65 80 L 80 80 L 75 65" stroke="currentColor" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </div>
    </div>
    
    <!-- Visual Content (Scrapbook Style) -->
    <div style="flex: 1; min-width: 300px; max-width: 500px; position: relative; z-index: 1;">
        
        <!-- Background Torn Paper or Notebook (Polaroid style) -->
        <div style="background: #fff; padding: 15px 15px 40px 15px; border: 1px solid #e2e8f0; box-shadow: 4px 6px 15px rgba(0,0,0,0.08); transform: rotate(4deg); width: 85%; margin: 0 auto; position: relative; z-index: 1;">
            
            <!-- Tape -->
            <div style="position: absolute; top: -12px; left: 50%; transform: translateX(-50%) rotate(-3deg); width: 120px; height: 35px; background: rgba(255,255,255,0.7); box-shadow: 0 1px 4px rgba(0,0,0,0.1); border: 1px solid rgba(0,0,0,0.05); z-index: 2;"></div>
            
            <!-- Image -->
            <img src="<?= base_url('images/blog/sup-ayam-bayam.jpg') ?>" style="width: 100%; height: auto; display: block; border: 1px solid #eee;" alt="Sup Ayam Bayam">
            
            <div style="position: absolute; bottom: 5px; width: 100%; text-align: center; left: 0;">
                <span class="handwritten" style="font-size: 1.8rem; color: #555;">Resep Sup Ayam Bayam!</span>
            </div>
        </div>
        
        <!-- Overlapping small polaroid -->
        <div style="position: absolute; bottom: -20px; left: -20px; background: #fff; padding: 8px 8px 30px 8px; box-shadow: 2px 4px 12px rgba(0,0,0,0.12); transform: rotate(-8deg); width: 200px; z-index: 3;">
            <!-- Tape for small polaroid -->
            <div style="position: absolute; top: -10px; right: 10px; transform: rotate(15deg); width: 60px; height: 25px; background: rgba(255,255,255,0.7); box-shadow: 0 1px 3px rgba(0,0,0,0.1); z-index: 4;"></div>
            
            <img src="<?= base_url('images/blog/mpasi-sehat.jpg') ?>" style="width: 100%; height: auto; display: block;" alt="Makan">
            
            <span class="handwritten" style="position: absolute; bottom: 2px; left: 15px; font-size: 1.4rem; color: #333;">Yummy...</span>
        </div>
        
    </div>
</section>


<!-- KEWENANGAN / REGULASI -->
<section class="sb-team" style="background-color: #E2E8F0;">
    <div class="sb-team-container">
        <div class="sb-team-text">
            <h2>Payung Hukum & Perlindungan Keluarga</h2>
            <p>Pelajari regulasi hak konstitusional, Undang-Undang Perlindungan Anak, standar pengasuhan ramah anak, hingga layanan aduan darurat yang difasilitasi oleh lembaga resmi negara.</p>
            <br>
            <a href="<?= base_url('kewenangan') ?>" class="sb-btn-primary" style="background:var(--sb-primary); color:white;">Pusat Kewenangan</a>
        </div>
        
        <div style="flex:1.5; position:relative; display:flex; justify-content:center; align-items:center; min-height:400px; padding: 20px 0;">
            <!-- Illustration / Photo Polaroid -->
            <div style="position:absolute; left:5%; top:5%; background:#fff; padding:10px 10px 35px 10px; border:1px solid #ddd; box-shadow:2px 6px 15px rgba(0,0,0,0.1); transform:rotate(-6deg); z-index:1; width:260px;">
                <img src="<?= base_url('images/keluarga-aman-baru.jpg') ?>" style="width:100%; height:auto;" alt="Keluarga Terlindungi">
                <span style="font-family:'Caveat', cursive; font-size:1.8rem; color:var(--sb-accent-dark); position:absolute; bottom:5px; left:15px;">#KeluargaAman</span>
            </div>
            
            <!-- Folder/Note Aesthetic for Authority -->
            <div style="background:#fff; padding:30px; border:2px dashed var(--sb-accent-dark); border-radius:10px; width:65%; transform:rotate(4deg); box-shadow:8px 8px 0 rgba(0,0,0,0.1); position:relative; z-index:2; margin-left:30%;">
                
                <!-- Pin or Tape graphic -->
                <div style="position:absolute; top:-15px; left:50%; transform:translateX(-50%); width:60px; height:25px; background:rgba(255, 202, 179, 0.9); box-shadow:0 2px 4px rgba(0,0,0,0.15);"></div>
                
                <h3 style="font-family:'Caveat', cursive; font-size:2.2rem; color:var(--sb-primary); margin-bottom:15px; text-align:center;">Lembaga Terkait</h3>
                
                <ul style="list-style:none; padding:0; margin:0; font-family:'Outfit', sans-serif; font-size:1rem; line-height:1.7;">
                    <li style="border-bottom:1px solid #eee; padding:8px 0;">🏛️ Kementerian PPPA RI</li>
                    <li style="border-bottom:1px solid #eee; padding:8px 0;">🛡️ KPAI Pusat</li>
                    <li style="border-bottom:1px solid #eee; padding:8px 0;">⚖️ Kemenkumham RI</li>
                    <li style="padding:8px 0;">🏙️ DP3A-PPKB Surabaya</li>
                </ul>
                
                <!-- Stamp -->
                <div style="position:absolute; bottom:20px; right:-10px; border:3px solid var(--sb-primary-light); color:var(--sb-primary-light); font-weight:800; font-family:'Outfit', sans-serif; padding:4px 12px; transform:rotate(-25deg); border-radius:4px; text-transform:uppercase; letter-spacing:1px; background:#fff;">
                    Resmi
                </div>
            </div>
            
            <!-- Little Badge/Sticker -->
            <div style="position:absolute; bottom:10%; left:25%; z-index:3; transform:rotate(15deg); font-size:3rem; filter:drop-shadow(2px 4px 0px rgba(0,0,0,0.15));">
                🌟
            </div>
        </div>
    </div>
</section>

<!-- TOKO / PRODUK PARENTELA (MODERN SCRAPBOOK) -->
<section style="background-color: var(--sb-bg); padding: 80px 5%; position: relative;">
    
    <!-- Background Doodle/Texture -->
    <div style="position: absolute; top: 10%; right: 10%; opacity: 0.03; pointer-events: none;">
        <svg width="200" height="200" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
            <circle cx="50" cy="50" r="40" fill="none" stroke="var(--sb-accent-dark)" stroke-width="2" stroke-dasharray="5 5" />
        </svg>
    </div>

    <!-- Header Toko 2 Kolom (Scrapbook Style) -->
    <div style="max-width: 1150px; margin: 0 auto; display: flex; align-items: center; justify-content: space-between; gap: 40px; flex-wrap: wrap;">
        
        <!-- Kolom Kiri: Teks Persuasif -->
        <div style="flex: 1 1 500px; text-align: left;">
            <span class="handwritten" style="font-size: 2.2rem; color: var(--sb-primary-light); display: inline-block; transform: rotate(-2deg); margin-bottom: 8px;">
                Ingin Melengkapi Kebutuhan si Kecil?
            </span>
            <h2 style="font-size: 3rem; color: var(--sb-accent-dark); line-height: 1.15; margin-bottom: 16px;">
                Jelajahi Parentela Store
            </h2>
            <p style="font-size: 1.05rem; color: var(--sb-text); line-height: 1.6; margin-bottom: 22px; max-width: 540px;">
                Setiap tahap tumbuh kembang buah hati butuh dukungan terbaik! Cari tahu lebih lanjut koleksi produk edukatif dan perlengkapan esensial di <strong>Parentela Store</strong> untuk melengkapi segala kebutuhan si Kecil dengan penuh kasih sayang.
            </p>
            <div style="display: flex; gap: 12px; align-items: center; flex-wrap: wrap; margin-bottom: 24px;">
                <span style="background: #fef3c7; color: #b45309; border: 1px dashed #f59e0b; padding: 6px 16px; border-radius: 20px; font-weight: 600; font-size: 0.88rem; display: inline-flex; align-items: center; gap: 6px;">
                    ✨ Pilihan Favorit Orang Tua
                </span>
                <span style="background: #e0f2fe; color: #0369a1; border: 1px dashed #38bdf8; padding: 6px 16px; border-radius: 20px; font-weight: 600; font-size: 0.88rem; display: inline-flex; align-items: center; gap: 6px;">
                    🧸 100% Edukatif & Aman
                </span>
            </div>
            <div>
                <a href="<?= base_url('toko') ?>" style="display: inline-block; background: var(--sb-primary); color: #fff; padding: 14px 30px; border-radius: 30px; font-weight: 700; text-decoration: none; font-size: 1rem; box-shadow: 0 6px 20px rgba(222, 115, 99, 0.35); transition: transform 0.2s, background 0.2s;" onmouseover="this.style.transform='translateY(-2px)'; this.style.background='var(--sb-accent-dark)';" onmouseout="this.style.transform='none'; this.style.background='var(--sb-primary)';">
                    Kunjungi Parentela Store &rarr;
                </a>
            </div>
        </div>

        <!-- Kolom Kanan: Foto Ibu & Anak (Scrapbook Frame) -->
        <div style="flex: 0 0 400px; max-width: 100%; position: relative;">
            <!-- Washi Tape Hiasan -->
            <div style="position: absolute; top: -14px; left: 35%; transform: translateX(-50%) rotate(-4deg); background: rgba(245, 158, 11, 0.65); width: 100px; height: 26px; z-index: 5; box-shadow: 0 2px 5px rgba(0,0,0,0.08); border-left: 2px dashed rgba(255,255,255,0.7); border-right: 2px dashed rgba(255,255,255,0.7);"></div>
            
            <!-- Frame Foto Scrapbook -->
            <div style="background: #fff; padding: 14px 14px 18px 14px; border-radius: 20px; box-shadow: 0 12px 30px rgba(0,0,0,0.08); transform: rotate(2.5deg); border: 1px solid #f1f5f9; transition: transform 0.3s ease;" onmouseover="this.style.transform='rotate(0deg) scale(1.02)';" onmouseout="this.style.transform='rotate(2.5deg) scale(1)';">
                <div style="overflow: hidden; border-radius: 14px; height: 250px;">
                    <img src="<?= base_url('images/store-header-mom-child.jpg') ?>" alt="Ibu dan Anak Parentela Store" style="width: 100%; height: 100%; object-fit: cover; display: block;">
                </div>
                <div style="text-align: center; margin-top: 10px;">
                    <span class="handwritten" style="font-size: 1.25rem; color: var(--sb-accent-dark);">Momen Indah Bersama si Kecil ❤️</span>
                </div>
            </div>

            <!-- Sticker Hiasan -->
            <div style="position: absolute; bottom: -12px; right: -8px; z-index: 5; transform: rotate(12deg); font-size: 2.2rem; filter: drop-shadow(2px 4px 4px rgba(0,0,0,0.15));">
                🌟
            </div>
        </div>

    </div>

</section>

<!-- CLIENT LOVE (REVIEWS) -->
<section class="sb-reviews-section" style="overflow-x: hidden;">
    <div style="text-align:center; margin-bottom: 40px;">
        <span style="font-size:12px; text-transform:uppercase; letter-spacing:2px; color:var(--sb-primary-light); font-weight:bold;">Parent Love</span>
        <h2 style="font-size: 2.5rem; color:var(--sb-accent-dark); margin-top:10px;">Cerita dari Keluarga Parentela</h2>
    </div>

    <!-- Review Marquee Container -->
    <div class="sb-reviews-marquee">
        <!-- Track 1 (Scrolling Left) -->
        <div class="sb-reviews-track">
            <?php 
            // Daftar ulasan
            $reviews = [
                ['name' => 'Keluarga Rara', 'text' => 'Parentela beneran lifesaver! Artikel panduannya bikin rutinitas harian lebih rapi dan kelas MPASI-nya sangat mencerahkan.', 'tag' => 'Kelas MPASI', 'loc' => 'Surabaya'],
                ['name' => 'Papa Dika', 'text' => 'Fitur konsultasi ahlinya sangat ngebantu banget pas anak lagi demam tengah malem. Dokter responsif dan ngasih solusi yang tenangin pikiran.', 'tag' => 'Konsultasi Ahli', 'loc' => 'Jakarta'],
                ['name' => 'Bunda Nisa', 'text' => 'Suka banget sama komunitasnya! Bisa saling curhat dan dapet tips praktis dari sesama ibu. Ngerasa nggak sendirian lagi dalam ngasuh anak.', 'tag' => 'Komunitas Parentela', 'loc' => 'Bandung'],
                ['name' => 'Keluarga Bima', 'text' => 'Artikel tumbuh kembangnya lengkap banget. Jadi panduan wajib buat mantau perkembangan motorik si kecil tiap bulannya.', 'tag' => 'Artikel Edukasi', 'loc' => 'Yogyakarta'],
                ['name' => 'Bunda Ayu', 'text' => 'Dongeng audio dari Parentela jadi teman wajib sebelum tidur. Anakku suka banget sama cerita fabelnya.', 'tag' => 'Audio Cerita', 'loc' => 'Malang']
            ];
            // Render 2 set agar seamless loop
            for ($i = 0; $i < 2; $i++) {
                foreach ($reviews as $rev) {
            ?>
                <div class="sb-review-card">
                    <div class="sb-rc-header">
                        <span class="sb-rc-badge">Dari: <?= $rev['name'] ?></span>
                    </div>
                    <div class="sb-rc-body handwritten">
                        <?= $rev['text'] ?>
                    </div>
                    <div class="sb-rc-footer">
                        <div class="sb-rc-meta">
                            <strong><?= $rev['tag'] ?></strong>
                            <span><?= $rev['loc'] ?></span>
                        </div>
                        <div class="sb-rc-icon">⭐</div>
                    </div>
                </div>
            <?php 
                }
            } 
            ?>
        </div>

        <!-- Track 2 (Scrolling Right) -->
        <div class="sb-reviews-track reverse" style="margin-top: 20px;">
            <?php 
            // Acak atau beda ulasan untuk baris kedua
            $reviews2 = [
                ['name' => 'Ayah Reza', 'text' => 'Nemu banyak referensi kegiatan motorik kasar yang gampang dibuat di rumah pakai barang bekas. Weekend jadi seru!', 'tag' => 'Ide Bermain', 'loc' => 'Semarang'],
                ['name' => 'Mama Cindy', 'text' => 'Senang banget ada bagian Kewenangan, ngebantu paham hak cuti melahirkan dan perlindungan ibu. Sangat edukatif.', 'tag' => 'Regulasi Keluarga', 'loc' => 'Bali'],
                ['name' => 'Keluarga Tio', 'text' => 'Materi tentang tantrum di usia 2 tahun benar-benar membuka wawasan. Sekarang bisa lebih sabar ngadepinnya.', 'tag' => 'Psikologi Anak', 'loc' => 'Medan'],
                ['name' => 'Bunda Lia', 'text' => 'Buku-buku anak digitalnya bagus-bagus dan gambarnya menarik. Praktis dibaca pas lagi nunggu antrian dokter.', 'tag' => 'Perpustakaan Digital', 'loc' => 'Bogor'],
                ['name' => 'Ibu Tari', 'text' => 'Resep MPASI-nya simpel tapi bergizi. Gak bingung lagi mau masak apa buat si kecil hari ini.', 'tag' => 'Gizi & Nutrisi', 'loc' => 'Tangerang']
            ];
            for ($i = 0; $i < 2; $i++) {
                foreach ($reviews2 as $rev) {
            ?>
                <div class="sb-review-card">
                    <div class="sb-rc-header">
                        <span class="sb-rc-badge">Dari: <?= $rev['name'] ?></span>
                    </div>
                    <div class="sb-rc-body handwritten">
                        <?= $rev['text'] ?>
                    </div>
                    <div class="sb-rc-footer">
                        <div class="sb-rc-meta">
                            <strong><?= $rev['tag'] ?></strong>
                            <span><?= $rev['loc'] ?></span>
                        </div>
                        <div class="sb-rc-icon">⭐</div>
                    </div>
                </div>
            <?php 
                }
            } 
            ?>
        </div>
    </div>

    <!-- Call To Action (Tulis Cerita) -->
    <div style="text-align:center; margin-top: 50px;">
        <p style="font-family:'Outfit', sans-serif; font-size:1.2rem; color:var(--sb-accent-dark); margin-bottom: 15px;">
            Ingin membagikan cerita Anda bersama Parentela?
        </p>
        <?php if (session()->get('is_logged_in')): ?>
            <a href="<?= base_url('reviews/create') ?>" class="sb-btn-primary" style="background:var(--sb-primary); color:#ffffff; display:inline-block; padding: 12px 25px; border-radius: 30px; text-decoration:none; font-family:'Outfit', sans-serif; font-weight:bold;">
                Tulis Cerita Anda
            </a>
        <?php else: ?>
            <a href="<?= base_url('login?redirect=reviews/create') ?>" class="sb-btn-primary" style="background:var(--sb-primary); color:#ffffff; display:inline-block; padding: 12px 25px; border-radius: 30px; text-decoration:none; font-family:'Outfit', sans-serif; font-weight:bold;">
                Login untuk Menulis Cerita
            </a>
        <?php endif; ?>
    </div>
</section>

<?= $this->endSection() ?>