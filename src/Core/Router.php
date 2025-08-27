<?php

namespace App\Core;

class Router
{
    // Armazena as rotas registradas
    private array $routes = [];

    /**
     * Registra uma rota e sua ação correspondente
     *
     * @param string $rota Nome da rota (ex: 'login', 'home')
     * @param callable $action Função que será executada quando a rota for chamada
     */
    public function add(string $rota, callable $action): void
    {
        $this->routes[$rota] = $action;
    }

    /**
     * Executa a ação correspondente à rota solicitada
     *
     * @param string $rota Rota recebida via URL (ex: index.php?rota=home)
     */
    public function dispatch(string $rota): void
    {
        if (isset($this->routes[$rota])) {
   
            call_user_func($this->routes[$rota]);
        } else {
           
            echo '<h1>404 - Rota inválida</h1>';
        }
    }
}
