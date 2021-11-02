<?php
require_once('controllers/Controller.php');

class ControllerStore extends Controller 
{

    public function __construct($url)
    {
        if(isset($url) && count( array($url) ) > 1) {
            throw new Exception('Page introuvable');
        }else {
            $this->contenus();
        }
    }

}