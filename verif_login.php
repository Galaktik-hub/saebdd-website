<?php
if (!(isset($_POST['login']) && isset($_POST['mdp']))) { /* Vérification que l'on passe bien par la page de formulaire */
    header('location: authentification.php');
}

include('include/connexion.inc.php');

if (isset($_POST['login']) && isset($_POST['mdp'])) {
    $req = $cnx->prepare("SELECT COUNT(*) AS correct FROM client WHERE email=:login AND mdp=:mdp");
    $req->bindParam(':login', $_POST['login']);
    $req->bindParam(':mdp', $_POST['mdp']);
    $req->execute();
    $ligne=$req->fetch(PDO::FETCH_OBJ);
    if ($ligne->correct == 0) {
        header('location: authentification.php');
    } else {
        setcookie('login', $_POST['login'], time() + 60*60*24*31);
        setcookie('mdp', $_POST['mdp'], time() + 60*60*24*31);
        header('location: accueil.php');
    }
}
