<?php


    CheckInputLogin($_POST);

    function CheckInputLogin($POST){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            if(isset($_POST['btnSecretaire'])){
                header('Location: ../../front_end/Consultations.php');
            }
            if(isset($_POST['btnPatient'])){
                PrintLoginPatient();
                //header('Location: ../../front_end/usagers/usagers.php');
            }
            if(isset($_POST['btnMedecin'])){
                PrintLoginMedecin();
                //header('Location: ../../front_end/medecin/medecin.php');
            }
        }
    }
    function PrintLoginPatient(){
        echo '<form action="loginUsagers.php" method="POST">';
        echo ' <label for ="Nom">Nom</label>';
        echo ' <input for="nom" type="text" name="nom" id="nom" required><br>';
        
        echo ' <label for="prenom">Prenom</label>';
        echo ' <input for="prenom" type="text" name="prenom" id="prenom" required><br>';
        
        echo '<input type="submit" value="Valider">';
        echo '</form>';
    }
    function PrintLoginMedecin(){
        echo '<form action="loginMedecin.php" method="POST">';
        echo ' <label for ="Nom">Nom</label>';
        echo ' <input for="nom" type="text" name="nom" id="nom" required><br>';
        
        echo ' <label for="prenom">Prenom</label>';
        echo ' <input for="prenom" type="text" name="prenom" id="prenom" required><br>';
        
        echo '<input type="submit" value="Valider">';
        echo '</form>';
    }



?>