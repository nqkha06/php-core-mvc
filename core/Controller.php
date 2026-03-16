<?php

declare(strict_types=1);

class Controller
{
    protected function render(string $view, array $data = []): void
    {
        $viewPath = ROOT_PATH . '/app/views/' . $view . '.php';

        if (!file_exists($viewPath)) {
            http_response_code(500);
            echo 'View not found';
            return;
        }

        extract($data);
        $title = $data['title'] ?? 'PHP Core MVC';

        include ROOT_PATH . '/app/views/layouts/header.php';
        include $viewPath;
        include ROOT_PATH . '/app/views/layouts/footer.php';
    }

    protected function redirect(string $path): void
    {
        header('Location: ' . url($path));
        exit;
    }

    protected function setFlash(string $type, string $message): void
    {
        $_SESSION['flash'] = [
            'type' => $type,
            'message' => $message,
        ];
    }

    protected function requireAuth(): void
    {
        if (isGuest()) {
            $this->setFlash('error', 'Vui long dang nhap de tiep tuc.');
            $this->redirect('/login');
        }
    }

    protected function requireAdmin(): void
    {
        $this->requireAuth();

        if (!hasRole('admin')) {
            $this->setFlash('error', 'Ban khong co quyen truy cap chuc nang nay.');
            $this->redirect('/');
        }
    }
}
