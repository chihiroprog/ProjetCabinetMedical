<?php
require_once 'dbConfig.php';
class Usager
{
    private DbConfig $dbconfig;
    private $Id_Usager;
    private $civilite;
    private $nom;
    private $prenom;
    private $adresse;
    private $date_naissance;
    private $lieu_naissance;
    private $numero_securite_social;
    private $medecin_referent;

    public function __construct(){
        $this->dbconfig = DbConfig::getDbConfig();
    }
    //+++++++++++++++++++++++++++++++++++++++++++++++++++AFFICHAGE ALL MEDECIN+++++++++++++++++++++++++++++++++++++++++++++++

    public function PrintAllMedecin(){
        try {
            $req = $this->dbconfig->getPDO()->prepare('SELECT * FROM medecin');
            $req->execute();
            $result = $req->fetchAll(PDO::FETCH_ASSOC);
    
            $output = '';
            foreach ($result as $medecin) {
                $output .= '<option value="' . $medecin['Id_Medecin'] . '">' . $medecin['prenom'] . ' ' . $medecin['nom'] . '</option>';
            }
    
            return $output;
        } catch (Exception $pe) {echo 'ERREUR : ' . $pe->getMessage();}
    }
    
    
    //+++++++++++++++++++++++++++++++++++++++++++++++++++AJOUT USER+++++++++++++++++++++++++++++++++++++++++++++++
    public function addUser()
    {
        try {
            $req = $this->dbconfig->getPDO()->prepare('INSERT INTO usager (civilite ,nom, prenom, adresse, date_naissance,lieu_naissance, numero_securite_social,medecin_referent) 
            VALUES (:civilite,:nom, :prenom, :adresse, :date_naissance,:lieu_naissance, :numero_securite_social, :medecin_referent )');

            $req->execute(array(
                'nom' => $this->nom,
                'civilite' => $this->civilite,
                'prenom' => $this->prenom,
                'adresse' => $this->adresse,
                'date_naissance' => $this->date_naissance,
                'lieu_naissance' => $this->lieu_naissance,
                'numero_securite_social' => $this->numero_securite_social,
                'medecin_referent' => $this->medecin_referent,

            ));

        } catch (Exception $pe) {echo 'ERREUR : ' . $pe->getMessage();}
    }
    //+++++++++++++++++++++++++++++++++++++++++++++++++++RECHERCHE USER+++++++++++++++++++++++++++++++++++++++++++++++
    // public function SearchUser($context)
    // {
    //     try {
    //         $req = $this->dbconfig->getPDO()->prepare('SELECT Id_Usager,civilite, nom, prenom, adresse, date_naissance, lieu_naissance, numero_securite_social
    //         FROM usager WHERE nom = :nom AND prenom = :prenom');

    //         $req->execute(array(
    //             ':nom' => $this->nom,
    //             ':prenom' => $this->prenom,
    //         ));
    //         session_start();

    //         if($context === 'Modify'){
    //             $_SESSION['req'] = $req->fetchAll(PDO::FETCH_ASSOC);
    //             header('Location: ../../front_end/usager/ModifyUsager.php');
    //         }elseif($context === 'Delete'){
    //             $_SESSION['req'] = $req->fetchAll(PDO::FETCH_ASSOC);
    //             header('Location: ../../front_end/usager/DeleteUsager.php');
    //         }
    //         session_write_close();
    //     } 
    //     catch (Exception $pe) { echo 'ERREUR : ' . $pe->getMessage(); }
    // }
    public function SearchUser($context)
    {
        try {
            $req = $this->dbconfig->getPDO()->prepare('SELECT Id_Usager,civilite, nom, prenom, adresse, date_naissance, lieu_naissance, numero_securite_social
            FROM usager WHERE nom = :nom AND prenom = :prenom');
    
            $req->execute(array(
                ':nom' => $this->nom,
                ':prenom' => $this->prenom,
            ));
<<<<<<< HEAD
            $result = $req->fetch(PDO::FETCH_ASSOC);

            if($context === 'Modify'){
                $url = '../../front_end/usager/' . $context . 'Usager.php?' . http_build_query($result);
                header('Location: ' . $url);
            }elseif($context === 'Delete'){
                header('Location: ../../front_end/usager/DeleteUsager.php');
            }
        } 
        catch (Exception $pe) { echo 'ERREUR : ' . $pe->getMessage(); }
    }
=======
    
            $result = $req->fetch(PDO::FETCH_ASSOC);
    
            if ($result !== false) {
                if ($context === 'Modify') {
                    $url = '../../front_end/usager/ModifyUsager.php?' . http_build_query($result);
                    header('Location: ' . $url);
                    exit();
                } elseif ($context === 'Delete') {
                    $url = '../../front_end/usager/DeleteUsager.php?' . http_build_query($result);
                    header('Location: ' . $url);
                    exit();
                }
            } else {
                echo 'Aucun utilisateur trouvé.';
            }
        } catch (Exception $pe) {echo 'ERREUR : ' . $pe->getMessage();}
    }
    

>>>>>>> 87643665498d3bc276687a23dec5e5c559efc8a8
    //+++++++++++++++++++++++++++++++++++++++++++++++++++DELETE USER+++++++++++++++++++++++++++++++++++++++++++++++

