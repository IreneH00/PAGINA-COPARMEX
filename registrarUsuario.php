<?php

include 'conexion.php';

$nombre = $_POST['nombre'];
$apP = $_POST['apP'];
$apM = $_POST['apM'];
$correo = $_POST['correo'];
$contraseña = $_POST['contraseña'];

if (empty($nombre) || empty($apP) || empty($apM) || empty($correo) || empty($contraseña)) {
    echo 'Todos los campos son obligatorios.';
} else {

    $sql = "INSERT INTO administradores (nombre, apP, apM, correo, contraseña) VALUES ('$nombre', '$apP', '$apM', '$correo', '$contraseña')";
   
    if (mysqli_query($conex, $sql)) {
        echo 'Se guardó correctamente';
    } else {
        echo 'Intenta de nuevo: ' . mysqli_error($conex);
    }
}
// Cerrar la conexión
mysqli_close($conex);
