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
    
    if (isset($_GET['modif']) && isset($_GET['numeroproduit'])) { // Modification produit
        $modif = $_GET['modif'];
        $numeroproduit = $_GET['numeroproduit'];
        
        if ($modif == "description" || $modif == "prix" || $modif == "dimensions" || $modif == "poids" || $modif == "siret_f") {
            $valeur = $_GET['valeur'];
            $modification = $cnx->query('UPDATE produits SET '.$modif.'=\''.$valeur.'\' WHERE numeroproduit=\''.$numeroproduit.'\';');
            if ($modification) {
                echo "Produit modifié avec succès</br>";

            } else {
                echo "Erreur lors de la modification du produit </br>";
            }
        } else {
            echo "Champ invalide</br>";
        }
    }

    if (isset($_GET['categorie'])) { // Modification catégorie
        $newcat = $_GET['categorie'];
        $modification_cat = $cnx->exec("UPDATE appartient SET description = '".$newcat."' WHERE numeroproduit = '".$numeroproduit."'");
        
        if ($modification_cat) {
            echo "Catégorie modifiée avec succès (".$newcat.")</br>";
        }
        else {
            echo "La modification de la catégorie du produit a échouée (".$newcat.")</br>";
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
    echo '    <br><p>Entrez la nouvelle valeur du champ</p>';
    echo '    <input type="text" name="valeur" id="valeur"><br><br>';
    ?>
            <select name="categorie">
                <option disabled selected hidden>Changer catégorie...</option>
                <?php
                $results = $cnx->query("SELECT description FROM catégorie");
                while ($ligne = $results->fetch(PDO::FETCH_OBJ)) {
                    ?> <option value="<?php echo $ligne->description ?>"> <?php echo $ligne->description; } ?> </option>
            </select>
    <?php
    echo '</br></br><input type="submit" value="Modifier le produit">';
    echo '</form>';

    echo '<h3><a href="../panel.php">Retour au panel</a></h3>';
?>