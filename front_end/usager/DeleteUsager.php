<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un médecin</title>
</head>
<body>
<?php

        require_once("../../back_end/Objects/Usager.php");

        $Id_Usager = $_GET['Id_Usager'];
        $civilite = $_GET['civilite'];
        $nom = $_GET['nom'];
        $prenom = $_GET['prenom'];
        $adresse = $_GET['adresse'];
        $date_naissance = $_GET['date_naissance'];
        $lieu_naissance = $_GET['lieu_naissance'];
        $numero_securite_social = $_GET['numero_securite_social'];

        $usager = new Usager();

        $usager->setId($Id_Usager);
        $usager->setCivilite($civilite);
        $usager->setNom($nom);
        $usager->setPrenom($prenom);
        $usager->setAdresse($adresse);
        $usager->setDateNaissance($date_naissance);
        $usager->setLieuNaissance($lieu_naissance);
        $usager->setNumeroSecuriteSocial($numero_securite_social);

        echo '<link rel="stylesheet" href="../style/modifyUsager.css">';
        echo '<link rel="stylesheet" href="../style/global.css">';

        echo '<div class="modifUsager">';
        echo '<form action="../../back_end/Usager/DeleteUser.php" method="POST" class="modify-form">';
        
        echo '<input type="hidden" name="user_id" value="' . $usager->getIdUsager() . '">';

        echo '<label for="civilite_homme"><input disabled type="radio" name="civilite" value="homme" required';
        echo ($usager->getCivilite() == 'homme') ? ' checked' : '';
        echo '>homme</label>';
        
        echo '<label for="civilite_femme"><input disabled type="radio" name="civilite" value="femme" required';
        echo ($usager->getCivilite() == 'femme') ? ' checked' : '';
        echo '>femme</label><br>';

        echo 'Nom: <input type="text" readonly name="form_nom" value="' . $usager->getNom() . '" ><br>';
        echo 'Prénom: <input type="text" readonly name="form_prenom" value="' . $usager->getPrenom() . '"><br>';
        echo 'Adresse: <input type="text"readonly name="form_adresse" value="' . $usager->getAdresse() . '"><br>';
        echo 'Date de naissance: <input type="text" readonly name="form_date_naissance" value="' . $usager->getDateNaissance() . '"><br>';
        echo 'Lieu de naissance: <input type="text" readonly name="form_lieu_naissance" value="' . $usager->getLieuNaissance() . '"><br>';
        echo 'Numéro de sécurité sociale: <input type="text" readonly name="form_numero_securite_social" value="' . $usager->getNumeroSecuriteSocial() . '"><br>';
        
        echo '<input type="submit" value="Supprimer">';
        echo '</form>';
        echo '</div>';

    ?>
    <button class="button_back">
        <a href="../Usagers.php" style="text-decoration: none;">Retour</a>
    </button>
</body>
</html>