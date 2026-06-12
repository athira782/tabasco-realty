<?php ob_start() ?>

<nav aria-label="breadcrumb" class="mb-3">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?= site_url('dashboard') ?>" style="color:#e65c00;">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="<?= site_url('reports') ?>" style="color:#e65c00;">Reports</a></li>
    <li class="breadcrumb-item active" style="color:var(--text-muted);">Availability Report</li>
  </ol>
</nav>

<div class="d-flex justify-content-between align-items-center mb-4">
  <div>
    <h4 class="fw-bold mb-1" style="color:var(--text-primary);">Availability Report</h4>
    <p class="mb-0" style="color:var(--text-muted);font-size:14px;">Units by project, floor, type and status</p>
  </div>
  <div class="d-flex gap-2">
    <button class="btn btn-sm" style="background:#e65c00;color:#fff;border-radius:8px;"><i class="bi bi-file-earmark-excel me-1"></i>Excel</button>
    <button class="btn btn-sm btn-outline-secondary" style="border-radius:8px;"><i class="bi bi-file-earmark-pdf me-1"></i>PDF</button>
    <button class="btn btn-sm btn-outline-secondary" style="border-radius:8px;"><i class="bi bi-printer me-1"></i>Print</button>
  </div>
</div>

<!-- Filters -->
<div class="card border-0 shadow-sm mb-4" style="border-radius:14px;border:1px solid #e65c00 !important;">
  <div class="card-body">
    <div class="row g-2">
      <div class="col-6 col-md-2">
        <select class="form-select form-select-sm">
          <option>All Projects</option>
          <option>Tabasco Heights</option>
          <option>Tabasco Residency</option>
        </select>
      </div>
      <div class="col-6 col-md-2">
        <select class="form-select form-select-sm">
          <option>All Floors</option>
          <option>Ground</option>
          <option>1st Floor</option>
          <option>Basement</option>
        </select>
      </div>
      <div class="col-6 col-md-2">
        <select class="form-select form-select-sm">
          <option>All Types</option>
          <option>Shop</option>
          <option>Flat</option>
          <option>Parking</option>
        </select>
      </div>
      <div class="col-6 col-md-2">
        <select class="form-select form-select-sm">
          <option>All Status</option>
          <option>Available</option>
          <option>Sold</option>
          <option>Hold</option>
        </select>
      </div>
      <div class="col-6 col-md-2">
        <input type="date" class="form-control form-control-sm">
      </div>
      <div class="col-6 col-md-2">
        <input type="date" class="form-control form-control-sm">
      </div>
      <div class="col-12 d-flex gap-2 mt-1">
        <button class="btn btn-sm" style="background:#e65c00;color:#fff;border-radius:8px;"><i class="bi bi-funnel me-1"></i>Apply</button>
        <button class="btn btn-sm btn-outline-secondary" style="border-radius:8px;"><i class="bi bi-x-circle me-1"></i>Reset</button>
      </div>
    </div>
  </div>
</div>

<!-- Stats -->
<div class="row g-3 mb-4">
  <div class="col-6 col-md-3">
    <div class="card border-0 shadow-sm" style="border-radius:14px;border:1px solid #e65c00 !important;">
      <div class="card-body d-flex align-items-center gap-3">
        <div class="d-flex align-items-center justify-content-center rounded-circle" style="width:48px;height:48px;background:#fff0e0;flex-shrink:0;">
          <i class="bi bi-building" style="font-size:22px;color:#e65c00;"></i>
        </div>
        <div>
          <p class="small mb-0" style="font-size:12px;color:var(--text-muted);">Total Units</p>
          <h5 class="fw-bold mb-0" style="color:var(--text-primary);">6</h5>
        </div>
      </div>
    </div>
  </div>
  <div class="col-6 col-md-3">
    <div class="card border-0 shadow-sm" style="border-radius:14px;border:1px solid #e65c00 !important;">
      <div class="card-body d-flex align-items-center gap-3">
        <div class="d-flex align-items-center justify-content-center rounded-circle" style="width:48px;height:48px;background:#dcfce7;flex-shrink:0;">
          <i class="bi bi-check-circle" style="font-size:22px;color:#16a34a;"></i>
        </div>
        <div>
          <p class="small mb-0" style="font-size:12px;color:var(--text-muted);">Available</p>
          <h5 class="fw-bold mb-0" style="color:var(--text-primary);">3</h5>
        </div>
      </div>
    </div>
  </div>
  <div class="col-6 col-md-3">
    <div class="card border-0 shadow-sm" style="border-radius:14px;border:1px solid #e65c00 !important;">
      <div class="card-body d-flex align-items-center gap-3">
        <div class="d-flex align-items-center justify-content-center rounded-circle" style="width:48px;height:48px;background:#fee2e2;flex-shrink:0;">
          <i class="bi bi-x-circle" style="font-size:22px;color:#dc2626;"></i>
        </div>
        <div>
          <p class="small mb-0" style="font-size:12px;color:var(--text-muted);">Sold</p>
          <h5 class="fw-bold mb-0" style="color:var(--text-primary);">2</h5>
        </div>
      </div>
    </div>
  </div>
  <div class="col-6 col-md-3">
    <div class="card border-0 shadow-sm" style="border-radius:14px;border:1px solid #e65c00 !important;">
      <div class="card-body d-flex align-items-center gap-3">
        <div class="d-flex align-items-center justify-content-center rounded-circle" style="width:48px;height:48px;background:#fef9c3;flex-shrink:0;">
          <i class="bi bi-pause-circle" style="font-size:22px;color:#a16207;"></i>
        </div>
        <div>
          <p class="small mb-0" style="font-size:12px;color:var(--text-muted);">Hold</p>
          <h5 class="fw-bold mb-0" style="color:var(--text-primary);">1</h5>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Table -->
