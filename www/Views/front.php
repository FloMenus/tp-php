<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?= $title??"TP PHP" ?></title>
    <meta name="description" content="<?= $description??"ceci est la description de ma page" ?>">
    <link rel="stylesheet" href="/Views/Style/front.css">
</head>
<body>
    <nav class="nav">
        <a href="/">Accueil</a>
        <a href="/login">Connexion</a>
        <a href="/sinscrire">Inscription</a>
    </nav>
    <?php include "../Views/".$this->v; ?>
</body>
</html>