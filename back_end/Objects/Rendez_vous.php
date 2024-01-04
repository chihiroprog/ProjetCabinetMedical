<?php

    require_once 'dbConfig.php';
    require_once 'Usager.php';
    class Rendez_vous {

        private DbConfig $dbConfig;
        private $numero_securite_social;
        public Usager $usager;
        private $nom;
        private $prenom;
        private $Id_Usager;
        private $id_rendez_vous;
        private $medecin_choose;
        private $date_rdv;
        private $duree_rdv;
        private $heure_rdv;

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
            $req = $this->dbconfig->getPDO()->prepare('INSERT INTO rdv (nom_patient , prenom_patient , numero_securite_social, duree_rendez_vous , date_rendez_vous , Id_Medecin , Id_Usager,heure_rendez_vous) 
            VALUES (:nom , :prenom , :numero_securite_social, :duree_rdv , :date_rdv , :Id_Medecin , :Id_Usager, :heure_rdv)');

            $req->execute(array(
                'nom' => $this->nom,
                'prenom' => $this->prenom,
                'numero_securite_social' => $this->numero_securite_social,
                'duree_rdv' => $this->duree_rdv,
                'date_rdv' => $this->date_rdv,
                'Id_Medecin' => $this->medecin_choose,
                'Id_Usager' => $this->Id_Usager,
                'heure_rdv' =>$this->heure_rdv,

            ));
        }catch (Exception $pe) {echo 'ERREUR : ' . $pe->getMessage();}
    }

    public function getAllRdv(){
        try{
            $req = $this->dbconfig->getPDO()->prepare('SELECT id_rendez_vous, nom_patient , prenom_patient , numero_securite_social, duree_rendez_vous , date_rendez_vous , Id_Medecin , Id_Usager , heure_rendez_vous FROM rdv ORDER BY date_rendez_vous');
            $req->execute();
            return $req;
        }catch (Exception $pe) {echo 'ERREUR : ' . $pe->getMessage();}

    }

    public function getModifyRdv(){
        try{
            $req = $this->dbconfig->getPDO()->prepare('SELECT * FROM rdv WHERE id_rendez_vous = :id_rendez_vous');
            $req->execute();
            return $req;
        }catch(Exception $pe) {echo 'ERREUR : ' . $pe->getMessage();}
    }

    public function DeleteRdv(){
        try{
            $req = $this->dbconfig->getPDO()->prepare(
                'DELETE FROM rdv
                WHERE id_rendez_vous = :id_rendez_vous');
    
            $req->execute(array(
                'id_rendez_vous' => $this->id_rendez_vous,
            ));
            
        }catch(Exception $pe){echo 'ERREUR : ' . $pe->getMessage();}
    }
    public function ModifyRdv(){
        try {
            $req = $this->dbconfig->getPDO()->prepare(
                'UPDATE rdv SET
                Date_rendez_vous = :dateRdv,
                Duree_rendez_vous = :dureeRdv,
                Id_Medecin = :idMedecin,
                Id_Usager = :idUsager,
                Nom_patient = :nomUsager,
                numero_securite_social = :numSecuriteSociale,
                Prenom_patient = :prenomUsager
                WHERE Id_rendez_vous = :idRdv'
            );

            $req->execute(array(
                'dateRdv' => $this->date_rdv,
                'dureeRdv' => $this->duree_rdv,
                'idMedecin' => $this->medecin_choose,
                'idUsager' => $this->Id_Usager,
                'nomUsager' => $this->nom,
                'numSecuriteSociale' => $this->numero_securite_social,
                'prenomUsager' => $this->prenom,
                'idRdv' => $this->id_rendez_vous
            ));
            var_dump($this->date_rdv, $this->duree_rdv, $this->medecin_choose, $this->Id_Usager, $this->nom, $this->numero_securite_social, $this->prenom, $this->id_rendez_vous);

            $rowCount = $req->rowCount();
            if ($rowCount > 0) {
                echo "La modification a réussi. Nombre de lignes modifiées : $rowCount";
            } else {
                echo "Aucune modification effectuée.";
            }

    
        } catch(Exception $pe) {echo 'ERREUR : ' . $pe->getMessage();}
    }
    public function SearchRdvByMedecin($medecin_selectionner){
        try {
            $req = $this->dbconfig->getPDO()->prepare('SELECT id_rendez_vous, nom_patient, prenom_patient, numero_securite_social, duree_rendez_vous, date_rendez_vous, Id_Medecin, Id_Usager ,heure_rendez_vous
            FROM rdv 
            WHERE Id_Medecin = :medecin_selectionner
            ORDER BY date_rendez_vous');
            $req->bindValue(':medecin_selectionner', $medecin_selectionner, PDO::PARAM_INT); 
    
            $req->execute();
            return $req;
        } catch (Exception $pe) {
            echo 'ERREUR : ' . $pe->getMessage();
        }
    }
    public function getUsagerIDByNameAndFristName($nom,$prenom){
        try {
            $req = $this->dbconfig->getPDO()->prepare('SELECT Id_Usager, nom,prenom FROM usager WHERE nom = :nom AND prenom = :prenom');
            $req->execute(array(
                ':prenom' => $prenom,
                ':nom' => $nom,
            ));
            $result = $req->fetchAll(PDO::FETCH_ASSOC);
    
            return $result;
        } catch (Exception $pe) {echo 'ERREUR : ' . $pe->getMessage();}
    }

    public function getAllRdvUsagerByIdUsager($Id_Usager){
        try {
            $req = $this->dbconfig->getPDO()->prepare('SELECT id_rendez_vous, nom_patient, prenom_patient, numero_securite_social, duree_rendez_vous, date_rendez_vous, Id_Medecin, Id_Usager ,heure_rendez_vous FROM rdv WHERE Id_Usager = :IdUsager');
            $req->bindValue(':IdUsager', $Id_Usager, PDO::PARAM_INT); 
            $req->execute();

            return $req;
        } catch (Exception $pe) {
            echo 'ERREUR : ' . $pe->getMessage();
        }
    }
    
    public function getMedecinIDByNameAndFristName($nom,$prenom){
        try {
            $req = $this->dbconfig->getPDO()->prepare('SELECT Id_Medecin, nom,prenom FROM medecin WHERE nom = :nom AND prenom = :prenom');
            $req->execute(array(
                ':prenom' => $prenom,
                ':nom' => $nom,
            ));
            $result = $req->fetchAll(PDO::FETCH_ASSOC);
    
            return $result;
        } catch (Exception $pe) {echo 'ERREUR : ' . $pe->getMessage();}
    }

    public function getAllRdvMedecinByIdMedecin($Id_Medecin){
        try {
            $req = $this->dbconfig->getPDO()->prepare('SELECT id_rendez_vous, nom_patient, prenom_patient, numero_securite_social, duree_rendez_vous, date_rendez_vous, Id_Medecin, Id_Usager ,heure_rendez_vous FROM rdv WHERE Id_Medecin = :IdMedecin');
            $req->bindValue(':IdMedecin', $Id_Medecin, PDO::PARAM_INT); 
            $req->execute();

            return $req;
        } catch (Exception $pe) {
            echo 'ERREUR : ' . $pe->getMessage();
        }
    }
    function convertMinutesToHoursMinutes($minutes) {
        $hours = floor($minutes / 60);
        $remainingMinutes = $minutes % 60;
        return $hours . ' h ' . $remainingMinutes . ' min';
    }

    
    public function setNumeroSecuriteSocial($numero_securite_social){
        $this->numero_securite_social = $numero_securite_social;
    }
    public function setmedecinChoseForRdv($medecin_choose){
        $this->medecin_choose = $medecin_choose;
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
    public function setIdUsager($Id_Usager){
        $this->Id_Usager = $Id_Usager;
    }
    public function setIdRdv($id_rendez_vous){
        $this->id_rendez_vous = $id_rendez_vous;
    }
    public function setHeureRdv($heure_rdv){
        $this->heure_rdv = $heure_rdv;
    }


    public function getIdRdv() {
        return $this->id_rendez_vous;
    }
    public function getDateRdv() {
        return $this->date_rdv;
    }
    public function getDureeRdv() {
        return $this->duree_rdv;
    }
    public function getMedecinChoseForRdv() {
        return $this->medecin_choose;
    }
    public function getNom() {
        return $this->nom;
    }
    public function getPrenom() {
        return $this->prenom;
    }
    public function getNumeroSecuriteSocial() {
        return $this->numero_securite_social;
    }
    public function getIdUsager() {
        return $this->Id_Usager;
    }
    public function getHeureRdv(){
        return $this->heure_rdv;
    }
}
?>