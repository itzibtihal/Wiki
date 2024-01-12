<?php
  namespace App\Controllers;

  use App\Entities\Wiki;
  use App\Models\WikiModel;
  use App\Models\UserModel;
  use App\Models\TagModel;
  use App\Models\CategoryModel;
  
  class HomeAuthorController
  {
    private $wikiModel;
    private $userModel;


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
      $this->isAuthorLoggedIn();
      $userSId= $_SESSION['userId'];
      // var_dump( $userSId);
      // $userId = 2;
      $existingUser = $this->userModel->getById($userSId);
        $userSId = $_SESSION["userId"];
        $Mywikis = $this->wikiModel->getAllWikisByUserId($userSId);
        require_once "../../views/Author/Authors.php";
    }



    
  }

?>