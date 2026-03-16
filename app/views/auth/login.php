
<section class="auth-wrapper">
    <div class="card auth-card">
        <h1>Dang nhap</h1>
        <p class="muted">Su dung email va mat khau de truy cap he thong.</p>

        <?php if (!empty($errors['general'])): ?>
            <div class="alert alert-error"><?= e($errors['general']) ?></div>
        <?php endif; ?>

        <form method="POST" action="<?= e(url('/login')) ?>" class="form-card" novalidate>
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

            <button type="submit" class="button">Dang nhap</button>
        </form>

        <p class="switch-link">
            Chua co tai khoan?
            <a href="<?= e(url('/register')) ?>">Dang ky ngay</a>
        </p>
    </div>
</section>
