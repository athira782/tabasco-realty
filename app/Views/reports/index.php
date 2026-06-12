<?php ob_start() ?>

<!-- Breadcrumb -->
<nav aria-label="breadcrumb" class="mb-3">
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="<?= site_url('dashboard') ?>"
         style="color:#e65c00;">Dashboard</a>
    </li>
    <li class="breadcrumb-item active"
        style="color:var(--text-muted);">Reports</li>
  </ol>
</nav>

<!-- Page Header -->
<div class="d-flex justify-content-between
            align-items-center mb-4">
  <div>
    <h4 class="fw-bold mb-1"
        style="color:var(--text-primary);">
      Reports & MIS
    </h4>
    <p class="mb-0"
       style="color:var(--text-muted);font-size:14px;">
      View and export all business reports
    </p>
  </div>
</div>

<!-- Summary Stats -->
<div class="row g-3 mb-4">
  <!-- Total Reports -->
  <div class="col-6 col-md-3">
    <div class="card border-0 shadow-sm"
         style="border-radius:14px;
                border:1px solid #e65c00 !important;">
      <div class="card-body d-flex align-items-center gap-3">
        <div class="d-flex align-items-center
                    justify-content-center rounded-circle"
             style="width:48px;height:48px;
                    background:#fff0e0;flex-shrink:0;">
          <i class="bi bi-file-earmark-bar-graph"
             style="font-size:22px;color:#e65c00;"></i>
        </div>
        <div>
          <p class="small mb-0"
             style="font-size:12px;
                    color:var(--text-muted);">
            Total Reports
          </p>
          <h5 class="fw-bold mb-0"
              style="color:var(--text-primary);">14</h5>
        </div>
      </div>
    </div>
  </div>
  <!-- Property Reports -->
  <div class="col-6 col-md-3">
    <div class="card border-0 shadow-sm"
         style="border-radius:14px;
                border:1px solid #e65c00 !important;">
      <div class="card-body d-flex align-items-center gap-3">
        <div class="d-flex align-items-center
                    justify-content-center rounded-circle"
             style="width:48px;height:48px;
                    background:#fff0e0;flex-shrink:0;">
          <i class="bi bi-house-check"
             style="font-size:22px;color:#e65c00;"></i>
        </div>
        <div>
          <p class="small mb-0"
             style="font-size:12px;
                    color:var(--text-muted);">
            Property Reports
          </p>
          <h5 class="fw-bold mb-0"
              style="color:var(--text-primary);">4</h5>
        </div>
      </div>
    </div>
  </div>
  <!-- Financial Reports -->
  <div class="col-6 col-md-3">
    <div class="card border-0 shadow-sm"
         style="border-radius:14px;
                border:1px solid #e65c00 !important;">
      <div class="card-body d-flex align-items-center gap-3">
        <div class="d-flex align-items-center
                    justify-content-center rounded-circle"
             style="width:48px;height:48px;
                    background:#fff0e0;flex-shrink:0;">
          <i class="bi bi-cash-coin"
             style="font-size:22px;color:#e65c00;"></i>
        </div>
        <div>
          <p class="small mb-0"
             style="font-size:12px;
                    color:var(--text-muted);">
            Financial Reports
          </p>
          <h5 class="fw-bold mb-0"
              style="color:var(--text-primary);">6</h5>
        </div>
      </div>
    </div>
  </div>
  <!-- Accounting Reports -->
  <div class="col-6 col-md-3">
    <div class="card border-0 shadow-sm"
         style="border-radius:14px;
                border:1px solid #e65c00 !important;">
      <div class="card-body d-flex align-items-center gap-3">
        <div class="d-flex align-items-center
                    justify-content-center rounded-circle"
             style="width:48px;height:48px;
                    background:#fff0e0;flex-shrink:0;">
          <i class="bi bi-clipboard-data"
             style="font-size:22px;color:#e65c00;"></i>
        </div>
        <div>
          <p class="small mb-0"
             style="font-size:12px;
                    color:var(--text-muted);">
            Accounting Reports
          </p>
          <h5 class="fw-bold mb-0"
              style="color:var(--text-primary);">4</h5>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- GROUP 1: Property Reports -->
