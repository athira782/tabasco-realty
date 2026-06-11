<?php

use App\Models\UserModel;
use App\Models\PermissionModel;
use App\Filters\AuthFilter;

if (!function_exists('currentUser')) {
    /**
     * Returns the currently logged-in user array, or null.
     */
    function currentUser(): ?array
    {
        return AuthFilter::$user;
    }
}

if (!function_exists('hasPermission')) {
    /**
     * Check if the logged-in user has permission for a given module and action.
     */
    function hasPermission(string $module, string $action): bool
    {
        $session = session();
        $authUser = $session->get('auth_user');
        $role = is_array($authUser) ? ($authUser['role'] ?? null) : $session->get('role');

        if (!$role) {
            return false;
        }

        $permissionModel = model(PermissionModel::class);

        return $permissionModel->canDo($role, $module, $action);
    }
}

if (!function_exists('isLoggedIn')) {
    /**
     * Check if a user is currently logged in.
     */
    function isLoggedIn(): bool
    {
        $session = session();
        return $session->has('auth_user') || $session->has('user_id');
    }
}

if (!function_exists('currentRole')) {
    /**
     * Returns the current logged-in user's role, or ''.
     */
    function currentRole(): string
    {
        $authUser = session()->get('auth_user');
        return is_array($authUser) ? ($authUser['role'] ?? '') : '';
    }
}

if (!function_exists('currentSystem')) {
    /**
     * Returns the current logged-in user's system, or ''.
     */
    function currentSystem(): string
    {
        $authUser = session()->get('auth_user');
        return is_array($authUser) ? ($authUser['system'] ?? '') : '';
    }
}

if (!function_exists('logoutUser')) {
    /**
     * Destroy the current session (log out).
     */
    function logoutUser(): void
    {
        session()->destroy();
    }
}