<?php

namespace App\Controllers;

class ReportController extends BaseController
{
    public function index()
    {
        return view('reports/index', [
            'title' => 'Reports & MIS',
        ]);
    }



// Reports.php Controller
// Use static arrays as dummy data for every method
// NO database queries — all hardcoded arrays

public function availability() {
    $data['report_data'] = [
        ['project'=>'Tabasco Heights','floor'=>'Ground','unit_no'=>'G-01','type'=>'Shop','area'=>450,'base_price'=>2250000,'status'=>'Available'],
        ['project'=>'Tabasco Heights','floor'=>'Ground','unit_no'=>'G-02','type'=>'Shop','area'=>380,'base_price'=>1900000,'status'=>'Sold'],
        ['project'=>'Tabasco Residency','floor'=>'1st','unit_no'=>'101','type'=>'Flat','area'=>1200,'base_price'=>6000000,'status'=>'Available'],
        ['project'=>'Tabasco Residency','floor'=>'1st','unit_no'=>'102','type'=>'Flat','area'=>1100,'base_price'=>5500000,'status'=>'Hold'],
        ['project'=>'Tabasco Residency','floor'=>'Basement','unit_no'=>'P-01','type'=>'Parking','area'=>120,'base_price'=>300000,'status'=>'Available'],
        ['project'=>'Tabasco Residency','floor'=>'Basement','unit_no'=>'P-02','type'=>'Parking','area'=>120,'base_price'=>300000,'status'=>'Sold'],
    ];
    return view('reports/availability', $data);
}

public function sales() {
    $data['report_data'] = [
        ['sale_no'=>'SAL-2024-0001','date'=>'2024-01-15','project'=>'Tabasco Heights','floor'=>'Ground','unit'=>'G-01','type'=>'Shop','customer'=>'Rajesh Kumar','broker'=>'ABC Realty','area'=>450,'rate'=>5000,'amount'=>2250000,'gst'=>202500,'final'=>2452500,'mode'=>'EMI','status'=>'Agreement'],
        ['sale_no'=>'SAL-2024-0002','date'=>'2024-02-10','project'=>'Tabasco Residency','floor'=>'1st','unit'=>'101','type'=>'Flat','customer'=>'Priya Sharma','broker'=>'XYZ Brokers','area'=>1200,'rate'=>5000,'amount'=>6000000,'gst'=>0,'final'=>6000000,'mode'=>'Cash','status'=>'Registered'],
        ['sale_no'=>'SAL-2024-0003','date'=>'2024-03-05','project'=>'Tabasco Residency','floor'=>'Basement','unit'=>'P-02','type'=>'Parking','customer'=>'Amit Patel','broker'=>'—','area'=>120,'rate'=>2500,'amount'=>300000,'gst'=>27000,'final'=>327000,'mode'=>'Online','status'=>'Booked'],
    ];
    return view('reports/sales', $data);
}

public function emiCollections() {
    $data['report_data'] = [
        ['sale_no'=>'SAL-2024-0001','customer'=>'Rajesh Kumar','project'=>'Tabasco Heights','unit'=>'G-01','emi_no'=>1,'due_date'=>'2024-02-01','due_amount'=>50000,'paid_date'=>'2024-02-01','paid_amount'=>50000,'balance'=>0,'status'=>'Paid'],
        ['sale_no'=>'SAL-2024-0001','customer'=>'Rajesh Kumar','project'=>'Tabasco Heights','unit'=>'G-01','emi_no'=>2,'due_date'=>'2024-03-01','due_amount'=>50000,'paid_date'=>'2024-03-05','paid_amount'=>50000,'balance'=>0,'status'=>'Paid'],
        ['sale_no'=>'SAL-2024-0001','customer'=>'Rajesh Kumar','project'=>'Tabasco Heights','unit'=>'G-01','emi_no'=>3,'due_date'=>'2024-04-01','due_amount'=>50000,'paid_date'=>null,'paid_amount'=>0,'balance'=>50000,'status'=>'Pending'],
        ['sale_no'=>'SAL-2024-0001','customer'=>'Rajesh Kumar','project'=>'Tabasco Heights','unit'=>'G-01','emi_no'=>4,'due_date'=>'2024-05-01','due_amount'=>50000,'paid_date'=>null,'paid_amount'=>0,'balance'=>50000,'status'=>'Overdue'],
    ];
    return view('reports/emi_collections', $data);
}

public function customerLedger() {
    $data['report_data'] = [
        ['date'=>'2024-01-15','description'=>'Booking Amount - G-01','voucher'=>'RCP-001','debit'=>0,'credit'=>500000,'balance'=>500000],
        ['date'=>'2024-02-01','description'=>'EMI No 1','voucher'=>'RCP-002','debit'=>0,'credit'=>50000,'balance'=>550000],
        ['date'=>'2024-03-01','description'=>'EMI No 2','voucher'=>'RCP-003','debit'=>0,'credit'=>50000,'balance'=>600000],
        ['date'=>'2024-03-10','description'=>'Adjustment','voucher'=>'JV-001','debit'=>5000,'credit'=>0,'balance'=>595000],
    ];
    return view('reports/customer_ledger', $data);
}

public function cashBook() {
    $data['report_data'] = [
        ['date'=>'2024-01-15','description'=>'Booking from Rajesh Kumar','voucher'=>'RCP-001','receipt'=>500000,'payment'=>0,'balance'=>500000],
        ['date'=>'2024-01-20','description'=>'Office Rent Payment','voucher'=>'PMT-001','receipt'=>0,'payment'=>25000,'balance'=>475000],
        ['date'=>'2024-02-01','description'=>'EMI Collection','voucher'=>'RCP-002','receipt'=>50000,'payment'=>0,'balance'=>525000],
        ['date'=>'2024-02-15','description'=>'Electricity Bill','voucher'=>'PMT-002','receipt'=>0,'payment'=>5000,'balance'=>520000],
    ];
    return view('reports/cash_book', $data);
}

public function bankReports() {
    $data['report_data'] = [
        ['date'=>'2024-01-16','description'=>'Deposit - Rajesh Kumar Cheque','cheque'=>'123456','deposit'=>500000,'withdrawal'=>0,'balance'=>500000],
        ['date'=>'2024-01-25','description'=>'Contractor Payment','cheque'=>'654321','deposit'=>0,'withdrawal'=>100000,'balance'=>400000],
        ['date'=>'2024-02-02','description'=>'EMI Deposit','cheque'=>'789012','deposit'=>50000,'withdrawal'=>0,'balance'=>450000],
    ];
    return view('reports/bank_reports', $data);
}

public function supplierStatements() {
    $data['report_data'] = [
        ['date'=>'2024-01-10','description'=>'Construction Work Invoice','invoice'=>'INV-001','amount'=>500000,'paid'=>300000,'balance'=>200000],
        ['date'=>'2024-02-10','description'=>'Electrical Work Invoice','invoice'=>'INV-002','amount'=>150000,'paid'=>150000,'balance'=>0],
        ['date'=>'2024-03-10','description'=>'Plumbing Work Invoice','invoice'=>'INV-003','amount'=>80000,'paid'=>0,'balance'=>80000],
    ];
    return view('reports/supplier_statements', $data);
}

public function salesReturn() {
    $data['report_data'] = [
        ['return_no'=>'RET-2024-001','sale_no'=>'SAL-2024-003','customer'=>'Amit Patel','unit'=>'P-02','return_date'=>'2024-04-01','refund_amount'=>327000,'status'=>'Processed'],
    ];
    return view('reports/sales_return', $data);
}

public function exchange() {
    $data['report_data'] = [
        ['exchange_no'=>'EXC-2024-001','customer'=>'Priya Sharma','old_unit'=>'101 - 1st Floor','new_unit'=>'201 - 2nd Floor','difference'=>500000,'date'=>'2024-03-15','status'=>'Completed'],
    ];
    return view('reports/exchange', $data);
}

public function pettyCash() {
    $data['report_data'] = [
        ['date'=>'2024-01-05','description'=>'Office Supplies','category'=>'Stationery','receipt'=>0,'payment'=>2500,'balance'=>7500],
        ['date'=>'2024-01-10','description'=>'Tea & Refreshments','category'=>'Misc','receipt'=>0,'payment'=>500,'balance'=>7000],
        ['date'=>'2024-01-15','description'=>'Petty Cash Replenishment','category'=>'Opening','receipt'=>5000,'payment'=>0,'balance'=>12000],
    ];
    return view('reports/petty_cash', $data);
}

public function bankLoanEmi() {
    $data['report_data'] = [
        ['emi_no'=>1,'due_date'=>'2024-02-01','principal'=>45000,'interest'=>15000,'total'=>60000,'paid_date'=>'2024-02-01','status'=>'Paid'],
        ['emi_no'=>2,'due_date'=>'2024-03-01','principal'=>46000,'interest'=>14000,'total'=>60000,'paid_date'=>'2024-03-02','status'=>'Paid'],
        ['emi_no'=>3,'due_date'=>'2024-04-01','principal'=>47000,'interest'=>13000,'total'=>60000,'paid_date'=>null,'status'=>'Pending'],
    ];
    return view('reports/bank_loan_emi', $data);
}

public function trialBalance() {
    $data['report_data'] = [
        ['account'=>'Sales Revenue','debit'=>0,'credit'=>8779500],
        ['account'=>'Cash in Hand','debit'=>520000,'credit'=>0],
        ['account'=>'Bank Account','debit'=>450000,'credit'=>0],
        ['account'=>'Brokerage Expense','debit'=>50000,'credit'=>0],
        ['account'=>'Construction Cost','debit'=>730000,'credit'=>0],
        ['account'=>'Customer Advances','debit'=>0,'credit'=>600000],
        ['account'=>'Loan Account','debit'=>0,'credit'=>1200000],
        ['account'=>'Capital Account','debit'=>0,'credit'=>170500],
    ];
    return view('reports/trial_balance', $data);
}

public function profitLoss() {
    $data['income'] = [
        ['label'=>'Sales Revenue - Commercial','amount'=>2452500],
        ['label'=>'Sales Revenue - Residential','amount'=>6000000],
        ['label'=>'Sales Revenue - Parking','amount'=>327000],
    ];
    $data['expenses'] = [
        ['label'=>'Construction Cost','amount'=>730000],
        ['label'=>'Brokerage Paid','amount'=>50000],
        ['label'=>'Bank Loan Interest','amount'=>42000],
        ['label'=>'Operating Expenses','amount'=>33000],
    ];
    return view('reports/profit_loss', $data);
}

public function balanceSheet() {
    $data['assets'] = [
        ['label'=>'Cash in Hand','amount'=>520000],
        ['label'=>'Bank Balance','amount'=>450000],
        ['label'=>'Customer Receivables','amount'=>2179500],
        ['label'=>'Property / Units Stock','amount'=>8050000],
    ];
    $data['liabilities'] = [
        ['label'=>'Bank Loan','amount'=>1200000],
        ['label'=>'Contractor Payables','amount'=>280000],
        ['label'=>'Customer Advances','amount'=>600000],
    ];
    $data['equity'] = [
        ['label'=>'Capital Account','amount'=>8949500],
        ['label'=>'Retained Earnings','amount'=>170000],
    ];
    return view('reports/balance_sheet', $data);
}



}