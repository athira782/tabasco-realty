<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>403 - Access Denied</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
    body {
        background: #f0f2f5;
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: 'Segoe UI', system-ui, sans-serif;
        margin: 0;
        padding: 20px;
    }

    .error-card {
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 4px 24px rgba(0, 0, 0, 0.08);
        padding: 48px 40px;
        text-align: center;
        max-width: 440px;
        width: 100%;
    }

    .error-card .icon-lock {
        width: 72px;
        height: 72px;
        border-radius: 50%;
        background: #fee2e2;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
    }

    .error-card .icon-lock i {
        font-size: 32px;
        color: #dc2626;
    }

    .error-card h1 {
        font-size: 28px;
        font-weight: 700;
        color: #1a1a2e;
        margin-bottom: 8px;
    }

    .error-card p {
        color: #6c757d;
        font-size: 15px;
        margin-bottom: 28px;
    }

    .btn-orange {
        background: linear-gradient(135deg, #ff7a00, #e65c00);
        border: none;
        color: #fff;
        padding: 12px 28px;
        border-radius: 10px;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .btn-orange:hover {
        transform: translateY(-1px);
        box-shadow: 0 6px 20px rgba(230, 92, 0, 0.35);
        color: #fff;
    }
    </style>
</head>

<body>
    <div class="error-card">
        <div class="icon-lock">
            <i class="bi bi-lock-fill"></i>
        </div>
        <h1>Access Denied</h1>
        <p><?= esc($message ?? 'You don\'t have permission to access this page.') ?></p>
        <a href="<?= site_url('/dashboard') ?>" class="btn-orange">
            <i class="bi bi-grid-1x2-fill"></i> Go to Dashboard
        </a>
    </div>
</body>

</html>
</write_to_file>