<?php
class Connexion {
    private $host = 'localhost';
    private $dbname = 'librairie';
    private $username = 'root'; 
    private $password = ''; 
    public $connexion;

    public function __construct() {
        try {
            $this->connexion = new PDO("mysql:host=$this->host;dbname=$this->dbname;charset=utf8", $this->username, $this->password);
            $this->connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Erreur de connexion : " . $e->getMessage());
        }
    }
}
?>