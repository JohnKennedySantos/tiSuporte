<?php


declare(strict_types=1);


require_once __DIR__ . '/../vendor/autoload.php';

use App\Controller\LoginController;


session_start();

$rota = $_GET['rota'] ?? 'login';

$controller = new LoginController();

switch ($rota) {
    case 'login':
        $controller->exibirLogin();
        break;

    case 'autenticar':
        $controller->autenticar();
        break;

    case 'dashboard':
        if (!isset($_SESSION['usuario'])) {
            header('Location: index.php?rota=login');
            exit;
        }
        echo "<h1>Bem-vindo, {$_SESSION['usuario']['nome']}!</h1>";
        echo '<a href="index.php?rota=logout">Sair</a>';
        break;

    case 'logout':
        session_destroy();
        header('Location: index.php?rota=login');
        exit;

    default:
        echo 'Rota inválida.';
}
