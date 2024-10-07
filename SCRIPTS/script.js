
function cargarDiv(div, url) {
    $(div).load(url);
}

function salir() {
    Swal.fire({
        title: "¿Estas seguro que quieres salir?",
        text: "Selecciona 'Si' para salir",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, salir",
        cancelButtonText: "Cancelar",
    }).then((result) => {
        if (result.isConfirmed) {
            window.location = "logout.php";
        }
    });
}


function actualizarAula(id) {
    var nombre = $("#nombre").val();
    var correo = $("#correo").val();
    var telefono = $("#telefono").val();
    var espacio = $("#espacio").val();
    var montaje = $("#montaje").val();
    var cantPersonas = $("#cantPersonas").val();
    var fechaInic = $("#fechaInic").val();
    var fechaFin = $("#fechaFin").val();

    $.post(
        "updateAula.php",
        {
            id: id,
            nombre: nombre,
            correo: correo,
            telefono: telefono,
            espacio: espacio,
            montaje: montaje,
            cantPersonas: cantPersonas,
            fechaInic: fechaInic,
            fechaFin: fechaFin,
        },
        function (result) {
            alert(result);
            window.location.href = "consultarAulas.php";
        }
    );
}



function editar(id) {
    $.post(
        "actualizarAula.php",
        {
            id: id
        },
        function (result) {
            window.location.href = "actualizarAula.php?id=" + id;
        }
    );
}

function eliminarAula(id) {
    $.post(
        "eliminarAula.php",
        {
            id: id,
        },
        function (result) {
            alert(result);
            window.location.href = "consultarAulas.php";
        }
    );
}


function cotizacion() {
    var nombre = $("#nombre").val();
    var correo = $("#correo").val();
    var telefono = $("#telefono").val();
    var espacio = $("#espacio").val();
    var montaje = $("#montaje").val();
    var cantPersonas = $("#cantPersonas").val();
    var fechaInic = $("#fechaInic").val();
    var fechaFin = $("#fechaFin").val();

    $.post(
        "registrarAula.php",
        {
            nombre: nombre,
            correo: correo,
            telefono: telefono,
            espacio: espacio,
            montaje: montaje,
            cantPersonas: cantPersonas,
            fechaInic: fechaInic,
            fechaFin: fechaFin,
        },
        function (result) {
            alert(result);
            $("#nombre").val("");
            $("#correo").val("");
            $("#telefono").val("");
            $("#espacio").val("");
            $("#montaje").val("");
            $("cantPersonas").val("");
            $("fechaInic").val("");
            $("fechaFin").val("");
            cargarDiv($("#result"), "consultarAulas.php");
        }
    );
}



//FUNCIONES DE SERVICIOS



function guardarPonente() {
    var nombre = $("#nombre").val();
    var perfil = $("#perfil").val();
    var puesto = $("#puesto").val();
    var especialidad = $("#especialidad").val();

    if (nombre.trim() === "") {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'El nombre de la categoría no puede estar vacío!',
        });
        return;
    }

    $.post(
        "registrarPonente.php",
        {
            nombre: nombre,
            perfil: perfil,
            puesto: puesto,
            especialidad: especialidad,
        },
        function (result) {
            $("#nombre").val("");
            $("#perfil").val("");
            $("#puesto").val("");
            $("#especialidad").val("");
            Swal.fire({
                icon: 'success',
                title: 'Ponente registrado!',
                text: 'El nuevo ponnete ha sido agregada exitosamente.',
            }).then(function () {
                location.reload();
            });
        }
    ).fail(function () {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Hubo un problema al guardar la categoría. Por favor, inténtalo de nuevo más tarde.',
        });
    });
}

function guardarCategoria() {

    var nombre = $("#nombre").val();

    if (nombre.trim() === "") {

        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'El nombre de la categoría no puede estar vacío!',
        });
        return;
    }

    $.post(
        "registrarCategoria.php",
        {
            nombre: nombre,
        },
        function (result) {
            $("#nombre").val("");
            Swal.fire({
                icon: 'success',
                title: 'Categoría guardada!',
                text: 'La nueva categoría ha sido agregada exitosamente.',
            }).then(function () {
                location.reload();
            });
        }
    ).fail(function () {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Hubo un problema al guardar la categoría. Por favor, inténtalo de nuevo más tarde.',
        });
    });
}

function eliminarPonente(id) {

    $.post(
        "eliminarPonente.php",
        {
            id: id,
        },
        function (result) {
            Swal.fire({
                icon: 'error',
                title: 'Eliminado correctamente',
                text: 'Ponente eliminado de manera correcta',
            }).then(function () {
                location.reload();
            });
        }
    );
}

function eliminarfila(id) {

    $.post(
        "eliminarCategoria.php",
        {
            id: id,
        },
        function (result) {
            alert(result);
            location.reload()
        }
    );
}




