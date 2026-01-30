<?php

class GestorPokemon {
    protected $pokedex;

    public function __construct() {
        $this->pokedex = [];
    }

    public function agregarPokemon ($pokemon) {
        $this->pokedex [] = $pokemon;
    }

    public function listarPokemons() {
        return $this->pokedex;
    }

    public function buscarPokemon($id) {
        foreach ($this->pokedex as $pokemon) {
            if ($pokemon->getId() == $id) {
                return $pokemon;
            }
        }
    }

    public function actualizarEntrenado ($id, $entrenador, $nombre) {
        foreach ($this->pokedex as $i => $pokemon) {
            if ($pokemon->getId () == $id) {
                $this->pokedex [$i]->setEntrenador ($entrenador);
                $this->pokedex [$i]->setNombre ($nombre);
            }       
            }
        }


    public function actualizarSalvaje ($id, $nombre, $region, $tipo) {
        foreach ($this->pokedex as $i => $pokemon) {
            if ($pokemon->getId () == $id) {
                $this->pokedex [$i]->setNombre ($nombre);
                $this->pokedex [$i]->setRegion ($region);
                $this->pokedex [$i]->setTipo ($tipo);       
            }
        }
    }

    public function eliminarPokemon($id) {
        foreach ($this->pokedex as $i => $pokemon) {
            if ($pokemon->getId() == $id) {
                unset($this->pokedex[$i]);
                $this->pokedex = array_values($this->pokedex);
                return;
        }
    }
    }
}    
?>
