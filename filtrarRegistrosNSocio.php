<?php
include 'conexion.php';


$socio_id = isset($_POST['socio_id']) ? $_POST['socio_id'] : '';
$payment_status = isset($_POST['payment_status']) ? $_POST['payment_status'] : '';


$query = "SELECT id, nombre_evento, nombre, telefono, correo, precio, pagado 
          FROM registro_eventos_socios 
          WHERE tipo_usuario != 'socio'";


if (!empty($socio_id)) {
    $query .= " AND nombre = '$socio_id'";
}


if ($payment_status !== '') {
    $query .= " AND pagado = " . ($payment_status == 'pagado' ? 1 : 0);
}


$query .= " ORDER BY id DESC";

$resultado = $conex->query($query);

$eventos = '';
if ($resultado->num_rows > 0) {
    
    while ($fila = $resultado->fetch_assoc()) {
        $pagadoClass = $fila['pagado'] ? 'pagado' : 'no-pagado';
        
        $eventos .= "<tr>
                        <td class='$pagadoClass'>" . $fila['id'] . "</td>
                        <td class='$pagadoClass'>" . $fila['nombre_evento'] . "</td>
                        <td class='$pagadoClass'>" . $fila['nombre'] . "</td>
                        <td class='$pagadoClass'>" . $fila['telefono'] . "</td>
                        <td class='$pagadoClass'>" . $fila['correo'] . "</td>
                        <td class='$pagadoClass'>" . number_format($fila['precio'], 2) . "</td>
                        <td class='$pagadoClass'>" . ($fila['pagado'] ? 'Sí' : 'No') . "</td>
                        <td>
                            <a href='#' onclick='editarRegistro(" . $fila['id'] . ");' class='btn btn-warning btn-circle' title='editar'>
                                <i class='fa-solid fa-pencil'></i>
                            </a>
                        </td>
                    </tr>";
    }
} else {
   
    $eventos .= "<tr><td colspan='8'>No se encontraron registros</td></tr>";
}


echo json_encode(['eventos' => $eventos]);

?>