<div class="card border-0 shadow-sm mb-4" style="border-radius:14px;border:1px solid #e65c00 !important;">
  <div class="card-body p-0">
    <div class="table-responsive">
      <table class="table table-hover mb-0">
        <thead>
          <tr style="background:#e65c00;">
            <th style="color:#000;padding:12px;">#</th>
            <th style="color:#000;padding:12px;">Project</th>
            <th style="color:#000;padding:12px;">Floor</th>
            <th style="color:#000;padding:12px;">Unit No</th>
            <th style="color:#000;padding:12px;">Type</th>
            <th style="color:#000;padding:12px;">Area (Sqft)</th>
            <th style="color:#000;padding:12px;">Base Price</th>
            <th style="color:#000;padding:12px;">Status</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td style="color:var(--text-primary);padding:12px;">1</td>
            <td style="color:var(--text-primary);padding:12px;">Tabasco Heights</td>
            <td style="color:var(--text-primary);padding:12px;">Ground</td>
            <td style="color:var(--text-primary);padding:12px;">G-01</td>
            <td style="color:var(--text-primary);padding:12px;">Shop</td>
            <td style="color:var(--text-primary);padding:12px;">450</td>
            <td style="color:var(--text-primary);padding:12px;">₹22,50,000</td>
            <td style="padding:12px;"><span class="badge" style="background:#dcfce7;color:#16a34a;">Available</span></td>
          </tr>
          <tr>
            <td style="color:var(--text-primary);padding:12px;">2</td>
            <td style="color:var(--text-primary);padding:12px;">Tabasco Heights</td>
            <td style="color:var(--text-primary);padding:12px;">Ground</td>
            <td style="color:var(--text-primary);padding:12px;">G-02</td>
            <td style="color:var(--text-primary);padding:12px;">Shop</td>
            <td style="color:var(--text-primary);padding:12px;">380</td>
            <td style="color:var(--text-primary);padding:12px;">₹19,00,000</td>
            <td style="padding:12px;"><span class="badge" style="background:#fee2e2;color:#dc2626;">Sold</span></td>
          </tr>
          <tr>
            <td style="color:var(--text-primary);padding:12px;">3</td>
            <td style="color:var(--text-primary);padding:12px;">Tabasco Residency</td>
            <td style="color:var(--text-primary);padding:12px;">1st Floor</td>
            <td style="color:var(--text-primary);padding:12px;">101</td>
            <td style="color:var(--text-primary);padding:12px;">Flat</td>
            <td style="color:var(--text-primary);padding:12px;">1200</td>
            <td style="color:var(--text-primary);padding:12px;">₹60,00,000</td>
            <td style="padding:12px;"><span class="badge" style="background:#dcfce7;color:#16a34a;">Available</span></td>
          </tr>
          <tr>
            <td style="color:var(--text-primary);padding:12px;">4</td>
            <td style="color:var(--text-primary);padding:12px;">Tabasco Residency</td>
            <td style="color:var(--text-primary);padding:12px;">1st Floor</td>
            <td style="color:var(--text-primary);padding:12px;">102</td>
            <td style="color:var(--text-primary);padding:12px;">Flat</td>
            <td style="color:var(--text-primary);padding:12px;">1100</td>
            <td style="color:var(--text-primary);padding:12px;">₹55,00,000</td>
            <td style="padding:12px;"><span class="badge" style="background:#fef9c3;color:#a16207;">Hold</span></td>
          </tr>
          <tr>
            <td style="color:var(--text-primary);padding:12px;">5</td>
            <td style="color:var(--text-primary);padding:12px;">Tabasco Residency</td>
            <td style="color:var(--text-primary);padding:12px;">Basement</td>
            <td style="color:var(--text-primary);padding:12px;">P-01</td>
            <td style="color:var(--text-primary);padding:12px;">Parking</td>
            <td style="color:var(--text-primary);padding:12px;">120</td>
            <td style="color:var(--text-primary);padding:12px;">₹3,00,000</td>
            <td style="padding:12px;"><span class="badge" style="background:#dcfce7;color:#16a34a;">Available</span></td>
          </tr>
          <tr>
            <td style="color:var(--text-primary);padding:12px;">6</td>
            <td style="color:var(--text-primary);padding:12px;">Tabasco Residency</td>
            <td style="color:var(--text-primary);padding:12px;">Basement</td>
            <td style="color:var(--text-primary);padding:12px;">P-02</td>
            <td style="color:var(--text-primary);padding:12px;">Parking</td>
            <td style="color:var(--text-primary);padding:12px;">120</td>
            <td style="color:var(--text-primary);padding:12px;">₹3,00,000</td>
            <td style="padding:12px;"><span class="badge" style="background:#fee2e2;color:#dc2626;">Sold</span></td>
          </tr>
          <tr style="background:#e65c00;">
            <td colspan="5" style="color:#000;padding:12px;font-weight:bold;">Total</td>
            <td style="color:#000;padding:12px;font-weight:bold;">3,370 Sqft</td>
            <td style="color:#000;padding:12px;font-weight:bold;">₹1,62,50,000</td>
            <td style="padding:12px;"></td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>

<a href="<?= site_url('reports') ?>" class="btn btn-sm btn-outline-secondary" style="border-radius:8px;">
  <i class="bi bi-arrow-left me-1"></i>Back to Reports
</a>

<?php $content = ob_get_clean() ?>
<?= view('layouts/main', ['content' => $content, 'title' => 'Availability Report']) ?>