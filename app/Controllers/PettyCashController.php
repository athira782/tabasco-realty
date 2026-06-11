<?php

namespace App\Controllers;

class PettyCashController extends BaseController
{
    public function index()
    {
        return view('coming_soon', [
            'title'  => 'Petty Cash',
            'module' => 'Petty Cash',
        ]);
    }
}