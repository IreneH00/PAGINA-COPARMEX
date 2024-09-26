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
    <title>Administrador</title>
    <link rel="icon" type="image/png" href="images/logo.jpeg">
    <link rel="stylesheet" href="./CSS/card.css">
    <link rel="stylesheet" href="CSS/sidebar.css">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" />

    <style>
  

        
        .main-container {
            margin-left: 270px; 
            padding: 20px;
            display: flex;
            justify-content: space-between;
        }

        .form-container, .notification-center {
            width: 48%;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .form-container {
            background-color: #f8f9fa;
        }

        .notification-center {
            background-color: #ffffff;
            border: 1px solid #ddd;
        }

        /* Estilos adicionales */
        .notification-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
            background-color: #007bff;
            color: #ffffff;
            border-radius: 5px 5px 0 0;
        }

        .notification-header h2 {
            margin: 0;
            font-size: 16px;
        }

        #clearAllBtn {
            background: none;
            border: none;
            color: #ffffff;
            cursor: pointer;
            font-size: 14px;
        }

        .notification-list {
            max-height: 400px;
            overflow-y: auto;
            padding: 10px;
        }

        .notification-item {
            padding: 10px;
            border-bottom: 1px solid #ddd;
            background-color: #f9f9f9;
            margin-bottom: 5px;
            border-radius: 5px;
        }

        .notification-item p {
            margin: 0;
            font-size: 14px;
        }

        .notification-item button {
            background: none;
            border: none;
            color: #007bff;
            cursor: pointer;
            font-size: 12px;
            float: right;
        }

        .notification-item button:hover {
            text-decoration: underline;
        }

        
        #contenido {
            margin-left: 270px; 
            padding: 20px;
        }

        .grafica {
            width: 30px;
            vertical-align: middle;
        }

      

    </style>
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
                <option value="" selected hidden>Servicios</option>  
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
              
                <option value="" selected hidden>Ejecutivo</option>  
                <option value="socios.php">Socios</option>
                <option value="asignacion.php">Asignación</option>
                <option value="cobranza.php">Cobranza</option>
                <option value="proyectos.php">Proyectos</option>
                <option value="permisos.php">Permisos</option>
                <option value="gerencia.php">Gerencia</option>
            </select>
        </div>

<!-- Administración -->
<hr style="border-top: 1.5px solid black">

<div>
    <select id="administracion" onchange="if (this.value) window.location.href=this.value;">
        <option value="" selected hidden>Administración</option>     
        <option value="inventario.php">Inventario</option>
    </select>
