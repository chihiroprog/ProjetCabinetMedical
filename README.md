CREATE TABLE Medecin(
   Id_Medecin INT AUTO_INCREMENT,
   civilite VARCHAR(50),
   prenom VARCHAR(50),
   nom VARCHAR(50),
   PRIMARY KEY(Id_Medecin)
);

CREATE TABLE Usager(
   Id_Usager INT AUTO_INCREMENT,
   civilite VARCHAR(50),
   nom VARCHAR(50),
   prenom VARCHAR(50),
   adresse VARCHAR(50),
   lieu_naissance VARCHAR(50),
   date_naissance DATE,
   numero_securite_social INT,
   medecin_referent INT,
   FOREIGN KEY(medecin_referent) REFERENCES medecin(Id_Medecin),
   PRIMARY KEY(Id_Usager)
);

CREATE TABLE RDV(
   Id_rendez_vous INT AUTO_INCREMENT,
   Heure_rendez_vous TIME,
   Duree_rendez_vous VARCHAR(50),
   Date_rendez_vous DATE,
   Id_Medecin INT,
   Id_Usager INT,
   PRIMARY KEY(Id_rendez_vous),
   FOREIGN KEY(Id_Medecin) REFERENCES medecin(Id_Medecin),
   FOREIGN KEY(Id_Usager) REFERENCES usager(Id_Usager)
);

CREATE TABLE secretaire (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(255) NOT NULL,
    prenom VARCHAR(255) NOT NULL,
    mots_de_passe VARCHAR(255) NOT NULL
);
