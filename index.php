<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . "/config.php";
require_once __DIR__ . "/controleurs/ControleurPrincipal.php";

$action = $_GET['page'] ?? "defaut";
$fichierControleur = controleurPrincipal($action);

require_once __DIR__ . "/controleurs/" . $fichierControleur;

?>
