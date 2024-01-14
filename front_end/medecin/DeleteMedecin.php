<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supprimer un médecin</title>
</head>
<body>
    <?php

        require_once ("../../back_end/Objects/Medecin.php");
        $Id_Medecin = $_GET['Id_Medecin'];
        $nom = $_GET['nom'];
        $prenom = $_GET['prenom'];
        $civilite = $_GET['civilite'];

        $medecin = new Medecin();

        $medecin->setNom($nom);
        $medecin->setPrenom($prenom);
        $medecin->setCivilite($civilite);
        $medecin->setId($Id_Medecin);

        echo '<link rel="stylesheet" href="../style/modifyMedecin.css">';
        echo '<link rel="stylesheet" href="../style/global.css">';

        echo '<div class="modifUsager">';
        echo '<form action="../../back_end/Medecin/DeleteMedecin.php" method="POST" class="modify-form">';

        echo '<input name="Id_Medecin" type="hidden" value="' . $medecin->getId() . '">';

        echo '<label class="radio-label" for="civilite_homme"><input disabled type="radio" name="civilite" value="homme" required';
        echo ($medecin->getCivilite() == 'homme') ? ' checked' : '';
        echo '>homme</label>';

        echo '<label class="radio-label" for="civilite_femme"><input disabled type="radio" name="civilite" value="femme" required';
        echo ($medecin->getCivilite() == 'femme') ? ' checked' : '';
        echo '>femme</label><br>';

        echo 'Nom: <input type="text" readonly name="nom" value="' . $medecin->getNom() . '" ><br>';
        echo 'Prénom: <input type="text" readonly name="prenom" value="' . $medecin->getPrenom() . '"><br>';

        echo '<input type="submit" value="Supprimer">';
        echo '</form>';
        echo '</div>';

    ?>
    <button class="button_back">
        <a href="../Médecins.php" style="text-decoration: none;">Retour</a>
    </button>
</body>
</html>