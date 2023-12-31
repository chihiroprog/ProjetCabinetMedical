    <?php
        require_once '../Objects/dbConfig.php';
        require_once '../Objects/Rendez_vous.php';

        $rendezVous = new Rendez_vous();

        checkInputToAddRdv($_POST);
        $commandAddRdv = setCommandAddRdv($_POST);
        
        $collisions = $rendezVous->CheckColisionRdv($commandAddRdv->getMedecinChoseForRdv(), $commandAddRdv->getDateRdv(), $commandAddRdv->getHeureRdv(), $commandAddRdv->getDureeRdv());
        
        if (!$rendezVous->CheckColisionRdv($commandAddRdv->getMedecinChoseForRdv(), $commandAddRdv->getDateRdv(), $commandAddRdv->getHeureRdv(), $commandAddRdv->getDureeRdv())) {
            $commandAddRdv->AddRdv();
            header('Location: ../../front_end/Consultations.php?success=2');
        } else {
            header('Location: ../../front_end/Consultations.php?echec=1');
        }
        
        

        function checkInputToAddRdv($POST){
            if(!isset($POST['user_id'])){
                exceptions_error_handler('id user null');
            }
            if(!isset($POST['nom'])){
                exceptions_error_handler('nom null');
            }
            if(!isset($POST['prenom'])){
                exceptions_error_handler('prenom null');
            }
            if(!isset($POST['numero_securite_social'])){
                exceptions_error_handler('numero_securite_social null');
            }
            if(!isset($POST['Id_Medecin'])){
                exceptions_error_handler('Id_Medecin null');
            }
            if(!isset($POST['date_rdv'])){
                exceptions_error_handler('date_rdv null');
            }
            if(!isset($POST['duree_rdv'])){
                exceptions_error_handler('duree_rdv null');
            }
            if(!isset($POST['heure_rdv'])){
                exceptions_error_handler('heure_rdv null');
            }
        }

        function setCommandAddRdv($POST){
            $commandAddRdvToReturn = new Rendez_vous();
            
            $commandAddRdvToReturn->setDateRdv($POST['date_rdv']);
            $commandAddRdvToReturn->setHeureRdv($POST['heure_rdv']);
            $commandAddRdvToReturn->setDureeRdv($POST['duree_rdv']);
            $commandAddRdvToReturn->setmedecinChoseForRdv($POST['Id_Medecin']);
            $commandAddRdvToReturn->setNom($POST['nom']);
            $commandAddRdvToReturn->setPrenom($POST['prenom']);
            $commandAddRdvToReturn->setNumeroSecuriteSocial($POST['numero_securite_social']);
            $commandAddRdvToReturn->setIdUsager($POST['user_id']);
            return $commandAddRdvToReturn;
        }



        function exceptions_error_handler($message) {
            throw new ErrorException($message);
        }

    ?>  
