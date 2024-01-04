
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Espace Usagers</title>
    <link  rel="stylesheet" href="../style/global.css">
    <link  rel="stylesheet" href="../style/espace_usagers.css">
</head>
<body>
    <?php

        $nom =  $_GET['nom'];
        $prenom = $_GET['prenom'];
        echo "<h1>Vous etes connecté en tant que : $nom $prenom</h1><br>"
    ?>
    <?php
    require_once '../../back_end/Objects/Rendez_vous.php';
    require_once("../../back_end/Objects/Medecin.php");


    $rendv = new Rendez_vous();
    $medecin = new Medecin();
    $InformationUsager = $rendv->getUsagerIDByNameAndFristName($nom, $prenom);
    echo "<h1>Liste de vos rendez-vous : </h1>";

    $allRdv = $rendv->getAllRdvUsagerByIdUsager($InformationUsager[0]['Id_Usager']);
    if ($allRdv !== null) {
        foreach ($allRdv as $rdv) {
            $getInfoMedecin = $medecin->getNameAndFirstNameByID($rdv['Id_Medecin']);
            $getHoursMinutes = $rendv->convertMinutesToHoursMinutes($rdv['duree_rendez_vous']);

            echo '<link rel="stylesheet" href="style/consultations.css">';
                echo '<div class="allRdv">';
                    echo '<form action="" method="post">';
                    echo '<input type="hidden"readonly  name="duree_rendez_vous" value="' . $rdv['duree_rendez_vous'] . ' min"><br>';

                    echo 'date rendez vous: <input type="text"readonly  name="date_rendez_vous" value="' . $rdv['date_rendez_vous'] . '"><br>';
                    echo 'Heure rendez vous : <input type="text"readonly  name="heure_rendez_vous" value="' . $rdv['heure_rendez_vous'] . '"><br>';
                    echo 'Durée rendez vous : <input type="text"readonly  name="duree" value="' . $getHoursMinutes . '"><br>';
                    echo 'Nom & prénom du médecin : <input type="text"readonly  name="nom_medecin" value="' . $getInfoMedecin . '"><br>';

                    echo '<input type="hidden"readonly  name="Id_Medecin" value="' . $rdv['Id_Medecin'] . '"><br>';
                    echo '</form>';
                echo '</div>';
        }
    } else {
        echo "Aucun rendez-vous trouvé.";
    }
    ?>
</body>
</html>