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
        // $tags = $this->wikiModel->getAll();
        
        require_once "../../views/Admin/VerifiedWikis.php";
    }

}


?>