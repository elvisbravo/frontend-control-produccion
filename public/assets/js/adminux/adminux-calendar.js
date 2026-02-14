document.addEventListener("DOMContentLoaded", function () {

  var calendarElement = document.getElementById("calendar");

  var calendar = new Calendar(calendarElement, {
    plugins: [dayGridPlugin, timeGridPlugin, listPlugin],

    initialView: "timeGridWeek",
    locale: "es",
    height: "auto",

    slotMinTime: "07:00:00",

    headerToolbar: {
      left: "prev,next today",
      center: "title",
      right: "dayGridMonth,timeGridWeek,timeGridDay",
    },

    events: function (info, successCallback, failureCallback) {
      fetch("horario-by-id")
        .then((response) => response.json())
        .then((data) => {

          const eventos = data.result.map((evento) => ({
            id: evento.id,
            title: evento.title,
            start: evento.start,
            end: evento.end,
            className: evento.className,
          }));

          successCallback(eventos);
        })
        .catch((error) => {
          console.error("Error cargando eventos:", error);
          failureCallback(error);
        });
    },

    eventContent: function (info) {

      // Obtener SOLO la hora de inicio
      let horaInicio = "";

      if (info.event.start) {
        horaInicio = info.event.start.toLocaleTimeString('es-PE', {
          hour: '2-digit',
          minute: '2-digit',
          hour12: true
        });
      }

      return {
        html: `
          <div style="cursor: pointer;">
            ${horaInicio ? `<div style="font-size:12px;font-weight:600;">${horaInicio}</div>` : ""}
            <div>${info.event.title}</div>
          </div>
        `
      };
    },

    eventClick: function (info) {
      const event = info.event;

      let horaInicio = event.start ? event.start.toLocaleTimeString('es-PE', { hour: '2-digit', minute: '2-digit', hour12: true }) : "N/A";
      let horaFin = event.end ? event.end.toLocaleTimeString('es-PE', { hour: '2-digit', minute: '2-digit', hour12: true }) : "N/A";
      let fecha = event.start ? event.start.toLocaleDateString('es-PE', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' }) : "N/A";

      Swal.fire({
        title: `<span class="h5">${event.title}</span>`,
        html: `
          <div class="text-start">
            <p class="mb-2"><strong><i class="bi bi-calendar-event me-2"></i>Fecha:</strong> <br><span class="text-secondary">${fecha}</span></p>
            <p class="mb-2"><strong><i class="bi bi-clock me-2"></i>Horario:</strong> <br><span class="text-secondary">${horaInicio}</span></p>
          </div>
        `,
        icon: 'info',
        confirmButtonText: 'Cerrar',
        confirmButtonColor: 'var(--adminuiux-theme-1)',
        customClass: {
          title: 'text-theme-1',
          popup: 'rounded-4 shadow'
        }
      });
    }

  });

  calendar.render();
});
