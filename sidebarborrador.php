<?php
session_start();
$nombre = $_SESSION['nombre'];
if (!isset($_SESSION['loggedin'])) {
    echo '<script language="javascript">alert("Tienes que acceder con tu usuario y contraseña"); location.href="index.php";</script>';
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="images/logo.jpeg">
    <title>Administrador</title>
    <link rel="stylesheet" href="./CSS/card.css">
    <link rel="stylesheet" href="CSS/sidebar.css">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" />
</head>

<body>
    <div class="sidenav">
        <a href="actualizarPerfil.php" class="logo">
            <img id="logoImage" alt="">
            <span class="nav-item">Bienvenido <?php echo $nombre; ?></span>
        </a>

        <hr style="border-top: 1.5px solid black">

        <!-- Servicios -->
        <div>
            <select id="servicios" onchange="if (this.value) window.location.href=this.value;">
                <option value="">Servicios</option>
                <option value="aulas.php">Aulas</option>
                <option value="eventos.php">Eventos</option>
                <option value="imagen.php">Imagen</option>
                <option value="servicios.php">Servicios</option>
                <option value="gerenciaServicios.php">Gerencia de servicios</option>
                <option value="talento.php">Talento</option>
            </select>
        </div>

        <!-- Ejecutivo -->
        <hr style="border-top: 1.5px solid black">

        <div>
            <select id="ejecutivo" onchange="if (this.value) window.location.href=this.value;">
                <option value="">Ejecutivo</option>
                <option value="socios.php">Socios</option>
                <option value="asignacion.php">Asignación</option>
                <option value="cobranza.php">Cobranza</option>
                <option value="proyectos.php">Proyectos</option>
                <option value="permisos.php">Permisos</option>
                <option value="gerencia.php">Gerencia</option>
            </select>
        </div>

         <!-- Administracion -->
         <hr style="border-top: 1.5px solid black">

<div>
    <select id="administracion" onchange="if (this.value) window.location.href=this.value;">
        <option value="">Administracion</option>
        <option value="inventario.php">Inventario</option>
        
    </select>
</div>

        <!-- Configuración -->
        <hr style="border-top: 1.5px solid black">

        <div>
            <select id="configuracion" onchange="if (this.value) window.location.href=this.value;">
                <option value="">Configuración ⚙️</option>
                <option value="nuevoUsuario.php">Nuevo usuario</option>
                <option value="parametrosGenerales.php">Parámetros generales</option>
                <option value="informacion.php">Información</option>
                <option value="perfilSocios.php">Perfil socios</option>
            </select>
        </div>
        <a href="#" onclick="salir();"><span class="salir"><i class="fas fa-power-off" title="cerrar sesión"></i></span></a>
    </div>


    <div id="contenido">
        <h1 style="font-family: 'Press Start 2P', cursive;"> Dashboard-<img class="grafica" src="./images/dashboard.png" alt="grafica"></h1>
    </div>

    <div class="main">
        <form action="registro_evento.php" method="post" class="form-container">
            <h3 style="color:blue;">PRE-REGISTRO</h3>
            <div class="row">
                <div class="col">
                    <label for="nombre_evento">Evento:</label>
                    <select class="form-select" id="nombre_evento" name="nombre_evento" required>
                        <option>Seleccione un evento...</option>
                        <?php
                        include 'conexion.php';
                        $query = "SELECT id, nombre_evento, precio_socio, precio_general, precio_estudiante, precio_prospecto, precio_cortesia, precio_no_activo, ubicacion, fecha, hora, gratis, activo FROM eventos WHERE activo = 0";
                        $ejecutar = $conex->query($query);
                        while ($result = $ejecutar->fetch_array()) {
                            echo "<option value='" . $result["nombre_evento"] . "' gratis='" . ($result["gratis"] ? '1' : '0') . "'";
                            echo " precio_socio='" . $result["precio_socio"] . "'";
                            echo " precio_general='" . $result["precio_general"] . "'";
                            echo ">" . $result["nombre_evento"] . "</option>";
                        }
                        ?>
                    </select>

                </div>

                <div class="col">
                    <label for="nombre" class="form-label">Nombre completo:</label>
                    <input type="text" class="form-control" name="nombre" id="nombre" required>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label for="correo" class="form-label">Correo electrónico</label>
                    <input type="email" class="form-control" id="correo" name="correo" placeholder="name@example.com" required>
                </div>
                <div class="col">
                    <label class="form-label" for="telefono">Teléfono</label>
                    <input type="tel" class="form-control" name="telefono" id="telefono">
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label for="billing" class="form-label">¿Requiere factura?</label><br>
                    <select id="billing" class="form-select" name="fact" required>
                        <option selected>Seleccione una opción..</option>
                        <option id="no" value="no">No</option>
                        <option id="si" value="si">Sí</option>
                    </select>
                </div>
            </div>
            <div id="facturaForm" style="display: none;">
                <div class="row">
                    <div class="col">
                        <label for="razon-social" class="form-label">Razón social</label>
                        <input type="text" class="form-control" id="razon-social" name="razon-social">
                    </div>
                </div>
            </div>
        </form>

        <div class="row">
            <div class="col text-end">
                <button type="button" id="registrarBtn" class="btn btn-primary" onclick="registroEvento();">Registrar</button>
            </div>

            <div class="col text-end">
                <button type="button" id="pagarBtn" class="btn btn-primary" onclick="pagar();">Pagar</button>
            </div>
        </div>

        <div class="bottom1">
            <p style="font-size: 11px; text-align: center;">Realizado por Aldo Tolentino Domingo</p>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="SCRIPTS/script.js"></script>
    <script src="./SCRIPTS/card.js"></script>

    <script>
        $(document).ready(function() {

            $('#nombre_evento').change(function() {
                updateButtonVisibility();
            });

            $('#billing').change(function() {
                toggleFacturaForm();
            });

            $('#registrarBtn').show();
            $('#pagarBtn').hide();

            updateButtonVisibility();
            toggleFacturaForm();
        });

        function updateButtonVisibility() {
            var gratis = $('#nombre_evento option:selected').attr('gratis');
            if (gratis === '0') {
                $('#registrarBtn').hide();
                $('#pagarBtn').show();
                $('#payment_form').hide();
            } else {
                $('#registrarBtn').show();
                $('#pagarBtn').hide();
            }
        }

        function toggleFacturaForm() {
            var factura = $('#billing').val();
            if (factura === 'si') {
                $('#facturaForm').show();
            } else {
                $('#facturaForm').hide();
            }
        }

        function registroEvento() {
            var nombre_evento = $("#nombre_evento").val();
            var nombre = $("#nombre").val();
            var correo = $("#correo").val();
            var telefono = $("#telefono").val();


            var fact = $("#billing").val();
            var razon_social = $("#razon-social").val();

            var data = {
                nombre_evento: nombre_evento,
                nombre: nombre,
                correo: correo,
                telefono: telefono,
            };

            if (fact === 'si') {
                data.razon_social = razon_social;
            }

            $.post(
                "registro_evento.php", data,
                function(result) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Registro exitoso',
                        text: 'El evento ha sido registrado exitosamente.',
                    });
                    $("#nombre_evento").val("");
                    $("#nombre").val("");
                    $("#correo").val("");
                    $("#telefono").val("");
                    $("#facturaForm").hide();
                }
            ).fail(function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Hubo un problema al registrar el evento. Por favor, intente de nuevo.',
                });
            });
        }

        function pagar() {
            var factura = $('#billing').val();
            var nombre_evento = $("#nombre_evento").val();
            var nombre = $("#nombre").val();
            var correo = $("#correo").val();
            var telefono = $("#telefono").val();
            var pagar = $("#pagar").is(":checked") ? 1 : 0;


            var fact = $("#billing").val();
            var razon_social = $("#razon-social").val();

            var data = {
                nombre_evento: nombre_evento,
                nombre: nombre,
                correo: correo,
                telefono: telefono,
                pagar: pagar,
                razon_social: razon_social
            };

            if (fact === 'si') {
                data.razon_social = razon_social;
            }

            $.post(
                "registro_evento.php", data,
                function(result) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Registro exitoso',
                        text: 'El evento ha sido registrado exitosamente.',
                    });
                    $("#nombre_evento").val("");
                    $("#nombre").val("");
                    $("#correo").val("");
                    $("#telefono").val("");
                    $("#pagar").val("");
                    $("#facturaForm").hide();
                }
            ).fail(function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Hubo un problema al registrar el evento. Por favor, intente de nuevo.',
                });
            });
            switch (factura) {
                case 'si':
                    Swal.fire('Factura requerida');
                    break;
                default:
                    Swal.fire('Seleccione una opción válida');
            }
            $('#payment_form').show();
        }
    </script>

</body>

</html>