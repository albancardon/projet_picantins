<?php

class ControllerLoginBdd
{
    private $_compteBdd;
    private $_idCompte;
    private $_nom;
    private $_prenom;
    private $_mail;
    private $_motDePasse;
    private $_motDePasseNew;
    private $_motDePasseConfirm;
    private $_adresse;
    private $_recupTel;
    private $_telephone;
    private $_dateInsciption;
    private $_active;
    private $_recupActive;
    private $_droit;
    private $_nomForm;

    public function __construct()
    {
        if (isset($_GET)) {
            $this->getUrl();
        }else {
            throw new Exception('Contenu introuvable');
        }
    }

    private function getUrl()
    {
        // recupération et sécurisation des informations envoyer par le formulaire
        foreach ($_POST as $key => $value) {
            $params["*" . $key] = (isset($_POST[$key]) && !empty($_POST[$key])) ? htmlspecialchars($_POST[$key]) : null;
        }
        if (isset($params["*deconnect"]) && $params["*deconnect"] == "deconnect") {    
            // fermeture de la $_SESSION
            session_start();
            $_SESSION = array();
            if (isset($_COOKIE[session_name()])){
                setcookie(session_name(), '', time()-1);
            }
            //Détruire la session
            session_destroy();
            header('Location: /php_projet-CDA/0.projet_les_picantins-code/accueil');
        }
        //recupération du reste des données sécurisés et vérification de l'existance des clées/valeurs
        $this->_idCompte =  ucfirst(isset($params["*idCompte"])?$params["*idCompte"]:'');
        $this->_nom =  ucfirst(isset($params["*compte-nom"])?$params["*compte-nom"]:'');
        $this->_prenom =  ucfirst(isset($params["*compte-prenom"])?$params["*compte-prenom"]:'');
        $this->_mail =  isset($params["*mailLogin"])?$params["*mailLogin"]:'';
        // cryptage du mot de passe
        $this->_motDePasse = password_hash((isset($params["*passLogin"])?$params["*passLogin"]:''), PASSWORD_DEFAULT, ['cost' => 12]);
        $this->_motDePasseNew =  password_hash((isset($params["*passLoginNew"])?$params["*passLoginNew"]:''), PASSWORD_DEFAULT, ['cost' => 12]);
        $this->_adresse =  isset($params["*compte-adresse"])?$params["*compte-adresse"]:'';
        // mise en forme du numéro de téléphone pour qu'il ait toujours la même
        $this->_recupTel = isset($params["*compte-tel"])?$params["*compte-tel"]:'';
        $presenceTiret = strstr($this->_recupTel, '-');
        $presenceEspace = strstr($this->_recupTel, ' ');
        if (empty($presenceTiret) && empty($presenceEspace)){
            $this->_telephone =  $this->_recupTel;
        }elseif (empty($presenceTiret) && !empty($presenceEspace)) {
            $this->_telephone =  str_replace(" ", "", $this->_recupTel);
        }elseif (!empty($presenceTiret) && empty($presenceEspace)) {
            $this->_telephone =  str_replace("-", "", $this->_recupTel);
        }
        // vérification si le compte est actif
        $this->_recupActive = isset($params["*compte-active"])?$params["*compte-active"]:'';
        if ($this->_recupActive == "oui") {
            $this->_active = 1;
        }elseif ($this->_recupActive == "non") {
            $this->_active = 2;
        }else{
            $this->_active = '';
        }
        //ajout du nom du fomulaire ayant été envoyer
        if (isset($params["*addCompte"]) && $params["*addCompte"] == "addCompte"){
            $this->_nomForm = "addCompte";
        }elseif (isset($params["*logCompte"]) && $params["*logCompte"] == "logCompte") {
            $this->_nomForm = "logCompte";
        }elseif (isset($params["*modifCompte"]) && $params["*modifCompte"] == "modifCompte") {
            $this->_nomForm = "modifCompte";
        }elseif (isset($params["*modifCompteGestion"]) && $params["*modifCompteGestion"] == "modifCompteGestion") {
            $this->_nomForm = "modifCompteGestion";
        }
        // vérification du formulaire envoyer envoyer est "addCompte"
        if ($this->_nomForm == "addCompte") {
            //recupération du mot de passe ainsi que sa confirmation et vérification de la concordence
            if (password_verify((isset($params["*passConfirm"])?$params["*passConfirm"]:''), $this->_motDePasse)) {
                //recupération des donné manquante pour la création du compte
                $this->_dateInsciption =  date('Y-m-d');
                $this->_active =  1;
                $this->_droit =  "user";
                // création de l'objet User
                $this->_compteBdd = new ModelsManager;
                $CompteBdd = $this->_compteBdd->getModelForBdd('user');
                
                // hydratation de l'objet (remplissage de l'objet avec les données récupéraient)
                $ModelCompte = $this->hydrateModelCompte($CompteBdd);
                
                // appel de la methode d'ajout d'un utilisateur à la base de données
                $this->_compteBdd->addUser($ModelCompte);

            }else{
                throw new Exception('Erreur: Le mot de passe et la vérification du mot de passe ne sont pas identique!');
            }
        // vérification du formulaire envoyer envoyer est "logCompte"
        }elseif ($this->_nomForm == "logCompte") {
            // création de l'objet 
            $this->_compteBdd = new ModelsManager;
            $CompteConnexionBdd = $this->_compteBdd->getModelForBdd('user');
            // hydratation de l'objet (remplissage de l'objet avec les données récupéraient)
            $ModelCompteConnexion= $this->hydrateModelCompte($CompteConnexionBdd);
            // appel de la methode de connexion d'un utilisateur
            $this->_compteBdd->connexionUser($ModelCompteConnexion);

        // vérification du formulaire envoyer envoyer est "modifCompte"
        }elseif ($this->_nomForm == "modifCompte") {
            //recupération du nouveau mot de passe ainsi que sa confirmation et vérification de la concordence
            $this->_motDePasseConfirm =  isset($params["*passConfirm"])?$params["*passConfirm"]:false;

            if (password_verify((isset($params["*passConfirm"])?$params["*passConfirm"]:''), $this->_motDePasseNew)) {
                // création de l'objet User
                $this->_compteBdd = new ModelsManager;
                $CompteBdd = $this->_compteBdd->getModelForBdd('user');
                
                // hydratation de l'objet (remplissage de l'objet avec les données récupéraient)
                $ModelCompte = $this->hydrateModelCompte($CompteBdd);
                
                // appel de la methode de modification d'un utilisateur à la base de données
                $this->_compteBdd->modifUser($ModelCompte);

            }else{
                throw new Exception('Erreur: Le mot de passe et la vérification du mot de passe ne sont pas identique!');
            }

            // vérification du formulaire envoyer envoyer est "modifCompteGestion"
        }elseif ($this->_nomForm == "modifCompteGestion"){
            // création de l'objet User
            $this->_compteBdd = new ModelsManager;
            $CompteBdd = $this->_compteBdd->getModelForBdd('user');
            
            // hydratation de l'objet (remplissage de l'objet avec les données récupéraient)
            $ModelCompte = $this->hydrateModelCompte($CompteBdd);
            // appel de la methode de modification d'un utilisateur à la base de données
            $this->_compteBdd->modifUser($ModelCompte);

            // vérification du formulaire envoyer envoyer est "supprCompte"
        }
    }

    private function hydrateModelCompte($Obj){
        $Obj->setIdCompte($this->_idCompte);
        $Obj->setNom($this->_nom);
        $Obj->setPrenom($this->_prenom);
        $Obj->setMail($this->_mail);
        $Obj->setMotDePasse($this->_motDePasse);
        $Obj->setMotDePasseNew($this->_motDePasseNew);
        $Obj->setAdresse($this->_adresse);
        $Obj->setTelephone($this->_telephone);
        $Obj->setDateInsciption($this->_dateInsciption);
        $Obj->setActive($this->_active);
        $Obj->setDroit($this->_droit);
        $Obj->setNomForm($this->_nomForm);
        return $Obj;
    }
}