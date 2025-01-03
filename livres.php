<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'db_connexion.php';
require_once 'Classe/Livre.php';
require_once 'Classe/Auteur.php';
require_once 'Classe/Genre.php';

$pdo = (new Connexion())->pdo;
$livre = new Livre($pdo);
$auteur = new Auteur($pdo);
$genre = new Genre($pdo);

// Ajouter un livre
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ajouter'])) {
    $titre = $_POST['titre'];
    $annee_publication = $_POST['annee_publication'];
    $id_auteur = $_POST['id_auteur'];
    $id_genre = $_POST['id_genre'];
    $quantite_disponible = $_POST['quantite_disponible'];

    $livre->ajouterLivre($titre, $annee_publication, $id_auteur, $id_genre, $quantite_disponible);
}

// Modifier un livre
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['modifier'])) {
    $id_livre = $_POST['id_livre'];
    $titre = $_POST['titre'];
    $annee_publication = $_POST['annee_publication'];
    $id_auteur = $_POST['id_auteur'];
    $id_genre = $_POST['id_genre'];
    $quantite_disponible = $_POST['quantite_disponible'];
    
    $livre->modifierLivre($id_livre, $titre, $annee_publication, $id_auteur, $id_genre, $quantite_disponible);
}

// Supprimer un livre
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['supprimer'])) {
    $id_livre = $_POST['id_livre'];
    $livre->supprimerLivre($id_livre);
}

// Lister tous les livres
$livres = $livre->getLivres();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des livres</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <h1>Ajouter un livre</h1>
    <form action="livres.php" method="post">
        <input type="text" name="titre" placeholder="Titre" required>
        <input type="number" name="annee_publication" placeholder="Année de publication" required>
        <label for="id_auteur">Auteur :</label>
        <select name="id_auteur" required>
            <?php
            $auteurs = $auteur->getAuteurs();
            foreach ($auteurs as $a) {
                echo "<option value='{$a['id_auteur']}'>{$a['prenom']} {$a['nom']}</option>";
            }
            ?>
        </select>
        <label for="id_genre">Genre :</label>
        <select name="id_genre">
            <?php
            $genres = $genre->getGenres();
            foreach ($genres as $g) {
                echo "<option value='{$g['id_genre']}'>{$g['nom_genre']}</option>";
            }
            ?>
        </select>
        <input type="number" name="quantite_disponible" placeholder="Quantité disponible">
        <button class="bouton" type="submit" name="ajouter">Ajouter</button>
    </form>
    <h1>Liste des livres</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>Titre</th>
            <th>Auteur</th>
            <th>Année de publication</th>
            <th>Genre</th>
            <th>Quantité disponible</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($livres as $l):?>
            <tr>
                 <td><?php echo $l['id_livre']; ?></td>
                <td><?php echo $l['titre'];?></td>
                <td><?php echo $l['auteur_prenom'] . ' ' . $l['auteur_nom']; ?></td>
                <td><?php echo $l['annee_publication'];?></td>
                <td><?php echo $l['nom_genre']; ?></td>
                <td><?php echo $l['quantite_disponible'];?></td>
                <td>
                    <h4>Modifier un livre</h4>
                    <form action="livres.php" method="post">
                        <input type="hidden" name="id_livre" value="<?php echo $l['id_livre']; ?>">
                        
                        <label for="titre">Titre :</label>
                        <input type="text" name="titre" value="<?php echo $l['titre']; ?>" required>
                        
                        <label for="annee_publication">Année de publication :</label>
                        <input type="number" name="annee_publication" value="<?php echo $l['annee_publication']; ?>" required>
                        
                        <label for="id_auteur">Auteur :</label>
                        <select name="id_auteur" required>
                            <?php
                            $auteurs = $auteur->getAuteurs();
                            foreach ($auteurs as $a) {
                                $selected = $a['id_auteur'] == $l['id_auteur'] ? 'selected' : '';
                                echo "<option value='{$a['id_auteur']}' $selected>{$a['prenom']} {$a['nom']}</option>";
                            }
                            ?>
                        </select>
                        <label for="id_genre">Genre :</label>
                        <select name="id_genre" required>
                            <?php
                            $genres = $genre->getGenres();
                            foreach ($genres as $g) {
                                $selected = $g['id_genre'] == $l['id_genre'] ? 'selected' : '';
                                echo "<option value='{$g['id_genre']}' $selected>{$g['nom_genre']}</option>";
                            }
                            ?>
                        </select>
                        <label for="quantite_disponible">Quantité disponible :</label>
                        <input type="number" name="quantite_disponible" value="<?php echo $l['quantite_disponible']; ?>" required>
                        <button type="submit" name="modifier">Confirmer les modifications</button>`
                    </form>
                    <h4>Supprimer ce livre</h4>
                    <form action="livres.php" method="post">
                        <input type="hidden" name="id_livre" value="<?php echo $l['id_livre']; ?>">
                        <button type="submit" name="supprimer">Supprimer</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>