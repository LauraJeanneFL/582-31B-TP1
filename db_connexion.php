<?php 
class Connexion {
    private $host = 'localhost';
    private $dbname = 'librairie';
    private $user = 'root';
    private $pass = '';
    private $charset = 'utf8mb4';   
    public $pdo;

    public function __construct() {
        // TODO: à revérifer
         try {
            $dsn = "mysql:host=$this->host;dbname=$this->dbname;charset=$this->charset";
            $this->pdo = new PDO($dsn, $this->user, $this->pass);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Erreur de connexion : " . $e->getMessage());
        }
    }
}