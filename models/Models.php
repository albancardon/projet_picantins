<?php

session_start();

abstract class Models
{
    private static $_bdd;
    private $_req;
    private $_objProduit;
    private $_ctrl;
    private $_nom;
    private $_prenom;
    private $_mail;
    private $_motDePasse;
    private $_motDePasseNew;
    private $_adresse;
    private $_telephone;
    private $_active;
    private $_nomForm;
    private $request;

    //instencie la connexion à la bdd si elle n'existe pas
    private static function setBdd()
    {
        self::$_bdd = new PDO('mysql:host=localhost;dbname=lespicantins', 'root', '');
        self::$_bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        self::$_bdd->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    }

    //récupération de la connexion à la bdd
    protected function getBdd()
    {
        if (self::$_bdd == null) {
            self::setBdd();
        }
        return self::$_bdd;
    }

    // récupération des informations de la base de données
    protected function getAll($table, $obj, $nomId)
    {
        try {
            $var = [];
                if ($table == "formatproduit") {
                    $req = $this->getBdd()->prepare('SELECT * FROM ' . $table . ' ORDER BY poids+0 ASC');
                }elseif ($table == "compte"){
                    $req = $this->getBdd()->prepare('SELECT * FROM ' . $table . ' ORDER BY active ASC');
                }else{
                    $req = $this->getBdd()->prepare('SELECT * FROM ' . $table . ' ORDER BY id' . $nomId . ' ASC');
                }
                $req->execute();
                while ($data = $req->fetch(PDO::FETCH_ASSOC)) {
                    $var[] = new $obj($data);
                }
                return $var;
                $req->closeCursor();
        }catch (PDOException $e) {
            $errorMsg = $e->getMessage();
            require_once('controllers/ControllerError.php');
            //passage l'information de l'echecs de l'action via la variable $_session
            $this->_ctrl = new ControllerError($url, array('errorMsg' => $errorMsg));
        }
    }

    // envoie des données pour vérifier leur existences dans la base de donnée
    protected function verifPropriete($propAVerif,$objProduit)
    {
        try {
            if (isset($propAVerif)) {
                $this->_req = $this->getBdd()->prepare('SELECT * FROM Produit WHERE idProduit = ' . $propAVerif);
                $this->_req->execute();
                $verifBdd = $this->_req->fetch(PDO::FETCH_ASSOC);
                $retourBdd = $this->verifExistanceBdd ($verifBdd, $objProduit);
            }else{
                $dataBdd = "";
                $this->modifBddProduit($dataBdd, $objProduit);
            }
            return $retourBdd;
            $this->_req->closeCursor();
        }catch (PDOException $e) {
            $errorMsg = $e->getMessage();
            require_once('controllers/ControllerError.php');
            //passage l'information de l'echecs de l'action via la variable $_session
            $this->_ctrl = new ControllerError($url, array('errorMsg' => $errorMsg));
        }
    }

    // extraction des données récupérer dans la base de donnée
    private function verifExistanceBdd ($verifBdd, $objProduit)
    {
        foreach($verifBdd as $key => $value){
            $dataBdd [":" . $key] = $value;
        };
        if (isset($dataBdd)){
            $this->modifBddProduit($dataBdd, $objProduit);
        }
    }

