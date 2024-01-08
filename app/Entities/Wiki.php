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
    private $dateDeleted;
    private $status;
    private $userId;
    private $categoryId;

    public function __construct($picture, $title, $content, $readMin,$creationDate,$dateDeleted,$status, $userId, $categoryId)
    {
        $this->picture = $picture;
        $this->title = $title;
        $this->content = $content;
        $this->readMin = $readMin;
        $this->creationDate = $creationDate;
        $this->dateDeleted = $dateDeleted;
        $this->status = $status;
        $this->userId = $userId;
        $this->categoryId = $categoryId;
        
    }

 
    public function getId()
    {
        return $this->id;
    }

    public function getPicture()
    {
        return $this->picture;
    }
    

    public function getTitle()
    {
        return $this->title;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function getReadMin()
    {
        return $this->readMin;
    }

    public function getCreationDate()
    {
        return $this->creationDate;
    }

    public function getDateDeleted()
    {
        return $this->dateDeleted;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function getCategoryId()
    {
        return $this->categoryId;
    }

    
    public function setId($id)
    {
        $this->id = $id;
    }

    public function setPicture($picture)
    {
        $this->picture = $picture;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function setContent($content)
    {
        $this->content = $content;
    }

    public function setReadMin($readMin)
    {
        $this->readMin = $readMin;
    }

    public function setCreationDate($creationDate)
    {
        $this->creationDate = $creationDate;
    }

    public function setDateDeleted($dateDeleted)
    {
        $this->dateDeleted = $dateDeleted;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    public function setCategoryId($categoryId)
    {
        $this->categoryId = $categoryId;
    }
}

?>
