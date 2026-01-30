<?php

require_once 'autoload.php';

$miPokedex = new GestorPokemon();

for ($i=1; $i <= 25; $i++) {
    $entrenado=new Entrenado(($i*2)+1, " $i", $i*5);
    $miPokedex->agregarPokemon($entrenado);
 }

for ($i=1; $i <= 25; $i++) {
    $salvaje=new Salvaje(($i*2), $i*5, "Región $i", "Tipo $i");
    $miPokedex->agregarPokemon($salvaje);
 }

 var_dump($miPokedex);

 $miPokedex->actualizarEntrenado(3, "ACTUALIZADO", "ACTUALIZADO ");
 $miPokedex->actualizarSalvaje(2, "ACTUALIZADO", "ACTUALIZADO", "ACTUALIZADO");
 
 var_dump($miPokedex);   

$miPokedex->eliminarPokemon(20);
$miPokedex->eliminarPokemon(21);

var_dump($miPokedex);    

?>