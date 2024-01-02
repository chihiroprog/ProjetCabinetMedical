
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

    $usager = new Rendez_vous();
    $InformationUsager = $usager->getUsagerIDByNameAndFristName($nom, $prenom);
    echo "<h1>Liste de vos rendez-vous : </h1>";

    $allRdv = $usager->getAllRdvUsagerByIdUsager($InformationUsager[0]['Id_Usager']);
    if ($allRdv !== null) {
        foreach ($allRdv as $rdv) {
            echo '<link rel="stylesheet" href="style/consultations.css">';
                echo '<div class="allRdv">';
                    echo '<form action="" method="post">';
                    echo 'Votre nom: <input type="text"readonly name="nom" value="' . $rdv['Nom_patient'] . '"><br>';
                    echo 'Nom du patient: <input type="text" readonly name="prenom" value="' . $rdv['Prenom_patient'] . '" ><br>';
                    echo 'Votre numéro de sécurite social: <input type="text"readonly name="numero_securite_social"  value="' . $rdv['numero_securite_social'] . '"><br>';
                    echo 'date rendez vous: <input type="text"readonly  name="date_rendez_vous" value="' . $rdv['Date_rendez_vous'] . '"><br>';
                    echo 'Duree rendez vous: <input type="text"readonly  name="duree_rendez_vous" value="' . $rdv['Duree_rendez_vous'] . ' min"><br>';
                    echo 'Id_Medecin: <input type="text"readonly  name="Id_Medecin" value="' . $rdv['Id_Medecin'] . '"><br>';
                    echo '</form>';
                echo '</div>';
        }
    } else {
        echo "Aucun rendez-vous trouvé.";
    }
    ?>
</body>
</html>