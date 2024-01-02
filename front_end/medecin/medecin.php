
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Espace Medecin</title>
    <link  rel="stylesheet" href="../style/global.css">
    <link  rel="stylesheet" href="../style/espace_medecin.css">
</head>
<body>
    <?php

        $nom =  $_GET['nom'];
        $prenom = $_GET['prenom'];
        echo "<h1>Vous etes connecté en tant que : $nom $prenom</h1><br>"
    ?>
    <?php
    require_once '../../back_end/Objects/Rendez_vous.php';

    $medecin = new Rendez_vous();
    $InformationMedecin = $medecin->getMedecinIDByNameAndFristName($nom, $prenom);

    echo "<h1>Liste de vos rendez-vous : </h1>";

    $allRdv = $medecin->getAllRdvMedecinByIdMedecin($InformationMedecin[0]['Id_Medecin']);

    if ($allRdv !== null) {
        foreach ($allRdv as $rdv) {
            echo '<link rel="stylesheet" href="style/consultations.css">';
                echo '<div class="allRdv">';
                    echo '<form action="" method="post">';
                    echo 'Prenom du patient: <input type="text"readonly name="nom" value="' . $rdv['Nom_patient'] . '"><br>';
                    echo 'Nom du patient: <input type="text" readonly name="prenom" value="' . $rdv['Prenom_patient'] . '" ><br>';
                    echo 'duree rendez vous: <input type="text"readonly  name="duree_rendez_vous" value="' . $rdv['Duree_rendez_vous'] . ' min"><br>';
                    echo 'date rendez vous: <input type="text"readonly  name="date_rendez_vous" value="' . $rdv['Date_rendez_vous'] . '"><br>';
                   // echo 'Id_Medecin: <input type="text"readonly  name="Id_Medecin" value="' . $rdv['Id_Medecin'] . '"><br>';
                    echo '</form>';
                echo '</div>';

        }
    } else {
        echo "Aucun rendez-vous trouvé.";
    }
    ?>
</body>
</html>