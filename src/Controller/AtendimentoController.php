<?php

namespace App\Controller;

class AtendimentoController extends BaseController
{
    public function listar(): void
    {
        echo $this->twig->render('Atendimento.twig', [
            'usuario' => $_SESSION['usuario'] ?? null
        ]);
    }

    public function novo(): void
    {
        // Aqui você pode criar uma view separada
        echo $this->twig->render('AtendimentoNovo.twig', [
            'usuario' => $_SESSION['usuario'] ?? null
        ]);
    }
}
