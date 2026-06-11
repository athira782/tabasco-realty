<?php
$session = session();
$authUser = $session->get('auth_user');
?>
<?php ob_start() ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0" style="color: #1a1a2e;">User Management</h4>
    <?php if (hasPermission('users', 'create')): ?>
    <a href="<?= site_url('users/create') ?>" class="btn"
        style="background: linear-gradient(135deg, #ff7a00, #e65c00); color: #fff; border: none; border-radius: 10px; padding: 10px 22px; font-weight: 600; font-size: 14px;">
        <i class="bi bi-plus-lg me-1"></i> Add User
    </a>
    <?php endif; ?>
</div>

<?php if (empty($users)): ?>
<div class="card border-0 shadow-sm" style="border-radius: 14px;">
    <div class="card-body text-center py-5">
        <i class="bi bi-people" style="font-size: 48px; color: #adb5bd;"></i>
        <h6 class="mt-3 text-muted">No users found</h6>
        <?php if (hasPermission('users', 'create')): ?>
        <a href="<?= site_url('users/create') ?>" class="btn btn-outline-secondary btn-sm mt-2">Add the first user</a>
        <?php endif; ?>
    </div>
</div>
<?php else: ?>
<div class="card border-0 shadow-sm" style="border-radius: 14px; overflow: hidden;">
    <div class="table-responsive">
        <table class="table table-striped table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th class="ps-4" style="font-size: 13px; font-weight: 600; color: #6c757d;">#</th>
                    <th style="font-size: 13px; font-weight: 600; color: #6c757d;">Name</th>
                    <th style="font-size: 13px; font-weight: 600; color: #6c757d;">Email</th>
                    <th style="font-size: 13px; font-weight: 600; color: #6c757d;">Role</th>
                    <th style="font-size: 13px; font-weight: 600; color: #6c757d;">System</th>
                    <th style="font-size: 13px; font-weight: 600; color: #6c757d;">Status</th>
                    <th style="font-size: 13px; font-weight: 600; color: #6c757d;">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1;
                    foreach ($users as $user): ?>
                <tr>
                    <td class="ps-4 text-muted" style="font-size: 14px;"><?= $i++ ?></td>
                    <td style="font-weight: 600; color: #1a1a2e;"><?= esc($user['name']) ?></td>
                    <td><?= esc($user['email']) ?></td>
                    <td>
                        <?php if ($user['role'] === 'owner'): ?>
                        <span class="badge"
                            style="background: #f3e8ff; color: #7c3aed; font-weight: 600; padding: 5px 12px; border-radius: 20px; font-size: 12px;">Owner</span>
                        <?php elseif ($user['role'] === 'accountant'): ?>
                        <span class="badge bg-primary"
                            style="font-weight: 600; padding: 5px 12px; border-radius: 20px; font-size: 12px;">Accountant</span>
                        <?php elseif ($user['role'] === 'sales'): ?>
                        <span class="badge bg-success"
                            style="font-weight: 600; padding: 5px 12px; border-radius: 20px; font-size: 12px;">Sales
                            Team</span>
                        <?php elseif ($user['role'] === 'site_office'): ?>
                        <span class="badge bg-warning text-dark"
                            style="font-weight: 600; padding: 5px 12px; border-radius: 20px; font-size: 12px;">Site
                            Office</span>
                        <?php else: ?>
                        <span class="badge bg-secondary"
                            style="font-weight: 600; padding: 5px 12px; border-radius: 20px; font-size: 12px;"><?= esc(ucfirst($user['role'])) ?></span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if ($user['system'] === 'india'): ?>
                        <span class="badge"
                            style="background: #fff0e0; color: #e65c00; font-weight: 600; padding: 5px 12px; border-radius: 20px; font-size: 12px;">
                            <i class="bi bi-globe2 me-1"></i> India
                        </span>
                        <?php else: ?>
                        <span class="badge"
                            style="background: #e0f2fe; color: #0369a1; font-weight: 600; padding: 5px 12px; border-radius: 20px; font-size: 12px;">
                            <i class="bi bi-globe2 me-1"></i> UAE
                        </span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if ($user['is_active']): ?>
                        <span class="badge bg-success"
                            style="font-weight: 600; padding: 5px 12px; border-radius: 20px; font-size: 12px;">Active</span>
                        <?php else: ?>
                        <span class="badge bg-secondary"
                            style="font-weight: 600; padding: 5px 12px; border-radius: 20px; font-size: 12px;">Inactive</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <div class="d-flex gap-1">
                            <?php if (hasPermission('users', 'edit')): ?>
                            <a href="<?= site_url('users/edit/' . $user['id']) ?>"
                                class="btn btn-sm btn-outline-primary" style="border-radius: 8px;" title="Edit">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <?php if ($user['is_active'] && $authUser['id'] !== $user['id']): ?>
                            <form method="POST" action="<?= site_url('users/deactivate/' . $user['id']) ?>"
                                onsubmit="return confirm('Deactivate this user?')" style="display: inline;">
                                <?= csrf_field() ?>
                                <button type="submit" class="btn btn-sm btn-outline-danger" style="border-radius: 8px;"
                                    title="Deactivate">
                                    <i class="bi bi-x-circle"></i>
                                </button>
                            </form>
                            <?php endif; ?>
                            <?php endif; ?>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?php endif; ?>

<?php $content = ob_get_clean() ?>
<?= view('layouts/main', ['content' => $content, 'title' => 'User Management']) ?>
</write_to_file>
<task_progress>
    - [x] Create app/Controllers/UserController.php
    - [x] Create app/Views/errors/403.php
    - [x] Create app/Views/users/index.php
    - [ ] Create app/Views/users/form.php
    - [ ] Update app/Config/Routes.php
</task_progress>