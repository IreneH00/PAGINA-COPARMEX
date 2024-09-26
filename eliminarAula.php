<?php
    include 'conexion.php';
    $id = $_POST['id'];

    $sql = "DELETE FROM aulas WHERE id='". $id ."'";
    if($datos = mysqli_query($conex, $sql)){
        echo 'Registro eliminado correctamente';
    }else{
        echo 'El registro no pudo eliminarse correctamente, intenta de nuevo';
    }
?>