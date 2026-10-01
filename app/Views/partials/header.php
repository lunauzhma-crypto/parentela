<header class="main-header">
    <div class="header-container">

        <!-- Logo -->
        <div class="logo">
            <a href="<?= base_url('/') ?>">Parentela</a>
        </div>

        <!-- Menu Navigasi Tengah -->
        <nav class="main-nav">
            <ul>
                <!-- 2. Artikel & Panduan Edukasi (8 Kategori Web Artikel) -->
                <li class="has-dropdown">
                    <a href="<?= base_url('articles') ?>" class="dropdown-trigger">Artikel ▾</a>
                    <ul class="dropdown-menu dropdown-menu-articles">
                        <li>
                            <a href="<?= base_url('articles') ?>">
                                <span class="drop-icon">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                        <rect x="3" y="3" width="7" height="7" rx="1.5" />
                                        <circle cx="17.5" cy="6.5" r="3.5" />
                                        <polygon points="6.5,14 10,21 3,21" />
                                        <rect x="14" y="14" width="7" height="7" rx="1.5" />
                                    </svg>
                                </span>
                                <div class="drop-text">
                                    <strong>Semua Kategori</strong>
                                    <small>Koleksi lengkap artikel & panduan</small>
                                </div>
                            </a>
                        </li>
                        <li class="dropdown-divider" style="margin: 4px 8px; border-bottom: 1px solid #F5ECE8;"></li>
                        <li>
                            <a href="<?= base_url('articles/kategori/tumbuh-kembang') ?>">
                                <span class="drop-icon">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                        <polyline points="22 7 13.5 15.5 8.5 10.5 2 17"></polyline>
                                        <polyline points="16 7 22 7 22 13"></polyline>
                                    </svg>
                                </span>
                                <div class="drop-text">
                                    <strong>Tumbuh Kembang</strong>
                                    <small>Milestone fisik, motorik & kognitif</small>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="<?= base_url('articles/kategori/kesehatan') ?>">
                                <span class="drop-icon">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                                        <polyline points="7 12 10 12 11 9 13 15 14 12 17 12"></polyline>
                                    </svg>
                                </span>
                                <div class="drop-text">
                                    <strong>Kesehatan</strong>
                                    <small>Perawatan medis dasar & imunisasi</small>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="<?= base_url('articles/kategori/kebutuhan-khusus') ?>">
                                <span class="drop-icon">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                        <circle cx="9" cy="7" r="4"></circle>
                                        <path d="M3 21v-2a4 4 0 0 1 4-4h4a4 4 0 0 1 4 4v2"></path>
                                        <circle cx="18" cy="11" r="3"></circle>
                                        <path d="M15 21v-1.5a3 3 0 0 1 3-3h1"></path>
                                    </svg>
                                </span>
                                <div class="drop-text">
                                    <strong>Kebutuhan Khusus</strong>
                                    <small>Pendampingan anak istimewa</small>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="<?= base_url('articles/kategori/kebugaran') ?>">
                                <span class="drop-icon">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                        <circle cx="12" cy="5" r="2.5"></circle>
                                        <path d="M6 21v-5l3-3 2 4 4-6 3 2"></path>
                                        <path d="M12 11l2-3 4 1"></path>
                                    </svg>
                                </span>
                                <div class="drop-text">
                                    <strong>Kebugaran</strong>
                                    <small>Aktivitas fisik & stimulasi gerak</small>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="<?= base_url('articles/kategori/parenting') ?>">
                                <span class="drop-icon">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"></path>
                                    </svg>
                                </span>
                                <div class="drop-text">
                                    <strong>Parenting</strong>
                                    <small>Pola asuh, relasi & psikologi anak</small>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="<?= base_url('articles/kategori/gaya-hidup') ?>">
                                <span class="drop-icon">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                        <rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect>
                                        <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path>
                                    </svg>
                                </span>
                                <div class="drop-text">
                                    <strong>Gaya Hidup</strong>
                                    <small>Nutrisi, resep & rutinitas harian</small>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="<?= base_url('articles/kategori/video-aman') ?>">
                                <span class="drop-icon">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                        <rect x="2" y="4" width="20" height="15" rx="2"></rect>
                                        <polygon points="10 9 15 12 10 15 10 9" fill="currentColor"></polygon>
                                        <line x1="8" y1="21" x2="16" y2="21"></line>
                                    </svg>
                                </span>
                                <div class="drop-text">
                                    <strong>Video Aman Anak</strong>
                                    <small>Tontonan edukatif & ramah anak</small>
                                </div>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- 3 & 4. Direktori Terpadu (Tempat Asuh & Pendidikan) -->
                <li class="has-dropdown has-mega-dropdown">
                    <a href="#" class="dropdown-trigger">Direktori ▾</a>
                    <div class="dropdown-menu dropdown-mega">
                        <!-- Kolom 1: Tempat Asuh -->
                        <div class="mega-column">
                            <div class="mega-col-header">
                                <span class="mega-col-icon">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                                </span>
                                <div>
                                    <h4>Tempat Asuh</h4>
                                    <span>Penitipan & ruang aman anak</span>
                                </div>
                            </div>
                            <ul class="mega-link-list">
                                <li>
                                    <a href="<?= base_url('tempat-asuh/panti-asuhan') ?>">
                                        <span class="mega-dot"></span>
                                        <div>
                                            <strong>Panti Asuhan & Sosial</strong>
                                            <small>Lembaga kesejahteraan anak</small>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?= base_url('tempat-asuh/daycare') ?>">
                                        <span class="mega-dot"></span>
                                        <div>
                                            <strong>Daycare & Penitipan</strong>
                                            <small>Penitipan harian terpercaya</small>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?= base_url('tempat-asuh/nursery-playground') ?>">
                                        <span class="mega-dot"></span>
                                        <div>
                                            <strong>Nursery & Playground</strong>
                                            <small>Ruang laktasi & arena bermain</small>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?= base_url('tempat-asuh/taman-bacaan') ?>">
                                        <span class="mega-dot"></span>
                                        <div>
                                            <strong>Taman Bacaan Masyarakat</strong>
                                            <small>Pojok baca & literasi anak</small>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <!-- Kolom 2: Pendidikan -->
                        <div class="mega-column">
                            <div class="mega-col-header">
                                <span class="mega-col-icon">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 10l10-5 10 5-10 5z"/><path d="M6 12.5V16c0 2.2 2.7 4 6 4s6-1.8 6-4v-3.5"/><path d="M22 10v6"/></svg>
                                </span>
                                <div>
                                    <h4>Pendidikan</h4>
                                    <span>Jalur formal & nonformal</span>
                                </div>
                            </div>
                            <ul class="mega-link-list">
                                <li>
                                    <a href="<?= base_url('pendidikan/formal') ?>">
                                        <span class="mega-dot"></span>
                                        <div>
                                            <strong>Pendidikan Formal</strong>
                                            <small>TK, SD, & Sekolah Umum</small>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?= base_url('pendidikan/nonformal') ?>">
                                        <span class="mega-dot"></span>
                                        <div>
                                            <strong>Nonformal (Preschool & PAUD)</strong>
                                            <small>Stimulasi usia dini & bermain</small>
                                        </div>
                                    </a>
                                </li>

                            </ul>
                        </div>
                    </div>
                </li>

                <!-- Nanny -->
                <li>
                    <a href="<?= base_url('nanny') ?>">Nanny</a>
                </li>

                <!-- Perencanaan Keluarga -->
                <li>
                    <a href="<?= base_url('perencanaan-keluarga') ?>">Perencanaan Keluarga</a>
                </li>

                <!-- Menu -->
                <li>
                    <a href="<?= base_url('menu') ?>">Menu</a>
                </li>

                <!-- 5. Kewenangan & Perlindungan Ibu-Anak -->
                <li>
                    <a href="<?= base_url('kewenangan') ?>">Kewenangan</a>
                </li>

                <!-- 6. Toko Parentela -->
                <li>
                    <a href="<?= base_url('shop') ?>">Toko</a>
                </li>

                <!-- 7. Tentang Kami -->
                <li>
                    <a href="<?= base_url('about-us') ?>">Tentang Kami</a>
                </li>
            </ul>
        </nav>

        <!-- Kanan: Search, Bahasa, Profile -->
        <div class="header-right">
            <!-- Global Search Form Trigger in Header -->
            <form action="<?= base_url('search') ?>" method="get" class="header-search-form" style="display: flex; align-items: center; background: #FFF7ED; border: 1px solid #FFEDD5; border-radius: 20px; padding: 4px 12px; margin-right: 8px;">
                <input type="text" name="q" placeholder="Cari..." style="border: none; background: transparent; outline: none; font-size: 0.82rem; width: 90px; color: #431407; font-family: 'Outfit', sans-serif;">
                <button type="submit" aria-label="Cari" style="background: none; border: none; cursor: pointer; color: #EA580C; display: flex; align-items: center; padding: 0;">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                </button>
            </form>

            <!-- Language Switcher -->
            <div class="language-switcher">
                <select onchange="location = this.value;">
                    <option value="?lang=id">ID</option>
                    <option value="?lang=en">EN</option>
                </select>
            </div>

            <!-- Profile Icon (Avatar) with Dropdown Menu -->
            <div class="user-profile has-dropdown" id="headerUserProfile">
                <?php 
                    $isUserLoggedIn   = (bool) session()->get('is_logged_in');
                    $activeUserName   = session()->get('user_name') ?? 'Ayah & Bunda';
                    $activeUserRole   = session()->get('role') ?? 'user';
                    $activeUserAvatar = session()->get('user_avatar') ?? null;
                ?>
                <button type="button" class="avatar-link" aria-label="Menu Akun & Profil" id="profileDropdownBtn" aria-expanded="false" onclick="toggleProfileDropdown(event)">
                    <?php if ($activeUserAvatar && file_exists(FCPATH . $activeUserAvatar)): ?>
                        <img src="<?= base_url($activeUserAvatar) ?>" alt="Avatar" style="width: 28px; height: 28px; border-radius: 50%; object-fit: cover; border: 2px solid var(--color-primary); box-shadow: 0 2px 6px rgba(0,0,0,0.15);">
                    <?php else: ?>
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="color: var(--color-primary);">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
                            <circle cx="12" cy="7" r="4" />
                        </svg>
                    <?php endif; ?>
                    <?php if ($isUserLoggedIn): ?>
                        <span class="avatar-online-dot" title="Akun Aktif"></span>
                    <?php endif; ?>
                </button>

                <!-- Profile Dropdown Menu -->
                <div class="profile-dropdown-menu" id="headerProfileDropdownMenu" role="menu" aria-labelledby="profileDropdownBtn">
                    <?php if ($isUserLoggedIn): ?>
                        <!-- Mode Pengguna Sudah Login -->
                        <div class="profile-dropdown-header">
                            <div class="profile-user-avatar" style="overflow: hidden;">
                                <?php if ($activeUserAvatar && file_exists(FCPATH . $activeUserAvatar)): ?>
                                    <img src="<?= base_url($activeUserAvatar) ?>" alt="Avatar" style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%;">
                                <?php else: ?>
                                    <span>
                                        <?php if ($activeUserRole === 'admin'): ?>
                                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                                        <?php else: ?>
                                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg>
                                        <?php endif; ?>
                                    </span>
                                <?php endif; ?>
                            </div>
                            <div class="profile-user-info">
                                <strong><?= esc($activeUserName) ?></strong>
                                <small><?= $activeUserRole === 'admin' ? 'Administrator' : 'Keluarga Parentela' ?></small>
                            </div>
                        </div>
                        <ul class="profile-dropdown-links">
                            <li>
                                <a href="<?= base_url('profile') ?>">
                                    <span class="menu-icon">
                                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
                                            <circle cx="12" cy="7" r="4" />
                                        </svg>
                                    </span>
                                    <span>Profil</span>
                                </a>
                            </li>
                            <li class="dropdown-divider"></li>
                            <li>
                                <a href="<?= base_url('logout') ?>" class="logout-link">
                                    <span class="menu-icon">
                                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
                                    </span>
                                    <span>Keluar (Logout)</span>
                                </a>
                            </li>
                        </ul>
                    <?php else: ?>
                        <!-- Mode Tamu: Opsi Sudah Memiliki Akun atau Belum -->
                        <div class="profile-guest-card">
                            <div class="guest-card-header">
                                <span class="guest-badge">Akun Parentela</span>
                                <h4>Akses Fitur Keluarga</h4>
                                <p>Simpan catatan tumbuh kembang buah hati dan dapatkan panduan pengasuhan terpercaya.</p>
                            </div>

                            <!-- Opsi 1: Sudah Memiliki Akun -->
                            <div class="profile-action-group">
                                <span class="action-question">Sudah memiliki akun?</span>
                                <a href="<?= base_url('login') ?>" class="btn-profile-login" style="background: linear-gradient(135deg, #BC4F4F, #E98B50); color: #ffffff !important;">
                                    <span style="color: #ffffff !important; font-weight: 600;">Masuk ke Akun</span>
                                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                        <line x1="5" y1="12" x2="19" y2="12"></line>
                                        <polyline points="12 5 19 12 12 19"></polyline>
                                    </svg>
                                </a>
                            </div>

                            <div class="profile-divider">
                                <span>atau</span>
                            </div>

                            <!-- Opsi 2: Belum Memiliki Akun -->
                            <div class="profile-action-group">
                                <span class="action-question">Belum memiliki akun?</span>
                                <a href="<?= base_url('login?mode=register') ?>" class="btn-profile-register">
                                    <span>Daftar Akun Baru</span>
                                    <span class="free-pill">Gratis</span>
                                </a>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

    </div>

    <!-- Scoped Style Protection untuk Tombol Profil -->
    <style>
        .btn-profile-login, 
        .btn-profile-login:visited {
            background-color: #BC4F4F !important;
            background-image: linear-gradient(135deg, #BC4F4F 0%, #E98B50 100%) !important;
            color: #ffffff !important;
            text-decoration: none !important;
        }
        .btn-profile-login:hover,
        .btn-profile-login:focus,
        .btn-profile-login:active {
            background-color: #9E3E3E !important;
            background-image: linear-gradient(135deg, #9E3E3E 0%, #BC4F4F 100%) !important;
            color: #ffffff !important;
            box-shadow: 0 6px 16px rgba(188, 79, 79, 0.38) !important;
            transform: translateY(-1px);
        }
        .btn-profile-login span {
            color: #ffffff !important;
        }
        .btn-profile-login svg {
            stroke: #ffffff !important;
        }
    </style>

    <!-- Script Interaktif Toggle Profile Dropdown -->
    <script>
        function toggleProfileDropdown(event) {
            event.stopPropagation();
            const wrapper = document.getElementById('headerUserProfile');
            const btn = document.getElementById('profileDropdownBtn');
            if (!wrapper) return;

            const isExpanded = wrapper.classList.toggle('active');
            if (btn) {
                btn.setAttribute('aria-expanded', isExpanded ? 'true' : 'false');
            }
        }

        // Tutup dropdown saat klik di luar area
        document.addEventListener('click', function(e) {
            const wrapper = document.getElementById('headerUserProfile');
            const btn = document.getElementById('profileDropdownBtn');
            if (wrapper && !wrapper.contains(e.target)) {
                wrapper.classList.remove('active');
                if (btn) btn.setAttribute('aria-expanded', 'false');
            }
        });

        // Tutup dropdown dengan tombol Escape
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                const wrapper = document.getElementById('headerUserProfile');
                const btn = document.getElementById('profileDropdownBtn');
                if (wrapper && wrapper.classList.contains('active')) {
                    wrapper.classList.remove('active');
                    if (btn) {
                        btn.setAttribute('aria-expanded', 'false');
                        btn.focus();
                    }
                }
            }
        });
    </script>
</header>