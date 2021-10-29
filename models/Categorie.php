<?php
class Categorie
{
    private $_id;
    private $_nomCategorie;

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
    public function setIdCategorie($idCategorie)
    {
        $idCategorie = (int) $idCategorie;
        if ($idCategorie > 0) {
            $this->_id = $idCategorie;
        }
    }
    public function setNomCategorie($nomCategorie)
    {
        if (is_string($nomCategorie)) {
            $this->_nomCategorie = $nomCategorie;
        }
    }

    // getters

    public function getIdCategorie()
    {
        return $this->_id;
    }
    public function getNomCategorie()
    {
        return $this->_nomCategorie;
    }
}
