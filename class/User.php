<?php
require 'db-config.php';

class User
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function insertUser($civilite, $nom, $prenom, $est_medecin)
    {
        $sql = "INSERT INTO users (civilite, nom, prenom, est_medecin) VALUES (:civilite, :nom, :prenom, :est_medecin)";
        $stmt = $this->conn->prepare($sql);

        $stmt->bindParam(':civilite', $civilite);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':prenom', $prenom);
        $stmt->bindParam(':est_medecin', $est_medecin);

        try {
            $stmt->execute();
            return "Utilisateur inséré avec succès.";
        } catch (PDOException $e) {
            return "Erreur lors de l'insertion de l'utilisateur : " . $e->getMessage();
        }
    }
}

try {
    $options = [
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ];

    $linkpdo = new PDO($DB_DSN, $DB_USER, $DB_PASS, $options);
    echo "ok";

    $user = new User($linkpdo);

    $civilite = "Mr";
    $nom = "Doe";
    $prenom = "John";
    $est_medecin = false;

    $result = $user->insertUser($civilite, $nom, $prenom, $est_medecin);
} catch (Exception $pe) {
    echo 'ERREUR : ' . $pe->getMessage();
}
?>
