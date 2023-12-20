<?php
    require_once '../Objects/Medecin.php';
    require_once '../Objects/dbConfig.php';

    CheckInputDeleteMedecin($_POST);
    $commandToDeleteMedecin = setDeleteMedecinCommand($_POST);
    $commandToDeleteMedecin->DeleteMedecin();

    header('Location: ../../front_end/Gestionnaire_users.html');

    function CheckInputDeleteMedecin($POST){

        if(!isset($POST['Id_Medecin'])){
            exceptions_error_handler('Id_Medecin pas fait');
        }

    }

    function exceptions_error_handler($message) {
        throw new ErrorException($message);
    }

    function setDeleteMedecinCommand($POST){
        $commandToDeleteMedecinToReturn = new Medecin();

        $commandToDeleteMedecinToReturn->setId($POST['Id_Medecin']);
        return $commandToDeleteMedecinToReturn;
    }
?>