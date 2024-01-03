<?php
    require_once '../Objects/dbConfig.php';
    require_once '../Objects/Rendez_vous.php';

    checkInputToAddRdv($_POST);
    $commandAddRdv = setCommandAddRdv($_POST);
    $commandAddRdv->ModifyRdv();



    function checkInputToAddRdv($POST){
        if(!isset($POST['idMedecin'])){
            exceptions_error_handler('id user null');
        }
        if(!isset($POST['nomUsager'])){
            exceptions_error_handler('nom null');
        }
        if(!isset($POST['prenomUsager'])){
            exceptions_error_handler('prenom null');
        }
        if(!isset($POST['numSecuriteSociale'])){
            exceptions_error_handler('numero_securite_social null');
        }
        if(!isset($POST['idUsager'])){
            exceptions_error_handler('Id_Medecin null');
        }
        if(!isset($POST['dateRdv'])){
            exceptions_error_handler('date_rdv null');
        }
        if(!isset($POST['dureeRdv'])){
            exceptions_error_handler('duree_rdv null');
        }
    }

    function setCommandAddRdv($POST){
        $commandAddRdvToReturn = new Rendez_vous();
        
        $commandAddRdvToReturn->setDateRdv($POST['dateRdv']);
        $commandAddRdvToReturn->setDureeRdv($POST['dureeRdv']);
        $commandAddRdvToReturn->setmedecinChoseForRdv($POST['idMedecin']);
        $commandAddRdvToReturn->setNom($POST['nomUsager']);
        $commandAddRdvToReturn->setPrenom($POST['prenomUsager']);
        $commandAddRdvToReturn->setNumeroSecuriteSocial($POST['numSecuriteSociale']);
        $commandAddRdvToReturn->setIdUsager($POST['idUsager']);
        return $commandAddRdvToReturn;
    }



    function exceptions_error_handler($message) {
        throw new ErrorException($message);
    }

?>  
?>