    // modification de la base de données
    private function modifBddProduit($dataBdd, $objProduit)
    {
        try{
            // récuprération des données extraites 
            $idProduitBdd = isset($dataBdd[":idProduit"])?$dataBdd[":idProduit"]:'';
            $categorie_idCategorieBdd = isset($dataBdd[":categorie_idCategorie"])?$dataBdd[":categorie_idCategorie"]:'';
            $nomProduitBdd = isset($dataBdd[":nomProduit"])?$dataBdd[":nomProduit"]:'';
            $descriptionProduitBdd = isset($dataBdd[":descriptionProduit"])?$dataBdd[":descriptionProduit"]:'';
            
            // récuprération des données de l'objet (qui ont été ajouté via les fonctions "hydrate") 
            $idProduit = $objProduit->getIdProduit();
            $categorie_idCategorie = $objProduit->getCategorie_idCategorie();
            $nomProduit = $objProduit->getNomProduit();
            $descriptionProduit = $objProduit->getDescriptionProduit();
            
            // envoie de la mise à jour de la base de données si les variables idCategorie, idProduit ou nomProduit 
            // sont différent entre l'objet et la base de données
            if($categorie_idCategorieBdd != $categorie_idCategorie || $idProduitBdd != $idProduit || $nomProduitBdd != $nomProduit){
                if (empty($descriptionProduit)) {
                    $descriptionProduit = $descriptionProduitBdd;
                }
                $qry = $this->getBdd()->prepare("UPDATE produit SET categorie_idCategorie = ? , nomProduit = ?,
                descriptionProduit = ? WHERE idProduit = ? ");
                $qry->execute(array($categorie_idCategorie, $nomProduit, $descriptionProduit, $idProduit));
            }
            
            // récupération des données liées au format des produits
                // les données de l'objet
            $idFormatProduit = $objProduit->getIdFormatProduit();
            $poidsProduit = $objProduit->getPoidsProduit();
            $prixProduit = $objProduit->getPrixProduit();
            
                // les données de la base de données si l'idFormatProduit est récupérer ou non
            if (!empty($idFormatProduit)) {
                $this->_req = $this->getBdd()->prepare('SELECT * FROM formatProduit WHERE idFormatProduit = ?');
                $this->_req->execute(array($idFormatProduit));
                $dataBddFormat = $this->_req->fetch(PDO::FETCH_ASSOC);
            }else{
                $this->_req = $this->getBdd()->prepare('SELECT * FROM formatProduit WHERE produit_idProduit = ? AND poids = ?');
                $this->_req->execute(array($idProduit, $poidsProduit));
                $dataBddFormat = $this->_req->fetch(PDO::FETCH_ASSOC);
            }
            
            // si les données de la base de données nt mise à jour de base de données
            if($dataBddFormat){
                $idFormatProduitBdd = $dataBddFormat["idFormatProduit"];
                $poidsProduitBdd = $dataBddFormat["poids"];
                $prixProduitBdd = $dataBddFormat["prixUnitaire"];
                if ($prixProduitBdd != $prixProduit || $poidsProduitBdd != $poidsProduit ) {
                    $qry = $this->getBdd()->prepare("UPDATE formatProduit SET poids = ? , prixUnitaire = ?
                    WHERE idFormatProduit = ? ");
                    $qry->execute(array($poidsProduit, $prixProduit, $idFormatProduitBdd));
                }
                
            // si les données de la base de données existent, non null et vrai,et l'idProduit existe et non null : création du format dans la base de données 
            }elseif(!empty($dataBddFormat) && isset($idProduit)){
                $qry = $this->getBdd()->prepare("INSERT INTO formatProduit (produit_idProduit, poids, prixUnitaire) Values (?,?,?)");
                $qry->execute(array($idProduit, $poidsProduit, $prixProduit));
            
            // si les données de la base de données n'existent pas création du produit puis création du format dans la base de données
            }else{
                $qry = $this->getBdd()->prepare("INSERT INTO Produit (categorie_idCategorie, nomProduit, descriptionProduit) Values (?,?,?)");
                $qry->execute(array($categorie_idCategorie, $nomProduit, $descriptionProduit));
                $this->_req = $this->getBdd()->prepare('SELECT idProduit FROM produit WHERE nomProduit = ?');
                $this->_req->execute(array($nomProduit));
                $dataBddFormat2 = $this->_req->fetch(PDO::FETCH_ASSOC);
                $idProduitNew = $dataBddFormat2["idProduit"];
                $qry2 = $this->getBdd()->prepare("INSERT INTO formatProduit (produit_idProduit, poids, prixUnitaire) Values (?,?,?)");
                $qry2->execute(array($idProduitNew, $poidsProduit, $prixProduit));
            }
            //passage l'information de la réussite de l'action via la variable $_session
            $_SESSION['modif']='ok';
            
        //recupération des eventuelles erreurs
        } catch (PDOException $e) {
            $errorMsg = $e->getMessage();
            require_once('controllers/ControllerError.php');
            //passage l'information de l'echecs de l'action via la variable $_session
            $_SESSION['modif']='no';
            $this->_ctrl = new ControllerError($url, array('errorMsg' => $errorMsg));
        }
        
        //retour automatique à la page gestion_produits
        header('Location: /php_projet-CDA/0.projet_les_picantins-code/gestion_produits');
        exit();
    }

    // suppression d'un format de la base de données
    protected function deleteObjtFormatBdd($objProduit)
    {
        try{
            // recupération des informations contenus dans l'objet
            $idProduit = $objProduit->getIdProduit();
            $idFormatProduit = $objProduit->getIdFormatProduit();
            
            // envoie requête de suppression de la base de données
            $qry = $this->getBdd()->prepare("DELETE FROM formatproduit WHERE produit_idProduit = ? AND idFormatProduit = ? ");
            $qry->execute(array($idProduit, $idFormatProduit));
            
            // vérification si c'était le dernier format du produit ou non
            $this->_req = $this->getBdd()->prepare('SELECT * FROM formatproduit WHERE produit_idProduit = ?');
            $this->_req->execute(array($idProduit));
            $dataBddFormat = $this->_req->fetch(PDO::FETCH_ASSOC);
            
            // si il y a pas d'autre format : envoie requête suppression du produit de la base de données
            if (empty($dataBddFormat)) {
                $qry = $this->getBdd()->prepare("DELETE FROM produit WHERE idProduit = ? ");
                $qry->execute(array($idProduit));
            }
            //passage l'information de la réussite de l'action via la variable $_session
            $_SESSION['modif']='ok';
            
        //recupération des eventuelles erreurs
        } catch (PDOException $e) {
            $errorMsg = $e->getMessage();
            require_once('controllers/ControllerError.php');
            //passage l'information de l'echecs de l'action via la variable $_session
            $_SESSION['modif']='no';
            $this->_ctrl = new ControllerError($url, array('errorMsg' => $errorMsg));
        }
        
        //retour automatique à la page gestion_produits
        header('Location: /php_projet-CDA/0.projet_les_picantins-code/gestion_produits');
        exit();
        
    }
    
    // vérification si la catégorie existe
    protected function verifExistanceCat($nomCategorie, $newNomCategorie)
    {
        try {
            // si le nom de la catégorie existe et non nul: recupération des données de la table Categorie  
            // où le nom est égale à la variables nomCategorie
            if (isset($nomCategorie)) {
                $this->_req = $this->getBdd()->prepare("SELECT * FROM Categorie WHERE nomCategorie =  '$nomCategorie'");
                $this->_req->execute();
                $verifBdd = $this->_req->fetch(PDO::FETCH_ASSOC);
    
                // extraction des données retournées si elles existent,sont non null et sont vrai
                if (!empty($verifBdd)) {
                    foreach($verifBdd as $key => $value){
                        $dataBdd [":" . $key] = $value;
                    };
                }
                // vérification que les données extraitent existes et sont non null pour faire appel 
                // à la méthode de modification de la base de donnée des catégories
                if (isset($dataBdd)){
                    $this->modifBddCat($dataBdd, $nomCategorie, $newNomCategorie);
                }else{
                    $dataBdd = "";
                    $this->modifBddCat($dataBdd, $nomCategorie, $newNomCategorie);
                }
            }else{
                //passage l'information de l'echecs de l'action via la variable $_session
                $_SESSION['modif']='noCatAbs';
                die();
            }
        }catch (PDOException $e) {
            $errorMsg = $e->getMessage();
            require_once('controllers/ControllerError.php');
            //passage l'information de l'echecs de l'action via la variable $_session
            $this->_ctrl = new ControllerError($url, array('errorMsg' => $errorMsg));
        }
    }

    // méthode de modification de la base de donnée des catégories
    private function modifBddCat($dataBdd, $nomCategorie, $newNomCategorie)
    {
        try{
            // si dataBdd et newNomCategorie existent,sont non null et sont vrai alors
            // envoie de la misae a jour de la base de donnée
            if (!empty($dataBdd) && !empty($newNomCategorie)){

                $idCatBdd = isset($dataBdd[":idCategorie"])?$dataBdd[":idCategorie"]:'';
                $qry = $this->getBdd()->prepare("UPDATE categorie SET  nomCategorie = ?
                WHERE idCategorie = ? ");
                $qry->execute(array($newNomCategorie,$idCatBdd));
            
            // sinon creation d'un nouvelle catégorie dans la base de donnée
            }else{
                $qry = $this->getBdd()->prepare("INSERT INTO categorie (nomCategorie) Values (?)");
                $qry->execute(array($nomCategorie));
            }
            //passage l'information de la réussite de l'action via la variable $_session
            $_SESSION['modif']='ok';

        //recupération des eventuelles erreurs
        } catch (PDOException $e) {
            $errorMsg = $e->getMessage();
            require_once('controllers/ControllerError.php');
            //passage l'information de l'echecs de l'action via la variable $_session
            $_SESSION['modif']='no';
            $this->_ctrl = new ControllerError($url, array('errorMsg' => $errorMsg));
        }

        //retour automatique à la page gestion_produits
        header('Location: /php_projet-CDA/0.projet_les_picantins-code/gestion_produits');
        exit();
    }

    // suppression de la base de données d'une catégorie
    protected function suppBddCat( $objCat)
    {
        try{
            // récupération du nom de la catégorie
            $nomCategorie = $objCat->getNomCategorie();
            // le nom de la catégorie existe et non null:vérification de l'existance de la catégorie dans la base de données
            if (isset($nomCategorie)) {
                $this->_req = $this->getBdd()->prepare("SELECT * FROM Categorie WHERE nomCategorie =  '$nomCategorie'");
                $this->_req->execute();
                $verifBdd = $this->_req->fetch(PDO::FETCH_ASSOC);
                if (!empty($verifBdd)) {
                    foreach($verifBdd as $key => $value){
                        $dataBdd [":" . $key] = $value;
                    };
                }
                // si les données de la base de données recupérer sont null, n'esiste pas, ou sont fausse: envoie d'un message d'erreur
                if (empty($dataBdd)){
                    throw new Exception('Erreur: nom de catégorie non valide!');
                    //passage l'information de l'echecs de l'action via la variable $_session
                    $_SESSION['modif']='no';
                }else{
                    //sinon envoie de la requête de suppression de la catégorie de la base de données
                    try {
                        $idCatBdd = isset($dataBdd[":idCategorie"])?$dataBdd[":idCategorie"]:'';
                        $qry = $this->getBdd()->prepare("DELETE FROM categorie WHERE idCategorie = ?");
                        $qry->execute(array($idCatBdd));
                        // vérification que la suppression a bien eu lieux
                        $this->_req = $this->getBdd()->prepare("SELECT * FROM Categorie WHERE nomCategorie =  '$nomCategorie'");
                        $this->_req->execute();
                        $verifBdd = $this->_req->fetch(PDO::FETCH_ASSOC);
                        if (empty($verifBdd)){
                            //passage l'information de la réussite de l'action via la variable $_session
                            $_SESSION['modif']='ok';
                        }else {
                            //passage l'information de l'echecs de l'action, car il y a presence d'une clée etrengére utiliser dans la table via la variable $_session
                            $_SESSION['modif']='errorKey';
                        }
                        
                    //recupération des eventuelles erreurs
                    } catch (PDOException $e) {
                        $errorMsg = $e->getMessage();
                        require_once('controllers/ControllerError.php');
                        //passage l'information de l'echecs de l'action via la variable $_session
                        $_SESSION['modif']='no';
                        $this->_ctrl = new ControllerError($url, array('errorMsg' => $errorMsg));
                    }
                }
            }else{
                throw new Exception('Erreur: nom de catégorie absent!');
                //passage l'information de l'echecs de l'action via la variable $_session
                $_SESSION['modif']='no';
                die();
            }
        //recupération des eventuelles erreurs
        } catch (PDOException $e) {
            $errorMsg = $e->getMessage();
            require_once('controllers/ControllerError.php');
            //passage l'information de l'echecs de l'action via la variable $_session
            $_SESSION['modif']='no';
            $this->_ctrl = new ControllerError($url, array('errorMsg' => $errorMsg));
            die();
        }
        
        //retour automatique à la page gestion_produits
        header('Location: /php_projet-CDA/0.projet_les_picantins-code/gestion_produits');
        exit();
    }

    //suppression d'un produit de la base de données
    protected function deleteObjtProduitBdd($objProduit)
    {
        try{
            //recupération de l'idProduit
            $idProduit = $objProduit->getIdProduit();
            //envoie de la requête de suppression de tout le format lié au produit
            $qry = $this->getBdd()->prepare("DELETE FROM formatproduit WHERE produit_idProduit = ? ");
            $qry->execute(array($idProduit));
            //envoie de la requête de suppression du produit
            $qry2 = $this->getBdd()->prepare("DELETE FROM produit WHERE idProduit = ? ");
            $qry2->execute(array($idProduit));
            //passage l'information de la réussite de l'action via la variable $_session
            $_SESSION['modif']='ok';
            
        //recupération des eventuelles erreurs
        } catch (PDOException $e) {
            $errorMsg = $e->getMessage();
            require_once('controllers/ControllerError.php');
            
            //passage l'information de l'echecs de l'action via la variable $_session
            $_SESSION['modif']='no';
            $this->_ctrl = new ControllerError($url, array('errorMsg' => $errorMsg));
        }
        
        //retour automatique à la page gestion_produits
        header('Location: /php_projet-CDA/0.projet_les_picantins-code/gestion_produits');
        exit();
        
    }

    // vérification si l'utilisateur existe
    protected function verifExistanceAddUser($objUser)
    {
        
        try {
            //récupération de l'adresse mail dans l'objet User
            $this->_mail = $objUser->getMail();
            // si le mail existe et non nul: recupération des données de la table Compte 
            if (isset($this->_mail)) {
                $this->_req = $this->getBdd()->prepare("SELECT * FROM Compte WHERE mail = ?");
                $this->_req->execute(array($this->_mail));
                $verifBdd = $this->_req->fetch(PDO::FETCH_ASSOC);
    
                // extraction des données retournées si elles existent,sont non null et sont vrai
                if (!empty($verifBdd)) {
                    foreach($verifBdd as $key => $value){
                        $dataBdd [":" . $key] = $value;
                    };
                }
                // vérification si les données extraitent existes et sont non null car pas de mail en double 
                if (!isset($dataBdd)){
                    $this->addUserBdd($objUser);
                }else{
    
    
                    //création de l'erreur mail existant
                    throw new Exception('Erreur: adresse e-mail déjà utilisé!');
    
    
    
                    //passage l'information de l'echecs de l'action via la variable $_session
                    $_SESSION['ajoutUser']='mailExistant';
                }
            }else{
    
    
                //création de l'erreur mail non renseignée
                // throw new Exception("Erreur: veuillez renseignée un adresse mail s'il vous plait!");
    
    
                //passage l'information de l'echecs de l'action via la variable $_session
                $_SESSION['ajoutUser']='manqueMail';
                die();
            }
        }catch (PDOException $e) {
            $errorMsg = $e->getMessage();
            require_once('controllers/ControllerError.php');
            //passage l'information de l'echecs de l'action via la variable $_session
            $this->_ctrl = new ControllerError($url, array('errorMsg' => $errorMsg));
        }
    }

    //ajout d'un nouveau utilisateur dans la bdd
    private function addUserBdd($objUser)    {
        try{            
            // récuprération des données de l'objet
            $nom = $objUser->getNom();
            $prenom = $objUser->getPrenom();
            $mail = $objUser->getMail();
            $mdp = $objUser->getMotDePasse();
            $adresse = $objUser->getAdresse();
            $tel = $objUser->getTelephone();
            $dateInsciption= $objUser->getDateInsciption();
            $statut = $objUser->getStatut();
            $droit = $objUser->getDroit();
            
            // envoie de la d'un nouvel utilisateur de la base de données
            $qry = $this->getBdd()->prepare(
            "INSERT INTO compte( mail, motDePasse, nom, prenom, adresse, telephone, dateInsciption, active, droit) 
            VALUES (?,?,?,?,?,?,?,?,?)");
            $qry->execute(array($mail,$mdp,$nom,$prenom,$adresse,$tel,$dateInsciption,$statut,$droit));
            //passage l'information de la réussite de l'action via la variable $_session
            $_SESSION['ajoutUser']='ok';
            header('Location: /php_projet-CDA/0.projet_les_picantins-code/login');
            die();
        //recupération des eventuelles erreurs
        } catch (PDOException $e) {
            $errorMsg = $e->getMessage();
            require_once('controllers/ControllerError.php');
            //passage l'information de l'echecs de l'action via la variable $_session
            $this->_ctrl = new ControllerError($url, array('errorMsg' => $errorMsg));
            $_SESSION['ajoutUser']='no';
            die();
        }
    }

    // vérification et récupération des données du compte
    protected function verifMailMdp($objUser)
    {
        //récupération du mail
        $this->_idCompte = $objUser->getIdCompte();
        $this->_mail = $objUser->getMail();
        $this->_nomForm = $objUser->getNomForm();
        
        // si le mail  et le mot de passe existent et sont non nul: recupération des données de la table Compte 
        try {
            if (isset($this->_mail)) {
                if ($this->_nomForm == "logCompte") {
                    $this->_req = $this->getBdd()->prepare("SELECT * FROM compte WHERE mail = ?  AND active = ? ");
                    $this->_req->execute(array($this->_mail,1));
                    $recupBdd = $this->_req->fetch(PDO::FETCH_ASSOC);
                } elseif ($this->_nomForm == "modifCompte" || $this->_nomForm == "modifCompteGestion"){
                    $this->_req = $this->getBdd()->prepare("SELECT * FROM compte WHERE idCompte = ?");
                    $this->_req->execute(array($this->_idCompte));
                    $recupBdd = $this->_req->fetch(PDO::FETCH_ASSOC);
                }
                // extraction des données retournées si elles existent,sont non null et sont vrai
                if (!empty($recupBdd)) {
                    foreach($recupBdd as $key => $value){
                        $dataBdd [":" . $key] = $value;
                    };
                }else{
                    $_SESSION['ajoutUser']='compteInexistant';


                    //a refaire pour non connexion


                    // header('Location: /php_projet-CDA/0.projet_les_picantins-code/accueil');
                }
                //mauvais mail => $dataBdd undefined faire alerte ici (ligne 515)


                $this->_motDePasse = $dataBdd[':motDePasse'];
                if (password_verify(
                    ((isset($_POST["passLogin"]) && !empty($_POST["passLogin"])) ? htmlspecialchars($_POST["passLogin"]) : null), 
                    $dataBdd[':motDePasse'])) 
                    {
                        // vérification si les données extraitent existes et sont non null 
                        if (isset($dataBdd) && $this->_nomForm == "logCompte"){
                            $this-> connexion($dataBdd);

                        }elseif ((isset($dataBdd) && $this->_nomForm == "modifCompte")){
                            $this-> verifModifCompte($dataBdd,$objUser);

                        }else{
                            //passage l'information de l'echecs de l'action via la variable $_session
                            $_SESSION['ajoutUser']='compteInexistant';
                        }
                    }elseif((!password_verify(
                        ((isset($_POST["passLogin"]) && !empty($_POST["passLogin"])) ? htmlspecialchars($_POST["passLogin"]) : null), 
                        $dataBdd[':motDePasse']))
                        && $this->_nomForm == "modifCompteGestion"){
                            $this-> verifModifCompte($dataBdd,$objUser);
                    }else {
                        //passage l'information de l'echecs de l'action via la variable $_session
                        $_SESSION['ajoutUser']='mauvaisMdp';
                        die();
                    }
            }else{
                //passage l'information de l'echecs de l'action via la variable $_session
                $_SESSION['ajoutUser']='MailVide';
                die();
            }
        }catch(Exception $e) {
            $errorMsg = $e->getMessage();
            throw new Exception('Erreur: '.$errorMsg);
        }
    }
    
    //comparaison entre les données récupéré de la Bdd et les données entrés dans le formulaire
    private function verifModifCompte($dataBdd,$objUser)
    {
        $idcompte =  $dataBdd[":idCompte"];
        $this->_motDePasseNew = $objUser->getMotDePasseNew();
        $this->_active = $objUser->getActive();
        foreach($dataBdd as $Key => $value){
            $nomKey = str_replace(":", "", $Key);
            if ($Key != ":idCompte" && $Key != ":motDePasse" && $Key != ":dateInsciption" && $Key != ":active" ) {
                $methodeNomKey=  "get".ucfirst($nomKey);
                $recupObjet =  $objUser->$methodeNomKey();
                if( $value != $recupObjet && !empty($recupObjet)){
                    $this->modifCompteBdd($idcompte,$nomKey,$recupObjet);
                }
            }elseif($Key == ":motDePasse" && !empty($this->_motDePasseNew) && $this->_nomForm == "modifCompte"){
                $this->modifCompteBdd($idcompte,$nomKey,$this->_motDePasseNew);
            }elseif($Key == ":active" && $this->_nomForm == "modifCompteGestion"){
                $this->modifCompteBdd($idcompte,$nomKey,$this->_active);
            }
        }
        if ($this->_nomForm == "modifCompte") {
            $objUser->setNomForm("logCompte");
            if (!empty($this->_motDePasseNew)) {
                $objUser->setMotDePasse($this->_motDePasseNew);
            }
            $this->verifMailMdp($objUser);
        }elseif ($this->_nomForm == "modifCompteGestion"){
            $_SESSION['modifCompte']="ok";
        }
    }

    // fonction de modification du comptre de la bdd
    private function modifCompteBdd($idCompte,$nomKey,$valeur)
    {
        try{
            if (!empty($idCompte) && !empty($nomKey) && !empty($valeur)) {
                $this->request = "UPDATE compte SET $nomKey = '$valeur' WHERE idCompte = $idCompte";
                $qry = $this->getBdd()->prepare($this->request);
                $qry->execute();
            }
        }catch(Exception $e){
            $errorMsg = $e->getMessage();
            throw new Exception('Erreur: '.$errorMsg);
        }
    }

    // compte trouvé, récuprétion des données du compte et envoie de ces dernières dans le $_SESSION 
    // pour récupération dans d'autre page
    private function connexion($data)
    {
        // récupération des données de la base de donné sauf pour l'adresse mail qui est récupérer de la connexion
        $this->_idCompte = $data[':idCompte'];
        $this->_nom = $data[':nom'];
        $this->_prenom = $data[':prenom'];
        $this->_mail = $data[':mail'];
        $this->_adresse = $data[':adresse'];
        $this->_telephone = $data[':telephone'];
        for($i=strlen($this->_telephone); $i>0; $i--){
            if($i%2==0 && $i!=10){
                $this->_telephone = substr_replace($this->_telephone, '-', $i, 0);
            }
        }
        $this->_active = $data[':active'];
        
        // ajout des données récupérées dans un tableau pour le passage dans la variable $_SESSION
        // et envoie confirmation de la connexion
        $user = array (
            'idCompte'=>$this->_idCompte,
            'nom'=>$this->_nom,
            'prenom'=>$this->_prenom,
            'mail'=>$this->_mail,
            'adresse'=>$this->_adresse,
            'tel'=>$this->_telephone,
            'active'=>$this->_active
        );
        $_SESSION['derniere_action'] = time();
        $_SESSION['logged']=true;
        $_SESSION['user']=$user;
        header('Location: /php_projet-CDA/0.projet_les_picantins-code/myAccount');
        exit();
    }
}