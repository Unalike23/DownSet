<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include_once __DIR__ . "/../config.php";

header("Content-Type: application/json; charset=utf-8");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nom = trim($_POST["nom"] ?? '');
    $prenom = trim($_POST["prenom"] ?? '');
    $email = trim($_POST["email"] ?? '');
    $telephone = trim($_POST["telephone"] ?? '');
    $mdp = $_POST["mdp"] ?? '';

    if (!$nom || !$prenom || !$email || !$mdp) {
        echo json_encode(["success" => false, "message" => "Champs obligatoires manquants"]);
        exit;
    }

    if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/', $mdp)) {
        echo json_encode(["success" => false, "message" => "Mot de passe invalide (8+ car, 1 maj, 1 min, 1 chiffre)."]);
        exit;
    }

    try {
        $hash = password_hash($mdp, PASSWORD_BCRYPT);

        $stmt = $pdo->prepare("INSERT INTO utilisateur (nom, prenom, email, telephone, mdp) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$nom, $prenom, $email, $telephone, $hash]);

        $stmt = $pdo->prepare("SELECT id_user, nom, prenom, email, is_admin FROM utilisateur WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        $_SESSION["user"] = $user;
        echo json_encode(["success" => true, "user" => $user]);
        exit;

    } catch (PDOException $e) {
        echo json_encode(["success" => false, "message" => "Erreur : cet email existe déjà !"]);
        exit;
    }
}
