<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<!-- Header / Breadcrumb Minimalis -->
<div style="background: #FFF9F6; padding: 25px 0; border-bottom: 1px solid #F5EAE5; margin-bottom: 30px;">
    <div class="container" style="max-width: 1100px; margin: 0 auto;">
        <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 15px;">
            <a href="<?= base_url('pendidikan') ?>" style="color: #9C3D26; font-weight: 600; text-decoration: none; display: flex; align-items: center; gap: 5px;">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5"/><path d="M12 19l-7-7 7-7"/></svg>
                Kembali ke Menu Pendidikan
            </a>
        </div>
        <h1 class="edu-hero-title" style="font-size: 32px; text-align: left; margin: 0;">
            <?= ($activeCategory === 'formal') ? 'Pendidikan Formal' : 'Pendidikan Nonformal (PAUD & Preschool)' ?>
        </h1>
        <p style="color: #475569; margin-top: 10px;">
            <?= ($activeCategory === 'formal') ? 'Daftar sekolah TK, SD, SMP, dan SMA/SMK terverifikasi di Surabaya.' : 'Daftar lembaga PAUD, Kelompok Bermain (KB), dan Preschool.' ?>
        </p>
    </div>
</div>

<!-- Container Konten Pendidikan -->
<div class="container" style="padding-bottom: 70px; max-width: 1100px; margin: 0 auto;">
    <!-- ========================================================
         BAGIAN KONTEN 1: JALUR FORMAL (TK, SD, SMP, SMA/SMK)
         ======================================================== -->
    <div id="sectionFormal" style="display: <?= ($activeCategory === 'formal') ? 'block' : 'none' ?>;">
        
        <div class="edu-filter-header-wrap">
            <div>
                <div class="edu-filter-kategori-indicator">Jalur Pendidikan Formal Terpilih</div>
                <h2 class="edu-section-heading">Pilih Jenjang Sekolah di Surabaya</h2>
            </div>
            <div class="edu-items-count" id="countFormal">
                Menampilkan <strong style="color: #db8a74;"><?= count($sekolahFormal) ?></strong> Sekolah Terverifikasi
            </div>
        </div>

        <!-- Input Pencarian Nama Sekolah -->
        <div class="edu-search-box-wrap" style="margin-bottom: 20px;">
            <div style="position: relative; width: 100%;">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#94A3B8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="position: absolute; left: 16px; top: 50%; transform: translateY(-50%); pointer-events: none;">
                    <circle cx="11" cy="11" r="8"></circle>
                    <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                </svg>
                <input type="text" id="eduSchoolSearch" placeholder="Cari nama sekolah, lokasi, atau kurikulum (misal: Al-Irsyad)..." oninput="applySchoolFilters()" style="width: 100%; padding: 14px 20px 14px 48px; border-radius: 12px; border: 1.5px solid #E2E8F0; font-size: 15px; outline: none; transition: all 0.2s ease; background: #FFFFFF; box-shadow: 0 2px 8px rgba(0,0,0,0.02);">
            </div>
        </div>

        <!-- Tombol Filter Jenjang (TK, SD, SMP, SMA/SMK) -->
        <div class="edu-subfilter-tabs">
            <button type="button" class="edu-subfilter-btn <?= ($activeSub === 'semua' || empty($activeSub)) ? 'active' : '' ?>" onclick="filterFormalLevel('semua')">
                ✨ Semua Jenjang
            </button>
            <button type="button" class="edu-subfilter-btn <?= ($activeSub === 'tk') ? 'active' : '' ?>" onclick="filterFormalLevel('tk')">
                🎒 TK / PAUD
            </button>
            <button type="button" class="edu-subfilter-btn <?= ($activeSub === 'sd') ? 'active' : '' ?>" onclick="filterFormalLevel('sd')">
                📚 SD / MI
            </button>
            <button type="button" class="edu-subfilter-btn <?= ($activeSub === 'smp') ? 'active' : '' ?>" onclick="filterFormalLevel('smp')">
                🏫 SMP / MTs
            </button>
            <button type="button" class="edu-subfilter-btn <?= ($activeSub === 'sma' || $activeSub === 'smk') ? 'active' : '' ?>" onclick="filterFormalLevel('sma')">
                🎓 SMA / SMK
            </button>
        </div>

        <!-- Daftar Sekolah Formal -->
        <div class="edu-cards-list">
            <?php if (!empty($sekolahFormal)): ?>
                <?php foreach ($sekolahFormal as $sekolah): ?>
                    <div class="edu-item-card formal-item" data-jenjang="<?= esc($sekolah['jenjang']) ?>">
                        <div class="edu-item-img-wrap">
                            <img src="<?= esc($sekolah['image']) ?>" alt="<?= esc($sekolah['nama']) ?>" loading="lazy" onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1580582932707-520aed937b7b?q=80&w=600&auto=format&fit=crop';">
                            <span class="edu-item-level-badge"><?= esc($sekolah['jenjang_label']) ?></span>
                        </div>
                        <div class="edu-item-content">
                            <div style="display: flex; justify-content: space-between; align-items: flex-start; gap: 10px; flex-wrap: wrap;">
                                <h3 class="edu-item-title"><?= esc($sekolah['nama']) ?></h3>
                                <span class="edu-item-akreditasi-badge">⭐ <?= esc($sekolah['akreditasi']) ?></span>
                            </div>
                            <p class="edu-item-location"><?= esc($sekolah['lokasi']) ?></p>
                            <div class="edu-item-kurikulum-pill">
                                <strong>Kurikulum:</strong> <?= esc($sekolah['kurikulum']) ?>
                            </div>
                            <p class="edu-item-desc"><?= esc($sekolah['deskripsi']) ?></p>
                            
                            <!-- Fasilitas Unggulan Sekolah -->
                            <div class="edu-item-fasilitas-grid">
                                <?php foreach ($sekolah['fasilitas'] as $fas): ?>
                                    <div class="edu-item-fasilitas-item">
                                        <span style="color: #db8a74; font-size: 14px;">✓</span>
                                        <span><?= esc($fas) ?></span>
                                    </div>
                                <?php endforeach; ?>
                            </div>

                            <div class="edu-item-footer">
                                <a href="<?= esc($sekolah['kontak']) ?>" target="_blank" rel="noopener noreferrer" class="edu-item-btn-link">
                                    Kunjungi Website Resmi ↗
                                </a>
                                <span style="font-size: 12.5px; color: #888;">
                                    Rujukan Terverifikasi Surabaya
                                </span>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div style="text-align: center; padding: 50px 20px; background: #ffffff; border-radius: 16px; border: 1.5px dashed #cbd5e1; color: #64748b; width: 100%;">
                    <div style="font-size: 40px; margin-bottom: 12px;">🏫</div>
                    <h3 style="font-size: 18px; font-weight: 700; color: #334155; margin-bottom: 6px;">Belum Ada Data Sekolah Formal</h3>
                    <p style="font-size: 14px; margin: 0; color: #64748b;">Data sekolah formal dapat dikelola dan ditambahkan melalui Portal Administrator.</p>
                </div>
            <?php endif; ?>
        </div>

    </div>

    <!-- ========================================================
         BAGIAN KONTEN 2: JALUR NONFORMAL (PAUD & PRESCHOOL)
         ======================================================== -->
    <div id="sectionNonformal" style="display: <?= ($activeCategory === 'nonformal') ? 'block' : 'none' ?>;">
        
        <div class="edu-filter-header-wrap">
            <div>
                <div class="edu-filter-kategori-indicator" style="background: #fdf5f0; color: #a84b4b; border-color: #f7dfd6;">Jalur Pendidikan Nonformal Terpilih</div>
                <h2 class="edu-section-heading">Pilih Kategori PAUD & Preschool</h2>
            </div>
            <div class="edu-items-count" id="countNonformal">
                Menampilkan <strong style="color: #db8a74;"><?= count($lembagaNonformal) ?></strong> Lembaga Terverifikasi
            </div>
        </div>

        <!-- Input Pencarian Lembaga Nonformal -->
        <div class="edu-search-box-wrap" style="margin-bottom: 20px;">
            <div style="position: relative; width: 100%;">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#94A3B8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="position: absolute; left: 16px; top: 50%; transform: translateY(-50%); pointer-events: none;">
                    <circle cx="11" cy="11" r="8"></circle>
                    <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                </svg>
                <input type="text" id="eduNonformalSearch" placeholder="Cari nama lembaga, program, atau lokasi..." oninput="applyNonformalFilters()" style="width: 100%; padding: 14px 20px 14px 48px; border-radius: 12px; border: 1.5px solid #E2E8F0; font-size: 15px; outline: none; transition: all 0.2s ease; background: #FFFFFF; box-shadow: 0 2px 8px rgba(0,0,0,0.02);">
            </div>
        </div>

        <!-- Tombol Filter Kategori -->
        <div class="edu-subfilter-tabs">
            <button type="button" class="edu-subfilter-btn active" onclick="filterNonformalCategory('semua')">
                ✨ Semua Kategori
            </button>
            <button type="button" class="edu-subfilter-btn" onclick="filterNonformalCategory('preschool')">
                🧩 Preschool
            </button>
            <button type="button" class="edu-subfilter-btn" onclick="filterNonformalCategory('paud')">
                🧸 PAUD
            </button>
            <button type="button" class="edu-subfilter-btn" onclick="filterNonformalCategory('kelompok-bermain')">
                🎠 Kelompok Bermain
            </button>
            <button type="button" class="edu-subfilter-btn" onclick="filterNonformalCategory('bimbel')">
                📚 Bimbel &amp; Les
            </button>
            <button type="button" class="edu-subfilter-btn" onclick="filterNonformalCategory('sanggar')">
                🎨 Sanggar &amp; Kursus
            </button>
        </div>

        <!-- Daftar Lembaga Nonformal -->
        <div class="edu-cards-list">
            <?php foreach ($lembagaNonformal as $kursus): ?>
                <div class="edu-item-card nonformal-item" data-kategori="<?= esc($kursus['kategori']) ?>">
                    <div class="edu-item-img-wrap">
                        <img src="<?= esc($kursus['image']) ?>" alt="<?= esc($kursus['nama']) ?>" loading="lazy" onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1516627145497-ae6968895b74?q=80&w=600&auto=format&fit=crop';">
                        <span class="edu-item-level-badge" style="background: rgba(168, 75, 75, 0.85);"><?= esc($kursus['rentang_usia']) ?></span>
                    </div>
                    <div class="edu-item-content">
                        <div style="display: flex; justify-content: space-between; align-items: flex-start; gap: 10px; flex-wrap: wrap;">
                            <h3 class="edu-item-title"><?= esc($kursus['nama']) ?></h3>
                            <span class="edu-item-kategori-badge"><?= esc($kursus['kategori_label']) ?></span>
                        </div>
                        <p class="edu-item-location"><?= esc($kursus['lokasi']) ?></p>
                        <div class="edu-item-kurikulum-pill" style="background: #fff8f5; border-color: #fae4dc;">
                            <strong>Program Unggulan:</strong> <?= esc($kursus['program_fokus']) ?>
                        </div>
                        <p class="edu-item-desc"><?= esc($kursus['deskripsi']) ?></p>
                        
                        <!-- Fasilitas Kursus -->
                        <div class="edu-item-fasilitas-grid">
                            <?php foreach ($kursus['fasilitas'] as $fas): ?>
                                <div class="edu-item-fasilitas-item">
                                    <span style="color: #db8a74; font-size: 14px;">✓</span>
                                    <span><?= esc($fas) ?></span>
                                </div>
                            <?php endforeach; ?>
                        </div>

                        <div class="edu-item-footer">
                            <a href="<?= esc($kursus['kontak']) ?>" target="_blank" rel="noopener noreferrer" class="edu-item-btn-link" style="background: linear-gradient(135deg, #db8a74 0%, #c46d57 100%);">
                                Informasi & Pendaftaran ↗
                            </a>
                            <span style="font-size: 12.5px; color: #888;">
                                Kursus Minat Bakat Surabaya
                            </span>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

    </div>

