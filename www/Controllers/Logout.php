<?php

namespace App\Controllers;

class Logout {

    public function handleLogout(): void
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        session_unset();
        session_destroy();

        header("Location: /");
        exit;
    }
}