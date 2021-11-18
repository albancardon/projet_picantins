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
    private $_catBdd;
    private $_idCategorie;
    private $_nomCategorie;
    private $_tmpNameImg;
    private $_nameImg;
    private $_sizeImg;
    private $_errorImg;
    private $_typeImg;


    public function __construct()
    {
        if (isset($_GET)) {
            $this->getUrl();
        }else {
            throw new Exception('Contenu introuvable');
        }
    }

    private function getUrl(){
        // recupération et sécurisation des informations envoyer par le formulaire
        foreach ($_POST as $key => $value) {
            $params["*" . $key] = (isset($_POST[$key]) && !empty($_POST[$key])) ? htmlspecialchars($_POST[$key]) : null;
        }

        // vérification de la présence de la clef "name-product" dans les données envoyer
        if (isset($params["*name-product"])) {
            //recupération de toutes les données sécurisés et vérification de l'existance des clées
            $this->_idName =  $params["*name-product"];

            $this->_idProduit = !empty(explode('-',$this->_idName)[3])?explode('-',$this->_idName)[3]:'';
            $this->idFormatProduit =  !empty(explode('-',$this->_idName)[6])?explode('-',$this->_idName)[6]:'';
            $this->_nomProduit = strtolower( !empty(explode('-',$this->_idName)[4])?explode('-',$this->_idName)[4]:'');

            if (!empty(explode('-',$this->_idName)[4]) && isset (explode('-',$this->_idName)[4])) {
                $this->_nomProduit = explode('-',$this->_idName)[4];
            }elseif (!empty($params["*name-product"])){
                $this->_nomProduit = $params["*name-product"];
            }else{
                $this->_nomProduit = "";
            }

            if (!empty(explode('-',$this->_idName)[1]) && isset (explode('-',$this->_idName)[1])) {
                $this->_categorie_idCategorie = explode('-',$this->_idName)[1];
            }elseif (!empty(explode('-',$params["*category-product"])[0])){
                $this->_categorie_idCategorie = explode('-',$params["*category-product"])[0];
            }else{
                $this->_categorie_idCategorie = "";
            }

            // recupération et stockage de l'image envoyer, si elle existe envoyer
            if(isset($_FILES['img-product'])){
                $this->_tmpNameImg = $_FILES['img-product']['tmp_name'];
                $this->_nameImg = $_FILES['img-product']['name'];
                $this->_sizeImg = $_FILES['img-product']['size'];
                $this->_errorImg = $_FILES['img-product']['error'];
                $this->_typeImg = $_FILES['img-product']['type'];


                // vérification du type de fichier envoyer
                $tabExtension = explode('.', $this->_nameImg);
                $extension = strtolower(end($tabExtension));

                //condition autoriser
                $extensionAutorisees = ['jpg', 'jpeg', 'gif', 'png'];
                $tailleMax = 400000;

                if ($this->_errorImg == 0) {
                    if (in_array($extension, $extensionAutorisees)){
                        if ($this->_sizeImg <=$tailleMax) {
                            $nomImgUpload = $this->_nomProduit. '.jpg';
                            echo $nomImgUpload;
                            move_uploaded_file($this->_tmpNameImg, 'asset/img/produit/'.$nomImgUpload);
                        }else{
                            throw new Exception('Fichier trop volumineux');
                        }
                    }else{
                        throw new Exception('Mauvais type de fichier envoyer');
                    }
                }else{
                    throw new Exception('Erreur sur le fichier envoyer');
                }
            }

            $this->_poidsProduit =  isset($params["*size-product"])?$params["*size-product"]:'';
            $this->_prixProduit = isset($params["*prixUnitaire-product"])?$params["*prixUnitaire-product"]:'';
            $this->_descriptionProduit = isset($params["*description-product"])?$params["*description-product"]:'';

            // création de l'objet 
            $this->_produitBdd = new ModelsManager;
            $ModelBdd = $this->_produitBdd->getModelForBdd('ProduitObjBdd');

            // hydratation de l'objet (remplissage de l'objet avec les données récupéraient)
            $ModelProduitBdd=$this->hydrateModelProduit($ModelBdd);

            // determination de l'action en fonction du bouton qui a envoyer les données du formulaire
            if(isset($_POST['ajout']) AND $_POST['ajout'] == 'ajout')
            {
                $this->_produitBdd->setProduitBdd($ModelProduitBdd);
            }
            elseif(isset($_POST['supprimer']) AND $_POST['supprimer'] == 'supprimer')
            {
                $this->_produitBdd->deleteFromatBdd($ModelBdd);
            }
            elseif(isset($_POST['suppProd']) AND $_POST['suppProd'] == 'suppProd')
            {
                $this->_produitBdd->deleteProduitBdd($ModelBdd);
            }
        // Si la clef "name-product" n'est pas dans les données envoyer mais qu'il y a la clé name-category
        }elseif (isset($params["*name-category"])) {
            // détermination des valeur des variables
            if (isset($params["*name-categoryOld"])) {
                $this->_nomCategorie = $params["*name-categoryOld"];
                $this->_nouveauNomCategorie = $params["*name-category"];
            }else{
                $this->_nomCategorie = $params["*name-category"];
                $this->_nouveauNomCategorie = "";
            }

            // création de l'objet
            $this->_catBdd = new ModelsManager;
            $ModelBdd = $this->_catBdd->getModelForBdd('ajoutObjCat');

            //hydratation de l'objet
            $ModelCatBdd=$this->hydrateModelCategorie($ModelBdd);

            // determination de l'action en fonction du bouton qui a envoyer les données du formulaire
            if(isset($_POST['ajoutCat']) AND $_POST['ajoutCat'] == 'ajoutCat')
            {
                $this->_catBdd->ajoutCatBdd($ModelCatBdd);
            }elseif(isset($_POST['suppCat']) AND $_POST['suppCat'] == 'suppCat')
            {
                $this->_catBdd->deleteCatBdd($ModelCatBdd);
            }
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

    private function hydrateModelCategorie($Obj){
        $Obj->setNomCategorie($this->_nomCategorie);
        $Obj->setNewNomCategorie($this->_nouveauNomCategorie);
        return $Obj;
    }
}
