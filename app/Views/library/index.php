<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<!-- Teks Berjalan Pengumuman Perpustakaan -->
<div class="library-marquee-bar">
    <div class="container">
        <div class="library-marquee-inner">
            📚 Selamat Datang di Perpustakaan Digital Anak Parentela &bull; Koleksi Buku Klasik Dunia Terbitan Nyata &bull; Dongeng Audio Pilihan (Referensi: digitalbook.io) &bull; Temani Si Kecil Membaca 15 Menit Setiap Hari!
        </div>
    </div>
</div>

<!-- Hero Section dengan Foto Asli Ibu & Anak Membaca -->
<section class="library-hero">
    <div class="container">
        <div class="library-hero-grid">
            <!-- Left Column: Copywriting & Search -->
            <div class="library-hero-text">
                <div class="hero-pill-badge">
                    <span>✨ Perpustakaan Digital Khusus Anak</span>
                </div>
                <h1>Ruang Imajinasi & Literasi Terbaik untuk Buah Hati</h1>
                <p>Jelajahi karya-karya klasik terbitan dunia terpopuler—mulai dari <em>Le Petit Prince</em>, <em>The Secret Garden</em>, hingga <em>Peter Pan</em>—lengkap dengan audio dongeng dan kurasi sesuai tahapan usia anak.</p>
                
                <!-- Modern Search Box -->
                <form class="library-search-box" action="<?= base_url('perpustakaan/katalog') ?>" method="get">
                    <span class="search-icon">🔍</span>
                    <input type="text" name="q" placeholder="Cari judul buku anak, penulis klasik, dongeng tidur..." autocomplete="off">
                    <button type="submit">
                        <span>Cari Buku</span>
                        <span>→</span>
                    </button>
                </form>

                <!-- Popular Search Tags -->
                <div class="popular-tags-wrapper">
                    <span class="tag-label">Pencarian Populer:</span>
                    <a href="<?= base_url('perpustakaan/katalog?q=Little+Prince') ?>" class="tag-pill">👑 The Little Prince</a>
                    <a href="<?= base_url('perpustakaan/katalog?q=Secret+Garden') ?>" class="tag-pill">🌿 The Secret Garden</a>
                    <a href="<?= base_url('perpustakaan/katalog?q=Peter+Pan') ?>" class="tag-pill">🧚 Peter and Wendy</a>
                    <a href="<?= base_url('perpustakaan/katalog?q=Winnie') ?>" class="tag-pill">🍯 Winnie-the-Pooh</a>
                    <a href="<?= base_url('perpustakaan/katalog?q=Rabbit') ?>" class="tag-pill">🐰 Peter Rabbit</a>
                    <a href="<?= base_url('perpustakaan/katalog?format=Audiobook') ?>" class="tag-pill">🎧 Audio Cerita</a>
                </div>

                <!-- Stats Bar -->
                <div class="library-stats-bar">
                    <div class="stat-item">
                        <div class="stat-icon">📚</div>
                        <div class="stat-text">
                            <strong>Koleksi Klasik Nyata</strong>
                            <span>Karya sastra anak dunia</span>
                        </div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-icon">🎧</div>
                        <div class="stat-text">
                            <strong>Audiobook Ramah Anak</strong>
                            <span>Ref: digitalbook.io</span>
                        </div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-icon">👶</div>
                        <div class="stat-text">
                            <strong>Kurasi 0 - 12 Tahun</strong>
                            <span>Sesuai tingkat membaca</span>
                        </div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-icon">🛡️</div>
                        <div class="stat-text">
                            <strong>100% Khusus Anak</strong>
                            <span>Aman & bebas konten dewasa</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column: Real Photo of Mother & Child Reading -->
            <div class="library-hero-visual">
                <div class="hero-photo-wrapper">
                    <img src="<?= base_url('images/mother-child-reading.jpg') ?>" alt="Ibu dan anak membaca buku cerita bersama" class="hero-reading-img" loading="eager">
                    <div class="hero-photo-gradient-overlay"></div>
                    
                    <!-- Floating Badge Top Left -->
                    <div class="floating-badge badge-top-left">
                        <div class="badge-icon-bubble">📖</div>
                        <div class="badge-text-col">
                            <strong>Momen Bonding Berharga</strong>
                            <span>15 menit membaca sebelum tidur</span>
                        </div>
                    </div>

                    <!-- Floating Badge Bottom Right -->
                    <div class="floating-badge badge-bottom-right">
                        <div class="badge-icon-bubble">⭐</div>
                        <div class="badge-text-col">
                            <strong>Karya Klasik Terbitan Nyata</strong>
                            <span>Dikurasi ramah buah hati</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Kategori Pilihan (Khusus Anak-Anak) -->
