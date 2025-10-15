<?php
function dump($var){
    echo '<pre>'.print_r($var,1).'</pre>';
}

//Función lógica de presentación
function getLaberintoMarkup($laberintoData, $posPersonaje) {
    $output = '';
    $cont = 0;
    foreach($laberintoData as $filaIndex => $filaData){
        foreach ($filaData as $columnaIndex => $tileType) {
            $output .= '<div class="tile '.$tileType.'">';
            if($cont == $posPersonaje) {
                $output .= '<img src="sova.webp">';
            }
            
            $output .= '</div>';
            $cont++;
        }
    }
    return $output;
}

function getFlechasMarkup ($laberintoData, $rowPersonaje, $colPersonaje) {
    $output = '';
    // dump($laberintoData);
    $output .= '<div></div>';

    if($rowPersonaje > 1) {
        foreach ($laberintoData as $rowIndex => $rowData){
            foreach ($rowData as $colIndex => $tileType) {
                if ($rowIndex+1 == $rowPersonaje-1 && $colIndex+1 == $colPersonaje){
                    if ($tileType == 'floor'){
                        $output .= '<div><a href="?row='.($rowPersonaje-1).'&col='.$colPersonaje.'">⬆️</a></div>';
                    }else{
                        $output .= '<div></div>';
                    }
                }
            }
        }
    }else{
        $output .= '<div></div>';
    }

    $output .= '<div></div>';

    if($colPersonaje > 1) {
        foreach ($laberintoData as $rowIndex => $rowData){
            foreach ($rowData as $colIndex => $tileType) {
                if ($colIndex+1 == ($colPersonaje-1) && $rowIndex+1 == $rowPersonaje){
                    if ($tileType == 'floor'){
                        $output .= '<div><a href="?row='.$rowPersonaje.'&col='.($colPersonaje-1).'">⬅️</a></div>';
                    }else{
                        $output .= '<div></div>';
                    }
                }
            }
        }
    }else{
        $output .= '<div></div>';
    }

    $output .= '<div></div>';

    if($colPersonaje < 11) {
        foreach ($laberintoData as $rowIndex => $rowData){
            foreach ($rowData as $colIndex => $tileType) {
                if ($colIndex+1 == $colPersonaje+1 && $rowIndex+1 == $rowPersonaje){
                    if ($tileType == 'floor'){
                        $output .= '<div><a href="?row='.$rowPersonaje.'&col='.($colPersonaje+1).'">➡️</a></div>';
                    }else{
                        $output .= '<div></div>';
                    }
                }
            }
        }
    }else{
        $output .= '<div></div>';
    }

    $output .= '<div></div>';

    if($rowPersonaje < 11) {
        foreach ($laberintoData as $rowIndex => $rowData){
            foreach ($rowData as $colIndex => $tileType) {
                if ($rowIndex+1 == $rowPersonaje+1 && $colIndex+1 == $colPersonaje){
                    if ($tileType == 'floor'){
                        $output .= '<div><a href="?row='.($rowPersonaje+1).'&col='.$colPersonaje.'">⬇️</a></div>';
                    }else{
                        $output .= '<div></div>';
                    }
                }
            }
        }
    }else{
        $output .= '<div></div>';
    }

    
    $output .= '<div></div>';

    return $output;
}

//LÓGICA DE NEGOCIO
function leerArchivo ($archivo) {
    $laberintoData = [];
    while($material = fgetcsv($archivo)) {
        $laberintoData[] = $material;
    }
    fclose($archivo);
    return $laberintoData;
}



function leerPosPersonaje(){
    if (isset($_GET['row']) && isset($_GET['col'])){
        return mapPosition($_GET['row'], $_GET['col']);
    } else {
        header("HTTP/1.1 308 Moved Permanently");
        header("Location: ?row=1&col=1");
        die();
    }
}

function getRow(){
    return $_GET['row'];
}

function getCol(){
    return $_GET['col'];
}

function mapPosition ($row, $col) {
    return (($row*10-10) + ($col-1));
}

function getMensajeVictoria ($row, $col) {
    if($row == 10 && $col == 9){
        return '<h3>Has escapado!🏆</h3>';
    }else{
        return '';
    }
}


?>