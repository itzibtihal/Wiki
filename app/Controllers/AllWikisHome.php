<?php

namespace App\Controllers;

use App\Entities\Wiki;
use App\Models\WikiModel;



class AllWikisHome
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
            $wiki->setCategoryName($categoryName);
        }

        foreach ($wikis as $wiki) {
            $tags = $this->wikiModel->getTagsForWiki($wiki->getId());
            $wiki->setTags($tags);
        }

        require_once "../../views/wikiposts.php";
    }

    public function searchh()
{
    // var_dump($_GET);
    $searchTerm = $_GET['q']; 
    $wikis = $this->wikiModel->searchWikis($searchTerm);

    foreach ($wikis as $wiki) {
        $categoryName = $this->wikiModel->getCategoryNameById($wiki->getCategoryId());
        $wiki->setCategoryName($categoryName);
    }

    foreach ($wikis as $wiki) {
        $tags = $this->wikiModel->getTagsForWiki($wiki->getId());
        $wiki->setTags($tags);
    }

    require_once "../../views/wikiposts.php";
}

public function search()
{
    if (isset($_GET['q'])) {
        $searchQuery = $_GET['q'];
        $WikiModel = new WikiModel();
        $searchedWikis = $WikiModel->searchWikiis($searchQuery);

        echo json_encode($searchedWikis);

    }
}


}
