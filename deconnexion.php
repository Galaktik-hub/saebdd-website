<?php
    session_start();
    session_unset();
    session_destroy();
    header('location: authentification.php?deco=1');
?>