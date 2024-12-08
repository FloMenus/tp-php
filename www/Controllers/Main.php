<?php

namespace App\Controllers;

use App\Core\View;

class Main
{

    public function home():void
    {

        if(session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $connectedUser = isset($_SESSION['user'])
            ? "{$_SESSION['user']['firstName']} {$_SESSION['user']['lastName']}"
            : "Guest";

        $view = new View("Main/home.php");
        $view->addData("connectedUser", $connectedUser);
    }

}