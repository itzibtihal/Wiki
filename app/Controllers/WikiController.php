<?php

namespace App\controllers;

use App\Entities\Category;
use App\Entities\Wiki;
use App\Models\WikiModel;
use App\Models\UserModel;
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
        try {
            // Fetch user details
            $userSId = $_SESSION['userId'];
            $existingUser = $this->userModel->getById($userSId);
    
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
                    // Create a new Wiki object
                    $wiki = new Wiki(null, $_FILES['picture']['name'], $title, $content, $readTime, null, null, null, null, $categoryId);
    
                    // Set tags for the wiki
                    $wiki->setTags($tags);
    
                    try {
                        // Save the wiki with tags
                        $this->wikiModel->saveWikiWithTags($wiki);
    
                        // Redirect to success page
                        header("Location: success_page.php");
                        exit();
                    } catch (\Exception $exception) {
                        // Handle exceptions (e.g., log the error)
                        echo "Error: " . $exception->getMessage();
                    }
                }
            } else {
                // Display the form
                // Call the function to get tags and categories
                $wikiFormDetails = $this->getWikiFormDetails();
    
                // Extract tags and categories from the returned array
                $tags = $wikiFormDetails['tags'];
                $categories = $wikiFormDetails['categories'];
    
                // Pass tags, categories, and user details to the view
                require_once "../../views/Author/Addwiki.php";
            }
        } catch (\Exception $exception) {
            // Handle exceptions (e.g., log the error)
            echo "Error: " . $exception->getMessage();
        }
    }
    

    public function getWikiFormDetails()
    {
        try {
            // Fetch all tags
            $tags = $this->tagModel ? $this->tagModel->getAllTags() : [];
    
            // Fetch all categories
            $categories = $this->categoryModel ? $this->categoryModel->getAll() : [];
    
            // Return an associative array containing tags and categories
            return [
                'tags' => $tags,
                'categories' => $categories,
            ];
        } catch (\Exception $exception) {
            // Handle exceptions (e.g., log the error)
            throw $exception;
        }
    }

   
    





}


?>