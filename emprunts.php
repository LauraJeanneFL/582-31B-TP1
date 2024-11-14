<?php
require_once 'db_connexion.php';
require_once 'Classe/Emprunt.php';

$pdo = (new Connexion())->pdo;
$emprunt = new Emprunt($pdo);

// Ajouter un emprunt
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ajouter'])) {
    $id_livre = $_POST['id_livre'];
    $nom_emprunteur = $_POST['nom_emprunteur'];
    $date_emprunt = $_POST['date_emprunt'];
    $date_retour = $_POST['date_retour'];

    $emprunt->ajouterEmprunt($id_livre, $nom_emprunteur, $date_emprunt, $date_retour);
}

// Modifier un emprunt
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['modifier'])) {
    $id_emprunt = $_POST['id_emprunt'];
    $id_livre = $_POST['id_livre'];
    $nom_emprunteur = $_POST['nom_emprunteur'];
    $date_emprunt = $_POST['date_emprunt'];
    $date_retour = $_POST['date_retour'];

    $emprunt->modifierEmprunt($id_emprunt, $id_livre, $nom_emprunteur, $date_emprunt, $date_retour);
}

// Supprimer un emprunt
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['supprimer'])) {
    $id_emprunt = $_POST['id_emprunt'];
    $emprunt->supprimerEmprunt($id_emprunt);
}

// Lister tous les emprunts
$emprunts = $emprunt->getEmprunts();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des emprunts</title>
     <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <h1>Ajouter un emprunt</h1>
    <form action="emprunts.php" method="post">
        <label for="id_livre">ID du livre</label>
        <input type="text" name="id_livre" required>
        <label for="nom_emprunteur">Nom de l'emprunteur</label>
        <input type="text" name="nom_emprunteur" required>
        <label for="date_emprunt">Date d'emprunt</label>
        <input type="date" name="date_emprunt" required>
        <label for="date_retour">Date de retour</label>
        <input type="date" name="date_retour">
        <button type="submit" name="ajouter">Ajouter</button>
    </form>

    <h1>Liste des emprunts</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>ID du livre</th>
            <th>Nom de l'emprunteur</th>
            <th>Date d'emprunt</th>
            <th>Date de retour</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($emprunts as $e):?>
            <tr>
                <td><?php echo $e['id_emprunt'];?></td>
                <td><?php echo $e['id_livre'];?></td>
                <td><?php echo $e['nom_emprunteur'];?></td>
                <td><?php echo $e['date_emprunt'];?></td>
                <td><?php echo $e['date_retour'];?></td>
                <td>

                    <h1>Modifier un emprunt</h1>
                    <form action="emprunts.php" method="post">
                        <input type="text" name="id_emprunt" value="<?php echo $e['id_emprunt']; ?>">
                        <input type="text" name="id_livre" value="<?php echo $e['id_livre'];?>">
                        <input type="text" name="nom_emprunteur" value="<?php echo $e['nom_emprunteur'];?>">
                        <input type="date" name="date_emprunt" value="<?php echo $e['date_emprunt'];?>">
                        <input type="date" name="date_retour" value="<?php echo $e['date_retour'];?>">
                        <button type="submit" name="modifier">Modifier</button>
                    </form>

                    <h1>Supprimer un emprunt</h1>
                    <form action="emprunts.php" method="post">
                        <input type="text" name="id_emprunt" value="<?php echo $e['id_emprunt'];?>">
                        <button type="submit" name="supprimer">Supprimer</button>
                    </form>
                </td>
            </tr>
        <?php endforeach;?>
    </table>
</body>
</html>