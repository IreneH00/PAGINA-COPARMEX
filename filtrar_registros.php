<?php
include 'conexion.php';

$response = [];

if (isset($_POST['socio_id'])) {
    $socio_id = $_POST['socio_id'];
    $payment_status = isset($_POST['payment_status']) ? $_POST['payment_status'] : '';

   
    $query_socio = "SELECT nombreComercial FROM socios WHERE id = ?";
    $stmt = $conex->prepare($query_socio);
    $stmt->bind_param("i", $socio_id);
    $stmt->execute();
    $stmt->bind_result($nombreComercial);
    $stmt->fetch();
    $stmt->close();

    
    $query_eventos = "SELECT id, nombre_evento, nombre, telefono, correo, activo, pagado 
                      FROM registro_eventos_socios 
                      WHERE nombre = ?";

    
    if ($payment_status == 'pagados') {
        $query_eventos .= " AND pagado = 1";
    } elseif ($payment_status == 'por_pagar') {
        $query_eventos .= " AND pagado = 0";
    }

    $stmt = $conex->prepare($query_eventos);
    $stmt->bind_param("s", $nombreComercial);
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

    
    $query_socios = "SELECT id, fechaAfiliacion, razonSocial, nombreComercial, cuota, ejecutivoAfilio 
                     FROM socios 
                     WHERE nombreComercial = ?";
    $stmt = $conex->prepare($query_socios);
    $stmt->bind_param("s", $nombreComercial);
    $stmt->execute();
    $resultado_socios = $stmt->get_result();

    
    $socios_html = "";
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
    $stmt->close();

    $response['eventos'] = $eventos_html;
    $response['socios'] = $socios_html;
}


echo json_encode($response);

$conex->close();
?>
