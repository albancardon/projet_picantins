<?php

class ControllerAjoutBdd
{
    private $_idName;
    private $_idProduit;
    private $_categorie_idCategorie;
    private $_poids_idPoids;
    private $_nomProduit;
    private $_poidsProduit;
    private $_prixProduit;
    private $_descriptionProduit;
    private $_produitBdd;

    public function __construct()
    {
        if (isset($_GET)) {
            $this->getUrl();
        }else {
            throw new Exception('Contenu introuvable');
        }
    }

    private function getUrl(){
        echo "<pre>";
        var_dump($_POST);
        echo "</pre>";
        foreach ($_POST as $key => $value) {
            $params[':' . $key] = (isset($_POST[$key]) && !empty($_POST[$key])) ? htmlspecialchars($_POST[$key]) : null;
        }
        $this->_idName =  $params[":name-product"];

        $this->_categorie_idCategorie = !empty(explode('-',$this->_idName)[1])?explode('-',$this->_idName)[1]:'';
        $this->_idProduit = !empty(explode('-',$this->_idName)[3])?explode('-',$this->_idName)[3]:'';
        $this->_nomProduit = strtolower( !empty(explode('-',$this->_idName)[4])?explode('-',$this->_idName)[4]:'');
        $this->idFormatProduit =  !empty(explode('-',$this->_idName)[6])?explode('-',$this->_idName)[6]:'';

        echo "idFormatProduit : ".$this->idFormatProduit.'<br>';

        $this->_poidsProduit =  isset($params[":size-product"])?$params[":size-product"]:'';
        $this->_prixProduit = isset($params[":prixUnitaire-product"])?$params[":prixUnitaire-product"]:'';
        $this->_descriptionProduit = isset($params[":description-product"])?$params[":description-product"]:'';

        $this->_produitBdd = new ModelsManager;
        $ModelBdd = $this->_produitBdd->getModelForBdd('ProduitBdd');
        $ModelProduitBdd=$this->hydrateModelProduit($ModelBdd);
        if(isset($_POST['ajout']) AND $_POST['ajout'] == 'ajout')
        {
            $this->_produitBdd->setProduitBdd($ModelProduitBdd);
        }
        elseif(isset($_POST['supprimer']) AND $_POST['supprimer'] == 'supprimer')
        {
            $this->_produitBdd->deleteProduitBdd($ModelBdd);
        }
    }

    private function hydrateModelProduit($Obj){
        $Obj->setIdProduit($this->_idProduit);
        $Obj->setCategorie_idCategorie($this->_categorie_idCategorie);
        $Obj->setIdFormatProduit($this->idFormatProduit);
        $Obj->setNomProduit($this->_nomProduit);
        $Obj->setPoidsProduit($this->_poidsProduit);
        $Obj->setPrixProduit($this->_prixProduit);
        $Obj->setDescriptionProduit($this->_descriptionProduit);
        return $Obj;
    }
}
