<?php
//INICIALIZACIÓN DEL ENTORNO
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once('functions.php');


//LÓGICA DE PRESENTACIÓN
$archivoLaberinto = fopen('laberinto.csv', 'r');
$laberintoData = leerArchivo($archivoLaberinto);
//dump($laberintoData);
$posPersonaje = leerPosPersonaje();
$row = getRow();
$col = getCol();
// dump($posPersonaje);
// dump($row);
// dump($col);
$laberintoMarkup = getLaberintoMarkup($laberintoData, $posPersonaje);
$flechasMarkup = getFlechasMarkup($laberintoData, $row, $col);
$mensajeVictoria = getMensajeVictoria($row, $col);
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Juego del laberinto</title>
    <link rel="stylesheet" href="https://cdn.simplecss.org/simple.min.css">
    <style>
        .contenedor-laberinto {
            width: 600px;
            height: 600px;
            border: 2px solid white;
            display: grid;
            grid-template-rows: repeat(10, 1fr);
            grid-template-columns: repeat(10, 1fr);
        }

        .tile{
            width: 59px;
            height: 59px;
            margin:0;
            padding:0;
            border-width:0;
            background-size: 200px;
        }

        .wall {
            background-image: url("wall.jpg");
        }

        .floor {
            background-image: url("floor.webp");
        }
        
        .container-flechas {
            display: grid;
            grid-template-rows: repeat(3, 1fr);
            grid-template-columns: repeat(3, 1fr);
        }

        .container-flechas > div {
            padding: 10px;
        }
    </style>
</head>
<body>
    <h1>JUEGO DEL LABERINTO</h1>
    <div class="mensaje-victoria">
        <?php
            echo $mensajeVictoria;
        ?>
    </div>
    <div class="contenedor-laberinto">
        <?php
            echo $laberintoMarkup;
        ?>
    </div>
    <div class="container-flechas">
        <?php
            echo $flechasMarkup;
        ?>
    </div>
</body>
</html>