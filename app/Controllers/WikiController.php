<?php

namespace App\controllers;

use App\Entities\Category;
use App\Entities\Wiki;
use App\Models\WikiModel;
use App\Models\UserModel;
use App\Models\TagModel;
use App\Models\CategoryModel;


class WikiController
{
    private $wikiModel;
    private $tagModel;
    private $userModel;
     private $categoryModel;

    public function __construct()
    {
        $this->wikiModel = new WikiModel();
        $this->userModel = new UserModel();
        $this->categoryModel = new CategoryModel();
        $this->tagModel = new TagModel();
    }

    private function isAdminLoggedIn()
    {
        if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] === true) {
            return true;
        } else {
            header('Location: Auth');
            exit();
        }
    }
    private function isAuthorLoggedIn()
    {
        if (isset($_SESSION['isAuthor']) && $_SESSION['isAuthor'] === true) {
            return true;
        } else {
            header('Location: Auth');
            exit();
        }
    }

    public function index()
    {
        $this->isAdminLoggedIn();
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
        $this->isAdminLoggedIn();
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
        $this->isAuthorLoggedIn();
        try {
            
            $userSId = $_SESSION['userId'];
            $existingUser = $this->userModel->getById($userSId);
            
    
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // Process the form submission
                $title = $_POST['title'];
                $content = $_POST['content'];
                $read_min = $_POST['read_min'];
                $category_id = $_POST['category_id'];
                $tags = isset($_POST['tags']) ? $_POST['tags'] : [];
               
    
                $uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/WIKI/public/img/';
                $uploadFile = $uploadDir . basename($_FILES['picture']['name']);
    
                if (!file_exists($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }
    
                if (move_uploaded_file($_FILES['picture']['tmp_name'], $uploadFile)) {
                    // Create a new Wiki object
                    $wiki = new Wiki(null, $_FILES['picture']['name'], $title, $content, $read_min, null, null,'verified', $userSId, $category_id);
    
                    
                    $wiki->setTags($tags);
                    // var_dump($tags);
    
                    try {
                        
                        $this->wikiModel->saveWikiWithTags($wiki);
    
                        header("Location: MyDash");
                        exit();
                    } catch (\Exception $exception) {
                       
                        echo "Error: " . $exception->getMessage();
                    }
                }
            } else {
                
                $wikiFormDetails = $this->getWikiFormDetails();
    
                
                $tags = $wikiFormDetails['tags'];
                $categories = $wikiFormDetails['categories'];
    
                require_once "../../views/Author/AddWiki.php";
            }
        } catch (\Exception $exception) {
            
            echo "Error: " . $exception->getMessage();
        }
    }
    

    public function getWikiFormDetails()
    {
        
        try {
            
            $tags = $this->tagModel ? $this->tagModel->getAll() : [];
    
            
            $categories = $this->categoryModel ? $this->categoryModel->getAll() : [];
    
            
            return [
                'tags' => $tags,
                'categories' => $categories,
            ];
        } catch (\Exception $exception) {
            
            throw $exception;
        }
    }

   
    public function archiveWikiByAuthor()
    {
        $this->isAuthorLoggedIn();
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $wikiId = $_POST['wiki_id'];
            
            $existingWiki = $this->wikiModel->getById($wikiId);
            echo $existingWiki->getId();

            if (!$existingWiki) {
                echo 'Wiki not found.';
                return;
            }
            
            $this->wikiModel->archiveWiki($existingWiki); 
            header('location:MyDash');
        
            exit();
        }

        echo 'Invalid request.';
    }





}


?>