<?php $flash = $_SESSION['flash'] ?? null; ?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($title) ?></title>
    <link rel="stylesheet" href="<?= e(asset('/assets/css/style.css')) ?>">
</head>
<body>
    <header class="site-header">
        <div class="container nav">
            <a class="brand" href="<?= e(url('/')) ?>">PHP Core MVC</a>
            <nav>
                <?php if (auth()): ?>
                    <a href="<?= e(url('/')) ?>">Dashboard</a>
                    <?php if (hasRole('admin')): ?>
                        <a href="<?= e(url('/users')) ?>">Quan ly user</a>
                    <?php endif; ?>
                    <span class="welcome">Xin chao, <?= e(auth()['name']) ?></span>
                    <a class="button button-light" href="<?= e(url('/logout')) ?>">Dang xuat</a>
                <?php else: ?>
                    <a href="<?= e(url('/login')) ?>">Dang nhap</a>
                    <a class="button" href="<?= e(url('/register')) ?>">Dang ky</a>
                <?php endif; ?>
            </nav>
        </div>
    </header>

    <main class="container page-content">
        <?php if ($flash): ?>
            <div class="alert alert-<?= e($flash['type']) ?>">
                <?= e($flash['message']) ?>
            </div>
            <?php unset($_SESSION['flash']); ?>
        <?php endif; ?>
