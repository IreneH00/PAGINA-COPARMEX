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

      


        .mesa {
    width: 80px;
    height: 80px;
    border: none; 
    position: relative;
    background-color: #cce5ff;
    margin: auto;
  }

  .mesa-principal {
    width: 200px; 
    height: 40px;
    border: none; 
    position: relative;
    background-color: #007bff; 
    margin-top: 40px; 
  }

  .asiento, .asiento-principal {
    width: 20px;
    height: 20px;
    display: flex;
    justify-content: center;
    align-items: center;
    border-radius: 50%;
    position: absolute;
    transform: translate(-50%, -50%);
  }

  .asiento {
    background-color: #6c757d;
    cursor: pointer; 
  }


  .asiento-principal {
    background-color: #6c757d;
    color: white; 
  }

  .badge {
    font-size: 10px;
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
    color: white;
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
        echo "<option value='" . $result["nombre_evento"] . "' data-id='" . $result["id"] . "' data-gratis='" . $result["gratis"] . "' ";
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

    <!-- Tipo de usuario -->
    <div class="row mt-3">
    <div class="col">
        <label for="tipo_usuario">Tipo de usuario:</label>
        <select class="form-select" id="tipo_usuario" name="tipo_usuario" required onchange="mostrarEmpresa(this.value)">
            <option value="">Seleccione un tipo de usuario...</option>
            <option value="socio">Socio</option>
            <option value="general">Usuario general</option>
            <option value="estudiante">Estudiante</option>
            <option value="prospecto">Prospecto</option>
            <option value="cortesia">Cortesía</option>
            <option value="noactivo">No activo</option>
        </select>
    </div>
</div>



    <!-- Empresa y Razón Social  -->
    <div class="row mt-3" id="empresaContainer" style="display: none;">
        <div class="col">
            <label for="nombre_empresa">Nombre de la empresa:</label>
            <select class="form-select" id="nombre_empresa" name="nombre_empresa">
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
        <div class="col">
            <label for="razon-social" class="form-label">Razón social:</label>
            <input type="text" class="form-control" id="razon-social" name="razon-social" readonly>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col text-end">
            <button type="button" id="registrarBtn" class="btn btn-primary" onclick="registroEvento();">Registrar</button>
        </div>
    </div>
</form>




        <!-- MAPA DE ASIENTOS -->
        <div class="notification-center">
            <div class="notification-header">
                <h2>MAPA DE ASIENTOS</h2>
                
            </div>
            <div class="notification-list" id="notificationList">
              
            </div>
        </div>
    </div>

    
    <script src="SCRIPTS/script.js"></script>
    <script src="SCRIPTS/card.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.qrcode/1.0/jquery.qrcode.min.js"></script>


    <script>
       
       function mostrarEmpresa(tipoUsuario) {
    
    if (tipoUsuario === 'socio') {
        $("#empresaContainer").show();
    } else {
        $("#empresaContainer").hide();
    }

   
    $("#nombre_empresa").val(""); 
    $("#razon-social").val(""); 
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

//EVENTOS
 

$(document).ready(function() {
    $("#nombre_evento").change(function() {
        var nombreEvento = $(this).val();
        
        if (nombreEvento) {
            var eventoId = $(this).find("option:selected").data("id");

            $.ajax({
                url: "obtenerMapa.php",
                type: "GET",
                data: { id: eventoId }, 
                success: function(data) {
                    var mapa = JSON.parse(data);
                    if (mapa.success) {
                        dibujarMapa(mapa.mapas.num_mesas, mapa.mapas.asientos_por_mesa, mapa.mapas.asientos_mesa_principal,  mapa.asientos_ocupados);
                    } else {
                        $("#notificationList").html("<p>No se encontró mapa para este evento.</p>");
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error al obtener el mapa:', error);
                }
            });
        } else {
            $("#notificationList").empty();
        }
    });
});

let selectedSeats = null;  
let selectedMesa = null;   
function dibujarMapa(numMesas, asientosPorMesa, asientosMesaPrincipal, asientosOcupados) {
    const seatingMap = document.getElementById('notificationList');
    seatingMap.innerHTML = ''; 

    const legend = document.createElement('div');
    legend.innerHTML = `
        <h5>Seleccione un asiento</h5>
        <div class="mb-3">
            <span style="display: inline-block; width: 15px; height: 15px; background-color: grey; border-radius: 50%; margin-right: 5px;"></span> Disponible 
            <span style="display: inline-block; width: 15px; height: 15px; background-color: red; border-radius: 50%; margin-left: 15px; margin-right: 5px;"></span> Ocupado
        </div>
    `;
    seatingMap.appendChild(legend);

    const spacingDiv = document.createElement('div');
    spacingDiv.style.height = '20px'; 
    seatingMap.appendChild(spacingDiv);

    const mesasContainer = document.createElement('div');
    mesasContainer.classList.add('row', 'gy-4'); 

   
    function esAsientoOcupado(mesa, asiento) {
        return asientosOcupados.some(a => a.num_mesa == mesa && a.num_asiento == asiento);
    }


    for (let i = numMesas; i >= 1; i--) { 
        const mesaCol = document.createElement('div');
        mesaCol.classList.add('col-md-3');

        const mesaDiv = document.createElement('div');
        mesaDiv.classList.add('mesa', 'rounded-circle', 'position-relative', 'mx-auto');

        const mesaTitulo = document.createElement('h6');
        mesaTitulo.innerText = `Mesa ${i}`;
        mesaTitulo.classList.add('text-center', 'mb-3', 'position-absolute', 'top-50', 'start-50', 'translate-middle');
        mesaDiv.appendChild(mesaTitulo);

        const radio = 40;
        for (let j = 1; j <= asientosPorMesa; j++) {
            const asiento = document.createElement('span');
            asiento.innerText = `${j}`;
            asiento.classList.add('asiento', 'badge', 'position-absolute'); 

            if (esAsientoOcupado(i, j)) {
                asiento.style.backgroundColor = 'red';
                asiento.style.cursor = 'not-allowed';
                asiento.setAttribute('disabled', 'true');
            } else {
                asiento.style.backgroundColor = 'grey';

                asiento.addEventListener('click', function() {
                    if (asiento.style.backgroundColor === 'grey') {
                        if (selectedSeats) {
                            selectedSeats.style.backgroundColor = 'grey';  
                        }
                        asiento.style.backgroundColor = 'red';
                        selectedSeats = asiento;
                        selectedMesa = i; 
                    } else {
                        asiento.style.backgroundColor = 'grey';
                        selectedSeats = null;
                        selectedMesa = null;
                    }
                });
            }

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
    mesaPrincipalDiv.classList.add('mesa', 'mesa-principal', 'position-relative', 'mx-auto', 'mt-5');

    const mesaPrincipalTitulo = document.createElement('h6');
    mesaPrincipalTitulo.innerText = `Mesa Principal (Mesa 0)`; 
    mesaPrincipalTitulo.classList.add('text-center', 'mb-3', 'position-absolute', 'top-50', 'start-50', 'translate-middle', 'text-white');
    mesaPrincipalDiv.appendChild(mesaPrincipalTitulo);

    const widthPrincipal = 200; 
    const heightPrincipal = 40; 
    mesaPrincipalDiv.style.width = `${widthPrincipal}px`;
    mesaPrincipalDiv.style.height = `${heightPrincipal}px`;
    mesaPrincipalDiv.style.backgroundColor = '#007bff'; 
    mesaPrincipalDiv.style.border = 'none'; 

    const totalAsientos = asientosMesaPrincipal; 
    const half = Math.floor(totalAsientos / 2);

    for (let k = 1; k <= totalAsientos; k++) {
        const asientoPrincipal = document.createElement('span');
        asientoPrincipal.innerText = `${k}`;
        asientoPrincipal.classList.add('asiento', 'badge', 'position-absolute'); 

        if (esAsientoOcupado(0, k)) {
            asientoPrincipal.style.backgroundColor = 'red';
            asientoPrincipal.style.cursor = 'not-allowed';
            asientoPrincipal.setAttribute('disabled', 'true');
        } else {
            asientoPrincipal.style.backgroundColor = 'grey';

            asientoPrincipal.addEventListener('click', function() {
                if (asientoPrincipal.style.backgroundColor === 'grey') {
                    if (selectedSeats) {
                        selectedSeats.style.backgroundColor = 'grey';  
                    }
                    asientoPrincipal.style.backgroundColor = 'red';
                    selectedSeats = asientoPrincipal;
                    selectedMesa = 0; 
                } else {
                    asientoPrincipal.style.backgroundColor = 'grey';
                    selectedSeats = null;
                    selectedMesa = null;
                }
            });
        }

        const posX = (k <= half)
            ? (k - 1) * (widthPrincipal / half) 
            : (k - half - 1) * (widthPrincipal / half); 

        let posY; 
        if (k <= half) {
            posY = -3; 
        } else {
            posY = heightPrincipal;
        }

        asientoPrincipal.style.left = `${posX}px`;
        asientoPrincipal.style.top = `${posY}px`;

        mesaPrincipalDiv.appendChild(asientoPrincipal);
    }

    seatingMap.appendChild(mesaPrincipalDiv);
}






function registroEvento() {
    if (!$("#nombre_evento").length || !$("#nombre").length || !$("#correo").length || !$("#telefono").length || !$("#tipo_usuario").length) {
        console.error("Un elemento del formulario no se encuentra.");
        return;
    }
    
    let nombre_evento = $("#nombre_evento").val();
    let evento_id = $("#nombre_evento option:selected").data("id");
    
    let nombre = $("#nombre").val();
    let correo = $("#correo").val();
    let telefono = $("#telefono").val();
    let gratis = $("#nombre_evento option:selected").data("gratis");
    let tipo_usuario = $("#tipo_usuario").val();
    let nombre_empresa = $("#nombre_empresa").val();
    let razon_social = $("#razon-social").val();
    
    let no_asiento = selectedSeats ? selectedSeats.innerText : '';
    let no_mesa = selectedMesa; 

   
    let eventoTieneMapa = no_mesa !== undefined && no_mesa !== null;

    
    if (!nombre_evento || !nombre || !correo || !telefono || !tipo_usuario || 
        (eventoTieneMapa && !no_asiento)) {  
        Swal.fire({
            icon: 'warning',
            title: 'Campos incompletos',
            text: eventoTieneMapa ? 'Por favor, seleccione un asiento antes de enviar el formulario.' : 'Por favor, completa todos los campos antes de enviar el formulario.',
        });
        return;
    }

   
    const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!re.test(correo)) {
        Swal.fire({
            icon: 'warning',
            title: 'Correo inválido',
            text: 'Por favor, ingrese un correo electrónico válido.',
        });
        return;
    }

   
    let data = {
        evento_id: evento_id, 
        nombre_evento: nombre_evento, 
        nombre: nombre,
        correo: correo,
        telefono: telefono,
        activo: 0,
        gratis: gratis,
        tipo_usuario: tipo_usuario,
        nombre_empresa: nombre_empresa,
        razon_social: razon_social,
        no_asiento: eventoTieneMapa ? no_asiento : '',  
        no_mesa: eventoTieneMapa ? no_mesa : null  
    };

    // Enviar datos por AJAX
    $.post("registro_evento.php", data)
        .done(function(result) {
            console.log(result);
            Swal.fire({
                icon: 'success',
                title: 'Registro exitoso',
                text: 'El evento ha sido registrado exitosamente.',
                timer: 1500, 
                showConfirmButton: false
            });

            
            $("input[type=text], input[type=email], input[type=tel], select").val("");

            
            var qrData = `Evento: ${nombre_evento}, Nombre: ${nombre}, Usuario: ${tipo_usuario}, Empresa: ${nombre_empresa}, Mesa: ${no_mesa}, Asiento: ${no_asiento}`;

            if (gratis !== 1) {
                qrData += ', Estado: No Pagado';
            }

            setTimeout(function() {
                generateQRCode(qrData);
            }, 1600);

            // Reiniciar los campos del formulario
            $("#nombre_evento").val("");
            $("#nombre").val("");
            $("#tipo_usuario").val("");
            $("#nombre_empresa").val("");
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

  
    $.post("guardar_qr.php", { qrUrl: qrUrl })
        .done(function(response) {
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
});

        })
        .fail(function() {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'No se pudo guardar la imagen del código QR en el servidor.',
            });
        });
}


    </script>
</body>

</html>
