<?php
require_once('views/View.php');

class ControllerAccueil
{
    private $_contenuManager;
    private $_view;
    private $_page;
    private $_nameContenu;

    public function __construct($url)
    {
        if(isset($url) && count( array($url) ) > 1) {
            throw new Exception('Page introuvable');
        }else {
            $this->contenus();
        }
    }

    private function contenus()
    {
        if(array_key_exists("url" , $_GET)) {
            $this->_page = strtolower(htmlspecialchars($_GET["url"]));
        }else {
            $this->_page = 'accueil';
        }

        $this->getContenu();
        $this->_contenuManager = new ModelsManager;
        $contenu = $this->_contenuManager->getModel($this->_nameContenu);
        $page = $this->_page;

        $this->_view = new View($this->_page);
        $this->_view->generate(array($this->_nameContenu => $contenu, 'page' => $page));
    }

    private function getContenu(){
        if ($this->_page === 'accueil' || $this->_page === 'Accueil') {
            $this->_nameContenu = 'categorie';
        }
    }
}