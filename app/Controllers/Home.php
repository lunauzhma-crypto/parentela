<?php
namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        // Support demo login / logout query toggle for testing
        if ($this->request->getGet('demo_login') === '1') {
            session()->set('is_logged_in', true);
            return redirect()->to(base_url('/'));
        }
        if ($this->request->getGet('demo_logout') === '1') {
            session()->remove('is_logged_in');
            return redirect()->to(base_url('/'));
        }

        $isLoggedIn = (bool) session()->get('is_logged_in');

        $data = [
            'title' => 'Parentela - Pusat Perawatan & Tumbuh Kembang Anak',
            'isLoggedIn' => $isLoggedIn
        ];
        return view('pages/home', $data);
    }
}