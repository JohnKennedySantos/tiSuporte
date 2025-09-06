<?php

namespace App\Controller;


class AtendimentoController extends BaseController
{
    public function listar(): void
    {
        echo $this->twig->render('Atendimento.twig', [
            'usuario' => $_SESSION['usuario'] ?? null,
            'titulo'  => 'Atendimentos'
        ]);
    }

    public function novo(): void
    {
        echo $this->twig->render('AtendimentoNovo.twig', [
            'usuario' => $_SESSION['usuario'] ?? null,
            'titulo'  => 'Novo Atendimento'
        ]);
    }
}
