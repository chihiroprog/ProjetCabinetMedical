<?php

    require_once '../Objects/dbConfig.php';
    require_once '../Objects/Usager.php';

    checkInputToModidyUser($_POST);
    $commandModifyUser = setCommandModifyUser($_POST);
    $commandModifyUser->ModifyUser();
    //header('Location: ../../front_end/Gestionnaire_users.html');




    function checkInputToModidyUser($POST){
        if(!isset($POST['nom'])){
            exceptions_error_handler('nom pas fait');
        }
        if(!isset($POST['prenom'])){
            exceptions_error_handler('prenom pas fait');
        }
        if(!isset($POST['numero_securite_social'])){
            exceptions_error_handler('numero_securite_social pas fait');
        }
    }

    function exceptions_error_handler($message) {
        throw new ErrorException($message);
    }

    function setCommandModifyUser($POST){
        $commandModifyUserToReturn = new Usager();
        
        $commandModifyUserToReturn->setNom($POST['nom']);
        $commandModifyUserToReturn->setPrenom($POST['prenom']);
        $commandModifyUserToReturn->setNumeroSecuriteSocial($POST['numero_securite_social']);

        return $commandModifyUserToReturn;
    }
?>  