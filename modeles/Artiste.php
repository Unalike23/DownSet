<?php

class Artiste
{
    private $id;
    private $nom;
    private $description;
    private $imagePath;
    private $imagePagePath;
    private $imageTitlePath;
    public $genres = [];
    public $albums = [];

    public function __construct(
        $id = null,
        $nom = '',
        $description = '',
        $imagePath = null,
        $imagePagePath = null,
        $imageTitlePath = null
    ) {
        $this->id = $id;
        $this->nom = $nom;
        $this->description = $description;
        $this->imagePath = $imagePath;
        $this->imagePagePath = $imagePagePath;
        $this->imageTitlePath = $imageTitlePath;
    }

    public function getId() { return $this->id; }
    public function getNom() { return $this->nom; }
    public function getDescription() { return $this->description; }
    public function getImagePath() { return $this->imagePath; }
    public function getImagePagePath() { return $this->imagePagePath; }
    public function getImageTitlePath() { return $this->imageTitlePath; }

    public function setNom($nom) { $this->nom = $nom; }
    public function setDescription($desc) { $this->description = $desc; }
    public function setImagePath($path) { $this->imagePath = $path; }
    public function setImagePagePath($path) { $this->imagePagePath = $path; }
    public function setImageTitlePath($path) { $this->imageTitlePath = $path; }
}
