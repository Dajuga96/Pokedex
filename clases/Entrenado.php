<?php


class Entrenado extends Pokemon {

    private $entrenador;
    private $nombre;

    public function __construct($id,$entrenador,$nombre) {
        parent::__construct($id);
        $this->entrenador = $entrenador;
        $this->nombre = $nombre;
    }

    public function getEntrenador() {
        return $this->entrenador;
    }

    public function setEntrenador($entrenador) {
        $this->entrenador = $entrenador;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }
}
?>