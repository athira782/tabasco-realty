<?php

namespace App\Models;

use CodeIgniter\Model;

class UnitModel extends Model
{
    protected $table            = 'units';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = false;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $useTimestamps    = true;
    protected $dateFormat       = 'datetime';

    protected $allowedFields = [
        'project_id',
        'unit_number',
        'unit_type',
        'block',
        'floor',
        'area_sqft',
        'price',
        'status',
    ];

    protected $beforeInsert = ['generateUuid'];

    // Validation
    protected $validationRules = [
        'project_id'  => 'required',
        'unit_number' => 'required|max_length[50]',
        'unit_type'   => 'required|max_length[50]',
        'price'       => 'permit_empty|decimal',
        'area_sqft'   => 'permit_empty|decimal',
        'status'      => 'permit_empty|in_list[available,sold,reserved,booked,under_construction]',
    ];

    protected $validationMessages = [
        'unit_number' => [
            'required' => 'Unit number is required.',
        ],
        'unit_type' => [
            'required' => 'Unit type is required.',
        ],
    ];

    /**
     * Auto-generate UUID before insert
     */
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

    /**
     * Get units for a specific project with optional status filter
     */
    public function getUnitsForProject(string $projectId, ?string $status = null): array
    {
        $builder = $this->where('project_id', $projectId);

        if ($status) {
            $builder->where('status', $status);
        }

        return $builder->orderBy('block, floor, unit_number', 'ASC')
            ->get()
            ->getResultArray();
    }

    /**
     * Get status counts for a project
     */
    public function getStatusCounts(string $projectId): array
    {
        $counts = [];

        $statuses = ['available', 'sold', 'reserved', 'booked', 'under_construction'];

        foreach ($statuses as $status) {
            $counts[$status] = $this->where('project_id', $projectId)
                ->where('status', $status)
                ->countAllResults();
        }

        return $counts;
    }

    /**
     * Update project's total_units count
     */
    public function updateProjectTotalUnits(string $projectId): void
    {
        $count = $this->where('project_id', $projectId)->countAllResults();
        $db = \Config\Database::connect();
        $db->table('projects')
            ->where('id', $projectId)
            ->update(['total_units' => $count]);
    }
}