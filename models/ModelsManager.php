<?php

class ModelsManager extends Models
{
    public function getModel($infoModel)
    {
        $infoModelMaj = ucfirst($infoModel);
        $this->getBdd();
        return $this->getAll($infoModel, $infoModelMaj, $infoModelMaj);
    }
}