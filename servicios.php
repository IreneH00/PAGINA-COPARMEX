
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
    <title>Servicios</title>
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

        .table-container {
    padding: 1rem;
    border-radius: 8px;
    box-shadow: 0 0 8px rgba(0,0,0,0.1);
    background-color: #fff; 
  
}

.form-container {
    padding: 1rem;
    border-radius: 8px;
    box-shadow: 0 0 8px rgba(0,0,0,0.1);
    background-color: #fff; 
}

      /* Table Styles */
      .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table th, .table td {
            text-align: left;
            padding: 8px;
        }
        .table th {
    background-color: #000; 
    color: #fff; 
}

.search-bar {
    margin-bottom: 0px;
}

      
        thead {
    width: 400%; 
}



        .container {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }

        .pagination {
            display: flex;
            align-items: center;
        }

        .pagination button {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 8px 12px;
            margin: 0 5px;
            cursor: pointer;
        }

        .pagination button:hover {
            background-color: #eee;
        }

        .pagination button.active {
            background-color: #007bff;
            color: #fff;
        }

       

#searchInput {
    width: 100%;
    padding: 10px;
    font-size: 16px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-shadow: 0 0 8px rgba(0, 0, 0, 0.1);
    outline: none;
}

#searchInput:focus {
    border-color: #007bff;
    box-shadow: 0 0 8px rgba(0, 123, 255, 0.25);
}
.pagination {
    display: flex;
    align-items: center;
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
    background-color: blue;
    color: white;
}

.nav-link {
    display: flex;
    align-items: left; 
    justify-content: left; 
}

.nav-link i {
    margin-right: 8px; 
}

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
    border-radius: 34px;
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
    border-radius: 50%;
}

input:checked + .slider {
    background-color: #2196F3;
}

input:checked + .slider:before {
    transform: translateX(26px);
}

.slider.round {
    border-radius: 34px;
}

.slider.round:before {
    border-radius: 50%;
}



    @media (max-width: 768px) {
    .col-md-6 {
        width: 100%;
    }
}

.inactive {
    color: #808080; 
    opacity: 0.7; 
}


    </style>
</head>

<body style="font-family: 'Geist Mono', monospace;">

<nav class="nav nav-pills nav-fill bg-primary  shadow-sm">
    <a class="nav-link text-white" href="sidebar.php"><i class="fa-solid fa-house"></i> Ir al Inicio</a>
</nav>

    
    <div class="container" style="font-size:16px">
        <div class="row">
            <!-- Tabla de Servicios -->
            <div class="col-md-6 table-container">
                
                <h3>Servicios</h3>
                
<!-- Buscador -->
<div class="search-bar">
    <input type="text" id="searchInput" placeholder="Buscar servicio..." aria-label="Buscar servicio">
</div>

