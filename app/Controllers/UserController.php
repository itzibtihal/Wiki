<?php

namespace App\controllers;

use App\Entities\User;
use App\Models\UserModel;

class UserController
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        
    }
   
    public function getWikiAuthors()
    {
        $users = $this->userModel->getUsersByRoleId(2);
        require_once "../../views/Admin/Authors.php";
    }

    public function geteditProfil()
    {
        // $userSId= $_SESSION['userId'];
        $userSId =2;
        $existingUser = $this->userModel->getById($userSId);
        require_once "../../views/Author/Myprofil.php";

    }
    


}




?>