function editarFila(id) {
    $.ajax({
        url: 'obtener_categoria.php?id=' + id,
        type: 'GET',
        success: function (response) {
            var categoria = JSON.parse(response);

            Swal.fire({
                title: 'Editar categoria',
                html: `
                <form id="editarCategoriaForm">

                <input type="hidden" name="id" id="id" value="${categoria.id}">

                <div class="mb-3">
                <label for="nombre" class="form-label">Nombre de la categoria:</label>
                <input type="text" class="form-control" id="nombre" name="nombre" value="${categoria.nombre}" required>
                </div>

                </form>`,
                showCancelButton: true,
                confirmButtonText: 'Actualizar',
                cancelButtonText: 'Cancelar',
                showLoaderOnConfirm: true,
                preConfirm: () => {
                    return $.ajax({
                        url: 'updateCategoria.php',
                        type: 'POST',
                        data: $('#editarCategoriaForm').serialize(),
                        dataType: 'json'
                    });
                },
                allowOutsideClick: () => !Swal.isLoading()
            }).then((result) => {
                if (result.isConfirmed && result.value.statcatus === 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'actualizado!',
                        text: result.value.message,
                        showConfirmButton: true,
                        timer: 1500
                    }).then(function () {
                        location.reload();
                    });
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    Swal.fire({
                        title: 'Cancelado',
                        icon: 'error',
                        text: 'Se cancelo la actualizacion.'
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: result.value.message
                    });
                }
            }).catch((error) => {
                console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Error al procesar la solicitud.'
                });
            });
        },
        error: function () {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Error al obtener los datos.'
            });
        }
    });
}

function editarPonente(id) {
    $.ajax({
        url: 'obtener_ponente.php?id=' + id,
        type: 'GET',
        success: function (response) {
            var ponentes = JSON.parse(response);

            Swal.fire({
                title: 'Editar Ponente',
                html: `
                <form id="editarPonenteForm">
                    <input type="hidden" name="id" id="id" value="${ponentes.id}">

                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre del Ponente</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" value="${ponentes.nombre}" required>
                </div>

                <div class="mb-3">
                    <label for="perfil" class="form-label">Perfil</label>
                    <input type="text" class="form-control" id="perfil" name="perfil" value="${ponentes.perfil}" required>
                </div>

                <div class="mb-3">
                    <label for="puesto" class="form-label">Puesto</label>
                    <input type="text" class="form-control" id="puesto" name="puesto" value="${ponentes.puesto}" required>
                </div>

                <div class="mb-3">
                    <label for="especialidad" class="form-label">Especialidad</label>
                    <input type="text" class="form-control" id="especialidad" name="especialidad" value="${ponentes.especialidad}" required>
                </div>
                
                </form>`,
                showCancelButton: true,
                confirmButtonText: 'Actualizar',
                cancelButtonText: 'Cancelar',
                showLoaderOnConfirm: true,
                preConfirm: () => {
                    return $.ajax({
                        url: 'updatePonente.php',
                        type: 'POST',
                        data: $('#editarPonenteForm').serialize(),
                        dataType: 'json'
                    });
                },
                allowOutsideClick: () => !Swal.isLoading()
            }).then((result) => {
                if (result.isConfirmed && result.value.status === 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Ponente actualizado!',
                        text: result.value.message,
                        showConfirmButton: false,
                        timer: 1500
                    }).then(function () {
                        location.reload();
                    });
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    Swal.fire({
                        title: 'Cancelado',
                        icon: 'error',
                        text: 'Se cancelo la actualizacion del ponente.'
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: result.value.message
                    });
                }
            }).catch((error) => {
                console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Error al procesar la solicitud.'
                });
            });
        },
        error: function () {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Error al obtener los datos del ponente.'
            });
        }
    });
}


