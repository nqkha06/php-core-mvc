<?php

declare(strict_types=1);

session_start();

define('ROOT_PATH', dirname(__DIR__));

$scriptName = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? ''));
define('BASE_URL', $scriptName === '/' ? '' : rtrim($scriptName, '/'));

require ROOT_PATH . '/core/helpers.php';
require ROOT_PATH . '/core/Router.php';
require ROOT_PATH . '/core/Controller.php';
require ROOT_PATH . '/config/database.php';
require ROOT_PATH . '/app/models/User.php';
require ROOT_PATH . '/app/controllers/HomeController.php';
require ROOT_PATH . '/app/controllers/AuthController.php';
require ROOT_PATH . '/app/controllers/UserController.php';

$router = new Router();

require ROOT_PATH . '/routes.php';

$router->dispatch($_SERVER['REQUEST_METHOD'] ?? 'GET', $_SERVER['REQUEST_URI'] ?? '/');
