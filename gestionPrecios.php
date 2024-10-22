<?php
include 'conexion.php';

if (isset($_POST['socio_id'])) {
    $socio_id = $_POST['socio_id'];

    // TOTAL INCIAL
    $query_inicial = "
    SELECT 
        IFNULL((
            SELECT SUM(total_anualidad) 
            FROM abonos 
            WHERE socio_id = $socio_id
        ), 0) +
        IFNULL((
            SELECT SUM(total_anualidad) 
            FROM abonos_eventos 
            WHERE registro_evento_id IN (
                SELECT res.id 
                FROM registro_eventos_socios res 
                WHERE res.nombre = (
                    SELECT nombreComercial 
                    FROM socios 
                    WHERE id = $socio_id
                )
            )
        ), 0) AS total_inicial
    ";
    
    
    // TOTAL PAGADO
    $query_pagado = "
    SELECT 
        COALESCE(SUM(a.monto), 0) + COALESCE(SUM(ae.monto), 0) AS total_pagado
    FROM abonos a
    LEFT JOIN abonos_eventos ae ON ae.registro_evento_id IN (
        SELECT res.id 
        FROM registro_eventos_socios res 
        WHERE res.nombre = (SELECT nombreComercial FROM socios WHERE id = $socio_id)
    )
    WHERE a.socio_id = $socio_id
    GROUP BY a.socio_id
";


  

    

    // suma de montos condonados en condonaciones y condonaciones_eventos
    $query_condonado = "
        SELECT 
            -- Suma del monto_condonacion de la tabla condonaciones
            (SELECT IFNULL(SUM(c.monto_condonacion), 0) 
            FROM condonaciones c
            WHERE c.socio_id = $socio_id) AS total_condonaciones,
            
            -- Suma del monto_condonacion de la tabla condonaciones_eventos
            (SELECT IFNULL(SUM(ce.monto_condonacion), 0)
            FROM condonaciones_eventos ce
            JOIN registro_eventos_socios res ON ce.registro_evento_id = res.id
            WHERE res.nombre = (SELECT nombreComercial FROM socios WHERE id = $socio_id)) AS total_condonaciones_eventos
    ";

   

    $query_por_cobrar = "
    SELECT 
        IFNULL(
            (SELECT por_cobrar FROM abonos WHERE socio_id = $socio_id ORDER BY id DESC LIMIT 1), 
            0
        ) +
        IFNULL(
            (SELECT por_cobrar FROM abonos_eventos WHERE registro_evento_id IN (
                SELECT res.id FROM registro_eventos_socios res WHERE res.nombre = (
                    SELECT nombreComercial FROM socios WHERE id = $socio_id
                )
            ) ORDER BY id DESC LIMIT 1), 
            0
        ) AS total_por_cobrar
    ";
    

  
    $resultado_inicial = $conex->query($query_inicial);
    $resultado_pagado = $conex->query($query_pagado);
    $resultado_condonado = $conex->query($query_condonado);
    $resultado_por_cobrar = $conex->query($query_por_cobrar);

    
    $total_inicial = $resultado_inicial->fetch_assoc()['total_inicial'] ?? 0;
    $total_pagado = $resultado_pagado->fetch_assoc()['total_pagado'] ?? 0;
    
    
    $row_condonado = $resultado_condonado->fetch_assoc();
    $total_condonaciones = $row_condonado['total_condonaciones'] ?? 0;
    $total_condonaciones_eventos = $row_condonado['total_condonaciones_eventos'] ?? 0;
    $total_condonado = $total_condonaciones + $total_condonaciones_eventos;

    $total_por_cobrar = $resultado_por_cobrar->fetch_assoc()['total_por_cobrar'] ?? 0;

    
    echo json_encode([
        'total_inicial' => (float)$total_inicial,
        'total_pagado' => (float)$total_pagado,
        'total_condonado' => (float)$total_condonado,
        'total_por_cobrar' => (float)$total_por_cobrar
    ]);
} else {
    echo json_encode(['error' => 'No se proporcionó socio_id']);
}
