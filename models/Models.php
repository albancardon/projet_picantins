<?php

session_start();

abstract class Models
{
    private static $_bdd;
    private $_req;
    private $_objProduit;
    private $_ctrl;

    //instencie la connection à la bdd si elle n'existe pas
    private static function setBdd()
    {
        self::$_bdd = new PDO('mysql:host=localhost;dbname=lespicantins', 'root', '');
        self::$_bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    }

    //récupération de la connection à la bdd
    protected function getBdd()
    {
        if (self::$_bdd == null) {
            self::setBdd();
        }
        return self::$_bdd;
    }

    // récupération des informations de la base de données
    protected function getAll($table, $obj, $nomId)
    {
        $var = [];
        if ($table == "formatproduit") {
            $req = $this->getBdd()->prepare('SELECT * FROM ' . $table . ' ORDER BY poids+0 ASC');
        }else{
            $req = $this->getBdd()->prepare('SELECT * FROM ' . $table . ' ORDER BY id' . $nomId . ' ASC');
        }
        $req->execute();
        while ($data = $req->fetch(PDO::FETCH_ASSOC)) {
            $var[] = new $obj($data);
        }
        return $var;
        $req->closeCursor();
    }

    // envoie des données pour vérifier leur existences dans la base de donnée
    protected function verifPropriete($propAVerif,$objProduit)
    {
        if (isset($propAVerif)) {
            $this->_req = $this->getBdd()->prepare('SELECT * FROM Produit WHERE idProduit = ' . $propAVerif);
            $this->_req->execute();
            $verifBdd = $this->_req->fetch(PDO::FETCH_ASSOC);
            $retourBdd = $this->verifExistanceBdd ($verifBdd, $objProduit);
        }else{
            $dataBdd = "";
            $this->modifBddProduit($dataBdd, $objProduit);
        }
        return $retourBdd;
        $this->_req->closeCursor();
    }

    // extraction des données récupérer dans la base de donnée
    private function verifExistanceBdd ($verifBdd, $objProduit)
    {
        foreach($verifBdd as $key => $value){
            $dataBdd [":" . $key] = $value;
        };
        if (isset($dataBdd)){
            $this->modifBddProduit($dataBdd, $objProduit);
        }
    }

