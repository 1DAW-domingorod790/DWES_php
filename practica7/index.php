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
            
            if(isset ($personaje)){
                if($cont == $personaje) {
                    $output .= '<img src="phoenix.png">';
                }
            }

            $output .= '</div>';
            $cont++;
        }
    }
    return $output;
}

function getArrowsMarkup($fila, $col){
    $output = '';
    $output .= '<div></div>';
    //BOTÓN A ARRIBA
    if ($fila == 1) {
        $output .= '<div></div>';
    }else{
        $output .= '<a href="index.php?fila=' . $fila-1 . '&col=' . $col . '">⬆️</a>';
    }
    $output .= '<div></div>';
    //BOTÓN A IZQUIERDA
    if ($col == 1) {
        $output .= '<div></div>';
    } else{
        $output .= '<a href="index.php?fila=' . $fila . '&col=' . $col-1 . '">⬅️</a>';
    }
    $output .= '<div></div>';
    //BOTÓN A DERECHA
    if ($col == 12) {
        $output .= '<div></div>';
    }else{
        $output .= '<a href="index.php?fila=' . $fila . '&col=' . $col+1 . '">➡️</a>';
    }
    $output .= '<div></div>';
    //BOTÓN A ABAJO
    if ($fila == 12) {
        $output .= '<div></div>';
    }else{
        $output .= '<a href="index.php?fila=' . $fila+1 . '&col=' . $col . '">⬇️</a>';
    }
    $output .= '<div></div>';
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
    fclose($archivoTablero);;
    return $tablero;
};

$tablero = leerArchivo($archivoTablero);

$personaje = null;

if ((isset($_GET['fila']) && isset($_GET['col'])) && ($_GET['fila'] > 0) && ($_GET['fila'] < 13) && ($_GET['col'] > 0) && ($_GET['col'] < 13)){
    $fila = $_GET['fila'];
    $col = $_GET['col'];
    $personaje = (($fila*12-12) + ($col-1));
}

function posicionInvalida($personajeAComprobar) {
    if(!isset($personajeAComprobar)) {
        return '<p>Posiciones inválidas.</p>';
    }else{
        return '';
    }
}


//LÓGICA DE PRESENTACIÓN
$tableroMarkup = getTableroMarkup ($tablero, $personaje);
$mensajeErrorPosiciones = posicionInvalida($personaje);
$arrowsMarkup = getArrowsMarkup($fila, $col);
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
        .flechas{
            display: grid;
            grid-template-rows: repeat(3, 1fr);
            grid-template-columns: repeat(3, 1fr);
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
    <div class="mensaje-usuario">
        <?php
            echo $mensajeErrorPosiciones;
        ?>
    </div>
    <div class="flechas">
        <?php
            echo $arrowsMarkup;
        ?>
    </div>
</body>
</html>