</div>

<style>
/* ========================================================
   Gaya Halaman Direktori Pendidikan Anak (Modern & Editorial)
   ======================================================== */
.edu-hero-header {
    background-color: #fcf6f4;
    padding: 55px 20px 45px 20px;
    border-bottom: 1px solid #f2deda;
    margin-bottom: 40px;
}
.edu-badge-top {
    display: inline-block;
    background: #fbf0ec;
    color: #a84b4b;
    border: 1px solid #f7dfd6;
    font-size: 11.5px;
    font-weight: 700;
    letter-spacing: 0.8px;
    padding: 6px 14px;
    border-radius: 20px;
    margin-bottom: 14px;
}
.edu-hero-title {
    font-family: 'Playfair Display', serif;
    color: #a84b4b;
    font-size: 42px;
    font-weight: 700;
    margin: 0 0 15px 0;
    line-height: 1.25;
}
.edu-hero-desc {
    color: #555;
    font-size: 16px;
    line-height: 1.7;
    margin: 0 auto;
}

/* Dua Kartu Opsi Utama (Formal & Nonformal) */
.edu-two-cards-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 28px;
    margin-bottom: 45px;
}

.edu-choice-card {
    background: #ffffff;
    border-radius: 24px;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
    border: 2.5px solid #f4e2db;
    cursor: pointer;
    transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
    position: relative;
    display: flex;
    flex-direction: column;
    outline: none;
}
.edu-choice-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 16px 40px rgba(219, 138, 116, 0.22);
    border-color: #db8a74;
}
.edu-choice-card.is-active {
    border-color: #db8a74;
    box-shadow: 0 14px 38px rgba(219, 138, 116, 0.25);
    background: #ffffff;
}

