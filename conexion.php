<?php

$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '12345';
$DATABASE_NAME = 'administracion';


$conex = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);

if (mysqli_connect_error()) {

   

    exit('Fallo en la conexiòn con la base de datos');
    
} else {
   
    //echo "Conexion exitosa";
}
    