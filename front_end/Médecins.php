<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title></title>

    <link href="" rel="stylesheet">
    <link  rel="stylesheet" href="style/medecin.css">
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
                    document.getElementById("confirmationMessage").style.display = "none";
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

</header>

<body>

    <div>
        <div class="category">
            <h1>Médecin</h1>
        </div>
        <?php
        if (isset($_GET['success']) && $_GET['success'] == 1) {
            echo '<div id="confirmationMessage">Médecin bien ajouté</div>';
        }
        if (isset($_GET['success']) && $_GET['success'] == 2) {
            echo '<div id="confirmationMessage">Médecin bien modifié</div>';
        }
        if (isset($_GET['success']) && $_GET['success'] == 3) {
            echo '<div id="confirmationMessage">Médecin bien supprimé</div>';
        }
        ?>
        <div class="global_gestion_medecins">
            <div class="ajout_usagers">
                <form action="../back_end/Medecin/AddMedecin.php" method="post">
                    <h2>Ajouter un medecin</h2>
                    <label for="civilite"><input type="radio" name="civilite"  value="homme" required>homme</label>
                    <label for="civilite"><input type="radio" name="civilite"  value="femme" required>femme</label>
                    
                    <label for ="Nom">Nom</label>
                    <input for="nom" type="text" name="nom" id="nom" required>
                    
                    <label for="prenom">Prenom</label>
                    <input for="prenom" type="text" class="bas" name="prenom" id="prenom" required>

                    <input type="submit" value="Ajouter">
                </form>
            </div>
            <div class="modifications_usagers">
                <form action="../back_end/Medecin/SearchMedecin.php" method="post">
                    <input type="hidden" name="context" value="Modify">
                    <h2>Modifier un médecin</h2>

                    <label for="nom">Nom</label>
                    <input type="text" name="nom" id="nom" required>

                    <label for="prenom">Prenom</label>
                    <input type="text" class="bas" name="prenom" id="prenom" required>

                    <input type="submit" value="Modifier">
                </form>
            </div>  
            <div class="suppresion_usagers">
                <form action="../back_end/Medecin/SearchMedecin.php" method="post">
                    <input type="hidden" name="context" value="Delete">
                    <h2>Supprimer un médecin</h2>

                    <label for="nom">Nom</label>
                    <input type="text" name="nom" id="nom" >

                    <label for="prenom">Prenom</label>
                    <input type="text" name="prenom" class="bas"id="prenom" >

                    <input type="submit" value="Supprimer">
                </form>
            </div>
        </div>
    </div>
</body>

</html>