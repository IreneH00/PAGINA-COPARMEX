<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Centro de Notificaciones</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .notification-center {
            width: 300px;
            position: fixed;
            top: 20px;
            right: 20px;
            background-color: #ffffff;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .notification-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
            background-color: #007bff;
            color: #ffffff;
        }

        .notification-header h2 {
            margin: 0;
            font-size: 16px;
        }

        #clearAllBtn {
            background: none;
            border: none;
            color: #ffffff;
            cursor: pointer;
            font-size: 14px;
        }

        .notification-list {
            max-height: 400px;
            overflow-y: auto;
        }

        .notification-item {
            padding: 10px;
            border-bottom: 1px solid #ddd;
            background-color: #f9f9f9;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .notification-item:last-child {
            border-bottom: none;
        }

        .notification-item p {
            margin: 0;
            font-size: 14px;
        }

        .notification-item button {
            background: none;
            border: none;
            color: #007bff;
            cursor: pointer;
            font-size: 12px;
        }

        .notification-item button:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="notification-center">
        <div class="notification-header">
            <h2>Notificaciones</h2>
            <button id="clearAllBtn">Limpiar Todo</button>
        </div>
        <div class="notification-list" id="notificationList">
            <!-- Las notificaciones se añadirán aquí dinámicamente -->
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const clearAllBtn = document.getElementById('clearAllBtn');
            const notificationList = document.getElementById('notificationList');

            // Simula algunas notificaciones
            const notifications = [
                { id: 1, message: 'Nueva actualización disponible.', timestamp: 'Hace 5 minutos' },
                { id: 2, message: 'Recordatorio: Reunión a las 3 PM.', timestamp: 'Hace 10 minutos' },
                { id: 3, message: 'Tu informe ha sido aprobado.', timestamp: 'Hace 20 minutos' }
            ];

            // Función para renderizar notificaciones
            function renderNotifications() {
                notificationList.innerHTML = '';
                notifications.forEach(notification => {
                    const notificationItem = document.createElement('div');
                    notificationItem.className = 'notification-item';
                    notificationItem.innerHTML = `
                        <p>${notification.message} <span style="font-size: 12px; color: #666;">(${notification.timestamp})</span></p>
                        <button onclick="removeNotification(${notification.id})">Eliminar</button>
                    `;
                    notificationList.appendChild(notificationItem);
                });
            }

            // Función para eliminar notificaciones
            window.removeNotification = function(id) {
                const index = notifications.findIndex(n => n.id === id);
                if (index !== -1) {
                    notifications.splice(index, 1);
                    renderNotifications();
                }
            }

            // Elimina todas las notificaciones
            clearAllBtn.addEventListener('click', () => {
                notifications.length = 0; // Vacía el array de notificaciones
                renderNotifications();
            });

            // Renderiza las notificaciones al cargar la página
            renderNotifications();
        });
    </script>
</body>
</html>
