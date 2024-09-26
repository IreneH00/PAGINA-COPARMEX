<?php
include 'conexion.php';

$id = $_GET['id'];

if (empty($id)) {
    die("ID is empty");
}

$query = "SELECT * FROM aulas WHERE id = '" . $id . "'";
$ejecutar = $conex->query($query);

if (!$ejecutar) {
    die("Query failed: " . $conex->error);
}

while ($result = $ejecutar->fetch_array()) {
?>
    <!DOCTYPE html>
    <html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Actualizar las aulas</title>
        <link rel="icon" type="image/png" href="images/logo.jpeg">
        <link rel="stylesheet" href="CSS/sidebar.css">
        <script src="SCRIPTS/jquery.min.js"></script>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    </head>

    <body style="font-family: 'Geist Mono', monospace">

        <div class="container">
            <a class="btn btn-primary" href="consultarAulas.php" role="button">Regresar</a>
            <br>

            <form action="registrarAula.php" id="frmaulas" name="frmaulas" method="POST">
                <h3>Actualizar Registro</h3>
                <br>
                <div class="form-outline mb-4">
                    <label class="form-label" for="nombre">Nombre Completo</label>
                    <input type="text" class="form-control" name="nombre" id="nombre" value="<?php echo $result['nombre']; ?>">
                </div>

                <div class="form-outline mb-4">
                    <label class="form-label" for="correo">Correo Electrónico</label>
                    <input type="email" class="form-control" name="correo" id="correo" value="<?php echo $result['correo']; ?>">
                </div>

                <div class="form-outline mb-4">
                    <label class="form-label" for="telefono">Teléfono</label>
                    <input type="phone" class="form-control" name="telefono" id="telefono" value="<?php echo $result['telefono']; ?>">
                </div>

                <div class="form-outline mb-4">
                    <label class="form-label" for="espacio">Espacio</label>
                    <input type="text" class="form-control" name="espacio" id="espacio" value="<?php echo $result['espacio']; ?>">
                </div>

                <div class="form-outline mb-4">
                    <label class="form-label" for="montaje">Montaje</label>
                    <input type="text" class="form-control" name="montaje" id="montaje" value="<?php echo $result['montaje']; ?>">
                </div>

                <div class="form-outline mb-4">
                    <label class="form-label" for="cantPersonas">Cantidad de personas</label>
                    <input type="number" class="form-control" name="cantPersonas" id="cantPersonas" value="<?php echo $result['cantPersonas']; ?>">
                </div>

                <div class="form-outline mb-4">
                    <label class="form-label" for="espacio">Fecha de inicio del evento</label>
                    <input type="date" class="form-control" name="fechaInic" id="fechaInic" value="<?php echo $result['fechaInic']; ?>">
                </div>

                <div class="form-outline mb-4">
                    <label class="form-label" for="espacio">Fecha en la que finalizará el evento</label>
                    <input type="date" class="form-control" name="fechaFin" id="fechaFin" value="<?php echo $result['fechaFin']; ?>">
                </div>

                <div class="text-center pt-1 mb-5 pb-1">
                    <input type="button" class="btn btn-danger btn-block fa-lg gradient-custom-2 mb-3" onclick="cancelar();" value="Cancelar">
                    <input type="button" class="btn btn-warning btn-block fa-lg gradient-custom-2 mb-3" onclick="actualizarAula(<?php echo $id; ?>);" value="Actualizar">
                </div>
            </form>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="SCRIPTS/script.js"></script>
    </body>

    </html>
<?php
}
?>