<div class="d-flex align-items-center mb-3"
     style="border-left:4px solid #e65c00;
            padding-left:12px;">
  <div>
    <h5 class="fw-bold mb-0"
        style="color:var(--text-primary);">
      Property Reports
    </h5>
    <small style="color:var(--text-muted);">
      4 reports available
    </small>
  </div>
</div>
<div class="row g-3 mb-4">
  <!-- Availability Report -->
  <div class="col-6 col-md-4 col-lg-3">
    <a href="<?= site_url('reports/availability') ?>"
       class="text-decoration-none">
      <div class="card border-0 shadow-sm h-100"
           style="border-radius:14px;
                  border:1px solid #e65c00 !important;
                  transition:transform 0.15s,box-shadow 0.15s;"
           onmouseover="this.style.transform='translateY(-4px)';
                        this.style.boxShadow='0 8px 24px rgba(230,92,0,0.15)';"
           onmouseout="this.style.transform='';
                       this.style.boxShadow='';">
        <div class="card-body text-center py-4">
          <div class="d-flex align-items-center
                      justify-content-center rounded-circle
                      mx-auto mb-3"
               style="width:56px;height:56px;
                      background:#fff0e0;">
            <i class="bi bi-house-check"
               style="font-size:26px;color:#e65c00;"></i>
          </div>
          <h6 class="fw-bold mb-1"
              style="color:var(--text-primary);font-size:14px;">
            Availability Report
          </h6>
          <p class="mb-2"
             style="color:var(--text-muted);font-size:12px;">
            Units by project, floor, type and status
          </p>
          <span style="font-size:12px;color:#e65c00;
                       font-weight:600;">
            View Report &rarr;
          </span>
        </div>
      </div>
    </a>
  </div>
  <!-- Sales Report -->
  <div class="col-6 col-md-4 col-lg-3">
    <a href="<?= site_url('reports/sales') ?>"
       class="text-decoration-none">
      <div class="card border-0 shadow-sm h-100"
           style="border-radius:14px;
                  border:1px solid #e65c00 !important;
                  transition:transform 0.15s,box-shadow 0.15s;"
           onmouseover="this.style.transform='translateY(-4px)';
                        this.style.boxShadow='0 8px 24px rgba(230,92,0,0.15)';"
           onmouseout="this.style.transform='';
                       this.style.boxShadow='';">
        <div class="card-body text-center py-4">
          <div class="d-flex align-items-center
                      justify-content-center rounded-circle
                      mx-auto mb-3"
               style="width:56px;height:56px;
                      background:#fff0e0;">
            <i class="bi bi-cart-check"
               style="font-size:26px;color:#e65c00;"></i>
          </div>
          <h6 class="fw-bold mb-1"
              style="color:var(--text-primary);font-size:14px;">
            Sales Report
          </h6>
          <p class="mb-2"
             style="color:var(--text-muted);font-size:12px;">
            Commercial, apartments and parking sales
          </p>
          <span style="font-size:12px;color:#e65c00;
                       font-weight:600;">
            View Report &rarr;
          </span>
        </div>
      </div>
    </a>
  </div>
  <!-- Sales Return -->
  <div class="col-6 col-md-4 col-lg-3">
    <a href="<?= site_url('reports/sales-return') ?>"
       class="text-decoration-none">
      <div class="card border-0 shadow-sm h-100"
           style="border-radius:14px;
                  border:1px solid #e65c00 !important;
                  transition:transform 0.15s,box-shadow 0.15s;"
           onmouseover="this.style.transform='translateY(-4px)';
                        this.style.boxShadow='0 8px 24px rgba(230,92,0,0.15)';"
           onmouseout="this.style.transform='';
                       this.style.boxShadow='';">
        <div class="card-body text-center py-4">
          <div class="d-flex align-items-center
                      justify-content-center rounded-circle
                      mx-auto mb-3"
               style="width:56px;height:56px;
                      background:#fff0e0;">
            <i class="bi bi-arrow-return-left"
               style="font-size:26px;color:#e65c00;"></i>
          </div>
          <h6 class="fw-bold mb-1"
              style="color:var(--text-primary);font-size:14px;">
            Sales Return Report
          </h6>
          <p class="mb-2"
             style="color:var(--text-muted);font-size:12px;">
            Cancelled and returned sales
          </p>
          <span style="font-size:12px;color:#e65c00;
                       font-weight:600;">
            View Report &rarr;
          </span>
        </div>
      </div>
    </a>
  </div>
  <!-- Exchange Report -->
  <div class="col-6 col-md-4 col-lg-3">
    <a href="<?= site_url('reports/exchange') ?>"
       class="text-decoration-none">
      <div class="card border-0 shadow-sm h-100"
           style="border-radius:14px;
                  border:1px solid #e65c00 !important;
                  transition:transform 0.15s,box-shadow 0.15s;"
           onmouseover="this.style.transform='translateY(-4px)';
                        this.style.boxShadow='0 8px 24px rgba(230,92,0,0.15)';"
           onmouseout="this.style.transform='';
                       this.style.boxShadow='';">
        <div class="card-body text-center py-4">
          <div class="d-flex align-items-center
                      justify-content-center rounded-circle
                      mx-auto mb-3"
               style="width:56px;height:56px;
                      background:#fff0e0;">
            <i class="bi bi-arrow-left-right"
               style="font-size:26px;color:#e65c00;"></i>
          </div>
          <h6 class="fw-bold mb-1"
              style="color:var(--text-primary);font-size:14px;">
            Exchange Report
          </h6>
          <p class="mb-2"
             style="color:var(--text-muted);font-size:12px;">
            Unit exchange transactions
          </p>
          <span style="font-size:12px;color:#e65c00;
                       font-weight:600;">
            View Report &rarr;
          </span>
        </div>
      </div>
    </a>
  </div>
