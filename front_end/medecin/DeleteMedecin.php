<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supprimer un médecin</title>
</head>
<body>
    <?php
        session_start();
        require_once '../../back_end/Objects/Medecin.php';
        $req = $_SESSION['req'];
        foreach ($req as $row) {
            echo '<link rel="stylesheet" href="../style/modifyMedecin.css">';
            echo '<link rel="stylesheet" href="../style/global.css">';

            echo '<div class="modifUsager">';
            echo '<form action="../../back_end/Medecin/DeleteMedecin.php" method="POST" class="modify-form">';
            
            echo '<input name="Id_Medecin" type="hidden" value="' . $row['Id_Medecin'] . '">';
            
            echo '<label class="radio-label" for="civilite_homme"><input type="radio" name="civilite" value="homme" required';
            echo ($row['civilite'] == 'homme') ? ' checked' : '';
            echo '>homme</label>';
            
            echo '<label class="radio-label" for="civilite_femme"><input type="radio" name="civilite" value="femme" required';
            echo ($row['civilite'] == 'femme') ? ' checked' : '';
            echo '>femme</label><br>';
            
            echo 'Nom: <input type="text" disabled name="nom" value="' . $row['nom'] . '" ><br>';
            echo 'Prénom: <input type="text" disabled name="prenom" value="' . $row['prenom'] . '"><br>';
            
            echo '<input type="submit" value="Supprimer">';
            echo '</form>';
            echo '</div>';

        }
    ?>
    <button class="button_back">
        <a href="../Médecins.php" style="text-decoration: none;">Retour</a>
    </button>
</body>
</html>