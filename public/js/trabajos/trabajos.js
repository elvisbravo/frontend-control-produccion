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
            alert("Asignar auxiliares a trabajo " + id);
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
