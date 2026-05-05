<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../modeles/CommandeModele.php';
require_once __DIR__ . '/../modeles/PanierModele.php';
require_once __DIR__ . '/../modeles/LigneCommande.php';

if (!isset($_SESSION['user'])) {
    header("Location: index.php?page=accueil");
    exit;
}

$commandeModele = new CommandeModele();
$panierModele = new PanierModele();

if (isset($_GET['action']) && $_GET['action'] === 'place') {
    // Endpoint AJAX pour finaliser la commande
    while (ob_get_level()) {
        ob_end_clean();
    }
    header('Content-Type: application/json; charset=utf-8');

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        http_response_code(405);
        echo json_encode(['success' => false, 'message' => 'Method not allowed']);
        exit;
    }

    if (!isset($_SESSION['user']['id_user'])) {
        http_response_code(401);
        echo json_encode(['success' => false, 'message' => 'Non authentifié']);
        exit;
    }

    $idUser = (int)$_SESSION['user']['id_user'];
    $id_adresse = isset($_POST['id_adresse']) && $_POST['id_adresse'] !== '' ? (int)$_POST['id_adresse'] : null;

    try {
        // Récupérer le panier et créer les lignes de commande
        $panier = $panierModele->getPanier($idUser);
        $lignes = [];
        
        foreach ($panier->getArticles() as $article) {
            $ligne = new LigneCommande(null, $article['produit'], $article['quantite'], $article['produit']->getPrix());
            $lignes[] = $ligne;
        }
        
        $id_commande = $commandeModele->createCommande($idUser, $id_adresse, $lignes);
        $panierModele->viderPanier($idUser);
        
        http_response_code(200);
        echo json_encode(['success' => true, 'id_commande' => $id_commande, 'message' => 'Commande créée']);
        exit;
    } catch (Exception $e) {
        http_response_code(500);
        echo json_encode(['success' => false, 'message' => 'Erreur lors de la création de la commande']);
        exit;
    }
}

$userId = $_SESSION['user']['id_user'];
$panier = $panierModele->getPanier($userId);
$adresses = $commandeModele->getAdresses($userId);

$total = $panier->getTotalPrix();

require_once __DIR__ . '/../vue/vueHeader.php';
include __DIR__ . '/../vue/vueCommande.php';
require_once __DIR__ . '/../vue/vueFooter.php';
?>
