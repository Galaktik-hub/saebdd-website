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

// Si le produit est un ordinateur

$results = $cnx->query("SELECT description FROM appartient WHERE numeroproduit = '".$produit."'");
$appartient = $results->fetch(PDO::FETCH_OBJ);
echo $appartient->description;
if ($appartient->description == 'ordinateurs') {
	echo "<h2>Composants de l'ordinateur ".$ligne->description." :</h2>";

	// Trouver les produits contenu dans le produit de catégorie ordinateur (avec la table contient)
	$results = $cnx->query("SELECT numeroproduit_est_contenu FROM contient WHERE numeroproduit_contient = '".$produit."'");
	while ($produits_dans_ordinateur = $results->fetch(PDO::FETCH_OBJ)) {
		$results_2 = $cnx->query("SELECT description, prix FROM produits WHERE numeroproduit = '".$produits_dans_ordinateur->numeroproduit_est_contenu."'");
		$ligne_2 = $results_2->fetch(PDO::FETCH_OBJ);
		echo $ligne_2->description."</br>";
		echo $ligne_2->prix." euros</br>";
		echo "<a href=\"ajouterpanier.php?produit=".$produits_dans_ordinateur->numeroproduit_est_contenu."\">"."Ajouter au panier"."</a>"."</br></br>";
	}
}

echo "<h2>Magasins disposant du produit ".$ligne->description." :</h2>";
$results = $cnx->query("SELECT adresse FROM point_de_vente JOIN possède ON point_de_vente.numeropdv = possède.numeropdv WHERE possède.numeroproduit = '".$produit."'");
while ($ligne = $results->fetch(PDO::FETCH_OBJ)) {
    echo $ligne->adresse."</br></br>";
}
$results->closeCursor();
?>

</body>
</html>
