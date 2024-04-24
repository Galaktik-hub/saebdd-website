<?php

if (isset($_GET["produit"])) {
	if (!(isset($_COOKIE["panier"]))) {
		$cart = [];
	}
	else {
		$cart = unserialize($_COOKIE["panier"]);
	}

	$cart[] = $_GET["produit"];
	setcookie("panier", serialize($cart), time() + 60*60*24*30);
	header('Location: ' . $_SERVER['HTTP_REFERER']);
}
else {
	header('location: accueil.php');
}

?>
