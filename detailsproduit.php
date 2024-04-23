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

</br>

<?php

include("include/connexion.inc.php");

$produit = $_GET['produit'];

$results = $cnx->query("SELECT description, prix FROM produits WHERE numeroproduit = '".$produit."'");
$ligne = $results->fetch(PDO::FETCH_OBJ);
echo $ligne->description."</br>";
echo $ligne->prix." euros</br>";
echo "<a href=\"ajouterpanier.php?produit=".$produit."\">"."Ajouter au panier"."</a>"."</br>";
$results->closeCursor();

echo "<h2>Magasins disposant du produit ".$ligne->description." :</h2>";
$results = $cnx->query("SELECT adresse FROM point_de_vente JOIN possède ON point_de_vente.numeropdv = possède.numeropdv WHERE possède.numeroproduit = '".$produit."'");
while ($ligne = $results->fetch(PDO::FETCH_OBJ)) {
    echo $ligne->adresse."</br></br>";
}
$results->closeCursor();
?>

</body>
</html>
