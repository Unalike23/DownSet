<?php

class Commande
{
    private $id;
    private $utilisateur;
    private $adresse;
    private $dateCommande;
    private $dateExpedition;
    private $dateArrivee;
    private $total;
    private $statut;
    private $modePaiement;
    private $lignes = [];

    public function __construct(
        $id = null,
        ?Utilisateur $utilisateur = null,
        ?Adresse $adresse = null,
        $dateCommande = null,
        $dateExpedition = null,
        $dateArrivee = null,
        $total = 0,
        $statut = 'Préparation',
        $modePaiement = 'CB'
    ) {
        $this->id = $id;
        $this->utilisateur = $utilisateur;
        $this->adresse = $adresse;
        $this->dateCommande = $dateCommande;
        $this->dateExpedition = $dateExpedition;
        $this->dateArrivee = $dateArrivee;
        $this->total = (float) $total;
        $this->statut = $statut;
        $this->modePaiement = $modePaiement;
    }

    public function getId() { return $this->id; }
    public function getUtilisateur() { return $this->utilisateur; }
    public function getAdresse() { return $this->adresse; }
    public function getDateCommande() { return $this->dateCommande; }
    public function getDateExpedition() { return $this->dateExpedition; }
    public function getDateArrivee() { return $this->dateArrivee; }
    public function getTotal() { return $this->total; }
    public function getStatut() { return $this->statut; }
    public function getModePaiement() { return $this->modePaiement; }
    public function getLignes() { return $this->lignes; }

    public function setUtilisateur(Utilisateur $user) { $this->utilisateur = $user; }
    public function setAdresse(Adresse $adresse) { $this->adresse = $adresse; }
    public function setDateCommande($date) { $this->dateCommande = $date; }
    public function setDateExpedition($date) { $this->dateExpedition = $date; }
    public function setDateArrivee($date) { $this->dateArrivee = $date; }
    public function setTotal($total) { $this->total = (float) $total; }
    public function setStatut($statut) { $this->statut = $statut; }
    public function setModePaiement($mode) { $this->modePaiement = $mode; }

    public function addLigne(LigneCommande $ligne)
    {
        $this->lignes[] = $ligne;
    }

    public function setLignes(array $lignes)
    {
        $this->lignes = $lignes;
    }

    public function getDeliveryStatus()
    {
        if (!$this->dateCommande) return 'Inconnu';
        
        $orderDate = new DateTime($this->dateCommande);
        $today = new DateTime();
        $daysElapsed = $today->diff($orderDate)->days;

        if ($daysElapsed >= 7) {
            return 'Reçu';
        } elseif ($daysElapsed >= 2) {
            return 'En chemin';
        } else {
            return 'Préparation';
        }
    }

    public function calculateTotal()
    {
        $this->total = 0;
        foreach ($this->lignes as $ligne) {
            $this->total += $ligne->getTotal();
        }
        return $this->total;
    }
}
