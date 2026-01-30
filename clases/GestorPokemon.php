<?php

class GestorPokemon {
    

    public function __construct() {
        if (!isset($_SESSION['pokedex'])) {
            $_SESSION['pokedex'] = [];
        }
    }

    public function agregarPokemon ($pokemon) {
         $_SESSION['pokedex'][] = $pokemon;
    }

    public function listarPokemons() {
        return $_SESSION['pokedex'];
    }

    public function buscarPokemon($id) {
        foreach ( $_SESSION['pokedex'] as $pokemon) {
            if ($pokemon->getId() == $id) {
                return $pokemon;
            }
        }
    }

    public function actualizarEntrenado ($id, $entrenador, $nombre) {
        foreach ($_SESSION['pokedex'] as $i => $pokemon) {
            if ($pokemon->getId () == $id) {
                $_SESSION['pokedex'][$i]->setEntrenador ($entrenador);
                $_SESSION['pokedex'][$i]->setNombre ($nombre);
            }       
            }
        }


    public function actualizarSalvaje ($id, $nombre, $region, $tipo) {
        foreach ($_SESSION['pokedex'] as $i => $pokemon) {
            if ($pokemon->getId () == $id) {
                $_SESSION['pokedex'][$i]->setNombre ($nombre);
                $_SESSION['pokedex'][$i]->setRegion ($region);
                $_SESSION['pokedex'][$i]->setTipo ($tipo);       
            }
        }
    }

    public function eliminarPokemon($id) {
        foreach ($_SESSION['pokedex'] as $i => $pokemon) {
            if ($pokemon->getId() == $id) {
                unset($_SESSION['pokedex'][$i]);
                $_SESSION['pokedex'] = array_values($_SESSION['pokedex']);
        }
    }
    }
}    
?>
