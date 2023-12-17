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

    $civilite = $_POST['civilite'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    
    $req = $linkpdo->prepare('INSERT INTO medecin (civilite ,nom, prenom) 
    VALUES (:civilite,:nom, :prenom)');
    
    $req->execute(array(
        'nom' => $nom,
        'prenom' => $prenom,
        'civilite' => $civilite,

    ));
    header("Location: ../../pages/Gestionnaire_users.html");
    exit();
?>