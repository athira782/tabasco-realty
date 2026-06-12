<?php

namespace App\Controllers;

use App\Models\SalesModel;
use App\Models\ProjectModel;
use App\Models\FloorModel;
use App\Models\UnitModel;
use App\Models\CustomerModel;
use App\Models\BrokerModel;
use App\Models\AuditLogModel;

class SalesController extends BaseController
{
    public function index()
    {
        $salesModel = model(SalesModel::class);
        $projectModel = model(ProjectModel::class);

        $filters = [
            'project_id'      => $this->request->getGet('project_id'),
            'floor_id'        => $this->request->getGet('floor_id'),
            'unit_id'         => $this->request->getGet('unit_id'),
            'unit_type'       => $this->request->getGet('unit_type'),
            'sqft_min'        => $this->request->getGet('sqft_min'),
            'sqft_max'        => $this->request->getGet('sqft_max'),
            'price_min'       => $this->request->getGet('price_min'),
            'price_max'       => $this->request->getGet('price_max'),
            'customer_search' => $this->request->getGet('customer_search'),
            'broker_id'       => $this->request->getGet('broker_id'),
            'date_from'       => $this->request->getGet('date_from'),
            'date_to'         => $this->request->getGet('date_to'),
            'sale_status'     => $this->request->getGet('sale_status'),
        ];

        $sales = $salesModel->getSalesWithRelations(array_filter($filters));
        $stats = $salesModel->getSummaryStats();
        $projects = $projectModel->findAll();
        $brokerModel = model(BrokerModel::class);
        $brokers = $brokerModel->getActiveBrokers(currentSystem());

        return view('sales/index', [
            'sales'    => $sales,
            'stats'    => $stats,
            'projects' => $projects,
            'brokers'  => $brokers,
            'filters'  => $filters,
            'title'    => 'Sales',
        ]);
    }

    public function create()
    {
        $projectModel = model(ProjectModel::class);
        $brokerModel = model(BrokerModel::class);
        $customerModel = model(CustomerModel::class);

        $projects = $projectModel->where('status', 'active')->findAll();
        $brokers = $brokerModel->getActiveBrokers(currentSystem());

        return view('sales/create', [
            'projects' => $projects,
            'brokers'  => $brokers,
            'title'    => 'New Sale',
        ]);
    }

    public function store()
    {
        $salesModel = model(SalesModel::class);
        $unitModel = model(UnitModel::class);
        $auditLog = model(AuditLogModel::class);
        $session = session();
        $authUser = $session->get('auth_user');

        $rules = [
            'project_id'      => 'required',
            'unit_id'         => 'required',
            'customer_id'     => 'required',
            'agreement_date'  => 'required|valid_date[Y-m-d]',
            'sale_rate_sqft'  => 'required|numeric',
            'total_area_sqft' => 'required|numeric',
            'booking_amount'  => 'required|numeric',
            'payment_mode'    => 'required|in_list[cash,cheque,online,emi]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()
                ->with('errors', $this->validator->getErrors())
                ->withInput();
        }

        $unitId = $this->request->getPost('unit_id');

        // Validate unit is available
        $unit = $unitModel->find($unitId);
        if (!$unit || $unit['status'] !== 'available') {
            return redirect()->back()
                ->with('error', 'Selected unit is not available for sale.')
                ->withInput();
        }

        $totalSaleAmount = (float) $this->request->getPost('sale_rate_sqft') * (float) $this->request->getPost('total_area_sqft');
        $discount = (float) ($this->request->getPost('discount') ?: 0);
        $netSaleAmount = $totalSaleAmount - $discount;

        $gstIncluded = $this->request->getPost('gst_included') ?: 'yes';
        $gstPercent = (float) ($this->request->getPost('gst_percent') ?: 0);
        $gstAmount = 0;
        $finalAmount = $netSaleAmount;

        if ($gstIncluded === 'no') {
            $gstAmount = $netSaleAmount * ($gstPercent / 100);
            $finalAmount = $netSaleAmount + $gstAmount;
        }

        $data = [
            'project_id'      => $this->request->getPost('project_id'),
            'floor_id'        => $this->request->getPost('floor_id'),
            'unit_id'         => $unitId,
            'unit_type'       => $unit['unit_type'],
            'customer_id'     => $this->request->getPost('customer_id'),
            'broker_id'       => $this->request->getPost('broker_id') ?: null,
            'agreement_date'  => $this->request->getPost('agreement_date'),
            'registration_date' => $this->request->getPost('registration_date') ?: null,
            'sale_rate_sqft'  => $this->request->getPost('sale_rate_sqft'),
            'total_area_sqft' => $this->request->getPost('total_area_sqft'),
            'total_sale_amount' => $totalSaleAmount,
            'discount'        => $discount,
            'net_sale_amount' => $netSaleAmount,
            'gst_included'    => $gstIncluded,
            'gst_percent'     => $gstPercent,
            'gst_amount'      => $gstAmount,
            'final_amount'    => $finalAmount,
            'booking_amount'  => $this->request->getPost('booking_amount'),
            'payment_mode'    => $this->request->getPost('payment_mode'),
            'sale_status'     => 'booked',
            'remarks'         => $this->request->getPost('remarks'),
        ];

        // Validate booking amount <= final amount
        if ((float) $data['booking_amount'] > $finalAmount) {
            return redirect()->back()
                ->with('error', 'Booking amount cannot exceed final amount.')
                ->withInput();
        }

        $saleId = $salesModel->insert($data);

        if (!$saleId) {
            return redirect()->back()
                ->with('error', 'Failed to create sale. Please try again.')
                ->withInput();
        }

        // Mark unit as sold
        $unitModel->update($unitId, ['status' => 'sold']);

        // Audit log
        $auditLog->log($authUser['id'], 'CREATE_SALE', 'SALES', null, json_encode($data));

        // If EMI, redirect to EMI creation
        if ($this->request->getPost('payment_mode') === 'emi') {
            return redirect()->to('/emi/create?sale_id=' . $saleId)
                ->with('success', 'Sale created successfully. Now set up the EMI schedule.');
        }

        return redirect()->to('/sales')
            ->with('success', 'Sale #' . $salesModel->find($saleId)['sale_number'] . ' created successfully.');
    }

