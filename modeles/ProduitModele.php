<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/Produit.php';
require_once __DIR__ . '/Artiste.php';
require_once __DIR__ . '/Genre.php';
require_once __DIR__ . '/Categorie.php';

class ProduitModele
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
            $row['nom_produit'] ?? '',
            $row['description'] ?? '',
            $row['prix_unitaire'] ?? 0,
            $row['stock'] ?? 0,
            $row['img_path'] ?? null,
            $row['img_disk_path'] ?? null
        );

        // Artistes
        if (!empty($row['artiste_ids'])) {
            $artisteIds = explode(',', $row['artiste_ids']);
            $artisteNoms = !empty($row['nom_artiste']) ? explode(', ', $row['nom_artiste']) : [];
            $artistes = [];
            foreach ($artisteIds as $i => $id) {
                $artistes[] = new Artiste($id, $artisteNoms[$i] ?? '');
            }
            $produit->setArtistes($artistes);
        }

        // Genres
        if (!empty($row['genre_ids'])) {
            $genreIds = explode(',', $row['genre_ids']);
            $genreNoms = !empty($row['genres']) ? explode(', ', $row['genres']) : [];
            $genres = [];
            foreach ($genreIds as $i => $id) {
                $genres[] = new Genre($id, $genreNoms[$i] ?? '');
            }
            $produit->setGenres($genres);
        }

        // Catégorie
        if (!empty($row['id_categorie'])) {
            $produit->setCategorie(new Categorie($row['id_categorie'], $row['nom_categorie'] ?? ''));
        }

        return $produit;
    }

    public function getHotProduits($limit = 8)
    {
        $sql = "
            SELECT p.id_produit, p.nom_produit, p.description, p.prix_unitaire, p.stock, p.img_path, p.img_disk_path,
                   GROUP_CONCAT(DISTINCT a.id_artiste) AS artiste_ids,
                   GROUP_CONCAT(DISTINCT a.nom_artiste SEPARATOR ', ') AS nom_artiste,
                   c.id_categorie, c.nom_categorie
            FROM produits p
            LEFT JOIN produit_categorie pc ON p.id_produit = pc.id_produit
            LEFT JOIN categorieproduit c ON pc.id_categorie = c.id_categorie
            LEFT JOIN produit_artiste pa ON p.id_produit = pa.id_produit
            LEFT JOIN artiste a ON pa.id_artiste = a.id_artiste
            GROUP BY p.id_produit
            ORDER BY p.nb_clics DESC
            LIMIT :limit
        ";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':limit', (int) $limit, PDO::PARAM_INT);
        $stmt->execute();

        $produits = [];
        foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
            $produits[] = $this->hydrateProduit($row);
        }

        return $produits;
    }

    public function getDerniersProduits($limit = 8)
    {
        $sql = "
            SELECT p.id_produit, p.nom_produit, p.description, p.prix_unitaire, p.stock, p.img_path, p.img_disk_path,
                   GROUP_CONCAT(DISTINCT a.id_artiste) AS artiste_ids,
                   GROUP_CONCAT(DISTINCT a.nom_artiste SEPARATOR ', ') AS nom_artiste,
                   GROUP_CONCAT(DISTINCT g.id_genre) AS genre_ids,
                   GROUP_CONCAT(DISTINCT g.nom_genre SEPARATOR ', ') AS genres,
                   c.id_categorie, c.nom_categorie
            FROM produits p
            LEFT JOIN produit_categorie pc ON p.id_produit = pc.id_produit
            LEFT JOIN categorieproduit c ON pc.id_categorie = c.id_categorie
            LEFT JOIN produit_artiste pa ON p.id_produit = pa.id_produit
            LEFT JOIN artiste a ON pa.id_artiste = a.id_artiste
            LEFT JOIN produit_genre pg ON p.id_produit = pg.id_produit
            LEFT JOIN genre g ON pg.id_genre = g.id_genre
            GROUP BY p.id_produit
            ORDER BY p.id_produit DESC
            LIMIT :limit
        ";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':limit', (int) $limit, PDO::PARAM_INT);
        $stmt->execute();

        $produits = [];
        foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
            $produits[] = $this->hydrateProduit($row);
        }

        return $produits;
    }

    public function getProduitById($id)
    {
        $sql = "
            SELECT p.id_produit, p.nom_produit, p.description, p.prix_unitaire, p.stock, p.img_path, p.img_disk_path,
                   GROUP_CONCAT(DISTINCT a.id_artiste) AS artiste_ids,
                   GROUP_CONCAT(DISTINCT a.nom_artiste SEPARATOR ', ') AS nom_artiste,
                   GROUP_CONCAT(DISTINCT g.id_genre) AS genre_ids,
                   GROUP_CONCAT(DISTINCT g.nom_genre SEPARATOR ', ') AS genres,
                   c.id_categorie, c.nom_categorie
            FROM produits p
            LEFT JOIN produit_artiste pa ON p.id_produit = pa.id_produit
            LEFT JOIN artiste a ON pa.id_artiste = a.id_artiste
            LEFT JOIN produit_categorie pc ON p.id_produit = pc.id_produit
            LEFT JOIN categorieproduit c ON pc.id_categorie = c.id_categorie
            LEFT JOIN produit_genre pg ON p.id_produit = pg.id_produit
            LEFT JOIN genre g ON pg.id_genre = g.id_genre
            WHERE p.id_produit = :id
            GROUP BY p.id_produit
            LIMIT 1
        ";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id' => (int) $id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row ? $this->hydrateProduit($row) : null;
    }

    public function getVariantes($nomProduit, $artistOrId = null, $excludeId = null)
    {
        $sql = "
            SELECT p.id_produit, p.nom_produit, p.description, p.prix_unitaire, p.stock, p.img_path,
                   GROUP_CONCAT(DISTINCT a.id_artiste) AS artiste_ids,
                   GROUP_CONCAT(DISTINCT a.nom_artiste SEPARATOR ', ') AS nom_artiste,
                   c.id_categorie, c.nom_categorie
            FROM produits p
            LEFT JOIN produit_categorie pc ON p.id_produit = pc.id_produit
            LEFT JOIN categorieproduit c ON pc.id_categorie = c.id_categorie
            LEFT JOIN produit_artiste pa ON p.id_produit = pa.id_produit
            LEFT JOIN artiste a ON pa.id_artiste = a.id_artiste
            WHERE p.nom_produit = :nom
        ";

        $params = [':nom' => $nomProduit];

        if (!empty($artistOrId)) {
            if (is_numeric($artistOrId)) {
                $sql .= " AND EXISTS (SELECT 1 FROM produit_artiste pa2 WHERE pa2.id_produit = p.id_produit AND pa2.id_artiste = :idArt)";
                $params[':idArt'] = (int) $artistOrId;
            } else {
                $sql .= " AND EXISTS (SELECT 1 FROM produit_artiste pa2 JOIN artiste a2 ON pa2.id_artiste = a2.id_artiste WHERE pa2.id_produit = p.id_produit AND a2.nom_artiste = :nomArt)";
                $params[':nomArt'] = $artistOrId;
            }
        }

        if (!empty($excludeId)) {
            $sql .= " AND p.id_produit != :exclude";
            $params[':exclude'] = (int) $excludeId;
        }

        $sql .= " GROUP BY p.id_produit ORDER BY p.prix_unitaire ASC";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);

        $produits = [];
        foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
            $produits[] = $this->hydrateProduit($row);
        }

        return $produits;
    }

    public function rechercherProduits($q = '', $genres = [], $categories = [], $prix_max = null, $sort = 'asc', $limit = 40, $offset = 0, $sortType = '')
    {
        $sql = "
            SELECT DISTINCT p.id_produit, p.nom_produit, p.description, p.prix_unitaire, p.stock, p.img_path, p.img_disk_path, p.nb_ventes,
                   GROUP_CONCAT(DISTINCT a.id_artiste) AS artiste_ids,
                   GROUP_CONCAT(DISTINCT a.nom_artiste SEPARATOR ', ') AS nom_artiste,
                   GROUP_CONCAT(DISTINCT g.id_genre) AS genre_ids,
                   GROUP_CONCAT(DISTINCT g.nom_genre SEPARATOR ', ') AS genres,
                   c.id_categorie, c.nom_categorie
            FROM produits p
            LEFT JOIN produit_artiste pa ON p.id_produit = pa.id_produit
            LEFT JOIN artiste a ON pa.id_artiste = a.id_artiste
            LEFT JOIN produit_categorie pc ON p.id_produit = pc.id_produit
            LEFT JOIN categorieproduit c ON pc.id_categorie = c.id_categorie
            LEFT JOIN produit_genre pg ON p.id_produit = pg.id_produit
            LEFT JOIN genre g ON pg.id_genre = g.id_genre
            WHERE 1=1
        ";

        $params = [];

        if (!empty($q)) {
            $sql .= " AND (p.nom_produit LIKE :q OR a.nom_artiste LIKE :q OR g.nom_genre LIKE :q)";
            $params[':q'] = "%$q%";
        }

        if (!empty($categories)) {
            $placeholders = [];
            foreach ($categories as $i => $cat) {
                $ph = ":cat$i";
                $placeholders[] = $ph;
                $params[$ph] = $cat;
            }
            $sql .= " AND c.id_categorie IN (" . implode(',', $placeholders) . ")";
        }

        if (!empty($genres)) {
            $placeholders = [];
            foreach ($genres as $i => $gen) {
                $ph = ":gen$i";
                $placeholders[] = $ph;
                $params[$ph] = $gen;
            }
            $sql .= " AND g.id_genre IN (" . implode(',', $placeholders) . ")";
        }

        if (!empty($prix_max)) {
            $sql .= " AND p.prix_unitaire <= :prix_max";
            $params[':prix_max'] = $prix_max;
        }

        $sql .= " GROUP BY p.id_produit";

        switch ($sortType) {
            case 'plus_vendus':
                $sql .= " ORDER BY p.nb_ventes DESC";
                break;
            case 'moins_vendus':
                $sql .= " ORDER BY p.nb_ventes ASC";
                break;
            case 'nouveaux':
                $sql .= " ORDER BY p.id_produit DESC";
                break;
            case 'anciens':
                $sql .= " ORDER BY p.id_produit ASC";
                break;
            default:
                $sql .= " ORDER BY p.prix_unitaire " . (strtolower($sort) === 'desc' ? 'DESC' : 'ASC');
                break;
        }

        $sql .= " LIMIT :limit OFFSET :offset";

        $stmt = $this->pdo->prepare($sql);
        foreach ($params as $key => $value) {
            $paramType = is_int($value) ? PDO::PARAM_INT : PDO::PARAM_STR;
            $stmt->bindValue($key, $value, $paramType);
        }
        $stmt->bindValue(':limit', (int) $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', (int) $offset, PDO::PARAM_INT);
        $stmt->execute();

        $produits = [];
        foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
            $produits[] = $this->hydrateProduit($row);
        }

        return $produits;
    }

    public function countProduits($q = '', $genres = [], $categories = [], $prix_max = 9999)
    {
        $sql = "
            SELECT COUNT(DISTINCT p.id_produit) as total
            FROM produits p
            LEFT JOIN produit_categorie pc ON p.id_produit = pc.id_produit
            LEFT JOIN categorieproduit c ON pc.id_categorie = c.id_categorie
            LEFT JOIN produit_artiste pa ON p.id_produit = pa.id_produit
            LEFT JOIN artiste a ON pa.id_artiste = a.id_artiste
            LEFT JOIN produit_genre pg ON p.id_produit = pg.id_produit
            LEFT JOIN genre g ON pg.id_genre = g.id_genre
            WHERE 1=1
        ";

        $params = [];

        if (!empty($q)) {
            $sql .= " AND (p.nom_produit LIKE :q OR a.nom_artiste LIKE :q OR g.nom_genre LIKE :q)";
            $params[':q'] = "%$q%";
        }

        if (!empty($genres)) {
            $placeholders = [];
            foreach ($genres as $i => $gid) {
                $ph = ":g$i";
                $placeholders[] = $ph;
                $params[$ph] = $gid;
            }
            $sql .= " AND g.id_genre IN (" . implode(",", $placeholders) . ")";
        }

        if (!empty($categories)) {
            $placeholders = [];
            foreach ($categories as $i => $cid) {
                $ph = ":c$i";
                $placeholders[] = $ph;
                $params[$ph] = $cid;
            }
            $sql .= " AND c.id_categorie IN (" . implode(",", $placeholders) . ")";
        }

        $sql .= " AND p.prix_unitaire <= :prix_max";
        $params[':prix_max'] = $prix_max;

        $stmt = $this->pdo->prepare($sql);
        foreach ($params as $key => $value) {
            $paramType = is_int($value) ? PDO::PARAM_INT : PDO::PARAM_STR;
            $stmt->bindValue($key, $value, $paramType);
        }
        $stmt->execute();

        return (int) $stmt->fetchColumn();
    }

    public function getAllGenres()
    {
        $stmt = $this->pdo->query("SELECT id_genre, nom_genre FROM genre ORDER BY nom_genre");
        $genres = [];
        foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
            $genres[] = new Genre($row['id_genre'], $row['nom_genre']);
        }
        return $genres;
    }

    public function getAllCategories()
    {
        $stmt = $this->pdo->query("SELECT id_categorie, nom_categorie FROM categorieproduit ORDER BY nom_categorie");
        $categories = [];
        foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
            $categories[] = new Categorie($row['id_categorie'], $row['nom_categorie']);
        }
        return $categories;
    }

    public function getMaxPrice()
    {
        $stmt = $this->pdo->query("SELECT MAX(prix_unitaire) as max_price FROM produits");
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return (float) ($row['max_price'] ?? 0);
    }

    public function rechercherArtistes($q = '')
    {
        $sql = "SELECT id_artiste, nom_artiste, img_path, img_title_path, img_page_path FROM artiste WHERE nom_artiste LIKE :q ORDER BY nom_artiste ASC";
        
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([":q" => "%$q%"]);

        $artistes = [];
        foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
            $artistes[] = new Artiste(
                $row['id_artiste'],
                $row['nom_artiste'],
                '',
                $row['img_path'],
                $row['img_page_path'],
                $row['img_title_path']
            );
        }
        return $artistes;
    }

    public function getProduitsByArtiste($idArtiste)
    {
        $sql = "
            SELECT p.id_produit, p.nom_produit, p.description, p.prix_unitaire, p.stock, p.img_path, p.img_disk_path,
                   GROUP_CONCAT(DISTINCT a.id_artiste) AS artiste_ids,
                   GROUP_CONCAT(DISTINCT a.nom_artiste SEPARATOR ', ') AS nom_artiste,
                   c.id_categorie, c.nom_categorie
            FROM produits p
            LEFT JOIN produit_artiste pa ON p.id_produit = pa.id_produit
            LEFT JOIN produit_categorie pc ON p.id_produit = pc.id_produit
            LEFT JOIN categorieproduit c ON pc.id_categorie = c.id_categorie
            LEFT JOIN produit_artiste pa2 ON p.id_produit = pa2.id_produit
            LEFT JOIN artiste a ON pa2.id_artiste = a.id_artiste
            WHERE pa.id_artiste = :idArtiste
            GROUP BY p.id_produit
            ORDER BY p.id_produit DESC
        ";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':idArtiste' => (int) $idArtiste]);

        $produits = [];
        foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
            $produits[] = $this->hydrateProduit($row);
        }
        return $produits;
    }
}
