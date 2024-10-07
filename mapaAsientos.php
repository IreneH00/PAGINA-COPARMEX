<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mapa de Asientos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        label {
            font-weight: bold;
        }

        input {
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            padding: 10px 20px;
            font-size: 16px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        #seatingMap {
            margin-top: 30px;
            display: flex;
            flex-direction: column; 
            align-items: center; 
            position: relative;
        }

        .stage {
            width: 220px;
            height: 100px;
            background-color: #333;
            border-radius: 10px;
            margin-bottom: 20px;
            z-index: 1;
        }

        .table {
            background-color: #f7f7f7;
            border: 2px solid #ddd;
            border-radius: 10px;
            display: inline-block;
            position: relative;
            width: 250px;
            height: 100px;
            margin-bottom: 20px;
        }

        .main-table {
            background-color: #ffb800;
        }

        .main-table .seat {
            background-color: #ff4d4d;
            border-radius: 5px;
            position: absolute;
            width: 20px;
            height: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
        }

        .main-table .seat.top {
            top: -15px;
        }
        .main-table .seat.bottom {
            bottom: -15px;
        }
        .main-table .seat.left {
            left: -15px;
        }
        .main-table .seat.right {
            right: -15px;
        }

        .secondary-table-container {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            justify-items: center;
            margin-top: 20px;
        }

        .secondary-table {
            width: 100px;
            height: 100px;
            background-color: #f7f7f7;
            border: 2px solid #ddd;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }

        .secondary-seat {
            position: absolute;
            width: 20px;
            height: 20px;
            background-color: #007bff;
            color: white;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Mapa de Asientos</h1>
    <form id="seatingForm">
        <label for="numMesas">Número de mesas secundarias:</label>
        <input type="number" id="numMesas" min="1" placeholder="Ingresa el número de mesas" required>

        <label for="asientosPorMesa">Asientos por mesa secundaria:</label>
        <input type="number" id="asientosPorMesa" min="1" placeholder="Asientos por mesa" required>

        <label for="asientosMesaPrincipal">Asientos en la mesa principal:</label>
        <input type="number" id="asientosMesaPrincipal" min="1" placeholder="Asientos en la mesa principal" required>

        <button type="submit">Generar Mapa</button>
    </form>

    <div id="seatingMap">
        <div class="stage"></div> <!-- Escenario -->
    </div>
</div>

<script>
    document.getElementById('seatingForm').addEventListener('submit', function (e) {
        e.preventDefault();
        
        // Obtener valores del formulario
        const numMesas = document.getElementById('numMesas').value;
        const asientosPorMesa = document.getElementById('asientosPorMesa').value;
        const asientosMesaPrincipal = document.getElementById('asientosMesaPrincipal').value;

        // Limpiar el contenedor de mapa de asientos
        const seatingMap = document.getElementById('seatingMap');
        seatingMap.innerHTML = '<div class="stage"></div>'; // Mantener el escenario

        // Crear mesa principal
        const mainTable = document.createElement('div');
        mainTable.classList.add('table', 'main-table');
        mainTable.innerHTML = `<strong>Mesa Principal</strong>`;

        // Calcular la cantidad de asientos y posicionarlos alrededor de la mesa principal
        const numSeats = parseInt(asientosMesaPrincipal);
        for (let i = 1; i <= numSeats; i++) {
            const seat = document.createElement('div');
            seat.classList.add('seat');

            // Posicionamiento de asientos alrededor de la mesa
            if (i <= 2) { 
                seat.classList.add('top');
                seat.style.left = `${(i - 1) * 140 + 50}px`;
            } else if (i <= 4) {
                seat.classList.add('bottom');
                seat.style.left = `${(i - 3) * 140 + 50}px`;
            } else if (i <= 6) {
                seat.classList.add('left');
                seat.style.top = `${(i - 5) * 60 + 30}px`;
            } else {
                seat.classList.add('right');
                seat.style.top = `${(i - 7) * 60 + 30}px`;
            }

            seat.textContent = i; 
            mainTable.appendChild(seat);
        }
        seatingMap.appendChild(mainTable);

        // Crear contenedor para mesas secundarias
        const secondaryContainer = document.createElement('div');
        secondaryContainer.classList.add('secondary-table-container');

        // Crear mesas secundarias
        for (let j = 1; j <= numMesas; j++) {
            const table = document.createElement('div');
            table.classList.add('secondary-table');
            table.innerHTML = `<strong>Mesa ${j}</strong>`;

            // Calcular y posicionar los asientos en las mesas secundarias
            const radius = 30;
            const numSeats = parseInt(asientosPorMesa);
            for (let k = 1; k <= numSeats; k++) {
                const seat = document.createElement('div');
                seat.classList.add('seat', 'secondary-seat');

                const angle = (2 * Math.PI / numSeats) * k;
                seat.style.left = `${40 + radius * Math.cos(angle)}px`; 
                seat.style.top = `${40 + radius * Math.sin(angle)}px`; 

                seat.textContent = k; 
                table.appendChild(seat);
            }
            secondaryContainer.appendChild(table);
        }
        seatingMap.appendChild(secondaryContainer);
    });
</script>

</body>
</html>
