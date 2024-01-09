<?php

namespace App\controllers;

use App\Entities\Wiki;
use App\Models\WikiModel;


class WikiController
{
    private $wikiModel;

    public function __construct()
    {
        $this->wikiModel = new WikiModel();
    }

    public function index()
    {
        $wikis = $this->wikiModel->getAll();
        // var_dump($wikis);
        foreach ($wikis as $wiki) {
            $categoryName = $this->wikiModel->getCategoryNameById($wiki->getCategoryId());
            $wiki->setCategoryName($categoryName); // Assuming you have a setCategoryName method in your Wiki entity
        }

        foreach ($wikis as $wiki) {
            $tags = $this->wikiModel->getTagsForWiki($wiki->getId());
            $wiki->setTags($tags); // Assuming you have a setTags method in your Wiki entity
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


    
    
    public function getArchivedWikis()
    {
        // $tags = $this->wikiModel->getAll();
        
        require_once "../../views/Admin/ArchivedWikis.php";
    }

    

}


?>