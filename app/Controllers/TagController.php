<?php
namespace App\Controllers;

use App\Entities\Tag;
use App\Models\TagModel;
use App\Models\UserModel;

class TagController
{
    private $tagModel;
    private $userModel;

    public function __construct()
    {
        $this->tagModel = new TagModel();
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
        $tags = $this->tagModel->getAll();
        
        require_once "../../views/Admin/Tags.php";
    }

    public function getAddTag()
    {
        $this->isAdminLoggedIn();
        require_once "../../views/Admin/Tags/add.php";
    }

    public function getUpdateTag()
    {
        $this->isAdminLoggedIn();
        $tagId = $_GET['id'];

        $existingTag = $this->tagModel->getById($tagId);
        // var_dump($existingTag);
        require_once "../../views/Admin/Tags/update.php";
    }

    public function addTag()
    {
        $this->isAdminLoggedIn();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $label = $_POST['label'];
            $id = $_POST['id'];
            $tag = new Tag($id,$label);
            
            $this->tagModel->save($tag);

            header('Location: /WIKI/Tags');
            exit();
        }
        require "../../views/Admin/Tags/add.php";
    }

    public function updateTag()
    {
        $this->isAdminLoggedIn();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $tagId = $_POST['tag_id'];
            $existingTag = $this->tagModel->getById($tagId);
            if (!$existingTag) {
                echo 'Tag not found.';
                return;
            }

            $label = $_POST['label'];
            $existingTag->setLabel($label);

            $this->tagModel->update($existingTag);

            header('Location: Tags');
            exit();
        }

        require "../../views/Admin/Tags/update.php";
    }



    
    public function destroyTag()
{
    $this->isAdminLoggedIn();
    $tagId = isset($_POST['tag_id']) ? $_POST['tag_id'] : null;
    var_dump($tagId); 

    if ($tagId === null) {
        echo 'Tag not found.';
        return;
    }

    $existingTag = $this->tagModel->getById($tagId);

    if (!$existingTag) {
        echo 'Tag not found.';
        return;
    }

    $this->tagModel->delete($existingTag);
    header('Location: Tags');
}

    

}


