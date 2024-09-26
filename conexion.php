<?php

$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '12345';
$DATABASE_NAME = 'administracion';


$conex = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);

if (mysqli_connect_error()) {

    //Si se encuentra error en la conexiòn

    exit('Fallo en la conexiòn con la base de datos');
    
} else {
    //Si no hay errores en la conexiòn
    //echo "Conexion exitosa";
}
    