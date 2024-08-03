CREATE DATABASE deliver;


USE deliver;



CREATE TABLE commande (
    code  INT AUTO_INCREMENT PRIMARY KEY,
    nom_complet VARCHAR(255) NOT NULL,
    gouvernerat VARCHAR(255) NOT NULL,
    delegation VARCHAR(255) NOT NULL,
    localite VARCHAR(255) NOT NULL,
    adresse_complementaire VARCHAR(255) NOT NULL,
    telephone VARCHAR(20) NOT NULL,
    telephone2 VARCHAR(20),
    designation VARCHAR(255) NOT NULL,
    nombre_article INT NOT NULL,
    prix DECIMAL(10, 2) NOT NULL,
    commentaire VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);



CREATE TABLE utilisateur (
    noUtilisateur INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    code INT NOT NULL,
    password VARCHAR(255) NOT NULL,
    role INT NOT NULL,
    gsm VARCHAR(15) NOT NULL,
    email VARCHAR(255) NOT NULL
);


CREATE TABLE user_request (
    noUtilisateur INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    role INT NOT NULL,
    gsm VARCHAR(15) NOT NULL,
    email VARCHAR(255) NOT NULL
);
