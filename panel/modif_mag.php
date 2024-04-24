<?php
    if (!(isset($_COOKIE['login'] ) && isset($_COOKIE['mdp']))) {
        header('location: ../authentification.php');
    }

    include('../include/connexion.inc.php');

    $resultat = $cnx->query("SELECT niveau FROM client WHERE email='".$_COOKIE['login']."' AND mdp='".$_COOKIE['mdp']."'");
    $niveau=$resultat->fetch(PDO::FETCH_OBJ)->niveau;
    if ($niveau < 3) {
        header("location: ../accueil.php");
    }
    
    if (isset($_GET['modif']) && isset($_GET['magasin'])) { // Modification magasin
        $modif = $_GET['modif'];
        $magasin = $_GET['magasin'];
        
        if ($modif == "adresse" || $modif == "horaires") {
            $valeur = $_GET['valeur'];
            $modification = $cnx->query('UPDATE point_de_vente SET '.$modif.'=\''.$valeur.'\' WHERE numeropdv=\''.$magasin.'\';');
            if ($modification) {
                echo "Magasin modifié avec succès</br>";

            } else {
                echo "Erreur lors de la modification du magasin</br>";
            }
        } else {
            echo "Champ invalide</br>";
        }
    }

    echo "<link rel='stylesheet' type='text/css' href='../style.css'>";

    echo "<h1>Modification du magasin ".$_GET['magasin']."</h1>";

    echo '<form method="GET" action="modif_mag.php">';
    echo '<input type="hidden" name="magasin" value="'.$_GET['magasin'] . '">';
    echo '    <select name="modif" id="modif">';
    echo '        <option value="adresse">Adresse</option>';
    echo '        <option value="horaires">Horaires</option>';
    echo '    </select>';
    echo '    <br><p>Entrez la nouvelle valeur du champ</p>';
    echo '    <input type="text" name="valeur" id="valeur"><br><br>';
    echo '    <input type="submit" value="Modifier le magasin">';
    echo '</form>';

    echo '<h3><a href="../panel.php">Retour au panel</a></h3>';
?>