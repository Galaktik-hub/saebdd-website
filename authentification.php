<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>Connexion</title>
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
?>

<h1>Connexion au compte utilisateur</h1>

<form action="verif_login.php" method="post">
	<table>
		<tr><td><label for="pseudo">Adresse e-mail</label></td><td><input type="text" name="login" /></td></tr>
		<tr><td><label for="mdp">Mot de passe</label></td><td><input type="password" name="mdp" /></td></tr>
	</table>
	<br />
	<input type="reset" name="reset" value="Effacer" /> 
	<input type="submit" name="submit" value="Valider" />
</form>

</body>
</html>