<?php

class Genre
{
    private $id;
    private $nom;
    private $description;

    public function __construct($id = null, $nom = '', $description = '')
    {
        $this->id = $id;
        $this->nom = $nom;
        $this->description = $description;
    }

    public function getId() { return $this->id; }
    public function getNom() { return $this->nom; }
    public function getDescription() { return $this->description; }

    public function setNom($nom) { $this->nom = $nom; }
    public function setDescription($desc) { $this->description = $desc; }
}
