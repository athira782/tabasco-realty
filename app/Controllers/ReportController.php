<?php

namespace App\Controllers;

class ReportController extends BaseController
{
    public function index()
    {
        return view('coming_soon', [
            'title'  => 'Reports',
            'module' => 'Reports',
        ]);
    }
}