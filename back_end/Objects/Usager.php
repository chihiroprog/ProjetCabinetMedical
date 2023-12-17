<?php
require_once 'dbConfig.php';
class Usager
{
    private DbConfig $dbconfig;
    private $civilite;
    private $nom;
    private $prenom;
    private $adresse;
    private $date_naissance;
    private $lieu_naissance;
    private $numero_securite_social;

    public function __construct(){
        $this->dbconfig = DbConfig::getDbConfig();
    }
    public function addUser()
    {
        try {
            $req = $this->dbconfig->getPDO()->prepare('INSERT INTO usager (civilite ,nom, prenom, adresse, date_naissance,lieu_naissance, numero_securite_social ) 
            VALUES (:civilite,:nom, :prenom, :adresse, :date_naissance,:lieu_naissance, :numero_securite_social )');

            var_dump($req);

            $req->execute(array(
                'nom' => $this->nom,
                'civilite' => $this->civilite,
                'prenom' => $this->prenom,
                'adresse' => $this->adresse,
                'date_naissance' => $this->date_naissance,
                'lieu_naissance' => $this->lieu_naissance,
                'numero_securite_social' => $this->numero_securite_social,

            ));

        } catch (Exception $pe) {
            echo 'ERREUR : ' . $pe->getMessage();
        }
    }

    public function ModifyUser()
    {
        try {
            $req = $this->dbconfig->getPDO()->prepare('SELECT civilite, nom, prenom, adresse, date_naissance, lieu_naissance, numero_securite_social
            FROM usager WHERE nom = :nom AND prenom = :prenom');

            $req->execute(array(
                ':nom' => $this->nom,
                ':prenom' => $this->prenom,
            ));

            $this->printModifyUser($req);

        } 
        catch (Exception $pe) { echo 'ERREUR : ' . $pe->getMessage(); }
    }


    function printModifyUser($req){
        while ($row = $req->fetch(PDO::FETCH_ASSOC)) {
            echo '<form action="" method="POST">';
        
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
    }

    public function setCivilite($civ){
        $this->civilite = $civ;
    }

    public function setNom($nom){
        $this->nom = $nom;
    }

    public function setPrenom($prenom){
        $this->prenom = $prenom;
    }

    public function setAdresse($adresse){
        $this->adresse = $adresse;
    }

    public function setDateNaissance($date_naissance){
        $this->date_naissance = $date_naissance;
    }

    public function setLieuNaissance($lieu_naissance){
        $this->lieu_naissance = $lieu_naissance;
    }

    public function setNumeroSecuriteSocial($numero_securite_social){
        $this->numero_securite_social = $numero_securite_social;
    }

    

}
?>
