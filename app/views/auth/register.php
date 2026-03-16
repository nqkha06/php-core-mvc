<section class="auth-wrapper">
    <div class="card auth-card">
        <h1>Dang ky tai khoan</h1>
        <p class="muted">Tai khoan dang ky moi mac dinh co role `user`.</p>

        <form method="POST" action="<?= e(url('/register')) ?>" class="form-card" novalidate>
            <label for="name">Ho ten</label>
            <input id="name" type="text" name="name" value="<?= e($old['name'] ?? '') ?>" required>
            <?php if (!empty($errors['name'])): ?>
                <small class="error-text"><?= e($errors['name']) ?></small>
            <?php endif; ?>

            <label for="email">Email</label>
            <input id="email" type="email" name="email" value="<?= e($old['email'] ?? '') ?>" required>
            <?php if (!empty($errors['email'])): ?>
                <small class="error-text"><?= e($errors['email']) ?></small>
            <?php endif; ?>

            <label for="password">Mat khau</label>
            <input id="password" type="password" name="password" required>
            <?php if (!empty($errors['password'])): ?>
                <small class="error-text"><?= e($errors['password']) ?></small>
            <?php endif; ?>

            <label for="confirm_password">Xac nhan mat khau</label>
            <input id="confirm_password" type="password" name="confirm_password" required>
            <?php if (!empty($errors['confirm_password'])): ?>
                <small class="error-text"><?= e($errors['confirm_password']) ?></small>
            <?php endif; ?>

            <button type="submit" class="button">Tao tai khoan</button>
        </form>

        <p class="switch-link">
            Da co tai khoan?
            <a href="<?= e(url('/login')) ?>">Dang nhap</a>
        </p>
    </div>
</section>