    // modification de la base de données
    protected function modifBddProduit($dataBdd, $objProduit)
    {
        try{
            // récuprération des données extraites 
            $idProduitBdd = isset($dataBdd[":idProduit"])?$dataBdd[":idProduit"]:'';
            $categorie_idCategorieBdd = isset($dataBdd[":categorie_idCategorie"])?$dataBdd[":categorie_idCategorie"]:'';
            $nomProduitBdd = isset($dataBdd[":nomProduit"])?$dataBdd[":nomProduit"]:'';
            $descriptionProduitBdd = isset($dataBdd[":descriptionProduit"])?$dataBdd[":descriptionProduit"]:'';
            
            // récuprération des données de l'objet (qui ont été ajouté via les fonctions "hydrate") 
            $idProduit = $objProduit->getIdProduit();
            $categorie_idCategorie = $objProduit->getCategorie_idCategorie();
            $nomProduit = $objProduit->getNomProduit();
            $descriptionProduit = $objProduit->getDescriptionProduit();
            
            // envoie de la mise à jour de la base de données si les variables idCategorie, idProduit ou nomProduit 
            // sont différent entre l'objet et la base de données
            if($categorie_idCategorieBdd != $categorie_idCategorie || $idProduitBdd != $idProduit || $nomProduitBdd != $nomProduit){
                if (empty($descriptionProduit)) {
                    $descriptionProduit = $descriptionProduitBdd;
                }
                $qry = $this->getBdd()->prepare("UPDATE produit SET categorie_idCategorie = ? , nomProduit = ?,
                descriptionProduit = ? WHERE idProduit = ? ");
                $qry->execute(array($categorie_idCategorie, $nomProduit, $descriptionProduit, $idProduit));
            }
            
            // récupération des données liées au format des produits
                // les données de l'objet
            $idFormatProduit = $objProduit->getIdFormatProduit();
            $poidsProduit = $objProduit->getPoidsProduit();
            $prixProduit = $objProduit->getPrixProduit();
            
                // les données de la base de données si l'idFormatProduit est récupérer ou non
            if (!empty($idFormatProduit)) {
                $this->_req = $this->getBdd()->prepare('SELECT * FROM formatProduit WHERE idFormatProduit = ?');
                $this->_req->execute(array($idFormatProduit));
                $dataBddFormat = $this->_req->fetch(PDO::FETCH_ASSOC);
            }else{
                $this->_req = $this->getBdd()->prepare('SELECT * FROM formatProduit WHERE produit_idProduit = ? AND poids = ?');
                $this->_req->execute(array($idProduit, $poidsProduit));
                $dataBddFormat = $this->_req->fetch(PDO::FETCH_ASSOC);
            }
            
            // si les données de la base de données nt mise à jour de base de données
            if($dataBddFormat){
                $idFormatProduitBdd = $dataBddFormat["idFormatProduit"];
                $poidsProduitBdd = $dataBddFormat["poids"];
                $prixProduitBdd = $dataBddFormat["prixUnitaire"];
                if ($prixProduitBdd != $prixProduit || $poidsProduitBdd != $poidsProduit ) {
                    $qry = $this->getBdd()->prepare("UPDATE formatProduit SET poids = ? , prixUnitaire = ?
                    WHERE idFormatProduit = ? ");
                    $qry->execute(array($poidsProduit, $prixProduit, $idFormatProduitBdd));
                }
                
            // si les données de la base de données existent, non null et vrai,et l'idProduit existe et non null : création du format dans la base de données 
            }else if(!empty($dataBddFormat) && isset($idProduit)){
                $qry = $this->getBdd()->prepare("INSERT INTO formatProduit (produit_idProduit, poids, prixUnitaire) Values (?,?,?)");
                $qry->execute(array($idProduit, $poidsProduit, $prixProduit));
            
            // si les données de la base de données n'existent pas création du produit puis création du format dans la base de données
            }else{
                $qry = $this->getBdd()->prepare("INSERT INTO Produit (categorie_idCategorie, nomProduit, descriptionProduit) Values (?,?,?)");
                $qry->execute(array($categorie_idCategorie, $nomProduit, $descriptionProduit));
                $this->_req = $this->getBdd()->prepare('SELECT idProduit FROM produit WHERE nomProduit = ?');
                $this->_req->execute(array($nomProduit));
                $dataBddFormat2 = $this->_req->fetch(PDO::FETCH_ASSOC);
                $idProduitNew = $dataBddFormat2["idProduit"];
                $qry2 = $this->getBdd()->prepare("INSERT INTO formatProduit (produit_idProduit, poids, prixUnitaire) Values (?,?,?)");
                $qry2->execute(array($idProduitNew, $poidsProduit, $prixProduit));
            }
            //passage l'information de la réussite de l'action via la variable $_session
            $_SESSION['modif']='ok';
            
        //recupération des eventuelles erreurs
        } catch (PDOException $e) {
            $errorMsg = $e->getMessage();
            require_once('controllers/ControllerError.php');
            //passage l'information de l'echecs de l'action via la variable $_session
            $_SESSION['modif']='no';
            $this->_ctrl = new ControllerError($url, array('errorMsg' => $errorMsg));
        }
        
        //retour automatique à la page gestion_produits
        header('Location: /php_projet-CDA/0.projet_les_picantins-code/gestion_produits');
        exit();
    }

    // suppression d'un format de la base de données
    protected function deleteObjtFormatBdd($objProduit)
    {
        try{
            // recupération des informations contenus dans l'objet
            $idProduit = $objProduit->getIdProduit();
            $idFormatProduit = $objProduit->getIdFormatProduit();
            
            // envoie requête de suppression de la base de données
            $qry = $this->getBdd()->prepare("DELETE FROM formatproduit WHERE produit_idProduit = ? AND idFormatProduit = ? ");
            $qry->execute(array($idProduit, $idFormatProduit));
            
            // vérification si c'était le dernier format du produit ou non
            $this->_req = $this->getBdd()->prepare('SELECT * FROM formatproduit WHERE produit_idProduit = ?');
            $this->_req->execute(array($idProduit));
            $dataBddFormat = $this->_req->fetch(PDO::FETCH_ASSOC);
            
            // si il y a pas d'autre format : envoie requête suppression du produit de la base de données
            if (empty($dataBddFormat)) {
                $qry = $this->getBdd()->prepare("DELETE FROM produit WHERE idProduit = ? ");
                $qry->execute(array($idProduit));
            }
            //passage l'information de la réussite de l'action via la variable $_session
            $_SESSION['modif']='ok';
            
        //recupération des eventuelles erreurs
        } catch (PDOException $e) {
            $errorMsg = $e->getMessage();
            require_once('controllers/ControllerError.php');
            //passage l'information de l'echecs de l'action via la variable $_session
            $_SESSION['modif']='no';
            $this->_ctrl = new ControllerError($url, array('errorMsg' => $errorMsg));
        }
        
        //retour automatique à la page gestion_produits
        header('Location: /php_projet-CDA/0.projet_les_picantins-code/gestion_produits');
        exit();
        
    }
    
    // vérification si la catégorie existe
    protected function verifExistanceCat($nomCategorie, $newNomCategorie)
    {
        // si le nom de la catégorie existe et non nul: recupération des données de la table Categorie  
        // où le nom est égale à la variables nomCategorie
        if (isset($nomCategorie)) {
            $this->_req = $this->getBdd()->prepare("SELECT * FROM Categorie WHERE nomCategorie =  '$nomCategorie'");
            $this->_req->execute();
            $verifBdd = $this->_req->fetch(PDO::FETCH_ASSOC);

            // extraction des données retournées si elles existent,sont non null et sont vrai
            if (!empty($verifBdd)) {
                foreach($verifBdd as $key => $value){
                    $dataBdd [":" . $key] = $value;
                };
            }
            // vérification que les données extraitent existes et sont non null pour faire appel 
            // à la méthode de modification de la base de donnée des catégories
            if (isset($dataBdd)){
                $this->modifBddCat($dataBdd, $nomCategorie, $newNomCategorie);
            }else{
                $dataBdd = "";
                $this->modifBddCat($dataBdd, $nomCategorie, $newNomCategorie);
            }
        }else{

            //recupération des eventuelles erreurs
            throw new Exception('Erreur: nom de catégorie absent!');
            //passage l'information de l'echecs de l'action via la variable $_session
            $_SESSION['modif']='no';
            die();
        }
    }

    // méthode de modification de la base de donnée des catégories
    protected function modifBddCat($dataBdd, $nomCategorie, $newNomCategorie)
    {
        try{
            // si dataBdd et newNomCategorie existent,sont non null et sont vrai alors
            // envoie de la misae a jour de la base de donnée
            if (!empty($dataBdd) && !empty($newNomCategorie)){

                $idCatBdd = isset($dataBdd[":idCategorie"])?$dataBdd[":idCategorie"]:'';
                $qry = $this->getBdd()->prepare("UPDATE categorie SET  nomCategorie = ?
                WHERE idCategorie = ? ");
                $qry->execute(array($newNomCategorie,$idCatBdd));
            
            // sinon creation d'un nouvelle catégorie dans la base de donnée
            }else{
                $qry = $this->getBdd()->prepare("INSERT INTO categorie (nomCategorie) Values (?)");
                $qry->execute(array($nomCategorie));
            }
            //passage l'information de la réussite de l'action via la variable $_session
            $_SESSION['modif']='ok';

        //recupération des eventuelles erreurs
        } catch (PDOException $e) {
            $errorMsg = $e->getMessage();
            require_once('controllers/ControllerError.php');
            //passage l'information de l'echecs de l'action via la variable $_session
            $_SESSION['modif']='no';
            $this->_ctrl = new ControllerError($url, array('errorMsg' => $errorMsg));
        }

        //retour automatique à la page gestion_produits
        header('Location: /php_projet-CDA/0.projet_les_picantins-code/gestion_produits');
        exit();
    }

    // suppression de la base de données d'une catégorie
    protected function suppBddCat( $objCat)
    {
        try{
            // récupération du nom de la catégorie
            $nomCategorie = $objCat->getNomCategorie();
            // le nom de la catégorie existe et non null:vérification de l'existance de la catégorie dans la base de données
            if (isset($nomCategorie)) {
                $this->_req = $this->getBdd()->prepare("SELECT * FROM Categorie WHERE nomCategorie =  '$nomCategorie'");
                $this->_req->execute();
                $verifBdd = $this->_req->fetch(PDO::FETCH_ASSOC);
                if (!empty($verifBdd)) {
                    foreach($verifBdd as $key => $value){
                        $dataBdd [":" . $key] = $value;
                    };
                }
                // si les données de la base de données recupérer sont null, n'esiste pas, ou sont fausse: envoie d'un message d'erreur
                if (empty($dataBdd)){
                    throw new Exception('Erreur: nom de catégorie non valide!');
                    //passage l'information de l'echecs de l'action via la variable $_session
                    $_SESSION['modif']='no';
                }else{
                    //sinon envoie de la requête de suppression de la catégorie de la base de données
                    try {
                        $idCatBdd = isset($dataBdd[":idCategorie"])?$dataBdd[":idCategorie"]:'';
                        $qry = $this->getBdd()->prepare("DELETE FROM categorie WHERE idCategorie = ?");
                        $qry->execute(array($idCatBdd));
                        // vérification que la suppression a bien eu lieux
                        $this->_req = $this->getBdd()->prepare("SELECT * FROM Categorie WHERE nomCategorie =  '$nomCategorie'");
                        $this->_req->execute();
                        $verifBdd = $this->_req->fetch(PDO::FETCH_ASSOC);
                        if (empty($verifBdd)){
                            //passage l'information de la réussite de l'action via la variable $_session
                            $_SESSION['modif']='ok';
                        }else {
                            //passage l'information de l'echecs de l'action, car il y a presence d'une clée etrengére utiliser dans la table via la variable $_session
                            $_SESSION['modif']='errorKey';
                        }
                        
                    //recupération des eventuelles erreurs
                    } catch (PDOException $e) {
                        $errorMsg = $e->getMessage();
                        require_once('controllers/ControllerError.php');
                        //passage l'information de l'echecs de l'action via la variable $_session
                        $_SESSION['modif']='no';
                        $this->_ctrl = new ControllerError($url, array('errorMsg' => $errorMsg));
                    }
                }
            }else{
                throw new Exception('Erreur: nom de catégorie absent!');
                //passage l'information de l'echecs de l'action via la variable $_session
                $_SESSION['modif']='no';
                die();
            }
        //recupération des eventuelles erreurs
        } catch (PDOException $e) {
            $errorMsg = $e->getMessage();
            require_once('controllers/ControllerError.php');
            //passage l'information de l'echecs de l'action via la variable $_session
            $_SESSION['modif']='no';
            $this->_ctrl = new ControllerError($url, array('errorMsg' => $errorMsg));
            die();
        }
        
        //retour automatique à la page gestion_produits
        header('Location: /php_projet-CDA/0.projet_les_picantins-code/gestion_produits');
        exit();
    }

    //suppression d'un produit de la base de données
    protected function deleteObjtProduitBdd($objProduit)
    {
        try{
            //recupération de l'idProduit
            $idProduit = $objProduit->getIdProduit();
            //envoie de la requête de suppression de tout le format lié au produit
            $qry = $this->getBdd()->prepare("DELETE FROM formatproduit WHERE produit_idProduit = ? ");
            $qry->execute(array($idProduit));
            //envoie de la requête de suppression du produit
            $qry2 = $this->getBdd()->prepare("DELETE FROM produit WHERE idProduit = ? ");
            $qry2->execute(array($idProduit));
            //passage l'information de la réussite de l'action via la variable $_session
            $_SESSION['modif']='ok';
            
        //recupération des eventuelles erreurs
        } catch (PDOException $e) {
            $errorMsg = $e->getMessage();
            require_once('controllers/ControllerError.php');
            
            //passage l'information de l'echecs de l'action via la variable $_session
            $_SESSION['modif']='no';
            $this->_ctrl = new ControllerError($url, array('errorMsg' => $errorMsg));
        }
        
        //retour automatique à la page gestion_produits
        header('Location: /php_projet-CDA/0.projet_les_picantins-code/gestion_produits');
        exit();
        
    }
}