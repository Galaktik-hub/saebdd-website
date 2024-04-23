<?php
    include("include/connexion.inc.php");
    $cnx->exec("SET search_path TO sae2");

    if (!(isset($_COOKIE['login'] ) && isset($_COOKIE['mdp']))) {
        header('location: authentification.php');
    }

    $resultat=$cnx->query("SELECT COUNT(*) AS correct FROM authentification WHERE mail='".$_COOKIE['login']."' AND mdp='".$_COOKIE['mdp']."'");
    if ($resultat->fetch(PDO::FETCH_OBJ)->correct == 0) {
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
    <h1>Panel administrateur</h1>

    <?php
        $resultat = $cnx->query("SELECT ");
    ?>

    <?php
        include("include/footer.inc.php");
    ?>

    </body>
</html>
