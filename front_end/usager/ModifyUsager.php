<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un médecin</title>
</head>
<body>
    <?php
        session_start();
        require_once '../../back_end/Objects/Medecin.php';
        $req = $_SESSION['req'];
        foreach ($req as $row) {
            echo '<link rel="stylesheet" href="../style/modifyUsager.css">';
            echo '<link rel="stylesheet" href="../style/global.css">';

            echo '<div class="modifUsager">';
            echo '<form action="../../back_end/Usager/ModifyUser.php" method="POST" class="modify-form">';
            
            echo '<input type="hidden" name="user_id" value="' . $row['Id_Usager'] . '">';
    
            echo '<label for="civilite_homme"><input type="radio" name="civilite" value="homme" required';
            echo ($row['civilite'] == 'homme') ? ' checked' : '';
            echo '>homme</label>';
            
            echo '<label for="civilite_femme"><input type="radio" name="civilite" value="femme" required';
            echo ($row['civilite'] == 'femme') ? ' checked' : '';
            echo '>femme</label><br>';
    
            echo 'Nom: <input type="text"  name="form_nom" value="' . $row['nom'] . '" ><br>';
            echo 'Prénom: <input type="text" name="form_prenom" value="' . $row['prenom'] . '"><br>';
            echo 'Adresse: <input type="text" name="form_adresse" value="' . $row['adresse'] . '"><br>';
            echo 'Date de naissance: <input type="text" name="form_date_naissance" value="' . $row['date_naissance'] . '"><br>';
            echo 'Lieu de naissance: <input type="text" name="form_lieu_naissance" value="' . $row['lieu_naissance'] . '"><br>';
            echo 'Numéro de sécurité sociale: <input type="text" name="form_numero_securite_social" value="' . $row['numero_securite_social'] . '"><br>';
            
            echo '<input type="submit" value="Modifier">';
            echo '</form>';
            echo '</div>';

        }
        session_write_close();
    ?>
    <button class="button_back">
        <a href="../Usagers.php" style="text-decoration: none;">Retour</a>
    </button>


</body>
</html>