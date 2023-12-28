<?php
require_once 'dbConfig.php';
class Medecin{
    private DbConfig $dbConfig;
    private $nom;
    private $prenom;
    private $civilite;
    private $Id_Medecin;

    public function __construct(){
        $this->dbConfig = DbConfig::getDbConfig();
    
}
//+++++++++++++++++++++++++++++++++++++++++++++++ADD MEDECIN+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

    function AddMedecin(){
        try{
            $req = $this->dbConfig->getPDO()->prepare('INSERT INTO medecin (civilite ,nom, prenom) 
            VALUES (:civilite,:nom, :prenom)');

            $req->execute(array(
                'civilite' => $this->civilite,
                'prenom' => $this->prenom,
                'nom' => $this->nom,

            ));
        }catch(Exception $pe){echo 'ERREUR : ' . $pe->getMessage();}

    }
//+++++++++++++++++++++++++++++++++++++++++++++++++SEARCH MEDECIN +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    function SearchMedecin($context){
        try{    
            $req = $this->dbConfig->getPDO()->prepare('SELECT Id_Medecin , nom , prenom , civilite FROM medecin WHERE nom = :nom AND prenom = :prenom');
            $req->execute(array(
                'nom' => $this->nom,
                'prenom' => $this->prenom,
            ));
            if($context === 'Modify'){
                $this->printModifyMedecin($req);            
            }elseif($context === 'Delete'){
                $this->printDeleteMedecin($req);
            }
        }catch(Exception $pe){echo 'ERREUR : ' . $pe->getMessage();}
    }

//+++++++++++++++++++++++++++++++++++++++++++++++++PRINT MODIFY MEDECIN +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    function printModifyMedecin($req){
        while ($row = $req->fetch(PDO::FETCH_ASSOC)) {
            echo '<form action="../Medecin/ModifyMedecin.php" method="POST">';

            echo '<input name="Id_Medecin" type="hidden" value="' . $row['Id_Medecin'] . '">';

            echo '<label for="civilite_homme"><input type="radio" name="civilite" value="homme" required';
            echo ($row['civilite'] == 'homme') ? ' checked' : '';
            echo '>homme</label>';
            
            echo '<label for="civilite_femme"><input type="radio" name="civilite" value="femme" required';
            echo ($row['civilite'] == 'femme') ? ' checked' : '';
            echo '>femme</label><br>';
    
            echo 'Nom: <input type="text"  name="nom" value="' . $row['nom'] . '" ><br>';
            echo 'Prénom: <input type="text" name="prenom" value="' . $row['prenom'] . '"><br>';
            
            echo '<input type="submit" value="Modifier">';
            echo '</form>';
        }
    }
//+++++++++++++++++++++++++++++++++++++++++++++++++PRINT DELETE MEDECIN +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    function printDeleteMedecin($req){
        while ($row = $req->fetch(PDO::FETCH_ASSOC)) {
            echo '<form action="../Medecin/DeleteMedecin.php" method="POST">';

            echo '<input name="Id_Medecin" type="hidden" value="' . $row['Id_Medecin'] . '">';

            echo '<label for="civilite_homme"><input type="radio" disabled name="civilite" value="homme" required';
            echo ($row['civilite'] == 'homme') ? ' checked' : '';
            echo '>homme</label>';
            
            echo '<label for="civilite_femme"><input type="radio" name="civilite" disabled value="femme" required';
            echo ($row['civilite'] == 'femme') ? ' checked' : '';
            echo '>femme</label><br>';
    
            echo 'Nom: <input type="text" disabled name="nom" value="' . $row['nom'] . '" ><br>';
            echo 'Prénom: <input type="text" disabled name="prenom" value="' . $row['prenom'] . '"><br>';
            
            echo '<input type="submit" value="Supprimer">';
            echo '</form>';
        }
    }
//+++++++++++++++++++++++++++++++++++++++++++++++++DELETE MEDECIN +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    function DeleteMedecin(){
        try{
            $req = $this->dbConfig->getPDO()->prepare('DELETE FROM medecin WHERE Id_Medecin = :Id_Medecin');
            $req->execute(array(
                'Id_Medecin' => $this->Id_Medecin,
            ));
        }catch(Exception $pe){echo 'ERREUR : ' . $pe->getMessage();}
    }
//+++++++++++++++++++++++++++++++++++++++++++++++++MODIFY MEDECIN +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

    function ModifyMedecin(){
        try{
            $req = $this->dbConfig->getPDO()->prepare(
                'UPDATE medecin SET 
                civilite = :civilite, 
                nom = :nom, 
                prenom = :prenom
                WHERE Id_Medecin = :Id_Medecin');

            $req->execute(array(
                'Id_Medecin' => $this->Id_Medecin,
                'civilite' => $this->civilite,
                'nom' => $this->nom,
                'prenom' => $this->prenom,
            ));

        }catch(Exception $pe){echo 'ERREUR : ' . $pe->getMessage();}
    }

    function CheckMedecinExist() {
        try {
            $req = $this->dbConfig->getPDO()->prepare('SELECT * FROM medecin WHERE nom = :nom AND prenom = :prenom');
    
            $req->execute(array(
                'prenom' => $this->prenom,
                'nom' => $this->nom,
            ));
    
            $medecin = $req->fetch();
            if ($medecin) {
                // Utilisez urlencode pour encoder les valeurs dans l'URL
                header('Location: ../../front_end/medecin/medecin.php?nom=' . urlencode($medecin['nom']) . '&prenom=' . urlencode($medecin['prenom']));
                exit;
            } else {
                header('Location: ../../front_end/index.html');
                exit;
            }
    
        } catch (Exception $pe) {
            echo 'ERREUR : ' . $pe->getMessage();
        }
    }
    public function getMedecinIDByNameAndFristName($nom,$prenom){
        try {
            $req = $this->dbConfig->getPDO()->prepare('SELECT Id_Medecin, nom,prenom FROM medecin WHERE nom = :nom AND prenom = :prenom');
            $req->execute(array(
                ':prenom' => $prenom,
                ':nom' => $nom,
            ));
            $result = $req->fetchAll(PDO::FETCH_ASSOC);
    
            return $result;
        } catch (Exception $pe) {echo 'ERREUR : ' . $pe->getMessage();}
    }

    public function getAllRdvMedecinByIdMedecin($Id_Medecin){
        // Sélectionne toutes les lignes où Id_Medecin est égal à $Id_Medecin dans la table rendez-vous
        try {
            $req = $this->dbConfig->getPDO()->prepare('SELECT * FROM rdv WHERE Id_Medecin = :IdMedecin');
            $req->bindValue(':IdMedecin', $Id_Medecin, PDO::PARAM_INT); // Lie la valeur du paramètre
            $req->execute();

            return $req;
        } catch (Exception $pe) {
            echo 'ERREUR : ' . $pe->getMessage();
        }
    }

    

//+++++++++++++++++++++++++++++++++++++++++++++++++++SETTER+++++++++++++++++++++++++++++++++++++++++++++++
    public function setNom($nom){
        $this->nom = $nom;
    }
    public function setPrenom($prenom){
        $this->prenom = $prenom;
    }
    public function setCivilite($civilite){
        $this->civilite = $civilite;
    }
    public function setId($Id_Medecin){
        $this->Id_Medecin = $Id_Medecin;
    }
}
?>