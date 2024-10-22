<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="CSS/sidebar.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  
  
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="icon" type="image/png" href="images/logo.jpeg">
 

  <title>Cobranza</title>

  <style>
    .hidden {
      display: none;
    }

    .btn-custom {
      width: 100%;
      padding: 10px 0;
      font-size: 16px;
      cursor: pointer;
      background-color: #007bff;
      color: white;
      border: none;
      border-radius: 4px;
      text-align: center;
      margin-top: 10px;
    }

    .btn-custom:hover {
      background-color: #0056b3;
    }

    .comment-box {
      width: 100%;
      resize: none;
      box-sizing: border-box;
      height: 40px;
      padding: 8px;
      font-size: 14px;
      border: 1px solid #ccc;
      margin-bottom: 10px;
    }

    .bottom1 {
      top: 69px;
      position: relative;
      left: 0;
      right: 0;
      bottom: 0%;
    }

    .left-container {
      flex: 1;
      margin-right: 30px;
      padding: 20px;
      background-color: #f8f9fa;
      border: 1px solid #ddd;
      border-radius: 10px;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .right-container {
      flex: 1;
      margin-left: 10px;
      padding: 20px;
      background-color: #f8f9fa;
      border: 1px solid #ddd;
      border-radius: 10px;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .container {
      display: flex;
      margin-top: 30px;
      max-width: 1300px;
      margin-left: auto;
      margin-right: auto;
    }

    .btn-socios {
      display: block;
      width: 100%;
      padding: 10px;
      text-align: center;
    }

    .form-container {
      margin-top: 20px;
    }

    .form-container div {
      margin-bottom: 15px;
    }

    .button-group {
      display: flex;
      width: 100%;
    }

    .button-group a {
      flex: 1;
      margin: 5px;
    }

    .price-section {
      margin-top: 20px;
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
      gap: 20px;
    }

    .price-card {
      padding: 20px;
      background: linear-gradient(145deg, #ffffff, #e6e6e6);
      border-radius: 15px;
      box-shadow: 8px 8px 20px #bfbfbf, -8px -8px 20px #ffffff;
      text-align: center;
      transition: transform 0.2s;
    }

    .price-card:hover {
      transform: translateY(-5px);
      box-shadow: 12px 12px 25px #bfbfbf, -12px -12px 25px #ffffff;
    }

    .price-title {
      font-size: 14px;
      margin-top: 10px;
      color: #343a40;
    }

    .price-value {
      font-size: 24px;
      color: #007bff;
      font-weight: 600;
    }

    
    @media (max-width: 768px) {
      .container {
        flex-direction: column;
      }

      .left-container,
      .right-container {
        margin: 0;
        margin-bottom: 20px;
      }
    }

    @media (max-width: 576px) {
      .left-container,
      .right-container {
        padding: 10px;
      }

      .price-card {
        padding: 10px;
      }

      .price-value {
        font-size: 20px;
      }

      .price-title {
        font-size: 12px;
      }
    }
    
    .fila-pagada {
      background-color: #d4edda; 
    }

    .fila-no-pagada {
      background-color: #f8d7da; 
    }
    .table-responsive {
      max-height: 600px; 
      overflow-y: auto;  
    }

   
  
    .dropdown-menu {
    width: 19.5%; 
    text-align: center; 
    padding: 0; 
}

.dropdown-item {
    padding: 5px 5px; 
    white-space: nowrap; 
}

.dropdown-item:hover {
    background-color: #f8f9fa; 
}
.swal2-popup-custom {
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
    padding: 20px;
}

.table-light th {
    background-color: #f8f9fa;
    color: #495057;
    font-size: 12px; 
}

.table {
    min-width: 600px; 
}
.table-hover td, .table-hover th {
    padding: 5px; 
    font-size: 14px; 
}


.btn-primary {
    background-color: #007bff;
    border-color: #007bff;
    font-size: 12px;
}

.btn-primary:hover {
    background-color: #0056b3;
    border-color: #0056b3;
}

        table tr td.pagado {
    color: #11a203 !important; 
    font-weight: none;
}

table tr td.no-pagado {
    color: #de0808 !important; 
    font-weight: none;
}

#mensajeExito {
    display: none;
    position: fixed;
    top: 20px;
    right: 20px;
    background-color: #d4edda;
    color: #155724; 
    padding: 15px;
    border: 1px solid #c3e6cb; 
    border-radius: 5px; 
    z-index: 9999; 
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); 
    font-family: Arial, sans-serif; 
    transition: opacity 0.5s ease; 
}

#mensajeExito i {
    margin-right: 10px; 
    font-size: 20px;
}
 


  </style>

</head>

