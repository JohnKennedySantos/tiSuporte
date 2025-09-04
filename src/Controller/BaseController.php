<?php

namespace App\Controller;

use App\Config\TwigConfig;

abstract class BaseController
{
    protected $twig;

    public function __construct()
    {
        // Garante que a sessão esteja sempre iniciada
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Configuração do Twig
        $this->twig = TwigConfig::getTwig();
    }
}
