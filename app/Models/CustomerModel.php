<?php

namespace App\Models;

use CodeIgniter\Model;

class CustomerModel extends Model
{
    protected $table            = 'customers';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = false;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $useTimestamps    = true;
    protected $dateFormat       = 'datetime';

    protected $allowedFields = [
        'name', 'phone', 'email', 'address', 'system', 'created_by',
    ];

    protected $beforeInsert = ['generateUuid', 'setCreatedBy'];

    protected $validationRules = [
        'name'  => 'required|max_length[200]',
        'phone' => 'required|max_length[20]',
    ];

    protected function generateUuid(array $data): array
    {
        if (empty($data['data']['id'])) {
            $bytes = random_bytes(16);
            $bytes[6] = chr((ord($bytes[6]) & 0x0f) | 0x40);
            $bytes[8] = chr((ord($bytes[8]) & 0x3f) | 0x80);
            $data['data']['id'] = vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($bytes), 4));
        }
        return $data;
    }

    protected function setCreatedBy(array $data): array
    {
        if (empty($data['data']['created_by'])) {
            $data['data']['created_by'] = session()->get('auth_user')['id'] ?? null;
        }
        return $data;
    }

    public function search(string $query, string $system): array
    {
        return $this->groupStart()
            ->like('name', $query)
            ->orLike('phone', $query)
            ->orLike('email', $query)
            ->groupEnd()
            ->where('system', $system)
            ->orderBy('name', 'ASC')
            ->limit(20)
            ->findAll();
    }
}