    public function show($id)
    {
        $salesModel = model(SalesModel::class);
        $sale = $salesModel->getSaleDetail($id);

        if (!$sale) {
            return redirect()->to('/sales')
                ->with('error', 'Sale not found.');
        }

        // Get EMI schedule if exists
        $emiSchedule = $salesModel->getEmiForSale($id);

        $balanceDue = (float) $sale['final_amount'] - (float) $sale['booking_amount'];

        return view('sales/show', [
            'sale'        => $sale,
            'emiSchedule' => $emiSchedule,
            'balanceDue'  => $balanceDue,
            'title'       => 'Sale #' . $sale['sale_number'],
        ]);
    }

    public function edit($id)
    {
        $salesModel = model(SalesModel::class);
        $sale = $salesModel->getSaleDetail($id);

        if (!$sale) {
            return redirect()->to('/sales')
                ->with('error', 'Sale not found.');
        }

        $brokerModel = model(BrokerModel::class);
        $brokers = $brokerModel->getActiveBrokers(currentSystem());

        return view('sales/edit', [
            'sale'    => $sale,
            'brokers' => $brokers,
            'title'   => 'Edit Sale #' . $sale['sale_number'],
        ]);
    }

    public function update($id)
    {
        $salesModel = model(SalesModel::class);
        $auditLog = model(AuditLogModel::class);
        $session = session();
        $authUser = $session->get('auth_user');

        $sale = $salesModel->find($id);
        if (!$sale) {
            return redirect()->to('/sales')
                ->with('error', 'Sale not found.');
        }

        $rules = [
            'agreement_date'    => 'required|valid_date[Y-m-d]',
            'registration_date' => 'permit_empty|valid_date[Y-m-d]',
            'discount'          => 'permit_empty|numeric',
            'gst_included'      => 'required|in_list[yes,no]',
            'gst_percent'       => 'permit_empty|numeric',
            'booking_amount'    => 'required|numeric',
            'sale_status'       => 'required|in_list[booked,agreement,registered,cancelled]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()
                ->with('errors', $this->validator->getErrors())
                ->withInput();
        }

        $oldValues = $sale;

        $discount = (float) ($this->request->getPost('discount') ?: 0);
        $gstIncluded = $this->request->getPost('gst_included');
        $gstPercent = (float) ($this->request->getPost('gst_percent') ?: 0);

        // Recalculate net amount based on updated discount
        $totalSaleAmount = (float) ($sale['total_sale_amount'] ?: 0);
        $netSaleAmount = $totalSaleAmount - $discount;
        $gstAmount = 0;
        $finalAmount = $netSaleAmount;

        if ($gstIncluded === 'no') {
            $gstAmount = $netSaleAmount * ($gstPercent / 100);
            $finalAmount = $netSaleAmount + $gstAmount;
        }

        // Handle cancellation - restore unit
        $newStatus = $this->request->getPost('sale_status');
        if ($newStatus === 'cancelled' && $sale['sale_status'] !== 'cancelled') {
            $unitModel = model(UnitModel::class);
            $unitModel->update($sale['unit_id'], ['status' => 'available']);
        }

        // Handle re-activation from cancelled
        if ($newStatus !== 'cancelled' && $sale['sale_status'] === 'cancelled') {
            $unitModel = model(UnitModel::class);
            $unitModel->update($sale['unit_id'], ['status' => 'sold']);
        }

        $updateData = [
            'agreement_date'    => $this->request->getPost('agreement_date'),
            'registration_date' => $this->request->getPost('registration_date') ?: null,
            'discount'          => $discount,
            'net_sale_amount'   => $netSaleAmount,
            'gst_included'      => $gstIncluded,
            'gst_percent'       => $gstPercent,
            'gst_amount'        => $gstAmount,
            'final_amount'      => $finalAmount,
            'booking_amount'    => $this->request->getPost('booking_amount'),
            'broker_id'         => $this->request->getPost('broker_id') ?: null,
            'sale_status'       => $newStatus,
            'remarks'           => $this->request->getPost('remarks'),
        ];

        if (!$salesModel->update($id, $updateData)) {
            return redirect()->back()
                ->with('error', 'Failed to update sale.')
                ->withInput();
        }

        $auditLog->log($authUser['id'], 'UPDATE_SALE', 'SALES', json_encode($oldValues), json_encode($updateData));

        return redirect()->to('/sales/show/' . $id)
            ->with('success', 'Sale updated successfully.');
    }

