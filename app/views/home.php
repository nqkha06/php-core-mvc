<section class="card hero">
    <h1>He thong quan ly user bang PHP Core</h1>
    <p>Du an nay su dung router tu `index.php`, mo hinh MVC, session cho dang nhap va PDO de thao tac MySQL.</p>

    <div class="dashboard-grid">
        <div class="info-box">
            <span class="label">Ho ten</span>
            <strong><?= e($user['name']) ?></strong>
        </div>
        <div class="info-box">
            <span class="label">Email</span>
            <strong><?= e($user['email']) ?></strong>
        </div>
        <div class="info-box">
            <span class="label">Role</span>
            <strong><?= e($user['role']) ?></strong>
        </div>
    </div>

    <?php if (hasRole('admin')): ?>
        <a class="button" href="<?= e(url('/users')) ?>">Vao trang quan ly user</a>
    <?php endif; ?>
</section>

<section class="card explanation">
    <h2>Giai thich ngan gon</h2>
    <ul>
        <li>Router nhan URL hien tai, doi chieu voi cac route trong `routes.php`, sau do goi dung controller va action.</li>
        <li>Controller xu ly request, validate du lieu, goi model `User` de doc/ghi database.</li>
        <li>View nhan du lieu tu controller qua mang `$data` va hien thi ra HTML.</li>
    </ul>
</section>
