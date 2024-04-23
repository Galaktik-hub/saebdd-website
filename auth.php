<?php
session_start();

if (!(isset($_SESSION['login']) && isset($_SESSION['mdp']))) { /* Vérification de l'existence d'un login et d'un mdp, sinon retour à la page d'authentification */
    header('location: form_auth.php');
}

include('connexion.inc.php');
?>
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

<?php
    if (isset($_POST['pseudo']) && isset($_POST['mdp'])) {
        $login=$_POST['pseudo'];
        $mdp=md5($_POST['mdp']);
        $resultat=$cnx->query("SELECT COUNT(*) AS correct FROM authentification WHERE login='$login'");
        $ligne=$resultat->fetch(PDO::FETCH_OBJ);
        if ($ligne->correct == 0) {
            header('location: authentification.php?errlog=1');
        } else {
            $resultat=$cnx->query("SELECT COUNT(*) AS correct FROM authentification WHERE login='$login' AND mdp='$mdp'");
            $ligne=$resultat->fetch(PDO::FETCH_OBJ);
            if ($ligne->correct == 0) {
                header('location: authentification.php?errmdp=1');
            } else {
                $_SESSION['login']=$login;
                $_SESSION['mdp']=$mdp;
                header('location: authentification.php');
            }
        }
    }
?>

</body>
</html>
