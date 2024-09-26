<?php 
    include 'conexion.php';

    $id = $_POST['id'];
    
    $sql = "DELETE FROM eventos WHERE id='". $id ."'";
    if($datos = mysqli_query($conex, $sql)){
        echo 'eliminado correctamente';
    }else{
        echo 'No pudo eliminarse correctamente, intenta de nuevo';
    }
?>