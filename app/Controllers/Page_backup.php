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
                'user_name'    => $user['name']
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

    public function luna()
    {
        echo view("luna");
    }

    public function shop()
    {
        return view("shop", [
            'title' => 'Toko Parentela - Perlengkapan & Kebutuhan Tumbuh Kembang Anak'
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
            'diskusi'         => 'parenting'
        ];

        $activeCategorySlug = $category ?? 'semua';
        $normalizedCategory = $categoryAliases[$activeCategorySlug] ?? $activeCategorySlug;
        $categoryName = $categoryMap[$activeCategorySlug] ?? ucwords(str_replace('-', ' ', $activeCategorySlug));

        // Dataset Artikel Lengkap (sesuai referensi mobile app untuk versi PC)
        $articles = [
            [
                'id'            => 'art-1',
                'title'         => '5 Cara Memilih Sunscreen Anak yang Aman & Tidak Lengket',
                'excerpt'       => 'Pastikan kulit sensitif buah hati terlindungi dari bahaya sinar UV dengan panduan pemilihan sunscreen ramah anak dan bebas bahan kimia berbahaya.',
                'category_slug' => 'kesehatan',
                'category_name' => 'Kesehatan',
                'age_slug'      => '2-5-tahun',
                'age_label'     => '2 - 5 tahun',
                'type'          => 'artikel',
                'type_label'    => 'Artikel',
                'subtags'       => ['Info Sehat', 'Rekomendasi'],
                'author'        => 'dr. Aulia Rahma, Sp.A',
                'read_time'     => '4 mnt baca',
                'image'         => base_url('images/cand-toddler-outdoors.jpg'),
                'saved_type'    => 'artikel'
            ],
            [
                'id'            => 'art-2',
                'title'         => 'Cara Memilih Lotion Anak untuk Kulit Sensitif & Eksim',
                'excerpt'       => 'Kenali kandungan pelembap hipoalergenik terbaik untuk menjaga elastisitas serta meredakan biang keringat atau ruam pada kulit bayi dan balita.',
                'category_slug' => 'kesehatan',
                'category_name' => 'Kesehatan',
                'age_slug'      => '0-6-bulan',
                'age_label'     => '0 - 6 bulan',
                'type'          => 'artikel',
                'type_label'    => 'Artikel',
                'subtags'       => ['Perkembangan', 'Info Sehat', 'Rekomendasi'],
                'author'        => 'dr. Sp.KK Citra Permata',
                'read_time'     => '5 mnt baca',
                'image'         => base_url('images/blog/kulit-bayi.jpg'),
                'saved_type'    => 'artikel'
            ],
            [
                'id'            => 'art-3',
                'title'         => 'Cara Memilih Odol Anak: Kenapa Fluoride Penting untuk Gigi Susu?',
                'excerpt'       => 'Pahami takaran fluoride yang tepat sejak gigi pertama tumbuh agar email gigi kuat dan bebas dari karies dini tanpa bahaya tertelan.',
                'category_slug' => 'kesehatan',
                'category_name' => 'Kesehatan',
                'age_slug'      => '2-5-tahun',
                'age_label'     => '2 - 5 tahun',
                'type'          => 'artikel',
                'type_label'    => 'Artikel',
                'subtags'       => ['Info Sehat', 'Pola Asuh'],
                'author'        => 'drg. Maya Sari, Sp.KGA',
                'read_time'     => '3 mnt baca',
                'image'         => base_url('images/cand-child-smile.jpg'),
                'saved_type'    => 'artikel'
            ],
            [
                'id'            => 'art-4',
                'title'         => 'Vitamin D: Dampaknya ke Tinggi Badan Anak & Kekebalan Tubuh',
                'excerpt'       => 'Kebutuhan vitamin D harian balita sangat krusial bagi penyerapan kalsium maksimal tulang dan pencegahan infeksi saluran pernapasan.',
                'category_slug' => 'tumbuh-kembang',
                'category_name' => 'Tumbuh Kembang',
                'age_slug'      => '2-5-tahun',
                'age_label'     => '2 - 5 tahun',
                'type'          => 'artikel',
                'type_label'    => 'Artikel',
                'subtags'       => ['Pertumbuhan', 'Pola Asuh', 'Info Sehat'],
                'author'        => 'dr. Budi Setiawan, Sp.A(K)',
                'read_time'     => '4 mnt baca',
                'image'         => base_url('images/cand-kid-happy.jpg'),
                'saved_type'    => 'artikel'
            ],
            [
                'id'            => 'art-5',
                'title'         => 'Vitamin Penambah Nafsu Makan Anak: Manfaat & Waktu Terbaik Diberikan',
                'excerpt'       => 'Jangan asal memberikan suplemen! Ketahui kapan si kecil benar-benar memerlukan vitamin tambahan serta nutrisi alami pemicu selera makan.',
                'category_slug' => 'tumbuh-kembang',
                'category_name' => 'Tumbuh Kembang',
                'age_slug'      => '2-5-tahun',
                'age_label'     => '2 - 5 tahun',
                'type'          => 'artikel',
                'type_label'    => 'Artikel',
                'subtags'       => ['Perkembangan', 'Nutrisi', 'Rekomendasi'],
                'author'        => 'Klinik Gizi Anak Parentela',
                'read_time'     => '4 mnt baca',
                'image'         => base_url('images/mpasi-sample.jpg'),
                'saved_type'    => 'resep'
            ],
            [
                'id'            => 'art-6',
                'title'         => 'Trik Mengatasi Anak Susah Makan (GTM - Gerakan Tutup Mulut)',
                'excerpt'       => 'Langkah praktis psikologi makan: terapkan feeding rules, variasi tekstur, dan ciptakan suasana tanpa paksaan saat fase GTM melanda.',
                'category_slug' => 'tumbuh-kembang',
                'category_name' => 'Tumbuh Kembang',
                'age_slug'      => '6-12-bulan',
                'age_label'     => '6 - 12 bulan',
                'type'          => 'artikel',
                'type_label'    => 'Artikel',
                'subtags'       => ['Pertumbuhan', 'Nutrisi', 'Pola Asuh'],
                'author'        => 'dr. Aulia Rahma, Sp.A',
                'read_time'     => '6 mnt baca',
                'image'         => base_url('images/cand-baby-curious.jpg'),
                'saved_type'    => 'resep'
            ],
            [
                'id'            => 'art-7',
                'title'         => '7 Resep MPASI Tinggi Zat Besi & Protein Hewani untuk Cegah Stunting',
                'excerpt'       => 'Inspirasi menu harian lezat berbahan hati ayam, daging sapi, dan telur puyuh yang lembut serta mudah dikunyah si kecil.',
                'category_slug' => 'gaya-hidup',
                'category_name' => 'Gaya Hidup',
                'age_slug'      => '6-12-bulan',
                'age_label'     => '6 - 12 bulan',
                'type'          => 'artikel',
                'type_label'    => 'Artikel',
                'subtags'       => ['Nutrisi', 'Rekomendasi'],
                'author'        => 'Chef & Nutrisi Bunda',
                'read_time'     => '5 mnt baca',
                'image'         => base_url('images/blog/mpasi-sehat.jpg'),
                'saved_type'    => 'resep'
            ],
            [
                'id'            => 'art-8',
                'title'         => 'Deteksi Dini Speech Delay & Stimulasi Bicara Efektif di Rumah',
                'excerpt'       => 'Kenali perbedaan keterlambatan bicara wajar dengan indikasi gangguan komunikasi agar Ayah & Bunda dapat memberi respons cepat.',
                'category_slug' => 'kebutuhan-khusus',
                'category_name' => 'Kebutuhan Khusus',
                'age_slug'      => '1-2-tahun',
                'age_label'     => '1 - 2 tahun',
                'type'          => 'artikel',
                'type_label'    => 'Artikel',
                'subtags'       => ['Perkembangan', 'Info Sehat', 'Rekomendasi'],
                'author'        => 'Terapis Wicara Parentela',
                'read_time'     => '6 mnt baca',
                'image'         => base_url('images/cand-talk-1.jpg'),
                'saved_type'    => 'stimulasi'
            ],
            [
                'id'            => 'art-9',
                'title'         => 'Terapi Sensori Integrasi Rumahan untuk Anak Aktif & Sensitif Cahaya',
                'excerpt'       => 'Aktivitas bermain sederhana untuk melatih persepsi proprioseptif dan vestibular anak agar lebih tenang dan fokus dalam beraktivitas.',
                'category_slug' => 'kebutuhan-khusus',
                'category_name' => 'Kebutuhan Khusus',
                'age_slug'      => '2-5-tahun',
                'age_label'     => '2 - 5 tahun',
                'type'          => 'artikel',
                'type_label'    => 'Artikel',
                'subtags'       => ['Perkembangan', 'Info Sehat'],
                'author'        => 'Tim Terapis Tumbuh Kembang',
                'read_time'     => '5 mnt baca',
                'image'         => base_url('images/cand-child-learning.jpg'),
                'saved_type'    => 'stimulasi'
            ],
            [
                'id'            => 'art-10',
                'title'         => 'Aktivitas Fisik & Olahraga Menyenangkan untuk Melatih Motorik Kasar',
                'excerpt'       => 'Permainan melompat, merangkak di rintangan bantal, dan lempar bola yang memperkuat otot inti serta koordinasi mata-kaki balita.',
                'category_slug' => 'kebugaran',
                'category_name' => 'Kebugaran',
                'age_slug'      => '2-5-tahun',
                'age_label'     => '2 - 5 tahun',
                'type'          => 'artikel',
                'type_label'    => 'Artikel',
                'subtags'       => ['Pertumbuhan', 'Rekomendasi'],
                'author'        => 'Pelatih Kebugaran Anak',
                'read_time'     => '4 mnt baca',
                'image'         => base_url('images/cand-girl-smile.jpg'),
                'saved_type'    => 'stimulasi'
            ],
            [
                'id'            => 'art-11',
                'title'         => 'Menangani Tantrum Balita dengan Pendekatan Gentle Parenting',
                'excerpt'       => 'Alih-alih membentak atau mengancam, gunakan validasi emosi dan teknik pernapasan bersama untuk menenangkan amukan si kecil.',
                'category_slug' => 'parenting',
                'category_name' => 'Parenting',
                'age_slug'      => '2-5-tahun',
                'age_label'     => '2 - 5 tahun',
                'type'          => 'artikel',
                'type_label'    => 'Artikel',
                'subtags'       => ['Pola Asuh', 'Rekomendasi'],
                'author'        => 'Psikolog Keluarga Parentela',
                'read_time'     => '5 mnt baca',
                'image'         => base_url('images/toddler-mom.jpg'),
                'saved_type'    => 'artikel'
            ],
            [
                'id'            => 'art-12',
                'title'         => 'Tips Mempersiapkan Kakak Menyambut Kehadiran Adik Baru',
                'excerpt'       => 'Cegah kecemburuan persaudaraan (*sibling rivalry*) dengan melibatkan si sulung sejak masa kehamilan hingga perawatan bayi baru lahir.',
                'category_slug' => 'parenting',
                'category_name' => 'Parenting',
                'age_slug'      => 'pasca-persalinan',
                'age_label'     => 'Pasca Persalinan',
                'type'          => 'artikel',
                'type_label'    => 'Artikel',
                'subtags'       => ['Pola Asuh', 'Info Sehat'],
                'author'        => 'Konselor Parenting',
                'read_time'     => '4 mnt baca',
                'image'         => base_url('images/smiling-baby-sample.jpg'),
                'saved_type'    => 'artikel'
            ],
            [
                'id'            => 'art-13',
                'title'         => 'Nutrisi Penting Ibu Selama Hamil Trimester Pertama (0 - 12 Minggu)',
                'excerpt'       => 'Asam folat, zat besi, dan vitamin B6 adalah pilar utama pembentukan organ vital janin serta pereda mual di trimester awal.',
                'category_slug' => 'gaya-hidup',
                'category_name' => 'Gaya Hidup',
                'age_slug'      => 'hamil-trimester-1',
                'age_label'     => 'Hamil Trimester 1',
                'type'          => 'artikel',
                'type_label'    => 'Artikel',
                'subtags'       => ['Nutrisi', 'Info Sehat'],
                'author'        => 'dr. Sp.OG Rina Wulandari',
                'read_time'     => '5 mnt baca',
                'image'         => base_url('images/mother-child-reading.jpg'),
                'saved_type'    => 'artikel'
            ],
            [
                'id'            => 'art-14',
                'title'         => '[Video] Animasi Lagu Edukasi Mengenal Warna, Angka & Buah',
                'excerpt'       => 'Video ramah anak dengan tempo tenang, warna lembut tidak menyilaukan mata, dan lirik edukatif untuk stimulasi visual batita.',
                'category_slug' => 'video-aman',
                'category_name' => 'Video Aman Anak',
                'age_slug'      => '1-2-tahun',
                'age_label'     => '1 - 2 tahun',
                'type'          => 'video',
                'type_label'    => 'Video',
                'subtags'       => ['Perkembangan', 'Rekomendasi'],
                'author'        => 'Studio Edukasi Parentela',
                'read_time'     => '7 mnt video',
                'image'         => base_url('images/cand-child-reading.jpg'),
                'saved_type'    => 'stimulasi'
            ],
            [
                'id'            => 'art-15',
                'title'         => '[Video] Gerak Senam Ceria: Melatih Koordinasi Tubuh & Kelincahan',
                'excerpt'       => 'Ikuti instruktur anak dalam gerakan tarian sederhana yang membakar energi positif si kecil di dalam ruangan saat cuaca hujan.',
                'category_slug' => 'video-aman',
                'category_name' => 'Video Aman Anak',
                'age_slug'      => '2-5-tahun',
                'age_label'     => '2 - 5 tahun',
                'type'          => 'video',
                'type_label'    => 'Video',
                'subtags'       => ['Pertumbuhan', 'Rekomendasi'],
                'author'        => 'Instruktur Anak Parentela',
                'read_time'     => '8 mnt video',
                'image'         => base_url('images/cand-toddler-outdoors.jpg'),
                'saved_type'    => 'stimulasi'
            ],
            [
                'id'            => 'art-16',
                'title'         => '[Webinar] Tanya Dokter Anak: Kupas Tuntas Alergi & Penyakit Kulit Bayi',
                'excerpt'       => 'Rekaman webinar interaktif bersama dokter spesialis anak membahas pemicu dermatitis atopik, tes alergi, dan penanganan rumahan.',
                'category_slug' => 'kesehatan',
                'category_name' => 'Kesehatan',
                'age_slug'      => '0-6-bulan',
                'age_label'     => '0 - 6 bulan',
                'type'          => 'video',
                'type_label'    => 'Video',
                'subtags'       => ['Penyakit', 'Info Sehat'],
                'author'        => 'dr. Aulia Rahma, Sp.A',
                'read_time'     => '45 mnt webinar',
                'image'         => base_url('images/cand-talk-2.jpg'),
                'saved_type'    => 'stimulasi'
            ],
            [
                'id'            => 'art-17',
                'title'         => '[Video] Kupas Pola Tidur & Membangun Kebiasaan Tidur Mandiri Anak',
                'excerpt'       => 'Konsultan tidur anak mengupas tuntas trik transisi tidur di ranjang sendiri tanpa drama menangis berkepanjangan.',
                'category_slug' => 'parenting',
                'category_name' => 'Parenting',
                'age_slug'      => '1-2-tahun',
                'age_label'     => '1 - 2 tahun',
                'type'          => 'video',
                'type_label'    => 'Video',
                'subtags'       => ['Pola Asuh', 'Perkembangan'],
                'author'        => 'Sleep Coach Parentela',
                'read_time'     => '38 mnt webinar',
                'image'         => base_url('images/sleeping-baby-sample.jpg'),
                'saved_type'    => 'stimulasi'
            ],
            [
                'id'            => 'art-18',
                'title'         => 'Pengalaman Menyapih Balita Usia 2 Tahun dengan Kasih Sayang',
                'excerpt'       => 'Panduan hangat dan refleksi mendampingi proses weaning with love tanpa paksaan agar anak tetap merasa dicintai dan aman secara emosional.',
                'category_slug' => 'parenting',
                'category_name' => 'Parenting',
                'age_slug'      => '2-5-tahun',
                'age_label'     => '2 - 5 tahun',
                'type'          => 'artikel',
                'type_label'    => 'Artikel',
                'subtags'       => ['Pola Asuh', 'Rekomendasi'],
                'author'        => 'Nadia Safitri, M.Psi., Psikolog',
                'read_time'     => '5 mnt baca',
                'image'         => base_url('images/cand-mother-child.jpg'),
                'saved_type'    => 'artikel'
            ],
            [
                'id'            => 'art-19',
                'title'         => 'Trik Menghadapi Anak Pilih-Pilih Makanan (Picky Eater)',
                'excerpt'       => 'Tips praktis dari dokter anak & ahli gizi seputar kreasi penyajian makanan menarik dan kombinasi warna piring saji untuk si kecil yang pemilih.',
                'category_slug' => 'gaya-hidup',
                'category_name' => 'Gaya Hidup',
                'age_slug'      => '2-5-tahun',
                'age_label'     => '2 - 5 tahun',
                'type'          => 'artikel',
                'type_label'    => 'Artikel',
                'subtags'       => ['Nutrisi', 'Info Sehat'],
                'author'        => 'dr. Ryan Hartanto, Sp.A & Ahli Gizi',
                'read_time'     => '6 mnt baca',
                'image'         => base_url('images/cand-talk-3.jpg'),
                'saved_type'    => 'artikel'
            ]
        ];

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
        // 1. Data Spesifik Detail Video (Sesuai Screenshot 1, 2, 3)
        $videoDetail = [
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
            'video_youtube_id' => 'dQw4w9WgXcQ', // Embed ID / Demo video
            'active_episode_title' => 'SANG EP.01 - Kenapa Harus Berbagi?',
            'episodes'       => [
                [
                    'number'      => 1,
                    'title'       => 'Episode 1: Kenapa Harus Berbagi?',
                    'action_text' => 'Tonton Di Sini',
                    'desc'        => 'Mengajak anak memahami empati dan kebersamaan lewat situasi sederhana yang sering mereka alami di rumah dan sekolah.',
                    'thumb'       => base_url('images/cand-child-reading.jpg'),
                    'video_id'    => 'dQw4w9WgXcQ',
                    'duration'    => '03:15'
                ],
                [
                    'number'      => 2,
                    'title'       => 'Episode 2: Kenapa Perlu Berterima Kasih?',
                    'action_text' => 'Tonton Di Sini',
                    'desc'        => 'Mengenalkan rasa syukur dan apresiasi melalui aktivitas harian yang dekat dengan dunia anak, melatih kesantunan sejak dini.',
                    'thumb'       => base_url('images/cand-talk-1.jpg'),
                    'video_id'    => 'dQw4w9WgXcQ',
                    'duration'    => '03:20'
                ],
                [
                    'number'      => 3,
                    'title'       => 'Episode 3: Kenapa Butuh Maaf & Tolong?',
                    'action_text' => 'Tonton Di Sini',
                    'desc'        => 'Membantu anak mengenali emosi, memahami kesalahan tanpa rasa takut berlebih, dan belajar berkomunikasi asertif.',
                    'thumb'       => base_url('images/cand-kid-happy.jpg'),
                    'video_id'    => 'dQw4w9WgXcQ',
                    'duration'    => '03:40'
                ],
            ],
            'paragraphs'     => [
                'Di tengah maraknya rekomendasi film animasi berdurasi panjang di bioskop dan berbagai platform streaming, kini muncul kebutuhan baru yang semakin banyak dicari orang tua Indonesia: tontonan edukasi anak yang singkat, aman untuk screen time, dan tetap bermakna terutama saat libur panjang anak.',
                'Salah satu tontonan yang mulai banyak diperbincangkan adalah <strong>SANG</strong>, serial animasi edukasi anak dari Parentela yang tayang gratis. Animasi ini dirancang khusus bersama dokter anak dan psikolog anak untuk menemani anak selama libur sekolah, tanpa membuat orang tua khawatir soal durasi <em>screen-time</em>.',
                'Setiap episodenya dibatasi berdurasi tepat 3 menit dengan tempo visual tenang tanpa *fast-cuts* yang menyilaukan, sehingga tidak memicu stimulasi dopamin berlebihan pada batita. Dilengkapi lagu ceria yang mudah dihafal untuk menanamkan kebiasaan positif dalam keseharian.'
            ],
            'tips_box'       => [
                'title' => 'Panduan Screen Time Aman Menurut IDAI & WHO:',
                'items' => [
                    'Anak usia 2 - 5 tahun: Maksimal 1 jam per hari dengan konten berkualitas.',
                    'Selalu dampingi si kecil (co-viewing) dan ajak berdiskusi tentang apa yang ditonton.',
                    'Matikan layar minimal 1 jam sebelum jadwal tidur malam anak.'
                ]
            ]
        ];

        // 2. Data Spesifik Detail Artikel (Sesuai Screenshot 4)
        $articleDetail = [
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
                [
                    'num'   => 1,
                    'title' => 'Pilih sunscreen anak dengan kandungan zinc oxide dan titanium dioxide.',
                    'desc'  => 'Kandungan ini merupakan ciri utama <strong>physical/mineral sunscreen</strong>. Partikel mineral alami ini bekerja layaknya cermin yang memantulkan sinar matahari langsung dari permukaan kulit tanpa diserap ke dalam aliran darah, sehingga sangat minim risiko memicu dermatitis kontak atau reaksi alergi pada kulit balita.'
                ],
                [
                    'num'   => 2,
                    'title' => 'Perhatikan perlindungan Spektrum Luas (Broad Spectrum UVA & UVB).',
                    'desc'  => 'UVA dapat menembus lebih dalam ke lapisan kulit dermis dan berkontribusi terhadap kerusakan DNA jangka panjang, sementara sinar UVB bertanggung jawab atas kulit terbakar kemerahan (sunburn). Pastikan kemasan memiliki label <strong>Broad Spectrum</strong> atau logo PA+++.'
                ],
                [
                    'num'   => 3,
                    'title' => 'Gunakan kadar SPF 30 hingga 50 untuk paparan matahari tropis.',
                    'desc'  => 'Untuk iklim Indonesia, SPF 30 sudah mampu menyaring hingga 97% sinar UVB, sedangkan SPF 50 memproteksi 98%. Hindari pemakaian SPF di atas 50 karena konsentrasi bahan kimia yang lebih pekat dapat terasa berat dan menyumbat pori-pori kulit anak.'
                ],
                [
                    'num'   => 4,
                    'title' => 'Prioritaskan formula tahan air (Water-Resistant) bila bermain di air.',
                    'desc'  => 'Bila anak bermain di kolam renang atau pantai, formula tahan air menjaga proteksi bertahan selama 40 hingga 80 menit saat terkena keringat maupun air. Tetap aplikasikan ulang setiap 2 jam sekali untuk hasil optimal.'
                ],
                [
                    'num'   => 5,
                    'title' => 'Lakukan uji tempel (Patch Test) 24 jam sebelum pemakaian menyeluruh.',
                    'desc'  => 'Oleskan sedikit produk pada area belakang telinga atau lipatan siku si kecil. Amati selama 24 jam. Jika tidak ada kemerahan, bintik kecil, atau rasa gatal, sunscreen aman digunakan ke seluruh tubuh dan wajah si kecil.'
                ]
            ],
            'tips_box'       => [
                'title' => 'Catatan Penting Dokter Anak:',
                'items' => [
                    'Bayi di bawah usia 6 bulan sebaiknya dihindarkan dari paparan langsung sinar matahari terik, utamakan pakaian tertutup dan topi lebar.',
                    'Gunakan takaran sunscreen setara satu sendok teh untuk seluruh area wajah dan leher anak.'
                ]
            ]
        ];

        // Penentuan Konten yang Ditampilkan
        if ($slug === 'art-video-1' || $slug === 'video' || $slug === 'art-14' || $slug === 'art-15' || $slug === 'libur-panjang-anak-tanpa-drama-screen-time') {
            $content = $videoDetail;
        } else {
            $content = $articleDetail;
            // Jika mengakses ID tertentu, sesuaikan judul agar dinamis
            if ($slug && $slug !== 'art-1') {
                $content['id'] = $slug;
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
        $typeMap = [
            'daycare' => 'Daycare & Tempat Penitipan Anak',
            'nursery-room' => 'Nursery Room & Ruang Laktasi',
            'playground' => 'Playground Ramah Anak',
            'taman-bacaan' => 'Taman Bacaan Masyarakat',
            'panti-asuhan' => 'Panti Asuhan & Lembaga Sosial',
            'nursery-playground' => 'Nursery & Playground'
        ];

        $typeName = $type ? ($typeMap[$type] ?? ucwords(str_replace('-', ' ', $type))) : 'Direktori Tempat Asuh';

        // Data 10 Panti Asuhan Asli di Surabaya Lengkap dengan Slug
        $pantiList = [
            [
                'slug' => 'panti-aisyiyah-1',
                'nama' => "Panti Asuhan Yatim Putri 'Aisyiyah 1",
                'lokasi' => '📍 Jl. Baratajaya XIX No.72, Gubeng, Surabaya',
                'deskripsi' => 'Panti asuhan teladan yang telah resmi meraih Akreditasi A dari Kementerian Sosial RI dengan pembinaan pendidikan dan akhlak yang sangat terstruktur.',
                'image' => base_url('images/locations/aisyiyah.jpg')
            ],
            [
                'slug' => 'panti-don-bosco',
                'nama' => 'Panti Asuhan Don Bosco',
                'lokasi' => '📍 Jl. Tidar No.115, Sawahan, Surabaya',
                'deskripsi' => 'Panti asuhan legendaris yang luas dan asri, dikenal disiplin serta memiliki fasilitas penunjang keterampilan anak yang lengkap.',
                'image' => base_url('images/locations/don-bosco.png')
            ],
            [
                'slug' => 'panti-undaan',
                'nama' => 'Panti Asuhan Yatim Piatu Undaan (PAU)',
                'lokasi' => '📍 Jl. Undaan Kulon No.39-41, Genteng, Surabaya',
                'deskripsi' => 'Berdiri sejak tahun 1919 di jantung kota Surabaya, konsisten mencetak anak-anak asuh berprestasi dengan tata kelola profesional.',
                'image' => base_url('images/locations/undaan.png')
            ],
            [
                'slug' => 'panti-pyi-ngagel',
                'nama' => 'Panti Asuhan PYI (Panti Yatim Indonesia)',
                'lokasi' => '📍 Jl. Ngagel Madya Kertajaya No.83, Gubeng, Surabaya',
                'deskripsi' => 'Asrama anak yatim dan dhuafa dengan fasilitas modern, bersih, serta transparan yang menjadi rujukan utama penyaluran santunan.',
                'image' => base_url('images/locations/pyi.png')
            ],
            [
                'slug' => 'panti-muhammadiyah-dahlan',
                'nama' => 'Panti Asuhan Muhammadiyah KH. Achmad Dahlan',
                'lokasi' => '📍 Jl. Tambak Asri No.202, Krembangan, Surabaya',
                'deskripsi' => 'Dikelola di bawah naungan ormas besar dengan asrama rapi yang mengutamakan pendidikan formal berkualitas tinggi.',
                'image' => base_url('images/locations/panti-dahlan.png')
            ],
            [
                'slug' => 'panti-al-fatimah',
                'nama' => 'Panti Asuhan Al-Fatimah Surabaya',
                'lokasi' => '📍 Jl. Kalidami, Gubeng, Surabaya Timur',
                'deskripsi' => 'Yayasan sosial penampung anak yatim dan dhuafa yang memiliki pengurus sangat ramah, amanah, serta terbuka bagi donatur.',
                'image' => base_url('images/locations/fatimah.png')
            ],
            [
                'slug' => 'panti-griya-yatim',
                'nama' => 'Panti Asuhan Griya Yatim & Dhuafa',
                'lokasi' => '📍 Jl. Rungkut Mapan Blok FD No.4, Rungkut, Surabaya',
                'deskripsi' => 'Asrama yatim di kawasan perumahan yang tenang, sangat bersih, tertata modern, dan transparan secara digital.',
                'image' => 'https://images.unsplash.com/photo-1513694203232-719a280e022f?q=80&w=800&auto=format&fit=crop'
            ],
            [
                'slug' => 'panti-bhakti-luhur',
                'nama' => 'Panti Asuhan Bhakti Luhur Surabaya',
                'lokasi' => '📍 Wilayah Dukuh Pakis / Ketintang, Surabaya',
                'deskripsi' => 'Didedikasikan untuk memberikan perawatan, kasih sayang, dan pendidikan khusus bagi anak-anak yatim serta berkebutuhan khusus.',
                'image' => 'https://images.unsplash.com/photo-1582213782179-e0d53f98f2ca?q=80&w=800&auto=format&fit=crop'
            ],
            [
                'slug' => 'panti-cahaya-insani',
                'nama' => 'Panti Asuhan Yatim Cahaya Insani',
                'lokasi' => '📍 Jl. Gubeng Kertajaya III, Gubeng, Surabaya',
                'deskripsi' => 'Berlokasi strategis di pusat kota dengan fasilitas tempat tinggal yang bersih serta kenyamanan ruang belajar anak asuh.',
                'image' => 'https://images.unsplash.com/photo-1523240795612-9a054b0db644?q=80&w=800&auto=format&fit=crop'
            ],
            [
                'slug' => 'panti-al-haq',
                'nama' => 'Panti Asuhan Al-Haq Surabaya',
                'lokasi' => '📍 Wilayah Gayungan, Surabaya Selatan',
                'deskripsi' => 'Lembaga pembinaan anak yatim piatu yang aktif menyelenggarakan bimbingan belajar gratis dan pelatihan karakter mandiri.',
                'image' => 'https://images.unsplash.com/photo-1497215728101-856f4ea42174?q=80&w=800&auto=format&fit=crop'
            ]
        ];

        return view('pages/directory', [
            'title'       => $typeName . ' - Parentela',
            'sectionType' => 'asuh',
            'activeType'  => $type ?? 'semua',
            'typeName'    => $typeName,
            'pantiList'   => $pantiList
        ]);
    }

    public function pendidikan($category = null, $sub = null)
    {
        // Normalisasi kategori
        if (empty($category) || $category === 'semua') {
            $category = 'formal';
        } elseif ($category === 'kursus') {
            $category = 'nonformal';
            $sub = 'kursus';
        } elseif (in_array($category, ['tk', 'sd', 'smp', 'sma', 'smk'])) {
            $sub = $category;
            $category = 'formal';
        }

        if (empty($sub)) {
            $sub = 'semua';
        }

        // Data Lembaga Pendidikan Formal di Surabaya
        $sekolahFormal = [
            // TK / PAUD
            [
                'jenjang'     => 'tk',
                'jenjang_label'=> 'TK / PAUD',
                'nama'        => 'TK Al-Falah Surabaya',
                'lokasi'      => '📍 Jl. Raya Darmo No.68, Tegalsari, Surabaya',
                'akreditasi'  => 'Akreditasi A',
                'kurikulum'   => 'Kurikulum Merdeka Plus Karakter Islami',
                'deskripsi'   => 'Taman kanak-kanak teladan di Surabaya Pusat dengan fokus pada pembiasaan akhlak mulia, kemandirian anak, serta stimulasi sensori motorik usia dini.',
                'fasilitas'   => ['Playground indoor & outdoor ramah anak', 'Kolam renang anak higienis', 'Ruang audio visual & multimedia', 'Konseling psikolog tumbuh kembang'],
                'image'       => 'https://images.unsplash.com/photo-1587654780291-39c9404d746b?q=80&w=600&auto=format&fit=crop',
                'kontak'      => 'https://alfalahsurabaya.sch.id'
            ],
            [
                'jenjang'     => 'tk',
                'jenjang_label'=> 'TK / PAUD',
                'nama'        => 'TK Kristen Petra Surabaya',
                'lokasi'      => '📍 Jl. Kalianyar No.43, Genteng, Surabaya',
                'akreditasi'  => 'Akreditasi A',
                'kurikulum'   => 'Kurikulum Bilingual & Pembinaan Karakter Kasih',
                'deskripsi'   => 'Lembaga pendidikan prasekolah berstandar tinggi yang menumbuhkan kreativitas, kecerdasan sosial, dan pengenalan bahasa Inggris interaktif sejak dini.',
                'fasilitas'   => ['Taman bermain tematik aman', 'Ruang musik & stimulasi ritme', 'Perpustakaan cerita anak bergambar', 'Kegiatan field trip edukatif berkala'],
                'image'       => 'https://images.unsplash.com/photo-1595841696677-6489ff3f8cd1?q=80&w=600&auto=format&fit=crop',
                'kontak'      => 'https://petra.ac.id'
            ],
            [
                'jenjang'     => 'tk',
                'jenjang_label'=> 'TK / PAUD',
                'nama'        => 'TK Khadijah Wonokromo',
                'lokasi'      => '📍 Jl. Ahmad Yani No.2-4, Wonokromo, Surabaya',
                'akreditasi'  => 'Akreditasi A',
                'kurikulum'   => 'Pendidikan Holistik Anak & Pembiasaan Al-Quran',
                'deskripsi'   => 'Sekolah prasekolah unggulan di Surabaya Selatan yang menyeimbangkan antara stimulasi kognitif, motorik halus-kasar, dan penanaman budi pekerti santun.',
                'fasilitas'   => ['Sentra belajar tematik', 'Area bermain pasir & air', 'Pemeriksaan kesehatan rutin anak', 'UKS dan tenaga medis terlatih'],
                'image'       => 'https://images.unsplash.com/photo-1509062522246-3755977927d7?q=80&w=600&auto=format&fit=crop',
                'kontak'      => 'https://khadijah.or.id'
            ],

            // SD / MI
            [
                'jenjang'     => 'sd',
                'jenjang_label'=> 'SD / MI',
                'nama'        => 'SD Muhammadiyah 4 Surabaya (Pucang)',
                'lokasi'      => '📍 Jl. Pucang Anom No.54, Gubeng, Surabaya',
                'akreditasi'  => 'Akreditasi A (Teladan Nasional)',
                'kurikulum'   => 'Kurikulum Merdeka, Cambridge English & Robotika',
                'deskripsi'   => 'Dikenal sebagai "Sekolah Teladan Nasional", SDM 4 Pucang mengintegrasikan sains mutakhir, ekstrakurikuler robotika internasional, dan pembinaan tahfidz.',
                'fasilitas'   => ['Laboratorium Robotika & AI Cilik', 'Smart Classroom ber-AC & Proyektor', 'Perpustakaan Digital Terakreditasi A', 'Kantin Sehat Berstandar BPOM'],
                'image'       => 'https://images.unsplash.com/photo-1580582932707-520aed937b7b?q=80&w=600&auto=format&fit=crop',
                'kontak'      => 'https://sdm4sby.sch.id'
            ],
            [
                'jenjang'     => 'sd',
                'jenjang_label'=> 'SD / MI',
                'nama'        => 'SD Santa Maria Surabaya',
                'lokasi'      => '📍 Jl. Raya Darmo No.49, Tegalsari, Surabaya',
                'akreditasi'  => 'Akreditasi A (Unggul)',
                'kurikulum'   => 'Kurikulum Nasional Inovatif & Nilai Karakter Ursulin',
                'deskripsi'   => 'Sekolah dasar legendaris di jantung kota Surabaya dengan lingkungan hijau asri, menekankan integritas, kepemimpinan kasih, dan keunggulan akademik.',
                'fasilitas'   => ['Laboratorium Sains Praktik Terpadu', 'Studio Musik & Ansambel', 'Lapangan Olahraga & Gym Indoor', 'Pendampingan Minat Bakat Siswa'],
                'image'       => 'https://images.unsplash.com/photo-1497633762265-9d179a990aa6?q=80&w=600&auto=format&fit=crop',
                'kontak'      => 'https://santamaria.sch.id'
            ],
            [
                'jenjang'     => 'sd',
                'jenjang_label'=> 'SD / MI',
                'nama'        => 'SD Negeri Kaliasin I Surabaya',
                'lokasi'      => '📍 Jl. Gubernur Suryo No.26, Genteng, Surabaya',
                'akreditasi'  => 'Akreditasi A (Adiwiyata Mandiri)',
                'kurikulum'   => 'Kurikulum Merdeka Penguatan Profil Pelajar Pancasila',
                'deskripsi'   => 'Sekolah dasar negeri favorit dan percontohan ramah anak di pusat Surabaya, meraih penghargaan Adiwiyata Mandiri Nasional untuk kelestarian lingkungan.',
                'fasilitas'   => ['Green House & Edukasi Lingkungan', 'Lab Komputer & Internet Pintar', 'UKS Teladan Kota Surabaya', 'Klub Robotika & Pramuka Berprestasi'],
                'image'       => 'https://images.unsplash.com/photo-1503676260728-1c00da094a0b?q=80&w=600&auto=format&fit=crop',
                'kontak'      => 'https://sdnkaliasin1.sch.id'
            ],

            // SMP / MTs
            [
                'jenjang'     => 'smp',
                'jenjang_label'=> 'SMP / MTs',
                'nama'        => 'SMP Negeri 1 Surabaya',
                'lokasi'      => '📍 Jl. Pacar No.4, Ketabang, Genteng, Surabaya',
                'akreditasi'  => 'Akreditasi A (Sekolah Penggerak Utama)',
                'kurikulum'   => 'Kurikulum Merdeka Berstandar Riset & Olimpiade',
                'deskripsi'   => 'Sekolah menengah pertama tertua dan terkemuka di Surabaya yang konsisten melahirkan juara olimpiade sains, riset ilmiah remaja, dan seni budaya.',
                'fasilitas'   => ['Laboratorium Sains & Digital Terlengkap', 'Studio Podcast & Multimedia Siswa', 'Aula Olahraga Serbaguna & Lapangan Basket', 'Perpustakaan Standar Nasional'],
                'image'       => 'https://images.unsplash.com/photo-1523240795612-9a054b0db644?q=80&w=600&auto=format&fit=crop',
                'kontak'      => 'https://smpn1sby.sch.id'
            ],
            [
                'jenjang'     => 'smp',
                'jenjang_label'=> 'SMP / MTs',
                'nama'        => 'SMP Al-Hikmah Surabaya',
                'lokasi'      => '📍 Jl. Kebonsari Elveka V, Jambangan, Surabaya Selatan',
                'akreditasi'  => 'Akreditasi A (Unggulan Islami)',
                'kurikulum'   => 'Kurikulum Terpadu Nasional, Riset & Tahfidz Al-Quran',
                'deskripsi'   => 'Lembaga pendidikan menengah pertama berbasis nilai Islam modern dengan fasilitas asrama kondusif, budaya riset, dan penguatan kepemimpinan remaja.',
                'fasilitas'   => ['Dome Olahraga Indoor & Futsal', 'Laboratorium Bahasa & Multimedia', 'Masjid Megah Pusat Tarbiyah', 'Program Pembinaan Olimpiade Intensif'],
                'image'       => 'https://images.unsplash.com/photo-1491438590914-bc09fcaaf77a?q=80&w=600&auto=format&fit=crop',
                'kontak'      => 'https://alhikmahsby.sch.id'
            ],
            [
                'jenjang'     => 'smp',
                'jenjang_label'=> 'SMP / MTs',
                'nama'        => 'SMP Katolik Angelus Custos Surabaya',
                'lokasi'      => '📍 Jl. Wonorejo Indah No.7, Rungkut, Surabaya',
                'akreditasi'  => 'Akreditasi A (Unggul)',
                'kurikulum'   => 'Kurikulum Berkelanjutan Berbasis Disiplin & Sains',
                'deskripsi'   => 'SMP Katolik terfavorit di Surabaya Timur dengan rekam jejak akademik cemerlang, penguasaan bahasa Inggris aktif, dan pembentukan watak tangguh.',
                'fasilitas'   => ['Lab Komputer & Bahasa Digital', 'Lapangan Basket & Voli Standar', 'Ruang Bimbingan Konseling Ramah Remaja', 'Klub Teater & Band Musik'],
                'image'       => 'https://images.unsplash.com/photo-1427504494785-3a9ca7044f45?q=80&w=600&auto=format&fit=crop',
                'kontak'      => 'https://angeluscustos.sch.id'
            ],

            // SMA / SMK
            [
                'jenjang'     => 'sma',
                'jenjang_label'=> 'SMA / SMK',
                'nama'        => 'SMA Negeri 5 Surabaya (Smala)',
                'lokasi'      => '📍 Jl. Kusuma Bangsa No.21, Genteng, Surabaya',
                'akreditasi'  => 'Akreditasi A (Peringkat 1 Jawa Timur)',
                'kurikulum'   => 'Kurikulum Merdeka Kelas Akselerasi & Riset Nasional',
                'deskripsi'   => 'SMA unggulan nomor satu di Jawa Timur dengan tingkat kelulusan SNMPTN/SNBP tertinggi di perguruan tinggi terkemuka dalam dan luar negeri.',
                'fasilitas'   => ['Laboratorium Riset Terpadu Fisika/Kimia/Bio', 'Perpustakaan Riset Modern', 'Lapangan Futsal & Basket Berstandar', 'Bimbingan Konsultasi Karir & PTN Intensif'],
                'image'       => 'https://images.unsplash.com/photo-1522202176988-66273c2fd55f?q=80&w=600&auto=format&fit=crop',
                'kontak'      => 'https://sman5sby.sch.id'
            ],
            [
                'jenjang'     => 'sma',
                'jenjang_label'=> 'SMA / SMK',
                'nama'        => 'SMK Negeri 5 Surabaya (STM Menur)',
                'lokasi'      => '📍 Jl. Mayjen Prof. Dr. Moestopo No.167, Surabaya',
                'akreditasi'  => 'Akreditasi A (SMK Pusat Keunggulan Industri)',
                'kurikulum'   => 'Vokasi Industri 4.0, Rekayasa Perangkat Lunak, Teknik Mesin & Listrik',
                'deskripsi'   => 'SMK Pusat Keunggulan berstatus BLUD dengan fasilitas bengkel modern berstandar industri dan jaringan kemitraan penyaluran kerja terpercaya.',
                'fasilitas'   => ['Teaching Factory Industri Nyata', 'Bengkel CNC & Lab Otomasi Robotik', 'Lembaga Sertifikasi Profesi (LSP) P1', 'Bursa Kerja Khusus (BKK) Aktif'],
                'image'       => 'https://images.unsplash.com/photo-1581092918056-0c4c3acd3789?q=80&w=600&auto=format&fit=crop',
                'kontak'      => 'https://smkn5sby.sch.id'
            ],
            [
                'jenjang'     => 'sma',
                'jenjang_label'=> 'SMA / SMK',
                'nama'        => 'SMA Kristen Petra 2 Surabaya',
                'lokasi'      => '📍 Jl. Manyar Tirtoasri V No.1-3, Sukolilo, Surabaya Timur',
                'akreditasi'  => 'Akreditasi A (Sekolah Penggerak)',
                'kurikulum'   => 'Kurikulum Internasional STEM, Kewirausahaan & Persiapan PTN Global',
                'deskripsi'   => 'Sekolah menengah atas modern yang memadukan keunggulan sains terapan, teknologi digital, serta pembinaan kepemimpinan berwawasan global.',
                'fasilitas'   => ['Auditorium Megah Berkapasitas 1.000 Siswa', 'Lab Komputer iMac Apple & PC High-End', 'Studio Musik & Orkestra', 'Lapangan Olahraga Tertutup'],
                'image'       => 'https://images.unsplash.com/photo-1564981797816-1043664bf78d?q=80&w=600&auto=format&fit=crop',
                'kontak'      => 'https://petra.ac.id'
            ]
        ];

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

        return view('pages/pendidikan', [
            'title'            => 'Direktori Pendidikan Anak Surabaya (Formal & Nonformal) - Parentela',
            'activeCategory'   => $category,
            'activeSub'        => $sub,
            'sekolahFormal'    => $sekolahFormal,
            'lembagaNonformal' => $lembagaNonformal
        ]);
    }

    public function kewenangan($sub = null)
    {
        return view('pages/kewenangan', [
            'title' => 'Kewenangan & Regulasi Perlindungan Ibu-Anak - Parentela',
            'activeSub' => $sub ?? 'ringkasan'
        ]);
    }

    public function detailDaycare($nama_daycare = null)
    {
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
        $nannyModel = new \App\Models\NannyModel();
        $nannies = $nannyModel->orderBy('is_verified', 'DESC')->orderBy('id', 'ASC')->findAll();

        return view('pages/nanny', [
            'title'   => 'Layanan Nanny & Pengasuh Berizin Surabaya - Parentela',
            'nannies' => $nannies
        ]);
    }
}