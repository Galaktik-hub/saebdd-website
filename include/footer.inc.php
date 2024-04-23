<footer>
    <hr />
    <?php
    if (isset($_COOKIE['login'])) {
        echo "Vous êtes connecté en tant que " . $_COOKIE['login'] . ", vous pouvez accéder à votre <a href='profil.php'> profil </a> ou vous déconnecter <a href='deconnexion.php'> ici </a>";
    } else {
        echo "Vous n'êtes pas connecté, n'hésitez pas à vous inscrire ou à vous connecter sur <a href='connexion.php'> la page de connexion </a>";
    }
    ?>
</footer>