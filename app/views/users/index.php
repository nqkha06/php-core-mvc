<section class="page-heading">
    <div>
        <h1>Danh sach user</h1>
        <p class="muted">Chi admin moi co quyen CRUD user.</p>
    </div>
    <a class="button" href="<?= e(url('/users/create')) ?>">Them user</a>
</section>

<section class="card">
    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Ho ten</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Ngay tao</th>
                    <th>Hanh dong</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($users === []): ?>
                    <tr>
                        <td colspan="6" class="text-center">Chua co du lieu user.</td>
                    </tr>
                <?php endif; ?>

                <?php foreach ($users as $item): ?>
                    <tr>
                        <td><?= e((string) $item['id']) ?></td>
                        <td><?= e($item['name']) ?></td>
                        <td><?= e($item['email']) ?></td>
                        <td><span class="badge"><?= e($item['role']) ?></span></td>
                        <td><?= e($item['created_at']) ?></td>
                        <td class="actions">
                            <a class="button button-light" href="<?= e(url('/users/edit/' . $item['id'])) ?>">Sua</a>
                            <form method="POST" action="<?= e(url('/users/delete/' . $item['id'])) ?>" class="inline-form delete-form">
                                <button type="submit" class="button button-danger">Xoa</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</section>
