<?php

namespace App\Models;

use CodeIgniter\Model;

class FloorModel extends Model
{
    protected $table            = 'floors';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = false;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $useTimestamps    = true;
    protected $dateFormat       = 'datetime';

    protected $allowedFields = [
        'project_id', 'name', 'floor_number',
    ];

    protected $beforeInsert = ['generateUuid'];

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

    public function getFloorsForProject(string $projectId): array
    {
        return $this->where('project_id', $projectId)
            ->orderBy('floor_number', 'ASC')
            ->findAll();
    }
}