<?php

namespace App\Controller;

use App\Model\UsuarioModel;


use App\Config\TwigConfig;

class LoginController
{
    
    private $twig;

    
    public function __construct()
    {

         // Garante que a sessão esteja iniciada
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $this->twig = TwigConfig::getTwig();
    }

    // Exibe a tela de login para o usuário
    public function exibirLogin(): void
    {

        // Se já estiver logado, redireciona para a home
        if (isset($_SESSION['usuario'])) {
            header('Location: index.php?rota=home');
            exit;
        }

        echo $this->twig->render('LoginView.twig');
    }

    
    public function autenticar(): void
    {
       
        $email = trim($_POST['email'] ?? ''); 
        $senha = $_POST['senha'] ?? '';       

        
        if (empty($email) || empty($senha)) {
            
            $this->renderErro('Preencha todos os campos.');
            return;
        }

        $usuarioModel = new UsuarioModel();
        $usuario = $usuarioModel->buscarPorEmail($email); 

        
        if ($usuario && password_verify($senha, $usuario['senha'])) {
       
            $_SESSION['usuario'] = $usuario;

        
            header('Location: index.php?rota=home');
            exit; 
        }

        $this->renderErro('Email ou senha inválidos.');
    }

    public function exibirHome(): void
    {

        echo $this->twig->render('homeView.twig', [
            'usuario' => $_SESSION['usuario'] ?? null 
        ]);
    }

    private function renderErro(string $mensagem): void
    {

        echo $this->twig->render('LoginView.twig', ['erro' => $mensagem]);
    }
}