</div>

<!-- GROUP 2: Financial Reports -->
<div class="d-flex align-items-center mb-3"
     style="border-left:4px solid #e65c00;
            padding-left:12px;">
  <div>
    <h5 class="fw-bold mb-0"
        style="color:var(--text-primary);">
      Financial Reports
    </h5>
    <small style="color:var(--text-muted);">
      6 reports available
    </small>
  </div>
</div>
<div class="row g-3 mb-4">
  <!-- EMI Collections -->
  <div class="col-6 col-md-4 col-lg-3">
    <a href="<?= site_url('reports/emi-collections') ?>"
       class="text-decoration-none">
      <div class="card border-0 shadow-sm h-100"
           style="border-radius:14px;
                  border:1px solid #e65c00 !important;
                  transition:transform 0.15s,box-shadow 0.15s;"
           onmouseover="this.style.transform='translateY(-4px)';
                        this.style.boxShadow='0 8px 24px rgba(230,92,0,0.15)';"
           onmouseout="this.style.transform='';
                       this.style.boxShadow='';">
        <div class="card-body text-center py-4">
          <div class="d-flex align-items-center
                      justify-content-center rounded-circle
                      mx-auto mb-3"
               style="width:56px;height:56px;
                      background:#fff0e0;">
            <i class="bi bi-cash-coin"
               style="font-size:26px;color:#e65c00;"></i>
          </div>
          <h6 class="fw-bold mb-1"
              style="color:var(--text-primary);font-size:14px;">
            EMI & Collection Report
          </h6>
          <p class="mb-2"
             style="color:var(--text-muted);font-size:12px;">
            EMI schedules and payment collections
          </p>
          <span style="font-size:12px;color:#e65c00;
                       font-weight:600;">
            View Report &rarr;
          </span>
        </div>
      </div>
    </a>
  </div>
  <!-- Customer Ledger -->
  <div class="col-6 col-md-4 col-lg-3">
    <a href="<?= site_url('reports/customer-ledger') ?>"
       class="text-decoration-none">
      <div class="card border-0 shadow-sm h-100"
           style="border-radius:14px;
                  border:1px solid #e65c00 !important;
                  transition:transform 0.15s,box-shadow 0.15s;"
           onmouseover="this.style.transform='translateY(-4px)';
                        this.style.boxShadow='0 8px 24px rgba(230,92,0,0.15)';"
           onmouseout="this.style.transform='';
                       this.style.boxShadow='';">
        <div class="card-body text-center py-4">
          <div class="d-flex align-items-center
                      justify-content-center rounded-circle
                      mx-auto mb-3"
               style="width:56px;height:56px;
                      background:#fff0e0;">
            <i class="bi bi-person-lines-fill"
               style="font-size:26px;color:#e65c00;"></i>
          </div>
          <h6 class="fw-bold mb-1"
              style="color:var(--text-primary);font-size:14px;">
            Customer Ledger
          </h6>
          <p class="mb-2"
             style="color:var(--text-muted);font-size:12px;">
            Customer account statements
          </p>
          <span style="font-size:12px;color:#e65c00;
                       font-weight:600;">
            View Report &rarr;
          </span>
        </div>
      </div>
    </a>
  </div>
  <!-- Cash Book -->
  <div class="col-6 col-md-4 col-lg-3">
    <a href="<?= site_url('reports/cash-book') ?>"
       class="text-decoration-none">
      <div class="card border-0 shadow-sm h-100"
           style="border-radius:14px;
                  border:1px solid #e65c00 !important;
                  transition:transform 0.15s,box-shadow 0.15s;"
           onmouseover="this.style.transform='translateY(-4px)';
                        this.style.boxShadow='0 8px 24px rgba(230,92,0,0.15)';"
           onmouseout="this.style.transform='';
                       this.style.boxShadow='';">
        <div class="card-body text-center py-4">
          <div class="d-flex align-items-center
                      justify-content-center rounded-circle
                      mx-auto mb-3"
               style="width:56px;height:56px;
                      background:#fff0e0;">
            <i class="bi bi-journal-cash"
               style="font-size:26px;color:#e65c00;"></i>
          </div>
          <h6 class="fw-bold mb-1"
              style="color:var(--text-primary);font-size:14px;">
            Cash Book
          </h6>
          <p class="mb-2"
             style="color:var(--text-muted);font-size:12px;">
            Daily cash receipts and payments
          </p>
          <span style="font-size:12px;color:#e65c00;
                       font-weight:600;">
            View Report &rarr;
          </span>
        </div>
      </div>
    </a>
  </div>
  <!-- Bank Reports -->
  <div class="col-6 col-md-4 col-lg-3">
    <a href="<?= site_url('reports/bank-reports') ?>"
       class="text-decoration-none">
      <div class="card border-0 shadow-sm h-100"
           style="border-radius:14px;
                  border:1px solid #e65c00 !important;
                  transition:transform 0.15s,box-shadow 0.15s;"
           onmouseover="this.style.transform='translateY(-4px)';
                        this.style.boxShadow='0 8px 24px rgba(230,92,0,0.15)';"
           onmouseout="this.style.transform='';
                       this.style.boxShadow='';">
        <div class="card-body text-center py-4">
          <div class="d-flex align-items-center
                      justify-content-center rounded-circle
                      mx-auto mb-3"
               style="width:56px;height:56px;
                      background:#fff0e0;">
            <i class="bi bi-bank"
               style="font-size:26px;color:#e65c00;"></i>
          </div>
          <h6 class="fw-bold mb-1"
              style="color:var(--text-primary);font-size:14px;">
            Bank Reports
          </h6>
          <p class="mb-2"
             style="color:var(--text-muted);font-size:12px;">
            Per bank and consolidated statements
          </p>
          <span style="font-size:12px;color:#e65c00;
                       font-weight:600;">
            View Report &rarr;
          </span>
        </div>
      </div>
    </a>
  </div>
  <!-- Petty Cash -->
  <div class="col-6 col-md-4 col-lg-3">
    <a href="<?= site_url('reports/petty-cash') ?>"
       class="text-decoration-none">
      <div class="card border-0 shadow-sm h-100"
           style="border-radius:14px;
                  border:1px solid #e65c00 !important;
                  transition:transform 0.15s,box-shadow 0.15s;"
           onmouseover="this.style.transform='translateY(-4px)';
                        this.style.boxShadow='0 8px 24px rgba(230,92,0,0.15)';"
           onmouseout="this.style.transform='';
                       this.style.boxShadow='';">
        <div class="card-body text-center py-4">
          <div class="d-flex align-items-center
                      justify-content-center rounded-circle
                      mx-auto mb-3"
               style="width:56px;height:56px;
                      background:#fff0e0;">
            <i class="bi bi-piggy-bank"
               style="font-size:26px;color:#e65c00;"></i>
          </div>
          <h6 class="fw-bold mb-1"
              style="color:var(--text-primary);font-size:14px;">
            Petty Cash Book
          </h6>
          <p class="mb-2"
             style="color:var(--text-muted);font-size:12px;">
            Small daily expense tracking
          </p>
          <span style="font-size:12px;color:#e65c00;
                       font-weight:600;">
            View Report &rarr;
          </span>
        </div>
      </div>
    </a>
  </div>
  <!-- Bank Loan EMI -->
  <div class="col-6 col-md-4 col-lg-3">
    <a href="<?= site_url('reports/bank-loan-emi') ?>"
       class="text-decoration-none">
      <div class="card border-0 shadow-sm h-100"
           style="border-radius:14px;
                  border:1px solid #e65c00 !important;
                  transition:transform 0.15s,box-shadow 0.15s;"
           onmouseover="this.style.transform='translateY(-4px)';
                        this.style.boxShadow='0 8px 24px rgba(230,92,0,0.15)';"
           onmouseout="this.style.transform='';
                       this.style.boxShadow='';">
        <div class="card-body text-center py-4">
          <div class="d-flex align-items-center
                      justify-content-center rounded-circle
                      mx-auto mb-3"
               style="width:56px;height:56px;
                      background:#fff0e0;">
            <i class="bi bi-calendar-check"
               style="font-size:26px;color:#e65c00;"></i>
          </div>
          <h6 class="fw-bold mb-1"
              style="color:var(--text-primary);font-size:14px;">
            Bank Loan EMI Schedule
          </h6>
          <p class="mb-2"
             style="color:var(--text-muted);font-size:12px;">
            Loan repayment schedules
          </p>
          <span style="font-size:12px;color:#e65c00;
                       font-weight:600;">
            View Report &rarr;
          </span>
        </div>
      </div>
    </a>
  </div>
