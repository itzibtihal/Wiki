<?php

namespace App\Entities;

class Wiki
{
    private $id;
    private $picture;
    private $title;
    private $content;
    private $readMin;
    private $creationDate;
    private $userId;
    private $categoryId;

    public function __construct($picture, $title, $content, $readMin, $userId, $categoryId)
    {
        $this->picture = $picture;
        $this->title = $title;
        $this->content = $content;
        $this->readMin = $readMin;
        $this->userId = $userId;
        $this->categoryId = $categoryId;
        // creation_date is managed by the database 
    }

    public function getId()
    {
        return $this->id;
    }

    public function getPicture()
    {
        return $this->picture;
    }

    public function setPicture($picture)
    {
        $this->picture = $picture;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function setContent($content)
    {
        $this->content = $content;
    }

    public function getReadMin()
    {
        return $this->readMin;
    }

    public function setReadMin($readMin)
    {
        $this->readMin = $readMin;
    }

    public function getCreationDate()
    {
        return $this->creationDate;
    }

    public function setCreationDate($creationDate)
    {
        $this->creationDate = $creationDate;
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    public function getCategoryId()
    {
        return $this->categoryId;
    }

    public function setCategoryId($categoryId)
    {
        $this->categoryId = $categoryId;
    }
}


