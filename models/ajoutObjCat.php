<?php

class ajoutObjCat
{
    private $_idCategorie;
    private $_nomCategorie;
    private $_nouveauNomCategorie;

    // setters
    public function setIdCategorie($idCategorie)
    {
        $idCategorie = (int) $idCategorie;
        if ($idCategorie > 0) {
            $this->_idCategorie = $idCategorie;
        }
    }
    public function setNomCategorie($nomCategorie)
    {
        if (is_string($nomCategorie)) {
            $this->_nomCategorie = $nomCategorie;
        }
    }
    public function setNewNomCategorie($nouveauNomCategorie)
    {
        if (is_string($nouveauNomCategorie)) {
            $this->_nouveauNomCategorie = $nouveauNomCategorie;
        }
    }

    // getters

    public function getIdCategorie()
    {
        return $this->_idCategorie;
    }
    public function getNomCategorie()
    {
        return $this->_nomCategorie;
    }
    public function getNewNomCategorie()
    {
        return $this->_nouveauNomCategorie;
    }
}
