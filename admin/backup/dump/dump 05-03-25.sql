CREATE TABLE Utilisateurs(
   id_utilisateur SERIAL,
   nom VARCHAR(100) NOT NULL,
   email VARCHAR(150) NOT NULL,
   mot_de_passe VARCHAR(150) NOT NULL,
   admin BOOLEAN NOT NULL,
   PRIMARY KEY(id_utilisateur),
   UNIQUE(email)
);

CREATE TABLE Tiramisus(
   id_tiramisu SERIAL,
   nom VARCHAR(100) NOT NULL,
   description TEXT NOT NULL,
   prix NUMERIC(10,2) NOT NULL,
   photo TEXT,
   PRIMARY KEY(id_tiramisu)
);

CREATE TABLE Paiements(
   id_paiement SERIAL,
   methode_paiement VARCHAR(50) CHECK (methode_paiement IN ('carte', 'paypal', 'virement')) NOT NULL,
   PRIMARY KEY(id_paiement)
);

CREATE TABLE Commandes(
   id_commande SERIAL,
   date_commande TIMESTAMP NOT NULL,
   id_paiement INTEGER NOT NULL,
   id_utilisateur INTEGER NOT NULL,
   PRIMARY KEY(id_commande),
   FOREIGN KEY(id_paiement) REFERENCES Paiements(id_paiement),
   FOREIGN KEY(id_utilisateur) REFERENCES Utilsateurs(id_utilisateur)
);

CREATE TABLE Details_Commande(
   id_details_commande SERIAL,
   quantite INTEGER NOT NULL,
   prix_total MONEY NOT NULL,
   id_tiramisu INTEGER NOT NULL,
   id_commande INTEGER NOT NULL,
   PRIMARY KEY(id_details_commande),
   FOREIGN KEY(id_tiramisu) REFERENCES Tiramisus(id_tiramisu),
   FOREIGN KEY(id_commande) REFERENCES Commandes(id_commande)
);
