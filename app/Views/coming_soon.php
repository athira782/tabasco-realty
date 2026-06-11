<?php ob_start() ?>
<div class="d-flex align-items-center justify-content-center" style="min-height: 60vh;">
    <div class="text-center">
        <div style="font-size: 72px; line-height: 1; margin-bottom: 16px;">🚧</div>
        <h3 class="fw-bold mb-2" style="color: #1a1a2e;"><?= esc($module) ?></h3>
        <p class="text-muted mb-3" style="font-size: 15px;">This module is under development</p>
        <span class="badge fs-6 px-3 py-2 mb-4"
            style="background: #fff0e0; color: #e65c00; font-weight: 600; border-radius: 20px;">
            Coming Soon
        </span>
        <div>
            <a href="<?= site_url('dashboard') ?>" class="btn btn-primary px-4 py-2"
                style="background: linear-gradient(135deg, #ff7a00, #e65c00); border: none; border-radius: 10px; font-weight: 600;">
                <i class="bi bi-arrow-left me-1"></i> Back to Dashboard
            </a>
        </div>
    </div>
</div>
<?php $content = ob_get_clean() ?>
<?= view('layouts/main', ['content' => $content, 'title' => $module]) ?>