<?php

namespace App\Controllers;

use App\Models\ProjectModel;
use App\Models\UnitModel;
use App\Models\AuditLogModel;

class ProjectController extends BaseController
{
    /**
     * List all projects for current user's system (or all for owner)
     */
    public function index()
    {
        $projectModel = model(ProjectModel::class);
        $system = currentRole() === 'owner' ? null : currentSystem();

        $projects = $projectModel->getProjectsWithSummary($system);

        return view('projects/index', [
            'projects' => $projects,
            'title'    => 'Projects & Units',
        ]);
    }

    /**
     * Show project detail with units list
     */
    public function view($id)
    {
        $projectModel = model(ProjectModel::class);
        $unitModel    = model(UnitModel::class);

        $project = $projectModel->find($id);

        if (!$project) {
            return redirect()->to('/projects')
                ->with('error', 'Project not found.');
        }

        $units        = $unitModel->getUnitsForProject($id);
        $statusCounts = $unitModel->getStatusCounts($id);

        return view('projects/view', [
            'project'      => $project,
            'units'        => $units,
            'statusCounts' => $statusCounts,
            'title'        => $project['name'],
        ]);
    }

    /**
     * Show create project form
     */
    public function create()
    {
        return view('projects/form', [
            'mode'    => 'create',
            'project' => null,
            'title'   => 'Add New Project',
        ]);
    }

    /**
     * Store a new project
     */
    public function store()
    {
        $system = $this->request->getPost('system');

        $rules = [
            'name'        => 'required|max_length[200]',
            'description' => 'permit_empty|max_length[1000]',
            'location'    => 'permit_empty|max_length[300]',
            'system'      => 'required|in_list[india,uae]',
            'status'      => 'permit_empty|in_list[active,completed,on_hold,cancelled]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()
                ->with('errors', $this->validator->getErrors())
                ->withInput();
        }

        $projectModel = model(ProjectModel::class);

        $projectModel->insert([
            'name'        => $this->request->getPost('name'),
            'description' => $this->request->getPost('description'),
            'location'    => $this->request->getPost('location'),
            'system'      => $system,
            'status'      => $this->request->getPost('status') ?: 'active',
            'total_units' => 0,
        ]);

        // Audit log
        $auditLog = model(AuditLogModel::class);
        $authUser = session()->get('auth_user');
        $auditLog->log(
            $authUser['id'],
            'CREATE_PROJECT',
            'PROJECTS',
            null,
            json_encode(['name' => $this->request->getPost('name'), 'system' => $system])
        );

        return redirect()->to('/projects')
            ->with('success', 'Project created successfully.');
    }

    /**
     * Show edit project form
     */
    public function edit($id)
    {
        $projectModel = model(ProjectModel::class);
        $project = $projectModel->find($id);

        if (!$project) {
            return redirect()->to('/projects')
                ->with('error', 'Project not found.');
        }

        return view('projects/form', [
            'mode'    => 'edit',
            'project' => $project,
            'title'   => 'Edit Project: ' . $project['name'],
        ]);
    }

    /**
     * Update an existing project
     */
    public function update($id)
    {
        $projectModel = model(ProjectModel::class);
        $project = $projectModel->find($id);

        if (!$project) {
            return redirect()->to('/projects')
                ->with('error', 'Project not found.');
        }

        $rules = [
            'name'        => 'required|max_length[200]',
            'description' => 'permit_empty|max_length[1000]',
            'location'    => 'permit_empty|max_length[300]',
            'status'      => 'required|in_list[active,completed,on_hold,cancelled]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()
                ->with('errors', $this->validator->getErrors())
                ->withInput();
        }

        $updateData = [
            'name'        => $this->request->getPost('name'),
            'description' => $this->request->getPost('description'),
            'location'    => $this->request->getPost('location'),
            'status'      => $this->request->getPost('status'),
        ];

        $projectModel->update($id, $updateData);

        // Audit log
        $auditLog = model(AuditLogModel::class);
        $authUser = session()->get('auth_user');
        $auditLog->log(
            $authUser['id'],
            'UPDATE_PROJECT',
            'PROJECTS',
            json_encode($project),
            json_encode($updateData)
        );

        return redirect()->to('/projects')
            ->with('success', 'Project updated successfully.');
    }

    // ────────────────────────────────────────────
    // UNIT MANAGEMENT (nested under project)
    // ────────────────────────────────────────────

    /**
     * Show create unit form for a project
     */
    public function createUnit($projectId)
    {
        $projectModel = model(ProjectModel::class);
        $project = $projectModel->find($projectId);

        if (!$project) {
            return redirect()->to('/projects')
                ->with('error', 'Project not found.');
        }

        return view('projects/unit_form', [
            'mode'    => 'create',
            'unit'    => null,
            'project' => $project,
            'title'   => 'Add Unit — ' . $project['name'],
        ]);
    }

