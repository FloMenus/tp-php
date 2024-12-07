<?php

namespace App\Controllers;

class Registration {
    private $formVerification;
    private $user;

    public function __construct($formVerification, $user) {
        $this->formVerification = $formVerification;
        $this->user = $user;
    }

    public function handleRegistration($form) {
        // Validate form data
        $errors = $this->formVerification->checkForm($form);

        if (!empty($errors)) {
            return $errors;
        }

        // Hash the password
        $form['password'] = password_hash($form['password'], PASSWORD_BCRYPT);

        // Insert user into the database
        try {
            $this->user->createUser($form);
        } catch (PDOException $e) {
            $errors['db'] = "Database error: " . $e->getMessage();
            return $errors;
        }

        // Redirect to login page
        header("Location: login.php");
        exit;
    }
}
