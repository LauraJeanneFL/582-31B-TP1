<?php 
class Auteur {
    private $id_auteur;
    private $prenom;
    private $nom;
    private $pdo;
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    //getters
    public function getIdAuteur() {
        return $this->id_auteur;
    }

    public function getPrenom() {
        return $this->prenom;
    }

    public function getNom() {
        return $this->nom;
    }
    
    //setters
    public function ajouterAuteur($prenom, $nom) {
        $sql = "INSERT INTO auteur (prenom, nom) VALUES (:prenom, :nom)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':prenom', $prenom);
        $stmt->bindValue(':nom', $nom);
        return $stmt->execute();
    }

    public function modifierAuteur($id_auteur, $prenom, $nom) {
        $sql = "UPDATE auteur SET prenom = :prenom, nom = :nom WHERE id_auteur = :id_auteur";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':prenom', $prenom);
        $stmt->bindValue(':nom', $nom);
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
