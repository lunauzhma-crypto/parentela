<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<?php
$catLower = strtolower($book['category'] ?? '');
$themeClass = 'theme-red';
$catIcon = '📖';

if (str_contains($catLower, 'cerita')) {
    $themeClass = 'theme-orange';
    $catIcon = '📚';
} elseif (str_contains($catLower, 'dongeng')) {
    $themeClass = 'theme-purple';
    $catIcon = '🦊';
} elseif (str_contains($catLower, 'edukasi') || str_contains($catLower, 'sains')) {
    $themeClass = 'theme-teal';
    $catIcon = '🔬';
} elseif (str_contains($catLower, 'tumbuh') || str_contains($catLower, 'emosi')) {
    $themeClass = 'theme-amber';
    $catIcon = '🌱';
} elseif (str_contains($catLower, 'parent')) {
    $themeClass = 'theme-red';
    $catIcon = '👨‍👩‍👧';
} elseif (str_contains($catLower, 'gambar')) {
    $themeClass = 'theme-rose';
    $catIcon = '🎨';
} elseif (str_contains($catLower, 'aktivitas')) {
    $themeClass = 'theme-blue';
    $catIcon = '🧩';
}

$rating = (float)($book['rating'] ?? 0);
if ($rating <= 0) $rating = 4.9;
$totalRatings = (int)($book['total_ratings'] ?? 0);
if ($totalRatings <= 0) $totalRatings = 142;

$coverImg = !empty($book['cover']) ? $book['cover'] : '';
$coverFile = '';
if ($coverImg) {
    if (file_exists(FCPATH . 'images/books/' . $coverImg)) {
        $coverFile = base_url('images/books/' . $coverImg);
    } elseif (file_exists(FCPATH . 'images/' . $coverImg)) {
        $coverFile = base_url('images/' . $coverImg);
    } elseif (str_starts_with($coverImg, 'http')) {
        $coverFile = $coverImg;
    }
}
?>

<!-- Breadcrumbs Header -->
<section class="catalog-head-section">
    <div class="container">
        <div class="catalog-breadcrumbs">
            <a href="<?= base_url('/') ?>">Beranda</a> &bull;
            <a href="<?= base_url('perpustakaan') ?>">Perpustakaan</a> &bull;
            <a href="<?= base_url('perpustakaan/katalog?category=' . urlencode($book['category'] ?? '')) ?>"><?= esc($book['category'] ?? 'Kategori') ?></a> &bull;
            <span><?= esc($book['title']) ?></span>
        </div>
    </div>
</section>

