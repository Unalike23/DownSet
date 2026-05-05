<?php
function controleurPrincipal($action) {
    $lesActions = array();
    $lesActions["defaut"] = "accueil.php";
    $lesActions["accueil"] = "accueil.php";
    $lesActions["recherche"] = "recherche.php";
    $lesActions["commande"] = "commande.php";
    $lesActions["produit"] = "produit.php";
    $lesActions["admin"] = "admin.php";
    $lesActions["profil"] = "profil.php";
    $lesActions["artiste"] = "artiste.php";
    $lesActions["login"] = "login.php";
    $lesActions["logout"] = "logout.php";
    $lesActions["register"] = "register.php";
    $lesActions["panier"] = "panier.php";

    if (array_key_exists($action, $lesActions)) {
        return $lesActions[$action];
    } else {
        return $lesActions["defaut"];
    }
}
?>
