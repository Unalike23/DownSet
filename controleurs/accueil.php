<?php
require_once __DIR__ . '/../modeles/AccueilModele.php';

$modele = new AccueilModele();
$arrivages = $modele->getArrivages(9);

$hots = $modele->getHots(9);

require_once __DIR__ . '/../vue/vueHeader.php';
include __DIR__ . '/../vue/vueAccueil.php';
require_once __DIR__ . '/../vue/vueFooter.php';
?>
