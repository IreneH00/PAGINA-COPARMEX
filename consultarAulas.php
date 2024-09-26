<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultar</title>
    <link rel="icon" type="image/png" href="images/logo.jpeg">
    <link rel="stylesheet" href="CSS/sidebar.css">
    <script src="SCRIPTS/jquery.min.js"></script>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body style="font-family: 'Geist Mono', monospace">
    <style>
        .print-button-container {
            margin-bottom: 20px;
        }
    </style>



    <ul class="nav nav-pills nav-fill gap-2 p-1 small bg-primary rounded-5 shadow-sm" id="pillNav2" role="tablist" style="--bs-nav-link-color: var(--bs-white); --bs-nav-pills-link-active-color: var(--bs-primary); --bs-nav-pills-link-active-bg: var(--bs-white);">

        <li class="nav-item" role="presentation">
            <a class="nav-link rounded-5" href="sidebar.php" role="button"><i class="fa-solid fa-house"> Ir al Inicio</i></a>
        </li>

        <li class="nav-item" role="presentation">
            <button class="nav-link rounded-5" id="home-tab1" href="agenda.php" data-bs-toggle="tab" type="button" role="tab" aria-selected="false">Agenda</button>
        </li>

        <li class="nav-item" role="presentation">
            <button class="nav-link rounded-5" id="home-tab2" href="aulas.php" data-bs-toggle="tab" type="button" role="tab" aria-selected="false">ESPACIO EN BLANCO*</button>
        </li>

        <li class="nav-item" role="presentation">
            <button class="nav-link rounded-5" id="profile-tab2" data-bs-toggle="tab" type="button" role="tab" aria-selected="false">Cotizador</button>
        </li>

        <li class="nav-item" role="presentation">
            <button class="nav-link active rounded-5" id="contact-tab2" data-bs-toggle="tab" type="button" role="tab" aria-selected="true">Solicitud cotización</button>
        </li>

    </ul>

    <br><br>
    <div class="container">


        <div class="print-button-container">
            <button class="btn btn-warning" onclick="imprimirTabla()">Imprimir Tabla</button>
        </div>

        <div class="table-responsive" id="tablaContainer">
            <table class="table table-dark table-hover">
                <thead class="table-dark">
                    <tr class="table-light">
                        <th scope="col">Nombre</th>
                        <th scope="col">Correo</th>
                        <th scope="col">Teléfono</th>
                        <th scope="col">Espacio</th>
                        <th scope="col">Montaje</th>
                        <th scope="col">Cantidad de Personas</th>
                        <th scope="col">Fecha Inicio</th>
                        <th scope="col">Fecha Fin</th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    include 'conexion.php';
                    $query = "SELECT id, nombre, correo, telefono, espacio, montaje, cantPersonas, fechaInic, fechaFin FROM aulas";
                    $ejecutar = $conex->query($query);
                    while ($result = $ejecutar->fetch_array()) {
                        echo "<tr>
                        <td>" . $result['nombre'] . "</td>
                        <td>" . $result['correo'] . "</td>
                        <td>" . $result['telefono'] . "</td>
                        <td>" . $result['espacio'] . "</td>
                        <td>" . $result['montaje'] . "</td>
                        <td>" . $result['cantPersonas'] . "</td>
                        <td>" . $result['fechaInic'] . "</td>
                        <td>" . $result['fechaFin'] . "</td>
                        <td><a href='#' onclick='editar(" . $result['id'] . ");' class='btn btn-warning'><i class='fa-solid fa-pencil'></i></a></td>
                        <td><a href='#' onclick='eliminarAula(" . $result['id'] . ");'class='btn btn-danger'><i class='fas fa-trash-alt'></i></a></td>
                    </tr>";
                    }
                    ?>
                </tbody>

            </table>
        </div>
    </div>

    <div class="container" id="result"></div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="SCRIPTS/script.js"></script>
</body>

</html>

<script>
    document.getElementById('profile-tab2').addEventListener('click', function() {
        window.location.href = 'precios.php';
    });

    document.getElementById('home-tab2').addEventListener('click', function() {
        window.location.href = 'aulas.php';
    });

    document.getElementById('home-tab1').addEventListener('click', function() {
        window.location.href = 'agenda.php';
    });
</script>