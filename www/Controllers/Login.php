<?php

namespace App\Controllers;

class Login {
    private $formVerification;
    private $user;

    public function __construct($formVerification, $user) {
        $this->formVerification = $formVerification;
        $this->user = $user;
    }

    public function handleLogin($form) {
        // Validate form data

        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $errors = $this->formVerification->checkLoginForm($form);

        if (!empty($errors)) {
            return $errors;
        }

        // Get user from the database
        try {
            $userFromDb = $this->user->getUserByEmail($form['email']);
            /* var_dump($userFromDb); */

            // Check if the user exists and if the password is correct
            if (!$userFromDb || !password_verify($form['password'], $userFromDb['password'])) {
                $errors['db'] = "Email ou mot de passe incorrect, vérifiez vos informations.";
                return $errors;
            }
        } catch (PDOException $e) {
            $errors['db'] = "Erreur interne: " . $e->getMessage();
            return $errors;
        }

        $_SESSION['user'] = [
            'firstName' => $userFromDb['firstName'],
            'lastName' => $userFromDb['lastName']
        ];

        // Redirect to login page
        header("Location: /");
        exit;
    }
}