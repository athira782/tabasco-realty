<?php

namespace App\Models;

use CodeIgniter\Model;

class PermissionModel extends Model
{
    protected $table            = 'permissions';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $useTimestamps    = false;

    protected $allowedFields = [
        'role',
        'module',
        'can_view',
        'can_create',
        'can_edit',
        'can_approve',
    ];

    public function canDo(string $role, string $module, string $action): bool
    {
        $actionMap = [
            'view'    => 'can_view',
            'create'  => 'can_create',
            'edit'    => 'can_edit',
            'approve' => 'can_approve',
        ];

        if (!array_key_exists($action, $actionMap)) {
            return false;
        }

        $row = $this->where('role', $role)
            ->where('module', $module)
            ->first();

        if (!$row) {
            return false;
        }

        return (bool) $row[$actionMap[$action]];
    }

    public function getPermissionsForRole(string $role): array
    {
        return $this->where('role', $role)->findAll();
    }
}