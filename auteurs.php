<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'db_connexion.php';
require_once 'Classe/Auteur.php';

$pdo = (new Connexion())->pdo;
$auteur = new Auteur($pdo);

// Ajouter un auteur
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ajouter'])) {
    $prenom = $_POST['prenom'];
    $nom = $_POST['nom'];
    $auteur->ajouterAuteur($prenom, $nom);
}

// Modifier un auteur
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['modifier'])) {
    $id_auteur = $_POST['id_auteur'];
    $prenom = $_POST['prenom'];
    $nom = $_POST['nom'];
    $auteur->modifierAuteur($id_auteur, $prenom, $nom);
}

// Supprimer un auteur
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['supprimer'])) {
    $id_auteur = $_POST['id_auteur'];
    $auteur->supprimerAuteur($id_auteur);
}

// Obtenir tous les auteurs
$auteurs = $auteur->getAuteurs();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion des auteurs</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <h1>Ajouter un Auteur</h1>
    <form action="auteurs.php" method="post">
        <input type="text" name="prenom" placeholder="Prénom" required>
        <input type="text" name="nom" placeholder="Nom" required>
        <button type="submit" name="ajouter">Ajouter</button>
    </form>

    <h1>Liste des Auteurs</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>Prénom</th>
            <th>Nom</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($auteurs as $a): ?>
            <tr>
                <td><?php echo $a['id_auteur']; ?></td>
                <td><?php echo $a['prenom']; ?></td>
                <td><?php echo $a['nom']; ?></td>
                <td>
                
                    <h4>Modifier un auteur</h4>
                    <form action="auteurs.php" method="post">
                        <input type="hidden" name="id_auteur" value="<?php echo $a['id_auteur']; ?>">
                        <input type="text" name="prenom" value="<?php echo $a['prenom']; ?>" required>
                        <input type="text" name="nom" value="<?php echo $a['nom']; ?>" required>
                        <button type="submit" name="modifier">Modifier</button>
                    </form>

                    <h4>Supprimer un auteur</h4>
                    <form action="auteurs.php" method="post" style="display:inline;">
                        <input type="hidden" name="id_auteur" value="<?php echo $a['id_auteur']; ?>">
                        <button type="submit" name="supprimer">Supprimer</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>