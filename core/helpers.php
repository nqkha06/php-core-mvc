<?php

declare(strict_types=1);

function url(string $path = ''): string
{
    $path = '/' . ltrim($path, '/');

    if ($path === '/') {
        return BASE_URL !== '' ? BASE_URL . '/' : '/';
    }

    return (BASE_URL ?: '') . $path;
}

function asset(string $path): string
{
    return url($path);
}

function e(?string $value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

function auth(): ?array
{
    return $_SESSION['user'] ?? null;
}

function isGuest(): bool
{
    return auth() === null;
}

function hasRole(string $role): bool
{
    return isset($_SESSION['user']['role']) && $_SESSION['user']['role'] === $role;
}

function env(string $key, $default = null)
{
    static $env = null;

    if ($env === null) {
        $envFile = ROOT_PATH . '/.env';
        $env = file_exists($envFile) ? parse_ini_file($envFile) : [];
    }

    return $env[$key] ?? $default;
}
