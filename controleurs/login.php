<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include_once __DIR__ . "/../config.php";

header("Content-Type: application/json; charset=utf-8");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = trim($_POST["email"] ?? '');
    $mdp = $_POST["mdp"] ?? '';

    if (!$email || !$mdp) {
        echo json_encode(["success" => false, "message" => "Champs manquants"]);
        exit;
    }

    $stmt = $pdo->prepare("SELECT * FROM utilisateur WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($mdp, $user["mdp"])) {
        unset($user['mdp']);
        $_SESSION["user"] = $user;

        echo json_encode(["success" => true, "user" => $user]);
        exit;
    } else {
        echo json_encode(["success" => false, "message" => "Email ou mot de passe incorrect"]);
        exit;
    }
}
