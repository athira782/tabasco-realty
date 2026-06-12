<?php ob_start() ?>

<!-- ─── BREADCRUMB ─── -->
<nav aria-label="breadcrumb" class="mb-3" style="font-size: 14px;">
    <ol class="breadcrumb mb-0">
        <li class="breadcrumb-item"><a href="<?= site_url('dashboard') ?>" style="color: var(--text-muted); text-decoration: none;">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page" style="color: var(--text-primary);">Sales Register</li>
    </ol>
</nav>

<!-- ─── HEADER ─── -->
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0" style="color: var(--text-primary);">Sales Register</h4>
    <?php if (hasPermission('sales', 'create')): ?>
    <a href="<?= site_url('sales/create') ?>" class="btn"
        style="background: linear-gradient(135deg, #ff7a00, #e65c00); color: #fff; border: none; border-radius: 10px; padding: 10px 22px; font-weight: 600; font-size: 14px;">
        <i class="bi bi-plus-lg me-1"></i> New Sale
    </a>
    <?php endif; ?>
</div>

<!-- ─── STATS CARDS ─── -->
<div class="row g-3 mb-4">
    <div class="col-6 col-md-3">
        <div class="card border-0 shadow-sm h-100" style="border-radius: 14px; border-left: 4px solid #e65c00 !important;">
            <div class="card-body">
                <p class="text-muted small mb-1" style="font-size: 12px;">Total Sales</p>
                <h5 class="fw-bold mb-0" style="color: var(--text-primary);"><?= number_format($stats['total_sales']) ?></h5>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card border-0 shadow-sm h-100" style="border-radius: 14px; border-left: 4px solid #0369a1 !important;">
            <div class="card-body">
                <p class="text-muted small mb-1" style="font-size: 12px;">Total Value</p>
                <h5 class="fw-bold mb-0" style="color: var(--text-primary);">₹<?= number_format($stats['total_value']) ?></h5>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card border-0 shadow-sm h-100" style="border-radius: 14px; border-left: 4px solid #16a34a !important;">
            <div class="card-body">
                <p class="text-muted small mb-1" style="font-size: 12px;">This Month</p>
                <h5 class="fw-bold mb-0" style="color: var(--text-primary);">₹<?= number_format($stats['this_month']) ?></h5>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card border-0 shadow-sm h-100" style="border-radius: 14px; border-left: 4px solid #dc2626 !important;">
            <div class="card-body">
                <p class="text-muted small mb-1" style="font-size: 12px;">Cancelled</p>
                <h5 class="fw-bold mb-0" style="color: var(--text-primary);"><?= number_format($stats['cancelled']) ?></h5>
            </div>
        </div>
    </div>
</div>

