<?php

namespace App\Controllers;

use App\Entities\Wiki;
use App\Models\WikiModel;
use App\Models\UserModel;
use App\Models\TagModel;
use App\Models\CategoryModel;

class HomeAdminController
{
    private $wikiModel;
    private $userModel;
    private $tagModel;
    private $categoryModel;

    public function __construct()
    {
        $this->wikiModel = new WikiModel();
        $this->userModel = new UserModel();
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
        $last6Wikis = $this->wikiModel->listLast6Wikis();
        require_once "../../views/Admin/Admin.php";
    }


    public function countUsersWithRoleId2()
    {
        $this->userModel = new UserModel();
        $count = $this->userModel->countUsersByRoleId(2);
        return $count;
    }

    public function countCategories()
    {
        $this->categoryModel = new CategoryModel();
        $count = $this->categoryModel->countCategories();
        return $count;
    }

    

    public function countTags()
    {
        $this->tagModel = new TagModel();
        $count = $this->tagModel->countTags();
        return $count;
    }


    

    public function countVerifiedWikis()
    {
        $count = $this->wikiModel->countVerifiedWikis();
        return $count;
    }


    public function countArchivedWikis()
    {
        $count = $this->wikiModel->countArchivedWikis();
        return $count;
    }

    public function countAllWikis()
    {
        $count = $this->wikiModel->countAllWikis();
        return $count;
    }

    public function countWikisCreatedToday()
    {
        $count = $this->wikiModel->countWikisCreatedToday();
        return $count;
    }

    
}
