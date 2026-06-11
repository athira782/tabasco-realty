<?php

namespace App\Controllers;

class ExpenseController extends BaseController
{
    public function index()
    {
        return view('coming_soon', [
            'title'  => 'Expenses',
            'module' => 'Expenses',
        ]);
    }
}