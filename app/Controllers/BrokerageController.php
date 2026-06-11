<?php

namespace App\Controllers;

class BrokerageController extends BaseController
{
    public function index()
    {
        return view('coming_soon', [
            'title'  => 'Brokerage',
            'module' => 'Brokerage',
        ]);
    }
}