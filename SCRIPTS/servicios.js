

//FUNCIONES CRUD
function guardarServicios() {
 
    var fecha = $("#fecha").val();
    var categoria = $("#categoria").val();
    var socio = $("#socio").val();
    var nombre = $("#nombre").val();
    var costo = $("#costo").val();
    var comentario = $("#comentario").val();
   
     var estado = $('#estado').is(':checked') ? 1 : 0;


    if (nombre.trim() === "") {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'No pueden quedar espacios sin completar!',
        });
        return;
    }

  
    $.post(
        "registrarservicio.php",
        {
            fecha: fecha,
            categoria: categoria,
            socio: socio,
            nombre: nombre,
            costo: costo,
            comentario: comentario
        },
        function(result) {
            
            $("#fecha").val("");
            $("#categoria").val("");
            $("#socio").val("");
            $("#nombre").val("");
            $("#costo").val("0");
            $("#comentario").val("");

            Swal.fire({
                icon: 'success',
                title: '¡Servicio registrado!',
                text: 'El nuevo servicio ha sido guardado exitosamente.',
            }).then(function() {
            
                cargarDatos(); 
                location.reload();
            });
        }
    ).fail(function() {
        
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Hubo un problema al guardar el servicio. Por favor, inténtalo de nuevo más tarde.',
        });
    });
}


function eliminarServicio(id) {
    Swal.fire({
        title: '¿Estás seguro?',
        text: "No podrás deshacer esta acción",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, eliminarlo',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            $.post(
                "eliminarServicio.php",
                {
                    id: id,
                },
                function (result) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Eliminado correctamente',
                        text: 'El evento se eliminó de manera correcta',
                    }).then(function () {
                        location.reload();
                    });
                }
            );
        }
    });
}


