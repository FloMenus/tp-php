<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?= $title??"TP PHP" ?></title>
    <meta name="description" content="<?= $description??"ceci est la description de ma page" ?>">
</head>
<body>
    <h1>TP PHP</h1>
    <a href="/">Accueil</a>
    <a href="/login">Connexion</a>
    <a href="/sinscrire">Inscription</a>
    <?php include "../Views/".$this->v; ?>
</body>
</html>