CREATE TABLE Categorie(
	idCategorie SMALLINT(4) PRIMARY KEY AUTO_INCREMENT,
	nomCategorie VARCHAR(20) NOT NULL UNIQUE
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE Produit(
	idProduit SMALLINT(4) PRIMARY KEY AUTO_INCREMENT,
	categorie_idCategorie SMALLINT(4) NOT NULL,
	nomProduit VARCHAR(40) NOT NULL UNIQUE,
	descriptionProduit VARCHAR(250) NOT NULL
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE FormatProduit(
	idFormatProduit SMALLINT(4) PRIMARY KEY AUTO_INCREMENT,
	produit_idProduit SMALLINT(4) NOT NULL,
	poids VARCHAR(20) NOT NULL,
	prixUnitaire DECIMAL(5,2) NOT NULL
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE ProdCmder(
	idprodCmder SMALLINT(4) PRIMARY KEY AUTO_INCREMENT,
	forProd_idFormatProduit SMALLINT(4) NOT NULL,
	quantite SMALLINT(2) NOT NULL
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE Compte(
	idCompte SMALLINT(4) PRIMARY KEY AUTO_INCREMENT,
	mail VARCHAR(255) NOT NULL UNIQUE,
	motDePasse VARCHAR(255) NOT NULL,
    nom VARCHAR(30) NOT NULL,
	prenom VARCHAR(30) NOT NULL,
	adresse VARCHAR(60) NOT NULL,
	telephone VARCHAR(255) NOT NULL,
	dateInsciption DATE DEFAULT (CURRENT_DATE) NOT NULL,
	active TINYINT(1) DEFAULT 1,
	droit VARCHAR(20) NOT NULL
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE Commande(
	idCommande SMALLINT(4) PRIMARY KEY AUTO_INCREMENT,
	compte_idCompte SMALLINT(4) NOT NULL,
	prodCmder_idprodCmder SMALLINT(4) NOT NULL,
	dateCommande DATE NOT NULL,
	montantCommande  DECIMAL(5,2) NOT NULL,
	etatCommande TINYINT(1)  NOT NULl
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE Facture(
	idFacture SMALLINT(4) PRIMARY KEY AUTO_INCREMENT,
	commande_idCommande SMALLINT(4) NOT NULL,
	numeroFacture VARCHAR(30) NOT NULL UNIQUE,
	dateEditionFacture DATE NOT NULL,
	numeroTransaction VARCHAR(20) DEFAULT NULL
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


ALTER TABLE Produit
ADD CONSTRAINT fk_categorie_idCategorie__Produit FOREIGN KEY (categorie_idCategorie) REFERENCES Categorie(idCategorie);

ALTER TABLE FormatProduit
ADD CONSTRAINT fk_produit_idProduit__FormatProduit FOREIGN KEY (produit_idProduit) REFERENCES Produit(idProduit);

ALTER TABLE prodCmder
ADD CONSTRAINT fk_formatProduit_idFormatProduit__prodCmder FOREIGN KEY (forProd_idFormatProduit) REFERENCES FormatProduit(idFormatProduit);

ALTER TABLE Commande
ADD CONSTRAINT fk_compte_idCompte__Commande FOREIGN KEY (compte_idCompte) REFERENCES Compte(idCompte),
ADD CONSTRAINT fk_poroduitCommande_idprodCmder__Commande FOREIGN KEY (prodCmder_idprodCmder) REFERENCES prodCmder(idprodCmder);

ALTER TABLE Facture
ADD CONSTRAINT fk_commande_idCommande__Facture FOREIGN KEY (commande_idCommande) REFERENCES Commande(idCommande);