.edu-choice-img-wrap {
    position: relative;
    width: 100%;
    height: 200px;
    overflow: hidden;
    background: #f0e9e6;
}
.edu-choice-img-wrap img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
    transition: transform 0.5s ease;
}
.edu-choice-card:hover .edu-choice-img-wrap img {
    transform: scale(1.06);
}
.edu-choice-img-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(to top, rgba(20, 10, 10, 0.75) 0%, rgba(20, 10, 10, 0.15) 60%, transparent 100%);
}
.edu-choice-tag {
    position: absolute;
    bottom: 14px;
    left: 16px;
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(4px);
    color: #a84b4b;
    font-size: 12px;
    font-weight: 700;
    padding: 4px 12px;
    border-radius: 20px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
}
.edu-choice-selected-badge {
    position: absolute;
    top: 14px;
    right: 16px;
    background: #db8a74;
    color: #ffffff;
    font-size: 11.5px;
    font-weight: 700;
    padding: 5px 14px;
    border-radius: 20px;
    box-shadow: 0 4px 12px rgba(219, 138, 116, 0.4);
    letter-spacing: 0.3px;
}

.edu-choice-body {
    padding: 24px;
    display: flex;
    flex-direction: column;
    flex: 1;
}
.edu-choice-title {
    font-family: 'Playfair Display', serif;
    color: #a84b4b;
    font-size: 26px;
    font-weight: 700;
    margin: 0 0 10px 0;
}
.edu-choice-text {
    color: #555;
    font-size: 14px;
    line-height: 1.6;
    margin: 0 0 16px 0;
    flex: 1;
}
.edu-choice-subpills {
    display: flex;
    gap: 8px;
    flex-wrap: wrap;
    margin-bottom: 20px;
}
.subpill {
    background: #fbf5f2;
    color: #777;
    font-size: 11.5px;
    font-weight: 600;
    padding: 4px 10px;
    border-radius: 12px;
    border: 1px solid #f4e2db;
}

