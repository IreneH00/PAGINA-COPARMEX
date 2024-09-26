<?php
include 'conexion.php';

$nombre = $_POST['nombre'];
$perfil = $_POST['perfil'];
$puesto = $_POST['puesto'];
$especialidad = $_POST['especialidad'];

if (empty($nombre) || empty($perfil) || empty($puesto) ||empty($especialidad)) {
    echo 'Todos los campos deben de ser llenados';
} else {

    $sql = "INSERT INTO ponentes (nombre,perfil,puesto,especialidad) VALUES ('$nombre','$perfil','$puesto','$especialidad')";
}

if (mysqli_query($conex, $sql)) {
    echo 'Guardados ';
} else {
    echo 'error' . mysqli_error($conex);
}

mysqli_close($conex);
