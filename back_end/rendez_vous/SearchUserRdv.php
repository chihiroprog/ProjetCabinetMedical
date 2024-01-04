<?php
    session_start();

    require_once '../Objects/dbConfig.php';
    require_once '../Objects/Rendez_vous.php';

    checkInputToSearch($_POST);
    $commandSearch = setCommandSearch($_POST);

    $_SESSION['commandSearchData'] = [
        'numeroSecuriteSocial' => $commandSearch->getNumeroSecuriteSocial(),
    ];

    header('Location: ../../front_end/rdv/AddRdv.php');
    session_write_close();


    function checkInputToSearch($POST){
        if(!isset($POST['numero_securite_social'])){
            exceptions_error_handler('numero_securite_social null');
        }
    }

    function setCommandSearch($POST){
        $commandAddUserToReturn = new Rendez_vous();
        $commandAddUserToReturn->setNumeroSecuriteSocial($POST['numero_securite_social']);
        return $commandAddUserToReturn;
    }

    function exceptions_error_handler($message) {
        throw new ErrorException($message);
    }
?>


