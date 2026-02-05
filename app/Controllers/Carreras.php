<?php

namespace App\Controllers;

class Carreras extends BaseController
{
    public function index(): string
    {
        return view('carreras/index');
    }
}