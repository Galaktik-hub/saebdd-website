<?php
if (isset($_POST["produit"])) {
    header("location: detailsproduit.php?produit=".$_POST['produit']);
}
else {
    header("location: accueil.php");
}
?>