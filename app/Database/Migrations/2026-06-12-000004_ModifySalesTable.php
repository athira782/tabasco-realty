<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ModifySalesTable extends Migration
{
    public function up()
    {
        // Add missing columns to existing sales table
        $fields = [
            'floor_id' => [
                'type'       => 'VARCHAR',
                'constraint' => 36,
                'null'       => true,
                'after'      => 'project_id',
            ],
            'unit_type' => [
                'type'       => 'ENUM',
                'constraint' => ['shop', 'flat', 'parking'],
                'null'       => true,
                'after'      => 'unit_id',
            ],
            'registration_date' => [
                'type' => 'DATE',
                'null' => true,
                'after' => 'agreement_date',
            ],
            'sale_rate_sqft' => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2',
                'null'       => true,
                'after'      => 'registration_date',
            ],
            'total_area_sqft' => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2',
                'null'       => true,
                'after'      => 'sale_rate_sqft',
            ],
            'total_sale_amount' => [
                'type'       => 'DECIMAL',
                'constraint' => '15,2',
                'null'       => true,
                'after'      => 'total_area_sqft',
            ],
            'net_sale_amount' => [
                'type'       => 'DECIMAL',
                'constraint' => '15,2',
                'null'       => true,
                'after'      => 'discount',
            ],
            'gst_included' => [
                'type'       => 'ENUM',
                'constraint' => ['yes', 'no'],
                'default'    => 'yes',
                'after'      => 'net_sale_amount',
            ],
            'gst_percent' => [
                'type'       => 'DECIMAL',
                'constraint' => '5,2',
                'default'    => 0,
                'after'      => 'gst_included',
            ],
            'gst_amount' => [
                'type'       => 'DECIMAL',
                'constraint' => '15,2',
                'default'    => 0,
                'after'      => 'gst_percent',
            ],
            'final_amount' => [
                'type'       => 'DECIMAL',
                'constraint' => '15,2',
                'null'       => true,
                'after'      => 'gst_amount',
            ],
        ];

        // Rename agreement_value to total_sale_amount if exists, or add columns
        if ($this->db->fieldExists('agreement_value', 'sales')) {
            $this->forge->modifyColumn('sales', [
                'agreement_value' => [
                    'name'       => 'total_sale_amount',
                    'type'       => 'DECIMAL',
                    'constraint' => '15,2',
                    'null'       => true,
                ],
            ]);
        }

        // Rename net_value to net_sale_amount if exists
        if ($this->db->fieldExists('net_value', 'sales')) {
            $this->forge->modifyColumn('sales', [
                'net_value' => [
                    'name'       => 'net_sale_amount',
                    'type'       => 'DECIMAL',
                    'constraint' => '15,2',
                    'null'       => true,
                ],
            ]);
        }

        // Rename sale_date to agreement_date if exists
        if ($this->db->fieldExists('sale_date', 'sales')) {
            $this->forge->modifyColumn('sales', [
                'sale_date' => [
                    'name' => 'agreement_date',
                    'type' => 'DATE',
                    'null' => true,
                ],
            ]);
        }

        // Add new fields
        $this->forge->addColumn('sales', $fields);
    }

    public function down()
    {
        // Reverse changes - drop added columns
        $this->forge->dropColumn('sales', [
            'floor_id', 'unit_type', 'registration_date',
            'sale_rate_sqft', 'total_area_sqft', 'total_sale_amount',
            'net_sale_amount', 'gst_included', 'gst_percent',
            'gst_amount', 'final_amount',
        ]);
    }
}