<?php
require 'db-config.php';
try {
    $options = [
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ];

    $linkpdo = new PDO($DB_DSN, $DB_USER, $DB_PASS, $options);

    echo "ok";
} catch (Exception $pe) {
    echo 'ERREUR : ' . $pe->getMessage();
}     
class User
{
    private int $id;
    private string $civilite;
    private string $nom;
    private string $prenom;
}
?>