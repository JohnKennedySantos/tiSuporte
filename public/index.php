<?php

declare(strict_types=1);


require_once __DIR__ . '/../vendor/autoload.php';

use App\Core\Router;
use App\Controller\LoginController;


session_start();

$rota = $_GET['rota'] ?? 'login';

$controller = new LoginController();
$router = new Router();

$router->add('login', fn() => $controller->exibirLogin());

$router->add('autenticar', fn() => $controller->autenticar());


$router->add('home', function () use ($controller) {
    if (!isset($_SESSION['usuario'])) {
        header('Location: index.php?rota=login');
        exit;
    }

    $controller->exibirHome();
});

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


$router->dispatch($rota);
