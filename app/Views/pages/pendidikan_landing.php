<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<style>
@import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');

.edu-landing-wrapper {
    background: linear-gradient(180deg, #FFFAF7 0%, #FFF5EF 60%, #FFF9F6 100%);
    min-height: 80vh;
}

.edu-landing-hero {
    background: linear-gradient(135deg, #FFF3EE 0%, #FDEBD9 50%, #FFF3EE 100%);
    padding: 56px 24px 48px;
    text-align: center;
    border-bottom: 1px solid rgba(226,125,72,0.12);
    position: relative;
    overflow: hidden;
}

.edu-landing-hero::before {
    content: '';
    position: absolute;
    top: -60px; right: -80px;
    width: 280px; height: 280px;
    background: radial-gradient(circle, rgba(226,125,72,0.08) 0%, transparent 70%);
    border-radius: 50%;
    pointer-events: none;
}

.edu-badge {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: #FFF0E8;
    border: 1.5px solid #F3C4AA;
    padding: 7px 20px;
    border-radius: 999px;
    font-size: 12.5px;
    font-weight: 700;
    color: #9C3D26;
    letter-spacing: 0.5px;
    margin-bottom: 22px;
    position: relative;
    z-index: 1;
}

.edu-landing-title {
    font-family: 'Playfair Display', Georgia, serif;
    font-size: clamp(30px, 5vw, 50px);
    font-weight: 700;
    color: #1F2937;
    line-height: 1.2;
    margin: 0 0 16px;
    position: relative;
    z-index: 1;
}

.edu-landing-title .highlight {
    color: #C85A32;
}

.edu-landing-desc {
    font-size: 16px;
    color: #52525B;
    line-height: 1.7;
    max-width: 620px;
    margin: 0 auto;
    position: relative;
    z-index: 1;
}

.edu-cards-section {
    padding: 56px 24px 80px;
    max-width: 1080px;
    margin: 0 auto;
}

.edu-cards-label {
    text-align: center;
    font-size: 12px;
    font-weight: 700;
    color: #9CA3AF;
    letter-spacing: 2.5px;
    text-transform: uppercase;
    margin-bottom: 32px;
}

.edu-two-cards {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 28px;
}

.edu-jalur-card {
    background: #FFFFFF;
    border-radius: 28px;
    overflow: hidden;
    border: 2px solid transparent;
    box-shadow: 0 8px 32px rgba(188,79,79,0.08), 0 2px 8px rgba(0,0,0,0.04);
    transition: all 0.35s cubic-bezier(0.34, 1.56, 0.64, 1);
    text-decoration: none;
    display: block;
    cursor: pointer;
    position: relative;
}

.edu-jalur-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 24px 52px rgba(188,79,79,0.18), 0 4px 16px rgba(0,0,0,0.06);
    border-color: #E27D48;
}

.edu-jalur-img {
    position: relative;
    height: 240px;
    overflow: hidden;
}

.edu-jalur-img img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
}

.edu-jalur-card:hover .edu-jalur-img img {
    transform: scale(1.06);
}

.edu-jalur-img-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(to bottom, rgba(0,0,0,0.04) 0%, rgba(0,0,0,0.52) 100%);
}