</div>





        <!-- Configuración -->
        <hr style="border-top: 1.5px solid black">

        <div>
            <select id="configuracion" onchange="if (this.value) window.location.href=this.value;">
                <option value="" selected hidden>Configuración ⚙️</option>  
               
                <option value="nuevoUsuario.php">Nuevo usuario</option>
                <option value="parametrosGenerales.php">Parámetros generales</option>
                <option value="informacion.php">Información</option>
                <option value="perfilSocios.php">Perfil socios</option>
            </select>
        </div>
        <a href="#" onclick="salir();"><span class="salir"><i class="fas fa-power-off" title="Cerrar sesión"></i></span></a>
    </div>

    <!-- Contenido principal -->
    <div id="contenido">
        <h1 style="font-family: 'Press Start 2P', cursive;">Dashboard <img class="grafica" src="./images/dashboard.png" alt="grafica"></h1>
    </div>

    <div class="main-container">
        <!-- Formulario -->
        <form action="registro_evento.php" method="post" class="form-container">
            <h3 style="color:blue;">PRE-REGISTRO</h3>
            <div class="row">
                <div class="col">
                    <label for="nombre_evento">Evento:</label>
                    <select class="form-select" id="nombre_evento" name="nombre_evento" required>
                        <option value="">Seleccione un evento...</option>
                        <?php
                        include 'conexion.php';
                        
                        $query = "SELECT id, nombre_evento, precio_socio, precio_general, precio_estudiante, precio_prospecto, precio_cortesia, precio_no_activo, ubicacion, fecha, hora, gratis, activo FROM eventos WHERE activo = 0";
                        $ejecutar = $conex->query($query);
                        while ($result = $ejecutar->fetch_array()) {
                            echo "<option value='" . $result["nombre_evento"] . "' data-gratis='" . $result["gratis"] . "' ";
                            echo "precio_socio='" . $result["precio_socio"] . "' ";
                            echo "precio_general='" . $result["precio_general"] . "' ";
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
                    <label for="correo" class="form-label">Correo electrónico:</label>
                    <input type="email" class="form-control" id="correo" name="correo" placeholder="nombre@ejemplo.com" required>
                </div>
                <div class="col">
                    <label class="form-label" for="telefono">Teléfono:</label>
                    <input type="tel" class="form-control" name="telefono" id="telefono">
                </div>
            </div>

            <div class="row">
    <div class="col">
        <label for="nombre_empresa">Nombre de la empresa:</label>
        <select class="form-select" id="nombre_empresa" name="nombre_empresa" required>
    <option value="">Seleccione una empresa...</option>
    <?php
    include 'conexion.php'; 

    $query = "SELECT nombreComercial FROM socios";
    $result = $conex->query($query);

    if ($result) {
        while ($row = $result->fetch_assoc()) {
            echo '<option value="' . $row['nombreComercial'] . '">' . $row['nombreComercial'] . '</option>';
        }
    } else {
        echo '<option value="">Error al cargar empresas</option>';
    }
    ?>
</select>

    </div>
</div>
<div class="row">
    <div class="col">
        <label for="razon-social" class="form-label">Razón social:</label>
        <input type="text" class="form-control" id="razon-social" name="razon-social" readonly>
    </div>
</div>
<div id="facturaForm" style="display: none;"></div>


            <div class="row mt-3">
    <div class="col text-end">
        <button type="button" id="registrarBtn" class="btn btn-primary" onclick="registroEvento();">Registrar</button>
        
    </div>
</div>


            
        </form>

        <!-- Centro de Notificaciones -->
        <div class="notification-center">
            <div class="notification-header">
                <h2>Notificaciones</h2>
                <button id="clearAllBtn">Limpiar Todo</button>
            </div>
            <div class="notification-list" id="notificationList">
              
            </div>
        </div>
    </div>

    
    <script src="SCRIPTS/script.js"></script>
    <script src="SCRIPTS/card.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.qrcode/1.0/jquery.qrcode.min.js"></script>


    <script>
   
   function registroEvento() {
    var nombre_evento = $("#nombre_evento").val();
    var nombre = $("#nombre").val();
    var correo = $("#correo").val();
    var telefono = $("#telefono").val();
    
    var gratis = $("#nombre_evento option:selected").data("gratis");
    var nombre_empresa = $("#nombre_empresa option:selected").text(); 

    
    if (!nombre_evento || !nombre || !correo || !telefono) {
        Swal.fire({
            icon: 'warning',
            title: 'Campos incompletos',
            text: 'Por favor, completa todos los campos antes de enviar el formulario.',
        });
        return; 
    }

    var activo = 0; 

    var data = {
        nombre_evento: nombre_evento,
        nombre: nombre,
        correo: correo,
        telefono: telefono,
        activo: activo,
        gratis: gratis
    };

    $.post("registro_evento.php", data)
        .done(function(result) {
            Swal.fire({
                icon: 'success',
                title: 'Registro exitoso',
                text: 'El evento ha sido registrado exitosamente.',
                timer: 1500, 
                showConfirmButton: false
            });

            var qrData = `Evento: ${nombre_evento}, Empresa: ${nombre_empresa}, Nombre: ${nombre}, Correo: ${correo}, `;

            if (gratis === 1) {
                qrData += 'Tipo: Gratis';
            } else {
                qrData += 'Estado: No Pagado';
            }

            setTimeout(function() {
                
                generateQRCode(qrData);
            }, 1600);

          
            $("#nombre_evento").val("");
            $("#nombre").val("");
            $("#correo").val("");
            $("#telefono").val("");
        })
        .fail(function() {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Hubo un problema al registrar el evento. Por favor, intente de nuevo.',
            });
        });
}

function generateQRCode(code) {
    var qrUrl = "https://api.qrserver.com/v1/create-qr-code/?data=" + encodeURIComponent(code);

    Swal.fire({
        title: 'Código QR',
        html: ` 
            <div style="text-align:center;">
                <img src="${qrUrl}" alt="Código QR" style="border-radius: 15px; box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);">
                <p style="font-size: 16px; margin-top: 10px;">Escanea el QR para obtener los detalles del registro</p>
            </div>
        `,
        customClass: {
            popup: 'qr-popup-class'
        },
        width: 350,
        padding: '20px',
        showCloseButton: true,
        showConfirmButton: false,
        background: '#f5f5f5',
        backdrop: `
            rgba(0,0,123,0.4)
            url("/images/nyan-cat.gif")
            left top
            no-repeat
        `
    });
}


//OBTENER RAZON SOCIAL

document.getElementById('nombre_empresa').addEventListener('change', function() {
    console.log('Cambio detectado'); 
    var nombreComercial = this.value;
    
    if (nombreComercial) {
        fetch('obtenerRS.php?nombreComercial=' + encodeURIComponent(nombreComercial))
            .then(response => response.json())
            .then(data => {
                console.log(data); 
                if (data.razonSocial) {
                    document.getElementById('razon-social').value = data.razonSocial;
                    document.getElementById('razon-social').removeAttribute('readonly');
                } else {
                    document.getElementById('razon-social').value = '';
                }
            })
            .catch(error => console.error('Error:', error));
    } else {
        document.getElementById('razon-social').value = '';
    }
});


//CENTRO DE NOTIFICACIONES 
     
const notificationList = document.getElementById('notificationList');
    const connection = new WebSocket('ws://localhost:8080/notificaciones');

    connection.onopen = function () {
        console.log('Conectado al servidor de notificaciones');
    };

    connection.onmessage = function (event) {
        addNotification(event.data);
    };

    connection.onclose = function () {
        console.log('Conexión cerrada');
    };

    function addNotification(message) {
        const notificationItem = document.createElement('div');
        notificationItem.className = 'notification-item';
        notificationItem.textContent = message;
        notificationList.appendChild(notificationItem);
    }

    

  



    </script>
</body>

</html>
