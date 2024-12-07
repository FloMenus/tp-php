<?php

use App\Core\FormVerification;
use App\Controllers\Login;
use App\Core\User;
use App\Core\SQL;

$errors = [];
$form = [];
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $form = [
        "email" => $_POST["email"],
        "password" => $_POST["password"],
    ];

    $sql = new SQL();
    $pdo = $sql->getPDO();
    $user = new User($pdo);
    $formVerification = new FormVerification();
    $loginController = new Login($formVerification, $user);

    $errors = $loginController->handleLogin($form);
}
?>

<h1>Connexion</h1>

<form method="POST">
    <label for="email">Email</label>
    <input id="email" name="email" type="email" placeholder="Email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>">
    <p><?php echo isset($errors["email"]) ? $errors["email"] : ""; ?></p>

    <label for="password">Mot de passe</label>
    <input id="password" name="password" type="password" placeholder="Mot de passe">
    <p><?php echo isset($errors["password"]) ? $errors["password"] : ""; ?></p>

    <p><?php echo isset($errors["db"]) ? $errors["db"] : ""; ?></p>
    <input type="submit" value="Connexion">
</form>