<?php

namespace App\Controllers;

use App\Entities\Wiki;
use App\Models\WikiModel;
use App\Models\UserModel;
use App\Models\TagModel;
use App\Models\CategoryModel;

class DetailsWikiController
{
    private $wikiModel;
    private $tagModel;
    private $categoryModel;
    private $userModel;


    public function __construct()
    {
        $this->wikiModel = new WikiModel();
        $this->tagModel = new TagModel();
        $this->categoryModel = new CategoryModel();
        $this->userModel = new UserModel();
    }

    public function index()
{
    $id = $_GET['id'];
    $wiki = $this->wikiModel->getById($id);

    if ($wiki) {
        $categoryName = $this->wikiModel->getCategoryNameById($wiki->getCategoryId());
        $wiki->setCategoryName($categoryName);

        $tags = $this->wikiModel->getTagsForWiki($wiki->getId());
        $wiki->setTags($tags);

        $user = $this->userModel->getUserById($wiki->getUserId());
        // Add other data that you need for the view

        require_once "../../views/SingleWiki.php";
    } else {
        echo "Wiki not found"; // Handle the case where the wiki is not found
    }
}


}