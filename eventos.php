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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

  <link rel="icon" type="image/png" href="images/logo.jpeg">
  <title>Formulario eventos</title>

  <style>
    .hidden {
      display: none;
    }

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

    .comment-box {
      width: 100%;
      resize: none;
      box-sizing: border-box;
      height: 40px;
      padding: 8px;
      font-size: 14px;
      border: 1px solid #ccc;
    }

    .bottom1 {
      top: 69px;
      position: relative;
      left: 0;
      right: 0;
      bottom: 0%;
    }
    
  .mesa, .mesa-principal {
    width: 100px;
    height: 100px;
    border: 2px solid #007bff;
    position: relative;
    background-color: #f8f9fa;
  }

  .mesa-principal {
    width: 150px;
    height: 150px;
    border-color: #28a745;
  }

  .asiento, .asiento-principal {
    width: 20px;
    height: 20px;
    display: flex;
    justify-content: center;
    align-items: center;
    border-radius: 50%;
    color: white;
    position: absolute;
    transform: translate(-50%, -50%);
  }

  .asiento {
    background-color: #6c757d;
  }

  .asiento-principal {
    background-color: #28a745;
  }

  .badge {
    font-size: 12px;
  }

  .row {
    justify-content: center;
  }

  .mesa-titulo, .mesa-principal-titulo {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    text-align: center;
  }




    
  </style>

</head>

<body style="font-family: 'Geist Mono', monospace;">

  <ul class="nav nav-pills nav-fill gap-2 p-1 small bg-primary rounded-5 shadow-sm" id="pillNav2" role="tablist" style="--bs-nav-link-color: var(--bs-white); --bs-nav-pills-link-active-color: var(--bs-primary); --bs-nav-pills-link-active-bg: var(--bs-white);">

    <li class="nav-item" role="presentation">
      <a class="nav-link rounded-5" href="sidebar.php" role="button"><i class="fa-solid fa-house"> Ir al Inicio</i></a>
    </li>

    <li class="nav-item" role="presentation">
      <button class="nav-link active rounded-5" id="contact-tab2" data-bs-toggle="tab" type="button" role="tab" aria-selected="true">Agregar evento</button>
    </li>

    <li class="nav-item" role="presentation">
      <button class="nav-link rounded-5" id="listevent-tab1" data-bs-toggle="tab" type="button" role="tab" aria-selected="false">Lista de eventos</button>
    </li>

    <li class="nav-item" role="presentation">
      <button class="nav-link rounded-5" id="category-tab2" data-bs-toggle="tab" type="button" role="tab" aria-selected="true">Categorias</button>
    </li>

    <li class="nav-item" role="presentation">
      <button class="nav-link rounded-5" id="ponente-tab1" data-bs-toggle="tab" type="button" role="tab" aria-selected="true">Ponentes</button>
    </li>

  </ul>

  <div class="container">

    <form action="registrarEvento.php" id="frmevento" name="frmevento" method="post">

      <h1 style="font-size: 27px; font-family: 'Cooper Black', sans-serif; text-align: center;">Formulario para los eventos de Coparmex</h1>

      <br>

      <div class="row">

        <div class="col">
          <label>Nombre del evento</label>
          <input type="text" class="form-control" id="nombre_evento" name="nombre_evento" placeholder="nombre del evento" required>
        </div>

        <div class="col">
          <label for="tipo">Tipo</label>
          <select class="form-select" id="tipo" name="tipo" aria-label="tipo">
            <option selected> selecciona una opción</option>
            <option value="Presencial">Presencial</option>
            <option value="Online">Online</option>
          </select>
        </div>

        <div class="col">
          <label for="modo">Modo</label>
          <select class="form-select" id="modo" name="modo" aria-label="modo">
            <option selected> selecciona una opción</option>
            <option value="Externa">Externa</option>
            <option id="interna" value="Interna">Interna</option>
          </select>
        </div>

      </div>
      <br>

      <div class="row">

      <div class="col">
  <select class="form-select" id="categoria" name="categoria" aria-label="categoria">
    <option selected>Selecciona una categoría</option>
    <?php
    include 'conexion.php';
    $query = "SELECT * FROM categoria";
    $result = $conex->query($query);
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
    ?>
        <option value="<?php echo $row['nombre']; ?>"><?php echo $row['nombre']; ?></option>
    <?php
      }
    } else {
      echo "<option value=''>No hay categorías disponibles</option>";
    }
    ?>
  </select>

        </div>

      
        <!-- PRIMER MODAL PARA GENERAR EL FORM-->
        <div class="modal fade" id="desayunoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #007bff; color: white;">
        
        <h5 class="modal-title w-100 text-center" id="ModalLabel">Mapa de Asientos</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="filter: invert(1);"></button>
      </div>
      <div class="modal-body">
        <div class="container">
          <p class="text-muted" style="font-size: 14px;">Completa los campos para generar el mapa de asientos</p>
          <form id="seatingForm">
            <div class="mb-3">
              <label for="numMesas" class="form-label" style="font-weight: bold;">Número de mesas:</label>
              <input type="number" class="form-control shadow-sm" id="numMesas" min="1" placeholder="Ingresa el número de mesas" style="border-radius: 10px;">
            </div>
            <div class="mb-3">
              <label for="asientosPorMesa" class="form-label" style="font-weight: bold;">Número de asientos por mesa:</label>
              <input type="number" class="form-control shadow-sm" id="asientosPorMesa" min="1" placeholder="Asientos por mesa" style="border-radius: 10px;">
            </div>
            <div class="mb-3">
              <label for="asientosMesaPrincipal" class="form-label" style="font-weight: bold;">Número de asientos en la mesa principal:</label>
              <input type="number" class="form-control shadow-sm" id="asientosMesaPrincipal" min="1" placeholder="Asientos en la mesa principal" style="border-radius: 10px;">
            </div>
            <button type="button" class="btn btn-primary btn-block w-100" style="background-color: #007bff; border-radius: 10px;" onclick="abrirMapa()">Generar Mapa</button>

          </form>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="border-radius: 10px;">Cancelar</button>
      
      </div>
    </div>
  </div>
