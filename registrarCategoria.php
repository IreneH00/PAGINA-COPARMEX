<?php
include 'conexion.php';

$nombre = $_POST['nombre'];

$sql = "INSERT INTO categoria (nombre) VALUES ('$nombre')";

if (mysqli_query($conex, $sql)) {
    
} else {
    echo "error"  . mysqli_error($conexion);
}

mysqli_close($conex);
