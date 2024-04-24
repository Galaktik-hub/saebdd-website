<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
    include("include/header.inc.php");
    ?>
    <h1>Création du compte</h1>

    <form action="" method="post">
        <label for="nom">Nom</label>
        <input type="text" id="nom" name="nom" required><br><br>
        <label for="prenom">Prénom</label>
        <input type="text" id="prenom" name="prenom" required><br><br>
        <label for="ville">Ville</label>
        <input type="text" id="ville" name="ville" required><br><br>
        <label for="tel">Téléphone</label>
        <input type="tel" id="tel" name="tel" required><br><br>
        <label for="email">Adresse e-mail</label>
        <input type="email" id="email" name="email" required><br><br>
        <label for="mdp">Mot de passe:</label>
        <input type="password" id="mdp" name="mdp" required><br><br>
        <input type="submit" value="S'inscrire">
    </form>

    <?php
        if (isset($_GET['state'])) {
            if ($_GET['state'] == '2') {
                echo '<p id="warning">Cette adresse e-mail est déjà utilisée.</p>';
            } elseif ($_GET['state'] == '1') {
                echo '<p id="success">Votre inscription a bien été prise en compte.</p>';
            } elseif ($_GET['state'] == '0') {
                echo '<p id="error">Veuillez renseigner tous les champs obligatoires.</p>';
            }
        }
    ?>

<?php

if (isset($_COOKIE['login']) && isset($_COOKIE['mdp'])) {
    header('location: compte.php');
}



if (isset($_POST['mdp'])) {
    include('include/connexion.inc.php');

    $req = $cnx->prepare('SELECT COUNT(*) AS total FROM client WHERE email = :email');
    $req->bindParam(':email', $_POST['email']);
    $req->execute();
    $ligne = $req->fetch(PDO::FETCH_OBJ);
    if ($ligne->total > 0) {
        header('location: inscription.php?state=2');
    }


    // TODO: Réparer la requête
    $req = $cnx->prepare('INSERT INTO client (numcli, nom, prenom, email, telephone, niveau, mdp) VALUES (DEFAULT, :nom, :prenom, :email, :tel, :niveau, :mdp);');
    $req->bindParam(':nom', $nom);
    $req->bindParam(':prenom', $prenom);
    $req->bindParam(':email', $email);
    $req->bindParam(':tel', $tel);
    $req->bindParam(':niveau', $niveau);
    $req->bindParam(':mdp', $mdp);

    $nom = trim($_POST['nom']);
    $prenom = trim($_POST['prenom']);
    $email = trim($_POST['email']);
    $tel = preg_replace('/\D/', '', $_POST['tel']); // On retire tout ce qui n'est pas un chiffre
    $niveau = 1;
    $mdp = $_POST['mdp'];

    $res = $req->execute(); 

    if ($res) {
        setcookie('login', $login, time() + 60*60*31, '/');
        setcookie('mdp', $mdp, time() + 60*60*31, '/');
        header('location: compte.php');
    } else {
        echo '<p class="error">Une erreur est survenue : ' . $cnx->errorInfo() . '</p>' ;
    }
}

?>
</body>
</html>
