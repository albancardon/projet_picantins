<?php
class CategorieManager extends Models
{
    public function getCategorie()
    {
        $this->getBdd();
        return $this->getAll('categorie', 'Categorie', 'Categorie');
    }
}