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
    public function SearchUser($context)
    {
        try {
            $req = $this->dbconfig->getPDO()->prepare('SELECT Id_Usager,civilite, nom, prenom, adresse, date_naissance, lieu_naissance, numero_securite_social
            FROM usager WHERE nom = :nom AND prenom = :prenom');

            $req->execute(array(
                ':nom' => $this->nom,
                ':prenom' => $this->prenom,
            ));

            if($context === 'Modify'){
                $this->printModifyUser($req);
            }elseif($context === 'Delete'){
                $this->printDeleteUser($req);
            }
        } 
        catch (Exception $pe) { echo 'ERREUR : ' . $pe->getMessage(); }
    }
    //+++++++++++++++++++++++++++++++++++++++++++++++++++AFFICHAGE POUR MODIF USER+++++++++++++++++++++++++++++++++++++++++++++++

    function printModifyUser($req){
        while ($row = $req->fetch(PDO::FETCH_ASSOC)) {
            echo '<form action="../Usager/ModifyUser.php" method="POST">';
            
            echo '<input type="hidden" name="user_id" value="' . $row['Id_Usager'] . '">';
    
            echo '<label for="civilite_homme"><input type="radio" name="form_civilite" value="homme" required';
            echo ($row['civilite'] == 'homme') ? ' checked' : '';
            echo '>homme</label>';
            
            echo '<label for="civilite_femme"><input type="radio" name="form_civilite" value="femme" required';
            echo ($row['civilite'] == 'femme') ? ' checked' : '';
            echo '>femme</label><br>';
    
            echo 'Nom: <input type="text"  name="form_nom" value="' . $row['nom'] . '" ><br>';
            echo 'Prénom: <input type="text" name="form_prenom" value="' . $row['prenom'] . '"><br>';
            echo 'Adresse: <input type="text" name="form_adresse" value="' . $row['adresse'] . '"><br>';
            echo 'Date de naissance: <input type="text" name="form_date_naissance" value="' . $row['date_naissance'] . '"><br>';
            echo 'Lieu de naissance: <input type="text" name="form_lieu_naissance" value="' . $row['lieu_naissance'] . '"><br>';
            echo 'Numéro de sécurité sociale: <input type="text" name="form_numero_securite_social" value="' . $row['numero_securite_social'] . '"><br>';
            
            echo '<input type="submit" value="Modifier">';
            echo '</form>';
        }
    }
    //+++++++++++++++++++++++++++++++++++++++++++++++++++AFFICHAGE POUR DELETE USER+++++++++++++++++++++++++++++++++++++++++++++++
    function printDeleteUser($req){
        while ($row = $req->fetch(PDO::FETCH_ASSOC)) {
            echo '<form action="../Usager/DeleteUser.php" method="POST">';
            
            echo '<input type="hidden" name="user_id" value="' . $row['Id_Usager'] . '">';
    
            echo '<label for="civilite_homme"><input type="radio" disabled name="form_civilite" value="homme" required';
            echo ($row['civilite'] == 'homme') ? ' checked' : '';
            echo '>homme</label>';
            
            echo '<label for="civilite_femme"><input type="radio" disabled name="form_civilite" value="femme" required';
            echo ($row['civilite'] == 'femme') ? ' checked' : '';
            echo '>femme</label><br>';
    
            echo 'Nom: <input type="text" disabled name="form_nom" value="' . $row['nom'] . '" ><br>';
            echo 'Prénom: <input type="text" disabled name="form_prenom" value="' . $row['prenom'] . '"><br>';
            echo 'Adresse: <input type="text" disabled name="form_adresse" value="' . $row['adresse'] . '"><br>';
            echo 'Date de naissance: <input type="text" disabled name="form_date_naissance" value="' . $row['date_naissance'] . '"><br>';
            echo 'Lieu de naissance: <input type="text" disabled name="form_lieu_naissance" value="' . $row['lieu_naissance'] . '"><br>';
            echo 'Numéro de sécurité sociale: <input type="text"disabled  name="form_numero_securite_social" value="' . $row['numero_securite_social'] . '"><br>';
            
            echo '<input type="submit" value="Supprimer">';
            echo '</form>';
        }
    }
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
                header('Location: ../../front_end/usager/usager.php');
            }else{
                header('Location: ../../front_end/index.html');
                echo 'usager non trouvé';
            }

        }catch(Exception $pe){echo 'ERREUR : ' . $pe->getMessage();}
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
