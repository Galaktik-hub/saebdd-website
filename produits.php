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

echo "<h2>"."Produits de la catégorie ".$categorie." disponibles en ligne</h2><a href=\"magasins.php?categorie=".$categorie."\">Voir disponibilités par magasins</a></br></br>";

$cnx->exec("SET search_path TO sae2");
$results = $cnx->query("SELECT produits.numeroproduit, produits.description, produits.prix FROM produits JOIN appartient ON produits.numeroproduit = appartient.numeroproduit WHERE appartient.description = '".$categorie."'");

while ($ligne = $results->fetch(PDO::FETCH_OBJ)) {
    echo "<a href=\"detailsproduit.php?produit=".$ligne->numeroproduit."\">".$ligne->description."</a></br>";
	echo $ligne->prix." euros</br>";
	echo "<a href=\"ajouterpanier.php?produit=".$ligne->numeroproduit."&categorie=".$categorie."\">"."Ajouter au panier"."</a>"."</br></br>";
}
$results->closeCursor();
?>

</body>
</html>
