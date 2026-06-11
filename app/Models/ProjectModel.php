<?php

namespace App\Models;

use CodeIgniter\Model;

class ProjectModel extends Model
{
    protected $table            = 'projects';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = false;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $useTimestamps    = true;
    protected $dateFormat       = 'datetime';

    protected $allowedFields = [
        'name',
        'description',
        'location',
        'system',
        'status',
        'total_units',
        'created_by',
    ];

    protected $beforeInsert = ['generateUuid', 'setCreatedBy'];

    // Validation
    protected $validationRules = [
        'name'   => 'required|max_length[200]',
        'system' => 'required|in_list[india,uae]',
        'status' => 'permit_empty|in_list[active,completed,on_hold,cancelled]',
    ];

    protected $validationMessages = [
        'name' => [
            'required' => 'Project name is required.',
        ],
        'system' => [
            'required' => 'System is required.',
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
     * Set created_by from session auth user
     */
    protected function setCreatedBy(array $data): array
    {
        if (empty($data['data']['created_by'])) {
            $data['data']['created_by'] = session()->get('auth_user')['id'] ?? null;
        }

        return $data;
    }

    /**
     * Get units count for a project
     */
    public function getUnitsCount(string $projectId): int
    {
        $unitModel = model(UnitModel::class);
        return $unitModel->where('project_id', $projectId)->countAllResults();
    }

    /**
     * Get available units count for a project
     */
    public function getAvailableUnitsCount(string $projectId): int
    {
        $unitModel = model(UnitModel::class);
        return $unitModel->where('project_id', $projectId)->where('status', 'available')->countAllResults();
    }

    /**
     * Get project with unit summary
     */
    public function getProjectsWithSummary(string $system = null): array
    {
        $builder = $this->builder();
        if ($system) {
            $builder->where('system', $system);
        }
        $projects = $builder->orderBy('created_at', 'DESC')->get()->getResultArray();

        $unitModel = model(UnitModel::class);

        foreach ($projects as &$project) {
            $project['units_count'] = $unitModel->where('project_id', $project['id'])->countAllResults();
            $project['available_count'] = $unitModel
                ->where('project_id', $project['id'])
                ->where('status', 'available')
                ->countAllResults();
            $project['sold_count'] = $unitModel
                ->where('project_id', $project['id'])
                ->where('status', 'sold')
                ->countAllResults();
        }

        return $projects;
    }
}