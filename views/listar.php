<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Pokedex MVC</title>
    <link rel="preconnect" href="https://fonts.googleapis.com/css2?family=Luckiest+Guy&family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles/styles.css"> 
</head>
<body>

    <h1 class="titulo-pokemon">Gestor de Pokemons</h1>

    <div class="container">
        
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

        <h2>Pokedex Actual (Página <?= $pagina ?>)</h2>

        <h3>⚡ Pokémon Entrenados</h3>
        <table border="0">
            <thead>
                <tr>
                    <th width="10%">ID</th>
                    <th width="20%">Nombre</th>
                    <th width="25%">Entrenador</th>
                    <th>Acciones</th> 
                </tr>
            </thead>
            <tbody>
            <?php if (!empty($pokemons)): ?>
                <?php foreach ($pokemons as $p): ?>
                    <?php if (get_class($p) == 'Entrenado'): ?>
                    <tr>
                        <td><strong>#<?= $p->getId() ?></strong></td>
                        <td><?= $p->getNombre() ?></td>
                        <td><?= $p->getEntrenador() ?></td>
                        <td>
                            <form method="POST" action="index.php?accion=editar" class="form-inline">
                                <input type="hidden" name="id" value="<?= $p->getId() ?>">
                                <input type="hidden" name="tipoPokemon" value="entrenado">
                                <input type="text" name="nombre" value="<?= $p->getNombre() ?>" placeholder="Nombre">
                                <input type="text" name="entrenador" value="<?= $p->getEntrenador() ?>" placeholder="Entrenador">
                                <input type="submit" value="💾">
                                <a href="index.php?accion=eliminar&id=<?= $p->getId() ?>" class="btn-borrar" onclick="return confirm('¿Seguro?');">🗑️ Borrar</a>
                            </form>
                        </td>
                    </tr>
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="4">No hay Pokémon.</td></tr>
            <?php endif; ?>
            </tbody>
        </table> 

        <h3>🌿 Pokémon Salvajes</h3>
        <table border="0">
            <thead>
                <tr>
                    <th width="10%">ID</th>
                    <th width="15%">Tipo</th>
                    <th width="20%">Nombre</th>
                    <th width="15%">Región</th>
                    <th>Acciones</th> 
                </tr>
            </thead>
            <tbody>
            <?php if (!empty($pokemons)): ?>
                <?php foreach ($pokemons as $p): ?>
                    <?php if (get_class($p) == 'Salvaje'): ?>
                    <tr>
                        <td><strong>#<?= $p->getId() ?></strong></td>
                        <td><span style="background:#eee; padding:3px 8px; border-radius:10px; font-size:0.8rem;"><?= $p->getTipo() ?></span></td>
                        <td><?= $p->getNombre() ?></td>
                        <td><?= $p->getRegion() ?></td>
                        <td>
                            <form method="POST" action="index.php?accion=editar" class="form-inline">
                                <input type="hidden" name="id" value="<?= $p->getId() ?>">
                                <input type="hidden" name="tipoPokemon" value="salvaje">
                                <input type="text" name="nombre" value="<?= $p->getNombre() ?>">
                                <input type="text" name="region" value="<?= $p->getRegion() ?>">
                                <input type="hidden" name="tipo" value="<?= $p->getTipo() ?>">
                                <input type="submit" value="💾">
                                <a href="index.php?accion=eliminar&id=<?= $p->getId() ?>" class="btn-borrar" onclick="return confirm('¿Seguro?');">🗑️ Borrar</a>
                            </form>
                        </td>
                    </tr>               
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php endif; ?>
            </tbody>
        </table>

        <?php if (isset($totalPaginas) && $totalPaginas > 1): ?>
        <div class="paginacion-container">
            <span class="info-paginas">Página <?= $pagina ?> de <?= $totalPaginas ?></span>
            <div class="paginacion">
                <?php if ($pagina > 1): ?>
                    <a href="index.php?accion=index&pagina=<?= $pagina - 1 ?>" class="btn-pag">&laquo; Anterior</a>
                <?php endif; ?>

                <?php for ($i = 1; $i <= $totalPaginas; $i++): ?>
                    <?php if ($i == $pagina): ?>
                        <span class="btn-pag activo"><?= $i ?></span>
                    <?php else: ?>
                        <a href="index.php?accion=index&pagina=<?= $i ?>" class="btn-pag"><?= $i ?></a>
                    <?php endif; ?>
                <?php endfor; ?>

                <?php if ($pagina < $totalPaginas): ?>
                    <a href="index.php?accion=index&pagina=<?= $pagina + 1 ?>" class="btn-pag">Siguiente &raquo;</a>
                <?php endif; ?>
            </div>
        </div>
        <?php endif; ?>
    
    </div>

</body>
</html>