</div>


<!-------------------SEGUNDO MODAL PARA GENERAR EL MAPA------------------------------>
<div class="modal fade" id="mapaModal" tabindex="-1" aria-labelledby="mapaModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-secondary text-white">
        <h5 class="modal-title w-100 text-center" id="mapaModalLabel">Mapa de Asientos</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        
        <div id="seatingMap">
          <p>El mapa de asientos aparecerá aquí...</p>
        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-light border" data-bs-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">GuardarMapa</button>
      </div>
    </div>
  </div>
</div>


        <div class="col">
          <div class="form-group">
            <label for="gratis">Evento Gratuito:</label>
            <input type="checkbox" id="gratis" name="gratis" value="1">
          </div>
        </div>

        <div class="col">
          <input type="text" class="form-control" id="ubicacion" name="ubicacion" placeholder="Ubicación" aria-label="ubicacion">
        </div>

        <div class="col">
          <input type="date" class="form-control" id="fecha" name="fecha" placeholder="Fecha del evento" aria-label="fecha">
        </div>

        <div class="col">
          <input type="time" class="form-control" id="hora" name="hora" placeholder="Hora del evento" aria-label="hora">
        </div>

      </div>
      <br>

      <div class="row precios">
        <div class="col">
          <div class="input-group mb-3">
            <span class="input-group-text">$</span>
            <input type="number" class="form-control" id="precio_socio" name="precio_socio" placeholder="Precio para socios Coparmex" required>
          </div>
        </div>

        <div class="col">
          <div class="input-group mb-3">
            <span class="input-group-text">$</span>
            <input type="number" class="form-control" id="precio_general" name="precio_general" placeholder="Precio para publico general" required>
          </div>
        </div>

        <div class="col">
          <div class="input-group mb-3">
            <span class="input-group-text">$</span>
            <input type="number" class="form-control" id="precio_estudiante" name="precio_estudiante" placeholder="Precio invitado especial estudiantes" required>
          </div>
        </div>
      </div>

      <div class="row precios">
        <div class="col">
          <div class="input-group mb-3">
            <span class="input-group-text">$</span>
            <input type="number" class="form-control" id="precio_prospecto" name="precio_prospecto" placeholder="Precio invitado especial prospecto" required>
          </div>
        </div>

        <div class="col">
          <div class="input-group mb-3">
            <span class="input-group-text">$</span>
            <input type="number" class="form-control" id="precio_cortesia" name="precio_cortesia" placeholder="Precio cortesia" required>
          </div>
        </div>

        <div class="col">
          <div class="input-group mb-3">
            <span class="input-group-text">$</span>
            <input type="number" class="form-control" id="precio_no_activo" name="precio_no_activo" placeholder="Precio socio no activo" required>
          </div>
        </div>
      </div>


      <div class="row">

        <div class="col">
          <div class="input-group mb-3">
            <input type="file" class="form-control" id="archivo" name="archivo" accept="image/*" required>
            <form action="registrarEvento.php" id="frmevento" name="frmevento" method="post" enctype="multipart/form-data" >

          </div>
        </div>

        <div class="col" id="uploadedImageContainer">
          <img id="uploadedImage" src="" style="width: 50%; height: 100%; display: none;">
        </div>


        <div class="col">

          <label>Ponente</label>
          <select class="form-select" id="ponente" name="ponente" aria-label="Default select example">
            <option selected> selecciona una opción</option>
            <?php
            include 'conexion.php';
            $query = "SELECT * FROM ponentes";
            $result = $conex->query($query);
            if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
            ?>
                <option value="<?php echo $row['perfil'] . ' ' . $row['nombre']; ?>">
                  <?php echo $row['perfil'] . ' ' . $row['nombre']; ?>
                </option>

            <?php
              }
            } else {
              echo "<option value=''>No existe ningun ponente</option>";
            }
            ?>
          </select>
        </div>

        <div class="col">
          <a class="btn btn-primary" id="btnAgregarPonente" role="button">📂 Añadir</a>
        </div>

        <div class="col">
          <div class="table-responsive" style="width: 100%">
            <table id="tablaPonentes" class="table">
              <thead>
                <tr>
                  <td><b>Nombre del ponente</b></td>
                  <td><b>Eliminar</b></td>
                </tr>
              </thead>
            </table>
          </div>
        </div>



      </div>

      <div class="row">

        <div class="col" id="link">
          <legend style="font-size: 12px;">Link</legend>
          <input type="url" class="link_zoom" id="link_zoom" name="link_zoom" placeholder="Link de zoom">
        </div>

        <div class="col">
          <legend style="font-size: 12px;">Comentario</legend>
          <textarea name="comentario" id="comentario" class="comment-box" placeholder="Deja algún comentario"></textarea>
        </div>


      </div>

      <div class="d-grid gap-2">
        <input type="submit" class="btn-custom" onclick="guardarEvento()" value="💾 Guardar">
        
      </div>

    </form>

    <div class="bottom1">
      <p style="font-size: 12px;text-align: center;">Realizado por Aldo Tolentino Domingo</p>
    </div>

  </div>


  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="SCRIPTS/script.js"></script>

