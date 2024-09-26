function guardarSocio() {
    var fechaAfiliacion = $("#fechaAfiliacion").val();
    var razonSocial = $("#razonSocial").val();
    var RFC = $("#RFC").val();
    var nombreComercial = $("#nombreComercial").val();
    var calle = $("#calle").val();
    var numero = $("#numero").val();
    var colonia = $("#colonia").val();
    var cp = $("#cp").val();
    var estado = $("#estado").val();
    var municipio = $("#municipio").val();
    var telefonoEmpresa1 = $("#telefonoEmpresa1").val();
    var sectorEstrategico = $("#sectorEstrategico").val();
    var giro = $("#giro").val();
    var giroGeneral = $("#giroGeneral").val();
    var noColaboradores = $("#noColaboradores").val();
    var rangoVentas = $("#rangoVentas").val();
    var tamaño = $("#tamaño").val();
    var queVende = $("#queVende").val();
    var queCompra = $("#queCompra").val();
    var cuota = $("#cuota").val();
    var mesFactura = $("#mesFactura").val();
    var ejecutivoAfilio = $("#ejecutivoAfilio").val();
    var diaAniversario = $("#diaAniversario").val();
    var mesAniversario = $("#mesAniversario").val();
    var nombreAsociado = $("#nombreAsociado").val();
    var curpAsociado = $("#curpAsociado").val();
    var diaCumpleAsociado = $("#diaCumpleAsociado").val();
    var mesCumpleAsociado = $("#mesCumpleAsociado").val();
    var correoAsociado1 = $("#correoAsociado1").val();
    var correoAsociado2 = $("#correoAsociado2").val();
    var celularAsociado = $("#celularAsociado").val();
    var telOficinaAsociado = $("#telOficinaAsociado").val();
    var extensionAsociado = $("#extensionAsociado").val();
    var perfilAsociado = $("#perfilAsociado").val();
    var generoAsociado = $("#generoAsociado").val();
    var mismosDatosRepresentante = $("#mismosDatosRepresentante").val();
    var nombreRepresentante = $("#nombreRepresentante").val();
    var curpRepresentante = $("#curpRepresentante").val();
    var diaCumpleRepresentante = $("#diaCumpleRepresentante").val();
    var mesCumpleRepresentante = $("#mesCumpleRepresentante").val();
    var correoRepresentante1 = $("#correoRepresentante1").val();
    var correoRepresentante2 = $("#correoRepresentante2").val();
    var celularRepresentante = $("#celularRepresentante").val();
    var telOficinaRepresentante = $("#telOficinaRepresentante").val();
    var extensionRepresentante = $("#extensionRepresentante").val();
    var perfilRepresentante = $("#perfilRepresentante").val();
    var generoRepresentante = $("#generoRepresentante").val();
    var nombreAsistente = $("#nombreAsistente").val();
    var correoAsistente1 = $("#correoAsistente1").val();
    var celularAsistente = $("#celularAsistente").val();
    var nombreFinanzas = $("#nombreFinanzas").val();
    var correoFinanzas1 = $("#correoFinanzas1").val();
    var celularFinanzas = $("#celularFinanzas").val();
    var nombreRecursosHumanos = $("#nombreRecursosHumanos").val();
    var correoRecursosHumanos1 = $("#correoRecursosHumanos1").val();
    var celularRecursosHumanos = $("#celularRecursosHumanos").val();
    var comentario = $("#comentario").val();
    // var logotipo = $("#logotipo").val();

    const inputs = document.querySelectorAll('input, textarea, select');

    for (let input of inputs) {
        if (input.value.trim() === "") {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Completa todos los campos!',
            });
            return;
        }
    }

    $.post(
        "registrarSocio.php", {
        fechaAfiliacion: fechaAfiliacion,
        razonSocial: razonSocial,
        RFC: RFC,
        nombreComercial: nombreComercial,
        calle: calle,
        numero: numero,
        colonia: colonia,
        cp: cp,
        estado: estado,
        municipio: municipio,
        telefonoEmpresa1: telefonoEmpresa1,
        sectorEstrategico: sectorEstrategico,
        giro: giro,
        giroGeneral: giroGeneral,
        noColaboradores: noColaboradores,
        rangoVentas: rangoVentas,
        tamaño: tamaño,
        queVende: queVende,
        queCompra: queCompra,
        cuota: cuota,
        mesFactura: mesFactura,
        ejecutivoAfilio: ejecutivoAfilio,
        diaAniversario: diaAniversario,
        mesAniversario: mesAniversario,
        nombreAsociado: nombreAsociado,
        curpAsociado: curpAsociado,
        diaCumpleAsociado: diaCumpleAsociado,
        mesCumpleAsociado: mesCumpleAsociado,
        correoAsociado1: correoAsociado1,
        correoAsociado2: correoAsociado2,
        celularAsociado: celularAsociado,
        telOficinaAsociado: telOficinaAsociado,
        extensionAsociado: extensionAsociado,
        perfilAsociado: perfilAsociado,
        generoAsociado: generoAsociado,
        mismosDatosRepresentante: mismosDatosRepresentante,
        nombreRepresentante: nombreRepresentante,
        curpRepresentante: curpRepresentante,
        diaCumpleRepresentante: diaCumpleRepresentante,
        mesCumpleRepresentante: mesCumpleRepresentante,
        correoRepresentante1: correoRepresentante1,
        correoRepresentante2: correoRepresentante2,
        celularRepresentante: celularRepresentante,
        telOficinaRepresentante: telOficinaRepresentante,
        extensionRepresentante: extensionRepresentante,
        perfilRepresentante: perfilRepresentante,
        generoRepresentante: generoRepresentante,
        nombreAsistente: nombreAsistente,
        correoAsistente1: correoAsistente1,
        celularAsistente: celularAsistente,
        nombreFinanzas: nombreFinanzas,
        correoFinanzas1: correoFinanzas1,
        celularFinanzas: celularFinanzas,
        nombreRecursosHumanos: nombreRecursosHumanos,
        correoRecursosHumanos1: correoRecursosHumanos1,
        celularRecursosHumanos: celularRecursosHumanos,
        comentario: comentario,
        // logotipo: logotipo,
    },
        function (result) {
            $("#fechaAfiliacion").val("");
            $("#razonSocial").val("");
            $("#RFC").val("");
            $("#nombreComercial").val("");
            $("#calle").val("");
            $("#numero").val("");
            $("#colonia").val("");
            $("#cp").val("");
            $("#estado").val("");
            $("#municipio").val("");
            $("#telefonoEmpresa1").val("");
            $("#sectorEstrategico").val("");
            $("#giro").val("");
            $("#giroGeneral").val("");
            $("#noColaboradores").val("");
            $("#rangoVentas").val("");
            $("#tamaño").val("");
            $("#queVende").val("");
            $("#queCompra").val("");
            $("#cuota").val("");
            $("#mesFactura").val("");
            $("#ejecutivoAfilio").val("");
            $("#diaAniversario").val("");
            $("#mesAniversario").val("");
            $("#nombreAsociado").val("");
            $("#curpAsociado").val("");
            $("#diaCumpleAsociado").val("");
            $("#mesCumpleAsociado").val("");
            $("#correoAsociado1").val("");
            $("#correoAsociado2").val("");
            $("#celularAsociado").val("");
            $("#telOficinaAsociado").val("");
            $("#extensionAsociado").val("");
            $("#perfilAsociado").val("");
            $("#generoAsociado").val("");
            $("#mismosDatosRepresentante").val("");
            $("#nombreRepresentante").val("");
            $("#curpRepresentante").val("");
            $("#diaCumpleRepresentante").val("");
            $("#mesCumpleRepresentante").val("");
            $("#correoRepresentante1").val("");
            $("#correoRepresentante2").val("");
            $("#celularRepresentante").val("");
            $("#telOficinaRepresentante").val("");
            $("#extensionRepresentante").val("");
            $("#perfilRepresentante").val("");
            $("#generoRepresentante").val("");
            $("#nombreAsistente").val("");
            $("#correoAsistente1").val("");
            $("#celularAsistente").val("");
            $("#nombreFinanzas").val("");
            $("#correoFinanzas1").val("");
            $("#celularFinanzas").val("");
            $("#nombreRecursosHumanos").val("");
            $("#correoRecursosHumanos1").val("");
            $("#celularRecursosHumanos").val("");
            $("#comentario").val("");
            cargarDiv($("#result"), "listaSocios.php");

            Swal.fire({
                icon: 'success',
                title: 'Socio registrado!',
                text: 'El nuevo socio ha sido agregado exitosamente.',
            }).then(function () {
                location.reload();
            });
        }
    ).fail(function () {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Hubo un problema al guardar el socio. Por favor, inténtalo de nuevo más tarde.'
        });
    });
}

