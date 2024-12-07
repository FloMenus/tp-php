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
        $errors = $this->formVerification->checkLoginForm($form);

        if (!empty($errors)) {
            return $errors;
        }

        // Hash the password
        $form['password'] = password_hash($form['password'], PASSWORD_BCRYPT);

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

        // Redirect to login page
        header("Location: /");
        exit;
    }
}