    public function DeleteUser(){
        try{
            $req = $this->dbconfig->getPDO()->prepare(
                'DELETE FROM usager
                WHERE Id_Usager = :user_id');
    
            $req->execute(array(
                'user_id' => $this->Id_Usager,
            ));
            
        }catch(Exception $pe){echo 'ERREUR : ' . $pe->getMessage();}
    }
    //+++++++++++++++++++++++++++++++++++++++++++++++++++MODIFICATION USER+++++++++++++++++++++++++++++++++++++++++++++++
    public function ModifyUser(){
        try{
            $req = $this->dbconfig->getPDO()->prepare(
            'UPDATE usager SET 
                civilite = :form_civilite,
                nom = :form_nom,
                prenom = :form_prenom,
                adresse = :form_adresse,
                date_naissance = :form_date_naissance,
                lieu_naissance = :form_lieu_naissance,
                numero_securite_social = :form_numero_securite_social
                WHERE Id_Usager = :user_id');

            $req->execute(array(
                'user_id' => $this->Id_Usager,
                'form_civilite' => $this->civilite,
                'form_nom' => $this->nom,
                'form_prenom' => $this->prenom,
                'form_adresse' => $this->adresse,
                'form_date_naissance' => $this->date_naissance,
                'form_lieu_naissance' => $this->lieu_naissance,
                'form_numero_securite_social' => $this->numero_securite_social,

            ));


            
        }catch(Exception $pe){echo 'ERREUR : ' . $pe->getMessage();}
    } 

    public function CheckUsagerExist(){
        try{
            $req = $this->dbconfig->getPDO()->prepare('SELECT * FROM usager WHERE nom = :nom AND prenom = :prenom' );

            $req->execute(array(
                'prenom' => $this->prenom,
                'nom' => $this->nom,
            ));

            $usager = $req->fetch();
            if($usager){
                header('Location: ../../front_end/usager/usager.php?nom=' . urlencode($usager['nom']) . '&prenom=' . urlencode($usager['prenom']));
            }else{
                header('Location: ../../front_end/index.html');
            }

        }catch(Exception $pe){echo 'ERREUR : ' . $pe->getMessage();}
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
            $req = $this->dbconfig->getPDO()->prepare('SELECT * FROM rdv WHERE Id_Usager = :IdUsager');
            $req->bindValue(':IdUsager', $Id_Usager, PDO::PARAM_INT);
            $req->execute();

            return $req;
        } catch (Exception $pe) {
            echo 'ERREUR : ' . $pe->getMessage();
        }
    }

    //+++++++++++++++++++++++++++++++++++++++++++++++++++SETTER+++++++++++++++++++++++++++++++++++++++++++++++
    public function setId($Id_Usager){
        $this->Id_Usager = $Id_Usager;
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
    public function setMedecinReferent($medecin_referent){
        $this->medecin_referent = $medecin_referent;
    }
    public function getIdUsager(){
        return $this->Id_Usager;
    }
    
    public function getCivilite(){
        return $this->civilite;
    }
    
    public function getNom(){
        return $this->nom;
    }
    
    public function getPrenom(){
        return $this->prenom;
    }
    
    public function getAdresse(){
        return $this->adresse;
    }
    
    public function getDateNaissance(){
        return $this->date_naissance;
    }
    
    public function getLieuNaissance(){
        return $this->lieu_naissance;
    }
    
    public function getNumeroSecuriteSocial(){
        return $this->numero_securite_social;
    }
    
    public function getMedecinReferent(){
        return $this->medecin_referent;
    }
    

}
?>
