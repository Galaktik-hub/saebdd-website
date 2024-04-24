<?php

if (isset($_POST['mdp'])) {
    include('include/connexion.inc.php');

    $req = $cnx->prepare('SELECT COUNT(*) AS total FROM client WHERE email = :email');
    $req->bindParam(':email', $_POST['email']);
    $req->execute();
    $ligne = $req->fetch(PDO::FETCH_OBJ);
    if ($ligne->total > 0) {
        header('location: inscription.php?state=2');
    }

    $req = $cnx->prepare('INSERT INTO client (nom, prenom, email, telephone, niveau, mdp) VALUES (:nom, :prenom, :email, :tel, :niveau, :mdp);');
    $req->bindParam(':nom', $nom);
    $req->bindParam(':prenom', $prenom);
    $req->bindParam(':email', $email);
    $req->bindParam(':tel', $tel);
    $req->bindParam(':niveau', $niveau);
    $req->bindParam(':mdp', $mdp);

    $nom = trim($_POST['nom']);
    $prenom = trim($_POST['prenom']);
    $email = trim($_POST['email']);
    $tel = preg_replace('/\D/', '', $_POST['tel']); // On retire tout ce qui n'est pas un chiffre pour stocker le tel
    $niveau = 1;
    $mdp = $_POST['mdp'];

    $res = $req->execute();

    if ($res) {
        setcookie('login', $login, time() + 60*60*31, '/');
        setcookie('mdp', $mdp, time() + 60*60*31, '/');
        header('location: compte.php');
    } else {
        $message = $req->errorInfo()[2];
        $message = str_replace(array("\r", "\n"), '', $message);
        header('location: inscription.php?state=0&error=' . $message);
    }
}

?>
