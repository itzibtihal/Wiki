<?php
namespace App\Controllers;

use App\Entities\Tag;
use App\Models\TagModel;

class TagController
{
    private $tagModel;

    public function __construct()
    {
        $this->tagModel = new TagModel();
    }

    public function index()
    {
        $tags = $this->tagModel->getAll();
        
        require_once "../../views/Admin/Tags.php";
    }

    public function getAddTag()
    {
        require_once "../../views/Admin/Tags/add.php";
    }

    public function getUpdateTag()
    {
        $tagId = $_GET['id'];
        $existingTag = $this->tagModel->getById($tagId);
        require_once "../../views/Admin/Tags/update.php";
    }

    public function addTag()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $label = $_POST['label'];
            $tag = new Tag($label);
            
            $this->tagModel->save($tag);

            header('Location: /WIKI/Tags');
            exit();
        }
        require "../../views/Admin/Tags/add.php";
    }

    public function updateTag()
    {
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

            header('Location: /WIKI/Tags');
            exit();
        }

        require "../../views/Admin/Tags/update.php";
    }

    public function destroyTag()
    {
        $tagId = $_GET['id'];
        $existingTag = $this->tagModel->getById($tagId);

        if (!$existingTag) {
            echo 'Tag not found.';
            return;
        }

        $this->tagModel->delete($existingTag);
        header('Location: /WIKI/Tags');
    }
}

