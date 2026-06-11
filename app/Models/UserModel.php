<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = false;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $useTimestamps    = true;
    protected $dateFormat       = 'datetime';

    protected $allowedFields = [
        'name',
        'email',
        'password',
        'role',
        'system',
        'is_active',
    ];

    protected $beforeInsert = ['generateUuid', 'hashPassword'];
    protected $beforeUpdate = ['rehashPassword'];

    protected function generateUuid(array $data): array
    {
        if (empty($data['data']['id'])) {
            $bytes = random_bytes(16);
            $bytes[6] = chr((ord($bytes[6]) & 0x0f) | 0x40); // version 4
            $bytes[8] = chr((ord($bytes[8]) & 0x3f) | 0x80); // variant
            $data['data']['id'] = vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($bytes), 4));
        }

        return $data;
    }

    protected function hashPassword(array $data): array
    {
        if (!empty($data['data']['password'])) {
            $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_BCRYPT);
        }

        return $data;
    }

    protected function rehashPassword(array $data): array
    {
        if (!empty($data['data']['password'])) {
            $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_BCRYPT);
        }

        return $data;
    }

    public function findByEmailAndSystem(string $email, string $system): ?array
    {
        return $this->where('email', $email)
            ->where('system', $system)
            ->first();
    }
}