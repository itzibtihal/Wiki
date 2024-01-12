<?php

namespace App\Controllers;

use App\Entities\Category;
use App\Models\CategoryModel;
use App\Models\UserModel;



class CategoryController
{
    private $categoryModel;
    private $userModel;

    public function __construct()
    {
        $this->categoryModel = new CategoryModel();
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
        $categories = $this->categoryModel->getAll();
      
        require_once"../../views/Admin/Categories.php";
    }

    public function getaddCategory()
    {
        $this->isAdminLoggedIn();
        require_once"../../views/Admin/Categories/add.php";
    }

    public function getupdateCategory()
    {
        $this->isAdminLoggedIn();
        $categoryId = $_GET['id'];
        
       
        $existingCategory = $this->categoryModel->getById($categoryId);
        

        require_once"../../views/Admin/Categories/update.php";
    }

   

    public function addCategory()
{
    $this->isAdminLoggedIn();
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_POST['id'];
        $name = filter_var($_POST['name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        
        $uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/WIKI/public/img/';
        $uploadFile = $uploadDir . basename($_FILES['picture']['name']);

        
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        if (move_uploaded_file($_FILES['picture']['tmp_name'], $uploadFile)) {
            $category = new Category($id,$name, $_FILES['picture']['name']);
            
            
            $this->categoryModel->save($category);

            header('Location: /WIKI/Categories');
            exit();
        } else {
            echo 'Failed to upload image.';
        }
    }
    require "../../views/Admin/Categories/add.php";
}


public function UpdateCategory()
{
    $this->isAdminLoggedIn();
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        
        $categoryId = $_POST['category_id'];
       
        $existingCategory = $this->categoryModel->getById($categoryId);

        if (!$existingCategory) {
            echo 'Category not found.';
            return;
        }

        $name = filter_var($_POST['name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        
        $uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/WIKI/public/img/';

       
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

       
        $uploadFile = $uploadDir . basename($_FILES['picture']['name']);

       
        if (move_uploaded_file($_FILES['picture']['tmp_name'], $uploadFile)) {
            $existingCategory->setName($name);
            $existingCategory->setPicture($_FILES['picture']['name']);

            $this->categoryModel->update($existingCategory);

            header('Location: Categories');
            exit();
        } else {
            echo 'Failed to upload image.';
        }
    }

    require "../../views/Admin/Categories/update.php";
}






    public function destroy()
{
    $this->isAdminLoggedIn();
   
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
       
        $categoryId = isset($_POST['category_id']) ? $_POST['category_id'] : null;

        
        if ($categoryId === null) {
            echo 'Category not found.';
            return;
        }

        
        $category = $this->categoryModel->getById($categoryId);

       
        if (!$category) {
            echo 'Category not found.';
            return;
        }

     
        $this->categoryModel->delete($category);

        
        header('Location: Categories');
    } else {
      
        echo 'Invalid request method.';
    }
}

}
