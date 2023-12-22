<?php

    require_once '../Objects/dbConfig.php';
    require_once '../Objects/Usager.php';

    checkInputToAddUser($_POST);
    $commandAddUser = setCommandAddUser($_POST);
    $commandAddUser->addUser();
    header('Location: ../../front_end/Usagers.html');




    function checkInputToAddUser($POST){
        if(!isset($POST['civilite'])){
            exceptions_error_handler('civilite pas fait');
        }

        if(!isset($POST['nom'])){
            exceptions_error_handler('nom pas fait');
        }

        if(!isset($POST['prenom'])){
            exceptions_error_handler('prenom pas fait');
        }
        
        if(!isset($POST['adresse'])){
            exceptions_error_handler('adresse pas fait');
        }

        if(!isset($POST['date_naissance'])){
            exceptions_error_handler('date_naissance pas fait');
        }

        if(!isset($POST['lieu_naissance'])){
            exceptions_error_handler('lieu_naissance pas fait');
        }

        if(!isset($POST['numero_securite_social'])){
            exceptions_error_handler('numero_securite_social pas fait');
        }
    }

    function setCommandAddUser($POST){
        $commandAddUserToReturn = new Usager();
        
        $commandAddUserToReturn->setCivilite($POST['civilite']);
        $commandAddUserToReturn->setNom($POST['nom']);
        $commandAddUserToReturn->setPrenom($POST['prenom']);
        $commandAddUserToReturn->setAdresse($POST['adresse']);
        $commandAddUserToReturn->setDateNaissance($POST['date_naissance']);
        $commandAddUserToReturn->setLieuNaissance($POST['lieu_naissance']);
        $commandAddUserToReturn->setNumeroSecuriteSocial($POST['numero_securite_social']);
        return $commandAddUserToReturn;
    }



    function exceptions_error_handler($message) {
        throw new ErrorException($message);
    }

?>  