<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Formulario de Registro de Socios</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2>Formulario de Registro de Socios</h2>
        <form action="tu_script_php.php" method="POST" enctype="multipart/form-data" class="form-horizontal">
            
            <h3>Datos de la Empresa</h3>
            <div class="form-group">
                <label for="fechaAfiliacion" class="col-sm-2 control-label">Fecha de Afiliación:</label>
                <div class="col-sm-10">
                    <input type="date" class="form-control" id="fechaAfiliacion" name="fechaAfiliacion" required>
                </div>
            </div>
            
            <div class="form-group">
                <label for="razonSocial" class="col-sm-2 control-label">Razón Social:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="razonSocial" name="razonSocial" required>
                </div>
            </div>

            <div class="form-group">
                <label for="RFC" class="col-sm-2 control-label">RFC:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="RFC" name="RFC" required>
                </div>
            </div>

            <div class="form-group">
                <label for="nombreComercial" class="col-sm-2 control-label">Nombre Comercial:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="nombreComercial" name="nombreComercial" required>
                </div>
            </div>

            <div class="form-group">
                <label for="calle" class="col-sm-2 control-label">Calle:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="calle" name="calle" required>
                </div>
            </div>

            <div class="form-group">
                <label for="numero" class="col-sm-2 control-label">Número:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="numero" name="numero" required>
                </div>
            </div>

            <div class="form-group">
                <label for="colonia" class="col-sm-2 control-label">Colonia:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="colonia" name="colonia" required>
                </div>
            </div>

            <div class="form-group">
                <label for="cp" class="col-sm-2 control-label">Código Postal:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="cp" name="cp" required>
                </div>
            </div>

            <div class="form-group">
                <label for="estado" class="col-sm-2 control-label">Estado:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="estado" name="estado" required>
                </div>
            </div>

            <div class="form-group">
                <label for="municipio" class="col-sm-2 control-label">Municipio:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="municipio" name="municipio" required>
                </div>
            </div>

            <div class="form-group">
                <label for="telefonoEmpresa1" class="col-sm-2 control-label">Teléfono de la Empresa:</label>
                <div class="col-sm-10">
                    <input type="tel" class="form-control" id="telefonoEmpresa1" name="telefonoEmpresa1" required>
                </div>
            </div>

            <div class="form-group">
                <label for="sectorEstrategico" class="col-sm-2 control-label">Sector Estratégico:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="sectorEstrategico" name="sectorEstrategico" required>
                </div>
            </div>

            <div class="form-group">
                <label for="giro" class="col-sm-2 control-label">Giro:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="giro" name="giro" required>
                </div>
            </div>

            <div class="form-group">
                <label for="giroGeneral" class="col-sm-2 control-label">Giro General:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="giroGeneral" name="giroGeneral" required>
                </div>
            </div>

            <div class="form-group">
                <label for="noColaboradores" class="col-sm-2 control-label">Número de Colaboradores:</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" id="noColaboradores" name="noColaboradores" required>
                </div>
            </div>

            <div class="form-group">
                <label for="rangoVentas" class="col-sm-2 control-label">Rango de Ventas:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="rangoVentas" name="rangoVentas" required>
                </div>
            </div>

            <div class="form-group">
                <label for="tamaño" class="col-sm-2 control-label">Tamaño de la Empresa:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="tamaño" name="tamaño" required>
                </div>
            </div>

            <div class="form-group">
                <label for="queVende" class="col-sm-2 control-label">¿Qué Vende?:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="queVende" name="queVende" required>
                </div>
            </div>

            <div class="form-group">
                <label for="queCompra" class="col-sm-2 control-label">¿Qué Compra?:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="queCompra" name="queCompra" required>
                </div>
            </div>

            <div class="form-group">
                <label for="cuota" class="col-sm-2 control-label">Cuota:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="cuota" name="cuota" required>
                </div>
            </div>

            <div class="form-group">
                <label for="mesFactura" class="col-sm-2 control-label">Mes de Facturación:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="mesFactura" name="mesFactura" required>
                </div>
            </div>

            <div class="form-group">
                <label for="ejecutivoAfilio" class="col-sm-2 control-label">Ejecutivo que Afila:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="ejecutivoAfilio" name="ejecutivoAfilio" required>
                </div>
            </div>

            <div class="form-group">
                <label for="diaAniversario" class="col-sm-2 control-label">Día de Aniversario:</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" id="diaAniversario" name="diaAniversario" required>
                </div>
            </div>

            <div class="form-group">
                <label for="mesAniversario" class="col-sm-2 control-label">Mes de Aniversario:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="mesAniversario" name="mesAniversario" required>
                </div>
            </div>

            <h3>Datos del Asociado</h3>
            <div class="form-group">
                <label for="nombreAsociado" class="col-sm-2 control-label">Nombre del Asociado:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="nombreAsociado" name="nombreAsociado" required>
                </div>
            </div>

            <div class="form-group">
                <label for="curpAsociado" class="col-sm-2 control-label">CURP del Asociado:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="curpAsociado" name="curpAsociado" required>
                </div>
            </div>

            <div class="form-group">
                <label for="diaCumpleAsociado" class="col-sm-2 control-label">Día de Cumpleaños del Asociado:</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" id="diaCumpleAsociado" name="diaCumpleAsociado" required>
                </div>
            </div>

            <div class="form-group">
                <label for="mesCumpleAsociado" class="col-sm-2 control-label">Mes de Cumpleaños del Asociado:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="mesCumpleAsociado" name="mesCumpleAsociado" required>
                </div>
            </div>

            <div class="form-group">
                <label for="correoAsociado1" class="col-sm-2 control-label">Correo Electrónico del Asociado (1):</label>
                <div class="col-sm-10">
                    <input type="email" class="form-control" id="correoAsociado1" name="correoAsociado1" required>
                </div>
            </div>

            <div class="form-group">
                <label for="correoAsociado2" class="col-sm-2 control-label">Correo Electrónico del Asociado (2):</label>
                <div class="col-sm-10">
                    <input type="email" class="form-control" id="correoAsociado2" name="correoAsociado2">
                </div>
            </div>

            <div class="form-group">
                <label for="celularAsociado" class="col-sm-2 control-label">Celular del Asociado:</label>
                <div class="col-sm-10">
                    <input type="tel" class="form-control" id="celularAsociado" name="celularAsociado" required>
                </div>
            </div>

            <div class="form-group">
                <label for="telOficinaAsociado" class="col-sm-2 control-label">Teléfono de Oficina del Asociado:</label>
                <div class="col-sm-10">
                    <input type="tel" class="form-control" id="telOficinaAsociado" name="telOficinaAsociado">
                </div>
            </div>

            <div class="form-group">
                <label for="extensionAsociado" class="col-sm-2 control-label">Extensión del Asociado:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="extensionAsociado" name="extensionAsociado">
                </div>
            </div>

            <div class="form-group">
                <label for="perfilAsociado" class="col-sm-2 control-label">Perfil del Asociado:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="perfilAsociado" name="perfilAsociado" required>
                </div>
            </div>

            <div class="form-group">
                <label for="generoAsociado" class="col-sm-2 control-label">Género del Asociado:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="generoAsociado" name="generoAsociado" required>
                </div>
            </div>

            <!-- Representante -->
            <h3>Datos del Representante</h3>
            <div class="form-group">
                <label for="nombreRepresentante" class="col-sm-2 control-label">Nombre del Representante:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="nombreRepresentante" name="nombreRepresentante" required>
                </div>
            </div>

            <div class="form-group">
                <label for="correoRepresentante" class="col-sm-2 control-label">Correo Electrónico del Representante:</label>
                <div class="col-sm-10">
                    <input type="email" class="form-control" id="correoRepresentante" name="correoRepresentante" required>
                </div>
            </div>

            <div class="form-group">
                <label for="telRepresentante" class="col-sm-2 control-label">Teléfono del Representante:</label>
                <div class="col-sm-10">
                    <input type="tel" class="form-control" id="telRepresentante" name="telRepresentante" required>
                </div>
            </div>

            <div class="form-group">
                <label for="puestoRepresentante" class="col-sm-2 control-label">Puesto del Representante:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="puestoRepresentante" name="puestoRepresentante" required>
                </div>
            </div>

            <!-- Asistente -->
            <h3>Datos del Asistente</h3>
            <div class="form-group">
                <label for="nombreAsistente" class="col-sm-2 control-label">Nombre del Asistente:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="nombreAsistente" name="nombreAsistente" required>
                </div>
            </div>

            <div class="form-group">
                <label for="correoAsistente" class="col-sm-2 control-label">Correo Electrónico del Asistente:</label>
                <div class="col-sm-10">
                    <input type="email" class="form-control" id="correoAsistente" name="correoAsistente" required>
                </div>
            </div>

            <div class="form-group">
                <label for="telAsistente" class="col-sm-2 control-label">Teléfono del Asistente:</label>
                <div class="col-sm-10">
                    <input type="tel" class="form-control" id="telAsistente" name="telAsistente" required>
                </div>
            </div>

            <div class="form-group">
                <label for="puestoAsistente" class="col-sm-2 control-label">Puesto del Asistente:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="puestoAsistente" name="puestoAsistente" required>
                </div>
            </div>

            <!-- Finanzas -->
            <h3>Datos de Finanzas</h3>
            <div class="form-group">
                <label for="nombreFinanzas" class="col-sm-2 control-label">Nombre del Encargado de Finanzas:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="nombreFinanzas" name="nombreFinanzas" required>
                </div>
            </div>

            <div class="form-group">
                <label for="correoFinanzas" class="col-sm-2 control-label">Correo Electrónico de Finanzas:</label>
                <div class="col-sm-10">
                    <input type="email" class="form-control" id="correoFinanzas1" name="correoFinanzas1" required>
                </div>
            </div>

            <div class="form-group">
                <label for="telFinanzas" class="col-sm-2 control-label">Teléfono de Finanzas:</label>
                <div class="col-sm-10">
                    <input type="tel" class="form-control" id="telFinanzas" name="telFinanzas" required>
                </div>
            </div>

            <div class="form-group">
                <label for="puestoFinanzas" class="col-sm-2 control-label">Puesto del Encargado de Finanzas:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="puestoFinanzas" name="puestoFinanzas" required>
                </div>
            </div>

            <!-- Recursos Humanos -->
            <h3>Datos de Recursos Humanos</h3>
            <div class="form-group">
                <label for="nombreRRHH" class="col-sm-2 control-label">Nombre del Encargado de RRHH:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="nombreRRHH" name="nombreRRHH" required>
                </div>
            </div>

            <div class="form-group">
                <label for="correoRRHH" class="col-sm-2 control-label">Correo Electrónico de RRHH:</label>
                <div class="col-sm-10">
                    <input type="email" class="form-control" id="correoRRHH" name="correoRRHH" required>
                </div>
            </div>

            <div class="form-group">
                <label for="telRRHH" class="col-sm-2 control-label">Teléfono de RRHH:</label>
                <div class="col-sm-10">
                    <input type="tel" class="form-control" id="telRRHH" name="telRRHH" required>
                </div>
            </div>

            <div class="form-group">
                <label for="puestoRRHH" class="col-sm-2 control-label">Puesto del Encargado de RRHH:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="puestoRRHH" name="puestoRRHH" required>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-primary">Guardar Datos</button>
                </div>
            </div>
        </form>
    </div>

        </form>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>
