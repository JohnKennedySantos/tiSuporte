<?php 
  
  // INICIO DA SESSÃO
    session_start();

    require_once __DIR__ . '/../vendor/autoload.php';

    require_once __DIR__ . '/../src/Config/Database.php';

  use Src\Config\Database;

  $db = new Database();
  $conn = $db->getConnection();

  if ($conn) {
        echo "Conexão com o banco de dados estabelecida com sucesso!";
    } else {
        echo "Erro ao conectar com o banco de dados.";
    }


?>