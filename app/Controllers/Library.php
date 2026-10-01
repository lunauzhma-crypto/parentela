<?php

namespace App\Controllers;

use App\Models\BookModel;
use App\Models\UserLibraryModel;
use App\Models\StorytellingModel;

class Library extends BaseController
{
    protected $bookModel;
    protected $userLibraryModel;
    protected $storytellingModel;

    public function __construct()
    {
        $this->bookModel = new BookModel();
        $this->userLibraryModel = new UserLibraryModel();
        $this->storytellingModel = new StorytellingModel();
    }

    public function index()
    {
        try {
            $bestSeller = $this->bookModel->getBestSeller(8);
            $newArrivals = $this->bookModel->getNewArrivals(8);
            $popularBooks = $this->bookModel->orderBy('total_ratings', 'DESC')->findAll(8);
            $featuredStories = $this->storytellingModel->findAll(6);
            $totalBooksCount = $this->bookModel->countAllResults();
        } catch (\Throwable $e) {
            log_message('error', 'Library index DB error: ' . $e->getMessage());
            $bestSeller = $this->getFallbackBooks('best_seller');
            $newArrivals = $this->getFallbackBooks('new_arrivals');
            $popularBooks = $this->getFallbackBooks('popular');
            $featuredStories = $this->getFallbackStories();
            $totalBooksCount = 16;
        }

        if (empty($bestSeller)) {
            $bestSeller = $this->getFallbackBooks('best_seller');
        }
        if (empty($newArrivals)) {
            $newArrivals = $this->getFallbackBooks('new_arrivals');
        }
        if (empty($featuredStories)) {
            $featuredStories = $this->getFallbackStories();
        }

        // Perpustakaan khusus anak - Kategori khusus anak (tanpa parenting)
        $categories = [
            [
                'name' => 'Cerita Anak & Fantasi',
                'slug' => 'Cerita Anak',
                'icon' => '📚',
                'desc' => 'Kisah imajinatif, petualangan klasik, & persahabatan',
                'count' => '45+ Seri'
            ],
            [
                'name' => 'Dongeng & Fabel',
                'slug' => 'Dongeng',
                'icon' => '🦊',
                'desc' => 'Cerita hewan bijak & budi pekerti lintas generasi',
                'count' => '35+ Cerita'
            ],
            [
                'name' => 'Buku Bergambar (Picture Books)',
                'slug' => 'Buku Bergambar',
                'icon' => '🎨',
                'desc' => 'Ilustrasi cat air cerah dan teks berima untuk balita',
                'count' => '40+ Buku'
            ],
            [
                'name' => 'Karakter & Tumbuh Kembang',
                'slug' => 'Tumbuh Kembang',
                'icon' => '🌱',
                'desc' => 'Melatih empati, kejujuran, kasih sayang, & emosi positif',
                'count' => '30+ Buku'
            ],
            [
                'name' => 'Edukasi & Sains Cilik',
                'slug' => 'Edukasi',
                'icon' => '🔬',
                'desc' => 'Eksplorasi alam semesta, flora, fauna, & logika',
                'count' => '28+ Seri'
            ],
            [
                'name' => 'Aktivitas & Kreativitas',
                'slug' => 'Aktivitas Anak',
                'icon' => '🧩',
                'desc' => 'Permainan teka-teki, mewarnai, & tantangan motorik',
                'count' => '25+ Buku'
            ],
        ];

        $data = [
            'title' => 'Perpustakaan Digital Ramah Anak - Parentela',
            'best_seller' => $bestSeller,
            'new_arrivals' => $newArrivals,
            'popular_books' => $popularBooks,
            'featured_stories' => $featuredStories,
            'categories' => $categories,
            'total_books_count' => $totalBooksCount > 0 ? $totalBooksCount : 16,
        ];
        return view('library/index', $data);
    }

