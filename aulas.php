<!-- ELIMINAR LA SECCION DE AGENDAR ESPACIOS, Y QUE SEA UNA AGENDA DE LOS ESPACIOS QUE YA ESTAN OCUPADOS Y CUALES ESTAN LIBRES -->
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>*ESPACIO EN BLANCO</title>
    <link rel="icon" type="image/png" href="images/logo.jpeg">
    <link rel="stylesheet" href="CSS/sidebar.css">
    <script src="SCRIPTS/jquery.min.js"></script>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
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
</style>

<body style="font-family: 'Geist Mono', monospace;">


    <ul class="nav nav-pills nav-fill gap-2 p-1 small bg-primary rounded-5 shadow-sm" id="pillNav2" role="tablist" style="--bs-nav-link-color: var(--bs-white); --bs-nav-pills-link-active-color: var(--bs-primary); --bs-nav-pills-link-active-bg: var(--bs-white);">

        <li class="nav-item" role="presentation">
            <a class="nav-link rounded-5" href="sidebar.php" role="button"><i class="fa-solid fa-house"> Ir al Inicio</i></a>
        </li>
        
        <li class="nav-item" role="presentation">
            <button class="nav-link rounded-5" id="home-tab1" href="agenda.php" data-bs-toggle="tab" type="button" role="tab" aria-selected="true">Agenda</button>
        </li>

        <li class="nav-item" role="presentation">
            <button class="nav-link active rounded-5" id="home-tab2" href="aulas.php" data-bs-toggle="tab" type="button" role="tab" aria-selected="true">ESPACIO EN BLANCO*</button>
        </li>

        <li class="nav-item" role="presentation">
            <button class="nav-link rounded-5" id="profile-tab2" data-bs-toggle="tab" type="button" role="tab" aria-selected="false">Cotizador</button>
        </li>

        <li class="nav-item" role="presentation">
            <button class="nav-link rounded-5" id="contact-tab2" data-bs-toggle="tab" type="button" role="tab" aria-selected="false">Solicitud cotización</button>
        </li>

    </ul>


    <div class="container">
        <br>
        <form action="registrarAula.php" id="frmaulas" name="frmaulas" method="POST">
            <h3 style="font-size: 45px; font-family: 'Cooper Black', sans-serif; text-align: center;">Agenda de espacios en renta</h3>
            <br>

            <div class="row g-3">

                <div class="col">
                    <label for="nombre" class="form-label">Nombre Completo:</label>
                    <input type="text" class="form-control" name="nombre" id="nombre" required>
                </div>

                <div class="col">

                    <label for="correo" class="form-label">Correo electrónico</label>
                    <input type="email" class="form-control" id="correo" name="correo" placeholder="name@example.com" required>

                </div>

            </div>

            <div class="form-outline mb-4">
                <label class="form-label" for="telefono">Teléfono</label>
                <input type="tel" class="form-control" name="telefono" id="telefono">
            </div>


            <div class="row g-3">
                <div class="col">
                    <label class="form-label" for="espacio">Espacio</label>
                    <input type="text" class="form-control" name="espacio" id="espacio">
                </div>

                <div class="col">
                    <label class="form-label" for="montaje">Montaje</label>
                    <input type="text" class="form-control" name="montaje" id="montaje">
                </div>


            </div>

            <div class="form-outline mb-4">
                <label class="form-label" for="cantPersonas">Cantidad de personas</label>
                <input type="number" class="form-control" name="cantPersonas" id="cantPersonas" min="1">
            </div>


            <div class="row g-3">

                <div class="col">
                    <label class="form-label" for="espacio">Fecha de inicio del evento</label>
                    <input type="date" class="form-control" name="fechaInic" id="fechaInic">
                </div>

                <div class="col">

                    <label class="form-label" for="espacio">Fecha en la que finalizara el evento</label>
                    <input type="date" class="form-control" name="fechaFin" id="fechaFin">

                </div>


            </div>
            <br>

            <div class="text-center pt-1 mb-5 pb-1">
                <input type="button" class="btn-custom" onclick="cotizacion();" value="Cotizar">
            </div>

        </form>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="SCRIPTS/script.js"></script>

</body>

</html>

<script>
    document.getElementById('profile-tab2').addEventListener('click', function() {
        window.location.href = 'precios.php';
    });

    document.getElementById('contact-tab2').addEventListener('click', function() {
        window.location.href = 'consultarAulas.php';
    });

    document.getElementById('home-tab1').addEventListener('click', function() {
        window.location.href = 'agenda.php';
    });
</script>