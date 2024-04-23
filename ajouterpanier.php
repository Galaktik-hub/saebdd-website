<?php

include("include/connexion.inc.php");

if (isset($_GET["produit"])) {
	if (!(isset($_COOKIE["panier"]))) {
		$cart = [];
		$cart[] = $_GET["produit"];
		setcookie("panier", serialize($cart), time() + 60*60*24*30);
		header('location: produits.php?categorie='.$_GET["categorie"]);
	}
	else {
		$cart = unserialize($_COOKIE["panier"]);
		$cart[] = $_GET["produit"];
		setcookie("panier", serialize($cart), time() + 60*60*24*30);
		header('location: produits.php?categorie='.$_GET["categorie"]);
	}
}
else {
	header('location: accueil.php');
}

?>