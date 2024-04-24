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
    
    if (isset($_GET['modif']) && isset($_GET['email'])) {
        $modif = $_GET['modif'];
        $email = htmlspecialchars_decode($_GET['email']);
        
        if ($modif == "nom" || $modif == "prenom" || $modif == "telephone" || $modif == "niveau" || $modif == "mdp") {
            $valeur = $_GET['valeur'];
            $modification = $cnx->query('UPDATE client SET '.$modif.'=\''.$valeur.'\' WHERE email=\''.$email.'\';');
            if ($modification) {
                echo "Utilisateur modifié avec succès";
            } else {
                echo "Erreur lors de la modification de l'utilisateur</br>";
            }
        } else {
            echo "Champ invalide</br>";
        }
    }

    echo "<link rel='stylesheet' type='text/css' href='../style.css'>";

    echo "<h1>Modification de l'utilisateur ".$_GET['email']."</h1>";

    echo '<form method="GET" action="modif_user.php">';
    echo '<input type="hidden" name="email" value="'.$_GET['email'] . '">'; /* Pour passer le mail */
    echo '    <select name="modif" id="modif">';
    echo '        <option value="nom">Nom</option>';
    echo '        <option value="prenom">Prénom</option>';
    echo '        <option value="telephone">Téléphone</option>';
    echo '        <option value="niveau">Niveau</option>';
    echo '        <option value="mdp">Mot de passe</option>';
    echo '    </select>';
    echo '    <br><p>Entrez la nouvelle valeur du champ</p>';
    echo '    <input type="text" name="valeur" id="valeur" required><br><br>';
    echo '    <input type="submit" value="Modifier l\'utilisateur">';
    echo '</form>';

    echo '<h3><a href="../panel.php">Retour au panel</a></h3>';
?>