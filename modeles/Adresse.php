<?php

class Adresse
{
    private $id;
    private $numeroRue;
    private $typeNumeroRue;
    private $rue;
    private $ville;
    private $codePostal;

    public function __construct($id = null, $numeroRue = '', $typeNumeroRue = '', $rue = '', $ville = '', $codePostal = '')
    {
        $this->id = $id;
        $this->numeroRue = $numeroRue;
        $this->typeNumeroRue = $typeNumeroRue;
        $this->rue = $rue;
        $this->ville = $ville;
        $this->codePostal = $codePostal;
    }

    public function getId() { return $this->id; }
    public function getNumeroRue() { return $this->numeroRue; }
    public function getTypeNumeroRue() { return $this->typeNumeroRue; }
    public function getRue() { return $this->rue; }
    public function getVille() { return $this->ville; }
    public function getCodePostal() { return $this->codePostal; }

    public function setNumeroRue($num) { $this->numeroRue = $num; }
    public function setTypeNumeroRue($type) { $this->typeNumeroRue = $type; }
    public function setRue($rue) { $this->rue = $rue; }
    public function setVille($ville) { $this->ville = $ville; }
    public function setCodePostal($code) { $this->codePostal = $code; }

    public function getFullAddress()
    {
        return trim($this->numeroRue . ' ' . $this->typeNumeroRue . ' ' . $this->rue) . ', ' . $this->codePostal . ' ' . $this->ville;
    }
}
