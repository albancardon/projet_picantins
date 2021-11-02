<?php
class Produit
{
    private $_idProduit;
    private $_categorie_idCategorie;
    private $_nomProduit;
    private $_descriptionProduit;

    // constructeur de l'objet
    public function __construct(array $data)
    {
        $this->hydrate($data);
    }

    // hydratation: remplissage de l'objet avec les données récupérer
    public function hydrate(array $data)
    {
        foreach ($data as $key => $value) {
            $method = 'set' . ucfirst($key);

            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }

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

    // getters

    public function getIdProduit()
    {
        return $this->_idProduit;
    }
    public function getCategorie_idCategorie()
    {
        return $this->_categorie_idCategorie;
    }
    public function getNomProduit()
    {
        return $this->_nomProduit;
    }
    public function getDescriptionProduit()
    {
        return $this->_descriptionProduit;
    }
}
