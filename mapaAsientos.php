<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mapa de Asientos</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
        }
        #canvas-container {
            width: 100vw;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        form {
            position: absolute;
            top: 20px;
            left: 20px;
            background-color: rgba(255, 255, 255, 0.8);
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            z-index: 1;
        }
        label, input, button {
            display: block;
            margin-bottom: 10px;
        }
        button {
            background-color: #007BFF;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3; 
        }
    </style>
</head>
<body>

<div id="canvas-container"></div>

<form id="seatForm">
    <label for="mesas">Número de mesas:</label>
    <input type="number" id="mesas" name="mesas" min="1" required>

    <label for="asientos">Asientos por mesa:</label>
    <input type="number" id="asientos" name="asientos" min="1" required>

    <label for="mesaPrincipal">Asientos en mesa principal:</label>
    <input type="number" id="mesaPrincipal" name="mesaPrincipal" min="1" required>

    <button type="submit">Generar Mapa</button>
</form>


<script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/three@0.128.0/examples/js/controls/OrbitControls.js"></script>

<script>
    let scene, camera, renderer, controls;
    let tablesGroup, stageGroup;

    function init() {
        const container = document.getElementById('canvas-container');

        
        scene = new THREE.Scene();
        scene.background = new THREE.Color(0xf4f4f4);

       
        camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);
        camera.position.set(0, 200, 400);

      
        renderer = new THREE.WebGLRenderer({ antialias: true });
        renderer.setSize(window.innerWidth, window.innerHeight);
        renderer.shadowMap.enabled = true; 
        container.appendChild(renderer.domElement);

      
        controls = new THREE.OrbitControls(camera, renderer.domElement);
        controls.enableDamping = true;
        controls.dampingFactor = 0.05;
        controls.maxPolarAngle = Math.PI / 2; 

        
        const ambientLight = new THREE.AmbientLight(0xffffff, 0.6);
        scene.add(ambientLight);

        
        const directionalLight = new THREE.DirectionalLight(0xffffff, 1);
        directionalLight.position.set(100, 200, 100);
        directionalLight.castShadow = true;
        scene.add(directionalLight);

        // SUELO
        const floorGeometry = new THREE.PlaneGeometry(1000, 1000);
        const floorMaterial = new THREE.MeshStandardMaterial({ color: 0x555555 });
        const floor = new THREE.Mesh(floorGeometry, floorMaterial);
        floor.rotation.x = -Math.PI / 2;
        floor.receiveShadow = true;
        scene.add(floor);

        
        tablesGroup = new THREE.Group();
        scene.add(tablesGroup);

       
        stageGroup = new THREE.Group();
        scene.add(stageGroup);

       
        crearEscenario();

       
        animate();
    }

    function animate() {
        requestAnimationFrame(animate);
        controls.update(); 
        renderer.render(scene, camera);
    }

    function crearMesaConSillas(numAsientos, anchoMesa, largoMesa, esPrincipal, x, z, rotacion=0) {
        const texturaMesa = new THREE.TextureLoader().load('https://images.pexels.com/photos/7078052/pexels-photo-7078052.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1');
        const texturaSilla = new THREE.TextureLoader().load('https://images.pexels.com/photos/82256/pexels-photo-82256.jpeg');

        let mesaGeometry, mesaMaterial;

        if (esPrincipal) {
           
            mesaGeometry = new THREE.BoxGeometry(anchoMesa, 20, largoMesa);
            mesaMaterial = new THREE.MeshStandardMaterial({
                map: texturaMesa,
                color: 0xFFD700
            });
        } else {
           
            mesaGeometry = new THREE.CylinderGeometry(50, 50, 10, 32);
            mesaMaterial = new THREE.MeshStandardMaterial({
                map: texturaMesa,
                color: 0xffffff
            });
        }

        const mesa = new THREE.Mesh(mesaGeometry, mesaMaterial);
        mesa.position.set(x, 5, z);
        mesa.castShadow = true;
        mesa.receiveShadow = true;

        if (esPrincipal) {
            mesa.rotation.y = rotacion;
        }

        tablesGroup.add(mesa);

      
        const sillaMaterial = new THREE.MeshStandardMaterial({ map: texturaSilla });
        let sillaGeometry;

        if (esPrincipal) {
           
            sillaGeometry = new THREE.BoxGeometry(10, 20, 10);
            const numSillasPorLado = Math.ceil(numAsientos / 4);
            const spacingX = anchoMesa / (numSillasPorLado + 1);
            const spacingZ = largoMesa / (numSillasPorLado + 1);

            let count = 0;

            for (let i = 1; i <= numSillasPorLado && count < numAsientos; i++) {
                const posX = x - anchoMesa / 2 + i * spacingX;
                const posZFront = z - largoMesa / 2 - 15;
                const posZBack = z + largoMesa / 2 + 15;

               
                const sillaFront = new THREE.Mesh(sillaGeometry, sillaMaterial);
                sillaFront.position.set(posX, 15, posZFront);
                sillaFront.lookAt(new THREE.Vector3(x, 15, z));
                sillaFront.castShadow = true;
                tablesGroup.add(sillaFront);
                count++;

               
                if (count < numAsientos) {
                    const sillaBack = new THREE.Mesh(sillaGeometry, sillaMaterial);
                    sillaBack.position.set(posX, 15, posZBack);
                    sillaBack.lookAt(new THREE.Vector3(x, 15, z));
                    sillaBack.castShadow = true;
                    tablesGroup.add(sillaBack);
                    count++;
                }
            }

          
            const numSillasLargo = Math.ceil(numAsientos / 2 / 2); 
            for (let i = 1; i <= numSillasLargo && count < numAsientos; i++) {
                const posZ = z - largoMesa / 2 + i * spacingZ;
                const posXLeft = x - anchoMesa / 2 - 15;
                const posXRight = x + anchoMesa / 2 + 15;

                
                const sillaLeft = new THREE.Mesh(sillaGeometry, sillaMaterial);
                sillaLeft.position.set(posXLeft, 15, posZ);
                sillaLeft.rotation.y = Math.PI / 2;
                sillaLeft.castShadow = true;
                tablesGroup.add(sillaLeft);
                count++;

               
                if (count < numAsientos) {
                    const sillaRight = new THREE.Mesh(sillaGeometry, sillaMaterial);
                    sillaRight.position.set(posXRight, 15, posZ);
                    sillaRight.rotation.y = Math.PI / 2;
                    sillaRight.castShadow = true;
                    tablesGroup.add(sillaRight);
                    count++;
                }
            }
        } else {
           
            const sillaGeometryCircular = new THREE.BoxGeometry(10, 20, 10);
            for (let i = 0; i < numAsientos; i++) {
                const angulo = (2 * Math.PI / numAsientos) * i;

                const sx = x + (60 + 20) * Math.cos(angulo);
                const sz = z + (60 + 20) * Math.sin(angulo);

                const silla = new THREE.Mesh(sillaGeometryCircular, sillaMaterial);
                silla.position.set(sx, 15, sz);
                silla.lookAt(new THREE.Vector3(x, 15, z));
                silla.castShadow = true;
                tablesGroup.add(silla);
            }
        }
    }

    function crearEscenario() {
    
    const texturaEscenario = new THREE.TextureLoader().load('https://images.pexels.com/photos/7233108/pexels-photo-7233108.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1'); // Puedes cambiar esta URL por otra textura si lo deseas
    const escenarioMaterial = new THREE.MeshStandardMaterial({ 
        map: texturaEscenario,
        color: 0x444444, 
        side: THREE.DoubleSide 
    });
    const escenarioGeometry = new THREE.BoxGeometry(300, 150, 10);

    const escenario = new THREE.Mesh(escenarioGeometry, escenarioMaterial);
   escenario.position.set(0, 50, -400);
 
    escenario.receiveShadow = true;
    escenario.castShadow = true;

    stageGroup.add(escenario);
}


    document.getElementById('seatForm').addEventListener('submit', function(event) {
        event.preventDefault();

       
        while (tablesGroup.children.length > 0) {
            const obj = tablesGroup.children[0];
            tablesGroup.remove(obj);
        }

        const mesas = parseInt(document.getElementById('mesas').value);
        const asientos = parseInt(document.getElementById('asientos').value);

       
        if (mesas > 40 || asientos > 20) {
            alert("Por favor ingresa un número razonable (máximo 40 mesas y 20 asientos por mesa).");
            return;
        }

        const mesaPrincipal = parseInt(document.getElementById('mesaPrincipal').value);

    
        crearMesaConSillas(mesaPrincipal, 120, 80, true, 0, 100, 0); 

        
        const columnas = 4;
        const filas = Math.ceil(mesas / columnas);
        const espacioX = 200; 
        const espacioZ = 150; 
        const inicioX = -((columnas - 1) * espacioX) / 2;
        const inicioZ = 200 + espacioZ; 

        let mesaActual = 0;

        for (let fila = 0; fila < filas; fila++) {
            for (let col = 0; col < columnas; col++) {
                if (mesaActual >= mesas) break;

                const x = inicioX + col * espacioX;
                const z = inicioZ + fila * espacioZ;

                crearMesaConSillas(asientos, 50, 50, false, x, z);
                mesaActual++;
            }
        }
    });

    window.addEventListener('resize', function () {
         camera.aspect = window.innerWidth / window.innerHeight;
         camera.updateProjectionMatrix();
         renderer.setSize(window.innerWidth, window.innerHeight);
     });

     init();
</script>

</body>
</html>