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

$Id_usager = $_POST['Id_usager'];

$req_delete = $linkpdo->prepare('DELETE FROM usager WHERE Id_usager = :Id_usager');
$req_delete->execute(array(
'Id_usager' => $Id_usager,
));
header("Location: ../pages/Gestionnaire_users.html");

exit();
