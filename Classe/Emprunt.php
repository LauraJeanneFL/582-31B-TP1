<?php
class Emprunt {
    private $id_emprunt;
    private $id_livre;
    private $nom_emprunteur;
    private $date_emprunt;
    private $date_retour;
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    //setters 
    public function getIdEmprunt() {
        return $this->id_emprunt;
    }
    public function getIdLivre() {
        return $this->id_livre;
    }
    public function getNomEmprunteur() {
        return $this->nom_emprunteur;
    }
    public function getDateEmprunt() {
        return $this->date_emprunt;
    }
    public function getDateRetour() {
        return $this->date_retour;
    }

    //getters
    public function ajouterEmprunt($id_livre, $nom_emprunteur, $date_emprunt, $date_retour = null) {
        $sql = "INSERT INTO emprunt (id_livre, nom_emprunteur, date_emprunt, date_retour) VALUES (:id_livre, :nom_emprunteur, :date_emprunt, :date_retour)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':id_livre', $id_livre);
        $stmt->bindValue(':nom_emprunteur', $nom_emprunteur);
        $stmt->bindValue(':date_emprunt', $date_emprunt);
        $stmt->bindValue(':date_retour', $date_retour);

        return $stmt->execute();
    }

    public function modifierEmprunt($id_emprunt, $date_retour) {
        $sql = "UPDATE emprunt SET date_retour = :date_retour WHERE id_emprunt = :id_emprunt";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':date_retour', $date_retour);
        $stmt->bindValue(':id_emprunt', $id_emprunt);
        return $stmt->execute();
    }

    public function supprimerEmprunt($id_emprunt) {
        $sql = "DELETE FROM emprunt WHERE id_emprunt = :id_emprunt";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':id_emprunt', $id_emprunt);
        return $stmt->execute();
    }
    
    public function getEmprunts() {
        $sql = "SELECT * FROM emprunt";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll();
    }
}
?>