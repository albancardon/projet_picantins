<?php
require_once('views/View.php');

class ControllerAccueil
{
    private $_categorieManager;
    private $_viewAccueil;

    public function __construct($url)
    {
        if(isset($url) && count( array($url) ) > 1) {
            throw new Exception('Page introuvable');
        }else {
            $this->categories();
        }
    }

    private function categories()
    {
        $this->_categorieManager = new CategorieManager;
        $categorie = $this->_categorieManager->getCategorie();
        $page = 'Accueil';

        $this->_view = new View('Accueil');
        $this->_view->generate(array('categorie' => $categorie, 'page' => $page));
    }
}
