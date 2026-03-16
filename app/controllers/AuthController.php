<?php

declare(strict_types=1);

class AuthController extends Controller
{
    private User $userModel;

    public function __construct()
    {
        $this->userModel = new User();
    }

    public function showRegister(): void
    {
        if (!isGuest()) {
            $this->redirect('/');
        }

        $this->render('auth/register', [
            'title' => 'Dang ky',
            'errors' => [],
            'old' => ['name' => '', 'email' => ''],
        ]);
    }

    public function register(): void
    {
        if (!isGuest()) {
            $this->redirect('/');
        }

        $name = trim($_POST['name'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';
        $confirmPassword = $_POST['confirm_password'] ?? '';

        $errors = $this->validateRegister($name, $email, $password, $confirmPassword);

        if ($errors !== []) {
            $this->render('auth/register', [
                'title' => 'Dang ky',
                'errors' => $errors,
                'old' => compact('name', 'email'),
            ]);
            return;
        }

        $this->userModel->create([
            'name' => $name,
            'email' => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'role' => 'user',
        ]);

        $this->setFlash('success', 'Dang ky thanh cong. Vui long dang nhap.');
        $this->redirect('/login');
    }

    public function showLogin(): void
    {
        if (!isGuest()) {
            $this->redirect('/');
        }

        $this->render('auth/login', [
            'title' => 'Dang nhap',
            'errors' => [],
            'old' => ['email' => ''],
        ]);
    }

    public function login(): void
    {
        if (!isGuest()) {
            $this->redirect('/');
        }

        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';
        $errors = [];

        if ($email === '') {
            $errors['email'] = 'Email khong duoc de trong.';
        }

        if ($password === '') {
            $errors['password'] = 'Mat khau khong duoc de trong.';
        }

        $user = $errors === [] ? $this->userModel->findByEmail($email) : null;

        if ($user === null || !password_verify($password, $user['password'] ?? '')) {
            $errors['general'] = 'Email hoac mat khau khong dung.';
        }

        if ($errors !== []) {
            $this->render('auth/login', [
                'title' => 'Dang nhap',
                'errors' => $errors,
                'old' => compact('email'),
            ]);
            return;
        }

        $_SESSION['user'] = [
            'id' => (int) $user['id'],
            'name' => $user['name'],
            'email' => $user['email'],
            'role' => $user['role'],
        ];

        $this->setFlash('success', 'Dang nhap thanh cong.');
        $this->redirect('/');
    }

    public function logout(): void
    {
        unset($_SESSION['user']);
        session_regenerate_id(true);

        $this->setFlash('success', 'Ban da dang xuat.');
        $this->redirect('/login');
    }

    private function validateRegister(string $name, string $email, string $password, string $confirmPassword): array
    {
        $errors = [];

        if ($name === '') {
            $errors['name'] = 'Ho ten khong duoc de trong.';
        }

        if ($email === '') {
            $errors['email'] = 'Email khong duoc de trong.';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Email khong dung dinh dang.';
        } elseif ($this->userModel->emailExists($email)) {
            $errors['email'] = 'Email da ton tai.';
        }

        if (strlen($password) < 6) {
            $errors['password'] = 'Mat khau phai co it nhat 6 ky tu.';
        }

        if ($confirmPassword !== $password) {
            $errors['confirm_password'] = 'Xac nhan mat khau khong khop.';
        }

        return $errors;
    }
}
