<?php 
require_once 'db_connexion.php';
require_once 'Classe/Genre.php';

$pdo = (new Connexion())->pdo;
$genre = new Genre($pdo);

// Ajouter un genre
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ajouter'])) {
    $nom_genre = $_POST['nom_genre'];
    $genre->ajouterGenre($nom_genre);
}

// Modifier un genre
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['modifier'])) {
    $id_genre = $_POST['id_genre'];
    $nom_genre = $_POST['nom_genre'];
    $genre->modifierGenre($id_genre, $nom_genre);
}

// Supprimer un genre
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['supprimer'])) {
    $id_genre = $_POST['id_genre'];
    $genre->supprimerGenre($id_genre);
}

// Obtenir tous les genres
$genres = $genre->getGenres();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des genres</title>
</head>
<body>
    <h1>Ajouter un genre</h1>
    <form action="genres.php" method="post">
        <label for="nom_genre">Nom du genre</label>
        <input type="text" name="nom_genre" required>
        <button type="submit" name="ajouter">Ajouter</button>
    </form>
    <h1>Liste des genres</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>Nom du genre</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($genres as $g):?>
            <tr>
                <td><?php echo $g['id_genre'];?></td>
                <td><?php echo $g['nom_genre'];?></td>
                <td>

                    <h1>Modifier un genre</h1>
                    <form action="genres.php" method="post">
                        <input type="hidden" name="id_genre" value="<?php echo $genre['id_genre'];?>">
                        <button type="submit" name="modifier">Modifier</button>
                    </form>

                    <h1>Supprimer un genre</h1>
                    <form action="genres.php" method="post">
                        <input type="hidden" name="id_genre" value="<?php echo $genre['id_genre'];?>">
                        <button type="submit" name="supprimer">Supprimer</button>
                    </form>
                </td>
            </tr>
        <?php endforeach;?>
    </table>
</body>
</html>