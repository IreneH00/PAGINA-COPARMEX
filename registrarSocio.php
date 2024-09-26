<?php

include 'conexion.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


if ($conex->connect_error) {
    die("Error de conexión: " . $conex->connect_error);
}

// Obtener datos de POST
$fechaAfiliacion = date('Y-m-d', strtotime($fechaAfiliacion));
$razonSocial = $_POST['razonSocial'];
$RFC = $_POST['RFC'];
$nombreComercial = $_POST['nombreComercial'];
$calle = $_POST['calle'];
$numero = $_POST['numero'];
$colonia = $_POST['colonia'];
$cp = $_POST['cp'];
$estado = $_POST['estado'];
$municipio = $_POST['municipio'];
$telefonoEmpresa1 = $_POST['telefonoEmpresa1'];
$sectorEstrategico = $_POST['sectorEstrategico'];
$giro = $_POST['giro'];
$giroGeneral = $_POST['giroGeneral'];
$noColaboradores = $_POST['noColaboradores'];
$rangoVentas = $_POST['rangoVentas'];
$tamaño = $_POST['tamaño'];
$queVende = $_POST['queVende'];
$queCompra = $_POST['queCompra'];
$cuota = $_POST['cuota'];
$mesFactura = $_POST['mesFactura'];
$ejecutivoAfilio = $_POST['ejecutivoAfilio'];
$diaAniversario = $_POST['diaAniversario'];
$mesAniversario = $_POST['mesAniversario'];
$nombreAsociado = $_POST['nombreAsociado'];
$curpAsociado = $_POST['curpAsociado'];
$diaCumpleAsociado = $_POST['diaCumpleAsociado'];
$mesCumpleAsociado = $_POST['mesCumpleAsociado'];
$correoAsociado1 = $_POST['correoAsociado1'];
$correoAsociado2 = $_POST['correoAsociado2'];
$celularAsociado = $_POST['celularAsociado'];
$telOficinaAsociado = $_POST['telOficinaAsociado'];
$extensionAsociado = $_POST['extensionAsociado'];
$perfilAsociado = $_POST['perfilAsociado'];
$generoAsociado = $_POST['generoAsociado'];
$mismosDatosRepresentante = $_POST['mismosDatosRepresentante'];
$nombreRepresentante = $_POST['nombreRepresentante'];
$curpRepresentante = $_POST['curpRepresentante'];
$diaCumpleRepresentante = $_POST['diaCumpleRepresentante'];
$mesCumpleRepresentante = $_POST['mesCumpleRepresentante'];
$correoRepresentante1 = $_POST['correoRepresentante1'];
$correoRepresentante2 = $_POST['correoRepresentante2'];
$celularRepresentante = $_POST['celularRepresentante'];
$telOficinaRepresentante = $_POST['telOficinaRepresentante'];
$extensionRepresentante = $_POST['extensionRepresentante'];
$perfilRepresentante = $_POST['perfilRepresentante'];
$generoRepresentante = $_POST['generoRepresentante'];
$nombreAsistente = $_POST['nombreAsistente'];
$correoAsistente1 = $_POST['correoAsistente1'];
$celularAsistente = $_POST['celularAsistente'];
$nombreFinanzas = $_POST['nombreFinanzas'];
$correoFinanzas1 = $_POST['correoFinanzas1'];
$celularFinanzas = $_POST['celularFinanzas'];
$nombreRecursosHumanos = $_POST['nombreRecursosHumanos'];
$correoRecursosHumanos1 = $_POST['correoRecursosHumanos1'];
$celularRecursosHumanos = $_POST['celularRecursosHumanos'];
$comentario = $_POST['comentario'];

// SE HACE EL MANEJO DEL ARCHIVO DEL LOGOTIPO......
// $logotipo = '';
// if (isset($_FILES['logotipo']) && $_FILES['logotipo']['error'] == 0) {
//     $rutaDestino = 'images/logotipos/' . basename($_FILES['logotipo']['name']);
//     if (move_uploaded_file($_FILES['logotipo']['tmp_name'], $rutaDestino)) {
//         $logotipo = $rutaDestino;
//     } else {
//         die("Error al subir el archivo.");
//     }
// }

// SE PREPARA Y SE EJECUTA LA CONSULTA
$stmt = $conex->prepare("INSERT INTO socios (fechaAfiliacion, razonSocial, RFC, nombreComercial, calle, numero, colonia, cp, estado, municipio, telefonoEmpresa1, sectorEstrategico, giro, giroGeneral, noColaboradores, rangoVentas, tamaño, queVende, queCompra, cuota, mesFactura, ejecutivoAfilio, diaAniversario, mesAniversario, nombreAsociado, curpAsociado, diaCumpleAsociado, mesCumpleAsociado, correoAsociado1, correoAsociado2, celularAsociado, telOficinaAsociado, extensionAsociado, perfilAsociado, generoAsociado, mismosDatosRepresentante ,nombreRepresentante, curpRepresentante, diaCumpleRepresentante, mesCumpleRepresentante, correoRepresentante1, correoRepresentante2, celularRepresentante, telOficinaRepresentante, extensionRepresentante, perfilRepresentante, generoRepresentante, nombreAsistente, correoAsistente1, celularAsistente, nombreFinanzas, correoFinanzas1, celularFinanzas, nombreRecursosHumanos, correoRecursosHumanos1, celularRecursosHumanos, comentario) VALUES (?,?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

$stmt = $conex->prepare($query);

if ($stmt === false) {
    die("Error en la preparación de la consulta: " . $conex->error);
}

// SE AJUSTA EL BIND_PARAM PARA QUE LOS DATOS COINCIDAN Y ESTEN TODOS LOS DATOS REQUERIDOS.......
$stmt->bind_param(
    "ssssssssssssssssssssssssssssssssssssssssssssssssss",
    $fechaAfiliacion,
    $razonSocial,
    $RFC,
    $nombreComercial,
    $calle,
    $numero,
    $colonia,
    $cp,
    $estado,
    $municipio,
    $telefonoEmpresa1,
    $sectorEstrategico,
    $giro,
    $giroGeneral,
    $noColaboradores,
    $rangoVentas,
    $tamaño,
    $queVende,
    $queCompra,
    $cuota,
    $mesFactura,
    $ejecutivoAfilio,
    $diaAniversario,
    $mesAniversario,
    $nombreAsociado,
    $curpAsociado,
    $diaCumpleAsociado,
    $mesCumpleAsociado,
    $correoAsociado1,
    $correoAsociado2,
    $celularAsociado,
    $telOficinaAsociado,
    $extensionAsociado,
    $perfilAsociado,
    $generoAsociado,
    $mismosDatosRepresentante,
    $nombreRepresentante,
    $curpRepresentante,
    $diaCumpleRepresentante,
    $mesCumpleRepresentante,
    $correoRepresentante1,
    $correoRepresentante2,
    $celularRepresentante,
    $telOficinaRepresentante,
    $extensionRepresentante,
    $perfilRepresentante,
    $generoRepresentante,
    $nombreAsistente,
    $correoAsistente1,
    $celularAsistente,
    $nombreFinanzas,
    $correoFinanzas1,
    $celularFinanzas,
    $nombreRecursosHumanos,
    $correoRecursosHumanos1,
    $celularRecursosHumanos,
    $comentario
);

if ($stmt->execute()) {
    echo "Los datos se han guardado correctamente.";
} else {
    echo "Error al guardar los datos: " . $stmt->error;
}

$stmt->close();
$conex->close();
