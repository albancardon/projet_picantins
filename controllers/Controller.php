<?php
require_once('views/View.php');

class Controller
{
    private $_contenuManager;
    private $_view;
    private $_page;
    private $_nameContenu;
    private $_nameContenu2;
    private $_nameContenu3;

    protected function contenus()
    {
        if(array_key_exists("url" , $_GET)) {
            $this->_page = strtolower(htmlspecialchars($_GET["url"]));
        }else {
            $this->_page = 'accueil';
        }

        $this->getContenu();
        $this->_contenuManager = new ModelsManager;
        $contenu = $this->_contenuManager->getModel($this->_nameContenu);
        $contenuTab = array($this->_nameContenu => $contenu);

        if (isset($this->_nameContenu2)) {
            $contenu2 = $this->_contenuManager->getModel($this->_nameContenu2);
            $contenuTab[$this->_nameContenu2] =  $contenu2;
        }
        if (isset($this->_nameContenu3)) {
            $contenu3 = $this->_contenuManager->getModel($this->_nameContenu3);
            $contenuTab[$this->_nameContenu3] =  $contenu3;
        }
        $page = $this->_page;

        $this->_view = new View($this->_page);
        $this->_view->generate(array('contenuTab' => $contenuTab, 'page' => $page));
    }

    private function getContenu(){
        if ($this->_page === 'accueil' || $this->_page === 'Accueil') {
            $this->_nameContenu = 'categorie';
        }
        else if ($this->_page === 'store') {
            $this->_nameContenu = 'categorie';
            $this->_nameContenu2 = 'produit';
            $this->_nameContenu3 = 'formatproduit';
        }
    }
}