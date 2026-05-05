<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/Panier.php';
require_once __DIR__ . '/Produit.php';
require_once __DIR__ . '/Artiste.php';
require_once __DIR__ . '/Categorie.php';

class PanierModele
{
    private $pdo;

    public function __construct($pdo = null)
    {
        if ($pdo === null) {
            global $pdo;
        }
        $this->pdo = $pdo;
    }

    private function hydrateProduit($row)
    {
        $produit = new Produit(
            $row['id_produit'],
            $row['nom_produit'],
            '',
            $row['prix_unitaire'],
            $row['stock'] ?? 0,
            $row['img_path'],
            null
        );

        if (!empty($row['id_categorie'])) {
            $produit->setCategorie(new Categorie($row['id_categorie'], $row['nom_categorie']));
        }

        if (!empty($row['nom_artiste'])) {
            $artistes = [];
            $noms = explode(', ', $row['nom_artiste']);
            foreach ($noms as $nom) {
                $artistes[] = new Artiste(null, $nom);
            }
            $produit->setArtistes($artistes);
        }

        return $produit;
    }

    private function getOrCreatePanierDB($idUser)
    {
        $stmt = $this->pdo->prepare("SELECT id_panier FROM panier WHERE id_user = ?");
        $stmt->execute([$idUser]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            return $row['id_panier'];
        }

        $this->pdo->prepare("INSERT INTO panier (date_creation, id_user) VALUES (NOW(), ?)")->execute([$idUser]);
        return $this->pdo->lastInsertId();
    }

    public function getPanier($idUser)
    {
        $idPanier = $this->getOrCreatePanierDB($idUser);

        $sql = "
            SELECT pr.id_produit, pr.nom_produit, pr.prix_unitaire, pr.img_path, pr.stock,
                   pp.quantite, c.id_categorie, c.nom_categorie,
                   GROUP_CONCAT(DISTINCT a.nom_artiste SEPARATOR ', ') AS nom_artiste
            FROM panier_produit pp
            JOIN produits pr ON pp.id_produit = pr.id_produit
            LEFT JOIN produit_categorie pc ON pr.id_produit = pc.id_produit
            LEFT JOIN categorieproduit c ON pc.id_categorie = c.id_categorie
            LEFT JOIN produit_artiste pa ON pr.id_produit = pa.id_produit
            LEFT JOIN artiste a ON pa.id_artiste = a.id_artiste
            WHERE pp.id_panier = :id_panier
            GROUP BY pr.id_produit, pp.quantite
        ";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id_panier' => $idPanier]);

        $panier = new Panier($idPanier);

        foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
            $produit = $this->hydrateProduit($row);
            $panier->addArticle($produit, $row['quantite']);
        }

        return $panier;
    }

    public function ajouterProduit($idUser, $idProduit)
    {
        $idPanier = $this->getOrCreatePanierDB($idUser);

        $stmt = $this->pdo->prepare("SELECT * FROM panier_produit WHERE id_panier = ? AND id_produit = ?");
        $stmt->execute([$idPanier, $idProduit]);

        if ($stmt->fetch()) {
            $this->pdo->prepare("UPDATE panier_produit SET quantite = quantite + 1 WHERE id_panier = ? AND id_produit = ?")
                ->execute([$idPanier, $idProduit]);
        } else {
            $this->pdo->prepare("INSERT INTO panier_produit (id_panier, id_produit, quantite) VALUES (?, ?, 1)")
                ->execute([$idPanier, $idProduit]);
        }
    }

    public function supprimerProduit($idUser, $idProduit)
    {
        $idPanier = $this->getOrCreatePanierDB($idUser);
        $this->pdo->prepare("DELETE FROM panier_produit WHERE id_panier = ? AND id_produit = ?")
            ->execute([$idPanier, $idProduit]);
    }

    public function updateQuantite($idUser, $idProduit, $quantite)
    {
        $idPanier = $this->getOrCreatePanierDB($idUser);
        
        if ($quantite <= 0) {
            $this->supprimerProduit($idUser, $idProduit);
        } else {
            $this->pdo->prepare("UPDATE panier_produit SET quantite = ? WHERE id_panier = ? AND id_produit = ?")
                ->execute([$quantite, $idPanier, $idProduit]);
        }
    }

    public function viderPanier($idUser)
    {
        $idPanier = $this->getOrCreatePanierDB($idUser);
        $this->pdo->prepare("DELETE FROM panier_produit WHERE id_panier = ?")->execute([$idPanier]);
    }
}
