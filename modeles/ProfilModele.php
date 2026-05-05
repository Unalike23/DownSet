<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/Utilisateur.php';
require_once __DIR__ . '/Adresse.php';
require_once __DIR__ . '/Produit.php';

class ProfilModele {

    public static function getInfosUtilisateur(int $id_user): ?Utilisateur {
        global $pdo;
        $stmt = $pdo->prepare("SELECT * FROM utilisateur WHERE id_user = :id_user");
        $stmt->execute(['id_user' => $id_user]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if (!$row) return null;
        
        return new Utilisateur(
            $row['id_user'],
            $row['nom'],
            $row['prenom'],
            $row['email'],
            (bool) $row['is_admin'],
            $row['date_inscription'] ?? null,
            $row['telephone'] ?? null
        );
    }

    public static function getAdresses(int $id_user): array {
        global $pdo;
        $stmt = $pdo->prepare("
            SELECT a.*
            FROM adresse a
            INNER JOIN utilisateur_adresse ua ON ua.id_adresse = a.id_adresse
            WHERE ua.id_user = :id_user
        ");
        $stmt->execute(['id_user' => $id_user]);
        
        $adresses = [];
        foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
            $adresses[] = new Adresse(
                $row['id_adresse'],
                $row['numero_rue'],
                $row['type_numero_rue'],
                $row['rue'],
                $row['ville'],
                $row['code_postal']
            );
        }
        return $adresses;
    }

    public static function ajouterAdresse(int $id_user, string $rue, string $numero, string $type_num, string $ville, string $code_postal): void {
        global $pdo;
        $stmt = $pdo->prepare("
            INSERT INTO adresse (rue, numero_rue, type_numero_rue, ville, code_postal)
            VALUES (:rue, :numero, :type_num, :ville, :code_postal)
        ");
        $stmt->execute([
            'rue' => $rue,
            'numero' => $numero,
            'type_num' => $type_num,
            'ville' => $ville,
            'code_postal' => $code_postal
        ]);

        $id_adresse = $pdo->lastInsertId();
        $stmt2 = $pdo->prepare("INSERT INTO utilisateur_adresse (id_user, id_adresse) VALUES (:id_user, :id_adresse)");
        $stmt2->execute(['id_user' => $id_user, 'id_adresse' => $id_adresse]);
    }

    public static function supprimerAdresse(int $id_user, int $id_adresse): void {
        global $pdo;
        // Supprime la relation d'abord
        $stmt = $pdo->prepare("DELETE FROM utilisateur_adresse WHERE id_user = :id_user AND id_adresse = :id_adresse");
        $stmt->execute(['id_user' => $id_user, 'id_adresse' => $id_adresse]);

        // Puis supprime l'adresse
        $stmt2 = $pdo->prepare("DELETE FROM adresse WHERE id_adresse = :id_adresse");
        $stmt2->execute(['id_adresse' => $id_adresse]);
    }

    public static function getPanier(int $id_user): array {
        global $pdo;
        $stmt = $pdo->prepare("
            SELECT p.*, pp.quantite
            FROM panier_produit pp
            INNER JOIN produits p ON p.id_produit = pp.id_produit
            INNER JOIN panier pa ON pa.id_panier = pp.id_panier
            WHERE pa.id_user = :id_user
        ");
        $stmt->execute(['id_user' => $id_user]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getCommandes(int $id_user): array {
    global $pdo;

    $stmt = $pdo->prepare("
        SELECT c.*
        FROM commande c
        INNER JOIN panier p ON c.id_panier = p.id_panier
        WHERE p.id_user = :id_user
        ORDER BY c.date_commande DESC
    ");
    $stmt->execute(['id_user' => $id_user]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

public static function modifierEmail($id_user, $email) {
    global $pdo;
    $stmt = $pdo->prepare("UPDATE utilisateur SET email = :email WHERE id_user = :id");
    $stmt->execute(['email' => $email, 'id' => $id_user]);
}

public static function modifierTelephone($id_user, $tel) {
    global $pdo;
    $stmt = $pdo->prepare("UPDATE utilisateur SET telephone = :tel WHERE id_user = :id");
    $stmt->execute(['tel' => $tel, 'id' => $id_user]);
}

public static function supprimerUtilisateur($id_user) {
    global $pdo;

    try {
        $pdo->beginTransaction();

        // Supprimer panier
        $stmt = $pdo->prepare("DELETE FROM panier_produit WHERE id_panier IN (SELECT id_panier FROM panier WHERE id_user = :id)");
        $stmt->execute(['id' => $id_user]);
        $stmt = $pdo->prepare("DELETE FROM panier WHERE id_user = :id");
        $stmt->execute(['id' => $id_user]);

        // Supprimer commandes
        $stmt = $pdo->prepare("DELETE FROM commande_produit WHERE id_commande IN (SELECT id_commande FROM commande WHERE id_user = :id)");
        $stmt->execute(['id' => $id_user]);
        $stmt = $pdo->prepare("DELETE FROM commande WHERE id_user = :id");
        $stmt->execute(['id' => $id_user]);

        // Supprimer adresses liées
        $stmt = $pdo->prepare("DELETE FROM utilisateur_adresse WHERE id_user = :id");
        $stmt->execute(['id' => $id_user]);

        // Supprimer utilisateur
        $stmt = $pdo->prepare("DELETE FROM utilisateur WHERE id_user = :id");
        $stmt->execute(['id' => $id_user]);

        $pdo->commit();
    } catch (Exception $e) {
        $pdo->rollBack();
        throw $e;
    }
    
}

}