.edu-choice-action-btn {
    text-align: center;
    padding: 12px;
    border-radius: 14px;
    font-weight: 700;
    font-size: 14px;
    background: #fdf5f2;
    color: #db8a74;
    border: 1.5px solid #fae1d7;
    transition: all 0.25s ease;
}
.edu-choice-action-btn.btn-active,
.edu-choice-card.is-active .edu-choice-action-btn {
    background: #db8a74;
    color: #ffffff;
    border-color: #db8a74;
    box-shadow: 0 4px 14px rgba(219, 138, 116, 0.3);
}

/* Header Filter Jenjang */
.edu-filter-header-wrap {
    display: flex;
    justify-content: space-between;
    align-items: flex-end;
    margin-bottom: 18px;
    flex-wrap: wrap;
    gap: 12px;
    border-bottom: 2px solid #fcf2ee;
    padding-bottom: 14px;
}
.edu-filter-kategori-indicator {
    display: inline-block;
    background: #fdf2ee;
    color: #db8a74;
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.8px;
    padding: 4px 10px;
    border-radius: 20px;
    margin-bottom: 6px;
    border: 1px solid #fae3dc;
}
.edu-section-heading {
    font-family: 'Playfair Display', serif;
    color: #a84b4b;
    font-size: 26px;
    font-weight: 700;
    margin: 0;
}
.edu-items-count {
    font-size: 13.5px;
    color: #666;
    background: #faf5f3;
    padding: 6px 14px;
    border-radius: 12px;
    border: 1px solid #f5e4dd;
}