function editarEvento(id) {
    $.ajax({
        url: 'obtener_evento.php?id=' + id,
        type: 'GET',
        success: function (response) {
            var evento = JSON.parse(response);

            $.ajax({
                url: 'obtener_ponente.php?type=all',
                type: 'GET',
                success: function (response) {
                    var ponentes = JSON.parse(response);

                    if (!Array.isArray(ponentes)) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Error al obtener la lista de ponentes.'
                        });
                        return;
                    }

                    var ponenteSelect = '';

                    ponentes.forEach(function (ponente) {
                        var selected = ponente.id === evento.id ? 'selected' : '';
                        ponenteSelect += `<option value="${ponente.perfil} ${ponente.nombre}" ${selected}>${ponente.perfil}${ponente.nombre}</option>`;
                    });

                    if (!evento.id) {
                        ponenteSelect = '<option value="" selected>Selecciona el ponente</option>' + ponenteSelect;
                    }

                    Swal.fire({
                        title: 'Editar Evento',
                        html: `
                            <form id="editarEventoForm">
                                <input type="hidden" name="id" id="id" value="${evento.id}">
                                <div class="mb-3">
                                    <label for="nombre_evento" class="form-label">Nombre del Evento</label>
                                    <input type="text" class="form-control" id="nombre_evento" name="nombre_evento" value="${evento.nombre_evento}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="ubicacion" class="form-label">Ubicación</label>
                                    <input type="text" class="form-control" id="ubicacion" name="ubicacion" value="${evento.ubicacion}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="ponente" class="form-label">Ponente</label>
                                    <select class="form-control" id="ponente" name="ponente" required>
                                    ${ponenteSelect}
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="fecha" class="form-label">Fecha</label>
                                    <input type="date" class="form-control" id="fecha" name="fecha" value="${evento.fecha}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="hora" class="form-label">Hora</label>
                                    <input type="time" class="form-control" id="hora" name="hora" value="${evento.hora}">
                                </div>
                                <div class="mb-3">
                                    <label for="precios" class="form-label">Precios</label>
                                    <div class="row precios">
                                        <div class="col">
                                            <div class="input-group mb-3">
                                                <span class="input-group-text">$</span>
                                                <input type="number" class="form-control precio-input" id="precio_socio" name="precio_socio" placeholder="Precio para socios Coparmex" value="${evento.precio_socio}" required>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="input-group mb-3">
                                                <span class="input-group-text">$</span>
                                                <input type="number" class="form-control precio-input" id="precio_general" name="precio_general" placeholder="Precio para publico general" value="${evento.precio_general}" required>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="input-group mb-3">
                                                <span class="input-group-text">$</span>
                                                <input type="number" class="form-control precio-input" id="precio_estudiante" name="precio_estudiante" placeholder="Precio invitado especial estudiantes" value="${evento.precio_estudiante}" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row precios">
                                        <div class="col">
                                            <div class="input-group mb-3">
                                                <span class="input-group-text">$</span>
                                                <input type="number" class="form-control precio-input" id="precio_prospecto" name="precio_prospecto" placeholder="Precio invitado especial prospecto" value="${evento.precio_prospecto}" required>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="input-group mb-3">
                                                <span class="input-group-text">$</span>
                                                <input type="number" class="form-control precio-input" id="precio_cortesia" name="precio_cortesia" placeholder="Precio cortesia" value="${evento.precio_cortesia}" required>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="input-group mb-3">
                                                <span class="input-group-text">$</span>
                                                <input type="number" class="form-control precio-input" id="precio_no_activo" name="precio_no_activo" placeholder="Precio socio no activo" value="${evento.precio_no_activo}" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        `,
                        showCancelButton: true,
                        confirmButtonText: 'Guardar',
                        cancelButtonText: 'Cancelar',
                        showLoaderOnConfirm: true,
                        preConfirm: () => {
                            return $.ajax({
                                url: 'updateEvento.php',
                                type: 'POST',
                                data: $('#editarEventoForm').serialize(),
                                dataType: 'json'
                            });
                        },
                        allowOutsideClick: () => !Swal.isLoading()
                    }).then((result) => {
                        if (result.isConfirmed && result.value.status === 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Evento actualizado!',
                                text: result.value.message,
                                showConfirmButton: false,
                                timer: 1500
                            }).then(function () {
                                location.reload();
                            });
                        } else if (result.dismiss === Swal.DismissReason.cancel) {
                            Swal.fire({
                                title: 'Cancelado',
                                icon: 'error',
                                text: 'La edición del evento ha sido cancelada.'
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: result.value.message
                            });
                        }
                    }).catch((error) => {
                        console.error('Error:', error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Error al procesar la solicitud.'
                        });
                    });

                    function actualizarHora() {
                        var precioSocio = $('#precio_socio').val();
                        var precioGeneral = $('#precio_general').val();
                        var precioEstudiante = $('#precio_estudiante').val();
                        var precioProspecto = $('#precio_prospecto').val();
                        var precioCortesia = $('#precio_cortesia').val();
                        var precioNoActivo = $('#precio_no_activo').val();

                        var preciosConcatenados = precioSocio + ',' + precioGeneral + ',' + precioEstudiante + ',' + precioProspecto + ',' + precioCortesia + ',' + precioNoActivo;

                        $('#hora').val(preciosConcatenados);
                    }

                    $('.precio-input').on('input', actualizarHora);
                },
                error: function () {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Error al obtener la lista de ponentes.'
                    });
                }
            });
        },
        error: function () {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Error al obtener los datos del evento.'
            });
        }
    });
}




function eliminarEvento(id) {
    $.post(
        "eliminarEvento.php",
        {
            id: id,
        },
        function (result) {
            Swal.fire({
                icon: 'error',
                title: 'Eliminado correctamente',
                text: 'El evento se eliminó de manera correcta',
            }).then(function () {
                location.reload();
            });
        }
    );
}

