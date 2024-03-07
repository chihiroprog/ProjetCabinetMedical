<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add rendez-vous</title>
</head>
<body>
<?php
    require_once '../../back_end/Objects/DbConfig.php';
    require_once '../../back_end/Objects/Rendez_vous.php';
    require_once '../../back_end/Objects/Usager.php';

    if(isset($_GET['numero_securite_social'])) {
        $numero_securite_social = $_GET['numero_securite_social'];
        $commandSearch = new Rendez_vous();
        $usager = new Usager();
        
        $commandSearch->SearchUserForRDV($numero_securite_social);
        $listeMedecins = $commandSearch->getNomPrenomMedecin();
        
        $listeMedecinSorted = $commandSearch->sortMedecinReferentFirst($listeMedecins);
        echo '<link rel="stylesheet" href="../style/addRdv.css">';
        echo '<div class="AddRdv">';

        echo '<form action="../../back_end/rendez_vous/AddRdv.php" method="post">';
        echo '<input type="hidden" name="user_id" value="' . $commandSearch->usager->getIdUsager() . '">';
        echo 'Nom: <input type="text" readonly name="nom" value="' . $commandSearch->usager->getNom() . '" ><br>';
        echo 'Prénom: <input type="text" readonly name="prenom" value="' . $commandSearch->usager->getPrenom() . '"><br>';
        echo 'Numéro de sécurité sociale: <input type="text" readonly name="numero_securite_social" value="' . $numero_securite_social . '"><br>';
        echo 'Médecin Référent: <select name="Id_Medecin" >';
        foreach ($listeMedecinSorted as $medecin) {
            echo '<option value="' . $medecin['Id_Medecin'] . '">' . $medecin['nom'] . ' ' . $medecin['prenom'] . '</option>';
        }
        echo '</select><br>';
        echo 'Date du rendez-vous : <input type="date" name="date_rdv" required> <br>';
        echo 'Heure du rendez-vous: <input type="time" name="heure_rdv" required><br>';
        echo 'Durée du rendez-vous en minute: <input type="number" name="duree_rdv" value="30" required> <br>';
        echo '<input type="submit" value="Créer">';
        echo '</form>';
        echo '</div>';


    } else {
        echo 'Les données nécessaires ne sont pas disponibles.';
    }
?>
</body>
</html>
