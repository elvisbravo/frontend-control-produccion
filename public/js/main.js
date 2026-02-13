const url_backend = document.getElementById("url_backend").value;
const notificaciones = document.getElementById("notificaciones");
const url_base = document.getElementById("url_base").value;
const countNotificaciones = document.getElementById("countNotifications");
const newNoti = document.getElementById("newNoti");
const btnOffCanvasNotification = document.getElementById(
  "btnOffCanvasNotification",
);

btnOffCanvasNotification.addEventListener("click", (e) => {
  const offcanvas = new bootstrap.Offcanvas(
    document.getElementById("view-notification"),
  );
  offcanvas.show();

  notifications();
});

countNotifications();

function countNotifications() {
  fetch("countNotifications")
    .then((res) => res.json())
    .then((data) => {
      countNotificaciones.innerText = data.result.cantidad;
      newNoti.innerText = `${data.result.cantidad} nuevas notificaciones`;
    });
}

function notifications() {
  fetch("notifications")
    .then((res) => res.json())
    .then((data) => {
      const datos = data.result;

      let html = "";

      datos.forEach((noti) => {
        let nombres = `${noti.nombres} ${noti.apellidos}`;
        let iniciales = nombres
          .split(" ")
          .slice(0, 2)
          .map((p) => p[0])
          .join("");

        let transcurrido = tiempoTranscurrido(noti.created_at);

        html += `
        <div class="card bg-none mb-2">
            <div class="card-body">
                <div class="row gx-3">
                    <div class="col-auto">
                        <figure class="avatar avatar-30 rounded-circle bg-theme-1 border border-theme-1">
                            <p class="h6 fw-medium">${iniciales}</p>
                        </figure>
                    </div>
                    <div class="col">
                        <p class="small mb-2"><a href="javascript:void(0)" class="text-theme-1 style-none">${nombres}</a> "${noti.titulo}"</p>
                        <p class="small mb-2">${noti.mensaje}</p>

                        <div class="row gx-3 align-items-center">
                            <div class="col">
                                <p class="text-secondary small">${transcurrido}</p>
                            </div>
                            <div class="col-auto">
                                <a href="javascript:void(0)" class="btn btn-sm btn-square btn-link theme-red"><i class="bi bi-trash"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        `;
      });

      notificaciones.innerHTML = html;
    });
}

function tiempoTranscurrido(fechaString) {
  // Arreglar formato
  fechaString = fechaString.replace(" ", "T");

  // Si termina en -05 agregar :00
  if (/[-+]\d{2}$/.test(fechaString)) {
    fechaString += ":00";
  }

  const fecha = new Date(fechaString);
  const ahora = new Date();

  if (isNaN(fecha)) return "Fecha inválida";

  const diffSeg = Math.floor((ahora - fecha) / 1000);

  const minutos = Math.floor(diffSeg / 60);
  if (minutos < 60) return `hace ${minutos} min`;

  const horas = Math.floor(minutos / 60);
  if (horas < 24) return `hace ${horas} hora${horas > 1 ? "s" : ""}`;

  const dias = Math.floor(horas / 24);
  return `hace ${dias} día${dias > 1 ? "s" : ""}`;
}
