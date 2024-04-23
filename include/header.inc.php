<!DOCTYPE html>
<html>
<head>
</head>
<body>
	<a href="accueil.php">Accueil</a></br>
	<a href="panier.php">Panier</a></br>
    <?php
        if (isset($_COOKIE['login'])) {
            echo "<a href=\"deconnexion.php\">Déconnexion</a>";
        } else {
            echo "<a href=\"authentification.php\">Connexion</a>";
        }
    ?>
</body>
</html>