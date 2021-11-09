<?php

class ProduitBdd
{
    private $_idProduit;
    private $_categorie_idCategorie;
    private $_idFormatProduit;
    private $_nomProduit;
    private $_descriptionProduit;
    private $_poids;
    private $_prix;

    // setters
    public function setIdProduit($idProduit)
    {
        $idProduit = (int) $idProduit;
        if ($idProduit > 0) {
            $this->_idProduit = $idProduit;
        }
    }
    public function setCategorie_idCategorie($categorie_idCategorie)
    {
        $categorie_idCategorie = (int) $categorie_idCategorie;
        if ($categorie_idCategorie > 0) {
            $this->_categorie_idCategorie = $categorie_idCategorie;
        }
    }
    public function setIdFormatProduit($idFormatProduit)
    {
        $idFormatProduit = (int) $idFormatProduit;
        if ($idFormatProduit > 0) {
            $this->_idFormatProduit = $idFormatProduit;
        }
    }
    public function setNomProduit($nomProduit)
    {
        if (is_string($nomProduit)) {
            $this->_nomProduit = $nomProduit;
        }
    }
    public function setDescriptionProduit($descriptionProduit)
    {
        if (is_string($descriptionProduit)) {
            $this->_descriptionProduit = $descriptionProduit;
        }
    }
    public function setPoidsProduit($poids)
    {
        if (is_string($poids)) {
            $this->_poids = $poids;
        }
    }
    public function setPrixProduit($prix)
    {
        if (is_string($prix)) {
            $this->_prix = $prix;
        }
    }

    // getters

    public function getIdProduit()
    {
        return $this->_idProduit;
    }
    public function getCategorie_idCategorie()
    {
        return $this->_categorie_idCategorie;
    }
    public function getIdFormatProduit()
    {
        return $this->_idFormatProduit;
    }
    public function getNomProduit()
    {
        return $this->_nomProduit;
    }
    public function getDescriptionProduit()
    {
        return $this->_descriptionProduit;
    }
    public function getPoidsProduit()
    {
        return $this->_poids;
    }
    public function getPrixProduit()
    {
        return $this->_prix;
    }
}
