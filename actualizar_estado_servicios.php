<?php 
include 'conexion.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){


    $id = intval($_POST['id']);
    $activo = intval($_POST['activo']);

    $sql = "UPDATE servicios SET activo = ? WHERE id = ?";

    $stmt = $conex->prepare($sql);
    if($stmt===false){
        die("Error");
    }
    $stmt->bind_param('ii', $activo, $id);

    if($stmt->execute()){
        echo "success";
    } else {
        echo "error";
    }

    $stmt->close();
    $conex->close();
}
?>