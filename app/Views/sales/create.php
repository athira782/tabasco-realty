<?php ob_start() ?>

<!-- ─── BREADCRUMB ─── -->
<nav aria-label="breadcrumb" class="mb-3" style="font-size: 14px;">
    <ol class="breadcrumb mb-0">
        <li class="breadcrumb-item"><a href="<?= site_url('dashboard') ?>" style="color: var(--text-muted); text-decoration: none;">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="<?= site_url('sales') ?>" style="color: var(--text-muted); text-decoration: none;">Sales</a></li>
        <li class="breadcrumb-item active" aria-current="page" style="color: var(--text-primary);">New Sale</li>
    </ol>
</nav>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0" style="color: var(--text-primary);">New Sale</h4>
</div>

<!-- ─── STEP INDICATOR ─── -->
<div class="card border-0 shadow-sm mb-4" style="border-radius: 14px;">
    <div class="card-body py-3">
        <div class="d-flex justify-content-between">
            <?php $steps = ['Property', 'Customer', 'Sale Details', 'Broker', 'Remarks']; ?>
            <?php foreach ($steps as $i => $step): ?>
            <div class="text-center" style="flex: 1;">
                <div class="step-circle mx-auto mb-1 d-flex align-items-center justify-content-center rounded-circle"
                    style="width: 32px; height: 32px; background: <?= $i === 0 ? '#e65c00' : 'var(--bg-hover)' ?>; color: <?= $i === 0 ? '#fff' : 'var(--text-muted)' ?>; font-weight: 700; font-size: 13px;">
                    <?= $i + 1 ?>
                </div>
                <small style="color: <?= $i === 0 ? '#e65c00' : 'var(--text-muted)' ?>; font-weight: <?= $i === 0 ? '600' : '400' ?>; font-size: 11px;"><?= $step ?></small>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
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

