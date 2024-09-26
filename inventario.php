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


.table-container {
    width: 70%;
    margin: 0;
    padding: 0;
    float: left;
}

.form-container {
    width: 30%;
    float: left;
    padding-left: 20px;
}

.form-container form {
    display: flex;
    flex-direction: column;
}

.form-container label {
    margin-bottom: 5px;
}

.form-container input {
    margin-bottom: 10px;
}

.form-container button {
    margin-top: 10px;
}

.action-icons {
    display: flex;
    justify-content: space-between;
    width: 100px;
}

.action-icons a {
    margin: 0 5px;
}

.table-container table {
    width: 100%;
}

.btn-light-grey {
background-color: #60B5E1; 
color: white;
}

.btn-light-grey:hover {
background-color: #60B5E1; 
}
.btn-light-blue {
background-color: #293142; 
color: white;
}


.btn-light-blue:hover {
background-color: #293142; 
}
.no-results-message {
color: #dc3545;
font-style: italic;
text-align: center;
}


.search-container {
    width: 100%; 
    margin-bottom: 20px; 
}

.search-input-group {
    display:flexbox;
    justify-content: flex-start;
    width: 100%; 
}

.form-control.custom-small-input {
    width: 70%; }




.form-control {
flex-grow: 1;
margin-right: 10px;
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
background-color: #007bff;
color: #fff;
}

.pagination-button.active {
background-color: rgba(26, 162, 196, 0.884);
color: white;
}

.signo-adicion {
    color: green;
    font-weight: bold;
}

.signo-retiro {
    color: red;
    font-weight: bold;
}

