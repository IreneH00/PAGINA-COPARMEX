<?php
include 'conexion.php';

$sql = "SELECT * FROM agenda";
$result = mysqli_query($conex, $sql);

$events = [];

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $events[] = $row;
    }
} else {
    echo 'Error: ' . mysqli_error($conex);
}

// Cerrar la conexión
mysqli_close($conex);

echo json_encode($events);
