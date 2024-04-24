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
        if (isset($_GET["magasin"]) && isset($_GET["produit"]) && isset($_GET["quantite"])) {
            $magasin = $_GET["magasin"];
            $produit = $_GET["produit"];
            $quantite = $_GET["quantite"];
            $res = $cnx->exec("UPDATE possède SET quantité = '".$quantite."' WHERE numeropdv = '".$magasin."' AND numeroproduit = '".$produit."'");
            header('Location: '.$_SERVER['HTTP_REFERER']);
        }
    }
?>
</body>
</html>