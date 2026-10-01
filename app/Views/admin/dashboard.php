<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'Portal Admin Parentela') ?></title>
    <!-- Google Fonts & FontAwesome -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --admin-bg: #f4f6f9;
            --sidebar-bg: #1e293b;
            --sidebar-active: #a84b4b;
            --text-main: #334155;
            --card-bg: #ffffff;
            --primary: #a84b4b;
            --primary-hover: #8f3d3d;
            --accent-gold: #eab308;
            --border-color: #e2e8f0;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        body {
            background-color: var(--admin-bg);
            color: var(--text-main);
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar Styles */
        .admin-sidebar {
            width: 270px;
            background: var(--sidebar-bg);
            color: #f8fafc;
            display: flex;
            flex-direction: column;
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            z-index: 100;
            box-shadow: 4px 0 20px rgba(0,0,0,0.1);
        }

        .sidebar-brand {
            padding: 24px 20px;
            border-bottom: 1px solid rgba(255,255,255,0.08);
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .sidebar-brand h2 {
            font-family: 'Playfair Display', serif;
            font-size: 22px;
            color: #fff;
            letter-spacing: 0.5px;
        }

        .sidebar-brand span {
            background: #a84b4b;
            color: #fff;
            font-size: 10px;
            font-weight: 800;
            padding: 2px 8px;
            border-radius: 6px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .sidebar-menu {
            list-style: none;
            padding: 20px 12px;
            flex: 1;
            overflow-y: auto;
        }

        .sidebar-menu li {
            margin-bottom: 6px;
        }

        .sidebar-menu a {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 12px 16px;
            color: #94a3b8;
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
            border-radius: 10px;
            transition: all 0.2s ease;
        }

        .sidebar-menu a:hover,
        .sidebar-menu a.active {
            color: #ffffff;
            background: rgba(168, 75, 75, 0.85);
            box-shadow: 0 4px 12px rgba(168, 75, 75, 0.3);
        }

        .sidebar-menu a i {
            font-size: 16px;
            width: 20px;
            text-align: center;
        }

        .sidebar-footer {
            padding: 16px 20px;
            border-top: 1px solid rgba(255,255,255,0.08);
        }

        .admin-user-card {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .admin-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #a84b4b;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 16px;
        }

        .admin-info {
            flex: 1;
            min-width: 0;
        }

        .admin-info p {
            font-size: 13px;
            font-weight: 700;
            color: #fff;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .admin-info span {
            font-size: 11px;
            color: #94a3b8;
        }

        /* Main Content Area */
        .admin-main {
            margin-left: 270px;
            flex: 1;
            display: flex;
            flex-direction: column;
            min-width: 0;
        }

        /* Top Header */
        .admin-header {
            height: 70px;
            background: #ffffff;
            border-bottom: 1px solid var(--border-color);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 30px;
            position: sticky;
            top: 0;
            z-index: 90;
        }

        .header-title h1 {
            font-size: 20px;
            font-weight: 700;
            color: #0f172a;
        }

        .header-actions {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .btn-view-site {
            background: #f1f5f9;
            color: #334155;
            padding: 8px 16px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 13px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.2s;
        }

        .btn-view-site:hover {
            background: #e2e8f0;
        }

        .btn-logout {
            background: #fee2e2;
            color: #dc2626;
            padding: 8px 16px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 13px;
            font-weight: 600;
            transition: all 0.2s;
        }

        .btn-logout:hover {
            background: #fca5a5;
        }

        /* Content Container */
        .content-body {
            padding: 30px;
            flex: 1;
        }

        /* Flash Message Alerts */
        .alert-success {
            background: #dcfce7;
            color: #15803d;
            padding: 14px 20px;
            border-radius: 10px;
            border: 1px solid #bbf7d0;
            margin-bottom: 25px;
            font-weight: 600;
            font-size: 14px;
        }

        /* Stats Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: #fff;
            padding: 22px;
            border-radius: 16px;
            border: 1px solid var(--border-color);
            box-shadow: 0 4px 12px rgba(0,0,0,0.03);
            display: flex;
            align-items: center;
            gap: 18px;
        }

        .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
        }

        .icon-dir { background: #fee2e2; color: #a84b4b; }
        .icon-ver { background: #dcfce7; color: #16a34a; }
        .icon-nan { background: #e0f2fe; color: #0284c7; }
        .icon-art { background: #fef3c7; color: #d97706; }

        .stat-info h3 {
            font-size: 24px;
            font-weight: 800;
            color: #0f172a;
        }

        .stat-info p {
            font-size: 13px;
            color: #64748b;
            font-weight: 500;
        }

        /* Tables & Cards Container */
        .panel-card {
            background: #fff;
            border-radius: 16px;
            border: 1px solid var(--border-color);
            box-shadow: 0 4px 16px rgba(0,0,0,0.03);
            overflow: hidden;
            margin-bottom: 30px;
        }

        .panel-header {
            padding: 20px 24px;
            border-bottom: 1px solid var(--border-color);
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 15px;
        }

        .panel-header h2 {
            font-size: 18px;
            font-weight: 700;
            color: #0f172a;
        }

        .btn-primary {
            background: var(--primary);
            color: white;
            border: none;
            padding: 10px 18px;
            border-radius: 10px;
            font-weight: 600;
            font-size: 13px;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: background 0.2s;
        }

        .btn-primary:hover {
            background: var(--primary-hover);
        }

        /* Filter Pills */
        .filter-pills {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        .filter-pill {
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-decoration: none;
            background: #f1f5f9;
            color: #64748b;
            transition: all 0.2s;
        }

        .filter-pill.active,
        .filter-pill:hover {
            background: #a84b4b;
            color: #fff;
        }

        /* Data Table */
        .data-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
        }

        .data-table th {
            background: #f8fafc;
            padding: 14px 20px;
            text-align: left;
            font-weight: 700;
            color: #475569;
            border-bottom: 1px solid var(--border-color);
        }

        .data-table td {
            padding: 16px 20px;
            border-bottom: 1px solid var(--border-color);
            vertical-align: middle;
        }

        .data-table tr:hover {
            background: #f8fafc;
        }

        .thumb-preview {
            width: 60px;
            height: 45px;
            border-radius: 8px;
            object-fit: cover;
            background: #f1f5f9;
            display: block;
        }

        .no-photo-badge {
            width: 60px;
            height: 45px;
            border-radius: 8px;
            background: #fef2f2;
            border: 1px dashed #fca5a5;
            color: #dc2626;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 10px;
            font-weight: 700;
            text-align: center;
            line-height: 1.1;
        }

        .badge-status {
            padding: 4px 10px;
            border-radius: 12px;
            font-size: 11px;
            font-weight: 700;
            display: inline-block;
        }

        .badge-verified {
            background: #dcfce7;
            color: #15803d;
        }

        .badge-pending {
            background: #fef3c7;
            color: #b45309;
        }

        .action-btns {
            display: flex;
            gap: 8px;
        }

        .btn-sm {
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 600;
            text-decoration: none;
            border: none;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }

        .btn-edit { background: #e0f2fe; color: #0369a1; }
        .btn-verify { background: #dcfce7; color: #15803d; }
        .btn-unverify { background: #fef3c7; color: #b45309; }
        .btn-delete { background: #fee2e2; color: #b91c1c; }

        /* Modal Styles */
        .modal-backdrop {
            display: none;
            position: fixed;
            top: 0; left: 0; right: 0; bottom: 0;
            background: rgba(15, 23, 42, 0.6);
            backdrop-filter: blur(4px);
            z-index: 1000;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .modal-backdrop.active {
            display: flex;
        }

        .modal-box {
            background: white;
            border-radius: 20px;
            width: 100%;
            max-width: 680px;
            max-height: 90vh;
            overflow-y: auto;
            box-shadow: 0 20px 40px rgba(0,0,0,0.2);
        }

        .modal-header {
            padding: 20px 24px;
            border-bottom: 1px solid var(--border-color);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-header h3 {
            font-size: 18px;
            font-weight: 700;
            color: #0f172a;
        }

        .modal-close {
            background: none;
            border: none;
            font-size: 20px;
            color: #94a3b8;
            cursor: pointer;
        }

        .modal-body {
            padding: 24px;
        }

        .form-group {
            margin-bottom: 18px;
        }

        .form-group label {
            display: block;
            font-size: 13px;
            font-weight: 700;
            color: #334155;
            margin-bottom: 6px;
        }

        .form-control {
            width: 100%;
            padding: 10px 14px;
            border-radius: 8px;
            border: 1px solid var(--border-color);
            font-size: 14px;
            outline: none;
            transition: border-color 0.2s;
        }

        .form-control:focus {
            border-color: var(--primary);
        }

        textarea.form-control {
            min-height: 90px;
            resize: vertical;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }
    </style>
</head>
<body>

    <!-- Sidebar Navigation -->
    <aside class="admin-sidebar">
        <div class="sidebar-brand">
            <h2>Parentela</h2>
            <span>Admin</span>
        </div>
        <ul class="sidebar-menu">
            <li>
                <a href="<?= base_url('admin/dashboard') ?>" class="<?= $activeTab === 'dashboard' ? 'active' : '' ?>">
                    <i class="fas fa-chart-pie"></i> Ringkasan Dashboard
                </a>
            </li>
            <li>
                <a href="<?= base_url('admin/articles') ?>" class="<?= $activeTab === 'articles' ? 'active' : '' ?>">
                    <i class="fas fa-newspaper"></i> Artikel
                </a>
            </li>
            <li>
                <a href="<?= base_url('admin/directory') ?>" class="<?= $activeTab === 'directory' ? 'active' : '' ?>">
                    <i class="fas fa-home"></i> Tempat Asuh
                </a>
            </li>
            <li>
                <a href="<?= base_url('admin/education') ?>" class="<?= $activeTab === 'education' ? 'active' : '' ?>">
                    <i class="fas fa-school"></i> Pendidikan
                </a>
            </li>
            <li>
                <a href="<?= base_url('admin/toko') ?>" class="<?= $activeTab === 'toko' ? 'active' : '' ?>">
                    <i class="fas fa-shopping-bag"></i> Toko
                </a>
            </li>
        </ul>
        <div class="sidebar-footer">
            <div class="admin-user-card">
                <div class="admin-avatar">A</div>
                <div class="admin-info">
                    <p><?= esc(session()->get('user_name') ?? 'Administrator') ?></p>
                    <span><?= esc(session()->get('user_email') ?? 'admin@parentela.id') ?></span>
                </div>
            </div>
        </div>
    </aside>

    <!-- Main Content Area -->
    <main class="admin-main">
        <!-- Top Navbar -->
        <header class="admin-header">
            <div class="header-title">
                <h1>Portal Pengelolaan Administrator</h1>
            </div>
            <div class="header-actions">
                <a href="<?= base_url('/') ?>" target="_blank" class="btn-view-site">
                    <i class="fas fa-external-link-alt"></i> Lihat Situs Publik
                </a>
                <a href="<?= base_url('logout') ?>" class="btn-logout">
                    <i class="fas fa-sign-out-alt"></i> Keluar
                </a>
            </div>
        </header>

        <!-- Content Body -->
        <div class="content-body">
            
            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert-success">
                    <i class="fas fa-check-circle"></i> <?= session()->getFlashdata('success') ?>
                </div>
            <?php endif; ?>

            <!-- Metric Cards -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon icon-dir"><i class="fas fa-building"></i></div>
                    <div class="stat-info">
                        <h3><?= $totalDirectory ?></h3>
                        <p>Total Tempat Asuh</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon icon-ver"><i class="fas fa-check-circle"></i></div>
                    <div class="stat-info">
                        <h3><?= $totalVerified ?></h3>
                        <p>Tepat & Terverifikasi</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon icon-art"><i class="fas fa-file-alt"></i></div>
                    <div class="stat-info">
                        <h3><?= $totalArticles ?></h3>
                        <p>Artikel & Konten</p>
                    </div>
                </div>
            </div>

            <?php if ($activeTab === 'directory'): ?>
                <!-- TAB DIREKTORI TEMPAT ASUHAN -->
                <div class="panel-card">
                    <div class="panel-header">
                        <div>
                            <h2>Pengelolaan Tempat Asuh, Daycare & Fasilitas Anak</h2>
                            <p style="font-size: 13px; color: #64748b; margin-top: 4px;">Kelola data lokasi, status terverifikasi, dan unggah foto tempat.</p>
                        </div>
                        <div style="display: flex; gap: 12px; align-items: center;">
                            <div class="filter-pills">
                                <a href="<?= base_url('admin/directory?category=all') ?>" class="filter-pill <?= $activeCategory === 'all' ? 'active' : '' ?>">Semua</a>
                                <a href="<?= base_url('admin/directory?category=panti-asuhan') ?>" class="filter-pill <?= $activeCategory === 'panti-asuhan' ? 'active' : '' ?>">🏡 Panti Asuhan</a>
                                <a href="<?= base_url('admin/directory?category=daycare') ?>" class="filter-pill <?= $activeCategory === 'daycare' ? 'active' : '' ?>">🧸 Daycare</a>
                                <a href="<?= base_url('admin/directory?category=nursery-playground') ?>" class="filter-pill <?= $activeCategory === 'nursery-playground' ? 'active' : '' ?>">🎠 Nursery</a>
                                <a href="<?= base_url('admin/directory?category=taman-bacaan') ?>" class="filter-pill <?= $activeCategory === 'taman-bacaan' ? 'active' : '' ?>">📚 Taman Bacaan</a>
                            </div>
                            <button class="btn-primary" onclick="openDirectoryModal()">
                                <i class="fas fa-plus"></i> Tambah Tempat
                            </button>
                        </div>
                    </div>

                    <div style="overflow-x: auto;">
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th>Foto</th>
                                    <th>Nama Tempat</th>
                                    <th>Kategori</th>
                                    <th>Lokasi</th>
                                    <th>Verifikasi</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($directories)): ?>
                                    <?php foreach ($directories as $place): ?>
                                        <tr>
                                            <td>
                                                <?php if (!empty($place['foto_utama'])): ?>
                                                    <img src="<?= (strpos($place['foto_utama'], 'http') === 0) ? esc($place['foto_utama']) : base_url($place['foto_utama']) ?>" class="thumb-preview" alt="Foto">
                                                <?php else: ?>
                                                    <div class="no-photo-badge">📷 Belum Ada</div>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <strong><?= esc($place['nama']) ?></strong>
                                                <div style="font-size: 11px; color: #888;"><?= esc($place['slug']) ?></div>
                                            </td>
                                            <td>
                                                <span style="font-size: 12px; font-weight: 600; text-transform: uppercase; background: #f1f5f9; padding: 4px 8px; border-radius: 6px;">
                                                    <?= esc($place['category']) ?>
                                                </span>
                                            </td>
                                            <td style="font-size: 13px; color: #475569; max-width: 220px;">
                                                <?= esc($place['lokasi']) ?>
                                            </td>
                                            <td>
                                                <?php if (!empty($place['is_verified']) && $place['is_verified'] == 1): ?>
                                                    <span class="badge-status badge-verified">✔ Terverifikasi</span>
                                                <?php else: ?>
                                                    <span class="badge-status badge-pending">Belum Verifikasi</span>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <div class="action-btns">
                                                    <a href="<?= base_url('admin/directory/toggle-verify/' . $place['id']) ?>" class="btn-sm <?= $place['is_verified'] ? 'btn-unverify' : 'btn-verify' ?>" title="Ubah Status Verifikasi">
                                                        <i class="fas fa-shield-alt"></i> <?= $place['is_verified'] ? 'Unverify' : 'Verifikasi' ?>
                                                    </a>
                                                    <button class="btn-sm btn-edit" onclick='editDirectory(<?= json_encode($place) ?>)'>
                                                        <i class="fas fa-edit"></i> Edit / Unggah
                                                    </button>
                                                    <a href="<?= base_url('admin/directory/delete/' . $place['id']) ?>" class="btn-sm btn-delete" onclick="return confirm('Apakah Anda yakin ingin menghapus tempat ini?')">
                                                        <i class="fas fa-trash"></i> Hapus
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="6" style="text-align: center; color: #94a3b8; padding: 30px;">
                                            Belum ada tempat terdaftar pada kategori ini.
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            <?php endif; ?>

            <?php if ($activeTab === 'education'): ?>
                <!-- TAB DIREKTORI PENDIDIKAN -->
                <div class="panel-card">
                    <div class="panel-header">
                        <div>
                            <h2>Pengelolaan Direktori Pendidikan</h2>
                            <p style="font-size: 13px; color: #64748b; margin-top: 4px;">Kelola data sekolah, TK, PAUD, SD, dan lembaga pendidikan anak lainnya.</p>
                        </div>
                        <div style="display: flex; gap: 12px; align-items: center;">
                            <div class="filter-pills" style="flex-wrap: wrap; gap: 6px;">
                                <a href="<?= base_url('admin/education?category=all') ?>" class="filter-pill <?= ($activeEduCategory ?? 'all') === 'all' ? 'active' : '' ?>">Semua</a>
                                <a href="<?= base_url('admin/education?category=formal') ?>" class="filter-pill <?= ($activeEduCategory ?? '') === 'formal' ? 'active' : '' ?>" style="border: 1px solid #bae6fd;">🏫 Formal</a>
                                <a href="<?= base_url('admin/education?category=nonformal') ?>" class="filter-pill <?= ($activeEduCategory ?? '') === 'nonformal' ? 'active' : '' ?>" style="border: 1px solid #fde68a;">🧸 Nonformal / Informal</a>
                                <a href="<?= base_url('admin/education?category=paud') ?>" class="filter-pill <?= ($activeEduCategory ?? '') === 'paud' ? 'active' : '' ?>">🌱 PAUD</a>
                                <a href="<?= base_url('admin/education?category=tk') ?>" class="filter-pill <?= ($activeEduCategory ?? '') === 'tk' ? 'active' : '' ?>">🏫 TK</a>
                                <a href="<?= base_url('admin/education?category=sd') ?>" class="filter-pill <?= ($activeEduCategory ?? '') === 'sd' ? 'active' : '' ?>">📖 SD</a>
                                <a href="<?= base_url('admin/education?category=smp') ?>" class="filter-pill <?= ($activeEduCategory ?? '') === 'smp' ? 'active' : '' ?>">🏫 SMP</a>
                                <a href="<?= base_url('admin/education?category=sma') ?>" class="filter-pill <?= ($activeEduCategory ?? '') === 'sma' ? 'active' : '' ?>">🎓 SMA</a>
                                <a href="<?= base_url('admin/education?category=slb') ?>" class="filter-pill <?= ($activeEduCategory ?? '') === 'slb' ? 'active' : '' ?>">♿ SLB</a>
                                <a href="<?= base_url('admin/education?category=preschool') ?>" class="filter-pill <?= ($activeEduCategory ?? '') === 'preschool' ? 'active' : '' ?>">🧩 Preschool</a>
                                <a href="<?= base_url('admin/education?category=kelompok-bermain') ?>" class="filter-pill <?= ($activeEduCategory ?? '') === 'kelompok-bermain' ? 'active' : '' ?>">🎠 KB</a>
                                <a href="<?= base_url('admin/education?category=bimbel') ?>" class="filter-pill <?= ($activeEduCategory ?? '') === 'bimbel' ? 'active' : '' ?>">📚 Bimbel</a>
                                <a href="<?= base_url('admin/education?category=sanggar') ?>" class="filter-pill <?= ($activeEduCategory ?? '') === 'sanggar' ? 'active' : '' ?>">🎨 Sanggar</a>
                            </div>
                            <button class="btn-primary" onclick="openEducationModal()">
                                <i class="fas fa-plus"></i> Tambah Lembaga
                            </button>
                        </div>
                    </div>
                    <div style="overflow-x: auto;">
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th>Foto</th>
                                    <th>Nama Lembaga</th>
                                    <th>Jalur &amp; Kategori</th>
                                    <th>Lokasi</th>
                                    <th>Verifikasi</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($educations)): ?>
                                    <?php foreach ($educations as $edu): ?>
                                        <tr>
                                            <td>
                                                <?php if (!empty($edu['foto_utama'])): ?>
                                                    <img src="<?= (strpos($edu['foto_utama'], 'http') === 0) ? esc($edu['foto_utama']) : base_url($edu['foto_utama']) ?>" class="thumb-preview" alt="Foto">
                                                <?php else: ?>
                                                    <div class="no-photo-badge">📷 Belum Ada</div>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <strong><?= esc($edu['nama']) ?></strong>
                                                <div style="font-size: 11px; color: #888;"><?= esc($edu['slug']) ?></div>
                                            </td>
                                            <td>
                                                <?php
                                                    $isFormal = in_array(strtolower($edu['category'] ?? ''), ['tk', 'sd', 'smp', 'sma', 'smk', 'slb', 'formal']);
                                                    $eduCatLabels = [
                                                        'paud'             => '🌱 PAUD',
                                                        'tk'               => '🏫 TK',
                                                        'sd'               => '📖 SD',
                                                        'smp'              => '🏫 SMP',
                                                        'sma'              => '🎓 SMA/SMK',
                                                        'smk'              => '🎓 SMA/SMK',
                                                        'slb'              => '♿ SLB',
                                                        'preschool'        => '🧩 Preschool',
                                                        'kelompok-bermain' => '🎠 KB',
                                                        'bimbel'           => '📚 Bimbel',
                                                        'sanggar'          => '🎨 Sanggar / Kursus'
                                                    ];
                                                    $catLabel = $eduCatLabels[$edu['category']] ?? ucfirst($edu['category']);
                                                ?>
                                                <div style="display: flex; gap: 4px; align-items: center; flex-wrap: wrap; margin-bottom: 4px;">
                                                    <span style="font-size: 10px; font-weight: 700; background: <?= $isFormal ? '#e0f2fe' : '#fef3c7' ?>; color: <?= $isFormal ? '#0369a1' : '#b45309' ?>; padding: 2px 6px; border-radius: 4px;">
                                                        <?= $isFormal ? '🏫 FORMAL' : '🧸 NONFORMAL' ?>
                                                    </span>
                                                    <span style="font-size: 11px; font-weight: 600; background: #f1f5f9; color: #475569; padding: 2px 6px; border-radius: 4px;">
                                                        <?= esc($catLabel) ?>
                                                    </span>
                                                </div>
                                                <?php if (!empty($edu['akreditasi'])): ?>
                                                    <div style="margin-top: 2px;"><span style="font-size: 11px; background: #dcfce7; color: #15803d; padding: 2px 6px; border-radius: 4px; font-weight: 600;">⭐ <?= esc($edu['akreditasi']) ?></span></div>
                                                <?php endif; ?>
                                                <?php if (!empty($edu['kurikulum'])): ?>
                                                    <div style="font-size: 11px; color: #64748b; margin-top: 2px;">📚 <?= esc($edu['kurikulum']) ?></div>
                                                <?php endif; ?>
                                            </td>
                                            <td style="font-size: 13px; color: #475569; max-width: 220px;"><?= esc($edu['lokasi']) ?></td>
                                            <td>
                                                <?php if (!empty($edu['is_verified']) && $edu['is_verified'] == 1): ?>
                                                    <span class="badge-status badge-verified">✔ Terverifikasi</span>
                                                <?php else: ?>
                                                    <span class="badge-status badge-pending">Belum Verifikasi</span>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <div class="action-btns">
                                                    <a href="<?= base_url('admin/education/toggle-verify/' . $edu['id']) ?>" class="btn-sm <?= $edu['is_verified'] ? 'btn-unverify' : 'btn-verify' ?>">
                                                        <i class="fas fa-shield-alt"></i> <?= $edu['is_verified'] ? 'Unverify' : 'Verifikasi' ?>
                                                    </a>
                                                    <button class="btn-sm btn-edit" onclick='editEducation(<?= json_encode($edu) ?>)'>
                                                        <i class="fas fa-edit"></i> Edit
                                                    </button>
                                                    <a href="<?= base_url('admin/education/delete/' . $edu['id']) ?>" class="btn-sm btn-delete" onclick="return confirm('Hapus lembaga pendidikan ini?')">
                                                        <i class="fas fa-trash"></i> Hapus
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="6" style="text-align: center; color: #94a3b8; padding: 30px;">
                                            Belum ada lembaga pendidikan yang terdaftar pada kategori ini.
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            <?php endif; ?>


            <?php if ($activeTab === 'articles'): ?>
                <!-- TAB PENGELOLAAN & PENINJAUAN ARTIKEL -->
                <div class="panel-card">
                    <div class="panel-header">
                        <div>
                            <h2>Pengelolaan & Peninjauan Artikel Parentela</h2>
                            <p style="font-size: 13px; color: #64748b; margin-top: 4px;">Tinjau pengajuan artikel dari pengguna atau tambahkan artikel baru oleh tim Redaksi Administrator.</p>
                        </div>
                        <button class="btn-primary" onclick="openArticleModal()">
                            <i class="fas fa-plus"></i> Tambah Artikel Baru
                        </button>
                    </div>

                    <div style="overflow-x: auto;">
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th>Sampul</th>
                                    <th>Judul Artikel</th>
                                    <th>Penulis / Email</th>
                                    <th>Kategori & Usia</th>
                                    <th>Tipe</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($articles)): ?>
                                    <?php foreach ($articles as $art): ?>
                                        <tr>
                                            <td>
                                                <?php 
                                                    $imgSrc = !empty($art['thumbnail']) ? $art['thumbnail'] : (!empty($art['image']) ? $art['image'] : 'images/cand-mother-child.jpg');
                                                    if (strpos($imgSrc, 'http') !== 0) { $imgSrc = base_url($imgSrc); }
                                                ?>
                                                <img src="<?= esc($imgSrc) ?>" class="thumb-preview" alt="Sampul" style="width: 48px; height: 48px; object-fit: cover; border-radius: 8px;">
                                            </td>
                                            <td style="max-width: 250px;">
                                                <strong><?= esc($art['title']) ?></strong>
                                                <?php if (!empty($art['excerpt'])): ?>
                                                    <div style="font-size: 11px; color: #64748b; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; max-width: 240px; margin-top: 3px;">
                                                        <?= esc($art['excerpt']) ?>
                                                    </div>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <div style="font-weight: 600; font-size: 13px; color: #334155;"><?= esc($art['author'] ?? 'Anonim') ?></div>
                                                <div style="font-size: 11px; color: #64748b;"><?= esc($art['author_email'] ?? '-') ?></div>
                                            </td>
                                            <td>
                                                <span style="font-size: 11px; font-weight: 700; text-transform: uppercase; background: #e0f2fe; color: #0369a1; padding: 3px 8px; border-radius: 6px; display: inline-block; margin-bottom: 4px;">
                                                    <?= esc($art['category_name'] ?? ($art['category_slug'] ?? 'Parenting')) ?>
                                                </span>
                                                <div style="font-size: 11px; color: #64748b;"><?= esc($art['age_label'] ?? 'Semua Usia') ?></div>
                                            </td>
                                            <td>
                                                <span style="font-size: 11px; font-weight: 600; background: #f1f5f9; padding: 3px 8px; border-radius: 6px;">
                                                    <?= esc(ucfirst($art['type'] ?? 'artikel')) ?>
                                                </span>
                                            </td>
                                            <td>
                                                <?php 
                                                    $st = $art['status'] ?? 'published';
                                                    if ($st === 'published'): 
                                                ?>
                                                    <span class="badge-status badge-verified" style="background: #dcfce7; color: #15803d;">✔ Diterbitkan</span>
                                                <?php elseif ($st === 'pending'): ?>
                                                    <span class="badge-status badge-pending" style="background: #fef9c3; color: #a16207;">⏳ Perlu Ditinjau</span>
                                                <?php else: ?>
                                                    <span class="badge-status" style="background: #fee2e2; color: #b91c1c; padding: 4px 8px; border-radius: 6px; font-size: 11px; font-weight: 700;">✖ Ditolak</span>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <div class="action-btns" style="display: flex; gap: 6px; flex-wrap: wrap;">
                                                    <?php if (($art['status'] ?? '') !== 'published'): ?>
                                                        <a href="<?= base_url('admin/article/approve/' . $art['id']) ?>" class="btn-sm btn-verify" title="Setujui & Terbitkan ke Parentela" style="background: #16a34a; color: #fff; text-decoration: none;">
                                                            <i class="fas fa-check"></i> Setujui
                                                        </a>
                                                    <?php endif; ?>

                                                    <?php if (($art['status'] ?? '') !== 'rejected'): ?>
                                                        <a href="<?= base_url('admin/article/reject/' . $art['id']) ?>" class="btn-sm btn-unverify" title="Tolak Artikel Ini" style="background: #ea580c; color: #fff; text-decoration: none;">
                                                            <i class="fas fa-times"></i> Tolak
                                                        </a>
                                                    <?php endif; ?>

                                                    <button class="btn-sm btn-edit" onclick='editArticle(<?= json_encode($art) ?>)'>
                                                        <i class="fas fa-edit"></i> Edit
                                                    </button>
                                                    <a href="<?= base_url('admin/article/delete/' . $art['id']) ?>" class="btn-sm btn-delete" onclick="return confirm('Apakah Anda yakin ingin menghapus artikel ini?')" style="text-decoration: none;">
                                                        <i class="fas fa-trash"></i> Hapus
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="7" style="text-align: center; color: #94a3b8; padding: 30px;">
                                            Belum ada artikel terdaftar atau diajukan.
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            <?php endif; ?>

            <?php if ($activeTab === 'toko' || $activeTab === 'shop'): ?>
                <!-- TAB PENGELOLAAN TOKO & PRODUK -->
                <div class="panel-card">
                    <div class="panel-header">
                        <div>
                            <h2>Pengelolaan Toko & Produk Rekomendasi Parentela</h2>
                            <p style="font-size: 13px; color: #64748b; margin-top: 4px;">Kelola produk rekomendasi Shopee, foto produk, link checkout, dan kategori.</p>
                        </div>
                        <div style="display: flex; gap: 12px; align-items: center;">
                            <div class="filter-pills">
                                <a href="<?= base_url('admin/toko?shop_category=all') ?>" class="filter-pill <?= ($activeShopCategory ?? 'all') === 'all' ? 'active' : '' ?>">Semua</a>
                                <a href="<?= base_url('admin/toko?shop_category=ibu-hamil') ?>" class="filter-pill <?= ($activeShopCategory ?? '') === 'ibu-hamil' ? 'active' : '' ?>">🤰 Ibu & Kehamilan</a>
                                <a href="<?= base_url('admin/toko?shop_category=newborn') ?>" class="filter-pill <?= ($activeShopCategory ?? '') === 'newborn' ? 'active' : '' ?>">👶 Newborn</a>
                                <a href="<?= base_url('admin/toko?shop_category=mpasi') ?>" class="filter-pill <?= ($activeShopCategory ?? '') === 'mpasi' ? 'active' : '' ?>">🥣 MPASI</a>
                                <a href="<?= base_url('admin/toko?shop_category=balita') ?>" class="filter-pill <?= ($activeShopCategory ?? '') === 'balita' ? 'active' : '' ?>">🧸 Balita</a>
                                <a href="<?= base_url('admin/toko?shop_category=keamanan') ?>" class="filter-pill <?= ($activeShopCategory ?? '') === 'keamanan' ? 'active' : '' ?>">🛡️ Keamanan</a>
                            </div>
                            <button class="btn-primary" onclick="openShopModal()">
                                <i class="fas fa-plus"></i> Tambah Produk Toko
                            </button>
                        </div>
                    </div>

                    <div style="overflow-x: auto;">
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th>Foto</th>
                                    <th>Nama Produk</th>
                                    <th>Kategori</th>
                                    <th>Subtext / Deskripsi</th>
                                    <th>Tautan Shopee</th>
                                    <th>Badge</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($shopProducts)): ?>
                                    <?php foreach ($shopProducts as $prod): ?>
                                        <tr>
                                            <td style="text-align: center; vertical-align: middle;">
                                                <?php 
                                                    $imgVal = $prod['image'] ?? '';
                                                    if (!empty($imgVal) && (strpos($imgVal, '/') !== false || strpos($imgVal, '.') !== false)): 
                                                        $src = (strpos($imgVal, 'http') === 0) ? esc($imgVal) : base_url($imgVal);
                                                ?>
                                                    <img src="<?= $src ?>" class="thumb-preview" alt="Foto Produk" style="width: 50px; height: 50px; object-fit: contain; background: #fff; border: 1px solid #e2e8f0; padding: 2px;">
                                                <?php else: ?>
                                                    <div style="font-size: 1.8rem; line-height: 1;"><?= esc($imgVal ?: '🛍️') ?></div>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <strong><?= esc($prod['name']) ?></strong>
                                            </td>
                                            <td>
                                                <span style="font-size: 11px; font-weight: 700; text-transform: uppercase; background: #ffe4e6; color: #be123c; padding: 4px 8px; border-radius: 6px;">
                                                    <?= esc($prod['category']) ?>
                                                </span>
                                            </td>
                                            <td style="font-size: 12px; color: #475569; max-width: 220px;">
                                                <?= esc($prod['subtext']) ?>
                                            </td>
                                            <td>
                                                <?php if (!empty($prod['shopee_link'])): ?>
                                                    <a href="<?= esc($prod['shopee_link']) ?>" target="_blank" rel="noopener" class="btn-sm" style="background: #fff3ed; color: #ee4d2d; border: 1px solid #ffd8cc; font-size: 11px; text-decoration: none;">
                                                        <i class="fas fa-shopping-cart"></i> Shopee Link
                                                    </a>
                                                <?php else: ?>
                                                    <span style="font-size: 11px; color: #94a3b8;">Belum ada link</span>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <?php if (!empty($prod['badge'])): ?>
                                                    <span style="font-size: 11px; background: #fef3c7; color: #b45309; padding: 3px 8px; border-radius: 6px; font-weight: 600;">
                                                        <?= esc($prod['badge']) ?>
                                                    </span>
                                                <?php else: ?>
                                                    <span style="color: #cbd5e1; font-size: 11px;">-</span>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <div class="action-btns">
                                                    <button class="btn-sm btn-edit" onclick='editShopProduct(<?= json_encode($prod) ?>)'>
                                                        <i class="fas fa-edit"></i> Edit
                                                    </button>
                                                    <a href="<?= base_url('admin/shop/delete/' . $prod['id']) ?>" class="btn-sm btn-delete" onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?')" style="text-decoration: none;">
                                                        <i class="fas fa-trash"></i> Hapus
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="7" style="text-align: center; color: #94a3b8; padding: 30px;">
                                            Belum ada produk toko pada kategori ini.
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            <?php endif; ?>
    </main>

    <!-- Modal Form Direktori Tempat Asuh -->
    <div class="modal-backdrop" id="directoryModal">
        <div class="modal-box">
            <div class="modal-header">
                <h3 id="modalTitle">Tambah Tempat Asuh / Daycare Baru</h3>
                <button class="modal-close" onclick="closeDirectoryModal()">&times;</button>
            </div>
            <form action="<?= base_url('admin/directory/save') ?>" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="hidden" name="id" id="dir_id">
                    <input type="hidden" name="existing_foto" id="dir_existing_foto">

                    <div class="form-row">
                        <div class="form-group">
                            <label>Nama Tempat / Fasilitas</label>
                            <input type="text" name="nama" id="dir_nama" class="form-control" required placeholder="Contoh: Mom Donny Daycare">
                        </div>
                        <div class="form-group">
                            <label>Kategori</label>
                            <select name="category" id="dir_category" class="form-control" required>
                                <option value="daycare">🧸 Daycare</option>
                                <option value="panti-asuhan">🏡 Panti Asuhan</option>
                                <option value="nursery-playground">🎠 Nursery & Playground</option>
                                <option value="taman-bacaan">📚 Taman Bacaan</option>
                            </select>
                        </div>
                    </div>

                    <!-- Seksi Upload Foto Sampul Utama & Foto Detail Galeri -->
                    <div class="form-group" style="background: #f8fafc; border: 1.5px dashed #cbd5e1; border-radius: 12px; padding: 14px; margin-bottom: 16px;">
                        <label style="color: #1e293b; font-weight: 700; font-size: 13.5px; margin-bottom: 6px; display: flex; align-items: center; gap: 6px;">
                            <span>🖼️</span> <span>1. Foto Sampul Utama (Cover / Hero Header)</span>
                        </label>
                        <input type="file" name="foto_utama" class="form-control" accept="image/*">
                        <small style="color: #64748b; font-size: 11.5px; display: block; margin-top: 4px;">
                            Format JPG, PNG, WEBP. Ditampilkan sebagai gambar utama di halaman depan & header banner.
                        </small>
                        <div id="dir_cover_preview" style="margin-top: 8px; display: none;">
                            <span style="font-size: 11px; color: #475569; display: block; margin-bottom: 4px;">Foto Sampul Saat Ini:</span>
                            <img id="dir_cover_img" src="" style="max-height: 90px; border-radius: 8px; border: 1px solid #cbd5e1; object-fit: cover;">
                        </div>
                    </div>

                    <div class="form-group" style="background: #f0fdf4; border: 1.5px dashed #86efac; border-radius: 12px; padding: 14px; margin-bottom: 16px;">
                        <label style="color: #166534; font-weight: 700; font-size: 13.5px; margin-bottom: 6px; display: flex; align-items: center; gap: 6px;">
                            <span>📸</span> <span>2. Foto Detail / Galeri Kegiatan (Bisa Unggah Banyak Foto Sekaligus)</span>
                        </label>
                        <input type="file" name="galeri_files[]" class="form-control" accept="image/*" multiple style="background: #ffffff;">
                        <small style="color: #15803d; font-size: 11.5px; display: block; margin-top: 4px;">
                            Pilih satu atau beberapa foto sekaligus untuk menambah galeri foto detail kegiatan anak/fasilitas dalam.
                        </small>
                        
                        <!-- Container Preview Galeri Foto Terpasang -->
                        <div id="dir_galeri_preview_container" style="margin-top: 10px; display: flex; flex-wrap: wrap; gap: 8px;"></div>
                        <input type="hidden" name="existing_galeri" id="dir_existing_galeri_input">
                    </div>

                    <div class="form-group">
                        <label>Alamat & Lokasi Kompleks</label>
                        <input type="text" name="lokasi" id="dir_lokasi" class="form-control" placeholder="📍 Jl. Raya Dian Istana, Wiyung, Surabaya">
                    </div>

                    <div class="form-group">
                        <label>Deskripsi Singkat</label>
                        <textarea name="deskripsi" id="dir_deskripsi" class="form-control" placeholder="Penjelasan mengenai fasilitas, layanan, dan keunggulan..."></textarea>
                    </div>

                    <div class="form-group">
                        <label>Fasilitas (1 per baris)</label>
                        <textarea name="fasilitas" id="dir_fasilitas" class="form-control" placeholder="Kelas Ber-AC&#10;CCTV Real-Time&#10;Ruang Bermain"></textarea>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>Jam Operasional</label>
                            <input type="text" name="jam_buka" id="dir_jam_buka" class="form-control" placeholder="Senin - Jumat: 07:00 - 17:00">
                        </div>
                        <div class="form-group">
                            <label>Kelompok Usia</label>
                            <input type="text" name="usia" id="dir_usia" class="form-control" placeholder="3 Bulan - 6 Tahun">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>Nomor WhatsApp Admin</label>
                            <input type="text" name="wa" id="dir_wa" class="form-control" placeholder="6281234567890">
                        </div>
                        <div class="form-group">
                            <label>Instagram (Opsional)</label>
                            <input type="text" name="instagram" id="dir_instagram" class="form-control" placeholder="@namapanti atau https://instagram.com/...">
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Link Google Maps (Opsional)</label>
                        <input type="text" name="gmaps" id="dir_gmaps" class="form-control" placeholder="https://maps.google.com/...">
                    </div>

                    <div class="form-group" style="display: flex; align-items: center; margin-top: 6px;">
                        <label style="display: flex; align-items: center; gap: 8px; cursor: pointer;">
                            <input type="checkbox" name="is_verified" id="dir_is_verified" value="1" style="width: 18px; height: 18px;">
                            <span style="font-weight: 700; color: #16a34a;">Setujui Status "Tepat &amp; Terverifikasi"</span>
                        </label>
                    </div>

                    <div style="text-align: right; margin-top: 20px;">
                        <button type="button" class="btn-sm" style="background: #e2e8f0; color: #475569; padding: 10px 20px;" onclick="closeDirectoryModal()">Batal</button>
                        <button type="submit" class="btn-primary" style="padding: 10px 24px;">Simpan Data</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Form Direktori Pendidikan -->
    <div class="modal-backdrop" id="educationModal">
        <div class="modal-box">
            <div class="modal-header">
                <h3 id="eduModalTitle">Tambah Lembaga Pendidikan Baru</h3>
                <button class="modal-close" onclick="closeEducationModal()">&times;</button>
            </div>
            <form action="<?= base_url('admin/education/save') ?>" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="hidden" name="id" id="edu_id">
                    <input type="hidden" name="existing_foto" id="edu_existing_foto">

                    <div class="form-row">
                        <div class="form-group">
                            <label>Nama Lembaga / Sekolah *</label>
                            <input type="text" name="nama" id="edu_nama" class="form-control" required placeholder="Contoh: TK Islam Nur Hidayah">
                        </div>
                        <div class="form-group">
                            <label>Kategori *</label>
                            <select name="category" id="edu_category" class="form-control" required>
                                <optgroup label="🎒 Jalur Pendidikan Formal">
                                    <option value="tk">🏫 TK (Taman Kanak-Kanak)</option>
                                    <option value="sd">📖 SD (Sekolah Dasar)</option>
                                    <option value="smp">🏫 SMP (Sekolah Menengah Pertama)</option>
                                    <option value="sma">🎓 SMA / SMK</option>
                                    <option value="slb">♿ SLB (Sekolah Luar Biasa)</option>
                                </optgroup>
                                <optgroup label="🧸 Jalur Pendidikan Nonformal / Informal">
                                    <option value="paud">🌱 PAUD (Pendidikan Anak Usia Dini)</option>
                                    <option value="preschool">🧩 Preschool / Prasekolah</option>
                                    <option value="kelompok-bermain">🎠 Kelompok Bermain (KB)</option>
                                    <option value="bimbel">📚 Bimbingan Belajar / Les</option>
                                    <option value="sanggar">🎨 Sanggar &amp; Kursus Keterampilan</option>
                                </optgroup>
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>Akreditasi / Badge Status (Opsional)</label>
                            <input type="text" name="akreditasi" id="edu_akreditasi" class="form-control" placeholder="Contoh: Akreditasi A atau Terakreditasi">
                        </div>
                        <div class="form-group">
                            <label>Kurikulum (Opsional)</label>
                            <input type="text" name="kurikulum" id="edu_kurikulum" class="form-control" placeholder="Contoh: Kurikulum Merdeka Plus Karakter Islami">
                        </div>
                    </div>

                    <div class="form-group" style="background: #f8fafc; border: 1.5px dashed #cbd5e1; border-radius: 12px; padding: 14px; margin-bottom: 16px;">
                        <label style="color: #1e293b; font-weight: 700; font-size: 13.5px; margin-bottom: 6px; display: flex; align-items: center; gap: 6px;">
                            <span>🖼️</span> <span>Foto Sampul Utama (Cover Card / Hero Image)</span>
                        </label>
                        <input type="file" name="foto_utama" class="form-control" accept="image/*">
                        <small style="color: #64748b; font-size: 11.5px; display: block; margin-top: 4px;">
                            Format JPG, PNG, WEBP. Ditampilkan di kartu utama & sampul lembaga pendidikan.
                        </small>
                    </div>

                    <div class="form-group">
                        <label>Alamat &amp; Lokasi Lengkap *</label>
                        <input type="text" name="lokasi" id="edu_lokasi" class="form-control" required placeholder="📍 Jl. Raya Darmo No.68, Tegalsari, Surabaya">
                    </div>

                    <div class="form-group">
                        <label>Deskripsi Singkat Lembaga *</label>
                        <textarea name="deskripsi" id="edu_deskripsi" class="form-control" required placeholder="Penjelasan mengenai keunggulan, pembiasaan karakter, dan metode pembelajaran..."></textarea>
                    </div>

                    <div class="form-group">
                        <label>Fasilitas (1 per baris)</label>
                        <textarea name="fasilitas" id="edu_fasilitas" class="form-control" placeholder="Perpustakaan&#10;Lab Komputer&#10;Lapangan Olahraga"></textarea>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>Jam Operasional</label>
                            <input type="text" name="jam_buka" id="edu_jam_buka" class="form-control" placeholder="Senin - Sabtu: 07:00 - 13:00">
                        </div>
                        <div class="form-group">
                            <label>Kisaran Jenjang Usia</label>
                            <input type="text" name="usia" id="edu_usia" class="form-control" placeholder="4 - 6 Tahun">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>Nomor WhatsApp</label>
                            <input type="text" name="wa" id="edu_wa" class="form-control" placeholder="6281234567890">
                        </div>
                        <div class="form-group">
                            <label>Instagram (Opsional)</label>
                            <input type="text" name="instagram" id="edu_instagram" class="form-control" placeholder="@namalembaga">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>Website (Opsional)</label>
                            <input type="text" name="website" id="edu_website" class="form-control" placeholder="https://sekolah.sch.id">
                        </div>
                        <div class="form-group">
                            <label>Link Google Maps (Opsional)</label>
                            <input type="text" name="gmaps" id="edu_gmaps" class="form-control" placeholder="https://maps.google.com/...">
                        </div>
                    </div>

                    <div class="form-group" style="display: flex; align-items: center;">
                        <label style="display: flex; align-items: center; gap: 8px; cursor: pointer;">
                            <input type="checkbox" name="is_verified" id="edu_is_verified" value="1" style="width: 18px; height: 18px;">
                            <span style="font-weight: 700; color: #16a34a;">Setujui Status "Tepat &amp; Terverifikasi"</span>
                        </label>
                    </div>

                    <div style="text-align: right; margin-top: 20px;">
                        <button type="button" class="btn-sm" style="background: #e2e8f0; color: #475569; padding: 10px 20px;" onclick="closeEducationModal()">Batal</button>
                        <button type="submit" class="btn-primary" style="padding: 10px 24px;">Simpan Data</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Form Admin Tambah / Edit Artikel -->
    <div class="modal-backdrop" id="articleAdminModal">
        <div class="modal-box" style="max-width: 650px;">
            <div class="modal-header">
                <h3 id="articleModalTitle">Kelola Artikel Parentela</h3>
                <button class="modal-close" onclick="closeArticleModal()">&times;</button>
            </div>
            <form action="<?= base_url('admin/article/save') ?>" method="post" enctype="multipart/form-data">
                <div class="modal-body" style="max-height: 75vh; overflow-y: auto;">
                    <input type="hidden" name="id" id="art_id">
                    <input type="hidden" name="existing_thumbnail" id="art_existing_thumbnail">

                    <div class="form-group">
                        <label>Judul Artikel / Video *</label>
                        <input type="text" name="title" id="art_title" class="form-control" required placeholder="Judul artikel edukasi...">
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>Nama Penulis / Redaksi</label>
                            <input type="text" name="author" id="art_author" class="form-control" placeholder="dr. Aulia / Redaksi Parentela">
                        </div>
                        <div class="form-group">
                            <label>Status Publikasi *</label>
                            <select name="status" id="art_status" class="form-control" required>
                                <option value="published">Diterbitkan (Published)</option>
                                <option value="pending">Perlu Ditinjau (Pending)</option>
                                <option value="rejected">Ditolak (Rejected)</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>Kategori *</label>
                            <select name="category_slug" id="art_category_slug" class="form-control" required>
                                <option value="parenting">Parenting</option>
                                <option value="tumbuh-kembang">Tumbuh Kembang</option>
                                <option value="kesehatan">Kesehatan</option>
                                <option value="kebutuhan-khusus">Kebutuhan Khusus</option>
                                <option value="kebugaran">Kebugaran</option>
                                <option value="gaya-hidup">Gaya Hidup</option>
                                <option value="video-edukasi">Video Edukasi</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Target Usia *</label>
                            <select name="age_slug" id="art_age_slug" class="form-control" required>
                                <option value="semua-usia">Semua Usia</option>
                                <option value="hamil-trimester-1">Hamil Trimester 1</option>
                                <option value="hamil-trimester-2">Hamil Trimester 2</option>
                                <option value="hamil-trimester-3">Hamil Trimester 3</option>
                                <option value="pasca-persalinan">Pasca Persalinan</option>
                                <option value="0-6-bulan">0 - 6 bulan</option>
                                <option value="6-12-bulan">6 - 12 bulan</option>
                                <option value="1-2-tahun">1 - 2 tahun</option>
                                <option value="2-5-tahun">2 - 5 tahun</option>
                                <option value="5-12-tahun">5 - 12 tahun</option>
                                <option value="lebih-12-tahun">> 12 tahun</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Tipe Konten *</label>
                        <select name="type" id="art_type" class="form-control" required>
                            <option value="artikel">Artikel Bacaan</option>
                            <option value="video">Video Edukasi</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Ringkasan Singkat (Excerpt)</label>
                        <textarea name="excerpt" id="art_excerpt" class="form-control" rows="2" placeholder="Ringkasan 2-3 kalimat..."></textarea>
                    </div>

                    <div class="form-group">
                        <label>Isi Artikel / Konten Lengkap</label>
                        <textarea name="content" id="art_content" class="form-control" rows="5" placeholder="Tulis artikel atau tautan video di sini..."></textarea>
                    </div>

                    <div class="form-group">
                        <label>Foto Sampul / Thumbnail (Opsional)</label>
                        <input type="file" name="thumbnail" class="form-control" accept="image/*">
                        <small style="color: #64748b; font-size: 11px;">Format JPG, PNG, WEBP.</small>
                    </div>

                    <div style="text-align: right; margin-top: 20px;">
                        <button type="button" class="btn-sm" style="background: #e2e8f0; color: #475569; padding: 10px 20px;" onclick="closeArticleModal()">Batal</button>
                        <button type="submit" class="btn-primary" style="padding: 10px 24px;">Simpan Artikel</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        let currentGaleriList = [];

        function renderGaleriPreview() {
            const container = document.getElementById('dir_galeri_preview_container');
            const hiddenInput = document.getElementById('dir_existing_galeri_input');
            if (!container || !hiddenInput) return;
            container.innerHTML = '';

            if (currentGaleriList.length === 0) {
                hiddenInput.value = '';
                return;
            }

            hiddenInput.value = JSON.stringify(currentGaleriList);

            currentGaleriList.forEach((item, index) => {
                let imgUrl = (typeof item === 'string') ? item : (item.url || '');
                if (!imgUrl) return;
                if (!imgUrl.startsWith('http') && !imgUrl.startsWith('data:')) {
                    imgUrl = '<?= base_url() ?>' + imgUrl;
                }

                const wrapper = document.createElement('div');
                wrapper.style.cssText = 'position: relative; width: 85px; height: 85px; border-radius: 8px; overflow: hidden; border: 1.5px solid #cbd5e1; box-shadow: 0 2px 6px rgba(0,0,0,0.05);';

                const img = document.createElement('img');
                img.src = imgUrl;
                img.style.cssText = 'width: 100%; height: 100%; object-fit: cover; display: block;';

                const btnRemove = document.createElement('button');
                btnRemove.type = 'button';
                btnRemove.innerHTML = '&times;';
                btnRemove.title = 'Hapus foto galeri ini';
                btnRemove.style.cssText = 'position: absolute; top: 3px; right: 3px; background: rgba(220,38,38,0.9); color: #ffffff; border: none; border-radius: 50%; width: 22px; height: 22px; font-size: 15px; font-weight: bold; cursor: pointer; display: flex; align-items: center; justify-content: center; line-height: 1;';
                btnRemove.onclick = function() {
                    currentGaleriList.splice(index, 1);
                    renderGaleriPreview();
                };

                wrapper.appendChild(img);
                wrapper.appendChild(btnRemove);
                container.appendChild(wrapper);
            });
        }

        function openDirectoryModal() {
            document.getElementById('modalTitle').innerText = 'Tambah Tempat Asuh / Daycare Baru';
            document.getElementById('dir_id').value = '';
            document.getElementById('dir_existing_foto').value = '';
            document.getElementById('dir_nama').value = '';
            document.getElementById('dir_lokasi').value = '';
            document.getElementById('dir_deskripsi').value = '';
            document.getElementById('dir_fasilitas').value = '';
            document.getElementById('dir_jam_buka').value = '';
            document.getElementById('dir_usia').value = '';
            document.getElementById('dir_wa').value = '';
            document.getElementById('dir_instagram').value = '';
            document.getElementById('dir_gmaps').value = '';
            document.getElementById('dir_is_verified').checked = false;

            // Reset Cover & Galeri Preview
            document.getElementById('dir_cover_preview').style.display = 'none';
            document.getElementById('dir_cover_img').src = '';
            currentGaleriList = [];
            renderGaleriPreview();

            document.getElementById('directoryModal').classList.add('active');
        }

        function closeDirectoryModal() {
            document.getElementById('directoryModal').classList.remove('active');
        }

        function editDirectory(data) {
            document.getElementById('modalTitle').innerText = 'Edit / Unggah Foto Tempat';
            document.getElementById('dir_id').value = data.id || '';
            document.getElementById('dir_existing_foto').value = data.foto_utama || '';
            document.getElementById('dir_nama').value = data.nama || '';
            document.getElementById('dir_category').value = data.category || 'daycare';
            document.getElementById('dir_lokasi').value = data.lokasi || '';
            document.getElementById('dir_deskripsi').value = data.deskripsi || '';
            
            // Preview Foto Sampul / Utama
            if (data.foto_utama) {
                let coverUrl = data.foto_utama.startsWith('http') ? data.foto_utama : ('<?= base_url() ?>' + data.foto_utama);
                document.getElementById('dir_cover_img').src = coverUrl;
                document.getElementById('dir_cover_preview').style.display = 'block';
            } else {
                document.getElementById('dir_cover_preview').style.display = 'none';
            }

            // Preview Foto Galeri Kegiatan / Detail Dalam
            currentGaleriList = [];
            if (data.galeri) {
                try {
                    let parsedG = typeof data.galeri === 'string' ? JSON.parse(data.galeri) : data.galeri;
                    if (Array.isArray(parsedG)) {
                        currentGaleriList = parsedG;
                    }
                } catch(e) {}
            }
            renderGaleriPreview();

            // Format Fasilitas if JSON
            let fas = data.fasilitas || '';
            try {
                let parsed = JSON.parse(fas);
                if (Array.isArray(parsed)) fas = parsed.join("\n");
            } catch(e) {}
            document.getElementById('dir_fasilitas').value = fas;

            document.getElementById('dir_jam_buka').value = data.jam_buka || '';
            document.getElementById('dir_usia').value = data.usia || '';
            document.getElementById('dir_wa').value = data.wa || '';
            document.getElementById('dir_instagram').value = data.instagram || '';
            document.getElementById('dir_gmaps').value = data.gmaps || '';
            document.getElementById('dir_is_verified').checked = (data.is_verified == 1);
            
            document.getElementById('directoryModal').classList.add('active');
        }

        function openArticleModal() {
            document.getElementById('articleModalTitle').innerText = 'Tambah Artikel Baru (Administrator)';
            document.getElementById('art_id').value = '';
            document.getElementById('art_existing_thumbnail').value = '';
            document.getElementById('art_title').value = '';
            document.getElementById('art_author').value = 'Redaksi Parentela';
            document.getElementById('art_status').value = 'published';
            document.getElementById('art_category_slug').value = 'parenting';
            document.getElementById('art_age_slug').value = 'semua-usia';
            document.getElementById('art_type').value = 'artikel';
            document.getElementById('art_excerpt').value = '';
            document.getElementById('art_content').value = '';
            document.getElementById('articleAdminModal').classList.add('active');
        }

        function closeArticleModal() {
            document.getElementById('articleAdminModal').classList.remove('active');
        }

        function openEducationModal() {
            document.getElementById('eduModalTitle').innerText = 'Tambah Lembaga Pendidikan Baru';
            document.getElementById('edu_id').value = '';
            document.getElementById('edu_existing_foto').value = '';
            document.getElementById('edu_nama').value = '';
            document.getElementById('edu_category').value = 'paud';
            if (document.getElementById('edu_akreditasi')) document.getElementById('edu_akreditasi').value = '';
            if (document.getElementById('edu_kurikulum')) document.getElementById('edu_kurikulum').value = '';
            document.getElementById('edu_lokasi').value = '';
            document.getElementById('edu_deskripsi').value = '';
            document.getElementById('edu_fasilitas').value = '';
            document.getElementById('edu_jam_buka').value = '';
            document.getElementById('edu_usia').value = '';
            document.getElementById('edu_wa').value = '';
            document.getElementById('edu_instagram').value = '';
            document.getElementById('edu_website').value = '';
            document.getElementById('edu_gmaps').value = '';
            document.getElementById('edu_is_verified').checked = false;
            document.getElementById('educationModal').classList.add('active');
        }

        function closeEducationModal() {
            document.getElementById('educationModal').classList.remove('active');
        }

        function editEducation(data) {
            document.getElementById('eduModalTitle').innerText = 'Edit Data Lembaga Pendidikan';
            document.getElementById('edu_id').value = data.id || '';
            document.getElementById('edu_existing_foto').value = data.foto_utama || '';
            document.getElementById('edu_nama').value = data.nama || '';
            document.getElementById('edu_category').value = data.category || 'paud';
            if (document.getElementById('edu_akreditasi')) document.getElementById('edu_akreditasi').value = data.akreditasi || '';
            if (document.getElementById('edu_kurikulum')) document.getElementById('edu_kurikulum').value = data.kurikulum || '';
            document.getElementById('edu_lokasi').value = data.lokasi || '';
            document.getElementById('edu_deskripsi').value = data.deskripsi || '';
            let fas = data.fasilitas || '';
            try {
                let parsed = JSON.parse(fas);
                if (Array.isArray(parsed)) fas = parsed.join("\n");
            } catch(e) {}
            document.getElementById('edu_fasilitas').value = fas;
            document.getElementById('edu_jam_buka').value = data.jam_buka || '';
            document.getElementById('edu_usia').value = data.usia || '';
            document.getElementById('edu_wa').value = data.wa || '';
            document.getElementById('edu_instagram').value = data.instagram || '';
            document.getElementById('edu_website').value = data.website || '';
            document.getElementById('edu_gmaps').value = data.gmaps || '';
            document.getElementById('edu_is_verified').checked = (data.is_verified == 1);
            document.getElementById('educationModal').classList.add('active');
        }

        function editArticle(data) {
            document.getElementById('articleModalTitle').innerText = 'Edit Data Artikel';
            document.getElementById('art_id').value = data.id || '';
            document.getElementById('art_existing_thumbnail').value = data.thumbnail || data.image || '';
            document.getElementById('art_title').value = data.title || '';
            document.getElementById('art_author').value = data.author || 'Redaksi Parentela';
            document.getElementById('art_status').value = data.status || 'published';
            document.getElementById('art_category_slug').value = data.category_slug || 'parenting';
            document.getElementById('art_age_slug').value = data.age_slug || 'semua-usia';
            document.getElementById('art_type').value = data.type || 'artikel';
            document.getElementById('art_excerpt').value = data.excerpt || '';
            document.getElementById('art_content').value = data.content || '';
            document.getElementById('articleAdminModal').classList.add('active');
        }

        function openShopModal() {
            document.getElementById('shopModalTitle').innerText = 'Tambah Produk Toko Baru';
            document.getElementById('shop_id').value = '';
            document.getElementById('shop_existing_image').value = '';
            document.getElementById('shop_name').value = '';
            document.getElementById('shop_subtext').value = '';
            document.getElementById('shop_category').value = 'ibu-hamil';
            document.getElementById('shop_shopee_link').value = '';
            document.getElementById('shop_badge').value = '';
            document.getElementById('shop_image_file').value = '';
            document.getElementById('shop_image_text').value = '';
            document.getElementById('shopModal').classList.add('active');
        }

        function closeShopModal() {
            document.getElementById('shopModal').classList.remove('active');
        }

        function editShopProduct(data) {
            document.getElementById('shopModalTitle').innerText = 'Edit Data Produk Toko';
            document.getElementById('shop_id').value = data.id || '';
            document.getElementById('shop_existing_image').value = data.image || '';
            document.getElementById('shop_name').value = data.name || '';
            document.getElementById('shop_subtext').value = data.subtext || '';
            document.getElementById('shop_category').value = data.category || 'ibu-hamil';
            document.getElementById('shop_shopee_link').value = data.shopee_link || '';
            document.getElementById('shop_badge').value = data.badge || '';
            document.getElementById('shop_image_file').value = '';
            document.getElementById('shop_image_text').value = (data.image && !data.image.includes('/')) ? data.image : '';
            document.getElementById('shopModal').classList.add('active');
        }
    </script>

    <!-- Modal Form Produk Toko -->
    <div class="modal-backdrop" id="shopModal">
        <div class="modal-box">
            <div class="modal-header">
                <h3 id="shopModalTitle">Tambah Produk Toko Baru</h3>
                <button class="modal-close" onclick="closeShopModal()">&times;</button>
            </div>
            <form action="<?= base_url('admin/shop/save') ?>" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="hidden" name="id" id="shop_id">
                    <input type="hidden" name="existing_image" id="shop_existing_image">

                    <div class="form-row">
                        <div class="form-group">
                            <label>Nama Produk</label>
                            <input type="text" name="name" id="shop_name" class="form-control" required placeholder="Contoh: Bantal Hamil Ergonomis (Model 1)">
                        </div>
                        <div class="form-group">
                            <label>Kategori Produk</label>
                            <select name="category" id="shop_category" class="form-control" required>
                                <option value="ibu-hamil">🤰 Ibu & Kehamilan</option>
                                <option value="newborn">👶 Newborn (0-6 Bln)</option>
                                <option value="mpasi">🥣 Fase MPASI</option>
                                <option value="balita">🧸 Balita & Montessori</option>
                                <option value="keamanan">🛡️ Keamanan & Rumah</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Deskripsi Singkat / Subtext</label>
                        <input type="text" name="subtext" id="shop_subtext" class="form-control" placeholder="Contoh: Menopang perut & punggung saat tidur">
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>Link Shopee (URL / Tautan Checkout)</label>
                            <input type="url" name="shopee_link" id="shop_shopee_link" class="form-control" placeholder="https://id.shp.ee/...">
                        </div>
                        <div class="form-group">
                            <label>Badge Highlight (Opsional)</label>
                            <input type="text" name="badge" id="shop_badge" class="form-control" placeholder="Contoh: ⭐ Rekomendasi Bumil">
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Unggah File Foto Produk (Opsional / Prioritas)</label>
                        <input type="file" name="image_file" id="shop_image_file" class="form-control" accept="image/*">
                        <small style="color: #64748b; font-size: 11px; margin-top: 4px; display: block;">Format: PNG, JPG, WEBP. Maks 2MB.</small>
                    </div>

                    <div class="form-group">
                        <label>ATAU Emoji / Gambar Teks (Alternatif jika tidak ada foto)</label>
                        <input type="text" name="image_text" id="shop_image_text" class="form-control" placeholder="Contoh: 🛏️ atau 🍼 atau path gambar">
                    </div>
                </div>
                <div class="modal-footer" style="padding: 16px 24px; background: #f8fafc; border-top: 1px solid #e2e8f0; display: flex; justify-content: flex-end; gap: 10px;">
                    <button type="button" class="btn-sm" onclick="closeShopModal()" style="background: #e2e8f0; color: #475569;">Batal</button>
                    <button type="submit" class="btn-primary"><i class="fas fa-save"></i> Simpan Produk</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
