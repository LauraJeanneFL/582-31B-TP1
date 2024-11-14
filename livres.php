<?php
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
        
        <!-- Liste des genres -->
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
        <button type="submit" name="ajouter">Ajouter</button>
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
                    <h1>Modifier un livre</h1>
                   <form action="livres.php" method="post">
                        <input type="hidden" name="id_livre" value="<?php echo $l['id_livre']; ?>">
                        <button type="submit" name="modifier">Modifier</button>
                    </form>

                    <h1>Supprimer un livre</h1>
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