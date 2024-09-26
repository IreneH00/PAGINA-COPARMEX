<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitud de Equipo</title>
    <link rel="icon" type="image/png" href="images/logo.jpeg">
    <link rel="stylesheet" href="CSS/sidebar.css">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="SCRIPTS/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <style>
        body {
            font-family: 'Geist Mono', monospace;
        }

        .action-icons {
            display: flex;
            gap: 10px;
            justify-content: center;
        }

        .action-icons a {
            text-decoration: none;
            color: inherit;
        }

        .action-icons i {
            font-size: 16px;
        }

        .action-icons a.btn-danger i {
            color: white;
        }

        .form-container {
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 600px; 
            margin: auto; 
        }

        .table-container {
            overflow-x: auto;
        }

        .table th, .table td {
            white-space: normal;
            word-wrap: break-word;
        }

        .table th {
            width: 12%; 
        }

        .table th,
        .table td {
            text-align: center;
            vertical-align: middle;
        }
    </style>
</head>

<body>
    <ul class="nav nav-pills nav-fill gap-2 p-1 small bg-primary rounded-5 shadow-sm" id="pillNav2" role="tablist"
        style="--bs-nav-link-color: var(--bs-white); --bs-nav-pills-link-active-color: var(--bs-primary); --bs-nav-pills-link-active-bg: var(--bs-white);">
        <li class="nav-item" role="presentation">
            <a class="nav-link rounded-5" href="sidebar.php" role="button"><i class="fa-solid fa-house"></i> Ir al Inicio</a>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link rounded-5" id="inventario-tab2" data-bs-toggle="tab" type="button" role="tab">Inventario Interno</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link rounded-5" id="equipo-tab1" data-bs-toggle="tab" type="button" role="tab">Inventario de equipo</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link active rounded-5" id="equipo-tab2" data-bs-toggle="tab" type="button" role="tab">Solicitud de equipo</button>
        </li>
    </ul>

    <br><br>

    <div class="container">
        <div class="row">
            <div class="col-md-8 table-container">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Equipo</th>
                                <th>Solicitante</th>
                                <th>Fecha<br>adquisición</th> 
                                <th>Fecha<br>devolución</th> 
                                <th>Motivo</th>
                                <th>Código</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            include 'conexion.php';
                            $query = "SELECT s.id, s.equipo, s.Nombre_solicitante, s.Fecha_solicitud, s.Fecha_devolucion, s.Motivo, s.Codigo_Identificacion
                                      FROM solicitudes s
                                      ORDER BY s.id DESC";
                                      
                            $ejecutar = $conex->query($query);
                            while ($result = $ejecutar->fetch_assoc()) {
                                echo "<tr>
                                        <td>{$result['id']}</td>
                                        <td>{$result['equipo']}</td>
                                        <td>{$result['Nombre_solicitante']}</td>
                                        <td>{$result['Fecha_solicitud']}</td>
                                        <td>{$result['Fecha_devolucion']}</td>
                                        <td>{$result['Motivo']}</td>
                                        <td>{$result['Codigo_Identificacion']}</td>
                                        <td>
                                            <div class='action-icons'>
                                                <a href='#' onclick='editarSolicitud({$result['id']});' class='btn btn-warning' title='editar'><i class='fa-solid fa-pencil'></i></a>
                                                <a href='#' onclick='eliminarSolicitud({$result['id']});' class='btn btn-danger' title='eliminar'><i class='fas fa-trash-alt'></i></a>
                                            </div>
                                        </td>
                                      </tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="col-md-4 form-container p-3">
                
                <h3 class="mb-3" style="font-family: monospace; font-weight: bold;">Solicitar Equipo</h3>

                <form id="formSolicitud">
    <div class="mb-3">
        <label for="equipo" class="form-label">Equipo</label>
        <select class="form-select" id="equipo" name="equipo" required>
            <option value="">Seleccione un equipo...</option>
            <?php
            include 'conexion.php';
            $query = "SELECT DISTINCT equipo FROM equipo";
            $result = $conex->query($query);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row['equipo'] . "'>" . $row['equipo'] . "</option>";
                }
            }
            ?>
        </select>
    </div>

    <div class="mb-3">
        <label for="solicitante" class="form-label">Nombre del Solicitante</label>
        <input type="text" id="solicitante" name="solicitante" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="fechaSolicitud" class="form-label">Fecha de Solicitud</label>
        <input type="date" id="fechaSolicitud" name="fechaSolicitud" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="fechaDevolucion" class="form-label">Fecha de Devolución</label>
        <input type="date" id="fechaDevolucion" name="fechaDevolucion" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="motivo" class="form-label">Motivo de la Solicitud</label>
        <textarea id="motivo" name="motivo" class="form-control" rows="3" required></textarea>
    </div>
    <input type="hidden" id="codigo" name="codigo">
    <button type="submit" class="btn btn-primary w-100">Enviar Solicitud</button>
