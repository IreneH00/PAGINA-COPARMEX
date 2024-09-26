<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/sidebar.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="icon" type="image/png" href="images/logo.jpeg">
    <title>Socios</title>

    <style>
        select::-webkit-scrollbar {
            width: 10px;
        }

        select::-webkit-scrollbar-track {
            background: lightblue;
        }

        select::-webkit-scrollbar-thumb {
            background: blue;
            border-radius: 6px;
        }

        select::-webkit-scrollbar-thumb:hover {
            background: #007;
        }

        body::-webkit-scrollbar {
            width: 12px;
        }

        body::-webkit-scrollbar-track {
            background: lightblue;
        }

        body::-webkit-scrollbar-thumb {
            background: blue;
            border-radius: 6px;
        }

        body::-webkit-scrollbar-thumb:hover {
            background: #007;
        }

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

        .comment-box {
            width: 100%;
            resize: none;
            box-sizing: border-box;
            height: 40px;
            padding: 8px;
            font-size: 14px;
            border: 1px solid;
        }
    </style>

</head>

<body style="font-family: 'Geist Mono', monospace;">

    <ul class="nav nav-pills nav-fill gap-2 p-1 small bg-primary rounded-5 shadow-sm" id="pillNav2" role="tablist" style="--bs-nav-link-color: var(--bs-white); --bs-nav-pills-link-active-color: var(--bs-primary); --bs-nav-pills-link-active-bg: var(--bs-white);">
        <li class="nav-item" role="presentation">
            <a class="nav-link rounded-5" href="sidebar.php" role="button"><i class="fa-solid fa-house"> Ir al Inicio</i></a>
        </li>

        <li class="nav-item" role="presentation">
            <button class="nav-link active rounded-5" id="home-tab1" href="agenda.php" data-bs-toggle="tab" type="button" role="tab" aria-selected="true">Agregar nuevo socio</button>
        </li>

        <li class="nav-item" role="presentation">
            <button class="nav-link rounded-5" id="listaSocios" data-bs-toggle="tab" type="button" role="tab" aria-selected="false">Lista de Socios</button>
        </li>
    </ul>

    <div class="container">

        <form action="registrarSocio.php" id="frmsocios" name="frmsocios" method="post">

            <!-- SECCIÓN DE LOS DATOS DE LA EMPRESA -->

            <p style="font-size: 18px; text-align:center"><b>EMPRESA</b></p>
            <hr style="border-top: 2.5px solid black">

            <div class="row">

                <div class="col">
                    <label>Fecha de afiliación:</label>
                    <input type="date" class="form-control" id="fechaAfiliacion" name="fechaAfiliacion" required>
                </div>

                <div class="col">
                    <label>Razón social:</label>
                    <input type="text" class="form-control" id="razonSocial" name="razonSocial" placeholder="razón social" required>
                </div>

                <div class="col">
                    <label>RFC:</label>
                    <input type="text" class="form-control" id="RFC" name="RFC" placeholder="RFC" maxlength="13" required>
                </div>

            </div>

            <br>

            <div class="row">
                <div class="col">
                    <label>Nombre comercial:</label>
                    <input type="text" class="form-control" id="nombreComercial" name="nombreComercial" placeholder="Nombre comercial" required>
                </div>
                <div class="col">
                    <label>Calle:</label>
                    <input type="text" class="form-control" id="calle" name="calle" placeholder="Calle" required>
                </div>
                <div class="col">
                    <label>Número:</label>
                    <input type="text" class="form-control" id="numero" name="numero" placeholder="Número" required>
                </div>
                <div class="col">
                    <label>Colonia:</label>
                    <input type="text" class="form-control" id="colonia" name="colonia" placeholder="Colonia" required>
                </div>
                <div class="col">
                    <label>C.P:</label>
                    <input type="text" class="form-control" id="cp" name="cp" placeholder="Código postal" maxlength="5" required>
                </div>
            </div>

            <br>

            <div class="row">
                <div class="col">
                    <label for="estado">Estado:</label>
                    <select class="form-select" id="estado" name="estado" aria-label="estado">
                        <option selected>Selecciona una opción...</option>
                        <option value="Puebla">Puebla</option>
                        <option value="México">México</option>
                    </select>
                </div>

                <div class="col">
                    <label for="municipio">Municipio:</label>
                    <select class="form-select" id="municipio" name="municipio" aria-label="municipio">
                        <option value="" selected>Selecciona una opción....</option>
                        <option value="Tierra Negra">Tierra Negra</option>
                        <option value="Francisco Z. Mena">Francisco Z. Mena</option>
                        <option value="Nicolas Romero">Nicolas Romero</option>
                    </select>
                </div>

                <div class="col">
                    <label>Teléfono de empresa:</label>
                    <input type="tel" class="form-control" id="telefonoEmpresa1" name="telefonoEmpresa1" placeholder="Teléfono de la empresa" maxlength="10" required>
                </div>

            </div>

            <br>

            <div class="row">

                <div class="col">
                    <label for="sectorEstrategico">Sector estratégico:</label>
                    <select class="form-select" id="sectorEstrategico" name="sectorEstrategico" aria-label="sectorEstrategico">
                        <option value="INDUSTRIAL">INDUSTRIAL</option>
                        <option value="SERVICIO">SERVICIO</option>
                        <option value="COMERCIAL">COMERCIAL</option>
                    </select>
                </div>

                <div class="col">
                    <label>Giro:</label>
                    <input type="text" class="form-control" id="giro" name="giro" placeholder="giro de la empresa" required>
                </div>

                <div class="col">
                    <label for="giroGeneral">Giro general:</label>
                    <select class="form-select" id="giroGeneral" name="giroGeneral" aria-label="giroGeneral">
                        <option value="" selected>Selecciona una opción</option>
                        <option value="Agricultura">Agricultura</option>
                        <option value="Ganadería">Ganadería</option>
                        <option value="Silvicultura">Silvicultura</option>
                        <option value="Pesca">Pesca</option>
                        <option value="Caza">Caza</option>
                        <option value="Extracción y beneficio de carbón mineral, grafito y minerales no metálicos; excepto sal">Extracción y beneficio de carbón mineral, grafito y minerales no metálicos; excepto sal</option>
                        <option value="Exploración y extracción de petroléo crudo y gas natural">Exploración y extracción de petroléo crudo y gas natural</option>
                        <option value="Extracción y beneficio de minerales metálicos">Extracción y beneficio de minerales metálicos</option>
                        <option value="Explotación de sal">Explotación de sal</option>
                        <option value="Elaboración de alimentos">Elaboración de alimentos</option>
                        <option value="Elaboración de bebidas">Elaboración de bebidas</option>
                        <option value="Beneficio y/o fabricación de productos de tabaco">Beneficio y/o fabricación de productos de tabaco</option>
                        <option value="Industria textil">Industria textil</option>
                        <option value="Confección de prendas de vestir y otros artículos a base de textiles y minerales diversos; excepto calzado">Confección de prendas de vestir y otros artículos a base de textiles y minerales diversos; excepto calzado</option>
                        <option value="Fabricación de calzado e industria del cuero">Fabricación de calzado e industria del cuero</option>
                        <option value="Industria y productos de madera y corcho; excepto muebles">Industria y productos de madera y corcho; excepto muebles</option>
                        <option value="Fabricación y/o reparación de muebles de madera y sus partes; excepto los de metal y de plástico modelado">Fabricación y/o reparación de muebles de madera y sus partes; excepto los de metal y de plástico modelado</option>
                        <option value="Industria del papel">Industria del papel</option>
                        <option value="Industrias editorial, de impresión y conexas">Industrias editorial, de impresión y conexas</option>
                        <option value="Industria química">Industria química</option>
                        <option value="Refinación del petróleo y derivados del carbón mineral">Refinación del petróleo y derivados del carbón mineral</option>
                        <option value="Fabricación de productos de hule y plástico">Fabricación de productos de hule y plástico</option>
                        <option value="Fabricación de productos de minerales no metálicos; excepto del petróleo y del carbón mineral">Fabricación de productos de minerales no metálicos; excepto del petróleo y del carbón mineral</option>
                        <option value="Industrias metálicas básicas">Industrias metálicas básicas</option>
                        <option value="Fabricación de productos metálicos: excepto maquinaria y equipo">Fabricación de productos metálicos: excepto maquinaria y equipo</option>
                        <option value="Fabricación, ensamble y/o reparación de maquinaria, equipo y sus partes; excepto los eléctricos">Fabricación, ensamble y/o reparación de maquinaria, equipo y sus partes; excepto los eléctricos</option>
                        <option value="Fabricación y/o ensamble de maquinaria, equipos, aparatos, accesorios y artículos eléctricos electrónicos y sus partes">Fabricación y/o ensamble de maquinaria, equipos, aparatos, accesorios y artículos eléctricos electrónicos y sus partes</option>
                        <option value="Construcción, reconstrucción y ensamble de equipo de transporte y sus partes">Construcción, reconstrucción y ensamble de equipo de transporte y sus partes</option>
                        <option value="Otras industrias manufactureras">Otras industrias manufactureras</option>
                        <option value="Construcción de edificaciones y de obras de ingeniería civil">Construcción de edificaciones y de obras de ingeniería civil</option>
                        <option value="Trabajos realizados por contratistas especializados">Trabajos realizados por contratistas especializados</option>
                        <option value="Generación, transmisión y distribución de energía">Generación, transmisión y distribución de energía</option>
                        <option value="Eléctrica">Eléctrica</option>
                        <option value="Captación y suministro de agua potable y tratada">Captación y suministro de agua potable y tratada</option>
                        <option value="Compraventa de alimentos, bebidas y productos del tabaco">Compraventa de alimentos, bebidas y productos del tabaco</option>
                        <option value="Compraventa de prendas de vestir y otros artículos de uso personal">Compraventa de prendas de vestir y otros artículos de uso personal</option>
                        <option value="Compraventa de artículos para el hogar y diversos">Compraventa de artículos para el hogar y diversos</option>
                        <option value="Compraventa en tiendas de autoservicio y de departamentos especializados por línea de mercancías">Compraventa en tiendas de autoservicio y de departamentos especializados por línea de mercancías</option>
                        <option value="Compraventa de gases, combustibles y lubricantes">Compraventa de gases, combustibles y lubricantes</option>
                        <option value="Compraventa de materias primas, materiales y auxiliares">Compraventa de materias primas, materiales y auxiliares</option>
                        <option value="Compraventa de maquinaria, equipo, instrumentos, aparatos, herramientas; sus refacciones y accesorios">Compraventa de maquinaria, equipo, instrumentos, aparatos, herramientas; sus refacciones y accesorios</option>
                        <option value="Compraventa de equipo de transporte; sus refacciones y accesorios">Compraventa de equipo de transporte; sus refacciones y accesorios</option>
                        <option value="Compraventa de inmuebles y artículos diversos">Compraventa de inmuebles y artículos diversos</option>
                        <option value="Transporte terrestre">Transporte terrestre</option>
                        <option value="Transporte por agua">Transporte por agua</option>
                        <option value="Transporte aéreo">Transporte aéreo</option>
                        <option value="Servicios conexos al transporte">Servicios conexos al transporte</option>
                        <option value="Servicios relacionados con el transporte en general">Servicios relacionados con el transporte en general</option>
                        <option value="Comunicaciones">Comunicaciones</option>
                        <option value="Servicios financieros y de seguros (Bancos, financieras, compañías de seguros y similares)">Servicios financieros y de seguros (Bancos, financieras, compañías de seguros y similares)</option>
                        <option value="Servicios colaterales a las instituciones financieras y de seguros">Servicios colaterales a las instituciones financieras y de seguros</option>
                        <option value="Servicios relacionados con inmuebles">Servicios relacionados con inmuebles</option>
                        <option value="Servicios profesionales y técnicos">Servicios profesionales y técnicos</option>
                        <option value="Servicios de alquiler; excepto inmuebles">Servicios de alquiler; excepto inmuebles</option>
                        <option value="Servicios de alojamiento temporal">Servicios de alojamiento temporal</option>
                        <option value="Preparación y servicio de alimentos y bebidas">Preparación y servicio de alimentos y bebidas</option>
                        <option value="Servicios recreativos y de esparcimiento">Servicios recreativos y de esparcimiento</option>
                        <option value="Servicios profesionales para el hogar y diversos">Servicios profesionales para el hogar y diversos</option>
                        <option value="Servicios de enseñanza, investigación científica y difusión cultural">Servicios de enseñanza, investigación científica y difusión cultural</option>
                        <option value="Servicios médicos, asistencia social y veterinarios">Servicios médicos, asistencia social y veterinarios</option>
                        <option value="Agrupaciones mercantiles, profesionales, cívicas, políticas, laborales y religiosas">Agrupaciones mercantiles, profesionales, cívicas, políticas, laborales y religiosas</option>
                        <option value="Servicios de administración pública y seguridad social">Servicios de administración pública y seguridad social</option>
                        <option value="Servicios de organizaciones internacionales y otros organismos extra territoriales">Servicios de organizaciones internacionales y otros organismos extra territoriales</option>
                    </select>
                </div>

                <div class="col">
                    <label>No. de colaboradores:</label>
                    <input type="number" class="form-control" id="noColaboradores" name="noColaboradores" required>
                </div>
            </div>


            <br>


            <div class="row">
                <div class="col">
                    <label for="rangoVentas">Rango de ventas:</label>
                    <select class="form-select" id="rangoVentas" name="rangoVentas" aria-label="rangoVentas">
                        <option value="De 0 a 4 millones.">De 0 a 4 millones.</option>
                        <option value="De 4 millones a 100 millones.">De 4 millones a 100 millones.</option>
                        <option value="De 100 millones en adelante.">De 100 millones en adelante.</option>
                    </select>
                </div>

                <div class="col">
                    <label for="tamaño">Tamaño:</label>
                    <select class="form-select" id="tamaño" name="tamaño" aria-label="tamaño">
                        <option value="MICRO">MICRO</option>
                        <option value="PEQUEÑA">PEQUEÑA</option>
                        <option value="MEDIANA">MEDIANA</option>
                        <option value="GRANDE">GRANDE</option>
                    </select>
                </div>

                <div class="col">
                    <label>¿Que productos vende?</label>
                    <input type="text" class="form-control" id="queVende" name="queVende" placeholder="Que producto(s) vende" required>
                </div>

                <div class="col">
                    <label>¿Qué productos o insumos compra?</label>
                    <input type="text" class="form-control" id="queCompra" name="queCompra" placeholder="Que producto(s) compra" required>
                </div>
            </div>

            <br>

            <div class="row">
                <div class="col">
                    <label>Cuota:</label>
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text">$</div>
                        </div>
                        <input type="number" class="form-control" id="cuota" name="cuota" required>
                    </div>
                </div>

                <div class="col">
                    <label for="mesFactura">Mes de facturación:</label>
                    <select class="form-select" id="mesFactura" name="mesFactura" aria-label="mesFactura">
                        <option value="ENERO">ENERO</option>
                        <option value="FEBRERO">FEBRERO</option>
                        <option value="MARZO">MARZO</option>
                        <option value="ABRIL">ABRIL</option>
                        <option value="MAYO">MAYO</option>
                        <option value="JUNIO">JUNIO</option>
                        <option value="JULIO">JULIO</option>
                        <option value="AGOSTO">AGOSTO</option>
                        <option value="SEPTIEMBRE">SEPTIEMBRE</option>
                        <option value="OCTUBRE">OCTUBRE</option>
                        <option value="NOVIEMBRE">NOVIEMBRE</option>
                        <option value="DICIEMBRE">DICIEMBRE</option>
                    </select>
                </div>

                <div class="col">
                    <label for="ejecutivoAfilio">Ejecutivo que afilio:</label>
                    <select class="form-select" id="ejecutivoAfilio" name="ejecutivoAfilio" aria-label="ejecutivoAfilio">
                        <option selected>Selecciona una opción</option>
                        <option value="ISAAC HERNANDEZ CABRERA">ISAAC HERNANDEZ CABRERA</option>
                        <option value="NANCY NIEVES RENDON">NANCY NIEVES RENDON</option>
                        <option value="PABLO ISAAC PEÑA GUTIÉRREZ">PABLO ISAAC PEÑA GUTIÉRREZ</option>
                        <option value="BAJA PENDIENTE">BAJA PENDIENTE</option>
                        <option value="DULCE MARIA CURIEL ROMERO">DULCE MARIA CURIEL ROMERO</option>
                        <option value="ELEAZAR AMADOR HERNANDEZ">ELEAZAR AMADOR HERNANDEZ</option>
                        <option value="MARILYN ESCALANTE SANTIAGO">MARILYN ESCALANTE SANTIAGO</option>
                        <option value="CONNY STEPHANIA PICHARDO BONILLA">CONNY STEPHANIA PICHARDO BONILLA</option>
                        <option value="ANA MARIA GOMEZ MUÑOZ">ANA MARIA GOMEZ MUÑOZ</option>
                        <option value="ELISSA LORENA TRUJILLO JIMÉNEZ">ELISSA LORENA TRUJILLO JIMÉNEZ</option>
                        <option value="CARLOS MANUEL ZARATE MUÑOZ">CARLOS MANUEL ZARATE MUÑOZ</option>
                    </select>
                </div>
            </div>


            <br>
            
            <div class="row">
                <div class="col-sm-4">
                    <label for="diaAniversario">día Aniversaio</label>
                    <select class="form-select" id="diaAniversario" name="diaAniversario" aria-label="diaAniversario">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                        <option value="11">11</option>
                        <option value="12">12</option>
                        <option value="13">13</option>
                        <option value="14">14</option>
                        <option value="15">15</option>
                        <option value="16">16</option>
                        <option value="17">17</option>
                        <option value="18">18</option>
                        <option value="19">19</option>
                        <option value="20">20</option>
                        <option value="21">21</option>
                        <option value="22">22</option>
                        <option value="23">23</option>
                        <option value="24">24</option>
                        <option value="25">25</option>
                        <option value="26">26</option>
                        <option value="27">27</option>
                        <option value="28">28</option>
                        <option value="29">29</option>
                        <option value="30">30</option>
                        <option value="31">31</option>
                    </select>
                </div>

                <div class="col-sm-4">
                    <label for="mesAniversario">Mes de Aniversario:</label>
                    <select class="form-select" id="mesAniversario" name="mesAniversario" aria-label="mesAniversario">
                        <option value="ENERO">ENERO</option>
                        <option value="FEBRERO">FEBRERO</option>
                        <option value="MARZO">MARZO</option>
                        <option value="ABRIL">ABRIL</option>
                        <option value="MAYO">MAYO</option>
                        <option value="JUNIO">JUNIO</option>
                        <option value="JULIO">JULIO</option>
                        <option value="AGOSTO">AGOSTO</option>
                        <option value="SEPTIEMBRE">SEPTIEMBRE</option>
                        <option value="OCTUBRE">OCTUBRE</option>
                        <option value="NOVIEMBRE">NOVIEMBRE</option>
                        <option value="DICIEMBRE">DICIEMBRE</option>
                    </select>
                </div>
            </div>


            <!-- SECCION DE LOS ASOCIADOS -->
            <br>
            <hr style="border-top: 2.5px solid black">
            <p style="font-size: 18px; text-align:center"><b>ASOCIADO</b></p>
            <hr style="border-top: 2.5px solid black">

            <div class="row">
                <div class="col">
                    <label>Nombre:</label>
                    <input type="text" class="form-control" id="nombreAsociado" name="nombreAsociado" placeholder="Nombre del asociado" required>
                </div>

                <div class="col">
                    <label>CURP:</label>
                    <input type="text" class="form-control" id="curpAsociado" name="curpAsociado" placeholder="CURP del asociado" maxlength="18" required>
                </div>

                <div class="col">
                    <label for="diaCumpleAsociado">Día de cumpleaños:</label>
                    <select class="form-select" id="diaCumpleAsociado" name="diaCumpleAsociado" aria-label="diaCumpleAsociado">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                        <option value="11">11</option>
                        <option value="12">12</option>
                        <option value="13">13</option>
                        <option value="14">14</option>
                        <option value="15">15</option>
                        <option value="16">16</option>
                        <option value="17">17</option>
                        <option value="18">18</option>
                        <option value="19">19</option>
                        <option value="20">20</option>
                        <option value="21">21</option>
                        <option value="22">22</option>
                        <option value="23">23</option>
                        <option value="24">24</option>
                        <option value="25">25</option>
                        <option value="26">26</option>
                        <option value="27">27</option>
                        <option value="28">28</option>
                        <option value="29">29</option>
                        <option value="30">30</option>
                        <option value="31">31</option>
                    </select>
                </div>

                <div class="col">
                    <label for="mesCumpleAsociado">Mes de cumpleaños:</label>
                    <select class="form-select" id="mesCumpleAsociado" name="mesCumpleAsociado" aria-label="mesCumpleAsociado">
                        <option value="ENERO">ENERO</option>
                        <option value="FEBRERO">FEBRERO</option>
                        <option value="MARZO">MARZO</option>
                        <option value="ABRIL">ABRIL</option>
                        <option value="MAYO">MAYO</option>
                        <option value="JUNIO">JUNIO</option>
                        <option value="JULIO">JULIO</option>
                        <option value="AGOSTO">AGOSTO</option>
                        <option value="SEPTIEMBRE">SEPTIEMBRE</option>
                        <option value="OCTUBRE">OCTUBRE</option>
                        <option value="NOVIEMBRE">NOVIEMBRE</option>
                        <option value="DICIEMBRE">DICIEMBRE</option>
                    </select>
                </div>
            </div>


            <br>

            <div class="row">
                <div class="col">
                    <label>Correo 1:</label>
                    <input type="email" class="form-control" id="correoAsociado1" name="correoAsociado1" placeholder="Correo 1 del asociado" required>
                </div>

                <div class="col">
                    <label>Correo 2:</label>
                    <input type="email" class="form-control" id="correoAsociado2" name="correoAsociado2" placeholder="Correo 2 del asociado" required>
                </div>

            </div>


            <br>
            <div class="row">
                <div class="col">
                    <label>Celular:</label>
                    <input type="tel" class="form-control" id="celularAsociado" name="celularAsociado" placeholder="Número celular" maxlength="10" required>
                </div>

                <div class="col">
                    <label>Tel oficina:</label>
                    <input type="tel" class="form-control" id="telOficinaAsociado" name="telOficinaAsociado" placeholder="Número de teléfono de oficina" maxlength="10" required>
                </div>

                <div class="col">
                    <label>Extensión:</label>
                    <input type="text" class="form-control" id="extensionAsociado" name="extensionAsociado" placeholder="extensión" maxlength="4" required>
                </div>
            </div>


            <br>
            <div class="row">
                <div class="col">
                    <label for="perfilAsociado">Perfil:</label>
                    <select class="form-select" id="perfilAsociado" name="perfilAsociado" aria-label="perfilAsociado">
                        <option value="" selected>Selecciona una opción</option>
                        <option value="PRESIDENTE">PRESIDENTE</option>
                        <option value="SOCIO">SOCIO</option>
                        <option value="PRESIDENTE DE COMISIÓN">PRESIDENTE DE COMISIÓN</option>
                        <option value="EXPRESIDENTE">EXPRESIDENTE</option>
                        <option value="CONSEJERO">CONSEJERO</option>
                    </select>
                </div>

                <div class="col">
                    <label for="generoAsociado">Genero:</label>
                    <select class="form-select" id="generoAsociado" name="generoAsociado" aria-label="generoAsociado">
                        <option value="MASCULINO">MASCULINO</option>
                        <option value="FEMENINO">FEMENINO</option>
                    </select>
                </div>

                <div class="col">
                    <label>Mismos datos para el resprentante legal:</label>
                    <select class="form-select" id="mismosDatosRepresentante" name="mismosDatosRepresentante" onchange="siDatos()">
                        <option value="No">No</option>
                        <option value="Si">Si</option>
                    </select>
                </div>
            </div>

            <!-- SECCION DEL REPRESENTANTES -->
            <br>
            <hr style="border-top: 2.5px solid black">
            <p style="font-size: 18px; text-align:center"><b>REPRESENTANTE ANTE COPARMEX</b></p>
            <hr style="border-top: 2.5px solid black">

            <div class="row">
                <div class="col">
                    <label>Nombre:</label>
                    <input type="text" class="form-control" id="nombreRepresentante" name="nombreRepresentante" placeholder="Nombre del representante" required>
                </div>

                <div class="col">
                    <label>CURP:</label>
                    <input type="text" class="form-control" id="curpRepresentante" name="curpRepresentante" placeholder="CURP del representante" maxlength="18" required>
                </div>

                <div class="col">
                    <label for="diaCumpleRepresentante">Día de cumpleaños:</label>
                    <select class="form-select" id="diaCumpleRepresentante" name="diaCumpleRepresentante" aria-label="diaCumpleRepresentante">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                        <option value="11">11</option>
                        <option value="12">12</option>
                        <option value="13">13</option>
                        <option value="14">14</option>
                        <option value="15">15</option>
                        <option value="16">16</option>
                        <option value="17">17</option>
                        <option value="18">18</option>
                        <option value="19">19</option>
                        <option value="20">20</option>
                        <option value="21">21</option>
                        <option value="22">22</option>
                        <option value="23">23</option>
                        <option value="24">24</option>
                        <option value="25">25</option>
                        <option value="26">26</option>
                        <option value="27">27</option>
                        <option value="28">28</option>
                        <option value="29">29</option>
                        <option value="30">30</option>
                        <option value="31">31</option>
                    </select>
                </div>

                <div class="col">
                    <label for="mesCumpleRepresentante">Mes de cumpleaños:</label>
                    <select class="form-select" id="mesCumpleRepresentante" name="mesCumpleRepresentante" aria-label="mesCumpleRepresentante">
                        <option value="ENERO">ENERO</option>
                        <option value="FEBRERO">FEBRERO</option>
                        <option value="MARZO">MARZO</option>
                        <option value="ABRIL">ABRIL</option>
                        <option value="MAYO">MAYO</option>
                        <option value="JUNIO">JUNIO</option>
                        <option value="JULIO">JULIO</option>
                        <option value="AGOSTO">AGOSTO</option>
                        <option value="SEPTIEMBRE">SEPTIEMBRE</option>
                        <option value="OCTUBRE">OCTUBRE</option>
                        <option value="NOVIEMBRE">NOVIEMBRE</option>
                        <option value="DICIEMBRE">DICIEMBRE</option>
                    </select>
                </div>
            </div>



            <br>
            <div class="row">
                <div class="col">
                    <label>Correo 1:</label>
                    <input type="email" class="form-control" id="correoRepresentante1" name="correoRepresentante1" autocomplete="email" placeholder="primer correo del representante" required>
                </div>

                <div class="col">
                    <label>Correo 2:</label>
                    <input type="email" class="form-control" id="correoRepresentante2" name="correoRepresentante2" autocomplete="email" placeholder="segundo correo del representante" required>
                </div>
            </div>



            <br>
            <div class="row">
                <div class="col">
                    <label>Celular:</label>
                    <input type="tel" class="form-control" id="celularRepresentante" name="celularRepresentante" placeholder="Número de celular de representante" maxlength="10" autocomplete="tel">
                </div>

                <div class="col">
                    <label>Tel oficina:</label>
                    <input type="tel" class="form-control" id="telOficinaRepresentante" name="telOficinaRepresentante" placeholder="Número de oficina" maxlength="10" autocomplete="tel">
                </div>

                <div class="col">
                    <label>Extensión:</label>
                    <input type="tel" class="form-control" id="extensionRepresentante" name="extensionRepresentante" placeholder="extensión" maxlength="4">
                </div>
            </div>




            <br>
            <div class="row">
                <div class="col">
                    <label for="perfilRepresentante">Perfil:</label>
                    <select class="form-select" id="perfilRepresentante" name="perfilRepresentante" aria-label="perfilRepresentante">
                        <option value="" selected>Selecciona una opción</option>
                        <option value="PRESIDENTE">PRESIDENTE</option>
                        <option value="SOCIO">SOCIO</option>
                        <option value="PRESIDENTE DE COMISIÓN">PRESIDENTE DE COMISIÓN</option>
                        <option value="EXPRESIDENTE">EXPRESIDENTE</option>
                        <option value="CONSEJERO">CONSEJERO</option>
                    </select>
                </div>

                <div class="col">
                    <label for="generoRepresentante">Genero:</label>
                    <select class="form-select" id="generoRepresentante" name="generoRepresentante" aria-label="generoRepresentante">
                        <option value="MASCULINO">MASCULINO</option>
                        <option value="FEMENINO">FEMENINO</option>
                    </select>
                </div>
            </div>


            <!-- SECCIÓN DEL ASISTENTE -->
            <br>
            <hr style="border-top: 2.5px solid black">
            <p style="font-size: 18px; text-align:center"><b>ASISTENTE</b></p>
            <hr style="border-top: 2.5px solid black">


            <div class="row">
                <div class="col">
                    <label>Nombre:</label>
                    <input type="text" class="form-control" id="nombreAsistente" name="nombreAsistente" autocomplete="name">
                </div>

                <div class="col">
                    <label>Correo 1:</label>
                    <input type="email" class="form-control" id="correoAsistente1" name="correoAsistente1" autocomplete="email">
                </div>

                <div class="col">
                    <label>Celular:</label>
                    <input type="tel" class="form-control" id="celularAsistente" name="celularAsistente" maxlength="10" autocomplete="tel">
                </div>
            </div>


            <!-- SECCION DE FINANZAS -->
            <br>
            <hr style="border-top: 2.5px solid black">
            <p style="font-size: 18px; text-align:center;"><b>FINANZAS</b></p>
            <hr style="border-top: 2.5px solid black">

            <div class="row">
                <div class="col">
                    <label>Nombre:</label>
                    <input type="text" class="form-control" id="nombreFinanzas" name="nombreFinanzas" required>
                </div>

                <div class="col">
                    <label>Correo 1:</label>
                    <input type="email" class="form-control" id="correoFinanzas1" name="correoFinanzas1" required>
                </div>

                <div class="col">
                    <label>Celular:</label>
                    <input type="tel" class="form-control" id="celularFinanzas" name="celularFinanzas" maxlength="10" autocomplete="tel">
                </div>
            </div>


            <!-- SECCIÓN DE RECURSOS HUMANOS -->
            <br>
            <hr style="border-top: 2.5px solid black">
            <p style="font-size: 18px; text-align:center;"><b>RECURSOS HUMANOS</b></p>
            <hr style="border-top: 2.5px solid black">

            <div class="row">
                <div class="col">
                    <label>Nombre:</label>
                    <input type="text" class="form-control" id="nombreRecursosHumanos" name="nombreRecursosHumanos" autocomplete="name">
                </div>

                <div class="col">
                    <label>Correo 1:</label>
                    <input type="email" class="form-control" id="correoRecursosHumanos1" name="correoRecursosHumanos1" autocomplete="email">
                </div>

                <div class="col">
                    <label>Celular:</label>
                    <input type="tel" class="form-control" id="celularRecursosHumanos" name="celularRecursosHumanos" maxlength="10" autocomplete="tel">
                </div>
            </div>


            <!-- SECCIÓN DE LOS COMENTARIOS -->
            <br>
            <hr style="border-top: 2.5px solid black">
            <p style="font-size: 18px; text-align:center;"><b>COMENTARIOS</b></p>
            <hr style="border-top: 2.5px solid black">

            <div class="row">
                <div class="col">
                    <legend style="font-size: 12px;">Comentario:</legend>
                    <textarea id="comentario" name="comentario" class="comment-box" placeholder="Deja algún comentario"></textarea>
                </div>
            </div>


            <!-- SECCION PARA LA CARGA DEL LOGO -->
            <!-- <hr style="border-top: 2.5px solid black">
            <p style="font-size: 18px; text-align:center"><b>LOGOTIPO</b></p>

            <div class="row" style="align-content: space-between;">
                <div class="col-sm-4">
                    <div class="input-group mb-3">
                        <input type="file" class="form-control" id="logotipo" name="logotipo" accept="image/*" required>
                    </div>
                </div>


                <div class="col" id="uploadedImageContainer">
                    <img id="uploadedImage" src="" style="width: 30%; height: auto;">
                </div>

            </div> -->
            
            <div class="d-grid gap-2">
                <input type="button" class="btn-custom" onclick="guardarSocio()" value="💾 Guardar">
            </div>

        </form>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="SCRIPTS/script.js"></script>
    <script src="SCRIPTS/socios.js"></script>
</body>

</html>

<script>
    document.getElementById('listaSocios').addEventListener('click', function() {
        window.location.href = 'listaSocios.php';
    });

    // document.getElementById('logotipo').addEventListener('change', function(event) {
    //     const file = event.target.files[0];
    //     const reader = new FileReader();

    //     reader.onload = function(e) {
    //         const uploadedImage = document.getElementById('uploadedImage');
    //         uploadedImage.src = e.target.result;
    //         uploadedImage.style.display = 'block';
    //     }

    //     if (file) {
    //         reader.readAsDataURL(file);
    //     }
    // });
</script>