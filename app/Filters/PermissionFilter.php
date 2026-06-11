<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class PermissionFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null): ?ResponseInterface
    {
        if ($arguments === null || count($arguments) < 2) {
            throw new \RuntimeException('PermissionFilter requires module and action parameters.');
        }

        $module = $arguments[0];
        $action = $arguments[1];

        $session = session();
        $authUser = $session->get('auth_user');
        $role = is_array($authUser) ? ($authUser['role'] ?? null) : $session->get('role');

        if (!$role) {
            return redirect()->to('/login');
        }

        $permissionModel = model('App\Models\PermissionModel');

        if (!$permissionModel->canDo($role, $module, $action)) {
            $message = 'You do not have permission to access this page.';

            $response = service('response');
            $response->setStatusCode(403);
            $response->setBody(view('errors/403', ['message' => $message]));

            return $response;
        }

        return null;
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null): void
    {
        // No action needed after
    }
}