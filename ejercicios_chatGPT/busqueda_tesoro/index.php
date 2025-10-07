<?php
//INICIALIZACIÓN DEL ENTORNO
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once('functions.php');

//LÓGICA DE NEGOCIO

$dashboardFile = fopen("tablero.csv", 'r');

$dashboardData = readFileCSV($dashboardFile);

$characterPosition = generatePosition();

session_start();

if (!isset($_SESSION['treassure'])) {
    $_SESSION['treassure'] = mapPosition(random_int(1, 12), random_int(1, 12));
}

//LÓGICA DE PRESENTACIÓN

$dashboardMarkup = getDashboardMarkup($dashboardData, $characterPosition, $_SESSION['treassure']);

$arrowsMarkup = getArrowsMarkup($characterPosition);

$winMessage = getWinMessage($characterPosition, $_SESSION['treassure']);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Juego del tesoro</title>
    <link rel="stylesheet" href="https://cdn.simplecss.org/simple.min.css">
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <h1>FIND THE TREASSURE</h1>
    <div class="dashboard-container">
        <?php
            echo $dashboardMarkup;
        ?>
    </div>
    <div class="win-message">
        <?php
            echo $winMessage;
        ?>
    </div>
    <div class="arrows-container">
        <?php
            echo $arrowsMarkup;
        ?>
    </div>
</body>
</html>