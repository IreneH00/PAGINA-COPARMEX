<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="CSS/sidebar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Lista de participantes</title>
    <link rel="icon" type="image/png" href="images/logo.jpeg">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">


    <style>
        .half-width {
            max-width: 50%;
            margin: 0;
            float: left;
        }

        .inactive {
            text-decoration: line-through;
            color: red;
        }

        .btn-red {
            background-color: red;
            color: white;
        }
    </style>
</head>

<body style="font-family: 'Geist Mono', monospace;">

    <ul class="nav nav-pills nav-fill gap-2 p-1 small bg-primary rounded-5 shadow-sm" id="pillNav2" role="tablist" style="--bs-nav-link-color: var(--bs-white); --bs-nav-pills-link-active-color: var(--bs-primary); --bs-nav-pills-link-active-bg: var(--bs-white);">
        <li class="nav-item" role="presentation">
            <a class="nav-link rounded-5" href="listaEventos.php" role="button"><i class="fas fa-undo-alt"></i>Regresar</a>
        </li>
    </ul>

    <div class="container half-width">
    <?php
    include 'conexion.php';

    if (isset($_GET['nombre_evento']) && isset($_GET['gratis'])) {
        $nombre_evento = htmlspecialchars($_GET['nombre_evento']);
        $gratis = htmlspecialchars($_GET['gratis']);

       
        $query = "SELECT id, nombre, activo, pagado, qr_code_path FROM registro_eventos_socios WHERE nombre_evento = ?";
        $stmt = $conex->prepare($query);

        if ($stmt === false) {
            die('Error al preparar la consulta: ' . $conex->error);
        }

        $stmt->bind_param('s', $nombre_evento);
        $stmt->execute();
        $result = $stmt->get_result();
        echo "<h4>Participantes del evento: " . $nombre_evento . "</h4>";
    ?>
        <div class="print-button-container">
            <button class="btn btn-warning" onclick="imprimirTabla()">Imprimir Tabla</button>
        </div>
        <br>
        <div class="table-responsive" id="tablaContainer">
            <table class="table table-hover">
                <thead class="table-dark">
                    <tr class="table-light">
                        <th scope="col">ID</th>
                        <th scope="col">Nombre</th>
                        <th></th>
                        <th></th>
                        <th>Activo/Inactivo</th>
                        <th>Pagado/Adeudo</th>
                        <th>Descargar QR</th>
                    </tr>
                </thead>

                <tbody>
    <?php
    while ($row = $result->fetch_assoc()) {
        $activoClass = $row['activo'] == 0 ? '' : 'inactive';
        $pagado = $row['pagado'] == 1 ? '' : 'btn-red';
        $gratuito = $gratis == 1;

        echo "<tr>
        <td>" . htmlspecialchars($row['id']) . "</td>
        <td><span class='nombre $activoClass' id='nombre-" . $row['id'] . "'>" . htmlspecialchars($row['nombre']) . "</span></td>
        <td><a href='#' onclick='editarParticipante(" . $row['id'] . ");' class='btn btn-warning' title='Editar'><i class='fa-solid fa-pencil'></i></a></td>
        <td><a href='#' onclick='eliminarParticipante(" . $row['id'] . ");' class='btn btn-danger' title='Eliminar'><i class='fas fa-trash-alt'></i></a></td>
        <td><button onclick='toggleActivo(" . $row['id'] . ");' class='btn btn-secondary'>Activo/Inactivo</button></td>
        <td><button onclick='togglePagado(" . $row['id'] . ");' class='btn btn-primary $pagado' " . ($gratuito ? 'disabled' : '') . ">Pagado/Adeudo</button></td>";

       
        if (!empty($row['qr_code_path'])) {
            echo "<td><a href='" . htmlspecialchars($row['qr_code_path']) . "' download class='btn btn-secondary' title='Descargar QR'><i class='fas fa-arrow-alt-circle-down'></i> Descargar</a></td>";
        } else {
            echo "<td>No disponible</td>";
        }

        echo "</tr>";
    }
    ?>
</tbody>

            </table>
        </div>
    <?php
        $stmt->close();
    } else {
        echo "<h1>Evento no especificado.</h1>";
    }
    $conex->close();
    ?>
</div>


    <div class="container" id="result"></div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="SCRIPTS/script.js"></script>

</body>

</html>