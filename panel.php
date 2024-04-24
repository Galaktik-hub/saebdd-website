<?php
    include("include/connexion.inc.php");

    if (!(isset($_COOKIE['login'] ) && isset($_COOKIE['mdp']))) {
        header('location: authentification.php');
    }
?>

<!DOCTYPE html>
<html>
    <head>
 
        <!-- En-tête du document Si avec l'UTF8 cela ne fonctionne pas mettez charset=ISO-8859-1 -->
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /><title>Panel administrateur</title>

        <style type="text/css">
        body {
            background-color:#ffd;
            font-family:Verdana,Helvetica,Arial,sans-serif;
        }
        </style>
    </head>

    <body>
    <?php
        include("include/header.inc.php");

        echo "<h1>Panel administrateur</h1>";

        $resultat = $cnx->query("SELECT niveau FROM client WHERE email='".$_COOKIE['login']."' AND mdp='".$_COOKIE['mdp']."'");
        $niveau=$resultat->fetch(PDO::FETCH_OBJ)->niveau;
        if ($niveau == 1 || $niveau == 2) {
            header("location: accueil.php");
        }
        echo "<h2>Section managérial</h2>";
        if ($niveau == 4) {
            echo "<h2>Section administrateur</h2>";
            echo "<h3>Liste des utilisateurs</h3>";
            echo 'Email | Nom | Prénom | Niveau<br>';
            $users = $cnx->query("SELECT * FROM client");
            while ($ligne = $users->fetch(PDO::FETCH_OBJ)) {
                echo $ligne->email." | ".$ligne->nom." | ".$ligne->prenom." | ".$ligne->niveau;
                echo "&nbsp; <a href='panel/modif_user.php?email=".$ligne->email."'>Modifier données</a> | <a href='panel/suppr_user.php?email=".$ligne->email."'>Supprimer</a><br>";
            }
            echo "<p><a href='panel/ajout_user.php'>Ajouter un utilisateur</a></p>";
            echo "<h3>Liste des produits</h3>";
            $prods = $cnx->query("SELECT * FROM produits ORDER BY numeroproduit");
            echo("Numéro | Description | Prix | Dimensions | Poids | Siret fournisseur | Catégorie<br>");
            while ($ligne = $prods->fetch(PDO::FETCH_OBJ)) {
                echo $ligne->numeroproduit." | ".$ligne->description." | ".$ligne->prix." | ".$ligne->dimensions." | ".$ligne->poids." | ".$ligne->siret_f." | ";
                $catprods = $cnx->query("SELECT description FROM appartient WHERE numeroproduit = '".$ligne->numeroproduit."'");
                $lignecat = $catprods->fetch(PDO::FETCH_OBJ);
                echo $lignecat->description;
                echo "&nbsp; <a href='panel/modif_prod.php?numeroproduit=".$ligne->numeroproduit."'>Modifier données</a> | <a href='panel/suppr_prod.php?numeroproduit=".$ligne->numeroproduit."'>Supprimer</a><br>";
            }
            echo "<p><a href='panel/ajout_prod.php'>Ajouter un produit</a></p>";
        }

        include("include/footer.inc.php");
    ?>

    </body>
</html>
