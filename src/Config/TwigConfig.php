<?php

namespace App\Config;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class TwigConfig
{
    public static function getTwig(): Environment
    {
        $loader = new FilesystemLoader(__DIR__ . '/../View');
        return new Environment($loader);
    }
}
