<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<!-- GOOGLE FONTS IMPORT (OUTFIT, CAVEAT, PLAYFAIR DISPLAY) -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Caveat:wght@700&family=Outfit:wght@400;500;600;700;800&family=Playfair+Display:ital,wght@0,600;0,800;1,600&display=swap" rel="stylesheet">

<div class="kb-page-wrapper">
    
    <!-- 1. TOP HERO SECTION -->
    <section class="kb-hero-container">
        <div class="kb-hero-grid">
            
            <!-- HERO LEFT CARD -->
            <div class="kb-hero-card-left">
                <!-- DASHED SVG ACCENT (TEAL THEME) -->
                <svg class="kb-svg-curve" viewBox="0 0 300 200" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M10 100 C 90 20, 210 180, 290 100" stroke="#0D9488" stroke-width="2.5" stroke-dasharray="6 6" opacity="0.3"/>
                    <circle cx="290" cy="100" r="4" fill="#0D9488"/>
                    <circle cx="10" cy="100" r="4" fill="#0D9488"/>
                </svg>

                <div class="kb-chip-tag">
                    <span>🌱 Panduan Perencanaan Keluarga Sehat</span>
                </div>

                <h1 class="kb-hero-title">
                    Kontrasepsi & <span class="kb-pill kb-pill-teal">Perencanaan KB</span>
                </h1>

                <p class="kb-hero-subtitle">
                    Panduan lengkap medis, kalkulator jarak kehamilan, serta kuis interaktif pemilihan KB terbaik demi kesehatan ibu & masa depan keluarga yang bahagia.
                </p>

                <!-- QUICK STATS BADGES -->
                <div class="kb-hero-stats">
                    <div class="stat-pill-item">
                        <span class="stat-num">100%</span>
                        <span class="stat-lbl">Edukasi Medis Resmi</span>
                    </div>
                    <div class="stat-pill-divider"></div>
                    <div class="stat-pill-item">
                        <span class="stat-num">6+</span>
                        <span class="stat-lbl">Metode KB Teruji</span>
                    </div>
                    <div class="stat-pill-divider"></div>
                    <div class="stat-pill-item">
                        <span class="stat-num">Kuis & Calc</span>
                        <span class="stat-lbl">Fitur Interaktif Cerdas</span>
                    </div>
                </div>
            </div>

            <!-- HERO RIGHT CARD PHOTO -->
            <div class="kb-hero-card-right">
                <div class="kb-img-wrapper">
                    <img src="<?= base_url('images/family-pointing-left.jpg') ?>" alt="Perencanaan Keluarga Sejahtera Parentela" class="kb-hero-img">
                    
                    <!-- OVERLAY BADGES AT BOTTOM -->
                    <div class="kb-img-overlay-bar">
                        <div class="kb-overlay-badge badge-teal">
                            <span class="badge-title">Katalis Kesehatan</span>
                            <span class="badge-sub">Atur Jarak Kehamilan Ideal</span>
                        </div>
                        <div class="kb-overlay-badge badge-purple">
                            <span class="badge-title">Bebas Mitos</span>
                            <span class="badge-sub">Informasi Medis Terverifikasi</span>
                        </div>
                        <div class="kb-overlay-badge badge-rose">
                            <span class="badge-title">Ibu & Bayi Sehat</span>
                            <span class="badge-sub">Masa Nifas & Laktasi Aman</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- NAVIGATION ANCHOR BAR -->
    <div class="kb-nav-anchors-wrap">
        <div class="kb-nav-anchors">
            <a href="#katalog-kb" class="anchor-btn">📚 Katalogue Metode KB</a>
            <a href="#kuis-kb" class="anchor-btn highlight">🎯 Kuis "Cari KB Cocok"</a>
            <a href="#pascapersalinan" class="anchor-btn">🍼 KB Pascapersalinan</a>
            <a href="#mitos-fakta" class="anchor-btn">💡 Mitos vs Fakta KB</a>
            <a href="#kalkulator-jarak" class="anchor-btn">🧮 Kalkulator Jarak Hamil</a>
        </div>
    </div>

    <!-- 2. MODULE 1: ENCYCLOPEDIA & KATALOG METODE KB -->
    <section class="kb-section-container" id="katalog-kb">
        <div class="kb-chip-tag chip-center">
            <span>Ensiklopedi Medis Terpadu</span>
        </div>
        <h2 class="kb-section-title text-center">
            Katalog & Matriks Perbandingan <span class="kb-pill kb-pill-teal">Metode KB</span>
        </h2>
        <p class="kb-section-subtitle text-center">
            Bandingkan efektivitas, cara kerja, kelebihan, serta efek samping umum metode kontrasepsi Hormonal vs Non-Hormonal.
        </p>

        <!-- TAB BUTTONS HORMONAL VS NON-HORMONAL -->
        <div class="kb-tab-controls">
            <button type="button" class="kb-tab-btn active" onclick="switchKbTab('all')">Semua Metode KB</button>
            <button type="button" class="kb-tab-btn" onclick="switchKbTab('hormonal')">💉 KB Hormonal (Suntik, Pil, Implan)</button>
            <button type="button" class="kb-tab-btn" onclick="switchKbTab('non-hormonal')">🛡️ KB Non-Hormonal (IUD, Kondom, Steril)</button>
        </div>

        <!-- MATRIX CARDS GRID -->
        <div class="kb-matrix-grid">
            
            <!-- KB 1: IUD TEMBAGA (NON-HORMONAL) -->
            <div class="kb-matrix-card card-non-hormonal">
                <div class="kb-sticker-badge badge-teal-sticker">Non-Hormonal</div>
                <div class="matrix-card-header">
                    <div class="matrix-icon icon-teal">🌀</div>
                    <div>
                        <h3 class="matrix-title">IUD Tembaga (Spiral)</h3>
                        <span class="matrix-tag">Jangka Panjang (5 - 10 Tahun)</span>
                    </div>
                    <div class="eff-badge">Efektivitas 99.2%</div>
                </div>

                <div class="matrix-card-body">
                    <p class="matrix-desc">Alat kontrasepsi kecil berbentuk T yang dipasang dokter/bidan di dalam rahim tanpa mengganggu hormon tubuh.</p>
                    
                    <div class="matrix-detail-list">
                        <div class="detail-box box-green">
                            <strong>👍 Kelebihan Utama:</strong> Bebas hormon, tidak memengaruhi ASI, praktis tanpa perlu pengingat harian.
                        </div>
                        <div class="detail-box box-amber">
                            <strong>⚠️ Efek Samping Umum:</strong> Darah haid sedikit lebih banyak/kram pada 3-6 bulan pertama.
                        </div>
                        <div class="detail-box box-blue">
                            <strong>🔄 Kesuburan Kembali:</strong> Langsung bisa hamil segera setelah IUD dilepas oleh dokter.
                        </div>
                    </div>
                </div>
            </div>

            <!-- KB 2: IMPLAN / SUSUK KB (HORMONAL) -->
            <div class="kb-matrix-card card-hormonal">
                <div class="kb-sticker-badge badge-purple-sticker">Hormonal</div>
                <div class="matrix-card-header">
                    <div class="matrix-icon icon-purple">💊</div>
                    <div>
                        <h3 class="matrix-title">Implan / Susuk KB</h3>
                        <span class="matrix-tag">Jangka Menengah (3 Tahun)</span>
                    </div>
                    <div class="eff-badge">Efektivitas >99.9%</div>
                </div>

                <div class="matrix-card-body">
                    <p class="matrix-desc">Batang kecil fleksibel yang disisipkan di bawah kulit lengan atas untuk melepaskan hormon progestin secara berkala.</p>
                    
                    <div class="matrix-detail-list">
                        <div class="detail-box box-green">
                            <strong>👍 Kelebihan Utama:</strong> Perlindungan sangat tinggi 3 tahun nonstop, aman untuk ibu menyusui.
                        </div>
                        <div class="detail-box box-amber">
                            <strong>⚠️ Efek Samping Umum:</strong> Perubahan pola menstruasi (flek ringan atau tidak haid), mood swing awal.
                        </div>
                        <div class="detail-box box-blue">
                            <strong>🔄 Kesuburan Kembali:</strong> Pulih dalam 1 - 2 minggu setelah implan dilepas.
                        </div>
                    </div>
                </div>
            </div>

            <!-- KB 3: SUNTIK KB 3 BULAN (HORMONAL - MENYUSUI) -->
            <div class="kb-matrix-card card-hormonal">
                <div class="kb-sticker-badge badge-purple-sticker">Hormonal</div>
                <div class="matrix-card-header">
                    <div class="matrix-icon icon-purple">💉</div>
                    <div>
                        <h3 class="matrix-title">Suntik KB 3 Bulan</h3>
                        <span class="matrix-tag">Rutin (Tiap 12 Minggu)</span>
                    </div>
                    <div class="eff-badge">Efektivitas 99%</div>
                </div>

                <div class="matrix-card-body">
                    <p class="matrix-desc">Suntikan hormon progestin ke bokong/lengan yang dilakukan setiap 3 bulan sekali oleh tenaga medis.</p>
                    
                    <div class="matrix-detail-list">
                        <div class="detail-box box-green">
                            <strong>👍 Kelebihan Utama:</strong> Sangat disukai ibu menyusui karena tidak mengganggu kualitas ASI, praktis 3 bulan sekali.
                        </div>
                        <div class="detail-box box-amber">
                            <strong>⚠️ Efek Samping Umum:</strong> Flek menstruasi atau jarang haid, potensi penambahan berat badan ringan.
                        </div>
                        <div class="detail-box box-blue">
                            <strong>🔄 Kesuburan Kembali:</strong> Membutuhkan waktu 3 - 6 bulan setelah suntikan terakhir dihentikan.
                        </div>
                    </div>
                </div>
            </div>

            <!-- KB 4: PIL KB PROGESTIN / MINIPIL (HORMONAL) -->
            <div class="kb-matrix-card card-hormonal">
                <div class="kb-sticker-badge badge-purple-sticker">Hormonal</div>
                <div class="matrix-card-header">
                    <div class="matrix-icon icon-purple">💊</div>
                    <div>
                        <h3 class="matrix-title">Pil KB Progestin (Minipil)</h3>
                        <span class="matrix-tag">Harian Disiplin</span>
                    </div>
                    <div class="eff-badge">Efektivitas 99%</div>
                </div>

                <div class="matrix-card-body">
                    <p class="matrix-desc">Pil hormon harian khusus ibu menyusui yang diminum pada jam yang sama setiap hari.</p>
                    
                    <div class="matrix-detail-list">
                        <div class="detail-box box-green">
                            <strong>👍 Kelebihan Utama:</strong> Produksi ASI tetap melimpah, dapat dihentikan kapan saja secara mandiri.
                        </div>
                        <div class="detail-box box-amber">
                            <strong>⚠️ Efek Samping Umum:</strong> Membutuhkan kedisiplinan jam minum yang tinggi (toleransi terlambat max 3 jam).
                        </div>
                        <div class="detail-box box-blue">
                            <strong>🔄 Kesuburan Kembali:</strong> Sangat cepat, bisa langsung hamil begitu berhenti minum pil.
                        </div>
                    </div>
                </div>
            </div>

            <!-- KB 5: KONDOM PRIA / WANITA (NON-HORMONAL) -->
            <div class="kb-matrix-card card-non-hormonal">
                <div class="kb-sticker-badge badge-teal-sticker">Non-Hormonal</div>
                <div class="matrix-card-header">
                    <div class="matrix-icon icon-teal">🛡️</div>
                    <div>
                        <h3 class="matrix-title">Kondom Akses Mudah</h3>
                        <span class="matrix-tag">Insidental / Sekali Pakai</span>
                    </div>
                    <div class="eff-badge">Efektivitas 98%</div>
                </div>

                <div class="matrix-card-body">
                    <p class="matrix-desc">Metode penghalang medis yang digunakan saat berhubungan tanpa memengaruhi kondisi sistemik tubuh.</p>
                    
                    <div class="matrix-detail-list">
                        <div class="detail-box box-green">
                            <strong>👍 Kelebihan Utama:</strong> Satu-satunya metode yang murni mencegah Penyakit Menular Seksual (IMS) & bebas efek samping.
                        </div>
                        <div class="detail-box box-amber">
                            <strong>⚠️ Efek Samping Umum:</strong> Potensi bocor/sobek jika cara penggunaan tidak tepat atau kadaluarsa.
                        </div>
                        <div class="detail-box box-blue">
                            <strong>🔄 Kesuburan Kembali:</strong> Langsung fertil 100% saat tidak menggunakan kondom.
                        </div>
                    </div>
                </div>
            </div>

            <!-- KB 6: MOW / MOP (STERIL PERMANEN) -->
            <div class="kb-matrix-card card-non-hormonal">
                <div class="kb-sticker-badge badge-teal-sticker">Non-Hormonal</div>
                <div class="matrix-card-header">
                    <div class="matrix-icon icon-teal">✂️</div>
                    <div>
                        <h3 class="matrix-title">MOW / MOP (Tubektomi / Vasekto)</h3>
                        <span class="matrix-tag">Permanen / Kontrasepsi Mantap</span>
                    </div>
                    <div class="eff-badge">Efektivitas 99.9%</div>
                </div>

                <div class="matrix-card-body">
                    <p class="matrix-desc">Prosedur medis operasi kecil pengikatan saluran telur (wanita) atau saluran sperma (pria).</p>
                    
                    <div class="matrix-detail-list">
                        <div class="detail-box box-green">
                            <strong>👍 Kelebihan Utama:</strong> Permanen seumur hidup tanpa perlunya alat atau kontrol harian lagi.
                        </div>
                        <div class="detail-box box-amber">
                            <strong>⚠️ Efek Samping Umum:</strong> Membutuhkan kesepakatan mutlak suami-istri karena bersifat tidak dapat dikembalikan.
                        </div>
                        <div class="detail-box box-blue">
                            <strong>🔄 Kesuburan Kembali:</strong> Permanen (tidak direncanakan untuk hamil kembali).
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- 3. MODULE 2: FITUR INTERAKTIF KUIS "CARI KB YANG COCOK" -->
    <section class="kb-quiz-section" id="kuis-kb">
        <div class="kb-quiz-box">
            
            <div class="kb-chip-tag chip-center chip-white">
                <span>🎯 Fitur Decision Tree Medis</span>
            </div>

            <h2 class="kb-quiz-title text-center">
                Kuis Interaktif: <span class="kb-pill kb-pill-rose">Cari KB yang Cocok</span>
            </h2>

            <p class="kb-quiz-subtitle text-center">
                Jawab 4 pertanyaan singkat berikut untuk mendapatkan rekomendasi jenis KB yang paling sesuai dengan riwayat kesehatan & gaya hidup Anda.
            </p>

            <div class="kb-quiz-card">
                <!-- QUIZ STEPS CONTAINER -->
                <div id="quizContainer">
                    
                    <!-- STEP 1 -->
                    <div class="quiz-step active" id="quizStep1">
                        <div class="quiz-step-header">
                            <span class="step-num">Pertanyaan 1 dari 4</span>
                            <h3 class="question-text">Apakah Anda saat ini sedang menyusui bayi secara eksklusif (di bawah 6 bulan)?</h3>
                        </div>
                        <div class="quiz-options">
                            <button type="button" class="quiz-opt-btn" onclick="answerQuiz(1, 'asi')">
                                <span class="opt-icon">🍼</span>
                                <div class="opt-text">
                                    <strong>Ya, Menyusui Eksklusif (ASI)</strong>
                                    <small>Membutuhkan KB yang tidak mengganggu hormon produksi ASI</small>
                                </div>
                            </button>
                            <button type="button" class="quiz-opt-btn" onclick="answerQuiz(1, 'no_asi')">
                                <span class="opt-icon">👶</span>
                                <div class="opt-text">
                                    <strong>Tidak / Sudah Memakai Susu Formula & MPASI</strong>
                                    <small>Bebas memilih metode KB hormonal atau non-hormonal</small>
                                </div>
                            </button>
                        </div>
                    </div>

                    <!-- STEP 2 -->
                    <div class="quiz-step" id="quizStep2">
                        <div class="quiz-step-header">
                            <span class="step-num">Pertanyaan 2 dari 4</span>
                            <h3 class="question-text">Berapa lama jangka waktu perlindungan kehamilan yang Anda harapkan?</h3>
                        </div>
                        <div class="quiz-options">
                            <button type="button" class="quiz-opt-btn" onclick="answerQuiz(2, 'long')">
                                <span class="opt-icon">⏳</span>
                                <div class="opt-text">
                                    <strong>Jangka Panjang (3 hingga 10 Tahun)</strong>
                                    <small>Praktis sekali pasang untuk jeda kehamilan lama</small>
                                </div>
                            </button>
                            <button type="button" class="quiz-opt-btn" onclick="answerQuiz(2, 'short')">
                                <span class="opt-icon">📅</span>
                                <div class="opt-text">
                                    <strong>Jangka Pendek / Harian (1 Bulan - 3 Bulan)</strong>
                                    <small>Ingin fleksibilitas mudah berhenti sewaktu-waktu</small>
                                </div>
                            </button>
                        </div>
                    </div>

                    <!-- STEP 3 -->
                    <div class="quiz-step" id="quizStep3">
                        <div class="quiz-step-header">
                            <span class="step-num">Pertanyaan 3 dari 4</span>
                            <h3 class="question-text">Apakah Anda sering lupa atau memiliki rutinitas padat untuk minum obat di jam sama?</h3>
                        </div>
                        <div class="quiz-options">
                            <button type="button" class="quiz-opt-btn" onclick="answerQuiz(3, 'forgetful')">
                                <span class="opt-icon">🧠</span>
                                <div class="opt-text">
                                    <strong>Ya, Saya Pelupa / Jadwal Kerja Berubah-ubah</strong>
                                    <small>Tidak cocok dengan metode yang butuh konsistensi jam harian</small>
                                </div>
                            </button>
                            <button type="button" class="quiz-opt-btn" onclick="answerQuiz(3, 'disciplined')">
                                <span class="opt-icon">⏰</span>
                                <div class="opt-text">
                                    <strong>Tidak, Saya Sangat Disiplin Minum Obat Jam Sama</strong>
                                    <small>Dapat menjalankan rutinitas minum pil harian dengan lancar</small>
                                </div>
                            </button>
                        </div>
                    </div>

                    <!-- STEP 4 -->
                    <div class="quiz-step" id="quizStep4">
                        <div class="quiz-step-header">
                            <span class="step-num">Pertanyaan 4 dari 4</span>
                            <h3 class="question-text">Apakah Anda memiliki sensitivitas hormon (riwayat jerawat parah, flek hitam, atau mood swing)?</h3>
                        </div>
                        <div class="quiz-options">
                            <button type="button" class="quiz-opt-btn" onclick="answerQuiz(4, 'sensitive')">
                                <span class="opt-icon">🌿</span>
                                <div class="opt-text">
                                    <strong>Ya, Saya Sensitif Terhadap Perubahan Hormon</strong>
                                    <small>Lebih mengutamakan metode kontrasepsi Non-Hormonal</small>
                                </div>
                            </button>
                            <button type="button" class="quiz-opt-btn" onclick="answerQuiz(4, 'normal')">
                                <span class="opt-icon">✨</span>
                                <div class="opt-text">
                                    <strong>Tidak Terlalu Sensitif / Aman dengan Hormonal</strong>
                                    <small>Nyaman menggunakan opsi kontrasepsi sintetis berijin medis</small>
                                </div>
                            </button>
                        </div>
                    </div>

                    <!-- RESULT BOX -->
                    <div class="quiz-result-box" id="quizResult" style="display:none;">
                        <div class="result-badge">✨ Rekomendasi Medis Parentela</div>
                        <h3 class="result-title" id="resultTitle">KB IUD Tembaga & Implan</h3>
                        <p class="result-desc" id="resultDesc">Berdasarkan jawaban Anda, pilihan ini sangat ideal karena memberikan perlindungan maksimal tanpa mengganggu aktivitas harian.</p>
                        
                        <div class="result-highlights" id="resultHighlights">
                            <!-- JS Inject Highlights -->
                        </div>

                        <button type="button" class="btn-restart-quiz" onclick="restartQuiz()">
                            🔄 Ulangi Kuis Rekomendasi
                        </button>
                    </div>

                </div>
            </div>

        </div>
    </section>

    <!-- 4. MODULE 3: PANDUAN KB PASCAPERSALINAN (POSTPARTUM CONTRACEPTION) -->
    <section class="kb-section-container" id="pascapersalinan">
        <div class="kb-chip-tag chip-center">
            <span>Edukasi Postpartum Medis</span>
        </div>
        <h2 class="kb-section-title text-center">
            Panduan KB Pascapersalinan & <span class="kb-pill kb-pill-purple">Masa Nifas</span>
        </h2>
        <p class="kb-section-subtitle text-center">
            Informasi krusial mengenai waktu ideal pemasangan kontrasepsi setelah melahirkan serta metode alami selama masa laktasi.
        </p>

        <div class="postpartum-grid">
            
            <!-- POSTPARTUM CARD 1 -->
            <div class="postpartum-card">
                <div class="postpartum-icon-wrap icon-teal">⏱️</div>
                <h3 class="postpartum-card-title">Waktu Pemasangan Ideal KB</h3>
                <p class="postpartum-desc">Memahami momen yang paling tepat agar perlindungan kehamilan berjalan efektif tanpa mengganggu proses pemulihan fisik ibu.</p>
                
                <div class="postpartum-timeline">
                    <div class="timeline-item">
                        <span class="timeline-time">10 Menit Pasca Melahirkan</span>
                        <strong>IUD Pasca-Plasenta:</strong> Dipasang langsung oleh dokter spesialis kandungan sesaat setelah plasenta lahir (pada persalinan normal maupun C-section).
                    </div>

                    <div class="timeline-item">
                        <span class="timeline-time">Masa Nifas (6 Minggu / 40 Hari)</span>
                        <strong>Suntik 3 Bulan / Implan / Minipil:</strong> Dapat langsung diberikan pada kunjungan kontrol pasca-nifas tanpa memengaruhi ASI.
                    </div>

                    <div class="timeline-item">
                        <span class="timeline-time">6 Bulan Pasca Melahirkan</span>
                        <strong>KB Kombinasi (Pil Kombinasi / Suntik 1 Bulan):</strong> Baru diperbolehkan jika bayi sudah mulai makan MPASI dan tidak lagi menyusui ASI eksklusif.
                    </div>
                </div>
            </div>

            <!-- POSTPARTUM CARD 2 -->
            <div class="postpartum-card">
                <div class="postpartum-icon-wrap icon-rose">🥛</div>
                <h3 class="postpartum-card-title">Metode Amenore Laktasi (MAL)</h3>
                <p class="postpartum-desc">Penggunaan ASI Eksklusif sebagai kontrasepsi alami sementara pasca melahirkan dengan prinsip hormonal biologi ibu.</p>
                
                <div class="mal-criteria-box">
                    <h4 class="criteria-title">3 Syarat Wajib Kriteria MAL Efektif (98%):</h4>
                    <ul class="criteria-list">
                        <li>
                            <span class="check-icon">✓</span>
                            <div>
                                <strong>Bayi Belum Genap Berusia 6 Bulan:</strong> Efektivitas MAL akan menurun tajam saat bayi mulai memasuki fase MPASI.
                            </div>
                        </li>
                        <li>
                            <span class="check-icon">✓</span>
                            <div>
                                <strong>Menyusui Langsung Tanpa Jeda > 4 Jam:</strong> Ibu menyusui secara <em>on-demand</em> siang dan malam tanpa bantuan susu formula.
                            </div>
                        </li>
                        <li>
                            <span class="check-icon">✓</span>
                            <div>
                                <strong>Ibu Belum Mengalami Menstruasi:</strong> Belum ada flek atau haid kembali sejak masa nifas selesai.
                            </div>
                        </li>
                    </ul>

                    <div class="mal-warning-note">
                        ⚠️ <strong>Catatan Medis:</strong> Jika salah satu syarat di atas tidak terpenuhi, ibu disarankan segera menggunakan KB pendamping seperti IUD atau Minipil.
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- 5. MODULE 4: MITOS VS FAKTA KB -->
    <section class="kb-section-container" id="mitos-fakta">
        <div class="kb-chip-tag chip-center">
            <span>Edukasi Meluruskan Stigma</span>
        </div>
        <h2 class="kb-section-title text-center">
            Mitos vs Fakta Medis <span class="kb-pill kb-pill-teal">Seputar KB</span>
        </h2>
        <p class="kb-section-subtitle text-center">
            Mari meluruskan berbagai prasangka dan mitos keliru yang sering menghinggapi orang tua muda mengenai penggunaan kontrasepsi.
        </p>

        <div class="myths-grid">
            
            <!-- MYTH 1 -->
            <div class="myth-card">
                <div class="myth-header">
                    <span class="myth-badge">❌ MITOS POPULER</span>
                    <h4 class="myth-title">"KB IUD / Spiral bisa jalan-jalan bergeser naik sampai ke organ jantung atau paru-paru."</h4>
                </div>
                <div class="fact-body">
                    <span class="fact-badge">✅ FAKTA MEDIS</span>
                    <p class="fact-desc">IUD terpasang di dalam rongga rahim yang memiliki dinding otot sangat tebal dan tertutup rapat oleh leher rahim (serviks). IUD tidak dapat berpindah organ ke dada atau jantung. Jika posisi bergeser, IUD hanya akan lepas keluar ke vagina.</p>
                </div>
            </div>

            <!-- MYTH 2 -->
            <div class="myth-card">
                <div class="myth-header">
                    <span class="myth-badge">❌ MITOS POPULER</span>
                    <h4 class="myth-title">"Semua jenis KB pasti bikin badan tambah gemuk dan wajah penuh jerawat."</h4>
                </div>
                <div class="fact-body">
                    <span class="fact-badge">✅ FAKTA MEDIS</span>
                    <p class="fact-desc">KB Non-Hormonal seperti IUD Tembaga & Kondom 100% tidak memengaruhi hormon, nafsu makan, maupun kondisi kulit. Efek penambahan berat badan pada KB hormonal berbeda-beda pada setiap individu tergantung pola hidup & respons metabolisme.</p>
                </div>
            </div>

            <!-- MYTH 3 -->
            <div class="myth-card">
                <div class="myth-header">
                    <span class="myth-badge">❌ MITOS POPULER</span>
                    <h4 class="myth-title">"Memakai KB membuat rahim jadi kering dan bakal susah punya anak lagi nanti."</h4>
                </div>
                <div class="fact-body">
                    <span class="fact-badge">✅ FAKTA MEDIS</span>
                    <p class="fact-desc">Istilah 'rahim kering' tidak ada dalam kamus medis. Kontrasepsi hanya mengistirahatkan ovulasi secara sementara. Setelah alat KB dilepas atau dihentikan, tingkat kesuburan wanita akan kembali normal sesuai faktor usia & kesehatan organ reproduksi.</p>
                </div>
            </div>

        </div>
    </section>

    <!-- 6. MODULE 5: PERENCANAAN JARAK KEHAMILAN & LEPAS KB -->
    <section class="kb-section-container" id="kalkulator-jarak">
        <div class="kb-calculator-box">
            
            <div class="kb-chip-tag chip-center">
                <span>🧮 Tool Perencanaan Keluarga Medis</span>
            </div>

            <h2 class="kb-section-title text-center">
                Kalkulator Jarak Kehamilan Ideal & <span class="kb-pill kb-pill-rose">Panduan Lepas KB</span>
            </h2>

            <p class="kb-section-subtitle text-center">
                Organisasi Kesehatan Dunia (WHO) dan BKKBN merekomendasikan jeda minimal <strong>18–24 bulan</strong> antar kehamilan demi kesehatan organ ibu dan kecukupan gizi anak.
            </p>

            <div class="calc-grid">
                
                <!-- LEFT: CALCULATOR WIDGET -->
                <div class="calc-card">
                    <h3 class="calc-card-title">Hitung Jeda Kehamilan Sehat</h3>
                    <p class="calc-card-desc">Masukkan tanggal lahir anak terakhir Anda untuk mengetahui perkiraan waktu paling aman merencanakan adik berikutnya.</p>
                    
                    <div class="calc-form-group">
                        <label for="childBirthDate">Tanggal Lahir Anak Terakhir:</label>
                        <input type="date" id="childBirthDate" class="calc-input">
                    </div>

                    <button type="button" class="btn-calc-submit" onclick="calculateBirthSpacing()">
                        🧮 Hitung Jarak Kehamilan Ideal
                    </button>

                    <div id="calcResultBox" class="calc-result-display" style="display:none;">
                        <span class="res-lbl">Rekomendasi Medis Waktu Lepas KB:</span>
                        <h4 class="res-date" id="recommendedDateText">15 Oktober 2027</h4>
                        <p class="res-detail" id="recommendedDetailText">Memberikan jeda waktu 24 bulan dari kehamilan sebelumnya menurunkan risiko kelahiran prematur & stunting hingga 70%.</p>
                    </div>
                </div>

                <!-- RIGHT: PANDUAN LEPAS KB ESTIMASI FERTILITAS -->
                <div class="calc-card">
                    <h3 class="calc-card-title">Panduan Lepas KB (Estimasi Kesuburan)</h3>
                    <p class="calc-card-desc">Estimasi waktu kembalinya kesuburan pasca penghentian kontrasepsi bagi pasangan yang ingin promil anak berikutnya:</p>
                    
                    <div class="fertility-timeline-list">
                        <div class="fertility-item">
                            <span class="fert-icon">🌀</span>
                            <div class="fert-info">
                                <strong>IUD Tembaga:</strong> Kesuburan kembali **seketika** setelah IUD dicabut oleh bidan/dokter.
                            </div>
                        </div>

                        <div class="fertility-item">
                            <span class="fert-icon">💊</span>
                            <div class="fert-info">
                                <strong>Pil KB & Implan:</strong> Kesuburan kembali normal dalam kurun **1 hingga 2 minggu**.
                            </div>
                        </div>

                        <div class="fertility-item">
                            <span class="fert-icon">💉</span>
                            <div class="fert-info">
                                <strong>Suntik KB 3 Bulan:</strong> Kesuburan memerlukan waktu penyesuaian **3 hingga 6 bulan** pasca suntikan dihentikan.
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </section>

