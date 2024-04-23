<?php

include("include/connexion.inc.php");

if (isset($_GET["produit"])) {
	if (!(isset($_COOKIE["panier"]))) {
		$cart = [];
	}
	else {
		$cart = unserialize($_COOKIE["panier"]);
	}

	$cart[] = $_GET["produit"];
	setcookie("panier", serialize($cart), time() + 60*60*24*30);
	if (isset($_GET["categorie"])) {
		header('location: produits.php?categorie='.$_GET["categorie"]);
	}
	else {
		header('location: detailsproduit.php?produit='.$_GET["produit"]);
	}
}
else {
	header('location: accueil.php');
}

?>