<!-- ─── FORM ─── -->
<form method="POST" action="<?= site_url('sales/store') ?>" id="saleForm">
    <?= csrf_field() ?>

    <!-- STEP 1: PROPERTY SELECTION -->
    <div class="card border-0 shadow-sm mb-4" style="border-radius: 14px;">
        <div class="card-header bg-transparent border-bottom-0 pt-4 pb-0 px-4">
            <h5 class="fw-bold mb-0" style="color: var(--text-primary);"><i class="bi bi-building me-2" style="color: #e65c00;"></i>Step 1: Property Selection</h5>
        </div>
        <div class="card-body px-4 py-4">
            <div class="row g-3">
                <div class="col-md-4">
                    <label class="form-label fw-semibold" style="font-size: 14px; color: var(--text-primary);">Project <span class="text-danger">*</span></label>
                    <select name="project_id" id="project_id" class="form-select" required style="border-radius: 10px;">
                        <option value="">-- Select Project --</option>
                        <?php foreach ($projects as $p): ?>
                        <option value="<?= esc($p['id']) ?>"><?= esc($p['name']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold" style="font-size: 14px; color: var(--text-primary);">Floor</label>
                    <select name="floor_id" id="floor_id" class="form-select" style="border-radius: 10px;">
                        <option value="">-- Select Floor --</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold" style="font-size: 14px; color: var(--text-primary);">Unit <span class="text-danger">*</span></label>
                    <select name="unit_id" id="unit_id" class="form-select" required style="border-radius: 10px;">
                        <option value="">-- Select Project first --</option>
                    </select>
                </div>
            </div>
            <div id="unitPreview" class="mt-3 p-3" style="background: var(--bg-hover); border-radius: 10px; display: none;">
                <div class="row g-2">
                    <div class="col-md-3">
                        <small class="text-muted d-block">Unit Type</small>
                        <strong id="previewType" style="color: var(--text-primary);">-</strong>
                    </div>
                    <div class="col-md-3">
                        <small class="text-muted d-block">Area (sqft)</small>
                        <strong id="previewArea" style="color: var(--text-primary);">-</strong>
                    </div>
                    <div class="col-md-3">
                        <small class="text-muted d-block">Base Rate/sqft</small>
                        <strong id="previewRate" style="color: var(--text-primary);">-</strong>
                    </div>
                    <div class="col-md-3">
                        <small class="text-muted d-block">Total Price</small>
                        <strong id="previewPrice" style="color: var(--text-primary);">-</strong>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- STEP 2: CUSTOMER -->
    <div class="card border-0 shadow-sm mb-4" style="border-radius: 14px;">
        <div class="card-header bg-transparent border-bottom-0 pt-4 pb-0 px-4">
            <h5 class="fw-bold mb-0" style="color: var(--text-primary);"><i class="bi bi-people me-2" style="color: #e65c00;"></i>Step 2: Customer</h5>
        </div>
        <div class="card-body px-4 py-4">
            <div class="row g-3">
                <div class="col-md-8">
                    <label class="form-label fw-semibold" style="font-size: 14px; color: var(--text-primary);">Search Existing Customer</label>
                    <div class="input-group">
                        <input type="text" id="customerSearch" class="form-control" placeholder="Type name or phone..." style="border-radius: 10px 0 0 10px;" autocomplete="off">
                        <button type="button" class="btn" style="background: #e65c00; color: #fff; border-radius: 0 10px 10px 0;" id="customerSearchBtn">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                    <div id="customerResults" class="mt-2" style="display: none;"></div>
                    <input type="hidden" name="customer_id" id="customer_id">
                </div>
                <div class="col-md-4 d-flex align-items-end">
                    <button type="button" class="btn btn-outline-secondary w-100" data-bs-toggle="modal" data-bs-target="#newCustomerModal" style="border-radius: 10px;">
                        <i class="bi bi-plus-circle me-1"></i> Add New Customer
                    </button>
                </div>
            </div>
            <div id="selectedCustomer" class="mt-3 p-3" style="background: #d1fae5; border-radius: 10px; display: none;">
                <strong id="selectedCustomerName" style="color: #065f46;"></strong>
                <br><small id="selectedCustomerPhone" style="color: #065f46;"></small>
                <button type="button" class="btn btn-sm btn-outline-danger ms-2" onclick="clearCustomer()"><i class="bi bi-x"></i> Change</button>
            </div>
        </div>
    </div>

    <!-- STEP 3: SALE DETAILS -->
    <div class="card border-0 shadow-sm mb-4" style="border-radius: 14px;">
        <div class="card-header bg-transparent border-bottom-0 pt-4 pb-0 px-4">
            <h5 class="fw-bold mb-0" style="color: var(--text-primary);"><i class="bi bi-cash-coin me-2" style="color: #e65c00;"></i>Step 3: Sale Details</h5>
        </div>
        <div class="card-body px-4 py-4">
            <div class="row g-3">
                <div class="col-md-4">
                    <label class="form-label fw-semibold" style="font-size: 14px; color: var(--text-primary);">Agreement Date <span class="text-danger">*</span></label>
                    <input type="date" name="agreement_date" class="form-control" required style="border-radius: 10px;">
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold" style="font-size: 14px; color: var(--text-primary);">Registration Date</label>
                    <input type="date" name="registration_date" class="form-control" style="border-radius: 10px;">
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold" style="font-size: 14px; color: var(--text-primary);">Sale Rate/sqft <span class="text-danger">*</span></label>
                    <input type="number" step="0.01" name="sale_rate_sqft" id="sale_rate_sqft" class="form-control" required style="border-radius: 10px;">
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold" style="font-size: 14px; color: var(--text-primary);">Total Area (sqft) <span class="text-danger">*</span></label>
                    <input type="number" step="0.01" name="total_area_sqft" id="total_area_sqft" class="form-control" required style="border-radius: 10px;">
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold" style="font-size: 14px; color: var(--text-primary);">Total Sale Amount</label>
                    <input type="text" id="total_sale_amount_display" class="form-control" readonly style="border-radius: 10px; background: var(--bg-hover);">
                    <input type="hidden" name="total_sale_amount" id="total_sale_amount">
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold" style="font-size: 14px; color: var(--text-primary);">Discount (₹)</label>
                    <input type="number" step="0.01" name="discount" id="discount" class="form-control" value="0" style="border-radius: 10px;">
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold" style="font-size: 14px; color: var(--text-primary);">Net Sale Amount</label>
                    <input type="text" id="net_sale_amount_display" class="form-control" readonly style="border-radius: 10px; background: var(--bg-hover);">
                    <input type="hidden" name="net_sale_amount" id="net_sale_amount">
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold" style="font-size: 14px; color: var(--text-primary);">GST Included in Price?</label>
                    <select name="gst_included" id="gst_included" class="form-select" style="border-radius: 10px;">
                        <option value="yes">Yes (GST included)</option>
                        <option value="no">No (Add GST separately)</option>
                    </select>
                </div>
                <div class="col-md-4" id="gstPercentGroup" style="display: none;">
                    <label class="form-label fw-semibold" style="font-size: 14px; color: var(--text-primary);">GST %</label>
                    <select name="gst_percent" id="gst_percent" class="form-select" style="border-radius: 10px;">
                        <option value="0">0%</option>
                        <option value="5">5%</option>
                        <option value="12">12%</option>
                        <option value="18">18%</option>
                        <option value="28">28%</option>
                    </select>
                </div>
                <div class="col-md-4" id="gstAmountGroup" style="display: none;">
                    <label class="form-label fw-semibold" style="font-size: 14px; color: var(--text-primary);">GST Amount</label>
                    <input type="text" id="gst_amount_display" class="form-control" readonly style="border-radius: 10px; background: var(--bg-hover);">
                    <input type="hidden" name="gst_amount" id="gst_amount">
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold" style="font-size: 14px; color: var(--text-primary);">Final Amount</label>
                    <input type="text" id="final_amount_display" class="form-control fw-bold" readonly style="border-radius: 10px; background: var(--bg-hover); color: #e65c00; font-size: 16px;">
                    <input type="hidden" name="final_amount" id="final_amount">
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold" style="font-size: 14px; color: var(--text-primary);">Booking Amount <span class="text-danger">*</span></label>
                    <input type="number" step="0.01" name="booking_amount" id="booking_amount" class="form-control" required style="border-radius: 10px;">
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold" style="font-size: 14px; color: var(--text-primary);">Payment Mode <span class="text-danger">*</span></label>
                    <select name="payment_mode" class="form-select" required style="border-radius: 10px;">
                        <option value="">-- Select --</option>
                        <option value="cash">Cash</option>
                        <option value="cheque">Cheque</option>
                        <option value="online">Online</option>
                        <option value="emi">EMI</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <!-- STEP 4: BROKER -->
    <div class="card border-0 shadow-sm mb-4" style="border-radius: 14px;">
        <div class="card-header bg-transparent border-bottom-0 pt-4 pb-0 px-4">
            <h5 class="fw-bold mb-0" style="color: var(--text-primary);"><i class="bi bi-diagram-3 me-2" style="color: #e65c00;"></i>Step 4: Broker Details (Optional)</h5>
        </div>
        <div class="card-body px-4 py-4">
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label fw-semibold" style="font-size: 14px; color: var(--text-primary);">Select Broker</label>
                    <select name="broker_id" class="form-select" style="border-radius: 10px;">
                        <option value="">-- No Broker --</option>
                        <?php foreach ($brokers as $b): ?>
                        <option value="<?= esc($b['id']) ?>" data-commission="<?= esc($b['commission_percent']) ?>"><?= esc($b['name']) ?> (<?= esc($b['commission_percent']) ?>%)</option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-semibold" style="font-size: 14px; color: var(--text-primary);">Brokerage Amount</label>
                    <input type="text" id="brokerageAmount" class="form-control" readonly style="border-radius: 10px; background: var(--bg-hover);" value="₹0">
                </div>
            </div>
        </div>
    </div>

    <!-- STEP 5: REMARKS -->
    <div class="card border-0 shadow-sm mb-4" style="border-radius: 14px;">
        <div class="card-header bg-transparent border-bottom-0 pt-4 pb-0 px-4">
            <h5 class="fw-bold mb-0" style="color: var(--text-primary);"><i class="bi bi-chat-dots me-2" style="color: #e65c00;"></i>Step 5: Remarks</h5>
        </div>
        <div class="card-body px-4 py-4">
            <div class="row g-3">
                <div class="col-md-12">
                    <label class="form-label fw-semibold" style="font-size: 14px; color: var(--text-primary);">Remarks / Notes</label>
                    <textarea name="remarks" class="form-control" rows="3" style="border-radius: 10px;"></textarea>
                </div>
            </div>
        </div>
    </div>

    <!-- SUBMIT -->
    <div class="d-flex justify-content-between">
        <a href="<?= site_url('sales') ?>" class="btn btn-outline-secondary px-4" style="border-radius: 10px; font-weight: 600;">Cancel</a>
        <button type="submit" class="btn px-5" style="background: linear-gradient(135deg, #ff7a00, #e65c00); color: #fff; border: none; border-radius: 10px; font-weight: 600; padding: 12px 28px;">
            <i class="bi bi-check-lg me-1"></i> Create Sale
        </button>
    </div>
</form>

<!-- ─── NEW CUSTOMER MODAL ─── -->
<div class="modal fade" id="newCustomerModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content" style="border-radius: 14px;">
            <div class="modal-header border-0">
                <h5 class="modal-title fw-bold" style="color: var(--text-primary);">Add New Customer</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label fw-semibold" style="font-size: 14px;">Full Name <span class="text-danger">*</span></label>
                    <input type="text" id="newCustomerName" class="form-control" style="border-radius: 10px;">
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold" style="font-size: 14px;">Phone <span class="text-danger">*</span></label>
                    <input type="text" id="newCustomerPhone" class="form-control" style="border-radius: 10px;">
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold" style="font-size: 14px;">Email</label>
                    <input type="email" id="newCustomerEmail" class="form-control" style="border-radius: 10px;">
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold" style="font-size: 14px;">Address</label>
                    <textarea id="newCustomerAddress" class="form-control" rows="2" style="border-radius: 10px;"></textarea>
                </div>
                <div id="newCustomerError" class="alert alert-danger py-2" style="display: none; border-radius: 8px; font-size: 13px;"></div>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal" style="border-radius: 10px;">Cancel</button>
                <button type="button" class="btn" id="saveCustomerBtn" style="background: #e65c00; color: #fff; border-radius: 10px; font-weight: 600;">
                    <i class="bi bi-plus-circle me-1"></i> Add Customer
                </button>
            </div>
        </div>
    </div>
</div>

<?php $content = ob_get_clean() ?>

<script>
// ─── UNIT LOADING ───
$('#project_id').change(function() {
    const pid = $(this).val();
    $('#unit_id').html('<option value="">Loading...</option>');

    $.get('<?= site_url('sales/getFloors') ?>', { project_id: pid }, function(floors) {
        let html = '<option value="">-- Select Floor --</option>';
        floors.forEach(f => { html += `<option value="${f.id}">${f.name} (Floor ${f.floor_number})</option>`; });
        $('#floor_id').html(html);
    });

    $.get('<?= site_url('sales/getUnits') ?>', { project_id: pid }, function(units) {
        let html = '<option value="">-- Select Unit --</option>';
        units.forEach(u => {
            html += `<option value="${u.id}">${u.unit_number} - ${u.unit_type} (${u.area_sqft} sqft)</option>`;
        });
        $('#unit_id').html(html);
    });
});

$('#floor_id').change(function() {
    const pid = $('#project_id').val();
    const fid = $(this).val();
    if (!pid) return;

    $.get('<?= site_url('sales/getUnits') ?>', { project_id: pid, floor_id: fid }, function(units) {
        let html = '<option value="">-- Select Unit --</option>';
        units.forEach(u => {
            html += `<option value="${u.id}">${u.unit_number} - ${u.unit_type} (${u.area_sqft} sqft)</option>`;
        });
        $('#unit_id').html(html);
    });
});

$('#unit_id').change(function() {
    const uid = $(this).val();
    if (!uid) {
        $('#unitPreview').hide();
        return;
    }
    $.get('<?= site_url('sales/getUnitDetail') ?>', { unit_id: uid }, function(unit) {
        if (!unit || !unit.id) return;
        $('#previewType').text(unit.unit_type || '-');
        $('#previewArea').text(unit.area_sqft || '-');
        $('#previewRate').text('₹' + parseFloat(unit.price / unit.area_sqft || 0).toLocaleString());
        $('#previewPrice').text('₹' + parseFloat(unit.price || 0).toLocaleString());
        $('#sale_rate_sqft').val(unit.price && unit.area_sqft ? (unit.price / unit.area_sqft).toFixed(2) : '');
        $('#total_area_sqft').val(unit.area_sqft || '');
        $('#unitPreview').show();
        calcTotals();
    });
});

function calcTotals() {
    const rate = parseFloat($('#sale_rate_sqft').val()) || 0;
    const area = parseFloat($('#total_area_sqft').val()) || 0;
    const discount = parseFloat($('#discount').val()) || 0;
    const total = rate * area;
    const net = total - discount;

    $('#total_sale_amount_display').val('₹' + total.toLocaleString());
    $('#total_sale_amount').val(total.toFixed(2));
    $('#net_sale_amount_display').val('₹' + net.toLocaleString());
    $('#net_sale_amount').val(net.toFixed(2));

    const gstIncluded = $('#gst_included').val();
    let final = net;

    if (gstIncluded === 'no') {
        const gstPercent = parseFloat($('#gst_percent').val()) || 0;
        const gst = net * (gstPercent / 100);
        final = net + gst;
        $('#gst_amount_display').val('₹' + gst.toLocaleString());
        $('#gst_amount').val(gst.toFixed(2));
        $('#gstPercentGroup').show();
        $('#gstAmountGroup').show();
    } else {
        $('#gstPercentGroup').hide();
        $('#gstAmountGroup').hide();
        $('#gst_amount').val(0);
    }

    $('#final_amount_display').val('₹' + final.toLocaleString());
    $('#final_amount').val(final.toFixed(2));

    const brokerSelect = $('select[name="broker_id"] option:selected');
    const commission = parseFloat(brokerSelect.data('commission')) || 0;
    if (commission > 0) {
        const brokerage = final * (commission / 100);
        $('#brokerageAmount').val('₹' + brokerage.toLocaleString());
    } else {
        $('#brokerageAmount').val('₹0');
    }
}

$('#sale_rate_sqft, #total_area_sqft, #discount, #gst_included, #gst_percent').on('change keyup', calcTotals);
$('select[name="broker_id"]').change(calcTotals);

$('#customerSearchBtn').click(searchCustomers);
$('#customerSearch').on('keyup', function(e) {
    if (e.key === 'Enter') searchCustomers();
});

function searchCustomers() {
    const q = $('#customerSearch').val();
    if (q.length < 2) return;
    $.get('<?= site_url('sales/searchCustomers') ?>', { q: q }, function(customers) {
        const container = $('#customerResults');
        container.empty().show();
        if (!customers || customers.length === 0) {
            container.html('<div class="p-2 text-muted small" style="background: var(--bg-hover); border-radius: 8px;">No customers found.</div>');
            return;
        }
        customers.forEach(c => {
            container.append(`
                <div class="p-2 border-bottom" style="cursor: pointer; border-radius: 8px;" onclick="selectCustomer('${c.id}', '${escJs(c.name)}', '${escJs(c.phone)}')">
                    <strong style="color: var(--text-primary);">${escHtml(c.name)}</strong>
                    <br><small style="color: var(--text-muted);">${escHtml(c.phone)}${c.email ? ' | ' + escHtml(c.email) : ''}</small>
                </div>
            `);
        });
    });
}

function selectCustomer(id, name, phone) {
    $('#customer_id').val(id);
    $('#selectedCustomerName').text(name);
    $('#selectedCustomerPhone').text(phone);
    $('#selectedCustomer').show();
    $('#customerResults').hide();
    $('#customerSearch').val(name).prop('disabled', true);
}

function clearCustomer() {
    $('#customer_id').val('');
    $('#selectedCustomer').hide();
    $('#customerSearch').val('').prop('disabled', false).focus();
}

$('#saveCustomerBtn').click(function() {
    const name = $('#newCustomerName').val().trim();
    const phone = $('#newCustomerPhone').val().trim();
    if (!name || !phone) {
        $('#newCustomerError').text('Name and Phone are required.').show();
        return;
    }
    $.post('<?= site_url('sales/storeCustomerAjax') ?>', {
        name: name,
        phone: phone,
        email: $('#newCustomerEmail').val(),
        address: $('#newCustomerAddress').val(),
        '<?= csrf_token() ?>': '<?= csrf_hash() ?>'
    }, function(res) {
        if (res.success) {
            selectCustomer(res.customer.id, res.customer.name, res.customer.phone);
            $('#newCustomerModal').modal('hide');
            $('#newCustomerName, #newCustomerPhone, #newCustomerEmail, #newCustomerAddress').val('');
            $('#newCustomerError').hide();
        } else {
            let errText = '';
            for (let k in res.errors) errText += res.errors[k] + ' ';
            $('#newCustomerError').text(errText).show();
        }
    }, 'json');
});

function escJs(s) { return s.replace(/'/g, "\\'").replace(/"/g, '"'); }
function escHtml(s) { return $('<div>').text(s).html(); }
</script>
<?= view('layouts/main', ['content' => $content, 'title' => 'New Sale']) ?>