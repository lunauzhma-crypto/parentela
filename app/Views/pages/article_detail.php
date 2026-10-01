<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<!-- Link Modular CSS Detail Konten -->
<link rel="stylesheet" href="<?= base_url('css/article_detail.css') ?>?v=<?= file_exists(FCPATH . 'css/article_detail.css') ? filemtime(FCPATH . 'css/article_detail.css') : time() ?>">

<?php 
    $isLoggedIn = (bool) session()->get('is_logged_in');
    $currentUserName = session()->get('user_name') ?? 'Ayah & Bunda';
?>

<div class="art-detail-wrapper" id="detailContentWrapper" data-content-id="<?= esc($content['id']) ?>">
    <div class="container">

        <!-- ══════════════════════════════════════════════════════════
             1. DETAIL TOP NAVIGATION BAR
             ══════════════════════════════════════════════════════════ -->
        <div class="detail-top-bar">
            <!-- Back to Articles Button -->
            <a href="<?= base_url('articles') ?>" class="detail-back-btn">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="19" y1="12" x2="5" y2="12"></line>
                    <polyline points="12 19 5 12 12 5"></polyline>
                </svg>
                <span>Kembali ke Artikel</span>
            </a>

            <!-- Action Buttons: Like, Save/Bookmark, Share -->
            <div class="detail-top-actions">
                <!-- Like Button -->
                <button type="button" class="detail-action-btn" id="btnDetailLike" title="Sukai konten ini">
                    <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                    </svg>
                    <span id="detailLikeCount"><?= esc($content['likes']) ?></span>
                </button>
            </div>
        </div>

        <!-- ══════════════════════════════════════════════════════════
             2. DESKTOP 3-COLUMN LAYOUT (TEMPO SHARE BAR + KONTEN + SIDEBAR)
             ══════════════════════════════════════════════════════════ -->
        <div class="detail-layout-grid">

            <!-- ── BILAH ALAT, SIMPAN & BAGIKAN (TEMPO STYLE) ── -->
            <aside class="tempo-share-aside" id="tempoShareWidget" aria-label="Bilah Alat Artikel">
                <div class="tempo-share-card">
                    <div class="tempo-handle-bar"></div>

                    <!-- Tombol Ukuran Huruf (Aa) -->
                    <button type="button" class="tempo-btn tempo-btn-aa" id="btnTempoFontSize" title="Sesuaikan Ukuran Teks">
                        <span class="tempo-aa-label">A<small>a</small></span>
                    </button>

                    <!-- Tombol Simpan / Bookmark -->
                    <button type="button" class="tempo-btn tempo-btn-save" id="btnTempoSave" title="Simpan Artikel">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"></path>
                        </svg>
                    </button>

                    <!-- Divider -->
                    <div class="tempo-divider"></div>

                    <!-- Label Bagikan -->
                    <span class="tempo-share-label">Bagikan</span>

                    <!-- WhatsApp -->
                    <a href="#" class="tempo-btn tempo-btn-share" id="btnShareWa" title="Bagikan ke WhatsApp" aria-label="Bagikan ke WhatsApp" target="_blank" rel="noopener">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.890-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                        </svg>
                    </a>

                    <!-- Facebook -->
                    <a href="#" class="tempo-btn tempo-btn-share" id="btnShareFb" title="Bagikan ke Facebook" aria-label="Bagikan ke Facebook" target="_blank" rel="noopener">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                        </svg>
                    </a>

                    <!-- X (Twitter) -->
                    <a href="#" class="tempo-btn tempo-btn-share" id="btnShareX" title="Bagikan ke X" aria-label="Bagikan ke X" target="_blank" rel="noopener">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-4.714-6.231-5.401 6.231H2.746l7.73-8.835L1.254 2.25H8.08l4.713 5.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
                        </svg>
                    </a>

                    <!-- Threads -->
                    <a href="#" class="tempo-btn tempo-btn-share" id="btnShareThreads" title="Bagikan ke Threads" aria-label="Bagikan ke Threads" target="_blank" rel="noopener">
                        <svg width="20" height="20" viewBox="0 0 192 192" fill="currentColor">
                            <path d="M141.537 88.988a66.667 66.667 0 00-2.518-1.143c-1.482-27.307-16.403-42.94-41.457-43.1h-.34c-14.986 0-27.449 6.396-35.12 18.036l13.779 9.452c5.73-8.695 14.724-10.548 21.348-10.548h.229c8.249.053 14.474 2.452 18.503 7.129 2.932 3.405 4.893 8.111 5.864 14.05-7.314-1.243-15.224-1.626-23.68-1.14-23.82 1.371-39.134 15.264-38.105 34.568.522 9.792 5.4 18.216 13.735 23.719 7.047 4.652 16.124 6.927 25.557 6.412 12.458-.683 22.231-5.436 29.049-14.127 5.178-6.6 8.453-15.153 9.899-25.93 5.937 3.583 10.337 8.298 12.767 13.966 4.132 9.635 4.373 25.468-8.546 38.376-11.319 11.308-24.925 16.2-45.488 16.351-22.809-.169-40.06-7.484-51.275-21.742C35.236 139.966 29.808 120.682 29.605 96c.203-24.682 5.63-43.966 16.133-57.317C56.954 24.425 74.206 17.11 97.015 16.94c22.975.17 40.526 7.52 52.171 21.847 5.71 7.026 10.015 15.86 12.853 26.162l16.147-4.308c-3.44-12.68-8.853-23.606-16.219-32.668C147.036 9.607 125.202.195 97.19 0h-.38C68.956.195 47.439 9.643 33.095 28.108 20.226 44.606 13.652 67.052 13.424 95.999v.002c.228 28.947 6.802 51.392 19.671 67.891C47.44 182.357 68.956 191.805 96.81 192h.38c24.268-.163 41.37-6.527 55.539-20.73 18.314-18.336 17.767-41.202 11.716-55.24-4.255-9.92-12.439-17.946-22.908-23.042zm-47.33 45.97c-10.427.58-21.258-4.098-21.83-14.135-.424-7.959 5.647-16.831 24.02-17.87 2.1-.12 4.16-.177 6.177-.177 6.25 0 12.105.61 17.444 1.778-1.978 24.65-15.956 29.823-25.81 30.404z"/>
                        </svg>
                    </a>

                    <!-- SMS -->
                    <a href="#" class="tempo-btn tempo-btn-share" id="btnShareSms" title="Bagikan via SMS" aria-label="Bagikan via SMS">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                        </svg>
                    </a>

                    <!-- Salin Link -->
                    <button type="button" class="tempo-btn tempo-btn-share" id="btnShareCopy" title="Salin Tautan Artikel" aria-label="Salin tautan artikel">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect>
                            <path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path>
                        </svg>
                    </button>
                </div>
            </aside>


            <!-- ── KOLOM UTAMA (KONTEN) ── -->
            <div class="detail-main-col">

                <!-- HERO MEDIA (IMAGE ATAU VIDEO PLAYER) -->
                <?php if ($content['type'] === 'video'): ?>
                    <!-- Pemutar Video Interaktif (Tipe Video) -->
                    <div class="detail-hero-media">
                        <div class="video-player-bar">
                            <span id="activeVideoTitle"><?= esc($content['active_episode_title'] ?? $content['title']) ?></span>
                            <span style="color: var(--color-primary); font-weight: 700;">Pemutar Video Aman Anak</span>
                        </div>
                        <div class="detail-video-container">
                            <iframe 
                                id="activeVideoPlayer" 
                                class="detail-video-iframe" 
                                src="https://www.youtube-nocookie.com/embed/<?= esc($content['video_youtube_id']) ?>?rel=0" 
                                title="<?= esc($content['title']) ?>" 
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                allowfullscreen
                            ></iframe>
                        </div>
                    </div>
                <?php else: ?>
                    <!-- Hero Image Banner (Tipe Artikel) -->
                    <div class="detail-hero-media">
                        <img 
                            src="<?= esc($content['hero_image']) ?>" 
                            alt="<?= esc($content['title']) ?>" 
                            class="detail-hero-img"
                        />
                    </div>
                <?php endif; ?>

                <!-- Judul Konten -->
                <h1 class="detail-title"><?= esc($content['title']) ?></h1>

                <!-- Kategori & Tag Row -->
                <div class="detail-tags-row">
                    <?php foreach ($content['tags'] as $tag): ?>
                        <span class="detail-tag-pill"><?= esc($tag) ?></span>
                    <?php endforeach; ?>
                    <span class="detail-likes-pill">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="#D9383A" stroke="#D9383A"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg>
                        <span id="likesPillCount"><?= esc($content['likes']) ?></span> disukai AyBun
                    </span>
                </div>

                <!-- 2-Column Metadata Card (Sesuai Screenshot) -->
                <div class="metadata-two-col-box">
                    <div class="meta-box-col">
                        <div class="meta-col-label">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2"></rect><line x1="9" y1="9" x2="15" y2="9"></line><line x1="9" y1="13" x2="15" y2="13"></line></svg>
                            <span>Jenis Konten</span>
                        </div>
                        <div class="meta-col-val"><?= esc($content['type_label']) ?></div>
                    </div>
                    <div class="meta-box-col">
                        <div class="meta-col-label">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                            <span>Usia</span>
                        </div>
                        <div class="meta-col-val"><?= esc($content['age_label']) ?></div>
                    </div>
                </div>

                <!-- Kotak Verifikasi Penulis & Dokter (Sesuai Screenshot) -->
                <div class="verified-author-card">
                    <div class="verified-icon-badge" title="Tinjauan Medis Terverifikasi">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="20 6 9 17 4 12"></polyline>
                        </svg>
                    </div>
                    <div class="verified-author-text">
                        Ditulis oleh <strong><?= esc($content['author']) ?></strong><br>
                        Ditinjau oleh <strong><?= esc($content['reviewer']) ?></strong>
                    </div>
                </div>

                <!-- Isi Artikel & Pembahasan -->
                <div class="detail-body-content">
                    <?php if (!empty($content['paragraphs'])): ?>
                        <?php foreach ($content['paragraphs'] as $p): ?>
                            <p><?= $p ?></p>
                        <?php endforeach; ?>
                    <?php endif; ?>

                    <!-- Poin Khusus Tipe Artikel (1-5 Poin Medis Sesuai Screenshot 4) -->
                    <?php if (!empty($content['points'])): ?>
                        <div class="article-points-wrapper">
                            <?php foreach ($content['points'] as $pt): ?>
                                <div class="article-numbered-point">
                                    <div class="point-header">
                                        <?= esc($pt['num']) ?>. <?= esc($pt['title']) ?>
                                    </div>
                                    <div class="point-desc">
                                        <?= $pt['desc'] ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>

                    <!-- Poin Khusus Tipe Video: Daftar Putar Episode (Sesuai Screenshot 3) -->
                    <?php if ($content['type'] === 'video' && !empty($content['episodes'])): ?>
                        <section class="video-episodes-section">
                            <h3 class="episodes-section-header">
                                Daftar Episode Animasi Edukasi:
                            </h3>
                            <div class="episodes-list">
                                <?php foreach ($content['episodes'] as $idx => $ep): ?>
                                    <div 
                                        class="episode-card <?= ($idx === 0) ? 'active' : '' ?>" 
                                        data-ep-num="<?= esc($ep['number']) ?>"
                                        data-ep-title="<?= esc($ep['title']) ?>"
                                        data-video-id="<?= esc($ep['video_id']) ?>"
                                    >
                                        <div class="episode-card-title">
                                            <?= esc($ep['title']) ?>
                                            <span class="action-link">(<?= esc($ep['action_text']) ?>)</span>
                                        </div>
                                        <div class="episode-thumb-wrap">
                                            <img src="<?= esc($ep['thumb']) ?>" alt="<?= esc($ep['title']) ?>" class="episode-thumb-img" />
                                            <div class="episode-play-badge">
                                                <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><polygon points="5 3 19 12 5 21 5 3"></polygon></svg>
                                            </div>
                                        </div>
                                        <p class="episode-desc"><?= esc($ep['desc']) ?></p>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </section>
                    <?php endif; ?>

                    <!-- Kotak Tips & Panduan Medis -->
                    <?php if (!empty($content['tips_box'])): ?>
                        <div class="medical-callout-box">
                            <div class="callout-title">
                                <?= esc($content['tips_box']['title']) ?>
                            </div>
                            <ul class="callout-list">
                                <?php foreach ($content['tips_box']['items'] as $item): ?>
                                    <li><?= esc($item) ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- ══════════════════════════════════════════════════════════
                     SEKSI KOMENTAR
                     ══════════════════════════════════════════════════════════ -->
                <section class="detail-comment-section">
                    <h3 class="comment-section-title">Komentar</h3>

                    <?php if ($isLoggedIn): ?>
                        <!-- Form Masukan Komentar (Hanya Pengguna yang Sudah Login) -->
                        <div class="comment-input-bar">
                            <input 
                                type="text" 
                                id="commentInput" 
                                class="comment-text-input" 
                                placeholder="Tulis komentar AyBun di sini..." 
                                aria-label="Tulis komentar"
                                data-user-name="<?= esc($currentUserName) ?>"
                            />
                            <button type="button" class="btn-send-comment" id="btnSendComment" title="Kirim komentar">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M2.01 21L23 12 2.01 3 2 10l15 2-15 2z"></path>
                                </svg>
                            </button>
                        </div>
                    <?php else: ?>
                        <!-- Notifikasi Tamu: Belum Login Tidak Bisa Kirim Komentar -->
                        <div class="comment-guest-notice">
                            <div class="guest-notice-body">
                                <div class="guest-notice-icon">
                                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="12" cy="7" r="4"></circle>
                                    </svg>
                                </div>
                                <div class="guest-notice-text">
                                    <strong>Ingin ikut berdiskusi?</strong>
                                    <p>Hanya pengguna terdaftar yang dapat menulis komentar. Silakan masuk ke akun AyBun terlebih dahulu.</p>
                                </div>
                            </div>
                            <a href="<?= base_url('login') ?>" class="btn-comment-login">Masuk ke Akun</a>
                        </div>
                    <?php endif; ?>

                    <!-- Daftar Komentar (Bisa Dibaca oleh Semua Pengunjung) -->
                    <div class="comments-list-wrap" id="commentsListWrap">
                        <div class="comment-bubble">
                            <div class="comment-bubble-head">
                                <span class="comment-author-name">Bunda Dian Kartika</span>
                                <span class="comment-time">2 jam yang lalu</span>
                            </div>
                            <div class="comment-bubble-body">
                                Terima kasih banyak panduannya dokter! Sangat membantu kami yang punya balita aktif sering main di luar rumah. Langsung saya simpan ke Konten Tersimpan.
                            </div>
                        </div>

                        <div class="comment-bubble">
                            <div class="comment-bubble-head">
                                <span class="comment-author-name">Ayah Faisal</span>
                                <span class="comment-time">Kemarin</span>
                            </div>
                            <div class="comment-bubble-body">
                                Penjelasannya sangat runut dan mudah dipahami. Tontonan animasinya juga pas banget buat anak usia 3 tahun kami, tidak bikin tantrum saat selesai nonton.
                            </div>
                        </div>
                    </div>
                </section>

            </div>

            <!-- ── KOLOM KANAN / SIDEBAR DESKTOP (PC) ── -->
            <aside class="detail-sidebar">

                <!-- Profil Peninjau Medis -->
                <div class="sidebar-card">
                    <h4 class="sidebar-card-title">Peninjau Medis</h4>
                    <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 10px;">
                        <div style="width: 46px; height: 46px; border-radius: 50%; background: #FFF2EB; border: 1.5px solid var(--color-primary); display: grid; place-items: center; color: var(--color-primary);">
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M4.8 2.3A.3.3 0 1 0 5 2H4a2 2 0 0 0-2 2v5a6 6 0 0 0 6 6v0a6 6 0 0 0 6-6V4a2 2 0 0 0-2-2h-1a.2.2 0 1 0 .3.3"/>
                                <path d="M8 15v1a6 6 0 0 0 6 6v0a6 6 0 0 0 6-6v-4"/>
                                <circle cx="20" cy="10" r="2"/>
                            </svg>
                        </div>
                        <div>
                            <strong style="display: block; font-size: 13.5px; color: var(--color-dark);"><?= esc($content['reviewer']) ?></strong>
                            <small style="color: var(--color-muted); font-size: 11.5px;"><?= esc($content['reviewer_role']) ?></small>
                        </div>
                    </div>
                    <p style="font-size: 12.5px; color: var(--color-muted); line-height: 1.5; margin: 0;">
                        Konten telah diverifikasi sesuai standar pedoman Ikatan Dokter Anak Indonesia (IDAI) & WHO untuk kesehatan dan keselamatan anak.
                    </p>
                </div>



                <!-- Konten Terkait -->
                <div class="sidebar-card">
                    <h4 class="sidebar-card-title">Konten Terkait</h4>
                    <div class="related-list">
                        <?php foreach ($relatedItems as $rel): ?>
                            <a href="<?= base_url('articles/detail/' . $rel['id']) ?>" class="related-row-item">
                                <img src="<?= esc($rel['image']) ?>" alt="<?= esc($rel['title']) ?>" class="related-thumb" />
                                <div class="related-info">
                                    <h5><?= esc($rel['title']) ?></h5>
                                    <small><?= esc($rel['type_lbl']) ?> • <?= esc($rel['category']) ?></small>
                                </div>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>

            </aside>

        </div>

    </div>
</div>

<!-- Toast Feedback -->
<div class="art-toast-container" id="artToastContainer"></div>

<!-- Link Modular JS Detail Konten -->
<script src="<?= base_url('js/article_detail.js') ?>?v=<?= file_exists(FCPATH . 'js/article_detail.js') ? filemtime(FCPATH . 'js/article_detail.js') : time() ?>"></script>

<?= $this->endSection() ?>