function guardarEvento() {
    var nombre_evento = $("#nombre_evento").val();
    var tipo = $("#tipo").val();
    var modo = $("#modo").val();
    var categoria = $("#categoria").val();
    var ubicacion = $("#ubicacion").val();
    var fecha = $("#fecha").val();
    var hora = $("#hora").val();
    var gratis = $("#gratis").is(":checked") ? 1 : 0;
    var precio_socio = $("#precio_socio").val();
    var precio_general = $("#precio_general").val();
    var precio_estudiante = $("#precio_estudiante").val();
    var precio_prospecto = $("#precio_prospecto").val();
    var precio_cortesia = $("#precio_cortesia").val();
    var precio_no_activo = $("#precio_no_activo").val();
    var ponente = $("#ponente").val();
    var link_zoom = $("#link_zoom").val();
    var comentario = $("#comentario").val();
    var archivo = $("#archivo").val();

    $.post(
        "registrarEvento.php", {
        nombre_evento: nombre_evento,
        tipo: tipo,
        modo: modo,
        categoria: categoria,
        ubicacion: ubicacion,
        fecha: fecha,
        hora: hora,
        gratis: gratis,
        precio_socio: precio_socio,
        precio_general: precio_general,
        precio_estudiante: precio_estudiante,
        precio_prospecto: precio_prospecto,
        precio_cortesia: precio_cortesia,
        precio_no_activo: precio_no_activo,
        ponente: ponente,
        link_zoom: link_zoom,
        comentario: comentario,
        archivo: archivo,
    },
        function (result) {
            $("#nombre_evento").val("");
            $("#tipo").val("");
            $("#modo").val("");
            $("#categoria").val("");
            $("#ubicacion").val("");
            $("#fecha").val("");
            $("#hora").val("");
            $("#gratis").prop("checked", false);
            $("#precio_socio").val("");
            $("#precio_general").val("");
            $("#precio_estudiante").val("");
            $("#precio_prospecto").val("");
            $("#precio_cortesia").val("");
            $("#precio_no_activo").val("");
            $("#ponente").val("");
            $("#link_zoom").val("");
            $("#comentario").val("");
            $("#archivo").val("");
            cargarDiv($("#result"), "listaEventos.php");
            Swal.fire({
                icon: 'success',
                title: 'Evento guardado!',
                text: 'El nuevo evento ha sido agregado exitosamente.',
            }).then(function () {
                location.reload();
            });
        }
    );
}



// document.addEventListener('DOMContentLoaded', function () {
//     const gratisElement = document.getElementById('gratis');
//     const nombreEventoElement = document.getElementById('nombre_evento');

//     if (nombreEventoElement) {
//         nombreEventoElement.addEventListener('change', function () {
//             const selectedOption = nombreEventoElement.options[nombreEventoElement.selectedIndex];
//             const isInterno = selectedOption.getAttribute('interno') === '1';

//             if (isInterno) {
//                 gratisElement.style.display = 'none';
//             } else {
//                 gratisElement.style.display = '';
//             }
//         });
//     } else {
//         console.error('Elemento con id "nombre_evento" no encontrado en el DOM');
//     }
// });


document.addEventListener('DOMContentLoaded', function () {
    const gratisElement = document.getElementById('gratis');

    if (gratisElement) {
        gratisElement.addEventListener('change', gratis);
    }
});

function gratis() {
    const precios = document.querySelectorAll('.precios');
    if (this.checked) {
        precios.forEach(precio => precio.style.display = 'none');
        document.getElementById('precio_socio').removeAttribute('required');
        document.getElementById('precio_general').removeAttribute('required');
        document.getElementById('precio_estudiante').removeAttribute('required');
        document.getElementById('precio_prospecto').removeAttribute('required');
        document.getElementById('precio_cortesia').removeAttribute('required');
        document.getElementById('precio_no_activo').removeAttribute('required');
    } else {
        precios.forEach(precio => precio.style.display = 'flex');
        document.getElementById('precio_socio').setAttribute('required', 'required');
        document.getElementById('precio_general').setAttribute('required', 'required');
        document.getElementById('precio_estudiante').setAttribute('required', 'required');
        document.getElementById('precio_prospecto').setAttribute('required', 'required');
        document.getElementById('precio_cortesia').setAttribute('required', 'required');
        document.getElementById('precio_no_activo').setAttribute('required', 'required');
    }
}

function cancelar() {
    Swal.fire({
        title: "¿Estas seguro que quieres cancelar la actualización?",
        text: "Selecciona 'Si' para cancelar",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, cancelar",
        cancelButtonText: "Cancelar",
    }).then((result) => {
        if (result.isConfirmed) {
            window.location = "consultarAulas.php";
        }
    });
}

