<?php

namespace App\Controllers;

use App\Models\DirectoryModel;
use App\Models\NannyModel;
use CodeIgniter\Controller;

class Admin extends BaseController
{
    protected $directoryModel;
    protected $nannyModel;
    protected $session;

    public function __construct()
    {
        $this->directoryModel = new DirectoryModel();
        $this->nannyModel     = new NannyModel();
        $this->session        = session();
    }

    private function checkAdmin()
    {
        if (!$this->session->get('is_logged_in') || $this->session->get('role') !== 'admin') {
            $this->session->setFlashdata('error', 'Akses khusus Administrator Parentela.');
            return false;
        }
        return true;
    }

    public function index($tab = 'dashboard')
    {
        if (!$this->checkAdmin()) {
            return redirect()->to(base_url('login'));
        }

        $db = \Config\Database::connect();
        $this->ensureArticlesTable();

        // Ambil statistik
        $totalDirectory  = $this->directoryModel->countAllResults();
        $totalVerified   = $this->directoryModel->where('is_verified', 1)->countAllResults();
        $totalNanny      = $this->nannyModel->countAllResults();
        
        $articlesCount = 0;
        if ($db->tableExists('articles')) {
            $articlesCount = $db->table('articles')->countAllResults();
        }

        // Ambil data direktori
        $activeCategory = $this->request->getGet('category') ?? 'all';
        if ($activeCategory !== 'all') {
            $directories = $this->directoryModel->where('category', $activeCategory)->orderBy('id', 'DESC')->findAll();
        } else {
            $directories = $this->directoryModel->orderBy('id', 'DESC')->findAll();
        }

        // Ambil data nanny
        $nannies = $this->nannyModel->orderBy('id', 'DESC')->findAll();

        // Ambil data artikel
        $articles = [];
        if ($db->tableExists('articles')) {
            $articles = $db->table('articles')->orderBy('id', 'DESC')->get()->getResultArray();
        }

        // Ambil site settings
        $settings = [];
        if ($db->tableExists('site_settings')) {
            $rows = $db->table('site_settings')->get()->getResultArray();
            foreach ($rows as $r) {
                $key = $r['setting_key'] ?? ($r['key_name'] ?? '');
                $val = $r['setting_value'] ?? ($r['value_content'] ?? '');
                if (!empty($key)) {
                    $settings[$key] = json_decode($val, true) ?? $val;
                }
            }
        }

        // Ambil data pendidikan
        $activeEduCategory = $this->request->getGet('category') ?? $this->request->getGet('edu_category') ?? 'all';
        $educations = [];
        $this->ensureEducationTable();
        $db2 = \Config\Database::connect();
        if ($db2->tableExists('education_places')) {
            $eduQ = $db2->table('education_places')->orderBy('id', 'DESC');
            if ($activeEduCategory === 'formal') {
                $eduQ->whereIn('category', ['tk', 'sd', 'smp', 'sma', 'smk', 'slb', 'formal']);
            } else if (in_array($activeEduCategory, ['nonformal', 'informal'])) {
                $eduQ->whereNotIn('category', ['tk', 'sd', 'smp', 'sma', 'smk', 'slb', 'formal']);
            } else if ($activeEduCategory !== 'all') {
                $eduQ->where('category', $activeEduCategory);
            }
            $educations = $eduQ->get()->getResultArray();
        }

        // Ambil data toko
        $activeShopCategory = $this->request->getGet('shop_category') ?? 'all';
        $shopProducts = [];
        $this->ensureShopTable();
        if ($db2->tableExists('shop_products')) {
            $shopQ = $db2->table('shop_products')->orderBy('id', 'DESC');
            if ($activeShopCategory !== 'all') {
                $shopQ->where('category', $activeShopCategory);
            }
            $shopProducts = $shopQ->get()->getResultArray();
        }
        $totalShopProducts = count($shopProducts);

        return view('admin/dashboard', [
            'title'              => 'Portal Administrator Parentela',
            'activeTab'          => $tab,
            'activeCategory'     => $activeCategory,
            'activeEduCategory'  => $activeEduCategory,
            'activeShopCategory' => $activeShopCategory,
            'totalDirectory'     => $totalDirectory,
            'totalVerified'      => $totalVerified,
            'totalNanny'         => $totalNanny,
            'totalArticles'      => $articlesCount,
            'totalShopProducts'  => $totalShopProducts,
            'directories'        => $directories,
            'nannies'            => $nannies,
            'articles'           => $articles,
            'educations'         => $educations,
            'shopProducts'       => $shopProducts,
            'settings'           => $settings
        ]);
    }

    /**
     * Simpan / Update Direktori
     */
    public function saveDirectory()
    {
        if (!$this->checkAdmin()) return redirect()->to(base_url('login'));

        // Pastikan kolom instagram ada (migrasi otomatis)
        $db = \Config\Database::connect();
        if ($db->tableExists('directory_places')) {
            $fields = $db->getFieldNames('directory_places');
            if (!in_array('instagram', $fields)) {
                $forge = \Config\Database::forge();
                $forge->addColumn('directory_places', ['instagram' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true, 'after' => 'wa']]);
            }
        }

        $id        = $this->request->getPost('id');
        $nama      = trim((string) $this->request->getPost('nama'));
        $category  = (string) $this->request->getPost('category');
        $lokasi    = trim((string) $this->request->getPost('lokasi'));
        $deskripsi = trim((string) $this->request->getPost('deskripsi'));
        $jam_buka  = trim((string) $this->request->getPost('jam_buka'));
        $usia      = trim((string) $this->request->getPost('usia'));
        $harga     = trim((string) $this->request->getPost('harga'));
        $wa        = trim((string) $this->request->getPost('wa'));
        $instagram = trim((string) $this->request->getPost('instagram'));
        $website   = trim((string) $this->request->getPost('website'));
        $gmaps     = trim((string) $this->request->getPost('gmaps'));
        $is_verified = $this->request->getPost('is_verified') ? 1 : 0;

        $slug = url_title(strtolower($nama), '-', true);

        // Prosess Upload Foto Utama (Cover / Sampul) jika ada
        $foto_utama = (string) $this->request->getPost('existing_foto');
        $fileImage  = $this->request->getFile('foto_utama');

        if ($fileImage && $fileImage->isValid() && !$fileImage->hasMoved()) {
            $uploadDir = FCPATH . 'uploads/directory/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            $newName = $fileImage->getRandomName();
            $fileImage->move($uploadDir, $newName);
            $foto_utama = 'uploads/directory/' . $newName;
        }

        // Prosess Foto Galeri / Detail Dalam (Multiple Upload)
        $existingGaleriRaw = $this->request->getPost('existing_galeri');
        $galeriArr = [];
        if (!empty($existingGaleriRaw)) {
            if (is_array($existingGaleriRaw)) {
                $galeriArr = $existingGaleriRaw;
            } else {
                $decoded = json_decode($existingGaleriRaw, true);
                if (is_array($decoded)) {
                    $galeriArr = $decoded;
                }
            }
        }

