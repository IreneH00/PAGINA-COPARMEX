<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cotizador</title>
    <link rel="icon" type="image/png" href="images/logo.jpeg">
    <link rel="stylesheet" href="CSS/sidebar.css">
    <script src="SCRIPTS/jquery.min.js"></script>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<style>
    .comment-box {
        width: 100%;
        resize: none;
        box-sizing: border-box;
        height: 42px;
        padding: 8px;
        font-size: 14px;
        border: 1px solid #ccc;
    }

    .socio {
        background-color: red;
        margin-bottom: 30px;
        transform: scale(2);
        -webkit-transform: scale(2);
    }
</style>

<body style="font-family: 'Geist Mono', monospace;">

    <ul class="nav nav-pills nav-fill gap-2 p-1 small bg-primary rounded-5 shadow-sm" id="pillNav2" role="tablist" style="--bs-nav-link-color: var(--bs-white); --bs-nav-pills-link-active-color: var(--bs-primary); --bs-nav-pills-link-active-bg: var(--bs-white);">

        <li class="nav-item" role="presentation">
            <a class="nav-link rounded-5" href="sidebar.php" role="button"><i class="fa-solid fa-house">Ir al Inicio</i></a>
        </li>

        <li class="nav-item" role="presentation">
            <button class="nav-link rounded-5" id="home-tab1" data-bs-toggle="tab" type="button" role="tab" aria-selected="false">Agenda</button>
        </li>

        <li class="nav-item" role="presentation">
            <button class="nav-link rounded-5" id="home-tab2" data-bs-toggle="tab" type="button" role="tab" aria-selected="false">ESPACIO EN BLANCO*</button>
        </li>

        <li class="nav-item" role="presentation">
            <button class="nav-link active rounded-5" id="profile-tab2" data-bs-toggle="tab" type="button" role="tab" aria-selected="true">Cotizador</button>
        </li>

        <li class="nav-item" role="presentation">
            <button class="nav-link rounded-5" id="contact-tab2" data-bs-toggle="tab" type="button" role="tab" aria-selected="false">Solicitud cotización</button>
        </li>

    </ul>

    <div class="container">

        <br>

        <form id="frmprecios" name="frmprecios" class="row g-3 needs-validation" novalidate>

            <div class="col">
                <div class="form-group">
                    <label style="font-size: 34px;" for="socio">Socio</label>
                    <input type="checkbox" class="socio" id="socio" name="socio" value="1" onclick="handleCheckboxClick()">
                </div>
            </div>

            <div class="row">

                <div class="col">
                    <label for="nombre" class="form-label">Nombre:</label>
                    <input type="text" class="form-control" placeholder="Nombre" name="nombre" aria-label="Nombre" required>
                </div>

                <div class="col">
                    <label for="apellido" class="form-label">Apellido completo:</label>
                    <input type="text" class="form-control" placeholder="Apellido" name="apellido" aria-label="Apellido" required>
                </div>

                <div class="col">
                    <label for="correo" class="form-label">Correo electrónico</label>
                    <input type="email" class="form-control" id="correo" name="correo" placeholder="name@example.com" required>
                </div>

            </div>

            <div class="row g-3">

                <div class="col">
                    <label class="form-label" for="espacio">Fecha de inicio del evento</label>
                    <input type="date" class="form-control" name="fechaInic" id="fechaInic">
                </div>

                <div class="col">
                    <label class="form-label" for="espacio">Fecha de fin del evento</label>
                    <input type="date" class="form-control" name="fechaFin" id="fechaFin">
                </div>

                <div class="col">
                    <label for="inputHoraInicio" class="form-label">Hora de Inicio:</label>
                    <input type="time" id="inputHoraInicio" class="form-control" required>
                </div>

                <div class="col">
                    <label for="inputHoraFin" class="form-label">Hora de Fin:</label>
                    <input type="time" id="inputHoraFin" class="form-control" required>
                </div>

            </div>

            <div class="col-md-4">
                <label for="inputEspacio" class="form-label">Elige el tipo de montaje</label>
                <select id="inputEspacio" class="form-select" name="espacio" required>
                    <option selected>Elige...</option>
                    <option value="Herradura">Herradura</option>
                    <option value="Estilo escolar">Estilo escolar</option>
                    <option value="Solo sillas">Solo sillas</option>
                </select>
            </div>

            <div class="col-md-4">
                <label for="inputInstalacion" class="form-label">Elige la instalación que desea</label>
                <select id="inputInstalacion" class="form-select" name="instalacion" required>
                    <option selected>Elige...</option>
                    <option value="Auditorio Pedro Tellería">Auditorio Pedro Tellería</option>
                    <option value="Aula Oxxo">Aula Oxxo</option>
                    <option value="Aula Tapia">Aula Tapia</option>
                </select>
            </div>

            <div class="col-md-4">
                <label for="inputCB" class="form-label">Tipo de Coffee Break que deseas?</label>
                <select id="inputCB" class="form-select" name="cb" required>
                    <option selected>Elige...</option>
                    <option id="scf" value="Sin Coffee Break">Sin Coffee Break</option>
                    <option id="cbs" value="con Coffee Break sencillo">Con Coffee Break sencillo</option>
                    <option id="cfc" value="con Coffee Break completo">Con Coffee Break completo</option>
                </select>
            </div>

            <div class="col-md-4">
                <label for="inputNumPersonas" class="form-label">Número de personas que asisten</label>
                <input type="number" class="form-control" id="inputNumPersonas" name="numPersonas" min="1" required>
            </div>

            <div class="col-md-4">
                <label for="comentario" class="form-label">Comentario</label>
                <textarea class="comment-box" style="font-family: 'Cooper Black', sans-serif; border-radius: 19px; margin-top: -1%;" name="comentario" id="comentario" placeholder="Algo por decir"></textarea>
            </div>

        </form>

    </div>

    <div class="container mt-3">

        <div class="row">
            <div class="col text-end">
                <button type="button" id="cotizarBtn" class="btn btn-primary">Cotizar</button>
            </div>

            <div class="col">
                <a href="#" id="enviarCorreo">Enviar por correo electrónico</a>
            </div>

        </div>

    </div>

    <div class="container mt-3" id="result"></div>
    <div class="container mt-3" id="cotizacionResult" style="font-size: 45px; color: green; font-family: 'Cooper Black', sans-serif; text-align: center;"></div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="SCRIPTS/script.js"></script>

    <script>
        document.getElementById('home-tab2').addEventListener('click', function() {
            window.location.href = 'aulas.php';
        });

        document.getElementById('contact-tab2').addEventListener('click', function() {
            window.location.href = 'consultarAulas.php';
        });

        document.getElementById('home-tab1').addEventListener('click', function() {
            window.location.href = 'agenda.php';
        });

        $('#enviarCorreo').click(function(event) {
            event.preventDefault();

            var form = document.forms['frmprecios'];
            var correo = form['correo'].value;

            if (correo) {
                var mensajeCotizacion = $('#cotizacionResult').text().trim();
                var body = `Fecha de inicio del evento: ${form['fechaInic'].value}\n` +
                    `Fecha de fin del evento: ${form['fechaFin'].value}\n` +
                    `Hora de Inicio: ${form['inputHoraInicio'].value}\n` +
                    `Hora de Fin: ${form['inputHoraFin'].value}\n` +
                    `Tipo de montaje: ${form['espacio'].value}\n` +
                    `Instalación: ${form['instalacion'].value}\n` +
                    `Tipo de Coffe Break: ${form['cb'].value}\n` +
                    `Número de personas: ${form['numPersonas'].value}\n` +
                    `Comentario: ${form['comentario'].value}\n` +
                    `\n` +
                    `Mensaje de cotización:\n${mensajeCotizacion}`;
                var mailtoLink = `mailto:${correo}?subject=Cotización Evento&body=${encodeURIComponent(body)}`;
                window.location.href = mailtoLink;
            } else {
                alert("Por favor, ingresa un correo electrónico.");
            }
        });

        function calcularTotalHoras() {
            var horaInicio = $('#inputHoraInicio').val();
            var horaFin = $('#inputHoraFin').val();
            var inicio = new Date('1970-01-01T' + horaInicio + 'Z');
            var fin = new Date('1970-01-01T' + horaFin + 'Z');
            var diff = Math.abs(fin - inicio);
            var totalHoras = diff / 36e5;
            return totalHoras;
        }

        function cotizar() {
            var numPersonas = parseInt($('#inputNumPersonas').val());
            var totalHoras = calcularTotalHoras();
            var tipoCB = $('#inputCB').val();
            var espacio = 20;
            var costoPersonaExtra = 50;
            var resultado = 0;

            if (!numPersonas || numPersonas <= 0) {
                alert("Ingrese un número válido de personas.");
                return;
            }

            if (totalHoras === 0) {
                alert("Ingrese la hora de inicio y fin.");
                return;
            }
            var tipoCoffeeBreak = document.getElementById('inputCB').value;
            var personasExtras = numPersonas - espacio;

            switch (tipoCoffeeBreak) {
                case 'con Coffee Break sencillo':
                    if (numPersonas >= espacio) {
                        if (totalHoras >= 7 && totalHoras <= 10) {
                            resultado = (7 * 350) + (personasExtras * costoPersonaExtra);
                        } else if (totalHoras >= 5 && totalHoras <= 6) {
                            resultado = (5 * 400 + (totalHoras - 5) * 400) + (personasExtras * costoPersonaExtra);
                        } else if (totalHoras === 4) {
                            resultado = (4 * 450 + (totalHoras - 4) * 450) + (personasExtras * costoPersonaExtra);
                        } else if (totalHoras === 3) {
                            resultado = (3 * 450 + (totalHoras - 3) * 450) + (personasExtras * costoPersonaExtra);
                        } else if (totalHoras === 1) {
                            resultado = (1 * 550);
                        } else if (totalHoras === 2) {
                            resultado = (2 * 550);
                        } else if (totalHoras >= 11) {
                            if (numPersonas >= 20 && numPersonas <= 30) {
                                resultado = totalHoras * 300;
                            } else if (numPersonas >= 40 && numPersonas <= 70) {
                                resultado = totalHoras * 350;
                            } else {
                                resultado = 0;
                            }
                        }
                    } else if (numPersonas < espacio) {
                        if (numPersonas === 1) {
                            resultado = 70;
                        } else {
                            var personaMas = 70;
                            if (totalHoras <= 9) {
                                resultado = (numPersonas * 70) + (personasExtras * personaMas);
                            }
                        }
                    }

                    if (document.getElementById('socio').checked) {
                        if (totalHoras >= 2 && totalHoras <= 3 && numPersonas == 20) {
                            resultado = 1000;
                        } else if (totalHoras >= 1 && totalHoras <= 3 && numPersonas == 25) {
                            resultado = 1250;
                        } else if (totalHoras >= 1 && totalHoras <= 3 && numPersonas == 30) {
                            resultado = 1500;
                        } else if (totalHoras >= 1 && totalHoras <= 3 && numPersonas == 40) {
                            resultado = 2000;
                        } else if (totalHoras >= 1 && totalHoras <= 4 && numPersonas == 50) {
                            resultado = 2250;
                        } else if (totalHoras >= 1 && totalHoras <= 4 && numPersonas == 60) {
                            resultado = 2700;
                        } else if (totalHoras >= 1 && totalHoras <= 4 && numPersonas == 70) {
                            resultado = 2800;
                        } else if (totalHoras === 4 && numPersonas <= 25) {
                            resultado = 1550;
                        } else if (totalHoras === 4 && numPersonas <= 30) {
                            resultado = 1800;
                        } else if (totalHoras === 4 && numPersonas <= 40) {
                            resultado = 2050;
                        } else if (totalHoras === 4 && numPersonas == 40) {
                            resultado = 2550;
                        } else if (totalHoras >= 5 && totalHoras <= 9 && numPersonas <= 24) {
                            resultado = 2100;
                        } else if (totalHoras >= 5 && totalHoras <= 9 && numPersonas <= 29) {
                            resultado = 2350;
                        } else if (totalHoras >= 5 && totalHoras <= 9 && numPersonas <= 39) {
                            resultado = 2600;
                        } else if (totalHoras >= 5 && totalHoras <= 9 && numPersonas <= 49) {
                            resultado = 3100;
                        } else if (totalHoras >= 5 && totalHoras <= 9 && numPersonas <= 59) {
                            resultado = 3250;
                        } else if (totalHoras >= 5 && totalHoras <= 9 && numPersonas <= 69) {
                            resultado = 3350;
                        } else if (totalHoras === 1) {
                            resultado = 550;
                        }
                    }

                    if (document.getElementById('fechaInic').value) {
                        const date = new Date(document.getElementById('fechaInic').value);
                        const dayOfWeek = date.getUTCDay();

                        if (dayOfWeek === 0) {
                            if (numPersonas === 20 && totalHoras >= 1 && totalHoras <= 3) {
                                resultado = numPersonas * 78;
                            } else if (numPersonas >= 25 && numPersonas <= 29 && totalHoras >= 1 && totalHoras <= 3) {
                                resultado = numPersonas * 78;
                            } else if (numPersonas >= 30 && numPersonas <= 39 && totalHoras >= 1 && totalHoras <= 3) {
                                resultado = numPersonas * 78;
                            } else if (numPersonas >= 40 && numPersonas <= 49 && totalHoras >= 1 && totalHoras <= 3) {
                                resultado = numPersonas * 78;
                            } else if (numPersonas >= 50 && numPersonas <= 59 && totalHoras >= 1 && totalHoras <= 4) {
                                resultado = numPersonas * 73;
                            } else if (numPersonas >= 60 && numPersonas <= 69 && totalHoras >= 1 && totalHoras <= 4) {
                                resultado = numPersonas * 73;
                            } else if (numPersonas === 70 && totalHoras >= 1 && totalHoras <= 4) {
                                resultado = numPersonas * 68;
                            } else if (numPersonas >= 20 && numPersonas <= 24 && totalHoras == 4) {
                                resultado = 2810;
                            } else if (numPersonas >= 25 && numPersonas <= 29 && totalHoras == 4) {
                                resultado = 3150;
                            } else if (numPersonas >= 30 && numPersonas <= 39 && totalHoras == 4) {
                                resultado = 3490;
                            } else if (numPersonas === 40 && totalHoras == 4) {
                                resultado = 4220;
                            } else if (numPersonas >= 20 && numPersonas <= 24 && totalHoras >= 5 && totalHoras <= 9) {
                                resultado = 2810 + 550;
                            } else if (numPersonas >= 25 && numPersonas <= 29 && totalHoras >= 5 && totalHoras <= 9) {
                                resultado = 3150 + 550;
                            } else if (numPersonas >= 30 && numPersonas <= 39 && totalHoras >= 5 && totalHoras <= 9) {
                                resultado = 3490 + 550;
                            } else if (numPersonas >= 40 && numPersonas <= 49 && totalHoras >= 5 && totalHoras <= 9) {
                                resultado = 4220 + 550;
                            } else if (numPersonas >= 50 && numPersonas <= 59 && totalHoras >= 5 && totalHoras <= 9) {
                                resultado = 3650 + 550;
                            } else if (numPersonas >= 60 && numPersonas <= 69 && totalHoras >= 5 && totalHoras <= 9) {
                                resultado = 4380 + 550;
                            } else if (numPersonas === 70 && totalHoras >= 5 && totalHoras <= 9) {
                                resultado = 4760 + 550;
                            } else if (totalHoras >= 10) {
                                resultado = totalHoras * 500;
                            }
                        }
                    }
                    break;

                case 'Sin Coffee Break':
                    var tipoInstalacion = document.getElementById('inputInstalacion').value;
                    switch (tipoInstalacion) {
                        case 'Auditorio Pedro Tellería':
                            if (totalHoras === 1 && numPersonas == 20) {
                                resultado = totalHoras * 800;
                            } else if (totalHoras === 2) {
                                resultado = totalHoras * 800;
                            } else if (totalHoras === 3) {
                                resultado = totalHoras * 400 + 800;
                            } else if (totalHoras === 4) {
                                resultado = totalHoras * 400 + 800;
                            } else if (totalHoras === 5) {
                                resultado = totalHoras * 350 + 800;
                            } else if (totalHoras === 6) {
                                resultado = totalHoras * 350 + 800;
                            } else if (totalHoras === 7) {
                                resultado = totalHoras * 300 + 800;
                            } else if (totalHoras === 8) {
                                resultado = totalHoras * 300 + 800;
                            } else if (totalHoras === 9 || totalHoras === 10) {
                                resultado = totalHoras * 300 + 800;
                            } else if (numPersonas < espacio) {
                                if (numPersonas >= 1 && numPersonas <= 19) {
                                    resultado = 70;
                                } else {
                                    var personaMas = 70;
                                    if (totalHoras <= 9) {
                                        resultado = numPersonas * 70;
                                    }
                                }
                            }
                            break;

                        case 'Aula Oxxo':
                            if (totalHoras >= 1 && totalHoras <= 2) {
                                resultado = totalHoras * 450;
                            } else if (totalHoras == 3 && totalHoras <= 4) {
                                resultado = totalHoras * 400;
                            } else if (totalHoras === 5 && totalHoras <= 6) {
                                resultado = totalHoras * 350;
                            } else if (totalHoras == 7 && totalHoras <= 10) {
                                resultado = totalHoras * 300;
                            }
                            break;
                        case 'Aula Tapia':
                            if (totalHoras >= 1 && totalHoras <= 2) {
                                resultado = totalHoras * 450;
                            } else if (totalHoras == 3 && totalHoras <= 4) {
                                resultado = totalHoras * 400;
                            } else if (totalHoras === 5 && totalHoras <= 6) {
                                resultado = totalHoras * 350;
                            } else if (totalHoras == 7 && totalHoras <= 10) {
                                resultado = totalHoras * 300;
                            }
                            break;
                        default:
                            alert('Selecciona una opción');
                    }
                    break;
                case 'con Coffee Break completo':
                    if (numPersonas >= espacio) {
                        if (totalHoras === 1) {
                            resultado = (totalHoras * 800) + (personasExtras * costoPersonaExtra);
                        } else if (totalHoras === 2) {
                            resultado = (totalHoras * 750) + (personasExtras * costoPersonaExtra);
                        } else if (totalHoras >= 3 && totalHoras <= 4) {
                            resultado = (totalHoras * 450 + 700) + (personasExtras * costoPersonaExtra);
                        } else if (totalHoras >= 5 && totalHoras <= 6) {
                            resultado = (totalHoras * 400 + 650) + (personasExtras * costoPersonaExtra);
                        } else if (totalHoras >= 7 && totalHoras <= 8) {
                            resultado = (totalHoras * 350 + 600) + (personasExtras * costoPersonaExtra);
                        } else if (totalHoras >= 9 && totalHoras <= 10) {
                            resultado = (totalHoras * 350 + 550) + (personasExtras * costoPersonaExtra);
                        }
                    }

                    if (document.getElementById('socio').checked) {
                        if (totalHoras >= 1 && totalHoras <= 3 && numPersonas == 20) {
                            resultado = 1400;
                        } else if (totalHoras >= 1 && totalHoras <= 3 && numPersonas == 25) {
                            resultado = 1750;
                        } else if (totalHoras >= 1 && totalHoras <= 3 && numPersonas == 30) {
                            resultado = 1950;
                        } else if (totalHoras >= 1 && totalHoras <= 3 && numPersonas == 40) {
                            resultado = 2400;
                        } else if (totalHoras >= 1 && totalHoras <= 4 && numPersonas == 50) {
                            resultado = 3000;
                        } else if (totalHoras >= 1 && totalHoras <= 4 && numPersonas == 60) {
                            resultado = 3600;
                        } else if (totalHoras >= 1 && totalHoras <= 4 && numPersonas == 70) {
                            resultado = 4200;
                        } else if (totalHoras === 4 && numPersonas == 20) {
                            resultado = 1400 + 550;
                        } else if (totalHoras === 4 && numPersonas == 25) {
                            resultado = 2300;
                        } else if (totalHoras === 4 && numPersonas == 30) {
                            resultado = 2500;
                        } else if (totalHoras === 4 && numPersonas == 40) {
                            resultado = 2950;
                        } else if (totalHoras >= 5 && numPersonas == 20) {
                            resultado = 2200;
                        } else if (totalHoras >= 5 && numPersonas == 25) {
                            resultado = 2550;
                        } else if (totalHoras >= 5 && numPersonas == 30) {
                            resultado = 2750;
                        } else if (totalHoras >= 5 && numPersonas == 40) {
                            resultado = 3200;
                        }
                    }
                    if (document.getElementById('fechaInic').value) {
                        const date = new Date(document.getElementById('fechaInic').value);
                        const dayOfWeek = date.getUTCDay();

                        if (dayOfWeek === 0) {
                            if (numPersonas === 20 && totalHoras >= 1 && totalHoras <= 3) {
                                resultado = numPersonas * 70 + 600;
                            } else if (numPersonas >= 25 && numPersonas <= 29 && totalHoras >= 1 && totalHoras <= 3) {
                                resultado = numPersonas * 70 + 600;
                            } else if (numPersonas >= 30 && numPersonas <= 39 && totalHoras >= 1 && totalHoras <= 3) {
                                resultado = numPersonas * 70 + 600;
                            } else if (numPersonas >= 40 && numPersonas <= 49 && totalHoras >= 1 && totalHoras <= 3) {
                                resultado = numPersonas * 70 + 600;
                            } else if (numPersonas >= 50 && numPersonas <= 59 && totalHoras >= 1 && totalHoras <= 4) {
                                resultado = numPersonas * 70 + 600;
                            } else if (numPersonas >= 60 && numPersonas <= 69 && totalHoras >= 1 && totalHoras <= 4) {
                                resultado = numPersonas * 70 + 600;
                            } else if (numPersonas === 70 && totalHoras >= 1 && totalHoras <= 4) {
                                resultado = numPersonas * 70 + 600;
                            } else if (numPersonas >= 20 && numPersonas <= 24 && totalHoras == 4) {
                                resultado = 2550;
                            } else if (numPersonas >= 25 && numPersonas <= 29 && totalHoras == 4) {
                                resultado = 2900;
                            } else if (numPersonas >= 30 && numPersonas <= 39 && totalHoras == 4) {
                                resultado = 3250;
                            } else if (numPersonas === 40 && totalHoras == 4) {
                                resultado = 3950;
                            } else if (numPersonas >= 20 && numPersonas <= 24 && totalHoras >= 5 && totalHoras <= 9) {
                                resultado = 2000 + 800;
                            } else if (numPersonas >= 25 && numPersonas <= 29 && totalHoras >= 5 && totalHoras <= 9) {
                                resultado = 2350 + 800;
                            } else if (numPersonas >= 30 && numPersonas <= 39 && totalHoras >= 5 && totalHoras <= 9) {
                                resultado = 2700 + 800;
                            } else if (numPersonas >= 40 && numPersonas <= 49 && totalHoras >= 5 && totalHoras <= 9) {
                                resultado = 3400 + 800;
                            } else if (totalHoras >= 10) {
                                if (numPersonas >= 20 && numPersonas <= 29) {
                                    resultado = totalHoras * 550;
                                } else if (numPersonas >= 30 && numPersonas <= 70) {
                                    resultado = totalHoras * 600;
                                }
                            }
                        }
                    }
                    break;

                default:
                    alert('Seleccion una de las opciones!!!!')
            }

            var mensaje = "Precio de renta de instalación " + tipoCB + " de " + totalHoras.toFixed(2) + " horas: $" + resultado.toFixed(2) + " + IVA";
            $('#cotizacionResult').html(mensaje);

        }

        $(document).ready(function() {
            $('#cotizarBtn').click(function() {
                cotizar();
            });
        });
    </script>


</body>

</html>