<!--LISTA DE SERVICIOS-->
<div class="container-fluid">
    <br>
    <div id="tablaPrincipalServicio_wrapper" class="dataTables_wrapper no-footer">
    <div id="tablaPrincipalServicio_filter" class="dataTables_filter"></div>
    <div id="tablaPrincipalServicio_processing" class="dataTables_processing" style="display: none; font-size:14px"></div>
       
    <div class="table-fluid" id="tablaContainer">
        <table class="table table-hover">
            
            <thead class="table-dark">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Datos</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col">Alta/Baja</th>
                </tr>
            </thead>

            <tbody>
            <?php
           
           include 'conexion.php';
           $query = "SELECT s.id, s.fecha, c.nombre AS categoria, so.nombreComercial AS socio, s.nombre, s.costo, s.comentario
           FROM servicios s
           JOIN categoria c ON s.categoria = c.id
           JOIN socios so ON s.socio = so.id
           ORDER BY s.id DESC";
           
           $ejecutar = $conex->query($query);
           while ($result = $ejecutar->fetch_assoc()) {
               $datos = "<span class='text-content'>Fecha: " . $result['fecha'] . "</span><br>" .
                        "<span class='text-content'>Categoría: " . $result['categoria'] . "</span><br>" .
                        "<span class='text-content'>Socio: " . $result['socio'] . "</span><br>" .
                        "<span class='text-content'>Nombre: " . $result['nombre'] . "</span><br>" .
                        "<span class='text-content'>Costo: " . $result['costo'] . "</span><br>" .
                        "<span class='text-content'>Comentario: " . $result['comentario'] . "</span>";
               
               echo "<tr>
                   <td>" . $result['id'] . "</td>
                   <td>" . $datos . "</td>
                   <td><a href='#' onclick='editarServicio(" . $result['id'] . ");' class='btn btn-warning' title='editar'><i class='fa-solid fa-pencil'></i></a></td>
                   <td><a href='#' onclick='eliminarServicio(" . $result['id'] . ");' class='btn btn-danger' title='eliminar'><i class='fas fa-trash-alt'></i></a></td>
                   <td>
                       <label class='switch'>
                           <input type='checkbox' id='checkbox" . $result['id'] . "' onchange='darBaja(" . $result['id'] . ")'>
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
                            
<!-- Paginación -->
<div class="container">
    <div class="pagination" id="pagination">
        <button id="prevPage" class="pagination-button" data-page="prev">Anterior</button>
        <div id="pageNumbers" class="page-numbers"></div>
        <button id="nextPage" class="pagination-button" data-page="next">Siguiente</button>
    </div>
</div>




                </div>
            </div>

            <!-- Formulario -->
            <div class="col-md-6 form-container">
                <h3 style="font-size: 36px; font-family: 'Cooper Black', monospace;">NUEVO SERVICIO</h3>
                <p>Por favor complete los campos obligatorios marcados con *</p>
                <form>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                        <label for="fecha"><strong>Fecha*</strong></label>

                            <input type="date" class="form-control" name="fecha" id="fecha" required>
                        </div>

                        <div class="col-md-6 mb-3">
                        <label for="categoria" class="form-label"><strong>Categoría*</strong></label>
                        

                            <select class="form-select" id="categoria" name="categoria" required>
                                <option value="">Seleccione una categoría...</option>
                                <?php
                                include 'conexion.php';
                                $query = "SELECT id, nombre FROM categoria";
                                $result = $conex->query($query);
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<option value='" . $row['id'] . "'>" . $row['nombre'] . "</option>";
                                    }
                                } else {
                                    echo "<option value=''>No hay categorías disponibles</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                        <label for="socio" class="form-label"><strong>Socio*</strong></label>

                            <select id="socio" class="form-select" name="socio" required>
                                <option selected>Seleccione una opción...</option>
                                <?php
                                include 'conexion.php';
                                $query = "SELECT id, nombreComercial, razonSocial, telefonoEmpresa1, correoAsociado1 FROM socios";
                                $ejecutar = $conex->query($query);
                                while ($result = $ejecutar->fetch_array()) {
                                    echo "<option value='" . $result["id"] . "'";
                                    echo " data-razon-social='" . htmlspecialchars($result["razonSocial"]) . "'";
                                    echo " data-telefono='" . htmlspecialchars($result["telefonoEmpresa1"]) . "'";
                                    echo " data-correo='" . htmlspecialchars($result["correoAsociado1"]) . "'";
                                    echo ">" . htmlspecialchars($result["nombreComercial"]) . "</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                        <label class="form-label" for="costo"><strong>Costo*</strong></label>

                            <input type="number" class="form-control" name="costo" id="costo" value="0" required>
                        </div>

                        <div class="col-md-6 mb-3">
                        <label for="nombre" class="form-label"><strong>Nombre de quien solicitó el servicio*</strong></label>

                            <input type="text" class="form-control" name="nombre" id="nombre" required>
                        </div>
                    </div>

      
                    <div class="row">
                    <div class="col">
                    <label for="comentario" class="form-label"><strong>Comentario</strong></label>

                        <textarea class="form-control" name="comentario" id="comentario" required></textarea>
                    </div>
                </div>

                    <div class="d-grid gap-2">
                    <button type="button" id="guardarBtn" class="btn-custom" onclick="guardarServicios();"><i class="fa-solid fa-floppy-disk"> Guardar</i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="SCRIPTS/servicios.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    

    <script>


 
    </script>
</body>

</html>

