<?php
require_once __DIR__ . "/../config.php";
require_once __DIR__ . "/../modeles/ProduitModele.php";

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

if ($id <= 0) {
    echo "Produit non trouvé.";
} else {
    $produitModele = new ProduitModele();
    $produit = $produitModele->getProduitById($id);
    if (!$produit) {
        echo "Produit introuvable.";
    } else {
        $variantes = $produitModele->getVariantes($produit->getNom());
        require_once __DIR__ . '/../vue/vueHeader.php';
        include __DIR__ . "/../vue/vueProduit.php";
        require_once __DIR__ . '/../vue/vueFooter.php';
    }
}
?>
