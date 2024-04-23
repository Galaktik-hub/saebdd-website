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
            $users = $cnx->query("SELECT * FROM client");
            while ($ligne = $users->fetch(PDO::FETCH_OBJ)) {
                echo $ligne->email." | ".$ligne->nom." | ".$ligne->prenom." | ".$ligne->niveau."<br />";
            }
        }

        include("include/footer.inc.php");
    ?>

    </body>
</html>
