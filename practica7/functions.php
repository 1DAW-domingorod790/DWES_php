<?php
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
    if(isset($fila, $col)) {
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
    } else {
        $output .= '';
    }
    return $output;
}

//LÓGICA DE NEGOCIO
//El tablero es un array bidimensional en el que cada fila contiene 12 palabras cuyos
//valores pueden ser : agua, fuego, tierra, hierba


function leerArchivo ($archivoTablero) {
    $tablero = [];
    while($material = fgetcsv($archivoTablero)) {
        $tablero [] = $material;
        
    };
    fclose($archivoTablero);;
    return $tablero;
};

function posicionInvalida($personajeAComprobar) {
    if(!isset($personajeAComprobar)) {
        return '<p>Posiciones inválidas.</p>';
    }else{
        return '';
    }
}

function mapPosition($fila, $col) {
    return (($fila*12-12) + ($col-1));
}

?>