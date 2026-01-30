<?php
require_once 'autoload.php';
session_start();

$gestor = new GestorPokemon();

$pokemons = $gestor->listarPokemons();  

$accion = $_GET['accion'] ?? null;

if ($accion == 'crear') {
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

    $gestor->agregarPokemon($pokemon);

    header('Location: index.php');
    exit();
    
}

if ($accion == 'editarEntrenado') {
    $gestor-> actualizarEntrenado($_POST['id'], $_POST['entrenador'], $_POST['nombre']);
    header('Location: index.php');   
    exit();
}

if ($accion == 'editarSalvaje') {
    $gestor-> actualizarSalvaje($_POST['id'], $_POST['region'], $_POST['tipo'], $_POST['nombre']);
    header('Location: index.php');   
    exit();
}

if ($accion == 'eliminar') {
    $gestor->eliminarPokemon($_GET['id']);
    header('Location: index.php');   
    exit();
}

?>

<!DOCTYPE html>
<html>
    <head>
        <title>CRUD</title>
    </head>
    <body>
        <h1>Gestor de Pokemons</h1>
        
        <hr>
        <h2>Listado de Pokemons</h2>
            <form method="POST" action="index.php?accion=crear">
                <label>ID:</label>
                <input type="number" name="id" required>
                <br><br>

                <label>Clase de Pokemon:</label>
                <select name="tipoPokemon" required>
                    <option value="entrenado">Entrenado</option>
                    <option value="salvaje">Salvaje</option>
                </select>
                <br><br>

                <label>Nombre:</label>
                <input type="text" name="nombre" required>
                <br><br>

                <label>Entrenador (Solo si es Entrenado):</label>
                <input type="text" name="entrenador">
                <br><br>

                <label>Región (Solo si es Salvaje):</label>
                <input type="text" name="region">
                <br><br>

                <label>Tipo (Solo si es Salvaje):</label>
                <input type="text" name="tipo">
                <br><br>

                <input type="submit" value="Añadir Pokemon">
            </form>

        <h3>Entrenados</h3>
        <table border="1" cellpadding="5">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Entrenador</th>
                    <th>Acciones</th> </tr>
            </thead>
            <tbody>
            <?php foreach ($pokemons as $pokemon): ?>
                <?php if (get_class($pokemon) == 'Entrenado'): ?>
                <tr>
                    <td><?= $pokemon->getId() ?></td>
                    <td><?= $pokemon->getNombre() ?></td>
                    <td><?= $pokemon->getEntrenador() ?></td>
                    
                    <td>
                        <form method="POST" action="index.php?accion=editarEntrenado">
                            <input type="hidden" name="id" value="<?= $pokemon->getId() ?>">
                            <input type="text" name="entrenador" value="<?= $pokemon->getEntrenador() ?>">
                            <input type="text" name="nombre" value="<?= $pokemon->getNombre() ?>" placeholder="Nombre">
                            <input type="submit" value="Guardar Cambios">
                            <a href="index.php?accion=eliminar&id=<?= $pokemon->getId() ?>">Eliminar</a>
                        </form>
                    </td>
                </tr>
                <?php endif; ?>
            <?php endforeach; ?>
            </tbody>
        </table> <h3>Salvajes</h3>
        <table border="1" cellpadding="5">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tipo</th>
                    <th>Nombre</th>
                    <th>Región</th>
                    <th>Acciones</th> </tr>
            </thead>
            <tbody>
            <?php foreach ($pokemons as $pokemon): ?>
                <?php if (get_class($pokemon) == 'Salvaje'): ?>
                <tr>
                    <td><?= $pokemon->getId() ?></td>
                    <td><?= $pokemon->getTipo() ?></td>
                    <td><?= $pokemon->getNombre() ?></td>
                    <td><?= $pokemon->getRegion() ?></td>
                    
                    <td>
                        <form method="POST" action="index.php?accion=editarSalvaje">
                            <input type="hidden" name="id" value="<?= $pokemon->getId() ?>">
                            <input type="text" name="region" value="<?= $pokemon->getRegion() ?>" placeholder="Región">
                            <input type="text" name="tipo" value="<?= $pokemon->getTipo() ?>" placeholder="Tipo">
                            <input type="hidden" name="nombre" value="<?= $pokemon->getNombre() ?>"> 
                            <input type="submit" value="Guardar Cambios">
                            <a href="index.php?accion=eliminar&id=<?= $pokemon->getId() ?>">Eliminar</a>
                        </form>
                    </td>
                </tr>               
                <?php endif; ?>
            <?php endforeach; ?>    
            </tbody>
        </table>
           
    </body>
</html>