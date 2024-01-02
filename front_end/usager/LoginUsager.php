<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion patient</title>
    <link  rel="stylesheet" href="../style/global.css">
    <link  rel="stylesheet" href="../style/form_usagers.css">

</head>
<body>
    <?php
        echo '<form action="../../back_end/Login/loginUsagers.php" method="POST">';
        echo ' <label for ="Nom">Nom</label>';
        echo ' <input for="nom" type="text" name="nom" id="nom" required><br>';
        
        echo ' <label for="prenom">Prenom</label>';
        echo ' <input for="prenom" type="text" name="prenom" id="prenom" required><br>';
        
        echo '<input type="submit" value="Valider">';
        echo '</form>';
    ?>
</body>
</html>
