<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'Tabasco Realty') ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
    :root {
        --sidebar-width: 240px;
        --orange: #e65c00;
        --orange-light: #fff0e0;
        --sidebar-bg: #fff;
        --navbar-height: 60px;
    }

    * {
        box-sizing: border-box;
    }

    body {
        font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
        background: #f0f2f5;
        margin: 0;
        padding: 0;
        min-height: 100vh;
    }

    /* ─── NAVBAR ─── */
    .navbar-main {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        height: var(--navbar-height);
        background: #fff;
        box-shadow: 0 1px 4px rgba(0, 0, 0, 0.08);
        z-index: 1030;
        display: flex;
        align-items: center;
        padding: 0 20px;
    }

    .navbar-main .brand {
        display: flex;
        align-items: center;
        gap: 10px;
        text-decoration: none;
        color: #1a1a2e;
        font-weight: 700;
        font-size: 18px;
    }

    .navbar-main .brand .logo-square {
        width: 34px;
        height: 34px;
        background: linear-gradient(135deg, #ff7a00, #e65c00);
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-size: 18px;
        font-weight: 800;
        flex-shrink: 0;
    }

    .navbar-main .nav-right {
        margin-left: auto;
        display: flex;
        align-items: center;
        gap: 14px;
    }

    .system-badge {
        font-size: 12px;
        font-weight: 600;
        padding: 4px 12px;
        border-radius: 20px;
        white-space: nowrap;
    }

    .system-badge.india {
        background: #fff0e0;
        color: #e65c00;
    }

    .system-badge.uae {
        background: #e0f2fe;
        color: #0369a1;
    }

    .user-meta {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .user-meta .user-name {
        font-size: 14px;
        font-weight: 600;
        color: #333;
    }

    .role-badge {
        font-size: 11px;
        font-weight: 600;
        padding: 2px 10px;
        border-radius: 20px;
        white-space: nowrap;
    }

    .role-badge.owner {
        background: #f3e8ff;
        color: #7c3aed;
    }

    .role-badge.accountant {
        background: #dbeafe;
        color: #2563eb;
    }

    .role-badge.sales {
        background: #dcfce7;
        color: #16a34a;
    }

    .role-badge.site_office {
        background: #fef9c3;
        color: #a16207;
    }

    .btn-logout {
        background: none;
        border: 1px solid #e0e0e0;
        border-radius: 8px;
        padding: 6px 12px;
        color: #6c757d;
        font-size: 14px;
        cursor: pointer;
        transition: all 0.2s;
        display: flex;
        align-items: center;
        gap: 6px;
        text-decoration: none;
    }

    .btn-logout:hover {
        background: #fee2e2;
        border-color: #fca5a5;
        color: #dc2626;
    }

    .btn-logout .logout-text {
        display: inline;
    }

    /* ─── LAYOUT ─── */
    .layout-wrapper {
        display: flex;
        min-height: 100vh;
        padding-top: var(--navbar-height);
    }

    /* ─── SIDEBAR ─── */
    .sidebar {
        position: fixed;
        top: var(--navbar-height);
        left: 0;
        bottom: 0;
        width: var(--sidebar-width);
        background: var(--sidebar-bg);
        border-right: 1px solid #e0e0e0;
        overflow-y: auto;
        padding: 12px 0;
        z-index: 1020;
    }

    .sidebar .nav-section {
        padding: 0 12px;
    }

    .sidebar .nav-link {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 10px 14px;
        border-radius: 10px;
        color: #4a4a5a;
        font-size: 14px;
        font-weight: 500;
        text-decoration: none;
        transition: all 0.15s ease;
        border-left: 3px solid transparent;
        margin-bottom: 2px;
    }

    .sidebar .nav-link i {
        font-size: 18px;
        width: 22px;
        text-align: center;
        flex-shrink: 0;
        color: #6c757d;
    }

    .sidebar .nav-link:hover {
        background: #f8f9fa;
        color: #e65c00;
    }

    .sidebar .nav-link:hover i {
        color: #e65c00;
    }

    .sidebar .nav-link.active {
        background: var(--orange-light);
        color: var(--orange);
        border-left-color: var(--orange);
        font-weight: 600;
    }

    .sidebar .nav-link.active i {
        color: var(--orange);
    }

    .sidebar .nav-section-title {
        font-size: 10px;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: #adb5bd;
        font-weight: 700;
        padding: 16px 14px 6px;
    }

    /* ─── MAIN CONTENT ─── */
    .main-content {
        margin-top: 5rem;
        margin-left: var(--sidebar-width);
        flex: 1;
        padding: 24px;
        padding-top: 20px;
        min-height: calc(100vh - var(--navbar-height));
        display: flex;
        flex-direction: column;
    }

    .main-content .content-body {
        flex: 1;
    }

    /* ─── FOOTER ─── */
    .footer-bar {
        border-top: 1px solid #e0e0e0;
        padding: 14px 0;
        font-size: 12px;
        color: #adb5bd;
        text-align: center;
        margin-top: 32px;
    }

    /* ─── FLASH ALERTS ─── */
    .flash-container {
        position: fixed;
        top: calc(var(--navbar-height) + 12px);
        left: 50%;
        transform: translateX(-50%);
        z-index: 1050;
        width: 90%;
        max-width: 600px;
    }

    .flash-container .alert {
        border-radius: 10px;
        font-size: 14px;
        padding: 12px 18px;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08);
        margin-bottom: 8px;
    }

    /* ─── RESPONSIVE ─── */
    .sidebar-toggle {
        display: none;
        background: none;
        border: none;
        font-size: 22px;
        color: #333;
        padding: 4px 8px;
        cursor: pointer;
        margin-right: 10px;
    }

    @media (max-width: 768px) {
        .sidebar {
            transform: translateX(-100%);
            transition: transform 0.3s ease;
        }

        .sidebar.open {
            transform: translateX(0);
        }

        .main-content {
            margin-left: 0;
        }

        .sidebar-toggle {
            display: block;
        }

        .btn-logout .logout-text {
            display: none;
        }

        .user-meta .user-name,
        .user-meta .role-badge {
            display: none;
        }
    }
    </style>
</head>

<body>

    <?php
    $session = session();
    $authUser = $session->get('auth_user');
    $role = $authUser['role'] ?? '';
    $system = $authUser['system'] ?? '';
    $name   = $authUser['name']   ?? 'User';

    // Detect active segment
    $uri = service('uri');
    $activeSegment = $uri->getSegment(1);
    ?>

    <!-- ─── FLASH MESSAGES ─── -->
    <div class="flash-container" id="flashContainer">
        <?php if ($success = session()->getFlashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill me-1"></i> <?= esc($success) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        <?php endif; ?>

        <?php if ($error = session()->getFlashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-1"></i> <?= esc($error) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        <?php endif; ?>
    </div>

    <!-- ─── NAVBAR ─── -->
    <nav class="navbar-main">
        <button class="sidebar-toggle" onclick="toggleSidebar()" aria-label="Toggle sidebar">
            <i class="bi bi-list"></i>
        </button>

        <a href="<?= site_url('dashboard') ?>" class="brand">
            <span class="logo-square">T</span>
            <span>Tabasco Realty</span>
        </a>

        <div class="nav-right">
            <span class="system-badge <?= $system ?>">
                <i class="bi bi-globe2 me-1"></i>
                <?= ucfirst($system) ?> System
            </span>

            <div class="user-meta">
                <span class="user-name"><?= esc($name) ?></span>
                <span class="role-badge <?= $role ?>">
                    <?= ucfirst(str_replace('_', ' ', $role)) ?>
                </span>
            </div>

            <a href="<?= site_url('logout') ?>" class="btn-logout">
                <i class="bi bi-box-arrow-right"></i>
                <span class="logout-text">Logout</span>
            </a>
        </div>
    </nav>

    <!-- ─── SIDEBAR ─── -->
    <aside class="sidebar" id="sidebar">
        <div class="nav-section">
            <div class="nav-section-title">Main</div>

            <a href="<?= site_url('dashboard') ?>"
                class="nav-link <?= $activeSegment === 'dashboard' ? 'active' : '' ?>">
                <i class="bi bi-grid-1x2-fill"></i> Dashboard
            </a>

            <?php if (hasPermission('projects', 'view')): ?>
            <a href="<?= site_url('projects') ?>" class="nav-link <?= $activeSegment === 'projects' ? 'active' : '' ?>">
                <i class="bi bi-building"></i> Projects & Units
            </a>
            <?php endif; ?>

            <?php if (hasPermission('sales', 'view')): ?>
            <a href="<?= site_url('sales') ?>" class="nav-link <?= $activeSegment === 'sales' ? 'active' : '' ?>">
                <i class="bi bi-cart3"></i> Sales
            </a>
            <?php endif; ?>

            <?php if (hasPermission('customers', 'view')): ?>
            <a href="<?= site_url('customers') ?>"
                class="nav-link <?= $activeSegment === 'customers' ? 'active' : '' ?>">
                <i class="bi bi-people"></i> Customers
            </a>
            <?php endif; ?>

            <?php if (hasPermission('emi', 'view')): ?>
            <a href="<?= site_url('emi') ?>" class="nav-link <?= $activeSegment === 'emi' ? 'active' : '' ?>">
                <i class="bi bi-cash-coin"></i> EMI & Collections
            </a>
            <?php endif; ?>

            <?php if (hasPermission('expenses', 'view')): ?>
            <a href="<?= site_url('expenses') ?>" class="nav-link <?= $activeSegment === 'expenses' ? 'active' : '' ?>">
                <i class="bi bi-wallet2"></i> Expenses
            </a>
            <?php endif; ?>

            <?php if (hasPermission('petty_cash', 'view')): ?>
            <a href="<?= site_url('petty-cash') ?>"
                class="nav-link <?= $activeSegment === 'petty-cash' ? 'active' : '' ?>">
                <i class="bi bi-piggy-bank"></i> Petty Cash
            </a>
            <?php endif; ?>

            <?php if (hasPermission('loans', 'view')): ?>
            <a href="<?= site_url('loans') ?>" class="nav-link <?= $activeSegment === 'loans' ? 'active' : '' ?>">
                <i class="bi bi-bank"></i> Bank Loans
            </a>
            <?php endif; ?>

            <?php if (hasPermission('brokerage', 'view')): ?>
            <a href="<?= site_url('brokerage') ?>"
                class="nav-link <?= $activeSegment === 'brokerage' ? 'active' : '' ?>">
                <i class="bi bi-diagram-3"></i> Brokerage
            </a>
            <?php endif; ?>

            <?php if (hasPermission('reports', 'view')): ?>
            <a href="<?= site_url('reports') ?>" class="nav-link <?= $activeSegment === 'reports' ? 'active' : '' ?>">
                <i class="bi bi-file-earmark-bar-graph"></i> Reports
            </a>
            <?php endif; ?>

            <?php if (hasPermission('users', 'view')): ?>
            <a href="<?= site_url('users') ?>" class="nav-link <?= $activeSegment === 'users' ? 'active' : '' ?>">
                <i class="bi bi-shield-lock"></i> User Management
            </a>
            <?php endif; ?>
        </div>
    </aside>

    <!-- ─── MAIN CONTENT ─── -->
    <div class="main-content">
        <div class="content-body">
            <?= $content ?>
        </div>

        <div class="footer-bar">
            &copy; 2024 Tabasco Hindustan Infra Developers Pvt. Ltd.
        </div>
    </div>

    <!-- ─── SCRIPTS ─── -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    // Toggle sidebar on mobile
    function toggleSidebar() {
        document.getElementById('sidebar').classList.toggle('open');
    }

    // Auto-dismiss flash messages after 4 seconds
    $(document).ready(function() {
        setTimeout(function() {
            $('#flashContainer .alert').fadeOut(400, function() {
                $(this).alert('close');
            });
        }, 4000);
    });
    </script>
</body>

</html>
</write_to_file>