<?php

namespace App\Models;

use CodeIgniter\Model;

class SalesModel extends Model
{
    protected $table            = 'sales';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = false;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $useTimestamps    = true;
    protected $dateFormat       = 'datetime';

    protected $allowedFields = [
        'id',
        'sale_number',
        'project_id',
        'floor_id',
        'unit_id',
        'unit_type',
        'customer_id',
        'broker_id',
        'agreement_date',
        'registration_date',
        'sale_rate_sqft',
        'total_area_sqft',
        'total_sale_amount',
        'discount',
        'net_sale_amount',
        'gst_included',
        'gst_percent',
        'gst_amount',
        'final_amount',
        'booking_amount',
        'payment_mode',
        'sale_status',
        'remarks',
        'created_by',
    ];

    protected $beforeInsert = ['generateUuid', 'generateSaleNumber', 'setCreatedBy'];

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

    protected function generateSaleNumber(array $data): array
    {
        if (empty($data['data']['sale_number'])) {
            $year = date('Y');
            $db = \Config\Database::connect();
            $result = $db->query("SELECT COUNT(*) as cnt FROM sales WHERE sale_number LIKE 'SAL-{$year}-%'")->getRowArray();
            $next = ($result['cnt'] ?? 0) + 1;
            $data['data']['sale_number'] = sprintf('SAL-%s-%04d', $year, $next);
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

    public function getSalesWithRelations(array $filters = []): array
    {
        $db = \Config\Database::connect();
        $builder = $db->table('sales s')
            ->select("
                s.*,
                p.name as project_name,
                u.unit_number,
                u.unit_type as unit_type_name,
                u.area_sqft,
                u.price,
                c.name as customer_name,
                c.phone as customer_phone,
                b.name as broker_name,
                f.name as floor_name,
                f.floor_number
            ")
            ->join('projects p', 'p.id = s.project_id', 'left')
            ->join('units u', 'u.id = s.unit_id', 'left')
            ->join('customers c', 'c.id = s.customer_id', 'left')
            ->join('brokers b', 'b.id = s.broker_id', 'left')
            ->join('floors f', 'f.id = s.floor_id', 'left');

        // Apply filters
        if (!empty($filters['project_id'])) {
            $builder->where('s.project_id', $filters['project_id']);
        }
        if (!empty($filters['floor_id'])) {
            $builder->where('s.floor_id', $filters['floor_id']);
        }
        if (!empty($filters['unit_id'])) {
            $builder->where('s.unit_id', $filters['unit_id']);
        }
        if (!empty($filters['unit_type'])) {
            $builder->where('s.unit_type', $filters['unit_type']);
        }
        if (!empty($filters['customer_search'])) {
            $builder->like('c.name', $filters['customer_search']);
        }
        if (!empty($filters['broker_id'])) {
            $builder->where('s.broker_id', $filters['broker_id']);
        }
        if (!empty($filters['sale_status'])) {
            $builder->where('s.sale_status', $filters['sale_status']);
        }
        if (!empty($filters['sqft_min'])) {
            $builder->where('s.total_area_sqft >=', $filters['sqft_min']);
        }
        if (!empty($filters['sqft_max'])) {
            $builder->where('s.total_area_sqft <=', $filters['sqft_max']);
        }
        if (!empty($filters['price_min'])) {
            $builder->where('s.final_amount >=', $filters['price_min']);
        }
        if (!empty($filters['price_max'])) {
            $builder->where('s.final_amount <=', $filters['price_max']);
        }
        if (!empty($filters['date_from'])) {
            $builder->where('s.agreement_date >=', $filters['date_from']);
        }
        if (!empty($filters['date_to'])) {
            $builder->where('s.agreement_date <=', $filters['date_to']);
        }

        return $builder->orderBy('s.created_at', 'DESC')->get()->getResultArray();
    }

    public function getSaleDetail(string $id): ?array
    {
        $db = \Config\Database::connect();
        return $db->table('sales s')
            ->select("
                s.*,
                p.name as project_name,
                p.location as project_location,
                u.unit_number,
                u.unit_type as unit_type_name,
                u.block,
                c.name as customer_name,
                c.phone as customer_phone,
                c.email as customer_email,
                c.address as customer_address,
                b.name as broker_name,
                b.phone as broker_phone,
                b.commission_percent as broker_commission,
                f.name as floor_name,
                f.floor_number,
                u2.name as created_by_name
            ")
            ->join('projects p', 'p.id = s.project_id', 'left')
            ->join('units u', 'u.id = s.unit_id', 'left')
            ->join('customers c', 'c.id = s.customer_id', 'left')
            ->join('brokers b', 'b.id = s.broker_id', 'left')
            ->join('floors f', 'f.id = s.floor_id', 'left')
            ->join('users u2', 'u2.id = s.created_by', 'left')
            ->where('s.id', $id)
            ->get()
            ->getRowArray();
    }

    public function getSummaryStats(): array
    {
        $db = \Config\Database::connect();
        
        $totalSales = $db->table('sales')->where('sale_status !=', 'cancelled')->countAllResults();
        $totalValue = $db->table('sales')
            ->selectSum('final_amount')
            ->where('sale_status !=', 'cancelled')
            ->get()
            ->getRowArray()['final_amount'] ?? 0;
        
        $monthStart = date('Y-m-01');
        $thisMonth = $db->table('sales')
            ->selectSum('final_amount')
            ->where('sale_status !=', 'cancelled')
            ->where('created_at >=', $monthStart)
            ->get()
            ->getRowArray()['final_amount'] ?? 0;

        $cancelled = $db->table('sales')
            ->where('sale_status', 'cancelled')
            ->countAllResults();

        return [
            'total_sales' => $totalSales,
            'total_value' => $totalValue,
            'this_month'  => $thisMonth,
            'cancelled'   => $cancelled,
        ];
    }

    public function getEmiForSale(string $saleId): array
    {
        $db = \Config\Database::connect();
        return $db->table('emi')
            ->where('sale_id', $saleId)
            ->orderBy('emi_number', 'ASC')
            ->get()
            ->getResultArray();
    }
}