</form>

            </div>
        </div>
    </div>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('inventario-tab2').addEventListener('click', function() {
            window.location.href = 'inventario.php';
        });

        document.getElementById('equipo-tab1').addEventListener('click', function() {
            window.location.href = 'inventarioEquipo.php';
        });

        //ELIMINAR SOLICITUD
        function eliminarSolicitud(id) {
    console.log('ID de solicitud:', id); 

    Swal.fire({
        title: '¿Estás seguro?',
        text: "¡Esta acción no se puede deshacer!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: 'eliminarSolicitud.php',
                type: 'POST',
                data: { id: id },
                dataType: 'json', 
                success: function(response) {
                    if (response.success) {
                        Swal.fire(
                            'Eliminado!',
                            'La solicitud ha sido eliminada.',
                            'success'
                        ).then(() => {
                            location.reload();
                        });
                    } else {
                        Swal.fire(
                            'Error!',
                            response.error || 'Hubo un problema al eliminar la solicitud.',
                            'error'
                        );
                    }
                },
                error: function(xhr, status, error) {
                    Swal.fire(
                        'Error!',
                        'Hubo un problema al comunicarse con el servidor: ' + error,
                        'error'
                    );
                }
            });
        }
    });
}


// EDITAR SOLICITUD
function editarSolicitud(id) {
    $.ajax({
        url: 'obtenerSolicitud.php',
        type: 'POST',
        data: { id: id },
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                Swal.fire({
                    title: 'Editar Solicitud',
                    html: `
                        <form id="formEditar">
                            <input type="hidden" id="editId" value="${response.data.id}">
                            <div class="mb-3">
                                <label for="editEquipo" class="form-label">Equipo</label>
                                <input type="text" id="editEquipo" class="form-control" value="${response.data.equipo}" required>
                            </div>
                            <div class="mb-3">
                                <label for="editNombreSolicitante" class="form-label">Nombre del Solicitante</label>
                                <input type="text" id="editNombreSolicitante" class="form-control" value="${response.data.Nombre_solicitante}" required>
                            </div>
                            <div class="mb-3">
                                <label for="editFechaSolicitud" class="form-label">Fecha de Solicitud</label>
                                <input type="date" id="editFechaSolicitud" class="form-control" value="${response.data.Fecha_solicitud}" required>
                            </div>
                            <div class="mb-3">
                                <label for="editFechaDevolucion" class="form-label">Fecha de Devolución</label>
                                <input type="date" id="editFechaDevolucion" class="form-control" value="${response.data.Fecha_devolucion}" required>
                            </div>
                            <div class="mb-3">
                                <label for="editMotivo" class="form-label">Motivo de la Solicitud</label>
                                <textarea id="editMotivo" class="form-control" rows="3" required>${response.data.Motivo}</textarea>
                            </div>
                        </form>
                    `,
                    showCancelButton: true,
                    confirmButtonText: 'Guardar cambios',
                    cancelButtonText: 'Cancelar',
                    preConfirm: () => {
                        return new Promise((resolve) => {
                            resolve({
                                id: $('#editId').val(),
                                equipo: $('#editEquipo').val(),
                                nombreSolicitante: $('#editNombreSolicitante').val(),
                                fechaSolicitud: $('#editFechaSolicitud').val(),
                                fechaDevolucion: $('#editFechaDevolucion').val(),
                                motivo: $('#editMotivo').val()
                            });
                        });
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: 'actualizarSolicitud.php',
                            type: 'POST',
                            data: result.value,
                            dataType: 'json',
                            success: function(response) {
                                if (response.success) {
                                    Swal.fire(
                                        'Actualizado!',
                                        'La solicitud ha sido actualizada.',
                                        'success'
                                    ).then(() => {
                                        location.reload();
                                    });
                                } else {
                                    Swal.fire(
                                        'Error!',
                                        response.error || 'Hubo un problema al actualizar la solicitud.',
                                        'error'
                                    );
                                }
                            },
                            error: function(xhr, status, error) {
                                Swal.fire(
                                    'Error!',
                                    'Hubo un problema al comunicarse con el servidor: ' + error,
                                    'error'
                                );
                            }
                        });
                    }
                });
            } else {
                Swal.fire(
                    'Error!',
                    response.error || 'No se pudo obtener los datos de la solicitud.',
                    'error'
                );
            }
        },
        error: function(xhr, status, error) {
            Swal.fire(
                'Error!',
                'Hubo un problema al comunicarse con el servidor: ' + error,
                'error'
            );
        }
    });
}


 //ENVIAR SOLICITUD
 $(document).ready(function() {
    $('#formSolicitud').on('submit', function(event) {
        event.preventDefault(); 
        
        
        const formData = $(this).serialize();

        
        $.ajax({
            url: 'solicitarEquipo.php',
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    Swal.fire({
                        title: 'Éxito!',
                        text: response.success,
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        
                        $('#formSolicitud')[0].reset();
                       
                        // location.reload();
                       
                   
                    
                    });
                } else {
                    Swal.fire({
                        title: 'Error!',
                        text: response.error,
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                }
            },
            error: function(xhr, status, error) {
                Swal.fire({
                    title: 'Error!',
                    text: 'Hubo un problema al comunicarse con el servidor: ' + error,
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            }
        });
    });
});




    </script>
</body>

</html>
