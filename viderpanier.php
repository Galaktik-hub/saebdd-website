<?php
setcookie("panier", serialize($cart), time() - 60*60*24*30);
header('location: panier.php');
?>