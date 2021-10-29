<?php

abstract class Models
{
    private static $_bdd;

    //instencie la connection à la bdd si elle n'existe pas
    private static function setBdd()
    {
        self::$_bdd = new PDO('mysql:host=localhost;dbname=lespicantins', 'root', '');
        self::$_bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    }

    //récupération de la connection à la bdd
    protected function getBdd()
    {
        if (self::$_bdd == null) {
            self::setBdd();
        }
        return self::$_bdd;
    }

    protected function getAll($table, $obj, $nomId)
    {
        $var = [];
        $req = $this->getBdd()->prepare('SELECT * FROM ' . $table . ' ORDER BY id' . $nomId . ' ASC');
        $req->execute();
        while ($data = $req->fetch(PDO::FETCH_ASSOC)) {
            $var[] = new $obj($data);
        }
        return $var;
        $req->closeCursor();
    }
}