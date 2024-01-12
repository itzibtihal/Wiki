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

    public function getWikiAuthors()
    {
        $this->isAdminLoggedIn();
        $userSId= $_SESSION['userId'];
        // var_dump( $userSId);
        // $userId = 2;
        $existingUser = $this->userModel->getById($userSId);
        $users = $this->userModel->getUsersByRoleId(2);
        require_once "../../views/Admin/Authors.php";
    }

    public function geteditProfil()
    {
        $this->isAuthorLoggedIn();
        $userSId= $_SESSION['userId'];
        // var_dump( $userSId);
        // $userId = 2;
        $existingUser = $this->userModel->getById($userSId);
        // var_dump($existingUser);
        require_once "../../views/Author/Myprofil.php";
    }

    public function updateUser()
    {
        $this->isAuthorLoggedIn();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // $userSId= $_SESSION['userId'];
            $userId = $_POST['user_id'];

            $existingUser = $this->userModel->getUserById($userId);

            if (!$existingUser) {
                echo 'User not found.';
                return;
            }

            $name = $_POST['name'];
            $email = $_POST['email'];
            $linkedinProfile = $_POST['linkedinProfile'];
            $instagramProfile = $_POST['instagramProfile'];
            $xProfile = $_POST['xProfile'];
            $description = $_POST['description'];


            $uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/WIKI/public/img/';

            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            $uploadFile = $uploadDir . basename($_FILES['profile']['name']);

            if (move_uploaded_file($_FILES['profile']['tmp_name'], $uploadFile)) {
                $existingUser->setName($name);
                $existingUser->setEmail($email);
                $existingUser->setLinkedinProfile($linkedinProfile);
                $existingUser->setInstagramProfile($instagramProfile);
                $existingUser->setXProfile($xProfile);
                $existingUser->setDescription($description);
                $existingUser->setProfile($_FILES['profile']['name']);

                $this->userModel->updateUser($existingUser);

                header('Location: MyProfile');
                exit();
            } else {
                echo 'Failed to upload profile image.';
                
            }
        }

        require "../../views/Author/Myprofil.php"; // Adjust the view path accordingly
    }
}
