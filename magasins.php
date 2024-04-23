<!DOCTYPE html>
<html>
 <head>
 
	<!-- En-tête du document Si avec l'UTF8 cela ne fonctionne pas mettez charset=ISO-8859-1 -->
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /><title>SAE BDD</title>

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
?>

<?php

include("include/connexion.inc.php");

$categorie = $_GET['categorie'];

echo "<h2>"."Produits de la catégorie ".$categorie." disponibles par magasins</h2><a href=\"produits.php?categorie=".$categorie."\">Voir disponibilités en ligne</a></br></br>";

$cnx->exec("SET search_path TO sae2");
$results = $cnx->query("SELECT adresse, numeropdv FROM point_de_vente");

while ($ligne = $results->fetch(PDO::FETCH_OBJ)) {
    echo "<a href=\"produitsmagasin.php?magasin=".$ligne->numeropdv."&categorie=".$categorie."\">".$ligne->adresse."</br></br>";
}
$results->closeCursor();
?>

</body>
</html>