<section class="library-section">
    <div class="container">
        <div class="section-head-flex">
            <div class="section-head-title">
                <h2><span>📂</span> Jelajahi Kategori Bacaan Anak</h2>
                <p>Temukan topik cerita yang paling memicu rasa ingin tahu dan imajinasi si kecil</p>
            </div>
            <a href="<?= base_url('perpustakaan/katalog') ?>" class="btn-view-all">Semua Koleksi (<?= $total_books_count ?> Buku) →</a>
        </div>

        <div class="lib-category-grid">
            <?php foreach ($categories as $cat): ?>
                <a href="<?= base_url('perpustakaan/katalog?category=' . urlencode($cat['slug'])) ?>" class="lib-category-card">
                    <div class="lib-cat-icon"><?= $cat['icon'] ?></div>
                    <h3><?= esc($cat['name']) ?></h3>
                    <p><?= esc($cat['desc']) ?></p>
                    <span class="lib-cat-badge"><?= esc($cat['count']) ?></span>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Best Seller Section: Buku Klasik Populer Anak -->
<section class="library-section bg-alt">
    <div class="container">
        <div class="section-head-flex">
            <div class="section-head-title">
                <h2><span>⭐</span> Buku Anak Populer & Karya Klasik Dunia</h2>
                <p>Karya abadi yang dicintai jutaan anak lintas generasi: Le Petit Prince, The Secret Garden, Peter Pan, dan lainnya</p>
            </div>
            <a href="<?= base_url('perpustakaan/katalog?sort=popular') ?>" class="btn-view-all">Lihat Koleksi Populer →</a>
        </div>

        <div class="lib-book-grid">
            <?php foreach ($best_seller as $book): ?>
                <?= view('library/_book_card', ['book' => $book]) ?>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Audio Storytelling Section (Audiobook Anak via Referensi DigitalBook.io) -->
<section class="section-storytelling">
    <div class="container">
        <div class="section-head-flex storytelling-head">
            <div class="section-head-title">
                <h2 style="color:#ffffff;"><span>🎧</span> Pojok Cerita Suara (Audiobook Anak)</h2>
                <p style="color:rgba(255,255,255,0.88);">Mendengarkan kisah klasik anak dengan narasi ekspresif. Terinspirasi dan merujuk rekaman buku anak domain publik <strong>digitalbook.io</strong> & LibriVox.</p>
            </div>
            <a href="<?= base_url('perpustakaan/katalog?format=Audiobook') ?>" class="btn-view-all" style="background:rgba(255,255,255,0.15); color:#ffffff; border-color:rgba(255,255,255,0.3);">Semua Audiobook (6+) →</a>
        </div>

        <div class="story-grid">
            <?php foreach ($featured_stories as $story): ?>
                <div class="story-card">
                    <div class="story-card-top">
                        <span class="story-cat-pill"><?= esc($story['category'] ?? 'Audiobook') ?></span>
                        <span class="story-duration-pill">⏱️ <?= esc($story['duration'] ?? '10:00') ?></span>
                    </div>

                    <h3><?= esc($story['title']) ?></h3>
                    <p><?= esc($story['description']) ?></p>

                    <div class="story-source-tag">
                        <span class="digitalbook-badge">🌐 Ref: <?= esc($story['reference_site'] ?? 'digitalbook.io') ?></span>
                    </div>

                    <div class="story-narrator-row">
                        <div class="story-narrator-avatar">🎙️</div>
                        <span>Narator: <strong><?= esc($story['narrator'] ?? 'DigitalBook.io Storyteller') ?></strong></span>
                    </div>

                    <div class="story-player-bar">
                        <button type="button" class="btn-story-play" onclick="toggleAudioPreview(this, '<?= esc($story['title']) ?>')">▶</button>
                        <div class="soundwave-visual">
                            <div class="soundwave-bar"></div>
                            <div class="soundwave-bar"></div>
                            <div class="soundwave-bar"></div>
                            <div class="soundwave-bar"></div>
                            <div class="soundwave-bar"></div>
                            <div class="soundwave-bar"></div>
                            <div class="soundwave-bar"></div>
                            <div class="soundwave-bar"></div>
                            <div class="soundwave-bar"></div>
                            <div class="soundwave-bar"></div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Rekomendasi Sesuai Usia Anak (Semua untuk Anak, Bagian Orang Tua Dihapus) -->
