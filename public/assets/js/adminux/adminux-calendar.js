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
            start: evento.created_at,
            end: evento.end,
            className: evento.className,
            // Agregamos los campos adicionales
            contenido: evento.contenido || "",
            linkDrive: evento.linkDrive || "",
            horas_programacion: evento.horas_programacion || "",
            // Prospecto
            cliente_nombre: `${evento.prospecto_nombres || '--'} ${evento.prospecto_apellidos || ''}`,
            cliente_celular: evento.prospecto_celular || '--',
            cliente_origen: evento.prospecto_origen || '--',
            cliente_nivel: evento.prospecto_nivel || '--',
            cliente_universidad: evento.prospecto_universidad || '--',
            cliente_carrera: evento.prospecto_carrera || '--',
            entrega_tentativa: evento.fecha_entrega_tentativa || '--'
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
      const props = event.extendedProps;

      let horaInicio = event.start ? event.start.toLocaleTimeString('es-PE', { hour: '2-digit', minute: '2-digit', hour12: true }) : "N/A";
      let fecha = event.start ? event.start.toLocaleDateString('es-PE', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' }) : "N/A";
      let horaRegistro = event.created_at ? event.created_at.toLocaleTimeString('es-PE', { hour: '2-digit', minute: '2-digit', hour12: true }) : "N/A";

      Swal.fire({
        title: `<span class="h5">${event.title}</span>`,
        html: `
          <div class="text-start">
            <div class="row mb-3">
                <div class="col-md-6">
                    <p class="mb-1 text-secondary small"><strong><i class="bi bi-calendar-event me-2"></i>Fecha:</strong></p>
                    <p class="ms-4">${fecha}</p>
                </div>
                <div class="col-md-6">
                    <p class="mb-1 text-secondary small"><strong><i class="bi bi-clock me-2"></i>Horario:</strong></p>
                    <p class="ms-4">${horaRegistro}</p>
                </div>
            </div>

            <div class="card bg-light border-0 mb-3">
                <div class="card-body p-3">
                    <h6 class="mb-3"><span class="badge bg-secondary">Información del Cliente</span></h6>
                    <div class="row g-2">
                        <div class="col-12">
                            <p class="text-secondary small mb-0">Nombre Completo:</p>
                            <p class="fw-bold mb-2">${props.cliente_nombre}</p>
                        </div>
                        <div class="col-6">
                            <p class="text-secondary small mb-0">Celular:</p>
                            <p class="mb-2">${props.cliente_celular}</p>
                        </div>
                        <div class="col-6">
                            <p class="text-secondary small mb-0">Origen:</p>
                            <p class="mb-2">${props.cliente_origen}</p>
                        </div>
                        <div class="col-6">
                            <p class="text-secondary small mb-0">Nivel:</p>
                            <p class="mb-2">${props.cliente_nivel}</p>
                        </div>
                        <div class="col-6">
                            <p class="text-secondary small mb-0">Entrega Tentativa:</p>
                            <p class="mb-2 text-primary fw-bold">${props.entrega_tentativa}</p>
                        </div>
                        <div class="col-12">
                            <p class="text-secondary small mb-0">Universidad:</p>
                            <p class="mb-2">${props.cliente_universidad}</p>
                        </div>
                        <div class="col-12">
                            <p class="text-secondary small mb-0">Carrera:</p>
                            <p class="mb-1">${props.cliente_carrera}</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <hr>

            <div class="mb-3">
              <label class="form-label fw-bold"><i class="bi bi-file-text me-2"></i>Contenido del Trabajo:</label>
              <div class="border rounded p-3 bg-light" style="max-height: 250px; overflow-y: auto;">
                ${props.contenido || '<span class="text-muted small">Sin contenido registrado.</span>'}
              </div>
            </div>

            <div class="mb-3">
              <label class="form-label fw-bold"><i class="bi bi-hdd me-2"></i>Link Drive:</label>
              <div class="input-group">
                <input type="text" id="link_drive" class="form-control" value="${props.linkDrive}" placeholder="Ingrese el link del drive">
                ${props.linkDrive ? `<a href="${props.linkDrive}" target="_blank" class="btn btn-outline-theme" id="btn_go_drive"><i class="bi bi-box-arrow-up-right"></i></a>` : ''}
              </div>
            </div>

            <div class="mb-3">
                <label for="horas_programacion" class="form-label fw-bold"><i class="bi bi-hourglass-split me-2"></i>Horas de Programación:</label>
                <input type="number" step="0.5" id="horas_programacion" class="form-control" placeholder="Ingrese horas estimadas" value="${props.horas_programacion}">
            </div>
          </div>
        `,
        showCancelButton: true,
        confirmButtonText: '<i class="bi bi-check-circle me-2"></i>Empezar',
        cancelButtonText: 'Cerrar',
        confirmButtonColor: 'var(--adminuiux-theme-1)',
        customClass: {
          title: 'text-theme-1',
          popup: 'rounded-4 shadow'
        }
      }).then((result) => {
        if (result.isConfirmed) {
          const nuevasHoras = document.getElementById('horas_programacion').value;
          const nuevoLink = document.getElementById('link_drive').value;
          // Aquí se podría implementar la lógica para guardar los datos
          console.log("Datos a guardar:", { horas: nuevasHoras, link: nuevoLink }, "para el evento:", event.id);
        }
      });
    }

  });

  window.calendarInstance = calendar;
  calendar.render();

  // Escuchar el cambio de tabs para redimensionar el calendario
  const calendarTab = document.getElementById('calendar-tab');
  if (calendarTab) {
    calendarTab.addEventListener('shown.bs.tab', function () {
      if (window.calendarInstance) {
        window.calendarInstance.updateSize();
      }
    });
  }
});
