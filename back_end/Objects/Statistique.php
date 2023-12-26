<?php

require_once 'DbConfig.php'; 

class Statistique {

    private DbConfig $dbconfig;

    public function __construct() {
        $this->dbconfig = DbConfig::getDbConfig();
    }

    public function getNbUsager() {
        try {
            $req = $this->dbconfig->getPDO()->prepare('SELECT COUNT(*) FROM usager');
            $req->execute();
            $nbUsager = $req->fetch();
            return $nbUsager;
        } catch (Exception $pe) {
            echo 'ERREUR : ' . $pe->getMessage();
        }
    }

    public function getNbFemme() {
        try {
            $req = $this->dbconfig->getPDO()->prepare('SELECT COUNT(*) FROM usager WHERE civilite = "femme"');
            $req->execute();
            $nbFemme = $req->fetch();
            return $nbFemme;
        } catch (Exception $pe) {
            echo 'ERREUR : ' . $pe->getMessage();
        }
    }

    public function getNbHomme() {
        try {
            $req = $this->dbconfig->getPDO()->prepare('SELECT COUNT(*) FROM usager WHERE civilite = "homme"');
            $req->execute();
            $nbHomme = $req->fetch();
            return $nbHomme;
        } catch (Exception $pe) {
            echo 'ERREUR : ' . $pe->getMessage();
        }
    }

    public function getNbHommeMoins25Ans() {
        try {
            $req = $this->dbconfig->getPDO()->prepare('SELECT COUNT(*) FROM usager WHERE civilite = "homme" AND TIMESTAMPDIFF(YEAR, date_naissance, CURDATE()) < 25');
            $req->execute();
            $nbHommeMoins25Ans = $req->fetch();
            return $nbHommeMoins25Ans;
        } catch (Exception $pe) {
            echo 'ERREUR : ' . $pe->getMessage();
        }
    }

    public function getNbFemmeMoins25Ans() {
        try {
            $req = $this->dbconfig->getPDO()->prepare('SELECT COUNT(*) FROM usager WHERE civilite = "femme" AND TIMESTAMPDIFF(YEAR, date_naissance, CURDATE()) < 25');
            $req->execute();
            $nbFemmeMoins25Ans = $req->fetch();
            return $nbFemmeMoins25Ans;
        } catch (Exception $pe) {
            echo 'ERREUR : ' . $pe->getMessage();
        }
    }

    public function getNbHommeEntre25et50Ans() {
        try {
            $req = $this->dbconfig->getPDO()->prepare('SELECT COUNT(*) FROM usager WHERE civilite = "homme" AND TIMESTAMPDIFF(YEAR, date_naissance, CURDATE()) BETWEEN 25 AND 50');
            $req->execute();
            $nbHommeEntre25et50Ans = $req->fetch();
            return $nbHommeEntre25et50Ans;
        } catch (Exception $pe) {
            echo 'ERREUR : ' . $pe->getMessage();
        }
    }

    public function getNbFemmeEntre25et50Ans() {
        try {
            $req = $this->dbconfig->getPDO()->prepare('SELECT COUNT(*) FROM usager WHERE civilite = "femme" AND TIMESTAMPDIFF(YEAR, date_naissance, CURDATE()) BETWEEN 25 AND 50');
            $req->execute();
            $nbFemmeEntre25et50Ans = $req->fetch();
            return $nbFemmeEntre25et50Ans;
        } catch (Exception $pe) {
            echo 'ERREUR : ' . $pe->getMessage();
        }
    }

    public function getNbHommePlus50Ans() {
        try {
            $req = $this->dbconfig->getPDO()->prepare('SELECT COUNT(*) FROM usager WHERE civilite = "homme" AND TIMESTAMPDIFF(YEAR, date_naissance, CURDATE()) > 50');
            $req->execute();
            $nbHommePlus50Ans = $req->fetch();
            return $nbHommePlus50Ans;
        } catch (Exception $pe) {
            echo 'ERREUR : ' . $pe->getMessage();
        }
    }

    public function getNbFemmePlus50Ans() {
        try {
            $req = $this->dbconfig->getPDO()->prepare('SELECT COUNT(*) FROM usager WHERE civilite = "femme" AND TIMESTAMPDIFF(YEAR, date_naissance, CURDATE()) > 50');
            $req->execute();
            $nbFemmePlus50Ans = $req->fetch();
            return $nbFemmePlus50Ans;
        } catch (Exception $pe) {
            echo 'ERREUR : ' . $pe->getMessage();
        }
    }

    
}
?>
