<?php

namespace App\Controllers;

class EmiController extends BaseController
{
    public function index()
    {
        return view('coming_soon', [
            'title'  => 'EMI & Collections',
            'module' => 'EMI & Collections',
        ]);
    }
}