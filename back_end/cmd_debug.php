<?php
            echo 'Nombre de lignes affectées : ' . $req->rowCount() . '<br>';
            echo 'ID de l\'usager modifié : ' . $this->Id_Usager . '<br>';
            echo 'Informations de l\'usager : ' . print_r($this, true) . '<br>';
    
            $req->debugDumpParams();


            if($req->rowCount() > 0){
                $this->printModifyMedecin($req);
            } else {
                echo "Aucun médecin trouvé avec le nom {$this->nom} et le prénom {$this->prenom}.";
            }
            
?>


