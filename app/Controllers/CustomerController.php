<?php

namespace App\Controllers;

class CustomerController extends BaseController
{
    public function index()
    {
        return view('coming_soon', [
            'title'  => 'Customers',
            'module' => 'Customers',
        ]);
    }
}