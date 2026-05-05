<?php

class Produit
{
    private $id;
    private $nom;
    private $description;
    private $prix;
    private $stock;
    private $imageCouverture;
    private $imageDisk;
    private $artistes = [];
    private $genres = [];
    private $categorie;

    public function __construct(
        $id = null,
        $nom = '',
        $description = '',
        $prix = 0,
        $stock = 0,
        $imageCouverture = null,
        $imageDisk = null,
        $categorie = null
    ) {
        $this->id = $id;
        $this->nom = $nom;
        $this->description = $description;
        $this->prix = (float) $prix;
        $this->stock = (int) $stock;
        $this->imageCouverture = $imageCouverture;
        $this->imageDisk = $imageDisk;
        $this->categorie = $categorie;
    }

    public function getId() { return $this->id; }
    public function getNom() { return $this->nom; }
    public function getDescription() { return $this->description; }
    public function getPrix() { return $this->prix; }
    public function getStock() { return $this->stock; }
    public function getImageCouverture() { return $this->imageCouverture; }
    public function getImageDisk() { return $this->imageDisk; }
    public function getCategorie() { return $this->categorie; }
    public function getArtistes() { return $this->artistes; }
    public function getGenres() { return $this->genres; }

    public function setNom($nom) { $this->nom = $nom; }
    public function setDescription($desc) { $this->description = $desc; }
    public function setPrix($prix) { $this->prix = (float) $prix; }
    public function setStock($stock) { $this->stock = (int) $stock; }
    public function setImageCouverture($path) { $this->imageCouverture = $path; }
    public function setImageDisk($path) { $this->imageDisk = $path; }
    public function setCategorie($cat) { $this->categorie = $cat; }
    public function setArtistes(array $artistes) { $this->artistes = $artistes; }
    public function setGenres(array $genres) { $this->genres = $genres; }

    public function addArtiste(Artiste $artiste)
    {
        if (!in_array($artiste, $this->artistes)) {
            $this->artistes[] = $artiste;
        }
    }

    public function addGenre(Genre $genre)
    {
        if (!in_array($genre, $this->genres)) {
            $this->genres[] = $genre;
        }
    }

    public function getArtistesNoms()
    {
        return implode(', ', array_map(fn($a) => $a->getNom(), $this->artistes));
    }

    public function getGenresNoms()
    {
        return implode(', ', array_map(fn($g) => $g->getNom(), $this->genres));
    }

    public function getCategorieNom()
    {
        return $this->categorie ? $this->categorie->getNom() : '';
    }

    public function getCoverUrl()
    {
        return !empty($this->imageCouverture) 
            ? BASE_URL . $this->imageCouverture 
            : BASE_URL . 'images/default.jpg';
    }

    public function getDiscUrl()
    {
        if (!empty($this->imageDisk)) {
            return BASE_URL . $this->imageDisk;
        }

        $categorie = strtolower($this->getCategorieNom());
        if (strpos($categorie, 'vinyle') !== false) {
            return BASE_URL . 'images/vinyl.png';
        } elseif (strpos($categorie, 'cd') !== false) {
            return BASE_URL . 'images/cd.png';
        } elseif (strpos($categorie, 'cassette') !== false) {
            return BASE_URL . 'images/cassette.png';
        }

        return null; // Pas de disque par défaut
    }
}
