<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\AuditLogModel;

class UserController extends BaseController
{
    public function index()
    {
        $userModel = model(UserModel::class);

        if (currentRole() === 'owner') {
            $users = $userModel->findAll();
        } else {
            $users = $userModel->where('system', currentSystem())->findAll();
        }

        return view('users/index', [
            'users' => $users,
            'title' => 'User Management',
        ]);
    }

    public function create()
    {
        return view('users/form', [
            'mode'  => 'create',
            'user'  => null,
            'title' => 'Add New User',
        ]);
    }

    public function store()
    {
        $system = $this->request->getPost('system');
        $email  = $this->request->getPost('email');

        // Check email uniqueness within the same system
        $userModel = model(UserModel::class);
        $existing  = $userModel->where('email', $email)
            ->where('system', $system)
            ->first();

        if ($existing) {
            return redirect()->back()
                ->with('errors', ['email' => 'The email address is already in use for this system.'])
                ->withInput();
        }

        $rules = [
            'name'     => 'required',
            'email'    => 'required|valid_email',
            'password' => 'required|min_length[8]',
            'role'     => 'required|in_list[owner,accountant,sales,site_office]',
            'system'   => 'required|in_list[india,uae]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()
                ->with('errors', $this->validator->getErrors())
                ->withInput();
        }

        $userModel->insert([
            'name'     => $this->request->getPost('name'),
            'email'    => $email,
            'password' => $this->request->getPost('password'),
            'role'     => $this->request->getPost('role'),
            'system'   => $system,
            'is_active' => 1,
        ]);

        return redirect()->to('/users')
            ->with('success', 'User created successfully.');
    }

    public function edit($id)
    {
        $userModel = model(UserModel::class);
        $user = $userModel->find($id);

        if (!$user) {
            return redirect()->to('/users')
                ->with('error', 'User not found.');
        }

        return view('users/form', [
            'mode'  => 'edit',
            'user'  => $user,
            'title' => 'Edit User: ' . $user['name'],
        ]);
    }

    public function update($id)
    {
        $session = session();
        $authUser = $session->get('auth_user');

        // Cannot change own role
        if ($authUser['id'] === $id) {
            $submittedRole = $this->request->getPost('role');
            if ($submittedRole !== $authUser['role']) {
                return redirect()->back()
                    ->with('error', 'You cannot change your own role.')
                    ->withInput();
            }
        }

        $rules = [
            'name'      => 'required',
            'role'      => 'required|in_list[owner,accountant,sales,site_office]',
            'is_active' => 'permit_empty|in_list[0,1]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()
                ->with('errors', $this->validator->getErrors())
                ->withInput();
        }

        $userModel = model(UserModel::class);
        $user = $userModel->find($id);

        if (!$user) {
            return redirect()->to('/users')->with('error', 'User not found.');
        }

        $updateData = [
            'name' => $this->request->getPost('name'),
            'role' => $this->request->getPost('role'),
            'is_active' => $this->request->getPost('is_active') ? 1 : 0,
        ];

        $userModel->update($id, $updateData);

        // Log to AuditLog
        $auditLog = model(AuditLogModel::class);
        $auditLog->log(
            $authUser['id'],
            'UPDATE_USER',
            'USERS',
            json_encode($user),
            json_encode($updateData)
        );

        return redirect()->to('/users')
            ->with('success', 'User updated successfully.');
    }

    public function deactivate($id)
    {
        $session = session();
        $authUser = $session->get('auth_user');

        // Cannot deactivate self
        if ($authUser['id'] === $id) {
            return redirect()->back()
                ->with('error', 'You cannot deactivate your own account.');
        }

        $userModel = model(UserModel::class);
        $user = $userModel->find($id);

        if (!$user) {
            return redirect()->to('/users')->with('error', 'User not found.');
        }

        $userModel->update($id, ['is_active' => 0]);

        // Log to AuditLog
        $auditLog = model(AuditLogModel::class);
        $auditLog->log($authUser['id'], 'DEACTIVATE_USER', 'USERS', null, null);

        return redirect()->to('/users')
            ->with('success', 'User deactivated successfully.');
    }
}