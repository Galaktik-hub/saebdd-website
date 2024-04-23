<?php
if (!(isset($_COOKIE['login']) && isset($_COOKIE['mdp']))) {
    header('location: authentification.php');
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon compte</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
    include("include/header.inc.php");
    include('include/connexion.inc.php');
    ?>
    <h1>Mon compte</h1>

    <form action="modifier_compte.php" method="post">
        <label for="login">Adresse e-mail</label>
        <input type="text" id="login" name="login" value="<?php echo $_COOKIE['login']; ?>"><br><br>
        <label for="mdp">Nouveau mot de passe:</label>
        <input type="password" id="mdp" name="mdp"><br><br>
        <input type="submit" value="Enregistrer les modifications">
    </form>

    <?php
        if (isset($_GET['state'])) {
            if ($_GET['state'] == '1') {
                echo '<p id="success">Vos modifications ont bien &eacute;t&eacute; prises en compte.</p>';
            } else if ($_GET['state'] == '0') {
                echo '<p id="error">Veuillez renseigner tous les champs.</p>';
            }
        }
    ?>
</body>
</html>
