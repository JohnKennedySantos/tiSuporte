<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use App\Core\Router;
use App\Controller\LoginController;
use App\Controller\DashboardController;


session_start();

// Instanciando o roteador
$router = new Router();

// ROTAS DE LOGIN
$loginController = new LoginController();

$router->add('login', fn() => $loginController->exibirLogin());
$router->add('autenticar', fn() => $loginController->autenticar());

// ROTA HOME (protegida por sessão)
$router->add('home', function () use ($loginController) {
    if (!isset($_SESSION['usuario'])) {
        header('Location: index.php?rota=login');
        exit;
    }
    $loginController->exibirHome();
});

// ROTA LOGOUT
$router->add('logout', function () {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        unset($_SESSION['usuario']);
        session_destroy();
        header('Location: index.php?rota=login');
        exit;
    }
    header('Location: index.php?rota=home');
    exit;
});

// ROTAS DASHBOARD
$router->add('dashboard', function () {
    if (!isset($_SESSION['usuario'])) {
        header('Location: index.php?rota=login');
        exit;
    }
    $controller = new DashboardController();
    $controller->index();
});


// Captura da rota atual
$rota = $_GET['rota'] ?? 'login';

// Dispara a rota
$router->dispatch($rota);
