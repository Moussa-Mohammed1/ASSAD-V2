

CREATE DATABASE assad;
USE assad;

CREATE TABLE utilisateur(
    id_user INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(50),
    email VARCHAR(50),
    `role` VARCHAR(50) DEFAULT 'visiteur',
    isactive BOOLEAN DEFAULT 1,
    approved BOOLEAN DEFAULT 0,
    motpasse_hash VARCHAR(100)
);

CREATE TABLE visitesguidees(
    id_visite INT AUTO_INCREMENT PRIMARY KEY,
    titre VARCHAR(50),
    dateheure DATETIME DEFAULT CURRENT_TIMESTAMP,
    langue VARCHAR(50),
    capacite_max INT,
    `status` VARCHAR(50) DEFAULT 'OFFLINE',
    duree INT,
    prix DECIMAL(10,2),
    id_user INT,
    FOREIGN KEY (id_user) REFERENCES utilisateur(id_user)
);

CREATE TABLE etapesvisite(
    id_etape INT AUTO_INCREMENT PRIMARY KEY,
    titreetape VARCHAR(50),
    descriptionetape TEXT,
    ordreetape INT,
    id_visite INT,
    FOREIGN KEY (id_visite) REFERENCES visitesguidees(id_visite) ON DELETE CASCADE
);

CREATE TABLE commentaire(
    id_comment INT AUTO_INCREMENT PRIMARY KEY,
    id_visite INT,
    id_user INT,
    note INT,
    texte TEXT,
    date_commentaire DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_visite) REFERENCES visitesguidees(id_visite) ON DELETE CASCADE,
    FOREIGN KEY (id_user) REFERENCES utilisateur(id_user) ON DELETE CASCADE
);

CREATE TABLE reservation(
    id_reservation INT AUTO_INCREMENT PRIMARY KEY,
    id_visite INT,
    id_user INT, 
    nbpersonnes INT,
    datereservations DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_user) REFERENCES utilisateur(id_user) ON DELETE CASCADE,
    FOREIGN KEY (id_visite) REFERENCES visitesguidees(id_visite) ON DELETE CASCADE
);

CREATE TABLE habitat(
    id_habitat INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(50),
    typeclimat VARCHAR(50),
    `description` TEXT,
    zonezoo VARCHAR(50)
);

CREATE TABLE animal(
    id_animal INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(50),
    espece VARCHAR(50),
    alimentation VARCHAR(50),
    `image` VARCHAR(100),
    paysorigine VARCHAR(50),
    `description` TEXT,
    id_habitat INT,
    visites INT DEFAULT 0,
    FOREIGN KEY (id_habitat) REFERENCES habitat(id_habitat) ON DELETE CASCADE
); 
