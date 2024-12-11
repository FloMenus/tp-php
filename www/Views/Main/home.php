<link rel="stylesheet" href="/Views/Style/home.css">

<h1>Page d'accueil</h1>
 <?php (($connectedUser)) ? print("<br>Bienvenue $connectedUser") : print("<br>Bienvenue, n'hésitez pas à vous inscrire !"); ?>

 <?php $connectedUser && print (
    "<form method='POST' action='/logout'>
        <button class='disconnect-btn' type='submit'>Déconnexion</button>
    </form>");
?>