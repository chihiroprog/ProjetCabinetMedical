
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
    require_once '../../back_end/Objects/Medecin.php';

    $medecin = new Medecin();
    $InformationMedecin = $medecin->getMedecinIDByNameAndFristName($nom, $prenom);

    echo "<h1>Liste de vos rendez-vous : </h1>";

    $allRdv = $medecin->getAllRdvMedecinByIdMedecin($InformationMedecin[0]['Id_Medecin']);

    if ($allRdv !== null) {
        foreach ($allRdv as $rdv) {
            echo '<link rel="stylesheet" href="style/consultations.css">';
                echo '<div class="allRdv">';
                    echo '<form action="" method="post">';
                    echo 'Prenom: <input type="text"readonly name="nom" value="' . $rdv['nom_patient'] . '"><br>';
                    echo 'Nom: <input type="text" readonly name="prenom" value="' . $rdv['prenom_patient'] . '" ><br>';
                    echo 'numero de sécurite social: <input type="text"readonly name="numero_securite_social"  value="' . $rdv['numero_securite_social'] . '"><br>';
                    echo 'duree_rendez_vous: <input type="text"readonly  name="duree_rendez_vous" value="' . $rdv['duree_rendez_vous'] . '"><br>';
                    echo 'date_rendez_vous: <input type="text"readonly  name="date_rendez_vous" value="' . $rdv['date_rendez_vous'] . '"><br>';
                    echo 'Id_Medecin: <input type="text"readonly  name="Id_Medecin" value="' . $rdv['Id_Medecin'] . '"><br>';
                    echo 'Id_Usager: <input type="text"readonly  name="Id_Usager" value="' . $rdv['Id_Usager'] . '"><br>';
                    echo '<input type="submit" value="Modifier">';
                    echo '<input type="submit" value="Supprimer">';
                    echo '</form>';
                echo '</div>';

        }
    } else {
        echo "Aucun rendez-vous trouvé.";
    }
    ?>
</body>
</html>