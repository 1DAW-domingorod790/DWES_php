<?php
//INICIALIZACIÓN DEL ENTORNO
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

function dump($var){
    echo '<pre>'.print_r($var,1).'</pre>';
}

//Función lógica presentación
function getTableroMarkup($tableroData, $personaje){
    $cont = 0;
    $output = '';
    foreach($tableroData as $filaIndex => $datosFila){
        foreach($datosFila as $columnaIndex => $tileType){
            $output .= '<div class="tile '.$tileType.'">';
            
            if($cont == $personaje) {
                $output .= '<img src="phoenix.png">"';
            }

            $output .= '</div>';
            $cont++;
        }
    }
    return $output;
}

//LÓGICA DE NEGOCIO
//El tablero es un array bidimensional en el que cada fila contiene 12 palabras cuyos
//valores pueden ser : agua, fuego, tierra, hierba
$archivoTablero = fopen('tablero.csv', 'r');

function leerArchivo ($archivoTablero) {
    $tablero = [];
    while($material = fgetcsv($archivoTablero)) {
        $tablero [] = $material;
        
    };
    fclose($archivoTablero);
    return $tablero;
};

$tablero = leerArchivo($archivoTablero);

$personaje = rand(0, 143);

//LÓGICA DE PRESENTACIÓN
$tableroMarkup = getTableroMarkup ($tablero, $personaje);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Minified version -->
    <link rel="stylesheet" href="https://cdn.simplecss.org/simple.min.css">
    <style>
        .contenedorTablero{
            width: 600px;
            height: 600px;
            border: 2px solid white;
            display: grid;
            grid-template-rows: repeat(12, 1fr);
            grid-template-columns: repeat(12, 1fr);
        }
        .tile{
            width: 50px;
            height: 50px;
            margin:0;
            padding:0;
            border-width:0;
            background-image: url("464.jpg");
            background-size: 209px;
        }
        .fuego{
            background-position: -105px -52px;
        }
        .tierra{
            background-position: 103px 52px;        
        }
        .agua{
            background-position: -54px 0px;       
        }

        img{
            width: 50px;
            height: 50px;
        }
    </style>
</head>
<body>
    <h1>TABLERO DE VIDEOJUEGO</h1>
    <div class="contenedorTablero">
        <?php
            echo $tableroMarkup;
        ?>
    </div>
</body>
</html>