<body style="font-family: 'Geist Mono', monospace;">

  <ul class="nav nav-pills nav-fill gap-2 p-1 small bg-primary rounded-5 shadow-sm" id="pillNav2" role="tablist" style="--bs-nav-link-color: var(--bs-white); --bs-nav-pills-link-active-color: var(--bs-primary); --bs-nav-pills-link-active-bg: var(--bs-white);">
    <li class="nav-item" role="presentation">
      <a class="nav-link rounded-5" href="sidebar.php" role="button"><i class="fa-solid fa-house"> Ir al Inicio</i></a>
    </li>

    <li class="nav-item" role="presentation">
      <button class="nav-link active rounded-5" id="cobranza-tab2" data-bs-toggle="tab" type="button" role="tab" aria-selected="true">Cobranza Socio</button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link rounded-5" id="cobranzanosocio-tab2" data-bs-toggle="tab" type="button" role="tab" aria-selected="true">Cobranza no socio</button>
    </li>
  </ul>

<!-- TABLA DE REGISTRO DE SOCIOS A EVENTOS -->
<div class="container">
    <div class="left-container">
        <div class="table-responsive" id="tablaRegistrosEventos">
            <table class="table table-hover">
                <thead class="table-dark">
                    <tr>
                        <th style="width: 5%;">ID</th>
                        <th style="width: 25%;">Nombre del Evento</th>
                        <th style="width: 20%;">Nombre</th>
                        <th style="width: 15%;">Teléfono</th>
                        <th style="width: 15%;">Correo</th>
                        <th style="width: 10%;">Precio</th>
                        <th style="width: 5%;">Pagado</th>
                        <th style="width: 5%;"></th>
                    </tr>
                </thead>
                <tbody>
                <?php
include 'conexion.php'; 

$query = "SELECT id, nombre_evento, nombre, telefono, correo, precio, pagado 
                          FROM registro_eventos_socios r
                          WHERE r.tipo_usuario = 'socio'
                          ORDER BY id DESC";
$resultado = $conex->query($query);

while ($fila = $resultado->fetch_assoc()) {
  
    
    $pagadoClass = $fila['pagado'] ? 'pagado' : 'no-pagado';

    
    echo "<tr>
    <td class='$pagadoClass'>" . $fila['id'] . "</td>
    <td class='$pagadoClass'>" . htmlspecialchars($fila['nombre_evento']) . "</td>
    <td class='$pagadoClass'>" . htmlspecialchars($fila['nombre']) . "</td>
    <td class='$pagadoClass'>" . htmlspecialchars($fila['telefono']) . "</td>
    <td class='$pagadoClass'>" . htmlspecialchars($fila['correo']) . "</td>
    <td class='$pagadoClass'>" . number_format($fila['precio'], 2) . "</td>
    <td class='$pagadoClass'>" . ($fila['pagado'] ? 'Sí' : 'No') . "</td>
    <td>
        <a href='#' onclick='editarRegistro(" . $fila['id'] . ");' class='btn btn-warning btn-circle' title='editar'>
            <i class='fa-solid fa-pencil'></i>
        </a>
    </td>
  </tr>";

}
?>
                
                </tbody>
            </table>
      
          <!-- TABLA DE SOCIOS -->
<div class="table-responsive" id= "tablaSocios">
    <table class="table table-hover">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Cuota</th>
                <th>Nombre Comercial</th>
                <th>Fecha Afiliación</th>
                <th>Razón Social</th>
                <th>Ejecutivo Afiliado</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        <?php

$query2 = "SELECT id, fechaAfiliacion, razonSocial, nombreComercial, cuota, ejecutivoAfilio 
           FROM socios
           ORDER BY id DESC";
$resultado2 = $conex->query($query2);

while ($fila2 = $resultado2->fetch_assoc()) {
    echo "<tr>
            <td>" . $fila2['id'] . "</td>
            <td>" . $fila2['cuota'] . "</td>
            <td>" . $fila2['nombreComercial'] . "</td>
            <td>" . $fila2['fechaAfiliacion'] . "</td>
            <td>" . $fila2['razonSocial'] . "</td>
            <td>" . $fila2['ejecutivoAfilio'] . "</td>
            <td>
                <a href='#' onclick='editarSocio(" . $fila2['id'] . ");' class='btn btn-warning btn-circle' title='editar'>
                    <i class='fa-solid fa-pencil'></i>
                </a>
                
            </td>
          </tr>";
}
?>

        </tbody>
    </table>
</div>
      </div>
    </div>

    
   
    <div class="right-container">
   <a href="#" id="socios" class="btn btn-secondary btn-socios mb-2">Mis socios</a>
   <select id="estado" class="form-select mb-2">
    <option value="">Seleccione un socio...</option>
    <?php
        include 'conexion.php';

      
        $query = "SELECT id, nombreComercial FROM socios";
        $resultado = $conex->query($query);
        
      
        if (!$resultado) {
            die("Error en la consulta de socios: " . $conex->error);
        }
        
       
        while ($fila = $resultado->fetch_assoc()) {
            echo "<option value='{$fila['id']}'>{$fila['nombreComercial']}</option>";
        }

        $query = "SELECT DISTINCT nombre FROM registro_eventos_socios WHERE tipo_usuario = 'socio'";
        $resultado = $conex->query($query);
        
        
        if (!$resultado) {
            die("Error en la consulta de registro_eventos_socios: " . $conex->error);
        }

        
        while ($fila = $resultado->fetch_assoc()) {
            echo "<option value='{$fila['nombre']}'>{$fila['nombre']}</option>";
        }
        ?>
