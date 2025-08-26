<?php

// Declara que o script usará tipagem estrita (evita conversões automáticas de tipos)
declare(strict_types=1);

// Carrega o autoloader do Composer para usar classes automaticamente
require_once __DIR__ . '/../vendor/autoload.php';

// Importa a classe LoginController do namespace App\Controller
use App\Controller\LoginController;

// Inicia a sessão para poder usar variáveis de sessão
session_start();

// Obtém a rota da URL (ex: index.php?rota=login). Se não houver, assume 'login' como padrão
$rota = $_GET['rota'] ?? 'login';

// Instancia o controlador responsável pelas ações de login
$controller = new LoginController();

// Define o comportamento com base na rota recebida
switch ($rota) {
    case 'login':
        // Exibe a tela de login
        $controller->exibirLogin();
        break;

    case 'autenticar':
        // Processa os dados do formulário de login e autentica o usuário
        $controller->autenticar();
        break;

    case 'dashboard':
        // Verifica se o usuário está logado (se existe na sessão)
        if (!isset($_SESSION['usuario'])) {
            // Se não estiver logado, redireciona para a tela de login
            header('Location: index.php?rota=login');
            exit;
        }
        // Se estiver logado, exibe uma mensagem de boas-vindas e um link para logout
        echo "<h1>Bem-vindo, {$_SESSION['usuario']['nome']}!</h1>";
        echo '<a href="index.php?rota=logout">Sair</a>';
        break;

    case 'logout':
        // Encerra a sessão (desloga o usuário)
        session_destroy();
        // Redireciona para a tela de login
        header('Location: index.php?rota=login');
        exit;

    default:
        // Se a rota não for reconhecida, exibe uma mensagem de erro
        echo 'Rota inválida.';
}