<section class="library-section">
    <div class="container">
        <div class="section-head-flex">
            <div class="section-head-title">
                <h2><span>🎯</span> Rekomendasi Sesuai Usia Anak</h2>
                <p>Pilih buku dengan kosakata, tingkat visual, dan stimulasi imajinasi yang pas dengan usia si buah hati</p>
            </div>
        </div>

        <div class="age-cards-grid">
            <a href="<?= base_url('perpustakaan/katalog?age=2') ?>" class="age-card-item">
                <div class="age-card-icon">🍼</div>
                <span class="age-badge-pill">Usia 0 - 2 Tahun</span>
                <h3>Bayi & Balita</h3>
                <p>Buku bergambar cerah, board book tactile, pengenalan objek pertama, dan rima lembut untuk menstimulasi sensorik mata dan telinga.</p>
                <span class="age-explore-link">Jelajahi Usia 0-2 Tahun →</span>
            </a>

            <a href="<?= base_url('perpustakaan/katalog?age=4') ?>" class="age-card-item">
                <div class="age-card-icon">🎨</div>
                <span class="age-badge-pill">Usia 3 - 5 Tahun</span>
                <h3>Prasekolah Ceria</h3>
                <p>Kisah fabel hangat seperti <em>The Tale of Peter Rabbit</em> & <em>Winnie-the-Pooh</em>, melatih empati, rasa ingin tahu, dan kebiasaan berbagi.</p>
                <span class="age-explore-link">Jelajahi Usia 3-5 Tahun →</span>
            </a>

            <a href="<?= base_url('perpustakaan/katalog?age=7') ?>" class="age-card-item">
                <div class="age-card-icon">🚀</div>
                <span class="age-badge-pill">Usia 6 - 8 Tahun</span>
                <h3>Pembaca Pemula</h3>
                <p>Cerita berbab awal dan dongeng klasik seperti <em>Charlotte's Web</em> & <em>Pinocchio</em> yang mengasah logika serta memperkaya kosakata.</p>
                <span class="age-explore-link">Jelajahi Usia 6-8 Tahun →</span>
            </a>

            <a href="<?= base_url('perpustakaan/katalog?age=10') ?>" class="age-card-item">
                <div class="age-card-icon">📖</div>
                <span class="age-badge-pill">Usia 9 - 12 Tahun</span>
                <h3>Pembaca Mandiri</h3>
                <p>Novel anak legendaris dunia seperti <em>Le Petit Prince</em>, <em>The Secret Garden</em>, & <em>Peter and Wendy</em> yang kaya petualangan dan nilai filosofis.</p>
                <span class="age-explore-link">Jelajahi Usia 9-12 Tahun →</span>
            </a>
        </div>
    </div>
</section>

<!-- Baru Ditambahkan Pekan Ini -->
<section class="library-section bg-alt">
    <div class="container">
        <div class="section-head-flex">
            <div class="section-head-title">
                <h2><span>🆕</span> Baru Ditambahkan Pekan Ini</h2>
                <p>Koleksi terkini dan rilis audiobook yang siap menemani momen santai bersama si kecil</p>
            </div>
            <a href="<?= base_url('perpustakaan/katalog?sort=newest') ?>" class="btn-view-all">Koleksi Terbaru →</a>
        </div>

        <div class="lib-book-grid">
            <?php foreach ($new_arrivals as $book): ?>
                <?= view('library/_book_card', ['book' => $book]) ?>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Tips Menumbuhkan Minat Baca Anak & CTA Parentela AI -->
