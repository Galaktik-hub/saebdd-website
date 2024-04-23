<?php
    setcookie('login', '', time() - 60*60*24*30);
    setcookie('mdp', '', time() - 60*60*24*30);
    header('location: authentification.php');
?>