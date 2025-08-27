<?php

namespace App\Core;

class Router
{
    private array $routes = [];


    public function add(string $rota, callable $action): void
    {
        $this->routes[$rota] = $action;
    }

    public function dispatch(string $rota): void
    {
        if (isset($this->routes[$rota])) {
            call_user_func($this->routes[$rota]);
        } else {
            echo 'Rota inválida.';
        }
    }
}