@media (max-width: 768px) {
    .table-container,
    .form-container {
        width: 100%;
        float: none;
        padding: 0;
    }
    
    .table-container {
        margin-bottom: 20px;
    }
    
    .form-container {
        padding-left: 0;
    }

    .button-container {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .button-container button {
        width: 100%;
    }

    .search-container {
        margin-bottom: 10px;
    }

    .action-icons {
        justify-content: center;
    }

    .action-icons a {
        margin: 0 8px;
    }
}

@media (min-width: 769px) {
    .table-container {
        width: 70%;
        float: left;
    }

    .form-container {
        width: 30%;
        float: left;
        padding-left: 20px;
    }

    .action-icons {
        justify-content: space-between;
        width: 100px;
    }

    .action-icons a {
        margin: 0 5px;
    }

    .button-container {
        display: flex;
        justify-content: flex-start;
        gap: 10px;
    }

    .button-container button {
        width: auto;
    }
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

    .button-container {
        text-align: center;
        margin-top: 15px; 
    }


    </style>
</head>

<body style="font-family: 'Geist Mono', monospace;">

<ul class="nav nav-pills nav-fill gap-2 p-1 small bg-primary rounded-5 shadow-sm" id="pillNav2" role="tablist" style="--bs-nav-link-color: var(--bs-white); --bs-nav-pills-link-active-color: var(--bs-primary); --bs-nav-pills-link-active-bg: var(--bs-white);">
    <li class="nav-item" role="presentation">
      <a class="nav-link rounded-5" href="sidebar.php" role="button"><i class="fa-solid fa-house"> Ir al Inicio</i></a>
    </li>

    <li class="nav-item" role="presentation">
      <button class="nav-link active rounded-5" id="inventario-tab2" data-bs-toggle="tab" type="button" role="tab" aria-selected="true">Inventario Interno</button>
    </li>

    <li class="nav-item" role="presentation">
      <button class="nav-link rounded-5" id="equipo-tab1" data-bs-toggle="tab" type="button" role="tab" aria-selected="false">Inventario de Equipo</button>
    </li>

    <li class="nav-item" role="presentation">
      <button class="nav-link rounded-5" id="equipo-tab2" data-bs-toggle="tab" type="button" role="tab" aria-selected="true">Solicitud de Equipo</button>
    </li>
</ul>

<br><br>

<div class="container">
    <div class="button-container">
        
    <button id="btnProductos" class="btn btn-primary btn-custom-width">Productos</button>
<button id="btnHistorial" class="btn btn-primary btn-custom-width">Historial</button>
<button class="btn btn-primary btn-custom-width" onclick="añadirProducto()">Añadir Producto</button>
<button class="btn btn-primary btn-custom-width" onclick="retirarProducto()">Sacar del stock</button>

    </div>
    <br>

    <div class="table-container">
        <div class="table-responsive" id="tablaContainer">
            <table class="table table-hover">
                <thead class="table-dark">
                    <tr class="table table-dark">
                        <th>ID</th>
                        <th>Nombre del producto</th>
                        <th>Descripción</th>
                        <th>Precio</th>
                        <th>Unidades</th>
                        <th>Acciones</th>
                    </tr>
                </thead>

                <tbody>
                <?php
                include 'conexion.php';
                $query = "SELECT p.id, p.nombre, p.descripcion, p.cantidad_total,  p.precio
                          FROM productos p
                          ORDER BY p.id DESC";
                
                $ejecutar = $conex->query($query);
                while ($result = $ejecutar->fetch_assoc()) {
                    echo "<tr>
                            <td>" . $result['id'] . "</td>
                            <td>" . $result['nombre'] . "</td>
                            <td>" . $result['descripcion'] . "</td>
                            <td>" . $result['precio'] . "</td>
                            <td>" . $result['cantidad_total'] . "</td>
                            
                            <td>
                              <div class='action-icons'>
                               <a href='#' onclick='editarProducto(" . $result['id'] . ");' class='btn btn-warning' title='editar'><i class='fa-solid fa-pencil'></i></a>
                                <a href='#' onclick='eliminarProducto(" . $result['id'] . ");' class='btn btn-danger' title='eliminar'><i class='fas fa-trash-alt'></i></a>
                              
                              </div>
                            </td>
                          </tr>";
                }
                ?>
                </tbody>
            </table>
         
            <button class="btn btn-secondary btn-sm" onclick="window.location.href='descargarInventario.php'">
    <i class="fas fa-download"></i> Descargar</button>

        </div>


<!--Historial-->
<div id="historialContainer" style="display: none;">
   
    <div class="table-responsive">
        <table class="table table-hover">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Fecha</th>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Motivo</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include 'conexion.php';
                $query = "SELECT h.id, h.fecha, p.nombre AS producto, h.cantidad, h.motivo, h.tipo_movimiento
                          FROM historial h
                          JOIN productos p ON h.id_producto = p.id
                          ORDER BY h.fecha DESC";
                $result = $conex->query($query);
                while ($row = $result->fetch_assoc()) {
                    
                    if ($row['tipo_movimiento'] === 'retirar') {
                        $signo = '-';
                        $clase = 'signo-retiro';
                    } else {
                        $signo = '+';
                        $clase = 'signo-adicion';
                    }

                    echo "<tr>
                            <td>" . $row['id'] . "</td>
                            <td>" . $row['fecha'] . "</td>
                            <td>" . $row['producto'] . "</td>
                            <td><span class='$clase'>$signo" . $row['cantidad'] . "</span></td>
                            <td>" . $row['motivo'] . "</td>
                          </tr>";
                }
                ?>
            </tbody>
        </table>

        
        <button class="btn btn-secondary btn-sm" onclick="window.location.href='descargarHistorial.php'">
    <i class="fas fa-download"></i> Descargar</button>

    </div>
    
</div>




         <!-- Paginación -->
<div class="container">
    <div class="pagination" id="pagination">
        <button id="prevPage" class="pagination-button" data-page="prev">Anterior</button>
        <div id="pageNumbers" class="page-numbers"></div>
        <button id="nextPage" class="pagination-button" data-page="next">Siguiente</button>
    </div>
</div>
<br>
    </div>

    <div class="form-container card shadow p-4 mb-5 bg-white rounded">
    <h3 class="text-center mb-4">Agregar Producto</h3>
    <form action="registrarProducto.php" method="post">
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre del producto</label>
            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingrese el nombre del producto" required>
        </div>

        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <input type="text" class="form-control" id="descripcion" name="descripcion" placeholder="Breve descripción del producto" required>
        </div>

        <div class="mb-3">
            <label for="precio" class="form-label">Precio</label>
            <input type="number" class="form-control" id="precio" name="precio" step="0.01" placeholder="Ingrese el precio del producto" required>
        </div>

        <div class="mb-3">
            <label for="cantidad_total" class="form-label">Cantidad Total</label>
            <input type="number" class="form-control" id="cantidad_total" name="cantidad" placeholder="Ingrese la cantidad disponible" required>
        </div>

        <button type="submit" class="btn btn-primary btn-lg w-100">Agregar Producto</button>
    </form>
</div>

    <div id="searchContainer" class="search-container">
    
    <div class="search-input-group">
        <input type="text" id="buscar" name="buscar" placeholder="Ingrese el nombre del producto a buscar" class="form-control custom-small-input">
    </div>
    <div id="noResults" class="mt-2" style="display:none;">Este producto no se encuentra disponible en el stock</div>
</div>


</div>
<br>

<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.5.0-beta4/html2canvas.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.6.0/jspdf.umd.min.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="SCRIPTS/script.js"></script>
<script src="SCRIPTS/inventario.js"></script>

</body>

</html>

<script>

    
    document.getElementById('equipo-tab1').addEventListener('click', function() {
        window.location.href = 'inventarioEquipo.php';
    });

    document.getElementById('equipo-tab2').addEventListener('click', function() {
        window.location.href = 'SolicitudEquipo.php';
    });

    function añadirProducto(idProducto) {
    $.ajax({
        url: 'obtenerProductos.php',
        type: 'GET',
        dataType: 'json',
        success: function(productos) {
            Swal.fire({
                title: 'Añadir Unidades',
                html: `
                  <form id="retirarProductoForm">
                    <div class="mb-3">
                        <label for="producto" class="form-label">Nombre del Producto</label>
                        <select class="form-select" id="producto" name="producto" required>
                            <option value="">Seleccione un producto...</option>
                            ${productos.map(producto => `<option value="${producto.id}">${producto.nombre}</option>`).join('')}
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="cantidad" class="form-label">Cantidad a añadir</label>
                        <input type="number" class="form-control" id="cantidad" name="cantidad" required>
                    </div>
                    <div class="mb-3">
                        <label for="motivo" class="form-label">Motivo</label>
                        <input type="text" class="form-control" id="motivo" name="motivo" required>
                    </div>
                  </form>
                `,
                focusConfirm: false,
                showCancelButton: true,
                confirmButtonText: 'Añadir',
                cancelButtonText: 'Cancelar',
                preConfirm: function() {
                    var datosFormulario = {
                        id: document.getElementById('producto').value,
                        cantidad: document.getElementById('cantidad').value,
                        motivo: document.getElementById('motivo').value
                    };

                    return $.ajax({
                        url: 'añadirProducto.php',
                        type: 'POST',
                        data: JSON.stringify(datosFormulario),
                        contentType: 'application/json',
                        success: function(response) {
                            if (response.trim() === 'success') {
                                Swal.fire(
                                    'Retirado',
                                    'La cantidad ha sido retirada correctamente.',
                                    'success'
                                ).then(() => {
                                    location.reload();
                                });
                            } else {
                                Swal.fire(
                                    'Error',
                                    `Hubo un problema al retirar la cantidad: ${response}`,
                                    'error'
                                );
                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            Swal.fire(
                                'Error',
                                'No se pudo conectar con el servidor.',
                                'error'
                            );
                        }
                    });
                }
            });
        },
        error: function(jqXHR, textStatus, errorThrown) {
            Swal.fire(
                'Error',
                'No se pudo obtener la lista de productos.',
                'error'
            );
        }
    });
}


// IMPRIMIR HISTORIAL
function imprimirHistorial() {
    var printContent = document.getElementById("historialContainer").innerHTML;
    var originalContent = document.body.innerHTML;

    document.body.innerHTML = printContent;
    window.print();

    document.body.innerHTML = originalContent;
    window.location.reload();
}

function editarProducto(id) {
        $.ajax({
            url: 'obtenerDatosProductos.php',
            type: 'POST',
            data: { id: id },
            success: function(response) {
                try {
                    const data = JSON.parse(response);

                    
                    Swal.fire({
                        title: 'Editar Producto',
                        html: `
                            <input type="text" id="editnombre" class= "swal2-input" placeholder="Nombre" value="${data.nombre || ''}">
                            <input type="text" id="editdescripcion" class="swal2-input" placeholder="Descripcion" value="${data.descripcion || ''}">
                            <input type="text" id="editprecio" class="swal2-input" placeholder="Precio" value="${data.precio || ''}">
                            <input type="text" id="editcantidad_total" class="swal2-input" placeholder="Unidades" value="${data.cantidad_total || ''}">
                        `,
                        showCancelButton: true,
                        confirmButtonText: 'Guardar',
                        cancelButtonText: 'Cancelar',
                        preConfirm: () => {
                            const nombre = Swal.getPopup().querySelector('#editnombre').value;
                            const descripcion = Swal.getPopup().querySelector('#editdescripcion').value;
                            const precio = Swal.getPopup().querySelector('#editprecio').value;
                            const cantidad_total = Swal.getPopup().querySelector('#editcantidad_total').value;
                            
                            if (!nombre || !descripcion || !precio || !cantidad_total) {
                                Swal.showValidationMessage('Todos los campos son obligatorios');
                            }

                            return { nombre: nombre, descripcion: descripcion, precio: precio, cantidad_total:cantidad_total };
                        }
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: 'actualizarProducto.php',
                                type: 'POST',
                                data: {
                                    id: id,
                                    nombre: result.value.nombre,
                                    descripcion: result.value.descripcion,
                                    precio: result.value.precio,
                                    cantidad_total:result.value.cantidad_total
                                },
                                success: function(response) {
                                    console.log('Respuesta del servidor:', response); 

                                    if (response.trim() === 'success') {
                                        Swal.fire(
                                            'Actualizado',
                                            'El producto ha sido actualizado.',
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
                        'No se pudo recuperar los datos del producto.',
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

</script>
