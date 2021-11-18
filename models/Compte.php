<?php

class Compte
{
    private $_idCompte;
    private $_nom;
    private $_prenom;
    private $_mail;
    private $_motDePasse;
    private $_adresse;
    private $_telephone;
    private $_dateInsciption;
    private $_statut;
    private $_droit;

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
    public function setStatut($statut)
    {
        $statut = (int) $statut;
        $this->_statut = $statut;
    }
    public function setDroit($droit)
    {
        if (is_string($droit)) {
            $this->_droit = $droit;
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
    public function getStatut()
    {
        return $this->_statut;
    }
    public function getDroit()
    {
        return $this->_droit;
    }
}
