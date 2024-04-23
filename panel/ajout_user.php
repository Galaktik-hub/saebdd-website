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
    
    if (isset($_POST['email']) && isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['telephone']) && isset($_POST['niveau']) && isset($_POST['mdp'])) {
        $email = $_POST['email'];
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $telephone = $_POST['telephone'];
        $niveau = $_POST['niveau'];
        $mdp = $_POST['mdp'];

        $resultat = $cnx->query("INSERT INTO client VALUES ('$nom', '$prenom', '$email', '$telephone', $niveau, '$mdp')");

        if ($resultat) {
            echo "Utilisateur ajouté avec succès";
        } else {
            echo "Erreur lors de l'ajout de l'utilisateur";
        }
    }
    echo "<link rel='stylesheet' type='text/css' href='../style.css'>";
?>

<form method="POST" action="ajout_user.php">
    <label for="email">Email:</label>
    <input type="email" name="email" id="email" required><br>

    <label for="nom">Nom:</label>
    <input type="text" name="nom" id="nom" required><br>

    <label for="prenom">Prénom:</label>
    <input type="text" name="prenom" id="prenom" required><br>

    <label for="telephone">Téléphone:</label>
    <input type="tel" name="telephone" id="telephone" required><br>

    <label for="niveau">Niveau:</label>
    <input type="text" name="niveau" id="niveau" required><br>

    <label for="mdp">Mot de passe:</label>
    <input type="password" name="mdp" id="mdp" required><br>

    <input type="submit" value="Ajouter l'utilisateur">
</form>
<h3><a href="../panel.php">Retour au panel</a></h3>
