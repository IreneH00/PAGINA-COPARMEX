<?php
include 'conexion.php';


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$response = [];


if (isset($_POST['nombre'])) {
    $nombre = $_POST['nombre'];
    $payment_status = isset($_POST['payment_status']) ? $_POST['payment_status'] : '';


    $query_eventos = "SELECT id, nombre_evento, nombre, telefono, correo, activo, pagado 
                      FROM registro_eventos_socios 
                      WHERE nombre = ? AND tipo_usuario != 'socio'";

    
    if ($payment_status == 'pagados') {
        $query_eventos .= " AND pagado = 1";
    } elseif ($payment_status == 'por_pagar') {
        $query_eventos .= " AND pagado = 0";
    }

    $stmt = $conex->prepare($query_eventos);
    $stmt->bind_param("s", $nombre); 
    $stmt->execute();
    $resultado_eventos = $stmt->get_result();

  
    $eventos_html = "";
    while ($fila = $resultado_eventos->fetch_assoc()) {
        $pagadoClass = $fila['pagado'] ? 'pagado' : 'no-pagado';
        $eventos_html .= "<tr>
                            <td class='$pagadoClass'>" . $fila['id'] . "</td>
                            <td class='$pagadoClass'>" . $fila['nombre_evento'] . "</td>
                            <td class='$pagadoClass'>" . $fila['nombre'] . "</td>
                            <td class='$pagadoClass'>" . $fila['telefono'] . "</td>
                            <td class='$pagadoClass'>" . $fila['correo'] . "</td>
                            <td class='$pagadoClass'>" . ($fila['activo'] ? 'Sí' : 'No') . "</td>
                            <td class='$pagadoClass'>" . ($fila['pagado'] ? 'Sí' : 'No') . "</td>
                            <td>
                                <a href='#' onclick='editarRegistro(" . $fila['id'] . ");' class='btn btn-warning btn-circle' title='editar'>
                                    <i class='fa-solid fa-pencil'></i>
                                </a>
                            </td>
                          </tr>";
    }
    $stmt->close();

    
    $response['eventos'] = $eventos_html;
}


header('Content-Type: application/json');
echo json_encode($response);
$conex->close();
?>
