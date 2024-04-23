<!DOCTYPE html>
<html>
 <head>
 
	<!-- En-tête du document Si avec l'UTF8 cela ne fonctionne pas mettez charset=ISO-8859-1 -->
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /><title>Test de connexion</title>

	<style type="text/css">
body {
	background-color:#ffd;
	font-family:Verdana,Helvetica,Arial,sans-serif;
}
</style>
</head>

<body>
<h1>Panier</h1>

<?php

include("include/connexion.inc.php");

if (isset($_COOKIE["panier"])) {
	$cart = unserialize($_COOKIE["panier"]);

	foreach ($cart as $produit) {
		echo $produit."</br>";
	}

}
else {
	echo "Votre panier est vide";
}

?>

</body>
</html>
