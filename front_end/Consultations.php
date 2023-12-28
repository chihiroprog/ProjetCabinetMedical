<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title></title>

    <link  rel="stylesheet" href="style/consultations.css">
    <link  rel="stylesheet" href="style/global.css">
</head>

<header >
    <div class="navBar">
        <ul>
            <li><a href="index.html" class="navElement">Accueil</a></li>
            <li><a href="Usagers.php" class="navElement">Usagers</a></li>
            <li><a href="Consultations.php" class="navElement">Consultations</a></li>
            <li><a href="Médecins.html" class="navElement">Médecins</a></li>
            <li><a href="Statistiques.php" class="navElement">Statistiques</a></li>
        </ul>
    </div>
    
    <h1>Creation de rendez-vous</h1>
    <div class="register">
        <form action="../back_end/rendez_vous/SearchUserRdv.php" method="post">
            <label for="numero_securite_social">numero de securité social du patient</label>
            <input type="text" name="numero_securite_social" required>
            <input type="submit" value="Ajouter un rendez-vous">
        </form>
    </div>

    <h1>Liste des rendez-vous</h1>
    <?php
    require_once("../back_end/Objects/DbConfig.php");
    require_once("../back_end/Objects/Rendez_vous.php");

    $statistique = new Rendez_vous();
    $allRdv = $statistique->getallRdv();

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

</header>

<body>
    
</body>

</html>