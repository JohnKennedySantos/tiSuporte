<?php
declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use App\Core\Router;

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$router = new Router();

// Registra todas as rotas
require_once __DIR__ . '/../src/routes.php';
registrarRotas($router);

$rota = $_GET['rota'] ?? 'login';
$method = $_SERVER['REQUEST_METHOD'];

$router->dispatch($method, $rota);
