"use strict";

let institucionesTable;

document.addEventListener('DOMContentLoaded', function () {
  initDataTable();
  inicializarEventosInstituciones();
});

function initDataTable() {
  if (typeof $ === 'undefined') {
    setTimeout(initDataTable, 100);
    return;
  }

  institucionesTable = $("#institucionesTable").DataTable({
    ajax: {
      url: "instituciones/get-all",
      type: "GET",
      dataSrc: "result",
    },
    columns: [
      { data: 'tipo' },
      { data: 'nombre' },
      { data: 'abreviatura' },
      { data: 'sector' },
      {
        data: null,
        render: function (data, type, row) {
          return `
                <div class="btn-group btn-group-sm" role="group">
                  <button class="btn btn-outline-primary btn-editar-institucion" data-id="${row.id}" onclick="abrirModalEditarInstitucion(${row.id}, '${row.nombre}', '${row.abreviatura}', '${row.sector}', '${row.tipo}')"><i class="bi bi-pencil-square"></i></button>
                  <button class="btn btn-outline-danger btn-eliminar-institucion" data-id="${row.id}" onclick="eliminarInstitucion(${row.id}, '${row.nombre}')"><i class="bi bi-trash"></i></button>
                </div>
              `;
        }
      }
    ],
    responsive: true,
    language: { url: "//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json" },
    paging: true,
    pageLength: 10
  });

}

function inicializarEventosInstituciones() {
  const btnAdd = document.getElementById('btnAdd');
  if (btnAdd) btnAdd.addEventListener('click', abrirModalAgregarInstitucion);
}

function abrirModalAgregarInstitucion() {
  document.getElementById('modalTitle').textContent = 'Agregar Institución';
  document.getElementById('institucionId').value = '0';
  document.getElementById('formInstitucion').reset();

  const modal = new bootstrap.Modal(document.getElementById('modalInstitucion'));
  modal.show();

}

function abrirModalEditarInstitucion(id, nombre, abreviatura, sector, tipo) {

  document.getElementById('modalTitle').textContent = 'Editar Institución';
  document.getElementById('institucionId').value = id;
  document.getElementById('institucionTipo').value = tipo;
  document.getElementById('institucionNombre').value = nombre;
  document.getElementById('institucionSigla').value = abreviatura;
  document.getElementById('institucionSector').value = sector;

  const modal = new bootstrap.Modal(document.getElementById('modalInstitucion'));
  modal.show();
}

function eliminarInstitucion(id, nombre) {
  Swal.fire({
    title: '¿Eliminar institución?',
    text: `¿Eliminar ${nombre}?`,
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#dc3545',
    cancelButtonColor: '#6c757d',
    confirmButtonText: 'Sí, eliminar'
  }).then((res) => {
    if (res.isConfirmed) {
      fetch(`/instituciones/delete/${id}`, {
        method: 'GET'
      }).then(response => response.json())
        .then(data => {
          if (data.status == 'success') {
            Swal.fire('Eliminada', 'Institución eliminada', 'success');
            institucionesTable.ajax.reload(null, false);
          } else {
            Swal.fire('Error', 'Error al eliminar la institución: ' + data.message, 'error');
          }
        }).catch(() => {
          Swal.fire('Error', 'Error al eliminar la institución', 'error');
        });
    }
  });
}

const formInstitucion = document.getElementById('formInstitucion');

formInstitucion.addEventListener('submit', function (e) {
  e.preventDefault();

  const formData = new FormData(formInstitucion);

  fetch('/instituciones/save', {
    method: 'POST',
    body: formData
  }).then(response => response.json())
    .then(data => {

      if (data.status == 'success') {

        institucionesTable.ajax.reload(null, false);
        const modalEl = document.getElementById('modalInstitucion');
        const modal = bootstrap.Modal.getInstance(modalEl);
        modal.hide();
        Swal.fire({
          title: "¡Éxito!",
          text: data.message,
          icon: "success"
        }).then(() => {
          const modal = bootstrap.Modal.getInstance(document.getElementById("modalInstitucion"));
          if (modal) modal.hide();
        });
      } else {
        alert('Error al guardar la institución: ' + data.message);
      }
    })
});