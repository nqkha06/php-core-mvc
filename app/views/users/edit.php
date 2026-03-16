<section class="card form-section">
    <h1>Cap nhat user #<?= e((string) $userItem['id']) ?></h1>

    <form method="POST" action="<?= e(url('/users/update/' . $userItem['id'])) ?>" class="form-card" novalidate>
        <label for="name">Ho ten</label>
        <input id="name" type="text" name="name" value="<?= e($userItem['name'] ?? '') ?>" required>
        <?php if (!empty($errors['name'])): ?>
            <small class="error-text"><?= e($errors['name']) ?></small>
        <?php endif; ?>

        <label for="email">Email</label>
        <input id="email" type="email" name="email" value="<?= e($userItem['email'] ?? '') ?>" required>
        <?php if (!empty($errors['email'])): ?>
            <small class="error-text"><?= e($errors['email']) ?></small>
        <?php endif; ?>

        <label for="role">Role</label>
        <select id="role" name="role">
            <option value="user" <?= ($userItem['role'] ?? 'user') === 'user' ? 'selected' : '' ?>>User</option>
            <option value="admin" <?= ($userItem['role'] ?? '') === 'admin' ? 'selected' : '' ?>>Admin</option>
        </select>
        <?php if (!empty($errors['role'])): ?>
            <small class="error-text"><?= e($errors['role']) ?></small>
        <?php endif; ?>

        <label for="password">Mat khau moi</label>
        <input id="password" type="password" name="password">
        <small class="muted">Bo trong neu khong muon doi mat khau.</small>
        <?php if (!empty($errors['password'])): ?>
            <small class="error-text"><?= e($errors['password']) ?></small>
        <?php endif; ?>

        <label for="confirm_password">Xac nhan mat khau moi</label>
        <input id="confirm_password" type="password" name="confirm_password">
        <?php if (!empty($errors['confirm_password'])): ?>
            <small class="error-text"><?= e($errors['confirm_password']) ?></small>
        <?php endif; ?>

        <div class="form-actions">
            <button type="submit" class="button">Cap nhat</button>
            <a class="button button-light" href="<?= e(url('/users')) ?>">Quay lai</a>
        </div>
    </form>
</section>