    public function catalog()
    {
        $filters = [
            'q' => trim((string)$this->request->getGet('q')),
            'age' => $this->request->getGet('age'),
            'reading_level' => $this->request->getGet('reading_level'),
            'category' => $this->request->getGet('category'),
            'language' => $this->request->getGet('language'),
            'format' => $this->request->getGet('format'),
            'sort' => $this->request->getGet('sort'),
        ];
        $filters = array_filter($filters, fn($val) => $val !== null && $val !== '');

        try {
            $books = $this->bookModel->getByFilter($filters);
        } catch (\Throwable $e) {
            log_message('error', 'Library catalog DB error: ' . $e->getMessage());
            $books = $this->getFallbackBooks('all', $filters);
        }

        if (empty($books)) {
            $books = $this->getFallbackBooks('all', $filters);
        }

        $data = [
            'title' => 'Katalog Buku Anak - Perpustakaan Parentela',
            'books' => $books,
            'filters' => $filters,
        ];
        return view('library/catalog', $data);
    }

    public function detail($id)
    {
        try {
            $book = $this->bookModel->find($id);
        } catch (\Throwable $e) {
            log_message('error', 'Library detail DB error: ' . $e->getMessage());
            $book = null;
        }

        if (!$book) {
            // Check fallback by ID
            $fallbacks = $this->getFallbackBooks('all');
            foreach ($fallbacks as $fb) {
                if ((int)$fb['id'] === (int)$id) {
                    $book = $fb;
                    break;
                }
            }
        }

        if (!$book) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Buku tidak ditemukan');
        }

        // Fetch related books
        try {
            $relatedBooks = $this->bookModel
                ->where('category', $book['category'] ?? '')
                ->where('id !=', $book['id'])
                ->findAll(4);
        } catch (\Throwable $e) {
            $allFb = $this->getFallbackBooks('all');
            $relatedBooks = array_filter($allFb, function($b) use ($book) {
                return (int)$b['id'] !== (int)$book['id'];
            });
            $relatedBooks = array_slice($relatedBooks, 0, 4);
        }

        if (empty($relatedBooks)) {
            $allFb = $this->getFallbackBooks('all');
            $relatedBooks = array_filter($allFb, function($b) use ($book) {
                return (int)$b['id'] !== (int)$book['id'];
            });
            $relatedBooks = array_slice($relatedBooks, 0, 4);
        }

