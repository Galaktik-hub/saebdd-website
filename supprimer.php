<?php

if (isset($_GET["produit"])) {
	$oldcart = unserialize($_COOKIE["panier"]);
	$cart = [];
	foreach ($oldcart as $elt) { // Supprime les occurrences du produit à supprimer, changer pour ne supprimer que la première occurrence
		if ($elt != $_GET["produit"]) {
			$cart[] = $elt;
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
