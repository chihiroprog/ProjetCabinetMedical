<?php
class Usager extends User{
    private dateTime $date_naissance;
    private int $numero_securite_sociale;

    public function modifier_information_compte(
        $nom,
        $prenom,
        $date_naissance,
        $numero_securite_sociale
    ){
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->date_naissance = $date_naissance;
        $this->numero_securite_sociale = $numero_securite_sociale;
    }
}
?>