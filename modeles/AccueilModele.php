<?php
require_once __DIR__ . '/Produit.php';
require_once __DIR__ . '/Artiste.php';
require_once __DIR__ . '/Categorie.php';

class AccueilModele {

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
            0,
            $row['img_path'],
            $row['img_disk_path']
        );

        if (!empty($row['nom_categorie'])) {
            $produit->setCategorie(new Categorie(null, $row['nom_categorie']));
        }

        if (!empty($row['nom_artiste'])) {
            $artistes = [];
            $noms = explode(', ', $row['nom_artiste']);
            foreach ($noms as $nom) {
                $artistes[] = new Artiste(null, $nom, '', null, $row['img_page_path'] ?? null);
            }
            $produit->setArtistes($artistes);
        }

        return $produit;
    }

    // Derniers arrivages
    public function getArrivages(int $limit = 10): array {
        $sql = "SELECT p.id_produit, p.nom_produit, p.description, p.prix_unitaire, p.stock,
                       p.img_path, p.img_disk_path,
                       GROUP_CONCAT(DISTINCT a.id_artiste) AS artiste_ids,
                       GROUP_CONCAT(DISTINCT a.nom_artiste SEPARATOR ', ') as nom_artiste,
                       (SELECT img_page_path FROM artiste 
                        WHERE id_artiste = (SELECT id_artiste FROM produit_artiste 
                                           WHERE id_produit = p.id_produit LIMIT 1)) as img_page_path,
                       c.id_categorie, c.nom_categorie
                FROM produits p
                LEFT JOIN produit_artiste pa ON p.id_produit = pa.id_produit
                LEFT JOIN artiste a ON pa.id_artiste = a.id_artiste
                LEFT JOIN produit_categorie pc ON p.id_produit = pc.id_produit
                LEFT JOIN categorieproduit c ON pc.id_categorie = c.id_categorie
                GROUP BY p.id_produit
                ORDER BY p.id_produit DESC
                LIMIT :limit";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        
        $produits = [];
        foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
            $produits[] = $this->hydrateProduit($row);
        }
        return $produits;
    }

    // Produits populaires ("hots")
    public function getHots(int $limit = 10): array {
        $sql = "SELECT p.id_produit, p.nom_produit, p.description, p.prix_unitaire, p.stock,
                       p.img_path, p.img_disk_path,
                       GROUP_CONCAT(DISTINCT a.id_artiste) AS artiste_ids,
                       GROUP_CONCAT(DISTINCT a.nom_artiste SEPARATOR ', ') as nom_artiste,
                       (SELECT img_page_path FROM artiste 
                        WHERE id_artiste = (SELECT id_artiste FROM produit_artiste 
                                           WHERE id_produit = p.id_produit LIMIT 1)) as img_page_path,
                       c.id_categorie, c.nom_categorie
                FROM produits p
                LEFT JOIN produit_artiste pa ON p.id_produit = pa.id_produit
                LEFT JOIN artiste a ON pa.id_artiste = a.id_artiste
                LEFT JOIN produit_categorie pc ON p.id_produit = pc.id_produit
                LEFT JOIN categorieproduit c ON pc.id_categorie = c.id_categorie
                GROUP BY p.id_produit
                ORDER BY p.nb_ventes DESC
                LIMIT :limit";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        
        $produits = [];
        foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
            $produits[] = $this->hydrateProduit($row);
        }
        return $produits;
    }
}