function cancelarPerfil() {
    Swal.fire({
        title: "¿Estas seguro que quieres cancelar la actualización?",
        text: "Selecciona 'Si' para cancelar",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, cancelar",
        cancelButtonText: "Cancelar",
    }).then((result) => {
        if (result.isConfirmed) {
            window.location = "sidebar.php";
        }
    });
}

// FUNCION PARA QUE SE GUARDE LA IMAGEN DENTRO DE SIDEBAR...........
window.onload = function () {
    const savedImage = localStorage.getItem("logoImage");
    if (savedImage) {
        const logoImage = document.getElementById("logoImage");
        if (logoImage) {
            logoImage.src = savedImage;
        }
    }
};
// SCRIPTS PARA PODER REALIZAR EL CAMBIO DE IMAGEN DE PERFIL..... 
document.getElementById("inputGroupFile02").addEventListener("change", function (event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function (e) {
            const imgElement = document.getElementById("uploadedImage");
            imgElement.src = e.target.result;
            imgElement.style.display = "block";
            document.getElementById("buttons").style.display = "block";
        };
        reader.readAsDataURL(file);
    }
});

// EN ESTA SECCION SE RECARGA LA PAGINA AUTOMATICAMENTE CUANDO SE HACE EL CAMBIO DE FOTO.....
document.getElementById("confirmButton").addEventListener("click", function () {
    const uploadedImageSrc = document.getElementById("uploadedImage").src;
    if (uploadedImageSrc) {
        localStorage.setItem("logoImage", uploadedImageSrc);
        location.reload();
    }
});

// SE RECARGA LA PAGINA SI DESEAS CANCELAR LA ACCIÓN....
document.getElementById("cancelButton").addEventListener("click", function () {
    location.reload();
});

// FUNCION PARA IMPRIMIR LA TABLA
function imprimirTabla() {
    var printContent = document.getElementById("tablaContainer").innerHTML;
    var originalContent = document.body.innerHTML;

    document.body.innerHTML = printContent;
    window.print();

    document.body.innerHTML = originalContent;
    window.location.reload();
}


// FUNCION QUE SIRVE PARA VISUALIZAR LA CONTRASEÑA...
document
    .getElementById("togglePassword")
    .addEventListener("click", function (e) {
        const passwordField = document.getElementById("inputPassword4");
        const type =
            passwordField.getAttribute("type") === "password" ? "text" : "password";
        passwordField.setAttribute("type", type);
        this.textContent = type === "password" ? "Mostrar" : "Ocultar";
    });

    
function nuevoUsuario() {
    var nombre = $("#nombre").val();
    var apP = $("#apP").val();
    var apM = $("#apM").val();
    var correo = $("#correo").val();
    var contraseña = $("#contraseña").val();

    $.post(
        "registrarUsuario.php",
        {
            nombre: nombre,
            apP: apP,
            apM: apM,
            correo: correo,
            contraseña: contraseña
        },
        function (result) {
            alert(result);
            $("#nombre").val("");
            $("#apP").val("");
            $("#apM").val("");
            $("#correo").val("");
            $("#contraseña").val("");
            cargarDiv($("#contenido"), "nuevoUsuario.php");
        }
    );
}

function actualizarPerfil() {
    var nombre = $("#nombre").val();
    var apP = $("#apP").val();
    var apM = $("#apM").val();
    var correo = $("#correo").val();
    var contraseña = $("#contraseña").val();

    $.post(
        "updatePerfil.php",
        {
            nombre: nombre,
            apP: apP,
            apM: apM,
            correo: correo,
            contraseña: contraseña,
        },
        function (result) {
            alert(result);
            cargarDiv($("#contenido"), "actualizarPerfil.php");
        }
    );
};

function editarParticipante(id) {
    $.ajax({
        url: 'obtenerParticipantes.php?id=' + id,
        type: 'GET',
        success: function (response) {
            var participante = JSON.parse(response);

            Swal.fire({
                title: 'Editar participante',
                html: `
                <form id="editarParticipantesForm">
                    <input type="hidden" name="id" id="id" value="${participante.id}">

                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre:</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" value="${participante.nombre}" required>
                    </div>

                    <div class="mb-3">
                        <label for="correo" class="form-label">Correo:</label>
                        <input type="email" class="form-control" id="correo" name="correo" value="${participante.correo}" required>
                    </div>

                    <div class="mb-3">
                        <label for="telefono" class="form-label">Teléfono:</label>
                        <input type="phone" class="form-control" id="telefono" name="telefono" value="${participante.telefono}">
                    </div>

                </form>`,
                showCancelButton: true,
                confirmButtonText: 'Actualizar',
                cancelButtonText: 'Cancelar',
                showLoaderOnConfirm: true,
                preConfirm: () => {
                    return $.ajax({
                        url: 'updateParticipantes.php',
                        type: 'POST',
                        data: $('#editarParticipantesForm').serialize(),
                        dataType: 'json'
                    });
                },
                allowOutsideClick: () => !Swal.isLoading()
            }).then((result) => {
                if (result.isConfirmed && result.value.status === 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: '¡Actualizado!',
                        text: result.value.message,
                        showConfirmButton: false,
                        timer: 1500
                    }).then(function () {
                        location.reload();
                    });
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    Swal.fire({
                        title: 'Cancelado',
                        icon: 'info',
                        text: 'La actualización ha sido cancelada.'
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: result.value.message
                    });
                }
            }).catch((error) => {
                console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Error al procesar la solicitud.'
                });
            });
        },
        error: function () {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Error al obtener los datos.'
            });
        }
    });
}

