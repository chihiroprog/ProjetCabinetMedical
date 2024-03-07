<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title></title>

    <link  rel="stylesheet" href="style/consultations.css">
    <link  rel="stylesheet" href="style/global.css">
    <?php
    if (isset($_GET['success']) && $_GET['success'] == 1) {
        echo '<script>
                setTimeout(function() {
                    document.getElementById("confirmationMessage").style.display = "none";
                }, 5000);
                </script>';
    }
    if (isset($_GET['success']) && $_GET['success'] == 2) {
        echo '<script>
                setTimeout(function() {
                    document.getElementById("confirmationMessageAjoutRdv").style.display = "none";
                }, 5000);
                </script>';
    }
    if (isset($_GET['success']) && $_GET['success'] == 3) {
        echo '<script>
                setTimeout(function() {
                    document.getElementById("confirmationMessage").style.display = "none";
                }, 5000);
                </script>';
    }
    if (isset($_GET['echec']) && $_GET['echec'] == 1) {
        echo '<script>
                setTimeout(function() {
                    document.getElementById("FailMessageAjoutrdv").style.display = "none";
                }, 5000);
                </script>';
    }
    if (isset($_GET['echec']) && $_GET['echec'] == 2) {
        echo '<script>
                setTimeout(function() {
                    document.getElementById("FailMessageAjoutrdv").style.display = "none";
                }, 5000);
                </script>';
    }
    ?>
</head>

<header >
    <div class="navBar">
        <ul>
            <li><a href="index.html" class="navElement">Accueil</a></li>
            <li><a href="Usagers.php" class="navElement">Usagers</a></li>
            <li><a href="Consultations.php" class="navElement">Consultations</a></li>
            <li><a href="Médecins.php" class="navElement">Médecins</a></li>
            <li><a href="Statistiques.php" class="navElement">Statistiques</a></li>
        </ul>
    </div>
    
    <h1>Creation de rendez-vous</h1>
    <?php
    if (isset($_GET['success']) && $_GET['success'] == 2) {
        echo '<div id="confirmationMessageAjoutRdv">Rendez-vous bien ajouté</div>';
    }
    if (isset($_GET['echec']) && $_GET['echec'] == 1) {
        echo '<div id="FailMessageAjoutrdv">Plage horraire non disponible</div>';
    }
    if (isset($_GET['echec']) && $_GET['echec'] == 2) {
        echo '<div id="FailMessageAjoutrdv">Patient introuvable</div>';
    }
    ?>
    <div class="register">
        <form action="../back_end/rendez_vous/SearchUserRdv.php" method="post">
            <label for="numero_securite_social">Numéro de securité social du patient</label>
            <input type="text" name="numero_securite_social" required>
            <input type="submit" value="Ajouter un rendez-vous">
        </form>
    </div>

    <form action="" method="post" class="form_recherche">
        <?php
            require_once("../back_end/Objects/Usager.php");

            $usager = new Usager();
            $printAllMedecin = $usager->PrintAllMedecin();

            echo '<select name="medecin_selectionner">';
            echo '<option value="" selected disabled>Sélectionnez un médecin</option>'; // Option par défaut
            echo $printAllMedecin;
            echo '</select>';
            
        ?>
        <input type="submit" name="Rechercher"value="Rechercher">
        <input type="submit" name="Reinitialiser" value="Reinitialiser">
    </form>
    <h1>Liste des rendez-vous</h1>
    <?php
        if (isset($_GET['success']) && $_GET['success'] == 1) {
            echo '<div id="confirmationMessage">Rendez-vous bien supprimer</div>';
        }
        if (isset($_GET['success']) && $_GET['success'] == 3) {
            echo '<div id="confirmationMessage">Rendez-vous bien Modifié</div>';
        }
    ?>
    
    <?php
    require_once("../back_end/Objects/DbConfig.php");
    require_once("../back_end/Objects/Rendez_vous.php");
    require_once("../back_end/Objects/Medecin.php");


    $commandButtonClicked = true;
    $commandSearchRdv = null;
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['Reinitialiser'])) {
            $commandButtonClicked = true;
        } else {
            $commandButtonClicked = false;
            $commandSearchRdv = $_POST['medecin_selectionner'];
        }
    }
    
    $statistique = new Rendez_vous();
    if ($commandButtonClicked === false) {
        $allRdv = $statistique->SearchRdvByMedecin($commandSearchRdv);
    } else {
        $allRdv = $statistique->getallRdv();
    }
    $medecin = new Medecin();
    $usager = new Usager();


    if ($allRdv !== null) {
        foreach ($allRdv as $rdv) {
            $getInfoUsager = $usager->getInformationByID($rdv['Id_Usager']);
            $getInfoMedecin = $medecin->getNameAndFirstNameByID($rdv['Id_Medecin']);
            $getHoursMinutes = $statistique->convertMinutesToHoursMinutes($rdv['duree_rendez_vous']);

            echo '<link rel="stylesheet" href="style/consultations.css">';
            echo '<div class="allRdv">';
                echo '<form action="../back_end/rendez_vous/CheckRdv.php" method="post">';
                        echo '<input type="hidden"readonly name="id_rendez_vous" value="' . $rdv['id_rendez_vous'] . '"><br>';
                        echo '<input type="hidden"readonly  name="duree" value="' . $rdv['duree_rendez_vous'] . '"><br>';
                        echo '<input type="hidden" readonly  name="Id_Medecin" value="' . $rdv['Id_Medecin'] . '"><br>';


                    echo 'Nom & prénom du patient : <input type="text"readonly name="nomprenom" value="' . $getInfoUsager['nom'] .' '.  $getInfoUsager['prenom'] .'"><br>';
                    echo 'Durée rendez vous : <input type="text"readonly  name="dureevisu" value="' . $getHoursMinutes . '"><br>';
                    echo 'Date rendez vous : <input type="text"readonly  name="date_rendez_vous" value="' . $rdv['date_rendez_vous'] . '"><br>';
                    echo 'Heure rendez vous : <input type="text"readonly  name="heure_rendez_vous" value="' . $rdv['heure_rendez_vous'] . '"><br>';
                    echo 'Nom & prénom du médecin : <input type="text"readonly  name="nom_medecin" value="' . $getInfoMedecin . '"><br>';
                    
                        echo '<input type="hidden"readonly  name="Id_Usager" value="' . $rdv['Id_Usager'] . '"><br>';
                        echo '<input type="hidden"  name="duree_rendez_vous" value="' . $rdv['duree_rendez_vous'] . '"><br>';
                        echo '<input type="hidden"readonly  name="numero_securite_social" value="' . $getInfoUsager['numero_securite_social'] . '"><br>';



                    echo '<input type="submit" name="Modifier" value="Modifier">';
                    echo '<input type="submit" name="Supprimer" value="Supprimer">';
                echo '</form>';
            echo '</div>';
        }
    } else {
        echo 'Aucun rendez-vous trouvé.';
    }
?>


</header>

<body>
    
</body>

</html>