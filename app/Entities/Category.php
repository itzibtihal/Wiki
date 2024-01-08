<?php

namespace App\Entities;

class Category
{
    private $id;
    private $name;
    private $picture;

    public function __construct($name, $picture)
    {
        $this->name = $name;
        $this->picture = $picture;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    } 
    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getPicture()
    {
        return $this->picture;
    }

    public function setPicture($picture)
    {
        $this->picture = $picture;
    }
}

?>
