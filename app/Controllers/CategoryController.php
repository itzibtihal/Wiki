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
        $name = $_POST['name'];

        
        $uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/WIKI/public/img/';
        $uploadFile = $uploadDir . basename($_FILES['picture']['name']);

        
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        if (move_uploaded_file($_FILES['picture']['tmp_name'], $uploadFile)) {
            $category = new Category($name, $_FILES['picture']['name']);
            
            
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
        var_dump($existingCategory);

         if (!$existingCategory) {
            echo 'Category not found.';
            return;
        }

        
        $name = $_POST['name'];

       
        $uploadDir = '/WIKI/public/img/';
        $uploadFile = $uploadDir . basename($_FILES['picture']['name']);

        if (move_uploaded_file($_FILES['picture']['tmp_name'], $uploadFile)) {
            
            $existingCategory->setName($name);
            $existingCategory->setPicture($_FILES['picture']['name']);

           
            $this->categoryModel->update($existingCategory);

            header('Location: /WIKI/Categories');
            exit();
        } else {
            echo 'Failed to upload image.';
        }
    }

     

    require "../../views/Admin/Categories/update.php"; 
}

































    public function show($id)
    {
        // Display details of a specific category
        $category = $this->categoryModel->getById($id);
        // Your code to display category details in the view
    }

    public function create()
    {
        // Display a form to create a new category
        // Your code to display the form in the view
    }

    public function store()
    {
        // Store a new category in the database
        $categoryData = [
            'name' => $_POST['name'],  // Assuming you have a form field with name attribute 'name'
            'picture' => $_POST['picture'],  // Assuming you have a form field with name attribute 'picture'
        ];

        $category = new Category($categoryData['name'], $categoryData['picture']);
        $this->categoryModel->save($category);

        // Redirect to the index page or show a success message
    }

    public function edit($id)
    {
        // Display a form to edit an existing category
        $category = $this->categoryModel->getById($id);
        // Your code to display the edit form with pre-filled values in the view
    }

    public function update($id)
    {
        // Update an existing category in the database
        $categoryData = [
            'name' => $_POST['name'],
            'picture' => $_POST['picture'],
        ];

        $category = new Category($categoryData['name'], $categoryData['picture']);
        $category->setId($id);
        $this->categoryModel->update($category);

        // Redirect to the index page or show a success message
    }

    public function destroy($id)
    {
        // Delete an existing category from the database
        $category = $this->categoryModel->getById($id);
        $this->categoryModel->delete($category);

        // Redirect to the index page or show a success message
        require_once"../../views/Admin/Categories.php";
    }
}