        $data = [
            'title' => $book['title'] . ' - Perpustakaan Parentela',
            'book' => $book,
            'related_books' => $relatedBooks,
        ];
        return view('library/detail', $data);
    }

    /**
     * Fallback collection of 16 classic published children's books
     */
    protected function getFallbackBooks($type = 'all', $filters = [])
    {
        $books = [
            [
                'id' => 1,
                'title' => 'The Little Prince (Le Petit Prince)',
                'author' => 'Antoine de Saint-Exupéry',
                'illustrator' => 'Antoine de Saint-Exupéry',
                'publisher' => 'Reynal & Hitchcock',
                'year' => 1943,
                'language' => 'Bahasa Indonesia & Multilingual',
                'age_min' => 6,
                'age_max' => 12,
                'reading_level' => 'Intermediate',
                'category' => 'Cerita Anak',
                'genre' => 'Klasik & Fantasi',
                'synopsis' => 'Kisah puitis seorang pangeran cilik yang menjelajahi berbagai planet dan belajar tentang arti persahabatan sejati, cinta, dan melihat dunia dengan mata hati.',
                'pages' => 96,
                'cover' => 'the-little-prince.jpg',
                'format' => 'E-book & Audio',
                'is_illustrated' => 1,
                'rating' => 4.98,
                'total_ratings' => 340,
                'is_best_seller' => 1,
                'is_new_arrival' => 0,
            ],
            [
                'id' => 2,
                'title' => 'The Secret Garden',
                'author' => 'Frances Hodgson Burnett',
                'illustrator' => 'Charles Robinson',
                'publisher' => 'Frederick A. Stokes',
                'year' => 1911,
                'language' => 'Bahasa Indonesia & Multilingual',
                'age_min' => 8,
                'age_max' => 12,
                'reading_level' => 'Advanced',
                'category' => 'Cerita Anak',
                'genre' => 'Petualangan & Misteri',
                'synopsis' => 'Kisah Mary Lennox yang menemukan sebuah taman rahasia terlupakan di mansion pamannya, tempat keajaiban persahabatan dan alam menyembuhkan luka batinnya.',
                'pages' => 268,
                'cover' => 'the-secret-garden.jpg',
                'format' => 'E-book & Audio',
                'is_illustrated' => 1,
                'rating' => 4.95,
                'total_ratings' => 285,
                'is_best_seller' => 1,
                'is_new_arrival' => 1,
            ],
            [
                'id' => 3,
                'title' => 'Peter and Wendy (Peter Pan)',
                'author' => 'J.M. Barrie',
                'illustrator' => 'F.D. Bedford',
                'publisher' => 'Hodder & Stoughton',
                'year' => 1911,
                'language' => 'Bahasa Indonesia & Multilingual',
                'age_min' => 7,
                'age_max' => 12,
                'reading_level' => 'Intermediate',
                'category' => 'Cerita Anak',
                'genre' => 'Petualangan & Fantasi',
                'synopsis' => 'Ikuti petualangan ajaib Wendy, John, dan Michael bersama Peter Pan ke Neverland menghadapi Kapten Hook, peri Tinker Bell, dan suku pulau yang penuh keajaiban.',
                'pages' => 212,
                'cover' => 'peter-and-wendy.jpg',
                'format' => 'Audiobook',
                'is_illustrated' => 1,
                'rating' => 4.92,
                'total_ratings' => 310,
                'is_best_seller' => 1,
                'is_new_arrival' => 0,
            ],
            [
                'id' => 4,
                'title' => 'Winnie-the-Pooh',
                'author' => 'A.A. Milne',
                'illustrator' => 'E.H. Shepard',
                'publisher' => 'Methuen & Co.',
                'year' => 1926,
                'language' => 'Bahasa Indonesia & Multilingual',
                'age_min' => 3,
                'age_max' => 7,
                'reading_level' => 'Beginner',
                'category' => 'Dongeng',
                'genre' => 'Fabel & Humor',
                'synopsis' => 'Kelucuan beruang pecinta madu Winnie-the-Pooh bersama kawan-kawannya Piglet, Eeyore, Rabbit, dan Christopher Robin di Hutan Seratus Ekar yang penuh keceriaan.',
                'pages' => 160,
                'cover' => 'winnie-the-pooh.jpg',
                'format' => 'E-book & Audio',
                'is_illustrated' => 1,
                'rating' => 4.96,
                'total_ratings' => 420,
                'is_best_seller' => 1,
                'is_new_arrival' => 0,
            ],
            [
                'id' => 5,
                'title' => 'The Tale of Peter Rabbit',
                'author' => 'Beatrix Potter',
                'illustrator' => 'Beatrix Potter',
                'publisher' => 'Frederick Warne & Co.',
                'year' => 1902,
                'language' => 'Bahasa Indonesia & Multilingual',
                'age_min' => 2,
                'age_max' => 6,
                'reading_level' => 'Beginner',
                'category' => 'Buku Bergambar',
                'genre' => 'Fabel & Cerita Hewan',
                'synopsis' => 'Kisah kelinci nakal berbaju biru bernama Peter yang menyelinap ke kebun sayur Pak McGregor, sarat dengan ilustrasi cat air klasik yang sangat memikat anak balita.',
                'pages' => 56,
                'cover' => 'peter-rabbit.jpg',
                'format' => 'E-book & Audio',
                'is_illustrated' => 1,
                'rating' => 4.94,
                'total_ratings' => 380,
                'is_best_seller' => 1,
                'is_new_arrival' => 1,
            ],
            [
                'id' => 6,
                'title' => 'The Velveteen Rabbit',
                'author' => 'Margery Williams',
                'illustrator' => 'William Nicholson',
                'publisher' => 'Heinemann',
                'year' => 1922,
                'language' => 'Bahasa Indonesia & Multilingual',
                'age_min' => 3,
                'age_max' => 8,
                'reading_level' => 'Beginner',
                'category' => 'Tumbuh Kembang',
                'genre' => 'Karakter & Empati',
                'synopsis' => 'Dongeng abadi tentang boneka kelinci beludru yang bermimpi menjadi nyata berkat cinta tulus seorang anak, mengajarkan arti ketulusan, kesetiaan, dan kasih sayang.',
                'pages' => 40,
                'cover' => 'the-velveteen-rabbit.jpg',
                'format' => 'Audiobook',
                'is_illustrated' => 1,
                'rating' => 4.93,
                'total_ratings' => 230,
                'is_best_seller' => 1,
                'is_new_arrival' => 0,
            ],
            [
                'id' => 7,
                'title' => 'Charlotte\'s Web',
                'author' => 'E.B. White',
                'illustrator' => 'Garth Williams',
                'publisher' => 'Harper & Brothers',
                'year' => 1952,
                'language' => 'Bahasa Indonesia & Multilingual',
                'age_min' => 6,
                'age_max' => 11,
                'reading_level' => 'Intermediate',
                'category' => 'Cerita Anak',
                'genre' => 'Persahabatan & Karakter',
                'synopsis' => 'Persahabatan mengharukan antara Wilbur si babi kecil dan Charlotte si laba-laba bijaksana yang menenun pesan-pesan penyelamat di jaringnya.',
                'pages' => 192,
                'cover' => 'charlottes-web.jpg',
                'format' => 'E-book',
                'is_illustrated' => 1,
                'rating' => 4.97,
                'total_ratings' => 490,
                'is_best_seller' => 1,
                'is_new_arrival' => 1,
            ],
            [
                'id' => 8,
                'title' => 'The Giving Tree',
                'author' => 'Shel Silverstein',
                'illustrator' => 'Shel Silverstein',
                'publisher' => 'Harper & Row',
                'year' => 1964,
                'language' => 'Bahasa Indonesia & Multilingual',
                'age_min' => 4,
                'age_max' => 10,
                'reading_level' => 'Beginner',
                'category' => 'Tumbuh Kembang',
                'genre' => 'Nilai Moral & Karakter',
                'synopsis' => 'Cerita menyentuh tentang pohon yang dengan tulus memberikan segalanya untuk seorang anak laki-laki sepanjang tahapan hidupnya, mengajarkan rasa syukur dan empati.',
                'pages' => 64,
                'cover' => 'the-giving-tree.jpg',
                'format' => 'E-book',
                'is_illustrated' => 1,
                'rating' => 4.91,
                'total_ratings' => 360,
                'is_best_seller' => 1,
                'is_new_arrival' => 0,
            ],
            [
                'id' => 9,
                'title' => 'Alice\'s Adventures in Wonderland',
                'author' => 'Lewis Carroll',
                'illustrator' => 'John Tenniel',
                'publisher' => 'Macmillan',
                'year' => 1865,
                'language' => 'Bahasa Indonesia & Multilingual',
                'age_min' => 7,
                'age_max' => 12,
                'reading_level' => 'Intermediate',
                'category' => 'Cerita Anak',
                'genre' => 'Fantasi & Petualangan',
                'synopsis' => 'Ikuti petualangan Alice yang jatuh ke liang kelinci dan memasuki dunia magis Wonderland bersama Kelinci Putih, Mad Hatter, dan Cheshire Cat.',
                'pages' => 200,
                'cover' => 'alice-in-wonderland.jpg',
                'format' => 'Audiobook',
                'is_illustrated' => 1,
                'rating' => 4.89,
                'total_ratings' => 295,
                'is_best_seller' => 0,
                'is_new_arrival' => 1,
            ],
            [
                'id' => 10,
                'title' => 'The Jungle Book',
                'author' => 'Rudyard Kipling',
                'illustrator' => 'John Lockwood Kipling',
                'publisher' => 'Macmillan & Co.',
                'year' => 1894,
                'language' => 'Bahasa Indonesia & Multilingual',
                'age_min' => 8,
                'age_max' => 12,
                'reading_level' => 'Intermediate',
                'category' => 'Cerita Anak',
                'genre' => 'Fabel & Petualangan',
                'synopsis' => 'Kisah Mowgli, anak manusia yang dibesarkan oleh kawanan serigala di rimba India, didampingi Baloo si beruang dan Bagheera si macan kumbang melawan Shere Khan.',
                'pages' => 224,
                'cover' => 'the-jungle-book.jpg',
                'format' => 'E-book & Audio',
                'is_illustrated' => 1,
                'rating' => 4.90,
                'total_ratings' => 270,
                'is_best_seller' => 0,
                'is_new_arrival' => 1,
            ],
            [
                'id' => 11,
                'title' => 'The Wind in the Willows',
                'author' => 'Kenneth Grahame',
                'illustrator' => 'E.H. Shepard',
                'publisher' => 'Methuen',
                'year' => 1908,
                'language' => 'Bahasa Indonesia & Multilingual',
                'age_min' => 7,
                'age_max' => 12,
                'reading_level' => 'Intermediate',
                'category' => 'Dongeng',
                'genre' => 'Fabel & Petualangan',
                'synopsis' => 'Persahabatan tepi sungai antara Mole, Ratty, Badger, dan Toad of Toad Hall yang jenaka dan suka petualangan mobil balap.',
                'pages' => 256,
                'cover' => 'the-wind-in-the-willows.jpg',
                'format' => 'E-book',
                'is_illustrated' => 1,
                'rating' => 4.88,
                'total_ratings' => 190,
                'is_best_seller' => 0,
                'is_new_arrival' => 1,
            ],
            [
                'id' => 12,
                'title' => 'The Adventures of Pinocchio',
                'author' => 'Carlo Collodi',
                'illustrator' => 'Enrico Mazzanti',
                'publisher' => 'Libreria Editrice Felice Paggi',
                'year' => 1883,
                'language' => 'Bahasa Indonesia & Multilingual',
                'age_min' => 6,
                'age_max' => 10,
                'reading_level' => 'Beginner',
                'category' => 'Dongeng',
                'genre' => 'Karakter & Budi Pekerti',
                'synopsis' => 'Kisah boneka kayu Pinocchio buatan Geppetto yang hidungnya memanjang saat berbohong, belajar menjadi anak yang jujur, berani, dan berbakti.',
                'pages' => 184,
                'cover' => 'pinocchio.jpg',
                'format' => 'E-book & Audio',
                'is_illustrated' => 1,
                'rating' => 4.87,
                'total_ratings' => 260,
                'is_best_seller' => 0,
                'is_new_arrival' => 1,
            ],
            [
                'id' => 13,
                'title' => 'Grimm\'s Fairy Tales (Kumpulan Dongeng Grimm)',
                'author' => 'Jacob & Wilhelm Grimm',
                'illustrator' => 'Arthur Rackham',
                'publisher' => 'Realschulbuchhandlung',
                'year' => 1812,
                'language' => 'Bahasa Indonesia & Multilingual',
                'age_min' => 5,
                'age_max' => 10,
                'reading_level' => 'Beginner',
                'category' => 'Dongeng',
                'genre' => 'Dongeng Klasik Dunia',
                'synopsis' => 'Kumpulan kisah dongeng klasik dunia terpopuler: Hansel & Gretel, Putri Salju, Rapunzel, dan Si Kerudung Merah yang memikat imajinasi anak lintas generasi.',
                'pages' => 310,
                'cover' => 'grimm-fairy-tales.jpg',
                'format' => 'E-book & Audio',
                'is_illustrated' => 1,
                'rating' => 4.93,
                'total_ratings' => 410,
                'is_best_seller' => 0,
                'is_new_arrival' => 1,
            ],
            [
                'id' => 14,
                'title' => 'Hans Christian Andersen\'s Fairy Tales',
                'author' => 'Hans Christian Andersen',
                'illustrator' => 'Kay Nielsen',
                'publisher' => 'C.A. Reitzel',
                'year' => 1837,
                'language' => 'Bahasa Indonesia & Multilingual',
                'age_min' => 5,
                'age_max' => 10,
                'reading_level' => 'Beginner',
                'category' => 'Dongeng',
                'genre' => 'Dongeng Klasik Dunia',
                'synopsis' => 'Kisah-kisah dongeng legendaris seperti Bebek Buruk Rupa, Gadis Penjual Korek Api, Thumbelina, dan Putri Duyung Kecil dengan pesan ketulusan hati.',
                'pages' => 280,
                'cover' => 'andersen-fairy-tales.jpg',
                'format' => 'E-book & Audio',
                'is_illustrated' => 1,
                'rating' => 4.92,
                'total_ratings' => 330,
                'is_best_seller' => 0,
                'is_new_arrival' => 0,
            ],
            [
                'id' => 15,
                'title' => 'Heidi',
                'author' => 'Johanna Spyri',
                'illustrator' => 'Jessie Willcox Smith',
                'publisher' => 'F.A. Perthes',
                'year' => 1881,
                'language' => 'Bahasa Indonesia & Multilingual',
                'age_min' => 7,
                'age_max' => 12,
                'reading_level' => 'Intermediate',
                'category' => 'Cerita Anak',
                'genre' => 'Alam & Persahabatan',
                'synopsis' => 'Keceriaan Heidi tinggal bersama kakeknya di Pegunungan Alpen Swiss, menyebarkan kegembiraan dan kehangatan bagi orang-orang di sekitarnya.',
                'pages' => 300,
                'cover' => 'heidi.jpg',
                'format' => 'E-book',
                'is_illustrated' => 1,
                'rating' => 4.91,
                'total_ratings' => 215,
                'is_best_seller' => 0,
                'is_new_arrival' => 0,
            ],
            [
                'id' => 16,
                'title' => 'How the Grinch Stole Christmas!',
                'author' => 'Dr. Seuss',
                'illustrator' => 'Dr. Seuss',
                'publisher' => 'Random House',
                'year' => 1957,
                'language' => 'Bahasa Indonesia & Multilingual',
                'age_min' => 3,
                'age_max' => 8,
                'reading_level' => 'Beginner',
                'category' => 'Buku Bergambar',
                'genre' => 'Fabel & Humor',
                'synopsis' => 'Kisah lucu berima khas Dr. Seuss tentang Grinch yang berhati dingin menyadari bahwa kebahagiaan sejati bukanlah tentang benda, melainkan kebersamaan dan cinta kasih.',
                'pages' => 64,
                'cover' => 'how-the-grinch-stole-christmas.jpg',
                'format' => 'E-book & Audio',
                'is_illustrated' => 1,
                'rating' => 4.94,
                'total_ratings' => 390,
                'is_best_seller' => 0,
                'is_new_arrival' => 1,
            ],
        ];

        // Filter by type if requested
        if ($type === 'best_seller') {
            return array_values(array_filter($books, fn($b) => !empty($b['is_best_seller'])));
        }
        if ($type === 'new_arrivals') {
            return array_values(array_filter($books, fn($b) => !empty($b['is_new_arrival'])));
        }
        if ($type === 'popular') {
            usort($books, fn($a, $b) => ($b['total_ratings'] ?? 0) <=> ($a['total_ratings'] ?? 0));
            return array_slice($books, 0, 8);
        }

        // Apply filters if passed
        if (!empty($filters)) {
            $filtered = $books;

            if (!empty($filters['q'])) {
                $q = strtolower($filters['q']);
                $filtered = array_filter($filtered, function($b) use ($q) {
                    return str_contains(strtolower($b['title']), $q) ||
                           str_contains(strtolower($b['author']), $q) ||
                           str_contains(strtolower($b['category']), $q) ||
                           str_contains(strtolower($b['synopsis']), $q);
                });
            }

            if (!empty($filters['age'])) {
                $age = (int)$filters['age'];
                $filtered = array_filter($filtered, function($b) use ($age) {
                    return $age >= (int)$b['age_min'] && $age <= (int)$b['age_max'];
                });
            }

            if (!empty($filters['category'])) {
                $cat = strtolower($filters['category']);
                $filtered = array_filter($filtered, function($b) use ($cat) {
                    return str_contains(strtolower($b['category']), $cat);
                });
            }

            if (!empty($filters['reading_level'])) {
                $lvl = strtolower($filters['reading_level']);
                $filtered = array_filter($filtered, function($b) use ($lvl) {
                    return strtolower($b['reading_level']) === $lvl;
                });
            }

            if (!empty($filters['format'])) {
                $fmt = strtolower($filters['format']);
                $filtered = array_filter($filtered, function($b) use ($fmt) {
                    return str_contains(strtolower($b['format']), $fmt);
                });
            }

            if (!empty($filters['sort'])) {
                if ($filters['sort'] === 'popular') {
                    usort($filtered, fn($a, $b) => ($b['total_ratings'] ?? 0) <=> ($a['total_ratings'] ?? 0));
                } elseif ($filters['sort'] === 'rating') {
                    usort($filtered, fn($a, $b) => ($b['rating'] ?? 0) <=> ($a['rating'] ?? 0));
                } elseif ($filters['sort'] === 'newest') {
                    usort($filtered, fn($a, $b) => ($b['is_new_arrival'] ?? 0) <=> ($a['is_new_arrival'] ?? 0));
                }
            }

            return array_values($filtered);
        }

        return $books;
    }

    /**
     * Fallback audiobooks referencing digitalbook.io open-access classic recordings
     */
    protected function getFallbackStories()
    {
        return [
            [
                'id' => 1,
                'title' => 'Peter Pan (Peter & Wendy) - Bab 1',
                'category' => 'Petualangan Klasik',
                'description' => 'Awal kisah Peter Pan terbang menembus jendela kamar anak-anak Darling menuju pulau ajaib Neverland.',
                'audio_url' => 'https://www.digitalbook.io/peter-pan-780',
                'reference_site' => 'digitalbook.io',
                'cover' => 'peter-and-wendy.jpg',
                'narrator' => 'Kara Shallenberg (DigitalBook.io / LibriVox)',
                'duration' => '12:40',
                'is_featured' => 1,
            ],
            [
                'id' => 2,
                'title' => 'Winnie-the-Pooh: Pooh Goes Visiting',
                'category' => 'Fabel & Humor',
                'description' => 'Kisah lucu beruang Pooh berkunjung ke rumah kelinci Rabbit dan tersangkut di lubang pintu karena terlalu banyak makan madu.',
                'audio_url' => 'https://www.digitalbook.io/winnie-the-pooh-1264',
                'reference_site' => 'digitalbook.io',
                'cover' => 'winnie-the-pooh.jpg',
                'narrator' => 'Kristin Luoma (DigitalBook.io / LibriVox)',
                'duration' => '14:15',
                'is_featured' => 1,
            ],
            [
                'id' => 3,
                'title' => 'The Secret Garden: Bab 1 - Keheningan di Misselthwaite',
                'category' => 'Misteri & Alam',
                'description' => 'Narasi hangat tentang Mary Lennox yang tiba di rumah besar Yorkshire dan mendengar suara burung robin penunjuk jalan ke taman rahasia.',
                'audio_url' => 'https://www.digitalbook.io/the-secret-garden-112',
                'reference_site' => 'digitalbook.io',
                'cover' => 'the-secret-garden.jpg',
                'narrator' => 'Karen Savage (DigitalBook.io / LibriVox)',
                'duration' => '18:20',
                'is_featured' => 1,
            ],
            [
                'id' => 4,
                'title' => 'The Tale of Peter Rabbit (Lengkap)',
                'category' => 'Dongeng Balita',
                'description' => 'Kisah seru kelinci Peter yang ceroboh dan nakal menjelajahi kebun sayur Pak McGregor dengan iringan suara ekspresif.',
                'audio_url' => 'https://www.digitalbook.io/the-tale-of-peter-rabbit-685',
                'reference_site' => 'digitalbook.io',
                'cover' => 'peter-rabbit.jpg',
                'narrator' => 'Kara Shallenberg (DigitalBook.io / LibriVox)',
                'duration' => '08:35',
                'is_featured' => 1,
            ],
            [
                'id' => 5,
                'title' => 'Alice\'s Adventures in Wonderland: Down the Rabbit-Hole',
                'category' => 'Fantasi Klasik',
                'description' => 'Petualangan Alice meluncur ke dalam liang kelinci putih dan menemukan kunci emas ke dunia fantasi yang menakjubkan.',
                'audio_url' => 'https://www.digitalbook.io/alices-adventures-in-wonderland-11',
                'reference_site' => 'digitalbook.io',
                'cover' => 'alice-in-wonderland.jpg',
                'narrator' => 'Cory Samuel (DigitalBook.io / LibriVox)',
                'duration' => '11:50',
                'is_featured' => 1,
            ],
            [
                'id' => 6,
                'title' => 'The Velveteen Rabbit: Menjadi Nyata Karena Kasih Sayang',
                'category' => 'Karakter & Empati',
                'description' => 'Kisah menyentuh boneka kelinci beludru yang belajar arti cinta sejati dari seorang anak kecil yang selalu mendekapnya.',
                'audio_url' => 'https://www.digitalbook.io/the-velveteen-rabbit-128',
                'reference_site' => 'digitalbook.io',
                'cover' => 'the-velveteen-rabbit.jpg',
                'narrator' => 'Maria Lectrix (DigitalBook.io / LibriVox)',
                'duration' => '15:40',
                'is_featured' => 1,
            ],
        ];
    }
}