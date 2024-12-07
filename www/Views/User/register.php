<?php

use App\Core\FormVerification;
use App\Controllers\Registration;
use App\Core\User;
use App\Core\SQL;

$errors = [];
$form = [];
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $form = [
        "firstName" => $_POST["firstName"],
        "lastName" => $_POST["lastName"],
        "email" => $_POST["email"],
        "country" => $_POST["country"],
        "password" => $_POST["password"],
        "confirmPassword" => $_POST["confirmPassword"]
    ];

    $sql = new SQL();
    $pdo = $sql->getPDO();
    $user = new User($pdo);
    $formVerification = new FormVerification();
    $registrationController = new Registration($formVerification, $user);

    $errors = $registrationController->handleRegistration($form);
}
?>

<h1>Inscription</h1>

<!-- Form & Errors values array - @TODO: Remove -->
<p>Form: <?php var_dump($form); ?></p>
<p>Errors: <?php var_dump($errors); ?></p>
<!--  -->

<form method="POST">
    <label for="firstName">Prénom</label>
    <input id="firstName" name="firstName" type="text" placeholder="Prénom" value="<?php echo isset($_POST['firstName']) ? $_POST['firstName'] : ''; ?>"/>
    <p><?php echo isset($errors["firstName"]) ? $errors["firstName"] : ""; ?></p>

    <label for="lastName">Nom</label>
    <input id="lastName" name="lastName" type="text" placeholder="Nom" value="<?php echo isset($_POST['lastName']) ? $_POST['lastName'] : ''; ?>">
    <p><?php echo isset($errors["lastName"]) ? $errors["lastName"] : ""; ?></p>
    
    <label for="email">Email</label>
    <input id="email" name="email" type="email" placeholder="Email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>">
    <p><?php echo isset($errors["email"]) ? $errors["email"] : ""; ?></p>

    <label for="country">Pays</label>
    <input id="country" name="country" type="text" placeholder="Pays" value="<?php echo isset($_POST['country']) ? $_POST['country'] : ''; ?>">
    <p><?php echo isset($errors["country"]) ? $errors["country"] : ""; ?></p>
    
    <label for="password">Mot de passe</label>
    <input id="password" name="password" type="password" placeholder="Mot de passe">
    <p><?php echo isset($errors["password"]) ? $errors["password"] : ""; ?></p>

    <input id="confirmPassword" name="confirmPassword" type="password" placeholder="Confirmez le mot de passe">
    <p><?php echo isset($errors["confirmPassword"]) ? $errors["confirmPassword"] : ""; ?></p>

    <input type="submit" value="S'inscrire">
</form>