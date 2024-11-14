<?php
class Livre
{
    private $id_livre;
    private $titre;
    private $annee_publication;
    private $id_auteur;
    private $id_genre;
    private $quantite_disponible;
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    // Méthode pour ajouter un livre
    public function ajouterLivre($titre, $annee_publication, $id_auteur, $id_genre, $quantite_disponible)
    {
        $sql = "INSERT INTO livre (titre, annee_publication, id_auteur, id_genre, quantite_disponible) 
                VALUES (:titre, :annee_publication, :id_auteur, :id_genre, :quantite_disponible)";
        $stmt = $this->pdo->prepare($sql);

        $stmt->bindValue(':titre', $titre);
        $stmt->bindValue(':annee_publication', $annee_publication);
        $stmt->bindValue(':id_auteur', $id_auteur);
        $stmt->bindValue(':id_genre', $id_genre);
        $stmt->bindValue(':quantite_disponible', $quantite_disponible);
        return $stmt->execute();
    }

    // Méthode pour modifier un livre
    public function modifierLivre($id_livre, $titre, $annee_publication, $id_auteur, $id_genre, $quantite_disponible)
    {
        $sql = "UPDATE livre SET titre = :titre, annee_publication = :annee_publication, id_auteur = :id_auteur, id_genre = :id_genre, quantite_disponible = :quantite_disponible 
                WHERE id_livre = :id_livre";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':id_livre', $id_livre);
        $stmt->bindValue(':titre', $titre);
        $stmt->bindValue(':annee_publication', $annee_publication);
        $stmt->bindValue(':id_auteur', $id_auteur);
        $stmt->bindValue(':id_genre', $id_genre);
        $stmt->bindValue(':quantite_disponible', $quantite_disponible);
        $stmt->execute();
       return $stmt->execute();
    }

    // Méthode pour supprimer un livre
    public function supprimerLivre($id_livre)
    {
        $sql = "DELETE FROM livre WHERE id_livre = :id_livre";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':id_livre', $id_livre);
        return $stmt->execute();
    }

    // Méthode pour récupérer tous les livres
    public function getLivres()
    {
        $sql = "SELECT livre.id_livre, livre.titre, livre.annee_publication, livre.quantite_disponible, 
                       auteur.prenom AS auteur_prenom, auteur.nom AS auteur_nom, genre.nom_genre 
                FROM livre
                JOIN auteur ON livre.id_auteur = auteur.id_auteur
                JOIN genre ON livre.id_genre = genre.id_genre";
    
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll();
    }
}
