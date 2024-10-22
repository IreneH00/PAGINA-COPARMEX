<?php
// REGISTRAR EL EVENTO, CON NUMERO DE MESA Y ASIENTO ASIGNADO 
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $evento_id = $_POST['evento_id']; 
    $nombre_evento = $_POST['nombre_evento']; 
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $telefono = $_POST['telefono'];
    $activo = $_POST['activo'];
    $gratis = $_POST['gratis'];
    $tipo_usuario = $_POST['tipo_usuario']; 
    $no_asiento = isset($_POST['no_asiento']) ? (int)$_POST['no_asiento'] : null; 
    $no_mesa = isset($_POST['no_mesa']) ? (int)$_POST['no_mesa'] : null;
    if ($no_mesa === null) {
        $no_mesa = 0;
    }
    
    $nombre_empresa = $_POST['nombre_empresa'];
    $razon_social = $_POST['razon_social'];

   
    $precio_query = "SELECT precio_socio, precio_general, precio_estudiante, precio_prospecto, precio_cortesia, precio_no_activo FROM eventos WHERE id = ?";
    $stmt_precio = $conex->prepare($precio_query);
    $stmt_precio->bind_param("i", $evento_id);
    $stmt_precio->execute();
    $resultado_precio = $stmt_precio->get_result();
    
    if ($resultado_precio->num_rows > 0) {
        $row = $resultado_precio->fetch_assoc();
        
        switch ($tipo_usuario) {
            case "socio":
                $precio = $row['precio_socio'];
                break;
            case "general":
                $precio = $row['precio_general'];
                break;
            case "estudiante":
                $precio = $row['precio_estudiante'];
                break;
            case "prospecto":
                $precio = $row['precio_prospecto'];
                break;
            case "cortesía":
                $precio = $row['precio_cortesia'];
                break;
            case "no activo":
                $precio = $row['precio_no_activo'];
                break;
            default:
                $precio = 0; 
                break;
        }
    } else {
        $precio = 0;
    }

    
    $query = "INSERT INTO registro_eventos_socios (nombre_evento, nombre, correo, telefono, activo, pagado, tipo_usuario, nombre_empresa, razon_social, precio, no_mesa, no_asiento) 
              VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conex->prepare($query);
    $pagado = ($gratis == 1) ? 1 : 0;

    $stmt->bind_param("ssssiisssiss", $nombre_evento, $nombre, $correo, $telefono, $activo, $pagado, $tipo_usuario, $nombre_empresa, $razon_social, $precio, $no_mesa, $no_asiento);

    if ($stmt->execute()) {
    
        $registro_id = $stmt->insert_id;

       
        $qrData = "Evento: $nombre_evento, Nombre: $nombre, Usuario: $tipo_usuario, Empresa: $nombre_empresa, Mesa: $no_mesa, Asiento: $no_asiento";
        
      
    if ($gratis !== 1) {
        $qrData .= ', Estado: No Pagado';
    }

        $qrUrl = "https://api.qrserver.com/v1/create-qr-code/?data=" . urlencode($qrData);

       
        $rutaGuardado = 'qrs/';
        $nombreArchivo = uniqid('qr_') . '.png';
        $rutaCompleta = $rutaGuardado . $nombreArchivo;

        $imagenQR = file_get_contents($qrUrl);

        if ($imagenQR) {
            file_put_contents($rutaCompleta, $imagenQR);

         
            $update_qr_query = "UPDATE registro_eventos_socios SET qr_code_path = ? WHERE id = ?";
            $stmt_update_qr = $conex->prepare($update_qr_query);
            $stmt_update_qr->bind_param('si', $rutaCompleta, $registro_id);

            if ($stmt_update_qr->execute()) {
                echo json_encode(["mensaje" => "Registro exitoso y QR generado", "precio" => $precio, "qr_path" => $rutaCompleta]);
            } else {
                echo json_encode(["error" => "Error al actualizar el QR en la base de datos: " . $stmt_update_qr->error]);
            }

            $stmt_update_qr->close();
        } else {
            echo json_encode(["error" => "Error al generar el código QR."]);
        }

        
        $query_ocupar_asiento = "INSERT INTO asientos_ocupados (evento_id, num_mesa, num_asiento) VALUES (?, ?, ?)";
        $stmt_ocupar_asiento = $conex->prepare($query_ocupar_asiento);
        $stmt_ocupar_asiento->bind_param("iii", $evento_id, $no_mesa, $no_asiento);

        if ($stmt_ocupar_asiento->execute()) {
            echo json_encode(["mensaje" => "Asiento registrado como ocupado exitosamente"]);
        } else {
            echo json_encode(["error" => "Error al registrar el asiento ocupado: " . $stmt_ocupar_asiento->error]);
        }

        $stmt_ocupar_asiento->close();

    } else {
        echo json_encode(["error" => "Error: " . $stmt->error]);
    }

    $stmt->close();
    $stmt_precio->close(); 
}
?>
