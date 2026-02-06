<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        if (session()->get('isLoggedIn') !== true) {
            return redirect()->to(base_url());
        }

        return view('home/admin');
    }
}
