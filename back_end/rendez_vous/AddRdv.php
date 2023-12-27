<?php
    require_once '../Objects/dbConfig.php';
    require_once '../Objects/Rendez_vous.php';
    var_dump($_POST);

    checkInputToAddRdv($_POST);
    $commandAddRdv = setCommandAddRdv($_POST);
    $commandAddRdv->addRdv();
    header('Location: ../../front_end/Consultations.html');


    function checkInputToAddRdv($POST){
        if(!isset($POST['user_id'])){
            exceptions_error_handler('id user null');
        }
        if(!isset($POST['nom'])){
            exceptions_error_handler('nom null');
        }
        if(!isset($POST['prenom'])){
            exceptions_error_handler('prenom null');
        }
        if(!isset($POST['numero_securite_social'])){
            exceptions_error_handler('numero_securite_social null');
        }
        if(!isset($POST['Id_Medecin'])){
            exceptions_error_handler('Id_Medecin null');
        }
        if(!isset($POST['date_rdv'])){
            exceptions_error_handler('date_rdv null');
        }
        if(!isset($POST['duree_rdv'])){
            exceptions_error_handler('duree_rdv null');
        }
    }

    function setCommandAddRdv($POST){
        $commandAddRdvToReturn = new Rendez_vous();
        
        $commandAddRdvToReturn->setDateRdv($POST['date_rdv']);
        $commandAddRdvToReturn->setDureeRdv($POST['duree_rdv']);
        $commandAddRdvToReturn->setmedecinChoseForRdv($POST['Id_Medecin']);
        $commandAddRdvToReturn->setNom($POST['nom']);
        $commandAddRdvToReturn->setPrenom($POST['prenom']);
        $commandAddRdvToReturn->setNumeroSecuriteSocial($POST['numero_securite_social']);
        $commandAddRdvToReturn->setIdUsager($POST['user_id']);
        return $commandAddRdvToReturn;
    }



    function exceptions_error_handler($message) {
        throw new ErrorException($message);
    }

?>  
?>