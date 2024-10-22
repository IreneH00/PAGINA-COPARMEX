<?php
include 'conexion.php';

$response = [];


$socio_id = isset($_POST['socio_id']) ? $_POST['socio_id'] : '';
$payment_status = isset($_POST['payment_status']) ? $_POST['payment_status'] : '';

$query = "SELECT id, nombre_evento, nombre, telefono, correo, precio, pagado 
          FROM registro_eventos_socios 
          WHERE tipo_usuario = 'socio'";

if (!empty($socio_id)) {
    $query .= " AND nombre = '$socio_id'";
}

if ($payment_status !== '') {
    $query .= " AND pagado = " . ($payment_status == 'pagado' ? 1 : 0);
}

$query .= " ORDER BY id DESC";

$resultado = $conex->query($query);

$eventos_html = '';
if ($resultado->num_rows > 0) {
    while ($fila = $resultado->fetch_assoc()) {
        $pagadoClass = $fila['pagado'] ? 'pagado' : 'no-pagado';
        
        $eventos_html .= "<tr>
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
    $eventos_html .= "<tr><td colspan='8'>No se encontraron registros</td></tr>";
}

$response['eventos'] = $eventos_html;


if (isset($_POST['socio_id'])) {
    $socio_id = $_POST['socio_id'];
    
    $query_socio = "SELECT nombreComercial FROM socios WHERE id = ?";
    $stmt = $conex->prepare($query_socio);
    $stmt->bind_param("i", $socio_id);
    $stmt->execute();
    $stmt->bind_result($nombreComercial);
    $stmt->fetch();
    $stmt->close();
    
    $query_socios = "SELECT id, fechaAfiliacion, razonSocial, nombreComercial, cuota, ejecutivoAfilio 
                     FROM socios 
                     WHERE nombreComercial = ?";
    $stmt = $conex->prepare($query_socios);
    $stmt->bind_param("s", $nombreComercial);
    $stmt->execute();
    $resultado_socios = $stmt->get_result();
    
    $socios_html = "";
    if ($resultado_socios->num_rows > 0) {
        while ($fila2 = $resultado_socios->fetch_assoc()) {
            $socios_html .= "<tr>
                                <td>" . $fila2['id'] . "</td>
                                <td>" . $fila2['cuota'] . "</td>
                                <td>" . $fila2['nombreComercial'] . "</td>
                                <td>" . $fila2['fechaAfiliacion'] . "</td>
                                <td>" . $fila2['razonSocial'] . "</td>
                                <td>" . $fila2['ejecutivoAfilio'] . "</td>
                                <td>
                                    <a href='#' onclick='editarSocio(" . $fila2['id'] . ");' class='btn btn-warning btn-circle' title='editar'>
                                        <i class='fa-solid fa-pencil'></i>
                                    </a>
                                </td>
                              </tr>";
        }
    } else {
      
        $socios_html .= "<tr><td colspan='7'>No se encontraron registros de socios</td></tr>";
    }
    
    $stmt->close();
    
    $response['socios'] = $socios_html;
}

echo json_encode($response);

$conex->close();
?>