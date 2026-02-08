<?php


class PokedexController {
    private $gestor;

    public function __construct($gestor) {
        $this->gestor = $gestor;
    }

    public function index() {
        $pokemons = $this->gestor->listarPokemons();
        require 'views/listar.php';
    }

    public function crear() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {    
            $id = $_POST['id'];
            $tipoPokemon = $_POST['tipoPokemon'];

            if ($tipoPokemon == 'entrenado') {
                $entrenador = $_POST['entrenador'];
                $nombre = $_POST['nombre'];
                $pokemon = new Entrenado($id, $entrenador, $nombre);
            } elseif ($tipoPokemon == 'salvaje') {
                $nombre = $_POST['nombre'];
                $region = $_POST['region'];
                $tipo = $_POST['tipo'];
                $pokemon = new Salvaje($id, $nombre, $region, $tipo);
            }

            $this->gestor->agregarPokemon($pokemon);
            
            header('Location: index.php');
            exit();
        }
    }

    public function editar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $tipoPokemon = $_POST['tipoPokemon'];

            if ($tipoPokemon == 'entrenado') {
                $entrenador = $_POST['entrenador'];
                $nombre = $_POST['nombre'];
                $this->gestor->actualizarEntrenado($id, $entrenador, $nombre);
            } elseif ($tipoPokemon == 'salvaje') {
                $nombre = $_POST['nombre'];
                $region = $_POST['region'];
                $tipo = $_POST['tipo'];
                $this->gestor->actualizarSalvaje($id, $region, $tipo, $nombre);
            }

            header('Location: index.php');
            exit();
        }
    }

    public function eliminar() {
        $id = $_GET['id'] ?? null;
        
        if ($id) {
            $this->gestor->eliminarPokemon($id);
        }
        
        header('Location: index.php');
        exit();
    }
}
?>