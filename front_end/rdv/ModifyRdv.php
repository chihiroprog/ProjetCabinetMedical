<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link  rel="stylesheet" href="../style/global.css">
    <link  rel="stylesheet" href="../style/modifyRdv.css">

</head>
<body>
    
    <h1>Modifier le rendez_vous</h1>
    <?php
        require_once("../../back_end/Objects/DbConfig.php");
        require_once("../../back_end/Objects/Rendez_vous.php");
        require_once("../../back_end/Objects/Medecin.php");

        
        //$nom = $_GET['nom'];
        $id_rendez_vous = $_GET['id_rendez_vous'];
        $date_rendez_vous = $_GET['date_rendez_vous'];
        $duree_rendez_vous = $_GET['duree_rendez_vous'];
        $Id_Medecin = $_GET['Id_Medecin'];
        //$nom_usager = $_GET['nom_usager'];
        //$prenom_usager = $_GET['prenom_usager'];
        //$numero_secu_usager = $_GET['numero_secu_usager'];
        $Id_Usager = $_GET['Id_Usager'];
        $heure_rendez_vous = $_GET['heure_rendez_vous'];

        
        $rendezVous = new Rendez_vous();
        //$rendezVous->setNom($nom);
        $rendezVous->setIdRdv($id_rendez_vous);
        $rendezVous->setDateRdv($date_rendez_vous);
        $rendezVous->setDureeRdv($duree_rendez_vous);
        $rendezVous->setMedecinChoseForRdv($Id_Medecin);
        //$rendezVous->setNom($nom_usager);
        //$rendezVous->setPrenom($prenom_usager);
        //$rendezVous->setNumeroSecuriteSocial($numero_secu_usager);
        $rendezVous->setIdUsager($Id_Usager);
        $rendezVous->setHeureRdv($heure_rendez_vous);

        $medecin = new Medecin();
        $usager = new Usager();
        $getInfoUsager = $usager->getInformationByID($rendezVous->getIdUsager());
        $getInfoMedecin = $medecin->getNameAndFirstNameByID($rendezVous->getMedecinChoseForRdv());
        echo '<div class="container">';
            echo '<div class="allRdv">';
                echo '<form action="../../back_end/rendez_vous/ModifyRdv.php" method="POST">';
                
                echo '<input type="hidden" id="idRdv" name="idRdv" value="' . $rendezVous->getIdRdv() . '"><br>';
                echo '<input type="hidden" id="idMedecin" name="idMedecin" value="' . $rendezVous->getMedecinChoseForRdv() . '"><br>';

                echo '<label for="idMedecin">Nom & prénom du médecin :</label>';
                echo '<input type="text" readonly id="idMedecin" name="medecin" value="' . $getInfoMedecin . '"><br>';
                
                echo '<label for="dateRdv">Date du rendez-vous:</label>';
                echo '<input type="date" id="dateRdv" name="dateRdv" value="' . $rendezVous->getDateRdv() . '"><br>';
                
                echo '<label for="dureeRdv">Durée du rendez-vous:</label>';
                echo '<input type="text" id="dureeRdv" name="dureeRdv" value="' . $rendezVous->getDureeRdv() . '"><br>';
                     
                echo '<label for="HeureRdv">Heure du rendez-vous:</label>';
                echo '<input type="time" id="heureRdv" name="heureRdv" value="' . $rendezVous->getHeureRdv() . '"><br>';

                echo '<label for="HeureRdv">Nom et prénom du patient :</label>';
                echo '<input type="text" readonly id="prenomUsager" name="prenomUsager" value="' . $getInfoUsager["nom"] . ' '.  $getInfoUsager['prenom'] .'"><br>';
                
                echo '<input type="hidden" id="idUsager" name="idUsager" value="' . $rendezVous->getIdUsager() . '"><br>';

                echo '<input type="submit" value="Modifier">';
                echo '</form>';
            echo '</div>';
        echo '</div>';


        function convertDureeIntoHour($pDuree){
            return gmdate('H:i:s', $pDuree * 60);
        }

    ?>
    <button class="button_back">
        <a href="../Consultations.php" style="text-decoration: none;">Retour</a>
    </button>
</body>
</html>



