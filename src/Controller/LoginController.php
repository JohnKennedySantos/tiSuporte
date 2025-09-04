<?php

namespace App\Controller;

use App\Model\UsuarioModel;

class LoginController extends BaseController
{
    // Exibe a tela de login para o usuário
    public function exibirLogin(): void
    {
        // Se já estiver logado, redireciona para a home
        if (isset($_SESSION['usuario'])) {
            header('Location: index.php?rota=home');
            exit;
        }

        echo $this->twig->render('LoginView.twig', [
            'erro' => $_SESSION['erro'] ?? null
        ]);

        // Limpa a mensagem de erro da sessão
        unset($_SESSION['erro']);
    }

    // Autenticação
    public function autenticar(): void
    {
        $email = trim($_POST['email'] ?? '');
        $senha = $_POST['senha'] ?? '';

        if (empty($email) || empty($senha)) {
            $_SESSION['erro'] = 'Preencha todos os campos.';
            header('Location: index.php?rota=login');
            exit;
        }

        $usuarioModel = new UsuarioModel();
        $usuario = $usuarioModel->buscarPorEmail($email);

        if ($usuario && password_verify($senha, $usuario['Senha'])) {
            $_SESSION['usuario'] = $usuario;
            header('Location: index.php?rota=home');
            exit;
        }

        $_SESSION['erro'] = 'Email ou senha inválidos.';
        header('Location: index.php?rota=login');
        exit;
    }

    // Logout
    public function sair(): void
    {
        session_destroy();
        header('Location: index.php?rota=login');
        exit;
    }
}
