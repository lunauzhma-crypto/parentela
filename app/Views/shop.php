<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<!-- Banner Toko Parentela -->
<section class="shop-hero-section">
    <div class="container">
        <div class="shop-hero-content reveal-on-scroll">
            <span class="shop-pill">Official Store Parentela</span>
            <h1>Toko Perlengkapan & Edukasi Anak</h1>
            <p>Pilihan perlengkapan terbaik, aman, food-grade, dan dirancang khusus mendukung milestone tumbuh kembang buah hati tercinta.</p>
            <div class="shop-trust-badges">
                <span class="trust-badge">100% Aman & BPA-Free</span>
                <span class="trust-badge">Kurasi Dokter & Ahli Anak</span>
                <span class="trust-badge">Pengiriman Cepat & Terjamin</span>
            </div>
        </div>
    </div>
</section>

<!-- Konten Utama Toko -->
<section class="shop-catalog-section">
    <div class="container">
        <!-- Filter Kategori -->
        <div class="shop-filter-bar reveal-on-scroll">
            <button type="button" class="shop-filter-btn active">Semua Produk</button>
            <button type="button" class="shop-filter-btn">Nutrisi & MPASI</button>
            <button type="button" class="shop-filter-btn">Buku & Sensori</button>
            <button type="button" class="shop-filter-btn">Perawatan Kulit</button>
            <button type="button" class="shop-filter-btn">Mainan Edukatif</button>
        </div>

        <!-- Grid Produk -->
        <div class="shop-grid">
            <!-- Produk 1 -->
            <div class="shop-card reveal-on-scroll">
                <div class="shop-card-badge bestseller">Terlaris #1</div>
                <div class="shop-img-box">
                    <img src="<?= base_url('images/products/product-mpasi-set.jpg') ?>" alt="Set Makan MPASI Silikon Premium">
                </div>
                <div class="shop-card-info">
                    <span class="shop-category">Nutrisi & MPASI</span>
                    <h3 class="shop-title">Set Makan MPASI Silikon Food-Grade (BPA-Free)</h3>
                    <div class="shop-rating">
                        <span class="stars">★★★★★</span>
                        <span class="score">5.0</span>
                        <span class="reviews">(380+ terjual)</span>
                    </div>
                    <div class="shop-pricing">
                        <div class="prices">
                            <span class="price-current">Rp 135.000</span>
                            <span class="price-old">Rp 165.000</span>
                        </div>
                        <span class="discount-pill">-18%</span>
                    </div>
                    <button type="button" class="btn-shop-buy">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="9" cy="21" r="1"></circle>
                            <circle cx="20" cy="21" r="1"></circle>
                            <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                        </svg>
                        Beli Sekarang
                    </button>
                </div>
            </div>

            <!-- Produk 2 -->
            <div class="shop-card reveal-on-scroll reveal-delay-1">
                <div class="shop-card-badge toprated">Top Rated</div>
                <div class="shop-img-box">
                    <img src="<?= base_url('images/products/product-sensory-book.jpg') ?>" alt="Buku Cerita Sensori Kain Interaktif">
                </div>
                <div class="shop-card-info">
                    <span class="shop-category">Buku & Sensori</span>
                    <h3 class="shop-title">Buku Sensori & Kain Interaktif Touch & Feel</h3>
                    <div class="shop-rating">
                        <span class="stars">★★★★★</span>
                        <span class="score">4.9</span>
                        <span class="reviews">(140+ terjual)</span>
                    </div>
                    <div class="shop-pricing">
                        <div class="prices">
                            <span class="price-current">Rp 89.000</span>
                            <span class="price-old">Rp 115.000</span>
                        </div>
                        <span class="discount-pill">-22%</span>
                    </div>
                    <button type="button" class="btn-shop-buy">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="9" cy="21" r="1"></circle>
                            <circle cx="20" cy="21" r="1"></circle>
                            <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                        </svg>
                        Beli Sekarang
                    </button>
                </div>
            </div>

            <!-- Produk 3 -->
            <div class="shop-card reveal-on-scroll reveal-delay-2">
                <div class="shop-card-badge favorite">Favorit Bunda</div>
                <div class="shop-img-box">
                    <img src="<?= base_url('images/products/product-baby-balm.jpg') ?>" alt="Organic Calming Baby Balm">
                </div>
                <div class="shop-card-info">
                    <span class="shop-category">Perawatan Kulit</span>
                    <h3 class="shop-title">Organic Calming Baby Balm (Kulit Sensitif)</h3>
                    <div class="shop-rating">
                        <span class="stars">★★★★★</span>
                        <span class="score">4.9</span>
                        <span class="reviews">(220+ terjual)</span>
                    </div>
                    <div class="shop-pricing">
                        <div class="prices">
                            <span class="price-current">Rp 95.000</span>
                            <span class="price-old">Rp 110.000</span>
                        </div>
                        <span class="discount-pill">-14%</span>
                    </div>
                    <button type="button" class="btn-shop-buy">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="9" cy="21" r="1"></circle>
                            <circle cx="20" cy="21" r="1"></circle>
                            <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                        </svg>
                        Beli Sekarang
                    </button>
                </div>
            </div>

            <!-- Produk 4 -->
            <div class="shop-card reveal-on-scroll reveal-delay-3">
                <div class="shop-card-badge edukatif">Edukasi Montessori</div>
                <div class="shop-img-box">
                    <img src="<?= base_url('images/products/product-wooden-toy.jpg') ?>" alt="Montessori Wooden Sorting Blocks">
                </div>
                <div class="shop-card-info">
                    <span class="shop-category">Mainan Edukatif</span>
                    <h3 class="shop-title">Montessori Wooden Sorting & Counting Blocks</h3>
                    <div class="shop-rating">
                        <span class="stars">★★★★★</span>
                        <span class="score">4.8</span>
                        <span class="reviews">(195+ terjual)</span>
                    </div>
                    <div class="shop-pricing">
                        <div class="prices">
                            <span class="price-current">Rp 129.000</span>
                            <span class="price-old">Rp 150.000</span>
                        </div>
                        <span class="discount-pill">-14%</span>
                    </div>
                    <button type="button" class="btn-shop-buy">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="9" cy="21" r="1"></circle>
                            <circle cx="20" cy="21" r="1"></circle>
                            <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                        </svg>
                        Beli Sekarang
                    </button>
                </div>
            </div>
        </div>

        <!-- Bantuan & Konsultasi Toko -->
        <div class="shop-help-banner reveal-on-scroll">
            <div class="shop-help-content">
                <h3>Butuh Rekomendasi Produk Sesuai Usia Si Kecil?</h3>
                <p>Tim konsultan tumbuh kembang Parentela siap membantu Ayah & Bunda memilih perlengkapan yang paling tepat.</p>
            </div>
            <a href="<?= base_url('contact') ?>" class="btn-shop-contact">Konsultasi Gratis</a>
        </div>
    </div>
</section>

<?= $this->endSection() ?>
