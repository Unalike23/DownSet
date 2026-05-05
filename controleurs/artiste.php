<?php
require_once __DIR__ . "/../config.php";
require_once __DIR__ . "/../modeles/ArtisteModele.php";
require_once __DIR__ . "/../modeles/ProduitModele.php";

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

if ($id <= 0) {
    echo "Artiste non trouvé.";
} else {
    $artisteModele = new ArtisteModele();
    $produitModele = new ProduitModele();
    
    $artiste = $artisteModele->getArtisteById($id);
    
    if (!$artiste) {
        echo "Artiste introuvable.";
    } else {
        $albums = $produitModele->getProduitsByArtiste($id);
        require_once __DIR__ . '/../vue/vueHeader.php';
        include __DIR__ . "/../vue/vueArtiste.php";
        require_once __DIR__ . '/../vue/vueFooter.php';
    }
}
?>
