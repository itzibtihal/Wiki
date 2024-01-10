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


    public function __construct()
    {
        $this->wikiModel = new WikiModel();
    }


    public function index()
    {
        $userId=2;
        $Mywikis = $this->wikiModel->getAllWikisByUserId($userId);
        require_once "../../views/Author/Authors.php";
    }



    
  }

?>