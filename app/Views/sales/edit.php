<?php ob_start() ?>

<!-- ─── BREADCRUMB ─── -->
<nav aria-label="breadcrumb" class="mb-3" style="font-size: 14px;">
    <ol class="breadcrumb mb-0">
        <li class="breadcrumb-item"><a href="<?= site_url('dashboard') ?>" style="color: var(--text-muted); text-decoration: none;">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="<?= site_url('sales') ?>" style="color: var(--text-muted); text-decoration: none;">Sales</a></li>
        <li class="breadcrumb-item"><a href="<?= site_url('sales/show/' . $sale['id']) ?>" style="color: var(--text-muted); text-decoration: none;">#<?= esc($sale['sale_number']) ?></a></li>
        <li class="breadcrumb-item active" aria-current="page" style="color: var(--text-primary);">Edit</li>
    </ol>
</nav>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0" style="color: var(--text-primary);">Edit Sale #<?= esc($sale['sale_number']) ?></h4>
</div>

<!-- ─── FLASH ERRORS ─── -->
<?php $errors = session()->getFlashdata('errors') ?? []; ?>
<?php if (!empty($errors)): ?>
<div class="alert alert-danger alert-dismissible fade show" role="alert" style="border-radius: 10px;">
    <i class="bi bi-exclamation-triangle-fill me-1"></i> Please fix the following errors:
    <ul class="mb-0 mt-1">
        <?php foreach ($errors as $e): ?>
        <li><?= esc($e) ?></li>
        <?php endforeach; ?>
    </ul>
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
<?php endif; ?>

