
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title></title>

    <link  rel="stylesheet" href="style/usagers.css">
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
            <h1>Usagers</h1>
        </div>
        <?php
        if (isset($_GET['success']) && $_GET['success'] == 1) {
            echo '<div id="confirmationMessage">Patient bien ajouté</div>';
        }
        if (isset($_GET['success']) && $_GET['success'] == 2) {
            echo '<div id="confirmationMessage">Patient bien modifié</div>';
        }
        if (isset($_GET['success']) && $_GET['success'] == 3) {
            echo '<div id="confirmationMessage">Patient bien supprimé</div>';
        }
        ?>
        <div class="global_gestion_user">
            <div class="ajout_usagers">
                <form action="../back_end/Usager/AddUsager.php" method="post">
                    <h2>Ajouter un usager</h2>
                    <label for="civilite"><input type="radio" name="civilite"  value="homme" required>homme</label>
                    <label for="civilite"><input type="radio" name="civilite"  value="femme" required>femme</label>
                    

                    <label for="nom">Nom</label>
                    <input type="text" name="nom" id="nom" required>

                    <label for="prenom">Prenom</label>
                    <input type="text" name="prenom" id="prenom" required>

                    <label for="adresse">Adresse complete</label>
                    <input type="text" name="adresse" id="adresse" required>

                    <label for="date_naissance">Date de naissance</label>
                    <input type="date" name="date_naissance" id="date_naissance" required>

                    <label for="lieu_naissance">Lieu de naissance</label>
                    <input type="text" name="lieu_naissance" id="lieu_naissance" required>

                    <label for="numero_securite_social">Numéro sécurité social</label>
                    <input type="text" name="numero_securite_social" id="numero_securite_social" required>
                        <?php
                            require_once("../back_end/Objects/DbConfig.php");
                            require_once("../back_end/Objects/Usager.php");

                            $usager = new Usager();
                            $printAllMedecin = $usager->PrintAllMedecin();

                            echo '<label>Choix du Medecin Référent</label>
                                <select name="medecin_referent">
                                    ' . $printAllMedecin . '
                                </select>';
                        ?>
                    <input type="submit" value="Ajouter">
                </form>
            </div>

            <div class="modifications_usagers">
            <form action="../back_end/Usager/SearchUsager.php" method="post">
                    <input type="hidden" name="context" value="Modify">
                    <h2>Modifier un usager</h2>

                    <label for="nom">Nom</label>
                    <input type="text" name="nom" id="nom" required>

                    <label for="prenom">Prenom</label>
                    <input type="text" name="prenom" id="prenom" required>

                    <label for="numero_securite_social">Numéro sécurité social</label>
                    <input type="text" class="bas" name="numero_securite_social" id="numero_securite_social">

                    <input type="submit" value="Modifier">
                </form>
            </div>

            <div class="suppresion_usagers">
            <form action="../back_end/Usager/SearchUsager.php" method="post">
                <input type="hidden" name="context" value="Delete">
                    <h2>Supprimer un usager</h2>

                    <label for="nom">Nom</label>
                    <input type="text" name="nom" id="nom" >

                    <label for="prenom">Prenom</label>
                    <input type="text" name="prenom" id="prenom" >

                    <label for="numero_securite_social">Numéro sécurité social</label>
                    <input type="text" class="bas" name="numero_securite_social" id="numero_securite_social" >

                    <input type="submit" value="Supprimer">
                </form>
            </div>
        </div>
    </div>  

</body>

</html>