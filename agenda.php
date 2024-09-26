<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/sidebar.css">
    <link rel="stylesheet" href="CSS/calendario.css">
    <script src="SCRIPTS/jquery.min.js"></script>
    <script src="https://gramthanos.github.io/jsCalendar/js/jsCalendar.min.js"></script>
    <link href="https://gramthanos.github.io/jsCalendar/css/jsCalendar.min.css" rel="stylesheet" />
    <link href="https://gramthanos.github.io/jsCalendar/css/themes/jsCalendar.clean.min.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Agenda</title>
    <link rel="icon" type="image/png" href="images/logo.jpeg">
</head>

<body style="font-family: 'Geist Mono', monospace;">

    <ul class="nav nav-pills nav-fill gap-2 p-1 small bg-primary rounded-5 shadow-sm" id="pillNav2" role="tablist" style="--bs-nav-link-color: var(--bs-white); --bs-nav-pills-link-active-color: var(--bs-primary); --bs-nav-pills-link-active-bg: var(--bs-white);">

        <li class="nav-item" role="presentation">
            <a class="nav-link rounded-5" href="sidebar.php" role="button"><i class="fa-solid fa-house"> Ir al Inicio</i></a>
        </li>

        <li class="nav-item" role="presentation">
            <button class="nav-link active rounded-5" id="home-tab1" href="agenda.php" data-bs-toggle="tab" type="button" role="tab" aria-selected="true">Agenda</button>
        </li>

        <li class="nav-item" role="presentation">
            <button class="nav-link rounded-5" id="home-tab2" href="aulas.php" data-bs-toggle="tab" type="button" role="tab" aria-selected="false">ESPACIO EN BLANCO*</button>
        </li>

        <li class="nav-item" role="presentation">
            <button class="nav-link rounded-5" id="profile-tab2" data-bs-toggle="tab" type="button" role="tab" aria-selected="false">Cotizador</button>
        </li>

        <li class="nav-item" role="presentation">
            <button class="nav-link rounded-5" id="contact-tab2" data-bs-toggle="tab" type="button" role="tab" aria-selected="false">Solicitud cotización</button>
        </li>

    </ul>
    <div class="calendario">

        <div id="wrapper">
            <!-- Calendar element -->
            <div id="events-calendar"></div>
            <!-- Events -->
            <div id="events"></div>
            <!-- Clear -->
            <div class="clear"></div>
        </div>

        <div class="clear"></div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="SCRIPTS/calendar.js"></script>

    <script>
        document.getElementById('profile-tab2').addEventListener('click', function() {
            window.location.href = 'precios.php';
        });

        document.getElementById('contact-tab2').addEventListener('click', function() {
            window.location.href = 'consultarAulas.php';
        });

        document.getElementById('home-tab2').addEventListener('click', function() {
            window.location.href = 'aulas.php';
        });
    </script>
</body>

</html>