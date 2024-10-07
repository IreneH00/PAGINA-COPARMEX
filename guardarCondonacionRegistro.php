<?php
include 'conexion.php';

session_start();

if (isset($_POST['id'], $_POST['totalAnualidad'], $_POST['porCondonar'], $_POST['fechaCondonacion'], $_POST['tipoCondonacion'], $_POST['montoCondonacion'])) {
    
    $registro_evento_id = (int) $_POST['id'];
    $total_anualidad = (float) $_POST['totalAnualidad'];
    $monto_condonacion = (float) $_POST['montoCondonacion'];
    $fecha_condonacion = $conex->real_escape_string($_POST['fechaCondonacion']);
    $tipo_condonacion = $conex->real_escape_string($_POST['tipoCondonacion']);
    $creado_por = $_SESSION['nombre'] ?? 'Desconocido';

   
    $querySelect = "SELECT por_condonar FROM condonaciones_eventos WHERE registro_evento_id = ? ORDER BY id DESC LIMIT 1";
    if ($stmtSelect = $conex->prepare($querySelect)) {
        $stmtSelect->bind_param('i', $registro_evento_id);
        $stmtSelect->execute();
        $stmtSelect->bind_result($por_condonar_actual);
        $stmtSelect->fetch();
        $stmtSelect->close();
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al obtener el valor actual de por condonar.']);
        exit();
    }

    
    if ($por_condonar_actual === null) {
        $por_condonar_actual = $total_anualidad;
    }

   
    $nuevo_por_condonar = $por_condonar_actual - $monto_condonacion;

    
    if ($nuevo_por_condonar < 0) {
        echo json_encode(['success' => false, 'message' => 'El monto de la condonación es mayor que el saldo por condonar.']);
        exit();
    }

    
    $queryInsert = "INSERT INTO condonaciones_eventos (registro_evento_id, total_anualidad, por_condonar, monto_condonacion, fecha_condonacion, tipo, creado_por)
                    VALUES (?, ?, ?, ?, ?, ?, ?)";

    if ($stmtInsert = $conex->prepare($queryInsert)) {
        $stmtInsert->bind_param('idddsss', $registro_evento_id, $total_anualidad, $nuevo_por_condonar, $monto_condonacion, $fecha_condonacion, $tipo_condonacion, $creado_por);

        if ($stmtInsert->execute()) {
            echo json_encode(['success' => true, 'nuevo_por_condonar' => $nuevo_por_condonar]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error al guardar la condonación.']);
        }

        $stmtInsert->close();
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al preparar la consulta.']);
    }

    $conex->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Datos incompletos.']);
}
?>
