<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./CSS/style.css">
  <title>Login</title><link rel="icon" type="image/png" href="images/logo.jpeg">
</head>

<body>
  
  <div class="loginbox">
    <img src="./images/logo.jpeg" class="avatar">

    <form action="login.php" method="post">
      <p>Usuario</p>
      <input type="text" name="nombre" placeholder="Ingresa tu usuario" required>
      <p>Contraseña</p>
      <input type="password" name="contraseña" placeholder="Ingresa tu contraseña" required>
      <input id="boton" type="submit" value="Login">
      <a href="#">¿Olvidaste tu contraseña?</a>
    </form>
    <?php
    if (isset($_GET['error'])) {
      echo "<p style='color:red;'>Usuario o contraseña incorrectos.</p>";
    }
    ?>
  </div>

  <script src="/SCRIPTS/script.js"></script>
</body>

</html>