function editarServicios(id) {
    $.ajax({
        url: 'obtenerServicios.php?id=' + id,
        type: 'GET',
        success: function (response) {
            var servicio = JSON.parse(response);

            Swal.fire({
                title: 'Editar Servicio',
                html: `
                  <form id="editarServicioForm">
                    <input type="hidden" name="id" id="id" value="${servicio.id}">
                    <div class="mb-3">
                        <label for="fecha" class="form-label">Fecha</label>
                        <input type="date" class="form-control" id="fecha" name="fecha" value="${servicio.fecha}" required>
                    </div>
                    <div class="mb-3">
                        <label for="categoria" class="form-label">Categoría</label>
                        <input type="text" class="form-control" id="categoria" name="categoria" value="${servicio.categoria}" required>
                    </div>
                    <div class="mb-3">
                        <label for="socio" class="form-label">Socio</label>
                        <input type="text" class="form-control" id="socio" name="socio" value="${servicio.socio}" required>
                    </div>
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre de quien solicitó el servicio</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" value="${servicio.nombre}" required>
                    </div>
                    <div class="mb-3">
                        <label for="costo" class="form-label">Costo</label>
                        <input type="number" step="0.01" class="form-control" id="costo" name="costo" value="${servicio.costo}" required>
                    </div>
                    <div class="mb-3">
                        <label for="comentario" class="form-label">Comentario</label>
                        <textarea class="form-control" id="comentario" name="comentario" required>${servicio.comentario}</textarea>
                    </div>
                </form>`,
                showCancelButton: true,
                confirmButtonText: 'Actualizar',
                cancelButtonText: 'Cancelar',
                showLoaderOnConfirm: true,
                preConfirm: () => {
                    return $.ajax({
                        url: 'actualizarServicios.php',
                        type: 'POST',
                        data: $('#editarServicioForm').serialize(),
                        dataType: 'json'
                    });
                },
                allowOutsideClick: () => !Swal.isLoading()
            }).then((result) => {
                if (result.isConfirmed && result.value.status === 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Servicio actualizado!',
                        text: result.value.message,
                        showConfirmButton: false,
                        timer: 1500
                    });

                  
                    var row = $('tr').filter(function() {
                        return $(this).find('td:first').text() == id; 
                    });

                    row.find('td:nth-child(2)').html(`
                        <span class='text-content'>Fecha: ${$('#fecha').val()}</span><br>
                        <span class='text-content'>Categoría: ${$('#categoria').val()}</span><br>
                        <span class='text-content'>Socio: ${$('#socio').val()}</span><br>
                        <span class='text-content'>Nombre: ${$('#nombre').val()}</span><br>
                        <span class='text-content'>Costo: ${$('#costo').val()}</span><br>
                        <span class='text-content'>Comentario: ${$('#comentario').val()}</span>
                    `);
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    Swal.fire({
                        title: 'Cancelado',
                        icon: 'error',
                        text: 'Se canceló la actualización del servicio.'
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
                text: 'Error al obtener los datos del servicio.'
            });
        }
    });
}

function editarServicio(id) {
    $.ajax({
        url: 'obtenerServicios.php?id=' + id,
        type: 'GET',
        success: function (response) {
            var servicio = JSON.parse(response);

           
            $.when(
                $.ajax({ url: 'obtenerCategorias.php', type: 'GET', dataType: 'json' }),
                $.ajax({ url: 'obtenerSocios.php', type: 'GET', dataType: 'json' })
            ).done(function (categoriasResponse, sociosResponse) {
                var categorias = categoriasResponse[0];
                var socios = sociosResponse[0];

                var categoriaOptions = categorias.map(cat => `<option value="${cat.id}" ${cat.id === servicio.categoria ? 'selected' : ''}>${cat.nombre}</option>`).join('');
                var socioOptions = socios.map(socio => `<option value="${socio.id}" ${socio.id === servicio.socio ? 'selected' : ''}>${socio.nombreComercial}</option>`).join('');

                Swal.fire({
                    title: 'Editar Servicio',
                    html: `
                      <form id="editarServicioForm">
                        <input type="hidden" name="id" id="id" value="${servicio.id}">
                        <div class="mb-3">
                            <label for="fecha" class="form-label">Fecha</label>
                            <input type="date" class="form-control" id="fecha" name="fecha" value="${servicio.fecha}" required>
                        </div>
                        <div class="mb-3">
                            <label for="categoria" class="form-label">Categoría</label>
                            <select class="form-control" id="categoria" name="categoria" required>
                                ${categoriaOptions}
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="socio" class="form-label">Socio</label>
                            <select class="form-control" id="socio" name="socio" required>
                                ${socioOptions}
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre de quien solicitó el servicio</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" value="${servicio.nombre}" required>
                        </div>
                        <div class="mb-3">
                            <label for="costo" class="form-label">Costo</label>
                            <input type="number" step="0.01" class="form-control" id="costo" name="costo" value="${servicio.costo}" required>
                        </div>
                        <div class="mb-3">
                            <label for="comentario" class="form-label">Comentario</label>
                            <textarea class="form-control" id="comentario" name="comentario" required>${servicio.comentario}</textarea>
                        </div>
                    </form>`,
                    showCancelButton: true,
                    confirmButtonText: 'Actualizar',
                    cancelButtonText: 'Cancelar',
                    showLoaderOnConfirm: true,
                    preConfirm: () => {
                        return $.ajax({
                            url: 'actualizarServicios.php',
                            type: 'POST',
                            data: $('#editarServicioForm').serialize(),
                            dataType: 'json'
                        });
                    },
                    allowOutsideClick: () => !Swal.isLoading()
                }).then((result) => {
                    if (result.isConfirmed && result.value.status === 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Servicio actualizado!',
                            text: result.value.message,
                            showConfirmButton: false,
                            timer: 1500
                            
                        });

                        
                        var row = $('#servicio_' + id);

                        // Actualiza solo el contenido sin eliminar la fila
                        row.find('td:nth-child(2)').html(`
                            <span class='text-content'>Fecha: ${$('#fecha').val()}</span><br>
                            <span class='text-content'>Categoría: ${$('#categoria option:selected').text()}</span><br>
                            <span class='text-content'>Socio: ${$('#socio option:selected').text()}</span><br>
                            <span class='text-content'>Nombre: ${$('#nombre').val()}</span><br>
                            <span class='text-content'>Costo: ${$('#costo').val()}</span><br>
                            <span class='text-content'>Comentario: ${$('#comentario').val()}</span>
                        `);
                    } else if (result.dismiss === Swal.DismissReason.cancel) {
                        Swal.fire({
                            title: 'Cancelado',
                            icon: 'error',
                            text: 'Se canceló la actualización del servicio.'
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
            }).fail(function () {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Error al obtener las categorías o socios.'
                });
            });
        },
        error: function () {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Error al obtener los datos del servicio.'
            });
        }
    });
}




