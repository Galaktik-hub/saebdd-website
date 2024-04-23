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

<h1>Panier</h1>

<?php
if (isset($_COOKIE["panier"])) {
	$cart = unserialize($_COOKIE["panier"]);

	$total = 0;

	foreach ($cart as $produit) {
		$results = $cnx->query("SELECT description, prix FROM produits WHERE numeroproduit = '".$produit."'");
		$ligne = $results->fetch(PDO::FETCH_OBJ);
		echo $ligne->description."</br>";
		echo $ligne->prix." euros</br>";
		$total += $ligne->prix;
		echo "<a href=\"supprimer.php?produit=".$produit."\">Supprimer</a></br></br>";
	}

	echo "Prix total du panier : ".$total." euros";

}
else {
	echo "Votre panier est vide</br>";
}
?>

</br>
<a href="viderpanier.php">Vider le panier</a>

</body>
</html>
