<?php
setcookie("panier", serialize($cart), time() - 60*60);
header('location: panier.php');
?>