//MOTOR DE BUSQUEDA
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const table = document.querySelector('.table');
    const rows = table.querySelectorAll('tbody tr');

    searchInput.addEventListener('input', function() {
        const query = searchInput.value.toLowerCase();

        rows.forEach(row => {
            const cells = row.querySelectorAll('td');
            const matches = Array.from(cells).some(cell => 
                cell.textContent.toLowerCase().includes(query)
            );
            row.style.display = matches ? '' : 'none';
        });
    });
});

//PAGINACION

    document.addEventListener('DOMContentLoaded', function() {
        const rowsPerPage = 3; 
        const table = document.querySelector('.table');
        const rows = Array.from(table.querySelectorAll('tbody tr'));
        const totalPages = Math.ceil(rows.length / rowsPerPage);
        let currentPage = 1;

        const paginationContainer = document.getElementById('pagination');
        const pageNumbersContainer = document.getElementById('pageNumbers');
        const prevButton = document.getElementById('prevPage');
        const nextButton = document.getElementById('nextPage');

        function displayPage(page) {
            
            const startIndex = (page - 1) * rowsPerPage;
            const endIndex = page * rowsPerPage;

           
            rows.forEach((row, index) => {
                row.style.display = (index >= startIndex && index < endIndex) ? '' : 'none';
            });

            prevButton.disabled = page === 1;
            nextButton.disabled = page === totalPages;
            updatePageNumbers();
        }

        function updatePageNumbers() {
            pageNumbersContainer.innerHTML = '';

            for (let i = 1; i <= totalPages; i++) {
                const pageButton = document.createElement('button');
                pageButton.textContent = i;
                pageButton.className = 'pagination-button';
                pageButton.dataset.page = i;
                if (i === currentPage) {
                    pageButton.classList.add('active');
                }
                pageButton.addEventListener('click', () => goToPage(i));
                pageNumbersContainer.appendChild(pageButton);
            }
        }

        function goToPage(page) {
            if (page < 1) page = 1;
            if (page > totalPages) page = totalPages;
            currentPage = page;
            displayPage(currentPage);
        }

        prevButton.addEventListener('click', function() {
            goToPage(currentPage - 1);
        });

        nextButton.addEventListener('click', function() {
            goToPage(currentPage + 1);
        });

       
        displayPage(currentPage);
    });


//CAMBIAR ESTADO

function darBaja(id) {
    var checkbox = document.getElementById('checkbox' + id);
    var row = checkbox.closest('tr');
    var textContents = row.querySelectorAll('.text-content');

    if (checkbox) {
        var isChecked = checkbox.checked;
        var nuevoEstado = isChecked ? 1 : 0;

        $.ajax({
            url: 'actualizar_estado_servicios.php',
            type: 'POST',
            data: {
                id: id,
                activo: nuevoEstado
            },
            success: function(response) {
                if (response === 'success') {
                    localStorage.setItem('checkbox' + id, isChecked);

                    textContents.forEach(function(span) {
                        if (isChecked) {
                            span.classList.remove('inactive');
                        } else {
                            span.classList.add('inactive');
                        }
                    });
                } else {
                    console.error('Error al actualizar el estado en la base de datos.');
                }
            },
            error: function() {
                console.error('Error en la petición AJAX.');
            }
        });
    } else {
        console.error("Checkbox with ID 'checkbox" + id + "' not found.");
    }
}

document.addEventListener('DOMContentLoaded', function() {
    var checkboxes = document.querySelectorAll('input[type=checkbox]');
    checkboxes.forEach(function(checkbox) {
        var id = checkbox.id.replace('checkbox', '');
        var savedState = localStorage.getItem('checkbox' + id);
        var row = checkbox.closest('tr');
        var textContents = row.querySelectorAll('.text-content');

        if (savedState === null) {
           
            checkbox.checked = true;
            textContents.forEach(function(span) {
                span.classList.remove('inactive');
            });
        } else {
            var isChecked = savedState === 'true';
            checkbox.checked = isChecked;
            textContents.forEach(function(span) {
                if (isChecked) {
                    span.classList.remove('inactive');
                } else {
                    span.classList.add('inactive');
                }
            });
        }
    });
});




