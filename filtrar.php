<?php
include 'conexion.php';


$nombre = isset($_GET['nombre']) ? $_GET['nombre'] : '';

$query = "SELECT id, nombre, correo, telefono, espacio, montaje, cantPersonas, fechaInic, fechaFin FROM aulas WHERE 1";

if ($nombre) {
    $query .= " AND nombre LIKE '%$nombre%'";
}

$ejecutar = $conex->query($query);

while ($result = $ejecutar->fetch_array()) {
    echo "<tr>
            <td>" . $result['nombre'] . "</td>
            <td>" . $result['correo'] . "</td>
            <td>" . $result['telefono'] . "</td>
            <td>" . $result['espacio'] . "</td>
            <td>" . $result['montaje'] . "</td>
            <td>" . $result['cantPersonas'] . "</td>
            <td>" . $result['fechaInic'] . "</td>
            <td>" . $result['fechaFin'] . "</td>
            <td><a href='#' onclick='editarAula(" . $result['id'] . ");'>Editar</a></td>
            <td><a href='#' onclick='eliminarAula(" . $result['id'] . ");'>Eliminar</a></td>
        </tr>";
}