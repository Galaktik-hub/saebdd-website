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

<?php

include("connexion.inc.php");

$categorie = $_GET['categorie'];

echo "<h2>"."Produits de la catégorie ".$categorie."</br></h2>";

$cnx->exec("SET search_path TO sae2");
$results = $cnx->query(" SELECT produits.description, produits.prix FROM produits JOIN appartient ON produits.numeroproduit = appartient.numeroproduit WHERE appartient.description = '".$categorie."';");

while ($ligne = $results->fetch(PDO::FETCH_OBJ)) {
    echo $ligne->description."\t".$ligne->prix."</br>";
}
$results->closeCursor();
?>

</body>
</html>
