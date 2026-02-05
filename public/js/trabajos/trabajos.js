"use strict";

function renderTrabajosRow(t) {
  var contactos = (t.contactos || []).join("<br>");
  var auxiliares = (t.auxiliares || []).join("<br>");

  return `
    <tr data-id="${t.id}">
      <td>${t.id}</td>
      <td>${contactos}</td>
      <td>${t.titulo}</td>
      <td>${t.tipo}</td>
      <td>${t.fecha_inicio || "-"}</td>
      <td>${t.fecha_entrega || "-"}</td>
      <td>${auxiliares}</td>
      <td>
        <button class="btn btn-sm btn-square btn-link btn-ver" data-id="${t.id}" title="Ver"><i class="bi bi-eye"></i></button>
        <button class="btn btn-sm btn-square btn-link btn-asignar" data-id="${t.id}" title="Asignar Auxiliares"><i class="bi bi-person-plus"></i></button>
        <button class="btn btn-sm btn-square btn-link btn-editar" data-id="${t.id}" title="Editar"><i class="bi bi-pencil"></i></button>
      </td>
    </tr>
  `;
}

function loadTrabajos() {
  var table = document.getElementById("trabajosGrid");
  if (!table) return;

  fetch("/trabajos/data", { credentials: "same-origin" })
    .then(function (r) {
      return r.json();
    })
    .then(function (json) {
      if (!json || !json.success) {
        console.error("Error cargando trabajos", json);
        return;
      }

      var tbody = table.querySelector("tbody");
      tbody.innerHTML = "";
      json.data.forEach(function (t) {
        tbody.insertAdjacentHTML("beforeend", renderTrabajosRow(t));
      });

      // Initialize or refresh DataTable
      if (
        typeof $ !== "undefined" &&
        typeof $.fn !== "undefined" &&
        typeof $.fn.DataTable !== "undefined"
      ) {
        // If already initialized, destroy to re-init with new data
        if ($.fn.DataTable.isDataTable("#trabajosGrid")) {
          $("#trabajosGrid").DataTable().destroy();
        }

        $("#trabajosGrid").DataTable({
          searching: true,
          lengthChange: true,
          autoWidth: false,
          responsive: true,
          order: [[0, "desc"]],
          pageLength: 10,
        });

        // Use delegated events because DataTable may redraw rows
        $("#trabajosGrid tbody")
          .off("click", ".btn-ver")
          .on("click", ".btn-ver", function () {
            var id = $(this).data("id");
            alert("Ver trabajo " + id);
          });

        $("#trabajosGrid tbody")
          .off("click", ".btn-asignar")
          .on("click", ".btn-asignar", function () {
            var id = $(this).data("id");
            abrirModalDisponibilidad(id);
          });

        $("#trabajosGrid tbody")
          .off("click", ".btn-editar")
          .on("click", ".btn-editar", function () {
            var id = $(this).data("id");
            alert("Editar trabajo " + id);
          });
      } else {
        attachRowEvents();
      }
    })
    .catch(function (err) {
      console.error("Error fetching trabajos:", err);
    });
}

function attachRowEvents() {
  document.querySelectorAll("#trabajosGrid .btn-ver").forEach(function (btn) {
    btn.addEventListener("click", function () {
      var id = this.getAttribute("data-id");
      // abrir modal detalle (implementar según necesidades)
      alert("Ver trabajo " + id);
    });
  });

  document
    .querySelectorAll("#trabajosGrid .btn-asignar")
    .forEach(function (btn) {
      btn.addEventListener("click", function () {
        var id = this.getAttribute("data-id");
        alert("Asignar auxiliares a trabajo " + id);
      });
    });

  document
    .querySelectorAll("#trabajosGrid .btn-editar")
    .forEach(function (btn) {
      btn.addEventListener("click", function () {
        var id = this.getAttribute("data-id");
        alert("Editar trabajo " + id);
      });
    });
}

if (document.readyState === "loading") {
  document.addEventListener("DOMContentLoaded", loadTrabajos);
} else {
  loadTrabajos();
}
// ============ DISPONIBILIDAD SIMULADOR ============

function abrirModalDisponibilidad(trabajoId) {
  var modal = document.getElementById("modalDisponibilidad");
  document.getElementById("trabajoIdDisp").value = trabajoId;

  // Mostrar modal
  if (typeof bootstrap !== "undefined") {
    var bsModal = new bootstrap.Modal(modal);
    bsModal.show();
  }

  // Cargar disponibilidad
  cargarDisponibilidad();
  cargarReporteDisponibilidad();
}

