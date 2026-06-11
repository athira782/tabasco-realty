<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\AuditLogModel;

class AuthController extends BaseController
{
    public function index()
    {
        // If already logged in, redirect to dashboard
        if (session()->has('auth_user')) {
            return redirect()->to('/dashboard');
        }

        return view('auth/login', [
            'error' => session()->getFlashdata('error'),
        ]);
    }

    public function attemptLogin()
    {
        $email    = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $system   = $this->request->getPost('system');

        // Validate required fields
        $rules = [
            'email'    => 'required|valid_email',
            'password' => 'required',
            'system'   => 'required|in_list[india,uae]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()
                ->with('error', 'All fields are required and must be valid.')
                ->withInput();
        }

        // Find user by email and system
        $userModel = model(UserModel::class);
        $user = $userModel->findByEmailAndSystem($email, $system);

        if (!$user || !password_verify($password, $user['password'])) {
            return redirect()->back()
                ->with('error', 'Invalid email or password')
                ->withInput();
        }

        // Check if account is active
        if (!$user['is_active']) {
            return redirect()->back()
                ->with('error', 'Your account is deactivated')
                ->withInput();
        }

        // Set session data
        $session = session();
        $session->set('auth_user', [
            'id'     => $user['id'],
            'name'   => $user['name'],
            'email'  => $user['email'],
            'role'   => $user['role'],
            'system' => $user['system'],
        ]);

        // Log to AuditLog
        $auditLog = model(AuditLogModel::class);
        $auditLog->log($user['id'], 'LOGIN', 'AUTH', null, null);

        return redirect()->to('/dashboard');
    }

    public function logout()
    {
        $session = session();

        // Log to AuditLog if auth_user exists
        if ($session->has('auth_user')) {
            $auditLog = model(AuditLogModel::class);
            $auditLog->log($session->get('auth_user')['id'], 'LOGOUT', 'AUTH', null, null);
        }

        $session->destroy();

        return redirect()->to('/login');
    }
}