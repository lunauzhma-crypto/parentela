<?php
namespace App\Controllers;

class Page extends BaseController
{
    public function about()
    {
        return view("pages/about_us", [
            'title' => 'Tentang Kami - Parentela',
        ]);
    }

    public function contact()
    {
        echo view("contact");
    }

    public function faqs()
    {
        echo view("faqs");
    }

    public function login()
    {
        $session = session();

        if (strtolower($this->request->getMethod()) === 'post') {
            $email = trim((string) $this->request->getPost('email'));
            $password = (string) $this->request->getPost('password');
            $mode = (string) ($this->request->getPost('mode') ?: $this->request->getGet('mode'));

            if (empty($email) || empty($password)) {
                $session->setFlashdata('error', 'Silakan masukkan alamat email dan kata sandi Anda.');
                return redirect()->to(base_url('login' . ($mode === 'register' ? '?mode=register' : '')))->withInput();
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $session->setFlashdata('error', 'Format alamat email tidak valid.');
                return redirect()->to(base_url('login' . ($mode === 'register' ? '?mode=register' : '')))->withInput();
            }

            $userModel = new \App\Models\UserModel();

            if ($mode === 'register') {
                if (strlen($password) < 6) {
                    $session->setFlashdata('error', 'Kata sandi minimal harus terdiri dari 6 karakter.');
                    return redirect()->to(base_url('login?mode=register'))->withInput();
                }

                $existingUser = $userModel->findByEmail($email);
                if ($existingUser) {
                    $session->setFlashdata('error', 'Email ini sudah terdaftar. Silakan masuk menggunakan kata sandi Anda.');
                    return redirect()->to(base_url('login'))->withInput();
                }

                $userId = $userModel->registerUser([
                    'email'    => $email,
                    'password' => $password,
                    'name'     => 'Keluarga Parentela'
                ]);

                $newUser = $userModel->find($userId);

                $session->set([
                    'is_logged_in' => true,
                    'user_id'      => $newUser['id'],
                    'role'         => $newUser['role'],
                    'user_email'   => $newUser['email'],
                    'user_name'    => $newUser['name']
                ]);

                $session->setFlashdata('success', 'Pendaftaran akun keluarga berhasil! Selamat datang di Parentela.');
                return redirect()->to(base_url('/'));
            }

            $user = $userModel->findByEmail($email);

            if (!$user || !password_verify($password, $user['password'])) {
                $session->setFlashdata('error', 'Email atau kata sandi yang Anda masukkan tidak sesuai.');
                return redirect()->to(base_url('login'))->withInput();
            }

            $session->set([
                'is_logged_in' => true,
                'user_id'      => $user['id'],
                'role'         => $user['role'],
                'user_email'   => $user['email'],
                'user_name'    => $user['name'],
                'user_avatar'  => $user['avatar'] ?? null
            ]);

            $welcomeMsg = ($user['role'] === 'admin')
                ? 'Selamat datang kembali, Administrator Parentela.'
                : 'Selamat datang kembali di Parentela!';
            $session->setFlashdata('success', $welcomeMsg);

            if ($user['role'] === 'admin') {
                return redirect()->to(base_url('admin'));
            }

            return redirect()->to(base_url('/'));
        }

        return view("login", [
            'title'      => 'Masuk ke Akun - Parentela',
            'isLoggedIn' => (bool) $session->get('is_logged_in'),
            'userRole'   => $session->get('role') ?? 'guest'
        ]);
    }

    public function logout()
    {
        $session = session();
        $session->remove(['is_logged_in', 'role', 'user_email', 'user_name']);
        $session->setFlashdata('info', 'Anda telah berhasil keluar dari akun.');
        return redirect()->to(base_url('login'));
    }

    private function requireLogin(?string $customMessage = null)
    {
        if (!session()->get('is_logged_in')) {
            $msg = $customMessage ?: 'Silakan masuk (login) terlebih dahulu untuk mengakses halaman ini.';
            session()->setFlashdata('error', $msg);
            return redirect()->to(base_url('login'));
        }
        return null;
    }

    private function maskEmail(?string $email): string
    {
        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return $email ?? '';
        }
        $parts  = explode('@', $email, 2);
        $name   = $parts[0];
        $domain = $parts[1];

        $len = strlen($name);
        if ($len <= 2) {
            $maskedName = substr($name, 0, 1) . '***';
        } elseif ($len <= 4) {
            $maskedName = substr($name, 0, 1) . '***' . substr($name, -1);
        } else {
            $maskedName = substr($name, 0, 2) . '***' . substr($name, -2);
        }

