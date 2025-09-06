<?php
use App\Controller\LoginController;
use App\Controller\HomeController;
use App\Controller\AtendimentoController;
use App\Controller\AtivosController;

function registrarRotas(\App\Core\Router $router): void
{
  
    $router->add('GET', 'login', [LoginController::class, 'exibirLogin']);
    $router->add('POST', 'autenticar', [LoginController::class, 'autenticar']);
    $router->add('GET', 'logout', [LoginController::class, 'sair']);

   
    $router->add('GET', 'home', [HomeController::class, 'exibirHome']);


    $router->add('GET', 'atendimentos', [AtendimentoController::class, 'listar']);
    $router->add('GET', 'novo-atendimento', [AtendimentoController::class, 'novo']);

    $router->add('GET', 'ativos', [AtivosController::class, 'listar']);

    
}
