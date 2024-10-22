







$(document).ready(function () {
    $('#historialBtn').click(function (e) {
      e.preventDefault();
      $('#estadoCuentaForm').addClass('hidden');
      $('#historialForm').removeClass('hidden');
    });

    $('#estadoCuentaBtn').click(function (e) {
      e.preventDefault();
      $('#historialForm').addClass('hidden');
      $('#estadoCuentaForm').removeClass('hidden');
    });
  });



  //ENVIAR CORREO CON HISTORIAL
  
  $(document).ready(function () {
    $('#enviarhistorial').click(function (event) {
      event.preventDefault();
  
      var correo = $('#correo').val().trim();
  
      if (correo) {
        const { jsPDF } = window.jspdf;
        const doc = new jsPDF();
  
        var img = new Image();
        img.src = 'images/COPARMEX.png';
  
        img.onload = function() {
          const imgWidth = 60; 
          const imgHeight = 30; 
          const xImage = (doc.internal.pageSize.getWidth() - imgWidth) / 2; 
          doc.addImage(img, 'png', xImage, 10, imgWidth, imgHeight);
  
          
          const date = new Date();
          const day = date.getDate(); 
          const monthNames = [
            "enero", "febrero", "marzo", "abril", "mayo", "junio",
            "julio", "agosto", "septiembre", "octubre", "noviembre", "diciembre"
          ];
          const month = monthNames[date.getMonth()]; 
          const year = date.getFullYear(); 
  
          
          const formattedDate = `Pachuca de Soto, Hidalgo a ${day} de ${month} de ${year}`;
          const dateWidth = doc.getTextWidth(formattedDate);
          const xDate = doc.internal.pageSize.getWidth() - dateWidth - 25; 
          doc.setFontSize(12);
          doc.setTextColor(100, 100, 100);
          doc.text(formattedDate, xDate, 50); 
  
         
          const subjectText = "ASUNTO: HISTORIAL DE COBRANZA";
          const subjectWidth = doc.getTextWidth(subjectText);
          const xSubject = doc.internal.pageSize.getWidth() - subjectWidth - 15; 
          
          
          doc.setFont("normal"); 
          doc.text(subjectText, xSubject, 60); 
  
          var headers = [['ID', 'Nombre del Evento', 'Nombre', 'Teléfono', 'Correo', 'Precio', 'Pagado']];
          var rows = [];
  
         
          $('table tbody tr').each(function () {
            var row = [
              $(this).find('td').eq(0).text(),
              $(this).find('td').eq(1).text(),
              $(this).find('td').eq(2).text(),
              $(this).find('td').eq(3).text(),
              $(this).find('td').eq(4).text(),
              $(this).find('td').eq(5).text(),
              $(this).find('td').eq(6).text(),
            ];
            rows.push(row);
          });
  
          
          const pageHeight = doc.internal.pageSize.getHeight();
          let startY = 70; 
          const marginBottom = 20; 
          const maxTableHeight = pageHeight - startY - marginBottom; 
  
        
          let currentPageRows = [];
          let rowHeight = 10; 
          rows.forEach((row, index) => {
            currentPageRows.push(row);
            if (currentPageRows.length * rowHeight >= maxTableHeight || index === rows.length - 1) {
            
              doc.autoTable({
                head: headers,
                body: currentPageRows,
                startY: startY,
                headStyles: {
                  fillColor: [0, 102, 204], 
                  textColor: [255, 255, 255], 
                  fontSize: 12,
                  fontStyle: 'bold',
                },
                bodyStyles: {
                  fontSize: 10, 
                  textColor: [0, 0, 0],
                },
                alternateRowStyles: {
                  fillColor: [240, 240, 240], 
                },
                margin: { top: 70 }, 
              });
  
              
              const finalText = 'Fracc.Comercial y de Servicios, lote 2 del lote 6, Col. El Palmar, C.P. 42088, Pachuca, Hidalgo. Teléfonos: 771 7135050 . e-mail:direccion@coparmexhidalgo.org.mx';
              const finalTextLines = doc.splitTextToSize(finalText, 180);
              let yText = pageHeight - (finalTextLines.length * 6) - 10; 
              
              finalTextLines.forEach(line => {
                const lineWidth = doc.getTextWidth(line);
                const xLine = (doc.internal.pageSize.getWidth() - lineWidth) / 2;
                doc.text(line, xLine, yText);
                yText += 6;
              });
  
             
              if (index < rows.length - 1) {
                doc.addPage(); 
                startY = 70; 
                currentPageRows = []; 
              }
            }
          });
  
         
          const pdfFileName = 'Historial_cobranza.pdf';
          doc.save(pdfFileName);
  
          var subject = encodeURIComponent("Historial de Cobranza");
          var body = encodeURIComponent("Adjunta el PDF generado antes de enviar el correo.");
          var mailtoLink = `mailto:${correo}?subject=${subject}&body=${body}`;
  
          alert('El PDF ha sido generado. Se abrirá el mail para que puedas adjuntar al correo.');
          window.location.href = mailtoLink;
        };
      } else {
        alert("Por favor, ingresa un correo electrónico.");
      }
    });
  });
  