function siDatos() {
    const mismoDatos = document.getElementById("mismosDatosRepresentante").value;
    const fields = [
        "nombreRepresentante",
        "curpRepresentante",
        "diaCumpleRepresentante",
        "mesCumpleRepresentante",
        "correoRepresentante1",
        "correoRepresentante2",
        "celularRepresentante",
        "telOficinaRepresentante",
        "extensionRepresentante",
        "perfilRepresentante",
        "generoRepresentante"
    ];

    const sourceFields = [
        "nombreAsociado",
        "curpAsociado",
        "diaCumpleAsociado",
        "mesCumpleAsociado",
        "correoAsociado1",
        "correoAsociado2",
        "celularAsociado",
        "telOficinaAsociado",
        "extensionAsociado",
        "perfilAsociado",
        "generoAsociado"
    ];

    if (mismoDatos === "Si") {
        fields.forEach((field, index) => {
            document.getElementById(field).value = document.getElementById(sourceFields[index]).value;
        });
    } else {
        fields.forEach(field => {
            document.getElementById(field).value = "";
        });
    }
}


// FUNCION PARA COPIAR LOS DATOS AL FORMULARIO DE REPRESENTANTE................
function siDatos() {
    const mismoDatos = document.getElementById("mismosDatosRepresentante").value;
    const fields = [
        "nombreRepresentante",
        "curpRepresentante",
        "diaCumpleRepresentante",
        "mesCumpleRepresentante",
        "correoRepresentante1",
        "correoRepresentante2",
        "celularRepresentante",
        "telOficinaRepresentante",
        "extensionRepresentante",
        "perfilRepresentante",
        "generoRepresentante"
    ];

    const sourceFields = [
        "nombreAsociado",
        "curpAsociado",
        "diaCumpleAsociado",
        "mesCumpleAsociado",
        "correoAsociado1",
        "correoAsociado2",
        "celularAsociado",
        "telOficinaAsociado",
        "extensionAsociado",
        "perfilAsociado",
        "generoAsociado"
    ];

    if (mismoDatos === "Si") {
        fields.forEach((field, index) => {
            document.getElementById(field).value = document.getElementById(sourceFields[index]).value;
        });
    } else {
        fields.forEach(field => {
            document.getElementById(field).value = "";
        });
    }
}

