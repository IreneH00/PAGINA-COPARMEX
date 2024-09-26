<?php
if (isset($_FILES['image'])) {
    $target_dir = "images/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        echo "La imagen se ha subido correctamente.";
        // Aquí podrías guardar la ruta en una base de datos
        $ruta_imagen = $target_file;
        // guardarEnBaseDeDatos($ruta_imagen);
    } else {
        echo "Error al subir la imagen.";
    }
}
?>

