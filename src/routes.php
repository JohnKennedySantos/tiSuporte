<?php
use App\Controller\LoginController;
use App\Controller\HomeController;
use App\Controller\AtendimentoController;

/**
 * Registra todas as rotas do sistema
 */
function registrarRotas(\App\Core\Router $router): void
{
    // ROTAS DE LOGIN
    $router->add('GET', 'login', [LoginController::class, 'exibirLogin']);
    $router->add('POST', 'autenticar', [LoginController::class, 'autenticar']);
    $router->add('GET', 'logout', [LoginController::class, 'sair']);

    // ROTA HOME (protegida)
    $router->add('GET', 'home', [HomeController::class, 'exibirHome']);

    // ROTAS ATENDIMENTOS (protegidas)
    $router->add('GET', 'atendimentos', [AtendimentoController::class, 'listar']);
    $router->add('GET', 'novo-atendimento', [AtendimentoController::class, 'novo']);

    // Aqui você pode adicionar novas rotas futuras
}
