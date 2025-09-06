<?php

namespace App\Controller;


class AtivosController extends BaseController
{
    public function listar(): void
    {
        echo $this->twig->render('Ativos.twig', [
            'usuario' => $_SESSION['usuario'] ?? null,
            'titulo'  => 'Ativos'
        ]);
    }
}
