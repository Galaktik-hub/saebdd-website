<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>Formulaire de saisie de login et de mot de passe</title>
	<style type="text/css">
		body {
			background-color:#ffd;
			font-family:Verdana,Helvetica,Arial,sans-serif;
		}
	</style>
</head>

<body>
<h1>Formulaire de saisie de login et de mot de passe</h1>

<form action="verif_login.php" method="post">
	<table>
		<tr><td><label for="pseudo">Adresse e-mail</label></td><td><input type="text" name="pseudo" /></td></tr>
		<tr><td><label for="mdp">Mot de passe</label></td><td><input type="password" name="mdp" /></td></tr>
	</table>
	<br />
	<input type="reset" name="reset" value="Effacer" /> 
	<input type="submit" name="submit" value="Valider" />
</form>

</body>
</html>
<?php
/* user1=COUCOU, user2=BONSOIR!, user3=klmapqjdf, user4=145236987*/
if (isset($_GET['errlog'])) {
    $message = "Erreur. Utilisateur non reconnu.";
    echo "<script>alert('$message');</script>";
} elseif (isset($_GET['errmdp'])) {
    $message = "Erreur. Mot de passe incorrect";
    echo "<script>alert('$message');</script>";
} elseif (isset($_GET['deco'])) {
    $message = "Vous avez bien été déconnecté.";
    echo "<script>alert('$message');</script>";
} elseif (isset($_GET['notconnected'])) {
    $message = "Veuillez vous connecter.";
    echo "<script>alert('$message');</script>";
}
?>