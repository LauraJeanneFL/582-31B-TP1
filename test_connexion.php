<?php
require_once './connexion.php';

try {
    $db = new Connexion();
    echo "Connexion à la base de données réussie !";
} catch (Exception $e) {
    echo "Erreur : " . $e->getMessage();
}
?>