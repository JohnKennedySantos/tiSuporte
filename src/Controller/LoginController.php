<?php

namespace App\Controller;

use App\Model\UsuarioModel;

class LoginController extends BaseController
{

    public function exibirLogin(): void
    {
        
        if (isset($_SESSION['usuario'])) {
            header('Location: index.php?rota=home');
            exit;
        }

        $erro = $_SESSION['erro'] ?? null;
        unset($_SESSION['erro']);

        echo $this->twig->render('LoginView.twig', [
            'erro' => $erro
        ]);
    }

    
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
            
            session_regenerate_id(true);

            
            $_SESSION['usuario'] = [
                'id'    => $usuario['IdUsuario'],
                'Usuario'  => $usuario['Usuario'],
                'email' => $usuario['Email']
            ];


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
        // Limpa dados da sessão
        $_SESSION = [];

        // Remove o cookie de sessão (se existir)
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }

        // Destrói a sessão
        session_destroy();

        header('Location: index.php?rota=login');
        exit;
    }
}