</body>

</html>

<script>
  document.getElementById('listevent-tab1').addEventListener('click', function() {
    window.location.href = 'listaEventos.php';
  });

  document.getElementById('category-tab2').addEventListener('click', function() {
    window.location.href = 'categoria.php';
  });

  document.getElementById('ponente-tab1').addEventListener('click', function() {
    window.location.href = 'agregarPonentes.php';
  });

  function agregarPonente() {
    var nombrePonente = $("#ponente").val();

    if (nombrePonente !== 'selecciona una opción') {
      var newRow = $("<tr>");
      newRow.append("<td>" + nombrePonente + "</td>");
      newRow.append("<td><button class='btn btn-danger btn-sm' onclick='eliminarFila(this)'>Eliminar</button></td>");

      $("#tablaPonentes").append(newRow);
    } else {
      alert("Por favor selecciona un ponente antes de añadir.");
    }
  }

  function eliminarFila(button) {
    $(button).closest("tr").remove();
  }

  $("#btnAgregarPonente").click(function() {
    agregarPonente();
  });

  document.getElementById('archivo').addEventListener('change', function(event) {
    const file = event.target.files[0];
    const reader = new FileReader();

    reader.onload = function(e) {
      const uploadedImage = document.getElementById('uploadedImage');
      uploadedImage.src = e.target.result;
      uploadedImage.style.display = 'block';
    }

    if (file) {
      reader.readAsDataURL(file);
    }
  });



  function guardarEvento() {
    var nombre_evento = $("#nombre_evento").val();
    var tipo = $("#tipo").val();
    var modo = $("#modo").val();
    var categoria = $("#categoria").val();
    var ubicacion = $("#ubicacion").val();
    var fecha = $("#fecha").val();
    var hora = $("#hora").val();
    var gratis = $("#gratis").is(":checked") ? 1 : 0;
    var precio_socio = $("#precio_socio").val();
    var precio_general = $("#precio_general").val();
    var precio_estudiante = $("#precio_estudiante").val();
    var precio_prospecto = $("#precio_prospecto").val();
    var precio_cortesia = $("#precio_cortesia").val();
    var precio_no_activo = $("#precio_no_activo").val();
    var ponente = $("#ponente").val();
    var link_zoom = $("#link_zoom").val();
    var comentario = $("#comentario").val();
    var archivo = $("#archivo").val();


    console.log({
    nombre_evento,
    tipo,
    modo,
    categoria,
    ubicacion,
    fecha,
    hora,
    gratis,
    precio_socio,
    precio_general,
    precio_estudiante,
    precio_prospecto,
    precio_cortesia,
    precio_no_activo,
    ponente,
    link_zoom,
    comentario,
    archivo
});

    $.post(
        "registrarEvento.php", {
        nombre_evento: nombre_evento,
        tipo: tipo,
        modo: modo,
        categoria: categoria,
        ubicacion: ubicacion,
        fecha: fecha,
        hora: hora,
        gratis: gratis,
        precio_socio: precio_socio,
        precio_general: precio_general,
        precio_estudiante: precio_estudiante,
        precio_prospecto: precio_prospecto,
        precio_cortesia: precio_cortesia,
        precio_no_activo: precio_no_activo,
        ponente: ponente,
        link_zoom: link_zoom,
        comentario: comentario,
        archivo: archivo,
    },
        function (result) {
            $("#nombre_evento").val("");
            $("#tipo").val("");
            $("#modo").val("");
            $("#categoria").val("");
            $("#ubicacion").val("");
            $("#fecha").val("");
            $("#hora").val("");
            $("#gratis").prop("checked", false);
            $("#precio_socio").val("");
            $("#precio_general").val("");
            $("#precio_estudiante").val("");
            $("#precio_prospecto").val("");
            $("#precio_cortesia").val("");
            $("#precio_no_activo").val("");
            $("#ponente").val("");
            $("#link_zoom").val("");
            $("#comentario").val("");
            $("#archivo").val("");
            cargarDiv($("#result"), "listaEventos.php");
            Swal.fire({
                icon: 'success',
                title: 'Evento guardado!',
                text: 'El nuevo evento ha sido agregado exitosamente.',
            }).then(function () {
                location.reload();
            });
        }
    );
}

