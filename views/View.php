<?php
class View
{
    private $_file;
    private $_page;

    public function __construct($action)
    {
        $this->_file ='views/view'.$action.'.php';
    }

    // génére et affiche la vue
    public function generate($data)
    {
        $content = $this->generateFile($this->_file, $data);
        
        $view = $this->generateFile('views/template.php', array('page'=> $this-> _page, 'content'=>$content));

        echo $view;
    }

    // génére un fichier vue et renvoie le résultat produit
    private function generateFile($file, $data)
    {
        if(file_exists($file)){

            extract($data);

            ob_start();

            require $file;

            return ob_get_clean();
        }else{
            throw new Exception('Fichier '.$file.' introuvable');
        }
    }
}