/* Sub-filter Tabs */
.edu-subfilter-tabs {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
    margin-bottom: 30px;
}
.edu-subfilter-btn {
    background: #ffffff;
    color: #a84b4b;
    border: 1.5px solid #f2d4cb;
    padding: 9px 20px;
    border-radius: 20px;
    font-size: 13.5px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.22s ease;
}
.edu-subfilter-btn:hover {
    background: #fdf5f2;
    border-color: #db8a74;
    color: #db8a74;
}
.edu-subfilter-btn.active {
    background: #db8a74;
    color: #ffffff;
    border-color: #db8a74;
    box-shadow: 0 4px 12px rgba(219, 138, 116, 0.3);
}

/* Daftar Kartu Sekolah / Lembaga */
.edu-cards-list {
    display: flex;
    flex-direction: column;
    gap: 24px;
}
.edu-item-card {
    background: #ffffff;
    border-radius: 20px;
    padding: 24px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.04);
    display: flex;
    gap: 26px;
    align-items: center;
    border: 1px solid #f9e3db;
    transition: transform 0.25s ease, box-shadow 0.25s ease, border-color 0.25s ease;
}
.edu-item-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 14px 34px rgba(219, 138, 116, 0.16);
    border-color: #db8a74;
}
.edu-item-img-wrap {
    width: 270px;
    height: 180px;
    flex-shrink: 0;
    overflow: hidden;
    border-radius: 16px;
    background: #eee;
    position: relative;
}
.edu-item-img-wrap img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
    transition: transform 0.4s ease;
}
.edu-item-card:hover .edu-item-img-wrap img {
    transform: scale(1.06);
}
.edu-item-level-badge {
    position: absolute;
    top: 10px;
    left: 10px;
    background: rgba(20, 15, 15, 0.72);
    backdrop-filter: blur(4px);
    color: #ffffff;
    font-size: 11px;
    font-weight: 700;
    padding: 4px 10px;
    border-radius: 8px;
}

.edu-item-content {
    flex: 1;
    min-width: 0;
}
.edu-item-title {
    font-family: 'Playfair Display', serif;
    color: #333;
    font-size: 22px;
    font-weight: 700;
    margin: 0;
}
.edu-item-akreditasi-badge {
    background: #eef8f2;
    color: #15803d;
    font-size: 11.5px;
    font-weight: 700;
    padding: 4px 12px;
    border-radius: 14px;
    border: 1px solid #bbf7d0;
    white-space: nowrap;
}
.edu-item-kategori-badge {
    background: #fdf2ee;
    color: #db8a74;
    font-size: 11.5px;
    font-weight: 700;
    padding: 4px 12px;
    border-radius: 14px;
    border: 1px solid #fae1d7;
    white-space: nowrap;
}
.edu-item-location {
    color: #666;
    font-size: 13.5px;
    margin: 6px 0 10px 0;
}
.edu-item-kurikulum-pill {
    background: #faf6f5;
    border: 1px solid #f4ded7;
    color: #555;
    font-size: 13px;
    padding: 6px 12px;
    border-radius: 10px;
    margin-bottom: 12px;
    display: inline-block;
}
.edu-item-desc {
    color: #555;
    font-size: 14px;
    line-height: 1.6;
    margin: 0 0 14px 0;
}
.edu-item-fasilitas-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 8px 16px;
    margin-bottom: 16px;
    background: #fdfcfb;
    padding: 10px 14px;
    border-radius: 10px;
    border: 1px dashed #f2ded8;
}
.edu-item-fasilitas-item {
    font-size: 12.5px;
    color: #666;
    display: flex;
    align-items: center;
    gap: 6px;
}
.edu-item-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 12px;
    margin-top: 10px;
}
.edu-item-btn-link {
    background: #db8a74;
    color: #ffffff;
    padding: 9px 18px;
    border-radius: 10px;
    text-decoration: none;
    font-weight: 600;
    font-size: 13px;
    display: inline-block;
    box-shadow: 0 4px 12px rgba(219, 138, 116, 0.25);
    transition: all 0.2s ease;
}
.edu-item-btn-link:hover {
    background: #c46d57;
    color: #ffffff;
    transform: translateY(-2px);
    box-shadow: 0 6px 16px rgba(219, 138, 116, 0.35);
}