<section class="library-section">
    <div class="container">
        <div class="library-tips-banner">
            <div class="tips-banner-text">
                <h3>Tips Menumbuhkan Minat Baca Anak Sejak Dini 📖</h3>
                <p>Membaca bersama anak bukan sekadar mengeja huruf, melainkan membangun kelekatan batin (bonding) yang hangat serta melatih imajinasi kognitif si kecil.</p>
                
                <ul class="tips-feature-list">
                    <li>
                        <span class="tips-bullet">1</span>
                        <div>
                            <strong>Jadikan Rutinitas 15 Menit Sebelum Tidur</strong>
                            <p style="font-size:13px; color:var(--color-muted); margin:0;">Suasana malam yang tenang adalah waktu emas bagi anak menyerap cerita bermakna dan menenangkan gelombang otak.</p>
                        </div>
                    </li>
                    <li>
                        <span class="tips-bullet">2</span>
                        <div>
                            <strong>Beri Ruang Anak Bertanya & Menebak Alur</strong>
                            <p style="font-size:13px; color:var(--color-muted); margin:0;">Ajak anak berdialog: "Kira-kira apa yang akan dilakukan Peter Pan selanjutnya?" untuk melatih nalar kritis dan imajinasi aktif.</p>
                        </div>
                    </li>
                    <li>
                        <span class="tips-bullet">3</span>
                        <div>
                            <strong>Gunakan Ragam Intonasi Suara & Karakter</strong>
                            <p style="font-size:13px; color:var(--color-muted); margin:0;">Beri suara berbeda untuk beruang Pooh, kelinci, atau peri agar dongeng terasa hidup, seru, dan penuh keceriaan.</p>
                        </div>
                    </li>
                </ul>

                <!-- Tombol CTA Parentela AI (Direvisi dari Luna AI) -->
                <a href="<?= base_url('luna') ?>" class="btn-ask-luna">
                    <span>✨ Bingung Pilih Buku? Tanyakan Parentela AI</span>
                    <span>→</span>
                </a>
            </div>

            <div class="tips-banner-visual">
                <div class="quote-bubble">
                    "Anak-anak dibuat menjadi pembaca di pangkuan orang tua mereka. Setiap halaman yang kita buka bersama adalah benih imajinasi masa depannya."
                </div>
                <div class="quote-author">
                    <div style="font-size:24px;">🌸</div>
                    <div>
                        <strong>Emilie Buchwald</strong><br>
                        <span>Penulis & Pendidik Literasi Anak Sedunia</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
function toggleAudioPreview(btn, title) {
    if (btn.innerText === '▶') {
        btn.innerText = '⏸';
        btn.style.background = '#BC4F4F';
        btn.style.color = '#FFFFFF';
        
        const notif = document.createElement('div');
        notif.id = 'audio-toast';
        notif.style.cssText = 'position:fixed;bottom:24px;right:24px;background:#3D2C2A;color:#FFF;padding:14px 22px;border-radius:14px;box-shadow:0 10px 30px rgba(0,0,0,0.3);z-index:9999;font-size:13px;display:flex;align-items:center;gap:12px;border-left:5px solid #E98B50;';
        notif.innerHTML = '<span>🔊 Memutar cuplikan audio klasik: <strong>' + title + '</strong> (Ref: digitalbook.io)</span>';
        document.body.appendChild(notif);
        setTimeout(() => { if (notif.parentNode) notif.parentNode.removeChild(notif); }, 3800);
    } else {
        btn.innerText = '▶';
        btn.style.background = 'var(--color-primary-light)';
        btn.style.color = 'var(--color-primary)';
        const existing = document.getElementById('audio-toast');
        if (existing) existing.remove();
    }
}
</script>

<?= $this->endSection() ?>