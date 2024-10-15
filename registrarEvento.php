<?php
//PARA REGISTRAR EVENTO Y ASIGNARLE EL ID AL MAPA DE ASIENTOS
include 'conexion.php';

if ($conex->connect_error) {
    die("Error de conexión: " . $conex->connect_error);
}

$nombre_evento = $_POST['nombre_evento'] ?? '';
$tipo = $_POST['tipo'] ?? '';
$modo = $_POST['modo'] ?? '';
$categoria = $_POST['categoria'] ?? '';
$ubicacion = $_POST['ubicacion'] ?? '';
$fecha = $_POST['fecha'] ?? '';
$hora = $_POST['hora'] ?? '';

$gratis = isset($_POST['gratis']) ? 1 : 0;

$precio_socio = $_POST['precio_socio'] ?? null;
$precio_general = $_POST['precio_general'] ?? null;
$precio_estudiante = $_POST['precio_estudiante'] ?? null;
$precio_prospecto = $_POST['precio_prospecto'] ?? null;
$precio_cortesia = $_POST['precio_cortesia'] ?? null;
$precio_no_activo = $_POST['precio_no_activo'] ?? null;
$ponente = $_POST['ponente'] ?? '';
$link_zoom = $_POST['link_zoom'] ?? '';
$comentario = $_POST['comentario'] ?? '';
$archivo = $_POST['archivo'] ?? '';

$fecha = date('Y-m-d', strtotime($fecha));
$hora = date('H:i:s', strtotime($hora));


if (empty($nombre_evento) || empty($tipo) || empty($modo) || empty($categoria) || empty($ubicacion) || empty($fecha) || empty($hora) || empty($ponente) || empty($archivo)) {
    echo json_encode(['success' => false, 'error' => 'Todos los campos obligatorios deben completarse.']);
} else {
   
    $stmt = $conex->prepare("INSERT INTO eventos (nombre_evento, tipo, modo, categoria, ubicacion, fecha, hora, gratis, precio_socio, precio_general, precio_estudiante, precio_prospecto, precio_cortesia, precio_no_activo, ponente, link_zoom, comentario, archivo) 
                              VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssssssssssssss", $nombre_evento, $tipo, $modo, $categoria, $ubicacion, $fecha, $hora, $gratis, $precio_socio, $precio_general, $precio_estudiante, $precio_prospecto, $precio_cortesia, $precio_no_activo, $ponente, $link_zoom, $comentario, $archivo);

    if ($stmt->execute()) {
       
        $evento_id = $conex->insert_id;

        
        echo "Evento guardado con ID: $evento_id<br>";

       
        $stmt_check = $conex->prepare("SELECT * FROM mapa_asientos WHERE evento_id IS NULL");
        $stmt_check->execute();
        $result_check = $stmt_check->get_result();

        if ($result_check->num_rows > 0) {
            
            $stmt_update = $conex->prepare("UPDATE mapa_asientos SET evento_id = ? WHERE evento_id IS NULL");
            $stmt_update->bind_param("i", $evento_id);

            if ($stmt_update->execute()) {
                echo "Mapa de asientos actualizado correctamente.";
            } else {
                echo "Error al actualizar el mapa de asientos: " . $stmt_update->error;
            }

            $stmt_update->close();
        } else {
            echo "No se encontraron registros en mapa_asientos con evento_id NULL.";
        }

        $stmt_check->close();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conex->close();
?>
