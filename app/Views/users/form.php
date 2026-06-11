<?php
$errors = session()->getFlashdata('errors') ?? [];
$old    = session()->getFlashdata('old') ?? [];
?>
<?php ob_start() ?>

<div class="row justify-content-center">
    <div class="col-lg-8 col-xl-6">
        <div class="card border-0 shadow-sm" style="border-radius: 14px;">
            <div class="card-header bg-transparent border-bottom-0 pt-4 pb-0 px-4">
                <h5 class="fw-bold mb-0" style="color: #1a1a2e;">
                    <?= $mode === 'create' ? 'Add New User' : 'Edit User: ' . esc($user['name']) ?>
                </h5>
                <p class="text-muted small mb-0 mt-1">
                    <?= $mode === 'create' ? 'Fill in the details to create a new user account.' : 'Update user details below.' ?>
                </p>
            </div>
            <div class="card-body px-4 py-4">

                <form method="POST"
                    action="<?= $mode === 'create' ? site_url('users/store') : site_url('users/update/' . $user['id']) ?>">
                    <?= csrf_field() ?>

                    <!-- Full Name -->
                    <div class="mb-3">
                        <label for="name" class="form-label fw-semibold" style="font-size: 14px; color: #333;">Full Name
                            <span class="text-danger">*</span></label>
                        <input type="text" class="form-control <?= isset($errors['name']) ? 'is-invalid' : '' ?>"
                            id="name" name="name" value="<?= esc($old['name'] ?? ($user['name'] ?? '')) ?>" required>
                        <?php if (isset($errors['name'])): ?>
                        <div class="invalid-feedback"><?= esc($errors['name']) ?></div>
                        <?php endif; ?>
                    </div>

                    <!-- Email -->
                    <div class="mb-3">
                        <label for="email" class="form-label fw-semibold" style="font-size: 14px; color: #333;">Email
                            <span class="text-danger">*</span></label>
                        <input type="email" class="form-control <?= isset($errors['email']) ? 'is-invalid' : '' ?>"
                            id="email" name="email" value="<?= esc($old['email'] ?? ($user['email'] ?? '')) ?>"
                            <?= $mode === 'edit' ? 'readonly style="background: #f8f9fa; color: #6c757d;"' : 'required' ?>>
                        <?php if (isset($errors['email'])): ?>
                        <div class="invalid-feedback"><?= esc($errors['email']) ?></div>
                        <?php endif; ?>
                    </div>

                    <!-- Password -->
                    <div class="mb-3">
                        <label for="password" class="form-label fw-semibold" style="font-size: 14px; color: #333;">
                            Password <?= $mode === 'create' ? '<span class="text-danger">*</span>' : '' ?>
                        </label>
                        <div class="input-group">
                            <input type="password"
                                class="form-control <?= isset($errors['password']) ? 'is-invalid' : '' ?>" id="password"
                                name="password"
                                placeholder="<?= $mode === 'create' ? 'Enter password' : 'Leave blank to keep current' ?>"
                                <?= $mode === 'create' ? 'required' : '' ?>>
                            <button type="button" class="btn btn-outline-secondary" onclick="togglePassword()"
                                tabindex="-1">
                                <i class="bi bi-eye-slash" id="eyeIcon"></i>
                            </button>
                            <?php if (isset($errors['password'])): ?>
                            <div class="invalid-feedback"><?= esc($errors['password']) ?></div>
                            <?php endif; ?>
                        </div>
                        <?php if ($mode === 'edit'): ?>
                        <div class="form-text text-muted small">Leave blank to keep current password.</div>
                        <?php endif; ?>
                    </div>

                    <!-- Role -->
                    <div class="mb-3">
                        <label for="role" class="form-label fw-semibold" style="font-size: 14px; color: #333;">Role
                            <span class="text-danger">*</span></label>
                        <select class="form-select <?= isset($errors['role']) ? 'is-invalid' : '' ?>" id="role"
                            name="role" required>
                            <option value="">-- Select Role --</option>
                            <option value="owner"
                                <?= (($old['role'] ?? ($user['role'] ?? '')) === 'owner') ? 'selected' : '' ?>>Owner
                            </option>
                            <option value="accountant"
                                <?= (($old['role'] ?? ($user['role'] ?? '')) === 'accountant') ? 'selected' : '' ?>>
                                Accountant</option>
                            <option value="sales"
                                <?= (($old['role'] ?? ($user['role'] ?? '')) === 'sales') ? 'selected' : '' ?>>Sales
                                Team</option>
                            <option value="site_office"
                                <?= (($old['role'] ?? ($user['role'] ?? '')) === 'site_office') ? 'selected' : '' ?>>
                                Site Office</option>
                        </select>
                        <?php if (isset($errors['role'])): ?>
                        <div class="invalid-feedback"><?= esc($errors['role']) ?></div>
                        <?php endif; ?>
                    </div>

                    <!-- System -->
                    <div class="mb-3">
                        <label for="system" class="form-label fw-semibold" style="font-size: 14px; color: #333;">System
                            <span class="text-danger">*</span></label>
                        <select class="form-select <?= isset($errors['system']) ? 'is-invalid' : '' ?>" id="system"
                            name="system" <?= $mode === 'edit' ? 'disabled' : '' ?> required>
                            <option value="">-- Select System --</option>
                            <option value="india"
                                <?= (($old['system'] ?? ($user['system'] ?? '')) === 'india') ? 'selected' : '' ?>>India
                            </option>
                            <option value="uae"
                                <?= (($old['system'] ?? ($user['system'] ?? '')) === 'uae') ? 'selected' : '' ?>>UAE
                            </option>
                        </select>
                        <?php if (isset($errors['system'])): ?>
                        <div class="invalid-feedback"><?= esc($errors['system']) ?></div>
                        <?php endif; ?>
                        <?php if ($mode === 'edit'): ?>
                        <input type="hidden" name="system" value="<?= $user['system'] ?>">
                        <?php endif; ?>
                    </div>

                    <!-- Active (edit only) -->
                    <?php if ($mode === 'edit'): ?>
                    <div class="mb-4">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="is_active" name="is_active" value="1"
                                <?= ($old['is_active'] ?? $user['is_active']) ? 'checked' : '' ?>>
                            <label class="form-check-label fw-semibold" for="is_active"
                                style="font-size: 14px; color: #333;">Account is active</label>
                        </div>
                    </div>
                    <?php endif; ?>

                    <!-- Buttons -->
                    <div class="d-flex gap-2 pt-2">
                        <button type="submit" class="btn"
                            style="background: linear-gradient(135deg, #ff7a00, #e65c00); color: #fff; border: none; border-radius: 10px; padding: 11px 28px; font-weight: 600;">
                            <i class="bi bi-check-lg me-1"></i> Save User
                        </button>
                        <a href="<?= site_url('users') ?>" class="btn btn-outline-secondary"
                            style="border-radius: 10px; padding: 11px 28px; font-weight: 600;">
                            Cancel
                        </a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<script>
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

<?php $content = ob_get_clean() ?>
<?= view('layouts/main', ['content' => $content, 'title' => $mode === 'create' ? 'Add New User' : 'Edit User']) ?>
</write_to_file>
<task_progress>
    - [x] Create app/Controllers/UserController.php
    - [x] Create app/Views/errors/403.php
    - [x] Create app/Views/users/index.php
    - [x] Create app/Views/users/form.php
    - [ ] Update app/Config/Routes.php
</task_progress>
</write_to_file>