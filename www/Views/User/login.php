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
<link rel="stylesheet" href="/Views/Style/login.css">
<h1>Connexion</h1>

<form class="login-form" method="POST">
    <div class="login-field">
        <label for="email">Email</label>
        <input id="email" name="email" type="email" placeholder="Email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>">
        <p class="error-message"><?php echo isset($errors["email"]) ? $errors["email"] : ""; ?></p>
    </div>

    <div class="login-field">
        <label for="password">Mot de passe</label>
        <input id="password" name="password" type="password" placeholder="Mot de passe">
        <p class="error-message"><?php echo isset($errors["password"]) ? $errors["password"] : ""; ?></p>
    </div>

    <p class="error-message-db"><?php echo isset($errors["db"]) ? $errors["db"] : ""; ?></p>
    <input class="submit-btn" type="submit" value="Connexion">
</form>