//ENVIAR CORREO CON ESTADO DE CUENTA
$(document).ready(function () {
    $('#enviarestado').click(function (event) {
        event.preventDefault();

        var correo = $('#email').val().trim(); 

        if (correo) {
            const { jsPDF } = window.jspdf;
            const doc = new jsPDF();
            var img = new Image();
            img.src = 'images/COPARMEX.png';

            img.onload = function() {
                const imgWidth = 60; 
                const imgHeight = 30; 
                const xImage = (doc.internal.pageSize.getWidth() - imgWidth) / 2; 
                doc.addImage(img, 'png', xImage, 10, imgWidth, imgHeight);

               
                const date = new Date();
                const day = date.getDate(); 
                const monthNames = [
                    "enero", "febrero", "marzo", "abril", "mayo", "junio",
                    "julio", "agosto", "septiembre", "octubre", "noviembre", "diciembre"
                ];
                const month = monthNames[date.getMonth()]; 
                const year = date.getFullYear(); 

                const formattedDate = `Pachuca de Soto, Hidalgo a ${day} de ${month} de ${year}`;
                const dateWidth = doc.getTextWidth(formattedDate);
                const xDate = doc.internal.pageSize.getWidth() - dateWidth - 25; 
                doc.setFontSize(12);
                doc.setTextColor(100, 100, 100);
                doc.text(formattedDate, xDate, 50); 

             
                const subjectText = "ASUNTO: ESTADO DE CUENTA";
                const subjectWidth = doc.getTextWidth(subjectText);
                const xSubject = doc.internal.pageSize.getWidth() - subjectWidth - 15; 
                doc.setFont("normal"); 
                doc.text(subjectText, xSubject, 60); 

                var headers = [['ID', 'Nombre del Evento', 'Nombre', 'Teléfono', 'Correo', 'Activo', 'Pagado']];
                var rows = [];

                
                $('table tbody tr').each(function () {
                    var pagado = $(this).find('td').eq(6).text(); 
                    if (pagado.toLowerCase() === 'no') { 
                        var row = [
                            $(this).find('td').eq(0).text(),
                            $(this).find('td').eq(1).text(),
                            $(this).find('td').eq(2).text(),
                            $(this).find('td').eq(3).text(),
                            $(this).find('td').eq(4).text(),
                            $(this).find('td').eq(5).text(),
                            $(this).find('td').eq(6).text(),
                        ];
                        rows.push(row);
                    }
                });

                if (rows.length === 0) {
                    alert("No hay registros donde el socio deba.");
                    return;
                }

               
                doc.autoTable({
                    head: headers,
                    body: rows,
                    startY: 70,
                    headStyles: {
                        fillColor: [0, 102, 204],
                        textColor: [255, 255, 255],
                        fontSize: 12,
                        fontStyle: 'bold'
                    },
                    bodyStyles: {
                        fontSize: 10,
                        textColor: [0, 0, 0]
                    },
                    alternateRowStyles: {
                        fillColor: [240, 240, 240]
                    },
                    margin: { top: 70 },
                });

                const finalText = 'Fracc. Comercial y de Servicios, lote 2 del lote 6, Col. El Palmar, C.P. 42088, Pachuca, Hidalgo. Teléfonos: 771 7135050 . e-mail: direccion@coparmexhidalgo.org.mx';
                const finalTextLines = doc.splitTextToSize(finalText, 180);
                let yText = doc.internal.pageSize.getHeight() - (finalTextLines.length * 6) - 10; 
                
                finalTextLines.forEach(line => {
                    const lineWidth = doc.getTextWidth(line);
                    const xLine = (doc.internal.pageSize.getWidth() - lineWidth) / 2;
                    doc.text(line, xLine, yText);
                    yText += 6;
                });

                const pdfFileName = 'Estado de cuenta.pdf';
                doc.save(pdfFileName);

                var subject = encodeURIComponent("ESTADO DE CUENTA");
                var body = encodeURIComponent("Adjunta el PDF generado antes de enviar el correo.");
                var mailtoLink = `mailto:${correo}?subject=${subject}&body=${body}`;

                alert('El PDF ha sido generado. Se abrirá el mail para que puedas adjuntar al correo.');
                window.location.href = mailtoLink;
            };
        } else {
            alert("Por favor, ingresa un correo electrónico.");
        }
    });
});




