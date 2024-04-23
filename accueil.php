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
<h1>Accueil</h1>

<h2>Catégories</h2>

<?php

include("include/connexion.inc.php");

$cnx->exec("SET search_path TO sae2");
$results = $cnx->query("SELECT description FROM catégorie");


while ($ligne = $results->fetch(PDO::FETCH_OBJ)) {
    echo "<a href=\"produits.php?categorie=".$ligne->description."\">".$ligne->description."</a>"."</br>";
	// Fabrique le lien pour la page produit, met le nom de la catégorie dans la variable get "categorie"
}
$results->closeCursor();
?>

<h2>Produits à la une</h2>

</body>
</html>
