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
    if (!(isset($_COOKIE['login'] ) && isset($_COOKIE['mdp']))) {
        header('location: ../authentification.php');
    }

    include('../include/connexion.inc.php');

    $resultat = $cnx->query("SELECT niveau FROM client WHERE email='".$_COOKIE['login']."' AND mdp='".$_COOKIE['mdp']."'");
    $niveau=$resultat->fetch(PDO::FETCH_OBJ)->niveau;
    if ($niveau < 3) {
        header("location: ../accueil.php");
    }
    else {
        if (isset($_GET["magasin"])) {
            $magasin = $_GET["magasin"];
            echo "<h1>Modifier les possessions du magasin ".$magasin."</h1>";
            echo "<h2>Possessions actuelles</h2>";
            $resultats_possessions = $cnx->query("SELECT numeroproduit, quantité FROM possède WHERE numeropdv = '".$magasin."'");
            
            echo "Numero produit | Quantité en stock<br>";
            while ($ligne = $resultats_possessions->fetch(PDO::FETCH_OBJ)) {
                echo "<br>".$ligne->numeroproduit." | ".$ligne->quantité;
                echo "<br><a href=supprimer_produit_mag.php?magasin=".$magasin."&produit=".$ligne->numeroproduit.">Supprimer</a><br>";
                echo "  <form method=\"get\" action=\"quantite_produit_mag.php?magasin=\".$magasin\">
                            <input type=\"radio\" name=\"magasin\" value=\"".$magasin."\" checked style=\"display:none;\">
                            <input type=\"radio\" name=\"produit\" value=\"".$ligne->numeroproduit."\" checked style=\"display:none;\">
                            <input type=\"text\" name=\"quantite\">
                            <br><input type=\"submit\" value=\"Modifier la quantité\">
                        </form>"; 
            }
            echo "<h2>Ajouter un produit</h2>";

            $resultat_produits_dispo = $cnx->query("SELECT numeroproduit, description FROM produits");
            echo "
            <form method=\"get\" action=\"ajout_produit_mag.php\">
                <select name=\"produit\">";
                while ($ligne_dispos = $resultat_produits_dispo->fetch(PDO::FETCH_OBJ)) {
                    echo "<option value=".$ligne_dispos->numeroproduit.">".$ligne_dispos->description."</option>";
                }
                echo "</select>
                <input type=\"radio\" name=\"magasin\" value=\"".$magasin."\" checked style=\"display:none;\">
                <br><input type=\"text\" name=\"quantite\">
                <br><input type=\"submit\" value=\"Ajouter le produit\">
            </form>";

            echo '<br><a href="../panel.php">Retour au panel</a>';
        }
    }
?>
</body>
</html>