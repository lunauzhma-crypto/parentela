<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Pink Instagram Style Home</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: Arial, Helvetica, sans-serif;
    }

    body {
      background: linear-gradient(to bottom, #fff7fb, #ffeaf4);
      color: #222;
    }

    a {
      text-decoration: none;
      color: inherit;
    }

    .navbar {
      width: 100%;
      background: rgba(255, 255, 255, 0.85);
      backdrop-filter: blur(10px);
      border-bottom: 1px solid #f3c9da;
      position: sticky;
      top: 0;
      z-index: 999;
    }

    .nav-container {
      max-width: 1200px;
      margin: auto;
      padding: 16px 24px;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .logo {
      font-size: 28px;
      font-weight: bold;
      color: #e1306c;
      letter-spacing: -1px;
    }

    .nav-links {
      display: flex;
      gap: 28px;
      font-size: 15px;
      color: #666;
    }

    .nav-links a:hover {
      color: #e1306c;
    }

    .nav-btn {
      background: linear-gradient(135deg, #ff7eb6, #ff4f9a);
      color: white;
      padding: 10px 18px;
      border-radius: 999px;
      font-weight: bold;
      font-size: 14px;
      transition: 0.3s;
    }

    .nav-btn:hover {
      transform: scale(1.05);
    }

    .hero {
      max-width: 1200px;
      margin: auto;
      padding: 70px 24px 40px;
      display: grid;
      grid-template-columns: 1.1fr 1fr;
      gap: 40px;
      align-items: center;
    }

    .hero-text h1 {
      font-size: 58px;
      line-height: 1.05;
      margin-bottom: 20px;
      color: #c2185b;
    }

    .hero-text p {
      font-size: 18px;
      color: #666;
      margin-bottom: 28px;
      max-width: 540px;
    }

    .hero-buttons {
      display: flex;
      gap: 14px;
      flex-wrap: wrap;
    }

    .btn-primary {
      background: linear-gradient(135deg, #ff69a6, #e1306c);
      color: white;
      padding: 14px 24px;
      border-radius: 999px;
      font-weight: bold;
      font-size: 15px;
      display: inline-block;
    }

    .btn-secondary {
      background: white;
      border: 1px solid #f3bfd3;
      color: #d63384;
      padding: 14px 24px;
      border-radius: 999px;
      font-weight: bold;
      font-size: 15px;
      display: inline-block;
    }

    .phone-mockup {
      background: linear-gradient(145deg, #fff, #ffe3ef);
      border: 1px solid #f4c6d8;
      border-radius: 32px;
      padding: 18px;
      max-width: 340px;
      margin: auto;
      box-shadow: 0 20px 40px rgba(225, 48, 108, 0.12);
    }

    .phone-screen {
      background: #fff;
      border-radius: 24px;
      overflow: hidden;
      border: 1px solid #f7d7e4;
    }

    .phone-top {
      padding: 14px 16px;
      border-bottom: 1px solid #f6dce7;
      display: flex;
      justify-content: space-between;
      align-items: center;
      font-weight: bold;
      color: #d63384;
    }

    .story-bar {
      display: flex;
      gap: 12px;
      padding: 14px;
      overflow: hidden;
      border-bottom: 1px solid #f6dce7;
    }

    .story {
      text-align: center;
      font-size: 11px;
      color: #666;
    }

    .story-circle {
      width: 52px;
      height: 52px;
      border-radius: 50%;
      background: linear-gradient(135deg, #ff8cc6, #ff4d94);
      padding: 3px;
      margin-bottom: 6px;
    }

    .story-inner {
      width: 100%;
      height: 100%;
      background: #fff0f6;
      border-radius: 50%;
    }

    .post {
      padding: 14px;
    }

    .post-head {
      display: flex;
      align-items: center;
      gap: 10px;
      margin-bottom: 12px;
    }

    .avatar {
      width: 38px;
      height: 38px;
      border-radius: 50%;
      background: linear-gradient(135deg, #ff8fbf, #e1306c);
    }

    .post-user {
      font-size: 14px;
      font-weight: bold;
      color: #333;
    }

    .post-img {
      width: 100%;
      height: 260px;
      border-radius: 18px;
      background: linear-gradient(135deg, #ffd1e6, #ff9ec4, #ffc2d9);
      margin-bottom: 12px;
    }

    .post-actions {
      display: flex;
      gap: 14px;
      font-size: 18px;
      color: #d63384;
      margin-bottom: 10px;
    }

    .post-caption {
      font-size: 13px;
      color: #555;
      line-height: 1.5;
    }

    .features {
      max-width: 1200px;
      margin: auto;
      padding: 40px 24px 90px;
    }

    .features-title {
      text-align: center;
      margin-bottom: 34px;
    }

    .features-title h2 {
      font-size: 38px;
      color: #c2185b;
      margin-bottom: 10px;
    }

    .features-title p {
      color: #777;
      font-size: 17px;
    }

    .feature-grid {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 24px;
    }

    .card {
      background: rgba(255, 255, 255, 0.75);
      border: 1px solid #f6c9da;
      border-radius: 24px;
      padding: 28px;
      box-shadow: 0 10px 25px rgba(255, 105, 180, 0.07);
      transition: 0.3s;
    }

    .card:hover {
      transform: translateY(-6px);
    }

    .card-icon {
      width: 54px;
      height: 54px;
      border-radius: 16px;
      background: linear-gradient(135deg, #ff98c8, #ff5ca2);
      display: flex;
      align-items: center;
      justify-content: center;
      color: white;
      font-size: 22px;
      margin-bottom: 18px;
    }

    .card h3 {
      margin-bottom: 10px;
      color: #c2185b;
      font-size: 20px;
    }

    .card p {
      color: #666;
      font-size: 15px;
      line-height: 1.6;
    }

    .cta {
      max-width: 1000px;
      margin: 0 auto 90px;
      padding: 0 24px;
    }

    .cta-box {
      background: linear-gradient(135deg, #ff9fc9, #ff72ad);
      border-radius: 30px;
      padding: 55px 30px;
      text-align: center;
      color: white;
      box-shadow: 0 18px 35px rgba(225, 48, 108, 0.18);
    }

    .cta-box h2 {
      font-size: 38px;
      margin-bottom: 14px;
    }

    .cta-box p {
      font-size: 17px;
      max-width: 650px;
      margin: 0 auto 24px;
      opacity: 0.95;
    }

    .cta-box a {
      background: white;
      color: #d63384;
      padding: 14px 24px;
      border-radius: 999px;
      font-weight: bold;
      display: inline-block;
    }

    footer {
      text-align: center;
      padding: 28px 20px;
      border-top: 1px solid #f5cada;
      color: #777;
      font-size: 14px;
      background: rgba(255,255,255,0.5);
    }

    @media (max-width: 950px) {
      .hero,
      .feature-grid {
        grid-template-columns: 1fr;
      }

      .hero-text {
        text-align: center;
      }

      .hero-text p {
        margin-left: auto;
        margin-right: auto;
      }

      .hero-buttons {
        justify-content: center;
      }

      .nav-links {
        display: none;
      }
    }

    @media (max-width: 600px) {
      .hero-text h1 {
        font-size: 40px;
      }

      .features-title h2,
      .cta-box h2 {
        font-size: 28px;
      }

      .phone-mockup {
        max-width: 100%;
      }

      .nav-container {
        padding: 14px 18px;
      }
    }
  </style>
</head>
<body>

  <nav class="navbar">
    <div class="nav-container">
      <div class="logo">PinkGram</div>

      <div class="nav-links">
        <a href="#">Beranda</a>
        <a href="#">Eksplor</a>
        <a href="#">Reels</a>
        <a href="#">Pesan</a>
      </div>

      <a href="#" class="nav-btn">Login</a>
    </div>
  </nav>

  <section class="hero">
    <div class="hero-text">
      <h1>Bagikan momenmu dengan nuansa pink yang manis.</h1>
      <p>
        Halaman beranda bergaya Instagram dengan sentuhan warna pink, tampilan modern,
        soft, dan aesthetic. Cocok untuk landing page media sosial, portfolio, atau project pribadi.
      </p>

      <div class="hero-buttons">
        <a href="#" class="btn-primary">Mulai Sekarang</a>
        <a href="#" class="btn-secondary">Lihat Preview</a>
      </div>
    </div>

    <div class="phone-mockup">
      <div class="phone-screen">
        <div class="phone-top">
          <span>PinkGram</span>
          <span>♡ ✦</span>
        </div>

        <div class="story-bar">
          <div class="story">
            <div class="story-circle"><div class="story-inner"></div></div>
            You
          </div>
          <div class="story">
            <div class="story-circle"><div class="story-inner"></div></div>
            Aira
          </div>
          <div class="story">
            <div class="story-circle"><div class="story-inner"></div></div>
            Naya
          </div>
          <div class="story">
            <div class="story-circle"><div class="story-inner"></div></div>
            Caca
          </div>
        </div>

        <div class="post">
          <div class="post-head">
            <div class="avatar"></div>
            <div class="post-user">pink.mood</div>
          </div>

          <div class="post-img"></div>

          <div class="post-actions">
            <span>♡</span>
            <span>💬</span>
            <span>✦</span>
          </div>

          <div class="post-caption">
            <strong>pink.mood</strong> A soft day, a sweet feed, and a little sparkle everywhere.
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="features">
    <div class="features-title">
      <h2>Semua yang kamu suka dalam satu tampilan</h2>
      <p>Simple, cute, modern, dan tetap clean seperti landing page masa kini.</p>
    </div>

    <div class="feature-grid">
      <div class="card">
        <div class="card-icon">♡</div>
        <h3>Feed Aesthetic</h3>
        <p>Tampilan lembut dengan dominasi pink yang cocok untuk brand personal atau project bertema feminin.</p>
      </div>

      <div class="card">
        <div class="card-icon">📷</div>
        <h3>Style Social Media</h3>
        <p>Terinspirasi dari nuansa Instagram dengan mockup story, post, dan layout yang familiar.</p>
      </div>

      <div class="card">
        <div class="card-icon">✨</div>
        <h3>Clean & Modern</h3>
        <p>Meski playful, tampilannya tetap rapi dan enak dilihat untuk homepage atau landing page.</p>
      </div>
    </div>
  </section>

  <section class="cta">
    <div class="cta-box">
      <h2>Bikin halamanmu lebih hidup.</h2>
      <p>
        Gunakan desain beranda dengan inspirasi Instagram dan warna pink untuk menampilkan
        suasana yang manis, segar, dan menarik perhatian.
      </p>
      <a href="#">Coba Desain Ini</a>
    </div>
  </section>

  <footer>
    © 2026 PinkGram Landing Page
  </footer>

</body>
</html>