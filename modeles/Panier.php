<?php

class Panier
{
    private $id;
    private $utilisateur;
    private $articles = [];
    private $dateCreation;

    public function __construct($id = null, ?Utilisateur $utilisateur = null, $dateCreation = null)
    {
        $this->id = $id;
        $this->utilisateur = $utilisateur;
        $this->dateCreation = $dateCreation;
    }

    public function getId() { return $this->id; }
    public function getUtilisateur() { return $this->utilisateur; }
    public function getArticles() { return $this->articles; }
    public function getDateCreation() { return $this->dateCreation; }

    public function setUtilisateur(Utilisateur $user) { $this->utilisateur = $user; }
    public function setDateCreation($date) { $this->dateCreation = $date; }

    public function addArticle(Produit $produit, $quantite = 1)
    {
        foreach ($this->articles as $article) {
            if ($article['produit']->getId() === $produit->getId()) {
                $article['quantite'] += $quantite;
                return;
            }
        }
        $this->articles[] = [
            'produit' => $produit,
            'quantite' => (int) $quantite
        ];
    }

    public function removeArticle($idProduit)
    {
        $this->articles = array_filter($this->articles, fn($a) => $a['produit']->getId() !== $idProduit);
    }

    public function updateQuantite($idProduit, $quantite)
    {
        foreach ($this->articles as &$article) {
            if ($article['produit']->getId() === $idProduit) {
                $article['quantite'] = (int) $quantite;
                return;
            }
        }
    }

    public function clear()
    {
        $this->articles = [];
    }

    public function getTotalPrix()
    {
        $total = 0;
        foreach ($this->articles as $article) {
            $total += $article['produit']->getPrix() * $article['quantite'];
        }
        return $total;
    }

    public function getTotalQuantite()
    {
        return array_sum(array_map(fn($a) => $a['quantite'], $this->articles));
    }

    public function isEmpty()
    {
        return empty($this->articles);
    }
}
