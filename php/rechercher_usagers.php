<?php
require '../php/db-config.php';
try {
    $options = [
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ];

    $linkpdo = new PDO($DB_DSN, $DB_USER, $DB_PASS, $options);

} catch (Exception $pe) {
    echo 'ERREUR : ' . $pe->getMessage();
}

$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
// $numero_securite_social['numero_securite_social'];

$req = $linkpdo->query('SELECT Id_usager,civilite, nom, prenom, adresse, date_naissance, lieu_naissance, numero_securite_social
 FROM usager WHERE nom = "'.$nom.'" AND prenom = "'.$prenom.'"');

while ($row = $req->fetch(PDO::FETCH_ASSOC)) {
    

    echo 'Civilité: <label>' . $row['civilite'] . '</label><br>';
    echo 'Nom: <label>' . $row['nom'] . '</label><br>';
    echo 'Prénom: <label>' . $row['prenom'] . '</label><br>';
    echo 'Adresse: <label>' . $row['adresse'] . '</label><br>';
    echo 'Date de naissance: <label>' . $row['date_naissance'] . '</label><br>';
    echo 'Lieu de naissance: <label>' . $row['lieu_naissance'] . '</label><br>';
    echo 'Numéro de sécurité sociale: <label>' . $row['numero_securite_social'] . '</label><br>';
    
    echo '<form action="supprimer_usagers.php" method="POST">';
    echo ' <input type="hidden" name="Id_usager" value="' . $row['Id_usager'] . '"><br>';
    echo '<input type="submit" value="Supprimer">';
    echo '</form>';
}

exit();
