<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sale Agreement - <?= esc($sale['sale_number']) ?></title>
    <style>
        @page { margin: 20mm 15mm; }
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Segoe UI', Arial, sans-serif; font-size: 13px; color: #1a1a2e; line-height: 1.6; padding: 40px; }
        .header { text-align: center; border-bottom: 3px solid #e65c00; padding-bottom: 20px; margin-bottom: 30px; }
        .header h1 { font-size: 24px; color: #e65c00; margin-bottom: 5px; }
        .header p { color: #6c757d; font-size: 12px; }
        h3 { font-size: 16px; color: #e65c00; margin-bottom: 12px; padding-bottom: 6px; border-bottom: 1px solid #e0e0e0; }
        .section { margin-bottom: 25px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 15px; }
        td, th { padding: 8px 12px; text-align: left; border-bottom: 1px solid #eee; }
        th { background: #f8f9fa; font-weight: 600; color: #6c757d; font-size: 11px; text-transform: uppercase; }
        .label { color: #6c757d; width: 180px; }
        .value { font-weight: 600; }
        .total-row td { border-top: 2px solid #e65c00; font-weight: 700; font-size: 15px; }
        .footer { margin-top: 50px; padding-top: 20px; border-top: 1px solid #e0e0e0; }
        .signatures { display: flex; justify-content: space-between; margin-top: 60px; }
        .signature-block { text-align: center; width: 200px; }
        .signature-line { border-top: 1px solid #1a1a2e; padding-top: 8px; margin-top: 50px; }
        .print-btn { display: block; margin: 20px auto; padding: 12px 30px; background: #e65c00; color: #fff; border: none; border-radius: 8px; font-size: 16px; cursor: pointer; }
        @media print { .print-btn { display: none; } }
    </style>
</head>
<body>
    <button class="print-btn" onclick="window.print()"><i class="bi bi-printer"></i> Print / Save PDF</button>

    <div class="header">
        <h1>TABASCO HINDUSTAN INFRA DEVELOPERS PVT. LTD.</h1>
        <p>Sale Agreement Summary | <?= esc($sale['sale_number']) ?> | Date: <?= date('d-m-Y') ?></p>
    </div>

    <div class="section">
        <h3>1. Property Details</h3>
        <table>
            <tr><td class="label">Project</td><td class="value"><?= esc($sale['project_name'] ?? '-') ?></td></tr>
            <tr><td class="label">Location</td><td class="value"><?= esc($sale['project_location'] ?? '-') ?></td></tr>
            <tr><td class="label">Floor</td><td class="value"><?= esc($sale['floor_name'] ?? '-') ?> (<?= esc($sale['floor_number'] ?? '-') ?>)</td></tr>
            <tr><td class="label">Unit Number</td><td class="value"><?= esc($sale['unit_number'] ?? '-') ?></td></tr>
            <tr><td class="label">Unit Type</td><td class="value"><?= esc($sale['unit_type'] ?? '-') ?></td></tr>
        </table>
    </div>

    <div class="section">
        <h3>2. Customer Details</h3>
        <table>
            <tr><td class="label">Name</td><td class="value"><?= esc($sale['customer_name'] ?? '-') ?></td></tr>
            <tr><td class="label">Phone</td><td class="value"><?= esc($sale['customer_phone'] ?? '-') ?></td></tr>
            <tr><td class="label">Email</td><td class="value"><?= esc($sale['customer_email'] ?? '-') ?></td></tr>
            <tr><td class="label">Address</td><td class="value"><?= nl2br(esc($sale['customer_address'] ?? '-')) ?></td></tr>
        </table>
    </div>

    <div class="section">
        <h3>3. Financial Summary</h3>
        <table>
            <tr><td class="label">Sale Rate / sqft</td><td class="value">₹<?= number_format((float) ($sale['sale_rate_sqft'] ?? 0), 2) ?></td></tr>
            <tr><td class="label">Total Area</td><td class="value"><?= number_format((float) ($sale['total_area_sqft'] ?? 0)) ?> sqft</td></tr>
            <tr><td class="label">Total Sale Amount</td><td class="value">₹<?= number_format((float) ($sale['total_sale_amount'] ?? 0)) ?></td></tr>
            <tr><td class="label">Discount</td><td class="value">- ₹<?= number_format((float) ($sale['discount'] ?? 0)) ?></td></tr>
            <tr><td class="label">Net Sale Amount</td><td class="value">₹<?= number_format((float) ($sale['net_sale_amount'] ?? 0)) ?></td></tr>
            <tr>
                <td class="label">GST</td>
                <td class="value">
                    <?php if (($sale['gst_included'] ?? 'yes') === 'yes'): ?>
                    Included in price
                    <?php else: ?>
                    ₹<?= number_format((float) ($sale['gst_amount'] ?? 0)) ?> @ <?= number_format((float) ($sale['gst_percent'] ?? 0)) ?>%
                    <?php endif; ?>
                </td>
            </tr>
            <tr class="total-row">
                <td class="label">Final Amount</td>
                <td class="value">₹<?= number_format((float) ($sale['final_amount'] ?? 0)) ?></td>
            </tr>
            <tr><td class="label">Booking Amount</td><td class="value">₹<?= number_format((float) ($sale['booking_amount'] ?? 0)) ?></td></tr>
            <tr>
                <td class="label">Balance Due</td>
                <td class="value" style="color: <?= $balanceDue > 0 ? '#dc2626' : '#16a34a' ?>;">
                    ₹<?= number_format((float) ($balanceDue ?? 0)) ?>
                </td>
            </tr>
            <tr><td class="label">Payment Mode</td><td class="value"><?= ucfirst($sale['payment_mode'] ?? '-') ?></td></tr>
        </table>
    </div>

    <?php if ($sale['broker_name']): ?>
    <div class="section">
        <h3>4. Broker Details</h3>
        <table>
            <tr><td class="label">Name</td><td class="value"><?= esc($sale['broker_name']) ?></td></tr>
            <tr><td class="label">Phone</td><td class="value"><?= esc($sale['broker_phone'] ?? '-') ?></td></tr>
            <tr><td class="label">Commission</td><td class="value"><?= number_format((float) ($sale['broker_commission'] ?? 0)) ?>%</td></tr>
        </table>
    </div>
    <?php endif; ?>

    <div class="section">
        <h3>5. Schedule</h3>
        <table>
            <tr><td class="label">Agreement Date</td><td class="value"><?= $sale['agreement_date'] ? date('d-m-Y', strtotime($sale['agreement_date'])) : '-' ?></td></tr>
            <tr><td class="label">Registration Date</td><td class="value"><?= $sale['registration_date'] ? date('d-m-Y', strtotime($sale['registration_date'])) : '-' ?></td></tr>
            <tr><td class="label">Sale Status</td><td class="value"><?= ucfirst($sale['sale_status'] ?? '-') ?></td></tr>
        </table>
    </div>

    <?php if ($sale['remarks']): ?>
    <div class="section">
        <h3>6. Remarks</h3>
        <p><?= nl2br(esc($sale['remarks'])) ?></p>
    </div>
    <?php endif; ?>

    <div class="footer">
        <p style="color: #6c757d; font-size: 11px; text-align: center;">
            This is a computer-generated summary. Generated on <?= date('d-m-Y H:i:s') ?>.
        </p>
    </div>

    <div class="signatures">
        <div class="signature-block">
            <div class="signature-line">Authorized Signatory</div>
        </div>
        <div class="signature-block">
            <div class="signature-line">Customer</div>
        </div>
    </div>
</body>
</html>