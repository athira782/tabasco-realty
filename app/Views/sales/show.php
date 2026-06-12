<?php ob_start() ?>

<!-- ─── BREADCRUMB ─── -->
<nav aria-label="breadcrumb" class="mb-3" style="font-size: 14px;">
    <ol class="breadcrumb mb-0">
        <li class="breadcrumb-item"><a href="<?= site_url('dashboard') ?>" style="color: var(--text-muted); text-decoration: none;">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="<?= site_url('sales') ?>" style="color: var(--text-muted); text-decoration: none;">Sales</a></li>
        <li class="breadcrumb-item active" aria-current="page" style="color: var(--text-primary);">Sale #<?= esc($sale['sale_number']) ?></li>
    </ol>
</nav>

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-1" style="color: var(--text-primary);">Sale #<?= esc($sale['sale_number']) ?></h4>
        <small style="color: var(--text-muted);">Created by <?= esc($sale['created_by_name'] ?? 'N/A') ?> on <?= date('d-m-Y H:i', strtotime($sale['created_at'])) ?></small>
    </div>
    <div class="d-flex gap-2">
        <?php if (hasPermission('sales', 'edit') && $sale['sale_status'] !== 'cancelled'): ?>
        <a href="<?= site_url('sales/edit/' . $sale['id']) ?>" class="btn btn-outline-primary" style="border-radius: 10px; font-weight: 600;">
            <i class="bi bi-pencil me-1"></i> Edit
        </a>
        <?php endif; ?>
        <a href="<?= site_url('sales/print/' . $sale['id']) ?>" target="_blank" class="btn btn-outline-success" style="border-radius: 10px; font-weight: 600;">
            <i class="bi bi-printer me-1"></i> Print
        </a>
    </div>
</div>

<!-- Status badge -->
<div class="mb-4">
    <?php
    $status = $sale['sale_status'] ?? '';
    $badgeClass = match($status) {
        'booked'     => 'bg-warning text-dark',
        'agreement'  => 'bg-primary',
        'registered' => 'bg-success',
        'cancelled'  => 'bg-danger',
        default      => 'bg-secondary',
    };
    ?>
    <span class="badge <?= $badgeClass ?>" style="font-size: 14px; padding: 8px 18px; border-radius: 20px;">
        <i class="bi bi-info-circle me-1"></i> <?= ucfirst($status) ?>
    </span>
</div>

<!-- ─── PROPERTY DETAILS CARD ─── -->
<div class="card border-0 shadow-sm mb-4" style="border-radius: 14px;">
    <div class="card-header bg-transparent border-bottom-0 pt-4 pb-0 px-4">
        <h5 class="fw-bold mb-0" style="color: var(--text-primary);"><i class="bi bi-building me-2" style="color: #e65c00;"></i>Property Details</h5>
    </div>
    <div class="card-body px-4 py-4">
        <div class="row g-3">
            <div class="col-md-3"><small class="text-muted d-block">Project</small><strong style="color: var(--text-primary);"><?= esc($sale['project_name'] ?? '-') ?></strong></div>
            <div class="col-md-3"><small class="text-muted d-block">Location</small><strong style="color: var(--text-primary);"><?= esc($sale['project_location'] ?? '-') ?></strong></div>
            <div class="col-md-2"><small class="text-muted d-block">Floor</small><strong style="color: var(--text-primary);"><?= esc($sale['floor_name'] ?? '-') ?> (<?= esc($sale['floor_number'] ?? '-') ?>)</strong></div>
            <div class="col-md-2"><small class="text-muted d-block">Unit No.</small><strong style="color: var(--text-primary);"><?= esc($sale['unit_number'] ?? '-') ?></strong></div>
            <div class="col-md-2"><small class="text-muted d-block">Type</small><strong style="color: var(--text-primary);"><?= esc($sale['unit_type'] ?? '-') ?></strong></div>
        </div>
    </div>
</div>

