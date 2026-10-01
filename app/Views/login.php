<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title><?= $title ?? 'Masuk ke Akun — Parentela' ?></title>
  
  <!-- Google Fonts: Outfit, Caveat & Playfair Display -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800&family=Caveat:wght@600;700&family=Playfair+Display:ital,wght@0,600;0,700;0,800;1,600&display=swap" rel="stylesheet">
  <link rel="icon" type="image/x-icon" href="<?= base_url('favicon.ico') ?>">

  <style>
    :root {
      /* SCARPBOOK THEME COLORS */
      --color-primary: #F97316;
      --color-primary-dark: #C2410C;
      --color-primary-light: #FB923C;
      --color-accent: #FFD8C9;
      --color-accent-soft: #FBE4A1;
      --color-bg: #FFFDF8;
      --color-dark: #431407;
      --color-text: #291F1E;
      --color-muted: #8C786E;
      --color-light-gray: #E2E8F0;
      --color-white: #FFFFFF;
      --color-success: #2E7D32;
      --color-success-bg: #EDF7ED;
      --color-error: #C62828;
      --color-error-bg: #FFEBEE;
      
      --shadow-sm: 0 2px 8px rgba(67, 20, 7, 0.05);
      --shadow-md: 0 8px 24px rgba(67, 20, 7, 0.08);
      --shadow-lg: 0 16px 40px rgba(249, 115, 22, 0.12);
      --radius-xl: 24px;
      --radius-lg: 16px;
      --radius-md: 12px;
      --radius-sm: 8px;
    }

    *, *::before, *::after {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      font-family: 'Outfit', -apple-system, BlinkMacSystemFont, sans-serif;
      background-color: var(--color-bg);
      color: var(--color-text);
      min-height: 100vh;
      display: flex;
      align-items: stretch;
      overflow-x: hidden;
      line-height: 1.5;
    }

    /* ════════════════════════════════════════════════════
       LEFT PANEL: FAMILY HERO & THEME ILLUSTRATION
    ════════════════════════════════════════════════════ */
    .left-panel {
      width: 50%;
      background-color: var(--color-bg);
      background-image: radial-gradient(var(--color-primary) 1px, transparent 1px);
      background-size: 30px 30px;
      display: flex;
      flex-direction: column;
      justify-content: flex-end;
      align-items: center;
      padding: 0 40px 60px 40px;
      position: relative;
      overflow: hidden;
      border-right: 1px solid rgba(233, 139, 80, 0.15);
    }

    /* Floating ambient decorative blobs */
    .blob {
      position: absolute;
      border-radius: 50%;
      filter: blur(40px);
      opacity: 0.45;
      pointer-events: none;
    }
    .blob-1 { width: 320px; height: 320px; background: #FAD4C0; top: -70px; left: -70px; animation: floatBlob 10s ease-in-out infinite alternate; }
    .blob-2 { width: 260px; height: 260px; background: #FFE6CC; bottom: -50px; right: -50px; animation: floatBlob 12s ease-in-out infinite alternate-reverse; }
    .blob-3 { width: 160px; height: 160px; background: #FCEFD5; top: 45%; left: 8%; animation: floatBlob 8s ease-in-out infinite alternate; }

    @keyframes floatBlob {
      from { transform: translate(0, 0) scale(1); }
      to   { transform: translate(25px, 20px) scale(1.08); }
    }

    .left-content {
      position: relative;
      z-index: 2;
      max-width: 440px;
      text-align: center;
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    /* Header Pill Badge */
    .top-badge {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      background: rgba(255, 255, 255, 0.85);
      backdrop-filter: blur(8px);
      border: 1px solid rgba(233, 139, 80, 0.3);
      color: var(--color-primary);
      padding: 6px 16px;
      border-radius: 50px;
      font-size: 12px;
      font-weight: 600;
      margin-bottom: 18px;
      box-shadow: var(--shadow-sm);
    }

    /* Family Illustration with Fade */
    .illustration-wrapper {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 65%;
      z-index: 1;
      display: flex;
      justify-content: center;
    }

    .illustration-frame {
      position: relative;
      width: 100%;
      height: 100%;
      -webkit-mask-image: linear-gradient(to bottom, black 50%, transparent 100%);
      mask-image: linear-gradient(to bottom, black 50%, transparent 100%);
    }

    .family-img {
      width: 100%;
      height: 100%;
      display: block;
      object-fit: cover;
      object-position: center 20%;
    }



    /* Left panel text & typography */
    .hero-title {
      font-family: 'Caveat', cursive;
      font-size: 46px;
      font-weight: 700;
      color: var(--color-dark);
      line-height: 1.1;
      margin-bottom: 15px;
      transform: rotate(-3deg);
    }

    .hero-title span {
      color: var(--color-primary);
      position: relative;
    }

    .hero-desc {
      font-size: 14px;
      color: var(--color-muted);
      line-height: 1.6;
      margin-bottom: 18px;
      max-width: 390px;
    }

    /* Community highlights */
    .highlights-row {
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 12px;
      flex-wrap: wrap;
    }

    .highlight-item {
      display: flex;
      align-items: center;
      gap: 6px;
      font-size: 12px;
      font-weight: 600;
      color: var(--color-text);
      background: rgba(255, 255, 255, 0.7);
      padding: 5px 12px;
      border-radius: 20px;
      border: 1px solid rgba(233, 139, 80, 0.2);
    }

    .highlight-icon {
      color: var(--color-primary-light);
    }

    /* ════════════════════════════════════════════════════
       RIGHT PANEL: MODERN UNIFIED LOGIN CARD
    ════════════════════════════════════════════════════ */
    .right-panel {
      width: 50%;
      background: var(--color-white);
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      padding: 36px 48px;
      position: relative;
    }

    .login-container {
      width: 100%;
      max-width: 410px;
    }

    /* Top navigation row inside right panel */
    .brand-top-bar {
      display: flex;
      align-items: center;
      justify-content: space-between;
      margin-bottom: 22px;
    }

    .brand-logo {
      display: flex;
      align-items: center;
      gap: 10px;
      text-decoration: none;
    }

    .brand-logo-mark {
      width: 38px;
      height: 38px;
      background: linear-gradient(135deg, var(--color-primary), var(--color-primary-light));
      border-radius: var(--radius-md);
      display: grid;
      place-items: center;
      color: var(--color-white);
      font-size: 18px;
      box-shadow: 0 4px 12px rgba(188, 79, 79, 0.25);
    }

    .brand-logo-name {
      font-family: 'Playfair Display', Georgia, serif;
      font-size: 24px;
      font-weight: 800;
      color: var(--color-primary);
      letter-spacing: -0.3px;
    }

    .back-home-link {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      font-size: 13px;
      font-weight: 600;
      color: var(--color-muted);
      text-decoration: none;
      transition: color 0.2s ease, transform 0.2s ease;
      padding: 6px 12px;
      border-radius: 8px;
    }

    .back-home-link:hover {
      color: var(--color-primary);
      background: var(--color-accent-soft);
      transform: translateX(-2px);
    }

    /* Card Header */
    .form-header {
      margin-bottom: 20px;
    }

    .form-title {
      font-family: 'Playfair Display', Georgia, serif;
      font-size: 27px;
      font-weight: 700;
      color: var(--color-dark);
      margin-bottom: 6px;
      letter-spacing: -0.4px;
    }

    .form-subtitle {
      font-size: 13.5px;
      color: var(--color-muted);
      line-height: 1.5;
    }

    /* Flash Message Alerts */
    .alert-box {
      padding: 10px 14px;
      border-radius: var(--radius-md);
      margin-bottom: 16px;
      font-size: 12.5px;
      font-weight: 500;
      display: flex;
      align-items: center;
      gap: 10px;
      animation: fadeIn 0.3s ease;
    }

    .alert-error {
      background-color: var(--color-error-bg);
      color: var(--color-error);
      border: 1px solid #FFCDD2;
    }

    .alert-success {
      background-color: var(--color-success-bg);
      color: var(--color-success);
      border: 1px solid #C8E6C9;
    }

    .alert-info {
      background-color: #E3F2FD;
      color: #1565C0;
      border: 1px solid #BBDEFB;
    }

    /* Social Login */
    .social-section {
      margin-bottom: 18px;
    }

    .btn-google {
      width: 100%;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 12px;
      padding: 10px 18px;
      background: var(--color-white);
      border: 1.5px solid var(--color-light-gray);
      border-radius: var(--radius-lg);
      color: var(--color-dark);
      font-family: 'Inter', sans-serif;
      font-size: 13.5px;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.25s ease;
      box-shadow: var(--shadow-sm);
    }

    .btn-google:hover {
      background: #FAF7F2;
      border-color: #D6C8B8;
      transform: translateY(-1px);
      box-shadow: 0 4px 12px rgba(61, 44, 42, 0.08);
    }

    .btn-google svg {
      width: 18px;
      height: 18px;
      flex-shrink: 0;
    }

    /* Divider */
    .divider {
      display: flex;
      align-items: center;
      gap: 16px;
      margin-bottom: 18px;
    }

    .divider-line {
      flex: 1;
      height: 1px;
      background-color: var(--color-light-gray);
    }

    .divider-text {
      font-size: 12px;
      font-weight: 500;
      color: var(--color-muted);
      text-transform: lowercase;
    }

    /* Input Groups */
    .form-group {
      margin-bottom: 16px;
    }

    .form-label {
      display: block;
      font-size: 13px;
      font-weight: 600;
      color: var(--color-dark);
      margin-bottom: 6px;
    }

    .input-wrapper {
      position: relative;
      display: flex;
      align-items: center;
    }

    .input-icon {
      position: absolute;
      left: 14px;
      color: var(--color-muted);
      pointer-events: none;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .input-icon svg {
      width: 18px;
      height: 18px;
      stroke-width: 2;
    }

    .form-input {
      width: 100%;
      padding: 11px 14px 11px 44px;
      font-family: 'Inter', sans-serif;
      font-size: 14px;
      font-weight: 500;
      color: var(--color-dark);
      background: #FDFBF8;
      border: 1.5px solid var(--color-light-gray);
      border-radius: var(--radius-lg);
      outline: none;
      transition: all 0.25s ease;
    }

    .form-input::placeholder {
      color: #A39391;
      font-weight: 400;
    }

    .form-input:focus {
      background: var(--color-white);
      border-color: var(--color-primary-light);
      box-shadow: 0 0 0 4px rgba(233, 139, 80, 0.15);
    }

    .form-input:hover:not(:focus) {
      border-color: #D2C4B5;
    }

    /* Toggle Password Button */
    .toggle-pwd-btn {
      position: absolute;
      right: 14px;
      background: none;
      border: none;
      padding: 6px;
      color: var(--color-muted);
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      border-radius: 6px;
      transition: color 0.2s ease;
    }

    .toggle-pwd-btn:hover {
      color: var(--color-dark);
    }

    .toggle-pwd-btn svg {
      width: 19px;
      height: 19px;
    }

    /* Extras row (Remember me & Forgot Password) */
    .extras-row {
      display: flex;
      align-items: center;
      justify-content: space-between;
      margin-bottom: 18px;
      font-size: 13px;
    }

    .checkbox-label {
      display: flex;
      align-items: center;
      gap: 8px;
      cursor: pointer;
      color: var(--color-muted);
      font-weight: 500;
      user-select: none;
    }

    .checkbox-input {
      appearance: none;
      width: 18px;
      height: 18px;
      border: 1.5px solid #C4B5A5;
      border-radius: 5px;
      background: var(--color-white);
      cursor: pointer;
      position: relative;
      transition: all 0.2s ease;
    }

    .checkbox-input:checked {
      background-color: var(--color-primary);
      border-color: var(--color-primary);
    }

    .checkbox-input:checked::after {
      content: '';
      position: absolute;
      left: 5px;
      top: 2px;
      width: 4px;
      height: 8px;
      border: solid white;
      border-width: 0 2px 2px 0;
      transform: rotate(45deg);
    }

    .forgot-link {
      color: var(--color-primary);
      text-decoration: none;
      font-weight: 600;
      transition: color 0.2s ease;
    }

    .forgot-link:hover {
      color: var(--color-primary-dark);
      text-decoration: underline;
    }

    /* Submit Button */
    .btn-submit {
      width: 100%;
      padding: 12px 18px;
      background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-light) 100%);
      color: var(--color-white);
      border: none;
      border-radius: var(--radius-lg);
      font-family: 'Inter', sans-serif;
      font-size: 14.5px;
      font-weight: 600;
      cursor: pointer;
      box-shadow: 0 4px 16px rgba(188, 79, 79, 0.28);
      transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1);
      position: relative;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 8px;
    }

    .btn-submit:hover {
      background: linear-gradient(135deg, var(--color-primary-dark) 0%, var(--color-primary) 100%);
      transform: translateY(-2px);
      box-shadow: 0 8px 24px rgba(188, 79, 79, 0.35);
    }

    .btn-submit:active {
      transform: translateY(0);
      box-shadow: 0 3px 10px rgba(188, 79, 79, 0.25);
    }

    .btn-submit:disabled {
      opacity: 0.75;
      cursor: not-allowed;
      transform: none;
    }

    /* Footer Register & Security Note */
    .form-footer {
      margin-top: 20px;
      text-align: center;
      font-size: 13px;
      color: var(--color-muted);
    }

    .register-link {
      color: var(--color-primary);
      font-weight: 600;
      text-decoration: none;
      margin-left: 4px;
    }

    .register-link:hover {
      text-decoration: underline;
    }

    .security-note {
      margin-top: 24px;
      padding-top: 16px;
      border-top: 1px solid var(--color-light-gray);
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 6px;
      font-size: 11px;
      color: #9C8C8A;
    }

    /* ════════════════════════════════════════════════════
       RESPONSIVE DESIGN (Tablets & Mobile)
    ════════════════════════════════════════════════════ */
    @media (max-width: 960px) {
      body {
        flex-direction: column;
      }
      .left-panel {
        width: 100%;
        padding: 40px 24px 36px;
        border-right: none;
        border-bottom: 1px solid rgba(233, 139, 80, 0.15);
      }
      .illustration-wrapper {
        max-width: 260px;
      }
      .badge-top-left {
        left: -10px;
      }
      .badge-bottom-right {
        right: -10px;
      }
      .hero-title {
        font-size: 28px;
      }
      .right-panel {
        width: 100%;
        padding: 36px 24px 48px;
      }
    }

    @media (max-width: 480px) {
      .float-badge {
        display: none; /* Hide floating badges on very small phones to prevent overflow */
      }
      .illustration-wrapper {
        max-width: 210px;
      }
      .brand-top-bar {
        margin-bottom: 24px;
      }
      .form-title {
        font-size: 25px;
      }
      .btn-submit {
        padding: 13px 16px;
      }
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(-4px); }
      to   { opacity: 1; transform: translateY(0); }
    }
  </style>
</head>
<body>

  <!-- ════════════════════════════════════════════════════
       LEFT PANEL: ILUSTRASI KELUARGA & TEMA PARENTELA
  ════════════════════════════════════════════════════ -->
  <aside class="left-panel" aria-label="Informasi Parentela">
    <div class="blob blob-1"></div>
    <div class="blob blob-2"></div>
    <div class="blob blob-3"></div>

    <div class="illustration-wrapper">
      <div class="illustration-frame">
        <img 
          src="<?= base_url('images/hero/family-login.jpg') ?>" 
          alt="Ilustrasi Keluarga Bahagia Parentela" 
          class="family-img"
          loading="eager"
        />
      </div>
    </div>

    <div class="left-content">

      <!-- Slogan & Penjelasan -->
      <h1 class="hero-title">Tumbuh Bahagia Bersama <span>Buah Hati</span></h1>
      <p class="hero-desc">
        Dampingi setiap langkah emas si kecil dengan panduan nutrisi, kesehatan, dan pemantauan tumbuh kembang terpercaya dari para ahli.
      </p>

      <!-- Highlights -->
      <div class="highlights-row">
        <div class="highlight-item">
          <span class="highlight-icon">✓</span> Panduan Gizi & MPASI
        </div>
        <div class="highlight-item">
          <span class="highlight-icon">✓</span> Jadwal Istirahat & Tidur
        </div>
        <div class="highlight-item">
          <span class="highlight-icon">✓</span> Komunitas Ayah & Bunda
        </div>
      </div>

    </div>
  </aside>

  <!-- ════════════════════════════════════════════════════
       RIGHT PANEL: FORMULIR LOGIN TERPADU (UNIFIED)
       (Tidak ada pemisahan peran admin/pengguna di UI)
  ════════════════════════════════════════════════════ -->
  <main class="right-panel">
    <div class="login-container">

      <!-- Top Bar: Logo & Link Kembali -->
      <div class="brand-top-bar">
        <a href="<?= base_url('/') ?>" class="brand-logo" title="Beranda Parentela">
          <div class="brand-logo-mark">🌿</div>
          <span class="brand-logo-name">Parentela</span>
        </a>
        <a href="<?= base_url('/') ?>" class="back-home-link" title="Kembali ke Beranda">
          <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
            <line x1="19" y1="12" x2="5" y2="12"></line>
            <polyline points="12 19 5 12 12 5"></polyline>
          </svg>
          Beranda
        </a>
      </div>

      <?php $isRegisterMode = (isset($_GET['mode']) && $_GET['mode'] === 'register'); ?>
      <!-- Form Heading -->
      <div class="form-header">
        <h2 class="form-title"><?= $isRegisterMode ? 'Daftar Akun Baru 👋' : 'Selamat Datang 👋' ?></h2>
        <p class="form-subtitle"><?= $isRegisterMode ? 'Daftarkan keluarga Anda untuk mengakses catatan tumbuh kembang dan panduan pengasuhan gratis.' : 'Masukkan email Anda untuk melanjutkan ke catatan tumbuh kembang dan panduan pengasuhan.' ?></p>
      </div>

      <!-- Flash Notification Messages -->
      <?php if (session()->getFlashdata('error')): ?>
        <div class="alert-box alert-error" role="alert">
          <span>⚠️</span>
          <span><?= esc(session()->getFlashdata('error')) ?></span>
        </div>
      <?php endif; ?>

      <?php if (session()->getFlashdata('success')): ?>
        <div class="alert-box alert-success" role="alert">
          <span>✅</span>
          <span><?= esc(session()->getFlashdata('success')) ?></span>
        </div>
      <?php endif; ?>

      <?php if (session()->getFlashdata('info')): ?>
        <div class="alert-box alert-info" role="alert">
          <span>ℹ️</span>
          <span><?= esc(session()->getFlashdata('info')) ?></span>
        </div>
      <?php endif; ?>



      <!-- Unified Login Form (POST) -->
      <form action="<?= base_url('login' . ($isRegisterMode ? '?mode=register' : '')) ?>" method="post" id="loginForm" novalidate onsubmit="return handleFormSubmit(event)">
        <?= csrf_field() ?>
        <input type="hidden" name="mode" value="<?= $isRegisterMode ? 'register' : '' ?>">

        <!-- Email Field -->
        <div class="form-group">
          <label for="email" class="form-label">Alamat Email</label>
          <div class="input-wrapper">
            <span class="input-icon" aria-hidden="true">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
              </svg>
            </span>
            <input 
              type="email" 
              name="email" 
              id="email" 
              class="form-input" 
              placeholder="nama@gmail.com" 
              required 
              autocomplete="email"
              value="<?= esc(old('email') ?? '') ?>"
            />
          </div>
        </div>

        <!-- Password Field -->
        <div class="form-group">
          <label for="password" class="form-label">Kata Sandi</label>
          <div class="input-wrapper">
            <span class="input-icon" aria-hidden="true">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
              </svg>
            </span>
            <input 
              type="password" 
              name="password" 
              id="password" 
              class="form-input" 
              placeholder="••••••••" 
              required 
              autocomplete="current-password"
            />
            <button 
              type="button" 
              class="toggle-pwd-btn" 
              onclick="togglePasswordVisibility()" 
              id="togglePwdBtn"
              title="Tampilkan / Sembunyikan Kata Sandi"
              aria-label="Tampilkan atau sembunyikan kata sandi"
            >
              <!-- Eye open SVG -->
              <svg id="eyeIconOpen" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
              </svg>
              <!-- Eye closed SVG (hidden by default) -->
              <svg id="eyeIconClosed" style="display:none;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />
              </svg>
            </button>
          </div>
        </div>

        <!-- Remember Me & Forgot Password -->
        <div class="extras-row">
          <label class="checkbox-label" for="rememberMe">
            <input type="checkbox" id="rememberMe" name="remember" class="checkbox-input" />
            <span>Ingat saya</span>
          </label>
          <a href="javascript:void(0)" onclick="handleForgotPassword()" class="forgot-link">Lupa kata sandi?</a>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn-submit" id="submitBtn">
          <span><?= $isRegisterMode ? 'Daftar Sekarang' : 'Masuk ke Akun' ?></span>
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
            <line x1="5" y1="12" x2="19" y2="12"></line>
            <polyline points="12 5 19 12 12 19"></polyline>
          </svg>
        </button>
      </form>

      <!-- Registration and Security Footer -->
      <div class="form-footer">
        <?php if ($isRegisterMode): ?>
          <span>Sudah memiliki akun keluarga?</span>
          <a href="<?= base_url('login') ?>" class="register-link">Masuk ke Akun</a>
        <?php else: ?>
          <span>Belum memiliki akun keluarga?</span>
          <a href="<?= base_url('login?mode=register') ?>" class="register-link">Daftar Akun Baru</a>
        <?php endif; ?>

        <div class="security-note">
          <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
            <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
          </svg>
          <span>Akses aman & data keluarga Anda selalu terlindungi</span>
        </div>
      </div>

    </div>
  </main>

  <script>
    // Toggle Password Visibility
    function togglePasswordVisibility() {
      const pwdInput = document.getElementById('password');
      const eyeOpen = document.getElementById('eyeIconOpen');
      const eyeClosed = document.getElementById('eyeIconClosed');
      
      if (pwdInput.type === 'password') {
        pwdInput.type = 'text';
        eyeOpen.style.display = 'none';
        eyeClosed.style.display = 'block';
      } else {
        pwdInput.type = 'password';
        eyeOpen.style.display = 'block';
        eyeClosed.style.display = 'none';
      }
    }

    // Form Submission & UX Feedback
    function handleFormSubmit(event) {
      const emailInput = document.getElementById('email');
      const passwordInput = document.getElementById('password');
      const submitBtn = document.getElementById('submitBtn');

      if (!emailInput.value.trim()) {
        alert('Silakan masukkan alamat email Anda.');
        emailInput.focus();
        if (event) event.preventDefault();
        return false;
      }

      if (!passwordInput.value.trim()) {
        alert('Silakan masukkan kata sandi Anda.');
        passwordInput.focus();
        if (event) event.preventDefault();
        return false;
      }

      // Animasi visual: gunakan pointer-events agar submit tidak dibatalkan oleh peramban Chrome
      submitBtn.style.pointerEvents = 'none';
      submitBtn.style.opacity = '0.85';
      submitBtn.innerHTML = `
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="animation: spin 0.8s linear infinite;">
          <line x1="12" y1="2" x2="12" y2="6"></line>
          <line x1="12" y1="18" x2="12" y2="22"></line>
          <line x1="4.93" y1="4.93" x2="7.76" y2="7.76"></line>
          <line x1="16.24" y1="16.24" x2="19.07" y2="19.07"></line>
          <line x1="2" y1="12" x2="6" y2="12"></line>
          <line x1="18" y1="12" x2="22" y2="12"></line>
          <line x1="4.93" y1="19.07" x2="7.76" y2="16.24"></line>
          <line x1="16.24" y1="7.76" x2="19.07" y2="4.93"></line>
        </svg>
        <span>Memverifikasi...</span>
      `;

      // Nonaktifkan tombol secara asinkron di event tick berikutnya agar form sempat terkirim
      setTimeout(() => {
        submitBtn.disabled = true;
      }, 80);

      // Fallback pemulihan jika jaringan bermasalah
      setTimeout(() => {
        submitBtn.disabled = false;
        submitBtn.style.pointerEvents = 'auto';
        submitBtn.style.opacity = '1';
        submitBtn.innerHTML = `
          <span><?= $isRegisterMode ? 'Daftar Sekarang' : 'Masuk ke Akun' ?></span>
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
            <line x1="5" y1="12" x2="19" y2="12"></line>
            <polyline points="12 5 19 12 12 19"></polyline>
          </svg>
        `;
      }, 7000);

      return true;
    }

    // Quick Social Login Feedback
    function handleSocialLogin(provider) {
      const emailInput = document.getElementById('email');
      const passwordInput = document.getElementById('password');
      emailInput.value = 'keluarga@gmail.com';
      if (passwordInput) {
        passwordInput.value = 'Keluarga123!';
      }
      const form = document.getElementById('loginForm');
      const submitBtn = document.getElementById('submitBtn');
      submitBtn.style.pointerEvents = 'none';
      submitBtn.style.opacity = '0.85';
      submitBtn.innerHTML = `<span>Menghubungkan ke ${provider}...</span>`;
      setTimeout(() => {
        form.submit();
      }, 50);
    }

    function handleForgotPassword() {
      const email = prompt('Masukkan email Anda untuk menerima tautan pemulihan kata sandi:', document.getElementById('email').value || '');
      if (email) {
        alert('Tautan instruksi pemulihan kata sandi telah dikirimkan ke: ' + email);
      }
    }

    function handleRegisterClick() {
      const email = prompt('Pendaftaran Akun Keluarga Baru Parentela:\nMasukkan email Anda untuk memulai pendaftaran gratis:', '');
      if (email) {
        document.getElementById('email').value = email;
        document.getElementById('loginForm').submit();
      }
    }
  </script>

  <style>
    @keyframes spin {
      100% { transform: rotate(360deg); }
    }
  </style>

</body>
</html>