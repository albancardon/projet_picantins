<?php

class ControllerCommandeBdd
{

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
        echo "<pre>";
        var_dump($_POST);
        echo "</pre>";
        // recupération et sécurisation des informations envoyer par le formulaire
        foreach ($_POST as $key => $value) {
            $params["*" . $key] = (isset($_POST[$key]) && !empty($_POST[$key])) ? htmlspecialchars($_POST[$key]) : null;
        }
    }

}