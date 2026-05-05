<?php
require_once __DIR__ . '/../modeles/AdminModele.php';

$modele = new AdminModele();

// === TRAITER LES REQUÊTES POST ===
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = null;
    $message = null;

    if (isset($_POST['ajout_genre'])) {
        $nom = trim($_POST['nom_genre'] ?? '');
        if ($nom !== '') {
            $desc = trim($_POST['desc_genre'] ?? '');
            $modele->ajouterGenre($nom, $desc);
            $message = "Genre ajouté avec succès !";
        } else {
            $message = "Le nom du genre est requis.";
        }
    }

    elseif (isset($_POST['ajout_artiste'])) {
        $nom = trim($_POST['nom_artiste'] ?? '');
        if ($nom !== '') {
            $desc = trim($_POST['desc_artiste'] ?? '');
            $imgPath = $modele->saveUploadedFile('img_artiste', 'images/uploads', 'artiste_');
            $imgPage = $modele->saveUploadedFile('img_artiste_page', 'images/ArtistePage', 'artistepage_');
            $imgTitlePath = $modele->saveUploadedFile('img_artiste_title', 'images/ArtistePage', 'artistetitle_');

            $modele->ajouterArtiste($nom, $desc, $imgPath, $imgPage, $imgTitlePath);
            $message = "Artiste ajouté avec succès !";
        } else {
            $message = "Le nom de l'artiste est requis.";
        }
    }

    elseif (isset($_POST['ajout_produit'])) {
        $nom = trim($_POST['nom_produit'] ?? '');
        $prix = $_POST['prix_unitaire'] ?? 0;
        
        if ($nom !== '' && $prix > 0) {
            $desc = trim($_POST['desc_produit'] ?? '');
            $stock = $_POST['stock'] ?? 0;
            $imgPath = $modele->saveUploadedFile('img_produit', 'images/uploads', 'prod_');
            $imgDiskPath = $modele->saveUploadedFile('img_disk', 'images/uploads', 'disk_');

            $modele->ajouterProduit(
                $nom,
                $desc,
                $prix,
                $stock,
                $imgPath,
                $imgDiskPath,
                $_POST['id_artistes'] ?? [],
                $_POST['id_genres'] ?? [],
                $_POST['id_categorie'] ?? null
            );
            $message = "Produit ajouté avec succès !";
        } else {
            $message = "Nom et prix requis.";
        }
    }

    elseif (isset($_POST['supprimer_produit'])) {
        $id = $_POST['id_produit'] ?? null;
        if ($id) {
            $modele->supprimerProduit($id);
            $message = "Produit supprimé.";
        }
    }

    elseif (isset($_POST['modifier_prix'])) {
        $id = $_POST['id_produit'] ?? null;
        $nouveau = $_POST['nouveau_prix'] ?? null;
        if ($id !== null && $nouveau !== null && $nouveau > 0) {
            $modele->modifierPrix($id, $nouveau);
            $message = "Prix modifié.";
        } else {
            $message = "Erreur : prix invalide.";
        }
    }

    if ($message) {
        $_SESSION['admin_message'] = $message;
    }
    header("Location: index.php?page=admin");
    exit;
}

// Récupérer les données au format objet
$formData = $modele->getFormData();

// Extraire les objets
$genres = $formData['genres'];      // Array de Genre
$artistes = $formData['artistes'];  // Array de Artiste
$categories = $formData['categories']; // Array de Categorie
$produits = $formData['produits'];  // Array de Produit

$message = $_SESSION['admin_message'] ?? null;
unset($_SESSION['admin_message']);

require_once __DIR__ . '/../vue/vueHeader.php';
include __DIR__ . '/../vue/vueAdmin.php';
require_once __DIR__ . '/../vue/vueFooter.php';
?>