</select>
 




<a href="#" id="registros" class="btn btn-secondary btn-socios mb-2">Mostrar registros</a>


<select id="paymentStatus" class="form-select mb-2">
    <option value="">Selecciona una opción...</option>
    <option value="pagado">Pagado</option>
    <option value="no_pagado">No pagado</option>
</select>

      <div class="button-group">
        <a href="#" id="historialBtn" class="btn btn-secondary btn-historial mb-2">Historial</a>
        <a href="#" id="estadoCuentaBtn" class="btn btn-secondary btn-estadocuenta mb-2">Estado de cuenta</a>
      </div>

      <div class="form-container">
  <div id="historialForm" class="hidden">
    
    <input type="email" id="correo" class="comment-box" placeholder="name@example.com" style="width: 200%;" required>

    <button class="btn btn-custom" id="enviarhistorial" style="width: 200%; margin-top: 10px;">Enviar historial</button>
  </div>




        
        <div id="estadoCuentaForm" class="hidden">
          <input type="email" id= "email"class="comment-box" placeholder="name@example.com" style="width: 200%;" required>
          <button class="btn btn-custom"  id= "enviarestado" style="width: 200%; margin-top: 10px;">Enviar estado de cuenta</button>
        </div>
      </div>

      <div class="price-section">
    <div class="price-card">
        <div class="price-value" id="total_inicial"></div>
        <div class="price-title">Total inicial</div>
    </div>
    <div class="price-card">
        <div class="price-value" id="total_pagado"></div>
        <div class="price-title">Total pagado</div>
    </div>
    <div class="price-card">
        <div class="price-value" id="total_condonado"></div>
        <div class="price-title">Total condonado</div>
    </div>
    <div class="price-card">
        <div class="price-value" id="total_por_cobrar"></div>
        <div class="price-title">Total por cobrar</div>
    </div>
</div>





<!-- ABONO -->
<div id="mensajeExito" style="display:none; position: fixed; top: 20px; right: 20px; background-color: #d4edda; color: #155724; padding: 15px; border: 1px solid #c3e6cb; border-radius: 5px; z-index: 9999; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); font-family: Arial, sans-serif;">
    <i class="fas fa-check-circle" style="margin-right: 10px; font-size: 20px;"></i>
    <span id="mensajeTexto"></span>
</div>

<!-- CONDONACION -->
<div id="mensajeExito" style="display:none; position: fixed; top: 10px; right: 10px; background-color: #dff0d8; color: #3c763d; padding: 10px; border: 1px solid #d6e9c6; border-radius: 5px; z-index: 9999;"></div>

<!-- COMENTARIO -->
<div id="mensajeExito" style="display:none; position: fixed; top: 10px; right: 10px; background-color: #dff0d8; color: #3c763d; padding: 10px; border: 1px solid #d6e9c6; border-radius: 5px; z-index: 9999;"></div>







  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.8.3/jspdf.plugin.autotable.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="SCRIPTS/cobranza.js"></script>
  

  <script>
 document.getElementById('cobranzanosocio-tab2').addEventListener('click', function() {
        window.location.href = 'cobranzaNoSocio.php';
    });


document.addEventListener('DOMContentLoaded', function() {
    
    document.getElementById('total_inicial').innerText = `$0.00`;
    document.getElementById('total_pagado').innerText = `$0.00`;
    document.getElementById('total_condonado').innerText = `$0.00`;
    document.getElementById('total_por_cobrar').innerText = `$0.00`;
});

document.getElementById('estado').addEventListener('change', function() {
    const socioId = this.value;

    if (socioId) {
        fetch('gestionPrecios.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: `socio_id=${socioId}`
        })
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                console.error(data.error);
                return;
            }
            
            document.getElementById('total_inicial').innerText = `$${data.total_inicial.toFixed(2)}`;
            document.getElementById('total_pagado').innerText = `$${data.total_pagado.toFixed(2)}`;
            document.getElementById('total_condonado').innerText = `$${data.total_condonado.toFixed(2)}`;
            document.getElementById('total_por_cobrar').innerText = `$${data.total_por_cobrar.toFixed(2)}`;
        })
        .catch(error => console.error('Error:', error));
    } else {
        
        document.getElementById('total_inicial').innerText = `$0.00`;
        document.getElementById('total_pagado').innerText = `$0.00`;
        document.getElementById('total_condonado').innerText = `$0.00`;
        document.getElementById('total_por_cobrar').innerText = `$0.00`;
    }
});




  </script>

</body>

</html>
