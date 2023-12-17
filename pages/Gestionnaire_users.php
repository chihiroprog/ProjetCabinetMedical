
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title></title>

    <link href="../css/gestionnaire.css" rel="stylesheet">
</head>

<body>
    <nav>
        <div class="">
            <a href="index.html" class="">Accueil</a>
            <a href="Gestionnaire_users.html" class="">Gestionnaire Utilisateurs</a>
            <a href="saisi_Rendez_vous.html" class="">Rendez-Vous</a>
            <a href="Planning.html" class="">Planning</a>
            <a href="statistique.html" class="">Statistique</a>
        </div>
    </nav>

    <div>
        <h1>Usagers</h1>
        <div class="global_gestion_user">
            <div class="ajout_usagers">
                
                <?php
                    require_once '../php/users/AjoutUsagersCommand.php';
                    if (isset($_POST['civilite']) && isset($_POST['nom'])) {
                        AjoutUsager();
                    }

                    function AjoutUsager(){
                        $comand = new AjoutUsagersCommand($_POST['civilite'], $_POST['nom'], $_POST['prenom'], $_POST['adresse'],  $_POST['date_naissance'],  $_POST['lieu_naissance'], $_POST['numero_securite_social']);
                        $comand->execute();
                    }
                ?>         
                <form action="" method="post">
                    <h2>Ajouter un usager</h2>

                    <label for="civilite">Civilité</label>
                    <input type="text" name="civilite" id="civilite" required>
                    

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

                    <input type="submit" value="Ajouter">
                </form>
            </div>

            <?php
                require_once '../php/users/ModifierUsagersCommand.php';
                if (isset($_POST['nom']) && isset($_POST['prenom'])) {
                    ModifierUsager();
                }
                function ModifierUsager(){
                    $command = new ModifierUsagersCommand($_POST['nom'], $_POST['prenom'], $_POST['numero_securite_social']);
                    $command->execute();

                }
            ?>
            <div class="modifications_usagers">
            <form action="" method="post">
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
            <form action="../php/users/rechercher_usagers.php" method="post">
                    <h2>Supprimer un usager</h2>

                    <label for="nom">Nom</label>
                    <input type="text" name="nom" id="nom" >

                    <label for="prenom">Prenom</label>
                    <input type="text" name="prenom" id="prenom" >

                    <!-- <label for="numero_securite_social">Numéro sécurité social</label>
                    <input type="text" name="numero_securite_social" id="numero_securite_social" required> -->

                    <input type="submit" value="Supprimer">
                </form>
            </div>
        </div>
    </div>  

    <!-- /* MEDECIN ++++++++++++++++++++++++++++++++++++++++++ */ -->
    <div>
        <h1>Médecin</h1>
        <div class="global_gestion_medecins">
            <div class="ajout_medecin">
                <form action="../php/medecin/ajout_medecin.php" method="post">
                    <h2>Ajouter un medecin</h2>
                    <label for="civilite">Nom</label>
                    <input for="nom" type="text" name="nom" id="nom" required>
                    <label for="civilite">Prenom</label>
                    <input for="prenom" type="text" name="prenom" id="prenom" required>
                    <label for="civilite">Civilité</label>
                    <input type="text" name="civilite" id="civilite" required>
                    <input type="submit" value="Ajouter">
                </form>
            </div>
            <div class="modifications_usagers">
                <form action="../php/medecin/modifier_medecin.php" method="post">
                    <h2>Modifier un usager</h2>

                    <label for="nom">Nom</label>
                    <input type="text" name="nom" id="nom" required>

                    <label for="prenom">Prenom</label>
                    <input type="text" name="prenom" id="prenom" required>

                    <input type="submit" value="Modifier">
                </form>
            </div>  
            <div class="suppresion_usagers">
                <form action="../php/medecin/rechercher_medecins.php" method="post">
                    <h2>Supprimer un médecin</h2>

                    <label for="nom">Nom</label>
                    <input type="text" name="nom" id="nom" >

                    <label for="prenom">Prenom</label>
                    <input type="text" name="prenom" id="prenom" >

                    <input type="submit" value="Supprimer">
                </form>
            </div>
        </div>
    </div>
</body>

</html>