        $galeriFiles = $this->request->getFileMultiple('galeri_files');
        if (!empty($galeriFiles)) {
            $galeriDir = FCPATH . 'uploads/directory/galeri/';
            if (!is_dir($galeriDir)) {
                mkdir($galeriDir, 0777, true);
            }

            foreach ($galeriFiles as $gFile) {
                if ($gFile && $gFile->isValid() && !$gFile->hasMoved()) {
                    $newName = $gFile->getRandomName();
                    $gFile->move($galeriDir, $newName);
                    $galeriArr[] = 'uploads/directory/galeri/' . $newName;
                }
            }
        }

        $galeriJson = !empty($galeriArr) ? json_encode(array_values($galeriArr)) : null;

        // Fasilitas
        $fasilitasInput = trim((string) $this->request->getPost('fasilitas'));
        $fasilitasArr = array_filter(array_map('trim', explode("\n", $fasilitasInput)));
        $fasilitasJson = json_encode(array_values($fasilitasArr));

        $data = [
            'category'    => $category,
            'slug'        => $slug,
            'nama'        => $nama,
            'lokasi'      => $lokasi,
            'deskripsi'   => $deskripsi,
            'fasilitas'   => $fasilitasJson,
            'foto_utama'  => $foto_utama,
            'galeri'      => $galeriJson,
            'jam_buka'    => $jam_buka,
            'usia'        => $usia,
            'harga'       => $harga,
            'wa'          => $wa,
            'instagram'   => $instagram,
            'website'     => $website,
            'gmaps'       => $gmaps,
            'is_verified' => $is_verified
        ];

        if (!empty($id)) {
            $this->directoryModel->update($id, $data);
            $this->session->setFlashdata('success', 'Data direktori "' . $nama . '" berhasil diperbarui.');
        } else {
            $this->directoryModel->insert($data);
            $this->session->setFlashdata('success', 'Lokasi baru "' . $nama . '" berhasil ditambahkan ke direktori.');
        }

