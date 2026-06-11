<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PermissionSeeder extends Seeder
{
    public function run()
    {
        // Modules list
        $modules = [
            'projects',
            'units',
            'sales',
            'customers',
            'emi',
            'expenses',
            'petty_cash',
            'loans',
            'brokerage',
            'reports',
            'users',
        ];

        // owner: everything true
        foreach ($modules as $module) {
            $this->db->table('permissions')->insert([
                'role'       => 'owner',
                'module'     => $module,
                'can_view'   => 1,
                'can_create' => 1,
                'can_edit'   => 1,
                'can_approve' => 1,
            ]);
        }

        // accountant: finance modules view+create+edit, sales view only
        $financeModules = ['emi', 'expenses', 'loans', 'brokerage', 'reports'];
        $accountantViewModules = array_merge($financeModules, ['sales']);

        foreach ($accountantViewModules as $module) {
            $this->db->table('permissions')->insert([
                'role'       => 'accountant',
                'module'     => $module,
                'can_view'   => 1,
                'can_create' => in_array($module, $financeModules) ? 1 : 0,
                'can_edit'   => in_array($module, $financeModules) ? 1 : 0,
                'can_approve' => 0,
            ]);
        }

        // sales: sales/customers/units view+create+edit only
        $salesModules = ['sales', 'customers', 'units'];
        foreach ($salesModules as $module) {
            $this->db->table('permissions')->insert([
                'role'       => 'sales',
                'module'     => $module,
                'can_view'   => 1,
                'can_create' => 1,
                'can_edit'   => 1,
                'can_approve' => 0,
            ]);
        }

        // site_office: petty_cash view+create only
        $this->db->table('permissions')->insert([
            'role'       => 'site_office',
            'module'     => 'petty_cash',
            'can_view'   => 1,
            'can_create' => 1,
            'can_edit'   => 0,
            'can_approve' => 0,
        ]);
    }
}