.edu-jalur-tag {
    position: absolute;
    top: 16px;
    left: 16px;
    background: rgba(255,255,255,0.93);
    backdrop-filter: blur(8px);
    color: #9C3D26;
    font-size: 12px;
    font-weight: 700;
    padding: 5px 14px;
    border-radius: 999px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

.edu-jalur-badge-sub {
    position: absolute;
    bottom: 14px;
    right: 14px;
    background: rgba(255,255,255,0.92);
    color: #9C3D26;
    font-size: 10.5px;
    font-weight: 700;
    padding: 4px 10px;
    border-radius: 999px;
    box-shadow: 0 2px 6px rgba(0,0,0,0.12);
}

.edu-jalur-body {
    padding: 26px 28px 30px;
}

.edu-jalur-title {
    font-family: 'Playfair Display', Georgia, serif;
    font-size: 25px;
    font-weight: 700;
    color: #C85A32;
    margin: 0 0 10px;
}

.edu-jalur-desc {
    font-size: 14px;
    color: #52525B;
    line-height: 1.65;
    margin: 0 0 20px;
}

.edu-jalur-pills {
    display: flex;
    flex-wrap: wrap;
    gap: 7px;
    margin-bottom: 24px;
}

.edu-jalur-pill {
    background: #FFF3EE;
    color: #9C3D26;
    font-size: 12px;
    font-weight: 600;
    padding: 4px 12px;
    border-radius: 999px;
    border: 1px solid #F3C4AA;
}

.edu-jalur-cta {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    padding: 14px 24px;
    border-radius: 14px;
    font-size: 14.5px;
    font-weight: 700;
    transition: all 0.25s ease;
    width: 100%;
    text-align: center;
}

.card-formal .edu-jalur-cta {
    background: linear-gradient(135deg, #BC4F4F, #9C3D26);
    color: #FFFFFF;
    box-shadow: 0 4px 14px rgba(188,79,79,0.35);
}

.card-nonformal .edu-jalur-cta {
    background: #FFF0E8;
    color: #C85A32;
    border: 1.5px solid #F3C4AA;
}

.edu-jalur-card:hover .edu-jalur-cta svg {
    transform: translateX(4px);
}

.edu-jalur-cta svg {
    flex-shrink: 0;
    transition: transform 0.2s ease;
}

.card-nonformal:hover .edu-jalur-cta {
    background: linear-gradient(135deg, #E27D48, #C85A32);
    color: #FFFFFF;
    border-color: transparent;
    box-shadow: 0 4px 14px rgba(226,125,72,0.35);
}

.edu-info-strip {
    background: #FFF3EE;
    border-top: 1px solid rgba(226,125,72,0.15);
    padding: 28px 24px;
    text-align: center;
}

.edu-info-strip p {
    color: #64748B;
    font-size: 14px;
    margin: 0;
}

.edu-info-strip a {
    color: #C85A32;
    font-weight: 600;
    text-decoration: none;
}

@media (max-width: 680px) {
    .edu-two-cards { grid-template-columns: 1fr; }
    .edu-jalur-img { height: 200px; }
}
</style>

<div class="edu-landing-wrapper">

    <div class="edu-landing-hero">
        <span class="edu-badge">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/></svg>
            Direktori Pendidikan Anak
        </span>
        <h1 class="edu-landing-title">
            Pilih Jalur Pendidikan<br>
            Terbaik untuk <span class="highlight">Buah Hati</span>
        </h1>
        <p class="edu-landing-desc">
            Temukan sekolah formal terakreditasi dan lembaga pendidikan anak usia dini (PAUD/Preschool) terpercaya untuk mendampingi tumbuh kembang si kecil di Kota Surabaya.
        </p>
    </div>

    <div class="edu-cards-section">
        <p class="edu-cards-label">Pilih jalur yang sesuai</p>

        <div class="edu-two-cards">

            <a href="<?= base_url('pendidikan/formal') ?>" class="edu-jalur-card card-formal">
                <div class="edu-jalur-img">
                    <img src="<?= base_url('images/education/pendidikan-formal.jpg') ?>"
                         alt="Siswa Pendidikan Formal"
                         onerror="this.src='https://images.unsplash.com/photo-1577896851231-70ef18881754?q=80&w=800&auto=format&fit=crop'">
                    <div class="edu-jalur-img-overlay"></div>
                    <span class="edu-jalur-tag">Jalur Sekolah Resmi</span>
                    <span class="edu-jalur-badge-sub">TK &middot; SD &middot; SMP &middot; SMA</span>
                </div>
                <div class="edu-jalur-body">
                    <h2 class="edu-jalur-title">Pendidikan Formal</h2>
                    <p class="edu-jalur-desc">
                        Jalur sekolah terstruktur berjenjang resmi, berakreditasi nasional — dari usia dini hingga jenjang menengah atas di Surabaya.
                    </p>
                    <div class="edu-jalur-pills">
                        <span class="edu-jalur-pill">TK / PAUD</span>
                        <span class="edu-jalur-pill">SD / MI</span>
                        <span class="edu-jalur-pill">SMP / MTs</span>
                        <span class="edu-jalur-pill">SMA / SMK</span>
                        <span class="edu-jalur-pill">SLB</span>
                    </div>
                    <div style="display: flex; align-items: center; justify-content: space-between; margin-top: 12px;">
                        <span style="font-size: 13px; color: #64748b;"><?= $totalFormal ?? 0 ?> Lembaga Terdaftar</span>
                        <div class="edu-jalur-cta">
                            <span>Lihat Sekolah Formal</span>
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                        </div>
                    </div>
                </div>
            </a>

            <a href="<?= base_url('pendidikan/nonformal') ?>" class="edu-jalur-card card-nonformal">
                <div class="edu-jalur-img">
                    <img src="<?= base_url('images/education/pendidikan-nonformal.jpg') ?>"
                         alt="Pendidikan Anak Usia Dini"
                         onerror="this.src='https://images.unsplash.com/photo-1503676260728-1c00da094a0b?q=80&w=800&auto=format&fit=crop'">
                    <div class="edu-jalur-img-overlay"></div>
                    <span class="edu-jalur-tag">PAUD &amp; Preschool</span>
                    <span class="edu-jalur-badge-sub">Bermain &middot; Belajar &middot; Bersosialisasi</span>
                </div>
                <div class="edu-jalur-body">
                    <h2 class="edu-jalur-title">Pendidikan Nonformal</h2>
                    <p class="edu-jalur-desc">
                        Kelompok Bermain (KB), Pendidikan Anak Usia Dini (PAUD), Preschool, Bimbingan Belajar, dan Sanggar Keterampilan — untuk stimulasi motorik dan sosial anak.
                    </p>
                    <div class="edu-jalur-pills">
                        <span class="edu-jalur-pill">Preschool</span>
                        <span class="edu-jalur-pill">PAUD</span>
                        <span class="edu-jalur-pill">Kelompok Bermain</span>
                        <span class="edu-jalur-pill">Bimbel &amp; Les</span>
                        <span class="edu-jalur-pill">Sanggar &amp; Kursus</span>
                    </div>
                    <div style="display: flex; align-items: center; justify-content: space-between; margin-top: 12px;">
                        <span style="font-size: 13px; color: #64748b;"><?= $totalNonformal ?? 0 ?> Lembaga Terdaftar</span>
                        <div class="edu-jalur-cta">
                            <span>Lihat Daftar Lembaga</span>
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                        </div>
                    </div>
                </div>
            </a>

        </div>
    </div>

    <div class="edu-info-strip">
        <p>Data direktori dikelola oleh Tim Parentela melalui Portal Administrator. Ingin mendaftarkan lembaga Anda? <a href="<?= base_url('contact') ?>">Hubungi kami.</a></p>
    </div>

</div>

<?= $this->endSection() ?>
