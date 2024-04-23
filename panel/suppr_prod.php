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

    if (isset($_GET['numeroproduit']) && isset($_GET['confirmation'])) {
        $numeroproduit = $_GET['numeroproduit'];

        $suppression = $cnx->query('DELETE FROM produits WHERE numeroproduit=\''.$numeroproduit.'\';');

        if ($suppression) {
            echo "Produit supprimé avec succès";
        } else {
            echo "Erreur lors de la suppression du produit";
        }

    } else if (isset($_GET['numeroproduit'])) {
        $numeroproduit = $_GET['numeroproduit'];
        echo "Voulez-vous vraiment supprimer le produit ".$numeroproduit." ?<br>";
        echo "<a href='suppr_prod.php?numeroproduit=".$numeroproduit."&confirmation=oui'>Oui</a> | <a href='../panel.php'>Non</a>";
    } else {
        header('location: ../panel.php');
    }

    echo '<h3><a href="../panel.php">Retour au panel</a></h3>';
?>