<?php

class User
{
    private $_idCompte;
    private $_nom;
    private $_prenom;
    private $_mail;
    private $_motDePasse;
    private $_motDePasseNew;
    private $_adresse;
    private $_telephone;
    private $_dateInsciption;
    private $_active;
    private $_droit;
    private $_nomForm;

    // setters

    public function setIdCompte($idCompte)
    {
        $idCompte = (int) $idCompte;
        if ($idCompte > 0) {
            $this->_idCompte = $idCompte;
        }
    }
    public function setNom($nom)
    {
        if (is_string($nom)) {
            $this->_nom = $nom;
        }
    }
    public function setPrenom($prenom)
    {
        if (is_string($prenom)) {
            $this->_prenom = $prenom;
        }
    }
    public function setMail($mail)
    {
        if (is_string($mail)) {
            $this->_mail = $mail;
        }
    }
    public function setMotDePasse($motDePasse)
    {
        
        if (is_string($motDePasse)) {
            $this->_motDePasse = $motDePasse;
        }
    }
    public function setMotDePasseNew($motDePasseNew)
    {
        
        if (is_string($motDePasseNew)) {
            $this->_motDePasseNew = $motDePasseNew;
        }
    }
    public function setAdresse($adresse)
    {
        if (is_string($adresse)) {
            $this->_adresse = $adresse;
        }
    }
    public function setTelephone($telephone)
    {
        $this->_telephone = $telephone;
    }
    public function setDateInsciption($dateInsciption)
    {
        $this->_dateInsciption = $dateInsciption;
    }
    public function setActive($active)
    {
        $active = (int) $active;
        $this->_active = $active;
    }
    public function setDroit($droit)
    {
        if (is_string($droit)) {
            $this->_droit = $droit;
        }
    }
    public function setNomForm($nomForm)
    {
        if (is_string($nomForm)) {
            $this->_nomForm = $nomForm;
        }
    }

    // getters

    public function getIdCompte()
    {
        return $this->_idCompte;
    }
    public function getNom()
    {
        return $this->_nom;
    }
    public function getPrenom()
    {
        return $this->_prenom;
    }
    public function getMail()
    {
        return $this->_mail;
    }
    public function getMotDePasse()
    {
        return $this->_motDePasse;
    }
    public function getMotDePasseNew()
    {
        return $this->_motDePasseNew;
    }
    public function getAdresse()
    {
        return $this->_adresse;
    }
    public function getTelephone()
    {
        return $this->_telephone;
    }
    public function getDateInsciption()
    {
        return $this->_dateInsciption;
    }
    public function getActive()
    {
        return $this->_active;
    }
    public function getDroit()
    {
        return $this->_droit;
    }
    public function getNomForm()
    {
        return $this->_nomForm;
    }
}
