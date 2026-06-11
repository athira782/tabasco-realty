<?php

namespace App\Controllers;

class DashboardController extends BaseController
{
    public function index()
    {
        $session = session();
        $authUser = $session->get('auth_user');

        return view('dashboard/index', [
            'title'  => 'Dashboard',
            'name'   => $authUser['name']   ?? 'User',
            'role'   => $authUser['role']   ?? '',
            'system' => $authUser['system'] ?? '',
        ]);
    }
}