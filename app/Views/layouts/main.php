<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Anti-flicker: apply theme before page paint -->
    <script>
    (function() {
        var theme = localStorage.getItem('tabasco_theme');
        if (theme === 'dark' || (!theme && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.setAttribute('data-bs-theme', 'dark');
        }
    })();
    </script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'Tabasco Realty') ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
    /* ─── THEME VARIABLES ─── */
    :root {
        --sidebar-width: 240px;
        --orange: #e65c00;
        --orange-light: #fff0e0;
        --navbar-height: 46px;

        --bg-body: #f0f2f5;
        --bg-navbar: #ffffff;
        --bg-sidebar: #ffffff;
        --card-bg: #ffffff;
        --bg-hover: #f0f0f0;
        --text-primary: #1a1a2e;
        --text-secondary: #4a4a5a;
        --text-muted: #6c757d;
        --border-color: #e0e0e0;
    }

    [data-bs-theme="dark"] {
        --bg-body: #0a0a0f;
        --bg-navbar: #1a1a2a;
        --bg-sidebar: #1a1a2a;
        --card-bg: #1e1e30;
        --bg-hover: #2a2a3e;
        --text-primary: #ffffff;
        --text-secondary: #cccccc;
        --text-muted: #adb5bd;
        --border-color: #33334a;
    }

    [data-bs-theme="dark"] body {
        color: var(--text-primary);
    }

    /* ─── DARK MODE: BOOTSTRAP COMPONENT OVERRIDES ─── */
    [data-bs-theme="dark"] .card,
    [data-bs-theme="dark"] .list-group-item {
        background-color: var(--card-bg);
        color: var(--text-primary);
    }

    [data-bs-theme="dark"] .table {
        --bs-table-bg: var(--card-bg);
        --bs-table-color: var(--text-primary);
        --bs-table-striped-bg: rgba(255, 255, 255, 0.02);
        --bs-table-hover-bg: var(--bg-hover);
        border-color: var(--border-color);
    }

    [data-bs-theme="dark"] .form-control,
    [data-bs-theme="dark"] .form-select {
        background-color: var(--bg-sidebar);
        border-color: var(--border-color);
        color: var(--text-primary);
    }

    [data-bs-theme="dark"] .form-control:focus,
    [data-bs-theme="dark"] .form-select:focus {
        background-color: var(--bg-sidebar);
        color: var(--text-primary);
    }

    [data-bs-theme="dark"] .form-label,
    [data-bs-theme="dark"] .form-check-label {
        color: var(--text-primary);
    }

    [data-bs-theme="dark"] .modal-content {
        background-color: var(--card-bg);
        color: var(--text-primary);
    }

    [data-bs-theme="dark"] .modal-header {
        border-color: var(--border-color);
    }

    [data-bs-theme="dark"] .modal-footer {
        border-color: var(--border-color);
    }

    [data-bs-theme="dark"] .dropdown-menu {
        background-color: var(--card-bg);
        border-color: var(--border-color);
    }

    [data-bs-theme="dark"] .dropdown-item {
        color: var(--text-primary);
    }

    [data-bs-theme="dark"] .dropdown-item:hover {
        background-color: var(--bg-hover);
        color: var(--text-primary);
    }

    [data-bs-theme="dark"] .btn-outline-secondary {
        color: var(--text-secondary);
        border-color: var(--border-color);
    }

    [data-bs-theme="dark"] .btn-close {
        filter: invert(1);
    }

    [data-bs-theme="dark"] .pagination .page-link {
        background-color: var(--card-bg);
        border-color: var(--border-color);
        color: var(--text-primary);
    }

    [data-bs-theme="dark"] .pagination .page-item.active .page-link {
        background-color: var(--orange);
        border-color: var(--orange);
        color: #fff;
    }

    [data-bs-theme="dark"] .breadcrumb {
        background-color: transparent;
    }

    [data-bs-theme="dark"] .text-muted {
        color: var(--text-muted) !important;
    }

    /* ─── DARK MODE: SHADOW ADJUSTMENTS ─── */
    [data-bs-theme="dark"] .shadow-sm {
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.3) !important;
    }

    [data-bs-theme="dark"] .navbar-main {
        box-shadow: 0 1px 4px rgba(0, 0, 0, 0.3);
    }

    [data-bs-theme="dark"] .flash-container .alert {
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.3);
    }

    /* ─── DARK MODE: BADGE OVERRIDES ─── */
    [data-bs-theme="dark"] .dropdown-user-role.owner {
        background: #3d2200;
        color: #ff9a3c;
    }

    [data-bs-theme="dark"] .dropdown-user-role.accountant {
        background: #0c1f3e;
        color: #60a5fa;
    }

    [data-bs-theme="dark"] .dropdown-user-role.sales {
        background: #052e16;
        color: #4ade80;
    }

    [data-bs-theme="dark"] .dropdown-user-role.site_office {
        background: #2e2200;
        color: #facc15;
    }

    [data-bs-theme="dark"] .system-badge.india {
        background: #3d2200;
        color: #ff9a3c;
    }

    [data-bs-theme="dark"] .system-badge.uae {
        background: #0c1f3e;
        color: #60a5fa;
    }

    [data-bs-theme="dark"] .sidebar .nav-link.active {
        background: rgba(230, 92, 0, 0.12);
    }

    /* ─── DARK MODE: DASHBOARD STAT ICONS ─── */
    [data-bs-theme="dark"] .stat-icon-circle {
        opacity: 0.85;
    }

    /* ─── DARK MODE: QUICK LINK HOVER ─── */
    [data-bs-theme="dark"] .card {
        box-shadow: 0 1px 4px rgba(0, 0, 0, 0.2) !important;
    }

    /* ─── DARK MODE: TABLE THEAD ─── */
    [data-bs-theme="dark"] .table-light {
        --bs-table-bg: var(--bg-sidebar);
        --bs-table-color: var(--text-muted);
    }

    [data-bs-theme="dark"] .table thead th {
        background-color: var(--bg-sidebar);
        color: var(--text-muted);
        border-color: var(--border-color);
    }

    [data-bs-theme="dark"] .table tbody td {
        border-color: var(--border-color);
    }

    /* ─── DARK MODE: ALERTS ─── */
    [data-bs-theme="dark"] .alert-success {
        background-color: #052e16;
        border-color: #166534;
        color: #4ade80;
    }

    [data-bs-theme="dark"] .alert-danger {
        background-color: #3b1010;
        border-color: #7f1d1d;
        color: #fca5a5;
    }

    [data-bs-theme="dark"] .alert-warning {
        background-color: #3d2200;
        border-color: #854d0e;
        color: #fde68a;
    }

    [data-bs-theme="dark"] .alert-info {
        background-color: #0c1f3e;
        border-color: #1e40af;
        color: #93c5fd;
    }

    /* ─── DARK MODE: BADGES ─── */
    [data-bs-theme="dark"] .badge.bg-warning {
        background-color: #854d0e !important;
        color: #fde68a !important;
    }

    [data-bs-theme="dark"] .badge.bg-primary {
        background-color: #1e40af !important;
        color: #93c5fd !important;
    }

    [data-bs-theme="dark"] .badge.bg-success {
        background-color: #166534 !important;
        color: #4ade80 !important;
    }

    [data-bs-theme="dark"] .badge.bg-danger {
        background-color: #7f1d1d !important;
        color: #fca5a5 !important;
    }

    [data-bs-theme="dark"] .badge.bg-secondary {
        background-color: #33334a !important;
        color: #cccccc !important;
    }

    /* ─── DARK MODE: BUTTONS ─── */
    [data-bs-theme="dark"] .btn-outline-secondary {
        color: var(--text-secondary);
        border-color: var(--border-color);
    }

    [data-bs-theme="dark"] .btn-outline-secondary:hover {
        background-color: var(--bg-hover);
        color: var(--text-primary);
        border-color: var(--text-muted);
    }

    /* ─── DARK MODE: INPUT DATE/NUMBER ─── */
    [data-bs-theme="dark"] input[type="date"],
    [data-bs-theme="dark"] input[type="number"],
    [data-bs-theme="dark"] input[type="text"],
    [data-bs-theme="dark"] input[type="email"],
    [data-bs-theme="dark"] input[type="password"],
    [data-bs-theme="dark"] select {
        background-color: var(--bg-sidebar);
        border-color: var(--border-color);
        color: var(--text-primary);
    }

    [data-bs-theme="dark"] input[type="date"]::-webkit-calendar-picker-indicator,
    [data-bs-theme="dark"] input[type="number"]::-webkit-inner-spin-button {
        filter: invert(0.8);
    }

    /* ─── DARK MODE: SCROLLBAR ─── */
    [data-bs-theme="dark"] ::-webkit-scrollbar {
        width: 8px;
        height: 8px;
    }

    [data-bs-theme="dark"] ::-webkit-scrollbar-track {
        background: var(--bg-body);
    }

    [data-bs-theme="dark"] ::-webkit-scrollbar-thumb {
        background: #444;
        border-radius: 4px;
    }

    [data-bs-theme="dark"] ::-webkit-scrollbar-thumb:hover {
        background: #555;
    }

    * {
        box-sizing: border-box;
    }

    body {
        font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
        background: var(--bg-body);
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
        background: var(--bg-navbar);
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
        color: var(--text-primary);
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

    /* ─── THEME TOGGLE BUTTON ─── */
    .btn-theme-toggle {
        background: none;
        border: none;
        padding: 6px 8px;
        cursor: pointer;
        border-radius: 8px;
        transition: background 0.2s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        line-height: 1;
    }

    .btn-theme-toggle:hover {
        background: var(--bg-hover);
    }

    .btn-theme-toggle .icon-sun,
    .btn-theme-toggle .icon-moon {
        font-size: 18px;
        transition: opacity 0.2s ease;
    }

    .btn-theme-toggle .icon-sun {
        color: #f59e0b;
    }

    .btn-theme-toggle .icon-moon {
        color: #6366f1;
    }

    /* Show/hide icons based on theme */
    .btn-theme-toggle .icon-sun {
        display: none;
    }

    [data-bs-theme="dark"] .btn-theme-toggle .icon-sun {
        display: block;
    }

    [data-bs-theme="dark"] .btn-theme-toggle .icon-moon {
        display: none;
    }

    /* ─── SETTINGS DROPDOWN ─── */
    .settings-dropdown {
        position: relative;
    }

    .btn-settings-gear {
        background: none;
        border: none;
        padding: 6px 8px;
        cursor: pointer;
        border-radius: 8px;
        transition: background 0.2s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        line-height: 1;
    }

    .btn-settings-gear:hover {
        background: var(--bg-hover);
    }

    .btn-settings-gear i {
        font-size: 20px;
        color: #e65c00;
        transition: transform 0.3s ease;
    }

    .btn-settings-gear.show i {
        transform: rotate(90deg);
    }

    .settings-menu {
        min-width: 220px;
        background: var(--card-bg);
        border: 1px solid var(--border-color);
        border-radius: 14px;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
        padding: 8px 0;
        margin-top: 8px !important;
        animation: settingsFadeIn 0.2s ease;
    }

    @keyframes settingsFadeIn {
        from {
            opacity: 0;
            transform: translateY(-6px) scale(0.96);
        }
        to {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }

    .settings-menu .dropdown-user-header {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 12px 16px 10px;
    }

    .settings-menu .dropdown-user-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: linear-gradient(135deg, #ff7a00, #e65c00);
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
        font-weight: 700;
        flex-shrink: 0;
    }

    .settings-menu .dropdown-user-info {
        flex: 1;
        min-width: 0;
    }

    .settings-menu .dropdown-user-name {
        font-size: 14px;
        font-weight: 700;
        color: var(--text-primary);
        line-height: 1.3;
    }

    .settings-menu .dropdown-user-role {
        display: inline-block;
        font-size: 11px;
        font-weight: 600;
        padding: 1px 8px;
        border-radius: 20px;
        white-space: nowrap;
        margin-top: 2px;
    }

    .dropdown-user-role.owner {
        background: #fff0e0;
        color: #e65c00;
    }

    .dropdown-user-role.accountant {
        background: #dbeafe;
        color: #2563eb;
    }

    .dropdown-user-role.sales {
        background: #dcfce7;
        color: #16a34a;
    }

    .dropdown-user-role.site_office {
        background: #fef9c3;
        color: #a16207;
    }

    .settings-menu .dropdown-divider {
        border-top: 1px solid var(--border-color);
        margin: 4px 0;
    }

    .settings-menu .settings-item {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 9px 16px;
        font-size: 14px;
        color: var(--text-primary);
        text-decoration: none;
        border-left: 3px solid transparent;
        transition: all 0.15s ease;
    }

    .settings-menu .settings-item i {
        font-size: 16px;
        width: 20px;
        text-align: center;
        color: var(--text-muted);
        flex-shrink: 0;
    }

    .settings-menu .settings-item:hover {
        background: var(--bg-hover);
        border-left-color: #e65c00;
        color: var(--text-primary);
    }

    .settings-menu .settings-item:hover i {
        color: #e65c00;
    }

    .settings-menu .dropdown-logout {
        color: #dc2626;
    }

    .settings-menu .dropdown-logout i {
        color: #dc2626;
    }

    .settings-menu .dropdown-logout:hover {
        background: #fef2f2;
        border-left-color: #dc2626;
        color: #dc2626;
    }

    [data-bs-theme="dark"] .settings-menu .dropdown-logout:hover {
        background: #3b1010;
    }

    /* ─── GLOBAL TEXT COLOR OVERRIDES ─── */
    h1, h2, h3, h4, h5, h6,
    p, span, small, label,
    .card-body,
    .card-body p,
    .card-body span,
    .card-body small,
    .card-body label {
        color: var(--text-primary);
    }

    .text-muted {
        color: var(--text-muted) !important;
    }

    small, .small {
        color: var(--text-muted);
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
        background: var(--bg-sidebar);
        border-right: 1px solid var(--border-color);
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
        color: var(--text-primary);
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
        color: var(--text-muted);
    }

    .sidebar .nav-link:hover {
        background: var(--bg-hover);
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
        color: var(--text-muted);
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
        border-top: 1px solid var(--border-color);
        padding: 14px 0;
        font-size: 12px;
        color: var(--text-muted);
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
        color: var(--text-primary);
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

        /* Mobile: center dropdown on small screens */
        .settings-menu {
            position: fixed !important;
            left: 50% !important;
            top: 50% !important;
            transform: translate(-50%, -50%) !important;
            max-width: calc(100vw - 32px);
        }

        .settings-menu.show {
            transform: translate(-50%, -50%) !important;
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

            <!-- ─── THEME TOGGLE ─── -->
            <button class="btn-theme-toggle" onclick="toggleTheme()" title="Toggle light/dark mode" aria-label="Toggle theme">
                <i class="bi bi-moon-fill icon-moon"></i>
                <i class="bi bi-sun-fill icon-sun"></i>
            </button>

            <!-- ─── SETTINGS DROPDOWN ─── -->
            <div class="dropdown settings-dropdown">
                <button class="btn-settings-gear" type="button" data-bs-toggle="dropdown" aria-expanded="false" aria-label="Settings">
                    <i class="bi bi-gear-fill"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end settings-menu">
                    <!-- User Header -->
                    <div class="dropdown-user-header">
                        <div class="dropdown-user-avatar">
                            <?= substr(esc($name), 0, 1) ?>
                        </div>
                        <div class="dropdown-user-info">
                            <div class="dropdown-user-name"><?= esc($name) ?></div>
                            <span class="dropdown-user-role <?= $role ?>">
                                <?= ucfirst(str_replace('_', ' ', $role)) ?> · Tabasco
                            </span>
                        </div>
                    </div>
                    <div class="dropdown-divider"></div>
                    <!-- Menu Items -->
                    <a href="<?= site_url('settings') ?>" class="dropdown-item settings-item">
                        <i class="bi bi-gear"></i> Settings
                    </a>
                    <a href="<?= site_url('profile') ?>" class="dropdown-item settings-item">
                        <i class="bi bi-person"></i> My Profile
                    </a>
                    <a href="<?= site_url('change-password') ?>" class="dropdown-item settings-item">
                        <i class="bi bi-lock"></i> Change Password
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="<?= site_url('logout') ?>" class="dropdown-item settings-item dropdown-logout">
                        <i class="bi bi-box-arrow-right"></i> Logout
                    </a>
                </div>
            </div>
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

    // ─── THEME TOGGLE ───
    function toggleTheme() {
        var html = document.documentElement;
        var current = html.getAttribute('data-bs-theme');
        var next = current === 'dark' ? 'light' : 'dark';

        if (next === 'dark') {
            html.setAttribute('data-bs-theme', 'dark');
        } else {
            html.removeAttribute('data-bs-theme');
        }

        localStorage.setItem('tabasco_theme', next);
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