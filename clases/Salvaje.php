<?php


class Salvaje extends Pokemon {

    private $nombre;
    private $region;
    private $tipo;

    public function __construct($id, $nombre, $region, $tipo) {
        parent::__construct($id);
        $this->nombre = $nombre;
        $this->region = $region;
        $this->tipo = $tipo;
    }   

    public function getNombre() {
        return $this->nombre;
    }

    public function getRegion() {
        return $this->region;
    }

    public function getTipo() {
        return $this->tipo;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function setRegion($region) {
        $this->region = $region;
    }
    public function setTipo($tipo) {
        $this->tipo = $tipo;
    }
}

?>