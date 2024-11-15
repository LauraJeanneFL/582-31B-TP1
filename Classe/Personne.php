<?php
class Personne {
    protected $prenom;
    protected $nom;

    public function __construct($prenom, $nom) {
        $this->prenom = $prenom;
        $this->nom = $nom;
    }

    // Getter pour le prénom
    public function getPrenom() {
        return $this->prenom;
    }

    // Getter pour le nom
    public function getNom() {
        return $this->nom;
    }
}