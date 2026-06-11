<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AuthFilter implements FilterInterface
{
    /**
     * Shared logged-in user data accessible from controllers.
     */
    public static ?array $user = null;

    public function before(RequestInterface $request, $arguments = null): ?ResponseInterface
    {
        $session = session();

        $authUser = $session->get('auth_user');

        if (!$authUser) {
            return redirect()->to('/login');
        }

        // Load full user record and store in shared property
        $userModel = model('App\Models\UserModel');
        $user = $userModel->find($authUser['id']);

        if (!$user || !$user['is_active']) {
            $session->destroy();
            return redirect()->to('/login');
        }

        self::$user = $user;

        return null;
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null): void
    {
        // No action needed after
    }
}