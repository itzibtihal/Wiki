<?php

namespace App\Controllers;

use App\Entities\Wiki;
use App\Models\WikiModel;
use App\Models\UserModel;
use App\Models\TagModel;
use App\Models\CategoryModel;

class HomeWikiController
{
    private $wikiModel;
    private $tagModel;
    private $categoryModel;


    public function __construct()
    {
        $this->wikiModel = new WikiModel();
        $this->tagModel = new TagModel();
        $this->categoryModel = new CategoryModel();
    }

    public function index()
    {

        require_once "../../views/home.php";
    }
    

    public function getLastWikiByCategory6()
    {
        $category_id = 2;
        $lastWiki = $this->wikiModel->getLastWikiByCategoryId($category_id);
        $category_id2 = 6;
        $lastWiki6 = $this->wikiModel->getLastWikiByCategoryId($category_id2);
        $category_id3 = 7;
        $lastWiki7 = $this->wikiModel->getLastWikiByCategoryId($category_id3);
        $lastInsertedWikiTitle = $this->wikiModel->getLastInsertedWikiTitle();
        $lastFiveWikis = $this->wikiModel->getLastFiveVerifiedWikis();
        $lastSixWikis = $this->wikiModel->getLastSixVerifiedWikis();
        $lastSixTags = $this->tagModel->getLastSixTags();
        $lastSixCategories = $this->categoryModel->getLastSixCategories();
        require_once "../../views/home.php";

    }

    // public function getLastInsertedWikiTitle()
    // {
    //     $lastInsertedWikiTitle = $this->wikiModel->getLastInsertedWikiTitle();
    //     require_once "../../views/home.php";

    // }

}
