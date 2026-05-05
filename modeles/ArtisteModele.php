<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/Artiste.php';
require_once __DIR__ . '/Produit.php';
require_once __DIR__ . '/Categorie.php';
require_once __DIR__ . '/Genre.php';

class ArtisteModele
{
    private $pdo;

    public function __construct($pdo = null)
    {
        if ($pdo === null) {
            global $pdo;
        }
        $this->pdo = $pdo;
    }

    private function hydrateArtiste($row)
    {
        return new Artiste(
            $row['id_artiste'],
            $row['nom_artiste'],
            $row['desc_artiste'] ?? '',
            $row['img_path'],
            $row['img_page_path'],
            $row['img_title_path']
        );
    }

    private function hydrateProduit($row)
    {
        return new Produit(
            $row['id_produit'],
            $row['nom_produit'],
            $row['description'] ?? '',
            $row['prix_unitaire'],
            $row['stock'],
            $row['img_path'],
            $row['img_disk_path'],
            $row['id_categorie'] ?? null
        );
    }



    public function getArtisteById($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM artiste WHERE id_artiste = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$row) return null;

        $artiste = $this->hydrateArtiste($row);

        // Récupérer les genres
        $stmtGenres = $this->pdo->prepare("
            SELECT DISTINCT g.id_genre, g.nom_genre
            FROM genre g
            JOIN produit_genre pg ON g.id_genre = pg.id_genre
            JOIN produit_artiste pa ON pg.id_produit = pa.id_produit
            WHERE pa.id_artiste = ?
            GROUP BY g.id_genre
        ");
        $stmtGenres->execute([$id]);
        
        $genres = [];
        foreach ($stmtGenres->fetchAll(PDO::FETCH_ASSOC) as $g) {
            $genres[] = new Genre($g['id_genre'], $g['nom_genre']);
        }

        // Récupérer les produits
        $stmtAlbums = $this->pdo->prepare("
            SELECT p.id_produit, p.nom_produit, p.description, p.prix_unitaire, p.stock, p.img_path, p.img_disk_path,
                   c.id_categorie, c.nom_categorie
            FROM produits p
            LEFT JOIN produit_categorie pc ON p.id_produit = pc.id_produit
            LEFT JOIN categorieproduit c ON pc.id_categorie = c.id_categorie
            JOIN produit_artiste pa ON p.id_produit = pa.id_produit
            WHERE pa.id_artiste = ?
        ");
        $stmtAlbums->execute([$id]);

        $albums = [];
        foreach ($stmtAlbums->fetchAll(PDO::FETCH_ASSOC) as $row) {
            $albums[] = $this->hydrateProduit($row);
        }

        // Stocker genres et albums dans l'artiste via des propriétés dynamiques
        $artiste->genres = $genres;
        $artiste->albums = $albums;

        return $artiste;
    }

    public function getAllArtistes()
    {
        $stmt = $this->pdo->query("SELECT * FROM artiste ORDER BY nom_artiste");
        
        $artistes = [];
        foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
            $artistes[] = $this->hydrateArtiste($row);
        }
        return $artistes;
    }
}
