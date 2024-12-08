<?php
namespace App\Controllers;

use App\Core\User as U;
use App\Core\View;
use App\Controllers\Logout;

class User
{
    public function register(): void
    {
        $view = new View("User/register.php", "front.php");
    }

    public function login(): void
    {
        $view = new View("User/login.php", "front.php");
        //echo $view;
    }


    public function logout(): void
    {
        $logoutHandler = new Logout();
        $logoutHandler->handleLogout();
    }



}

