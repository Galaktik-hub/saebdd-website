<?php
session_start();

if (!(isset($_SESSION['login']) && isset($_SESSION['mdp']))) { /* Vérification de l'existence d'un login et d'un mdp, sinon retour à la page d'authentification */
    header('location: authentification.php');
}

include('include/connexion.inc.php');

if (isset($_POST['login']) && isset($_POST['mdp'])) {
    $login=$_POST['login'];
    $mdp=$_POST['mdp'];
    $resultat=$cnx->query("SELECT COUNT(*) AS correct FROM authentification WHERE email='$login'");
    $ligne=$resultat->fetch(PDO::FETCH_OBJ);
    if ($ligne->correct == 0) {
        header('location: authentification.php?errlog=1');
    } else {
        $resultat=$cnx->query("SELECT COUNT(*) AS correct FROM authentification WHERE email='$login' AND mdp='$mdp'");
        $ligne=$resultat->fetch(PDO::FETCH_OBJ);
        if ($ligne->correct == 0) {
            header('location: authentification.php?errmdp=1');
        } else {
            $_COOKIE['login']=$login;
            $_COOKIE['mdp']=$mdp;
            header('location: authentification.php');
        }
    }
}
?>