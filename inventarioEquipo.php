<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventario</title>
    <link rel="icon" type="image/png" href="images/logo.jpeg">
    <link rel="stylesheet" href="CSS/sidebar.css">
    <script src="SCRIPTS/jquery.min.js"></script>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .action-icons {
            display: flex;
            justify-content: space-between;
            gap: 5mm;
        }

        .form-container {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            margin-top: 20px;
            max-width: 500px;
        }

        .form-container h3 {
            white-space: nowrap; 
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .pagination-button {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 8px 12px;
            margin: 0 5px;
            cursor: pointer;
        }

        .pagination-button:hover {
            background-color: #eee;
        }

        .pagination-button.active {
            background-color: rgba(26, 162, 196, 0.884);
            color: white;
        }

        .btn-rectangle {
            border-radius: 5px;
            width: auto;
            height: auto;
            padding: 10px 20px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            border: none;
            font-weight: bold;
        }

        .btn-disponible {
            background-color: #1adf06; 
        }

        .btn-en-uso {
            background-color: #ffc107;
        }

        .btn-en-reparacion {
            background-color: #f44336; 
        }

        .btn-rectangle:hover {
            opacity: 0.8;
        }

        .form-container {
            max-width: 500px;
            margin: auto;
        }

        .form-label {
            font-weight: bold;
        }

        .form-control {
            border-radius: 10px;
        }

        .btn-success {
            background-color: #28a745;
            border: none;
            transition: background-color 0.3s ease;
        }

        .btn-success:hover {
            background-color: #218838;
        }

        
        .flex-container {
            display: flex;
            justify-content: space-between;
            gap: 20px; 
        }

        .table-container,
        .form-container {
            flex: 1;
        }

        .table-container {
            margin-right: 20px; 
        }
    </style>
</head>

<body style="font-family: 'Geist Mono', monospace;">

    <ul class="nav nav-pills nav-fill gap-2 p-1 small bg-primary rounded-5 shadow-sm" id="pillNav2" role="tablist" style="--bs-nav-link-color: var(--bs-white); --bs-nav-pills-link-active-color: var(--bs-primary); --bs-nav-pills-link-active-bg: var(--bs-white);">
        <li class="nav-item" role="presentation">
            <a class="nav-link rounded-5" href="sidebar.php" role="button"><i class="fa-solid fa-house"> Ir al Inicio</i></a>
        </li>

        <li class="nav-item" role="presentation">
            <button class="nav-link rounded-5" id="inventario-tab2" data-bs-toggle="tab" type="button" role="tab" aria-selected="true">Inventario Interno</button>
        </li>

        <li class="nav-item" role="presentation">
            <button class="nav-link active rounded-5" id="equipo-tab1" data-bs-toggle="tab" type="button" role="tab" aria-selected="false">Inventario de Equipo</button>
        </li>

        <li class="nav-item" role="presentation">
            <button class="nav-link rounded-5" id="equipo-tab2" data-bs-toggle="tab" type="button" role="tab" aria-selected="true">Solicitud de Equipo</button>
        </li>
    </ul>

    <br><br>

    <div class="container">
        <div class="flex-container">
            <!-- Tabla de equipos -->
            <div class="table-container">
                <div class="table-responsive" id="tablaContainer">
                    <table class="table table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Equipo</th>
                                <th>Código</th>
                                <th>Características</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>

                        <tbody>
                        <?php
                        include 'conexion.php';
                        $query = "SELECT id, Equipo, No_Identificacion, Caracteristicas, Estado 
                            FROM equipo 
                            ORDER BY id DESC";

                        $ejecutar = $conex->query($query);
                        while ($result = $ejecutar->fetch_assoc()) {
                            $estadoClass = '';
                            switch ($result['Estado']) {
                                case 'disponible':
                                    $estadoClass = 'btn-disponible';
                                    break;
                                case 'en uso':
                                    $estadoClass = 'btn-en-uso';
                                    break;
                                case 'en reparación':
                                    $estadoClass = 'btn-en-reparacion';
                                    break;
                            }

                            echo "<tr>
                                    <td>" . $result['id'] . "</td>
                                    <td>" . $result['Equipo'] . "</td>
                                    <td>" . $result['No_Identificacion'] . "</td>
                                    <td>" . $result['Caracteristicas'] . "</td>
                                    <td>
                                        <button class='btn btn-rectangle " . $estadoClass . "' 
                        data-id='" . $result['id'] . "' 
                        data-estado='" . $result['Estado'] . "' 
                        onclick='cambiarEstado(this);'>
                </button>
                                    </td>
                                    <td>
                                      <div class='action-icons'>
                                        <a href='#' onclick='editarEquipo(" . $result['id'] . ");' class='btn btn-warning btn-circle' title='editar'><i class='fa-solid fa-pencil'></i></a>
                                        <a href='#' onclick='eliminarEquipo(" . $result['id'] . ");' class='btn btn-danger btn-circle' title='eliminar'><i class='fas fa-trash-alt'></i></a>
                                      </div>
                                    </td>
                                  </tr>";
                        }
                        ?>
                        </tbody>
                    </table>
                </div>

               
                <div class="pagination" id="pagination">
                    <button id="prevPage" class="pagination-button" data-page="prev">Anterior</button>
                    <div id="pageNumbers" class="page-numbers"></div>
                    <button id="nextPage" class="pagination-button" data-page="next">Siguiente</button>
                </div>
                <br>
            </div>

            
             
             
            <div class="form-container card shadow p-4 mb-5 bg-white rounded">
                <h3 class="mb-4 text-center" style="font-family: monospace; font-weight: bold;">Agregar Equipo</h3>

                <form action="procesar_producto.php" method="post">
                    <div class="mb-3">
                        <label for="equipo" class="form-label">Equipo</label>
                        <input type="text" id="equipo" name="equipo" class="form-control" placeholder="Ingrese el nombre del equipo" required>
                    </div>
                    <div class="mb-3">
                        <label for="no_identificacion" class="form-label">Código</label>
                        <input type="text" id="no_identificacion" name="no_identificacion" class="form-control" placeholder="Ingrese el código de identificación" required>
                    </div>
                    <div class="mb-3">
                        <label for="caracteristicas" class="form-label">Características</label>
                        <textarea id="caracteristicas" name="caracteristicas" class="form-control" placeholder="Ingrese las características" required></textarea>
                    </div>
                  
        <button type="submit" class="btn btn-primary btn-lg w-100">Guardar</button>
    </form>
</div>
        </div>
    </div>


    <script src="js/bootstrap.bundle.min.js"></script>

    <script>
        document.getElementById('inventario-tab2').addEventListener('click', function() {
            window.location.href = 'inventario.php';
        });

        document.getElementById('equipo-tab2').addEventListener('click', function() {
            window.location.href = 'SolicitudEquipo.php';
        });

        // Paginación
        document.addEventListener('DOMContentLoaded', function() {
            const rowsPerPage = 6;
            const table = document.querySelector('.table');
            const rows = Array.from(table.querySelectorAll('tbody tr'));
            const totalPages = Math.ceil(rows.length / rowsPerPage);
            let currentPage = 1;

            const paginationContainer = document.getElementById('pagination');
            const pageNumbersContainer = document.getElementById('pageNumbers');
            const prevButton = document.getElementById('prevPage');
            const nextButton = document.getElementById('nextPage');

            function displayPage(page) {
                const startIndex = (page - 1) * rowsPerPage;
                const endIndex = page * rowsPerPage;

                rows.forEach((row, index) => {
                    row.style.display = (index >= startIndex && index < endIndex) ? '' : 'none';
                });

                currentPage = page;
                prevButton.disabled = currentPage === 1;
                nextButton.disabled = currentPage === totalPages;
                updatePageNumbers();
            }

            function updatePageNumbers() {
                pageNumbersContainer.innerHTML = '';
                for (let i = 1; i <= totalPages; i++) {
                    const pageButton = document.createElement('button');
                    pageButton.className = 'pagination-button';
                    pageButton.textContent = i;
                    if (i === currentPage) pageButton.classList.add('active');
                    pageButton.addEventListener('click', () => displayPage(i));
                    pageNumbersContainer.appendChild(pageButton);
                }
            }

            prevButton.addEventListener('click', () => displayPage(currentPage - 1));
            nextButton.addEventListener('click', () => displayPage(currentPage + 1));

            displayPage(1);
        });


        //REGISTRAR EQUIPO
        $(document).ready(function() {
        $('form').on('submit', function(event) {
            event.preventDefault(); 

            var formData = new FormData(this);

            $.ajax({
                url: 'registrarEquipo.php',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response.trim() === 'success') {
                        Swal.fire(
                            'Éxito',
                            'El equipo ha sido registrado.',
                            'success'
                        ).then(() => {
                            
                            $('form').trigger('reset');
                            location.reload();
                        });
                    } else {
                        Swal.fire(
                            'Error',
                            'Hubo un problema al registrar el equipo.',
                            'error'
                        );
                    }
                },
                error: function() {
                    Swal.fire(
                        'Error',
                        'No se pudo conectar con el servidor.',
                        'error'
                    );
                }
            });
        });
    });

    // ELIMINAR EQUIPO
    function eliminarEquipo(id) {
        Swal.fire({
            title: '¿Estás seguro?',
            text: "No podrás recuperar este equipo una vez eliminado.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: 'eliminarEquipo.php',
                    type: 'POST',
                    data: { id: id },
                    success: function(response) {
                        console.log('Respuesta del servidor:', response); 

                        if (response.trim() === 'success') {
                            Swal.fire(
                                'Eliminado',
                                'El equipo ha sido eliminado.',
                                'success'
                            ).then(() => {
                                location.reload(); 
                            });
                        } else {
                            Swal.fire(
                                'Error',
                                response, 
                                'error'
                            );
                        }
                    },
                    error: function() {
                        Swal.fire(
                            'Error',
                            'No se pudo conectar con el servidor.',
                            'error'
                        );
                    }
                });
            }
        });
    }

    //EDITAR
    function editarEquipo(id) {
        $.ajax({
            url: 'obtenerDatosEquipo.php',
            type: 'POST',
            data: { id: id },
            success: function(response) {
                try {
                    const data = JSON.parse(response);

                    
                    Swal.fire({
                        title: 'Editar Equipo',
                        html: `
                            <input type="text" id="editEquipo" class="swal2-input" placeholder="Equipo" value="${data.Equipo || ''}">
                            <input type="text" id="editCodigo" class="swal2-input" placeholder="Código" value="${data.No_Identificacion || ''}">
                            <input type="text" id="editCaracteristicas" class="swal2-input" placeholder="Características" value="${data.Caracteristicas || ''}">
                        `,
                        showCancelButton: true,
                        confirmButtonText: 'Guardar',
                        cancelButtonText: 'Cancelar',
                        preConfirm: () => {
                            const equipo = Swal.getPopup().querySelector('#editEquipo').value;
                            const codigo = Swal.getPopup().querySelector('#editCodigo').value;
                            const caracteristicas = Swal.getPopup().querySelector('#editCaracteristicas').value;
                            
                            if (!equipo || !codigo || !caracteristicas) {
                                Swal.showValidationMessage('Todos los campos son obligatorios');
                            }

                            return { equipo: equipo, codigo: codigo, caracteristicas: caracteristicas };
                        }
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: 'actualizarEquipo.php',
                                type: 'POST',
                                data: {
                                    id: id,
                                    equipo: result.value.equipo,
                                    codigo: result.value.codigo,
                                    caracteristicas: result.value.caracteristicas
                                },
                                success: function(response) {
                                    console.log('Respuesta del servidor:', response); 

                                    if (response.trim() === 'success') {
                                        Swal.fire(
                                            'Actualizado',
                                            'El equipo ha sido actualizado.',
                                            'success'
                                        ).then(() => {
                                            location.reload();
                                        });
                                    } else {
                                        Swal.fire(
                                            'Error',
                                            response, 
                                            'error'
                                        );
                                    }
                                },
                                error: function(jqXHR, textStatus, errorThrown) {
                                    console.error('Error:', textStatus, errorThrown); 
                                    Swal.fire(
                                        'Error',
                                        'No se pudo conectar con el servidor.',
                                        'error'
                                    );
                                }
                            });
                        }
                    });

                } catch (error) {
                    console.error('Error al parsear la respuesta:', error); 
                    Swal.fire(
                        'Error',
                        'No se pudo recuperar los datos del equipo.',
                        'error'
                    );
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('Error:', textStatus, errorThrown); 
                Swal.fire(
                    'Error',
                    'No se pudo conectar con el servidor.',
                    'error'
                );
            }
        });
    }

    //CAMBIAR ESTADO
    function cambiarEstado(button) {
    const id = $(button).data('id');
    const estadoActual = $(button).data('estado');
    let nuevoEstado;

    switch (estadoActual) {
        case 'disponible':
        case 'en uso':
            nuevoEstado = 'en reparación';
            break;
        case 'en reparación':
            nuevoEstado = 'disponible'; 
            break;
        default:
            nuevoEstado = 'disponible'; 
            break;
    }

    $.ajax({
        url: 'actualizarEstadoEquipo.php',
        type: 'POST',
        data: { id: id, estado: nuevoEstado },
        success: function(response) {
            if (response.trim() === 'success') {
               
                $(button).data('estado', nuevoEstado);
                $(button).removeClass('btn-disponible btn-en-uso btn-en-reparacion');
                $(button).addClass('btn-' + nuevoEstado.replace(' ', '-'));
                Swal.fire('Estado Actualizado', 'El estado del equipo ha sido actualizado a ' + nuevoEstado + '.', 'success');
            } else {
                Swal.fire('Error', 'Hubo un problema al actualizar el estado.', 'error');
            }
        },
        error: function() {
            Swal.fire('Error', 'No se pudo conectar con el servidor.', 'error');
        }
    });
}


    </script>


</body>

</html>
