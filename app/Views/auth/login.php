<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In — Tabasco Realty</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
    body {
        background: #f0f2f5;
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
        margin: 0;
        padding: 20px;
    }

    .login-card {
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 4px 24px rgba(0, 0, 0, 0.08);
        padding: 40px 36px;
        width: 100%;
        max-width: 460px;
    }

    .icon-circle {
        width: 72px;
        height: 72px;
        border-radius: 50%;
        background: linear-gradient(135deg, #ff7a00, #e65c00);
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
        box-shadow: 0 6px 20px rgba(230, 92, 0, 0.3);
    }

    .icon-circle i {
        font-size: 32px;
        color: #fff;
    }

    .login-card h1 {
        font-size: 26px;
        font-weight: 700;
        color: #1a1a2e;
        margin-bottom: 2px;
        text-align: center;
    }

    .login-card .subtitle {
        font-size: 13px;
        color: #6c757d;
        margin-bottom: 28px;
        text-align: center;
    }

    .system-grid {
        display: flex;
        gap: 12px;
        margin-bottom: 24px;
    }

    .system-card {
        flex: 1;
        border: 2px solid #e0e0e0;
        border-radius: 12px;
        padding: 14px 10px;
        text-align: center;
        cursor: pointer;
        transition: all 0.2s ease;
        user-select: none;
        background: #fafafa;
    }

    .system-card:hover {
        border-color: #ffb380;
        background: #fff5eb;
    }

    .system-card.selected {
        border-color: #e65c00;
        background: #fff0e0;
        box-shadow: 0 0 0 3px rgba(230, 92, 0, 0.12);
    }

    .system-card .flag {
        font-size: 28px;
        display: block;
        margin-bottom: 6px;
        line-height: 1.2;
    }

    .system-card .label {
        font-size: 14px;
        font-weight: 600;
        color: #212529;
    }

    .input-group-custom {
        margin-bottom: 16px;
    }

    .input-group-custom .input-group-text {
        background: #f8f9fa;
        border: 2px solid #e0e0e0;
        border-right: none;
        border-radius: 10px 0 0 10px;
        color: #6c757d;
        font-size: 16px;
        padding: 10px 14px;
    }

    .input-group-custom .form-control {
        border: 2px solid #e0e0e0;
        border-left: none;
        border-radius: 0 10px 10px 0;
        padding: 10px 16px;
        font-size: 15px;
        box-shadow: none;
        transition: border-color 0.25s ease, box-shadow 0.25s ease;
    }

    .input-group-custom .form-control:focus {
        border-color: #e65c00;
        box-shadow: 0 0 0 3px rgba(230, 92, 0, 0.12);
    }

    .input-group-custom .form-control:focus+.input-group-text,
    .input-group-custom .input-group-text:has(~ .form-control:focus) {
        border-color: #e65c00;
    }

    .password-wrapper {
        position: relative;
        flex: 1;
    }

    .password-wrapper .form-control {
        padding-right: 44px;
        border-left: none;
        border-radius: 0 10px 10px 0;
    }

    .password-toggle {
        position: absolute;
        right: 12px;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        color: #6c757d;
        cursor: pointer;
        font-size: 18px;
        padding: 4px;
        line-height: 1;
        z-index: 5;
    }

    .password-toggle:hover {
        color: #212529;
    }

    .btn-signin {
        width: 100%;
        padding: 13px;
        font-weight: 700;
        font-size: 16px;
        border-radius: 10px;
        margin-top: 8px;
        background: linear-gradient(135deg, #ff7a00, #e65c00);
        border: none;
        color: #fff;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .btn-signin:hover {
        transform: translateY(-1px);
        box-shadow: 0 6px 20px rgba(230, 92, 0, 0.35);
        color: #fff;
    }

    .btn-signin:active {
        transform: translateY(0);
    }

    .alert-custom {
        font-size: 14px;
        padding: 12px 16px;
        border-radius: 10px;
        margin-bottom: 18px;
    }

    .footer-text {
        text-align: center;
        margin-top: 28px;
        font-size: 12px;
        color: #adb5bd;
        letter-spacing: 0.3px;
    }

    .footer-text i {
        font-size: 10px;
        margin-right: 4px;
    }
    </style>
</head>

<body>
    <div class="login-card">
        <!-- Orange Circle Icon -->
        <div class="icon-circle">
            <i class="bi bi-building"></i>
        </div>

        <h1>Tabasco Realty</h1>
        <p class="subtitle">Real Estate Management</p>

        <?php if (isset($error) && $error): ?>
        <div class="alert alert-danger alert-custom d-flex align-items-center">
            <i class="bi bi-exclamation-triangle-fill me-2 flex-shrink-0"></i>
            <span><?= esc($error) ?></span>
        </div>
        <?php endif; ?>

        <form action="<?= site_url('login') ?>" method="POST">
            <?= csrf_field() ?>

            <!-- System Selector -->
            <label class="form-label fw-semibold small text-muted mb-2">Select System</label>
            <div class="system-grid" id="systemGrid">
                <div class="system-card selected" data-value="india" onclick="selectSystem(this)">
                    <span class="flag">🇮🇳</span>
                    <div class="label">India System</div>
                </div>
                <div class="system-card" data-value="uae" onclick="selectSystem(this)">
                    <span class="flag">🇦🇪</span>
                    <div class="label">UAE System</div>
                </div>
            </div>
            <input type="hidden" name="system" id="systemInput" value="india">

            <!-- Email -->
            <div class="input-group-custom">
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email"
                        value="<?= old('email') ?>" required>
                </div>
            </div>

            <!-- Password with Eye Toggle -->
            <div class="input-group-custom">
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-lock"></i></span>
                    <div class="password-wrapper">
                        <input type="password" class="form-control" id="password" name="password"
                            placeholder="Enter your password" required>
                        <button type="button" class="password-toggle" onclick="togglePassword()" tabindex="-1">
                            <i class="bi bi-eye-slash" id="eyeIcon"></i>
                        </button>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-signin">
                <i class="bi bi-box-arrow-in-right me-1"></i> Sign In
            </button>
        </form>

        <div class="footer-text">
            <i class="bi bi-shield-lock"></i> Secure access &middot; Tabasco Hindustan Infra Developers
        </div>
    </div>

    <script>
    // Select system card
    function selectSystem(el) {
        document.querySelectorAll('.system-card').forEach(function(c) {
            c.classList.remove('selected');
        });
        el.classList.add('selected');
        document.getElementById('systemInput').value = el.dataset.value;
    }

    // Toggle password visibility
    function togglePassword() {
        var pwd = document.getElementById('password');
        var icon = document.getElementById('eyeIcon');
        if (pwd.type === 'password') {
            pwd.type = 'text';
            icon.className = 'bi bi-eye';
        } else {
            pwd.type = 'password';
            icon.className = 'bi bi-eye-slash';
        }
    }
    </script>
</body>

</html>