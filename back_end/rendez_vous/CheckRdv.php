<?php
require_once '../Objects/dbConfig.php';
require_once '../Objects/Rendez_vous.php';

checkInputToCheckRdv($_POST);
$commandCheckRdv = setCommandCheckRdv($_POST);
$commandCheckButtonClicked = CheckButtonClicked($_POST);

try {
    if ($commandCheckButtonClicked === "m") {
        $url = '../../front_end/rdv/ModifyRdv.php?' . http_build_query([
            'nom' => $commandCheckRdv->getNom(),
            'id_rendez_vous' => $commandCheckRdv->getIdRdv(),
            'date_rendez_vous' => $commandCheckRdv->getDateRdv(),
            'duree_rendez_vous' => $commandCheckRdv->getDureeRdv(),
            'Id_Medecin' => $commandCheckRdv->getMedecinChoseForRdv(),
            'nom_usager' => $commandCheckRdv->getNom(),
            'prenom_usager' => $commandCheckRdv->getPrenom(),
            'numero_secu_usager' => $commandCheckRdv->getNumeroSecuriteSocial(),
            'Id_Usager' => $commandCheckRdv->getIdUsager(),
        ]);
        header('Location: ' . $url);
    } elseif ($commandCheckButtonClicked === "s") {
        $commandCheckRdv->DeleteRdv();
        header('Location: ../../front_end/Consultations.php?success=1');

    } else {
        exceptions_error_handler('Bouton non reconnu');
    }
} catch (Exception $e) {echo 'Erreur : ' . $e->getMessage();}



function checkInputToCheckRdv($POST)
{
    if (!isset($POST['Id_Usager'])) {
        exceptions_error_handler('id user null');
    }
    if (!isset($POST['nom'])) {
        exceptions_error_handler('nom null');
    }
    if (!isset($POST['prenom'])) {
        exceptions_error_handler('prenom null');
    }
    if (!isset($POST['numero_securite_social'])) {
        exceptions_error_handler('numero_securite_social null');
    }
    if (!isset($POST['Id_Medecin'])) {
        exceptions_error_handler('Id_Medecin null');
    }
    if (!isset($POST['date_rendez_vous'])) {
        exceptions_error_handler('date_rendez_vous null');
    }
    if (!isset($POST['duree_rendez_vous'])) {
        exceptions_error_handler('duree_rdv null');
    }
    if (!isset($POST['id_rendez_vous'])) {
        exceptions_error_handler('id rdv null');
    }
    
}

function setCommandCheckRdv($POST)
{
    $commandCheckRevToReturn = new Rendez_vous();

    $commandCheckRevToReturn->setIdRdv($POST['id_rendez_vous']);
    $commandCheckRevToReturn->setDateRdv($POST['date_rendez_vous']);
    $commandCheckRevToReturn->setDureeRdv($POST['duree_rendez_vous']);
    $commandCheckRevToReturn->setmedecinChoseForRdv($POST['Id_Medecin']);
    $commandCheckRevToReturn->setNom($POST['nom']);
    $commandCheckRevToReturn->setPrenom($POST['prenom']);
    $commandCheckRevToReturn->setNumeroSecuriteSocial($POST['numero_securite_social']);
    $commandCheckRevToReturn->setIdUsager($POST['Id_Usager']);
    return $commandCheckRevToReturn;
}

function CheckButtonClicked($POST)
{
    $commandCheckButtonClicked = "";
    if (isset($_POST['Modifier'])) {
        $commandCheckButtonClicked = "m";
    } elseif (isset($_POST['Supprimer'])) {
        $commandCheckButtonClicked = "s";
    }
    return $commandCheckButtonClicked;
}

function exceptions_error_handler($message)
{
    throw new Exception($message);
}
?>
