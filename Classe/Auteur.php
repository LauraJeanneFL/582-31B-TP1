<?php 
require_once 'Personne.php';
class Auteur extends Personne {
    private $id_auteur;
    private $pdo;
    public function __construct($pdo, $prenom, $nom) {
        // Appel au constructeur de Personne
        parent::__construct($prenom, $nom);
        $this->pdo = $pdo;
    }

    // Getter pour l'ID de l'auteur
    public function getIdAuteur() {
        return $this->id_auteur;
    }
    
    //setters
    // Méthode pour ajouter un auteur
    public function ajouterAuteur() {
        $sql = "INSERT INTO auteur (prenom, nom) VALUES (:prenom, :nom)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':prenom', $this->prenom);
        $stmt->bindValue(':nom', $this->nom);
        return $stmt->execute();
    }

    public function modifierAuteur($id_auteur) {
        $sql = "UPDATE auteur SET prenom = :prenom, nom = :nom WHERE id_auteur = :id_auteur";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':prenom', $this->prenom);
        $stmt->bindValue(':nom', $this->nom);
        $stmt->bindValue(':id_auteur', $id_auteur);
        return $stmt->execute();
    }

    public function supprimerAuteur($id_auteur) {
        $sql = "DELETE FROM auteur WHERE id_auteur = :id_auteur";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':id_auteur', $id_auteur);
        return $stmt->execute();
    }

    public function getAuteurs() {
        $sql = "SELECT * FROM auteur";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll();
    }
}