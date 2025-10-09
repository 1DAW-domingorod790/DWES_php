<?php
//Inicialización entorno
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);



//Lógica de negocio
//Definición o carga de funciones
//Función de debugueo
function dump($var){
    echo '<pre>'.print_r($var,1).'</pre>';
}


function getEmpleadoMarkup($empleado){
    $output = '<li class="list-group-item">';
    $output .= $empleado['apellidos'].', '.$empleado['nombre'];
    if(isset($empleado['empleados'])&&(!empty($empleado['empleados']))){
        $output .= '<ol class="list-group">';
        foreach($empleado['empleados'] as $subempleadoClave => $subempleadoValor){
            $output .= getEmpleadoMarkup($subempleadoValor);
        }
        $output .= '</ol>';
    }
    $output .= '</li>';
    return $output;
}

function getEmpleadosMarkup($empleadosData){
    
    $output = '';

    if(isset($empleadosData)&&!empty($empleadosData)){
        //Existen empleados que mostrar
        $output = '<ol class="list-group">';
        
        foreach($empleadosData as $jefeClave => $jefeValor){
            $output .= getEmpleadoMarkup($jefeValor);
        }

        $output .= '</ol>';

    }else{
        $output = '<p>No existen empleados que mostrar</p>';
    }

    return $output;
    /*return "<ol>
        <li>Jefe 1<ol>
            <li>Subornidado 1 1</li>
            <li>Subornidado 1 2</li>
            <li>Subornidado 1 3</li>
        </ol></li>
        <li>Jefe 2<ol>
            <li>Subornidado 2 1</li>
        </ol></li>
        <li>Jefe 3<ol>
            <li>Subornidado 3 1</li>
            <li>Subornidado 4 1</li>
        </ol></li>
    </ol>";*/
}

//Cargamos datos
$empleados = array(
    0 => array(
        'nombre' => 'Pedro',
        'apellidos' => 'España Fernández',
        'empleados' => array(
            0 => array(
                'nombre' => 'Juan',
                'apellidos' => 'Hernández',
                'empleados' => array()
            ),
            1 => array(
                'nombre' => 'María',
                'apellidos' => 'Fernández',

            ),
        )
    ),
    1 => array(
        'nombre' => 'Lorena',
        'apellidos' => 'Hidalgo',
        'empleados' => array(
            0 => array(
                'nombre' => 'Roberto',
                'apellidos' => 'Sánchez',
                'empleados' => array(
                    0 => array(
                        'nombre' => 'Román',
                        'apellidos' => 'Rosell',
                        'empleados' => array(
                            0 => array(
                                'nombre' => 'Gael',
                                'apellidos' => 'Tellez',
                            ) 
                        ),
                    ) 
                )
            )
            
        ),
    ),
    2 => array(
        'nombre' => 'Nicolás',
        'apellidos' => 'Pérez',
    )
);

$empleadosMarkup = getEmpleadosMarkup($empleados);

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <!-- Minified version -->
    <link rel="stylesheet" href="https://cdn.simplecss.org/simple.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Lista de empleados con subordinados</h1>
    <?php echo $empleadosMarkup; ?>
</body>
</html>