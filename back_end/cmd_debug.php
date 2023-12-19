<?php
            echo 'Nombre de lignes affectées : ' . $req->rowCount() . '<br>';
            echo 'ID de l\'usager modifié : ' . $this->Id_Usager . '<br>';
            echo 'Informations de l\'usager : ' . print_r($this, true) . '<br>';
    
            // Afficher les informations de débogage pour la requête SQL
            $req->debugDumpParams();

?>


