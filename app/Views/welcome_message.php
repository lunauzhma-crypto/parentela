<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>ReadPoint — Selamat Datang</title>
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800;900&family=Fredoka+One&display=swap" rel="stylesheet"/>
  <style>
    /* ═══════════════════════════════════════════════════
       DESIGN TOKENS — identik dengan login & beranda
    ═══════════════════════════════════════════════════ */
    :root {
      --pastel-blue:    #A8D8EA;
      --pastel-pink:    #FFACC7;
      --pastel-yellow:  #FFE066;
      --pastel-green:   #B5EAD7;
      --pastel-purple:  #C3B1E1;
      --pastel-orange:  #FFCBA4;
      --accent:         #7C5CBF;
      --accent-dark:    #5E3FA0;
      --accent-light:   #F0EAFF;
      --white:          #FFFFFF;
      --off-white:      #FFFDF7;
      --text-dark:      #3D3250;
      --text-mid:       #6B5E7E;
      --text-light:     #A89BB8;
      --shadow-soft:    0 4px 20px rgba(100,80,140,0.10);
      --shadow-card:    0 8px 32px rgba(100,80,140,0.14);
      --shadow-btn:     0 6px 0 #5E3FA0, 0 8px 20px rgba(124,92,191,0.30);
      --radius-xl:      24px;
      --radius-lg:      16px;
      --radius-md:      12px;
      --radius-sm:      8px;
      --nav-h:          68px;
    }

    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
    html { scroll-behavior: smooth; }
    body {
      font-family: 'Nunito', sans-serif;
      background: var(--off-white);
      color: var(--text-dark);
      min-height: 100vh;
    }

    /* ─── KEYFRAMES ───────────────────────────────── */
    @keyframes drift {
      from { transform: translate(0,0) scale(1); }
      to   { transform: translate(14px,18px) scale(1.07); }
    }
    @keyframes mascot-bounce {
      0%,100% { transform: translateY(0); }
      50%      { transform: translateY(-10px); }
    }
    @keyframes slide-up {
      from { opacity:0; transform:translateY(24px); }
      to   { opacity:1; transform:translateY(0); }
    }
    @keyframes bubble-pop {
      from { opacity:0; transform:scale(0.5); }
      to   { opacity:1; transform:scale(1); }
    }
    @keyframes grow-bar {
      from { width:0; }
      to   { width:var(--bar-w,60%); }
    }
    @keyframes float-lock {
      0%,100% { transform:translateY(0) rotate(-4deg); }
      50%      { transform:translateY(-8px) rotate(4deg); }
    }
    @keyframes shimmer {
      0%   { background-position: -600px 0; }
      100% { background-position:  600px 0; }
    }
    @keyframes fire-wiggle {
      from { transform:rotate(-5deg); }
      to   { transform:rotate(5deg); }
    }
    @keyframes ping {
      0%   { transform:scale(1);   opacity:1; }
      75%,100% { transform:scale(2); opacity:0; }
    }

    /* ═══════════════════════════════════════════════════
       NAVBAR
    ═══════════════════════════════════════════════════ */
    .navbar {
      position:sticky; top:0; z-index:200;
      height:var(--nav-h);
      background:rgba(255,253,247,0.94);
      backdrop-filter:blur(14px);
      border-bottom:2.5px solid #EDE8F5;
      display:flex; align-items:center;
      padding:0 32px; gap:0;
    }
    .nav-logo {
      display:flex; align-items:center; gap:10px;
      text-decoration:none; margin-right:auto;
    }
    .nav-logo-icon {
      width:40px; height:40px;
      background:linear-gradient(135deg,var(--pastel-purple),var(--pastel-blue));
      border-radius:var(--radius-md); display:grid; place-items:center;
      font-size:20px; box-shadow:0 4px 12px rgba(124,92,191,0.22);
    }
    .nav-logo-text { font-family:'Fredoka One',cursive; font-size:24px; color:var(--text-dark); }
    .nav-logo-text span { color:var(--accent); }

    .nav-links {
      display:flex; align-items:center; gap:4px;
      list-style:none; margin-right:20px;
    }
    .nav-links a {
      display:flex; align-items:center; gap:6px;
      padding:8px 14px; border-radius:50px;
      text-decoration:none; font-size:14px; font-weight:700;
      color:var(--text-light); cursor:default; position:relative;
    }
    .nav-links a.locked { opacity:0.55; }
    .nav-links a.locked:hover::after {
      content:'🔒 Masuk dulu yuk!';
      position:absolute; top:calc(100% + 8px); left:50%; transform:translateX(-50%);
      background:var(--text-dark); color:var(--white);
      padding:6px 12px; border-radius:var(--radius-md);
      font-size:12px; font-weight:700; white-space:nowrap;
      box-shadow:var(--shadow-card); pointer-events:none;
    }

    /* guest tag */
    .nav-guest-tag {
      display:flex; align-items:center; gap:6px;
      background:#F0EBF8; border:2px solid var(--pastel-purple);
      border-radius:50px; padding:6px 14px;
      font-size:13px; font-weight:800; color:var(--text-mid);
      margin-right:12px;
    }

    .nav-btn-login {
      padding:9px 22px;
      background:linear-gradient(135deg,#8B6BCF,#7C5CBF);
      border:none; border-radius:50px;
      font-family:'Nunito',sans-serif; font-size:14px; font-weight:800;
      color:var(--white); cursor:pointer;
      box-shadow:0 4px 0 var(--accent-dark);
      position:relative; top:0; transition:all 0.18s;
      margin-right:8px;
    }
    .nav-btn-login:hover {
      box-shadow:0 2px 0 var(--accent-dark); top:2px;
    }
    .nav-btn-daftar {
      padding:9px 22px;
      background:var(--white); border:2.5px solid #EDE8F5;
      border-radius:50px; font-family:'Nunito',sans-serif;
      font-size:14px; font-weight:800; color:var(--accent); cursor:pointer;
      transition:all 0.18s;
    }
    .nav-btn-daftar:hover { border-color:var(--accent); background:var(--accent-light); }
    .nav-hamburger { display:none; background:none; border:none; font-size:24px; cursor:pointer; color:var(--text-mid); }

    /* ═══════════════════════════════════════════════════
       GUEST BANNER — pengganti hero
    ═══════════════════════════════════════════════════ */
    .guest-hero {
      background:linear-gradient(140deg,#E8F4FF 0%,#F0E8FF 45%,#FFE8F4 100%);
      padding:60px 48px 52px;
      position:relative; overflow:hidden;
      display:flex; align-items:center; gap:48px;
    }
    .blob {
      position:absolute; border-radius:50%; opacity:0.50;
      animation:drift 9s ease-in-out infinite alternate;
    }
    .b1{width:220px;height:220px;background:var(--pastel-blue);  top:-60px; right:4%;   animation-delay:0s;}
    .b2{width:160px;height:160px;background:var(--pastel-yellow);bottom:-40px;left:28%; animation-delay:2s;}
    .b3{width:120px;height:120px;background:var(--pastel-green); top:30%;   right:27%;  animation-delay:3.5s;}
    .b4{width:100px;height:100px;background:var(--pastel-pink);  top:10%;   left:42%;   animation-delay:1.5s;}

    .hero-content { position:relative; z-index:2; flex:1; max-width:560px; }

    .guest-tag {
      display:inline-flex; align-items:center; gap:8px;
      background:var(--white); border-radius:50px;
      padding:6px 16px; font-size:13px; font-weight:800;
      color:var(--accent); box-shadow:var(--shadow-soft);
      margin-bottom:20px;
      animation:slide-up 0.5s cubic-bezier(.36,1.56,.64,1) 0.1s both;
    }
    /* live dot */
    .live-dot {
      width:8px; height:8px; border-radius:50%; background:#5ED4A8;
      position:relative;
    }
    .live-dot::after {
      content:''; position:absolute; inset:0; border-radius:50%;
      background:#5ED4A8; animation:ping 1.4s ease-out infinite;
    }

    .hero-title {
      font-family:'Fredoka One',cursive;
      font-size:46px; line-height:1.1; color:var(--text-dark);
      margin-bottom:14px;
      animation:slide-up 0.5s cubic-bezier(.36,1.56,.64,1) 0.2s both;
    }
    .hero-title span { color:var(--accent); }
    .hero-sub {
      font-size:16px; font-weight:600; color:var(--text-mid);
      line-height:1.65; margin-bottom:32px;
      animation:slide-up 0.5s cubic-bezier(.36,1.56,.64,1) 0.3s both;
    }

    .hero-cta {
      display:flex; gap:14px; flex-wrap:wrap;
      animation:slide-up 0.5s cubic-bezier(.36,1.56,.64,1) 0.4s both;
    }
    .btn-primary {
      padding:15px 32px;
      background:linear-gradient(135deg,#8B6BCF,#7C5CBF);
      border:none; border-radius:var(--radius-lg);
      font-family:'Nunito',sans-serif; font-size:16px; font-weight:800;
      color:var(--white); cursor:pointer; letter-spacing:0.3px;
      box-shadow:var(--shadow-btn); position:relative; top:0; transition:all 0.18s;
    }
    .btn-primary:hover {
      background:linear-gradient(135deg,#9B7ADF,#8C6BCF);
      box-shadow:0 4px 0 var(--accent-dark),0 6px 16px rgba(124,92,191,0.28);
      top:2px;
    }
    .btn-primary:active { box-shadow:0 2px 0 var(--accent-dark); top:4px; }
    .btn-secondary {
      padding:15px 32px;
      background:var(--white); border:2.5px solid #EDE8F5;
      border-radius:var(--radius-lg); font-family:'Nunito',sans-serif;
      font-size:16px; font-weight:800; color:var(--accent); cursor:pointer; transition:all 0.18s;
    }
    .btn-secondary:hover { border-color:var(--accent); background:var(--accent-light); transform:translateY(-2px); box-shadow:var(--shadow-soft); }

    /* mascot */
    .hero-mascot {
      position:relative; z-index:2; flex-shrink:0;
      animation:slide-up 0.6s cubic-bezier(.36,1.56,.64,1) 0.15s both;
    }
    .hero-mascot svg {
      width:180px; height:180px;
      animation:mascot-bounce 2.4s ease-in-out infinite;
      filter:drop-shadow(0 14px 28px rgba(124,92,191,0.22));
    }
    .hero-bubble {
      position:absolute; top:-10px; right:-16px;
      background:var(--white); border-radius:var(--radius-lg);
      padding:7px 13px; font-size:12px; font-weight:800;
      color:var(--text-dark); box-shadow:var(--shadow-soft); white-space:nowrap;
      animation:bubble-pop 0.4s cubic-bezier(.36,1.56,.64,1) 1s both;
    }
    .hero-bubble::after {
      content:''; position:absolute; bottom:-8px; left:18px;
      border:8px solid transparent; border-top-color:var(--white); border-bottom:0;
    }

    /* ═══════════════════════════════════════════════════
       STATS STRIP
    ═══════════════════════════════════════════════════ */
    .stats-strip {
      display:flex; background:var(--white);
      border-bottom:2.5px solid #EDE8F5;
    }
    .stat-item {
      flex:1; display:flex; align-items:center; gap:14px;
      padding:20px 28px; border-right:2.5px solid #EDE8F5;
      animation:slide-up 0.5s cubic-bezier(.36,1.56,.64,1) both;
    }
    .stat-item:last-child { border-right:none; }
    .stat-item:nth-child(1){animation-delay:0.5s;}
    .stat-item:nth-child(2){animation-delay:0.65s;}
    .stat-item:nth-child(3){animation-delay:0.8s;}
    .stat-item:nth-child(4){animation-delay:0.95s;}
    .stat-icon-wrap {
      width:50px;height:50px; border-radius:var(--radius-md);
      display:grid; place-items:center; font-size:24px; flex-shrink:0;
    }
    .si-blue   {background:rgba(168,216,234,0.3);}
    .si-pink   {background:rgba(255,172,199,0.3);}
    .si-green  {background:rgba(181,234,215,0.3);}
    .si-yellow {background:rgba(255,224,102,0.3);}
    .stat-num  { font-family:'Fredoka One',cursive; font-size:24px; color:var(--text-dark); line-height:1; }
    .stat-label{ font-size:12px; font-weight:700; color:var(--text-light); margin-top:3px; }

    /* ═══════════════════════════════════════════════════
       MAIN LAYOUT
    ═══════════════════════════════════════════════════ */
    .main-wrap {
      display:grid; grid-template-columns:1fr 300px; gap:28px;
      padding:36px 40px 56px; max-width:1280px; margin:0 auto;
    }
    .section-title {
      font-family:'Fredoka One',cursive; font-size:22px; color:var(--text-dark);
      display:flex; align-items:center; gap:8px; margin-bottom:18px;
    }

    /* ─── SEARCH (disabled / blurred for guest) ──── */
    .search-wrap { position:relative; margin-bottom:24px; }
    .search-input {
      width:100%; padding:14px 20px 14px 50px;
      border:2.5px solid #EDE8F5; border-radius:var(--radius-lg);
      font-family:'Nunito',sans-serif; font-size:15px; font-weight:600;
      color:var(--text-dark); background:#FDFAFF; outline:none;
      cursor:pointer; transition:all 0.2s;
    }
    .search-input::placeholder { color:var(--text-light); }
    .search-icon { position:absolute; left:16px; top:50%; transform:translateY(-50%); font-size:18px; pointer-events:none; }
    .search-btn {
      position:absolute; right:8px; top:50%; transform:translateY(-50%);
      background:var(--accent); border:none; border-radius:var(--radius-md);
      padding:8px 18px; font-family:'Nunito',sans-serif;
      font-size:13px; font-weight:800; color:var(--white); cursor:pointer;
      box-shadow:0 3px 0 var(--accent-dark); transition:all 0.18s;
    }
    .search-btn:hover { background:#8B6BCF; top:calc(50% + 1px); }

    /* ─── CATEGORY PILLS ──────────────────────────── */
    .category-scroll {
      display:flex; gap:10px; margin-bottom:28px;
      overflow-x:auto; padding-bottom:4px;
    }
    .category-scroll::-webkit-scrollbar { height:4px; }
    .category-scroll::-webkit-scrollbar-thumb { background:#C3B1E1; border-radius:4px; }
    .cat-pill {
      display:flex; align-items:center; gap:6px;
      padding:8px 18px; border-radius:50px;
      border:2.5px solid #EDE8F5; background:var(--white);
      font-family:'Nunito',sans-serif; font-size:13px; font-weight:700;
      color:var(--text-mid); cursor:pointer; white-space:nowrap;
      transition:all 0.18s; flex-shrink:0;
    }
    .cat-pill:hover { border-color:var(--accent); color:var(--accent); background:var(--accent-light); }
    .cat-pill.active {
      background:var(--accent); border-color:var(--accent);
      color:var(--white); box-shadow:0 3px 0 var(--accent-dark);
    }

    /* ═══════════════════════════════════════════════════
       BOOK GRID — GUEST VERSION
    ═══════════════════════════════════════════════════ */
    .book-grid {
      display:grid; grid-template-columns:repeat(auto-fill,minmax(160px,1fr));
      gap:18px; margin-bottom:8px;
    }
    .book-card {
      background:var(--white); border-radius:var(--radius-xl);
      overflow:hidden; box-shadow:var(--shadow-soft);
      border:2px solid #F0EBF8; cursor:pointer; transition:all 0.22s;
      animation:slide-up 0.5s cubic-bezier(.36,1.56,.64,1) both;
    }
    .book-card.free-card:hover {
      transform:translateY(-6px); box-shadow:var(--shadow-card);
      border-color:var(--pastel-purple);
    }
    .book-cover {
      height:160px; display:flex; align-items:center;
      justify-content:center; position:relative; overflow:hidden;
    }
    .book-cover-emoji { font-size:56px; }

    /* badge */
    .badge-new  { position:absolute;top:10px;right:10px;background:var(--pastel-pink);border-radius:50px;padding:3px 10px;font-size:11px;font-weight:800;color:#C04F7A; }
    .badge-hot  { position:absolute;top:10px;right:10px;background:var(--pastel-yellow);border-radius:50px;padding:3px 10px;font-size:11px;font-weight:800;color:#A07000; }
    .badge-free { position:absolute;top:10px;left:10px;background:var(--pastel-green);border-radius:50px;padding:3px 10px;font-size:11px;font-weight:800;color:#2A7A5A; }

    .book-info { padding:14px 14px 16px; }
    .book-title {
      font-size:13px;font-weight:800;color:var(--text-dark);line-height:1.3;margin-bottom:4px;
      display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;
    }
    .book-author { font-size:11px;font-weight:700;color:var(--text-light);margin-bottom:8px; }
    .book-meta   { display:flex;align-items:center;gap:6px; }
    .book-rating { font-size:11px;font-weight:800;color:#F4A426;display:flex;align-items:center;gap:3px; }
    .book-tag    { font-size:10px;font-weight:800;padding:2px 8px;border-radius:50px;margin-left:auto; }
    .tag-fiksi    {background:rgba(168,216,234,0.35);color:#2A6A8A;}
    .tag-sains    {background:rgba(181,234,215,0.35);color:#2A7A5A;}
    .tag-sejarah  {background:rgba(255,224,102,0.35);color:#8A6A00;}
    .tag-bisnis   {background:rgba(195,177,225,0.35);color:#5A3A9A;}
    .tag-psikologi{background:rgba(255,172,199,0.35);color:#9A2A5A;}
    .tag-teknologi{background:rgba(255,203,164,0.35);color:#8A4A10;}

    /* ─── LOCK OVERLAY ────────────────────────────── */
    .book-card.locked-card {
      position:relative; cursor:default;
    }
    .book-card.locked-card:hover { transform:none; box-shadow:var(--shadow-soft); border-color:#F0EBF8; }
    .lock-overlay {
      position:absolute; inset:0; z-index:10;
      border-radius:calc(var(--radius-xl) - 2px);
      display:flex; flex-direction:column;
      align-items:center; justify-content:center; gap:6px;
      backdrop-filter:blur(5px);
      background:rgba(253,250,255,0.78);
      opacity:0; transition:opacity 0.22s;
    }
    .book-card.locked-card:hover .lock-overlay { opacity:1; }
    .lock-icon {
      font-size:32px;
      animation:float-lock 2.2s ease-in-out infinite;
    }
    .lock-msg { font-size:12px;font-weight:800;color:var(--text-mid);text-align:center;line-height:1.4; }
    .lock-btn {
      margin-top:4px; padding:7px 18px;
      background:linear-gradient(135deg,#8B6BCF,#7C5CBF);
      border:none; border-radius:50px;
      font-family:'Nunito',sans-serif; font-size:12px; font-weight:800;
      color:var(--white); cursor:pointer;
      box-shadow:0 3px 0 var(--accent-dark); transition:all 0.18s;
    }
    .lock-btn:hover { background:linear-gradient(135deg,#9B7ADF,#8C6BCF); }

    /* blurred book info for locked cards */
    .locked-card .book-info { filter:blur(3.5px); user-select:none; pointer-events:none; }
    .locked-card .book-cover { filter:blur(0); }
    .locked-card .book-cover .book-cover-emoji { filter:blur(2px); opacity:0.6; }

    /* ─── LOCK GATE BANNER ───────────────────────── */
    .lock-gate {
      background:linear-gradient(135deg,var(--accent-light),#E8F4FF);
      border:2.5px solid var(--pastel-purple);
      border-radius:var(--radius-xl); padding:28px 32px;
      display:flex; align-items:center; gap:24px;
      margin-bottom:36px; position:relative; overflow:hidden;
    }
    .lock-gate::before {
      content:''; position:absolute; inset:0;
      background:linear-gradient(90deg,transparent,rgba(255,255,255,0.5),transparent);
      background-size:600px; animation:shimmer 2.4s linear infinite;
    }
    .gate-icon { font-size:52px; flex-shrink:0; }
    .gate-body { flex:1; }
    .gate-title { font-family:'Fredoka One',cursive; font-size:20px; color:var(--text-dark); margin-bottom:6px; }
    .gate-sub   { font-size:14px; font-weight:600; color:var(--text-mid); line-height:1.5; }
    .gate-actions { display:flex; gap:10px; flex-shrink:0; flex-wrap:wrap; }
    .gate-btn-main {
      padding:12px 24px;
      background:linear-gradient(135deg,#8B6BCF,#7C5CBF);
      border:none; border-radius:var(--radius-lg);
      font-family:'Nunito',sans-serif; font-size:14px; font-weight:800;
      color:var(--white); cursor:pointer;
      box-shadow:var(--shadow-btn); position:relative; top:0; transition:all 0.18s;
    }
    .gate-btn-main:hover { box-shadow:0 4px 0 var(--accent-dark); top:2px; }
    .gate-btn-sec {
      padding:12px 24px; background:var(--white);
      border:2.5px solid #EDE8F5; border-radius:var(--radius-lg);
      font-family:'Nunito',sans-serif; font-size:14px; font-weight:800;
      color:var(--accent); cursor:pointer; transition:all 0.18s;
    }
    .gate-btn-sec:hover { border-color:var(--accent); background:var(--accent-light); }

    /* ═══════════════════════════════════════════════════
       FITUR HIGHLIGHTS
    ═══════════════════════════════════════════════════ */
    .features-section { margin-bottom:36px; }
    .features-grid {
      display:grid; grid-template-columns:repeat(3,1fr); gap:16px;
    }
    .feature-card {
      background:var(--white); border-radius:var(--radius-xl);
      padding:22px 20px; border:2px solid #F0EBF8;
      box-shadow:var(--shadow-soft); text-align:center;
      transition:all 0.22s; cursor:default;
      animation:slide-up 0.5s cubic-bezier(.36,1.56,.64,1) both;
    }
    .feature-card:hover {
      transform:translateY(-5px); box-shadow:var(--shadow-card);
      border-color:var(--pastel-purple);
    }
    .feature-card:nth-child(1){animation-delay:0.1s;}
    .feature-card:nth-child(2){animation-delay:0.2s;}
    .feature-card:nth-child(3){animation-delay:0.3s;}
    .feat-icon {
      width:56px; height:56px; border-radius:var(--radius-lg);
      display:grid; place-items:center; font-size:26px; margin:0 auto 14px;
    }
    .feat-title { font-family:'Fredoka One',cursive; font-size:16px; color:var(--text-dark); margin-bottom:6px; }
    .feat-desc  { font-size:12px; font-weight:600; color:var(--text-light); line-height:1.55; }

    /* ═══════════════════════════════════════════════════
       SIDEBAR
    ═══════════════════════════════════════════════════ */
    .sidebar { display:flex; flex-direction:column; gap:20px; }
    .sidebar-card {
      background:var(--white); border-radius:var(--radius-xl);
      padding:20px; box-shadow:var(--shadow-soft); border:2px solid #F0EBF8;
    }
    .sidebar-title {
      font-family:'Fredoka One',cursive; font-size:17px; color:var(--text-dark);
      margin-bottom:16px; display:flex; align-items:center; gap:6px;
    }

    /* ─── STREAK PREVIEW (locked) ─────────────────── */
    .locked-preview {
      position:relative; border-radius:var(--radius-lg); overflow:hidden;
    }
    .locked-preview-inner { filter:blur(4px); opacity:0.55; pointer-events:none; }
    .locked-preview-gate {
      position:absolute; inset:0; display:flex; flex-direction:column;
      align-items:center; justify-content:center; gap:8px;
      background:rgba(253,250,255,0.72); backdrop-filter:blur(2px);
      border-radius:var(--radius-lg);
    }
    .lp-lock { font-size:28px; animation:float-lock 2.2s ease-in-out infinite; }
    .lp-text { font-size:12px; font-weight:800; color:var(--text-mid); text-align:center; }
    .lp-btn {
      padding:7px 18px; background:linear-gradient(135deg,#8B6BCF,#7C5CBF);
      border:none; border-radius:50px;
      font-family:'Nunito',sans-serif; font-size:12px; font-weight:800;
      color:var(--white); cursor:pointer; box-shadow:0 3px 0 var(--accent-dark);
      transition:all 0.18s;
    }
    .lp-btn:hover { background:linear-gradient(135deg,#9B7ADF,#8C6BCF); }

    .streak-row { display:flex; align-items:center; gap:12px; margin-bottom:14px; }
    .streak-fire { font-size:38px; animation:fire-wiggle 1.2s ease-in-out infinite alternate; }
    .streak-num  { font-family:'Fredoka One',cursive; font-size:38px; color:#E07A20; }
    .streak-sub  { font-size:11px; font-weight:700; color:var(--text-light); }
    .streak-days { display:flex; gap:6px; justify-content:space-between; }
    .day-dot     { display:flex; flex-direction:column; align-items:center; gap:4px; }
    .day-circle  { width:30px; height:30px; border-radius:50%; display:grid; place-items:center; font-size:14px; }
    .day-done  { background:var(--pastel-yellow); }
    .day-todo  { background:#F0EBF8; font-size:10px; color:var(--text-light); font-weight:800; }
    .day-name  { font-size:9px; font-weight:800; color:var(--text-light); }

    /* ─── XP PREVIEW (locked) ─────────────────────── */
    .xp-card { background:linear-gradient(135deg,#F0EAFF,#E8F4FF); border-color:var(--pastel-purple); }
    .xp-level-row { display:flex; align-items:center; justify-content:space-between; margin-bottom:8px; }
    .xp-level-badge { background:var(--accent);color:var(--white);border-radius:50px;padding:4px 14px;font-size:13px;font-weight:800; }
    .xp-pts { font-size:13px;font-weight:800;color:var(--text-mid); }
    .xp-bar-wrap { background:rgba(195,177,225,0.3);border-radius:50px;height:12px;overflow:hidden;margin-bottom:6px; }
    .xp-bar { height:100%;width:0;border-radius:50px;background:linear-gradient(90deg,var(--pastel-green),#5ED4A8);--bar-w:62%;animation:grow-bar 1.4s ease 0.6s both; }
    .xp-label { display:flex;justify-content:space-between;font-size:11px;font-weight:800;color:var(--text-light); }

    /* ─── TESTIMONI ───────────────────────────────── */
    .testimonial-list { display:flex; flex-direction:column; gap:12px; }
    .testi-card {
      background:#FDFAFF; border:2px solid #F0EBF8;
      border-radius:var(--radius-lg); padding:14px;
      transition:all 0.18s;
    }
    .testi-card:hover { border-color:var(--pastel-purple); background:var(--accent-light); }
    .testi-header { display:flex; align-items:center; gap:10px; margin-bottom:8px; }
    .testi-avatar {
      width:36px; height:36px; border-radius:50%;
      display:grid; place-items:center; font-size:18px; flex-shrink:0;
    }
    .testi-name { font-size:13px; font-weight:800; color:var(--text-dark); }
    .testi-level{ font-size:10px; font-weight:700; color:var(--text-light); }
    .testi-stars{ font-size:12px; margin-left:auto; letter-spacing:1px; }
    .testi-text { font-size:12px; font-weight:600; color:var(--text-mid); line-height:1.55; }

    /* ─── TOP READERS ─────────────────────────────── */
    .top-reader-item {
      display:flex; align-items:center; gap:10px;
      padding:10px 0; border-bottom:2px solid #F0EBF8;
    }
    .top-reader-item:last-child { border-bottom:none; }
    .rank-num { font-family:'Fredoka One',cursive; font-size:18px; width:24px; text-align:center; flex-shrink:0; }
    .rank-1{color:#F4A426;} .rank-2{color:#A89BB8;} .rank-3{color:#C07A30;}
    .reader-avatar { width:34px;height:34px;border-radius:50%;display:grid;place-items:center;font-size:18px;flex-shrink:0; }
    .reader-name   { font-size:13px;font-weight:800;color:var(--text-dark); }
    .reader-books  { font-size:11px;font-weight:700;color:var(--text-light); }
    .reader-xp     { margin-left:auto;font-family:'Fredoka One',cursive;font-size:14px;color:var(--accent); }

    /* ═══════════════════════════════════════════════════
       BIG CTA BANNER (bottom)
    ═══════════════════════════════════════════════════ */
    .cta-banner {
      background:linear-gradient(135deg,#8B6BCF,#7C5CBF,#6A4BAF);
      padding:56px 48px; text-align:center;
      position:relative; overflow:hidden;
    }
    .cta-blob {
      position:absolute; border-radius:50%; opacity:0.18;
    }
    .cb1{width:300px;height:300px;background:var(--white);top:-100px;right:-80px;animation:drift 10s ease-in-out infinite alternate;}
    .cb2{width:200px;height:200px;background:var(--white);bottom:-60px;left:-40px;animation:drift 8s ease-in-out infinite alternate;}
    .cta-content { position:relative; z-index:2; max-width:600px; margin:0 auto; }
    .cta-mascot {
      width:90px; height:90px; margin:0 auto 20px;
      animation:mascot-bounce 2.4s ease-in-out infinite;
      filter:drop-shadow(0 8px 20px rgba(0,0,0,0.2));
    }
    .cta-title {
      font-family:'Fredoka One',cursive; font-size:38px;
      color:var(--white); margin-bottom:12px; line-height:1.15;
    }
    .cta-sub { font-size:16px;font-weight:600;color:rgba(255,255,255,0.80);line-height:1.6;margin-bottom:32px; }
    .cta-actions { display:flex;gap:14px;justify-content:center;flex-wrap:wrap; }
    .cta-btn-main {
      padding:16px 40px; background:var(--white);
      border:none; border-radius:var(--radius-lg);
      font-family:'Nunito',sans-serif; font-size:16px; font-weight:900;
      color:var(--accent); cursor:pointer;
      box-shadow:0 6px 0 rgba(0,0,0,0.18); position:relative; top:0; transition:all 0.18s;
    }
    .cta-btn-main:hover { top:2px; box-shadow:0 4px 0 rgba(0,0,0,0.18); }
    .cta-btn-sec {
      padding:16px 40px; background:transparent;
      border:2.5px solid rgba(255,255,255,0.55); border-radius:var(--radius-lg);
      font-family:'Nunito',sans-serif; font-size:16px; font-weight:800;
      color:var(--white); cursor:pointer; transition:all 0.18s;
    }
    .cta-btn-sec:hover { background:rgba(255,255,255,0.15); border-color:white; }
    .cta-note { margin-top:16px; font-size:13px; font-weight:700; color:rgba(255,255,255,0.60); }

    /* ═══════════════════════════════════════════════════
       FOOTER
    ═══════════════════════════════════════════════════ */
    .footer {
      background:var(--white); border-top:2.5px solid #EDE8F5;
      padding:24px 40px; display:flex; align-items:center;
      justify-content:space-between; flex-wrap:wrap; gap:12px;
    }
    .footer-logo { font-family:'Fredoka One',cursive; font-size:20px; color:var(--text-dark); }
    .footer-logo span { color:var(--accent); }
    .footer-text { font-size:12px; font-weight:700; color:var(--text-light); }
    .footer-links { display:flex; gap:16px; }
    .footer-links a { font-size:12px; font-weight:700; color:var(--text-light); text-decoration:none; transition:color 0.18s; }
    .footer-links a:hover { color:var(--accent); }

    /* ═══════════════════════════════════════════════════
       TOAST & MODAL
    ═══════════════════════════════════════════════════ */
    .toast {
      position:fixed; bottom:24px; left:50%; transform:translateX(-50%) translateY(80px);
      background:var(--text-dark); color:var(--white);
      border-radius:var(--radius-lg); padding:12px 24px;
      font-size:14px; font-weight:700; z-index:9999;
      box-shadow:var(--shadow-card); transition:transform 0.35s cubic-bezier(.36,1.56,.64,1);
      display:flex; align-items:center; gap:10px; white-space:nowrap;
    }
    .toast.show { transform:translateX(-50%) translateY(0); }

    /* modal overlay */
    .modal-overlay {
      position:fixed; inset:0; z-index:500;
      background:rgba(61,50,80,0.55); backdrop-filter:blur(6px);
      display:flex; align-items:center; justify-content:center; padding:20px;
      opacity:0; pointer-events:none; transition:opacity 0.25s;
    }
    .modal-overlay.open { opacity:1; pointer-events:all; }
    .modal {
      background:var(--white); border-radius:var(--radius-xl);
      padding:36px 32px; max-width:420px; width:100%;
      box-shadow:0 24px 60px rgba(61,50,80,0.28);
      text-align:center;
      transform:translateY(30px) scale(0.95); transition:transform 0.35s cubic-bezier(.36,1.56,.64,1);
    }
    .modal-overlay.open .modal { transform:translateY(0) scale(1); }
    .modal-icon { font-size:64px; margin-bottom:12px; animation:mascot-bounce 2.4s ease-in-out infinite; }
    .modal-title { font-family:'Fredoka One',cursive; font-size:26px; color:var(--text-dark); margin-bottom:8px; }
    .modal-sub   { font-size:14px; font-weight:600; color:var(--text-mid); margin-bottom:28px; line-height:1.55; }
    .modal-btn-main {
      width:100%; padding:15px;
      background:linear-gradient(135deg,#8B6BCF,#7C5CBF);
      border:none; border-radius:var(--radius-lg);
      font-family:'Nunito',sans-serif; font-size:16px; font-weight:800;
      color:var(--white); cursor:pointer; margin-bottom:10px;
      box-shadow:var(--shadow-btn); position:relative; top:0; transition:all 0.18s;
    }
    .modal-btn-main:hover { top:2px; box-shadow:0 4px 0 var(--accent-dark); }
    .modal-btn-sec {
      width:100%; padding:13px;
      background:var(--white); border:2.5px solid #EDE8F5;
      border-radius:var(--radius-lg); font-family:'Nunito',sans-serif;
      font-size:15px; font-weight:800; color:var(--accent); cursor:pointer; transition:all 0.18s;
      margin-bottom:16px;
    }
    .modal-btn-sec:hover { border-color:var(--accent); background:var(--accent-light); }
    .modal-close { font-size:13px; font-weight:700; color:var(--text-light); cursor:pointer; text-decoration:underline; }
    .modal-close:hover { color:var(--text-mid); }

    /* ═══════════════════════════════════════════════════
       RESPONSIVE
    ═══════════════════════════════════════════════════ */
    @media(max-width:960px){
      .main-wrap { grid-template-columns:1fr; padding:24px 20px 40px; }
      .sidebar   { display:grid; grid-template-columns:1fr 1fr; }
      .features-grid { grid-template-columns:1fr 1fr; }
    }
    @media(max-width:700px){
      .navbar { padding:0 16px; }
      .nav-links,.nav-guest-tag { display:none; }
      .nav-hamburger { display:block; }
      .guest-hero { flex-direction:column; padding:36px 20px 32px; text-align:center; }
      .hero-mascot { order:-1; }
      .hero-cta { justify-content:center; }
      .hero-title { font-size:34px; }
      .stats-strip { flex-wrap:wrap; }
      .stat-item { min-width:45%; border-right:none; border-bottom:2px solid #EDE8F5; }
      .features-grid { grid-template-columns:1fr; }
      .sidebar { display:flex; flex-direction:column; }
      .lock-gate { flex-direction:column; text-align:center; }
      .gate-actions { justify-content:center; }
      .cta-banner { padding:40px 20px; }
      .cta-title  { font-size:28px; }
      .footer { flex-direction:column; text-align:center; }
    }
  </style>
</head>
<body>

  <!-- ═══ NAVBAR ══════════════════════════════════════ -->
  <nav class="navbar">
    <a href="#" class="nav-logo">
      <div class="nav-logo-icon">📚</div>
      <span class="nav-logo-text">Read<span>Point</span></span>
    </a>

    <ul class="nav-links">
      <li><a href="#">🏠 Beranda</a></li>
      <li><a href="#" class="locked" title="">🔍 Telusuri</a></li>
      <li><a href="#" class="locked">📋 Pinjaman Saya</a></li>
      <li><a href="#" class="locked">❤️ Favorit</a></li>
      <li><a href="#" class="locked">🏆 Papan Skor</a></li>
    </ul>

    <div class="nav-guest-tag">👤 Mode Tamu</div>
    <button class="nav-btn-login" onclick="openModal()">Masuk</button>
    <button class="nav-btn-daftar" onclick="openModal()">Daftar Gratis</button>
    <button class="nav-hamburger">☰</button>
  </nav>

  <!-- ═══ HERO ═════════════════════════════════════════ -->
  <section class="guest-hero">
    <div class="blob b1"></div>
    <div class="blob b2"></div>
    <div class="blob b3"></div>
    <div class="blob b4"></div>

    <div class="hero-content">
      <div class="guest-tag">
        <div class="live-dot"></div>
        1.240 buku tersedia sekarang
      </div>
      <h1 class="hero-title">Pinjam Buku,<br/>Raih <span>Ilmu Baru!</span></h1>
      <p class="hero-sub">Bergabung dengan <strong>12.000+ pembaca aktif</strong> di ReadPoint. Pinjam buku kapan saja, kumpulkan XP, dan jadilah pembaca terbaik!</p>
      <div class="hero-cta">
        <button class="btn-primary" onclick="openModal()">🚀 Mulai Gratis</button>
        <button class="btn-secondary" onclick="openModal()">🔑 Sudah Punya Akun?</button>
      </div>
    </div>

    <div class="hero-mascot">
      <div class="hero-bubble">✨ Gratis untuk daftar!</div>
      <svg viewBox="0 0 160 160" xmlns="http://www.w3.org/2000/svg">
        <ellipse cx="80" cy="150" rx="45" ry="8" fill="rgba(100,80,140,0.12)"/>
        <rect x="22" y="28" width="116" height="108" rx="14" fill="#C3B1E1"/>
        <rect x="22" y="28" width="22" height="108" rx="10" fill="#A890D0"/>
        <rect x="52" y="48" width="72" height="5" rx="3" fill="#E8E0F4"/>
        <rect x="52" y="60" width="60" height="5" rx="3" fill="#E8E0F4"/>
        <rect x="52" y="72" width="68" height="5" rx="3" fill="#E8E0F4"/>
        <circle cx="64" cy="98" r="10" fill="white"/>
        <circle cx="64" cy="98" r="6"  fill="#3D3250"/>
        <circle cx="66" cy="96" r="2"  fill="white"/>
        <circle cx="96" cy="98" r="10" fill="white"/>
        <circle cx="96" cy="98" r="6"  fill="#3D3250"/>
        <circle cx="98" cy="96" r="2"  fill="white"/>
        <path d="M68 112 Q80 122 92 112" stroke="#3D3250" stroke-width="3.5" fill="none" stroke-linecap="round"/>
        <ellipse cx="55"  cy="110" rx="7" ry="5" fill="#FFACC7" opacity="0.7"/>
        <ellipse cx="105" cy="110" rx="7" ry="5" fill="#FFACC7" opacity="0.7"/>
        <rect x="118" y="56" width="12" height="48" rx="6" fill="#B5EAD7"/>
      </svg>
    </div>
  </section>

  <!-- ═══ STATS STRIP ══════════════════════════════════ -->
  <div class="stats-strip">
    <div class="stat-item">
      <div class="stat-icon-wrap si-blue">📚</div>
      <div><div class="stat-num">1.240</div><div class="stat-label">Koleksi Buku</div></div>
    </div>
    <div class="stat-item">
      <div class="stat-icon-wrap si-pink">👥</div>
      <div><div class="stat-num">12.000+</div><div class="stat-label">Pembaca Aktif</div></div>
    </div>
    <div class="stat-item">
      <div class="stat-icon-wrap si-green">📖</div>
      <div><div class="stat-num">48.500</div><div class="stat-label">Buku Dipinjam</div></div>
    </div>
    <div class="stat-item">
      <div class="stat-icon-wrap si-yellow">⭐</div>
      <div><div class="stat-num">4.9 / 5</div><div class="stat-label">Rating Pengguna</div></div>
    </div>
  </div>

  <!-- ═══ MAIN GRID ════════════════════════════════════ -->
  <div class="main-wrap">

    <!-- ─── LEFT COLUMN ──────────────────────────────── -->
    <div class="left-col">

      <!-- Search (accessible for guest) -->
      <div class="search-wrap">
        <span class="search-icon">🔍</span>
        <input type="text" class="search-input" placeholder="Cari judul buku, pengarang, atau genre..." onclick="showToast('🔒 Masuk untuk menggunakan pencarian penuh!')"/>
        <button class="search-btn" onclick="openModal()">Cari</button>
      </div>

      <!-- Categories -->
      <div class="category-scroll">
        <button class="cat-pill active" onclick="setActive(this)">✨ Semua</button>
        <button class="cat-pill" onclick="setActive(this)">📖 Fiksi</button>
        <button class="cat-pill" onclick="setActive(this)">🔬 Sains</button>
        <button class="cat-pill" onclick="setActive(this)">📜 Sejarah</button>
        <button class="cat-pill" onclick="setActive(this)">💼 Bisnis</button>
        <button class="cat-pill" onclick="setActive(this)">🧠 Psikologi</button>
        <button class="cat-pill" onclick="setActive(this)">💻 Teknologi</button>
        <button class="cat-pill" onclick="setActive(this)">🌍 Geografi</button>
      </div>

      <!-- Fitur Highlights -->
      <div class="features-section">
        <div class="section-title">🌟 Kenapa Pilih ReadPoint?</div>
        <div class="features-grid">
          <div class="feature-card">
            <div class="feat-icon" style="background:rgba(168,216,234,0.3);">📚</div>
            <div class="feat-title">Ribuan Koleksi</div>
            <div class="feat-desc">Akses 1.240+ judul dari berbagai genre. Selalu diperbarui setiap minggu.</div>
          </div>
          <div class="feature-card">
            <div class="feat-icon" style="background:rgba(255,224,102,0.3);">🏆</div>
            <div class="feat-title">Sistem XP & Level</div>
            <div class="feat-desc">Kumpulkan XP setiap buku selesai dibaca dan naiki level pembaca!</div>
          </div>
          <div class="feature-card">
            <div class="feat-icon" style="background:rgba(181,234,215,0.3);">🔥</div>
            <div class="feat-title">Streak Harian</div>
            <div class="feat-desc">Jaga streak membacamu. Streak panjang = hadiah eksklusif menantimu!</div>
          </div>
        </div>
      </div>

      <!-- Book Preview Grid -->
      <div class="section-title">✨ Preview Koleksi Buku</div>

      <div class="book-grid">
        <!-- FREE: 2 buku bisa dilihat -->
        <div class="book-card free-card" style="animation-delay:0.1s" onclick="showToast('🔒 Masuk untuk meminjam buku!')">
          <div class="book-cover" style="background:linear-gradient(145deg,#FFE8F4,#F0E8FF);">
            <span class="badge-free">Gratis Preview</span>
            <span class="book-cover-emoji">📕</span>
          </div>
          <div class="book-info">
            <div class="book-title">The Psychology of Money</div>
            <div class="book-author">Morgan Housel</div>
            <div class="book-meta">
              <span class="book-rating">⭐ 4.8</span>
              <span class="book-tag tag-bisnis">Bisnis</span>
            </div>
          </div>
        </div>

        <div class="book-card free-card" style="animation-delay:0.2s" onclick="showToast('🔒 Masuk untuk meminjam buku!')">
          <div class="book-cover" style="background:linear-gradient(145deg,#E8F4FF,#E8FFF4);">
            <span class="badge-hot">🔥 Populer</span>
            <span class="badge-free">Gratis Preview</span>
            <span class="book-cover-emoji">📗</span>
          </div>
          <div class="book-info">
            <div class="book-title">Atomic Habits</div>
            <div class="book-author">James Clear</div>
            <div class="book-meta">
              <span class="book-rating">⭐ 4.9</span>
              <span class="book-tag tag-psikologi">Psikologi</span>
            </div>
          </div>
        </div>

        <!-- LOCKED: 4 buku terkunci -->
        <div class="book-card locked-card" style="animation-delay:0.3s">
          <div class="lock-overlay">
            <div class="lock-icon">🔒</div>
            <div class="lock-msg">Masuk untuk<br/>melihat & meminjam</div>
            <button class="lock-btn" onclick="openModal()">Masuk / Daftar</button>
          </div>
          <div class="book-cover" style="background:linear-gradient(145deg,#FFFBE8,#FFF0E8);">
            <span class="book-cover-emoji">📙</span>
          </div>
          <div class="book-info">
            <div class="book-title">Clean Code</div>
            <div class="book-author">Robert C. Martin</div>
            <div class="book-meta">
              <span class="book-rating">⭐ 4.6</span>
              <span class="book-tag tag-teknologi">Teknologi</span>
            </div>
          </div>
        </div>

        <div class="book-card locked-card" style="animation-delay:0.4s">
          <div class="lock-overlay">
            <div class="lock-icon">🔒</div>
            <div class="lock-msg">Masuk untuk<br/>melihat & meminjam</div>
            <button class="lock-btn" onclick="openModal()">Masuk / Daftar</button>
          </div>
          <div class="book-cover" style="background:linear-gradient(145deg,#F0E8FF,#E8F4FF);">
            <span class="book-cover-emoji">📚</span>
          </div>
          <div class="book-info">
            <div class="book-title">A Brief History of Time</div>
            <div class="book-author">Stephen Hawking</div>
            <div class="book-meta">
              <span class="book-rating">⭐ 4.9</span>
              <span class="book-tag tag-sains">Sains</span>
            </div>
          </div>
        </div>

        <div class="book-card locked-card" style="animation-delay:0.5s">
          <div class="lock-overlay">
            <div class="lock-icon">🔒</div>
            <div class="lock-msg">Masuk untuk<br/>melihat & meminjam</div>
            <button class="lock-btn" onclick="openModal()">Masuk / Daftar</button>
          </div>
          <div class="book-cover" style="background:linear-gradient(145deg,#E8FFF0,#FFFBE8);">
            <span class="book-cover-emoji">📖</span>
          </div>
          <div class="book-info">
            <div class="book-title">1984</div>
            <div class="book-author">George Orwell</div>
            <div class="book-meta">
              <span class="book-rating">⭐ 4.7</span>
              <span class="book-tag tag-fiksi">Fiksi</span>
            </div>
          </div>
        </div>

        <div class="book-card locked-card" style="animation-delay:0.6s">
          <div class="lock-overlay">
            <div class="lock-icon">🔒</div>
            <div class="lock-msg">Masuk untuk<br/>melihat & meminjam</div>
            <button class="lock-btn" onclick="openModal()">Masuk / Daftar</button>
          </div>
          <div class="book-cover" style="background:linear-gradient(145deg,#FFE8E8,#FFE8F4);">
            <span class="book-cover-emoji">📓</span>
          </div>
          <div class="book-info">
            <div class="book-title">Guns, Germs, and Steel</div>
            <div class="book-author">Jared Diamond</div>
            <div class="book-meta">
              <span class="book-rating">⭐ 4.5</span>
              <span class="book-tag tag-sejarah">Sejarah</span>
            </div>
          </div>
        </div>
      </div>

      <!-- Lock Gate Banner -->
      <div class="lock-gate">
        <div class="gate-icon">🔓</div>
        <div class="gate-body">
          <div class="gate-title">Buka Akses ke 1.238 Buku Lainnya!</div>
          <div class="gate-sub">Daftar gratis dan nikmati semua fitur ReadPoint — pinjam buku, kumpulkan XP, ikuti tantangan membaca, dan bersaing di papan skor!</div>
        </div>
        <div class="gate-actions">
          <button class="gate-btn-main" onclick="openModal()">🚀 Daftar Gratis</button>
          <button class="gate-btn-sec"  onclick="openModal()">🔑 Masuk</button>
        </div>
      </div>

    </div>

    <!-- ─── SIDEBAR ───────────────────────────────────── -->
    <aside class="sidebar">

      <!-- XP Preview (locked) -->
      <div class="sidebar-card xp-card">
        <div class="sidebar-title">⚡ Progress XP Kamu</div>
        <div class="locked-preview">
          <div class="locked-preview-inner">
            <div class="xp-level-row">
              <span class="xp-level-badge">Level ?</span>
              <span class="xp-pts">??? / 1000 XP</span>
            </div>
            <div class="xp-bar-wrap"><div class="xp-bar"></div></div>
            <div class="xp-label"><span>??? XP</span><span>Login untuk lihat →</span></div>
          </div>
          <div class="locked-preview-gate">
            <div class="lp-lock">⚡</div>
            <div class="lp-text">Mulai perjalananmu<br/>dan kumpulkan XP!</div>
            <button class="lp-btn" onclick="openModal()">Daftar Sekarang</button>
          </div>
        </div>
      </div>

      <!-- Streak Preview (locked) -->
      <div class="sidebar-card">
        <div class="sidebar-title">🔥 Streak Membaca</div>
        <div class="locked-preview">
          <div class="locked-preview-inner">
            <div class="streak-row">
              <div class="streak-fire">🔥</div>
              <div><div class="streak-num">??</div><div class="streak-sub">hari berturut-turut</div></div>
            </div>
            <div class="streak-days">
              <div class="day-dot"><div class="day-circle day-todo">S</div><span class="day-name">Sen</span></div>
              <div class="day-dot"><div class="day-circle day-todo">S</div><span class="day-name">Sel</span></div>
              <div class="day-dot"><div class="day-circle day-todo">R</div><span class="day-name">Rab</span></div>
              <div class="day-dot"><div class="day-circle day-todo">K</div><span class="day-name">Kam</span></div>
              <div class="day-dot"><div class="day-circle day-todo">J</div><span class="day-name">Jum</span></div>
              <div class="day-dot"><div class="day-circle day-todo">S</div><span class="day-name">Sab</span></div>
              <div class="day-dot"><div class="day-circle day-todo">M</div><span class="day-name">Min</span></div>
            </div>
          </div>
          <div class="locked-preview-gate">
            <div class="lp-lock">🔥</div>
            <div class="lp-text">Bangun streakmu<br/>mulai hari ini!</div>
            <button class="lp-btn" onclick="openModal()">Mulai Gratis</button>
          </div>
        </div>
      </div>

      <!-- Top Readers -->
      <div class="sidebar-card">
        <div class="sidebar-title">🏆 Pembaca Terbaik</div>
        <div>
          <div class="top-reader-item">
            <span class="rank-num rank-1">🥇</span>
            <div class="reader-avatar" style="background:linear-gradient(135deg,var(--pastel-yellow),var(--pastel-orange));">😎</div>
            <div><div class="reader-name">Rania A.</div><div class="reader-books">52 buku · Level 10</div></div>
            <span class="reader-xp">9.800 XP</span>
          </div>
          <div class="top-reader-item">
            <span class="rank-num rank-2">🥈</span>
            <div class="reader-avatar" style="background:linear-gradient(135deg,var(--pastel-blue),var(--pastel-purple));">🤓</div>
            <div><div class="reader-name">Dimas P.</div><div class="reader-books">47 buku · Level 9</div></div>
            <span class="reader-xp">8.450 XP</span>
          </div>
          <div class="top-reader-item">
            <span class="rank-num rank-3">🥉</span>
            <div class="reader-avatar" style="background:linear-gradient(135deg,var(--pastel-green),var(--pastel-blue));">😊</div>
            <div><div class="reader-name">Siti N.</div><div class="reader-books">43 buku · Level 8</div></div>
            <span class="reader-xp">7.200 XP</span>
          </div>
          <div class="top-reader-item">
            <span class="rank-num" style="color:var(--text-light);">4</span>
            <div class="reader-avatar" style="background:linear-gradient(135deg,var(--pastel-pink),var(--pastel-orange));">🙂</div>
            <div><div class="reader-name">Bagas W.</div><div class="reader-books">38 buku · Level 7</div></div>
            <span class="reader-xp">6.100 XP</span>
          </div>
        </div>
      </div>

      <!-- Testimoni -->
      <div class="sidebar-card">
        <div class="sidebar-title">💬 Kata Mereka</div>
        <div class="testimonial-list">
          <div class="testi-card">
            <div class="testi-header">
              <div class="testi-avatar" style="background:linear-gradient(135deg,var(--pastel-pink),var(--pastel-purple));">😊</div>
              <div>
                <div class="testi-name">Ayu R.</div>
                <div class="testi-level">Level 8 · 40 buku</div>
              </div>
              <div class="testi-stars">⭐⭐⭐⭐⭐</div>
            </div>
            <div class="testi-text">"Sistem XP-nya bikin nagih! Gak kerasa udah baca 40 buku. Rekomended banget buat yang mau rajin baca."</div>
          </div>
          <div class="testi-card">
            <div class="testi-header">
              <div class="testi-avatar" style="background:linear-gradient(135deg,var(--pastel-blue),var(--pastel-green));">🤗</div>
              <div>
                <div class="testi-name">Farhan M.</div>
                <div class="testi-level">Level 6 · 25 buku</div>
              </div>
              <div class="testi-stars">⭐⭐⭐⭐⭐</div>
            </div>
            <div class="testi-text">"Koleksinya lengkap, tampilan aplikasinya lucu dan menyenangkan. Streak 30 hari, hadiahnya keren!"</div>
          </div>
        </div>
      </div>

    </aside>
  </div>

  <!-- ═══ BIG CTA BANNER ═══════════════════════════════ -->
  <section class="cta-banner">
    <div class="cta-blob cb1"></div>
    <div class="cta-blob cb2"></div>
    <div class="cta-content">
      <svg class="cta-mascot" viewBox="0 0 160 160" xmlns="http://www.w3.org/2000/svg">
        <rect x="22" y="28" width="116" height="108" rx="14" fill="rgba(255,255,255,0.9)"/>
        <rect x="22" y="28" width="22" height="108" rx="10" fill="rgba(255,255,255,0.7)"/>
        <rect x="52" y="48" width="72" height="5" rx="3" fill="rgba(124,92,191,0.3)"/>
        <rect x="52" y="60" width="60" height="5" rx="3" fill="rgba(124,92,191,0.3)"/>
        <rect x="52" y="72" width="68" height="5" rx="3" fill="rgba(124,92,191,0.3)"/>
        <circle cx="64" cy="98" r="10" fill="#7C5CBF"/>
        <circle cx="64" cy="98" r="6"  fill="#3D3250"/>
        <circle cx="66" cy="96" r="2"  fill="white"/>
        <circle cx="96" cy="98" r="10" fill="#7C5CBF"/>
        <circle cx="96" cy="98" r="6"  fill="#3D3250"/>
        <circle cx="98" cy="96" r="2"  fill="white"/>
        <path d="M68 112 Q80 122 92 112" stroke="#3D3250" stroke-width="3.5" fill="none" stroke-linecap="round"/>
        <ellipse cx="55"  cy="110" rx="7" ry="5" fill="#FFACC7" opacity="0.8"/>
        <ellipse cx="105" cy="110" rx="7" ry="5" fill="#FFACC7" opacity="0.8"/>
        <rect x="118" y="56" width="12" height="48" rx="6" fill="rgba(181,234,215,0.8)"/>
      </svg>
      <h2 class="cta-title">Siap Mulai Petualangan Membacamu?</h2>
      <p class="cta-sub">Bergabunglah dengan 12.000+ pembaca aktif. Daftar gratis dalam 30 detik — tidak perlu kartu kredit!</p>
      <div class="cta-actions">
        <button class="cta-btn-main" onclick="openModal()">🚀 Daftar Sekarang — Gratis!</button>
        <button class="cta-btn-sec"  onclick="openModal()">🔑 Sudah Punya Akun</button>
      </div>
      <div class="cta-note">✅ Gratis selamanya &nbsp;·&nbsp; 📚 1.240+ buku &nbsp;·&nbsp; 🏆 Sistem XP & Reward</div>
    </div>
  </section>

  <!-- ═══ FOOTER ═══════════════════════════════════════ -->
  <footer class="footer">
    <div class="footer-logo">Read<span>Point</span></div>
    <div class="footer-text">© 2026 ReadPoint · Membangun budaya membaca bersama 📚</div>
    <div class="footer-links">
      <a href="#">Tentang</a>
      <a href="#">Bantuan</a>
      <a href="#">Kebijakan</a>
      <a href="#">Kontak</a>
    </div>
  </footer>

  <!-- ═══ MODAL LOGIN/DAFTAR ═══════════════════════════ -->
  <div class="modal-overlay" id="modalOverlay" onclick="closeModalOutside(event)">
    <div class="modal">
      <div class="modal-icon">📚</div>
      <div class="modal-title">Gabung ReadPoint!</div>
      <div class="modal-sub">Daftar gratis dan mulai perjalanan membacamu. Kumpulkan XP, raih streak, pinjam ribuan buku!</div>
      <button class="modal-btn-main" onclick="showToast('🚀 Menuju halaman pendaftaran...');closeModal()">🚀 Daftar Gratis Sekarang</button>
      <button class="modal-btn-sec"  onclick="showToast('🔑 Menuju halaman login...');closeModal()">🔑 Masuk ke Akunmu</button>
      <span class="modal-close" onclick="closeModal()">Lanjutkan sebagai tamu</span>
    </div>
  </div>

  <!-- ═══ TOAST ════════════════════════════════════════ -->
  <div class="toast" id="toast">📚 Notifikasi</div>

  <script>
    function setActive(el) {
      document.querySelectorAll('.cat-pill').forEach(p => p.classList.remove('active'));
      el.classList.add('active');
    }

    let toastTimer;
    function showToast(msg) {
      const t = document.getElementById('toast');
      t.textContent = msg;
      t.classList.add('show');
      clearTimeout(toastTimer);
      toastTimer = setTimeout(() => t.classList.remove('show'), 2800);
    }

    function openModal() {
      document.getElementById('modalOverlay').classList.add('open');
      document.body.style.overflow = 'hidden';
    }
    function closeModal() {
      document.getElementById('modalOverlay').classList.remove('open');
      document.body.style.overflow = '';
    }
    function closeModalOutside(e) {
      if (e.target === document.getElementById('modalOverlay')) closeModal();
    }

    // Animate book cards on scroll
    const observer = new IntersectionObserver((entries) => {
      entries.forEach(e => {
        if (e.isIntersecting) {
          e.target.style.opacity = '1';
          e.target.style.transform = 'translateY(0)';
        }
      });
    }, { threshold: 0.1 });

    document.querySelectorAll('.book-card').forEach((card, i) => {
      card.style.opacity = '0';
      card.style.transform = 'translateY(28px)';
      card.style.transition = `opacity 0.45s ease ${i*0.09}s, transform 0.45s cubic-bezier(.36,1.56,.64,1) ${i*0.09}s`;
      observer.observe(card);
    });

    // Auto trigger modal after 8 seconds for guest
    setTimeout(() => {
      showToast('👋 Daftar gratis untuk akses penuh!');
    }, 8000);
  </script>
</body>
</html>