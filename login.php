<?php
include 'conexion.php';
session_start();

if (!isset($_POST['nombre'], $_POST['contraseña'])) {
    header('Location: index.php');
    exit();
}

$nombre = $_POST['nombre'];
$contraseña = $_POST['contraseña'];

if ($stmt = $conex->prepare('SELECT nombre, contraseña FROM administradores WHERE nombre = ?')) {
    $stmt->bind_param('s', $nombre);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($nombreDB, $contraseñaDB);
        $stmt->fetch();

        if ($contraseña === $contraseñaDB) {
            session_regenerate_id();
            $_SESSION['loggedin'] = true;
            $_SESSION['nombre'] = $nombreDB;
            header('Location: sidebar.php');
            exit();
        } else {
            echo '<script language="javascript">alert("Contraseña incorrecta");location.href="index.php";</script>';
        }
    } else {
        echo '<script language="javascript">alert("El usuario no existe");location.href="index.php";</script>';
    }
    $stmt->close();
}
$conex->close();