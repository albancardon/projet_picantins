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

    protected function getAll($table, $obj, $nomId)
    {
        $var = [];
        $req = $this->getBdd()->prepare('SELECT * FROM ' . $table . ' ORDER BY id' . $nomId . ' ASC');
        $req->execute();
        while ($data = $req->fetch(PDO::FETCH_ASSOC)) {
            $var[] = new $obj($data);
        }
        return $var;
        $req->closeCursor();
    }

    protected function verifPropriete($propAVerif,$objProduit)
    {
        $table ="Produit";
        $this->_req = $this->getBdd()->prepare('SELECT * FROM ' . $table . ' WHERE id' . 
        $table . ' = ' . $propAVerif);
        $this->_req->execute();
        $verifBdd = $this->_req->fetch(PDO::FETCH_ASSOC);
        $retourBdd = $this->verifExistanceBdd ($verifBdd, $objProduit);
        
        return $retourBdd;
        $this->_req->closeCursor();
    }

    private function verifExistanceBdd ($verifBdd, $objProduit)
    {
        foreach($verifBdd as $key => $value){
            $dataBdd [':' . $key] = $value;
        };

        if (isset($dataBdd)){
            $this->modifBddProduit($dataBdd, $objProduit);
        }
    }

    protected function modifBddProduit($dataBdd, $objProduit)
    {

        try{
            echo "dataBdd <pre>";
            var_dump($dataBdd);
            echo "</pre>";
            $idProduitBdd = $dataBdd[":idProduit"];
            $categorie_idCategorieBdd = $dataBdd[":categorie_idCategorie"];
            $nomProduitBdd = $dataBdd[":nomProduit"];
            $descriptionProduitBdd = $dataBdd[":descriptionProduit"];

            echo "categorie_idCategorieBdd: ".$categorie_idCategorieBdd." <br />";
            echo "nomProduitBdd: ".$nomProduitBdd." <br />";
            echo "descriptionProduitBdd: ".$descriptionProduitBdd."<br />";

            $idProduit = $objProduit->getIdProduit();
            $categorie_idCategorie = $objProduit->getCategorie_idCategorie();
            $nomProduit = $objProduit->getNomProduit();
            $descriptionProduit = $objProduit->getDescriptionProduit();

            echo "<br>";
            echo "categorie_idCategorie: ".$categorie_idCategorie." <br />";
            echo "nomProduit: ".$nomProduit." <br />";
            echo "descriptionProduit: ".$descriptionProduit."<br />";

            // a faire 

            if($categorie_idCategorieBdd != $categorie_idCategorie || $idProduitBdd != $idProduit || $nomProduitBdd != $nomProduit){
                if (empty($descriptionProduit)) {
                    $descriptionProduit = $descriptionProduitBdd;
                }
                echo "test modif nom <br>";
                echo $idProduit."<br>";
                echo $categorie_idCategorie."<br>";
                echo $nomProduit."<br>";
                echo $descriptionProduit."<br>";
                $qry = $this->getBdd()->prepare("UPDATE produit SET categorie_idCategorie = ? , nomProduit = ?,
                descriptionProduit = ? WHERE idProduit = ? ");
                $qry->execute(array($categorie_idCategorie, $nomProduit, $descriptionProduit, $idProduit));
            }

            //fin du a faire

            $idFormatProduit = $objProduit->getIdFormatProduit();
            $poidsProduit = $objProduit->getPoidsProduit();
            $prixProduit = $objProduit->getPrixProduit();
            
            echo "idFormatProduit: ".$idFormatProduit." <br />";
            echo "poidsProduit: ".$poidsProduit." <br />";
            echo "prixProduit: ".$prixProduit."<br />";

            if (!empty($idFormatProduit)) {
                $this->_req = $this->getBdd()->prepare('SELECT * FROM formatProduit WHERE idFormatProduit = ?');
                $this->_req->execute(array($idFormatProduit));
                $dataBddFormat = $this->_req->fetch(PDO::FETCH_ASSOC);
            }else{
                $this->_req = $this->getBdd()->prepare('SELECT * FROM formatProduit WHERE produit_idProduit = ? AND poids = ?');
                $this->_req->execute(array($idProduit, $poidsProduit));
                $dataBddFormat = $this->_req->fetch(PDO::FETCH_ASSOC);
            }
            echo "dataBddFormat <pre>";
            var_dump($dataBddFormat);
            echo "</pre>";
            echo "fin dataBddFormat <br>";


            if($dataBddFormat){
                $idFormatProduitBdd = $dataBddFormat["idFormatProduit"];
                $poidsProduitBdd = $dataBddFormat["poids"];
                $prixProduitBdd = $dataBddFormat["prixUnitaire"];
                echo $poidsProduitBdd."<br>";
                echo $prixProduitBdd."<br>";
                echo $poidsProduit."<br>";
                echo $prixProduit."<br>";

                if ($prixProduitBdd != $prixProduit || $poidsProduitBdd != $poidsProduit ) {
                    $qry = $this->getBdd()->prepare("UPDATE formatProduit SET poids = ? , prixUnitaire = ?
                    WHERE idFormatProduit = ? ");
                    $qry->execute(array($poidsProduit, $prixProduit, $idFormatProduitBdd));
                }
            }else if($dataBddFormat == false){
                $qry = $this->getBdd()->prepare("INSERT INTO formatProduit (produit_idProduit, poids, prixUnitaire) Values (?,?,?)");
                $qry->execute(array($idProduit, $poidsProduit, $prixProduit));
            }
            $_SESSION['modif']='ok';

        } catch (PDOException $e) {
            $errorMsg = $e->getMessage();
            require_once('controllers/ControllerError.php');
            $_SESSION['modif']='no';
            $this->_ctrl = new ControllerError($url, array('errorMsg' => $errorMsg));
        }
        // header('Location: /php_projet-CDA/0.projet_les_picantins-code/gestion_produits');
        exit();
    }


    protected function deleteObjtBdd($objProduit)
    {
        try{
            $idProduit = $objProduit->getIdProduit();
            $idFormatProduit = $objProduit->getPoids_idPoids();

            $qry = $this->getBdd()->prepare("DELETE FROM formatproduit WHERE produit_idProduit = ? AND idFormatProduit = ? ");
            $qry->execute(array($idProduit, $idFormatProduit));
            $_SESSION['modif']='ok';
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage() . "<br/>";
            $_SESSION['modif']='no';
            die();
        }
        header('Location: /php_projet-CDA/0.projet_les_picantins-code/gestion_produits');
        exit();
        
    }
    
}