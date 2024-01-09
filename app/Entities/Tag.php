<?php

namespace App\Entities;

class Tag
{
    private $id;
    private $label;
   

    public function __construct($id,$label)
    { 
        $this->id = $id;
        $this->label = $label;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getLabel()
    {
        return $this->label;
    }

    public function setLabel($label)
    {
        $this->label = $label;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

}



?>
