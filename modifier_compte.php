<?php

if (!(isset($_COOKIE['login'] ) && isset($_COOKIE['mdp']))) {
    header('location: authentification.php');
}

// on modifie les informations dans la BDD et les cookies puis on retourne à la page compte.php

include('include/connexion.inc.php');
if (!(isset($_POST['login']) && isset($_POST['mdp']))) {
    header('location: compte.php?state=0');
}

$login = $_POST['login'];
$mdp = $_POST['mdp'];

$req = $cnx->prepare("UPDATE client SET email = :login, mdp = :mdp WHERE email = :old_login AND mdp = :old_mdp");
$req->bindParam(':login', $login);
$req->bindParam(':mdp', $mdp);
$req->bindParam(':old_login', $_COOKIE['login']);
$req->bindParam(':old_mdp', $_COOKIE['mdp']);
$res = $req->execute();

if ($res) {
    setcookie('login', $login, time() + 60*60*31);
    setcookie('mdp', $mdp, time() + 60*60*31);
    
    header('location: compte.php?state=1');
} else {
    header('location: compte.php?state=0');
}

?>