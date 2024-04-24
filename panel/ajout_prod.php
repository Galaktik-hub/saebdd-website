<?php
    if (!(isset($_COOKIE['login'] ) && isset($_COOKIE['mdp']))) {
        header('location: ../authentification.php');
    }

    include('../include/connexion.inc.php');

    $resultat = $cnx->query("SELECT niveau FROM client WHERE email='".$_COOKIE['login']."' AND mdp='".$_COOKIE['mdp']."'");
    $niveau=$resultat->fetch(PDO::FETCH_OBJ)->niveau;
    if ($niveau != 4) {
        header("location: ../accueil.php");
    }
    
    if (isset($_POST['numeroproduit']) && isset($_POST['description']) && isset($_POST['prix']) && isset($_POST['dimensions'])&& isset($_POST['poids']) && isset($_POST['siret_f']) && isset($_POST['categorie'])) {
        $numeroproduit = $_POST['numeroproduit'];
        $description = $_POST['description'];
        $prix = $_POST['prix'];
        $dimensions = $_POST['dimensions'];
        $poids = $_POST['poids'];
        $siret_f = $_POST['siret_f'];
        $categorie = $_POST['categorie'];

        $resultat = $cnx->query("INSERT INTO produits VALUES ('$numeroproduit', '$description', $prix, '$dimensions', $poids, '$siret_f');");
        $resultat_cat = $cnx->query("INSERT INTO appartient VALUES ($numeroproduit, '$categorie');");

        if ($resultat) {
            echo "Produit ajouté avec succès</br>";
            if ($resultat_cat) {
                echo "Produit lié à la catégorie ".$categorie;
            }
            else {
                echo "Erreur lors de la liason avec la catégorie ".$categorie;
            }
        } else {
            echo "Erreur lors de l'ajout du produit";
        }
    }
    echo "<link rel='stylesheet' type='text/css' href='../style.css'>";
?>

<form method="POST" action="ajout_prod.php">
    <label for="numeroproduit">Numéro du produit:</label>
    <input type="text" name="numeroproduit" id="numeroproduit" required><br>

    <label for="description">Description:</label>
    <input type="text" name="description" id="description" required><br>

    <label for="prix">Prix:</label>
    <input type="text" name="prix" id="prix" required><br>

    <label for="dimensions">Dimensions:</label>
    <input type="text" name="dimensions" id="dimensions" required><br>

    <label for="poids">Poids:</label>
    <input type="text" name="poids" id="poids" required><br>

    <label for="siret_f">Siret fournisseur:</label>
    <input type="text" name="siret_f" id="siret_f" required><br>

    <label for="categorie">Catégorie:</label>
	<select name="categorie">
		<option disabled selected hidden>Choisir catégorie...</option>
		<?php
		$results = $cnx->query("SELECT description FROM catégorie");
		while ($ligne = $results->fetch(PDO::FETCH_OBJ)) {
			?> <option value="<?php echo $ligne->description ?>"> <?php echo $ligne->description; } ?> </option>
	</select>

    </br></br>
    <input type="submit" value="Ajouter le produit">
</form>
<h3><a href="../panel.php">Retour au panel</a></h3>
