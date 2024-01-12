<?php

namespace App\controllers;

use App\Entities\Wiki;
use App\Models\WikiModel;
use App\Models\UserModel;


class WikiController
{
    private $wikiModel;
    private $tagModel;
    private $userModel;

    public function __construct()
    {
        $this->wikiModel = new WikiModel();
        $this->userModel = new UserModel();
    }

    public function index()
    {
        $userSId= $_SESSION['userId'];
        // var_dump( $userSId);
        // $userId = 2;
        $existingUser = $this->userModel->getById($userSId);
        $wikis = $this->wikiModel->getAll();
        // var_dump($wikis);
        foreach ($wikis as $wiki) {
            $categoryName = $this->wikiModel->getCategoryNameById($wiki->getCategoryId());
            $wiki->setCategoryName($categoryName); 
        }

        foreach ($wikis as $wiki) {
            $tags = $this->wikiModel->getTagsForWiki($wiki->getId());
            $wiki->setTags($tags); 
        }
        require_once "../../views/Admin/VerifiedWikis.php";
    }

    
    public function archiveWiki()
    {
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $wikiId = $_POST['wiki_id'];
            
            $existingWiki = $this->wikiModel->getById($wikiId);
            echo $existingWiki->getId();

            if (!$existingWiki) {
                echo 'Wiki not found.';
                return;
            }
            
            $this->wikiModel->archiveWiki($existingWiki); 
            header('location:Wikis');
        
            exit();
        }

        echo 'Invalid request.';
    }

    public function verifyWiki()
    {
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $wikiId = $_POST['wiki_id'];
            
            $existingWiki = $this->wikiModel->getById($wikiId);
            echo $existingWiki->getId();

            if (!$existingWiki) {
                echo 'Wiki not found.';
                return;
            }
            
            $this->wikiModel->verifyWiki($existingWiki); 
            header('location:Wikis');
        
            exit();
        }

        echo 'Invalid request.';
    }


    
    
    public function getArchivedWikis()
    {
        $userSId= $_SESSION['userId'];
        // var_dump( $userSId);
        // $userId = 2;
        $existingUser = $this->userModel->getById($userSId);
        $wikis = $this->wikiModel->getAllArchived();
        foreach ($wikis as $wiki) {
            $categoryName = $this->wikiModel->getCategoryNameById($wiki->getCategoryId());
            $wiki->setCategoryName($categoryName); // Assuming you have a setCategoryName method in your Wiki entity
        }

        foreach ($wikis as $wiki) {
            $tags = $this->wikiModel->getTagsForWiki($wiki->getId());
            $wiki->setTags($tags); // Assuming you have a setTags method in your Wiki entity
        }
        require_once "../../views/Admin/ArchivedWikis.php";
    }


    public function createWiki()
    {
        $userSId= $_SESSION['userId'];
      // var_dump( $userSId);
      // $userId = 2;
      $existingUser = $this->userModel->getById($userSId);
        
        // $userSId= $_SESSION['userId'];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Process the form submission
            $title = $_POST['title'];
            $content = $_POST['content'];
            $readTime = $_POST['readMin'];
            $categoryId = $_POST['categoryId'];
            $tags = isset($_POST['tags']) ? $_POST['tags'] : [];
            
            $uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/WIKI/public/img/';
            $uploadFile = $uploadDir . basename($_FILES['picture']['name']);

        
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        if (move_uploaded_file($_FILES['picture']['tmp_name'], $uploadFile)) {
        
            $wiki = new Wiki(null, $_FILES['picture']['name'], $title, $content, $readTime, null, null, null, null, $categoryId);

           
            $wiki->setTags($tags);
            

            try {
               
                $this->wikiModel->saveWikiWithTags($wiki);

                
                header("Location: success_page.php");
                exit();
            } catch (\Exception $exception) {
                
                echo "Error: " . $exception->getMessage();
            }
        } 
    }else {
            // Display the form
            require_once "../../views/Author/Addwiki.php";
        }
    }


}


?>