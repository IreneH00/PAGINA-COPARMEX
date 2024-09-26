<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de eventos</title>
    <link rel="icon" type="image/png" href="images/logo.jpeg">
    <link rel="stylesheet" href="CSS/sidebar.css">
    <script src="SCRIPTS/jquery.min.js"></script>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .switch {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 34px;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            transition: .4s;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 26px;
            width: 26px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            transition: .4s;
        }

        input:checked+.slider {
            background-color: #1fa911;
        }

        input:focus+.slider {
            box-shadow: 0 0 1px #1fa91f;
        }

        input:checked+.slider:before {
            transform: translateX(26px);
        }

        .slider.round {
            border-radius: 34px;
        }

        .slider.round:before {
            border-radius: 50%;
        }

        .line-red {
            text-decoration: line-through;
            text-decoration-color: #d33;
            text-decoration-thickness: 4px;
        }
    </style>
</head>

<body style="font-family: 'Geist Mono', monospace;">

    <ul class="nav nav-pills nav-fill gap-2 p-1 small bg-primary rounded-5 shadow-sm" id="pillNav2" role="tablist" style="--bs-nav-link-color: var(--bs-white); --bs-nav-pills-link-active-color: var(--bs-primary); --bs-nav-pills-link-active-bg: var(--bs-white);">

        <li class="nav-item" role="presentation">
            <a class="nav-link rounded-5" href="sidebar.php" role="button"><i class="fa-solid fa-house"> Ir al Inicio</i></a>
        </li>

        <li class="nav-item" role="presentation">
            <button class="nav-link rounded-5" id="contact-tab2" data-bs-toggle="tab" type="button" role="tab" aria-selected="false">Agregar evento</button>
        </li>

        <li class="nav-item" role="presentation">
            <button class="nav-link active rounded-5" id="listevent-tab1" data-bs-toggle="tab" type="button" role="tab" aria-selected="true">Lista de eventos</button>
        </li>

        <li class="nav-item" role="presentation">
            <button class="nav-link rounded-5" id="category-tab2" data-bs-toggle="tab" type="button" role="tab" aria-selected="true">Categorias</button>
        </li>

        <li class="nav-item" role="presentation">
            <button class="nav-link rounded-5" id="ponente-tab1" data-bs-toggle="tab" type="button" role="tab" aria-selected="true">Ponentes</button>
        </li>

    </ul>

    <br><br>

    <div class="container">
        <div class="print-button-container">
            <button class="btn btn-warning" onclick="imprimirTabla()">Imprimir Tabla</button>
        </div>
        <br>

        <div class="table-responsive" id="tablaContainer">
            <table class="table table-hover">
                <thead class="table-dark">
                    <tr class="table table-dark">
                        <th scope="col">id</th>
                        <th scope="col">Evento</th>
                        <th scope="col">Precios</th>
                        <th scope="col">Ubicación</th>
                        <th scope="col">Ponente</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">Hora</th>
                        <th scope="col">Gratuito</th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th>Alta/Baja</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    include 'conexion.php';
                    $query = "SELECT id, nombre_evento, precio_socio, precio_general, precio_estudiante, precio_prospecto, precio_cortesia, precio_no_activo, ubicacion, ponente, fecha, hora, gratis, activo FROM eventos";
                    $ejecutar = $conex->query($query);

                    while ($result = $ejecutar->fetch_array()) {
                        echo "<tr>
                        
                            <td>" . $result['id'] . "</td>

                            <td style='font-size: 11px;'><span class='text-content'>" . $result['nombre_evento'] . "</span></td>
                            
                            <td>
                                <div style='font-size: 11px;'><span class='text-content'>Socio: $" . $result['precio_socio'] . "</span></div>
                                <div style='font-size: 11px;'><span class='text-content'>General: $" . $result['precio_general'] . "</span></div>
                                <div style='font-size: 11px;'><span class='text-content'>Estudiante: $" . $result['precio_estudiante'] . "</span></div>
                                <div style='font-size: 11px;'><span class='text-content'>Prospecto: $" . $result['precio_prospecto'] . "</span></div>
                                <div style='font-size: 11px;'><span class='text-content'>Cortesía: $" . $result['precio_cortesia'] . "</span></div>
                                <div style='font-size: 11px;'><span class='text-content'>No Activo: $" . $result['precio_no_activo'] . "</span></div>
                            </td>

                            <td style='font-size: 11px;'><span class='text-content'>" . $result['ubicacion'] . "</span></td>
                            <td style='font-size: 11px;'><span class='text-content'>" . $result['ponente'] . "</span></td>
                            <td style='font-size: 11px;'><span class='text-content'>" . $result['fecha'] . "</span></td>
                            <td style='font-size: 11px;'><span class='text-content'>" . $result['hora'] . "</span></td>                  
                            <td style='font-size: 11px;'><span class='text-content'>" . ($result['gratis'] == 1 ? 'Sí' : 'No') . "</span></td>
                            <td><a href='#' onclick='editarEvento(" . $result['id'] . ");' class='btn btn-warning' title='editar'><i class='fa-solid fa-pencil'></i></a></td>
                            <td><a href='#' onclick='eliminarEvento(" . $result['id'] . ");' class='btn btn-danger' title='eliminar'><i class='fas fa-trash-alt'></i></a></td>
                            <td><a href='participantesEventos.php?nombre_evento=" . urlencode($result['nombre_evento']) . "&gratis=" . $result['gratis'] . "' class='btn btn-primary'><i class='fas fa-users' title='participantes'></i></a></td>
                            
                            <td>
                                <label class='switch'>
                                    <input type='checkbox' id='checkbox" . $result['id'] . "' onchange='darAlta(" . $result['id'] . ")'>
                                    <span class='slider round' title='Dar de baja o alta'></span>
                                </label>
                            </td>

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
    document.getElementById('contact-tab2').addEventListener('click', function() {
        window.location.href = 'eventos.php';
    });

    document.getElementById('category-tab2').addEventListener('click', function() {
        window.location.href = 'categoria.php';
    });

    document.getElementById('ponente-tab1').addEventListener('click', function() {
        window.location.href = 'agregarPonentes.php';
    });

    function darAlta(id) {

        var checkbox = document.getElementById('checkbox' + id);
        var row = checkbox.closest('tr');
        var textContents = row.querySelectorAll('.text-content');

        if (checkbox) {
            var isChecked = checkbox.checked;
            var nuevoEstado = isChecked ? 1 : 0;

            $.ajax({
                url: 'actualizar_estado_evento.php',
                type: 'POST',
                data: {
                    id: id,
                    activo: nuevoEstado
                },
                success: function(response) {
                    if (response === 'success') {
                        localStorage.setItem('checkbox' + id, isChecked);

                        textContents.forEach(function(span) {
                            if (isChecked) {
                                span.classList.add('line-red');
                            } else {
                                span.classList.remove('line-red');
                            }
                        });
                    } else {
                        console.error('Error al actualizar el estado en la base de datos.');
                    }
                },
                error: function() {
                    console.error('Error en la petición AJAX.');
                }
            });
        } else {
            console.error("Checkbox with ID 'checkbox" + id + "' not found.");
        }
    }

    document.addEventListener('DOMContentLoaded', function() {

        var checkboxes = document.querySelectorAll('input[type=checkbox]');
        checkboxes.forEach(function(checkbox) {

            var id = checkbox.id.replace('checkbox', '');
            var savedState = localStorage.getItem('checkbox' + id);
            var row = checkbox.closest('tr');
            var textContents = row.querySelectorAll('.text-content');

            if (savedState !== null) {
                checkbox.checked = savedState === 'true';

                textContents.forEach(function(span) {
                    if (checkbox.checked) {
                        span.classList.add('line-red');
                    } else {
                        span.classList.remove('line-red');
                    }
                });
            }
        });
    });
</script>