//BUSQUEDA CON FILTROS 
$(document).ready(function () {
    // FILTRAR POR SOCIO
    $('#estado').change(function () {
        const socioSeleccionado = $(this).val();
        const paymentStatus = $('#paymentStatus').val(); 

        $.ajax({
            type: "POST",
            url: "filtrarRegistrosNSocio.php", 
            data: { socio_id: socioSeleccionado, payment_status: paymentStatus }, 
            success: function (response) {
                const data = JSON.parse(response);

                $('#tablaRegistrosEventos tbody').html(data.eventos);
                $('#tablaSocios tbody').html(data.socios);
            },
            error: function (xhr, status, error) {
                console.error("Error en la solicitud AJAX:", status, error); 
            }
        });
    });

    // FILTRAR POR ESTADO DE PAGO
    $('#paymentStatus').change(function () {
        const socioSeleccionado = $('#estado').val(); 
        const paymentStatus = $(this).val(); 

        $.ajax({
            type: "POST",
            url: "filtrarRegistrosNSocio.php", 
            data: { socio_id: socioSeleccionado, payment_status: paymentStatus }, 
            success: function (response) {
                const data = JSON.parse(response);

                $('#tablaRegistrosEventos tbody').html(data.eventos);
                $('#tablaSocios tbody').html(data.socios);
            },
            error: function (xhr, status, error) {
                console.error("Error en la solicitud AJAX:", status, error); 
            }
        });
    });
});