        return $maskedName . '@' . $domain;
    }

    public function profile()
    {
        if ($redirect = $this->requireLogin('Silakan masuk ke akun Anda terlebih dahulu untuk mengedit profil.')) {
            return $redirect;
        }

        $db = \Config\Database::connect();
        if (!$db->fieldExists('avatar', 'users')) {
            $forge = \Config\Database::forge();
            $forge->addColumn('users', [
                'avatar' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true]
            ]);
        }

        $session = session();
        $userId  = $session->get('user_id');
        $userModel = new \App\Models\UserModel();

        $user = $userModel->find($userId);
        if (!$user) {
            $user = [
                'id'     => $userId,
                'name'   => $session->get('user_name') ?? 'Keluarga Parentela',
                'email'  => $session->get('user_email') ?? '',
                'role'   => $session->get('role') ?? 'user',
                'avatar' => $session->get('user_avatar') ?? null
            ];
        }

        if (strtolower($this->request->getMethod()) === 'post') {
            $newName         = trim((string) $this->request->getPost('name'));
            $oldPassword     = (string) $this->request->getPost('old_password');
            $newPassword     = (string) $this->request->getPost('new_password');
            $confirmPassword = (string) $this->request->getPost('confirm_password');

            if (empty($newName)) {
                $session->setFlashdata('error', 'Nama profil tidak boleh kosong.');
                return redirect()->to(base_url('profile'));
            }

            $updateData = [
                'name' => $newName
            ];

            // 1. Password Verification & Change Logic
            if (!empty($oldPassword) || !empty($newPassword) || !empty($confirmPassword)) {
                if (empty($oldPassword)) {
                    $session->setFlashdata('error', 'Silakan masukkan kata sandi lama Anda terlebih dahulu untuk mengubah kata sandi.');
                    return redirect()->to(base_url('profile'));
                }
                if (empty($newPassword)) {
                    $session->setFlashdata('error', 'Silakan masukkan kata sandi baru Anda.');
                    return redirect()->to(base_url('profile'));
                }
                if ($newPassword !== $confirmPassword) {
                    $session->setFlashdata('error', 'Konfirmasi kata sandi baru tidak cocok dengan kata sandi baru Anda.');
                    return redirect()->to(base_url('profile'));
                }
                if (strlen($newPassword) < 6) {
                    $session->setFlashdata('error', 'Kata sandi baru minimal harus terdiri dari 6 karakter.');
                    return redirect()->to(base_url('profile'));
                }

                if (empty($user['password']) || !password_verify($oldPassword, $user['password'])) {
                    $session->setFlashdata('error', 'Kata sandi lama yang Anda masukkan tidak sesuai.');
                    return redirect()->to(base_url('profile'));
                }

                $updateData['password'] = password_hash($newPassword, PASSWORD_BCRYPT);
            }

            // 2. Avatar File Upload Logic
            $avatarFile = $this->request->getFile('avatar');
            if ($avatarFile && $avatarFile->isValid() && !$avatarFile->hasMoved()) {
                $uploadDir = FCPATH . 'uploads/avatars/';
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }
                $newNameFile = $avatarFile->getRandomName();
                $avatarFile->move($uploadDir, $newNameFile);
                $avatarPath = 'uploads/avatars/' . $newNameFile;

                $updateData['avatar'] = $avatarPath;
                $session->set('user_avatar', $avatarPath);
            }

            if (!empty($user['id'])) {
                $userModel->update($user['id'], $updateData);
            }

            $session->set('user_name', $newName);

            $session->setFlashdata('success', 'Profil Anda berhasil diperbarui!');
            return redirect()->to(base_url('profile'));
        }

        $maskedEmail = $this->maskEmail($user['email'] ?? $session->get('user_email') ?? '');

        return view('pages/profile', [
            'title'       => 'Pengaturan Profil Saya - Parentela',
            'user'        => $user,
            'maskedEmail' => $maskedEmail
        ]);
    }

    public function shop()
    {
        if ($redirect = $this->requireLogin('Silakan masuk ke akun Anda terlebih dahulu untuk mengakses Toko Parentela.')) {
            return $redirect;
        }

        $admin = new \App\Controllers\Admin();
        $ref = new \ReflectionMethod($admin, 'ensureShopTable');
        $ref->setAccessible(true);
        $ref->invoke($admin);

        $model = new \App\Models\ShopProductModel();
        $shopProducts = $model->where('is_active', 1)->orderBy('id', 'DESC')->findAll();

        return view("pages/shop", [
            'title'        => 'Rekomendasi Toko & Perlengkapan Ibu-Anak Terpercaya - Parentela',
            'shopProducts' => $shopProducts
        ]);
    }

    public function search()
    {
        $q = trim((string) ($this->request->getGet('q') ?? ''));
        $db = \Config\Database::connect();

        $articles    = [];
        $directories = [];
        $nannies     = [];
        $menus       = [];
        $shopItems   = [];

        if ($q !== '') {
            $likeQ = '%' . strtolower($q) . '%';

            // 1. ARTIKEL
            if ($db->tableExists('articles')) {
                $articles = $db->table('articles')
                    ->groupStart()
                        ->like('LOWER(title)', strtolower($q))
                        ->orLike('LOWER(excerpt)', strtolower($q))
                        ->orLike('LOWER(content)', strtolower($q))
                        ->orLike('LOWER(category_name)', strtolower($q))
                    ->groupEnd()
                    ->orderBy('id', 'DESC')
                    ->get()
                    ->getResultArray();
            }
            if (empty($articles)) {
                $presetArticles = [
                    ['id' => 'art-1', 'title' => '5 Cara Memilih Sunscreen Anak yang Aman & Tidak Lengket', 'excerpt' => 'Pastikan kulit sensitif buah hati terlindungi dari bahaya sinar UV dengan panduan pemilihan sunscreen ramah anak dan bebas bahan kimia berbahaya.', 'category_name' => 'Kesehatan', 'slug' => '5-cara-memilih-sunscreen-anak-yang-aman-dan-tidak-lengket', 'image' => base_url('images/cand-toddler-outdoors.jpg')],
                    ['id' => 'art-2', 'title' => 'Trik Menangani Anak Tantrum di Tempat Umum Tanpa Panik', 'excerpt' => 'Panduan praktis menenangkan emosi balita saat tantrum di keramaian menggunakan metode komunikasi validasi emosi & regulasi diri.', 'category_name' => 'Parenting', 'slug' => 'trik-menangani-anak-tantrum-di-tempat-umum-tanpa-panik', 'image' => base_url('images/cand-father-son.jpg')],
                    ['id' => 'art-3', 'title' => 'Kebutuhan Nutrisi & Suplementasi Otak Anak Usia Emas (1-5 Tahun)', 'excerpt' => 'Asupan gizi mikro seperti DHA, AA, Omega-3, dan Zat Besi yang optimal untuk mendukung perkembangan sel otak anak.', 'category_name' => 'Tumbuh Kembang', 'slug' => 'kebutuhan-nutrisi-dan-suplementasi-otak-anak-usia-emas', 'image' => base_url('images/cand-mother-child.jpg')],
                    ['id' => 'art-4', 'title' => 'Mengenal Tanda Keterlambatan Bicara (Speech Delay) & Stimulasinya', 'excerpt' => 'Kapan orang tua perlu waspada? Pelajari milestone sensoris bicara anak dan latihan interaktif mandiri di rumah.', 'category_name' => 'Kebutuhan Khusus', 'slug' => 'mengenal-tanda-keterlambatan-bicara-speech-delay-dan-stimulasinya', 'image' => base_url('images/cand-playing.jpg')],
                    ['id' => 'art-5', 'title' => 'Panduan Aman Melatih Balita Buang Air Sendiri (Toilet Training)', 'excerpt' => 'Langkah bertahap melatih anak lepas pampers secara menyenangkan tanpa paksaan dan bebas stres bagi ibu.', 'category_name' => 'Parenting', 'slug' => 'panduan-aman-melatih-balita-buang-air-sendiri-toilet-training', 'image' => base_url('images/cand-happy-family.jpg')],
                ];
                foreach ($presetArticles as $art) {
                    $haystack = strtolower($art['title'] . ' ' . $art['excerpt'] . ' ' . $art['category_name']);
                    if (strpos($haystack, strtolower($q)) !== false) {
                        $articles[] = $art;
                    }
                }
            }

            // 2. DIREKTORI & PENDIDIKAN
            if ($db->tableExists('directory_places')) {
                $dirs = $db->table('directory_places')
                    ->groupStart()
                        ->like('LOWER(nama)', strtolower($q))
                        ->orLike('LOWER(lokasi)', strtolower($q))
                        ->orLike('LOWER(category)', strtolower($q))
                        ->orLike('LOWER(deskripsi)', strtolower($q))
                    ->groupEnd()
                    ->get()
                    ->getResultArray();
                foreach ($dirs as $d) {
                    $d['type_label'] = 'Tempat Asuh / Daycare';
                    $d['url'] = base_url('tempat-asuh/detail/' . ($d['slug'] ?? $d['id']));
                    $directories[] = $d;
                }
            }
            if ($db->tableExists('education_places')) {
                $edus = $db->table('education_places')
                    ->groupStart()
                        ->like('LOWER(nama)', strtolower($q))
                        ->orLike('LOWER(lokasi)', strtolower($q))
                        ->orLike('LOWER(category)', strtolower($q))
                        ->orLike('LOWER(deskripsi)', strtolower($q))
                    ->groupEnd()
                    ->get()
                    ->getResultArray();
                foreach ($edus as $e) {
                    $e['type_label'] = 'Lembaga Pendidikan';
                    $e['url'] = base_url('pendidikan/' . ($e['category'] ?? 'semua') . '/' . ($e['slug'] ?? $e['id']));
                    $directories[] = $e;
                }
            }

            // 3. NANNY & PENGASUH
            if ($db->tableExists('nannies')) {
                $nannies = $db->table('nannies')
                    ->groupStart()
                        ->like('LOWER(nama)', strtolower($q))
                        ->orLike('LOWER(lokasi)', strtolower($q))
                        ->orLike('LOWER(pengalaman)', strtolower($q))
                        ->orLike('LOWER(deskripsi)', strtolower($q))
                    ->groupEnd()
                    ->get()
                    ->getResultArray();
            }

            // 4. MENU & RESEP MPASI
            $presetMenus = [
                [
                    'title' => 'Chicken Bolognese Porridge (Promina + Devina Hermawan)',
                    'desc' => 'Perpaduan paha ayam giling, saus bolognese tomat wortel oregano segar, dan Promina Bubur Tim Ayam Kampung.',
                    'age' => '8–12 Bulan',
                    'tag' => 'Booster BB',
                    'ingredients' => 'Paha Ayam Giling 50g, Tomat 1 buah, Bawang Bombai 15g, Bawang Putih, Seledri, Wortel 20g, Oregano, Promina Bubur Tim',
                    'image' => base_url('images/mother_cooking_mpasi.jpg'),
                    'url' => base_url('menu#resep-bolognese')
                ],
                [
                    'title' => 'Bubur Sup Telur Wortel (Simple & Mudah)',
                    'desc' => 'Bubur MPASI praktis tinggi protein dari telur ayam segar, tahu lembut, wortel manis, dan kaldu sapi gurih.',
                    'age' => '6–12 Bulan',
                    'tag' => 'Praktis Dapur',
                    'ingredients' => 'Nasi 60g, Telur Ayam 1 butir, Wortel 2 ruas jari, Tahu 1/2 kotak, Bawang Merah, Bawang Putih, Seledri, Kaldu Sapi 30ml',
                    'image' => base_url('images/mother_cooking_mpasi.jpg'),
                    'url' => base_url('menu#resep-sup-telur')
                ],
                [
                    'title' => 'Bubur Ayam Mentega (Creamy & Wangi)',
                    'desc' => 'Bubur tinggi kalori dengan tumisan paha ayam mentega gurih, telur ayam, dan wortel kaya vitamin A.',
                    'age' => '6–12 Bulan',
                    'tag' => 'Tinggi Kalori',
                    'ingredients' => 'Beras 3 sdm, Kaldu Ayam 300ml, Daging Ayam 40g, Telur 1 butir, Wortel, Mentega / Margarin 1 sdm',
                    'image' => base_url('images/mother_cooking_mpasi.jpg'),
                    'url' => base_url('menu#resep-ayam-mentega')
                ],
                [
                    'title' => 'Puree Buah Segar MPASI (Apel, Ubi, Wortel, Pepaya, Buah Naga, Alpukat)',
                    'desc' => 'Aneka puree lembut buah segar kaya serat & vitamin untuk perkenalan MPASI pertama bayi 6 bulan.',
                    'age' => '6+ Bulan',
                    'tag' => 'Puree MPASI',
                    'ingredients' => 'Apel, Ubi Manis, Wortel Kukus, Pepaya, Buah Naga Merah, Alpukat Lembut',
                    'image' => base_url('images/mother_cooking_mpasi.jpg'),
                    'url' => base_url('menu#puree-mpasi')
                ]
            ];
            foreach ($presetMenus as $m) {
                $haystack = strtolower($m['title'] . ' ' . $m['desc'] . ' ' . $m['ingredients'] . ' ' . $m['age'] . ' ' . $m['tag']);
                if (strpos($haystack, strtolower($q)) !== false) {
                    $menus[] = $m;
                }
            }

            // 5. TOKO & PRODUK REKOMENDASI
            if ($db->tableExists('shop_products')) {
                $shopItems = $db->table('shop_products')
                    ->groupStart()
                        ->like('LOWER(name)', strtolower($q))
                        ->orLike('LOWER(subtext)', strtolower($q))
                        ->orLike('LOWER(category)', strtolower($q))
                        ->orLike('LOWER(badge)', strtolower($q))
                    ->groupEnd()
                    ->where('is_active', 1)
                    ->get()
                    ->getResultArray();
            }
        }

        $totalCount = count($articles) + count($directories) + count($nannies) + count($menus) + count($shopItems);

        return view('pages/search', [
            'title'       => 'Pencarian: ' . ($q ? esc($q) : 'Semua Rekomendasi') . ' - Parentela',
            'q'           => $q,
            'articles'    => $articles,
            'directories' => $directories,
            'nannies'     => $nannies,
            'menus'       => $menus,
            'shopItems'   => $shopItems,
            'totalCount'  => $totalCount
        ]);
    }

    public function articles($category = null)
    {
        $categoryMap = [
            'semua'           => 'Semua Kategori',
            'tumbuh-kembang'  => 'Tumbuh Kembang',
            'kesehatan'       => 'Kesehatan',
            'kebutuhan-khusus'=> 'Kebutuhan Khusus',
            'kebugaran'       => 'Kebugaran',
            'parenting'       => 'Parenting',
            'gaya-hidup'      => 'Gaya Hidup',
            'video-aman'      => 'Video Aman Anak',
            'video-edukasi'   => 'Video Aman Anak',
            // Kompatibilitas slug rute lama & redirect:
            'tayangan-ulang'  => 'Video Aman Anak',
            'diskusi'         => 'Parenting',
            'gizi'            => 'Gaya Hidup',
            'resep'           => 'Gaya Hidup',
            'kulit-kesehatan' => 'Kesehatan',
            'istirahat'       => 'Parenting'
        ];

        // Normalisasi slug kategori lama ke kategori baru
        $categoryAliases = [
            'gizi'            => 'gaya-hidup',
            'resep'           => 'gaya-hidup',
            'kulit-kesehatan' => 'kesehatan',
            'istirahat'       => 'parenting',
            'tayangan-ulang'  => 'video-aman',
            'video-edukasi'   => 'video-aman',
            'diskusi'         => 'parenting'
        ];

        $activeCategorySlug = $category ?? 'semua';
        $normalizedCategory = $categoryAliases[$activeCategorySlug] ?? $activeCategorySlug;
        $categoryName = $categoryMap[$activeCategorySlug] ?? ucwords(str_replace('-', ' ', $activeCategorySlug));

        // 1. Ambil Artikel Dinamis dari Database (Portal Admin)
        $db = \Config\Database::connect();
        $dbArticles = [];
        if ($db->tableExists('articles')) {
            $dbRows = $db->table('articles')->orderBy('id', 'DESC')->get()->getResultArray();
            foreach ($dbRows as $r) {
                if (!empty($r['status']) && $r['status'] !== 'published') {
                    continue;
                }

                $subtags = [];
                if (!empty($r['subtags'])) {
                    $decoded = json_decode($r['subtags'], true);
                    if (is_array($decoded)) {
                        $subtags = $decoded;
                    } else {
                        $subtags = array_filter(array_map('trim', explode(',', $r['subtags'])));
                    }
                }
                if (empty($subtags)) {
                    $subtags = [$r['category_name'] ?? 'Parenting', $r['age_label'] ?? 'Semua Usia'];
                }

                $img = $r['image'] ?: ($r['thumbnail'] ?: '');
                if (!empty($img)) {
                    if (strpos($img, 'http://') !== 0 && strpos($img, 'https://') !== 0) {
                        $img = base_url($img);
                    }
                } else {
                    $img = base_url('images/cand-toddler-outdoors.jpg');
                }

                $dbArticles[] = [
                    'id'            => (string)$r['id'],
                    'slug'          => $r['slug'] ?: url_title(strtolower($r['title']), '-', true),
                    'title'         => $r['title'],
                    'excerpt'       => $r['excerpt'] ?: (mb_substr(strip_tags($r['content'] ?? ''), 0, 140) . '...'),
                    'category_slug' => $r['category_slug'] ?? 'parenting',
                    'category_name' => $r['category_name'] ?? 'Parenting',
                    'age_slug'      => $r['age_slug'] ?? 'semua-usia',
                    'age_label'     => $r['age_label'] ?? 'Semua Usia',
                    'type'          => $r['type'] ?? 'artikel',
                    'type_label'    => $r['type_label'] ?? (($r['type'] ?? 'artikel') === 'video' ? 'Video' : 'Artikel'),
                    'subtags'       => array_values($subtags),
                    'author'        => $r['author'] ?: 'Redaksi Parentela',
                    'read_time'     => $r['read_time'] ?: '4 mnt baca',
                    'image'         => $img,
                    'saved_type'    => ($r['type'] ?? 'artikel') === 'video' ? 'stimulasi' : 'artikel'
                ];
            }
        }

        $presetArticles = [];

        // Gabungkan Artikel DB & Preset (Dinamis DB tampil di urutan atas)
        $articles = array_merge($dbArticles, $presetArticles);

        // Filter berdasarkan kategori jika ada
        if ($normalizedCategory !== 'semua' && !empty($normalizedCategory)) {
            $articles = array_values(array_filter($articles, function($a) use ($normalizedCategory, $activeCategorySlug) {
                return ($a['category_slug'] === $normalizedCategory || $a['category_slug'] === $activeCategorySlug);
            }));
        }

        return view('pages/articles', [
            'title'              => 'Portal Artikel & Panduan Edukasi Orang Tua - Parentela',
            'activeCategory'     => $activeCategorySlug,
            'normalizedCategory' => $normalizedCategory,
            'categoryName'       => $categoryName,
            'articles'           => $articles
        ]);
    }

    public function articleDetail($slug = null)
    {
        if (empty($slug)) {
            $slug = 'art-1';
        }

        $db = \Config\Database::connect();
        $foundRow = null;

        // 1. Coba Cari di Database Terlebih Dahulu (Integrasi Portal Admin)
        if ($db->tableExists('articles')) {
            $foundRow = $db->table('articles')
                ->where('slug', $slug)
                ->orWhere('id', $slug)
                ->get()
                ->getRowArray();

            if (!$foundRow && is_string($slug)) {
                $allRows = $db->table('articles')->get()->getResultArray();
                foreach ($allRows as $r) {
                    $titleSlug = url_title(strtolower($r['title']), '-', true);
                    if ($titleSlug === strtolower($slug) || (string)$r['id'] === (string)$slug) {
                        $foundRow = $r;
                        break;
                    }
                }
            }
        }

        $content = null;

        if ($foundRow) {
            // Artikel Dinamis dari DB Admin
            $heroImg = $foundRow['image'] ?: ($foundRow['thumbnail'] ?: '');
            if (!empty($heroImg)) {
                if (strpos($heroImg, 'http://') !== 0 && strpos($heroImg, 'https://') !== 0) {
                    $heroImg = base_url($heroImg);
                }
            } else {
                $heroImg = base_url('images/cand-toddler-outdoors.jpg');
            }

            $tags = [];
            if (!empty($foundRow['subtags'])) {
                $decoded = json_decode($foundRow['subtags'], true);
                if (is_array($decoded)) {
                    $tags = $decoded;
                } else {
                    $tags = array_filter(array_map('trim', explode(',', $foundRow['subtags'])));
                }
            }
            if (empty($tags)) {
                $tags = [$foundRow['category_name'] ?? 'Parenting', $foundRow['age_label'] ?? 'Semua Usia', 'Info Sehat'];
            }

            $rawContent = trim((string)($foundRow['content'] ?? ''));
            $paragraphs = [];
            if (!empty($rawContent)) {
                if (strpos($rawContent, '<p>') !== false) {
                    $paragraphs = [$rawContent];
                } else {
                    $chunks = preg_split('/\r\n\r\n|\n\n|\r\r/', $rawContent);
                    foreach ($chunks as $c) {
                        $c = trim($c);
                        if (!empty($c)) {
                            $paragraphs[] = nl2br(esc($c));
                        }
                    }
                }
            }
            if (empty($paragraphs)) {
                $paragraphs = [esc($foundRow['excerpt'] ?: 'Artikel edukatif dari Parentela.')];
            }

            $content = [
                'id'             => (string)$foundRow['id'],
                'slug'           => $foundRow['slug'] ?: (string)$foundRow['id'],
                'type'           => $foundRow['type'] ?? 'artikel',
                'type_label'     => $foundRow['type_label'] ?? (($foundRow['type'] ?? 'artikel') === 'video' ? 'Video' : 'Artikel'),
                'title'          => $foundRow['title'],
                'tags'           => array_values($tags),
                'likes'          => 48,
                'age_label'      => $foundRow['age_label'] ?? 'Semua Usia',
                'author'         => $foundRow['author'] ?: 'Redaksi Parentela',
                'reviewer'       => 'Tim Medis Parentela (dr. Aulia Rahma, Sp.A)',
                'reviewer_role'  => 'Dokter Spesialis Anak & Konsultan Tumbuh Kembang',
                'hero_image'     => $heroImg,
                'paragraphs'     => $paragraphs,
                'points'         => [],
                'tips_box'       => [
                    'title' => 'Catatan Penting Tim Medis Parentela:',
                    'items' => [
                        'Informasi ini disajikan untuk edukasi pengasuhan dan tumbuh kembang anak.',
                        'Konsultasikan selalu kondisi kesehatan anak dengan dokter spesialis anak atau tenaga medis profesional.'
                    ]
                ]
            ];

            if (($foundRow['type'] ?? 'artikel') === 'video') {
                $content['video_youtube_id'] = 'dQw4w9WgXcQ';
                $content['active_episode_title'] = $foundRow['title'];
                $content['episodes'] = [
                    [
                        'number'      => 1,
                        'title'       => $foundRow['title'],
                        'action_text' => 'Tonton Di Sini',
                        'desc'        => $foundRow['excerpt'] ?: 'Saksikan video tayangan edukasi aman anak dari Parentela.',
                        'thumb'       => $heroImg,
                        'video_id'    => 'dQw4w9WgXcQ',
                        'duration'    => '03:30'
                    ]
                ];
            }
        } else {
            // 2. Data Preset Bawaan Berdasarkan Slug/ID yang Diklik
            $presetDetails = [
                'art-1' => [
                    'id'             => 'art-1',
                    'type'           => 'artikel',
                    'type_label'     => 'Artikel',
                    'title'          => '5 Cara Memilih Sunscreen Anak yang Tidak Semua Orang Tahu',
                    'tags'           => ['Kebugaran', 'Gaya Hidup', 'Info Sehat', 'Rekomendasi'],
                    'likes'          => 42,
                    'age_label'      => '2 - 5 tahun',
                    'author'         => 'Rizki Ayu W. P. & Shafira Syafwi',
                    'reviewer'       => 'Tim Medis Parentela (dr. Citra Permata, Sp.KK)',
                    'reviewer_role'  => 'Dokter Spesialis Kulit & Kelamin',
                    'hero_image'     => base_url('images/cand-toddler-outdoors.jpg'),
                    'paragraphs'     => [
                        'Memilih <strong>sunscreen anak</strong> ternyata bukan cuma soal mencari SPF paling tinggi. Apalagi kalau si Kecil aktif bermain di luar, mudah berkeringat, atau punya kulit sensitif. Jenis filter UV, ketahanan terhadap air, hingga kandungan yang mendukung <em>skin barrier</em> juga perlu dipertimbangkan.',
                        'Belum lagi ketika kita dihadapkan dengan pilihan <em>physical sunscreen</em> atau <em>chemical sunscreen</em>, mana yang lebih baik untuk anak? Yuk, kenali 5 hal berikut sebelum memilih sunscreen anak!'
                    ],
                    'points'         => [
                        ['num' => 1, 'title' => 'Pilih sunscreen anak dengan kandungan zinc oxide dan titanium dioxide.', 'desc' => 'Kandungan ini merupakan ciri utama <strong>physical/mineral sunscreen</strong>. Partikel mineral alami ini bekerja layaknya cermin yang memantulkan sinar matahari langsung dari permukaan kulit tanpa diserap ke dalam aliran darah.'],
                        ['num' => 2, 'title' => 'Perhatikan perlindungan Spektrum Luas (Broad Spectrum UVA & UVB).', 'desc' => 'UVA dapat menembus lebih dalam ke lapisan kulit dermis, sementara sinar UVB bertanggung jawab atas kulit terbakar kemerahan (sunburn). Pastikan kemasan memiliki label Broad Spectrum.'],
                        ['num' => 3, 'title' => 'Gunakan kadar SPF 30 hingga 50 untuk paparan matahari tropis.', 'desc' => 'Untuk iklim Indonesia, SPF 30 sudah mampu menyaring hingga 97% sinar UVB, sedangkan SPF 50 memproteksi 98%.'],
                        ['num' => 4, 'title' => 'Prioritaskan formula tahan air (Water-Resistant) bila bermain di air.', 'desc' => 'Bila anak bermain di kolam renang atau pantai, formula tahan air menjaga proteksi bertahan selama 40 hingga 80 menit.'],
                        ['num' => 5, 'title' => 'Lakukan uji tempel (Patch Test) 24 jam sebelum pemakaian menyeluruh.', 'desc' => 'Oleskan sedikit produk pada area belakang telinga atau lipatan siku si kecil. Amati selama 24 jam.']
                    ],
                    'tips_box'       => [
                        'title' => 'Catatan Penting Dokter Anak:',
                        'items' => [
                            'Bayi di bawah usia 6 bulan sebaiknya dihindarkan dari paparan langsung sinar matahari terik.',
                            'Gunakan takaran sunscreen setara satu sendok teh untuk seluruh area wajah dan leher anak.'
                        ]
                    ]
                ],
                'art-2' => [
                    'id'             => 'art-2',
                    'type'           => 'artikel',
                    'type_label'     => 'Artikel',
                    'title'          => 'Cara Memilih Lotion Anak untuk Kulit Sensitif & Eksim',
                    'tags'           => ['Kesehatan', 'Kulit Bayi', 'Info Sehat', 'Rekomendasi'],
                    'likes'          => 38,
                    'age_label'      => '0 - 6 bulan',
                    'author'         => 'dr. Sp.KK Citra Permata',
                    'reviewer'       => 'Tim Medis Parentela (dr. Citra Permata, Sp.KK)',
                    'reviewer_role'  => 'Dokter Spesialis Kulit & Kelamin',
                    'hero_image'     => base_url('images/blog/kulit-bayi.jpg'),
                    'paragraphs'     => [
                        'Kulit bayi dan balita memiliki lapisan epidermal 30% lebih tipis dibanding kulit orang dewasa, sehingga kelembapannya sangat mudah menguap dan rentan terserang iritasi maupun kambuhnya eksim (dermatitis atopik).',
                        'Memilih lotion pelembap harian untuk anak dengan kulit sensitif memerlukan kejelian membaca label produk agar terhindar dari zat aditif pemicu alergi.'
                    ],
                    'points'         => [
                        ['num' => 1, 'title' => 'Utamakan formula Hipoalergenik & Fragrance-Free', 'desc' => 'Parfum atau wewangian sintetis adalah penyebab nomor satu reaksi alergi kontak pada kulit balita.'],
                        ['num' => 2, 'title' => 'Pilih kandungan Ceramide & Fatty Acids', 'desc' => 'Ceramide membantu memperbaiki lapisan pelindung (*skin barrier*) alami kulit yang rusak akibat gesekan pakaian atau suhu udara dingin.'],
                        ['num' => 3, 'title' => 'Gunakan Krim (Cream/Ointment) saat eksim kambuh', 'desc' => 'Krim emolen pekat mengunci kelembapan jauh lebih lama dibanding lotion encer pada area kering seperti lipatan siku dan lutut.']
                    ],
                    'tips_box'       => [
                        'title' => 'Panduan Aplikasi Pelembap:',
                        'items' => [
                            'Oleskan pelembap dalam waktu 3 menit setelah mandi (Rule of 3 Minutes) saat kulit masih setengah basah.',
                            'Hindari menggosok kulit anak terlalu kencang; tepuk-tepuk lembut produk hingga meresap.'
                        ]
                    ]
                ],
                'art-3' => [
                    'id'             => 'art-3',
                    'type'           => 'artikel',
                    'type_label'     => 'Artikel',
                    'title'          => 'Cara Memilih Odol Anak: Kenapa Fluoride Penting untuk Gigi Susu?',
                    'tags'           => ['Kesehatan', 'Gigi Susu', 'Info Sehat', 'Pola Asuh'],
                    'likes'          => 54,
                    'age_label'      => '2 - 5 tahun',
                    'author'         => 'drg. Maya Sari, Sp.KGA',
                    'reviewer'       => 'Tim Medis Parentela (drg. Maya Sari, Sp.KGA)',
                    'reviewer_role'  => 'Dokter Gigi Anak',
                    'hero_image'     => base_url('images/cand-child-smile.jpg'),
                    'paragraphs'     => [
                        'Gigi susu yang sehat merupakan fondasi utama bagi struktur rahang dan deretan gigi permanen di masa depan. Sayangnya, karies gigi dini pada balita masih sering dijumpai akibat paparan gula dan kebiasaan minum susu hingga tertidur.',
                        'Banyak orang tua khawatir memberikan pasta gigi berfluoride. Padahal, menurut rekomendasi IDAI dan Ikatan Dokter Gigi Anak Indonesia (IDGAI), fluoride sangat aman dan penting digunakan sejak gigi pertama tumbuh, selama takarannya tepat!'
                    ],
                    'points'         => [
                        ['num' => 1, 'title' => 'Takaran Seukuran Biji Beras (Smear) Usia 0-2 Tahun', 'desc' => 'Dosis tipis ini sangat aman meskipun balita belum mahir meludah, memberikan proteksi enamel tanpa bahaya fluorosis.'],
                        ['num' => 2, 'title' => 'Takaran Seukuran Biji Kacang Polong (Pea-sized) Usia 2-5 Tahun', 'desc' => 'Begitu anak bisa meludah setelah menyikat gigi, gunakan takaran sebesar kacang polong secara teratur 2 kali sehari.'],
                        ['num' => 3, 'title' => 'Gunakan Kadar Fluoride 1000 ppm', 'desc' => 'Pilih pasta gigi ramah anak dengan formulasi 1000 ppm fluoride tanpa tambahan gula berlebih.']
                    ],
                    'tips_box'       => [
                        'title' => 'Tips Merawat Gigi Balita:',
                        'items' => [
                            'Sikat gigi 2 kali sehari: pagi setelah sarapan dan malam sebelum tidur.',
                            'Dampingi anak menyikat gigi hingga usia 7 tahun untuk memastikan seluruh area gigi bersih.'
                        ]
                    ]
                ],
                'art-video-1' => [
                    'id'             => 'art-video-1',
                    'type'           => 'video',
                    'type_label'     => 'Video',
                    'title'          => 'Libur Panjang Anak Tanpa Drama Screen Time: Tontonan Film Animasi dari Parentela 3 Menit yang Aman & Bermakna',
                    'tags'           => ['Video Aman Anak', 'Parenting', 'Pola Asuh'],
                    'likes'          => 45,
                    'age_label'      => '2 - 5 tahun',
                    'author'         => 'Sitti Rochmayati',
                    'reviewer'       => 'dr. Aulia Rahma, Sp.A (Dokter Spesialis Anak)',
                    'reviewer_role'  => 'Dokter Spesialis Anak & Konsultan Tumbuh Kembang',
                    'hero_image'     => base_url('images/cand-child-learning.jpg'),
                    'video_youtube_id' => 'dQw4w9WgXcQ',
                    'active_episode_title' => 'SANG EP.01 - Kenapa Harus Berbagi?',
                    'episodes'       => [
                        ['number' => 1, 'title' => 'Episode 1: Kenapa Harus Berbagi?', 'action_text' => 'Tonton Di Sini', 'desc' => 'Mengajak anak memahami empati dan kebersamaan lewat situasi sederhana.', 'thumb' => base_url('images/cand-child-reading.jpg'), 'video_id' => 'dQw4w9WgXcQ', 'duration' => '03:15'],
                        ['number' => 2, 'title' => 'Episode 2: Kenapa Perlu Berterima Kasih?', 'action_text' => 'Tonton Di Sini', 'desc' => 'Mengenalkan rasa syukur dan apresiasi melalui aktivitas harian.', 'thumb' => base_url('images/cand-talk-1.jpg'), 'video_id' => 'dQw4w9WgXcQ', 'duration' => '03:20'],
                        ['number' => 3, 'title' => 'Episode 3: Kenapa Butuh Maaf & Tolong?', 'action_text' => 'Tonton Di Sini', 'desc' => 'Membantu anak mengenali emosi dan belajar berkomunikasi asertif.', 'thumb' => base_url('images/cand-kid-happy.jpg'), 'video_id' => 'dQw4w9WgXcQ', 'duration' => '03:40'],
                    ],
                    'paragraphs'     => [
                        'Di tengah maraknya rekomendasi film animasi berdurasi panjang di bioskop dan berbagai platform streaming, kini muncul kebutuhan baru yang semakin banyak dicari orang tua Indonesia: tontonan edukasi anak yang singkat, aman untuk screen time, dan tetap bermakna terutama saat libur panjang anak.',
                        'Salah satu tontonan yang mulai banyak diperbincangkan adalah <strong>SANG</strong>, serial animasi edukasi anak dari Parentela yang tayang gratis. Animasi ini dirancang khusus bersama dokter anak dan psikolog anak untuk menemani anak selama libur sekolah.',
                        'Setiap episodenya dibatasi berdurasi tepat 3 menit dengan tempo visual tenang tanpa fast-cuts yang menyilaukan, sehingga tidak memicu stimulasi dopamin berlebihan.'
                    ],
                    'tips_box'       => [
                        'title' => 'Panduan Screen Time Aman Menurut IDAI & WHO:',
                        'items' => [
                            'Anak usia 2 - 5 tahun: Maksimal 1 jam per hari dengan konten berkualitas.',
                            'Selalu dampingi si kecil (co-viewing) dan ajak berdiskusi tentang apa yang ditonton.'
                        ]
                    ]
                ]
            ];

            // Cari di preset berdasarkan ID atau Slug
            if (isset($presetDetails[$slug])) {
                $content = $presetDetails[$slug];
            } else {
                // Cari preset berdasarkan substring slug/id
                foreach ($presetDetails as $pKey => $pVal) {
                    if (strpos($slug, $pKey) !== false || (isset($pVal['slug']) && strpos($slug, $pVal['slug']) !== false)) {
                        $content = $pVal;
                        break;
                    }
                }
            }

            // Fallback generik jika slug preset lain dibuka
            if (!$content) {
                // Cari data ringkas preset dari daftar artikel
                $articlesPreset = [
                    'art-4'  => ['title' => 'Vitamin D: Dampaknya ke Tinggi Badan Anak & Kekebalan Tubuh', 'cat' => 'Tumbuh Kembang', 'img' => base_url('images/cand-kid-happy.jpg'), 'author' => 'dr. Budi Setiawan, Sp.A(K)'],
                    'art-5'  => ['title' => 'Vitamin Penambah Nafsu Makan Anak: Manfaat & Waktu Terbaik Diberikan', 'cat' => 'Tumbuh Kembang', 'img' => base_url('images/mpasi-sample.jpg'), 'author' => 'Klinik Gizi Anak Parentela'],
                    'art-6'  => ['title' => 'Trik Mengatasi Anak Susah Makan (GTM - Gerakan Tutup Mulut)', 'cat' => 'Tumbuh Kembang', 'img' => base_url('images/cand-baby-curious.jpg'), 'author' => 'dr. Aulia Rahma, Sp.A'],
                    'art-7'  => ['title' => '7 Resep MPASI Tinggi Zat Besi & Protein Hewani untuk Cegah Stunting', 'cat' => 'Gaya Hidup', 'img' => base_url('images/blog/mpasi-sehat.jpg'), 'author' => 'Chef & Nutrisi Bunda'],
                    'art-8'  => ['title' => 'Deteksi Dini Speech Delay & Stimulasi Bicara Efektif di Rumah', 'cat' => 'Kebutuhan Khusus', 'img' => base_url('images/cand-talk-1.jpg'), 'author' => 'Terapis Wicara Parentela'],
                    'art-9'  => ['title' => 'Terapi Sensori Integrasi Rumahan untuk Anak Aktif & Sensitif Cahaya', 'cat' => 'Kebutuhan Khusus', 'img' => base_url('images/cand-child-learning.jpg'), 'author' => 'Tim Terapis Tumbuh Kembang'],
                    'art-10' => ['title' => 'Aktivitas Fisik & Olahraga Menyenangkan untuk Melatih Motorik Kasar', 'cat' => 'Kebugaran', 'img' => base_url('images/cand-girl-smile.jpg'), 'author' => 'Pelatih Kebugaran Anak'],
                    'art-11' => ['title' => 'Menangani Tantrum Balita dengan Pendekatan Gentle Parenting', 'cat' => 'Parenting', 'img' => base_url('images/toddler-mom.jpg'), 'author' => 'Psikolog Keluarga Parentela'],
                    'art-12' => ['title' => 'Tips Mempersiapkan Kakak Menyambut Kehadiran Adik Baru', 'cat' => 'Parenting', 'img' => base_url('images/smiling-baby-sample.jpg'), 'author' => 'Konselor Parenting'],
                    'art-13' => ['title' => 'Nutrisi Penting Ibu Selama Hamil Trimester Pertama (0 - 12 Minggu)', 'cat' => 'Gaya Hidup', 'img' => base_url('images/mother-child-reading.jpg'), 'author' => 'dr. Sp.OG Rina Wulandari'],
                    'art-14' => ['title' => '[Video] Animasi Lagu Edukasi Mengenal Warna, Angka & Buah', 'cat' => 'Video Aman Anak', 'img' => base_url('images/cand-child-reading.jpg'), 'author' => 'Studio Edukasi Parentela', 'type' => 'video'],
                    'art-15' => ['title' => '[Video] Gerak Senam Ceria: Melatih Koordinasi Tubuh & Kelincahan', 'cat' => 'Video Aman Anak', 'img' => base_url('images/cand-toddler-outdoors.jpg'), 'author' => 'Instruktur Anak Parentela', 'type' => 'video'],
                    'art-16' => ['title' => '[Webinar] Tanya Dokter Anak: Kupas Tuntas Alergi & Penyakit Kulit Bayi', 'cat' => 'Kesehatan', 'img' => base_url('images/cand-talk-2.jpg'), 'author' => 'dr. Aulia Rahma, Sp.A', 'type' => 'video'],
                    'art-17' => ['title' => '[Video] Kupas Pola Tidur & Membangun Kebiasaan Tidur Mandiri Anak', 'cat' => 'Parenting', 'img' => base_url('images/sleeping-baby-sample.jpg'), 'author' => 'Sleep Coach Parentela', 'type' => 'video'],
                    'art-18' => ['title' => 'Pengalaman Menyapih Balita Usia 2 Tahun dengan Kasih Sayang', 'cat' => 'Parenting', 'img' => base_url('images/cand-mother-child.jpg'), 'author' => 'Nadia Safitri, M.Psi., Psikolog'],
                    'art-19' => ['title' => 'Trik Menghadapi Anak Pilih-Pilih Makanan (Picky Eater)', 'cat' => 'Gaya Hidup', 'img' => base_url('images/cand-talk-3.jpg'), 'author' => 'dr. Ryan Hartanto, Sp.A & Ahli Gizi']
                ];

                $presetItem = $articlesPreset[$slug] ?? null;
                $isVid = isset($presetItem['type']) && $presetItem['type'] === 'video';

                $titleText = $presetItem['title'] ?? ucwords(str_replace('-', ' ', $slug));
                $catText   = $presetItem['cat'] ?? 'Parenting';
                $imgUrl    = $presetItem['img'] ?? base_url('images/cand-toddler-outdoors.jpg');
                $authorTxt = $presetItem['author'] ?? 'Redaksi Parentela';

                $content = [
                    'id'             => $slug,
                    'slug'           => $slug,
                    'type'           => $isVid ? 'video' : 'artikel',
                    'type_label'     => $isVid ? 'Video' : 'Artikel',
                    'title'          => $titleText,
                    'tags'           => [$catText, 'Parenting', 'Tumbuh Kembang'],
                    'likes'          => 36,
                    'age_label'      => '2 - 5 tahun',
                    'author'         => $authorTxt,
                    'reviewer'       => 'Tim Medis Parentela (dr. Aulia Rahma, Sp.A)',
                    'reviewer_role'  => 'Dokter Spesialis Anak & Konsultan Tumbuh Kembang',
                    'hero_image'     => $imgUrl,
                    'paragraphs'     => [
                        'Panduan dan pembahasan komprehensif mengenai ' . esc($titleText) . ' untuk mendampingi pengasuhan buah hati Ayah & Bunda.',
                        'Setiap langkah perkembangan dan nutrisi anak disesuaikan dengan standar tumbuh kembang serta arahan dokter spesialis anak terpercaya.'
                    ],
                    'points'         => [],
                    'tips_box'       => [
                        'title' => 'Catatan Penting Tim Medis Parentela:',
                        'items' => [
                            'Pastikan kebutuhan nutrisi dan stimulasi harian anak terpenuhi secara seimbang.',
                            'Konsultasikan secara berkala tumbuh kembang si kecil dengan fasilitas pelayanan kesehatan terdekat.'
                        ]
                    ]
                ];

                if ($isVid) {
                    $content['video_youtube_id'] = 'dQw4w9WgXcQ';
                    $content['active_episode_title'] = $titleText;
                    $content['episodes'] = [
                        [
                            'number'      => 1,
                            'title'       => $titleText,
                            'action_text' => 'Tonton Di Sini',
                            'desc'        => 'Saksikan tayangan video edukasi aman anak persembahan dari Parentela.',
                            'thumb'       => $imgUrl,
                            'video_id'    => 'dQw4w9WgXcQ',
                            'duration'    => '04:15'
                        ]
                    ];
                }
            }
        }

        // Konten Terkait untuk Sidebar Desktop (PC)
        $relatedItems = [
            [
                'id'       => ($content['type'] === 'video') ? 'art-1' : 'art-video-1',
                'title'    => ($content['type'] === 'video') ? '5 Cara Memilih Sunscreen Anak yang Tidak Semua Orang Tahu' : 'Libur Panjang Anak Tanpa Drama Screen Time: Animasi 3 Menit',
                'type'     => ($content['type'] === 'video') ? 'artikel' : 'video',
                'type_lbl' => ($content['type'] === 'video') ? 'Artikel' : 'Video',
                'category' => ($content['type'] === 'video') ? 'Kesehatan' : 'Video Aman Anak',
                'image'    => ($content['type'] === 'video') ? base_url('images/cand-toddler-outdoors.jpg') : base_url('images/cand-child-learning.jpg'),
                'read_time'=> ($content['type'] === 'video') ? '4 mnt baca' : '3 mnt video'
            ],
            [
                'id'       => 'art-3',
                'title'    => 'Cara Memilih Odol Anak: Kenapa Fluoride Penting untuk Gigi Susu?',
                'type'     => 'artikel',
                'type_lbl' => 'Artikel',
                'category' => 'Kesehatan',
                'image'    => base_url('images/cand-child-smile.jpg'),
                'read_time'=> '3 mnt baca'
            ],
            [
                'id'       => 'art-6',
                'title'    => 'Trik Mengatasi Anak Susah Makan (GTM) Tanpa Paksaan',
                'type'     => 'artikel',
                'type_lbl' => 'Artikel',
                'category' => 'Tumbuh Kembang',
                'image'    => base_url('images/cand-baby-curious.jpg'),
                'read_time'=> '6 mnt baca'
            ]
        ];

        return view('pages/article_detail', [
            'title'        => $content['title'] . ' - Parentela',
            'content'      => $content,
            'relatedItems' => $relatedItems
        ]);
    }

    public function tempatAsuh($type = null)
    {
        if ($redirect = $this->requireLogin('Silakan masuk ke akun Anda terlebih dahulu untuk mengakses Direktori Tempat Asuh.')) {
            return $redirect;
        }

        $directoryModel = new \App\Models\DirectoryModel();

        $categoryMap = [
            'daycare'            => 'Daycare & Tempat Penitipan Anak',
            'nursery-room'       => 'Nursery Room & Ruang Laktasi',
            'playground'         => 'Playground Ramah Anak',
            'taman-bacaan'       => 'Taman Bacaan Masyarakat',
            'panti-asuhan'       => 'Panti Asuhan & Lembaga Sosial',
            'nursery-playground' => 'Nursery & Playground'
        ];

        $typeName = $type ? ($categoryMap[$type] ?? ucwords(str_replace('-', ' ', (string)$type))) : 'Direktori Tempat Asuh';

        // Ambil semua data direktori dari DB 1x (diurutkan verifikasi & ID)
        $allPlaces = $directoryModel->orderBy('is_verified', 'DESC')->orderBy('id', 'ASC')->findAll() ?? [];

        // Hitung statistik per kategori untuk tab badges
        $pantiList       = array_values(array_filter($allPlaces, fn($p) => ($p['category'] ?? '') === 'panti-asuhan'));
        $daycareList     = array_values(array_filter($allPlaces, fn($p) => ($p['category'] ?? '') === 'daycare'));
        $nurseryPlayList = array_values(array_filter($allPlaces, fn($p) => in_array($p['category'] ?? '', ['nursery-playground', 'nursery-room', 'playground'])));
        $tamanBacaanList = array_values(array_filter($allPlaces, fn($p) => ($p['category'] ?? '') === 'taman-bacaan'));

        // Filter data $places sesuai kategori aktif
        if ($type && $type !== 'semua' && $type !== 'all') {
            if ($type === 'nursery-room' || $type === 'playground' || $type === 'nursery-playground') {
                $places = array_values(array_filter($allPlaces, fn($p) => in_array($p['category'] ?? '', ['nursery-playground', 'nursery-room', 'playground'])));
            } else {
                $places = array_values(array_filter($allPlaces, fn($p) => ($p['category'] ?? '') === $type));
            }
        } else {
            $places = $allPlaces;
        }

        $catLabels = [
            'panti-asuhan'       => 'Panti Asuhan',
            'daycare'            => 'Daycare',
            'nursery-playground' => 'Nursery & Play',
            'nursery-room'       => 'Nursery Room',
            'playground'         => 'Playground',
            'taman-bacaan'       => 'Taman Bacaan'
        ];

        foreach ($places as &$place) {
            $place['category_label'] = $catLabels[$place['category'] ?? ''] ?? ucfirst($place['category'] ?? '');
        }
        unset($place);

        return view('pages/directory', [
            'title'            => $typeName . ' - Parentela',
            'sectionType'      => 'asuh',
            'activeType'       => $type ?? 'semua',
            'typeName'         => $typeName,
            'places'           => $places,
            'pantiList'        => $pantiList,
            'daycareList'      => $daycareList,
            'nurseryPlayList'  => $nurseryPlayList,
            'tamanBacaanList'  => $tamanBacaanList
        ]);
    }

    public function pendidikan($category = null, $sub = null)
    {
        if ($redirect = $this->requireLogin('Silakan masuk ke akun Anda terlebih dahulu untuk mengakses Direktori Pendidikan.')) {
            return $redirect;
        }

        // Landing page ketika tidak ada kategori
        if (empty($category) || $category === 'semua') {
            // Hitung jumlah data dari database + statis
            $db = \Config\Database::connect();
            $totalFormal = 0; // jumlah preset statis formal
            $totalNonformal = 1; // jumlah preset statis nonformal (Tumble Tots)
            if ($db->tableExists('education_places')) {
                $totalFormal += $db->table('education_places')
                    ->whereIn('category', ['tk', 'sd', 'smp', 'sma', 'smk', 'slb', 'formal'])
                    ->countAllResults();
                $totalNonformal += $db->table('education_places')
                    ->whereNotIn('category', ['tk', 'sd', 'smp', 'sma', 'smk', 'slb', 'formal'])
                    ->countAllResults();
            }
            return view('pages/pendidikan_landing', [
                'title'          => 'Direktori Pendidikan Anak Surabaya - Parentela',
                'totalFormal'    => $totalFormal,
                'totalNonformal' => $totalNonformal,
            ]);
        }

        // Normalisasi kategori
        if ($category === 'kursus') {
            $category = 'nonformal';
            $sub = 'kursus';
        } elseif (in_array($category, ['tk', 'sd', 'smp', 'sma', 'smk'])) {
            $sub = $category;
            $category = 'formal';
        }

        if (empty($sub)) {
            $sub = 'semua';
        }

        // Data Lembaga Pendidikan Formal di Surabaya (Hanya dari DB)
        $sekolahFormal = [];

        // Data Lembaga Pendidikan Nonformal & Kursus Minat Bakat di Surabaya
        $lembagaNonformal = [
            // Seni & Musik
            [
                'kategori'      => 'seni-musik',
                'kategori_label'=> '🎨 Seni & Musik',
                'nama'          => 'Purwa Caraka Music Studio Surabaya',
                'lokasi'        => '📍 Jl. Klampis Jaya No.15, Sukolilo, Surabaya',
                'rentang_usia'  => 'Usia 4 - 18 Tahun',
                'program_fokus' => 'Vokal, Piano, Biola, Drum, Gitar & Keyboard',
                'deskripsi'     => 'Lembaga kursus musik profesional terkemuka dengan kurikulum berjenjang, sertifikasi ujian berkala, dan wadah resital konser tahunan bagi siswa.',
                'fasilitas'     => ['Studio kedap suara ber-AC', 'Instrumen musik standar konser', 'Sertifikasi internasional', 'Kelas privat & ensemble'],
                'image'         => 'https://images.unsplash.com/photo-1514525253161-7a46d19cd819?q=80&w=600&auto=format&fit=crop',
                'kontak'        => 'https://purwacarakamusicstudio.com'
            ],
            [
                'kategori'      => 'seni-musik',
                'kategori_label'=> '🎨 Seni & Musik',
                'nama'          => 'Global Art Creative Visual Art Surabaya',
                'lokasi'        => '📍 Jl. Raya Kertajaya Indah No.77, Sukolilo, Surabaya',
                'rentang_usia'  => 'Usia 3 - 16 Tahun',
                'program_fokus' => 'Visual Art, Clay Modeling, Acrylic Painting & Comic Drawing',
                'deskripsi'     => 'Pusat kursus seni rupa anak berstandar internasional yang menstimulasi imajinasi, fokus motorik halus, dan kepercayaan diri berekspresi.',
                'fasilitas'     => ['Studio lukis ramah anak', 'Pewarna & bahan non-toxic bersertifikat', 'Pameran galeri karya siswa', 'Kompetisi seni internasional'],
                'image'         => 'https://images.unsplash.com/photo-1513364776144-60967b0f800f?q=80&w=600&auto=format&fit=crop',
                'kontak'        => 'https://globalart.co.id'
            ],

            // Bimbel & Bahasa
            [
                'kategori'      => 'bimbel-bahasa',
                'kategori_label'=> '📖 Bimbel & Bahasa',
                'nama'          => 'English First (EF) Kids & Teens Surabaya',
                'lokasi'        => '📍 Jl. Kayoon No.38-40 & HR Muhammad, Surabaya',
                'rentang_usia'  => 'Usia 3 - 17 Tahun',
                'program_fokus' => 'Interactive English, Native Speaker, Phonics & Public Speaking',
                'deskripsi'     => 'Kursus bahasa Inggris anak dengan metode interaktif, ruang kelas teknologi tinggi, dan pendampingan pengajar asing (*Native Speaker*) berlisensi.',
                'fasilitas'     => ['Smart Classroom multimedia', 'Life Club aktivitas bahasa luar ruang', 'Sertifikasi kecakapan CEFR global', 'Aplikasi latihan digital di rumah'],
                'image'         => 'https://images.unsplash.com/photo-1523240795612-9a054b0db644?q=80&w=600&auto=format&fit=crop',
                'kontak'        => 'https://ef.co.id'
            ],
            [
                'kategori'      => 'bimbel-bahasa',
                'kategori_label'=> '📖 Bimbel & Bahasa',
                'nama'          => 'Kumon Learning Center Surabaya',
                'lokasi'        => '📍 Tersebar di Rungkut, Dharmahusada, Wiyung & Gubeng',
                'rentang_usia'  => 'Usia 3 Tahun - SMA',
                'program_fokus' => 'Metode Belajar Matematika Mandiri & Pemahaman Bacaan Bahasa',
                'deskripsi'     => 'Metode pembelajaran mandiri nomor satu dari Jepang yang membangun konsentrasi, kecepatan berhitung, serta kemandirian belajar anak.',
                'fasilitas'     => ['Lembar kerja terstruktur bertahap', 'Pendampingan individual terarah', 'Evaluasi kenaikan level berkala', 'Waktu belajar fleksibel'],
                'image'         => 'https://images.unsplash.com/photo-1509062522246-3755977927d7?q=80&w=600&auto=format&fit=crop',
                'kontak'        => 'https://kumon.co.id'
            ],

            // Coding & STEM
            [
                'kategori'      => 'coding-robotik',
                'kategori_label'=> '💻 Coding & Robotik',
                'nama'          => 'Robologics & KodeKiddo Surabaya',
                'lokasi'        => '📍 Jl. Raya Kupang Indah No.10, Sukomanunggal, Surabaya',
                'rentang_usia'  => 'Usia 6 - 16 Tahun',
                'program_fokus' => 'Coding Anak (Scratch & Python), Lego Robotics & AI Cilik',
                'deskripsi'     => 'Pusat pembelajaran teknologi masa depan untuk anak-anak, mengasah logika berpikir komputasional, penyelesaian masalah, dan kreasi game orisinal.',
                'fasilitas'     => ['Kit robotika orisinal Lego Mindstorms', 'Komputer spesifikasi gaming & desain', 'Mentor praktisi IT lulusan ternama', 'Keikutsertaan kompetisi robotik nasional'],
                'image'         => 'https://images.unsplash.com/photo-1581092918056-0c4c3acd3789?q=80&w=600&auto=format&fit=crop',
                'kontak'        => 'https://kodekiddo.com'
            ],

            // Olahraga & Bela Diri
            [
                'kategori'      => 'olahraga',
                'kategori_label'=> '⚽ Olahraga & Bela Diri',
                'nama'          => 'Surabaya Swimming School (Dolphin Club)',
                'lokasi'        => '📍 Kolam Renang Kertajaya & Mayjen Sungkono, Surabaya',
                'rentang_usia'  => 'Usia 3 - 15 Tahun',
                'program_fokus' => 'Les Renang Privat Anak, Water Safety & Pembinaan Prestasi Atlet',
                'deskripsi'     => 'Klub renang profesional yang mengajarkan teknik renang yang benar, keselamatan air sejak balita, hingga jenjang pembinaan atlet pelajar.',
                'fasilitas'     => ['Kolam renang air bersih bersirkulasi', 'Pelatih resmi berlisensi PRSI', 'Pendampingan privat 1-on-1 atau semi privat', 'Sertifikat kelulusan gaya renang'],
                'image'         => 'https://images.unsplash.com/photo-1530549387789-4c1017266635?q=80&w=600&auto=format&fit=crop',
                'kontak'        => 'https://parentela.id'
            ],
            [
                'kategori'      => 'olahraga',
                'kategori_label'=> '⚽ Olahraga & Bela Diri',
                'nama'          => 'Dojo Taekwondo & Karate Cendrawasih Surabaya',
                'lokasi'        => '📍 GOR Kertajaya & Gedung Olahraga Manyar, Surabaya',
                'rentang_usia'  => 'Usia 5 - 17 Tahun',
                'program_fokus' => 'Bela Diri Disiplin Karakter, Kebugaran Fisik & Sabuk Resmi',
                'deskripsi'     => 'Dojo seni bela diri yang menekankan rasa hormat, kedisiplinan, ketahanan mental, serta keterampilan perlindungan diri yang aman.',
                'fasilitas'     => ['Matras latihan berstandar turnamen', 'Pelatih DAN berlisensi Pengprov', 'Ujian kenaikan sabuk berkala', 'Kejuaraan antar pelajar se-Surabaya'],
                'image'         => 'https://images.unsplash.com/photo-1555597673-b21d5c935865?q=80&w=600&auto=format&fit=crop',
                'kontak'        => 'https://parentela.id'
            ],

            // Preschool & Montessori
            [
                'kategori'      => 'preschool',
                'kategori_label'=> '🧩 Preschool & Montessori',
                'nama'          => 'Tumble Tots & Kinderland Surabaya',
                'lokasi'        => '📍 Spazio Graha Famili & Manyar Tirtoyoso, Surabaya',
                'rentang_usia'  => 'Usia 6 Bulan - 5 Tahun',
                'program_fokus' => 'Gym Play Anak, Sensory Exploration & Sosialisasi Prasekolah',
                'deskripsi'     => 'Program stimulasi motorik dan sensorik terakreditasi internasional dari Inggris, melatih keseimbangan, kelincahan, dan keberanian anak sejak masa bayi.',
                'fasilitas'     => ['Peralatan gym kayu lembut bersertifikasi UK', 'Ruang kelas ber-AC higienis disterilisasi rutin', 'Fasilitator terlatih ramah anak', 'Kelas pendampingan orang tua (*Parent & Child*)'],
                'image'         => 'https://images.unsplash.com/photo-1587654780291-39c9404d746b?q=80&w=600&auto=format&fit=crop',
                'kontak'        => 'https://tumbletots.co.id'
            ]
        ];

        // ------------------ DYNAMIC DATA FROM DATABASE ------------------
        $eduModel = new \App\Models\EducationModel();
        $dbEducations = $eduModel->orderBy('is_verified', 'DESC')->orderBy('id', 'ASC')->findAll();

        if (!empty($dbEducations)) {
            $catLabelMap = [
                'paud'             => 'PAUD / Prasekolah',
                'tk'               => 'TK / PAUD',
                'sd'               => 'SD / MI',
                'smp'              => 'SMP / MTs',
                'sma'              => 'SMA / SMK',
                'smk'              => 'SMA / SMK',
                'slb'              => 'SLB (Kebutuhan Khusus)',
                'preschool'        => 'Preschool',
                'kelompok-bermain' => 'Kelompok Bermain',
                'bimbel'           => 'Bimbingan Belajar / Les',
                'sanggar'          => 'Sanggar & Kursus'
            ];

            $dbFormal = [];
            $dbNonformal = [];

            foreach ($dbEducations as $e) {
                // Fasilitas parsing
                $fasilitasArr = [];
                if (!empty($e['fasilitas'])) {
                    $decoded = json_decode($e['fasilitas'], true);
                    if (is_array($decoded)) {
                        $fasilitasArr = $decoded;
                    } else {
                        $fasilitasArr = array_filter(array_map('trim', explode("\n", $e['fasilitas'])));
                    }
                }
                if (empty($fasilitasArr)) {
                    $fasilitasArr = ['Ruang kelas ber-AC ramah anak', 'Fasilitas bermain & stimulasi aman', 'Pendampingan pengajar berpengalaman'];
                }
                $e['fasilitas'] = array_values($fasilitasArr);

                // Image mapping (foto_utama)
                $imgUrl = $e['foto_utama'] ?? '';
                if (!empty($imgUrl)) {
                    if (strpos($imgUrl, 'http://') !== 0 && strpos($imgUrl, 'https://') !== 0) {
                        $imgUrl = base_url($imgUrl);
                    }
                } else {
                    $imgUrl = 'https://images.unsplash.com/photo-1587654780291-39c9404d746b?q=80&w=600&auto=format&fit=crop';
                }
                $e['image'] = $imgUrl;

                // Akreditasi & Kurikulum
                $e['akreditasi'] = !empty($e['akreditasi']) ? $e['akreditasi'] : 'Terakreditasi';
                $e['kurikulum']  = !empty($e['kurikulum']) ? $e['kurikulum'] : 'Kurikulum Merdeka';

                // Kontak / Website link
                $websiteLink = !empty($e['website']) ? $e['website'] : (!empty($e['wa']) ? 'https://wa.me/' . preg_replace('/[^0-9]/', '', $e['wa']) : '#');
                $e['kontak'] = $websiteLink;

                $cat = strtolower($e['category'] ?? 'tk');

                if (in_array($cat, ['tk', 'sd', 'smp', 'sma', 'smk', 'slb', 'formal'])) {
                    $e['jenjang'] = in_array($cat, ['sma', 'smk']) ? 'sma' : $cat;
                    $e['jenjang_label'] = $catLabelMap[$cat] ?? 'Sekolah Formal';
                    $dbFormal[] = $e;
                } else {
                    $e['kategori'] = $cat;
                    $e['kategori_label'] = $catLabelMap[$cat] ?? 'Lembaga Nonformal';
                    $e['rentang_usia'] = !empty($e['usia']) ? $e['usia'] : 'Usia 2 - 6 Tahun';
                    $e['program_fokus'] = $e['kurikulum'];
                    $dbNonformal[] = $e;
                }
            }

            // Gabungkan data statis dengan dinamis (Dinamis di atas)
            $sekolahFormal = array_merge($dbFormal, $sekolahFormal);
            $lembagaNonformal = array_merge($dbNonformal, $lembagaNonformal);
        }

        // Filter out Kursus entries since we moved focus to Preschool/PAUD
        $lembagaNonformal = array_filter($lembagaNonformal, function($item) {
            return !in_array($item['kategori'] ?? '', ['seni-musik', 'bimbel-bahasa', 'coding-robotik', 'olahraga']);
        });

        // Strip 📍 emojis from locations to match clean UI
        $cleanLocation = function(&$item) {
            if (isset($item['lokasi'])) {
                $item['lokasi'] = str_replace('📍 ', '', $item['lokasi']);
            }
        };
        array_walk($sekolahFormal, $cleanLocation);
        array_walk($lembagaNonformal, $cleanLocation);

        return view('pages/pendidikan', [
            'title'            => 'Direktori Pendidikan Anak Surabaya (Formal & Nonformal) - Parentela',
            'activeCategory'   => $category,
            'activeSub'        => $sub,
            'sekolahFormal'    => array_values($sekolahFormal),
            'lembagaNonformal' => array_values($lembagaNonformal)
        ]);
    }

    public function kewenangan($sub = null)
    {
        if ($redirect = $this->requireLogin('Silakan masuk ke akun Anda terlebih dahulu untuk mengakses Halaman Kewenangan.')) {
            return $redirect;
        }

        return view('pages/kewenangan', [
            'title' => 'Kewenangan & Regulasi Perlindungan Ibu-Anak - Parentela',
            'activeSub' => $sub ?? 'ringkasan'
        ]);
    }

    public function detailDaycare($nama_daycare = null)
    {
        if ($redirect = $this->requireLogin('Silakan masuk ke akun Anda terlebih dahulu untuk melihat Detail Tempat Asuh.')) {
            return $redirect;
        }

        $directoryModel = new \App\Models\DirectoryModel();
        if ($nama_daycare) {
            $dbPlace = $directoryModel->getBySlug($nama_daycare);
            if ($dbPlace) {
                $fasilitasArr = [];
                if (!empty($dbPlace['fasilitas'])) {
                    $decoded = json_decode($dbPlace['fasilitas'], true);
                    $fasilitasArr = is_array($decoded) ? $decoded : array_filter(array_map('trim', explode("\n", $dbPlace['fasilitas'])));
                }
                $galeriArr = [];
                if (!empty($dbPlace['galeri'])) {
                    $decodedG = json_decode($dbPlace['galeri'], true);
                    $galeriArr = is_array($decodedG) ? $decodedG : [];
                }

                $dbPlace['fasilitas'] = $fasilitasArr;
                $dbPlace['galeri']    = $galeriArr;
                return view('pages/detail_daycare', [
                    'daycare' => $dbPlace
                ]);
            }
        }
        $dataDaycare = [
            'mom-donny' => [
                'nama' => 'Mom Donny Daycare',
                'lokasi' => '📍 Jl. Raya Dian Istana, Wiyung, Surabaya Barat',
                'deskripsi' => 'Mom Donny Daycare merupakan salah satu tempat penitipan anak terpercaya di Surabaya Barat yang berdiri sejak 2015. Memiliki fasilitas kelas terpisah sesuai umur anak, pengasuh berpengalaman, serta sistem keamanan CCTV real-time untuk orang tua.',
                'fasilitas' => [
                    'Pembagian 4 kelas terpisah sesuai kelompok umur',
                    'Pemantauan CCTV real-time untuk orang tua',
                    'Area bermain indoor dan outdoor yang aman',
                    'Menu makanan sehat bergizi seimbang',
                    'Program stimulasi motorik dan kognitif harian',
                    'Kegiatan after school & club activities'
                ],
                'foto_utama' => 'https://images.unsplash.com/photo-1587654780291-39c9404d746b?q=80&w=1200&auto=format&fit=crop',
                'galeri' => [
                    'https://images.unsplash.com/photo-1503676260728-1c00da094a0b?q=80&w=600&auto=format&fit=crop',
                    'https://images.unsplash.com/photo-1485546246426-74dc88dec4d9?q=80&w=600&auto=format&fit=crop',
                    'https://images.unsplash.com/photo-1577896851231-70ef18881754?q=80&w=600&auto=format&fit=crop'
                ],
                'jam_buka' => 'Senin - Jumat: 07:00 - 17:00 WIB',
                'usia' => '3 Bulan - 12 Tahun',
                'harga' => 'Hubungi via WhatsApp untuk Info Paket',
                'wa' => '6281234567890',
                'website' => 'https://www.instagram.com/momdonnydaycare/',
                'gmaps' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3957.4000000000005!2d112.6700!3d-7.3000!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zN8KwMTgnMDAuMCJTIDExMsKwNDAnMTIuMCJF!5e0!3m2!1sen!2sid!4v1700000000000!5m2!1sen!2sid'
            ],
            'jasmine-moslem' => [
                'nama' => 'Jasmine Moslem Daycare',
                'lokasi' => '📍 Jl. Gunung Anyar Tengah No.7, Surabaya',
                'deskripsi' => 'Daycare populer di Surabaya Selatan dengan biaya terjangkau. Menggabungkan program penitipan anak berbasis nilai-nilai Islami, pembiasaan akhlak, serta kegiatan kreatif seperti prakarya dan karyawisata edukatif.',
                'fasilitas' => [
                    'Penitipan anak berbasis nilai Islami',
                    'Praktik salat, mengaji, dan doa harian',
                    'Kegiatan prakarya, karyawisata, dan camping anak',
                    'Pengasuh ramah dan bersertifikat',
                    'Ruang istirahat anak ber-AC yang higienis',
                    'Laporan kegiatan harian secara transparan'
                ],
                'foto_utama' => 'https://images.unsplash.com/photo-1595841696677-6489ff3f8cd1?q=80&w=1200&auto=format&fit=crop',
                'galeri' => [
                    'https://images.unsplash.com/photo-1509062522246-3755977927d7?q=80&w=600&auto=format&fit=crop',
                    'https://images.unsplash.com/photo-1497633762265-9d179a990aa6?q=80&w=600&auto=format&fit=crop',
                    'https://images.unsplash.com/photo-1576267423445-b2e0074d68a4?q=80&w=600&auto=format&fit=crop'
                ],
                'jam_buka' => 'Senin - Sabtu: 06:30 - 17:00 WIB',
                'usia' => '2 Bulan - 6 Tahun',
                'harga' => 'Mulai dari Rp 1.200.000 / bulan',
                'wa' => '6281232674457',
                'website' => 'https://www.instagram.com/',
                'gmaps' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3957.1000000000004!2d112.7900!3d-7.3300!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zN8KwMT9mci4wIlMgMTEywrA0NScwMC4wIkU!5e0!3m2!1sen!2sid!4v1700000000000!5m2!1sen!2sid'
            ],
            'olivo-daycare' => [
                'nama' => 'Olivo Day Care',
                'lokasi' => '📍 Jl. Putat Indah No.31, Sukomanunggal, Surabaya',
                'deskripsi' => 'Olivo Day Care menerapkan metode pembelajaran Montessori untuk mengoptimalkan motorik dan sensorik anak. Menyediakan layanan fleksibel termasuk *Hourly Day Care* (titip per jam) bagi orang tua dengan mobilitas tinggi.',
                'fasilitas' => [
                    'Kurikulum berbasis metode Montessori',
                    'Layanan fleksibel Hourly Day Care (Per Jam)',
                    'Alat peraga edukatif lengkap dan steril',
                    'Stimulasi motorik dan sensorik intensif',
                    'Pengasuh profesional di bidang early childhood',
                    'Lingkungan belajar indoor yang nyaman'
                ],
                'foto_utama' => 'https://images.unsplash.com/photo-1516627145497-ae6968895b74?q=80&w=1200&auto=format&fit=crop',
                'galeri' => [
                    'https://images.unsplash.com/photo-1503676382389-4809596d5290?q=80&w=600&auto=format&fit=crop',
                    'https://images.unsplash.com/photo-1544717305-2782549b5136?q=80&w=600&auto=format&fit=crop',
                    'https://images.unsplash.com/photo-1546410531-bb4caa6b424d?q=80&w=600&auto=format&fit=crop'
                ],
                'jam_buka' => 'Senin - Jumat: 07:00 - 16:30 WIB',
                'usia' => '1 Tahun - 6 Tahun',
                'harga' => 'Mulai Rp 25.000 / jam atau bulanan',
                'wa' => '6285176840124',
                'website' => 'https://www.instagram.com/',
                'gmaps' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3957.5000000000005!2d112.6900!3d-7.2800!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zN8KwMTYnNDguMCJTIDExMsKwNDEnMjQuMCJF!5e0!3m2!1sen!2sid!4v1700000000000!5m2!1sen!2sid'
            ]
        ];

        if (!array_key_exists($nama_daycare, $dataDaycare)) {
            $nama_daycare = 'mom-donny'; 
        }

        $detailTerpilih = $dataDaycare[$nama_daycare];

        return view('pages/detail_daycare', [
            'daycare' => $detailTerpilih
        ]); 
    }

    public function detailPanti($slug = null)
    {
        if ($redirect = $this->requireLogin('Silakan masuk ke akun Anda terlebih dahulu untuk melihat Detail Panti Asuhan.')) {
            return $redirect;
        }

        $directoryModel = new \App\Models\DirectoryModel();
        if ($slug) {
            $dbPlace = $directoryModel->getBySlug($slug);
            if ($dbPlace) {
                $fasilitasArr = [];
                if (!empty($dbPlace['fasilitas'])) {
                    $decoded = json_decode($dbPlace['fasilitas'], true);
                    $fasilitasArr = is_array($decoded) ? $decoded : array_filter(array_map('trim', explode("\n", $dbPlace['fasilitas'])));
                }
                $galeriArr = [];
                if (!empty($dbPlace['galeri'])) {
                    $decodedG = json_decode($dbPlace['galeri'], true);
                    $galeriArr = is_array($decodedG) ? $decodedG : [];
                }

                $dbPlace['fasilitas'] = $fasilitasArr;
                $dbPlace['galeri']    = $galeriArr;

                return view('pages/detail_panti', [
                    'panti' => $dbPlace
                ]);
            }
        }
        $dataPanti = [
            'panti-aisyiyah-1' => [
                'nama' => "Panti Asuhan Yatim Putri 'Aisyiyah 1",
                'lokasi' => '📍 Jl. Baratajaya XIX No.72, Gubeng, Surabaya',
                'deskripsi' => 'Panti asuhan teladan yang telah resmi meraih Akreditasi A dari Kementerian Sosial RI. Memiliki program asuh holistik, pembinaan budi pekerti yang kuat, serta penyaluran santunan yang transparan untuk anak-anak asuh.',
                'ig' => 'payp.aisyiyah1sby',
                'fasilitas' => [
                    'Terakreditasi A oleh Kementerian Sosial RI',
                    'Pembinaan pendidikan formal & akhlak mulia',
                    'Asrama putri yang bersih, aman, dan nyaman',
                    'Bimbingan belajar dan keterampilan harian',
                    'Pengelolaan donasi dan santunan yang transparan',
                    'Kegiatan ekstrakurikuler kerohanian'
                ],
                'foto_utama' => base_url('images/locations/aisyiyah.jpg'), // Menggunakan foto lokal asli
                'galeri' => [
                    [
                        'url' => base_url('images/locations/aisyiyah.jpg'),
                        'judul' => "Gedung Panti Asuhan Yatim Putri 'Aisyiyah 1",
                        'deskripsi' => "Tampak depan asrama dan fasilitas operasional Panti Asuhan Yatim Putri 'Aisyiyah 1 di Jl. Baratajaya XIX No.72, Surabaya. Lingkungan asri, aman, dan tertata bersih untuk tempat tinggal santriwati.",
                        'tag' => 'Fasilitas & Asrama'
                    ],
                    [
                        'url' => base_url('images/locations/aisyiyah-kegiatan-2.png'),
                        'judul' => "Kebersamaan Santriwati & Pengurus LKSA",
                        'deskripsi' => "Momen silaturahmi dan foto bersama seluruh santriwati putri dan jajaran pengurus LKSA Panti Asuhan Putri 'Aisyiyah 1 dalam suasana penuh kehangatan dan kekeluargaan.",
                        'tag' => 'Keluarga Besar'
                    ],
                    [
                        'url' => base_url('images/locations/aisyiyah-kegiatan-1.png'),
                        'judul' => "Presentasi Santriwati & Silaturahmi Reuni Akbar",
                        'deskripsi' => "Santriwati tampil percaya diri menyampaikan sambutan dan tilawah Al-Qur'an pada perhelatan silaturahmi temu alumni dan pengurus dalam pembinaan karakter santriwati.",
                        'tag' => 'Pembinaan Karakter'
                    ],
                    [
                        'url' => base_url('images/locations/aisyiyah-kegiatan-3.png'),
                        'judul' => "Keseruan Fun Games & Lomba di Halaman",
                        'deskripsi' => "Aktivitas outbound di halaman panti asuhan dengan aneka permainan edukatif dan perlombaan ketangkasan untuk melatih sportivitas, daya juang, dan keceriaan santriwati.",
                        'tag' => 'Aktivitas Luar Ruangan'
                    ],
                    [
                        'url' => base_url('images/locations/aisyiyah-kegiatan-4.png'),
                        'judul' => "Kerjasama Tim & Estafet Bola Ceria",
                        'deskripsi' => "Permainan interaktif estafet bola dengan cangkir di kepala yang memupuk rasa saling percaya, empati, gotong royong, dan kekompakan antar santriwati.",
                        'tag' => 'Kerjasama Tim'
                    ]
                ],
                'jam_buka' => 'Setiap Hari: 08:00 - 16:00 WIB',
                'usia' => 'Anak Yatim & Dhuafa (TK - SMA)',
                'harga' => 'Lembaga Sosial / Terbuka untuk Donasi',
                'wa' => '6281234567890',
                'gmaps' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3957.5!2d112.75!3d-7.28!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zN8KwMTYnNDguMCJTIDExMsKwNDUnMDAuMCJF!5e0!3m2!1sen!2sid!4v1700000000000!5m2!1sen!2sid'
            ],
            'panti-don-bosco' => [
                'nama' => 'Panti Asuhan Don Bosco',
                'lokasi' => '📍 Jl. Tidar No.115, Sawahan, Surabaya',
                'deskripsi' => 'Panti asuhan legendaris yang berdiri sejak puluhan tahun lalu di Surabaya. Dikelola dengan disiplin tinggi, memiliki lingkungan yang luas dan asri, serta menyediakan fasilitas penunjang keterampilan kerja dan pendidikan mandiri.',
                'fasilitas' => [
                    'Lingkungan asrama luas, asri, dan tertib',
                    'Fasilitas pendidikan formal hingga jenjang atas',
                    'Pelatihan keterampilan kerja & kemandirian',
                    'Ruang belajar dan perpustakaan lengkap',
                    'Pendampingan psikologi dan karakter',
                    'Area olahraga dan rekreasi anak'
                ],
                'foto_utama' => base_url('images/locations/don-bosco.png'),
                'galeri' => [
                    [
                        'url' => base_url('images/locations/don-bosco.png'),
                        'judul' => 'Gedung & Gerbang Asrama LKSA Don Bosco',
                        'deskripsi' => 'Tampak depan gerbang utama dan bangunan bersejarah LKSA Don Bosco di Jl. Tidar No.115, Surabaya dengan lingkungan yang luas, asri, dan tertib.',
                        'tag' => 'Gedung & Fasilitas'
                    ],
                    [
                        'url' => base_url('images/locations/don-bosco-kegiatan-1.png'),
                        'judul' => 'Kebersamaan & Pembagian Bingkisan Anak Asuh',
                        'deskripsi' => 'Momen kebersamaan penuh sukacita anak-anak asuh Yayasan Don Bosco Surabaya berkumpul bersama di aula utama asrama.',
                        'tag' => 'Aktivitas Anak Asuh'
                    ],
                    [
                        'url' => base_url('images/locations/don-bosco-kegiatan-2.jpg'),
                        'judul' => 'Bhakti Sosial Paskah Gabungan TNI AL Wilayah Surabaya',
                        'deskripsi' => 'Kegiatan bakti sosial dan kunjungan kasih dalam rangka peringatan Paskah Gabungan jajaran TNI AL Wilayah Surabaya bersama anak-anak asuh Panti Asuhan Don Bosco.',
                        'tag' => 'Bhakti Sosial & Kunjungan'
                    ],
                    [
                        'url' => base_url('images/locations/don-bosco-kegiatan-3.png'),
                        'judul' => 'Dokumentasi Bersejarah Gedung Don Bosco Tehuis',
                        'deskripsi' => 'Arsip dokumentasi bersejarah para misionaris, biarawan, dan pengasuh di depan gedung "Don Bosco Tehuis" yang telah melayani masyarakat sejak puluhan tahun silam.',
                        'tag' => 'Arsip Sejarah Panti'
                    ]
                ],
                'ig' => 'https://www.instagram.com/explore/locations/292081269/panti-asuhan-don-bosco-jl-tidar-115-surabaya/',
                'ig_label' => 'Instagram LKSA Don Bosco',
                'jam_buka' => 'Senin - Sabtu: 08:00 - 17:00 WIB',
                'usia' => 'Anak Asuh Usia Sekolah (SD - SMK/SMA)',
                'harga' => 'Lembaga Sosial / Terbuka untuk Donasi',
                'wa' => '6281234567891',
                'gmaps' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3957.5!2d112.73!3d-7.25!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zN8KwMTnunMDAuMCJTIDExMsKwNDMnNTguMCJF!5e0!3m2!1sen!2sid!4v1700000000000!5m2!1sen!2sid'
            ],
            'panti-undaan' => [
                'nama' => 'Panti Asuhan Yatim Piatu Undaan (PAU)',
                'lokasi' => '📍 Jl. Undaan Kulon No.39-41, Genteng, Surabaya',
                'deskripsi' => 'Berdiri sejak tahun 1919, panti asuhan bersejarah di jantung kota Surabaya ini konsisten mencetak generasi berprestasi dengan tata kelola profesional dan pengawasan ketat terhadap tumbuh kembang anak.',
                'fasilitas' => [
                    'Berdiri historis sejak tahun 1919',
                    'Manajemen profesional dan akuntabel',
                    'Bimbingan akademik dan les intensif',
                    'Asrama higienis di pusat kota',
                    'Pembinaan seni, budaya, dan olahraga',
                    'Jaringan alumni yang solid'
                ],
                'foto_utama' => base_url('images/locations/undaan.png'),
                'galeri' => [
                    [
                        'url' => base_url('images/locations/undaan.png'),
                        'judul' => 'Gedung & Halaman Utama Panti Asuhan Undaan',
                        'deskripsi' => 'Bangunan panti asuhan bernuansa historis kolonial yang berdiri sejak tahun 1919 di Jl. Undaan Kulon No.39-41, Surabaya dengan lingkungan yang asri dan tertata rapi.',
                        'tag' => 'Gedung & Fasilitas'
                    ],
                    [
                        'url' => base_url('images/locations/undaan-kegiatan-1.png'),
                        'judul' => 'Keluarga Besar & Anak Asuh Panti Asuhan Undaan',
                        'deskripsi' => 'Momen kebersamaan seluruh anak-anak asuh bersama pengasuh dan pengurus di pelataran utama LKSA Panti Asuhan Anak Yatim Piatu Undaan Surabaya.',
                        'tag' => 'Keluarga Besar Panti'
                    ],
                    [
                        'url' => base_url('images/locations/undaan-kegiatan-2.jpg'),
                        'judul' => 'Latihan & Bermain Bersama (3D2N) di Trowulan',
                        'deskripsi' => 'Kegiatan rekreasi edukatif dan pembentukan karakter adik-adik Panti Asuhan Undaan Surabaya selama 3 hari 2 malam di Maha Vihara Mojopahit, Trowulan.',
                        'tag' => 'Aktivitas & Edukasi'
                    ]
                ],
                'jam_buka' => 'Setiap Hari: 08:00 - 16:30 WIB',
                'usia' => 'Anak Yatim Piatu (SD - SMA)',
                'harga' => 'Lembaga Sosial / Terbuka untuk Donasi',
                'wa' => '6281234567892',
                'gmaps' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3957.5!2d112.74!3d-7.26!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zN8KwMTUnMzYuMCJTIDExMsKwNDQnMjQuMCJF!5e0!3m2!1sen!2sid!4v1700000000000!5m2!1sen!2sid'
            ],
            'panti-pyi-ngagel' => [
                'nama' => 'Panti Asuhan PYI (Panti Yatim Indonesia)',
                'lokasi' => '📍 Jl. Ngagel Madya Kertajaya No.83, Gubeng, Surabaya',
                'deskripsi' => 'Asrama anak yatim dan dhuafa dengan konsep modern, sangat bersih, serta pengelolaan digital yang transparan. Menjadi salah satu rujukan utama warga Surabaya untuk menyalurkan zakat, infak, dan sedekah.',
                'fasilitas' => [
                    'Gedung asrama modern dan higienis',
                    'Sistem pelaporan donatur secara digital',
                    'Program Beasiswa Yatim Berprestasi',
                    'Fasilitas komputer & internet untuk belajar',
                    'Kegiatan keagamaan dan tahfidz Al-Quran',
                    'Lokasi strategis di Surabaya Timur'
                ],
                'foto_utama' => base_url('images/locations/pyi.png'),
                'galeri' => [
                    [
                        'url' => base_url('images/locations/pyi.png'),
                        'judul' => 'Gedung Asrama Yatim & Pelayanan Zakat PYI',
                        'deskripsi' => 'Tampak depan gedung Asrama Yatim dan Kantor Pelayanan Zakat PYI (Panti Yatim Indonesia) di Jl. Ngagel Madya No.83, Gubeng, Surabaya.',
                        'tag' => 'Gedung & Asrama'
                    ],
                    [
                        'url' => base_url('images/locations/pyi-kegiatan-1.png'),
                        'judul' => 'Kebersamaan Anak Asuh Asrama Yatim Ngagel',
                        'deskripsi' => 'Momen penuh kehangatan dan kebersamaan anak-anak asuh bersama pengasuh dan donatur di Asrama Yatim PYI Ngagel Surabaya.',
                        'tag' => 'Keluarga Besar Asrama'
                    ],
                    [
                        'url' => base_url('images/locations/pyi-kegiatan-2.png'),
                        'judul' => 'Program Bimbingan Belajar & Tahfidz Al-Quran',
                        'deskripsi' => 'Aktivitas pembiasaan membaca Al-Quran, pembinaan akhlak mulia, dan bimbingan belajar rutin santriwati di Asrama PYI Surabaya.',
                        'tag' => 'Pendidikan & Ibadah'
                    ]
                ],
                'jam_buka' => 'Senin - Minggu: 08:00 - 17:00 WIB',
                'usia' => 'Anak Yatim & Dhuafa (SD - Kuliah)',
                'harga' => 'Lembaga Sosial / Terbuka untuk Donasi',
                'wa' => '6281234567893',
                'gmaps' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3957.5!2d112.76!3d-7.29!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zN8KwMTcnMjQuMCJTIDExMsKwNDUnMzYuMCJF!5e0!3m2!1sen!2sid!4v1700000000000!5m2!1sen!2sid'
            ],
            'panti-muhammadiyah-dahlan' => [
                'nama' => 'Panti Asuhan Muhammadiyah KH. Achmad Dahlan',
                'lokasi' => '📍 Jl. Tambak Asri No.202, Krembangan, Surabaya',
                'deskripsi' => 'Dikelola di bawah naungan ormas Islam terkemuka, panti asuhan ini mengutamakan kualitas pendidikan formal yang tinggi dipadu dengan pembentukan karakter religius yang disiplin dan mandiri.',
                'fasilitas' => [
                    'Asrama rapi di bawah naungan Muhammadiyah',
                    'Fokus pendidikan formal dan pesantren',
                    'Pembinaan ibadah dan tahfidz harian',
                    'Fasilitas kesehatan dan gizi terpantau',
                    'Program pengembangan bakat kewirausahaan',
                    'Lingkungan belajar yang kondusif'
                ],
                'foto_utama' => base_url('images/locations/panti-dahlan.png'),
                'galeri' => [
                    [
                        'url' => base_url('images/locations/panti-dahlan.png'),
                        'judul' => 'Gedung Panti Asuhan Muhammadiyah KH. Achmad Dahlan',
                        'deskripsi' => 'Tampak depan gedung bertingkat Panti Asuhan Muhammadiyah KH. Achmad Dahlan berfasad oranye modern di Jl. Tambak Asri No.202, Krembangan, Surabaya.',
                        'tag' => 'Gedung & Asrama'
                    ],
                    [
                        'url' => base_url('images/locations/dahlan-kegiatan-1.png'),
                        'judul' => 'Latihan Dasar Kepemimpinan Santri (LDKS)',
                        'deskripsi' => 'Program pelatihan LDKS untuk membentuk generasi santri pemimpin yang berkarakter islami, berkualitas, dan berprestasi di Pacet, Mojokerto.',
                        'tag' => 'Kepemimpinan & Karakter'
                    ],
                    [
                        'url' => base_url('images/locations/dahlan-kegiatan-2.jpg'),
                        'judul' => 'Pentas Seni & Kreasi Semarak Kemerdekaan HUT RI',
                        'deskripsi' => 'Semangat kebersamaan anak-anak asuh menampilkan unjuk bakat musik perkusi, bernyanyi, dan kreasi seni memperingati HUT Kemerdekaan RI.',
                        'tag' => 'Kreativitas & Seni'
                    ],
                    [
                        'url' => base_url('images/locations/dahlan-kegiatan-3.png'),
                        'judul' => 'Apresiasi Prestasi & Bingkisan Kasih Santri',
                        'deskripsi' => 'Penyerahan medali, bingkisan hadiah perlombaan, dan apresiasi bagi anak-anak asuh berprestasi bersama dewan pembina panti asuhan.',
                        'tag' => 'Apresiasi & Prestasi'
                    ]
                ],
                'jam_buka' => 'Setiap Hari: 08:00 - 16:00 WIB',
                'usia' => 'Anak Asuh Usia Sekolah',
                'harga' => 'Lembaga Sosial / Terbuka untuk Donasi',
                'wa' => '6281234567894',
                'gmaps' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3957.5!2d112.78!3d-7.27!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zN8KwMTYnMTIsMCJTIDExMsKwNDcnNDguMCJF!5e0!3m2!1sen!2sid!4v1700000000000!5m2!1sen!2sid'
            ],
            'panti-al-fatimah' => [
                'nama' => 'Panti Asuhan Al-Fatimah Surabaya',
                'lokasi' => '📍 Jl. Kalidami, Gubeng, Surabaya Timur',
                'deskripsi' => 'Yayasan sosial yang aktif merawat anak yatim dan dhuafa dengan suasana kekeluargaan yang erat. Pengurusnya dikenal sangat ramah, amanah, serta responsif terhadap setiap kunjungan maupun bantuan donatur.',
                'fasilitas' => [
                    'Suasana asrama kekeluargaan yang hangat',
                    'Pengurus yang ramah dan amanah',
                    'Bimbingan belajar dan mengaji gratis',
                    'Penyaluran santunan langsung sasaran',
                    'Kegiatan sosial kemasyarakatan',
                    'Buka setiap hari untuk kunjungan donatur'
                ],
                'foto_utama' => base_url('images/locations/fatimah.png'),
                'galeri' => [
                    [
                        'url' => base_url('images/locations/fatimah.png'),
                        'judul' => 'Penyerahan Bantuan & Santunan Anak Asuh Al-Fatimah',
                        'deskripsi' => 'Momen penuh rasa syukur dan kebersamaan anak-anak asuh Panti Asuhan Al-Fatimah Surabaya dalam acara penyerahan santunan Mandirian Yatim & Dhuafa.',
                        'tag' => 'Santunan & Donasi'
                    ],
                    [
                        'url' => base_url('images/locations/fatimah-kegiatan-1.jpg'),
                        'judul' => 'Penyaluran Paket Sembako & Berbagi Makanan Berkah',
                        'deskripsi' => 'Kegiatan bakti sosial rutin penyaluran paket sembako dan makanan berkah bagi warga lansia dhuafa di sekitar lingkungan Panti Asuhan Al-Fatimah.',
                        'tag' => 'Bakti Sosial & Dhuafa'
                    ],
                    [
                        'url' => base_url('images/locations/fatimah-kegiatan-2.png'),
                        'judul' => 'Kebersamaan Anak Asuh & Relawan Seribu Senyum Nusantara',
                        'deskripsi' => 'Keceriaan dan kehangatan seluruh anak-anak asuh Panti Asuhan Al-Fatimah bersama para relawan dalam program Seribu Senyum Nusantara.',
                        'tag' => 'Aktivitas & Kebersamaan'
                    ]
                ],
                'jam_buka' => 'Setiap Hari: 08:00 - 17:00 WIB',
                'usia' => 'Anak Yatim & Dhuafa',
                'harga' => 'Lembaga Sosial / Terbuka untuk Donasi',
                'wa' => '6281234567895',
                'gmaps' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3957.5!2d112.75!3d-7.27!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zN8KwMTYnMTIuMCJTIDExMsKwNDUnMDAuMCJF!5e0!3m2!1sen!2sid!4v1700000000000!5m2!1sen!2sid'
            ],
            'panti-griya-yatim' => [
                'nama' => 'Panti Asuhan Griya Yatim & Dhuafa',
                'lokasi' => '📍 Jl. Rungkut Mapan Blok FD No.4, Rungkut, Surabaya',
                'deskripsi' => 'Asrama yatim yang berlokasi di kawasan perumahan tenang Surabaya Selatan. Tempatnya sangat bersih, tertata secara modern, serta transparan dalam pengelolaan dan penyaluran program sosial.',
                'fasilitas' => [
                    'Lokasi di lingkungan perumahan yang tenang',
                    'Asrama bersih dan berstandar higienis',
                    'Manajemen program sosial terstruktur',
                    'Fasilitas penunjang belajar anak asuh',
                    'Akses mudah bagi donatur wilayah Rungkut',
                    'Laporan kegiatan berkala'
                ],
                'foto_utama' => 'https://images.unsplash.com/photo-1513694203232-719a280e022f?q=80&w=1200&auto=format&fit=crop',
                'galeri' => [
                    'https://images.unsplash.com/photo-1531206715517-5c0ba140b2b8?q=80&w=600&auto=format&fit=crop',
                    'https://images.unsplash.com/photo-1580582932707-520aed937b7b?q=80&w=600&auto=format&fit=crop',
                    'https://images.unsplash.com/photo-1559027615-cd4628902d4a?q=80&w=600&auto=format&fit=crop'
                ],
                'jam_buka' => 'Senin - Minggu: 08:00 - 16:30 WIB',
                'usia' => 'Anak Yatim & Dhuafa',
                'harga' => 'Lembaga Sosial / Terbuka untuk Donasi',
                'wa' => '6281234567896',
                'gmaps' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3957.5!2d112.77!3d-7.32!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zN8KwMT9mci4wIlMgMTEywrA0NicwMC4wIkU!5e0!3m2!1sen!2sid!4v1700000000000!5m2!1sen!2sid'
            ],
            'panti-bhakti-luhur' => [
                'nama' => 'Panti Asuhan Bhakti Luhur Surabaya',
                'lokasi' => '📍 Wilayah Dukuh Pakis / Ketintang, Surabaya',
                'deskripsi' => 'Lembaga sosial yang berdedikasi tinggi dalam merawat, mendidik, dan memberikan kasih sayang khusus bagi anak-anak yatim piatu serta anak-anak dengan kebutuhan khusus dengan fasilitas yang sangat manusiawi.',
                'fasilitas' => [
                    'Perawatan khusus untuk anak berkebutuhan khusus',
                    'Tenaga pendamping dan terapis berpengalaman',
                    'Fasilitas penunjang mobilitas dan terapi',
                    'Program pendidikan inklusif',
                    'Lingkungan panti yang ramah dan penuh kasih',
                    'Dukungan medis berkala'
                ],
                'foto_utama' => 'https://images.unsplash.com/photo-1582213782179-e0d53f98f2ca?q=80&w=1200&auto=format&fit=crop',
                'galeri' => [
                    'https://images.unsplash.com/photo-1576765608535-5f04d1e3f289?q=80&w=600&auto=format&fit=crop',
                    'https://images.unsplash.com/photo-1503676260728-1c00da094a0b?q=80&w=600&auto=format&fit=crop',
                    'https://images.unsplash.com/photo-1516627145497-ae6968895b74?q=80&w=600&auto=format&fit=crop'
                ],
                'jam_buka' => 'Setiap Hari: 08:00 - 16:00 WIB',
                'usia' => 'Anak Yatim & Berkebutuhan Khusus',
                'harga' => 'Lembaga Sosial / Terbuka untuk Donasi',
                'wa' => '6281234567897',
                'gmaps' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3957.5!2d112.72!3d-7.30!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zN8KwMTgnMDAuMCJTIDExMsKwNDMnMDAuMCJF!5e0!3m2!1sen!2sid!4v1700000000000!5m2!1sen!2sid'
            ],
            'panti-cahaya-insani' => [
                'nama' => 'Panti Asuhan Yatim Cahaya Insani',
                'lokasi' => '📍 Jl. Gubeng Kertajaya III, Gubeng, Surabaya',
                'deskripsi' => 'Berlokasi sangat strategis di pusat kota Surabaya. Panti asuhan ini memiliki fasilitas tempat tinggal yang bersih serta ruang belajar yang nyaman untuk mendukung masa depan anak-anak asuhnya.',
                'fasilitas' => [
                    'Lokasi sangat strategis di pusat kota',
                    'Ruang belajar dan istirahat ber-AC',
                    'Kebersihan lingkungan yang terjaga',
                    'Pendampingan PR dan pelajaran sekolah',
                    'Akses mudah untuk kunjungan sosial',
                    'Program santunan anak yatim rutin'
                ],
                'foto_utama' => 'https://images.unsplash.com/photo-1523240795612-9a054b0db644?q=80&w=1200&auto=format&fit=crop',
                'galeri' => [
                    'https://images.unsplash.com/photo-1469571486292-0ba58a3f068b?q=80&w=600&auto=format&fit=crop',
                    'https://images.unsplash.com/photo-1517486808906-6ca8b3f04846?q=80&w=600&auto=format&fit=crop',
                    'https://images.unsplash.com/photo-1491438590914-bc09fcaaf77a?q=80&w=600&auto=format&fit=crop'
                ],
                'jam_buka' => 'Setiap Hari: 08:00 - 17:00 WIB',
                'usia' => 'Anak Yatim (SD - SMA)',
                'harga' => 'Lembaga Sosial / Terbuka untuk Donasi',
                'wa' => '6281234567898',
                'gmaps' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3957.5!2d112.75!3d-7.28!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zN8KwMTYnNDguMCJTIDExMsKwNDUnMDAuMCJF!5e0!3m2!1sen!2sid!4v1700000000000!5m2!1sen!2sid'
            ],
            'panti-al-haq' => [
                'nama' => 'Panti Asuhan Al-Haq Surabaya',
                'lokasi' => '📍 Wilayah Gayungan, Surabaya Selatan',
                'deskripsi' => 'Lembaga pembinaan anak yatim piatu di wilayah Surabaya Selatan yang aktif menyelenggarakan bimbingan belajar gratis serta pelatihan karakter mandiri agar anak-anak siap menghadapi masa depan.',
                'fasilitas' => [
                    'Bimbingan belajar gratis oleh relawan',
                    'Pelatihan kemandirian dan soft skills',
                    'Pembinaan mental dan spiritual',
                    'Asrama yang nyaman dan kondusif',
                    'Kerjasama dengan donatur lokal terpercaya',
                    'Kegiatan rekreasi edukatif anak'
                ],
                'foto_utama' => 'https://images.unsplash.com/photo-1497215728101-856f4ea42174?q=80&w=1200&auto=format&fit=crop',
                'galeri' => [
                    'https://images.unsplash.com/photo-1509062522246-3755977927d7?q=80&w=600&auto=format&fit=crop',
                    'https://images.unsplash.com/photo-1531206715517-5c0ba140b2b8?q=80&w=600&auto=format&fit=crop',
                    'https://images.unsplash.com/photo-1582213782179-e0d53f98f2ca?q=80&w=600&auto=format&fit=crop'
                ],
                'jam_buka' => 'Setiap Hari: 08:00 - 16:30 WIB',
                'usia' => 'Anak Yatim Piatu',
                'harga' => 'Lembaga Sosial / Terbuka untuk Donasi',
                'wa' => '6281234567899',
                'gmaps' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3957.5!2d112.72!3d-7.33!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zN8KwMT9mci4wIlMgMTEywrA0MicsMCJF!5e0!3m2!1sen!2sid!4v1700000000000!5m2!1sen!2sid'
            ]
        ];

        if (!array_key_exists($slug, $dataPanti)) {
            $slug = 'panti-aisyiyah-1'; 
        }

        $detailTerpilih = $dataPanti[$slug];

        return view('pages/detail_panti', [
            'panti' => $detailTerpilih
        ]);
    }

    public function nanny()
    {
        if ($redirect = $this->requireLogin('Silakan masuk ke akun Anda terlebih dahulu untuk mengakses Layanan Nanny & Pengasuh.')) {
            return $redirect;
        }

        try {
            $nannyModel = new \App\Models\NannyModel();
            $nannies = $nannyModel->orderBy('is_verified', 'DESC')->orderBy('id', 'ASC')->findAll();
        } catch (\Throwable $e) {
            $nannies = [];
        }

        return view('pages/nanny', [
            'title'   => 'Layanan Nanny & Pengasuh Berizin Surabaya - Parentela',
            'nannies' => $nannies
        ]);
    }

    public function perencanaanKeluarga()
    {
        if ($redirect = $this->requireLogin('Silakan masuk ke akun Anda terlebih dahulu untuk mengakses Portal Perencanaan Keluarga.')) {
            return $redirect;
        }

        return view('pages/perencanaan_keluarga', [
            'title' => 'Portal Perencanaan Keluarga & KB Terpadu - Parentela'
        ]);
    }

    public function menu()
    {
        if ($redirect = $this->requireLogin('Silakan masuk ke akun Anda terlebih dahulu untuk mengakses Fitur Menu & Resep MPASI.')) {
            return $redirect;
        }

        return view('pages/menu', [
            'title' => 'Panduan Resep MPASI & Nutrisi Si Kecil - Parentela'
        ]);
    }

    public function submitArticle()
    {
        if ($redirect = $this->requireLogin('Silakan masuk ke akun Anda terlebih dahulu untuk menuliskan dan mengajukan artikel.')) {
            return $redirect;
        }

        $db            = \Config\Database::connect();
        $author        = trim((string) $this->request->getPost('author')) ?: (session()->get('user_name') ?? 'Kontributor Parentela');
        $author_email  = trim((string) $this->request->getPost('author_email')) ?: (session()->get('user_email') ?? '');
        $title         = trim((string) $this->request->getPost('title'));
        $category_slug = $this->request->getPost('category_slug') ?? 'parenting';
        $age_slug      = $this->request->getPost('age_slug') ?? 'semua-usia';
        $type          = $this->request->getPost('type') ?? 'artikel';
        $excerpt       = trim((string) $this->request->getPost('excerpt'));
        $content       = trim((string) $this->request->getPost('content'));

        if (empty($title) || empty($content)) {
            session()->setFlashdata('error', 'Mohon isi judul dan materi artikel dengan lengkap.');
            return redirect()->to(base_url('articles'));
        }

        $categoryMap = [
            'tumbuh-kembang'  => 'Tumbuh Kembang',
            'kesehatan'       => 'Kesehatan',
            'kebutuhan-khusus'=> 'Kebutuhan Khusus',
            'kebugaran'       => 'Kebugaran',
            'parenting'       => 'Parenting',
            'gaya-hidup'      => 'Gaya Hidup',
            'video-edukasi'   => 'Video Edukasi'
        ];

        $ageMap = [
            'semua-usia'        => 'Semua Usia',
            'hamil-trimester-1' => 'Hamil Trimester 1',
            'hamil-trimester-2' => 'Hamil Trimester 2',
            'hamil-trimester-3' => 'Hamil Trimester 3',
            'pasca-persalinan'  => 'Pasca Persalinan',
            '0-6-bulan'         => '0 - 6 bulan',
            '6-12-bulan'        => '6 - 12 bulan',
            '1-2-tahun'         => '1 - 2 tahun',
            '2-5-tahun'         => '2 - 5 tahun',
            '5-12-tahun'        => '5 - 12 tahun',
            'lebih-12-tahun'    => '> 12 tahun'
        ];

        $slug = url_title(strtolower($title), '-', true);

        $thumbnail = null;
        $fileImage = $this->request->getFile('thumbnail');
        if ($fileImage && $fileImage->isValid() && !$fileImage->hasMoved()) {
            $uploadDir = FCPATH . 'uploads/articles/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }
            $newName = $fileImage->getRandomName();
            $fileImage->move($uploadDir, $newName);
            $thumbnail = 'uploads/articles/' . $newName;
        }

        $data = [
            'title'         => $title,
            'slug'          => $slug,
            'category_slug' => $category_slug,
            'category_name' => $categoryMap[$category_slug] ?? 'Parenting',
            'age_slug'      => $age_slug,
            'age_label'     => $ageMap[$age_slug] ?? 'Semua Usia',
            'type'          => $type,
            'type_label'    => ($type === 'video') ? 'Video Edukasi' : 'Artikel',
            'author'        => $author,
            'author_email'  => $author_email,
            'read_time'     => '5 mnt baca',
            'excerpt'       => $excerpt,
            'content'       => $content,
            'thumbnail'     => $thumbnail,
            'image'         => $thumbnail,
            'status'        => 'pending',
            'created_at'    => date('Y-m-d H:i:s'),
            'updated_at'    => date('Y-m-d H:i:s'),
        ];

        $db->table('articles')->insert($data);

        session()->setFlashdata('submitted', 'Artikel Anda berhasil diajukan! Tim Administrator kami akan meninjau tulisan Anda.');
        return redirect()->to(base_url('articles'));
    }
}