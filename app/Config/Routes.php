<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Home::index');

$routes->get('/about', 'Page::about');
$routes->get('/about-us', 'Page::about');
$routes->get('/contact', 'Page::contact');
$routes->get('/faqs', 'Page::faqs');
$routes->match(['GET', 'POST'], '/login', 'Page::login');
$routes->get('/logout', 'Page::logout');
$routes->match(['GET', 'POST'], '/profile', 'Page::profile');
$routes->match(['GET', 'POST'], '/profil', 'Page::profile');
$routes->get('/luna', 'Page::luna');
$routes->get('/shop', 'Page::shop');
$routes->get('/toko', 'Page::shop');
$routes->get('/nanny', 'Page::nanny');
$routes->get('/pengasuh', 'Page::nanny');
$routes->get('/perencanaan-keluarga', 'Page::perencanaanKeluarga');
$routes->get('/menu', 'Page::menu');
$routes->get('/resep-mpasi', 'Page::menu');
$routes->get('/search', 'Page::search');
$routes->get('/pencarian', 'Page::search');

// Perpustakaan
$routes->group('perpustakaan', function ($routes) {
    $routes->get('/', 'Library::index');
    $routes->get('katalog', 'Library::catalog');
    $routes->get('detail/(:num)', 'Library::detail/$1');
});

// Artikel & Perawatan Anak
$routes->get('articles', 'Page::articles');
$routes->post('articles/submit', 'Page::submitArticle');
$routes->get('articles/kategori/(:any)', 'Page::articles/$1');
$routes->get('articles/detail/(:any)', 'Page::articleDetail/$1');
$routes->get('artikel/(:any)', 'Page::articleDetail/$1');
$routes->get('perawatan-anak/(:any)', 'Page::articles/$1');

// Direktori Tempat Asuh & Pendidikan
// Rute detail spesifik ditaruh di ATAS agar tidak tertimpa rute dinamis umum (:any)
$routes->get('tempat-asuh/detail/(:segment)', 'Page::detailDaycare/$1');
$routes->get('tempat-asuh/detail-panti/(:segment)', 'Page::detailPanti/$1');

$routes->get('tempat-asuh', 'Page::tempatAsuh');
$routes->get('tempat-asuh/(:any)', 'Page::tempatAsuh/$1');

$routes->get('pendidikan', 'Page::pendidikan');
$routes->get('pendidikan/(:segment)/(:segment)', 'Page::pendidikan/$1/$2');
$routes->get('pendidikan/(:any)', 'Page::pendidikan/$1');

// Kewenangan & Perlindungan Hukum Ibu-Anak
$routes->get('kewenangan', 'Page::kewenangan');
$routes->get('kewenangan/(:any)', 'Page::kewenangan/$1');

// Portal Administrator
$routes->get('admin', 'Admin::index');
$routes->group('admin', function ($routes) {
    $routes->get('/', 'Admin::index');
    $routes->get('(:segment)', 'Admin::index/$1');
    $routes->post('directory/save', 'Admin::saveDirectory');
    $routes->get('directory/delete/(:num)', 'Admin::deleteDirectory/$1');
    $routes->get('directory/toggle-verify/(:num)', 'Admin::toggleVerifyDirectory/$1');
    $routes->post('education/save', 'Admin::saveEducation');
    $routes->get('education/delete/(:num)', 'Admin::deleteEducation/$1');
    $routes->get('education/toggle-verify/(:num)', 'Admin::toggleVerifyEducation/$1');
    $routes->post('article/save', 'Admin::saveArticle');
    $routes->get('article/approve/(:num)', 'Admin::approveArticle/$1');
    $routes->get('article/reject/(:num)', 'Admin::rejectArticle/$1');
    $routes->get('article/delete/(:num)', 'Admin::deleteArticle/$1');
    $routes->post('nanny/save', 'Admin::saveNanny');
    $routes->get('nanny/delete/(:num)', 'Admin::deleteNanny/$1');
    $routes->post('shop/save', 'Admin::saveShopProduct');
    $routes->get('shop/delete/(:num)', 'Admin::deleteShopProduct/$1');
    $routes->get('shop/toggle-active/(:num)', 'Admin::toggleActiveShopProduct/$1');
    $routes->post('settings/save', 'Admin::saveSettings');
});