<?php
// Module definitions for quick links
$modules = [
    'projects'   => ['label' => 'Projects & Units',    'icon' => 'bi-building',             'route' => site_url('projects')],
    'sales'      => ['label' => 'Sales',               'icon' => 'bi-cart3',                'route' => site_url('sales')],
    'customers'  => ['label' => 'Customers',           'icon' => 'bi-people',               'route' => site_url('customers')],
    'emi'        => ['label' => 'EMI & Collections',   'icon' => 'bi-cash-coin',            'route' => site_url('emi')],
    'expenses'   => ['label' => 'Expenses',            'icon' => 'bi-wallet2',              'route' => site_url('expenses')],
    'petty_cash' => ['label' => 'Petty Cash',          'icon' => 'bi-piggy-bank',           'route' => site_url('petty-cash')],
    'loans'      => ['label' => 'Bank Loans',          'icon' => 'bi-bank',                 'route' => site_url('loans')],
    'brokerage'  => ['label' => 'Brokerage',           'icon' => 'bi-diagram-3',            'route' => site_url('brokerage')],
    'reports'    => ['label' => 'Reports',             'icon' => 'bi-file-earmark-bar-graph', 'route' => site_url('reports')],
    'users'      => ['label' => 'User Management',     'icon' => 'bi-shield-lock',          'route' => site_url('users')],
];

$allowedModules = array_filter($modules, function ($slug) {
    return hasPermission($slug, 'view');
}, ARRAY_FILTER_USE_KEY);
?>
<?php ob_start() ?>

<!-- ─── WELCOME BANNER ─── -->
<div class="card border-0 shadow-sm mb-4" style="border-radius: 14px; border-left: 4px solid #e65c00 !important;">
    <div class="card-body py-4">
        <h4 class="fw-bold mb-1">Welcome back, <?= esc($name) ?></h4>
        <p class="mb-0 text-muted" style="font-size: 14px;">
            <?= esc(ucfirst(str_replace('_', ' ', $role))) ?> · <?= esc(ucfirst($system)) ?> system
        </p>
    </div>
</div>

<!-- ─── STATS ROW ─── -->
<div class="row g-3 mb-4">
    <div class="col-6 col-md-3">
        <div class="card border-0 shadow-sm h-100" style="border-radius: 14px;">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="d-flex align-items-center justify-content-center rounded-circle"
                    style="width: 48px; height: 48px; background: #fff0e0; flex-shrink: 0;">
                    <i class="bi bi-building" style="font-size: 22px; color: #e65c00;"></i>
                </div>
                <div>
                    <p class="text-muted small mb-0" style="font-size: 12px;">Total Projects</p>
                    <h5 class="fw-bold mb-0">—</h5>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card border-0 shadow-sm h-100" style="border-radius: 14px;">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="d-flex align-items-center justify-content-center rounded-circle"
                    style="width: 48px; height: 48px; background: #e0f2fe; flex-shrink: 0;">
                    <i class="bi bi-door-open" style="font-size: 22px; color: #0369a1;"></i>
                </div>
                <div>
                    <p class="text-muted small mb-0" style="font-size: 12px;">Active Units</p>
                    <h5 class="fw-bold mb-0">—</h5>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card border-0 shadow-sm h-100" style="border-radius: 14px;">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="d-flex align-items-center justify-content-center rounded-circle"
                    style="width: 48px; height: 48px; background: #dcfce7; flex-shrink: 0;">
                    <i class="bi bi-graph-up-arrow" style="font-size: 22px; color: #16a34a;"></i>
                </div>
                <div>
                    <p class="text-muted small mb-0" style="font-size: 12px;">Sales This Month</p>
                    <h5 class="fw-bold mb-0">—</h5>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card border-0 shadow-sm h-100" style="border-radius: 14px;">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="d-flex align-items-center justify-content-center rounded-circle"
                    style="width: 48px; height: 48px; background: #fef9c3; flex-shrink: 0;">
                    <i class="bi bi-cash-stack" style="font-size: 22px; color: #a16207;"></i>
                </div>
                <div>
                    <p class="text-muted small mb-0" style="font-size: 12px;">Collections</p>
                    <h5 class="fw-bold mb-0">—</h5>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ─── QUICK LINKS ─── -->
<?php if (!empty($allowedModules)): ?>
<h5 class="fw-bold mb-3">Quick Links</h5>
<div class="row g-3 mb-4">
    <?php foreach ($allowedModules as $slug => $module): ?>
    <div class="col-6 col-md-4 col-lg-3">
        <a href="<?= $module['route'] ?>" class="text-decoration-none">
            <div class="card border-0 shadow-sm h-100"
                style="border-radius: 14px; transition: transform 0.15s, box-shadow 0.15s;"
                onmouseover="this.style.transform='translateY(-3px)';this.style.boxShadow='0 8px 24px rgba(0,0,0,0.1)';"
                onmouseout="this.style.transform='';this.style.boxShadow='';">
                <div class="card-body text-center py-4">
                    <div class="d-flex align-items-center justify-content-center rounded-circle mx-auto mb-3"
                        style="width: 52px; height: 52px; background: #fff0e0;">
                        <i class="bi <?= $module['icon'] ?>" style="font-size: 24px; color: #e65c00;"></i>
                    </div>
                    <h6 class="fw-semibold mb-2" style="font-size: 14px;"><?= esc($module['label']) ?>
                    </h6>
                    <span style="font-size: 12px; color: #e65c00; font-weight: 600;">View &rarr;</span>
                </div>
            </div>
        </a>
    </div>
    <?php endforeach; ?>
</div>
<?php endif; ?>

<!-- ─── RECENT ACTIVITY ─── -->
<h5 class="fw-bold mb-3">Recent Activity</h5>
<div class="card border-0 shadow-sm" style="border-radius: 14px;">
    <div class="card-body text-center py-5">
        <i class="bi bi-clock-history" style="font-size: 40px; color: #adb5bd;"></i>
        <p class="text-muted mt-3 mb-0">Audit log will appear here</p>
    </div>
</div>

<?php $content = ob_get_clean() ?>
<?= view('layouts/main', ['content' => $content, 'title' => 'Dashboard']) ?>