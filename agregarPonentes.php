<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/sidebar.css">
    <script src="SCRIPTS/jquery.min.js"></script>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Ponentes</title>
    <link rel="icon" type="image/png" href="images/logo.jpeg">

    <style>
        .btn-custom {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            text-align: center;
        }

        .btn-custom:hover {
            background-color: #0056b3;
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
            <button class="nav-link rounded-5" id="listevent-tab1" data-bs-toggle="tab" type="button" role="tab" aria-selected="false">Lista de eventos</button>
        </li>

        <li class="nav-item" role="presentation">
            <button class="nav-link rounded-5" id="category-tab2" data-bs-toggle="tab" type="button" role="tab" aria-selected="true">Categorias</button>
        </li>

        <li class="nav-item" role="presentation">
            <button class="nav-link active rounded-5" id="ponente-tab1" data-bs-toggle="tab" type="button" role="tab" aria-selected="true">Ponentes</button>
        </li>

    </ul>
    <br>
    <div class="container">

        <div class="col-md-12 row margenArriba" style="margin-bottom: 2%">
            <div class="col-md-5" style="margin-bottom: 2%">
                <div class="box-body">
                    <div id="tablaPrincipalCategoria_wrapper" class="dataTables_wrapper no-footer">
                        <div id="tablaPrincipalCategoria_filter" class="dataTables_filter">
                        </div>
                        <div id="tablaPrincipalCategoria_processing" class="dataTables_processing" style="display: none;"></div>
                        <table id="tablaPrincipalCategoria" class="table dataTable no-footer" style="font-size: 12px; width: 100%;" role="grid" aria-describedby="tablaPrincipalCategoria_info">
                            <thead>
                                <tr class="headings table table-dark" role="row">
                                    <th class="sorting_desc" tabindex="0" aria-controls="tablaPrincipalCategoria" rowspan="1" colspan="1" aria-label="ID: Activar para ordenar la columna de manera ascendente" aria-sort="descending" style="width: 0px;">ID</th>
                                    <th class="sorting" tabindex="0" aria-controls="tablaPrincipalCategoria" rowspan="1" colspan="2" aria-label="Datos: Activar para ordenar la columna de manera ascendente" style="width: 0px;">Datos</th>
                                    <th style=" width: 0px;" class="sorting" tabindex="0" aria-controls="tablaPrincipalCategoria" rowspan="1" colspan="1" aria-label="Acciones: Activar para ordenar la columna de manera ascendente">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                include 'conexion.php';
                                $query = "SELECT id, perfil, nombre FROM ponentes";
                                $ejecutar = $conex->query($query);
                                while ($result = $ejecutar->fetch_array()) {

                                    echo "<tr>
                                    <td>" . $result['id'] . "</td>
                                    <td>" . $result['perfil'] . " " . $result['nombre'] . "</td>
                                    <td><a href='#' onclick='editarPonente(" . $result['id'] . ");'  class='btn btn-warning' title='editar'><i class='fa-solid fa-pencil'></i></a></td>
                                    <td><a href='#' onclick='eliminarPonente(" . $result['id'] . ");'class='btn btn-danger' title='eliminar'><i class='fas fa-trash-alt'></i></a></td>
                                    </tr>";
                                }
                                ?>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>


            <div class="col">

                <h3 style="font-size: 36px; font-family: 'Cooper Black', sans-serif;">Ingresa los datos:</h3>

                <div class="row">

                    <div class="col">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" name="nombre" id="nombre" required>
                    </div>

                    <div class="col">
                        <label for="perfil">Perfil:</label>
                        <select class="form-select" id="perfil" name="perfil" aria-label="perfil">
                            <option selected> selecciona una opción</option>
                            <option value="Dr.">Dr.</option>
                            <option value="Dra.">Dra.</option>
                            <option value="Mtro.">Mtro.</option>
                            <option value="Mtra.">Mtra.</option>
                            <option value="Ing.">Ing.</option>
                            <option value="Lic.">Lic.</option>
                        </select>
                    </div>

                </div>

                <div class="row">

                    <div class="col">
                        <label for="puesto" class="form-label">Puesto</label>
                        <input type="text" class="form-control" name="puesto" id="puesto" required>
                    </div>

                    <div class="col">
                        <label for="especialidad" class="form-label">Especialidad</label>
                        <select class="form-select" id="especialidad" name="especialidad" aria-label="especialidad">
                            <option selected> selecciona una opción</option>
                            <option value="LIDERAZGO">LIDERAZGO</option>
                            <option value="DESARROLLO Y GESTIÓN DE NEGOCIOS">DESARROLLO Y GESTIÓN DE NEGOCIOS</option>
                            <option value="VENTAS">VENTAS</option>
                            <option value="RECURSOS HUMANOS">RECURSOS HUMANOS</option>
                            <option value="FISCAL">FISCAL</option>
                        </select>
                    </div>

                </div>
                <br>

                <div class="d-grid gap-2">
                    <button type="button" class="btn-custom" onclick="guardarPonente();"><i class="fa-solid fa-floppy-disk"> Guardar</i></button>
                </div>

            </div>

        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="SCRIPTS/script.js"></script>
</body>

</html>

<script>
    document.getElementById('contact-tab2').addEventListener('click', function() {
        window.location.href = 'eventos.php';
    });

    document.getElementById('listevent-tab1').addEventListener('click', function() {
        window.location.href = 'listaEventos.php';
    });

    document.getElementById('category-tab2').addEventListener('click', function() {
        window.location.href = 'categoria.php';
    });
</script>