////////////////////////////////////////////////////EDITAR REGISTROS DE SOCIOS A EVENTOS /////////////////////////////////////////////
let totalAnualidad;
function editarRegistro(id) {
    $.ajax({
        
        url: 'obtenerDatosRegistros.php',
        type: 'POST',
        data: { id: id },
        success: function(response) {
            try {
                const data = JSON.parse(response);
                totalAnualidad = data.precio;

                Swal.fire({
                    title: 'Editar Registro de socios a eventos',
                    html: `
                        <div style="max-width: 800px; overflow-y: auto; font-size: 14px; padding: 20px;">
                            <h5 style="font-weight: bold; margin-bottom: 15px;">Historial de Pagos</h5>
                            <div style="overflow-x: auto;">
                                <table class="table table-bordered" style="border-collapse: collapse;">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Fecha</th>
                                            <th>Monto</th>
                                            <th>Forma de Pago</th>
                                            <th>Tipo</th>
                                            <th>Usuario</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody id="historialPagos">
                                        <!-- HISTORIAL -->
                                    </tbody>
                                </table>
                            </div>
                            
                            <h5 style="font-weight: bold; margin-top: 30px; margin-bottom: 15px;">Abono</h5>
                            <div style="overflow-x: auto;">
                                <table class="table table-bordered" style="border-collapse: collapse;">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Total Anualidad</th>
                                            <th>Por Cobrar</th>
                                            <th>Monto</th>
                                            <th>Forma de Pago</th>
                                            <th>Fecha de Pago</th>
                                        </tr>
                                    </thead>
                                    <tbody id="abonoSection">
                                        <tr>
                                           
                                            <td>${data.precio || ''}</td> 
                                            
                                             <td><input type="number" id="porCobrar" class="form-control"></td>
                                            <td><input type="number" id="monto" class="form-control"></td>
                                            <td><input type="text" id="formaPago" class="form-control"></td>
                                            <td><input type="date" id="fechaPago" class="form-control"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <button class="btn btn-primary w-100 mt-3" id="btnGuardarAbono">
                                <i class="fa-solid fa-save"></i> Guardar Abono
                            </button>

                            <h5 style="font-weight: bold; margin-top: 30px; margin-bottom: 15px;">Condonación</h5>
                            <div style="overflow-x: auto;">
                                <table class="table table-bordered" style="border-collapse: collapse;">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Total Anualidad</th>
                                            <th>Por Condonar</th>
                                            <th>Fecha Condonación</th>
                                            <th>Tipo</th>
                                            <th>Monto Condonación</th>
                                        </tr>
                                    </thead>
                                    <tbody id="condonacionSection">
                                        <tr>
                                            <td>${data.precio || ''}</td> 
                                            <td><input type="number" id="porCondonar" class="form-control"></td>
                                            <td><input type="date" id="fechaCondonacion" class="form-control"></td>
                                            <td><input type="text" id="tipoCondonacion" class="form-control"></td>
                                            <td><input type="number" id="montoCondonacion" class="form-control"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <button class="btn btn-primary w-100 mt-3" id="btnGuardarCondonacion">
                                <i class="fa-solid fa-save"></i> Guardar Condonación
                            </button>

                            <h5 style="font-weight: bold; margin-top: 30px; margin-bottom: 15px;">Comentario Dirección</h5>
                            <input type="text" id="comentarioDireccion" class="form-control mb-3" placeholder="Agregar comentario">
                            <button class="btn btn-primary w-100 mt-2" id="btnGuardarComentario">
                                <i class="fa-solid fa-save"></i> Guardar Comentario
                            </button>

                            <h5 style="font-weight: bold; margin-top: 30px; margin-bottom: 15px;">Historial de Comentarios Dirección</h5>
                            <div style="overflow-x: auto;">
                                <table class="table table-bordered" style="border-collapse: collapse;">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Fecha</th>
                                            <th>Comentario</th>
                                            <th>Creado por</th>
                                        </tr>
                                    </thead>
                                    <tbody id="historialComentarios">
                                    
                
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    `,
                    showCancelButton: true,
                    confirmButtonText: 'Guardar Cambios',
                    cancelButtonText: 'Cancelar',
                    customClass: {
                        popup: 'swal2-popup-custom',
                    },
                    width: '800px', 
                    didRender: () => {
                       
                        cargarComentarios(id);
                        cargarHistorial(id);
                        cargarAbonosRegistros(id);
                        cargarCondonacionesRegistros(id);
                        
                       
                        $('#btnGuardarAbono').on('click', function() {
                            guardarAbono(id);
                        });

                   
                        $('#btnGuardarCondonacion').on('click', function() {
                            guardarCondonacion(id);
                        });

                        
                        $('#btnGuardarComentario').on('click', function() {
                            guardarComentario(id);

                        });
 
                    }
                });

                function cargarComentarios(registroId) {
                    $.ajax({
                        url: 'obtenerComentariosRegistros.php',
                        type: 'GET',
                        data: { registro_id: registroId },
                        success: function(response) {
                            console.log('Respuesta del servidor:', response); 
                            try {
                                const comentarios = JSON.parse(response);
                                const tbody = $('#historialComentarios');
                                tbody.empty();
                    
                                if (Array.isArray(comentarios) && comentarios.length === 0) {
                                    tbody.append('<tr><td colspan="3">No hay comentarios disponibles.</td></tr>');
                                } else if (comentarios.error) {
                                    tbody.append(`<tr><td colspan="3">${comentarios.error}</td></tr>`);
                                } else {
                                    comentarios.forEach(comentario => {
                                        const row = `<tr>
                                            <td>${comentario.fecha}</td>
                                            <td>${comentario.comentario}</td>
                                            <td>${comentario.creado_por}</td>
                                        </tr>`;
                                        tbody.append(row);
                                    });
                                }
                            } catch (error) {
                                console.error('Error al procesar la respuesta de comentarios:', error);
                            }
                        },
                        error: function() {
                            console.error('Error al conectar con el servidor para obtener comentarios.');
                        }
                    });
                }
                

//OBTENER HISTORIAL DE PAGOS


function cargarHistorial(eventoId) { 
    $.ajax({
        url: 'obtenerHistorialPagosR.php', 
        type: 'GET',
        data: { registro_evento_id: eventoId }, 
        success: function(response) {
            console.log('Respuesta del servidor:', response); 
            try {
                const historial = JSON.parse(response);
                const tbody = $('#historialPagos'); 
                tbody.empty(); 

                if (historial.length === 0) {
                    tbody.append('<tr><td colspan="6">No hay abonos o condonaciones disponibles.</td></tr>');
                } else {
                    historial.forEach(transaccion => {
                        const row = `<tr>
                            <td>${transaccion.fecha}</td>
                            <td>${transaccion.monto}</td>
                            <td>${transaccion.forma_pago || transaccion.tipo}</td>
                            <td>${transaccion.tipo}</td>
                            
                            <td>${transaccion.usuario}</td>
                            <td>
                                <a href='#' onclick='eliminarTransaccion(${transaccion.id});' class='btn btn-danger' title='Eliminar'>
            <i class='fas fa-trash-alt'></i>
        </a>
                            </td>
                        </tr>`;
                        tbody.append(row); 
                      
                    });
                }
            } catch (error) {
                console.error('Error al procesar la respuesta del historial:', error);
            }
        },
        error: function() {
            console.error('Error al conectar con el servidor para obtener el historial.');
        }
    });
}





               
              // GUARDAR ABONO DEL REGISTRO DEL SOCIO 
           
            function guardarAbono(id) {
                const monto = parseFloat($('#monto').val());
                const formaPago = $('#formaPago').val();
                const fechaPago = $('#fechaPago').val();
                
                const totalAnualidad = parseFloat($('#abonoSection td:first').text().trim());
            
                if (!monto || !formaPago || !fechaPago) {
                    Swal.fire('Error', 'Por favor, completa todos los campos.', 'warning');
                    return;
                }
            
                const porCobrarActual = parseFloat($('#porCobrar').val());
                const nuevoPorCobrar = porCobrarActual - monto;
            
                if (nuevoPorCobrar < 0) {
                    Swal.fire('Error', 'El monto del abono no puede ser mayor que el monto por cobrar.', 'warning');
                    return;
                }
            
                $.ajax({
                    url: 'guardarAbonoRegistro.php',
                    type: 'POST',
                    data: {
                        id: id,
                        totalAnualidad: totalAnualidad,
                        porCobrar: nuevoPorCobrar,
                        monto: monto,
                        formaPago: formaPago,
                        fechaPago: fechaPago
                    },
                    success: function(response) {
                        try {
                            const result = JSON.parse(response);
                            if (result.success) {
                                $('#mensajeExito').text(result.message || 'El abono ha sido guardado correctamente.')
                                    .fadeIn().delay(2000).fadeOut();
            
                                $('#porCobrar').val(nuevoPorCobrar.toFixed(2));
                                $('#monto').val('');
                                $('#formaPago').val('');
                                $('#fechaPago').val('');
                            } else {
                                Swal.fire('Error', result.message || 'No se pudo guardar el abono.', 'error');
                            }
                        } catch (error) {
                            Swal.fire('Error', 'Error al procesar la respuesta del servidor.', 'error');
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        Swal.fire('Error', 'No se pudo conectar con el servidor.', 'error');
                    }
                });
            }
            
               
            function cargarAbonosRegistros(id) {
                $.get(`obtenerAbonosRegistros.php?registro_evento_id=${id}`, function(response) {
                    const result = JSON.parse(response);
                    
                    if (result.error) {
                        console.error('Error:', result.error);
                    } else {
                        const totalAnualidad = parseFloat($('#abonoSection td:first').text().trim());
                        const porCobrar = parseFloat(result.porCobrar);
                        
                        $('#porCobrar').val(porCobrar || totalAnualidad);
                    }
                }).fail(function(jqXHR, textStatus, errorThrown) {
                    console.error('Error en la solicitud AJAX:', textStatus, errorThrown);
                });
            }
         
            function guardarCondonacion(id) {
                const porCondonar = $('#porCondonar').val();
                const fechaCondonacion = $('#fechaCondonacion').val();
                const tipoCondonacion = $('#tipoCondonacion').val();
                const montoCondonacion = $('#montoCondonacion').val();
                const totalAnualidad = $('#condonacionSection td:first').text().trim(); 
            
                if (!porCondonar || !fechaCondonacion || !tipoCondonacion || !montoCondonacion) {
                    Swal.fire('Error', 'Por favor, completa todos los campos.', 'warning');
                    return;
                }
            
                console.log('Datos enviados para condonación:', {
                    id: id,
                    totalAnualidad: totalAnualidad,
                    porCondonar: porCondonar,
                    fechaCondonacion: fechaCondonacion,
                    tipoCondonacion: tipoCondonacion,
                    montoCondonacion: montoCondonacion
                });
            
                $.ajax({
                    url: 'guardarCondonacionRegistro.php', 
                    type: 'POST',
                    data: {
                        id: id, 
                        totalAnualidad: totalAnualidad,
                        porCondonar: porCondonar,
                        fechaCondonacion: fechaCondonacion,
                        tipoCondonacion: tipoCondonacion,
                        montoCondonacion: montoCondonacion
                    },
                    success: function(response) {
                        console.log('Respuesta del servidor:', response);
                        try {
                            const result = JSON.parse(response);
                            if (result.success) {
                                $('#mensajeExito').text(result.message || 'La condonación ha sido guardada correctamente.')
                                    .fadeIn().delay(2000).fadeOut(); 
                                
                               
                                $('#porCondonar').val(result.nuevo_por_condonar.toFixed(2));
            
                                
                                $('#fechaCondonacion').val('');
                                $('#tipoCondonacion').val('');
                                $('#montoCondonacion').val('');
                            } else {
                                Swal.fire('Error', result.message || 'No se pudo guardar la condonación.', 'error');
                            }
                        } catch (error) {
                            console.error('Error al procesar JSON:', error);
                            Swal.fire('Error', 'Error al procesar la respuesta del servidor.', 'error');
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error('Error en AJAX:', textStatus, errorThrown);
                        Swal.fire('Error', 'No se pudo conectar con el servidor.', 'error');
                    }
                });
            }
            
            function cargarCondonacionesRegistros(id) {
                $.get(`obtenerCondonacionesRegistros.php?registro_evento_id=${id}`, function(response) {
                    const result = JSON.parse(response);
                    
                    if (result.error) {
                        console.error('Error:', result.error);
                    } else {
                        const totalAnualidad = parseFloat($('#condonacionSection td:first').text().trim());
                        const porCondonar = parseFloat(result.porCondonar);
                        
                        $('#porCondonar').val(porCondonar || totalAnualidad);
                    }
                }).fail(function(jqXHR, textStatus, errorThrown) {
                    console.error('Error en la solicitud AJAX:', textStatus, errorThrown);
                });
            }    

function guardarComentario(id) {
    const comentarioDireccion = $('#comentarioDireccion').val().trim();

    if (!comentarioDireccion) {
        Swal.fire('Error', 'Por favor, ingresa un comentario.', 'warning');
        return;
    }

    console.log('Llamando a guardarComentario.php');
    console.log({ id: id, comentarioDireccion: comentarioDireccion });
    
    $.ajax({
        url: 'guardarComentarioRegistros.php',
        type: 'POST',
        data: {
            id: id,
            comentarioDireccion: comentarioDireccion
        },
        success: function(response) {
            try {
                if (response.success) {
                    
                    $('#mensajeExito').text('Comentario guardado correctamente.')
                        .fadeIn().delay(2000).fadeOut(); 
                    
                    $('#comentarioDireccion').val(''); 
                } else {
                    Swal.fire('Error', response.message || 'No se pudo guardar el comentario.', 'error');
                }
            } catch (error) {
                console.error('Error al procesar la respuesta del servidor:', error);
                Swal.fire('Error', 'Error al procesar la respuesta del servidor.', 'error');
            }
        },
        error: function() {
            Swal.fire('Error', 'Error al conectar con el servidor.', 'error');
        }
    });
}
            } catch (error) {
                console.error('Error al parsear la respuesta:', error);
                Swal.fire('Error', 'No se pudo recuperar los datos del registro.', 'error');
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.error('Error:', textStatus, errorThrown);
            Swal.fire('Error', 'No se pudo conectar con el servidor.', 'error');
        }
        
    });
}

///////////////// ELIMINAR TRANSACCION DEL REGISTRO DE USUARIO AL EVENTO
function eliminarTransaccion(id) {
    if (confirm("¿Estás seguro de que deseas eliminar esta transacción?")) {
        $.ajax({
            url: 'eliminarTransaccionRegistro.php',
            type: 'POST',
            data: { id: id }, 
            success: function(response) {
                console.log('Respuesta del servidor:', response); 
                try {
                    let result = JSON.parse(response);
                    if (result.success) {
                        alert('Transacción eliminada correctamente');
                        
                        
                        $(`#historialPagos tr:has(a[onclick*='eliminarTransaccion(${id})'])`).remove();
                    } else {
                        alert('Error: ' + result.error);
                    }
                } catch (error) {
                    console.error('Error al procesar la respuesta:', error);
                    alert('Error en la respuesta del servidor: ' + response);
                }
            },
            error: function() {
                alert('Error en la solicitud');
            }
        });
    }
}