<!-- ─── CUSTOMER CARD ─── -->
<div class="card border-0 shadow-sm mb-4" style="border-radius: 14px;">
    <div class="card-header bg-transparent border-bottom-0 pt-4 pb-0 px-4">
        <h5 class="fw-bold mb-0" style="color: var(--text-primary);"><i class="bi bi-person me-2" style="color: #e65c00;"></i>Customer Details</h5>
    </div>
    <div class="card-body px-4 py-4">
        <div class="row g-3">
            <div class="col-md-4"><small class="text-muted d-block">Name</small><strong style="color: var(--text-primary);"><?= esc($sale['customer_name'] ?? '-') ?></strong></div>
            <div class="col-md-4"><small class="text-muted d-block">Phone</small><strong style="color: var(--text-primary);"><?= esc($sale['customer_phone'] ?? '-') ?></strong></div>
            <div class="col-md-4"><small class="text-muted d-block">Email</small><strong style="color: var(--text-primary);"><?= esc($sale['customer_email'] ?? '-') ?></strong></div>
            <div class="col-md-12"><small class="text-muted d-block">Address</small><strong style="color: var(--text-primary);"><?= esc($sale['customer_address'] ?? '-') ?></strong></div>
        </div>
    </div>
</div>

<!-- ─── FINANCIAL SUMMARY ─── -->
<div class="card border-0 shadow-sm mb-4" style="border-radius: 14px;">
    <div class="card-header bg-transparent border-bottom-0 pt-4 pb-0 px-4">
        <h5 class="fw-bold mb-0" style="color: var(--text-primary);"><i class="bi bi-calculator me-2" style="color: #e65c00;"></i>Financial Summary</h5>
    </div>
    <div class="card-body px-4 py-4">
        <div class="table-responsive">
            <table class="table table-borderless mb-0" style="font-size: 14px;">
                <tbody>
                    <tr><td style="color: var(--text-muted); width: 200px;">Sale Rate/sqft</td><td style="color: var(--text-primary); font-weight: 600;">₹<?= number_format((float) ($sale['sale_rate_sqft'] ?? 0), 2) ?></td></tr>
                    <tr><td style="color: var(--text-muted);">Total Area</td><td style="color: var(--text-primary); font-weight: 600;"><?= number_format((float) ($sale['total_area_sqft'] ?? 0)) ?> sqft</td></tr>
                    <tr><td style="color: var(--text-muted);">Total Sale Amount</td><td style="color: var(--text-primary); font-weight: 600;">₹<?= number_format((float) ($sale['total_sale_amount'] ?? 0)) ?></td></tr>
                    <tr><td style="color: var(--text-muted);">Discount</td><td style="color: #dc2626; font-weight: 600;">- ₹<?= number_format((float) ($sale['discount'] ?? 0)) ?></td></tr>
                    <tr><td style="color: var(--text-muted); border-top: 1px solid var(--border-color);">Net Sale Amount</td><td style="color: var(--text-primary); font-weight: 700; border-top: 1px solid var(--border-color);">₹<?= number_format((float) ($sale['net_sale_amount'] ?? 0)) ?></td></tr>
                    <tr>
                        <td style="color: var(--text-muted);">GST</td>
                        <td style="color: var(--text-primary); font-weight: 600;">
                            <?php if (($sale['gst_included'] ?? 'yes') === 'yes'): ?>
                            <span class="badge bg-success" style="font-weight: 500;">Included in price</span>
                            <?php else: ?>
                            ₹<?= number_format((float) ($sale['gst_amount'] ?? 0)) ?> (<?= number_format((float) ($sale['gst_percent'] ?? 0)) ?>%)
                            <?php endif; ?>
                        </td>
                    </tr>
                    <tr><td style="color: var(--text-muted);"><strong>Final Amount</strong></td><td style="color: #e65c00; font-weight: 700; font-size: 18px;">₹<?= number_format((float) ($sale['final_amount'] ?? 0)) ?></td></tr>
                    <tr><td style="color: var(--text-muted);">Booking Amount</td><td style="color: var(--text-primary); font-weight: 600;">₹<?= number_format((float) ($sale['booking_amount'] ?? 0)) ?></td></tr>
                    <tr>
                        <td style="color: var(--text-muted); border-top: 2px solid #e65c00;"><strong>Balance Due</strong></td>
                        <td style="border-top: 2px solid #e65c00; font-weight: 700; font-size: 18px; color: <?= $balanceDue > 0 ? '#dc2626' : '#16a34a' ?>;">
                            ₹<?= number_format((float) ($balanceDue ?? 0)) ?>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="mt-3">
            <small class="text-muted">Payment Mode: <strong style="color: var(--text-primary);"><?= ucfirst($sale['payment_mode'] ?? '-') ?></strong></small>
            <?php if ($sale['agreement_date']): ?>
            <br><small class="text-muted">Agreement Date: <strong style="color: var(--text-primary);"><?= date('d-m-Y', strtotime($sale['agreement_date'])) ?></strong></small>
            <?php endif; ?>
            <?php if ($sale['registration_date']): ?>
            <br><small class="text-muted">Registration Date: <strong style="color: var(--text-primary);"><?= date('d-m-Y', strtotime($sale['registration_date'])) ?></strong></small>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- ─── BROKER CARD ─── -->