        return redirect()->to(base_url('admin/directory?category=' . $category));
    }

    /**
     * Hapus Direktori
     */
    public function deleteDirectory($id)
    {
        if (!$this->checkAdmin()) return redirect()->to(base_url('login'));

        $place = $this->directoryModel->find($id);
        if ($place) {
            $this->directoryModel->delete($id);
            $this->session->setFlashdata('success', 'Direktori tempat asuh berhasil dihapus.');
        }

        return redirect()->to(base_url('admin/directory'));
    }

    /**
     * Toggle Status Verifikasi
     */
    public function toggleVerifyDirectory($id)
    {
        if (!$this->checkAdmin()) return redirect()->to(base_url('login'));

        $place = $this->directoryModel->find($id);
        if ($place) {
            $newStatus = ($place['is_verified'] == 1) ? 0 : 1;
            $this->directoryModel->update($id, ['is_verified' => $newStatus]);
            $statusText = $newStatus ? 'Tepat & Terverifikasi' : 'Belum Terverifikasi';
            $this->session->setFlashdata('success', 'Status "' . $place['nama'] . '" diubah menjadi ' . $statusText . '.');
        }

        return redirect()->to(base_url('admin/directory'));
    }

    /**
     * Simpan / Update Pengasuh (Nanny)
     */
    public function saveNanny()
    {
        if (!$this->checkAdmin()) return redirect()->to(base_url('login'));

        $id        = $this->request->getPost('id');
        $nama      = trim((string) $this->request->getPost('nama'));
        $pengalaman= trim((string) $this->request->getPost('pengalaman'));
        $keahlian  = trim((string) $this->request->getPost('keahlian'));
        $tarif     = trim((string) $this->request->getPost('tarif'));
        $lokasi    = trim((string) $this->request->getPost('lokasi'));
        $wa        = trim((string) $this->request->getPost('wa'));
        $deskripsi = trim((string) $this->request->getPost('deskripsi'));
        $is_verified = $this->request->getPost('is_verified') ? 1 : 0;

        $foto = (string) $this->request->getPost('existing_foto');
        $fileImage = $this->request->getFile('foto');

        if ($fileImage && $fileImage->isValid() && !$fileImage->hasMoved()) {
            $uploadDir = FCPATH . 'uploads/nanny/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }
            $newName = $fileImage->getRandomName();
            $fileImage->move($uploadDir, $newName);
            $foto = 'uploads/nanny/' . $newName;
        }

        $data = [
            'nama'        => $nama,
            'foto'        => $foto,
            'pengalaman'  => $pengalaman,
            'keahlian'    => $keahlian,
            'tarif'       => $tarif,
            'lokasi'      => $lokasi,
            'wa'          => $wa,
            'deskripsi'   => $deskripsi,
            'is_verified' => $is_verified
        ];

        if (!empty($id)) {
            $this->nannyModel->update($id, $data);
            $this->session->setFlashdata('success', 'Profil pengasuh "' . $nama . '" berhasil diperbarui.');
        } else {
            $this->nannyModel->insert($data);
            $this->session->setFlashdata('success', 'Profil pengasuh baru "' . $nama . '" berhasil ditambahkan.');
        }

        return redirect()->to(base_url('admin/nanny'));
    }

    /**
     * Hapus Nanny
     */
    public function deleteNanny($id)
    {
        if (!$this->checkAdmin()) return redirect()->to(base_url('login'));

        $this->nannyModel->delete($id);
        $this->session->setFlashdata('success', 'Profil pengasuh berhasil dihapus.');
        return redirect()->to(base_url('admin/nanny'));
    }

    /**
     * Memastikan Tabel 'education_places' Siap Digunakan
     */
    private function ensureEducationTable()
    {
        $db = \Config\Database::connect();
        $forge = \Config\Database::forge();

        if (!$db->tableExists('education_places')) {
            $forge->addField([
                'id'          => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
                'category'    => ['type' => 'VARCHAR', 'constraint' => 100],
                'slug'        => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
                'nama'        => ['type' => 'VARCHAR', 'constraint' => 255],
                'akreditasi'  => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
                'kurikulum'   => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
                'lokasi'      => ['type' => 'TEXT', 'null' => true],
                'deskripsi'   => ['type' => 'TEXT', 'null' => true],
                'fasilitas'   => ['type' => 'TEXT', 'null' => true],
                'foto_utama'  => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
                'jam_buka'    => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
                'usia'        => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
                'harga'       => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
                'wa'          => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
                'instagram'   => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
                'website'     => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
                'gmaps'       => ['type' => 'TEXT', 'null' => true],
                'is_verified' => ['type' => 'TINYINT', 'constraint' => 1, 'default' => 0],
                'created_at'  => ['type' => 'DATETIME', 'null' => true],
                'updated_at'  => ['type' => 'DATETIME', 'null' => true],
            ]);
            $forge->addKey('id', true);
            $forge->createTable('education_places', true);
        } else {
            // Migrasi otomatis kolom jika belum ada
            $fields = $db->getFieldNames('education_places');
            $neededCols = [
                'akreditasi' => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
                'kurikulum'  => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
                'instagram'  => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
                'website'    => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            ];
            foreach ($neededCols as $cName => $cDef) {
                if (!in_array($cName, $fields)) {
                    $forge->addColumn('education_places', [$cName => $cDef]);
                }
            }
        }
    }

    /**
     * Simpan / Update Lembaga Pendidikan
     */
    public function saveEducation()
    {
        if (!$this->checkAdmin()) return redirect()->to(base_url('login'));
        $this->ensureEducationTable();

        $db         = \Config\Database::connect();
        $id         = $this->request->getPost('id');
        $nama       = trim((string) $this->request->getPost('nama'));
        $category   = (string) $this->request->getPost('category');
        $akreditasi = trim((string) $this->request->getPost('akreditasi'));
        $kurikulum  = trim((string) $this->request->getPost('kurikulum'));
        $lokasi     = trim((string) $this->request->getPost('lokasi'));
        $deskripsi  = trim((string) $this->request->getPost('deskripsi'));
        $jam_buka   = trim((string) $this->request->getPost('jam_buka'));
        $usia       = trim((string) $this->request->getPost('usia'));
        $wa         = trim((string) $this->request->getPost('wa'));
        $instagram  = trim((string) $this->request->getPost('instagram'));
        $website    = trim((string) $this->request->getPost('website'));
        $gmaps      = trim((string) $this->request->getPost('gmaps'));
        $is_verified = $this->request->getPost('is_verified') ? 1 : 0;

        $slug = url_title(strtolower($nama), '-', true);

        $foto_utama = (string) $this->request->getPost('existing_foto');
        $fileImage  = $this->request->getFile('foto_utama');
        if ($fileImage && $fileImage->isValid() && !$fileImage->hasMoved()) {
            $uploadDir = FCPATH . 'uploads/education/';
            if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);
            $newName = $fileImage->getRandomName();
            $fileImage->move($uploadDir, $newName);
            $foto_utama = 'uploads/education/' . $newName;
        }

        $fasilitasArr  = array_filter(array_map('trim', explode("\n", trim((string) $this->request->getPost('fasilitas')))));
        $fasilitasJson = json_encode(array_values($fasilitasArr));

        $data = [
            'category'    => $category,
            'slug'        => $slug,
            'nama'        => $nama,
            'akreditasi'  => $akreditasi,
            'kurikulum'   => $kurikulum,
            'lokasi'      => $lokasi,
            'deskripsi'   => $deskripsi,
            'fasilitas'   => $fasilitasJson,
            'foto_utama'  => $foto_utama,
            'jam_buka'    => $jam_buka,
            'usia'        => $usia,
            'wa'          => $wa,
            'instagram'   => $instagram,
            'website'     => $website,
            'gmaps'       => $gmaps,
            'is_verified' => $is_verified,
            'updated_at'  => date('Y-m-d H:i:s'),
        ];

        if (!empty($id)) {
            $db->table('education_places')->where('id', $id)->update($data);
            $this->session->setFlashdata('success', 'Lembaga pendidikan "' . $nama . '" berhasil diperbarui.');
        } else {
            $data['created_at'] = date('Y-m-d H:i:s');
            $db->table('education_places')->insert($data);
            $this->session->setFlashdata('success', 'Lembaga pendidikan "' . $nama . '" berhasil ditambahkan.');
        }

        return redirect()->to(base_url('admin/education?edu_category=' . $category));
    }

    /**
     * Hapus Lembaga Pendidikan
     */
    public function deleteEducation($id)
    {
        if (!$this->checkAdmin()) return redirect()->to(base_url('login'));
        $db = \Config\Database::connect();
        $db->table('education_places')->where('id', $id)->delete();
        $this->session->setFlashdata('success', 'Lembaga pendidikan berhasil dihapus.');
        return redirect()->to(base_url('admin/education'));
    }

    /**
     * Toggle Status Verifikasi Pendidikan
     */
    public function toggleVerifyEducation($id)
    {
        if (!$this->checkAdmin()) return redirect()->to(base_url('login'));
        $db   = \Config\Database::connect();
        $edu  = $db->table('education_places')->where('id', $id)->get()->getRowArray();
        if ($edu) {
            $newStatus  = ($edu['is_verified'] == 1) ? 0 : 1;
            $statusText = $newStatus ? 'Terverifikasi' : 'Belum Terverifikasi';
            $db->table('education_places')->where('id', $id)->update(['is_verified' => $newStatus, 'updated_at' => date('Y-m-d H:i:s')]);
            $this->session->setFlashdata('success', 'Status "' . $edu['nama'] . '" diubah menjadi ' . $statusText . '.');
        }
        return redirect()->to(base_url('admin/education'));
    }

    /**
     * Memastikan Tabel 'articles' Siap Digunakan
     */
    private function ensureArticlesTable()
    {
        $db = \Config\Database::connect();
        $forge = \Config\Database::forge();

        if (!$db->tableExists('articles')) {
            $forge->addField([
                'id'            => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
                'title'         => ['type' => 'VARCHAR', 'constraint' => 255],
                'slug'          => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
                'category_slug' => ['type' => 'VARCHAR', 'constraint' => 100, 'default' => 'parenting'],
                'category_name' => ['type' => 'VARCHAR', 'constraint' => 100, 'default' => 'Parenting'],
                'age_slug'      => ['type' => 'VARCHAR', 'constraint' => 100, 'default' => 'semua-usia'],
                'age_label'     => ['type' => 'VARCHAR', 'constraint' => 100, 'default' => 'Semua Usia'],
                'type'          => ['type' => 'VARCHAR', 'constraint' => 50, 'default' => 'artikel'],
                'type_label'    => ['type' => 'VARCHAR', 'constraint' => 100, 'default' => 'Artikel'],
                'subtags'       => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
                'author'        => ['type' => 'VARCHAR', 'constraint' => 150, 'null' => true],
                'author_email'  => ['type' => 'VARCHAR', 'constraint' => 150, 'null' => true],
                'read_time'     => ['type' => 'VARCHAR', 'constraint' => 50, 'default' => '4 mnt baca'],
                'excerpt'       => ['type' => 'TEXT', 'null' => true],
                'content'       => ['type' => 'TEXT', 'null' => true],
                'image'         => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
                'thumbnail'     => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
                'status'        => ['type' => 'VARCHAR', 'constraint' => 50, 'default' => 'pending'],
                'created_at'    => ['type' => 'DATETIME', 'null' => true],
                'updated_at'    => ['type' => 'DATETIME', 'null' => true],
            ]);
            $forge->addKey('id', true);
            $forge->createTable('articles', true);
        } else {
            // Table exists, check and add missing columns dynamically
            $neededFields = [
                'category_slug' => ['type' => 'VARCHAR', 'constraint' => 100, 'default' => 'parenting'],
                'category_name' => ['type' => 'VARCHAR', 'constraint' => 100, 'default' => 'Parenting'],
                'age_slug'      => ['type' => 'VARCHAR', 'constraint' => 100, 'default' => 'semua-usia'],
                'age_label'     => ['type' => 'VARCHAR', 'constraint' => 100, 'default' => 'Semua Usia'],
                'type'          => ['type' => 'VARCHAR', 'constraint' => 50, 'default' => 'artikel'],
                'type_label'    => ['type' => 'VARCHAR', 'constraint' => 100, 'default' => 'Artikel'],
                'subtags'       => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
                'author'        => ['type' => 'VARCHAR', 'constraint' => 150, 'null' => true],
                'author_email'  => ['type' => 'VARCHAR', 'constraint' => 150, 'null' => true],
                'read_time'     => ['type' => 'VARCHAR', 'constraint' => 50, 'default' => '4 mnt baca'],
                'excerpt'       => ['type' => 'TEXT', 'null' => true],
                'image'         => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
                'thumbnail'     => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
                'status'        => ['type' => 'VARCHAR', 'constraint' => 50, 'default' => 'published'],
            ];

            foreach ($neededFields as $colName => $colDef) {
                if (!$db->fieldExists($colName, 'articles')) {
                    $forge->addColumn('articles', [$colName => $colDef]);
                }
            }
        }
    }

    /**
     * Simpan / Tambah Artikel oleh Administrator
     */
    public function saveArticle()
    {
        if (!$this->checkAdmin()) return redirect()->to(base_url('login'));
        $this->ensureArticlesTable();

        $db            = \Config\Database::connect();
        $id            = $this->request->getPost('id');
        $title         = trim((string) $this->request->getPost('title'));
        $category_slug = $this->request->getPost('category_slug') ?? 'parenting';
        $age_slug      = $this->request->getPost('age_slug') ?? 'semua-usia';
        $type          = $this->request->getPost('type') ?? 'artikel';
        $author        = trim((string) $this->request->getPost('author')) ?: 'Redaksi Parentela';
        $excerpt       = trim((string) $this->request->getPost('excerpt'));
        $content       = trim((string) $this->request->getPost('content'));
        $status        = $this->request->getPost('status') ?? 'published';

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

        $thumbnail = (string) $this->request->getPost('existing_thumbnail');
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
            'type_label'    => ($type === 'video') ? 'Video' : 'Artikel',
            'author'        => $author,
            'excerpt'       => $excerpt,
            'content'       => $content,
            'thumbnail'     => $thumbnail,
            'image'         => $thumbnail,
            'status'        => $status,
            'updated_at'    => date('Y-m-d H:i:s')
        ];

        if (!empty($id)) {
            $db->table('articles')->where('id', $id)->update($data);
            $this->session->setFlashdata('success', 'Artikel "' . $title . '" berhasil diperbarui.');
        } else {
            $data['created_at'] = date('Y-m-d H:i:s');
            $db->table('articles')->insert($data);
            $this->session->setFlashdata('success', 'Artikel "' . $title . '" berhasil diterbitkan.');
        }

        return redirect()->to(base_url('admin/articles'));
    }

    /**
     * Setujui & Terbitkan Artikel
     */
    public function approveArticle($id)
    {
        if (!$this->checkAdmin()) return redirect()->to(base_url('login'));
        $this->ensureArticlesTable();
        $db = \Config\Database::connect();

        $db->table('articles')->where('id', $id)->update([
            'status'     => 'published',
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        $this->session->setFlashdata('success', 'Artikel berhasil disetujui & diterbitkan ke Parentela.');
        return redirect()->to(base_url('admin/articles'));
    }

    /**
     * Tolak Pengajuan Artikel
     */
    public function rejectArticle($id)
    {
        if (!$this->checkAdmin()) return redirect()->to(base_url('login'));
        $this->ensureArticlesTable();
        $db = \Config\Database::connect();

        $db->table('articles')->where('id', $id)->update([
            'status'     => 'rejected',
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        $this->session->setFlashdata('success', 'Status artikel diubah menjadi Ditolak.');
        return redirect()->to(base_url('admin/articles'));
    }

    /**
     * Hapus Artikel
     */
    public function deleteArticle($id)
    {
        if (!$this->checkAdmin()) return redirect()->to(base_url('login'));
        $this->ensureArticlesTable();

        $db = \Config\Database::connect();
        $db->table('articles')->where('id', $id)->delete();
        $this->session->setFlashdata('success', 'Artikel berhasil dihapus.');
        return redirect()->to(base_url('admin/articles'));
    }

    /**
     * Simpan Pengaturan Situs (Kewenangan, Toko, Tentang Kami)
     */
    public function saveSettings()
    {
        if (!$this->checkAdmin()) return redirect()->to(base_url('login'));

        $db  = \Config\Database::connect();
        $key = $this->request->getPost('key_name');
        $val = $this->request->getPost('value_content');

        if (is_array($val)) {
            $val = json_encode($val);
        }

        $exist = $db->table('site_settings')->where('setting_key', $key)->get()->getRowArray();
        if ($exist) {
            $db->table('site_settings')->where('setting_key', $key)->update([
                'setting_value' => $val,
                'updated_at'    => date('Y-m-d H:i:s')
            ]);
        } else {
            $db->table('site_settings')->insert([
                'setting_key'   => $key,
                'setting_value' => $val,
                'updated_at'    => date('Y-m-d H:i:s')
            ]);
        }

        $this->session->setFlashdata('success', 'Pengaturan "' . ucfirst($key) . '" berhasil diperbarui.');
        return redirect()->to(base_url('admin/' . $key));
    }

    /**
     * Simpan / Update Produk Toko
     */
    public function saveShopProduct()
    {
        if (!$this->checkAdmin()) return redirect()->to(base_url('login'));

        $this->ensureShopTable();
        $model = new \App\Models\ShopProductModel();

        $id         = $this->request->getPost('id');
        $name       = trim((string)$this->request->getPost('name'));
        $subtext    = trim((string)$this->request->getPost('subtext'));
        $category   = trim((string)$this->request->getPost('category'));
        $shopeeLink = trim((string)$this->request->getPost('shopee_link'));
        $badge      = trim((string)$this->request->getPost('badge'));
        
        $imagePath  = trim((string)($this->request->getPost('existing_image') ?? ''));

        $imgFile = $this->request->getFile('image_file');
        if ($imgFile && $imgFile->isValid() && !$imgFile->hasMoved()) {
            $uploadDir = FCPATH . 'uploads/shop';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }
            $newName = $imgFile->getRandomName();
            $imgFile->move($uploadDir, $newName);
            $imagePath = 'uploads/shop/' . $newName;
        } else {
            $imageText = trim((string)($this->request->getPost('image_text') ?? ''));
            if (!empty($imageText)) {
                $imagePath = $imageText;
            }
        }

        $data = [
            'name'        => $name,
            'subtext'     => $subtext,
            'category'    => $category,
            'shopee_link' => $shopeeLink,
            'badge'       => $badge,
            'image'       => $imagePath,
            'is_active'   => 1
        ];

        if (!empty($id)) {
            $model->update($id, $data);
            $this->session->setFlashdata('success', 'Produk toko "' . $name . '" berhasil diperbarui.');
        } else {
            $model->insert($data);
            $this->session->setFlashdata('success', 'Produk toko "' . $name . '" berhasil ditambahkan.');
        }

        return redirect()->to(base_url('admin/toko'));
    }

    public function deleteShopProduct($id)
    {
        if (!$this->checkAdmin()) return redirect()->to(base_url('login'));

        $model = new \App\Models\ShopProductModel();
        $model->delete($id);
        $this->session->setFlashdata('success', 'Produk toko berhasil dihapus.');
        return redirect()->to(base_url('admin/toko'));
    }

    public function toggleActiveShopProduct($id)
    {
        if (!$this->checkAdmin()) return redirect()->to(base_url('login'));

        $model = new \App\Models\ShopProductModel();
        $item = $model->find($id);
        if ($item) {
            $newStatus = !empty($item['is_active']) ? 0 : 1;
            $model->update($id, ['is_active' => $newStatus]);
            $this->session->setFlashdata('success', 'Status produk berhasil diperbarui.');
        }
        return redirect()->to(base_url('admin/toko'));
    }

    private function ensureShopTable()
    {
        $db = \Config\Database::connect();
        $forge = \Config\Database::forge();

        if (!$db->tableExists('shop_products')) {
            $forge->addField([
                'id'          => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
                'name'        => ['type' => 'VARCHAR', 'constraint' => 255],
                'subtext'     => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
                'category'    => ['type' => 'VARCHAR', 'constraint' => 100, 'default' => 'ibu-hamil'],
                'shopee_link' => ['type' => 'VARCHAR', 'constraint' => 500, 'null' => true],
                'badge'       => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
                'image'       => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
                'is_active'   => ['type' => 'TINYINT', 'constraint' => 1, 'default' => 1],
                'created_at'  => ['type' => 'DATETIME', 'null' => true],
                'updated_at'  => ['type' => 'DATETIME', 'null' => true],
            ]);
            $forge->addKey('id', true);
            $forge->createTable('shop_products', true);

            $this->seedInitialShopProducts();
        }
    }

    private function seedInitialShopProducts()
    {
        $db = \Config\Database::connect();
        if (!$db->tableExists('shop_products')) return;

        $count = $db->table('shop_products')->countAllResults();
        if ($count > 0) return;

        $now = date('Y-m-d H:i:s');
        $initialData = [
            // Ibu & Kehamilan
            [
                'name' => 'Bantal Hamil Ergonomis (Model 1)',
                'subtext' => 'Menopang perut & punggung saat tidur',
                'category' => 'ibu-hamil',
                'shopee_link' => 'https://id.shp.ee/yVqRp9is',
                'badge' => '⭐ Rekomendasi Bumil',
                'image' => 'images/bantal_hamil_model1.png',
                'is_active' => 1, 'created_at' => $now, 'updated_at' => $now
            ],
            [
                'name' => 'Bantal Hamil Maternity (Model 2)',
                'subtext' => 'Bahan katun lembut & sarung washable',
                'category' => 'ibu-hamil',
                'shopee_link' => 'https://id.shp.ee/pYJBN7GE',
                'badge' => '⭐ Best Seller',
                'image' => 'images/bantal_hamil_model2.png',
                'is_active' => 1, 'created_at' => $now, 'updated_at' => $now
            ],
            [
                'name' => 'Bantal Hamil U-Shape Premium (Model 3)',
                'subtext' => 'Kenyamanan tidur maksimal trimester 2-3',
                'category' => 'ibu-hamil',
                'shopee_link' => 'https://id.shp.ee/VXQ4bomL',
                'badge' => '',
                'image' => 'images/bantal_hamil_model3.png',
                'is_active' => 1, 'created_at' => $now, 'updated_at' => $now
            ],
            [
                'name' => 'Bantal Hamil Comfort (Model 4)',
                'subtext' => 'Desain praktis fleksibel',
                'category' => 'ibu-hamil',
                'shopee_link' => 'https://id.shp.ee/LetkM4P1',
                'badge' => '',
                'image' => '🛏️',
                'is_active' => 1, 'created_at' => $now, 'updated_at' => $now
            ],
            [
                'name' => 'Bantal Hamil Multi-Fungsi (Model 5)',
                'subtext' => 'Bisa dipakai lanjut untuk menyusui',
                'category' => 'ibu-hamil',
                'shopee_link' => 'https://id.shp.ee/k6K25svL',
                'badge' => '',
                'image' => '🛏️',
                'is_active' => 1, 'created_at' => $now, 'updated_at' => $now
            ],
            [
                'name' => 'Suplemen & Vitamin Bumil (Opsi 1)',
                'subtext' => 'Kaya Asam Folat & Kalsium harian',
                'category' => 'ibu-hamil',
                'shopee_link' => 'https://id.shp.ee/FRm1DWDd',
                'badge' => '💊 Suplemen Hamil',
                'image' => '💊',
                'is_active' => 1, 'created_at' => $now, 'updated_at' => $now
            ],
            [
                'name' => 'Suplemen Nutrisi Kehamilan (Opsi 2)',
                'subtext' => 'DHA & Zat Besi untuk janin sehat',
                'category' => 'ibu-hamil',
                'shopee_link' => 'https://id.shp.ee/5z7ufnjh',
                'badge' => '',
                'image' => '💊',
                'is_active' => 1, 'created_at' => $now, 'updated_at' => $now
            ],
            [
                'name' => 'Vitamin Kalsium & Tulang Bumil (Opsi 3)',
                'subtext' => 'Cegah kram kaki saat hamil',
                'category' => 'ibu-hamil',
                'shopee_link' => 'https://id.shp.ee/968qHYfG',
                'badge' => '',
                'image' => '💊',
                'is_active' => 1, 'created_at' => $now, 'updated_at' => $now
            ],
            [
                'name' => 'Korset Penyangga Perut Hamil (Model 1)',
                'subtext' => 'Ringankan beban pinggang & panggul',
                'category' => 'ibu-hamil',
                'shopee_link' => 'https://id.shp.ee/LzMec8bh',
                'badge' => '🩱 Penyangga Perut',
                'image' => '🩱',
                'is_active' => 1, 'created_at' => $now, 'updated_at' => $now
            ],
            [
                'name' => 'Korset Hamil Breathable (Model 2)',
                'subtext' => 'Bahan adem tidak bikin gerah',
                'category' => 'ibu-hamil',
                'shopee_link' => 'https://id.shp.ee/XYxVwmye',
                'badge' => '',
                'image' => '🩱',
                'is_active' => 1, 'created_at' => $now, 'updated_at' => $now
            ],
            [
                'name' => 'Korset Hamil Adjustable (Model 3)',
                'subtext' => 'Perekat velcro mudah disesuaikan',
                'category' => 'ibu-hamil',
                'shopee_link' => 'https://id.shp.ee/829UXCwq',
                'badge' => '',
                'image' => '🩱',
                'is_active' => 1, 'created_at' => $now, 'updated_at' => $now
            ],
            [
                'name' => 'Pompa ASI Electric Handsfree (Model 1)',
                'subtext' => 'Praktis dipasang di dalam bra tanpa kabel',
                'category' => 'ibu-hamil',
                'shopee_link' => 'https://id.shp.ee/NAP1YaVg',
                'badge' => '⭐ Handsfree Electric',
                'image' => '🍼',
                'is_active' => 1, 'created_at' => $now, 'updated_at' => $now
            ],
            [
                'name' => 'Pompa ASI Dual Pump Powerful (Model 2)',
                'subtext' => 'Pumping cepat & pijatan lembut 9 tingkat',
                'category' => 'ibu-hamil',
                'shopee_link' => 'https://id.shp.ee/qmuZTJkm',
                'badge' => '',
                'image' => '🍼',
                'is_active' => 1, 'created_at' => $now, 'updated_at' => $now
            ],
            [
                'name' => 'Pompa ASI Portable Rechargeable (Model 3)',
                'subtext' => 'Baterai tahan lama hemat listrik',
                'category' => 'ibu-hamil',
                'shopee_link' => 'https://id.shp.ee/gRi76xax',
                'badge' => '',
                'image' => '🍼',
                'is_active' => 1, 'created_at' => $now, 'updated_at' => $now
            ],
            [
                'name' => 'Bantal Menyusui Ergonomis (Model 1)',
                'subtext' => 'Penopang bayi pas agar ibu tidak pegal',
                'category' => 'ibu-hamil',
                'shopee_link' => 'https://id.shp.ee/ntw21E45',
                'badge' => '🛋️ Nursing Pillow',
                'image' => '🛋️',
                'is_active' => 1, 'created_at' => $now, 'updated_at' => $now
            ],
            [
                'name' => 'Bantal Menyusui Multi-Position (Model 2)',
                'subtext' => 'Mudah disesuaikan posisi menyusui',
                'category' => 'ibu-hamil',
                'shopee_link' => 'https://id.shp.ee/d2Prom6',
                'badge' => '',
                'image' => '🛋️',
                'is_active' => 1, 'created_at' => $now, 'updated_at' => $now
            ],
            [
                'name' => 'Kantong ASI Steril 100ml / 200ml (Pilihan 1)',
                'subtext' => 'Bebas BPA & anti bocor double zipper',
                'category' => 'ibu-hamil',
                'shopee_link' => 'https://id.shp.ee/4Vf8s2t',
                'badge' => '🛍️ Storage Bag',
                'image' => '🛍️',
                'is_active' => 1, 'created_at' => $now, 'updated_at' => $now
            ],
            [
                'name' => 'Kantong ASI Thermal Sensor (Pilihan 2)',
                'subtext' => 'Ada indikator suhu panas/dingin',
                'category' => 'ibu-hamil',
                'shopee_link' => 'https://id.shp.ee/Zq7C7P6',
                'badge' => '',
                'image' => '🛍️',
                'is_active' => 1, 'created_at' => $now, 'updated_at' => $now
            ],
            [
                'name' => 'Pelancar / Booster ASI Herbal (Model 1)',
                'subtext' => 'Formula alami tingkatkan produksi ASI',
                'category' => 'ibu-hamil',
                'shopee_link' => 'https://id.shp.ee/q37B4oM',
                'badge' => '🌿 ASI Booster',
                'image' => '🌿',
                'is_active' => 1, 'created_at' => $now, 'updated_at' => $now
            ],
            [
                'name' => 'Pelancar ASI Teh Herbal (Model 2)',
                'subtext' => 'Enak diminum hangat setiap hari',
                'category' => 'ibu-hamil',
                'shopee_link' => 'https://id.shp.ee/1YxW4sP',
                'badge' => '',
                'image' => '🌿',
                'is_active' => 1, 'created_at' => $now, 'updated_at' => $now
            ],
            [
                'name' => 'Apron / Kain Penutup Menyusui (Model 1)',
                'subtext' => 'Privasi terjaga saat menyusui di luar',
                'category' => 'ibu-hamil',
                'shopee_link' => 'https://id.shp.ee/5bN8PqR',
                'badge' => '🧣 Apron Menyusui',
                'image' => '🧣',
                'is_active' => 1, 'created_at' => $now, 'updated_at' => $now
            ],
            [
                'name' => 'Apron Menyusui Breathable (Model 2)',
                'subtext' => 'Bahan kawat melengkung agar tetap lihat bayi',
                'category' => 'ibu-hamil',
                'shopee_link' => 'https://id.shp.ee/yT9mZ2K',
                'badge' => '',
                'image' => '🧣',
                'is_active' => 1, 'created_at' => $now, 'updated_at' => $now
            ],

            // Newborn (0-6 Bln)
            [
                'name' => 'Stroller Kabin Size Portable (Model 1)',
                'subtext' => 'Ringan & melipat otomatis dengan satu tangan',
                'category' => 'newborn',
                'shopee_link' => 'https://id.shp.ee/2h77W7r',
                'badge' => '👶 Cabin Stroller',
                'image' => '👶',
                'is_active' => 1, 'created_at' => $now, 'updated_at' => $now
            ],
            [
                'name' => 'Stroller Reversible 2 Arah (Model 2)',
                'subtext' => 'Posisikan bayi menghadap ke ibu',
                'category' => 'newborn',
                'shopee_link' => 'https://id.shp.ee/8Wn4w2P',
                'badge' => '',
                'image' => '👶',
                'is_active' => 1, 'created_at' => $now, 'updated_at' => $now
            ],
            [
                'name' => 'Stroller Compact Travel (Model 3)',
                'subtext' => 'Pas dibawa di bagasi pesawat & kabin',
                'category' => 'newborn',
                'shopee_link' => 'https://id.shp.ee/xP9b2m1',
                'badge' => '',
                'image' => '👶',
                'is_active' => 1, 'created_at' => $now, 'updated_at' => $now
            ],
            [
                'name' => 'Gendongan Bayi M-Shape Ergonomis (Model 1)',
                'subtext' => 'Aman untuk panggul & tulang belakang bayi',
                'category' => 'newborn',
                'shopee_link' => 'https://id.shp.ee/zN5c3vX',
                'badge' => '🧸 Gendongan M-Shape',
                'image' => '🧸',
                'is_active' => 1, 'created_at' => $now, 'updated_at' => $now
            ],
            [
                'name' => 'Gendongan Geos Kaos Practical (Model 2)',
                'subtext' => 'Langsung pakai tanpa lilitan ribet',
                'category' => 'newborn',
                'shopee_link' => 'https://id.shp.ee/yK4m5nB',
                'badge' => '',
                'image' => '🧸',
                'is_active' => 1, 'created_at' => $now, 'updated_at' => $now
            ],
            [
                'name' => 'Gendongan Hipseat Convertible (Model 3)',
                'subtext' => 'Penopang tempat duduk kokoh',
                'category' => 'newborn',
                'shopee_link' => 'https://id.shp.ee/vR6p7m9',
                'badge' => '',
                'image' => '🧸',
                'is_active' => 1, 'created_at' => $now, 'updated_at' => $now
            ],
            [
                'name' => 'Car Seat Bayi Newborn (Model 1)',
                'subtext' => 'Perlindungan benturan samping ISOFIX',
                'category' => 'newborn',
                'shopee_link' => 'https://id.shp.ee/qP3n8mW',
                'badge' => '🚗 Safety Carseat',
                'image' => '🚗',
                'is_active' => 1, 'created_at' => $now, 'updated_at' => $now
            ],
            [
                'name' => 'Bedding Set & Kasur Kelambu (Model 1)',
                'subtext' => 'Lindungi bayi dari gigitan nyamuk',
                'category' => 'newborn',
                'shopee_link' => 'https://id.shp.ee/xM2n9pL',
                'badge' => '🛏️ Kasur Kelambu',
                'image' => '🛏️',
                'is_active' => 1, 'created_at' => $now, 'updated_at' => $now
            ],
            [
                'name' => 'Bedding Nest Ergonomis (Model 2)',
                'subtext' => 'Cegah bayi berguling saat tidur',
                'category' => 'newborn',
                'shopee_link' => 'https://id.shp.ee/vT5p8mK',
                'badge' => '',
                'image' => '🛏️',
                'is_active' => 1, 'created_at' => $now, 'updated_at' => $now
            ],
            [
                'name' => 'Baju Bayi Newborn Jumper Set (Model 1)',
                'subtext' => 'Katun SNI halus & bebas kimia berbahaya',
                'category' => 'newborn',
                'shopee_link' => 'https://id.shp.ee/mW8n2pK',
                'badge' => '👕 Set Baju Bayi',
                'image' => '👕',
                'is_active' => 1, 'created_at' => $now, 'updated_at' => $now
            ],
            [
                'name' => 'Baju Bayi Sleeper Overall (Model 2)',
                'subtext' => 'Resleting praktis ganti popok malam hari',
                'category' => 'newborn',
                'shopee_link' => 'https://id.shp.ee/pK9m3nR',
                'badge' => '',
                'image' => '👕',
                'is_active' => 1, 'created_at' => $now, 'updated_at' => $now
            ],
            [
                'name' => 'Bedong Instant Resleting (Model 1)',
                'subtext' => 'Bedong hangat tanpa ikatan ketat',
                'category' => 'newborn',
                'shopee_link' => 'https://id.shp.ee/nQ4m8pS',
                'badge' => '🍼 Bedong Instant',
                'image' => '🍼',
                'is_active' => 1, 'created_at' => $now, 'updated_at' => $now
            ],
            [
                'name' => 'Bedong Kain Katun Swaddle (Model 2)',
                'subtext' => 'Kain bedong breathable serbaguna',
                'category' => 'newborn',
                'shopee_link' => 'https://id.shp.ee/pR7n9mQ',
                'badge' => '',
                'image' => '🍼',
                'is_active' => 1, 'created_at' => $now, 'updated_at' => $now
            ],
            [
                'name' => 'Topi & Sarung Tangan Kaki (Model 1)',
                'subtext' => 'Cegah bayi menggaruk wajah',
                'category' => 'newborn',
                'shopee_link' => 'https://id.shp.ee/qS2m5pK',
                'badge' => '',
                'image' => '🧤',
                'is_active' => 1, 'created_at' => $now, 'updated_at' => $now
            ],
            [
                'name' => 'Sabun & Sampo 2in1 Gentle Bayi (Opsi 1)',
                'subtext' => 'Formula hypoallergenic tidak pedih di mata',
                'category' => 'newborn',
                'shopee_link' => 'https://id.shp.ee/mT4p8nL',
                'badge' => '🧼 Skincare Newborn',
                'image' => '🧼',
                'is_active' => 1, 'created_at' => $now, 'updated_at' => $now
            ],
            [
                'name' => 'Baby Oil / Minyak Telon Soft (Opsi 2)',
                'subtext' => 'Menghangatkan perut & cegah kembung',
                'category' => 'newborn',
                'shopee_link' => 'https://id.shp.ee/nU5m9pK',
                'badge' => '',
                'image' => '🧴',
                'is_active' => 1, 'created_at' => $now, 'updated_at' => $now
            ],
            [
                'name' => 'Diaper Cream Cegah Ruam Popok (Opsi 3)',
                'subtext' => 'Merawat kulit sensitif lipatan paha',
                'category' => 'newborn',
                'shopee_link' => 'https://id.shp.ee/pV6n2mR',
                'badge' => '',
                'image' => '🧴',
                'is_active' => 1, 'created_at' => $now, 'updated_at' => $now
            ],
            [
                'name' => 'Tisu Basah Pure Water Non-Alkohol (Opsi 4)',
                'subtext' => 'Formulasi air murni aman untuk mulut & tangan',
                'category' => 'newborn',
                'shopee_link' => 'https://id.shp.ee/qW7m3pS',
                'badge' => '',
                'image' => '🧻',
                'is_active' => 1, 'created_at' => $now, 'updated_at' => $now
            ],

            // Fase MPASI
            [
                'name' => 'Slow Cooker MPASI Ceramic (Model 1)',
                'subtext' => 'Masak bubur otomatis matang merata & bernutrisi',
                'category' => 'mpasi',
                'shopee_link' => 'https://id.shp.ee/rX8n4pT',
                'badge' => '🍲 Slow Cooker',
                'image' => '🍲',
                'is_active' => 1, 'created_at' => $now, 'updated_at' => $now
            ],
            [
                'name' => 'Baby Food Processor 4in1 (Model 2)',
                'subtext' => 'Kukus, blender, melembutkan, & defrost sekali tekan',
                'category' => 'mpasi',
                'shopee_link' => 'https://id.shp.ee/sY9m5pU',
                'badge' => '🍧 Food Processor',
                'image' => '🍧',
                'is_active' => 1, 'created_at' => $now, 'updated_at' => $now
            ],
            [
                'name' => 'Blender MPASI Mini Portable (Model 3)',
                'subtext' => 'Pisau tajam haluskan porsi kecil bayi',
                'category' => 'mpasi',
                'shopee_link' => 'https://id.shp.ee/tZ1n6pV',
                'badge' => '',
                'image' => '🍧',
                'is_active' => 1, 'created_at' => $now, 'updated_at' => $now
            ],
            [
                'name' => 'Piring & Mangkok Suction Silicon (Model 1)',
                'subtext' => 'Menempel kuat di meja tidak mudah tumpah',
                'category' => 'mpasi',
                'shopee_link' => 'https://id.shp.ee/uA2m7pW',
                'badge' => '🥣 Alat Makan Silicon',
                'image' => '🥣',
                'is_active' => 1, 'created_at' => $now, 'updated_at' => $now
            ],
            [
                'name' => 'Sendok Sensor Suhu MPASI (Model 2)',
                'subtext' => 'Berubah warna jika makanan terlalu panas',
                'category' => 'mpasi',
                'shopee_link' => 'https://id.shp.ee/vB3n8pX',
                'badge' => '',
                'image' => '🥄',
                'is_active' => 1, 'created_at' => $now, 'updated_at' => $now
            ],
            [
                'name' => 'Gelas Minum Spout Cup Training (Model 3)',
                'subtext' => 'Latih bayi minum sendiri anti bocor',
                'category' => 'mpasi',
                'shopee_link' => 'https://id.shp.ee/wC4m9pY',
                'badge' => '',
                'image' => '🥤',
                'is_active' => 1, 'created_at' => $now, 'updated_at' => $now
            ],
            [
                'name' => 'Slabber / Bib Silicone dengan Kantong (Model 1)',
                'subtext' => 'Menampung remahan makanan anti kotor',
                'category' => 'mpasi',
                'shopee_link' => 'https://id.shp.ee/xD5n0pZ',
                'badge' => '🦺 Slabber Silikon',
                'image' => '🦺',
                'is_active' => 1, 'created_at' => $now, 'updated_at' => $now
            ],
            [
                'name' => 'Kursi Makan High Chair Adjustable (Model 1)',
                'subtext' => 'Latih disiplin duduk saat makan',
                'category' => 'mpasi',
                'shopee_link' => 'https://id.shp.ee/yE6m1pA',
                'badge' => '🪑 High Chair',
                'image' => '🪑',
                'is_active' => 1, 'created_at' => $now, 'updated_at' => $now
            ],
            [
                'name' => 'Booster Seat Portable Foldable (Model 2)',
                'subtext' => 'Ringkas dibawa bepergian / kulineran',
                'category' => 'mpasi',
                'shopee_link' => 'https://id.shp.ee/zF7n2pB',
                'badge' => '',
                'image' => '🪑',
                'is_active' => 1, 'created_at' => $now, 'updated_at' => $now
            ],

            // Balita & Montessori
            [
                'name' => 'Flashcard Edukasi & Kosakata (Model 1)',
                'subtext' => 'Gambar menarik melatih kemampuan motorik & bicara',
                'category' => 'balita',
                'shopee_link' => 'https://id.shp.ee/aG8m3pC',
                'badge' => '🧠 Flashcard Edukasi',
                'image' => '🧠',
                'is_active' => 1, 'created_at' => $now, 'updated_at' => $now
            ],
            [
                'name' => 'Mainan Kayu Puzzle Balok Shape (Model 2)',
                'subtext' => 'Latih logika, pengenalan warna & koordinasi',
                'category' => 'balita',
                'shopee_link' => 'https://id.shp.ee/bH9n4pD',
                'badge' => '🧩 Mainan Montessori',
                'image' => '🧩',
                'is_active' => 1, 'created_at' => $now, 'updated_at' => $now
            ],
            [
                'name' => 'Sensory Toys Busy Board Silicone (Model 3)',
                'subtext' => 'Latih kemandirian & jemari anak',
                'category' => 'balita',
                'shopee_link' => 'https://id.shp.ee/cI0m5pE',
                'badge' => '',
                'image' => '🧩',
                'is_active' => 1, 'created_at' => $now, 'updated_at' => $now
            ],
            [
                'name' => 'Buku Kain Soft Book Touch & Feel (Model 4)',
                'subtext' => 'Aman digigit & tidak ripas saat dicuci',
                'category' => 'balita',
                'shopee_link' => 'https://id.shp.ee/dJ1n6pF',
                'badge' => '📚 Buku Kain',
                'image' => '📚',
                'is_active' => 1, 'created_at' => $now, 'updated_at' => $now
            ],
            [
                'name' => 'Sepatu Prewalker Sol Lembut (Model 1)',
                'subtext' => 'Sol fleksibel mendukung langkah pertama bayi',
                'category' => 'balita',
                'shopee_link' => 'https://id.shp.ee/eK2m7pG',
                'badge' => '👟 Sepatu Prewalker',
                'image' => '👟',
                'is_active' => 1, 'created_at' => $now, 'updated_at' => $now
            ],
            [
                'name' => 'Sepatu Anak Anti-Slip Cushion (Model 2)',
                'subtext' => 'Ringan & aman dipakai berlari',
                'category' => 'balita',
                'shopee_link' => 'https://id.shp.ee/fL3n8pH',
                'badge' => '',
                'image' => '👟',
                'is_active' => 1, 'created_at' => $now, 'updated_at' => $now
            ],

            // Keamanan & Rumah
            [
                'name' => 'Baby Monitor Wireless Night Vision (Model 1)',
                'subtext' => 'Pantau tidur bayi real-time via layar / HP',
                'category' => 'keamanan',
                'shopee_link' => 'https://id.shp.ee/gM4m9pI',
                'badge' => '📹 Baby Monitor',
                'image' => '📹',
                'is_active' => 1, 'created_at' => $now, 'updated_at' => $now
            ],
            [
                'name' => 'Pagar Pengaman Pintu & Tangga Safety Gate (Model 1)',
                'subtext' => 'Cegah anak masuk area berbahaya / tangga',
                'category' => 'keamanan',
                'shopee_link' => 'https://id.shp.ee/hN5n0pJ',
                'badge' => '🚪 Pagar Pengaman',
                'image' => '🚪',
                'is_active' => 1, 'created_at' => $now, 'updated_at' => $now
            ],
            [
                'name' => 'Pelindung Sudut Meja / Corner Guard (Model 1)',
                'subtext' => 'Bahan busa silikon empuk cegah benturan',
                'category' => 'keamanan',
                'shopee_link' => 'https://id.shp.ee/iO6m1pK',
                'badge' => '🛡️ Corner Guard',
                'image' => '🛡️',
                'is_active' => 1, 'created_at' => $now, 'updated_at' => $now
            ],
            [
                'name' => 'Pengunci Laci & Lemari Safe Lock (Model 2)',
                'subtext' => 'Cegah anak membuka laci berisi obatan / pisau',
                'category' => 'keamanan',
                'shopee_link' => 'https://id.shp.ee/jP7n2pL',
                'badge' => '',
                'image' => '🔒',
                'is_active' => 1, 'created_at' => $now, 'updated_at' => $now
            ],
        ];

        $db->table('shop_products')->insertBatch($initialData);
    }
}
