<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if(isset($_POST['btnSecretaire'])){
        header('Location: ../../front_end/Consultations.php');
    }
    if(isset($_POST['btnPatient'])){
        header('Location: ../../front_end/usagers/usagers.php');
    }
    if(isset($_POST['btnMedecin'])){
        header('Location: ../../front_end/medecin/medecin.php');
    }
}
?>