@media (max-width: 900px) {
    .edu-two-cards-grid {
        grid-template-columns: 1fr;
        gap: 20px;
    }
    .edu-item-card {
        flex-direction: column;
        align-items: stretch;
    }
    .edu-item-img-wrap {
        width: 100%;
        height: 200px;
    }
    .edu-hero-title {
        font-size: 32px;
    }
    .edu-item-fasilitas-grid {
        grid-template-columns: 1fr;
    }
}
</style>

<script>
let currentFormalLevel = 'semua';
let currentNonformalCategory = 'semua';

// Filter Sub-Jenjang Sekolah Formal (TK, SD, SMP, SMA/SMK)
function filterFormalLevel(level) {
    currentFormalLevel = level;
    const tabs = document.querySelectorAll('#sectionFormal .edu-subfilter-btn');
    tabs.forEach(btn => {
        btn.classList.remove('active');
        if (btn.getAttribute('onclick').includes(`'${level}'`)) {
            btn.classList.add('active');
        }
    });
    applySchoolFilters();
}

function applySchoolFilters() {
    const searchVal = (document.getElementById('eduSchoolSearch')?.value || '').toLowerCase().trim();
    const items = document.querySelectorAll('.formal-item');
    let visibleCount = 0;

    items.forEach(item => {
        const itemLevel = item.getAttribute('data-jenjang');
        const textContent = item.textContent.toLowerCase();

        const matchesLevel = (currentFormalLevel === 'semua' || itemLevel === currentFormalLevel);
        const matchesSearch = (searchVal === '' || textContent.includes(searchVal));

        if (matchesLevel && matchesSearch) {
            item.style.display = 'flex';
            visibleCount++;
        } else {
            item.style.display = 'none';
        }
    });

    const counter = document.getElementById('countFormal');
    if (counter) {
        counter.innerHTML = `Menampilkan <strong style="color: #db8a74;">${visibleCount}</strong> Sekolah Terverifikasi`;
    }
}

// Filter Sub-Kategori Lembaga Nonformal / Kursus
function filterNonformalCategory(kategori) {
    currentNonformalCategory = kategori;
    const tabs = document.querySelectorAll('#sectionNonformal .edu-subfilter-btn');
    tabs.forEach(btn => {
        btn.classList.remove('active');
        if (btn.getAttribute('onclick').includes(`'${kategori}'`)) {
            btn.classList.add('active');
        }
    });
    applyNonformalFilters();
}

function applyNonformalFilters() {
    const searchVal = (document.getElementById('eduNonformalSearch')?.value || '').toLowerCase().trim();
    const items = document.querySelectorAll('.nonformal-item');
    let visibleCount = 0;

    items.forEach(item => {
        const itemKat = item.getAttribute('data-kategori');
        const textContent = item.textContent.toLowerCase();

        const matchesKat = (currentNonformalCategory === 'semua' || itemKat === currentNonformalCategory);
        const matchesSearch = (searchVal === '' || textContent.includes(searchVal));

        if (matchesKat && matchesSearch) {
            item.style.display = 'flex';
            visibleCount++;
        } else {
            item.style.display = 'none';
        }
    });

    const counter = document.getElementById('countNonformal');
    if (counter) {
        counter.innerHTML = `Menampilkan <strong style="color: #db8a74;">${visibleCount}</strong> Lembaga Kursus Terverifikasi`;
    }
}

// Inisialisasi filter sub-jenjang berdasarkan parameter aktif saat load
document.addEventListener('DOMContentLoaded', function() {
    const initSub = '<?= esc($activeSub) ?>';
    const initCat = '<?= esc($activeCategory) ?>';

    if (initCat === 'formal' && initSub !== 'semua' && initSub !== '') {
        filterFormalLevel(initSub);
    } else if (initCat === 'nonformal' && initSub !== 'semua' && initSub !== '') {
        filterNonformalCategory(initSub);
    }
});
</script>

<?= $this->endSection() ?>