<?php if ($sale['broker_name']): ?>
<div class="card border-0 shadow-sm mb-4" style="border-radius: 14px;">
    <div class="card-header bg-transparent border-bottom-0 pt-4 pb-0 px-4">
        <h5 class="fw-bold mb-0" style="color: var(--text-primary);"><i class="bi bi-diagram-3 me-2" style="color: #e65c00;"></i>Broker Details</h5>
    </div>
    <div class="card-body px-4 py-4">
        <div class="row g-3">
            <div class="col-md-4"><small class="text-muted d-block">Name</small><strong style="color: var(--text-primary);"><?= esc($sale['broker_name']) ?></strong></div>
            <div class="col-md-4"><small class="text-muted d-block">Phone</small><strong style="color: var(--text-primary);"><?= esc($sale['broker_phone'] ?? '-') ?></strong></div>
            <div class="col-md-4"><small class="text-muted d-block">Commission</small><strong style="color: var(--text-primary);"><?= number_format((float) ($sale['broker_commission'] ?? 0)) ?>%</strong></div>
        </div>
    </div>
</div>
<?php endif; ?>

<!-- ─── EMI SCHEDULE ─── -->
<?php if (!empty($emiSchedule)): ?>
<div class="card border-0 shadow-sm mb-4" style="border-radius: 14px;">
    <div class="card-header bg-transparent border-bottom-0 pt-4 pb-0 px-4">
        <h5 class="fw-bold mb-0" style="color: var(--text-primary);"><i class="bi bi-cash-coin me-2" style="color: #e65c00;"></i>EMI Schedule</h5>
    </div>
    <div class="card-body px-4 py-4">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0" style="font-size: 13px;">
                <thead class="table-light">
                    <tr>
                        <th style="color: var(--text-muted);">#</th>
                        <th style="color: var(--text-muted);">Due Date</th>
                        <th style="color: var(--text-muted);">Amount</th>
                        <th style="color: var(--text-muted);">Paid</th>
                        <th style="color: var(--text-muted);">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($emiSchedule as $emi): ?>
                    <tr>
                        <td style="color: var(--text-primary);"><?= esc($emi['emi_number']) ?></td>
                        <td style="color: var(--text-primary);"><?= date('d-m-Y', strtotime($emi['due_date'])) ?></td>
                        <td style="color: var(--text-primary);">₹<?= number_format((float) ($emi['amount'] ?? 0)) ?></td>
                        <td style="color: var(--text-primary);">₹<?= number_format((float) ($emi['paid_amount'] ?? 0)) ?></td>
                        <td>
                            <?php $emiStatus = $emi['status'] ?? ''; ?>
                            <span class="badge <?= $emiStatus === 'paid' ? 'bg-success' : ($emiStatus === 'partial' ? 'bg-warning' : 'bg-secondary') ?>" style="font-weight: 500;">
                                <?= ucfirst($emiStatus) ?>
                            </span>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php endif; ?>

<!-- ─── REMARKS ─── -->
<?php if ($sale['remarks']): ?>
<div class="card border-0 shadow-sm mb-4" style="border-radius: 14px;">
    <div class="card-header bg-transparent border-bottom-0 pt-4 pb-0 px-4">
        <h5 class="fw-bold mb-0" style="color: var(--text-primary);"><i class="bi bi-chat-dots me-2" style="color: #e65c00;"></i>Remarks</h5>
    </div>
    <div class="card-body px-4 py-4">
        <p style="color: var(--text-primary);"><?= nl2br(esc($sale['remarks'])) ?></p>
    </div>
</div>
<?php endif; ?>

<div class="d-flex gap-2 mt-4">
    <a href="<?= site_url('sales') ?>" class="btn btn-outline-secondary" style="border-radius: 10px; font-weight: 600;">
        <i class="bi bi-arrow-left me-1"></i> Back to Sales
    </a>
</div>

<?php $content = ob_get_clean() ?>
<?= view('layouts/main', ['content' => $content, 'title' => 'Sale #' . esc($sale['sale_number'])]) ?>