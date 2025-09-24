<?php
//INICIALIZACIÓN DEL ENTORNO
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


//Función lógica presentación
function getTableroMarkup($tableroData){
    $output = '';
    foreach($tableroData as $filaIndex => $datosFila){
        foreach($datosFila as $columnaIndex => $tileType){
            $output .= '<div class="tile '.$tileType.'"></div>';
        }
    }
    return $output;
}


//LÓGICA DE NEGOCIO
//El tablero es un array bidimensional en el que cada fila contiene 12 palabras cuyos
//valores pueden ser : agua, fuego, tierra, hierba
$tablero = [
    ['agua', 'fuego',  'fuego', 'tierra', 'agua', 'fuego',  'fuego', 'tierra', 'agua', 'fuego',  'fuego', 'tierra'],
    ['agua', 'fuego',  'fuego', 'tierra', 'agua', 'fuego',  'fuego', 'tierra', 'agua', 'fuego',  'fuego', 'tierra'],
    ['agua', 'fuego',  'fuego', 'tierra', 'agua', 'fuego',  'fuego', 'tierra', 'agua', 'fuego',  'fuego', 'tierra'],
    ['agua', 'fuego',  'fuego', 'tierra', 'agua', 'fuego',  'fuego', 'tierra', 'agua', 'fuego',  'fuego', 'tierra'],
    ['agua', 'fuego',  'fuego', 'tierra', 'agua', 'fuego',  'fuego', 'tierra', 'agua', 'fuego',  'fuego', 'tierra'],
    ['agua', 'fuego',  'fuego', 'tierra', 'agua', 'fuego',  'fuego', 'tierra', 'agua', 'fuego',  'fuego', 'tierra'],
    ['agua', 'fuego',  'fuego', 'tierra', 'agua', 'fuego',  'fuego', 'tierra', 'agua', 'fuego',  'fuego', 'tierra'],
    ['agua', 'fuego',  'fuego', 'tierra', 'agua', 'fuego',  'fuego', 'tierra', 'agua', 'fuego',  'fuego', 'tierra'],
    ['agua', 'fuego',  'fuego', 'tierra', 'agua', 'fuego',  'fuego', 'tierra', 'agua', 'fuego',  'fuego', 'tierra'],
    ['agua', 'fuego',  'fuego', 'tierra', 'agua', 'fuego',  'fuego', 'tierra', 'agua', 'fuego',  'fuego', 'tierra'],
    ['agua', 'fuego',  'fuego', 'tierra', 'agua', 'fuego',  'fuego', 'tierra', 'agua', 'fuego',  'fuego', 'tierra'],
    ['agua', 'fuego',  'fuego', 'tierra', 'agua', 'fuego',  'fuego', 'tierra', 'agua', 'fuego',  'fuego', 'tierra'],
];


//LÓGICA DE PRESENTACIÓN
$tableroMarkup = getTableroMarkup ($tablero);

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
            width:604px;
            height: 604px;
            border-radius: 5px;
            border: solid 2px white;
            box-shadow: grey;
        }
        .tile{
            width: 50px;
            height: 50px;
            float:left;
            margin:0;
            padding:0;
            border-width:0;
        }
        .fuego{
            background-color:red;
        }
        .tierra{
            background-color:brown;
        }
        .agua{
            background-color:blue;
        }
    </style>
</head>
<body>
    <h1>TABLERO DE VIDEOJUEGO</h1>

    <div class="contenerdorTablero">
        <?php echo $tableroMarkup; ?>
    </div>

</body>
</html>