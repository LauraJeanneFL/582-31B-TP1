<?php

class Genre {
    private $id_genre;
    private $nom_genre;
    
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    //getters
    public function getIdGenre() {
        return $this->id_genre;
    }

    public function getNomGenre() {
        return $this->nom_genre;
    }

    public function getGenres() {
        $sql = "SELECT * FROM genre";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll();
    }

    //setters
    public function ajouterGenre($nom_genre) {
        $sql = "INSERT INTO genre (nom_genre) VALUES (:nom_genre)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':nom_genre', $nom_genre);
        return $stmt->execute();
    }

    public function modifierGenre($id_genre, $nom_genre) { 
        $sql = "UPDATE genre SET nom_genre = :nom_genre WHERE id_genre = :id_genre";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':nom_genre', $nom_genre);
        $stmt->bindValue(':id_genre', $id_genre);
        return $stmt->execute();
    }

    public function supprimerGenre($id_genre) {
        $sql = "DELETE FROM genre WHERE id_genre = :id_genre";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':id_genre', $id_genre);
        return $stmt->execute();
    }
}