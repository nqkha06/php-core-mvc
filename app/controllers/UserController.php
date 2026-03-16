<?php

declare(strict_types=1);

class UserController extends Controller
{
    private User $userModel;

    public function __construct()
    {
        $this->userModel = new User();
    }

    public function index(): void
    {
        $this->requireAdmin();

        $this->render('users/index', [
            'title' => 'Quan ly user',
            'users' => $this->userModel->all(),
        ]);
    }

    public function create(): void
    {
        $this->requireAdmin();

        $this->render('users/create', [
            'title' => 'Them user',
            'errors' => [],
            'old' => ['name' => '', 'email' => '', 'role' => 'user'],
        ]);
    }

    public function store(): void
    {
        $this->requireAdmin();

        $data = [
            'name' => trim($_POST['name'] ?? ''),
            'email' => trim($_POST['email'] ?? ''),
            'password' => $_POST['password'] ?? '',
            'confirm_password' => $_POST['confirm_password'] ?? '',
            'role' => $_POST['role'] ?? 'user',
        ];

        $errors = $this->validateUserForm($data);

        if ($errors !== []) {
            $this->render('users/create', [
                'title' => 'Them user',
                'errors' => $errors,
                'old' => $data,
            ]);
            return;
        }

        $this->userModel->create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => password_hash($data['password'], PASSWORD_DEFAULT),
            'role' => $data['role'],
        ]);

        $this->setFlash('success', 'Tao user thanh cong.');
        $this->redirect('/users');
    }

    public function edit(string $id): void
    {
        $this->requireAdmin();

        $user = $this->userModel->findById((int) $id);

        if ($user === null) {
            $this->setFlash('error', 'Khong tim thay user.');
            $this->redirect('/users');
        }

        $this->render('users/edit', [
            'title' => 'Cap nhat user',
            'errors' => [],
            'userItem' => $user,
        ]);
    }

    public function update(string $id): void
    {
        $this->requireAdmin();

        $userId = (int) $id;
        $user = $this->userModel->findById($userId);

        if ($user === null) {
            $this->setFlash('error', 'Khong tim thay user.');
            $this->redirect('/users');
        }

        $data = [
            'name' => trim($_POST['name'] ?? ''),
            'email' => trim($_POST['email'] ?? ''),
            'password' => $_POST['password'] ?? '',
            'confirm_password' => $_POST['confirm_password'] ?? '',
            'role' => $_POST['role'] ?? 'user',
        ];

        $errors = $this->validateUserForm($data, $userId, false);

        if ($errors !== []) {
            $userItem = array_merge($user, $data);
            $this->render('users/edit', [
                'title' => 'Cap nhat user',
                'errors' => $errors,
                'userItem' => $userItem,
            ]);
            return;
        }

        $this->userModel->update($userId, [
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'] !== '' ? password_hash($data['password'], PASSWORD_DEFAULT) : '',
            'role' => $data['role'],
        ]);

        $this->setFlash('success', 'Cap nhat user thanh cong.');
        $this->redirect('/users');
    }

    public function delete(string $id): void
    {
        $this->requireAdmin();

        $userId = (int) $id;

        if (auth()['id'] === $userId) {
            $this->setFlash('error', 'Khong the xoa tai khoan dang dang nhap.');
            $this->redirect('/users');
        }

        if ($this->userModel->findById($userId) === null) {
            $this->setFlash('error', 'Khong tim thay user.');
            $this->redirect('/users');
        }

        $this->userModel->delete($userId);
        $this->setFlash('success', 'Xoa user thanh cong.');
        $this->redirect('/users');
    }

    private function validateUserForm(array $data, ?int $ignoreId = null, bool $requirePassword = true): array
    {
        $errors = [];

        if ($data['name'] === '') {
            $errors['name'] = 'Ho ten khong duoc de trong.';
        }

        if ($data['email'] === '') {
            $errors['email'] = 'Email khong duoc de trong.';
        } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Email khong dung dinh dang.';
        } elseif ($this->userModel->emailExists($data['email'], $ignoreId)) {
            $errors['email'] = 'Email da ton tai.';
        }

        if (!in_array($data['role'], ['admin', 'user'], true)) {
            $errors['role'] = 'Role khong hop le.';
        }

        if ($requirePassword && strlen($data['password']) < 6) {
            $errors['password'] = 'Mat khau phai co it nhat 6 ky tu.';
        }

        if (!$requirePassword && $data['password'] !== '' && strlen($data['password']) < 6) {
            $errors['password'] = 'Mat khau phai co it nhat 6 ky tu.';
        }

        if (($requirePassword || $data['password'] !== '') && $data['confirm_password'] !== $data['password']) {
            $errors['confirm_password'] = 'Xac nhan mat khau khong khop.';
        }

        return $errors;
    }
}