function cargarDisponibilidad() {
  var listado = document.getElementById("listadoDisponibles");
  listado.innerHTML =
    '<div class="spinner-border spinner-border-sm" role="status"><span class="visually-hidden">Cargando...</span></div>';

  fetch("/trabajos/sugerir?cantidad=10", { credentials: "same-origin" })
    .then(function (r) {
      return r.json();
    })
    .then(function (json) {
      if (!json || !json.success) {
        listado.innerHTML =
          '<p class="text-danger">Error al cargar disponibilidad</p>';
        return;
      }

      var html = "";
      json.data.forEach(function (aux) {
        var estadoColor =
          {
            disponible: "success",
            moderado: "warning",
            ocupado: "danger",
          }[aux.estado] || "secondary";

        var barraAncho = Math.min(aux.porcentaje, 100);
        html += `
          <div class="card mb-2">
            <div class="card-body p-3">
              <div class="row align-items-center">
                <div class="col-md-4">
                  <strong>${aux.nombre} ${aux.apellidos}</strong><br>
                  <small class="text-secondary">@${aux.usuario}</small>
                </div>
                <div class="col-md-6">
                  <div class="progress" style="height: 20px;">
                    <div class="progress-bar bg-${estadoColor}" role="progressbar" 
                         style="width: ${barraAncho}%" 
                         aria-valuenow="${aux.porcentaje}" aria-valuemin="0" aria-valuemax="100">
                      ${Math.round(aux.porcentaje)}%
                    </div>
                  </div>
                  <small class="text-secondary">${aux.horas_actuales}/${aux.capacidad_maxima} horas</small>
                </div>
                <div class="col-md-2 text-end">
                  <button class="btn btn-sm btn-outline-primary btn-asignar-aux" data-aux-id="${aux.id}" data-aux-name="${aux.nombre}">
                    Asignar
                  </button>
                </div>
              </div>
            </div>
          </div>
        `;
      });

      listado.innerHTML = html;

      // Agregar eventos a botones asignar
      document.querySelectorAll(".btn-asignar-aux").forEach(function (btn) {
        btn.addEventListener("click", function () {
          var auxId = this.getAttribute("data-aux-id");
          var auxName = this.getAttribute("data-aux-name");
          var trabajoId = document.getElementById("trabajoIdDisp").value;

          // Placeholder: implementar guardado en BD
          if (typeof Swal !== "undefined") {
            Swal.fire("Éxito", "Trabajo asignado a " + auxName, "success").then(
              function () {
                bootstrap.Modal.getInstance(
                  document.getElementById("modalDisponibilidad"),
                ).hide();
                location.reload();
              },
            );
          } else {
            alert("Trabajo asignado a " + auxName + " (ID: " + auxId + ")");
          }
        });
      });
    })
    .catch(function (err) {
      console.error("Error:", err);
      listado.innerHTML = '<p class="text-danger">Error de red</p>';
    });
}

function cargarReporteDisponibilidad() {
  var reporte = document.getElementById("reporteCarga");
  reporte.innerHTML =
    '<small class="text-secondary">Cargando reporte...</small>';

  fetch("/trabajos/reporte", { credentials: "same-origin" })
    .then(function (r) {
      return r.json();
    })
    .then(function (json) {
      if (!json || !json.success) {
        reporte.innerHTML =
          '<p class="text-danger">Error al cargar reporte</p>';
        return;
      }

      var res = json.reporte.resumen;
      var html = `
        <div class="row text-center">
          <div class="col-md-4">
            <div class="card border-success">
              <div class="card-body">
                <h5 class="card-title text-success">${res.disponible}</h5>
                <p class="card-text small">Disponibles</p>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card border-warning">
              <div class="card-body">
                <h5 class="card-title text-warning">${res.moderado}</h5>
                <p class="card-text small">Carga Moderada</p>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card border-danger">
              <div class="card-body">
                <h5 class="card-title text-danger">${res.ocupado}</h5>
                <p class="card-text small">Ocupados</p>
              </div>
            </div>
          </div>
        </div>
      `;
      reporte.innerHTML = html;
    })
    .catch(function (err) {
      console.error("Error:", err);
      reporte.innerHTML = '<p class="text-danger">Error de red</p>';
    });
}
