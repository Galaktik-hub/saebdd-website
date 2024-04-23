<!DOCTYPE html>
<html>
<head>
</head>
<body>
	<a href="accueil.php">Accueil</a></br>
	<a href="panier.php">Panier</a></br>
    <?php
        if (isset($_COOKIE['login']) && isset($_COOKIE['mdp'])) {
            echo "<a href=\"compte.php\">Compte</a></br>";
            include('connexion.inc.php');
            $resultat = $cnx->query("SELECT niveau FROM client WHERE email='".$_COOKIE['login']."' AND mdp='".$_COOKIE['mdp']."'"); /* On vérifie que le compte a accès au panel */
            $niveau=$resultat->fetch(PDO::FETCH_OBJ)->niveau;
            if ($niveau >= 3) {
                echo "<a href=\"panel.php\">Panel</a></br>";
            }
            echo "<a href=\"deconnexion.php\">Déconnexion</a></br>";
        } else {
            echo "<a href=\"authentification.php\">Connexion</a></br>";
            echo "<a href=\"inscription.php\">Inscription</a></br>";
        }
    ?>
    <hr>
</body>
</html>