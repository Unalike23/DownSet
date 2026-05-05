<?php
$host = "localhost";
$dbname = "downsetrecordmvc";
$username = "root";
$password = "";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}

function getRacine(): string {
    return "http://localhost/DownSetRecord/";
}

define('SITE_NAME', 'DownSetRecord');
define('BASE_URL', 'http://localhost/DownSetRecord/');