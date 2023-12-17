<?php
require_once 'dbConfig.php';
class AjoutUsagersCommand
{
    private DbConfig $dbconfig;
    private $civilite;
    private $nom;
    private $prenom;
    private $adresse;
    private $date_naissance;
    private $lieu_naissance;
    private $numero_securite_social;

    public function __construct($civilite, $nom, $prenom, $adresse, $date_naissance, $lieu_naissance, $numero_securite_social)
    {
        $this->dbconfig = DbConfig::getDbConfig();
        $this->civilite = $civilite;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->adresse = $adresse;
        $this->date_naissance = $date_naissance;
        $this->lieu_naissance = $lieu_naissance;
        $this->numero_securite_social = $numero_securite_social;
    }

    public function execute()
    {
        try {
            $req = $this->dbconfig->getPDO()->prepare('INSERT INTO usager (civilite ,nom, prenom, adresse, date_naissance,lieu_naissance, numero_securite_social ) 
            VALUES (:civilite,:nom, :prenom, :adresse, :date_naissance,:lieu_naissance, :numero_securite_social )');

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
}

// exit(); // Cette ligne est inutile ici, vous pouvez la retirer.
?>
