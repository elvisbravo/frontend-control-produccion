"use strict";

let carrerasTable;

document.addEventListener('DOMContentLoaded', function () {
    initDataTable();
    inicializarEventosCarreras();
});

function initDataTable() {
    if (typeof $ === 'undefined') {
        setTimeout(initDataTable, 100);
        return;
    }

    carrerasTable = $('#carrerasTable').DataTable({
        ajax: {
            url: "carreras/get-all",
            type: "GET",
            dataSrc: "result",
        },
        columns: [
            {
                data: 'institucion_nombre',
            },
            { data: 'nombre' },
            {
                data: null,
                render: function (data, type, row) {
                    return `
                        <div class="btn-group btn-group-sm" role="group">
                            <button class="btn btn-outline-primary btn-editar-carrera" data-id="${row.id}" onclick="editarCarrera(${row.id}, '${row.nombre}', ${row.institucion_id})"><i class="bi bi-pencil-square"></i></button>
                            <button class="btn btn-outline-danger btn-eliminar-carrera" data-id="${row.id}" onclick="eliminarCarrera(${row.id}, '${row.nombre}')"><i class="bi bi-trash"></i></button>
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

function inicializarEventosCarreras() {
    const btnAdd = document.getElementById('btnAddCarrera');

    if (btnAdd) btnAdd.addEventListener('click', abrirModalAgregarCarrera);
}

function abrirModalAgregarCarrera() {
    document.getElementById('modalCarreraTitle').textContent = 'Agregar Carrera';
    document.getElementById('carreraId').value = '0';
    document.getElementById('formCarrera').reset();
    //poblarSelectInstituciones();
    const modal = new bootstrap.Modal(document.getElementById('modalAgregarEditarCarrera'));
    modal.show();
}

function editarCarrera(id, nombre, institucionId) {
    document.getElementById('modalCarreraTitle').textContent = 'Editar Carrera';
    document.getElementById('carreraId').value = id;
    document.getElementById('carreraInstitucion').value = institucionId;
    document.getElementById('carreraNombre').value = nombre;
    const modal = new bootstrap.Modal(document.getElementById('modalAgregarEditarCarrera'));
    modal.show();
}

function eliminarCarrera(id, nombre) {
    Swal.fire({
        title: '¿Eliminar carrera?',
        text: `¿Eliminar ${nombre}?`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc3545',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Sí, eliminar'
    }).then(res => {
        if (res.isConfirmed) {
            fetch(`/carreras/delete/${id}`, {
                method: 'GET'
            }).then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        Swal.fire('Eliminada', data.message, 'success').then(() => {
                            carrerasTable.ajax.reload(null, false);
                        });
                    } else {
                        Swal.fire('Error', 'Error al eliminar la carrera: ' + data.message, 'error');
                    }
                })

        }
    });
}

const formCarrera = document.getElementById('formCarrera');

formCarrera.addEventListener('submit', function (e) {
    e.preventDefault();

    const formData = new FormData(formCarrera);

    fetch('/carreras/save', {
        method: 'POST',
        body: formData
    }).then(response => response.json())
        .then(data => {

            if (data.status == 'success') {
                Swal.fire('¡Éxito!', data.message, 'success').then(() => {
                    const modal = bootstrap.Modal.getInstance(document.getElementById('modalAgregarEditarCarrera'));
                    if (modal) modal.hide();
                    // Aquí podrías recargar la tabla o actualizar el estado local
                    carrerasTable.ajax.reload(null, false); // Si usas AJAX para cargar datos, de lo contrario actualiza localmente
                });
            } else {
                Swal.fire('Error', 'Error al guardar la carrera: ' + data.message, 'error');
            }
        }).catch(() => {
            Swal.fire('Error', 'Error al guardar la carrera', 'error');
        });
});