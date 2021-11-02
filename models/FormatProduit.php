<?php
class FormatProduit
{
    private $_idFormatProduit;
    private $_produit_idProduit;
    private $_poids;
    private $_prixUnitaire;

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
    public function setIdFormatProduit($idFormatProduit)
    {
        $idFormatProduit = (int) $idFormatProduit;
        if ($idFormatProduit > 0) {
            $this->_idFormatProduit = $idFormatProduit;
        }
    }
    public function setProduit_idProduit($produit_idProduit)
    {
        $produit_idProduit = (int) $produit_idProduit;
        if ($produit_idProduit > 0) {
            $this->_produit_idProduit = $produit_idProduit;
        }
    }
    public function setPoids($poids)
    {
        $poids = (int) $poids;
        if ($poids > 0) {
            $this->_poids = $poids;
        }
    }
    public function setPrixUnitaire($prixUnitaire)
    {
        if (is_string($prixUnitaire)) {
            $this->_prixUnitaire = $prixUnitaire;
        }
    }

    // getters

    public function getIdFormatProduit()
    {
        return $this->_idFormatProduit;
    }
    public function getProduit_idProduit()
    {
        return $this->_produit_idProduit;
    }
    public function getPoids()
    {
        return $this->_poids;
    }
    public function getPrixUnitaire()
    {
        return $this->_prixUnitaire;
    }
}
