<?php
//LÓGICA DE NEGOCIO

function dump($var){
    echo '<pre>'.print_r($var,1).'</pre>';
}

function readFileCSV($file) {
    $dashboard = [];
    while ($material = fgetcsv($file)) {
        $dashboard [] = $material;
    };
    fclose($file);
    return $dashboard;
}

function getDashboardMarkup ($dasboardData, $characterPosition, $treassurePosition) {
    $output = '';
    $cont = 0;
    foreach ($dasboardData as $rowIndex => $rowData){
        foreach ($rowData as $columnIndex => $tileType){
            $output .= '<div class="tile ' . $tileType . '">';
            
            if ($characterPosition == $treassurePosition && $characterPosition == $cont) {
                $output .= '<img src="trophie.png">';
            }else{
                if ($characterPosition == $cont) {
                    $output .= '<img src="phoenix.png">';
                }
                if ($treassurePosition == $cont) {
                    $output .= '<img src="treassure.png">';
                }
            }

            $output .= '</div>';
            $cont++;
        }   
    }
    return $output;
}

function mapPosition ($row, $column){
    return (($row*12-12) + ($column - 1));
}

function getArrowsMarkup ($characterPosition) {
    $output = '';
    $characterRow = floor($characterPosition / 12 + 1);
    $characterColumn = ($characterPosition+12) - (12*$characterRow) + 1;

    $output .= '<div></div>';
    //FLECHA HACIA ARRIBA
    if ($characterRow != 1) {
        $output .= '<div><a href="index.php?row=' . ($characterRow-1) . '&col=' . $characterColumn. '">⬆️</a></div>';
    }else{
        $output .= '<div></div>'; 
    }
    $output .= '<div></div>';
    //FLECHA HACIA IZQUIERDA
    if ($characterColumn != 1) {
        $output .= '<div><a href="index.php?row=' . $characterRow . '&col=' . ($characterColumn-1). '">⬅️</a></div>';
    }else{
        $output .= '<div></div>';
    }
    $output .= '<div></div>';
    //FLECHA HACIA DERECHA
    if ($characterColumn != 12) {
        $output .= '<div><a href="index.php?row=' . $characterRow . '&col=' . ($characterColumn+1). '">➡️</a></div>';
    }else{
        $output .= '<div></div>';
    }
    //FLECHA HACIA ARRIBA
    $output .= '<div></div>';
    if ($characterRow != 12) {
        $output .= '<div><a href="index.php?row=' . ($characterRow+1) . '&col=' . $characterColumn. '">⬇️</a></div>';
    }else{
        $output .= '<div></div>';
    }
    $output .= '<div></div>';



    return $output;
}

function generatePosition() {
    if(!isset($_GET['row']) && !isset($_GET['col'])){
        return mapPosition(9, 3);
    } else {
        return mapPosition($_GET['row'], $_GET['col']);
    }
}


function getWinMessage($characterPosition, $treassurePosition) {
    if ($characterPosition == $treassurePosition){
        return '<p>You won!</p>';
    }else{
        return '<p></p>';
    }
}

?>