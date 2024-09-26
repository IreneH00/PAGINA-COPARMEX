<?php
include 'conexion.php';

$totalCuota = 0;
$totalPrecio = 0;


if (isset($_POST['socio_id']) && !empty($_POST['socio_id'])) {
    $socio_id = $_POST['socio_id'];

    
    $queryCuota = "SELECT SUM(cuota) AS totalCuota FROM socios WHERE id = ?";
    $stmtCuota = $conex->prepare($queryCuota);
    $stmtCuota->bind_param("i", $socio_id);
    $stmtCuota->execute();
    $stmtCuota->bind_result($totalCuota);
    $stmtCuota->fetch();
    $stmtCuota->close();


    $queryPrecio = "SELECT SUM(e.precio_socio) AS totalPrecio 
                    FROM registro_eventos_socios r 
                    JOIN eventos e ON r.nombre_evento = e.nombre_evento 
                    WHERE r.nombre = (SELECT nombreComercial FROM socios WHERE id = ?)";
    $stmtPrecio = $conex->prepare($queryPrecio);
    $stmtPrecio->bind_param("i", $socio_id);
    $stmtPrecio->execute();
    $stmtPrecio->bind_result($totalPrecio);
    $stmtPrecio->fetch();
    $stmtPrecio->close();
}


$totalInicial = $totalCuota + $totalPrecio;


echo json_encode([
    'totalInicial' => number_format($totalInicial, 2),
    'totalCuota' => number_format($totalCuota, 2),
    'totalPrecio' => number_format($totalPrecio, 2)
]);
?>
