<?php

namespace App\Controllers;

class Instituciones extends BaseController
{
    public function index(): string
    {
        return view('instituciones/index');
    }
}