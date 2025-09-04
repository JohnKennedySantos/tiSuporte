<?php

namespace App\Core;

class Router
{
    private array $routes = [];

    /**
     * Adiciona uma nova rota.
     */
    public function add(string $method, string $path, callable|array $action): void
    {
        $method = strtoupper($method);
        $this->routes[$method][$path] = $action;
    }

    /**
     * Dispara a rota correspondente.
     */
    public function dispatch(string $method, string $rota): void
    {
        $method = strtoupper($method);

        if (!isset($this->routes[$method])) {
            $this->render404($rota);
            return;
        }

        // Rota exata
        if (isset($this->routes[$method][$rota])) {
            $this->executeAction($this->routes[$method][$rota]);
            return;
        }

        // Rotas dinâmicas
        foreach ($this->routes[$method] as $path => $action) {
            $regex = preg_replace('/\{[a-zA-Z0-9_]+\}/', '([a-zA-Z0-9_-]+)', $path);
            $regex = "#^" . $regex . "$#";

            if (preg_match($regex, $rota, $matches)) {
                array_shift($matches);
                $this->executeAction($action, $matches);
                return;
            }
        }

        $this->render404($rota);
    }

    /**
     * Executa o método do controller ou callback
     */
    private function executeAction(callable|array $action, array $params = []): void
    {
        if (is_array($action)) {
            [$controllerClass, $method] = $action;

            if (!class_exists($controllerClass)) {
                throw new \Exception("Controller não encontrado: {$controllerClass}");
            }

            $controller = new $controllerClass();

            if (!method_exists($controller, $method)) {
                throw new \Exception("Método '{$method}' não encontrado no controller {$controllerClass}");
            }

            call_user_func_array([$controller, $method], $params);
            return;
        }

        call_user_func_array($action, $params);
    }

    /**
     * Página 404
     */
    private function render404(string $rota): void
    {
        http_response_code(404);
        echo "<h1>404 - Rota '{$rota}' não encontrada</h1>";
    }
}
