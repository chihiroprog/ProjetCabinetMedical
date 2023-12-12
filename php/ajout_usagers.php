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

    $civilite = $_POST['civilite'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $adresse = $_POST['adresse'];
    $date_naissance = $_POST['date_naissance'];
    $lieu_naissance = $_POST['lieu_naissance'];
    $numero_securite_social = $_POST['numero_securite_social'];

    $req = $linkpdo->prepare('INSERT INTO usager (civilite ,nom, prenom, adresse, date_naissance,lieu_naissance, numero_securite_social ) 
    VALUES (:civilite,:nom, :prenom, :adresse, :date_naissance,:lieu_naissance, :numero_securite_social )');
    
    $req->execute(array(
        'nom' => $nom,
        'civilite' => $civilite,
        'prenom' => $prenom,
        'adresse' => $adresse,
        'date_naissance' => $date_naissance,
        'lieu_naissance' => $lieu_naissance,
        'numero_securite_social' => $numero_securite_social,

    ));
    header("Location: ../pages/Gestionnaire_users.html");
    exit();
?>