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
</script>