function eliminarParticipante(id) {

    $.post(
        "eliminarParticipante.php",
        {
            id: id,
        },
        function (result) {
            Swal.fire({
                icon: 'error',
                title: 'Eliminado correctamente',
                text: 'Se ha eliminado de manera correcta',
            }).then(function () {
                location.reload();
            });
        }
    );
}

function toggleActivo(id) {

    var nombreElemento = document.getElementById('nombre-' + id);
    var isCurrentlyActive = !nombreElemento.classList.contains('inactive');

    Swal.fire({
        title: '¿Estás seguro?',
        text: isCurrentlyActive ? "¿Quieres dar de baja al participante?" : "¿Quieres dar de alta al participante?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, cambiar estado',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {

            var isActive = !nombreElemento.classList.toggle('inactive');

            $.ajax({
                type: "POST",
                url: "actualizar_estado.php",
                data: {
                    id: id,
                    activo: isActive ? 0 : 1
                },
                success: function (response) {
                    console.log("Estado actualizado: " + response);
                    Swal.fire(
                        'Actualizado',
                        'El estado ha sido actualizado.',
                        'success'
                    );
                },
                error: function (error) {
                    console.error("Error al actualizar el estado: " + error);
                    Swal.fire(
                        'Error',
                        'Hubo un problema al actualizar el estado.',
                        'error'
                    );
                }
            });
        }
    });
}

document.addEventListener('DOMContentLoaded', function () {
    const botones = document.querySelectorAll('.btn-secondary');
    botones.forEach(boton => {
        boton.addEventListener('click', function () {
            toggleActivo(this.getAttribute('data-id'));
        });
    });
});



function togglePagado(id) {
    var button = event.target;
    var nombreElement = document.getElementById('nombre-' + id);
    const isCurrentlyAdeudo = nombreElement.classList.contains('adeudo');

    Swal.fire({
        title: '¿Estás seguro?',
        text: isCurrentlyAdeudo ? "¿Cambiar con aduedo?" : "¿Cambiar el estado del participante a pagado?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, cambiar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {

            var isPagado = !nombreElement.classList.toggle('adeudo');

            if (isPagado) {
                button.classList.add('btn-red');
            } else {
                button.classList.remove('btn-red');
            }
            $.ajax({
                type: "POST",
                url: "actualizar_estado.php",
                data: {
                    id: id,
                    pagado: isPagado ? 0 : 1
                },
                success: function (response) {
                    console.log("Estado actualizado: " + response);
                    Swal.fire(
                        'Actualizado',
                        'El estado ha sido actualizado.',
                        'success'
                    );
                },
                error: function (error) {
                    console.error("Error al actualizar el estado: " + error);
                    Swal.fire(
                        'Error',
                        'Hubo un problema al actualizar el estado.',
                        'error'
                    );
                }
            });
        };
    });
};



// FUNCION PARA EL REGISTRO DE LOS SOSCIOS..........

