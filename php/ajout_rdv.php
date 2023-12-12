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

    $Medecin = $_POST['Medecin'];
    $Patient = $_POST['Patient'];
    $DuréeConsultationEnMinute = $_POST['DuréeConsultationEnMinute'];
    $DateEtHeureDébutRendezVous = $_POST['DateEtHeureDébutRendezVous'];

    $req = $linkpdo->prepare('INSERT INTO rendezvous (Medecin, Patient, DuréeConsultationEnMinute, DateEtHeureDébutRendezVous) 
    VALUES (:Medecin,:Patient, :DuréeConsultationEnMinute, :DateEtHeureDébutRendezVous)');
    
    $req->execute(array(
        'Medecin' => $Medecin,
        'Patient' => $Patient,
        'DuréeConsultationEnMinute' => $DuréeConsultationEnMinute,
        'DateEtHeureDébutRendezVous' => $DateEtHeureDébutRendezVous,
    ));
    exit();
?>