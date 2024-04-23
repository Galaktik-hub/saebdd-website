<?php
    if (!(isset($_COOKIE['login'] ) && isset($_COOKIE['mdp']))) {
        header('location: ../authentification.php');
    }

    include('../include/connexion.inc.php');

    $resultat = $cnx->query("SELECT niveau FROM client WHERE email='".$_COOKIE['login']."' AND mdp='".$_COOKIE['mdp']."'");
    $niveau=$resultat->fetch(PDO::FETCH_OBJ)->niveau;
    if ($niveau != 4) {
        header("location: ../accueil.php");
    }

    echo "<link rel='stylesheet' type='text/css' href='../style.css'>";

    if (isset($_GET['email']) && isset($_GET['confirmation'])) {
        $email = $_GET['email'];

        $suppression = $cnx->query('DELETE FROM client WHERE email=\''.$email.'\';');

        if ($suppression) {
            echo "Utilisateur supprimé avec succès";
        } else {
            echo "Erreur lors de la suppression de l'utilisateur";
        }
        
    } else if (isset($_GET['email'])) {
        $email = $_GET['email'];
        echo "Voulez-vous vraiment supprimer l'utilisateur ".$email." ?<br>";
        echo "<a href='suppr_user.php?email=".$email."&confirmation=oui'>Oui</a> | <a href='../panel.php'>Non</a>";
    } else {
        header('location: ../panel.php');
    }

    echo '<h3><a href="../panel.php">Retour au panel</a></h3>';
?>