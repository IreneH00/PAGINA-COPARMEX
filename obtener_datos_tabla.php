<?php
session_start(); // Asegúrate de iniciar la sesión

include 'conexion.php';

// Recuperar IDs de los registros eliminados de la sesión
$eliminados = isset($_SESSION['eliminados']) ? $_SESSION['eliminados'] : [];
$eliminados_str = implode(',', $eliminados);

// Asegúrate de que $eliminados_str no esté vacío
$eliminados_str = !empty($eliminados_str) ? $eliminados_str : '0';

$query = "SELECT s.id, s.fecha, c.nombre AS categoria, so.nombreComercial AS socio, s.nombre, s.costo, s.comentario
          FROM servicios s
          JOIN categoria c ON s.categoria = c.id
          JOIN socios so ON s.socio = so.id
          WHERE s.id NOT IN ($eliminados_str)";
$ejecutar = $conex->query($query);

while ($result = $ejecutar->fetch_array()) {
    $datos = "Fecha: " . $result['fecha'] . "<br>" .
             "Categoría: " . $result['categoria'] . "<br>" .
             "Socio: " . $result['socio'] . "<br>" .
             "Nombre: " . $result['nombre'] . "<br>" .
             "Costo: " . $result['costo'] . "<br>" .
             "Comentario: " . $result['comentario'];
    echo "<tr id='registro-" . $result['id'] . "'>
    <td>" . $result['id'] . "</td>
    <td>" . $datos . "</td>
    <td><a href='#' onclick='editarServicio(" . $result['id'] . ");' class='btn btn-warning' title='editar'><i class='fa-solid fa-pencil'></i></a></td>
    <td><a href='#' onclick='eliminarServicio(" . $result['id'] . ");' class='btn btn-danger' title='eliminar'><i class='fas fa-trash-alt'></i></a></td>
    </tr>";
}
?>
