<?php

    require_once 'dbConfig.php';
    require_once 'Usager.php';
    class Rendez_vous{

        private DbConfig $dbConfig;
        private $numero_securite_social;
        private Usager $usager;
        private $nom;
        private $prenom;
        private $Id_Usager;

    public function __construct(){
        $this->dbconfig = DbConfig::getDbConfig();
        $this->usager = new Usager();
    
    }

    public function SearchUserForRDV()
    {
        try {
            $req = $this->dbconfig->getPDO()->prepare('SELECT u.Id_Usager, u.civilite, u.nom, u.prenom, u.adresse, u.date_naissance, u.lieu_naissance, u.numero_securite_social,u.medecin_referent
                FROM usager u
                WHERE u.numero_securite_social = :numero_securite_social');
    
            $req->execute(array(
                ':numero_securite_social' => $this->numero_securite_social,
            ));
            while ($row = $req->fetch(PDO::FETCH_ASSOC)){
                $this->usager->setId($row['Id_Usager']);
                $this->usager->setCivilite($row['civilite']);
                $this->usager->setNom($row['nom']);
                $this->usager->setPrenom($row['prenom']);
                $this->usager->setDateNaissance($row['date_naissance']);
                $this->usager->setAdresse($row['adresse']);
                $this->usager->setLieuNaissance($row['lieu_naissance']);
                $this->usager->setNumeroSecuriteSocial($row['numero_securite_social']);
                $this->usager->setMedecinReferent($row['medecin_referent']);
            }
            } catch (Exception $pe) {echo 'ERREUR : ' . $pe->getMessage();}
    }

    public function getMedecinById($Id_Medecin)
    {
        try {
            $req = $this->dbconfig->getPDO()->prepare('SELECT Id_Medecin, nom,prenom FROM medecin WHERE Id_Medecin = :Id_Medecin');
            $req->execute(array(
                ':Id_Medecin' => $Id_Medecin
            ));
            $result = $req->fetchAll(PDO::FETCH_ASSOC);
    
            return $result;
        } catch (Exception $pe) {echo 'ERREUR : ' . $pe->getMessage();}
    }

    public function getNomPrenomMedecin()
    {
        try {
            $req = $this->dbconfig->getPDO()->prepare('SELECT Id_Medecin, nom, prenom FROM medecin');
            $req->execute();
            $result = $req->fetchAll(PDO::FETCH_ASSOC);
    
            return $result;
        } catch (Exception $pe) {echo 'ERREUR : ' . $pe->getMessage();}
    }

    public function printCreateRendezVous($listeMedecins)
    {
    
        echo '<form action="../rendez_vous/AddRdv.php" method="post">';
        echo '<input type="hidden" name="user_id" value="' . $this->usager->getIdUsager() . '">';
        echo 'Nom: <input type="text" readonly name="nom" value="' . $this->usager->getNom() . '" ><br>';
        echo 'Prénom: <input type="text"readonly name="prenom"  value="' . $this->usager->getPrenom() . '"><br>';
        echo 'Numéro de sécurité sociale: <input type="text"readonly  name="numero_securite_social" value="' . $this->usager->getNumeroSecuriteSocial() . '"><br>';
        echo 'Médecin Référent: <select name="Id_Medecin" >';
        foreach ($listeMedecins as $medecin) {
            echo '<option value="' . $medecin['Id_Medecin'] . '">' . $medecin['nom'] . ' ' . $medecin['prenom'] . '</option>';
        }
        echo '</select><br>';
        echo 'Date du rendez-vous : <input type="date" name="date_rdv"required> <br>';
        echo 'Durée du rendez-vous en minute: <input type="number" name="duree_rdv" value="30" required> <br>';
        echo '<input type="submit" value="Créer">';
        echo '</form>';

    }

    public function sortMedecinReferentFirst($listeMedecins){
        $listeMedecinReturn = array();
        $medecinReferent = $this->getMedecinById($this->usager->getMedecinReferent());
        array_push($listeMedecinReturn,$medecinReferent[0]);
        foreach ($listeMedecins as $medecin) {
            if ($this->usager->getMedecinReferent() !=  $medecin['Id_Medecin']){
                array_push($listeMedecinReturn,$medecin);
            }
        }
        return $listeMedecinReturn;
    }
    public function getUsager(){
        return $this->usager;
    }

    public function addRdv(){
        try{
            $req = $this->dbconfig->getPDO()->prepare('INSERT INTO rdv (nom_patient , prenom_patient , numero_securite_social, duree_rendez_vous , date_rendez_vous , Id_Medecin , Id_Usager) 
            VALUES (:nom , :prenom , :numero_securite_social, :duree_rdv , :date_rdv , :Id_Medecin , :Id_Usager)');

            $req->execute(array(
                'nom' => $this->nom,
                'prenom' => $this->prenom,
                'numero_securite_social' => $this->numero_securite_social,
                'duree_rdv' => $this->duree_rdv,
                'date_rdv' => $this->date_rdv,
                'Id_Medecin' => $this->Id_Medecin,
                'Id_Usager' => $this->IdUsager,

            ));
        }catch (Exception $pe) {echo 'ERREUR : ' . $pe->getMessage();}
    }

    public function getAllRdv(){
        try{
            $req = $this->dbconfig->getPDO()->prepare('SELECT nom_patient , prenom_patient , numero_securite_social, duree_rendez_vous , date_rendez_vous , Id_Medecin , Id_Usager FROM rdv ORDER BY date_rendez_vous');
            $req->execute();
            return $req;
        }catch (Exception $pe) {echo 'ERREUR : ' . $pe->getMessage();}

    }

    
    public function setNumeroSecuriteSocial($numero_securite_social){
        $this->numero_securite_social = $numero_securite_social;
    }
    public function setmedecinChoseForRdv($Id_Medecin){
        $this->Id_Medecin = $Id_Medecin;
    }
    public function setDateRdv($date_rdv){
        $this->date_rdv = $date_rdv;
    }
    public function setDureeRdv($duree_rdv){
        $this->duree_rdv = $duree_rdv;
    }
    public function setNom($nom){
        $this->nom = $nom;
    }
    public function setPrenom($prenom){
        $this->prenom = $prenom;
    }
    public function setIdUsager($IdUsager){
        $this->IdUsager = $IdUsager;
    }


    
}
?>