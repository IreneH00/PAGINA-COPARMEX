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
      margin-right: 10px;
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

  


  </style>

</head>

<body style="font-family: 'Geist Mono', monospace;">

  <ul class="nav nav-pills nav-fill gap-2 p-1 small bg-primary rounded-5 shadow-sm" id="pillNav2" role="tablist" style="--bs-nav-link-color: var(--bs-white); --bs-nav-pills-link-active-color: var(--bs-primary); --bs-nav-pills-link-active-bg: var(--bs-white);">
    <li class="nav-item" role="presentation">
      <a class="nav-link rounded-5" href="sidebar.php" role="button"><i class="fa-solid fa-house"> Ir al Inicio</i></a>
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

$query = "SELECT r.id, r.nombre_evento, r.nombre, r.telefono, r.correo, r.pagado, e.precio_socio 
          FROM registro_eventos_socios r
          JOIN eventos e ON r.nombre_evento = e.nombre_evento 
          ORDER BY r.id DESC";

$resultado = $conex->query($query);

while ($fila = $resultado->fetch_assoc()) {
    
    $pagadoClass = $fila['pagado'] ? 'pagado' : 'no-pagado';

    echo "<tr>
            <td class='$pagadoClass'>" . $fila['id'] . "</td>
            <td class='$pagadoClass'>" . $fila['nombre_evento'] . "</td>
            <td class='$pagadoClass'>" . $fila['nombre'] . "</td>
            <td class='$pagadoClass'>" . $fila['telefono'] . "</td>
            <td class='$pagadoClass'>" . $fila['correo'] . "</td>
            <td class='$pagadoClass'>" . number_format($fila['precio_socio'], 2) . "</td> <!-- Nueva celda para Precio -->
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
    while ($fila = $resultado->fetch_assoc()) {
        echo "<option value='{$fila['id']}'>{$fila['nombreComercial']}</option>";
    }
    ?>
</select>
 




<a href="#" id="registros" class="btn btn-secondary btn-socios mb-2">Mostrar registros</a>


<select id="paymentStatus" class="form-select mb-2">
    <option value="">Selecciona una opción...</option>
    <option value="pagados">Pagados</option>
    <option value="por_pagar">Por Pagar</option>
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
        <div class="price-value">$0.00</div>
        <div class="price-title">Total inicial</div>
    </div>
    <div class="price-card">
        <div class="price-value">$0.00</div>
        <div class="price-title">Total pagado</div>
    </div>
    <div class="price-card">
        <div class="price-value">$0.00</div>
        <div class="price-title">Total condonado</div>
    </div>
    <div class="price-card">
        <div class="price-value">$0.00</div>
        <div class="price-title">Total por cobrar</div>
    </div>
</div>






  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.8.3/jspdf.plugin.autotable.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    $(document).ready(function () {
      $('#historialBtn').click(function (e) {
        e.preventDefault();
        $('#estadoCuentaForm').addClass('hidden');
        $('#historialForm').removeClass('hidden');
      });

      $('#estadoCuentaBtn').click(function (e) {
        e.preventDefault();
        $('#historialForm').addClass('hidden');
        $('#estadoCuentaForm').removeClass('hidden');
      });
    });



    //ENVIAR CORREO CON HISTORIAL
    
    $(document).ready(function () {
  $('#enviarhistorial').click(function (event) {
    event.preventDefault();

    var correo = $('#correo').val().trim(); 

    if (correo) {
     
      const { jsPDF } = window.jspdf;
      const doc = new jsPDF();

      doc.setFontSize(22);
      doc.setTextColor(40, 60, 90);
      const title = 'HISTORIAL DE COBRANZA';
      const titleWidth = doc.getTextWidth(title);
      const xTitle = (doc.internal.pageSize.getWidth() - titleWidth) / 2; 
      doc.text(title, xTitle, 20);

      doc.setFontSize(12);
      doc.setTextColor(100, 100, 100);
      const date = 'Fecha: ' + new Date().toLocaleDateString();
      const dateWidth = doc.getTextWidth(date);
      const xDate = (doc.internal.pageSize.getWidth() - dateWidth) / 2; 
      doc.text(date, xDate, 30);

      var headers = [['ID', 'Nombre del Evento', 'Nombre', 'Teléfono', 'Correo', 'Activo', 'Pagado']];
      var rows = [];

      

      $('table tbody tr').each(function () {
        var row = [
          $(this).find('td').eq(0).text(),
          $(this).find('td').eq(1).text(),
          $(this).find('td').eq(2).text(),
          $(this).find('td').eq(3).text(),
          $(this).find('td').eq(4).text(),
          $(this).find('td').eq(5).text(),
          $(this).find('td').eq(6).text(),
        ];
        rows.push(row);
      });

      doc.autoTable({
        head: headers,
        body: rows,
        startY: 40,
        headStyles: {
          fillColor: [0, 102, 204],
          textColor: [255, 255, 255],
          fontSize: 12,
          fontStyle: 'bold'
        },
        bodyStyles: {
          fontSize: 10,
          textColor: [0, 0, 0]
        },
        alternateRowStyles: {
          fillColor: [240, 240, 240]
        },
        margin: { top: 40 },
      });

     
      const pdfFileName = 'Historial_cobranza.pdf';
      doc.save(pdfFileName);

      
      var subject = encodeURIComponent("Historial de Cobranza");
      var body = encodeURIComponent("Adjunta el PDF generado antes de enviar el correo.");
      var mailtoLink = `mailto:${correo}?subject=${subject}&body=${body}`;

     
      alert('El PDF ha sido generado. Se abrirá el mail para que puedas adjuntar al correo.');
      window.location.href = mailtoLink;

    } else {
      alert("Por favor, ingresa un correo electrónico.");
    }
  });
});


//ENVIAR CORREO CON ESTADO DE CUENTA
$(document).ready(function () {
  $('#enviarestado').click(function (event) {
    event.preventDefault();

    var correo = $('#email').val().trim(); 

    if (correo) {
     
     const { jsPDF } = window.jspdf;
     const doc = new jsPDF();

    
     doc.setFontSize(22);
     doc.setTextColor(40, 60, 90);
     const title = 'ESTADO DE CUENTA'; 
     const titleWidth = doc.getTextWidth(title);
     const xTitle = (doc.internal.pageSize.getWidth() - titleWidth) / 2; 
     doc.text(title, xTitle, 20);

     doc.setFontSize(12);
     doc.setTextColor(100, 100, 100);
     const date = 'Fecha: ' + new Date().toLocaleDateString();
     const dateWidth = doc.getTextWidth(date);
     const xDate = (doc.internal.pageSize.getWidth() - dateWidth) / 2; 
     doc.text(date, xDate, 30);

     var headers = [['ID', 'Nombre del Evento', 'Nombre', 'Teléfono', 'Correo', 'Activo', 'Pagado']];
     var rows = [];

     
     $('table tbody tr').each(function () {
       var pagado = $(this).find('td').eq(6).text(); 
       if (pagado.toLowerCase() === 'no') { 
         var row = [
           $(this).find('td').eq(0).text(),
           $(this).find('td').eq(1).text(),
           $(this).find('td').eq(2).text(),
           $(this).find('td').eq(3).text(),
           $(this).find('td').eq(4).text(),
           $(this).find('td').eq(5).text(),
           $(this).find('td').eq(6).text(),
         ];
         rows.push(row);
       }
     });

     
     if (rows.length === 0) {
       alert("No hay registros donde el socio deba.");
       return;
     }

     doc.autoTable({
       head: headers,
       body: rows,
       startY: 40,
       headStyles: {
         fillColor: [0, 102, 204],
         textColor: [255, 255, 255],
         fontSize: 12,
         fontStyle: 'bold'
       },
       bodyStyles: {
         fontSize: 10,
         textColor: [0, 0, 0]
       },
       alternateRowStyles: {
         fillColor: [240, 240, 240]
       },
       margin: { top: 40 },
     });

     const pdfFileName = 'Estado de cuenta.pdf';
      doc.save(pdfFileName);

      
      var subject = encodeURIComponent("ESTADO DE CUENTA");
      var body = encodeURIComponent("Adjunta el PDF generado antes de enviar el correo.");
      var mailtoLink = `mailto:${correo}?subject=${subject}&body=${body}`;

     
      alert('El PDF ha sido generado. Se abrirá el mail para que puedas adjuntar al correo.');
      window.location.href = mailtoLink;

    } else {
      alert("Por favor, ingresa un correo electrónico.");
    }
  });
});




//EDITAR REGISTROS DE SOCIOS A EVENTOS 

function editarRegistro(id) {
    $.ajax({
        url: 'obtenerDatosSocios.php',
        type: 'POST',
        data: { id: id },
        success: function(response) {
            try {
                const data = JSON.parse(response);

                Swal.fire({
                    title: 'Editar Registro de socios a eventos',
                    html: `
                        <div style="max-width: 800px; overflow-y: auto; font-size: 14px; padding: 20px;">
                            <h5 style="font-weight: bold; margin-bottom: 15px;">Historial de Pagos</h5>
                            <div style="overflow-x: auto;">
                                <table class="table table-bordered" style="border-collapse: collapse;">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Fecha</th>
                                            <th>Monto</th>
                                            <th>Forma de Pago</th>
                                            <th>Tipo</th>
                                            <th>Usuario</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody id="historialPagos">
                                        <!-- Aquí puedes cargar los pagos existentes si es necesario -->
                                    </tbody>
                                </table>
                            </div>
                            
                            <h5 style="font-weight: bold; margin-top: 30px; margin-bottom: 15px;">Abono</h5>
                            <div style="overflow-x: auto;">
                                <table class="table table-bordered" style="border-collapse: collapse;">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Total Anualidad</th>
                                            <th>Por Cobrar</th>
                                            <th>Monto</th>
                                            <th>Forma de Pago</th>
                                            <th>Fecha de Pago</th>
                                        </tr>
                                    </thead>
                                    <tbody id="abonoSection">
                                        <tr>
                                            <td>${data.cuota || ''}</td> 
                                            <td><input type="number" id="porCobrar" class="form-control"></td>
                                            <td><input type="number" id="monto" class="form-control"></td>
                                            <td><input type="text" id="formaPago" class="form-control"></td>
                                            <td><input type="date" id="fechaPago" class="form-control"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <button class="btn btn-primary w-100 mt-3" id="btnGuardarAbono">
                                <i class="fa-solid fa-save"></i> Guardar Abono
                            </button>

                            <h5 style="font-weight: bold; margin-top: 30px; margin-bottom: 15px;">Condonación</h5>
                            <div style="overflow-x: auto;">
                                <table class="table table-bordered" style="border-collapse: collapse;">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Total Anualidad</th>
                                            <th>Por Condonar</th>
                                            <th>Fecha Condonación</th>
                                            <th>Tipo</th>
                                            <th>Monto Condonación</th>
                                        </tr>
                                    </thead>
                                    <tbody id="condonacionSection">
                                        <tr>
                                            <td>${data.cuota || ''}</td> 
                                            <td><input type="number" id="porCondonar" class="form-control"></td>
                                            <td><input type="date" id="fechaCondonacion" class="form-control"></td>
                                            <td><input type="text" id="tipoCondonacion" class="form-control"></td>
                                            <td><input type="number" id="montoCondonacion" class="form-control"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <button class="btn btn-primary w-100 mt-3" id="btnGuardarCondonacion">
                                <i class="fa-solid fa-save"></i> Guardar Condonación
                            </button>

                            <h5 style="font-weight: bold; margin-top: 30px; margin-bottom: 15px;">Comentario Dirección</h5>
                            <input type="text" id="comentarioDireccion" class="form-control mb-3" placeholder="Agregar comentario">
                            <button class="btn btn-primary w-100 mt-2" id="btnGuardarComentario">
                                <i class="fa-solid fa-save"></i> Guardar Comentario
                            </button>

                            <h5 style="font-weight: bold; margin-top: 30px; margin-bottom: 15px;">Historial de Comentarios Dirección</h5>
                            <div style="overflow-x: auto;">
                                <table class="table table-bordered" style="border-collapse: collapse;">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Fecha</th>
                                            <th>Comentario</th>
                                            <th>Creado por</th>
                                        </tr>
                                    </thead>
                                    <tbody id="historialComentarios">
                                        <!-- Aquí puedes cargar los comentarios existentes si es necesario -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    `,
                    showCancelButton: true,
                    confirmButtonText: 'Guardar Cambios',
                    cancelButtonText: 'Cancelar',
                    customClass: {
                        popup: 'swal2-popup-custom',
                    },
                    width: '800px', 
                    didRender: () => {
                       

                        
                        $('#btnGuardarAbono').on('click', function() {
                            guardarAbono(id);
                        });

                        
                        $('#btnGuardarCondonacion').on('click', function() {
                            guardarCondonacion(id);
                        });

                        $('#btnGuardarComentario').on('click', function() {
                            guardarComentario(id);
                        });
                    }
                });

              
                function guardarAbono(id) {
                    const porCobrar = $('#porCobrar').val();
                    const monto = $('#monto').val();
                    const formaPago = $('#formaPago').val();
                    const fechaPago = $('#fechaPago').val();

                    if (!porCobrar || !monto || !formaPago || !fechaPago) {
                        Swal.fire('Error', 'Por favor, completa todos los campos de Abono.', 'warning');
                        return;
                    }

                    $.ajax({
                        url: 'guardarAbono.php',
                        type: 'POST',
                        data: {
                            id: id,
                            porCobrar: porCobrar,
                            monto: monto,
                            formaPago: formaPago,
                            fechaPago: fechaPago
                        },
                        success: function(response) {
                            const res = JSON.parse(response);
                            if (res.success) {
                                Swal.fire('Éxito', 'Abono guardado correctamente.', 'success');
                               
                            } else {
                                Swal.fire('Error', res.message || 'No se pudo guardar el abono.', 'error');
                            }
                        },
                        error: function() {
                            Swal.fire('Error', 'Error al conectar con el servidor.', 'error');
                        }
                    });
                }

                function guardarCondonacion(id) {
                    const porCondonar = $('#porCondonar').val();
                    const fechaCondonacion = $('#fechaCondonacion').val();
                    const tipoCondonacion = $('#tipoCondonacion').val();
                    const montoCondonacion = $('#montoCondonacion').val();

                    if (!porCondonar || !fechaCondonacion || !tipoCondonacion || !montoCondonacion) {
                        Swal.fire('Error', 'Por favor, completa todos los campos de Condonación.', 'warning');
                        return;
                    }

                    $.ajax({
                        url: 'guardarCondonacion.php',
                        type: 'POST',
                        data: {
                            id: id,
                            porCondonar: porCondonar,
                            fechaCondonacion: fechaCondonacion,
                            tipoCondonacion: tipoCondonacion,
                            montoCondonacion: montoCondonacion
                        },
                        success: function(response) {
                            const res = JSON.parse(response);
                            if (res.success) {
                                Swal.fire('Éxito', 'Condonación guardada correctamente.', 'success');
                                
                            } else {
                                Swal.fire('Error', res.message || 'No se pudo guardar la condonación.', 'error');
                            }
                        },
                        error: function() {
                            Swal.fire('Error', 'Error al conectar con el servidor.', 'error');
                        }
                    });
                }

                function guardarComentario(id) {
                    const comentarioDireccion = $('#comentarioDireccion').val().trim();

                    if (!comentarioDireccion) {
                        Swal.fire('Error', 'Por favor, ingresa un comentario.', 'warning');
                        return;
                    }
                    console.log('Llamando a guardarComentario.php');
                    console.log({ id: id, comentarioDireccion: comentarioDireccion });
                    $.ajax({
                      
                        url: 'guardarComentario.php',
                        type: 'POST',
                        data: {
                            id: id,
                            comentarioDireccion: comentarioDireccion
                        },
                        success: function(response) {
                            const res = JSON.parse(response);
                            if (res.success) {
                                Swal.fire('Éxito', 'Comentario guardado correctamente.', 'success');
                                
                                $('#comentarioDireccion').val(''); 
                            } else {
                                Swal.fire('Error', res.message || 'No se pudo guardar el comentario.', 'error');
                            }
                        },
                        error: function() {
                            Swal.fire('Error', 'Error al conectar con el servidor.', 'error');
                        }
                    });
                }

            } catch (error) {
                console.error('Error al parsear la respuesta:', error);
                Swal.fire('Error', 'No se pudo recuperar los datos del socio.', 'error');
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.error('Error:', textStatus, errorThrown);
            Swal.fire('Error', 'No se pudo conectar con el servidor.', 'error');
        }
        
    });
}






    //EDITAR SOCIO
    function editarSocio(id) {
    $.ajax({
        url: 'obtenerDatosSocios.php',
        type: 'POST',
        data: { id: id },
        success: function(response) {
            try {
                const data = JSON.parse(response);

                Swal.fire({
                    title: 'Editar Registro de socios a eventos',
                    html: `
                        <div style="max-width: 800px; overflow-y: auto; font-size: 14px; padding: 20px;">
                            <h5 style="font-weight: bold; margin-bottom: 15px;">Historial de Pagos</h5>
                            <div style="overflow-x: auto;">
                                <table class="table table-bordered" style="border-collapse: collapse;">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Fecha</th>
                                            <th>Monto</th>
                                            <th>Forma de Pago</th>
                                            <th>Tipo</th>
                                            <th>Usuario</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody id="historialPagos">
                                        <!-- Aquí puedes cargar los pagos existentes si es necesario -->
                                    </tbody>
                                </table>
                            </div>
                            
                            <h5 style="font-weight: bold; margin-top: 30px; margin-bottom: 15px;">Abono</h5>
                            <div style="overflow-x: auto;">
                                <table class="table table-bordered" style="border-collapse: collapse;">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Total Anualidad</th>
                                            <th>Por Cobrar</th>
                                            <th>Monto</th>
                                            <th>Forma de Pago</th>
                                            <th>Fecha de Pago</th>
                                        </tr>
                                    </thead>
                                    <tbody id="abonoSection">
                                        <tr>
                                            <td>${data.cuota || ''}</td> 
                                            <td><input type="number" id="porCobrar" class="form-control"></td>
                                            <td><input type="number" id="monto" class="form-control"></td>
                                            <td><input type="text" id="formaPago" class="form-control"></td>
                                            <td><input type="date" id="fechaPago" class="form-control"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <button class="btn btn-primary w-100 mt-3" id="btnGuardarAbono">
                                <i class="fa-solid fa-save"></i> Guardar Abono
                            </button>

                            <h5 style="font-weight: bold; margin-top: 30px; margin-bottom: 15px;">Condonación</h5>
                            <div style="overflow-x: auto;">
                                <table class="table table-bordered" style="border-collapse: collapse;">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Total Anualidad</th>
                                            <th>Por Condonar</th>
                                            <th>Fecha Condonación</th>
                                            <th>Tipo</th>
                                            <th>Monto Condonación</th>
                                        </tr>
                                    </thead>
                                    <tbody id="condonacionSection">
                                        <tr>
                                            <td>${data.cuota || ''}</td> 
                                            <td><input type="number" id="porCondonar" class="form-control"></td>
                                            <td><input type="date" id="fechaCondonacion" class="form-control"></td>
                                            <td><input type="text" id="tipoCondonacion" class="form-control"></td>
                                            <td><input type="number" id="montoCondonacion" class="form-control"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <button class="btn btn-primary w-100 mt-3" id="btnGuardarCondonacion">
                                <i class="fa-solid fa-save"></i> Guardar Condonación
                            </button>

                            <h5 style="font-weight: bold; margin-top: 30px; margin-bottom: 15px;">Comentario Dirección</h5>
                            <input type="text" id="comentarioDireccion" class="form-control mb-3" placeholder="Agregar comentario">
                            <button class="btn btn-primary w-100 mt-2" id="btnGuardarComentario">
                                <i class="fa-solid fa-save"></i> Guardar Comentario
                            </button>

                            <h5 style="font-weight: bold; margin-top: 30px; margin-bottom: 15px;">Historial de Comentarios Dirección</h5>
                            <div style="overflow-x: auto;">
                                <table class="table table-bordered" style="border-collapse: collapse;">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Fecha</th>
                                            <th>Comentario</th>
                                            <th>Creado por</th>
                                        </tr>
                                    </thead>
                                    <tbody id="historialComentarios">
                                        <!-- Aquí puedes cargar los comentarios existentes si es necesario -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    `,
                    showCancelButton: true,
                    confirmButtonText: 'Guardar Cambios',
                    cancelButtonText: 'Cancelar',
                    customClass: {
                        popup: 'swal2-popup-custom',
                    },
                    width: '800px', 
                    didRender: () => {
                       

                       
                        $('#btnGuardarAbono').on('click', function() {
                            guardarAbono(id);
                        });

                   
                        $('#btnGuardarCondonacion').on('click', function() {
                            guardarCondonacion(id);
                        });

                        
                        $('#btnGuardarComentario').on('click', function() {
                            guardarComentario(id);
                        });
                    }
                });

               
                function guardarAbono(id) {
                    const porCobrar = $('#porCobrar').val();
                    const monto = $('#monto').val();
                    const formaPago = $('#formaPago').val();
                    const fechaPago = $('#fechaPago').val();

                    if (!porCobrar || !monto || !formaPago || !fechaPago) {
                        Swal.fire('Error', 'Por favor, completa todos los campos de Abono.', 'warning');
                        return;
                    }

                    $.ajax({
                        url: 'guardarAbono.php',
                        type: 'POST',
                        data: {
                            id: id,
                            porCobrar: porCobrar,
                            monto: monto,
                            formaPago: formaPago,
                            fechaPago: fechaPago
                        },
                        success: function(response) {
                            const res = JSON.parse(response);
                            if (res.success) {
                                Swal.fire('Éxito', 'Abono guardado correctamente.', 'success');
                              
                            } else {
                                Swal.fire('Error', res.message || 'No se pudo guardar el abono.', 'error');
                            }
                        },
                        error: function() {
                            Swal.fire('Error', 'Error al conectar con el servidor.', 'error');
                        }
                    });
                }

                function guardarCondonacion(id) {
                    const porCondonar = $('#porCondonar').val();
                    const fechaCondonacion = $('#fechaCondonacion').val();
                    const tipoCondonacion = $('#tipoCondonacion').val();
                    const montoCondonacion = $('#montoCondonacion').val();

                    if (!porCondonar || !fechaCondonacion || !tipoCondonacion || !montoCondonacion) {
                        Swal.fire('Error', 'Por favor, completa todos los campos de Condonación.', 'warning');
                        return;
                    }

                    $.ajax({
                        url: 'guardarCondonacion.php',
                        type: 'POST',
                        data: {
                            id: id,
                            porCondonar: porCondonar,
                            fechaCondonacion: fechaCondonacion,
                            tipoCondonacion: tipoCondonacion,
                            montoCondonacion: montoCondonacion
                        },
                        success: function(response) {
                            const res = JSON.parse(response);
                            if (res.success) {
                                Swal.fire('Éxito', 'Condonación guardada correctamente.', 'success');
                             
                            } else {
                                Swal.fire('Error', res.message || 'No se pudo guardar la condonación.', 'error');
                            }
                        },
                        error: function() {
                            Swal.fire('Error', 'Error al conectar con el servidor.', 'error');
                        }
                    });
                }

                
    function guardarComentario(id) {
    const comentarioDireccion = $('#comentarioDireccion').val().trim();

    if (!comentarioDireccion) {
        Swal.fire('Error', 'Por favor, ingresa un comentario.', 'warning');
        return;
    }
    
    console.log('Llamando a guardarComentario.php');
    console.log({ id: id, comentarioDireccion: comentarioDireccion });
    
    $.ajax({
        url: 'guardarComentario.php',
        type: 'POST',
        data: {
            id: id,
            comentarioDireccion: comentarioDireccion
        },
        success: function(response) {
            
            if (response.success) {
                Swal.fire('Éxito', 'Comentario guardado correctamente.', 'success');
                $('#comentarioDireccion').val(''); 
            } else {
                Swal.fire('Error', response.message || 'No se pudo guardar el comentario.', 'error');
            }
        },
        error: function() {
            Swal.fire('Error', 'Error al conectar con el servidor.', 'error');
        }
    });
}
            } catch (error) {
                console.error('Error al parsear la respuesta:', error);
                Swal.fire('Error', 'No se pudo recuperar los datos del socio.', 'error');
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.error('Error:', textStatus, errorThrown);
            Swal.fire('Error', 'No se pudo conectar con el servidor.', 'error');
        }
        
    });
}


//BUSQUEDA CON FILTROS 
$(document).ready(function () {
    // FILTRAR POR SOCIO
    $('#estado').change(function () {
        const socioSeleccionado = $(this).val();
        const paymentStatus = $('#paymentStatus').val(); 

        $.ajax({
            type: "POST",
            url: "filtrar_registros.php", 
            data: { socio_id: socioSeleccionado, payment_status: paymentStatus }, 
            success: function (response) {
                const data = JSON.parse(response);

                $('#tablaRegistrosEventos tbody').html(data.eventos);
                $('#tablaSocios tbody').html(data.socios);
            },
            error: function (xhr, status, error) {
                console.error("Error en la solicitud AJAX:", status, error); 
            }
        });
    });

    // FILTRAR POR ESTADO DE PAGO
    $('#paymentStatus').change(function () {
        const socioSeleccionado = $('#estado').val(); 
        const paymentStatus = $(this).val(); 

        $.ajax({
            type: "POST",
            url: "filtrar_registros.php", 
            data: { socio_id: socioSeleccionado, payment_status: paymentStatus }, 
            success: function (response) {
                const data = JSON.parse(response);

                $('#tablaRegistrosEventos tbody').html(data.eventos);
                $('#tablaSocios tbody').html(data.socios);
            },
            error: function (xhr, status, error) {
                console.error("Error en la solicitud AJAX:", status, error); 
            }
        });
    });
});




//CALCULAR LOS PRECIOS DE CADA SOCIo

document.addEventListener('DOMContentLoaded', function () {
    const socioSelect = document.getElementById('socioSelect'); 
    const totalInicialElement = document.querySelector('.price-section .price-card:nth-child(1) .price-value');

    socioSelect.addEventListener('change', function () {
        const socioNombre = this.value; 

        fetch('gestionPrecios.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `socio_nombre=${socioNombre}` 
        })
        .then(response => response.json())
        .then(data => {
            totalInicialElement.textContent = `$${data.total_inicial.toFixed(2)}`;
        })
        .catch(error => console.error('Error:', error));
    });
});



  </script>

</body>

</html>
