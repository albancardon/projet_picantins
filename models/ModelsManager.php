<?php

class ModelsManager extends Models
{
    public function getModel($infoModel)
    {
        $infoModelMaj = ucfirst($infoModel);
        $this->getBdd();
        return $this->getAll($infoModel, $infoModelMaj, $infoModelMaj);
    }

    public function getModelForBdd($infoModel)
    {
        $Model= new $infoModel;
        return $Model;
    }

    public function setProduitBdd($objProduit)
    {
        return $this->setObjtBdd($objProduit);
    }

    private function setObjtBdd($objProduit)
    {
        $idProduit = $objProduit->getIdProduit();
        
        $categorie_idCategorie = $objProduit->getCategorie_idCategorie();
        $nomProduit = $objProduit->getNomProduit();
        $poidsProduit = $objProduit->getPoidsProduit();
        $prixProduit = $objProduit->getPrixProduit();
        $descriptionProduit = $objProduit->getDescriptionProduit();
        
        echo $idProduit."<br>";
        echo $categorie_idCategorie."<br>";
        echo $nomProduit."<br>";
        echo $poidsProduit."<br>";
        echo $prixProduit."<br>";
        echo $descriptionProduit."<br>";
        echo "objProduit <pre>";
        var_dump($objProduit);
        echo "</pre>";
        $verifEffectuerBDD = $this->verifPropriete($idProduit, $objProduit);
    }

    public function deleteProduitBdd($objProduit)
    {
        return $this->deleteObjtBdd($objProduit);
    }


}


// return $this->setAll($infoModel, $infoModelMaj, $infoModelMaj);