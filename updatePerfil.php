<?php
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $apP = $_POST['apP'];
    $apM = $_POST['apM'];
    $correo = $_POST['correo'];
    $contraseña = $_POST['contraseña'];

    $query = "UPDATE administradores SET nombre='$nombre', apP='$apP', apM='$apM', correo='$correo', contraseña='$contraseña' WHERE nombre ='$nombre'";
    if ($conex->query($query) === TRUE) {
        echo '<script language="javascript">alert("Perfil actualizado correctamente"); location.href="actualizarPerfil.php";</script>';
    } else {
        echo '<script language="javascript">alert("Error al actualizar el perfil: ' . $conex->error . '"); location.href="actualizarPerfil.php";</script>';
    }
} else {
    echo '<script language="javascript">alert("Método no permitido"); location.href="sidebar.php";</script>';
}
