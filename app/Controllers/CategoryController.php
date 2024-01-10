<?php

namespace App\Controllers;

use App\Entities\Category;
use App\Models\CategoryModel;



class CategoryController
{
    private $categoryModel;

    public function __construct()
    {
        $this->categoryModel = new CategoryModel();
    }



    public function index()
    {

        $categories = $this->categoryModel->getAll();
      
        require_once"../../views/Admin/Categories.php";
    }

    public function getaddCategory()
    {
        require_once"../../views/Admin/Categories/add.php";
    }

    public function getupdateCategory()
    {
        $categoryId = $_GET['id'];
        
       
        $existingCategory = $this->categoryModel->getById($categoryId);
        

        require_once"../../views/Admin/Categories/update.php";
    }

   

    public function addCategory()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_POST['id'];
        $name = $_POST['name'];

        
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
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        
        $categoryId = $_POST['category_id'];
       
        $existingCategory = $this->categoryModel->getById($categoryId);

        if (!$existingCategory) {
            echo 'Category not found.';
            return;
        }

        $name = $_POST['name'];

        // Specify the directory
        $uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/WIKI/public/img/';

        // Create the directory if it doesn't exist
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        // Specify the destination file
        $uploadFile = $uploadDir . basename($_FILES['picture']['name']);

        // Move the uploaded file to the destination
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
