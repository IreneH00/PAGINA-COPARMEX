<?php
include 'conexion.php';

$socioId = isset($_POST['socio_id']) ? $_POST['socio_id'] : '';
$estado = isset($_POST['estado']) ? $_POST['estado'] : '';

$query = "SELECT id, nombre_evento, nombre, telefono, correo, activo, pagado 
          FROM registro_eventos_socios WHERE 1=1";

if ($socioId) {
    $query .= " AND socio_id = '$socioId'";
}

if ($estado == 'pagados') {
    $query .= " AND pagado = 1";
} elseif ($estado == 'por_pagar') {
    $query .= " AND pagado = 0";
}

$query .= " ORDER BY id DESC";
$resultado = $conex->query($query);

$output = '';
while ($fila = $resultado->fetch_assoc()) {
    $output .= "<tr>
                    <td>{$fila['id']}</td>
                    <td>{$fila['nombre_evento']}</td>
                    <td>{$fila['nombre']}</td>
                    <td>{$fila['telefono']}</td>
                    <td>{$fila['correo']}</td>
                    <td>" . ($fila['activo'] ? 'Sí' : 'No') . "</td>
                    <td>" . ($fila['pagado'] ? 'Sí' : 'No') . "</td>
                    <td>
                        <a href='#' onclick='editarCobranza({$fila['id']});' class='btn btn-warning btn-circle' title='editar'>
                            <i class='fa-solid fa-pencil'></i>
                        </a>
                    </td>
                </tr>";
}

echo $output;
?>