// MAPA DE ASIENTOS
document.getElementById('categoria').addEventListener('change', function() {
    if (this.value === 'DESAYUNO EMPRESARIAL') {
      var myModal = new bootstrap.Modal(document.getElementById('desayunoModal'));
      myModal.show();
    }
  });

  
  
  function abrirMapa() {
    const numMesas = document.getElementById('numMesas').value;
    const asientosPorMesa = document.getElementById('asientosPorMesa').value;
    const asientosMesaPrincipal = document.getElementById('asientosMesaPrincipal').value;

    const seatingMap = document.getElementById('seatingMap');
    seatingMap.innerHTML = ''; 

    
    const mesasContainer = document.createElement('div');
    mesasContainer.classList.add('row', 'gy-4'); 

    
    for (let i = 1; i <= numMesas; i++) {
     
      const mesaCol = document.createElement('div');
      mesaCol.classList.add('col-md-6'); 

      const mesaDiv = document.createElement('div');
      mesaDiv.classList.add('mesa', 'rounded-circle', 'position-relative', 'mx-auto');
      
      const mesaTitulo = document.createElement('h6');
      mesaTitulo.innerText = `Mesa ${i}`;
      mesaTitulo.classList.add('text-center', 'mb-3', 'position-absolute', 'top-50', 'start-50', 'translate-middle');
      mesaDiv.appendChild(mesaTitulo);

      
      const radio = 50; 
      for (let j = 1; j <= asientosPorMesa; j++) {
        const asiento = document.createElement('span');
        asiento.innerText = `${j}`;
        asiento.classList.add('asiento', 'badge', 'bg-secondary', 'position-absolute');
        
        
        const angle = (360 / asientosPorMesa) * j;
        const x = radio + (Math.cos(angle * Math.PI / 180) * radio);
        const y = radio + (Math.sin(angle * Math.PI / 180) * radio);
        
        asiento.style.left = `${x}px`;
        asiento.style.top = `${y}px`;
        
        mesaDiv.appendChild(asiento);
      }

      
      mesaCol.appendChild(mesaDiv);
      mesasContainer.appendChild(mesaCol);
    }

    
    seatingMap.appendChild(mesasContainer);

    
    const mesaPrincipalDiv = document.createElement('div');
    mesaPrincipalDiv.classList.add('mesa-principal', 'rounded-circle', 'position-relative', 'mx-auto', 'mt-4');
    
    const mesaPrincipalTitulo = document.createElement('h6');
    mesaPrincipalTitulo.innerText = `Mesa Principal`;
    mesaPrincipalTitulo.classList.add('text-center', 'mb-3', 'position-absolute', 'top-50', 'start-50', 'translate-middle');
    mesaPrincipalDiv.appendChild(mesaPrincipalTitulo);

    const radioPrincipal = 90;
    for (let k = 1; k <= asientosMesaPrincipal; k++) {
      const asientoPrincipal = document.createElement('span');
      asientoPrincipal.innerText = `${k}`;
      asientoPrincipal.classList.add('asiento-principal', 'badge', 'bg-success', 'position-absolute');
      
     
      const anglePrincipal = (360 / asientosMesaPrincipal) * k;
      const x = radioPrincipal + (Math.cos(anglePrincipal * Math.PI / 180) * radioPrincipal);
      const y = radioPrincipal + (Math.sin(anglePrincipal * Math.PI / 180) * radioPrincipal);

      asientoPrincipal.style.left = `${x}px`;
      asientoPrincipal.style.top = `${y}px`;

      mesaPrincipalDiv.appendChild(asientoPrincipal);
    }

    seatingMap.appendChild(mesaPrincipalDiv);

    
    var mapaModal = new bootstrap.Modal(document.getElementById('mapaModal'));
    mapaModal.show();

    
    var desayunoModal = bootstrap.Modal.getInstance(document.getElementById('desayunoModal'));
    desayunoModal.hide();
  }






</script>