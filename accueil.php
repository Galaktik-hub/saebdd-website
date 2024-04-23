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
include("include/connexion.inc.php");
?>

<h1>Accueil</h1>

<h2>Recheche</h2>
<form method="get">
	<select name="produit">
		<option disables selected>Rechercher...</option>
		<?php
		$results = $cnx->query("SELECT numeroproduit, description FROM produits");
		while ($ligne = $results->fetch(PDO::FETCH_OBJ)) { // Nous mener sur la page detailsproduit du produit selectionné dans le menu, Il semblerait qu'on soit obligé d'utiliser POST, https://stackoverflow.com/questions/21524405/how-do-i-store-select-value-into-a-php-variable
			?> <option value="<?php echo $ligne->numeroproduit ?>"> <?php echo $ligne->description; } ?> </option>
	</select>
	<input type="submit" formaction=<?php echo "detailsproduit.php?produit=".$_POST["produit"] ?> value="Rechercher">
</form>

<h2>Catégories</h2>

<?php
$results = $cnx->query("SELECT description FROM catégorie");


while ($ligne = $results->fetch(PDO::FETCH_OBJ)) {
    echo "<a href=\"produits.php?categorie=".$ligne->description."\">".$ligne->description."</a>"."</br>";
	// Fabrique le lien pour la page produit, met le nom de la catégorie dans la variable get "categorie"
}
$results->closeCursor();
?>

<h2>Produits à la une</h2>

<?php
	$results = $cnx->query("SELECT numeroproduit, COUNT(*) AS nombre FROM achat GROUP BY numeroproduit ORDER BY nombre DESC LIMIT 3;");
	while ($num = $results->fetch(PDO::FETCH_OBJ)) {
		$produit = $cnx->query("SELECT produits.numeroproduit, produits.description, produits.prix FROM produits WHERE numeroproduit = '".$num->numeroproduit."'");
		while ($ligne = $produit->fetch(PDO::FETCH_OBJ)) {
			echo "<a href=\"detailsproduit.php?produit=".$ligne->numeroproduit."\">".$ligne->description."</a></br>";
			echo $ligne->prix." euros</br></br>";
		}
	}
?>

</body>
</html>
