<?php

namespace App\Controllers;

class SalesController extends BaseController
{
    public function index()
    {
        return view('coming_soon', [
            'title'  => 'Sales',
            'module' => 'Sales',
        ]);
    }
}