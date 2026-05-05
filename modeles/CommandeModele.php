<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/Commande.php';
require_once __DIR__ . '/LigneCommande.php';
require_once __DIR__ . '/Utilisateur.php';
require_once __DIR__ . '/Adresse.php';
require_once __DIR__ . '/Produit.php';

class CommandeModele
{
    private $pdo;

    public function __construct($pdo = null)
    {
        if ($pdo === null) {
            global $pdo;
        }
        $this->pdo = $pdo;
    }

    private function hydrateAdresse($row)
    {
        return new Adresse(
            $row['id_adresse'],
            $row['numero_rue'],
            $row['type_numero_rue'],
            $row['rue'],
            $row['ville'],
            $row['code_postal']
        );
    }

    private function hydrateProduit($row)
    {
        return new Produit(
            $row['id_produit'],
            $row['nom_produit'],
            '',
            $row['prix_unitaire'],
            0,
            $row['img_path'],
            null
        );
    }

    public function getAdresses($idUser)
    {
        $sql = "
            SELECT a.id_adresse, a.numero_rue, a.type_numero_rue, a.rue, a.ville, a.code_postal
            FROM utilisateur_adresse ua
            JOIN adresse a ON ua.id_adresse = a.id_adresse
            WHERE ua.id_user = :idUser
            ORDER BY a.id_adresse DESC
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['idUser' => $idUser]);

        $adresses = [];
        foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
            $adresses[] = $this->hydrateAdresse($row);
        }
        return $adresses;
    }

    public function createCommande($idUser, $idAdresse, $lignes)
    {
        if (empty($lignes)) {
            throw new Exception("Panier vide");
        }

        $total = 0;
        foreach ($lignes as $ligne) {
            $total += $ligne->getTotal();
        }

        try {
            $this->pdo->beginTransaction();

            // Créer la commande
            $sql = "INSERT INTO commande (id_user, id_adresse, date_commande, date_expedition, date_arrivee_prevue, total, statut, mode_paiement) 
                    VALUES (:id_user, :id_adresse, NOW(), DATE_ADD(NOW(), INTERVAL 2 DAY), DATE_ADD(NOW(), INTERVAL 5 DAY), :total, 'Préparation', 'CB')";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                'id_user' => $idUser,
                'id_adresse' => $idAdresse ?: null,
                'total' => $total
            ]);
            $idCommande = $this->pdo->lastInsertId();

            // Insérer les lignes
            $sqlLine = "INSERT INTO commande_produit (id_commande, id_produit, quantite, prix_unitaire) VALUES (:id_commande, :id_produit, :quantite, :prix_unitaire)";
            $stmtLine = $this->pdo->prepare($sqlLine);

            $sqlUpdateVentes = "UPDATE produits SET nb_ventes = nb_ventes + :quantite WHERE id_produit = :id_produit";
            $stmtUpdate = $this->pdo->prepare($sqlUpdateVentes);

            foreach ($lignes as $ligne) {
                $produit = $ligne->getProduit();
                $stmtLine->execute([
                    'id_commande' => $idCommande,
                    'id_produit' => $produit->getId(),
                    'quantite' => $ligne->getQuantite(),
                    'prix_unitaire' => $ligne->getPrixUnitaire()
                ]);

                $stmtUpdate->execute([
                    'quantite' => $ligne->getQuantite(),
                    'id_produit' => $produit->getId()
                ]);
            }

            $this->pdo->commit();
            return $idCommande;
        } catch (Exception $e) {
            $this->pdo->rollBack();
            throw $e;
        }
    }

    public function getCommandeById($idCommande)
    {
        $sql = "
            SELECT c.id_commande, c.id_user, c.id_adresse, c.date_commande, c.date_expedition, c.date_arrivee_prevue, c.total, c.statut, c.mode_paiement,
                   a.numero_rue, a.type_numero_rue, a.rue, a.ville, a.code_postal
            FROM commande c
            LEFT JOIN adresse a ON c.id_adresse = a.id_adresse
            WHERE c.id_commande = :id
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id' => (int) $idCommande]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$row) return null;

        $adresse = null;
        if ($row['id_adresse']) {
            $adresse = $this->hydrateAdresse($row);
        }

        $commande = new Commande(
            $row['id_commande'],
            null, // Utilisateur
            $adresse,
            $row['date_commande'],
            $row['date_expedition'],
            $row['date_arrivee_prevue'],
            $row['total'],
            $row['statut'],
            $row['mode_paiement']
        );

        // Charger les lignes
        $sqlLines = "
            SELECT cp.id_produit, p.nom_produit, p.prix_unitaire, p.img_path, cp.quantite
            FROM commande_produit cp
            JOIN produits p ON cp.id_produit = p.id_produit
            WHERE cp.id_commande = :id_commande
        ";
        $stmtLines = $this->pdo->prepare($sqlLines);
        $stmtLines->execute(['id_commande' => $idCommande]);

        foreach ($stmtLines->fetchAll(PDO::FETCH_ASSOC) as $ligne) {
            $produit = $this->hydrateProduit($ligne);
            $ligneCmd = new LigneCommande(null, $produit, $ligne['quantite'], $ligne['prix_unitaire']);
            $commande->addLigne($ligneCmd);
        }

        return $commande;
    }

    public function getCommandesByUser($idUser)
    {
        $sql = "
            SELECT c.id_commande, c.date_commande, c.date_expedition, c.date_arrivee_prevue, c.total, c.statut, c.mode_paiement,
                   a.id_adresse, a.numero_rue, a.type_numero_rue, a.rue, a.ville, a.code_postal
            FROM commande c
            LEFT JOIN adresse a ON c.id_adresse = a.id_adresse
            WHERE c.id_user = :idUser
            ORDER BY c.date_commande DESC
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['idUser' => $idUser]);

        $commandes = [];
        foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
            $adresse = null;
            if ($row['numero_rue']) {
                $adresse = $this->hydrateAdresse($row);
            }

            $commande = new Commande(
                $row['id_commande'],
                null,
                $adresse,
                $row['date_commande'],
                $row['date_expedition'],
                $row['date_arrivee_prevue'],
                $row['total'],
                $row['statut'],
                $row['mode_paiement']
            );

            // Load order lines
            $sqlLines = "
                SELECT cp.id_produit, p.nom_produit, p.prix_unitaire, p.img_path, cp.quantite
                FROM commande_produit cp
                JOIN produits p ON cp.id_produit = p.id_produit
                WHERE cp.id_commande = :id_commande
            ";
            $stmtLines = $this->pdo->prepare($sqlLines);
            $stmtLines->execute(['id_commande' => $row['id_commande']]);

            foreach ($stmtLines->fetchAll(PDO::FETCH_ASSOC) as $ligne) {
                $produit = $this->hydrateProduit($ligne);
                $ligneCmd = new LigneCommande(null, $produit, $ligne['quantite'], $ligne['prix_unitaire']);
                $commande->addLigne($ligneCmd);
            }

            $commandes[] = $commande;
        }

        return $commandes;
    }

    public static function getDeliveryStatus($dateCommande)
    {
        $commandeDate = new DateTime($dateCommande);
        $today = new DateTime();
        $interval = $today->diff($commandeDate);
        
        if ($interval->days >= 5) {
            return 'Reçu';
        } elseif ($interval->days >= 2) {
            return 'En chemin';
        } else {
            return 'Préparation';
        }
    }
}
