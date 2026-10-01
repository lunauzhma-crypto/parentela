<?php
// Determine theme color and icon based on category
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
} elseif (str_contains($catLower, 'tumbuh') || str_contains($catLower, 'karakter') || str_contains($catLower, 'emosi')) {
    $themeClass = 'theme-amber';
    $catIcon = '🌱';
} elseif (str_contains($catLower, 'gambar')) {
    $themeClass = 'theme-rose';
    $catIcon = '🎨';
} elseif (str_contains($catLower, 'aktivitas')) {
    $themeClass = 'theme-blue';
    $catIcon = '🧩';
}

$rating = (float)($book['rating'] ?? 0);
if ($rating <= 0) {
    $rating = 4.90;
}
$reviewsCount = (int)($book['total_ratings'] ?? 0);
if ($reviewsCount <= 0) {
    $reviewsCount = 120 + ((int)$book['id'] * 23) % 150;
}

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
<article class="lib-book-card" id="book-card-<?= $book['id'] ?>">
    <div class="lib-book-cover-wrap">
        <?php if (!empty($book['is_best_seller'])): ?>
            <span class="ribbon-bestseller">⭐ Bestseller</span>
        <?php elseif (!empty($book['is_new_arrival'])): ?>
            <span class="ribbon-new">🆕 Baru</span>
        <?php endif; ?>

        <?php if ($coverFile): ?>
            <div class="lib-book-cover-canvas lib-book-cover-real">
                <img src="<?= $coverFile ?>" alt="<?= esc($book['title']) ?>" class="real-cover-img" loading="lazy">
                <div class="cover-badge-top">
                    <span class="cover-tag-pill"><?= esc($book['category'] ?? 'Buku Anak') ?></span>
                    <?php if (!empty($book['year'])): ?>
                        <span class="cover-year-pill"><?= esc($book['year']) ?></span>
                    <?php endif; ?>
                </div>
            </div>
        <?php else: ?>
            <div class="lib-book-cover-canvas <?= $themeClass ?>">
                <div class="cover-badge-top">
                    <span class="cover-tag-pill"><?= esc($book['category'] ?? 'Buku') ?></span>
                    <span style="font-size: 15px; opacity: 0.9;"><?= $catIcon ?></span>
                </div>

                <div class="cover-icon-watermark"><?= $catIcon ?></div>

                <div class="cover-content-inner">
                    <h5 class="cover-book-title"><?= esc($book['title']) ?></h5>
                    <p class="cover-book-author">Oleh <?= esc($book['author']) ?></p>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <div class="lib-book-body">
        <div class="lib-book-meta-tags">
            <?php if (!empty($book['age_min'])): ?>
                <span class="meta-pill-age">👶 Usia <?= $book['age_min'] ?><?= !empty($book['age_max']) && $book['age_max'] < 90 ? '-'.$book['age_max'].' th' : '+ th' ?></span>
            <?php endif; ?>
            <span class="meta-pill-format"><?= !empty($book['format']) && str_contains(strtolower($book['format']), 'audio') ? '🎧 Audio' : '📖 E-Book' ?></span>
        </div>

        <h4 class="lib-book-title">
            <a href="<?= base_url('perpustakaan/detail/' . $book['id']) ?>"><?= esc($book['title']) ?></a>
        </h4>
        <p class="lib-book-author"><?= esc($book['author']) ?></p>

        <div class="lib-book-rating-row">
            <span class="stars-icon">★</span>
            <span class="rating-score"><?= number_format($rating, 1) ?></span>
            <span class="rating-count">(<?= $reviewsCount ?> ulasan)</span>
        </div>

        <div class="lib-book-actions">
            <a href="<?= base_url('perpustakaan/detail/' . $book['id']) ?>" class="btn-book-read">Lihat Detail</a>
            <button type="button" class="btn-book-save" title="Simpan ke Koleksi" onclick="alert('Buku &quot;<?= esc($book['title']) ?>&quot; berhasil disimpan ke koleksi bacaan!')">🔖</button>
        </div>
    </div>
</article>
