<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<!-- Catalog Header & Breadcrumbs -->
<section class="catalog-head-section">
    <div class="container">
        <div class="catalog-breadcrumbs">
            <a href="<?= base_url('/') ?>">Beranda</a> &bull;
            <a href="<?= base_url('perpustakaan') ?>">Perpustakaan</a> &bull;
            <span>Katalog Lengkap</span>
        </div>
        <div class="section-head-title">
            <h1>📚 Katalog Buku Anak & Koleksi Digital</h1>
            <p>Jelajahi seluruh koleksi buku anak klasik, fabel, buku bergambar, dan audio dongeng</p>
        </div>
    </div>
</section>

<div class="container" style="padding-bottom: 70px;">
    <!-- Advanced Filter Bar -->
    <div class="catalog-filter-card">
        <form method="get" action="<?= base_url('perpustakaan/katalog') ?>">
            <div class="filter-grid-layout">
                <!-- Search Input -->
                <div class="filter-field">
                    <label>Kata Kunci / Judul / Penulis</label>
                    <input type="text" name="q" value="<?= esc($filters['q'] ?? '') ?>" placeholder="Ketik kata kunci pencarian...">
                </div>

                <!-- Age Filter -->
                <div class="filter-field">
                    <label>Kelompok Usia</label>
                    <select name="age">
                        <option value="">Semua Usia (0 - 12 Tahun)</option>
                        <option value="2" <?= ($filters['age'] ?? '') == '2' ? 'selected' : '' ?>>0 - 2 Tahun (Bayi/Balita)</option>
                        <option value="4" <?= ($filters['age'] ?? '') == '4' ? 'selected' : '' ?>>3 - 5 Tahun (Prasekolah)</option>
                        <option value="7" <?= ($filters['age'] ?? '') == '7' ? 'selected' : '' ?>>6 - 8 Tahun (Pemula)</option>
                        <option value="10" <?= ($filters['age'] ?? '') == '10' ? 'selected' : '' ?>>9 - 12 Tahun (Mandiri)</option>
                    </select>
                </div>

                <!-- Category Filter -->
                <div class="filter-field">
                    <label>Kategori</label>
                    <select name="category">
                        <option value="">Semua Kategori Anak</option>
                        <option value="Cerita Anak" <?= ($filters['category'] ?? '') == 'Cerita Anak' ? 'selected' : '' ?>>Cerita Anak & Fantasi</option>
                        <option value="Dongeng" <?= ($filters['category'] ?? '') == 'Dongeng' ? 'selected' : '' ?>>Dongeng & Fabel</option>
                        <option value="Edukasi" <?= ($filters['category'] ?? '') == 'Edukasi' ? 'selected' : '' ?>>Edukasi & Sains Cilik</option>
                        <option value="Tumbuh Kembang" <?= ($filters['category'] ?? '') == 'Tumbuh Kembang' ? 'selected' : '' ?>>Karakter & Tumbuh Kembang</option>
                        <option value="Buku Bergambar" <?= ($filters['category'] ?? '') == 'Buku Bergambar' ? 'selected' : '' ?>>Buku Bergambar</option>
                        <option value="Aktivitas Anak" <?= ($filters['category'] ?? '') == 'Aktivitas Anak' ? 'selected' : '' ?>>Aktivitas & Kreativitas</option>
                    </select>
                </div>

                <!-- Reading Level -->
                <div class="filter-field">
                    <label>Tingkat Membaca</label>
                    <select name="reading_level">
                        <option value="">Semua Tingkat</option>
                        <option value="Beginner" <?= ($filters['reading_level'] ?? '') == 'Beginner' ? 'selected' : '' ?>>Pemula (Beginner)</option>
                        <option value="Intermediate" <?= ($filters['reading_level'] ?? '') == 'Intermediate' ? 'selected' : '' ?>>Menengah (Intermediate)</option>
                        <option value="Advanced" <?= ($filters['reading_level'] ?? '') == 'Advanced' ? 'selected' : '' ?>>Mahir (Advanced)</option>
                    </select>
                </div>

                <!-- Sorting -->
                <div class="filter-field">
                    <label>Urutkan</label>
                    <select name="sort">
                        <option value="">Judul (A - Z)</option>
                        <option value="popular" <?= ($filters['sort'] ?? '') == 'popular' ? 'selected' : '' ?>>Paling Populer</option>
                        <option value="rating" <?= ($filters['sort'] ?? '') == 'rating' ? 'selected' : '' ?>>Rating Tertinggi</option>
                        <option value="newest" <?= ($filters['sort'] ?? '') == 'newest' ? 'selected' : '' ?>>Terbaru</option>
                    </select>
                </div>

                <!-- Submit & Reset -->
                <div class="filter-actions-col">
                    <button type="submit" class="btn-filter-submit">Terapkan Filter</button>
                    <?php if (!empty($filters)): ?>
                        <a href="<?= base_url('perpustakaan/katalog') ?>" class="btn-filter-reset">Reset</a>
                    <?php endif; ?>
                </div>
            </div>
        </form>
    </div>

    <!-- Status Bar & Active Filters -->
    <div class="catalog-status-bar">
        <div>
            Menampilkan <strong><?= count($books) ?></strong> buku
            <?php if (!empty($filters['q'])): ?>
                untuk kata kunci "<strong><?= esc($filters['q']) ?></strong>"
            <?php endif; ?>
        </div>

        <?php if (!empty($filters)): ?>
            <div class="active-filter-chips">
                <?php if (!empty($filters['category'])): ?>
                    <span class="filter-chip">📂 <?= esc($filters['category']) ?></span>
                <?php endif; ?>
                <?php if (!empty($filters['age'])): ?>
                    <span class="filter-chip">👶 Usia <?= esc($filters['age']) ?> th</span>
                <?php endif; ?>
                <?php if (!empty($filters['reading_level'])): ?>
                    <span class="filter-chip">📖 <?= esc($filters['reading_level']) ?></span>
                <?php endif; ?>
                <?php if (!empty($filters['sort'])): ?>
                    <span class="filter-chip">⚡ <?= esc(ucfirst($filters['sort'])) ?></span>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>

    <!-- Results Grid -->
    <?php if (!empty($books)): ?>
        <div class="lib-book-grid">
            <?php foreach ($books as $book): ?>
                <?= view('library/_book_card', ['book' => $book]) ?>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <div class="catalog-empty-state">
            <div class="empty-icon">🔍</div>
            <h3>Buku Tidak Ditemukan</h3>
            <p>Maaf, kami tidak menemukan buku yang cocok dengan kriteria filter atau kata kunci yang Anda masukkan.</p>
            <a href="<?= base_url('perpustakaan/katalog') ?>" class="btn-filter-submit" style="display:inline-block; text-decoration:none;">Tampilkan Semua Koleksi</a>
        </div>
    <?php endif; ?>
</div>

<?= $this->endSection() ?>