<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
header("Content-Type: application/json");

require_once __DIR__ . "/../config.php";
require_once __DIR__ . "/../modeles/PanierModele.php";

if (!isset($_SESSION['user'])) {
    echo json_encode(["success" => false, "message" => "Non connecté", "items" => []]);
    exit;
}

$id_user = $_SESSION['user']['id_user'];
$action = $_POST['action'] ?? ($_GET['action'] ?? '');

$panierModele = new PanierModele();

switch ($action) {
    case "ajouter":
        if (isset($_POST['id_produit'])) {
            $id_produit = intval($_POST['id_produit']);
            $panierModele->ajouterProduit($id_user, $id_produit);
            
            $panier = $panierModele->getPanier($id_user);
            $produitTrouve = null;
            
            foreach ($panier->getArticles() as $article) {
                if ($article['produit']->getId() == $id_produit) {
                    $produitTrouve = $article['produit'];
                    break;
                }
            }
            
            echo json_encode([
                "success" => true,
                "message" => "Produit ajouté",
                "produit" => $produitTrouve ? [
                    'id_produit' => $produitTrouve->getId(), 
                    'nom_produit' => $produitTrouve->getNom(),
                    'nom_artiste' => $produitTrouve->getArtistesNoms(),
                    'img_path' => $produitTrouve->getImageCouverture()
                ] : null
            ]);
        }
        break;

    case "supprimer":
        if (isset($_POST['id_produit'])) {
            $panierModele->supprimerProduit($id_user, intval($_POST['id_produit']));
            echo json_encode(["success" => true, "message" => "Produit supprimé"]);
        }
        break;

    case "afficher":
        $panier = $panierModele->getPanier($id_user);
        $items = [];
        foreach ($panier->getArticles() as $article) {
            $produit = $article['produit'];
            $items[] = [
                'id_produit' => $produit->getId(),
                'nom_produit' => $produit->getNom(),
                'quantite' => $article['quantite'],
                'prix_unitaire' => $produit->getPrix(),
                'img_path' => $produit->getImageCouverture(),
                'nom_artiste' => $produit->getArtistesNoms(),
                'nom_categorie' => $produit->getCategorieNom()
            ];
        }
        echo json_encode(["success" => true, "items" => $items]);
        break;

    case "compter":
        $panier = $panierModele->getPanier($id_user);
        echo json_encode(["success" => true, "total" => $panier->getTotalQuantite()]);
        break;

    default:
        echo json_encode(["success" => false, "message" => "Action inconnue"]);
}
