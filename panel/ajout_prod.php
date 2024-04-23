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
    
    if (isset($_POST['numeroproduit']) && isset($_POST['description']) && isset($_POST['prix']) && isset($_POST['dimensions'])&& isset($_POST['poids']) && isset($_POST['siret_f'])){
        $numeroproduit = $_POST['numeroproduit'];
        $description = $_POST['description'];
        $prix = $_POST['prix'];
        $dimensions = $_POST['dimensions'];
        $poids = $_POST['poids'];
        $siret_f = $_POST['siret_f'];

        $resultat = $cnx->query("INSERT INTO produits VALUES ('$numeroproduit', '$description', $prix, '$dimensions', $poids, '$siret_f');");

        if ($resultat) {
            echo "Produit ajouté avec succès";
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

    <input type="submit" value="Ajouter le produit">
</form>
<h3><a href="../panel.php">Retour au panel</a></h3>
