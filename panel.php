<?php
    include("include/connexion.inc.php");
    $cnx->exec("SET search_path TO sae2");

    if (!(isset($_COOKIE['login']))) {
        header('location: authentification.php');
    }
?>

<!DOCTYPE html>
<html>
    <head>
 
        <!-- En-tête du document Si avec l'UTF8 cela ne fonctionne pas mettez charset=ISO-8859-1 -->
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /><title>Test de connexion</title>

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

    ?>

    <h2>Produits à la une</h2>

    <?php
        include("include/footer.inc.php");
    ?>

    </body>
</html>
