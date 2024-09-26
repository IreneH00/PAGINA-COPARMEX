<?php
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $equipo = $_POST['equipo'];
    $no_identificacion = $_POST['no_identificacion'];
    $caracteristicas = $_POST['caracteristicas'];

    if (!empty($equipo) && !empty($no_identificacion) && !empty($caracteristicas)) {
        $query = "INSERT INTO equipo (Equipo, No_Identificacion, Caracteristicas, Estado) VALUES (?, ?, ?, 'disponible')";
        $stmt = $conex->prepare($query);

        if ($stmt) {
            $stmt->bind_param('sss', $equipo, $no_identificacion, $caracteristicas);

            if ($stmt->execute()) {
                echo 'success'; 
            } else {
                echo 'Error al registrar el equipo: ' . $conex->error;
            }

            $stmt->close();
        } else {
            echo 'Error en la preparación de la consulta: ' . $conex->error;
        }
    } else {
        echo 'Todos los campos son obligatorios.';
    }

    $conex->close();
} else {
    echo 'Solicitud inválida.';
}
?>