function editarSocio(id) {
    var fechaAfiliacion = $("#fechaAfiliacion").val();
    var razonSocial = $("#razonSocial").val();
    var RFC = $("#RFC").val();
    var nombreComercial = $("#nombreComercial").val();
    var calle = $("#calle").val();
    var numero = $("#numero").val();
    var colonia = $("#colonia").val();
    var cp = $("#cp").val();
    var estado = $("#estado").val();
    var municipio = $("#municipio").val();
    var telefonoEmpresa1 = $("#telefonoEmpresa1").val();
    var sectorEstrategico = $("#sectorEstrategico").val();
    var giro = $("#giro").val();
    var giroGeneral = $("#giroGeneral").val();
    var noColaboradores = $("#noColaboradores").val();
    var rangoVentas = $("#rangoVentas").val();
    var tamaño = $("#tamaño").val();
    var queVende = $("#queVende").val();
    var queCompra = $("#queCompra").val();
    var cuota = $("#cuota").val();
    var mesFactura = $("#mesFactura").val();
    var ejecutivoAfilio = $("#ejecutivoAfilio").val();
    var diaAniversario = $("#diaAniversario").val();
    var mesAniversario = $("#mesAniversario").val();
    var nombreAsociado = $("#nombreAsociado").val();
    var curpAsociado = $("#curpAsociado").val();
    var diaCumpleAsociado = $("#diaCumpleAsociado").val();
    var mesCumpleAsociado = $("#mesCumpleAsociado").val();
    var correoAsociado1 = $("#correoAsociado1").val();
    var correoAsociado2 = $("#correoAsociado2").val();
    var celularAsociado = $("#celularAsociado").val();
    var telOficinaAsociado = $("#telOficinaAsociado").val();
    var extensionAsociado = $("#extensionAsociado").val();
    var perfilAsociado = $("#perfilAsociado").val();
    var generoAsociado = $("#generoAsociado").val();
    var nombreRepresentante = $("#nombreRepresentante").val();
    var curpRepresentante = $("#curpRepresentante").val();
    var diaCumpleRepresentante = $("#diaCumpleRepresentante").val();
    var mesCumpleRepresentante = $("#mesCumpleRepresentante").val();
    var correoRepresentante1 = $("#correoRepresentante1").val();
    var correoRepresentante2 = $("#correoRepresentante2").val();
    var celularRepresentante = $("#celularRepresentante").val();
    var telOficinaRepresentante = $("#telOficinaRepresentante").val();
    var extensionRepresentante = $("#extensionRepresentante").val();
    var perfilRepresentante = $("#perfilRepresentante").val();
    var generoRepresentante = $("#generoRepresentante").val();
    var nombreAsistente = $("#nombreAsistente").val();
    var correoAsistente1 = $("#correoAsistente1").val();
    var celularAsistente = $("#celularAsistente").val();
    var nombreFinanzas = $("#nombreFinanzas").val();
    var correoFinanzas1 = $("#correoFinanzas1").val();
    var celularFinanzas = $("#celularFinanzas").val();
    var nombreRecursosHumanos = $("#nombreRecursosHumanos").val();
    var correoRecursosHumanos1 = $("#correoRecursosHumanos1").val();
    var celularRecursosHumanos = $("#celularRecursosHumanos").val();
    var comentario = $("#comentario").val();
    var logotipo = $("#logotipo").val();

    $.post(
        "updateSocio.php",
        {
            id: id,
            fechaAfiliacion: fechaAfiliacion,
            razonSocial: razonSocial,
            RFC: RFC,
            nombreComercial: nombreComercial,
            calle: calle,
            numero: numero,
            colonia: colonia,
            cp: cp,
            estado: estado,
            municipio: municipio,
            telefonoEmpresa1: telefonoEmpresa1,
            sectorEstrategico: sectorEstrategico,
            giro: giro,
            giroGeneral: giroGeneral,
            noColaboradores: noColaboradores,
            rangoVentas: rangoVentas,
            tamaño: tamaño,
            queVende: queVende,
            queCompra: queCompra,
            cuota: cuota,
            mesFactura: mesFactura,
            ejecutivoAfilio: ejecutivoAfilio,
            diaAniversario: diaAniversario,
            mesAniversario: mesAniversario,
            nombreAsociado: nombreAsociado,
            curpAsociado: curpAsociado,
            diaCumpleAsociado: diaCumpleAsociado,
            mesCumpleAsociado: mesCumpleAsociado,
            correoAsociado1: correoAsociado1,
            correoAsociado2: correoAsociado2,
            celularAsociado: celularAsociado,
            telOficinaAsociado: telOficinaAsociado,
            extensionAsociado: extensionAsociado,
            perfilAsociado: perfilAsociado,
            generoAsociado: generoAsociado,
            nombreRepresentante: nombreRepresentante,
            curpRepresentante: curpRepresentante,
            diaCumpleRepresentante: diaCumpleRepresentante,
            mesCumpleRepresentante: mesCumpleRepresentante,
            correoRepresentante1: correoRepresentante1,
            correoRepresentante2: correoRepresentante2,
            celularRepresentante: celularRepresentante,
            telOficinaRepresentante: telOficinaRepresentante,
            extensionRepresentante: extensionRepresentante,
            perfilRepresentante: perfilRepresentante,
            generoRepresentante: generoRepresentante,
            nombreAsistente: nombreAsistente,
            correoAsistente1: correoAsistente1,
            celularAsistente: celularAsistente,
            nombreFinanzas: nombreFinanzas,
            correoFinanzas1: correoFinanzas1,
            celularFinanzas: celularFinanzas,
            nombreRecursosHumanos: nombreRecursosHumanos,
            correoRecursosHumanos1: correoRecursosHumanos1,
            celularRecursosHumanos: celularRecursosHumanos,
            comentario: comentario,
            logotipo: logotipo,
        },
        function (result) {
            alert(result);
            window.location.href = "listaSocios.php";
        }
    );
}

// function editarSocio(id) {
//     $.post(
//         "editarSocio.php",
//         {
//             id: id
//         },
//         function (result) {
//             window.location.href = "editarSocio.php?id=" + id;
//         }
//     );
// }