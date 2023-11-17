<?php
class Medecin extends User{
}
class Secretaire{
    public function cree_rendez_vous(){
        $rendez_vous = new Rendez_vous();
        $rendez_vous->date_rendez_vous_minute = new DateTime("2020-01-01 00:00:00");
        $rendez_vous->durée = 30;
        $rendez_vous->user = new Usager();
        return $rendez_vous;
    }
}
?>