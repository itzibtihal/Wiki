<?php

namespace App\controllers;

class HomeController
{

    public function index()
    {
        echo 'hello 2b || !2b';
    }


    public function displayDate()
    {
        $currentDate = date('Y-m-d H:i:s');
        echo "Current Date and Time: $currentDate";
    }
}