</div>

<style>
    /* ==========================================================================
       PERENCANAAN KELUARGA (KB) PAGE STYLES - TEAL / EMERALD / VIOLET ELEGANCE
       ========================================================================== */

    .kb-page-wrapper {
        background-color: #FFFDF9;
        padding: 50px 4% 90px;
        font-family: 'Outfit', sans-serif;
        color: #0F172A;
        overflow-x: hidden;
    }

    /* CHIP TAG ABOVE HEADINGS */
    .kb-chip-tag {
        display: inline-block;
        background-color: #CCFBF1;
        color: #0F766E;
        padding: 6px 18px;
        border-radius: 20px;
        font-size: 0.88rem;
        font-weight: 700;
        letter-spacing: 0.3px;
        margin-bottom: 16px;
        border: 1px solid rgba(13, 148, 136, 0.2);
    }

    .chip-center {
        margin: 0 auto 14px auto;
    }

    .chip-white {
        background-color: rgba(255, 255, 255, 0.95);
        color: #0F766E;
    }

    /* HIGHLIGHT PILL BADGES FOR TEXT */
    .kb-pill {
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

    .kb-pill-teal { background-color: #0D9488; }
    .kb-pill-purple { background-color: #7C3AED; }
    .kb-pill-rose { background-color: #F43F5E; }
    .kb-pill-emerald { background-color: #059669; }

    /* HERO SECTION */
    .kb-hero-container {
        max-width: 1240px;
        margin: 0 auto 50px;
    }

    .kb-hero-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 30px;
        align-items: stretch;
    }

    .kb-hero-card-left {
        background: linear-gradient(135deg, #E6FFFA 0%, #CCFBF1 100%);
        border: 1.5px solid rgba(13, 148, 136, 0.25);
        box-shadow: 0 10px 30px rgba(13, 148, 136, 0.08);
        border-radius: 28px;
        padding: 50px 45px;
        position: relative;
        display: flex;
        flex-direction: column;
        justify-content: center;
        overflow: hidden;
    }

    .kb-svg-curve {
        position: absolute;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        pointer-events: none;
    }

    .kb-hero-title {
        font-family: 'Outfit', sans-serif;
        font-size: 3.1rem;
        font-weight: 800;
        color: #134E4A;
        line-height: 1.2;
        margin-bottom: 20px;
        letter-spacing: -0.5px;
    }

    .kb-hero-subtitle {
        font-size: 1.12rem;
        color: #475569;
        line-height: 1.65;
        margin-bottom: 30px;
        max-width: 500px;
    }

    .kb-hero-stats {
        display: inline-flex;
        align-items: center;
        background-color: #ffffff;
        padding: 12px 24px;
        border-radius: 30px;
        box-shadow: 0 6px 20px rgba(13, 148, 136, 0.08);
        border: 1px solid rgba(13, 148, 136, 0.12);
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
        color: #0D9488;
        line-height: 1;
    }

    .stat-lbl {
        font-size: 0.76rem;
        color: #64748B;
        font-weight: 600;
        margin-top: 2px;
    }

    .stat-pill-divider {
        width: 1px;
        height: 28px;
        background-color: rgba(13, 148, 136, 0.15);
    }

    /* HERO RIGHT CARD PHOTO */
    .kb-hero-card-right {
        position: relative;
        border-radius: 28px;
        overflow: hidden;
        border: 1.5px solid rgba(13, 148, 136, 0.12);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
    }

    .kb-img-wrapper {
        width: 100%;
        height: 100%;
        min-height: 420px;
        position: relative;
    }

    .kb-hero-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    .kb-img-overlay-bar {
        position: absolute;
        bottom: 16px;
        left: 16px;
        right: 16px;
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 10px;
    }

    .kb-overlay-badge {
        padding: 12px 10px;
        border-radius: 18px;
        backdrop-filter: blur(10px);
        box-shadow: 0 4px 14px rgba(0, 0, 0, 0.08);
        display: flex;
        flex-direction: column;
        justify-content: center;
        text-align: center;
    }

    .badge-teal { background-color: rgba(204, 251, 241, 0.95); color: #0F766E; }
    .badge-purple { background-color: rgba(237, 233, 254, 0.95); color: #5B21B6; }
    .badge-rose { background-color: rgba(254, 226, 226, 0.95); color: #991B1B; }

    .badge-title { font-weight: 800; font-size: 0.85rem; line-height: 1.2; }
    .badge-sub { font-size: 0.74rem; opacity: 0.85; margin-top: 2px; }

    /* ANCHOR NAVIGATION BAR */
    .kb-nav-anchors-wrap {
        max-width: 1240px;
        margin: 0 auto 60px;
    }

    .kb-nav-anchors {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
        justify-content: center;
        background: #ffffff;
        padding: 12px 20px;
        border-radius: 30px;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.04);
        border: 1px solid rgba(0, 0, 0, 0.06);
    }

    .anchor-btn {
        padding: 8px 18px;
        border-radius: 20px;
        font-size: 0.88rem;
        font-weight: 700;
        text-decoration: none;
        color: #475569;
        background: #F8FAFC;
        transition: all 0.2s ease;
    }

    .anchor-btn:hover {
        background: #CCFBF1;
        color: #0F766E;
    }

    .anchor-btn.highlight {
        background: #0D9488;
        color: #ffffff;
        box-shadow: 0 4px 12px rgba(13, 148, 136, 0.25);
    }

    /* SECTION CONTAINERS & HEADINGS */
    .kb-section-container {
        max-width: 1240px;
        margin: 0 auto 80px;
        scroll-margin-top: 80px;
    }

    .kb-section-title {
        font-family: 'Outfit', sans-serif;
        font-size: 2.3rem;
        font-weight: 800;
        color: #134E4A;
        line-height: 1.3;
        margin-bottom: 12px;
    }

    .kb-section-subtitle {
        font-size: 1.05rem;
        color: #475569;
        line-height: 1.6;
        max-width: 780px;
        margin: 0 auto 36px;
    }

    .text-center { text-align: center; }

    /* MODULE 1: KATALOG MATRIX STYLES */
    .kb-tab-controls {
        display: flex;
        justify-content: center;
        gap: 12px;
        margin-bottom: 36px;
        flex-wrap: wrap;
    }

    .kb-tab-btn {
        padding: 10px 24px;
        border-radius: 30px;
        font-family: 'Outfit', sans-serif;
        font-size: 0.92rem;
        font-weight: 700;
        border: 1.5px solid rgba(13, 148, 136, 0.2);
        background: #ffffff;
        color: #475569;
        cursor: pointer;
        transition: all 0.25s ease;
    }

    .kb-tab-btn:hover {
        background: #E6FFFA;
        color: #0D9488;
    }

    .kb-tab-btn.active {
        background: #0D9488;
        color: #ffffff;
        border-color: #0D9488;
        box-shadow: 0 4px 14px rgba(13, 148, 136, 0.3);
    }

    .kb-matrix-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 28px;
    }

    .kb-matrix-card {
        background: #ffffff;
        border-radius: 26px;
        padding: 32px 24px 26px;
        position: relative;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.04);
        display: flex;
        flex-direction: column;
        transition: transform 0.25s ease, box-shadow 0.25s ease;
    }

    .card-non-hormonal {
        border: 1.5px solid rgba(13, 148, 136, 0.25);
    }

    .card-hormonal {
        border: 1.5px solid rgba(124, 58, 237, 0.25);
    }

    .kb-matrix-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 16px 36px rgba(0, 0, 0, 0.09);
    }

    .kb-sticker-badge {
        position: absolute;
        top: -14px;
        left: 20px;
        padding: 4px 20px;
        border-radius: 20px;
        font-family: 'Caveat', cursive;
        font-size: 1.45rem;
        font-weight: 700;
        color: #ffffff;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.12);
    }

    .badge-teal-sticker { background-color: #0D9488; }
    .badge-purple-sticker { background-color: #7C3AED; }

    .matrix-card-header {
        display: flex;
        flex-direction: column;
        gap: 8px;
        margin-bottom: 16px;
        margin-top: 6px;
    }

    .matrix-icon {
        width: 46px;
        height: 46px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.4rem;
    }

    .icon-teal { background: #CCFBF1; }
    .icon-purple { background: #EDE9FE; }

    .matrix-title {
        font-family: 'Outfit', sans-serif;
        font-size: 1.3rem;
        font-weight: 800;
        color: #0F172A;
        line-height: 1.25;
    }

    .matrix-tag {
        font-size: 0.8rem;
        color: #64748B;
        font-weight: 600;
    }

    .eff-badge {
        display: inline-block;
        align-self: flex-start;
        background: #DCFCE7;
        color: #15803D;
        font-size: 0.78rem;
        font-weight: 800;
        padding: 4px 12px;
        border-radius: 14px;
        margin-top: 4px;
    }

    .matrix-card-body {
        display: flex;
        flex-direction: column;
        flex-grow: 1;
    }

    .matrix-desc {
        font-size: 0.9rem;
        color: #475569;
        line-height: 1.55;
        margin-bottom: 18px;
    }

    .matrix-detail-list {
        display: flex;
        flex-direction: column;
        gap: 10px;
        margin-top: auto;
    }

    .detail-box {
        border-radius: 14px;
        padding: 10px 14px;
        font-size: 0.84rem;
        line-height: 1.45;
    }

    .box-green { background: #F0FDF4; color: #166534; }
    .box-amber { background: #FFFBEB; color: #92400E; }
    .box-blue { background: #EFF6FF; color: #1E40AF; }

    /* MODULE 2: QUIZ DECISION TREE STYLES */
    .kb-quiz-section {
        max-width: 1240px;
        margin: 0 auto 80px;
    }

    .kb-quiz-box {
        background: linear-gradient(135deg, #0F766E 0%, #0D9488 100%);
        border-radius: 32px;
        padding: 50px 40px;
        color: #ffffff;
        box-shadow: 0 14px 40px rgba(13, 148, 136, 0.2);
    }

    .kb-quiz-title {
        font-family: 'Outfit', sans-serif;
        font-size: 2.3rem;
        font-weight: 800;
        margin-bottom: 12px;
    }

    .kb-quiz-subtitle {
        font-size: 1.05rem;
        opacity: 0.9;
        max-width: 700px;
        margin: 0 auto 36px;
    }

    .kb-quiz-card {
        background: #ffffff;
        color: #0F172A;
        border-radius: 26px;
        padding: 40px 36px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.12);
        max-width: 820px;
        margin: 0 auto;
    }

    .quiz-step { display: none; }
    .quiz-step.active { display: block; }

    .quiz-step-header {
        margin-bottom: 24px;
    }

    .step-num {
        display: inline-block;
        background: #CCFBF1;
        color: #0F766E;
        font-size: 0.8rem;
        font-weight: 800;
        padding: 4px 14px;
        border-radius: 12px;
        margin-bottom: 10px;
    }

    .question-text {
        font-family: 'Outfit', sans-serif;
        font-size: 1.35rem;
        font-weight: 800;
        color: #0F172A;
        line-height: 1.35;
    }

    .quiz-options {
        display: flex;
        flex-direction: column;
        gap: 14px;
    }

    .quiz-opt-btn {
        display: flex;
        align-items: center;
        gap: 16px;
        background: #F8FAFC;
        border: 2px solid #E2E8F0;
        border-radius: 20px;
        padding: 16px 20px;
        text-align: left;
        cursor: pointer;
        transition: all 0.25s ease;
    }

    .quiz-opt-btn:hover {
        border-color: #0D9488;
        background: #F0FDF4;
        transform: translateY(-2px);
    }

    .opt-icon {
        font-size: 1.8rem;
        flex-shrink: 0;
    }

    .opt-text strong {
        display: block;
        font-family: 'Outfit', sans-serif;
        font-size: 1.02rem;
        color: #0F172A;
        margin-bottom: 2px;
    }

    .opt-text small {
        font-size: 0.85rem;
        color: #64748B;
    }

    /* QUIZ RESULT STYLES */
    .quiz-result-box {
        text-align: center;
        padding: 10px 0;
    }

    .result-badge {
        display: inline-block;
        background: #DCFCE7;
        color: #15803D;
        font-size: 0.85rem;
        font-weight: 800;
        padding: 6px 18px;
        border-radius: 20px;
        margin-bottom: 14px;
    }

    .result-title {
        font-family: 'Outfit', sans-serif;
        font-size: 1.8rem;
        font-weight: 800;
        color: #0F766E;
        margin-bottom: 10px;
    }

    .result-desc {
        font-size: 1rem;
        color: #475569;
        line-height: 1.6;
        max-width: 600px;
        margin: 0 auto 24px;
    }

    .result-highlights {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 16px;
        text-align: left;
        margin-bottom: 28px;
    }

    .res-high-card {
        background: #F8FAFC;
        border-radius: 18px;
        padding: 16px;
        border: 1px solid #E2E8F0;
    }

    .res-high-card h5 {
        font-family: 'Outfit', sans-serif;
        font-size: 1.05rem;
        font-weight: 800;
        color: #0F172A;
        margin-bottom: 6px;
    }

    .res-high-card p {
        font-size: 0.85rem;
        color: #475569;
        line-height: 1.45;
        margin: 0;
    }

    .btn-restart-quiz {
        background: #0D9488;
        color: #ffffff;
        font-family: 'Outfit', sans-serif;
        font-size: 0.95rem;
        font-weight: 700;
        padding: 12px 28px;
        border-radius: 30px;
        border: none;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .btn-restart-quiz:hover {
        background: #0F766E;
        transform: translateY(-2px);
    }

    /* MODULE 3: POSTPARTUM STYLES */
    .postpartum-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 28px;
    }

    .postpartum-card {
        background: #ffffff;
        border-radius: 26px;
        padding: 36px 30px;
        border: 1.5px solid rgba(13, 148, 136, 0.15);
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.04);
    }

    .postpartum-icon-wrap {
        width: 52px;
        height: 52px;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.6rem;
        margin-bottom: 16px;
    }

    .icon-rose { background: #FFE4E6; }

    .postpartum-card-title {
        font-family: 'Outfit', sans-serif;
        font-size: 1.4rem;
        font-weight: 800;
        color: #0F172A;
        margin-bottom: 8px;
    }

    .postpartum-desc {
        font-size: 0.95rem;
        color: #64748B;
        line-height: 1.6;
        margin-bottom: 24px;
    }

    .postpartum-timeline {
        display: flex;
        flex-direction: column;
        gap: 16px;
    }

    .timeline-item {
        background: #FFFDF9;
        border-left: 4px solid #0D9488;
        border-radius: 0 16px 16px 0;
        padding: 14px 18px;
        font-size: 0.9rem;
        color: #475569;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.02);
    }

    .timeline-time {
        display: block;
        font-size: 0.78rem;
        font-weight: 800;
        color: #0D9488;
        margin-bottom: 4px;
    }

    .mal-criteria-box {
        background: #F0FDF4;
        border-radius: 20px;
        padding: 20px;
        border: 1px solid rgba(34, 197, 94, 0.2);
    }

    .criteria-title {
        font-family: 'Outfit', sans-serif;
        font-size: 1.05rem;
        font-weight: 800;
        color: #166534;
        margin-bottom: 14px;
    }

    .criteria-list {
        list-style: none;
        padding: 0;
        margin: 0 0 16px 0;
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .criteria-list li {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        font-size: 0.88rem;
        color: #334155;
    }

    .check-icon {
        color: #16A34A;
        font-weight: 800;
        font-size: 1.1rem;
    }

    .mal-warning-note {
        background: #FEF3C7;
        color: #92400E;
        font-size: 0.84rem;
        padding: 10px 14px;
        border-radius: 12px;
        line-height: 1.45;
    }

    /* MODULE 4: MYTHS VS FACTS STYLES */
    .myths-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 24px;
    }

    .myth-card {
        background: #ffffff;
        border-radius: 24px;
        overflow: hidden;
        border: 1.5px solid rgba(0, 0, 0, 0.08);
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.04);
        display: flex;
        flex-direction: column;
        transition: transform 0.25s ease;
    }

    .myth-card:hover {
        transform: translateY(-5px);
    }

    .myth-header {
        background: #FFF1F2;
        padding: 24px;
        border-bottom: 1px solid #FFE4E6;
    }

    .myth-badge {
        font-size: 0.75rem;
        font-weight: 800;
        color: #E11D48;
        letter-spacing: 0.5px;
    }

    .myth-title {
        font-family: 'Outfit', sans-serif;
        font-size: 1.1rem;
        font-weight: 800;
        color: #881337;
        margin-top: 8px;
        line-height: 1.35;
    }

    .fact-body {
        padding: 24px;
        background: #F0FDF4;
        flex-grow: 1;
    }

    .fact-badge {
        font-size: 0.75rem;
        font-weight: 800;
        color: #16A34A;
        letter-spacing: 0.5px;
    }

    .fact-desc {
        font-size: 0.9rem;
        color: #166534;
        line-height: 1.55;
        margin-top: 8px;
    }

    /* MODULE 5: CALCULATOR STYLES */
    .kb-calculator-box {
        background: #ffffff;
        border-radius: 32px;
        padding: 50px 40px;
        border: 1.5px solid rgba(13, 148, 136, 0.15);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
    }

    .calc-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 32px;
        margin-top: 32px;
    }

    .calc-card {
        background: #FFFDF9;
        border-radius: 24px;
        padding: 30px 26px;
        border: 1px solid rgba(0, 0, 0, 0.06);
        box-shadow: 0 4px 14px rgba(0, 0, 0, 0.02);
    }

    .calc-card-title {
        font-family: 'Outfit', sans-serif;
        font-size: 1.35rem;
        font-weight: 800;
        color: #0F172A;
        margin-bottom: 8px;
    }

    .calc-card-desc {
        font-size: 0.92rem;
        color: #64748B;
        line-height: 1.55;
        margin-bottom: 20px;
    }

    .calc-form-group {
        margin-bottom: 18px;
    }

    .calc-form-group label {
        display: block;
        font-size: 0.88rem;
        font-weight: 700;
        color: #334155;
        margin-bottom: 8px;
    }

    .calc-input {
        width: 100%;
        padding: 12px 16px;
        border-radius: 14px;
        border: 1.5px solid #CBD5E1;
        font-family: 'Outfit', sans-serif;
        font-size: 1rem;
        outline: none;
        transition: border-color 0.2s ease;
    }

    .calc-input:focus {
        border-color: #0D9488;
    }

    .btn-calc-submit {
        width: 100%;
        background: #0D9488;
        color: #ffffff;
        font-family: 'Outfit', sans-serif;
        font-size: 0.95rem;
        font-weight: 700;
        padding: 12px 20px;
        border-radius: 30px;
        border: none;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .btn-calc-submit:hover {
        background: #0F766E;
    }

    .calc-result-display {
        margin-top: 20px;
        background: #E6FFFA;
        border: 1.5px solid #0D9488;
        border-radius: 18px;
        padding: 18px;
        text-align: center;
    }

    .res-lbl {
        font-size: 0.8rem;
        font-weight: 800;
        color: #0F766E;
    }

    .res-date {
        font-family: 'Outfit', sans-serif;
        font-size: 1.6rem;
        font-weight: 800;
        color: #0D9488;
        margin: 6px 0;
    }

    .res-detail {
        font-size: 0.85rem;
        color: #334155;
        line-height: 1.45;
        margin: 0;
    }

    .fertility-timeline-list {
        display: flex;
        flex-direction: column;
        gap: 14px;
    }

    .fertility-item {
        background: #ffffff;
        border-radius: 16px;
        padding: 14px 16px;
        display: flex;
        align-items: center;
        gap: 14px;
        border: 1px solid rgba(0, 0, 0, 0.05);
    }

    .fert-icon {
        font-size: 1.5rem;
        flex-shrink: 0;
    }

    .fert-info {
        font-size: 0.88rem;
        color: #475569;
        line-height: 1.45;
    }

    /* RESPONSIVE DESIGN BREAKPOINTS */
    @media (max-width: 1024px) {
        .kb-hero-grid,
        .kb-matrix-grid,
        .postpartum-grid,
        .myths-grid,
        .calc-grid {
            grid-template-columns: 1fr;
        }

        .kb-hero-title,
        .kb-section-title,
        .kb-quiz-title {
            font-size: 2rem;
        }
    }

    @media (max-width: 640px) {
        .kb-page-wrapper {
            padding: 30px 16px 60px;
        }

        .kb-hero-card-left,
        .kb-quiz-box,
        .kb-calculator-box {
            padding: 35px 20px;
            border-radius: 22px;
        }

        .result-highlights {
            grid-template-columns: 1fr;
        }
    }
</style>

<!-- INTERACTIVE SCRIPTS (TAB, QUIZ DECISION TREE, CALCULATOR) -->
<script>
// 1. SWITCH TAB METODE KB
function switchKbTab(category) {
    const tabBtns = document.querySelectorAll('.kb-tab-btn');
    const matrixCards = document.querySelectorAll('.kb-matrix-card');

    tabBtns.forEach(btn => btn.classList.remove('active'));
    event.target.classList.add('active');

    matrixCards.forEach(card => {
        if (category === 'all') {
            card.style.display = 'flex';
        } else if (category === 'hormonal') {
            if (card.classList.contains('card-hormonal')) {
                card.style.display = 'flex';
            } else {
                card.style.display = 'none';
            }
        } else if (category === 'non-hormonal') {
            if (card.classList.contains('card-non-hormonal')) {
                card.style.display = 'flex';
            } else {
                card.style.display = 'none';
            }
        }
    });
}

// 2. QUIZ DECISION TREE LOGIC
const quizAnswers = {
    asi: false,
    duration: 'long',
    forgetful: false,
    sensitive: false
};

function answerQuiz(step, value) {
    if (step === 1) quizAnswers.asi = (value === 'asi');
    if (step === 2) quizAnswers.duration = value;
    if (step === 3) quizAnswers.forgetful = (value === 'forgetful');
    if (step === 4) quizAnswers.sensitive = (value === 'sensitive');

    const currentStep = document.getElementById('quizStep' + step);
    if (currentStep) currentStep.classList.remove('active');

    if (step < 4) {
        const nextStep = document.getElementById('quizStep' + (step + 1));
        if (nextStep) nextStep.classList.add('active');
    } else {
        renderQuizResult();
    }
}

function renderQuizResult() {
    const resultBox = document.getElementById('quizResult');
    const resultTitle = document.getElementById('resultTitle');
    const resultDesc = document.getElementById('resultDesc');
    const resultHighlights = document.getElementById('resultHighlights');

    let recTitle = "";
    let recDesc = "";
    let highlights = [];

    if (quizAnswers.sensitive || (quizAnswers.duration === 'long' && quizAnswers.asi)) {
        recTitle = "IUD Tembaga (Spiral Non-Hormonal)";
        recDesc = "Rekomendasi terbaik untuk Anda karena 100% bebas dari efek samping hormon, tidak memengaruhi kuantitas ASI, dan memberikan perlindungan aman hingga 10 tahun.";
        highlights = [
            { title: " Bebas Efek Samping Hormon", desc: "Tidak membuat kulit berjerawat, flek, atau perubahan mood." },
            { title: " Aman 100% untuk Laktasi", desc: "Produksi ASI tetap melimpah dan lancar untuk buah hati." }
        ];
    } else if (quizAnswers.duration === 'long') {
        recTitle = "Implan KB (Susuk 3 Tahun)";
        recDesc = "Pilihan ideal untuk perlindungan jangka menengah yang praktis tanpa perlu pengingat harian. Sangat aman bagi ibu menyusui.";
        highlights = [
            { title: " Praktis Sekali Pasang 3 Tahun", desc: "Tidak perlu repot ke klinik setiap bulan." },
            { title: " Tingkat Efektivitas >99.9%", desc: "Daya cegah kehamilan tertinggi secara medis." }
        ];
    } else if (quizAnswers.forgetful || quizAnswers.asi) {
        recTitle = "Suntik KB 3 Bulan / Minipil Progestin";
        recDesc = "Sangat cocok untuk ibu menyusui atau pasangan yang menginginkan fleksibilitas tanpa perlu jadwal minum obat yang ketat.";
        highlights = [
            { title: " Hormon Progestin Ramah ASI", desc: "Formulasi khusus yang menjaga gizi dan kualitas ASI." },
            { title: " Rutinitas Ringkas", desc: "Cukup kontrol 3 bulan sekali atau minum pil progestin." }
        ];
    } else {
        recTitle = "Pil KB Kombinasi / Kondom Kesehatan";
        recDesc = "Cocok untuk Anda yang menginginkan fleksibilitas penuh dengan jadwal menstruasi yang teratur serta perlindungan harian.";
        highlights = [
            { title: " Siklus Menstruasi Teratur", desc: "Membantu menyeimbangkan siklus haid bulanan." },
            { title: " Fleksibilitas Tinggi", desc: "Dapat dihentikan kapan saja secara mandiri." }
        ];
    }

    resultTitle.textContent = recTitle;
    resultDesc.textContent = recDesc;

    resultHighlights.innerHTML = highlights.map(h => `
        <div class="res-high-card">
            <h5>${h.title}</h5>
            <p>${h.desc}</p>
        </div>
    `).join('');

    resultBox.style.display = 'block';
}

function restartQuiz() {
    document.getElementById('quizResult').style.display = 'none';
    for (let i = 1; i <= 4; i++) {
        const step = document.getElementById('quizStep' + i);
        if (step) step.classList.remove('active');
    }
    const step1 = document.getElementById('quizStep1');
    if (step1) step1.classList.add('active');
}

// 3. KALKULATOR JARAK KEHAMILAN IDEAL
function calculateBirthSpacing() {
    const input = document.getElementById('childBirthDate');
    const resultBox = document.getElementById('calcResultBox');
    const recommendedDateText = document.getElementById('recommendedDateText');
    const recommendedDetailText = document.getElementById('recommendedDetailText');

    if (!input || !input.value) {
        alert('Silakan pilih tanggal lahir anak terakhir Anda terlebih dahulu.');
        return;
    }

    const birthDate = new Date(input.value);
    
    // Add 24 months (2 years) for medical ideal spacing
    const recDate = new Date(birthDate);
    recDate.setMonth(recDate.getMonth() + 24);

    const options = { year: 'numeric', month: 'long', day: 'numeric' };
    const formattedDate = recDate.toLocaleDateString('id-ID', options);

    recommendedDateText.textContent = formattedDate;
    recommendedDetailText.textContent = 'Menjaga jeda 24 bulan dari kehamilan sebelumnya terbukti secara medis mengoptimalkan pemulihan stamina rahim ibu serta mencegah risiko stunting pada anak.';

    resultBox.style.display = 'block';
}
</script>

<?= $this->endSection() ?>
