<?php

class ControllerLoginBdd
{
    private $_compteBdd;
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
        echo " controller<pre>";
        var_dump($_POST);
        echo "</pre>";
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
            header('Location: /php_projet-CDA/0.projet_les_picantins-code/login');
        }
        //recupération du reste des données sécurisés et vérification de l'existance des clées/valeurs
        $this->_nom =  ucfirst(isset($params["*compte-nom"])?$params["*compte-nom"]:'');
        $this->_prenom =  ucfirst(isset($params["*compte-prenom"])?$params["*compte-prenom"]:'');
        $this->_mail =  isset($params["*mailLogin"])?$params["*mailLogin"]:'';
        $this->_motDePasse =  isset($params["*passLogin"])?$params["*passLogin"]:'';
        $this->_motDePasseNew =  isset($params["*passLoginNew"])?$params["*passLoginNew"]:'';
        $this->_adresse =  isset($params["*compte-adressse"])?$params["*compte-adressse"]:'';
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

        echo "nom : ".$this->_nom."<br>";
        echo "prenom : ".$this->_prenom."<br>";
        echo "mail : ".$this->_mail."<br>";
        echo "motDePasse : ".$this->_motDePasse."<br>";
        echo "adresse : ".$this->_adresse."<br>";
        echo "tel : ".$this->_telephone."<br>";




        // vérification du formulaire envoyer envoyer est "addCompte"
        if (isset($params["*addCompte"]) && $params["*addCompte"] == "addCompte") {

            //recupération du mot de passe ainsi que sa confirmation et vérification de la concordence
            $this->_motDePasseConfirm =  isset($params["*passConfirm"])?$params["*passConfirm"]:'';
            
            if ($this->_motDePasse === $this->_motDePasseConfirm) {

                // cryptage des données sensible adresse e-mail et mot de passe
                $this->_mail = md5(md5($this->_mail) . strlen($this->_mail));
                $this->_motDePasse = sha1(md5($this->_mail) . md5($this->_motDePasse));
                //ajout du nom du fomulaire ayant été envoyer
                $this->_nomForm =  "addCompte";
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
        }elseif (isset($params["*logCompte"]) && $params["*logCompte"] == "logCompte") {
            // cryptage des données sensible
            $this->_mail = md5(md5($this->_mail) . strlen($this->_mail));
            $this->_motDePasse = sha1(md5($this->_mail) . md5($this->_motDePasse));
            //ajout du nom du fomulaire ayant été envoyer
            $this->_nomForm =  "logCompte";
            // création de l'objet 
            $this->_compteBdd = new ModelsManager;
            $CompteConnexionBdd = $this->_compteBdd->getModelForBdd('user');
            echo " ModelCompteConnexion<pre>";
            var_dump($CompteConnexionBdd);
            echo "</pre>";
            // hydratation de l'objet (remplissage de l'objet avec les données récupéraient)
            $ModelCompteConnexion= $this->hydrateModelCompte($CompteConnexionBdd);

            echo " ModelCompteConnexion<pre>";
            var_dump($ModelCompteConnexion);
            echo "</pre>";
            $this->_compteBdd->connexionUser($ModelCompteConnexion);

        // vérification du formulaire envoyer envoyer est "modifCompte"
        }elseif (isset($params["*modifCompte"]) && $params["*modifCompte"] == "modifCompte") {
            //recupération du nouveau mot de passe ainsi que sa confirmation et vérification de la concordence
            $this->_motDePasseConfirm =  isset($params["*passConfirm"])?$params["*passConfirm"]:false;

            if ($this->_motDePasseNew === $this->_motDePasseConfirm) {
                
                // cryptage des données sensible adresse e-mail et mot de passe
                $this->_mail = md5(md5($this->_mail) . strlen($this->_mail));
                $this->_motDePasse = sha1(md5($this->_mail) . md5($this->_motDePasse));
                $this->_motDePasseNew = sha1(md5($this->_mail) . md5($this->_motDePasseNew));
                //ajout du nom du fomulaire ayant été envoyer
                $this->_nomForm =  "modifCompte";

                // création de l'objet User
                $this->_compteBdd = new ModelsManager;
                $CompteBdd = $this->_compteBdd->getModelForBdd('user');
                
                // hydratation de l'objet (remplissage de l'objet avec les données récupéraient)
                $ModelCompte = $this->hydrateModelCompte($CompteBdd);
                
                // appel de la methode d'ajout d'un utilisateur à la base de données
                $this->_compteBdd->modifUser($ModelCompte);

            }else{
                throw new Exception('Erreur: Le mot de passe et la vérification du mot de passe ne sont pas identique!');
            }
        }
    }

    private function hydrateModelCompte($Obj){
        $Obj->setNom($this->_nom);
        $Obj->setPrenom($this->_prenom);
        $Obj->setMail($this->_mail);
        $Obj->setMotDePasse($this->_motDePasse);
        $Obj->setMotDePasseNew($this->_motDePasseNew);
        $Obj->setAdresse($this->_adresse);
        $Obj->setTelephone($this->_telephone);
        $Obj->setDateInsciption($this->_dateInsciption);
        $Obj->setStatut($this->_active);
        $Obj->setDroit($this->_droit);
        $Obj->setNomForm($this->_nomForm);
        return $Obj;
    }
}