<div class="row">
    <div class="col-lg-8">
        <form method="POST" action="<?= site_url('sales/update/' . $sale['id']) ?>">
            <?= csrf_field() ?>

            <!-- Sale Info -->
            <div class="card border-0 shadow-sm mb-4" style="border-radius: 14px;">
                <div class="card-header bg-transparent border-bottom-0 pt-4 pb-0 px-4">
                    <h5 class="fw-bold mb-0" style="color: var(--text-primary);"><i class="bi bi-info-circle me-2" style="color: #e65c00;"></i>Sale Information</h5>
                </div>
                <div class="card-body px-4 py-4">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold" style="font-size: 14px; color: var(--text-primary);">Sale Number</label>
                            <input type="text" class="form-control" value="<?= esc($sale['sale_number']) ?>" readonly style="border-radius: 10px; background: var(--bg-hover);">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold" style="font-size: 14px; color: var(--text-primary);">Status <span class="text-danger">*</span></label>
                            <select name="sale_status" class="form-select" required style="border-radius: 10px;">
                                <option value="booked" <?= $sale['sale_status'] === 'booked' ? 'selected' : '' ?>>Booked</option>
                                <option value="agreement" <?= $sale['sale_status'] === 'agreement' ? 'selected' : '' ?>>Agreement</option>
                                <option value="registered" <?= $sale['sale_status'] === 'registered' ? 'selected' : '' ?>>Registered</option>
                                <option value="cancelled" <?= $sale['sale_status'] === 'cancelled' ? 'selected' : '' ?>>Cancelled</option>
                            </select>
                            <?php if ($sale['sale_status'] !== 'cancelled'): ?>
                            <div class="form-text text-warning small"><i class="bi bi-exclamation-triangle me-1"></i> Changing to "Cancelled" will mark the unit as available.</div>
                            <?php endif; ?>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold" style="font-size: 14px; color: var(--text-primary);">Agreement Date <span class="text-danger">*</span></label>
                            <input type="date" name="agreement_date" class="form-control" value="<?= $sale['agreement_date'] ?? '' ?>" required style="border-radius: 10px;">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold" style="font-size: 14px; color: var(--text-primary);">Registration Date</label>
                            <input type="date" name="registration_date" class="form-control" value="<?= $sale['registration_date'] ?? '' ?>" style="border-radius: 10px;">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Financial -->
            <div class="card border-0 shadow-sm mb-4" style="border-radius: 14px;">
                <div class="card-header bg-transparent border-bottom-0 pt-4 pb-0 px-4">
                    <h5 class="fw-bold mb-0" style="color: var(--text-primary);"><i class="bi bi-calculator me-2" style="color: #e65c00;"></i>Financial Details</h5>
                </div>
                <div class="card-body px-4 py-4">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label fw-semibold" style="font-size: 14px; color: var(--text-primary);">Sale Rate/sqft</label>
                            <input type="text" class="form-control" value="₹<?= number_format((float) ($sale['sale_rate_sqft'] ?? 0), 2) ?>" readonly style="border-radius: 10px; background: var(--bg-hover);">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold" style="font-size: 14px; color: var(--text-primary);">Total Area</label>
                            <input type="text" class="form-control" value="<?= number_format((float) ($sale['total_area_sqft'] ?? 0)) ?> sqft" readonly style="border-radius: 10px; background: var(--bg-hover);">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold" style="font-size: 14px; color: var(--text-primary);">Total Sale Amount</label>
                            <input type="text" class="form-control" value="₹<?= number_format((float) ($sale['total_sale_amount'] ?? 0)) ?>" readonly style="border-radius: 10px; background: var(--bg-hover);">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold" style="font-size: 14px; color: var(--text-primary);">Discount (₹)</label>
                            <input type="number" step="0.01" name="discount" id="discount" class="form-control" value="<?= $sale['discount'] ?? 0 ?>" style="border-radius: 10px;">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold" style="font-size: 14px; color: var(--text-primary);">Net Sale Amount</label>
                            <input type="text" class="form-control" value="₹<?= number_format((float) ($sale['net_sale_amount'] ?? 0)) ?>" readonly style="border-radius: 10px; background: var(--bg-hover);">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold" style="font-size: 14px; color: var(--text-primary);">GST Included?</label>
                            <select name="gst_included" id="gst_included" class="form-select" style="border-radius: 10px;">
                                <option value="yes" <?= ($sale['gst_included'] ?? 'yes') === 'yes' ? 'selected' : '' ?>>Yes (Included)</option>
                                <option value="no" <?= ($sale['gst_included'] ?? '') === 'no' ? 'selected' : '' ?>>No (Separate)</option>
                            </select>
                        </div>
                        <div class="col-md-4" id="gstPercentGroup" style="display: <?= ($sale['gst_included'] ?? 'yes') === 'no' ? 'block' : 'none' ?>;">
                            <label class="form-label fw-semibold" style="font-size: 14px; color: var(--text-primary);">GST %</label>
                            <select name="gst_percent" id="gst_percent" class="form-select" style="border-radius: 10px;">
                                <option value="0" <?= ($sale['gst_percent'] ?? 0) == 0 ? 'selected' : '' ?>>0%</option>
                                <option value="5" <?= ($sale['gst_percent'] ?? 0) == 5 ? 'selected' : '' ?>>5%</option>
                                <option value="12" <?= ($sale['gst_percent'] ?? 0) == 12 ? 'selected' : '' ?>>12%</option>
                                <option value="18" <?= ($sale['gst_percent'] ?? 0) == 18 ? 'selected' : '' ?>>18%</option>
                                <option value="28" <?= ($sale['gst_percent'] ?? 0) == 28 ? 'selected' : '' ?>>28%</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold" style="font-size: 14px; color: var(--text-primary);">Booking Amount <span class="text-danger">*</span></label>
                            <input type="number" step="0.01" name="booking_amount" class="form-control" value="<?= $sale['booking_amount'] ?? 0 ?>" required style="border-radius: 10px;">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold" style="font-size: 14px; color: var(--text-primary);">Broker</label>
                            <select name="broker_id" class="form-select" style="border-radius: 10px;">
                                <option value="">-- No Broker --</option>
                                <?php foreach ($brokers as $b): ?>
                                <option value="<?= esc($b['id']) ?>" <?= ($sale['broker_id'] ?? '') === $b['id'] ? 'selected' : '' ?>><?= esc($b['name']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Remarks -->
            <div class="card border-0 shadow-sm mb-4" style="border-radius: 14px;">
                <div class="card-header bg-transparent border-bottom-0 pt-4 pb-0 px-4">
                    <h5 class="fw-bold mb-0" style="color: var(--text-primary);"><i class="bi bi-chat-dots me-2" style="color: #e65c00;"></i>Remarks</h5>
                </div>
                <div class="card-body px-4 py-4">
                    <textarea name="remarks" class="form-control" rows="3" style="border-radius: 10px;"><?= esc($sale['remarks'] ?? '') ?></textarea>
                </div>
            </div>

            <div class="d-flex justify-content-between">
                <a href="<?= site_url('sales/show/' . $sale['id']) ?>" class="btn btn-outline-secondary px-4" style="border-radius: 10px; font-weight: 600;">Cancel</a>
                <button type="submit" class="btn px-5" style="background: linear-gradient(135deg, #ff7a00, #e65c00); color: #fff; border: none; border-radius: 10px; font-weight: 600; padding: 12px 28px;">
                    <i class="bi bi-check-lg me-1"></i> Update Sale
                </button>
            </div>
        </form>
    </div>

    <!-- Side info -->
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm mb-4" style="border-radius: 14px;">
            <div class="card-header bg-transparent border-bottom-0 pt-4 pb-0 px-4">
                <h6 class="fw-bold mb-0" style="color: var(--text-primary);">Quick Summary</h6>
            </div>
            <div class="card-body px-4 py-3" style="font-size: 13px;">
                <div class="mb-2"><small class="text-muted">Project:</small><br><strong style="color: var(--text-primary);"><?= $sale['project_name'] ?? 'N/A' ?></strong></div>
                <div class="mb-2"><small class="text-muted">Unit:</small><br><strong style="color: var(--text-primary);"><?= $sale['unit_number'] ?? 'N/A' ?></strong></div>
                <div class="mb-2"><small class="text-muted">Customer:</small><br><strong style="color: var(--text-primary);"><?= $sale['customer_name'] ?? 'N/A' ?></strong></div>
                <div class="mb-2"><small class="text-muted">Final Amount:</small><br><strong style="color: #e65c00;">₹<?= number_format((float) ($sale['final_amount'] ?? 0)) ?></strong></div>
            </div>
        </div>
    </div>
</div>

<script>
$('#gst_included').change(function() {
    $('#gstPercentGroup').toggle($(this).val() === 'no');
});
</script>

<?php $content = ob_get_clean() ?>
<?= view('layouts/main', ['content' => $content, 'title' => 'Edit Sale #' . esc($sale['sale_number'])]) ?>