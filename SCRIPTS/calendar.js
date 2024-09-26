var elements = {
    calendar: document.getElementById("events-calendar"),
    events: document.getElementById("events")
};

elements.calendar.className = "clean-theme";
var calendar = jsCalendar.new(elements.calendar);

elements.title = document.createElement("div");
elements.title.className = "title";
elements.events.appendChild(elements.title);

elements.subtitle = document.createElement("div");
elements.subtitle.className = "subtitle";
elements.events.appendChild(elements.subtitle);

elements.list = document.createElement("div");
elements.list.className = "list";
elements.events.appendChild(elements.list);

elements.actions = document.createElement("div");
elements.actions.className = "action";
elements.events.appendChild(elements.actions);

elements.addButton = document.createElement("input");
elements.addButton.type = "button";
elements.addButton.value = "Añadir Nuevo";
elements.actions.appendChild(elements.addButton);

var events = JSON.parse(localStorage.getItem("events")) || {};
var date_format = "DD/MM/YYYY";
var current = null;

var showEvents = function (date) {
    var id = jsCalendar.tools.dateToString(date, date_format, "es");
    current = new Date(date.getTime());
    elements.title.textContent = id;
    elements.list.innerHTML = "";

    if (events.hasOwnProperty(id) && events[id].length) {
        elements.subtitle.textContent = events[id].length + " " + ((events[id].length > 1) ? "eventos" : "evento");

        for (var i = 0; i < events[id].length; i++) {
            var div = document.createElement("div");
            div.className = "event-item";
            div.textContent = (i + 1) + ". " + events[id][i].name + " - " + events[id][i].evento + " - " + events[id][i].fechaFin + " - " + events[id][i].horaInic + " - " + events[id][i].horaFin;
            elements.list.appendChild(div);

            var close = document.createElement("div");
            close.className = "close";
            close.textContent = "☠️";
            div.appendChild(close);

            close.setAttribute("data-index", i);
            close.addEventListener("click", function (event) {
                var index = event.target.getAttribute("data-index");
                removeEvent(date, index);
            });
        }
    } else {
        elements.subtitle.textContent = "Aún no hay eventos registrados";
    }
};

var removeEvent = function (date, index) {
    var id = jsCalendar.tools.dateToString(date, date_format, "es");

    if (!events.hasOwnProperty(id)) {
        return;
    }

    if (events[id].length <= index) {
        return;
    }

    events[id].splice(index, 1);
    localStorage.setItem("events", JSON.stringify(events));
    showEvents(current);

    if (events[id].length === 0) {
        calendar.unselect(date);
    }
};

showEvents(new Date());

calendar.onDateClick(function (event, date) {
    calendar.set(date);
    showEvents(date);
});

elements.addButton.addEventListener("click", function () {
    Swal.fire({
        title: 'Agenda un nuevo evento',
        html:
            '<input id="swal-name" class="swal2-input" placeholder="Ejecutivo">' +
            '<input id="swal-evento" class="swal2-input" placeholder="Nombre del aula">' +
            '<input type="date" id="swal-fechaFin" class="swal2-input" placeholder="Fecha en la que finaliza el evento">' +
            '<input type="time" id="swal-horaInic" class="swal2-input" placeholder="Hora de inicio (HH:MM)">' +
            '<input type="time" id="swal-horaFin" class="swal2-input" placeholder="Hora de fin (HH:MM)">',
        focusConfirm: false,
        preConfirm: () => {
            return {
                name: document.getElementById('swal-name').value,
                evento: document.getElementById('swal-evento').value,
                fechaFin: document.getElementById('swal-fechaFin').value,
                horaInic: document.getElementById('swal-horaInic').value,
                horaFin: document.getElementById('swal-horaFin').value
            };
        }
    }).then((result) => {
        if (result.isConfirmed) {
            var data = result.value;
            if (!data.name || !data.evento || !data.fechaFin || !data.horaInic || !data.horaFin) {
                Swal.fire('Error', 'Todos los campos son obligatorios', 'error');
                return;
            }

            var id = jsCalendar.tools.dateToString(current, date_format, "es");

            fetch('guardarAgenda.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    ...data,
                    fechaInic: id
                })
            })
            .then(response => response.json())
            .then(responseData => {
                if (responseData.status === 'success') {
                    if (!events.hasOwnProperty(id)) {
                        calendar.select(current);
                        events[id] = [];
                    }
                    events[id].push({ name: data.name, evento: data.evento, fechaInic: id, fechaFin: data.fechaFin, horaInic: data.horaInic, horaFin: data.horaFin });
                    localStorage.setItem("events", JSON.stringify(events));
                    showEvents(current);
                } else {
                    Swal.fire('Error', responseData.message, 'error');
                }
            })
            .catch((error) => {
                console.error('Error:', error);
                Swal.fire('Error', 'Ocurrió un error al guardar el evento', 'error');
            });
        }
    });
});

document.addEventListener("DOMContentLoaded", function () {
    fetch('api.php')
        .then(response => response.json())
        .then(data => {
            data.forEach(evento => {
                var id = jsCalendar.tools.dateToString(new Date(evento.fechaInic), date_format, "es");
                if (!events.hasOwnProperty(id)) {
                    events[id] = [];
                }
                events[id].push(evento);
            });
            localStorage.setItem("events", JSON.stringify(events));
            showEvents(new Date());
        })
        .catch(error => console.error('Error:', error));
});
