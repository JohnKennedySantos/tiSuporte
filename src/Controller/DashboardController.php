<?php

namespace App\Controller;

use App\Core\Controller;

class DashboardController extends Controller {
    public function index() {
        echo $this->twig->render('dashboard.html.twig', [
            'usuario' => $_SESSION['usuario'] ?? null
        ]);
    }
}