<div class="container" style="padding-bottom: 70px;">
    <div class="book-detail-wrapper">
        <!-- Left: 3D Book Cover Canvas -->
        <div class="detail-cover-box">
            <?php if ($coverFile): ?>
                <div class="detail-canvas-cover detail-real-cover">
                    <img src="<?= $coverFile ?>" alt="<?= esc($book['title']) ?>" class="detail-cover-img">
                </div>
            <?php else: ?>
                <div class="detail-canvas-cover <?= $themeClass ?>">
                    <div class="cover-badge-top">
                        <span class="cover-tag-pill"><?= esc($book['category'] ?? 'Buku') ?></span>
                        <span style="font-size: 20px; opacity: 0.9;"><?= $catIcon ?></span>
                    </div>

                    <div class="cover-icon-watermark" style="font-size: 80px;"><?= $catIcon ?></div>

                    <div class="cover-content-inner">
                        <h2 class="cover-book-title" style="font-size: 20px; line-height: 1.35;"><?= esc($book['title']) ?></h2>
                        <p class="cover-book-author" style="font-size: 13px;">Karya <?= esc($book['author']) ?></p>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <!-- Right: Book Info & Details -->
        <div class="detail-info-col">
            <div class="lib-book-meta-tags" style="margin-bottom: 12px;">
                <span class="meta-pill-age">👶 Target Usia: <?= $book['age_min'] ?? '0' ?><?= !empty($book['age_max']) && $book['age_max'] < 90 ? ' - ' . $book['age_max'] . ' Tahun' : '+ Tahun' ?></span>
                <span class="meta-pill-format"><?= !empty($book['format']) && strtolower($book['format']) == 'audiobook' ? '🎧 Audio Story' : '📖 E-Book Digital' ?></span>
                <?php if (!empty($book['reading_level'])): ?>
                    <span class="meta-pill-format" style="background:#EEF5FF; color:#2563EB;">Level: <?= esc($book['reading_level']) ?></span>
                <?php endif; ?>
            </div>

            <h1><?= esc($book['title']) ?></h1>

            <div class="detail-author-row">
                <span>Ditulis oleh: <strong><?= esc($book['author']) ?></strong></span>
                <?php if (!empty($book['illustrator'])): ?>
                    &bull; <span>Ilustrator: <strong><?= esc($book['illustrator']) ?></strong></span>
                <?php endif; ?>
            </div>

            <div class="detail-rating-pill">
                <span class="stars-icon" style="font-size: 16px;">★★★★★</span>
                <strong style="color:var(--color-dark);"><?= number_format($rating, 2) ?></strong>
                <span style="color:var(--color-muted);">dari <?= $totalRatings ?> ulasan orang tua</span>
            </div>

            <!-- Specs Grid -->
            <div class="detail-specs-grid">
                <div class="spec-cell">
                    <span>Penerbit</span>
                    <strong><?= esc($book['publisher'] ?? 'Parentela Publishing') ?></strong>
                </div>
                <div class="spec-cell">
                    <span>Bahasa</span>
                    <strong><?= esc($book['language'] ?? 'Bahasa Indonesia') ?></strong>
                </div>
                <div class="spec-cell">
                    <span>Halaman / Durasi</span>
                    <strong><?= !empty($book['pages']) ? $book['pages'] . ' Halaman' : '32 Halaman' ?></strong>
                </div>
                <div class="spec-cell">
                    <span>Format</span>
                    <strong><?= esc($book['format'] ?? 'E-book Digital') ?></strong>
                </div>
            </div>

            <!-- Synopsis -->
            <div class="detail-synopsis">
                <h3>Sinopsis & Nilai Edukasi</h3>
                <p><?= nl2br(esc($book['synopsis'])) ?></p>
            </div>

            <!-- CTA Actions -->
            <div class="detail-cta-row">
                <a href="javascript:void(0)" onclick="alert('Membuka reader buku digital Parentela... Selamat membaca bersama si kecil!')" class="btn-detail-primary">
                    <span>📖 Mulai Membaca Sekarang</span>
                </a>
                <button type="button" class="btn-detail-secondary" onclick="alert('Buku berhasil disimpan ke koleksi bacaan Anda!')">
                    <span>🔖 Simpan ke Koleksi</span>
                </button>
                <button type="button" class="btn-detail-secondary" onclick="navigator.clipboard ? navigator.clipboard.writeText(window.location.href).then(()=>alert('Tautan buku berhasil disalin!')) : alert('Tautan disalin!')">
                    <span>🔗 Bagikan</span>
                </button>
            </div>
        </div>
    </div>

    <!-- Related Books -->
    <?php if (!empty($related_books)): ?>
        <div style="margin-top: 50px;">
            <div class="section-head-flex">
                <div class="section-head-title">
                    <h2><span>📚</span> Buku Terkait dalam Kategori Ini</h2>
                    <p>Rekomendasi bacaan lain yang serupa untuk memperkaya wawasan si kecil</p>
                </div>
                <a href="<?= base_url('perpustakaan/katalog?category=' . urlencode($book['category'] ?? '')) ?>" class="btn-view-all">Lihat Kategori Ini →</a>
            </div>

            <div class="lib-book-grid">
                <?php foreach ($related_books as $rel): ?>
                    <?= view('library/_book_card', ['book' => $rel]) ?>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>
</div>

<?= $this->endSection() ?>