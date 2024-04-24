<?php

if (isset($_GET["produit"])) {
	$oldcart = unserialize($_COOKIE["panier"]);
	$cart = [];
	$produit = $_GET["produit"];
	foreach ($oldcart as $elt) { // Supprime les occurrences du produit à supprimer, changer pour ne supprimer que la première occurrence
		if ($elt != $produit) {
			$cart[] = $elt;
		}
		else {
			$produit = null; // Afin de ne pas supprimer plusieurs fois le même produit
		}
	}
	if (count($cart) > 0) {
		setcookie("panier", serialize($cart), time() + 60*60*24*30);
		header('location: panier.php');
	}
	else {
		setcookie("panier", serialize($cart), time() - 60*60);
		header('location: panier.php');
	}
}
else {
	header('location: panier.php');
}

?>