</div>

<!-- GROUP 3: Accounting Reports -->
<div class="d-flex align-items-center mb-3"
     style="border-left:4px solid #e65c00;
            padding-left:12px;">
  <div>
    <h5 class="fw-bold mb-0"
        style="color:var(--text-primary);">
      Accounting Reports
    </h5>
    <small style="color:var(--text-muted);">
      4 reports available
    </small>
  </div>
</div>
<div class="row g-3 mb-4">
  <!-- Trial Balance -->
  <div class="col-6 col-md-4 col-lg-3">
    <a href="<?= site_url('reports/trial-balance') ?>"
       class="text-decoration-none">
      <div class="card border-0 shadow-sm h-100"
           style="border-radius:14px;
                  border:1px solid #e65c00 !important;
                  transition:transform 0.15s,box-shadow 0.15s;"
           onmouseover="this.style.transform='translateY(-4px)';
                        this.style.boxShadow='0 8px 24px rgba(230,92,0,0.15)';"
           onmouseout="this.style.transform='';
                       this.style.boxShadow='';">
        <div class="card-body text-center py-4">
          <div class="d-flex align-items-center
                      justify-content-center rounded-circle
                      mx-auto mb-3"
               style="width:56px;height:56px;
                      background:#fff0e0;">
            <i class="bi bi-scale"
               style="font-size:26px;color:#e65c00;"></i>
          </div>
          <h6 class="fw-bold mb-1"
              style="color:var(--text-primary);font-size:14px;">
            Trial Balance
          </h6>
          <p class="mb-2"
             style="color:var(--text-muted);font-size:12px;">
            Debit and credit account balances
          </p>
          <span style="font-size:12px;color:#e65c00;
                       font-weight:600;">
            View Report &rarr;
          </span>
        </div>
      </div>
    </a>
  </div>
  <!-- Profit & Loss -->
  <div class="col-6 col-md-4 col-lg-3">
    <a href="<?= site_url('reports/profit-loss') ?>"
       class="text-decoration-none">
      <div class="card border-0 shadow-sm h-100"
           style="border-radius:14px;
                  border:1px solid #e65c00 !important;
                  transition:transform 0.15s,box-shadow 0.15s;"
           onmouseover="this.style.transform='translateY(-4px)';
                        this.style.boxShadow='0 8px 24px rgba(230,92,0,0.15)';"
           onmouseout="this.style.transform='';
                       this.style.boxShadow='';">
        <div class="card-body text-center py-4">
          <div class="d-flex align-items-center
                      justify-content-center rounded-circle
                      mx-auto mb-3"
               style="width:56px;height:56px;
                      background:#fff0e0;">
            <i class="bi bi-graph-up-arrow"
               style="font-size:26px;color:#e65c00;"></i>
          </div>
          <h6 class="fw-bold mb-1"
              style="color:var(--text-primary);font-size:14px;">
            Profit & Loss
          </h6>
          <p class="mb-2"
             style="color:var(--text-muted);font-size:12px;">
            Income and expense summary
          </p>
          <span style="font-size:12px;color:#e65c00;
                       font-weight:600;">
            View Report &rarr;
          </span>
        </div>
      </div>
    </a>
  </div>
  <!-- Balance Sheet -->
  <div class="col-6 col-md-4 col-lg-3">
    <a href="<?= site_url('reports/balance-sheet') ?>"
       class="text-decoration-none">
      <div class="card border-0 shadow-sm h-100"
           style="border-radius:14px;
                  border:1px solid #e65c00 !important;
                  transition:transform 0.15s,box-shadow 0.15s;"
           onmouseover="this.style.transform='translateY(-4px)';
                        this.style.boxShadow='0 8px 24px rgba(230,92,0,0.15)';"
           onmouseout="this.style.transform='';
                       this.style.boxShadow='';">
        <div class="card-body text-center py-4">
          <div class="d-flex align-items-center
                      justify-content-center rounded-circle
                      mx-auto mb-3"
               style="width:56px;height:56px;
                      background:#fff0e0;">
            <i class="bi bi-clipboard-data"
               style="font-size:26px;color:#e65c00;"></i>
          </div>
          <h6 class="fw-bold mb-1"
              style="color:var(--text-primary);font-size:14px;">
            Balance Sheet Summary
          </h6>
          <p class="mb-2"
             style="color:var(--text-muted);font-size:12px;">
            Assets, liabilities and equity
          </p>
          <span style="font-size:12px;color:#e65c00;
                       font-weight:600;">
            View Report &rarr;
          </span>
        </div>
      </div>
    </a>
  </div>
  <!-- Supplier Statements -->
  <div class="col-6 col-md-4 col-lg-3">
    <a href="<?= site_url('reports/supplier-statements') ?>"
       class="text-decoration-none">
      <div class="card border-0 shadow-sm h-100"
           style="border-radius:14px;
                  border:1px solid #e65c00 !important;
                  transition:transform 0.15s,box-shadow 0.15s;"
           onmouseover="this.style.transform='translateY(-4px)';
                        this.style.boxShadow='0 8px 24px rgba(230,92,0,0.15)';"
           onmouseout="this.style.transform='';
                       this.style.boxShadow='';">
        <div class="card-body text-center py-4">
          <div class="d-flex align-items-center
                      justify-content-center rounded-circle
                      mx-auto mb-3"
               style="width:56px;height:56px;
                      background:#fff0e0;">
            <i class="bi bi-people"
               style="font-size:26px;color:#e65c00;"></i>
          </div>
          <h6 class="fw-bold mb-1"
              style="color:var(--text-primary);font-size:14px;">
            Supplier Statements
          </h6>
          <p class="mb-2"
             style="color:var(--text-muted);font-size:12px;">
            Supplier and contractor accounts
          </p>
          <span style="font-size:12px;color:#e65c00;
                       font-weight:600;">
            View Report &rarr;
          </span>
        </div>
      </div>
    </a>
  </div>
</div>

<?php $content = ob_get_clean() ?>
<?= view('layouts/main', [
    'content' => $content,
    'title'   => 'Reports & MIS'
]) ?>