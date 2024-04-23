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
    
    if (isset($_GET['modif']) && isset($_GET['numeroproduit'])) {
        $modif = $_GET['modif'];
        $numeroproduit = $_GET['numeroproduit'];
        
        if ($modif == "description" || $modif == "prix" || $modif == "dimensions" || $modif == "poids" || $modif == "siret_f") {
            $valeur = $_GET['valeur'];
            $modification = $cnx->query('UPDATE produits SET '.$modif.'=\''.$valeur.'\' WHERE numeroproduit=\''.$numeroproduit.'\';');
            if ($modification) {
                echo "Produit modifié avec succès";
            } else {
                echo "Erreur lors de la modification du produit </br>";
            }
        } else {
            echo "Champ invalide</br>";
        }
    }

    echo "<link rel='stylesheet' type='text/css' href='../style.css'>";

    echo "<h1>Modification du produit ".$_GET['numeroproduit']."</h1>";

    echo '<form method="GET" action="modif_prod.php">';
    echo '<input type="hidden" name="numeroproduit" value="'.$_GET['numeroproduit'] . '">'; /* Pour passer le numéro du produit */
    echo '    <select name="modif" id="modif">';
    echo '        <option value="description">Description</option>';
    echo '        <option value="prix">Prix</option>';
    echo '        <option value="dimensions">Dimensions</option>';
    echo '        <option value="poids">Poids</option>';
    echo '        <option value="siret_f">Siret fournisseur</option>';
    echo '    </select>';
    echo '    <input type="text" name="valeur" id="valeur" required><br>';
    echo '    <input type="submit" value="Modifier le produit">';
    echo '</form>';

    echo '<h3><a href="../panel.php">Retour au panel</a></h3>';
?>