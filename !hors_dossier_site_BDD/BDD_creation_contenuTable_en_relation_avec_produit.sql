INSERT INTO categorie (nomCategorie)
VALUES 
("spécialités"),
("confiseries"),
("assortiments");

INSERT INTO produit (categorie_idCategorie,nomProduit,descriptionProduit)
VALUES 
(1,"Les Picantins","3 noisettes grillées délicatement enrobées de chocolat et de nougatine."),
(1,"Les Rochers Compiégnois","Des pralinés feuilletés avec du riz soufflé."),
(1,"Les Marjories","Une ganache au chocolat noir parfumé aux écorces d’orange confite."),

(2,"Les Marrons-glacée","Marrons en provenance de Turin en Italie."),

(3,"Les Assortiments","Un assortiment de nos spécialités.");

INSERT INTO FormatProduit (produit_idProduit,poids,prixUnitaire)
VALUES 
(1,100,6),
(1,200,12),
(1,300,18),
(1,400,24),
(1,500,30),
(1,750,45),

(2,100,7),
(2,200,14),
(2,300,21),
(2,400,28),

(3,100,7),
(3,200,14),
(3,300,21),
(3,400,28),

(4,"unite",2.5),

(5,250,17.5),
(5,400,28),
(5,500,35),
(5,750,52.5),
(5,1000,70);