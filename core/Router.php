<?php

declare(strict_types=1);

class Router
{
    private array $routes = [];

    public function get(string $path, array $handler): void
    {
        $this->addRoute('GET', $path, $handler);
    }

    public function post(string $path, array $handler): void
    {
        $this->addRoute('POST', $path, $handler);
    }

    private function addRoute(string $method, string $path, array $handler): void
    {
        $this->routes[$method][] = [
            'path' => $this->normalizePath($path),
            'handler' => $handler,
        ];
    }

    public function dispatch(string $method, string $uri): void
    {
        $path = parse_url($uri, PHP_URL_PATH) ?: '/';
        $path = $this->stripBaseUrl($path);
        $path = $this->normalizePath($path);

        foreach ($this->routes[$method] ?? [] as $route) {
            $params = $this->match($route['path'], $path);

            if ($params === null) {
                continue;
            }

            [$controllerClass, $action] = $route['handler'];
            $controller = new $controllerClass();
            call_user_func_array([$controller, $action], $params);

            return;
        }

        http_response_code(404);
        echo '404 - Page not found';
    }

    private function match(string $routePath, string $requestPath): ?array
    {
        $routeParts = explode('/', trim($routePath, '/'));
        $requestParts = explode('/', trim($requestPath, '/'));

        if ($routePath === '/' && $requestPath === '/') {
            return [];
        }

        if (count($routeParts) !== count($requestParts)) {
            return null;
        }

        $params = [];

        foreach ($routeParts as $index => $routePart) {
            $requestPart = $requestParts[$index] ?? '';

            if (preg_match('/^\{(.+)\}$/', $routePart)) {
                $params[] = $requestPart;
                continue;
            }

            if ($routePart !== $requestPart) {
                return null;
            }
        }

        return $params;
    }

    private function normalizePath(string $path): string
    {
        if ($path === '') {
            return '/';
        }

        return '/' . trim($path, '/');
    }

    private function stripBaseUrl(string $path): string
    {
        if (BASE_URL !== '' && strpos($path, BASE_URL) === 0) {
            $path = substr($path, strlen(BASE_URL));
        }

        return $path === '' ? '/' : $path;
    }
}
