<?php
if (!(isset($_POST['login']) && isset($_POST['mdp']))) { /* Vérification que l'on passe bien par la page de formulaire */
    header('location: authentification.php');
}

include('include/connexion.inc.php');

if (isset($_POST['login']) && isset($_POST['mdp'])) {
    $login=$_POST['login'];
    $mdp=$_POST['mdp'];
    $resultat=$cnx->query("SELECT COUNT(*) AS correct FROM client WHERE email='$login' AND mdp='$mdp'");
    $ligne=$resultat->fetch(PDO::FETCH_OBJ);
    if ($ligne->correct == 0) {
        header('location: authentification.php');
    } else {
        setcookie('login', $login, time() + 60*60*31);
        setcookie('mdp', $mdp, time() + 60*60*31);
        header('location: accueil.php');
    }
}
?>