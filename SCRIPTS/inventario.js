 //FUNCIONES CRUD PRODUCTOS 
 function eliminarProducto(id) {
    Swal.fire({
        title: '¿Estás seguro?',
        text: "¡No podrás recuperar este producto!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, eliminarlo',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: 'eliminarProducto.php',
                type: 'POST',
                data: { id: id },
                success: function(response) {
                    if (response.trim() === 'success') {
                        Swal.fire(
                            'Eliminado',
                            'El producto ha sido eliminado.',
                            'success'
                        ).then(() => {
                           
                            location.reload();
                            
                            // $(event.target).closest('tr').remove();
                        });
                    } else {
                        Swal.fire(
                            'Error',
                            'Hubo un problema al eliminar el producto.',
                            'error'
                        );
                    }
                },
                error: function() {
                    Swal.fire(
                        'Error',
                        'No se pudo conectar con el servidor.',
                        'error'
                    );
                }
            });
        }
    });
}

//registrar producto
document.querySelector('form').addEventListener('submit', function(event) {
    event.preventDefault();
    var formData = new FormData(this);

    $.ajax({
        url: 'registrarProducto.php',
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function(response) {
            if (response.trim() === 'success') {
                Swal.fire(
                    'Éxito',
                    'El producto ha sido registrado.',
                    'success'
                ).then(() => {
                   
                    document.querySelector('form').reset();
                   
                    location.reload(); 
                });
            } else {
                Swal.fire(
                    'Error',
                    'Hubo un problema al registrar el producto.',
                    'error'
                );
            }
        },
        error: function() {
            Swal.fire(
                'Error',
                'No se pudo conectar con el servidor.',
                'error'
            );
        }
    });
});




//SACAR DEL STOCK
function retirarProducto(idProducto) {
    $.ajax({
        url: 'obtenerProductosDisp.php',
        type: 'GET',
        dataType: 'json',
        success: function(productos) {
            Swal.fire({
                title: 'Retirar del Stock',
                html: `
                  <form id="retirarProductoForm">
                    <div class="mb-3">
                        <label for="producto" class="form-label">Nombre del Producto</label>
                        <select class="form-select" id="producto" name="producto" required>
                            <option value="">Seleccione un producto...</option>
                            ${productos.map(producto => `<option value="${producto.id}">${producto.nombre}</option>`).join('')}
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="cantidad" class="form-label">Cantidad a retirar</label>
                        <input type="number" class="form-control" id="cantidad" name="cantidad" required>
                    </div>
                    <div class="mb-3">
                        <label for="motivo" class="form-label">Motivo</label>
                        <input type="text" class="form-control" id="motivo" name="motivo" required>
                    </div>
                  </form>
                `,
                focusConfirm: false,
                showCancelButton: true,
                confirmButtonText: 'Retirar',
                cancelButtonText: 'Cancelar',
                preConfirm: function() {
                    var datosFormulario = {
                        id: document.getElementById('producto').value,
                        cantidad: document.getElementById('cantidad').value,
                        motivo: document.getElementById('motivo').value
                    };

                    return $.ajax({
                        url: 'retirarProducto.php',
                        type: 'POST',
                        data: JSON.stringify(datosFormulario),
                        contentType: 'application/json',
                        success: function(response) {
                            if (response.trim() === 'success') {
                                Swal.fire(
                                    'Retirado',
                                    'La cantidad ha sido retirada correctamente.',
                                    'success'
                                ).then(() => {
                                    location.reload();
                                });
                            } else {
                                Swal.fire(
                                    'Error',
                                    `Hubo un problema al retirar la cantidad: ${response}`,
                                    'error'
                                );
                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            Swal.fire(
                                'Error',
                                'No se pudo conectar con el servidor.',
                                'error'
                            );
                        }
                    });
                }
            });
        },
        error: function(jqXHR, textStatus, errorThrown) {
            Swal.fire(
                'Error',
                'No se pudo obtener la lista de productos.',
                'error'
            );
        }
    });
}





//VERIFICAR PRODUCTO
function buscar() {
    var input = document.getElementById('buscar').value.toLowerCase();
    var tabla = document.querySelector('#tablaContainer tbody');
    
   
    Array.from(tabla.rows).forEach(row => row.style.display = 'none');

   
    var encontrado = false;
    Array.from(tabla.rows).forEach(row => {
        var texto = row.textContent.toLowerCase();
        if (texto.includes(input)) {
            row.style.display = '';
            encontrado = true;
        }
    });

  
    if (!encontrado) {
        var noResultsDiv = document.getElementById('noResults');
        noResultsDiv.style.display = 'block';
        noResultsDiv.innerHTML = 'Este producto no se encuentra en el stock.';
    } else {
        var noResultsDiv = document.getElementById('noResults');
        noResultsDiv.style.display = 'none';
    }
}

document.getElementById('buscar').addEventListener('keyup', buscar);




//PAGINACION

document.addEventListener('DOMContentLoaded', function() {
    const rowsPerPageProductos = 4;  
    const rowsPerPageHistorial = 8;  

    
    function setupPagination(tableSelector, rowsPerPage) {
        const table = document.querySelector(tableSelector);
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
    }

    
    setupPagination('.table', rowsPerPageProductos);

   
    setupPagination('#historialContainer .table', rowsPerPageHistorial);
});




//GENERAR HISTORIAL


document.getElementById('btnHistorial').addEventListener('click', function() {
    document.getElementById('tablaContainer').style.display = 'none';  
    document.getElementById('historialContainer').style.display = 'block';  
    document.getElementById('searchContainer').style.display = 'none';  
});

document.getElementById('btnProductos').addEventListener('click', function() {
    document.getElementById('historialContainer').style.display = 'none';  
    document.getElementById('tablaContainer').style.display = 'block';  
    document.getElementById('searchContainer').style.display = 'block';  
});




