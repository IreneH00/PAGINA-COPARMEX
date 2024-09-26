<?php 

//SE ENVIA EL FORM PARA HACER LA SOLICITUD DE UN EQUIPO Y SE ASIGNA UN CODIGO UNICO 
include 'conexion.php';

header('Content-Type: application/json'); 

$response = array();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $equipo = $_POST['equipo'] ?? '';
    $solicitante = $_POST['solicitante'] ?? '';
    $fechaSolicitud = $_POST['fechaSolicitud'] ?? '';
    $fechaDevolucion = $_POST['fechaDevolucion'] ?? '';
    $motivo = $_POST['motivo'] ?? '';

    if (!$equipo || !$solicitante || !$fechaSolicitud || !$fechaDevolucion || !$motivo) {
        echo json_encode(['error' => 'Todos los campos son requeridos.']);
        exit();
    }

    
    $url = "http://localhost/Pagina_Coparmex/obtenerCodigo.php?equipo=" . urlencode($equipo);
    $codigoResponse = file_get_contents($url);
    $codigoData = json_decode($codigoResponse, true);

    if (isset($codigoData['codigo'])) {
        $codigo = $codigoData['codigo'];
    } else {
        echo json_encode(['error' => 'El equipo que seleccionaste no está disponible']);
        exit();
    }

  
    $query = "INSERT INTO solicitudes (equipo, Nombre_solicitante, Fecha_solicitud, Fecha_devolucion, Motivo, Codigo_Identificacion) 
              VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conex->prepare($query);
    $stmt->bind_param("ssssss", $equipo, $solicitante, $fechaSolicitud, $fechaDevolucion, $motivo, $codigo);

    if ($stmt->execute()) {
        $id = $stmt->insert_id;

        
        $fechaActual = date('Y-m-d');
        $estado = ($fechaDevolucion <= $fechaActual) ? 'disponible' : 'en uso';

      
        $updateQuery = "UPDATE equipo SET estado = ? WHERE No_Identificacion = ?";
        $updateStmt = $conex->prepare($updateQuery);
        $updateStmt->bind_param("ss", $estado, $codigo);
        $updateStmt->execute();
        $updateStmt->close();

        echo json_encode(['success' => 'Solicitud enviada con éxito.']);
    } else {
        echo json_encode(['error' => 'Error al insertar la solicitud']);
    }

    $stmt->close();
    $conex->close();
} else {
    echo json_encode(['error' => 'Método HTTP incorrecto']);
}
?>
