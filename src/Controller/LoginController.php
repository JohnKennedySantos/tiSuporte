<?php

namespace App\Controller;

use App\Model\UsuarioModel;
use App\Config\TwigConfig;

class LoginController
{
    public function exibirLogin(): void
    {
        $twig = TwigConfig::getTwig();
        echo $twig->render('LoginView.twig');
    }

    public function autenticar(): void
    {
        // Sanitização básica dos dados recebidos
        $email = trim($_POST['email'] ?? '');
        $senha = $_POST['senha'] ?? '';

        // Validação simples
        if (empty($email) || empty($senha)) {
            $this->renderErro('Preencha todos os campos.');
            return;
        }

        $usuarioModel = new UsuarioModel();
        $usuario = $usuarioModel->buscarPorEmail($email);

        // Verifica se o usuário existe e se a senha está correta
        if ($usuario && password_verify($senha, $usuario['senha'])) {
            $_SESSION['usuario'] = $usuario;
            header('Location: index.php?rota=dashboard');
            exit;
        }

        // Se falhar, renderiza a view com mensagem de erro
        $this->renderErro('Email ou senha inválidos.');
    }

    private function renderErro(string $mensagem): void
    {
        $twig = TwigConfig::getTwig();
        echo $twig->render('LoginView.twig', ['erro' => $mensagem]);
    }
}
