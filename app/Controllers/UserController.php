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


}




?>