<?php
require '../db-config.php';
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

$req = $linkpdo->query('SELECT civilite, nom, prenom
 FROM medecin WHERE nom = "'.$nom.'" AND prenom = "'.$prenom.'"');

while ($row = $req->fetch(PDO::FETCH_ASSOC)) {
    echo '<form action="modifier_usager.php" method="POST">';

    echo 'Civilité: <input type="text" name="form_civilite" value="' . $row['civilite'] . '"><br>';
    echo 'Nom: <input type="text" name="form_nom" value="' . $row['nom'] . '"><br>';
    echo 'Prénom: <input type="text" name="form_prenom" value="' . $row['prenom'] . '"><br>';
    
    
    echo '<input type="submit" value="Modifier">';
    echo '</form>';
}
exit();

?>
