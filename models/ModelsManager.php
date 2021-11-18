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
        $Model = new $infoModel;
        return $Model;
    }

    public function setProduitBdd($objProduit)
    {
        return $this->setObjtBdd($objProduit);
    }

    private function setObjtBdd($objProduit)
    {
        $idProduit = $objProduit->getIdProduit();
        $this->verifPropriete($idProduit, $objProduit);
    }

    public function deleteProduitBdd($objProduit)
    {
        return $this->deleteObjtProduitBdd($objProduit);
    }

    public function deleteFromatBdd($objProduit)
    {
        return $this->deleteObjtFormatBdd($objProduit);
    }

    public function ajoutCatBdd($objCat)
    {
        return $this->setCatBdd($objCat);
    }

    private function setCatBdd($objCat)
    {
        $nomCategorie = $objCat->getNomCategorie();
        $newNomCategorie = $objCat->getNewNomCategorie();
        $this->verifExistanceCat($nomCategorie, $newNomCategorie);
    }

    public function deleteCatBdd($objCat){
        return $this->suppBddCat($objCat);
    }

    public function addUser($ModelCompte){
        return $this->verifExistanceAddUser($ModelCompte);
    }

    public function connexionUser($ModelCompte){
        return $this->verifMailMdp($ModelCompte);
    }

    public function modifUser($ModelCompte){
        return $this->verifMailMdp($ModelCompte);
    }
}