    /**
     * Store a new unit under a project
     */
    public function storeUnit($projectId)
    {
        $projectModel = model(ProjectModel::class);
        $project = $projectModel->find($projectId);

        if (!$project) {
            return redirect()->to('/projects')
                ->with('error', 'Project not found.');
        }

        $rules = [
            'unit_number' => 'required|max_length[50]',
            'unit_type'   => 'required|max_length[50]',
            'block'       => 'permit_empty|max_length[50]',
            'floor'       => 'permit_empty|integer',
            'area_sqft'   => 'permit_empty|decimal',
            'price'       => 'permit_empty|decimal',
            'status'      => 'permit_empty|in_list[available,sold,reserved,booked,under_construction]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()
                ->with('errors', $this->validator->getErrors())
                ->withInput();
        }

        $unitModel = model(UnitModel::class);

        $unitModel->insert([
            'project_id'  => $projectId,
            'unit_number' => $this->request->getPost('unit_number'),
            'unit_type'   => $this->request->getPost('unit_type'),
            'block'       => $this->request->getPost('block'),
            'floor'       => $this->request->getPost('floor') ?: null,
            'area_sqft'   => $this->request->getPost('area_sqft') ?: null,
            'price'       => $this->request->getPost('price') ?: null,
            'status'      => $this->request->getPost('status') ?: 'available',
        ]);

        // Update project total units
        $unitModel->updateProjectTotalUnits($projectId);

        // Audit log
        $auditLog = model(AuditLogModel::class);
        $authUser = session()->get('auth_user');
        $auditLog->log(
            $authUser['id'],
            'CREATE_UNIT',
            'UNITS',
            null,
            json_encode([
                'project_id'  => $projectId,
                'unit_number' => $this->request->getPost('unit_number'),
            ])
        );

        return redirect()->to('/projects/view/' . $projectId)
            ->with('success', 'Unit added successfully.');
    }

    /**
     * Show edit unit form
     */
    public function editUnit($projectId, $unitId)
    {
        $projectModel = model(ProjectModel::class);
        $project = $projectModel->find($projectId);

        if (!$project) {
            return redirect()->to('/projects')
                ->with('error', 'Project not found.');
        }

        $unitModel = model(UnitModel::class);
        $unit = $unitModel->find($unitId);

        if (!$unit || $unit['project_id'] !== $projectId) {
            return redirect()->to('/projects/view/' . $projectId)
                ->with('error', 'Unit not found.');
        }

        return view('projects/unit_form', [
            'mode'    => 'edit',
            'unit'    => $unit,
            'project' => $project,
            'title'   => 'Edit Unit ' . $unit['unit_number'] . ' — ' . $project['name'],
        ]);
    }

    /**
     * Update an existing unit
     */
    public function updateUnit($projectId, $unitId)
    {
        $projectModel = model(ProjectModel::class);
        $project = $projectModel->find($projectId);

        if (!$project) {
            return redirect()->to('/projects')
                ->with('error', 'Project not found.');
        }

        $unitModel = model(UnitModel::class);
        $unit = $unitModel->find($unitId);

        if (!$unit || $unit['project_id'] !== $projectId) {
            return redirect()->to('/projects/view/' . $projectId)
                ->with('error', 'Unit not found.');
        }

        $rules = [
            'unit_number' => 'required|max_length[50]',
            'unit_type'   => 'required|max_length[50]',
            'block'       => 'permit_empty|max_length[50]',
            'floor'       => 'permit_empty|integer',
            'area_sqft'   => 'permit_empty|decimal',
            'price'       => 'permit_empty|decimal',
            'status'      => 'required|in_list[available,sold,reserved,booked,under_construction]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()
                ->with('errors', $this->validator->getErrors())
                ->withInput();
        }

        $updateData = [
            'unit_number' => $this->request->getPost('unit_number'),
            'unit_type'   => $this->request->getPost('unit_type'),
            'block'       => $this->request->getPost('block'),
            'floor'       => $this->request->getPost('floor') ?: null,
            'area_sqft'   => $this->request->getPost('area_sqft') ?: null,
            'price'       => $this->request->getPost('price') ?: null,
            'status'      => $this->request->getPost('status'),
        ];

        $unitModel->update($unitId, $updateData);

        // Audit log
        $auditLog = model(AuditLogModel::class);
        $authUser = session()->get('auth_user');
        $auditLog->log(
            $authUser['id'],
            'UPDATE_UNIT',
            'UNITS',
            json_encode($unit),
            json_encode($updateData)
        );

        return redirect()->to('/projects/view/' . $projectId)
            ->with('success', 'Unit updated successfully.');
    }

    /**
     * Delete a unit
     */
    public function deleteUnit($projectId, $unitId)
    {
        $projectModel = model(ProjectModel::class);
        $project = $projectModel->find($projectId);

        if (!$project) {
            return redirect()->to('/projects')
                ->with('error', 'Project not found.');
        }

        $unitModel = model(UnitModel::class);
        $unit = $unitModel->find($unitId);

        if (!$unit || $unit['project_id'] !== $projectId) {
            return redirect()->to('/projects/view/' . $projectId)
                ->with('error', 'Unit not found.');
        }

        // Only allow deletion if unit is available or under_construction
        if (!in_array($unit['status'], ['available', 'under_construction'])) {
            return redirect()->to('/projects/view/' . $projectId)
                ->with('error', 'Cannot delete a unit that is ' . str_replace('_', ' ', $unit['status']) . '.');
        }

        $unitModel->delete($unitId);

        // Update project total units
        $unitModel->updateProjectTotalUnits($projectId);

        // Audit log
        $auditLog = model(AuditLogModel::class);
        $authUser = session()->get('auth_user');
        $auditLog->log(
            $authUser['id'],
            'DELETE_UNIT',
            'UNITS',
            json_encode($unit),
            null
        );

        return redirect()->to('/projects/view/' . $projectId)
            ->with('success', 'Unit deleted successfully.');
    }
}