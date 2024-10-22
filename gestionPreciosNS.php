<?php
include 'conexion.php';

if (isset($_POST['registro_evento_id'])) {
    $registro_evento_id = $_POST['registro_evento_id'];

    // TOTAL INICIAL: suma de la columna 'precio' de la tabla 'registro_eventos_socios' donde el tipo_usuario es diferente de 'socio' y coincida el nombre.
    $query_inicial = "
    SELECT SUM(precio) AS total_inicial 
    FROM registro_eventos_socios 
    WHERE tipo_usuario != 'socio' 
    AND id = '$registro_evento_id'
    ";

    // TOTAL PAGADO: suma de la columna 'monto' de la tabla 'abonos_eventos' donde coincida el 'registro_evento_id'
    $query_pagado = "
    SELECT COALESCE(SUM(monto), 0) AS total_pagado
    FROM abonos_eventos
    WHERE registro_evento_id = '$registro_evento_id'
    ";

    // TOTAL CONDONADO: suma de la columna 'monto_condonacion' de la tabla 'condonaciones_eventos' donde coincida el 'registro_evento_id'
    $query_condonado = "
    SELECT COALESCE(SUM(monto_condonacion), 0) AS total_condonado
    FROM condonaciones_eventos
    WHERE registro_evento_id = '$registro_evento_id'
    ";

    // TOTAL POR COBRAR: el último valor de la columna 'por_cobrar' de la tabla 'abonos_eventos' donde coincida el 'registro_evento_id'
    $query_por_cobrar = "
    SELECT IFNULL(por_cobrar, 0) AS total_por_cobrar
    FROM abonos_eventos
    WHERE registro_evento_id = '$registro_evento_id'
    ORDER BY id DESC 
    LIMIT 1
    ";

    // Ejecutar las consultas
    $resultado_inicial = $conex->query($query_inicial);
    $resultado_pagado = $conex->query($query_pagado);
    $resultado_condonado = $conex->query($query_condonado);
    $resultado_por_cobrar = $conex->query($query_por_cobrar);

    // Obtener los resultados
    $total_inicial = $resultado_inicial->fetch_assoc()['total_inicial'] ?? 0;
    $total_pagado = $resultado_pagado->fetch_assoc()['total_pagado'] ?? 0;
    $total_condonado = $resultado_condonado->fetch_assoc()['total_condonado'] ?? 0;
    $total_por_cobrar = $resultado_por_cobrar->fetch_assoc()['total_por_cobrar'] ?? 0;

    // Devolver los totales como JSON
    echo json_encode([
        'total_inicial' => (float)$total_inicial,
        'total_pagado' => (float)$total_pagado,
        'total_condonado' => (float)$total_condonado,
        'total_por_cobrar' => (float)$total_por_cobrar
    ]);
} else {
    echo json_encode(['error' => 'No se proporcionó registro_evento_id']);
}