// function guardarSocio() {
//     var fechaAfiliacion = $("#fechaAfiliacion").val();
//     var razonSocial = $("#razonSocial").val();
//     var RFC = $("#RFC").val();
//     var nombreComercial = $("#nombreComercial").val();
//     var calle = $("#calle").val();
//     var numero = $("#numero").val();
//     var colonia = $("#colonia").val();
//     var cp = $("#cp").val();
//     var estado = $("#estado").val();
//     var municipio = $("#municipio").val();
//     var telefonoEmpresa1 = $("#telefonoEmpresa1").val();
//     var sectorEstrategico = $("#sectorEstrategico").val();
//     var giro = $("#giro").val();
//     var giroGeneral = $("#giroGeneral").val();
//     var noColaboradores = $("#noColaboradores").val();
//     var rangoVentas = $("#rangoVentas").val();
//     var tamaño = $("#tamaño").val();
//     var queVende = $("#queVende").val();
//     var queCompra = $("#queCompra").val();
//     var cuota = $("#cuota").val();
//     var mesFactura = $("#mesFactura").val();
//     var ejecutivoAfilio = $("#ejecutivoAfilio").val();
//     var diaAniversario = $("#diaAniversario").val();
//     var mesAniversario = $("#mesAniversario").val();
//     var nombreAsociado = $("#nombreAsociado").val();
//     var curpAsociado = $("#curpAsociado").val();
//     var diaCumpleAsociado = $("#diaCumpleAsociado").val();
//     var mesCumpleAsociado = $("#mesCumpleAsociado").val();
//     var correoAsociado1 = $("#correoAsociado1").val();
//     var correoAsociado2 = $("#correoAsociado2").val();
//     var celularAsociado = $("#celularAsociado").val();
//     var telOficinaAsociado = $("#telOficinaAsociado").val();
//     var extensionAsociado = $("#extensionAsociado").val();
//     var perfilAsociado = $("#perfilAsociado").val();
//     var generoAsociado = $("#generoAsociado").val();
//     var nombreRepresentante = $("#nombreRepresentante").val();
//     var curpRepresentante = $("#curpRepresentante").val();
//     var diaCumpleRepresentante = $("#diaCumpleRepresentante").val();
//     var mesCumpleRepresentante = $("#mesCumpleRepresentante").val();
//     var correoRepresentante1 = $("#correoRepresentante1").val();
//     var correoRepresentante2 = $("#correoRepresentante2").val();
//     var celularRepresentante = $("#celularRepresentante").val();
//     var telOficinaRepresentante = $("#telOficinaRepresentante").val();
//     var extensionRepresentante = $("#extensionRepresentante").val();
//     var perfilRepresentante = $("#perfilRepresentante").val();
//     var generoRepresentante = $("#generoRepresentante").val();
//     var nombreAsistente = $("#nombreAsistente").val();
//     var correoAsistente1 = $("#correoAsistente1").val();
//     var celularAsistente = $("#celularAsistente").val();
//     var nombreFinanzas = $("#nombreFinanzas").val();
//     var correoFinanzas1 = $("#correoFinanzas1").val();
//     var celularFinanzas = $("#celularFinanzas").val();
//     var nombreRecursosHumanos = $("#nombreRecursosHumanos").val();
//     var correoRecursosHumanos1 = $("#correoRecursosHumanos1").val();
//     var celularRecursosHumanos = $("#celularRecursosHumanos").val();
//     var comentario = $("#comentario").val();
//     var logotipo = $("#logotipo").val();

//     const inputs = document.querySelectorAll('input, textarea, select');

//     for (let input of inputs) {
//         if (input.value.trim() === "") {
//             Swal.fire({
//                 icon: 'error',
//                 title: 'Oops...',
//                 text: 'Completa todos los campos!',
//             });
//             return;
//         }
//     }
    
