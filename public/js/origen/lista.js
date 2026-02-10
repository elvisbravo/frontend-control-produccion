"use strict";

let origenTable;

document.addEventListener("DOMContentLoaded", function () {
  initDataTable();
  inicializarEventosOrigen();
});

function initDataTable() {
  if (typeof $ === "undefined") {
    setTimeout(initDataTable, 100);
    return;
  }

  origenTable = $("#origenTable").DataTable({
    ajax: {
      url: "origen/get-all",
      type: "GET",
      dataSrc: "result",
    },
    columns: [
      { data: "nombre" },
      {
        data: null,
        render: function (data, type, row) {
          return `
                        <div class="btn-group btn-group-sm" role="group">
                            <button class="btn btn-outline-primary btn-editar-carrera" data-id="${row.id}" onclick="editarOrigen(${row.id}, '${row.nombre}')"><i class="bi bi-pencil-square"></i></button>
                            <button class="btn btn-outline-danger btn-eliminar-carrera" data-id="${row.id}" onclick="eliminarOrigen(${row.id}, '${row.nombre}')"><i class="bi bi-trash"></i></button>
                        </div>
                    `;
        },
      },
    ],
    responsive: true,
    language: { url: "//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json" },
    paging: true,
    pageLength: 10,
  });
}

function inicializarEventosOrigen() {
  const btnAdd = document.getElementById("btnAdd");

  if (btnAdd) btnAdd.addEventListener("click", abrirModalAgregarOrigen);
}

function abrirModalAgregarOrigen() {
  document.getElementById("modalTitle").textContent = "Agregar origen";
  document.getElementById("origenId").value = "0";
  document.getElementById("formOrigen").reset();
  //poblarSelectInstituciones();
  const modal = new bootstrap.Modal(
    document.getElementById("modalAgregarEditarOrigen"),
  );
  modal.show();
}

const formOrigen = document.getElementById("formOrigen");

formOrigen.addEventListener("submit", (e) => {
  e.preventDefault();

  const formData = new FormData(formOrigen);

  fetch("origen/save", {
    method: "POST",
    body: formData,
  })
    .then((res) => res.json())
    .then((data) => {
      if (data.status == "success") {
        Swal.fire("¡Éxito!", data.message, "success").then(() => {
          const modal = bootstrap.Modal.getInstance(
            document.getElementById("modalAgregarEditarOrigen"),
          );
          if (modal) modal.hide();
          // Aquí podrías recargar la tabla o actualizar el estado local
          origenTable.ajax.reload(null, false); // Si usas AJAX para cargar datos, de lo contrario actualiza localmente
        });
      } else {
        Swal.fire(
          "Error",
          "Error al guardar el origen: " + data.message,
          "error",
        );
      }
    });
});

function editarOrigen(id, nombre) {
  document.getElementById("modalTitle").textContent = "Editar Origen";
  document.getElementById("origenId").value = id;
  document.getElementById("name_origen").value = nombre;
  const modal = new bootstrap.Modal(
    document.getElementById("modalAgregarEditarOrigen"),
  );
  modal.show();
}

function eliminarOrigen(id, nombre) {
  Swal.fire({
    title: "¿Eliminar origen?",
    text: `¿Eliminar ${nombre}?`,
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#dc3545",
    cancelButtonColor: "#6c757d",
    confirmButtonText: "Sí, eliminar",
  }).then((res) => {
    if (res.isConfirmed) {
      fetch(`/origen/delete/${id}`, {
        method: "GET",
      })
        .then((response) => response.json())
        .then((data) => {
          if (data.status === "success") {
            Swal.fire("Eliminada", data.message, "success").then(() => {
              const modal = bootstrap.Modal.getInstance(
                document.getElementById("modalAgregarEditarOrigen"),
              );
              if (modal) modal.hide();
              origenTable.ajax.reload(null, false);
            });
          } else {
            Swal.fire(
              "Error",
              "Error al eliminar el origen: " + data.message,
              "error",
            );
          }
        });
    }
  });
}
