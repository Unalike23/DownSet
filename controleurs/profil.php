<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../modeles/ProfilModele.php';
require_once __DIR__ . '/../modeles/PanierModele.php';
require_once __DIR__ . '/../modeles/CommandeModele.php';

if (!isset($_SESSION['user']['id_user'])) {
    header("Location: index.php?page=accueil");
    exit;
}

$id_user = (int) $_SESSION['user']['id_user'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? null;

    if ($action === 'ajout_adresse') {
        $rue = trim($_POST['rue'] ?? '');
        $numero = trim($_POST['numero_rue'] ?? '');
        $type_num = trim($_POST['type_numero_rue'] ?? '');
        $ville = trim($_POST['ville'] ?? '');
        $code_postal = trim($_POST['code_postal'] ?? '');

        $existing = ProfilModele::getAdresses($id_user);
        if (count($existing) >= 4) {
            header("Location: index.php?page=profil");
            exit;
        }

        if ($rue && $numero && $ville && $code_postal) {
            ProfilModele::ajouterAdresse($id_user, $rue, $numero, $type_num, $ville, $code_postal);
        }

        header("Location: index.php?page=profil");
        exit;
    }

    if ($action === 'supprimer_adresse') {
        $id_adresse = intval($_POST['id_adresse'] ?? 0);
        if ($id_adresse > 0) {
            ProfilModele::supprimerAdresse($id_user, $id_adresse);
        }
        header("Location: index.php?page=profil");
        exit;
    }

    if ($action === 'modifier_email') {
        $nouvel_email = trim($_POST['nouvel_email'] ?? '');
        if (filter_var($nouvel_email, FILTER_VALIDATE_EMAIL)) {
            ProfilModele::modifierEmail($id_user, $nouvel_email);
            $_SESSION['user']['email'] = $nouvel_email;
        }
        header("Location: index.php?page=profil");
        exit;
    }

    if ($action === 'modifier_telephone') {
        $nouveau_tel = trim($_POST['nouveau_tel'] ?? '');
        if (!empty($nouveau_tel)) {
            ProfilModele::modifierTelephone($id_user, $nouveau_tel);
            $_SESSION['user']['telephone'] = $nouveau_tel;
        }
        header("Location: index.php?page=profil");
        exit;
    }

    if ($action === 'logout') {
        session_destroy();
        header("Location: index.php?page=accueil");
        exit;
    }

    if ($action === 'supprimer_compte') {
        ProfilModele::supprimerUtilisateur($id_user);
        session_destroy();
        header("Location: index.php?page=accueil");
        exit;
    }
}

$commandeModele = new CommandeModele();
$panierModele = new PanierModele();

$user = ProfilModele::getInfosUtilisateur($id_user);
$adresses = ProfilModele::getAdresses($id_user) ?? [];
$panierObj = $panierModele->getPanier($id_user);
$commandes = $commandeModele->getCommandesByUser($id_user) ?? [];

$total_panier = $panierObj->getTotalPrix();
$panier = $panierObj->getArticles();

require_once __DIR__ . '/../vue/vueHeader.php';
include __DIR__ . '/../vue/vueProfil.php';
require_once __DIR__ . '/../vue/vueFooter.php';
?>
