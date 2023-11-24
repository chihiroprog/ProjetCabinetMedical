<?php
class Rendez_vous{
    private dateTime $date_rendez_vous_minute;
    private dateTime $duree;
    private Usager $usager;
    private Medecin $medecin;

    public function __construct($date_rendez_vous_minute, $duree, $usager, $medecin){
        
        $this->date_rendez_vous_minute = $date_rendez_vous_minute;
        $this->duree = $duree;
        $this->usager = $usager;
        $this->medecin = $medecin;
    }

}
?>