//     $.post(
//         "registrarSocio.php", {
//         fechaAfiliacion: fechaAfiliacion,
//         razonSocial: razonSocial,
//         RFC: RFC,
//         nombreComercial: nombreComercial,
//         calle: calle,
//         numero: numero,
//         colonia: colonia,
//         cp: cp,
//         estado: estado,
//         municipio: municipio,
//         telefonoEmpresa1: telefonoEmpresa1,
//         sectorEstrategico: sectorEstrategico,
//         giro: giro,
//         giroGeneral: giroGeneral,
//         noColaboradores: noColaboradores,
//         rangoVentas: rangoVentas,
//         tamaño: tamaño,
//         queVende: queVende,
//         queCompra: queCompra,
//         cuota: cuota,
//         mesFactura: mesFactura,
//         ejecutivoAfilio: ejecutivoAfilio,
//         diaAniversario: diaAniversario,
//         mesAniversario: mesAniversario,
//         nombreAsociado: nombreAsociado,
//         curpAsociado: curpAsociado,
//         diaCumpleAsociado: diaCumpleAsociado,
//         mesCumpleAsociado: mesCumpleAsociado,
//         correoAsociado1: correoAsociado1,
//         correoAsociado2: correoAsociado2,
//         celularAsociado: celularAsociado,
//         telOficinaAsociado: telOficinaAsociado,
//         extensionAsociado: extensionAsociado,
//         perfilAsociado: perfilAsociado,
//         generoAsociado: generoAsociado,
//         nombreRepresentante: nombreRepresentante,
//         curpRepresentante: curpRepresentante,
//         diaCumpleRepresentante: diaCumpleRepresentante,
//         mesCumpleRepresentante: mesCumpleRepresentante,
//         correoRepresentante1: correoRepresentante1,
//         correoRepresentante2: correoRepresentante2,
//         celularRepresentante: celularRepresentante,
//         telOficinaRepresentante: telOficinaRepresentante,
//         extensionRepresentante: extensionRepresentante,
//         perfilRepresentante: perfilRepresentante,
//         generoRepresentante: generoRepresentante,
//         nombreAsistente: nombreAsistente,
//         correoAsistente1: correoAsistente1,
//         celularAsistente: celularAsistente,
//         nombreFinanzas: nombreFinanzas,
//         correoFinanzas1: correoFinanzas1,
//         celularFinanzas: celularFinanzas,
//         nombreRecursosHumanos: nombreRecursosHumanos,
//         correoRecursosHumanos1: correoRecursosHumanos1,
//         celularRecursosHumanos: celularRecursosHumanos,
//         comentario: comentario,
//         logotipo: logotipo,
//     },
//         function (result) {
//             $("#fechaAfiliacion").val("");
//             $("#razonSocial").val("");
//             $("#RFC").val("");
//             $("#nombreComercial").val("");
//             $("#calle").val("");
//             $("#numero").val("");
//             $("#colonia").val("");
//             $("#cp").val("");
//             $("#estado").val("");
//             $("#municipio").val("");
//             $("#telefonoEmpresa1").val("");
//             $("#sectorEstrategico").val("");
//             $("#giro").val("");
//             $("#giroGeneral").val("");
//             $("#noColaboradores").val("");
//             $("#rangoVentas").val("");
//             $("#tamaño").val("");
//             $("#queVende").val("");
//             $("#queCompra").val("");
//             $("#cuota").val("");
//             $("#mesFactura").val("");
//             $("#ejecutivoAfilio").val("");
//             $("#diaAniversario").val("");
//             $("#mesAniversario").val("");
//             $("#nombreAsociado").val("");
//             $("#curpAsociado").val("");
//             $("#diaCumpleAsociado").val("");
//             $("#mesCumpleAsociado").val("");
//             $("#correoAsociado1").val("");
//             $("#correoAsociado2").val("");
//             $("#celularAsociado").val("");
//             $("#telOficinaAsociado").val("");
//             $("#extensionAsociado").val("");
//             $("#perfilAsociado").val("");
//             $("#generoAsociado").val("");
//             $("#nombreRepresentante").val("");
//             $("#curpRepresentante").val("");
//             $("#diaCumpleRepresentante").val("");
//             $("#mesCumpleRepresentante").val("");
//             $("#correoRepresentante1").val("");
//             $("#correoRepresentante2").val("");
//             $("#celularRepresentante").val("");
//             $("#telOficinaRepresentante").val("");
//             $("#extensionRepresentante").val("");
//             $("#perfilRepresentante").val("");
//             $("#generoRepresentante").val("");
//             $("#nombreAsistente").val("");
//             $("#correoAsistente1").val("");
//             $("#celularAsistente").val("");
//             $("#nombreFinanzas").val("");
//             $("#correoFinanzas1").val("");
//             $("#celularFinanzas").val("");
//             $("#nombreRecursosHumanos").val("");
//             $("#correoRecursosHumanos1").val("");
//             $("#celularRecursosHumanos").val("");
//             $("#comentario").val("");
//             $("#logotipo").val("");
//             cargarDiv($("#result"), "listaSocios.php");

//             Swal.fire({
//                 icon: 'success',
//                 title: 'Socio registrado!',
//                 text: 'El nuevo socio ha sido agregado exitosamente.',
//             }).then(function () {
//                 location.reload();
//             });
//         }
//     ).fail(function () {
//         Swal.fire({
//             icon: 'error',
//             title: 'Error',
//             text: 'Hubo un problema al guardar el socio. Por favor, inténtalo de nuevo más tarde.'
//         });
//     });
// }

// function siDatos() {
//     const mismoDatos = document.getElementById("mismosDatosRepresentante").value;
//     const fields = [
//         "nombreRepresentante",
//         "curpRepresentante",
//         "diaCumpleRepresentante",
//         "mesCumpleRepresentante",
//         "correoRepresentante1",
//         "correoRepresentante2",
//         "celularRepresentante",
//         "telOficinaRepresentante",
//         "extensionRepresentante",
//         "perfilRepresentante",
//         "generoRepresentante"
//     ];
    
//     const sourceFields = [
//         "nombreAsociado",
//         "curpAsociado",
//         "diaCumpleAsociado",
//         "mesCumpleAsociado",
//         "correoAsociado1",
//         "correoAsociado2",
//         "celularAsociado",
//         "telOficinaAsociado",
//         "extensionAsociado",
//         "perfilAsociado",
//         "generoAsociado"
//     ];
    
//     if (mismoDatos === "Si") {
//         fields.forEach((field, index) => {
//             document.getElementById(field).value = document.getElementById(sourceFields[index]).value;
//         });
//     } else {
//         fields.forEach(field => {
//             document.getElementById(field).value = "";
//         });
//     }
// }


  