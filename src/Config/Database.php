<?php 
namespace Src\Config;

use PDO;
use PDOException;

class Database {
    private $host = 'localhost';
    private $dbname = 'proddev';
    private $user = 'root';
    private $pass = 'john';
    public $conn;


    public function __construct() {
        try {
            $this->conn = new PDO(
                "mysql:host{$this->host};dbname={$this->dbname}; charset=utf8",
                $this->user,
                $this->pass 
            );
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo 'Erro ao conectar com o banco de dados: ' . $e->getMessage();
        }
    }

    public function getConnection() {
        return $this->conn;
    }

}