<!-- ─── FILTERS ─── -->
<div class="card border-0 shadow-sm mb-4" style="border-radius: 14px;">
    <div class="card-body">
        <form method="GET" action="<?= site_url('sales') ?>" class="row g-2 align-items-end">
            <div class="col-md-2">
                <label class="form-label small fw-semibold" style="font-size: 12px; color: var(--text-muted);">Project</label>
                <select name="project_id" class="form-select form-select-sm" style="border-radius: 8px;">
                    <option value="">All Projects</option>
                    <?php foreach ($projects as $p): ?>
                    <option value="<?= esc($p['id']) ?>" <?= ($filters['project_id'] ?? '') === $p['id'] ? 'selected' : '' ?>><?= esc($p['name']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-2">
                <label class="form-label small fw-semibold" style="font-size: 12px; color: var(--text-muted);">Unit Type</label>
                <select name="unit_type" class="form-select form-select-sm" style="border-radius: 8px;">
                    <option value="">All Types</option>
                    <option value="shop" <?= ($filters['unit_type'] ?? '') === 'shop' ? 'selected' : '' ?>>Shop</option>
                    <option value="flat" <?= ($filters['unit_type'] ?? '') === 'flat' ? 'selected' : '' ?>>Flat</option>
                    <option value="parking" <?= ($filters['unit_type'] ?? '') === 'parking' ? 'selected' : '' ?>>Parking</option>
                </select>
            </div>
            <div class="col-md-2">
                <label class="form-label small fw-semibold" style="font-size: 12px; color: var(--text-muted);">Status</label>
                <select name="sale_status" class="form-select form-select-sm" style="border-radius: 8px;">
                    <option value="">All Status</option>
                    <option value="booked" <?= ($filters['sale_status'] ?? '') === 'booked' ? 'selected' : '' ?>>Booked</option>
                    <option value="agreement" <?= ($filters['sale_status'] ?? '') === 'agreement' ? 'selected' : '' ?>>Agreement</option>
                    <option value="registered" <?= ($filters['sale_status'] ?? '') === 'registered' ? 'selected' : '' ?>>Registered</option>
                    <option value="cancelled" <?= ($filters['sale_status'] ?? '') === 'cancelled' ? 'selected' : '' ?>>Cancelled</option>
                </select>
            </div>
            <div class="col-md-2">
                <label class="form-label small fw-semibold" style="font-size: 12px; color: var(--text-muted);">Customer</label>
                <input type="text" name="customer_search" class="form-control form-control-sm" placeholder="Search customer..." style="border-radius: 8px;" value="<?= esc($filters['customer_search'] ?? '') ?>">
            </div>
            <div class="col-md-2">
                <label class="form-label small fw-semibold" style="font-size: 12px; color: var(--text-muted);">Date From</label>
                <input type="date" name="date_from" class="form-control form-control-sm" style="border-radius: 8px;" value="<?= esc($filters['date_from'] ?? '') ?>">
            </div>
            <div class="col-md-2">
                <label class="form-label small fw-semibold" style="font-size: 12px; color: var(--text-muted);">Date To</label>
                <input type="date" name="date_to" class="form-control form-control-sm" style="border-radius: 8px;" value="<?= esc($filters['date_to'] ?? '') ?>">
            </div>
            <div class="col-md-2">
                <label class="form-label small fw-semibold" style="font-size: 12px; color: var(--text-muted);">Sqft (Min)</label>
                <input type="number" name="sqft_min" class="form-control form-control-sm" placeholder="Min" style="border-radius: 8px;" value="<?= esc($filters['sqft_min'] ?? '') ?>">
            </div>
            <div class="col-md-2">
                <label class="form-label small fw-semibold" style="font-size: 12px; color: var(--text-muted);">Sqft (Max)</label>
                <input type="number" name="sqft_max" class="form-control form-control-sm" placeholder="Max" style="border-radius: 8px;" value="<?= esc($filters['sqft_max'] ?? '') ?>">
            </div>
            <div class="col-md-2">
                <label class="form-label small fw-semibold" style="font-size: 12px; color: var(--text-muted);">Broker</label>
                <select name="broker_id" class="form-select form-select-sm" style="border-radius: 8px;">
                    <option value="">All Brokers</option>
                    <?php foreach ($brokers as $b): ?>
                    <option value="<?= esc($b['id']) ?>" <?= ($filters['broker_id'] ?? '') === $b['id'] ? 'selected' : '' ?>><?= esc($b['name']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-12 d-flex gap-2 mt-2">
                <button type="submit" class="btn btn-sm px-3" style="background: #e65c00; color: #fff; border-radius: 8px; font-weight: 600;">
                    <i class="bi bi-funnel me-1"></i> Apply Filters
                </button>
                <a href="<?= site_url('sales') ?>" class="btn btn-sm btn-outline-secondary px-3" style="border-radius: 8px;">
                    <i class="bi bi-x-lg me-1"></i> Clear
                </a>
            </div>
        </form>
    </div>
</div>

<!-- ─── TABLE ─── -->
<div class="card border-0 shadow-sm" style="border-radius: 14px; overflow: hidden;">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0" style="font-size: 13px;">
            <thead class="table-light">
                <tr>
                    <th style="color: var(--text-muted); font-weight: 600;">Sale No</th>
                    <th style="color: var(--text-muted); font-weight: 600;">Project</th>
                    <th style="color: var(--text-muted); font-weight: 600;">Floor</th>
                    <th style="color: var(--text-muted); font-weight: 600;">Unit</th>
                    <th style="color: var(--text-muted); font-weight: 600;">Type</th>
                    <th style="color: var(--text-muted); font-weight: 600;">Sqft</th>
                    <th style="color: var(--text-muted); font-weight: 600;">Rate/Sqft</th>
                    <th style="color: var(--text-muted); font-weight: 600;">Sale Amount</th>
                    <th style="color: var(--text-muted); font-weight: 600;">GST</th>
                    <th style="color: var(--text-muted); font-weight: 600;">Final</th>
                    <th style="color: var(--text-muted); font-weight: 600;">Customer</th>
                    <th style="color: var(--text-muted); font-weight: 600;">Broker</th>
                    <th style="color: var(--text-muted); font-weight: 600;">Agreement</th>
                    <th style="color: var(--text-muted); font-weight: 600;">Status</th>
                    <th style="color: var(--text-muted); font-weight: 600;">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($sales)): ?>
                <tr>
                    <td colspan="15" class="text-center py-5" style="color: var(--text-muted);">No sales found</td>
                </tr>
                <?php else: ?>
                <?php foreach ($sales as $sale): ?>
                <tr>
                    <td><strong style="color: var(--text-primary);"><?= esc($sale['sale_number']) ?></strong></td>
                    <td style="color: var(--text-primary);"><?= esc($sale['project_name'] ?? '-') ?></td>
                    <td style="color: var(--text-primary);"><?= esc($sale['floor_name'] ?? '-') ?></td>
                    <td style="color: var(--text-primary);"><?= esc($sale['unit_number'] ?? '-') ?></td>
                    <td><span class="badge" style="background: #fff0e0; color: #e65c00; font-weight: 500;"><?= esc($sale['unit_type'] ?? '-') ?></span></td>
                    <td style="color: var(--text-primary);"><?= number_format((float) ($sale['total_area_sqft'] ?? 0)) ?></td>
                    <td style="color: var(--text-primary);">₹<?= number_format((float) ($sale['sale_rate_sqft'] ?? 0), 2) ?></td>
                    <td style="color: var(--text-primary);">₹<?= number_format((float) ($sale['total_sale_amount'] ?? 0)) ?></td>
                    <td style="color: var(--text-primary);"><?= $sale['gst_included'] === 'no' ? number_format((float) ($sale['gst_amount'] ?? 0)) . ' (' . number_format((float) ($sale['gst_percent'] ?? 0)) . '%)' : 'Included' ?></td>
                    <td style="color: var(--text-primary); font-weight: 600;">₹<?= number_format((float) ($sale['final_amount'] ?? 0)) ?></td>
                    <td>
                        <span style="color: var(--text-primary);"><?= esc($sale['customer_name'] ?? '-') ?></span>
                        <br><small style="color: var(--text-muted);"><?= esc($sale['customer_phone'] ?? '') ?></small>
                    </td>
                    <td style="color: var(--text-primary);"><?= esc($sale['broker_name'] ?? '-') ?></td>
                    <td style="color: var(--text-primary);"><?= $sale['agreement_date'] ? date('d-m-Y', strtotime($sale['agreement_date'])) : '-' ?></td>
                    <td>
                        <?php
                        $status = $sale['sale_status'] ?? '';
                        $badgeClass = match($status) {
                            'booked'     => ['bg-warning', 'Booked'],
                            'agreement'  => ['bg-primary', 'Agreement'],
                            'registered' => ['bg-success', 'Registered'],
                            'cancelled'  => ['bg-danger', 'Cancelled'],
                            default      => ['bg-secondary', $status],
                        };
                        ?>
                        <span class="badge <?= $badgeClass[0] ?>" style="font-weight: 500;"><?= $badgeClass[1] ?></span>
                    </td>
                    <td>
                        <div class="dropdown">
                            <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" style="border-radius: 8px;">
                                <i class="bi bi-gear"></i>
                            </button>
                            <ul class="dropdown-menu" style="border-radius: 10px;">
                                <li><a class="dropdown-item" href="<?= site_url('sales/show/' . $sale['id']) ?>"><i class="bi bi-eye me-2" style="color: #e65c00;"></i>View</a></li>
                                <?php if (hasPermission('sales', 'edit') && $sale['sale_status'] !== 'cancelled'): ?>
                                <li><a class="dropdown-item" href="<?= site_url('sales/edit/' . $sale['id']) ?>"><i class="bi bi-pencil me-2" style="color: #0369a1;"></i>Edit</a></li>
                                <?php endif; ?>
                                <?php if (hasPermission('sales', 'edit') && $sale['sale_status'] !== 'cancelled'): ?>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form method="POST" action="<?= site_url('sales/cancel/' . $sale['id']) ?>" onsubmit="return confirm('Cancel this sale? Unit will be marked available.')">
                                        <?= csrf_field() ?>
                                        <button type="submit" class="dropdown-item text-danger"><i class="bi bi-x-circle me-2"></i>Cancel</button>
                                    </form>
                                </li>
                                <?php endif; ?>
                                <li><a class="dropdown-item" href="<?= site_url('sales/print/' . $sale['id']) ?>" target="_blank"><i class="bi bi-printer me-2" style="color: #16a34a;"></i>Print</a></li>
                            </ul>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php $content = ob_get_clean() ?>
<?= view('layouts/main', ['content' => $content, 'title' => 'Sales Register']) ?>