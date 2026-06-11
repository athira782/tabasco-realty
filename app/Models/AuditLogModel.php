<?php

namespace App\Models;

use CodeIgniter\Model;

class AuditLogModel extends Model
{
    protected $table            = 'audit_logs';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = false;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $useTimestamps    = false;

    protected $allowedFields = [
        'id',
        'user_id',
        'action',
        'module',
        'old_value',
        'new_value',
        'ip_address',
        'created_at',
    ];

    public function log(
        string $userId,
        string $action,
        string $module,
        ?string $old = null,
        ?string $new = null
    ): bool {
        $bytes    = random_bytes(16);
        $bytes[6] = chr((ord($bytes[6]) & 0x0f) | 0x40);
        $bytes[8] = chr((ord($bytes[8]) & 0x3f) | 0x80);
        $uuid     = vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($bytes), 4));

        return $this->insert([
            'id'         => $uuid,
            'user_id'    => $userId,
            'action'     => $action,
            'module'     => $module,
            'old_value'  => $old,
            'new_value'  => $new,
            'ip_address' => $_SERVER['REMOTE_ADDR'] ?? $_SERVER['HTTP_X_FORWARDED_FOR'] ?? '127.0.0.1',
            'created_at' => date('Y-m-d H:i:s'),
        ]);
    }
}