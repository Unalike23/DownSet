<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../modeles/ProduitModele.php';

$produitModele = new ProduitModele();

$q = $_GET['q'] ?? '';
$genres = $_GET['genres'] ?? [];
$categories = $_GET['categories'] ?? [];
$prix_max = $_GET['prix_max'] ?? $produitModele->getMaxPrice();
$sort = $_GET['sort'] ?? 'asc';
$sortType = $_GET['sortType'] ?? '';
$view = $_GET['view'] ?? 'produits';

$genresList = $produitModele->getAllGenres();
$categoriesList = $produitModele->getAllCategories();
$prixMaxGlobal = $produitModele->getMaxPrice();
$artistesResultats = $produitModele->rechercherArtistes($q);

$page = isset($_GET['p']) ? max(1, (int) $_GET['p']) : 1;
$limit = 40;
$offset = ($page - 1) * $limit;

$resultats = $produitModele->rechercherProduits($q, $genres, $categories, $prix_max, $sort, $limit, $offset, $sortType);
$totalProduits = $produitModele->countProduits($q, $genres, $categories, $prix_max);
$totalPages = ceil($totalProduits / $limit);

require_once __DIR__ . '/../vue/vueHeader.php';
include __DIR__ . '/../vue/vueRecherche.php';
require_once __DIR__ . '/../vue/vueFooter.php';
?>
