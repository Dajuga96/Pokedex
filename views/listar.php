<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Pokedex MVC</title>
    <link rel="preconnect" href="https://fonts.googleapis.com/css2?family=Luckiest+Guy&family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles/styles.css"> 
</head>
<body>
    <h1>Gestor de Pokemons</h1>
    <hr>
    
 <h2>Capturar nuevo Pokémon</h2>

<div class="form-wrapper">
    
    <img src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/25.png" alt="Pikachu" class="poke-decor poke-left">

    <form method="POST" action="index.php?accion=crear" class="crear-form">
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
            <div>
                <label>ID:</label>
                <input type="number" name="id" required placeholder="Ej: 25">
            </div>
            <div>
                <label>Tipo de Carta:</label>
                <select name="tipoPokemon" required>
                    <option value="entrenado">Entrenado</option>
                    <option value="salvaje">Salvaje</option>
                </select>
            </div>
            <div>
                <label>Nombre del Pokémon:</label>
                <input type="text" name="nombre" required placeholder="Ej: Pikachu">
            </div>
            <div></div>
        </div>

        <hr style="border: 0; border-top: 1px dashed #ccc; margin: 20px 0;">
        <p style="font-size: 0.9rem; color: #666; margin-top:0;">Rellena solo los campos de tu tipo:</p>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
            <div>
                <label><strong>Si es Entrenado:</strong> Nombre del Dueño</label>
                <input type="text" name="entrenador" placeholder="Ej: Ash">
            </div>
            <div>
                <label><strong>Si es Salvaje:</strong> Región / Tipo</label>
                <input type="text" name="region" placeholder="Región">
                <input type="text" name="tipo" placeholder="Tipo" style="margin-top: 5px;">
            </div>
        </div>
        
        <br>
        <div style="text-align: center;">
            <input type="submit" value="¡Capturar Pokémon!">
        </div>
    </form>

    <img src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/6.png" alt="Charizard" class="poke-decor poke-right">

</div>

    <hr>
    <h2>Listado</h2>

    <h3>Entrenados</h3>
    <table border="1">
        <tr>
            <th>ID</th><th>Nombre</th><th>Entrenador</th><th>Acciones</th>
        </tr>
        <?php foreach ($pokemons as $p): ?>
            <?php if (get_class($p) == 'Entrenado'): ?>
            <tr>
                <td><?= $p->getId() ?></td>
                <td><?= $p->getNombre() ?></td>
                <td><?= $p->getEntrenador() ?></td>
                <td>
                    <form method="POST" action="index.php?accion=editar" style="display:inline;">
                        <input type="hidden" name="id" value="<?= $p->getId() ?>">
                        <input type="hidden" name="tipoPokemon" value="entrenado">
                        <input type="text" name="nombre" value="<?= $p->getNombre() ?>">
                        <input type="text" name="entrenador" value="<?= $p->getEntrenador() ?>">
                        <input type="submit" value="Guardar">
                    </form>
                    <a href="index.php?accion=eliminar&id=<?= $p->getId() ?>" style="color:red;">[X]</a>
                </td>
            </tr>
            <?php endif; ?>
        <?php endforeach; ?>
    </table>

    <h3>Salvajes</h3>
    <table border="1">
        <tr>
            <th>ID</th><th>Tipo</th><th>Nombre</th><th>Región</th><th>Acciones</th>
        </tr>
        <?php foreach ($pokemons as $p): ?>
            <?php if (get_class($p) == 'Salvaje'): ?>
            <tr>
                <td><?= $p->getId() ?></td>
                <td><?= $p->getTipo() ?></td>
                <td><?= $p->getNombre() ?></td>
                <td><?= $p->getRegion() ?></td>
                <td>
                    <form method="POST" action="index.php?accion=editar" style="display:inline;">
                        <input type="hidden" name="id" value="<?= $p->getId() ?>">
                        <input type="hidden" name="tipoPokemon" value="salvaje">
                        <input type="text" name="nombre" value="<?= $p->getNombre() ?>">
                        <input type="text" name="region" value="<?= $p->getRegion() ?>">
                        <input type="text" name="tipo" value="<?= $p->getTipo() ?>">
                        <input type="submit" value="Guardar">
                    </form>
                    <a href="index.php?accion=eliminar&id=<?= $p->getId() ?>" style="color:red;">[X]</a>
                </td>
            </tr>
            <?php endif; ?>
        <?php endforeach; ?>
    </table>
</body>
</html>