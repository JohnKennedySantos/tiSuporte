<?php

namespace App\Controller;

class HomeController extends BaseController
{
    public function exibirHome(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['usuario'])) {
            header('Location: index.php?rota=login');
            exit;
        }

        echo $this->twig->render('homeView.twig', [
            'usuario' => $_SESSION['usuario']
        ]);
    }
}
