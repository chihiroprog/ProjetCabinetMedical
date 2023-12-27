
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title></title>

    <link  rel="stylesheet" href="style/gestionnaire.css">
    <link  rel="stylesheet" href="style/global.css">
</head>

<header >
    <div class="appName"> App </div>

    <div class="navBar">
        <ul>
            <li><a href="index.html" class="navElement">Accueil</a></li>
            <li><a href="Usagers.php" class="navElement">Usagers</a></li>
            <li><a href="Consultations.html" class="navElement">Consultations</a></li>
            <li><a href="Médecins.html" class="navElement">Médecins</a></li>
            <li><a href="Statistiques.html" class="navElement">Statistiques</a></li>
        </ul>
    </div>

    <div class="Compte">
        <a href="#">Votre compte</a>
    </div>
</header>

<body>


    <div>
        <div class="category">
            <h1>Usagers</h1>
        </div>

        <div class="global_gestion_user">
            <div class="ajout_usagers">
                  
                <form action="../back_end/Usager/AddUsager.php" method="post">
                    <h2>Ajouter un usager</h2>
                    <legend>Sexe</legend>
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
                    <input type="text" name="numero_securite_social" id="numero_securite_social">

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
                    <input type="text" name="numero_securite_social" id="numero_securite_social" >

                    <input type="submit" value="Supprimer">
                </form>
            </div>
        </div>
    </div>  

    <!-- /* MEDECIN ++++++++++++++++++++++++++++++++++++++++++ */ -->

</body>

</html>