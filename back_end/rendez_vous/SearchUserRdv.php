<?php
    session_start();

    require_once '../Objects/dbConfig.php';
    require_once '../Objects/Rendez_vous.php';

    checkInputToSearch($_POST);
    $commandSearch = setCommandSearch($_POST);

    $url = '../../front_end/rdv/AddRdv.php?' . http_build_query([
        'numero_securite_social' =>$commandSearch->getNumeroSecuriteSocial(),
    ]);
    header('Location: ' . $url);
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


