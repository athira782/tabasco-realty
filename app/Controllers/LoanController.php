<?php

namespace App\Controllers;

class LoanController extends BaseController
{
    public function index()
    {
        return view('coming_soon', [
            'title'  => 'Bank Loans',
            'module' => 'Bank Loans',
        ]);
    }
}