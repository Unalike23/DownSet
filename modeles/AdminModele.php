<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/Produit.php';
require_once __DIR__ . '/Artiste.php';
require_once __DIR__ . '/Genre.php';
require_once __DIR__ . '/Categorie.php';

class AdminModele
{
    private $pdo;

    public function __construct($pdo = null)
    {
        if ($pdo === null) {
            global $pdo;
        }
        $this->pdo = $pdo;
    }

    // ===== GENRES =====
    public function ajouterGenre($nom, $desc)
    {
        $stmt = $this->pdo->prepare("INSERT INTO genre (nom_genre, desc_genre) VALUES (?, ?)");
        return $stmt->execute([$nom, $desc]);
    }

    public function getGenres()
    {
        $stmt = $this->pdo->query("SELECT * FROM genre ORDER BY nom_genre");
        $genres = [];
        foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
            $genres[] = new Genre($row['id_genre'], $row['nom_genre'], $row['desc_genre']);
        }
        return $genres;
    }

    // ===== ARTISTES =====
    public function ajouterArtiste($nom, $desc, $imgPath = null, $imgPage = null, $imgTitlePath = null)
    {
        $stmt = $this->pdo->prepare("
            INSERT INTO artiste (nom_artiste, desc_artiste, img_path, img_page_path, img_title_path) 
            VALUES (?, ?, ?, ?, ?)
        ");
        return $stmt->execute([$nom, $desc, $imgPath, $imgPage, $imgTitlePath]);
    }

    public function getArtistes()
    {
        $stmt = $this->pdo->query("SELECT * FROM artiste ORDER BY nom_artiste");
        $artistes = [];
        foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
            $artistes[] = new Artiste(
                $row['id_artiste'],
                $row['nom_artiste'],
                $row['desc_artiste'],
                $row['img_path'],
                $row['img_page_path'],
                $row['img_title_path']
            );
        }
        return $artistes;
    }

    // ===== CATEGORIES =====
    public function getCategories()
    {
        $stmt = $this->pdo->query("SELECT * FROM categorieproduit ORDER BY nom_categorie");
        $categories = [];
        foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
            $categories[] = new Categorie($row['id_categorie'], $row['nom_categorie']);
        }
        return $categories;
    }

    // ===== PRODUITS =====
    public function ajouterProduit($nom, $desc, $prix, $stock, $imgPath, $imgDiskPath, $artistes, $genres, $categorie)
    {
        $stmt = $this->pdo->prepare("
            INSERT INTO produits (nom_produit, description, prix_unitaire, stock, img_path, img_disk_path) 
            VALUES (?, ?, ?, ?, ?, ?)
        ");
        $stmt->execute([$nom, $desc, $prix, $stock, $imgPath, $imgDiskPath]);
        $idProduit = $this->pdo->lastInsertId();

        // Liaisons artistes
        if (!empty($artistes)) {
            foreach ($artistes as $idArtiste) {
                $this->pdo->prepare("INSERT INTO produit_artiste (id_produit, id_artiste) VALUES (?, ?)")
                    ->execute([$idProduit, $idArtiste]);
            }
        }

        // Liaisons genres
        if (!empty($genres)) {
            foreach ($genres as $idGenre) {
                $this->pdo->prepare("INSERT INTO produit_genre (id_produit, id_genre) VALUES (?, ?)")
                    ->execute([$idProduit, $idGenre]);
            }
        }

        // Liaison catégorie
        if (!empty($categorie)) {
            $this->pdo->prepare("INSERT INTO produit_categorie (id_produit, id_categorie) VALUES (?, ?)")
                ->execute([$idProduit, $categorie]);
        }

        return $idProduit;
    }

    public function getProduits()
    {
        $sql = "
            SELECT p.id_produit, p.nom_produit, p.description, p.prix_unitaire, p.stock,
                   p.img_path, p.img_disk_path,
                   GROUP_CONCAT(DISTINCT a.id_artiste) AS artiste_ids,
                   GROUP_CONCAT(DISTINCT a.nom_artiste SEPARATOR ', ') AS artistes,
                   GROUP_CONCAT(DISTINCT g.id_genre) AS genre_ids,
                   GROUP_CONCAT(DISTINCT g.nom_genre SEPARATOR ', ') AS genres,
                   c.id_categorie,
                   c.nom_categorie AS categories
            FROM produits p
            LEFT JOIN produit_artiste pa ON p.id_produit = pa.id_produit
            LEFT JOIN artiste a ON pa.id_artiste = a.id_artiste
            LEFT JOIN produit_genre pg ON p.id_produit = pg.id_produit
            LEFT JOIN genre g ON pg.id_genre = g.id_genre
            LEFT JOIN produit_categorie pc ON p.id_produit = pc.id_produit
            LEFT JOIN categorieproduit c ON pc.id_categorie = c.id_categorie
            GROUP BY p.id_produit
            ORDER BY p.nom_produit
        ";
        
        $stmt = $this->pdo->query($sql);
        $produits = [];
        
        foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
            $produit = new Produit(
                $row['id_produit'],
                $row['nom_produit'],
                $row['description'],
                $row['prix_unitaire'],
                $row['stock'],
                $row['img_path'],
                $row['img_disk_path']
            );

            // Charger les artistes
            if (!empty($row['artiste_ids'])) {
                $artisteIds = explode(',', $row['artiste_ids']);
                $artisteNoms = explode(', ', $row['artistes']);
                $artistes = [];
                foreach ($artisteIds as $i => $id) {
                    $artistes[] = new Artiste($id, $artisteNoms[$i] ?? '');
                }
                $produit->setArtistes($artistes);
            }

            // Charger les genres
            if (!empty($row['genre_ids'])) {
                $genreIds = explode(',', $row['genre_ids']);
                $genreNoms = explode(', ', $row['genres']);
                $genres = [];
                foreach ($genreIds as $i => $id) {
                    $genres[] = new Genre($id, $genreNoms[$i] ?? '');
                }
                $produit->setGenres($genres);
            }

            // Charger la catégorie
            if (!empty($row['id_categorie'])) {
                $produit->setCategorie(new Categorie($row['id_categorie'], $row['categories']));
            }

            $produits[] = $produit;
        }

        return $produits;
    }

    public function supprimerProduit($id)
    {
        $this->pdo->prepare("DELETE FROM produits WHERE id_produit=?")->execute([$id]);
    }

    public function modifierPrix($id, $prix)
    {
        $this->pdo->prepare("UPDATE produits SET prix_unitaire=? WHERE id_produit=?")
            ->execute([$prix, $id]);
    }

    // ===== UTILITAIRES =====
    public function saveUploadedFile($fieldName, $uploadDir, $prefix = '')
    {
        if (!isset($_FILES[$fieldName]) || $_FILES[$fieldName]['error'] !== UPLOAD_ERR_OK) {
            return null;
        }

        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        $file = $_FILES[$fieldName];
        $filename = $prefix . uniqid() . '.' . pathinfo($file['name'], PATHINFO_EXTENSION);
        $filepath = $uploadDir . '/' . $filename;

        if (move_uploaded_file($file['tmp_name'], $filepath)) {
            return $filepath;
        }

        return null;
    }

    public function getFormData()
    {
        return [
            'genres' => $this->getGenres(),
            'artistes' => $this->getArtistes(),
            'categories' => $this->getCategories(),
            'produits' => $this->getProduits()
        ];
    }
}
