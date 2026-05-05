<?php

class LigneCommande
{
    private $id;
    private $produit;
    private $quantite;
    private $prixUnitaire;

    public function __construct($id = null, ?Produit $produit = null, $quantite = 1, $prixUnitaire = 0)
    {
        $this->id = $id;
        $this->produit = $produit;
        $this->quantite = (int) $quantite;
        $this->prixUnitaire = (float) $prixUnitaire;
    }

    public function getId() { return $this->id; }
    public function getProduit() { return $this->produit; }
    public function getQuantite() { return $this->quantite; }
    public function getPrixUnitaire() { return $this->prixUnitaire; }

    public function setProduit(Produit $produit) { $this->produit = $produit; }
    public function setQuantite($quantite) { $this->quantite = (int) $quantite; }
    public function setPrixUnitaire($prix) { $this->prixUnitaire = (float) $prix; }

    public function getTotal()
    {
        return $this->quantite * $this->prixUnitaire;
    }
}
