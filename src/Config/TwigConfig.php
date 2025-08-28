<?php

namespace App\Config;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class TwigConfig
{
    public static function getTwig(): Environment
    {
        $loader = new FilesystemLoader(__DIR__ . '/../View');
        $twig = new Environment($loader);

        // Detecta base_url automaticamente (ou define fixo)
        $baseUrl = self::getBaseUrl();

        // Torna acessível em todos os templates
        $twig->addGlobal('base_url', $baseUrl);

        return $twig;
    }

    private static function getBaseUrl(): string
    {
        // Se você rodar com servidor embutido (php -S localhost:8080 -t public)
        // a base será apenas "/"
        $scriptName = dirname($_SERVER['SCRIPT_NAME']);
        return rtrim(str_replace('\\', '/', $scriptName), '/') . '/';
    }
}
