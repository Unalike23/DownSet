<?php

class Utilisateur
{
    private $id;
    private $nom;
    private $prenom;
    private $email;
    private $telephone;
    private $isAdmin;
    private $dateInscription;

    public function __construct($id = null, $nom = '', $prenom = '', $email = '', $isAdmin = false, $dateInscription = null, $telephone = null)
    {
        $this->id = $id;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->email = $email;
        $this->isAdmin = $isAdmin;
        $this->dateInscription = $dateInscription;
        $this->telephone = $telephone;
    }

    public function getId() { return $this->id; }
    public function getNom() { return $this->nom; }
    public function getPrenom() { return $this->prenom; }
    public function getEmail() { return $this->email; }
    public function getTelephone() { return $this->telephone; }
    public function isAdmin() { return $this->isAdmin; }
    public function getDateInscription() { return $this->dateInscription; }

    public function setNom($nom) { $this->nom = $nom; }
    public function setPrenom($prenom) { $this->prenom = $prenom; }
    public function setEmail($email) { $this->email = $email; }
    public function setIsAdmin($isAdmin) { $this->isAdmin = $isAdmin; }

    public function getFullName()
    {
        return trim($this->prenom . ' ' . $this->nom);
    }
}
