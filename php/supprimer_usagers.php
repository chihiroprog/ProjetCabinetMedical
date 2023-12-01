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

$req = $linkpdo->query('SELECT civilite, nom, prenom, adresse, date_naissance, lieu_naissance, numero_securite_social
 FROM usager WHERE nom = "'.$nom.'" AND prenom = "'.$prenom.'"');

while ($row = $req->fetch(PDO::FETCH_ASSOC)) {
    
    echo 'Civilité: '. $row['civilite'] . '<br>';
    echo 'Nom: '. $row['nom'] . '<br>';
    echo 'Prénom: ' . $row['prenom'] . '<br>';
    echo 'Adresse: ' . $row['adresse'] . '<br>';
    echo 'Date de naissance: ' . $row['date_naissance'] . '<br>';
    echo 'Lieu de naissance:' . $row['lieu_naissance'] . '<br>';
    echo 'Numéro de sécurité sociale: ' . $row['numero_securite_social'] . '<br>';
    
    echo '<input type="submit" value="Supprimer">'. '<br>';
}

$req_delete = $linkpdo->prepare('DELETE FROM usager WHERE nom = :nom AND prenom = :prenom');
$req_delete->execute(array(
'nom' => $nom,
'prenom' => $prenom
));
exit();