    public function cancel($id)
    {
        $salesModel = model(SalesModel::class);
        $unitModel = model(UnitModel::class);
        $auditLog = model(AuditLogModel::class);
        $session = session();
        $authUser = $session->get('auth_user');

        $sale = $salesModel->find($id);
        if (!$sale) {
            return redirect()->to('/sales')
                ->with('error', 'Sale not found.');
        }

        if ($sale['sale_status'] === 'cancelled') {
            return redirect()->back()
                ->with('error', 'Sale is already cancelled.');
        }

        $salesModel->update($id, ['sale_status' => 'cancelled']);
        $unitModel->update($sale['unit_id'], ['status' => 'available']);

        $auditLog->log($authUser['id'], 'CANCEL_SALE', 'SALES', json_encode($sale), json_encode(['sale_status' => 'cancelled']));

        return redirect()->to('/sales')
            ->with('success', 'Sale cancelled successfully. Unit is now available.');
    }

    public function print($id)
    {
        $salesModel = model(SalesModel::class);
        $sale = $salesModel->getSaleDetail($id);

        if (!$sale) {
            return redirect()->to('/sales')
                ->with('error', 'Sale not found.');
        }

        $balanceDue = (float) $sale['final_amount'] - (float) $sale['booking_amount'];

        return view('sales/print', [
            'sale'       => $sale,
            'balanceDue' => $balanceDue,
            'title'      => 'Print - Sale #' . $sale['sale_number'],
        ]);
    }

    // ─── AJAX Endpoints ───

    public function getFloors()
    {
        $projectId = $this->request->getGet('project_id');
        if (!$projectId) {
            return $this->response->setJSON([]);
        }

        $floorModel = model(FloorModel::class);
        $floors = $floorModel->getFloorsForProject($projectId);

        return $this->response->setJSON($floors);
    }

    public function getUnits()
    {
        $projectId = $this->request->getGet('project_id');
        $floorId = $this->request->getGet('floor_id');

        if (!$projectId) {
            return $this->response->setJSON([]);
        }

        $unitModel = model(UnitModel::class);
        $builder = $unitModel->where('project_id', $projectId)
            ->where('status', 'available');

        if ($floorId) {
            $floorModel = model(FloorModel::class);
            $floor = $floorModel->find($floorId);
            if ($floor) {
                $builder->where('floor', $floor['floor_number']);
            }
        }

        $units = $builder->orderBy('unit_number', 'ASC')->findAll();

        return $this->response->setJSON($units);
    }

    public function getUnitDetail()
    {
        $unitId = $this->request->getGet('unit_id');
        if (!$unitId) {
            return $this->response->setJSON([]);
        }

        $unitModel = model(UnitModel::class);
        $unit = $unitModel->find($unitId);

        return $this->response->setJSON($unit ?: []);
    }

    public function searchCustomers()
    {
        $query = $this->request->getGet('q');
        if (!$query || strlen($query) < 2) {
            return $this->response->setJSON([]);
        }

        $customerModel = model(CustomerModel::class);
        $customers = $customerModel->search($query, currentSystem());

        return $this->response->setJSON($customers);
    }

    public function storeCustomerAjax()
    {
        $customerModel = model(CustomerModel::class);

        $rules = [
            'name'  => 'required|max_length[200]',
            'phone' => 'required|max_length[20]',
        ];

        if (!$this->validate($rules)) {
            return $this->response->setJSON([
                'success' => false,
                'errors'  => $this->validator->getErrors(),
            ]);
        }

        $id = $customerModel->insert([
            'name'    => $this->request->getPost('name'),
            'phone'   => $this->request->getPost('phone'),
            'email'   => $this->request->getPost('email'),
            'address' => $this->request->getPost('address'),
            'system'  => currentSystem(),
        ]);

        $customer = $customerModel->find($id);

        return $this->response->setJSON([
            'success'  => true,
            'customer' => $customer,
        ]);
    }
}