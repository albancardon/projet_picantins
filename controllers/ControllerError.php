<?php
require_once('controllers/Controller.php');

class ControllerError
{
    private $_nameContenu = 'categorie';
    private $_page = 'error';

    public function __construct($url, $errorMsg)
    {
        if(isset($url) && count( array($url) ) > 1) {
            throw new Exception('Page introuvable');
        }else {
            $this->contenus($errorMsg);
        }
    }

    private function contenus($errorMsg)
    {

        $this->_contenuManager = new ModelsManager;
        $contenu = $this->_contenuManager->getModel($this->_nameContenu);

        $page = $this->_page;
        $contenuTab = array($this->_nameContenu => $contenu);

        $this->_view = new View($this->_page);
        $this->_view->generate(array('contenuTab' => $contenuTab, 'errorMsg' => $errorMsg['errorMsg']));
    }


}