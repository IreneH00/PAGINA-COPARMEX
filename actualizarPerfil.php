<?php
include 'conexion.php';
session_start();

if (isset($_SESSION['nombre'])) {
  $nombre = $_SESSION['nombre'];
  $query = "SELECT * FROM administradores WHERE nombre = '" . $nombre . "'";
  $ejecutar = $conex->query($query);
  $result = $ejecutar->fetch_array();
} else {
  echo '<script language="javascript">alert("Nombre no proporcionado"); location.href="sidebar.php";</script>';
  exit;
}
?>

<!DOCTYPE html>
<html lang="es">

<head>

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="CSS/sidebar.css">
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="CSS/password.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  <title>Actualizar Perfil</title>
  <link rel="icon" type="image/png" href="images/logo.jpeg">

</head>

<style>
  .perfil{
    margin-bottom: 10px;
    width: 3%;
  }
</style>

<body style="font-family: 'Geist Mono', monospace">

  <div class="container">
    <br>
    <a class="btn btn-primary" href="sidebar.php" role="button">🏠Ir al inicio</a>

    
    <form action="updatePerfil.php" id="frmperfil" name="frmperfil" method="POST" class="row g-3">
      <h3 style="text-align: center; font-family: 'Press Start 2P', cursive;">Tu perfil<img class="perfil" src="./images/perfil.png" alt="grafica"></h3>

      <div class="row g-3">

        <div class="col">

          <label for="nombre" class="form-label">Nombre:</label>
          <input type="text" class="form-control" name="nombre" value="<?php echo $result['nombre']; ?>" required>

        </div>

        <div class="col">

          <label for="apP" class="form-label">Apellido Paterno:</label>
          <input type="text" class="form-control" name="apP" value="<?php echo $result['apP']; ?>" required>

        </div>

        <div class="col">

          <label for="apM" class="form-label">Apellido Materno:</label>
          <input type="text" class="form-control" name="apM" value="<?php echo $result['apM']; ?>" required>

        </div>

      </div>

      <div class="col-md-4">

        <label for="correo" class="form-label">Email</label>
        <input type="email" class="form-control" name="correo" value="<?php echo $result['correo']; ?>" required>

      </div>

      <div class="col-md-6">

        <label for="contraseña" class="form-label">Contraseña</label>


        <div class="input-group">
          <input type="password" class="form-control" name="contraseña" value="<?php echo $result['contraseña']; ?>" required>

          <div class="input-group-append">
            <button class="btn btn-outline-secondary" type="button" id="togglePassword">🔓</button>
          </div>

        </div>



      </div>

      <div class="col-12">

        <button type="button" class="btn btn-danger" onclick="cancelarPerfil();">Cancelar</button>
        <button type="submit" class="btn btn-warning" onclick="actualizarPerfil(<?php echo $nombre; ?>);">Actualizar</button>

      </div>

      <div class="container mt-5">

        <div class="input-group mb-3">

          <legend style="font-size: 20px; font-family: 'Cooper Black', sans-serif;">Selecciona una imagen para cambiar tu foto de perfil</legend>
          <input type="file" class="form-control" id="inputGroupFile02" accept="image/*">

        </div>

      </div>

    </form>

    <img id="uploadedImage" src="" alt="Imagen cargada" style="width: 15%; height: 30%; display: none;">

    <div id="buttons" style="display: none; text-align: center; margin-top: 20px;">

      <button id="confirmButton" class="btn btn-success">Confirmar</button>
      <button id="cancelButton" class="btn btn-danger">Cancelar</button>

    </div>

  </div>

  <script>
    document.getElementById('togglePassword').addEventListener('click', function() {
      const passwordField = document.querySelector('input[name="contraseña"]');
      const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
      passwordField.setAttribute('type', type);
      this.textContent = this.textContent === '🔓' ? '🔒' : '🔓';
    });
  </script>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="SCRIPTS/script.js"></script>

</body>

</html>