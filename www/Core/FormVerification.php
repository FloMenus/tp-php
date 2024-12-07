<?php

namespace App\Core;

class FormVerification
{
    public function checkRegistrationForm(array $form): array
    {
        $errors = [];

        // Sanitize email
        $form["email"] = strtolower(trim($form["email"]));

        // Check if email is valid
        if(!filter_var($form["email"], FILTER_VALIDATE_EMAIL)){
            $errors["email"] = "L'email n'est pas valide";
        }

        // Check first name and last name length
        if(strlen($form["firstName"]) < 2 || strlen($form["firstName"]) > 50){
            $errors["firstName"] = "Le prénom doit contenir entre 2 et 50 caractères";
        }
        if(strlen($form["lastName"]) < 2 || strlen($form["lastName"]) > 50){
            $errors["lastName"] = "Le nom doit contenir entre 2 et 50 caractères";
        }

         // Check country length 
         // @TODO: Adapt to have iso code ?
         if(strlen($form["country"]) < 2 || strlen($form["country"]) > 25){
            $errors["country"] = "Le pays doit contenir entre 2 et 50 caractères";
        }

        // Check password with regex (8-16 characters, 1 uppercase, 1 lowercase, 1 number)
        // Weirdly, the message is always displayed, even if the password is correct
        // I put this var_dump to check the password value during the test
        // var_dump($form["password"]);
        // if(!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[A-Za-z\d]{8,16}$/", $form["password"])){
        //     $errors["password"] = "Le mot de passe doit contenir entre 8 et 16 caractères, une majuscule, une minuscule et un chiffre";
        // }

        // Check if password and confirm password are the same
        if($form["password"] !== $form["confirmPassword"]){
            $errors["confirmPassword"] = "Les mots de passe ne correspondent pas";
        }

        // Check if fields are not empty
        foreach($form as $key => $value){
            if(!isset($value) || empty($value)){
                $errors[$key] = "Veuillez compléter le champ";
            }
        }

        return $errors;
    }
    
    public function checkLoginForm(array $form): array
    {
        $errors = [];

        // Sanitize email
        $form["email"] = strtolower(trim($form["email"]));

        // Check if email is valid
        if(!filter_var($form["email"], FILTER_VALIDATE_EMAIL)){
            $errors["email"] = "L'email n'est pas valide";
        }

        // Check if fields are not empty
        foreach($form as $key => $value){
            if(!isset($value) || empty($value)){
                $errors[$key] = "Veuillez compléter le champ";
            }
        }

        return $errors;
    }
}
?>