<link rel="stylesheet" href="CSS/sidebar.css">
<link rel="icon" type="image/png" href="images/logo.jpeg">
<script src="SCRIPTS/jquery.min.js"></script>
<link href="css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<div class="container" style="font-family: 'Geist Mono', monospace;">
    <a class="btn btn-primary" href="sidebar.php" role="button"><i class="fa-solid fa-house"> Ir al Inicio</i></a>
    <br>
    <br>
    <form action="registrarUsuario.php" id="frmuser" name="frmuser" method="POST" class="row g-3 needs-validation" novalidate>

        <div class="col-md-4 position-relative">
            <label for="validationTooltip01" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombre" value="" required>

            <div class="invalid-tooltip">
                Porfavor completa el campo.
            </div>

            <div class="valid-tooltip">
                ¡Se ve bien!
            </div>

        </div>

        <div class="col-md-4 position-relative">

            <label for="validationTooltip02" class="form-label">Apellido Paterno</label>
            <input type="text" class="form-control" id="apP" value="" required>
            <div class="invalid-tooltip">
                Porfavor completa el campo.
            </div>

            <div class="valid-tooltip">
                ¡Se ve bien!
            </div>

        </div>

        <div class="col-md-4 position-relative">

            <label for="validationTooltip02" class="form-label">Apellido Materno</label>
            <input type="text" class="form-control" id="apM" value="" required>

            <div class="invalid-tooltip">
                Porfavor completa el campo.
            </div>

            <div class="valid-tooltip">
                ¡Se ve bien!
            </div>

        </div>


        <div class="col-md-6 position-relative">

            <label for="validationTooltip03" class="form-label">Correo electronico</label>
            <input type="email" class="form-control" id="correo" required>

            <div class="invalid-tooltip">
                Proporciona un correo valido.
            </div>

            <div class="valid-tooltip">
                ¡Se ve bien!
            </div>

        </div>

        <div class="col-md-4 position-relative">

            <label for="validationTooltip02" class="form-label">Contraseña</label>
            <input type="password" class="form-control" id="contraseña" value="" required>

            <div class="invalid-tooltip">
                Proporciona una contraseña.
            </div>

            <div class="valid-tooltip">
                ¡Se ve bien!
            </div>

        </div>


        <div class="col-12">
            <button class="btn btn-primary" type="submit" onclick="nuevoUsuario();">Guardar nuevo usuario</button>
        </div>

    </form>

</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="SCRIPTS/script.js"></script>

<script>
    (function() {
        'use strict'

        var forms = document.querySelectorAll('.needs-validation')

        Array.prototype.slice.call(forms)
            .forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }

                    form.classList.add('was-validated')
                }, false)
            })
    })()
</script>