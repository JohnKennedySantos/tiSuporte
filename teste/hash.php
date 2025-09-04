<?php
// Senha que você quer armazenar
$senha = "123456";

// Gera o hash usando bcrypt
$hash = password_hash($senha, PASSWORD_DEFAULT);

// Exibe a senha e o hash
echo "Senha: $senha\n";
echo "Hash gerado: $hash\n";
?>
