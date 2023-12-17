<?php
require_once 'dbConfig.php';

class ModifierUsagersCommand
{
    private DbConfig $dbconfig;
    private $nom;
    private $prenom;
    private $numero_securite_social;    

    public function __construct($nom, $prenom, $numero_securite_social){
        $this->dbconfig = Dbconfig::getDbConfig();
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->numero_securite_social = $numero_securite_social;
    }

    public function execute()
    {
        try {
            $req = $this->dbconfig->getPDO()->prepare('SELECT civilite, nom, prenom, adresse, date_naissance, lieu_naissance, numero_securite_social
            FROM usager WHERE nom = :nom AND prenom = :prenom');

            $req->execute(array(
                ':nom' => $this->nom,
                ':prenom' => $this->prenom,
            ));

            while ($row = $req->fetch(PDO::FETCH_ASSOC)) {
                echo '<form action="ModifierUsagersCommand.php" method="POST">';
            
                echo 'Civilité: <input type="text" name="form_civilite" value="' . $row['civilite'] . '"><br>';
                echo 'Nom: <input type="text" name="form_nom" value="' . $row['nom'] . '"><br>';
                echo 'Prénom: <input type="text" name="form_prenom" value="' . $row['prenom'] . '"><br>';
                echo 'Adresse: <input type="text" name="form_adresse" value="' . $row['adresse'] . '"><br>';
                echo 'Date de naissance: <input type="text" name="form_date_naissance" value="' . $row['date_naissance'] . '"><br>';
                echo 'Lieu de naissance: <input type="text" name="form_lieu_naissance" value="' . $row['lieu_naissance'] . '"><br>';
                echo 'Numéro de sécurité sociale: <input type="text" name="form_numero_securite_social" value="' . $row['numero_securite_social'] . '"><br>';
                
                echo '<input type="submit" value="Modifier">';
                echo '</form>';
            }

        } catch (Exception $pe) {
            echo 'ERREUR : ' . $pe->getMessage();
        }
    }
}
?>
