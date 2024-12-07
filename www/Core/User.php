<?php

namespace App\Core;
class User
{
private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function isLogged():bool
    {
        return false;
    }

    public function logout():void
    {
        session_destroy();
    }

    public function createUser($userData) {
        $action = $this->pdo->prepare("
            INSERT INTO users (firstName, lastName, email, country, password)
            VALUES (:firstName, :lastName, :email, :country, :password)
        ");

        $action->execute([
            ':firstName' => $userData['firstName'],
            ':lastName' => $userData['lastName'],
            ':email' => $userData['email'],
            ':country' => $userData['country'],
            ':password' => $userData['password']
        ]);
    }

}